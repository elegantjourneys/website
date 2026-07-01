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


class TrainEnquiriesController extends AppController
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

    public function ecaptcha(): Response
    {
        $this->autoRender = false;

        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $code = '';
        for ($i = 0; $i < 6; $i++) {
            $code .= $chars[random_int(0, strlen($chars) - 1)];
        }

        $this->getRequest()->getSession()->write('ecaptcha', $code);

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
        $input = strtoupper((string)$this->request->getData('ecaptcha'));
        $stored = strtoupper((string)$this->request->getSession()->read('ecaptcha'));

        $isValid = ($input === $stored);

        return $this->response->withType('application/json')
            ->withStringBody(json_encode($isValid));
    }

public function trainSendEnquiry()
{
    $this->request->allowMethod(['post']);
    $data = $this->request->getData();
    $session = $this->request->getSession();

    $captchaInput = strtoupper(trim($data['ecaptcha'] ?? ''));
    $captchaStored = strtoupper($session->read('ecaptcha'));

    $errors = [];

    if (empty($data['ename'])) {
        $errors['ename'] = 'Name is required';
    }

    if (empty($data['eemail']) || !filter_var($data['eemail'], FILTER_VALIDATE_EMAIL)) {
        $errors['eemail'] = 'Valid email required';
    }

    if (empty($data['ephone'])) {
        $errors['ephone'] = 'Phone number required';
    }

    if ($captchaInput !== $captchaStored) {
        $errors['ecaptcha'] = 'Invalid CAPTCHA';
    }

    if (!empty($errors)) {
        return $this->response->withType('application/json')
        ->withStringBody(json_encode([
            'status' => 'error',
            'errors' => $errors
        ]));
    }
  
  $pageUrl = $data['page_url'];

$path = parse_url($pageUrl, PHP_URL_PATH);
$segments = explode('/', trim($path, '/'));
$slug = end($segments);

$trainName = ucwords(str_replace('-', ' ', $slug));

if (empty($trainName)) {
    $trainName = 'Luxury Train';
}

    $emailData = [
        "name" => $data['ename'],
        "email" => $data['eemail'],
        "phone" => $data['ephone'],
        "message" => $data['eComment'] ?? '',
      "trainName" => $trainName ?? '',
    ];

    $emailSent = $this->sendPalaceTrainMail($emailData);
    $ackMailSent = $this->sendPalaceAckMail($emailData);
  	$message = $this->getAckMessage($emailData['name']);


    return $this->response->withType('application/json')
    ->withStringBody(json_encode([
        'status' => 'success',
        'message' => $message
    ]));
}    
public function sendPalaceTrainMail($data)
{
    $userIp = $_SERVER['REMOTE_ADDR'];
    $ipInformation = $this->UserIpLocator->getUserIpDetail($userIp);

    //$subject = 'Palace On Wheels Train Enquiry from ' . $data['name'];
  	$subject = $data['trainName'] . ' Train Enquiry Form - ' . $data['name'];

    $htmlContent = '
    <h2>New Booking Enquiry</h2>

    <h3>Contact Details</h3>
    <p><strong>Name:</strong> '.$data['name'].'</p>
    <p><strong>Email:</strong> '.$data['email'].'</p>
    <p><strong>Phone:</strong> '.$data['phone'].'</p>

    <h4>Special Requirements</h4>
    <p>'.$data['message'].'</p>

    <table border="1" cellpadding="5">
        <tr>
            <td colspan="2"><strong>Details retrieve from IP address</strong></td>
        </tr>
        <tr>
            <td>IP Address</td>
            <td>'.$userIp.'</td>
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
    ';

    $result = $this->Email->sendHTMLEmail(
        $to = "sales2@elegantjourneys.co",
      	//$to = "mr.ujjwal.kuamr@gmail.com",
        $subject,
        $htmlContent
    );

    return $result === true;
}
  
  private function getAckMessage($name)
{
    return "
    <html>
    <body style='font-family:Arial;background:#f6f6f6'>
        <div style='background:#fff;padding:20px;max-width:600px;margin:auto'>
            <h2>Dear {$name},</h2>

            <p>Thank you for reaching out to us and submitting the inquiry form.</p>

            <p>Our team is reviewing your request and will contact you soon.</p>

            <p><strong>Call Us:</strong></p>

            <ul>
                <li>Australia: (+61) 02-8488-0900</li>
                <li>USA/Canada: (+1) 332-213-8200</li>
                <li>United Kingdom: (+44) 20-3769-7001</li>
                <li>India: (+91) 99100-78975</li>
            </ul>

            <p><strong>Whatsapp:</strong> +91-9811539696</p>
            <p><strong>Email:</strong> sales@elegantjourneys.com</p>
            <p><strong>Website:</strong> www.elegantjourneys.com</p>

            <p>Best Regards<br><strong>Team Elegant Journeys</strong></p>
        </div>
    </body>
    </html>
    ";
}
  
  public function sendPalaceAckMail($data)
{
    $name = htmlspecialchars($data['name']);
    $to = $data['email'];
    $subject = 'Thank You for Your Inquiry';

    $htmlContent = $this->getAckMessage($name);

    $result = $this->Email->sendHTMLEmail($to, $subject, $htmlContent);

    return $result === true;
}
  
   public function tcaptcha(): Response
    {
        $this->autoRender = false;

        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $code = '';
        for ($i = 0; $i < 6; $i++) {
            $code .= $chars[random_int(0, strlen($chars) - 1)];
        }

        $this->getRequest()->getSession()->write('captcha', $code);

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
        $stored = strtoupper((string)$this->request->getSession()->read('captcha'));

        $isValid = ($input === $stored);

        return $this->response->withType('application/json')
            ->withStringBody(json_encode($isValid));
    }
  public function trainShortEnquiry()
{
    $this->request->allowMethod(['post']);

    $data = $this->request->getData();
    $session = $this->request->getSession();

    $captchaInput = trim($data['captcha'] ?? '');
    $captchaStored = $session->read('captcha');

    if (strcasecmp($captchaInput, $captchaStored) !== 0) {
        return $this->response->withType('application/json')
        ->withStringBody(json_encode([
            'status' => 'error',
            'message' => 'Invalid CAPTCHA'
        ]));
    }

    $fullName = $data['fullName'] ?? '';
    $email = $data['email'] ?? '';
    $phone = $data['phone'] ?? '';
    $country = $data['country'] ?? '';
    $comment = $data['enquiryComment'] ?? '';

    if (empty($fullName) || empty($email) || empty($phone)) {
        return $this->response->withType('application/json')
        ->withStringBody(json_encode([
            'status' => 'fail',
            'message' => 'Required fields missing.'
        ]));
    }

    $emailData = [
        "name" => $fullName,
        "email" => $email,
        "phone" => $phone,
        "country" => $country,
        "message" => $comment
    ];

    $emailSent = $this->sendShortTrainMail($emailData);

    return $this->response->withType('application/json')
    ->withStringBody(json_encode([
        'status' => $emailSent ? 'success' : 'error',
        'message' => $emailSent ? 'Mail sent Successfully' : 'Failed to send mail'
    ]));
}
  public function sendShortTrainMail($data)
{
    $userIp = $_SERVER['REMOTE_ADDR'];

    $ipInformation = $this->UserIpLocator->getUserIpDetail($userIp);
    
    $currentUrl = $this->request->getData('page_url');

    $path = parse_url($currentUrl, PHP_URL_PATH);
    $segments = explode('/', trim($path, '/'));
    $slug = end($segments);

    $trainName = ucwords(str_replace('-', ' ', $slug));

    if (empty($trainName)) {
        $trainName = 'Luxury Train';
    }

    // Dynamic subject
   $subject = $trainName . ' Train Enquiry Short Form - ' . $data['name'];
    

    //$subject = 'Palace On Wheels Train Enquiry short from ' . $data['name'];

    $htmlContent = "
    <h2>New Booking Short Enquiry</h2>

    <h3>Contact Details</h3>

    <p><strong>Name:</strong> {$data['name']}</p>
    <p><strong>Email:</strong> {$data['email']}</p>
    <p><strong>Phone:</strong> {$data['phone']}</p>
    <p><strong>Country:</strong> {$data['country']}</p>

    <h4>Special Requirements</h4>
    <p>{$data['message']}</p>

    <table border='1' cellpadding='5'>
        <tr>
            <td colspan='2'><strong>Details retrieve from IP address</strong></td>
        </tr>
        <tr>
            <td>IP Address</td>
            <td>{$userIp}</td>
        </tr>
        <tr>
            <td>Country</td>
            <td>{$ipInformation['countryName']}</td>
        </tr>
        <tr>
            <td>Region</td>
            <td>{$ipInformation['regionName']}</td>
        </tr>
        <tr>
            <td>City</td>
            <td>{$ipInformation['cityName']}</td>
        </tr>
        <tr>
            <td>Time Zone</td>
            <td>{$ipInformation['timeZone']}</td>
        </tr>
    </table>
    ";

    $result = $this->Email->sendHTMLEmail(
        $to = "sales2@elegantjourneys.co",
      //$to = "mr.ujjwal.kumar@gmail.com",
        $subject,
        $htmlContent
    );

    return $result === true;
}
  
  public function contactTrainEnquiry()
{
    $this->request->allowMethod(['post']);
    $data = $this->request->getData();

    $name = $data['fullName'] ?? '';
    $email = $data['email'] ?? '';
    $phone = $data['phone'] ?? '';
    $country = $data['country'] ?? '';
    $state = $data['state'] ?? '';
    $zip = $data['zip'] ?? '';
    $season = $data['season'] ?? '';
    $months = $data['months'] ?? '';
    $cabins = $data['cabins'] ?? '';
    $comment = $data['enquiryComment'] ?? '';
    $currentUrl = $data['page_url'] ?? '';

    

    if (empty($name) || empty($email) || empty($phone)) {
        return $this->response->withType('application/json')
        ->withStringBody(json_encode([
            'status' => 'fail',
            'message' => 'Required fields missing.'
        ]));
    }

    $emailData = $data;

    $this->sendContactTrainMail($emailData);
    $this->sendContactAckMail($emailData);

    $htmlMessage = $this->getAckMessage($name);

    return $this->response->withType('application/json')
        ->withStringBody(json_encode([
            'status' => 'success',
            'message' => $htmlMessage
        ]));
}
  public function sendContactTrainMail($data)
{
    $userIp = $_SERVER['REMOTE_ADDR'];

    $ipInformation = $this->UserIpLocator->getUserIpDetail($userIp);
    
    $path = parse_url($data['page_url'], PHP_URL_PATH);
    $segments = explode('/', trim($path, '/'));
    $slug = end($segments);

    $trainName = ucwords(str_replace('-', ' ', $slug));

    if (empty($trainName)) {
        $trainName = 'Luxury Train';
    }

    // Dynamic subject
   $subject = $trainName . ' Train Enquiry Form - ' . $data['fullName'];

    //$subject = 'Palace On Wheels Train Enquiry from ' . $data['fullName'];

    $htmlContent = "
    <h2>New Booking Enquiry</h2>

    <h3>Contact Details</h3>

    <p><strong>Name:</strong> {$data['fullName']}</p>
    <p><strong>Email:</strong> {$data['email']}</p>
    <p><strong>Phone:</strong> {$data['phone']}</p>
    <p><strong>Country:</strong> {$data['country']}</p>
    <p><strong>State:</strong> {$data['state']}</p>
    <p><strong>ZIP/Postal:</strong> {$data['zip']}</p>

    <h3>Traveler Preferences</h3>

    <p><strong>Season:</strong> {$data['season']}</p>
    <p><strong>Departure:</strong> {$data['months']}</p>
    <p><strong>Number of Cabins:</strong> {$data['cabins']}</p>
    ";

    for ($i = 1; $i <= intval($data['cabins']); $i++) {

        $cat = $data["cabin_category_$i"] ?? '';
        $adult = $data["adults_$i"] ?? '';
        $infant = $data["infants_$i"] ?? '';
        $child = $data["children_$i"] ?? '';

        $htmlContent .= "
        <h4>Cabin $i</h4>
        <p><strong>Category:</strong> $cat</p>
        <p><strong>Adults:</strong> $adult</p>
        <p><strong>Infants (0-5 yrs):</strong> $infant</p>
        <p><strong>Children (5-12 yrs):</strong> $child</p>
        ";
    }

    $htmlContent .= "
    <h4>Special Requirements</h4>
    <p>{$data['enquiryComment']}</p>

    <table border='1' cellpadding='5'>
        <tr>
            <td colspan='2'><strong>Details retrieve from IP address</strong></td>
        </tr>
        <tr>
            <td>IP Address</td>
            <td>{$userIp}</td>
        </tr>
        <tr>
            <td>Country</td>
            <td>{$ipInformation['countryName']}</td>
        </tr>
        <tr>
            <td>Region</td>
            <td>{$ipInformation['regionName']}</td>
        </tr>
        <tr>
            <td>City</td>
            <td>{$ipInformation['cityName']}</td>
        </tr>
        <tr>
            <td>Time Zone</td>
            <td>{$ipInformation['timeZone']}</td>
        </tr>
    </table>
    ";

    $result = $this->Email->sendHTMLEmail(
        $to = "sales2@elegantjourneys.co",
        //$to = "mr.ujjwal.kumar@gmail.com",
        $subject,
        $htmlContent
    );

    return $result === true;
}
  public function sendContactAckMail($data)
{

    $subject = "Thank You for Your Inquiry";

    $htmlContent = "
    <div style='font-family:Arial;background:#f6f6f6;padding:20px'>
        <div style='background:#fff;padding:20px;max-width:600px;margin:auto'>

            <h3>Dear {$data['fullName']},</h3>

            <p>Thank you for reaching out to us and submitting the inquiry form.</p>

            <p>Our team is reviewing your request and will contact you soon.</p>

            <p><strong>Call Us:</strong></p>

            <ul>
                <li>Australia: (+61) 02-8488-0900</li>
                <li>USA/Canada: (+1) 332-213-8200</li>
                <li>United Kingdom: (+44) 20-3769-7001</li>
                <li>India: (+91) 99100-78975</li>
            </ul>

            <p><strong>Whatsapp:</strong> +91-9811539696</p>
            <p><strong>Email:</strong> sales@elegantjourneys.com</p>
            <p><strong>Website:</strong> www.elegantjourneys.com</p>

            <p>Best Regards<br><strong>Team Elegant Journeys</strong></p>

        </div>
    </div>
    ";

    $result = $this->Email->sendHTMLEmail(
        $data['email'],
        $subject,
        $htmlContent
    );

    return $result === true;
}
  
  public function ocaptcha(): Response
    {
        $this->autoRender = false;

        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $code = '';
        for ($i = 0; $i < 6; $i++) {
            $code .= $chars[random_int(0, strlen($chars) - 1)];
        }

        $this->getRequest()->getSession()->write('tcaptcha', $code);

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

    public function overifyCaptcha()
    {
        $this->request->allowMethod(['post']);
        $input = strtoupper((string)$this->request->getData('tcaptcha'));
        $stored = strtoupper((string)$this->request->getSession()->read('tcaptcha'));

        $isValid = ($input === $stored);

        return $this->response->withType('application/json')
            ->withStringBody(json_encode($isValid));
    }
  
  
  
  public function tariffTrainEnquiry()
{
    $this->request->allowMethod(['post']);
    $data = $this->request->getData();
    
     $pageUrl = $data['tarrif_page_url'];

$path = parse_url($pageUrl, PHP_URL_PATH);
$segments = explode('/', trim($path, '/'));
$slug = end($segments);

$trainName = ucwords(str_replace('-', ' ', $slug));

if (empty($trainName)) {
    $trainName = 'Luxury Train';
}
    
    $fullName = $data['tname'] ?? '';
    $email = $data['temail'] ?? '';
    $phone = $data['tphone'] ?? '';
    $price = $data['tprice'] ?? '';
    $data['train_name'] = $trainName ?? '';

    if (empty($fullName) || empty($email) || empty($phone)) {
        return $this->response->withType('application/json')
        ->withStringBody(json_encode([
            'status' => 'fail',
            'message' => 'Required fields missing.'
        ]));
    }

    $emailData = $data;

    $this->sendTariffEnquiryMail($emailData);
    $this->sendTariffAckMail($emailData);

    $htmlMessage = $this->getAckMessage($fullName);

    return $this->response->withType('application/json')
        ->withStringBody(json_encode([
            'status' => 'success',
            'message' => $htmlMessage
        ]));
}
  
  public function sendTariffEnquiryMail($data)
{
    $userIp = $_SERVER['REMOTE_ADDR'];

    $ipInformation = $this->UserIpLocator->getUserIpDetail($userIp);

    //$subject = 'Palace On Wheels Tariff Enquiry from ' . $data['tname'];
    $subject = $data['train_name'] . ' Train Enquiry Form - ' . $data['tname'];

    $htmlContent = "
    <h2>Offer Price Enquiry</h2>

    <h3>Contact Details</h3>

    <p><strong>Name:</strong> {$data['tname']}</p>
    <p><strong>Email:</strong> {$data['temail']}</p>
    <p><strong>Phone:</strong> {$data['tphone']}</p>
    <p><strong>Price:</strong> {$data['tprice']}</p>
    <p><strong>Train:</strong> {$data['train_name']}</p>

    <table border='1' cellpadding='5'>
        <tr>
            <td colspan='2'><strong>Details retrieve from IP address</strong></td>
        </tr>
        <tr>
            <td>IP Address</td>
            <td>{$userIp}</td>
        </tr>
        <tr>
            <td>Country</td>
            <td>{$ipInformation['countryName']}</td>
        </tr>
        <tr>
            <td>Region</td>
            <td>{$ipInformation['regionName']}</td>
        </tr>
        <tr>
            <td>City</td>
            <td>{$ipInformation['cityName']}</td>
        </tr>
        <tr>
            <td>Time Zone</td>
            <td>{$ipInformation['timeZone']}</td>
        </tr>
    </table>
    ";

    $result = $this->Email->sendHTMLEmail(
        $to = "sales2@elegantjourneys.co",
        //$to = "mr.ujjwal.kumar@gmail.com",
        $subject,
        $htmlContent
    );

    return $result === true;
}
  
  public function sendTariffAckMail($data)
{

    $subject = "Thank You for Your Inquiry";

    $htmlContent = "
    <div style='font-family:Arial;background:#f6f6f6;padding:20px'>
        <div style='background:#fff;padding:20px;max-width:600px;margin:auto;border-radius:8px'>

            <h2>Dear {$data['tname']},</h2>

            <p>Thank you for reaching out to us and submitting the inquiry form. 
            We are delighted that you have chosen Elegant Journeys for your upcoming travel plans.</p>

            <p>Our team is currently reviewing your request and will provide you with 
            detailed pricing and itinerary shortly.</p>

            <p><strong>Call Us:</strong></p>

            <ul>
                <li>Australia: (+61) 02-8488-0900</li>
                <li>USA/Canada: (+1) 332-213-8200</li>
                <li>United Kingdom: (+44) 20-3769-7001</li>
                <li>India: (+91) 99100-78975</li>
            </ul>

            <p><strong>Whatsapp:</strong> +919811539696</p>  
            <p><strong>Email:</strong> sales@elegantjourneys.com</p>  
            <p><strong>Website:</strong> www.elegantjourneys.com</p>  

            <p>We look forward to assisting you in planning a truly memorable and luxurious journey.</p>

            <p>Best regards,<br><strong>Team Elegant Journeys</strong></p>

        </div>
    </div>
    ";

    $result = $this->Email->sendHTMLEmail(
        $data['temail'],
        $subject,
        $htmlContent
    );

    return $result === true;
}
  
  public function tariffDetailTrainEnquiry()
{
    $this->request->allowMethod(['post']);
    $data = $this->request->getData();
    
    
    $fullName = $data['tname'] ?? '';
$email = $data['temail'] ?? '';
$phone = $data['tphone'] ?? '';
$tprice = $data['tprice'] ?? '';
$season = $data['tseason'] ?? '';
$departure = $data['tmonths'] ?? '';
$cabins = $data['tcabins'] ?? '';
$special = $data['tspecial'] ?? ''; // optional field if added later
    
    $pageUrl = $data['tarrif_page_url'];

$path = parse_url($pageUrl, PHP_URL_PATH);
$segments = explode('/', trim($path, '/'));
$slug = end($segments);

$trainName = ucwords(str_replace('-', ' ', $slug));

if (empty($trainName)) {
    $trainName = 'Luxury Train';
}
  
    $data['train_name'] = $trainName ?? '';
    

$cabinDetails = "";

  foreach ($data as $key => $value) {
    if (strpos($key, 'cabin_category_') === 0) {
      $i = substr($key, 15);
      $cabinDetails .= "<b>Cabin {$i}</b><br>";
      $cabinDetails .= "Category: " . htmlspecialchars($data["cabin_category_$i"]) . "<br>";
      $cabinDetails .= "Adults: " . htmlspecialchars($data["adults_$i"]) . "<br>";
      $cabinDetails .= "Children (5-12): " . htmlspecialchars($data["children_$i"]) . "<br>";
      $cabinDetails .= "Infants (0-5): " . htmlspecialchars($data["infants_$i"]) . "<br><br>";
    }
  }


    if (empty($fullName) || empty($email) || empty($phone)) {
        return $this->response->withType('application/json')
        ->withStringBody(json_encode([
            'status' => 'fail',
            'message' => 'Required fields missing.'
        ]));
    }

    $emailData = $data;

    $this->sendTariffStepThreeMail($emailData);
    $this->sendTariffStepThreeAckMail($emailData);

    $htmlMessage = $this->getAckMessage($fullName);

    return $this->response->withType('application/json')
        ->withStringBody(json_encode([
            'status' => 'success',
            'message' => $htmlMessage
        ]));
}

public function sendTariffStepThreeMail($data)
{
    $userIp = $_SERVER['REMOTE_ADDR'];

    $ipInformation = $this->UserIpLocator->getUserIpDetail($userIp);

    //$subject = 'Tariff Details Received from ' . $data['tname'];
  	$subject = $data['train_name'] . ' Tariff Details Received from - ' . $data['tname'];
  

    $cabinDetails = "";

    foreach ($data as $key => $value) {

        if (strpos($key, 'cabin_category_') === 0) {

            $i = substr($key, 15);

            $cat = $data["cabin_category_$i"] ?? '';
            $adult = $data["adults_$i"] ?? '';
            $child = $data["children_$i"] ?? '';
            $infant = $data["infants_$i"] ?? '';

            $cabinDetails .= "
            <b>Cabin {$i}</b><br>
            Category: {$cat}<br>
            Adults: {$adult}<br>
            Children (5-12): {$child}<br>
            Infants (0-5): {$infant}<br><br>
            ";
        }
    }

    $htmlContent = "
    <h2>Step 3 Tariff Details</h2>

    <h3>Passenger Information</h3>

    <p><strong>Name:</strong> {$data['tname']}</p>
    <p><strong>Email:</strong> {$data['temail']}</p>
    <p><strong>Phone:</strong> {$data['tphone']}</p>
    <p><strong>Price:</strong> {$data['tprice']}</p>
    <p><strong>Train:</strong> {$data['train_name']}</p>

    <h3>Journey Details</h3>

    <p><strong>Season:</strong> {$data['tseason']}</p>
    <p><strong>Departure Date:</strong> {$data['tmonths']}</p>
    <p><strong>No. of Cabins:</strong> {$data['tcabins']}</p>

    <h4>Cabin Details</h4>

    {$cabinDetails}
    ";

    if (!empty($data['tspecial'])) {
        $htmlContent .= "<p><strong>Special Requirements:</strong> {$data['tspecial']}</p>";
    }

    $htmlContent .= "
    <table border='1' cellpadding='6'>
        <tr>
            <td colspan='2'><strong>Details from IP Address</strong></td>
        </tr>
        <tr>
            <td>IP Address</td>
            <td>{$userIp}</td>
        </tr>
        <tr>
            <td>Country</td>
            <td>{$ipInformation['countryName']}</td>
        </tr>
        <tr>
            <td>Region</td>
            <td>{$ipInformation['regionName']}</td>
        </tr>
        <tr>
            <td>City</td>
            <td>{$ipInformation['cityName']}</td>
        </tr>
        <tr>
            <td>Time Zone</td>
            <td>{$ipInformation['timeZone']}</td>
        </tr>
    </table>
    ";

    $result = $this->Email->sendHTMLEmail(
        $to = "sales2@elegantjourneys.co",
        //$to = "mr.ujjwal.kumar@gmail.com",
        $subject,
        $htmlContent
    );

    return $result === true;
}
  
  public function sendTariffStepThreeAckMail($data)
{

    $subject = "Thank You for Your Inquiry";

    $htmlContent = "
    <div style='font-family:Arial;background:#f6f6f6;padding:20px'>
        <div style='background:#fff;padding:20px;max-width:600px;margin:auto;border-radius:8px'>

        <h2>Dear {$data['tname']},</h2>

        <p>Thank you for reaching out to us and submitting the inquiry form. 
        We are delighted that you have chosen Elegant Journeys for your upcoming travel plans.</p>

        <p>Our team is currently reviewing your request and will provide you with 
        a detailed itinerary and pricing information shortly.</p>

        <p><strong>Call Us:</strong></p>

        <ul>
            <li>Australia: (+61) 02-8488-0900</li>
            <li>USA/Canada: (+1) 332-213-8200</li>
            <li>United Kingdom: (+44) 20-3769-7001</li>
            <li>India: (+91) 99100-78975</li>
        </ul>

        <p><strong>Whatsapp:</strong> +919811539696</p>
        <p><strong>Email:</strong> sales@elegantjourneys.com</p>
        <p><strong>Website:</strong> www.elegantjourneys.com</p>

        <p>We look forward to assisting you in planning a truly memorable and luxurious journey.</p>

        <p>Best regards,<br><strong>Team Elegant Journeys</strong></p>

        </div>
    </div>
    ";

    $result = $this->Email->sendHTMLEmail(
        $data['temail'],
        $subject,
        $htmlContent
    );

    return $result === true;
}

}
