<?php
include_once(BASEPATH."class/first-class.php");
class Enquiry extends FirstClass
{
	public function getShortTourEnquiry($data)
	{
		$this->setDatabaseConnection();
		$strsqlEnquiry = "insert into tbls_enquiry( name, email, phone, country, enquiry_source) values('".$data['name']."','".$data['email']."','".$data['phone']."','".$data['country']."','".$data['enquiry_source']."')";
		mysql_query($strsqlEnquiry);

		$enquiryId = mysql_insert_id();

		$strsqlEnquiryDetail = "insert into tbls_enquiry_detail( enquiry_id, message, page_url, tour_id, tour_name, user_ip ) values(".$enquiryId.",'".$data['message']."','".$data['page_url']."','".$data['tour_id']."','".$data['tour_name']."','".$data['user_ip']."')";
		mysql_query($strsqlEnquiryDetail);

		#### SENDING MAIL TO ADMIN
		include_once(BASEPATH."class/mailer-class.php");
		$objMailer = new Mailer();
		$mailerData = array();
		$mailerData['mail_type']='html';
		$mailerData['mail_source']='php';
		$mailerData['to'] = EMAIL_WEBADMIN;
		$mailerData['subject'] = 'Short enquiry from tour listing page';
		$mailerData['from'] = EMAIL_FROM;
		$mailerData['message']= '<html>
									<head>
									  <title>Short Tour Enquiry From Website</title>
									</head>
									<body>
									  <p>Here are the details of enquiry submitted by visitors!</p>
									  <table>
										<tr>
										  <th>Name</th>
										  <th>'.$data['name'].'</th>
										</tr>
										<tr>
										  <th>Email</th>
										  <th>'.$data['email'].'</th>
										</tr>
										<tr>
										  <th>Phone</th>
										  <th>'.$data['phone'].'</th>
										</tr>
										<tr>
										  <th>Country</th>
										  <th>'.$data['country'].'</th>
										</tr>
										<tr>
										  <th>Message</th>
										  <th>'.$data['message'].'</th>
										</tr>
									  </table>
									</body>
									</html>';
		$mailResult=$objMailer->sendUserMail($mailerData);
		$confirmationPageParameter = array(
												"title" =>  "Thank You, Your query has been received",
												"description"	=>	"Dear ".$data['name']." thank you for contacting us. Your query has been received to us. We will contact you shortly."
									);
		$this->setConfirmationParameters($confirmationPageParameter);
		$this->closeDBConnection();
		return true;
	}


	public function getContactUsEnquiry($data)
	{
		$this->setDatabaseConnection();
		$strsqlEnquiry = "insert into tbls_enquiry( name, email, phone, country, enquiry_source) values('".$data['name']."','".$data['email']."','".$data['phone']."','".$data['country']."','".$data['enquiry_source']."')";
		mysql_query($strsqlEnquiry);

		$enquiryId = mysql_insert_id();

		$strsqlEnquiryDetail = "insert into tbls_enquiry_detail( enquiry_id, message, page_url, tour_id, tour_name, user_ip ) values(".$enquiryId.",'".$data['message']."','".$data['page_url']."','".$data['tour_id']."','".$data['tour_name']."','".$data['user_ip']."')";
		mysql_query($strsqlEnquiryDetail);

		#### SENDING MAIL TO ADMIN
		include_once(BASEPATH."class/mailer-class.php");
		$objMailer = new Mailer();
		$mailerData = array();
		$mailerData['mail_type']='html';
		$mailerData['mail_source']='php';
		$mailerData['to'] = EMAIL_WEBADMIN;
		$mailerData['subject'] = 'Details received from contact us';
		$mailerData['from'] = EMAIL_FROM;
		$mailerData['bcc'] = EMAIL_BCC;
		$mailerData['message']= '<html>
									<head>
									  <title>Details received from contact us</title>
									</head>
									<body>
									  <p>Here are the details of enquiry submitted by visitors!</p>
									  <table padding="2" border="1">
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
										  <th style="text-align:left;">Travel Requirement</th>
										  <td>'.$data['travel_requirement'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">IP</th>
										  <td>'.$_SERVER['REMOTE_ADDR'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Country from IP</th>
										  <td>India</td>
										</tr>
									  </table>
									</body>
									</html>';
		$mailResult=$objMailer->sendUserMail($mailerData);
		$confirmationPageParameter = array(
												"title" =>  "Thank You, Your query has been received",
												"description"	=>	"Dear ".$data['name']." thank you for contacting us. Your query has been received to us. We will contact you shortly."
									);
		$this->setConfirmationParameters($confirmationPageParameter);
		$this->closeDBConnection();
		
		/*return true;
		
		$confirmationPageParameter = array(
												"title" =>  "Thank You, Your query has been received",
												"description"	=>	"Thank you for contacting us. Your query has been received to us. We will contact you shortly."
									);
		$this->setConfirmationParameters($confirmationPageParameter);*/
		header('location:confirmation.php');
		exit();

	}
	
	public function getMakeATourEnquiry($data)
	{
		
		$this->setDatabaseConnection();

		$hotelPreference = implode(",",$data['hotel_preferences']);
		$arrChildrenAge = array();
		for($i=1;$i<=$data['no_of_children'];$i++)
		{
			$arrChildrenAge[] = $data['age_of_child'.$i];
		}
		$childrentAges = implode(",",$arrChildrenAge);
		$strsqlEnquiry = "insert into tbls_enquiry( name, email, phone, country, enquiry_source) values('".$data['name']."','".$data['email']."','".$data['phone']."','".$data['country']."','".$data['enquiry_source']."')";
		mysql_query($strsqlEnquiry);

		$enquiryId = mysql_insert_id();
		
		$other_information=array("nationality" => $data['nationality'],
			'no_of_adults' => $data['no_of_adults'],
			'no_of_children'=> $data['no_of_children'],
			'no_of_days' => $data['no_of_days'],
			'currency' => $data['currency'],
			'travel_budget'=>$data['travel_budget'],
			'no_of_rooms'=>$data['no_of_rooms'],
			'star_hotel'=>$data['star_hotel']);
			
		$other_information=serialize($other_information);

		$strsqlEnquiryDetail = "insert into tbls_enquiry_detail( enquiry_id, message, page_url, tour_id, tour_name, user_ip,other_information ) values(".$enquiryId.",'".$data['message']."','".$data['page_url']."','0','','".$data['user_ip']."','".$other_information."')";
		mysql_query($strsqlEnquiryDetail);
		
		#### SENDING MAIL TO ADMIN
		include_once(BASEPATH."class/mailer-class.php");
		$objMailer = new Mailer();
		$mailerData = array();
		$mailerData['mail_type']='html';
		$mailerData['mail_source']='php';
		$mailerData['to'] = EMAIL_WEBADMIN;
		$mailerData['subject'] = 'Tailor Maka a Tour Enquiry';
		$mailerData['from'] = EMAIL_FROM;
		$mailerData['message']= '<html>
									<head>
									  <title>Tailor Maka a Tour Enquiry From Website</title>
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
										  <th style="text-align:left;">Country</th>
										  <td>'.$data['city'].'</th>
										</tr>
										<tr>
										  <th style="text-align:left;">Nationality</th>
										  <td>'.$data['country'].'</th>
										</tr>
										<tr>
										  <th style="text-align:left;">Number of Adults</th>
										  <td>'.$data['no_of_adults'].'</th>
										</tr>
										<tr>
										  <th style="text-align:left;">Number of Children</th>
										  <td>'.$data['no_of_children'].'</th>
										</tr>
										<tr>
										  <th style="text-align:left;">Children Ages</th>
										  <td>'.$childrentAges.'</th>
										</tr>
										<tr>
										  <th style="text-align:left;">Number of Days</th>
										  <td>'.$data['no_of_days'].'</th>
										</tr>
										<tr>
										  <th style="text-align:left;">Travel Budget</th>
										  <td>'.$data['travel_budget'].'</th>
										</tr>
										<tr>
										  <th style="text-align:left;">Travel Date</th>
										  <td>'.$data['travel_date'].'</th>
										</tr>
										<tr>
										  <th style="text-align:left;">Hotels Preference</th>
										  <td>'.$hotelPreference.' Star</th>
										</tr>

										
										
										<tr>
										  <th style="text-align:left;">Message</th>
										  <td>'.$data['message'].'</th>
										</tr>
									  </table>
									</body>
									</html>';
		$mailResult=$objMailer->sendUserMail($mailerData);
		
		$confirmationPageParameter = array(
												"title" =>  "Thank You, Your query has been received",
												"description"	=>	"Thank you for contacting us. Your query has been received to us. We will contact you shortly."
									);
		$this->setConfirmationParameters($confirmationPageParameter);
		$this->closeDBConnection();
		header('location:confirmation.php');
		exit();
	}

	public function getTourEnquiry($data)
	{	
		
		$this->setDatabaseConnection();
		$hotelPreferences = implode(",",$_POST['enquiryHotelPreference']);

		#### setting child age according to selected numbers

		if($data['child1']==""||$data['child1']=='0')
		{
			$data['child1_1']="";
			$data['child1_2']="";
			$data['child1_3']="";
		}

		if($data['child2']==""||$data['child2']=='0')
		{
			$data['child2_1']="";
			$data['child2_2']="";
			$data['child2_3']="";
		}

		if($data['child3']==""||$data['child3']=='0')
		{
			$data['child3_1']="";
			$data['child3_2']="";
			$data['child3_3']="";
		}

		$strsqlEnquiry = "insert into tbls_enquiry( name, email, phone, country, enquiry_source) values('".$data['enquiryName']."','".$data['enquiryEmail']."','".$data['enquiryPhone']."','".$data['enquiryCountry']."','".$data['enquiry_source']."')";
		mysql_query($strsqlEnquiry);
		$enquiryId = mysql_insert_id();
		
		$other_information=array('no_of_adults' => $data['enquiryAdults'],
			'no_of_children'=> $data['enquiryChilds'],
			'no_of_rooms' => $data['enquiryRoomsRequired'],
			'travel_type' => $data['enquiryTravelType'],
			'hotel'=>$data['enquiryHotelPreference'],
			'city'=>$data['enquiryCity'],
			'arrival_date'=>$data['enquiryArrivalDate']);
			
		$other_information=serialize($other_information);

		$strsqlEnquiryDetail = "insert into tbls_enquiry_detail( enquiry_id, message, page_url, tour_id, tour_name, user_ip ,other_information) values(".$enquiryId.",'".$data['enquiryComment']."','".$data['page_url']."','".$data['tour_id']."','".$data['tour_name']."','".$data['user_ip']."','".$other_information."')";
		mysql_query($strsqlEnquiryDetail);

		#### SENDING MAIL TO ADMIN
		include_once(BASEPATH."class/mailer-class.php");
		$objMailer = new Mailer();
		$mailerData = array();
		$mailerData['mail_type']='html';
		$mailerData['mail_source']='php';
		//$mailerData['to'] = EMAIL_WEBADMIN;
		$mailerData['to'] = 'kr.rakesh.sinha7@gmail.com';
		$mailerData['subject'] = 'Enquiry from tour listing page';
		$mailerData['from'] = EMAIL_FROM;
		$mailerData['message']= '<html>
									<head>
									  <title>Tour Enquiry From Website</title>
									</head>
									<body>
									  <p>Here are the details of enquiry submitted by visitors!</p>
									  <table width="400" border="1" cellpadding="0" cellspacing="0">
										<tr>
										  <th style="text-align:left;">Tour Name</th>
										  <td style="text-align:left;">'.$data['tour_id'].'##'.$data['tour_name'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Page Url</th>
										  <td style="text-align:left;">'.WEBROOT.'/luxury-tours/'.$data['page_url'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Name</th>
										  <td style="text-align:left;">'.$data['enquiryName'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Email</th>
										  <td style="text-align:left;">'.$data['enquiryEmail'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Phone</th>
										  <td style="text-align:left;">'.$data['enquiryPhone'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Country</th>
										  <td style="text-align:left;">'.$data['enquiryCountry'].'</td>
										</tr>
										
										<tr>
										  <th style="text-align:left;">No Of Person Room1</th>
										  <td style="text-align:left;"> Adults:'.$data['adults1'].' Child:'.$data['child1'].'('.$data['child1_1'].','.$data['child1_2'].','.$data['child1_3'].')</td>
										</tr>';

										if($data['adults2']!=""||$data['adults2']!="")
										{
											$mailerData['message'] = $mailerData['message'].'<tr>
											  <th style="text-align:left;">No Of Person Room2</th>
											  <td style="text-align:left;"> Adults:'.$data['adults2'].' Child:'.$data['child2'].'('.$data['child2_1'].','.$data['child2_2'].','.$data['child2_3'].')</td>
											</tr>';
										}

										if($data['adults3']!=""||$data['adults3']!="")
										{
											$mailerData['message'] = $mailerData['message'].'<tr>
												  <th style="text-align:left;">No Of Person Room3</th>
												  <td style="text-align:left;"> Adults:'.$data['adults3'].' Child:'.$data['child3'].'('.$data['child3_1'].','.$data['child3_2'].','.$data['child3_3'].')</td>
												</tr>';
										}
										
										if($data['adults4']!=""||$data['adults4']!="")
										{
											$mailerData['message'] = $mailerData['message'].'<tr>
											  <th style="text-align:left;">No Of Person Room4</th>
											  <td style="text-align:left;"> Adults:'.$data['adults4'].' Child:'.$data['child4'].'</td>
											</tr>';
										}

										if($data['adults5']!=""||$data['adults5']!="")
										{
											$mailerData['message'] = $mailerData['message'].'<tr>
											  <th style="text-align:left;">No Of Person Room5</th>
											  <td style="text-align:left;"> Adults:'.$data['adults5'].' Child:'.$data['child5'].'</td>
											</tr>';
										}
										
										$mailerData['message'] = $mailerData['message'].'<tr>
										  <th style="text-align:left;">Travel Type</th>
										  <td style="text-align:left;">'.$data['enquiryTravelType'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Hotel Preference</th>
										  <td style="text-align:left;">'.$hotelPreferences.'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Arrival Date</th>
										  <td style="text-align:left;">'.$data['enquiryArrivalDate'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Message</th>
										  <td style="text-align:left;">'.$data['enquiryComment'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">IP</th>
										  <td style="text-align:left;">'.$data['user_ip'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">IP City</th>
										  <td style="text-align:left;">'.$data['ip_city'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">IP Region</th>
										  <td style="text-align:left;">'.$data['ip_region'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">IP Country</th>
										  <td style="text-align:left;">'.$data['ip_country'].'</td>
										</tr>
											<tr>
										  <th style="text-align:left;">IP Time Zone</th>
										  <td style="text-align:left;">'.$data['ip_time_zone'].'</td>
										</tr>
										
										
										
									  </table>
									</body>
									</html>';
									
		$mailResult=$objMailer->sendUserMail($mailerData);
		$confirmationPageParameter = array(
												"title" =>  "Thank You, Your query has been received",
												"description"	=>	"Dear ".$data['enquiryName']." thank you for contacting us. Your query has been received to us. We will contact you shortly."
									);
		$this->setConfirmationParameters($confirmationPageParameter);
		$this->closeDBConnection();
		header('location:../confirmation.php');
		exit;
	}









	function getUserIpDetail()
	{
		include(BASEPATH.'class/ip-locator.php');
	 
		//Load the class
		$ipLite = new ip2location_lite();
		$ipLite->setKey('f2a1699e7e2662e37434b7cf95380c2d6a15eb7cdb686a61a972796f835ca3c2');
		 
		//Get errors and locations
		$locations = $ipLite->getCity($_SERVER['REMOTE_ADDR']);
		return $locations;
	}


	function sendShortCustomerInfo($post)
	{
		//$userLocation=$this->getUserIpDetail();
		$to = 'sales@elegantjourneys.co';
		//$to='kr.rakesh.sinha7@gmail.com';
		if((isset($post['subject']))&&($post['subject']!=""))
		{
			$subject = $post['subject'];
		}
		else
		{
			$subject = 'Short information from '.$post['tourName'];
		}
		
		$message  ='<table width="400" border="1" cellpadding="0" cellspacing="0">';
		
		$message .= '
				<tr>
					<td>Tour Name</td>
					<td><a href="'.WEBROOT.'/luxury-tours/'.$post['page_url'].'">'.$post['tour_id'].'####'.$post['tour_name'].'</a></td>
			   </tr>
			   <tr>
					<td>Tour Code</td>
					<td>'.$post['tour_code'].'</a></td>
			   </tr>	
				';
		$message .= '
				<tr>
					<td>IP Address</td>
					<td>'.$_SERVER['REMOTE_ADDR'].'</td>
			    </tr>';
		 $message .='
				 <tr>
					<td>Client Name</td>
					<td>'.$post['customerName'].'</td>
				  </tr>
				  <tr>
					<td>Email ID</td>
					<td>'.$post['customerEmail'].'</td>
				  </tr>
				  <tr>
					<td>Phone</td>
					<td>'.$post['customerPhone'].'</td>
				  </tr>
				   <tr>
						<td colspan="2"><strong> Details retrieve from IP address</strong></td>
				  </tr>
				  <tr>
					<td>Country</td>
					<td>India</td>
				  </tr>
				  <tr>
					<td>Region</td>
					<td>Delhi</td>
				  </tr>
				 
				</table>';

		$from='wadhawan.vivek@gmail.com';

		$headers = "From:".$from."\r\n";
		$headers .= "Bcc:kr.rakesh.sinha7@gmail.com"."\r\n";
		$headers .= 'Content-type: text/html;';
		if(mail($to, $subject, $message, $headers))
		{
			
			return true;
		}
	}

	function processWebsiteFeedback($post)
	{
		

		$this->setDatabaseConnection();
		$name = $this->filterReceivedData($post['feedback_name']);
		$email = $this->filterReceivedData($post['feedback_email']);
		$contactNumber  = $this->filterReceivedData($post['feedback_contact_number']);
		$feedbackType  = $this->filterReceivedData($post['feedback_feedback_type']);
		$pageUrl  = $post['page_url'];
		$message = $post['feedback_message'];
		$this->closeDBConnection();

		$masterEnquiryData = array(
										"name"				=>		$name,
										"email"				=>		$email,
										"phone"				=>		$contactNumber,
										"enquiry_source"	=>		'website_feedback'
							);
		$enquiryId = $this->addMasterInformation($masterEnquiryData);

		if($enquiryId)
		{
			$userIP = $_SERVER['REMOTE_ADDR'];
			$detailData = array(
									"enquiry_id"		=>		$enquiryId,
									"message"			=>		$message,
									"page_url"			=>		$pageUrl,
									"user_ip"			=>		$userIP
					);
			
			$this->addEnquiryDetail($detailData);

			if((isset($post['feedback_attach_screenshot']))&&($post['feedback_attach_screenshot']=='yes'))
			{
				//call Google PageSpeed Insights API
				$googlePagespeedData = file_get_contents("https://www.googleapis.com/pagespeedonline/v2/runPagespeed?url=".$pageUrl."&screenshot=true");

				//decode json data
				$googlePagespeedData = json_decode($googlePagespeedData, true);

				//screenshot data
				$screenshot = $googlePagespeedData['screenshot']['data'];
				$screenshot = str_replace(array('_','-'),array('/','+'),$screenshot); 
				$screenData = array(
										"enquiry_id"		=>		$enquiryId,
										"image"				=>		$screenshot
								);
				$this->addCaptureScreen($screenData);
			}
				
			   //$userLocation=$this->getUserIpDetail();
				$to = 'sales@elegantjourneys.co';
				$to='kr.rakesh.sinha7@gmail.com';
				$subject = 'Website feedback from '.$name;
			
				$messageText  ='<table width="400" border="1" cellpadding="0" cellspacing="0">';
				
				$messageText .= '
						<tr>
							<td>Name</td>
							<td>'.$name.'</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>'.$email.'</td>
						</tr>
						<tr>
							<td>Contact Number</td>
							<td>'.$contactNumber.'</td>
						</tr>
						<tr>
							<td>Feedback Type</td>
							<td>'.$feedbackType.'</td>
						</tr>
						<tr>
							<td>Message</td>
							<td>'.$message.'</td>
						</tr>
						<tr>
							<td>Page URL</td>
							<td>'.$pageUrl.'</td>
						</tr>
						';
				if((isset($post['feedback_attach_screenshot']))&&($post['feedback_attach_screenshot']=='yes'))
				{
					$messageText .='
					 <tr>
						<td>Screenshot</td>
						<td><img src="data:image/jpeg;base64, '.$screenshot.'" /></td>
					  </tr>';

				}
				 $messageText .='</table>';
				// echo $messageText;

				$from='wadhawan.vivek@gmail.com';

				$headers = "From:".$from."\r\n";
				$headers .= "Bcc:kr.rakesh.sinha7@gmail.com"."\r\n";
				$headers .= 'Content-type: text/html;';
				mail($to, $subject, $messageText, $headers);
				
				$confirmationPageParameter = array(
												"title" =>  "Thank You",
												"description"	=>	"Your feedback has been received to us. We will contact you shortly."
									);
				$this->setConfirmationParameters($confirmationPageParameter);
				$this->closeDBConnection();
				//header('location:../confirmation.php');
				$json = array(
								"result"		=>		"success",
								"message"		=>		""
					);
				echo json_encode($json);
				return true;
		}
	}

	function addCaptureScreen($data)
	{
		$this->setDatabaseConnection();
		$strsqlTourEnquiry = "insert into tbls_enquiry_image ( enquiry_id, image) values('".$data['enquiry_id']."','".$data['image']."')";
		$resultTourEnquiry = mysql_query($strsqlTourEnquiry);
		$this->closeDBConnection();
		return $resultTourEnquiry;	

	}


	function addMasterInformation($data)
	{
		$this->setDatabaseConnection();
		$strsqlTourEnquiry = "insert into tbls_enquiry ( name, email, phone, country, enquiry_source, customer_id) values('".$data['name']."','".$data['email']."','".$data['phone']."','".$data['country']."','".$data['enquiry_source']."','".$data['customer_id']."')";
		$resultTourEnquiry = mysql_query($strsqlTourEnquiry);
				
		if($resultTourEnquiry)
		{
			$enquiryId = mysql_insert_id();
			$this->closeDBConnection();
			return $enquiryId;
		}
		else
		{
			$this->closeDBConnection();
			return false;
		}
	}

	function addEnquiryDetail($data)
	{
		$this->setDatabaseConnection();
		$strsqlTourEnquiry = "insert into tbls_enquiry_detail( enquiry_id, message, page_url, tour_id, tour_name, user_ip, other_information) values('".$data['enquiry_id']."','".$data['message']."','".$data['page_url']."','".$data['tour_id']."','".$data['tour_name']."','".$data['user_ip']."','".$data['other_information']."')";
		$resultTourEnquiry = mysql_query($strsqlTourEnquiry);

		$this->closeDBConnection();
		return $resultTourEnquiry;		
		

	}

	function intiateBookingSession($data)
	{
		$_SESSION['booking'] = $data;
		return true;
	}
}
?>