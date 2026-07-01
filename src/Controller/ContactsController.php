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


class ContactsController extends AppController
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

    public function captcha(): Response
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

    public function verifyCaptcha()
    {
        $this->request->allowMethod(['post']);
        $input = strtoupper((string)$this->request->getData('captcha'));
        $stored = strtoupper((string)$this->request->getSession()->read('captcha_code'));

        $isValid = ($input === $stored);

        return $this->response->withType('application/json')
            ->withStringBody(json_encode($isValid));
    }

    public function contactUs()
    {
        $this->viewBuilder()->setLayout('version2/default');
      
      #### SETTING BREADCRUMB
		
		$breadcrumbs = array();
		$schemaBreadcrumb = array();

		$breadcrumbs[]=array(
								"label"			=>		"Home",
								"link"			=>		WEBROOT,
								"link_url"		=>		true
				);

		$breadcrumbs[]=array(
								"label"			=>		'Contact Us',
								"link"			=>		false,
								"link_url"		=>		false
				);
				
		
		$data['breadcrumbs'] = $breadcrumbs;
		
		$this->set("data",$data);
      
        $this->set('showEnquiryModal', false);
        $this->set(compact('contact'));
    }

    public function sendContact()
    {
        $tblEnquiry  = $this->fetchTable('TblsEnquiry');
		$tblEnquiryDetail  = $this->fetchTable('TblsEnquiryDetail');
        $this->request->allowMethod(['post']);
        $data = $this->request->getData();
        $session = $this->request->getSession();

        $captchaInput = strtoupper(trim($data['captcha']));
        $captchaStored = strtoupper($session->read('captcha_code'));

        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = 'Name is required.';
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Valid email is required.';
        }

        if (empty($data['phone']) || !preg_match('/^[0-9]{5,15}$/', $data['phone'])) {
            $errors['phone'] = 'Valid phone number is required.';
        }

        if (empty($data['purpose'])) {
            $errors['purpose'] = 'Purpose is required.';
        }

        if (empty($data['captcha'])) {
            $errors['captcha'] = 'CAPTCHA is required.';
        } elseif ($captchaInput !== $captchaStored) {
            $errors['captcha'] = 'Incorrect CAPTCHA.';
        }

        if (!empty($errors)) {
            return $this->response->withType('application/json')->withStringBody(json_encode([
                'status' => 'error',
                'errors' => $errors
            ]));
        }

        $data = $tblEnquiry->newEntity($this->request->getData());
        $data->name = $this->request->getData("name");
        $data->email = $this->request->getData("email");
        $data->phone = $this->request->getData("phone");
        $data->enquiry_source = 'tour_enquiry';		
        if ($tblEnquiry->save($data)) {
            $other_information=array(
            'purpose' => $this->request->getData('purpose'),
            'requirements'=> $this->request->getData('requirements'),
            );
            $other_information=serialize($other_information);
            $edata = $tblEnquiryDetail->newEntity($this->request->getData());
            $edata->enquiry_id = $data->id;
            $edata->message = $this->request->getData("requirements");
            $edata->page_url = '';
            $edata->tour_id = 0;
            $edata->tour_name = '';
            $edata->user_ip = $_SERVER['REMOTE_ADDR'];
            $edata->other_information = $other_information;
            $tblEnquiryDetail->save($edata);
            //send mail
            $emailData = array();
            $emailData["name"] = $this->request->getData("name"); 
            $emailData["email"] = $this->request->getData("email"); 
            $emailData["phone"] = $this->request->getData("phone"); 
            $emailData["purpose"] = $this->request->getData("purpose"); 
            $emailData["message"] = $this->request->getData("requirements"); 
            if($this->sendEmail($emailData)){
                $this->redirect(array("controller" => "Contacts", "action" => "confirmation"));
            }else{
                $this->Flash->error('Failed to send email.');
            }
        }



    }



    public function confirmation(){
		$this->viewBuilder()->setLayout('version2/default');
		$confirmationPageParameter = array(
			"title" =>  "Thank You",
			"description"	=>	"<h3>Your query has been received.</h3><div>Thank you for contacting us. Your query has been received to us.</div><div> We will contact you shortly.</div>"
		);
		$this->set("confirmationPageParameter",$confirmationPageParameter);							
	}
	public function sendEmail($data)
    {
	$userIp = $_SERVER['REMOTE_ADDR'];
	$ipInformation = $this->UserIpLocator->getUserIpDetail($userIp);
        // Example data
        //$to = 'sales2@elegantjourneys.co';
        $subject = 'Details received from contact us';
		// HTML content
    $htmlContent = '
    <html>
	<head>
	  <title>Details received from contact us</title>
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
		  <th style="text-align:left;">Purpose of Contact</th>
		  <td>'.$data['purpose'].'</th>
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

}
