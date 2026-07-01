<?php

use PHPMailer\PHPMailer\PHPMailer;

require ('mail/phpmailer/src/Exception.php');
require ('mail/phpmailer/src/PHPMailer.php');
require ('mail/phpmailer/src/SMTP.php');
include_once(BASEPATH."class/first-class.php");
class Mailer extends FirstClass
{
	public function sendUserMail($data)
	{
		if($data['mail_type']=='html')
		{
			$mailInfo = array();
			$mailInfo['from'] = $data['from'];

			if((isset($data['cc']))&&($data['cc']!=""))
			{
				$mailInfo['cc'] = $data['cc'];
			}

			if((isset($data['bcc']))&&($data['bcc']!=""))
			{
				$mailInfo['bcc'] = $data['bcc'];
			}
			$mailInfo['to'] = $data['to'];
			$mailInfo['subject'] = $data['subject'];
			$mailInfo['message'] = $data['message'];

			$mailData=array();
			$mailData = $this->sendHTMLMail($mailInfo);

			//$result=$this->sendMailByPHP($mailData);
			
			$result=$this->sendMailBySMTP($mailData);

			$json = array(
							"result"	=>		"success",
							"Your query has been received to us. We will contact you shortly"
					);
			return $json;

		}
		else
		{
			$mailInfo = array();
			$mailInfo['from'] = $data['from'];

			if((isset($data['cc']))&&($data['cc']!=""))
			{
				$mailInfo['cc'] = $data['cc'];
			}

			if((isset($data['bcc']))&&($data['bcc']!=""))
			{
				$mailInfo['bcc'] = $data['bcc'];
			}
			$mailInfo['to'] = $data['to'];
			$mailInfo['subject'] = $data['subject'];
			$mailInfo['message'] = $data['message'];

			$mailData=array();
			$mailData = $this->sendTextMail($mailInfo);

			//$result=$this->sendMailByPHP($mailData);
			$result=$this->sendMailBySMTP($mailData);
			return $result;
		}
	}

	public function sendTextMail($data)
	{


	}

	public function sendHTMLMail($data)
	{
		$messageInformations = array();
		// To send HTML mail, the Content-type header must be set
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';

		// Additional headers
		$headers[] = 'From: '.$data['from'];
		if((isset($data['cc']))&&($data['cc']!=""))
		{
			$headers[] = 'Cc: '.$data['cc'];
		}

		if((isset($data['bcc']))&&($data['bcc']!=""))
		{
			$headers[] = 'Bcc: '.$data['bcc'];
		}

		$messageInformations['headers']=$headers;
		$messageInformations['subject']=$data['subject'];
		$messageInformations['message']=$data['message'];
		$messageInformations['to']=$data['to'];

		return $messageInformations;

	}

	public function sendMailByPHP($data)
	{

		$to = $data['to'];
		$subject = $data['subject'];
		$message = $data['message'];
		$headers = $data['headers'];

		if(mail($to, $subject, $message, implode("\r\n", $headers)))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function sendMailBySMTP($data)
	{
		
 // Posted Inputs


		$to = $data['to'];
		$subject = $data['subject'];
		$message = $data['message'];
		$headers = $data['headers'];


		//init data
		$mail = new PHPMailer;
		$mail->isSMTP();

		$mail->Username = "sales.elegantjourneys@gmail.com"; // Replace with your mail id
		$mail->Password = "xlypwttrxgqdsxqm"; //Replace with your mail pass

		$mail->SMTPAuth = true;  // authentication enabled
		$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
		$mail->SMTPAutoTLS = false;
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   

		$mail->SMTPDebug = 2;
		//Recipients
		$mail->setFrom('sales2@elegantjourneys.co', 'Elegant Journeys India');
		$mail->addAddress('sales2@elegantjourneys.co', 'Elegant Journeys India');  //add to email  
		$mail->addBCC('kr.rakesh.sinha7@gmail.com', 'Rakesh Kumar Sinha');  //add to email
		$mail->addReplyTo('sales2@elegantjourneys.co', 'Elegant Journeys India');  //add replay to email


		// Content
		$mail->isHTML(true);  // Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = '<b>' . $message . '</b>';

		//Info Message
		if (!$mail->send())
		{
			$error = "Mailer Error: " . $mail->ErrorInfo;
			return false;
		}
		else 
		{
			return true;
		}


	}




}
?>
