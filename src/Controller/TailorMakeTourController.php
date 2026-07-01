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

class TailorMakeTourController extends AppController
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
		//Configure::write('debug',true);
	}

	// Generate CAPTCHA (Numbers or Alphabets)
	/* private function generateCaptcha(): string
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
	
	
	public function validateCaptcha()
{
    $captchaInput = strtoupper(trim($this->request->getData('enquiry_captcha_text')));
    $captchaStored = strtoupper($this->request->getSession()->read('captcha_code'));

    if ($captchaInput !== $captchaStored) {
        return $this->response->withType('application/json')
            ->withStringBody(json_encode(['success' => false, 'errorMessage' => 'Incorrect CAPTCHA. Try again.']));
    }

    return $this->response->withType('application/json')
        ->withStringBody(json_encode(['success' => true]));
}
 */

	public function tcaptcha(): Response
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

	public function tverifyCaptcha()
	{
		$this->request->allowMethod(['post']);
		$input = strtoupper((string)$this->request->getData('captcha'));
		$stored = strtoupper((string)$this->request->getSession()->read('captcha_code'));

		$isValid = ($input === $stored);

		return $this->response->withType('application/json')
			->withStringBody(json_encode($isValid));
	}

	private function getAllCountryList()
	{
		$tabTblsCountry = $this->fetchTable('TblsCountry');
		$options['order'] = array("TblsCountry.name" => "ASC");
		$countryInfo = $tabTblsCountry->find('list', [
			'keyField' => 'id',      // The field to use for the key (usually primary key)
			'valueField' => 'name'   // The field to use for the value (name or other field)
		], $options)->toArray();
		return $countryInfo;
	}

	public function tailorMakeTour()
	{
		$this->loadComponent('Seo');
		// Set the layout.
		$this->viewBuilder()->setLayout('version2/default');
		$tblEnquiry  = $this->fetchTable('TblsEnquiry');
		$tblEnquiryDetail  = $this->fetchTable('TblsEnquiryDetail');

		$countryList = $this->getAllCountryList();
		$this->set("countryList", $countryList);

		if ($this->request->is('post')) {

			$hotelPreference = implode(",", $this->request->getData('hotel_preferences'));
			$roomsData = $this->_prepareRoomData($this->request->getData());

			/* echo "<pre>";
			print_r($roomsData);
			exit; */

			$data = $tblEnquiry->newEntity($this->request->getData());
			$data->name = $this->request->getData("name");
			$data->email = $this->request->getData("email");
			$data->phone = $this->request->getData("phone");
			$data->country = $this->request->getData("country");
			$data->enquiry_source = 'tailor_make_a_tour';
			if ($tblEnquiry->save($data)) {
				$other_information = array(
					"nationality" => '',
					'room_data' => $roomsData,
					'currency' => '',
					'travel_budget' => '',
					'travel_date' => $this->request->getData('date'),
					'no_of_rooms' => $this->request->getData('no_of_rooms'),
					'star_hotel' => $hotelPreference
				);
				$other_information = serialize($other_information);
				$edata = $tblEnquiryDetail->newEntity($this->request->getData());
				$edata->enquiry_id = $data->id;
				$edata->message = $this->request->getData("requirement");
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
				$emailData["country"] = $this->request->getData("country");
				//$emailData["no_of_adults"] = $this->request->getData("no_of_adults");
				//$emailData["no_of_children"] = $this->request->getData("no_of_children");
				//$emailData["no_of_days"] = $this->request->getData("no_of_days");
				//$emailData["travel_budget"] = $this->request->getData("travel_budget");
				$emailData["travel_date"] = $this->request->getData("date");
				$emailData["hotelPreference"] = $hotelPreference;
				$emailData["roomsData"] = $roomsData;
				$emailData["message"] = $this->request->getData("requirement");
				if ($this->sendEmail($emailData)) {
                  	$this->sendAckMail($emailData);
					$this->redirect(array("controller" => "TailorMakeTour", "action" => "confirmation"));
				} else {
					$this->Flash->error('Failed to send email.');
				}
			}
		}
		
		$sectionCode = 'TAILOR_MAKE_A_TOUR';
				
		$requestWebsiteData = array(
								"section_code"		=>	$sectionCode
						);
						
		$websiteSectionData=$this->getWebsiteContentData($requestWebsiteData);
		
		$data['faq'] = $websiteSectionData['faq'];
		$data['content'] = $websiteSectionData['content'];
		
		$seoTags = array();
		$seoTags['meta_title'] = "Tailor-Made Luxury Tours of India | Design Your Custom Tour";
		$seoTags['meta_description'] = "Tailor-make a tour through India’s Golden Triangle, royal palaces, and hidden gems — bespoke itineraries, luxury stays, and seamless travel to match your style.";
		$seoTags['meta_keyword'] = "tailor made tour India, luxury tailor-made tours, custom India itineraries, Golden Triangle tours, bespoke India travel";
		$seoTags['canonical_url'] = WEBROOT.'tailor-make-a-tour';
		$seoTags['itemprop_name'] = 'Tailor Make a Tour';
		$seoTags['date_published'] = date("Y-m-d",strtotime("-1 years"));
		$seoTags['date_modified'] = date("Y-m-d",strtotime("-1 months"));
		
		$metaTags = $this->Seo->getSeoTags($seoTags,'general');
		
		$data['meta_tags'] = $metaTags;
		
		
		$schemaTags = array();

		#### SETTING BREADCRUMB
		
		$breadcrumbs = array();
		$schemaBreadcrumb = array();

		$breadcrumbs[]=array(
								"label"			=>		"Home",
								"link"			=>		WEBROOT,
								"link_url"		=>		true
				);

		$breadcrumbs[]=array(
								"label"			=>		"Tailor Make a Tour",
								"link"			=>		WEBROOT.'tailor-make-a-tour',
								"link_url"		=>		false
				);
				
		$data['breadcrumbs'] = $breadcrumbs;
				
		$breadCrumbSchemaTags = array();
		$breadCrumbSchemaTags['breadcrumbs'] = $breadcrumbs;
		$breadCrumbSchemaTags['schema_category_type'] = 'breadcrumb';
		$breadCrumbSchema = $this->Seo->getSchema($breadCrumbSchemaTags);
		$schemaTags[] = $breadCrumbSchema;
		
		$organisationSchemaTags = array();
		$organisationSchemaTags['schema_category_type'] = 'organisation';
		$organisationSchema = $this->Seo->getSchema($organisationSchemaTags);
		$schemaTags[] = $organisationSchema;
		
		$websiteSchemaTags = array();
		$websiteSchemaTags['schema_category_type'] = 'website';
		$websiteSchema = $this->Seo->getSchema($websiteSchemaTags);
		$schemaTags[] = $websiteSchema;
		
		$reviewSchemaTags = array();
		$reviewSchemaTags['schema_category_type'] = 'review';
		$reviewSchema = $this->Seo->getSchema($reviewSchemaTags);
		$schemaTags[] = $reviewSchema;
		
		$data['schema'] = $schemaTags;
		
		
		$this->set('data',$data);
	}

	private function _prepareRoomData($data)
	{
		$rooms = [];

		foreach ($data as $key => $value) {
			// Match room adults
			if (preg_match('/^room_(\d+)_adults$/', $key, $match)) {
				$roomKey = 'room' . $match[1];
				$rooms[$roomKey]['adults'] = $value;
			}

			// Match room children
			if (preg_match('/^room_(\d+)_children$/', $key, $match)) {
				$roomKey = 'room' . $match[1];
				$rooms[$roomKey]['children'] = $value;
			}

			// Match child ages
			if (preg_match('/^room_(\d+)_children_age_(\d+)$/', $key, $match)) {
				$roomKey = 'room' . $match[1];
				$childIndex = $match[2];
				$rooms[$roomKey]['child_ages'][] = $value;
			}
		}

		return $rooms;
	}

	private function _roomDataToReadableText(array $rooms): string
	{
		$text = "";
		foreach ($rooms as $roomKey => $room) {
			$text .= "<b>".ucfirst($roomKey) . ":</b>\n";
			$text .= "- Adults: " . $room['adults'] . "\n";
			$text .= "- Children: " . $room['children'] . "\n";

			if (!empty($room['child_ages'])) {
				$text .= "- Child Ages: " . implode(", ", $room['child_ages']) . "\n";
			}

			$text .= "\n";
		}
		return trim($text);
	}
	public function confirmation()
	{
		$this->viewBuilder()->setLayout('version2/default');
		$confirmationPageParameter = array(
			"title" =>  "Thank You",
			"description"	=>	"<h3>Your query has been received.</h3><div>Thank you for contacting us. Your query has been received to us.</div><div> We will contact you shortly.</div>"
		);
		$this->set("confirmationPageParameter", $confirmationPageParameter);
	}
	public function sendEmail($data)
	{
		$userIp = $_SERVER['REMOTE_ADDR'];
		$ipInformation = $this->UserIpLocator->getUserIpDetail($userIp);
		// Example data
		//$to = 'sales2@elegantjourneys.co';
		$subject = 'Tailor Make a Tour Enquiry';
		// HTML content
		$htmlContent = '
    <html>
	<head>
	  <title>Tailor Maka a Tour Enquiry From Website</title>
	</head>
	<body>
	  <p>Here are the details of enquiry submitted by visitors!</p>
	  <table padding="2" border="1">
		<tr>
		  <th style="text-align:left;">Name</th>
		  <td>' . $data['name'] . '</th>
		</tr>
		<tr>
		  <th style="text-align:left;">Email</th>
		  <td>' . $data['email'] . '</th>
		</tr>
		<tr>
		  <th style="text-align:left;">Phone</th>
		  <td>' . $data['phone'] . '</th>
		</tr>
		
		<tr>
		  <th style="text-align:left;">Nationality</th>
		  <td>' . $data['country'] . '</th>
		</tr>
		<tr>
		  <th style="text-align:left;">Room Details</th>
		  <td>' . $this->_roomDataToReadableText( $data['roomsData']) . '</th>
		</tr>
		<tr>
		  <th style="text-align:left;">Travel Date</th>
		  <td>' . $data['travel_date'] . '</th>
		</tr>
		<tr>
		  <th style="text-align:left;">Hotels Preference</th>
		  <td>' . $data['hotelPreference'] . ' Star</th>
		</tr>
		<tr>
		  <th style="text-align:left;">Message</th>
		  <td>' . $data['message'] . '</th>
		</tr>
		<tr>
			<td colspan="2"><strong> Details retrieve from IP address</strong></td>
		</tr>			
		<tr>
			<td>IP Address</td>
			<td>' . $_SERVER['REMOTE_ADDR'] . '</td>
		</tr>
		  <tr>
			<td>Country</td>
			<td>' . $ipInformation['countryName'] . '</td>
		  </tr>
		  <tr>
			<td>Region</td>
			<td>' . $ipInformation['regionName'] . '</td>
		  </tr>
		   <tr>
			<td>City</td>
			<td>' . $ipInformation['cityName'] . '</td>
		  </tr>
		   <tr>
			<td>Time Zone</td>
			<td>' . $ipInformation['timeZone'] . '</td>
		  </tr>
	  </table>
	</body>
	</html>';
		// Send the email
		$result = $this->Email->sendHTMLEmail($to = "sales2@elegantjourneys.co", $subject, $htmlContent);
		//$result = $this->Email->sendHTMLEmail($to = "mr.ujjwal.kumar@gmail.com", $subject, $htmlContent);
		if ($result === true) {
			return true;
		} else {
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
                    <li>Australia: (+61) 02-8488-0900</li>
                    <li>USA/Canada: (+1) 332-213-8200</li>
                    <li>United Kingdom: (+44) 20-3769-7001</li>
                    <li>India: (+91) 99100-78975</li>
                </ul>
                <p><strong>Whatsapp:</strong> +91 98115 39696</p>  
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
