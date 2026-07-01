<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use Cake\Routing\Router;

//use Cake\Mailer\Mailer;

class EnquiryController extends AppController
{
	
	public function initialize(): void
    {
        parent::initialize();
		$this->loadComponent('Email'); // Load the EmailComponent
		$this->loadComponent('UserIpLocator'); // Load the EmailComponent
        $this->loadComponent('RequestHandler'); // Required for AJAX
    }


    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
		//Configure::write('debug',true);
    }

	public function tourEnquiry()
{
    // Disable view rendering
    $this->autoRender = false;

    // Fetch the required tables
    $tblEnquiry = $this->fetchTable('TblsEnquiry');
    $tblEnquiryDetail = $this->fetchTable('TblsEnquiryDetail');

    if ($this->request->is('post')) {
        // Retrieve the JSON data
        $decodedData = json_decode($this->request->getData('formData'), true);

	
        // Check if the JSON structure contains both `additionalData` and `rooms`
        if (!isset($decodedData['additionalData']) || !is_array($decodedData['additionalData']) || 
            !isset($decodedData['rooms']) || !is_array($decodedData['rooms'])) {
            return $this->response->withStatus(400)->withStringBody('Invalid data structure.');
        }
		
		 // Filter non-zero hotel categories
        $hotelPreferences = [];
        foreach ($decodedData['additionalData'] as $data) {
            if ($data['name'] === 'hotel_categories[]' && $data['value'] !== '0') {
                $hotelPreferences[] = $data['value'];
            }
        }

        // Parse `additionalData` into an associative array
        $additionalData = [];
        foreach ($decodedData['additionalData'] as $data) {
            if (isset($data['name']) && isset($data['value'])) {
                $additionalData[$data['name']] = $data['value'];
            }
        }

        // Validate parsed data
        if (empty($additionalData['name']) || empty($additionalData['email']) || empty($additionalData['phone'])) {
            return $this->response->withStatus(400)->withStringBody('Missing required fields.');
        }

        // Parse `rooms` data
        $rooms = $decodedData['rooms'];
		

        // Prepare the enquiry data for saving
        $data = $tblEnquiry->newEmptyEntity();
        $data->name = $additionalData['name'];
        $data->email = $additionalData['email'];
        $data->phone = $additionalData['phone'];
        $data->country = $additionalData['country'] ?? '';
        $data->enquiry_source = 'tour_enquiry';

        if ($tblEnquiry->save($data)) {
            // Prepare other information
            $otherInformation = [
                'no_of_travelers' => $rooms,
                'hotelPreference' => implode(', ', $hotelPreferences),
                'arrival_date' => $additionalData['arrival_date'] ?? ''
            ];
            $serializedOtherInformation = serialize($otherInformation);

            // Prepare the enquiry detail data for saving
            $edata = $tblEnquiryDetail->newEmptyEntity();
            $edata->enquiry_id = $data->id;
            $edata->message = $additionalData['specialRequirements'] ?? '';
            $edata->page_url = '';
            $edata->tour_id = 0;
            $edata->tour_name = '';
            $edata->user_ip = $_SERVER['REMOTE_ADDR'];
            $edata->other_information = $serializedOtherInformation;

            if ($tblEnquiryDetail->save($edata)) {
                // Send email
                $emailData = [
                    'name' => $additionalData['name'],
                    'email' => $additionalData['email'],
                    'phone' => $additionalData['phone'],
                    'country' => $additionalData['country'] ?? '',
                    'arrival_date' => $additionalData['arrival_date'] ?? '',
                    'hotelPreference' => implode(', ', $hotelPreferences),
                    'rooms' => $rooms,
					'page_url' => $decodedData['pageUrl'],
                    'message' => $additionalData['specialRequirements'] ?? ''
                ];

                if ($this->sendEmail($emailData)) {
                    return $this->response->withStringBody('Enquiry submitted successfully.');
                } else {
                    return $this->response->withStatus(500)->withStringBody('Failed to send email.');
                }
            } else {
                return $this->response->withStatus(500)->withStringBody('Failed to save enquiry details.');
            }
        } else {
            return $this->response->withStatus(500)->withStringBody('Failed to save enquiry.');
        }
    } else {
        return $this->response->withStatus(405)->withStringBody('Method not allowed.');
    }
}
	public function confirmation(){
		$this->viewBuilder()->setLayout('version1/default');
		$confirmationPageParameter = array(

			"title" =>  "Thank You",

			"description"	=>	"<h3>Your query has been received.</h3><div>Thank you for contacting us. Your query has been received to us.</div><div> We will contact you shortly.</div>"

									);

		$this->set("confirmationPageParameter",$confirmationPageParameter);							
	}


	public function sendEmail($data)
	{
    //$to = 'sales2@elegantjourneys.co';
    $subject = 'Final-O enquiry ' . $data['tour_code'] . ' - ' . $data['name'];

    // HTML content
    $htmlContent = '
    <html>
    <head>
      <title>Tour Enquiry From Website</title>
    </head>
    <body>
      <p>Here are the details of enquiry submitted by visitors!</p>
      <table width="400" border="1" cellpadding="0" cellspacing="0">
        <tr>
          <th>Tour Name</th>
          <td style="text-align:left;">' . $data['tour_id'] . '##' . $data['tour_name'] . '</td>
        </tr>
        <tr>
          <th>Page Url</th>
          <td>' . $data['page_url'] . '</td>
        </tr>
        <tr>
          <th>Name</th>
          <td>' . $data['name'] . '</td>
        </tr>
        <tr>
          <th>Email</th>
          <td>' . $data['email'] . '</td>
        </tr>
        <tr>
          <th>Phone</th>
          <td>' . $data['phone'] . '</td>
        </tr>
        <tr>
          <th>Country</th>
          <td>' . $data['country'] . '</td>
        </tr>
        <tr>
          <th>Hotel Preference</th>
          <td>' . $data['hotelPreference'] . '</td>
        </tr>
        <tr>
          <th>Arrival Date</th>
          <td>' . $data['arrival_date'] . '</td>
        </tr>
        <tr>
          <th>Message</th>
          <td>' . $data['message'] . '</td>
        </tr>
        <tr>
          <th>IP</th>
          <td><a href="' . WEBROOT . 'ip-information.php?ip=' . $data['user_ip'] . '">' . $data['user_ip'] . '</a></td>
        </tr>';

    // Add room details dynamically in the same table
    foreach ($data['rooms'] as $index => $room) {
        $htmlContent .= '
        <tr>
          <th>Room ' . ($index + 1) . '</th>
          <td>
            <strong>Adults:</strong> ' . $room['adults'] . '<br>
            <strong>Children:</strong> ' . $room['children'] . '<br>
            <strong>Children Ages:</strong> ' . (empty($room['childAges']) ? 'N/A' : implode(', ', $room['childAges'])) . '
          </td>
        </tr>';
    }

    $htmlContent .= '
      </table>
    </body>
    </html>';

    // Send the email
    $result = $this->Email->sendHTMLEmail($to="sales2@elegantjourneys.co", $subject, $htmlContent);
    //$result = $this->Email->sendHTMLEmail($to = "mr.ujjwal.kumar@gmail.com", $subject, $htmlContent);

    if ($result === true) {
        return true;
    } else {
        return false;
    }
}


/*************************Start Contact Us*****************************************/
public function contactUs()
{
    // Disable view rendering
    $this->autoRender = false;

    // Fetch the required tables
    $tblEnquiry = $this->fetchTable('TblsEnquiry');
    $tblEnquiryDetail = $this->fetchTable('TblsEnquiryDetail');

    if ($this->request->is('post')) {
        // Retrieve the JSON data
        $decodedData = json_decode($this->request->getData('formData'), true);

        // Check if JSON structure is valid
        if (!isset($decodedData)) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'errorMessage' => 'Invalid data structure.']));
        }

        parse_str($decodedData, $additionalData); // Convert to associative array

        // CAPTCHA Validation
        $captchaInput = strtoupper(trim($additionalData['captcha']));
        $captchaStored = strtoupper($this->request->getSession()->read('captcha_code'));

        if ($captchaInput !== $captchaStored) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'errorMessage' => 'Incorrect CAPTCHA. Try again.']));
        }

        // Prepare enquiry data for saving
        $data = $tblEnquiry->newEmptyEntity();
        $data->name = $additionalData['firstname'] . " " . $additionalData['lastname'];
        $data->first_name = $additionalData['firstname'];
        $data->last_name = $additionalData['lastname'];
        $data->email = $additionalData['email'];
        $data->phone = $additionalData['phone'];
        $data->country = $additionalData['country'] ?? '';
        $data->enquiry_source = 'tour_enquiry';

        if ($tblEnquiry->save($data)) {
            // Prepare other information
            $otherInformation = [
                'purpose_of_contact' => $additionalData['purpose_of_contact'] ?? ''
            ];
            $serializedOtherInformation = serialize($otherInformation);

            // Save enquiry details
            $edata = $tblEnquiryDetail->newEmptyEntity();
            $edata->enquiry_id = $data->id;
            $edata->message = $additionalData['contact_travel_requirement'] ?? '';
            $edata->page_url = '';
            $edata->tour_id = 0;
            $edata->tour_name = '';
            $edata->user_ip = $_SERVER['REMOTE_ADDR'];
            $edata->other_information = $serializedOtherInformation;

            if ($tblEnquiryDetail->save($edata)) {
                // Send email
                $emailData = [
                    'firstName' => $additionalData['firstname'],
                    'lastName' => $additionalData['lastname'],
                    'email' => $additionalData['email'],
                    'phone' => $additionalData['phone'],
                    'address' => $additionalData['address'],
                    'city' => $additionalData['city'] ?? '',
                    'country' => $additionalData['country'] ?? '',
                    'purpose_of_contact' => $additionalData['purpose_of_contact'] ?? '',
                    'message' => $additionalData['contact_travel_requirement'] ?? ''
                ];

                if ($this->sendContactUsEmail($emailData)) {
                    return $this->response->withType('application/json')
                        ->withStringBody(json_encode(['success' => true, 'message' => 'Contact Us submitted successfully.','data' => $emailData]));
						
                } else {
                    return $this->response->withStatus(500)
                        ->withType('application/json')
                        ->withStringBody(json_encode(['success' => false, 'errorMessage' => 'Failed to send email.']));
                }
            } else {
                return $this->response->withStatus(500)
                    ->withType('application/json')
                    ->withStringBody(json_encode(['success' => false, 'errorMessage' => 'Failed to save enquiry details.']));
            }
        } else {
            return $this->response->withStatus(500)
                ->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'errorMessage' => 'Failed to save enquiry.']));
        }
    } else {
        return $this->response->withStatus(405)
            ->withType('application/json')
            ->withStringBody(json_encode(['success' => false, 'errorMessage' => 'Method not allowed.']));
    }
}


// Generate CAPTCHA (Numbers or Alphabets)
    private function generateCaptcha(): string
    {
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789'; // Avoid 0, O, I, 1 for clarity
        return substr(str_shuffle($characters), 0, 5); // Generate a 5-character CAPTCHA
    }

    public function getCaptcha()
    {
        $captcha = $this->generateCaptcha();
        $this->request->getSession()->write('captcha_code', $captcha);
        $this->set('captcha', $captcha);
        $this->viewBuilder()->setOption('serialize', ['captcha']);
    }
	public function sendContactUsEmail($data)
	{
	$ipInformation = $this->getUserDetailByIp();
	
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
      <table width="400" border="1" cellpadding="0" cellspacing="0">
        <tr>
		  <th style="text-align:left;">First Name</th>
		  <td>'.$data['firstName'].'</td>
		</tr>
		<tr>
		  <th style="text-align:left;">Last Name</th>
		  <td>'.$data['lastName'].'</td>
		</tr>
		<tr>
		  <th style="text-align:left;">Email</th>
		  <td>'.$data['email'].'</td>
		</tr>
		<tr>
		  <th style="text-align:left;">Phone</th>
		  <td>'.$data['phone'].'</td>
		</tr>
		<tr>
		  <th style="text-align:left;">Address</th>
		  <td>'.$data['address'].'</td>
		</tr>
		<tr>
		  <th style="text-align:left;">City</th>
		  <td>'.$data['city'].'</td>
		</tr>
		<tr>
		  <th style="text-align:left;">Country</th>
		  <td>'.$data['country'].'</td>
		</tr>
		<tr>
		  <th style="text-align:left;">Purpose of Contact</th>
		  <td>'.$data['purpose_of_contact'].'</td>
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
    //$result = $this->Email->sendHTMLEmail($to = "mr.ujjwal.kumar@gmail.com", $subject, $htmlContent);
    if ($result === true) {
        return true;
    } else {
        return false;
    }
}
/*************************End Contact Us*****************************************/

function getUserDetailByIp()
	{
		$userIp = $_SERVER['REMOTE_ADDR'];
		$data['user_ip']=$userIp;
		$ipInformation = $this->UserIpLocator->getUserIpDetail($userIp);
		
		//print_r($ipInformation);exit;
		return $ipInformation;
	}


}



