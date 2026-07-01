<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use Cake\Mailer\Mailer;
use App\Service\IpLocatorService;


class EnquiriesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
		$this->loadComponent('Email'); // Load the EmailComponent
		$this->loadComponent('UserIpLocator'); // Load the IpLocatorComponent
		
    }
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        //Configure::write('debug',true);
    }

    public function ecaptcha(): Response
    {
        $this->autoRender = false;

        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $code = '';
        for ($i = 0; $i < 6; $i++) {
            $code .= $chars[random_int(0, strlen($chars) - 1)];
        }

        $this->getRequest()->getSession()->write('captcha_code', $code);

        $image = imagecreatetruecolor(200, 60);
        $bg = imagecolorallocate($image, 255, 255, 255);
        $textColor = imagecolorallocate($image, 0, 0, 0);
        $lineColor = imagecolorallocate($image, 200, 200, 200);

        // Fill background
        imagefilledrectangle($image, 0, 0, 200, 60, $bg);

        // Add noise lines
        /* for ($i = 0; $i < 6; $i++) {
        imageline($image, rand(0, 200), rand(0, 60), rand(0, 200), rand(0, 60), $lineColor);
        }*/

        // Use a larger TTF font (ensure file exists)
        $fontPath = WWW_ROOT . 'font' . DS . 'ARIAL.TTF'; // Use your font file
        $fontSize = 22; // You can increase/decrease this

        imagettftext($image, $fontSize, 0, 30, 40, $textColor, $fontPath, $code);

        ob_start();
        imagepng($image);
        imagedestroy($image);
        $imageData = ob_get_clean();

        return $this->response
            ->withType('image/png')
            ->withStringBody($imageData);
    }

    public function everifyCaptcha()
    {
        $this->request->allowMethod(['post']);
        $input = strtoupper((string)$this->request->getData('captcha'));
        $stored = strtoupper((string)$this->request->getSession()->read('captcha_code'));

        $isValid = ($input === $stored);

        return $this->response->withType('application/json')
            ->withStringBody(json_encode($isValid));
    }

    

    public function sendEnquiry()
{
    $tblEnquiry  = $this->fetchTable('TblsEnquiry');
    $tblEnquiryDetail  = $this->fetchTable('TblsEnquiryDetail');
    $this->request->allowMethod(['post']);
    $data = $this->request->getData();
    $session = $this->request->getSession();

    $captchaInput = strtoupper(trim($data['ecaptcha'] ?? ''));
    $captchaStored = strtoupper($session->read('captcha_code'));

    $errors = [];

    if (empty($data['fullName'])) {
        $errors['fullName'] = 'Name is required.';
    }

    if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Valid email is required.';
    }

    if (empty($data['phoneNumber']) || !preg_match('/^[0-9]{5,15}$/', $data['phoneNumber'])) {
        $errors['phoneNumber'] = 'Valid phone number is required.';
    }

    if (empty($data['ecaptcha'])) {
        $errors['ecaptcha'] = 'CAPTCHA is required.';
    } elseif ($captchaInput !== $captchaStored) {
        $errors['ecaptcha'] = 'Incorrect CAPTCHA.';
    }

    if (!empty($errors)) {
        return $this->response->withType('application/json')->withStringBody(json_encode([
            'status' => 'error',
            'errors' => $errors
        ]));
    }

    $enquiry = $tblEnquiry->newEntity($data);
    $enquiry->name = $data["fullName"];
    $enquiry->email = $data["email"];
    $enquiry->phone = $data["phoneNumber"];
    $enquiry->enquiry_source = 'tour_enquiry';
    $enquiry->page_url = $data['page_url'] ?? '';  

    if ($tblEnquiry->save($enquiry)) {
        $otherInformation = serialize([
            'extraNote' => $data['extraNote'] ?? ''
        ]);

        $enquiryDetail = $tblEnquiryDetail->newEntity($data);
        $enquiryDetail->enquiry_id = $enquiry->id;
        $enquiryDetail->message = $data['extraNote'] ?? '';
        $enquiryDetail->page_url = $data['page_url'] ?? '';
        $enquiryDetail->tour_id = 0;
        $enquiryDetail->tour_name = '';
        $enquiryDetail->user_ip = $_SERVER['REMOTE_ADDR'];
        $enquiryDetail->other_information = $otherInformation;

        $tblEnquiryDetail->save($enquiryDetail);

        // Send email
        $emailData = [
            "name" => $data["fullName"],
            "email" => $data["email"],
            "phone" => $data["phoneNumber"],
          	"page_url" => $data["page_url"] ?? '',
            "message" => $data["extraNote"] ?? ''
        ];

        $emailSent = $this->sendEmail($emailData);
      	$emailAckSent = $this->sendAckMail($emailData);

        return $this->response->withType('application/json')->withStringBody(json_encode([
            'status' => 'success',
            'message' => $emailSent ? 'Enquiry sent successfully!' : 'Enquiry saved, but email failed.'
        ]));
    }

    // Fallback response if save fails
    return $this->response->withType('application/json')->withStringBody(json_encode([
        'status' => 'error',
        'message' => 'Failed to save enquiry. Please try again.'
    ]));
}



	public function sendEmail($data)
    {
	$userIp = $_SERVER['REMOTE_ADDR'];
	$ipInformation = $this->UserIpLocator->getUserIpDetail($userIp);
        // Example data
        //$to = 'sales2@elegantjourneys.co';
        $subject = 'Details received from enquiry now';
		// HTML content
    $htmlContent = '
    <html>
	<head>
	  <title>Details received from Enquiry Now</title>
	</head>
	<body>
	  <p>Here are the details of enquiry submitted by visitors!</p>
	  <table padding="2" border="1">
		<tr>
		  <th style="text-align:left;">Name</th>
		  <td>'.$data['name'].'</th>
		</tr>
		<tr>
		  <th style="text-align:left;">Email</th>
		  <td>'.$data['email'].'</th>
		</tr>
		<tr>
		  <th style="text-align:left;">Phone</th>
		  <td>'.$data['phone'].'</th>
		</tr>
        <tr>
		  <th style="text-align:left;">Page URL</th>
		  <td>'.$data['page_url'].'</th>
		</tr>
		<tr>
		  <th style="text-align:left;">Travel Requirement</th>
		  <td>'.$data['message'].'</th>
		</tr>
		<tr>
			<td colspan="2"><strong> Details retrieve from IP address</strong></td>
		</tr>			
		<tr>
			<td>IP Address</td>
			<td>'.$_SERVER['REMOTE_ADDR'].'</td>
		</tr>
		  <tr>
			<td>Country</td>
			<td>'.$ipInformation['countryName'].'</td>
		  </tr>
		  <tr>
			<td>Region</td>
			<td>'.$ipInformation['regionName'].'</td>
		  </tr>
		   <tr>
			<td>City</td>
			<td>'.$ipInformation['cityName'].'</td>
		  </tr>
		   <tr>
			<td>Time Zone</td>
			<td>'.$ipInformation['timeZone'].'</td>
		  </tr>
	  </table>
	</body>
	</html>';
    // Send the email
    $result = $this->Email->sendHTMLEmail($to="sales2@elegantjourneys.co", $subject, $htmlContent);
	//$result = $this->Email->sendHTMLEmail($to="mr.ujjwal.kumar@gmail.com", $subject, $htmlContent);
        if ($result === true) {
            //$this->Flash->success('Email sent successfully.');
			return true;
        } else {
            //$this->Flash->error('Failed to send email. ' . $result);
			return false;
        }
    }
  
    
	public function sendAckMail($data)
{
    $subject = 'Thank You for Your Inquiry';
    $name = htmlspecialchars($data['name']);
    $to = $data['email'];

    $htmlContent = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; background-color: #f6f6f6; color: #333; }
            .email-wrapper { background: #fff; padding: 20px; max-width: 600px; margin: auto; border-radius: 8px; }
            .content { padding: 20px; }
            .call-style {font-size:11px; color:red;}
        </style>
    </head>
    <body>
        <div class='email-wrapper'>
            <div class='content'>
                <h2>Dear {$name},</h2>
                <p>Thank you for reaching out to us and submitting the inquiry form. We are delighted that you have chosen Elegant Journeys for your upcoming travel plans. Our team is currently reviewing your request and will provide you with a detailed itinerary and pricing information shortly.</p>
                <p>Should you need any immediate assistance or have additional questions, please feel free to contact us:</p>
                <p><strong>Call Us:</strong></p>
                <ul>
                    <li>Australia: +61-02-8488-0900</li>
                    <li>USA/Canada: +1-332-213-8200</li>
                    <li>United Kingdom: +44-20-3769-7001</li>
                    <li>India: +91-99100-78975</li>
                    <span class='call-style'>* Call with International dialing code</span>
                </ul>
                <p><strong>Whatsapp:</strong> +91-98115-39696</p>  
                <p><strong>Email:</strong> sales@elegantjourneys.com</p>  
                <p><strong>Website:</strong> www.elegantjourneys.com</p>  
                <p>We look forward to assisting you in planning a truly memorable and luxurious journey.</p>
                <p>Best regards,<br><strong>Team Elegant Journeys</strong></p>
            </div>
        </div>
    </body>
    </html>
    ";

    $result = $this->Email->sendHTMLEmail($to, $subject, $htmlContent);

    return $result === true;
}

}
