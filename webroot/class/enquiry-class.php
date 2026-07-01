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

		$ipInformation=$this->getUserDetailByIp();

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
												<td colspan="2"><strong> Details retrieve from IP address</strong></td>
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
		
		if($mailResult=$objMailer->sendUserMail($mailerData))
		{
		
			$confirmationPageParameter = array(
													"title" =>  "Thank You, Your query has been received",
													"description"	=>	"Dear ".$data['name']." thank you for contacting us. Your query has been received to us. We will contact you shortly."
										);
			$this->setConfirmationParameters($confirmationPageParameter);
			$this->closeDBConnection();

			header('location:confirmation.php');
			exit();
		}

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
		$mailerData['subject'] = 'Tailor Make a Tour Enquiry';
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

		//$ipInformation = $this->getUserIpDetail();

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

		$data['enquiry_source'] = 'tour_enquiry';

		if($data['enquiry_type']=='pay_now_100')
		{
			$data['enquiry_source'] = 'tour_first_payment';
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
		$mailerData['to'] = EMAIL_WEBADMIN;
		$mailerData['cc'] = 'kr.rakesh.sinha7@gmail.com';
		$mailerData['subject'] = 'Final-O enquiry '.$data['tour_code'].' - '.$data['enquiryName'];
		$mailerData['from'] = EMAIL_FROM;
		$mailerData['message']= '<html>
									<head>
									  <title>Tour Enquiry From Website</title>
									</head>
									<body>
									  <p>Here are the details of enquiry submitted by visitors!</p>
									  <table width="400" border="1" cellpadding="0" cellspacing="0">
										<tr>
										  <th>Tour Name</th>
										  <td style="text-align:left;">'.$data['tour_id'].'##'.$data['tour_name'].'</td>
										</tr>
										<tr>
										  <th>Page Url</th>
										  <td>'.$data['page_url'].'</td>
										</tr>
										<tr>
										  <th>Name</th>
										  <td>'.$data['enquiryName'].'</td>
										</tr>
										<tr>
										  <th>Email</th>
										  <td>'.$data['enquiryEmail'].'</td>
										</tr>
										<tr>
										  <th>Phone</th>
										  <td>'.$data['enquiryPhone'].'</td>
										</tr>
										<tr>
										  <th>Country</th>
										  <td>'.$data['enquiryCountry'].'</td>
										</tr>

										<tr>
										  <th>No Of Person Room1</th>
										  <td> Adults:'.$data['adults1'].' Child:'.$data['child1'].'('.$data['child1_1'].','.$data['child1_2'].','.$data['child1_3'].')</td>
										</tr>';

										if($data['adults2']!=""||$data['adults2']!="")
										{
											$mailerData['message'] = $mailerData['message'].'<tr>
											  <th  >No Of Person Room2</th>
											  <td  > Adults:'.$data['adults2'].' Child:'.$data['child2'].'('.$data['child2_1'].','.$data['child2_2'].','.$data['child2_3'].')</td>
											</tr>';
										}

										if($data['adults3']!=""||$data['adults3']!="")
										{
											$mailerData['message'] = $mailerData['message'].'<tr>
												  <th  >No Of Person Room3</th>
												  <td  > Adults:'.$data['adults3'].' Child:'.$data['child3'].'('.$data['child3_1'].','.$data['child3_2'].','.$data['child3_3'].')</td>
												</tr>';
										}

										if($data['adults4']!=""||$data['adults4']!="")
										{
											$mailerData['message'] = $mailerData['message'].'<tr>
											  <th  >No Of Person Room4</th>
											  <td  > Adults:'.$data['adults4'].' Child:'.$data['child4'].'</td>
											</tr>';
										}

										if($data['adults5']!=""||$data['adults5']!="")
										{
											$mailerData['message'] = $mailerData['message'].'<tr>
											  <th  >No Of Person Room5</th>
											  <td  > Adults:'.$data['adults5'].' Child:'.$data['child5'].'</td>
											</tr>';
										}

										$mailerData['message'] = $mailerData['message'].'<tr>
										 <tr>
										  <th  >Hotel Preference</th>
										  <td  >'.$hotelPreferences.'</td>
										</tr>
										<tr>
										  <th  >Arrival Date</th>
										  <td  >'.$data['enquiryArrivalDate'].'</td>
										</tr>
										<tr>
										  <th  >Message</th>
										  <td  >'.$data['enquiryComment'].'</td>
										</tr>
										<tr>
										  <th  >IP</th>
										  <td  ><a href="'.WEBROOT.'ip-information.php?ip='.$data['user_ip'].'">'.$data['user_ip'].'</a></td>
										</tr>
										
										


									  </table>
									</body>
									</html>';


		if($data['enquiry_type']=='pay_now_100')
		{
			$mailResult=$objMailer->sendUserMail($mailerData);
		}

		$confirmationPageParameter = array(
												"title" =>  "Thank You, Your query has been received",
												"description"	=>	"Dear ".$data['enquiryName']." thank you for contacting us. Your query has been received to us. We will contact you shortly."
									);
		$this->setConfirmationParameters($confirmationPageParameter);
		$this->closeDBConnection();

		
		if($data['enquiry_type']=='pay_now_100')
		{
			$countryInfo = explode("####",@$data['enquiryCountry']);
			$paymentRequestData = array(
										"enquiry_id"		=>		$enquiryId,
										"tour_id"			=>		$data['tour_id'],
										"tour_name"			=>		$data['tour_name'],
										"customer_name"		=>		$data['enquiryName'],
										"email"				=>		$data['enquiryEmail'],
										"country"			=>		@$countryInfo[0],
										"total_amount"		=>		'1000',
										"currency_code"		=>		'INR',
										"pyament_pg"		=>		'icicipg_ver2'

							);

			$paymentInfo = $this->addNewPaymentWithOrder($paymentRequestData);
			
			if($paymentInfo['payment_code']!=""&&$paymentInfo['user_payment_code']!="")
			{
				$paymentParam = $paymentInfo['payment_code'].'cd@erp98'.$paymentInfo['user_payment_code'];
				header('location:'.WEBROOT.'process-website-payment.php?eid='.$paymentParam);
				exit();
			}
	
		}
		else
		{
			header('location:https://www.elegantjourneys.com/confirmation.php');
		}
		exit;
	}

	function getPaymentInformationByUserPaymentCode($data=array())
	{
		$this->setDatabaseConnection();

		$strsqlPayment = "select * from tbls_payment where payment_code='".$data['payment_code']."' and user_payment_code='".$data['user_payment_code']."'";
		$resultPayment = mysql_query($strsqlPayment);
		$infoPayment = mysql_fetch_array($resultPayment,MYSQL_ASSOC);

		if($infoPayment['id']=="")
		{
			return false;
		}

		$strsqlEnquiry = "select * from  tbls_enquiry where id=".$infoPayment['enquiry_id'];
		$resultEnquiry = mysql_query($strsqlEnquiry);
		$infoEnquiry = mysql_fetch_array($resultEnquiry,MYSQL_ASSOC);

		$this->closeDBConnection();

		$paymentInfo = array(
									"payment_id"		=>		$infoPayment['id'],
									"payment_code"		=>		$infoPayment['payment_code'],
									"user_payment_code"	=>		$infoPayment['user_payment_code'],
									"total_amount"		=>		$infoPayment['total_amount'],
									"currency_code"		=>		$infoPayment['currency_code'],
									"order_id"			=>		$infoEnquiry['id'],
									"email"				=>		$infoEnquiry['email'],
									"enquiry_id"		=>		$infoPayment['enquiry_id'],
									"payment_ref_code"	=>		$infoPayment['payment_code'].'cd@erp98'.$infoPayment['user_payment_code'],
									"name"				=>		$infoEnquiry['name']
				);
		
		return $paymentInfo;

	}

	function updateBookNowPayment($data=array())
	{
		$this->setDatabaseConnection();

		$strsqlPayment = "select * from tbls_payment where id=".$data['payment_id']." and payment_code='".$data['payment_code']."' and user_payment_code='".$data['user_payment_code']."'";
		$resultPayment = mysql_query($strsqlPayment);
		$infoPayment = mysql_fetch_array($resultPayment,MYSQL_ASSOC);
		
		if($infoPayment['id']=="")
		{
			header("location:https//www.elegantjourneys.com");
			exit();
		}

		

		/*if($data['order_id']!=$infoPayment['order_id'])
		{
			echo "------------------------------------------3";
			//header("location:https//www.elegantjourneys.com");
			exit();
		}*/

		$strsqlOrder = "select * from elegantjourneys_db.tbls_order where id=".$infoPayment['order_id'];
		$resultOrder = mysql_query($strsqlOrder);
		$infoOrder = mysql_fetch_array($resultOrder);

		
		if($infoOrder['id']=="")
		{
			header("location:https//www.elegantjourneys.com");
			exit();
		}

		$strsqlPayment = "update tbls_payment set  	transaction_id='".$data['transaction_id']."', status='".$data['status']."', payment_details='".$data['payment_details']."', payment_date='".$data['payment_date']."' where id=".$infoPayment['id'];
		mysql_query($strsqlPayment);

		$strsqlOrder = "update elegantjourneys_db.tbls_order set payment_status = 'paid' where id".$infoOrder['id'];
		mysql_query($strsqlOrder);

		$confirmationPageParameter = array(
												"title" =>  "Thank You, Your payment has been received",
												"description"	=>	"Dear customer thank you for booking tour with us. Your payment has been received to us. We will contact you shortly. Your transaction id is <b>".$data['transaction_id']."</b> and your payment reference code is <b>".$data['payment_code']."</b>"
									);
		$this->setConfirmationParameters($confirmationPageParameter);
		header('location:https://www.elegantjourneys.com/confirmation.php');
		
		exit();
		
	}


	function addNewPaymentWithOrder($data)
	{

		$operationResult = true;
		$this->setDatabaseConnection();
		$strsqlCustomerOrder = "insert into elegantjourneys_db.tbls_order (enquiry_id) values('".$data['enquiry_id']."')";
		$resultOrder = mysql_query($strsqlCustomerOrder);
		$orderId = mysql_insert_id();

		if($orderId=="")
		{
			$operationResult = false;

		}
		#### ADDING PAYMENT

		if($operationResult)
		{
			$paymentCode = $this->genRandomString(10);
			$userPaymentCode = $this->genRandomString(6,'number');
			$strsqlPayment = "insert into tbls_payment ( order_id, enquiry_id, payment_code, user_payment_code, total_amount, currency_code, gateway) values(".$orderId.",'".$data['enquiry_id']."','".$paymentCode."','".$userPaymentCode."','".$data['total_amount']."','".$data['currency_code']."','".$data['pyament_pg']."')";
			$resultPayment = mysql_query($strsqlPayment);
			if(!$resultPayment)
			{
				$operationResult = false;
			}
		}

		
		if($operationResult)
		{
			$returnData = array(
									"payment_code"		=>		$paymentCode,
									"user_payment_code"	=>		$userPaymentCode
						);
			
			return $returnData;
		}
		else
		{
			return false;
		}

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

	function getUserIpDetailWithIP($ipAddress="")
	{
		include_once(BASEPATH.'class/ip-locator.php');

		//Load the class
		$ipLite = new ip2location_lite();
		$ipLite->setKey('f2a1699e7e2662e37434b7cf95380c2d6a15eb7cdb686a61a972796f835ca3c2');

		//Get errors and locations
		$locations = $ipLite->getCity($ipAddress);
		return $locations;
	}

	function getUserDetailByIp()
	{
		include_once(BASEPATH_CLASS."ip-locator.php");

		//Load the class
		$objIpLocator = new ip2location_lite();

		$userIp = $_SERVER['REMOTE_ADDR'];
		$data['user_ip']=$userIp;
		$ipInformation = $objIpLocator->getUserIpDetail($userIp);
		
		return $ipInformation;
	}


	function sendShortCustomerInfo($post)
	{

		$ipInformation=$this->getUserDetailByIp();


		$to = EMAIL_WEBADMIN;
		//$to='kr.rakesh.sinha7@gmail.com';
		
		#### SENDING MAIL TO ADMIN
		include_once(BASEPATH."class/mailer-class.php");
		$objMailer = new Mailer();
		$mailerData = array();
		
		
		
		if((isset($post['subject']))&&($post['subject']!=""))
		{
			$subject = $post['subject'];
		}
		else
		{
			$subject = 'Short-O enquiry '.$post['tour_code'].' - '.$post['customerName'];
		}

		$message  ='<table width="400" border="1" cellpadding="0" cellspacing="0">';

		$message .= '
				<tr>
					<td>Tour Name</td>
					<td><a href="'.$post['page_url'].'">'.$post['tour_id'].'####'.$post['tour_name'].'</a></td>
			   </tr>
			   <tr>
					<td>Tour Code</td>
					<td>'.$post['tour_code'].'</a></td>
			   </tr>
				';

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
				  </tr>';

					$message .= '
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

				</table>';
				
			

		$mailerData['mail_type']='html';
		$mailerData['mail_source']='php';
		$mailerData['to'] = EMAIL_WEBADMIN;
		$mailerData['subject'] = $subject;
		$mailerData['from'] = EMAIL_FROM;
		$mailerData['bcc'] = EMAIL_BCC;
		$mailerData['message']= $message;
		
		$mailResult=$objMailer->sendUserMail($mailerData);

		return $mailResult;

		/*$from=EMAIL_FROM;

		$headers = "From:".$from."\r\n";
		$headers .= "Bcc:kr.rakesh.sinha7@gmail.com"."\r\n";
		$headers .= 'Content-type: text/html;';
		if(mail($to, $subject, $message, $headers))
		{

			return true;
		}*/
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

		$sessionSecurityText = $_SESSION['feedback_security_code'];
		$enteredSecurityText = strtoupper($post['security_text']);
		$validation = false;
		if($sessionSecurityText!=""&&$enteredSecurityText!="")
		{
			if($sessionSecurityText==$enteredSecurityText)
			{
				$validation = true;
			}
		}

		if(!$validation)
		{
			$json = array(
								"result"	=>		"fail",
								"message"	=>		"Please enter correct security code"
					);
			echo json_encode($json);
			exit();
		}
		$this->closeDBConnection();

		include_once(BASEPATH_CLASS."ip-locator.php");
		$objIpLocator = new ip2location_lite();

		#### GETTING IP INFORMATIONS
		$userIp = $_SERVER['REMOTE_ADDR'];
		$data['user_ip']=$userIp;
		$ipInformation = $objIpLocator->getUserIpDetail($userIp);

		$data['ip_country']=$ipInformation['countryName'];
		$data['ip_state']=$ipInformation['regionName'];
		$data['ip_time_zone']=$ipInformation['timeZone'];

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
			
				#### SENDING MAIL TO ADMIN
				include_once(BASEPATH."class/mailer-class.php");
				$objMailer = new Mailer();
				$mailerData = array();

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

				 $messageText .='  <tr>
										<th style="text-align:left;">IP</th>
										<td>'.$data['user_ip'].'</td>
									</tr>
									<tr>
										<th style="text-align:left;">Country from IP</th>
										<td>'.$data['ip_country'].'</td>
									</tr>
									<tr>
										<th style="text-align:left;">State from IP</th>
										<td>'.$data['ip_state'].'</td>
									</tr>
									<tr>
										<th style="text-align:left;">Time Zone</th>
										<td>'.$data['ip_time_zone'].'</td>
									</tr>';

								

				 $messageText .='</table>';
				// echo $messageText;

				$from='wadhawan.vivek@gmail.com';

				//$headers = "From:".$from."\r\n";
				//$headers .= "Bcc:kr.rakesh.sinha7@gmail.com"."\r\n";
				//$headers .= 'Content-type: text/html;';
				//mail($to, $subject, $messageText, $headers);
				
				
				$mailerData['mail_type']='html';
				$mailerData['mail_source']='php';
				$mailerData['to'] = EMAIL_WEBADMIN;
				$mailerData['subject'] = $subject;
				$mailerData['from'] = EMAIL_FROM;
				$mailerData['bcc'] = EMAIL_BCC;
				$mailerData['message']= $messageText;
							
				$mailResult=$objMailer->sendUserMail($mailerData);

				//return $mailResult;

				
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
		
		if(empty($data['customer_id']) && ($data['customer_id'] == "")){
			$customerID = 0;
		}else{
			$customerID = $data['customer_id'];
		}
		$strsqlTourEnquiry = "insert into tbls_enquiry ( name, first_name, last_name, email, phone, country, enquiry_source, customer_id) values('".$data['name']."','".$data['first_name']."','".$data['last_name']."','".$data['email']."','".$data['phone']."','".$data['country']."','".$data['enquiry_source']."','".$customerID."')";
		$resultTourEnquiry = mysql_query($strsqlTourEnquiry);


		if($resultTourEnquiry)
		{
			$enquiryId = mysql_insert_id();

			$this->closeDBConnection();
			$this->addCampaignData($enquiryId);
			return $enquiryId;
		}
		else
		{
			$this->closeDBConnection();
			return false;
		}
	}

	function addCampaignData($enquiryId)
	{

		if((isset($_SESSION['campaign']['campaign_id']))&&($_SESSION['campaign']['campaign_id']!=""))
		{
			$campaignValue = $_SESSION['campaign'];
			$_SESSION['campaign'] = array();

			$this->setDatabaseConnection();

			$strsqlCampaign = "insert into tbls_campaign_visits (enquiry_id, campaign_id, campaign_value) values(".$enquiryId.",".$campaignValue['campaign_id'].",'".serialize($campaignValue)."')";
			mysql_query($strsqlCampaign);

			$this->closeDBConnection();
		}
	}

	function addEnquiryDetail($data)
	{
		$this->setDatabaseConnection();
		$strsqlTourEnquiry = "insert into tbls_enquiry_detail( enquiry_id, message, page_url, tour_id, tour_page_id, tour_name, user_ip, other_information) values('".$data['enquiry_id']."','".$data['message']."','".$data['page_url']."','".$data['tour_id']."','".$data['tour_page_id']."','".$data['tour_name']."','".$data['user_ip']."','".$data['other_information']."')";
		$resultTourEnquiry = mysql_query($strsqlTourEnquiry);

		$this->closeDBConnection();
		return $resultTourEnquiry;


	}

	function intiateBookingSession($data)
	{
		if(data['step']=='intiate')
		{
			$_SESSION['booking'] = array();
		}

		foreach($data as $key=>$value)
		{
			$_SESSION['booking'][$key]=$value;
		}

		return true;
	}


	function sendFirstStepBookingEmail($data=array())
	{
		#### SENDING MAIL TO ADMIN
		include_once(BASEPATH."class/mailer-class.php");
		$objMailer = new Mailer();
		$mailerData = array();

		$name = $data['first_name'].' '.$data['last_name'];

		$mailerData['mail_type']='html';
		$mailerData['mail_source']='php';
		$mailerData['to'] = EMAIL_WEBADMIN;
		$mailerData['subject'] = 'Short-P equiry '.$data['tour_id'].' -'.$name;
		$mailerData['from'] = EMAIL_FROM;
		$mailerData['bcc'] = EMAIL_BCC;
		$mailerData['message']= '<html>
									<head>
									  <title>Information received from first step Booking</title>
									</head>
									<body>
									  <p>Here are the details received from first step booking</p>
									  <table padding="2" border="1">
										<tr>
										  <th>First Name</th>
										  <td>'.$data['first_name'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Last Name</th>
										  <td>'.$data['last_name'].'</td>
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
										  <th style="text-align:left;">City</th>
										  <td>'.$data['city'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Country</th>
										  <td>'.$data['country'].'</td>
										</tr>

										<tr>
										  <th style="text-align:left;">IP</th>
										  <td>'.$data['user_ip'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Country from IP</th>
										  <td>'.$data['ip_country'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">State from IP</th>
										  <td>'.$data['ip_state'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Time Zone</th>
										  <td>'.$data['ip_time_zone'].'</td>
										</tr>
									  </table>
									</body>
									</html>';
		$mailResult=$objMailer->sendUserMail($mailerData);


	}

	public function getBookingEnquiry($data)
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

	function addSecondStepData($data)
	{

		$enquiryData = array(
									"enquiry_id"			=>		$data['enquiry_id'],
									"message"				=>		$data['special_requirement'],
									"page_url"				=>		$data['page_url'],
									"tour_id"				=>		$data['tour_id'],
									"tour_page_id"			=>		$data['tour_page_id'],
									"user_ip"				=>		$data['user_ip'],
									"other_information"		=>		serialize($data)
						);
		$this->addEnquiryDetail($enquiryData);

		return true;
	}

	function filterTravelerInformation($roomInformation)
	{
		$roomDetails = array();
		for($i=1;$i<count($roomInformation);$i++)
		{

			$arrTravelerInformation = explode('######',$roomInformation[$i]);

			$totalAdult = $arrTravelerInformation[0];
			$totalChild = $arrTravelerInformation[1];
			$totalBed = $totalAdult + $totalChild;

			$childList = array();
			if($totalChild>=1)
			{
				$arrChildInformation = explode('####',$arrTravelerInformation[2]);
				for($j=0;$j<$totalChild;$j++)
				{
					$childList[]=$arrChildInformation[$j];
				}
			}


			switch($totalBed)
			{
				case 1:
						$roomType='single';
					break;
				case 2:
						$roomType='double';
					break;
				case 3:
						$roomType='extra_bed';
					break;
			}

			$roomDetails[] = array(
										"total_adult"	=>	$totalAdult,
										"total_child"	=>	$totalChild,
										"total_bed"		=>	$totalBed,
										"child_info"	=>	$childList,
										"room_type"		=>	$roomType
						);
			$roomDetails['adults'] = $roomDetails['adults'] + $totalAdult;
			$roomDetails['children'] = $roomDetails['adults'] + $totalChild;
			$roomDetails['total_travelers'] = ($roomDetails['total_travelers'] + ($totalAdult+$totalChild));
			$roomDetails['total_rooms'] = ($roomDetails['total_rooms'] + 1);

		}

		return $roomDetails;
	}

	function getEnquiryInformation($data=array())
	{
		$this->setDatabaseConnection();
		$enquiryId = $data['enquiry_id'];

		$strsqlEnquiry = "select * from tbls_enquiry where id=".$enquiryId;
		$resultEnquiry = mysql_query($strsqlEnquiry);
		$infoEnquiry = mysql_fetch_array($resultEnquiry,MYSQL_ASSOC);

		$strsqlEnquiryDetail = "select * from tbls_enquiry_detail where enquiry_id=".$enquiryId;
		$resultEnquiryDetail = mysql_query($strsqlEnquiryDetail);
		$infoEnquiryDetail = mysql_fetch_array($resultEnquiryDetail,MYSQL_ASSOC);
		$this->closeDBConnection();

		$enquiryInfo = array(
									"id"				=>		$infoEnquiry['id'],
									"first_name"		=>		$infoEnquiry['first_name'],
									"last_name"			=>		$infoEnquiry['last_name'],
									"name"				=>		$infoEnquiry['name'],
									"email"				=>		$infoEnquiry['email'],
									"phone"				=>		$infoEnquiry['phone'],
									"country"			=>		$infoEnquiry['country'],
									"enquiry_source"	=>		$infoEnquiry['enquiry_source'],
									"customer_id"		=>		$infoEnquiry['customer_id'],
									"message"			=>		$infoEnquiryDetail['message'],
									"page_url"			=>		$infoEnquiryDetail['page_url'],
									"tour_id"			=>		$infoEnquiryDetail['tour_id'],
									"tour_name"			=>		$infoEnquiryDetail['tour_name'],
									"tour_page_id"		=>		$infoEnquiryDetail['tour_page_id'],
									"other_information"	=>		$infoEnquiryDetail['other_information']
					);

		return $enquiryInfo;

	}

	function getBookingEnquiryMail($data)
	{

		#### SENDING MAIL TO ADMIN
		include_once(BASEPATH."class/mailer-class.php");
		$name = $data['first_name'].' '.$data['last_name'];
		$objMailer = new Mailer();
		$mailerData = array();
		$mailerData['mail_type']='html';
		$mailerData['mail_source']='php';
		$mailerData['to'] = EMAIL_WEBADMIN;
		$mailerData['subject'] = 'Final-P Enquiry '.$data['tour_id'].' -'.$name;
		$mailerData['from'] = EMAIL_FROM;
		$mailerData['message']= '<html>
									<head>
									  <title>Tour Booking Enquiry From Website</title>
									</head>
									<body>
									  <p>Here are the details of enquiry submitted by visitors from tour calendar.</p>
									  <table width="400" border="1" cellpadding="0" cellspacing="0">
										<tr>
										  <th style="text-align:left;">Tour Name</th>
										  <td style="text-align:left;">'.$data['tour_name'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Tour Page Name</th>
										  <td style="text-align:left;">'.$data['tour_page_name'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Tour Id</th>
										  <td style="text-align:left;">'.$data['tour_id'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Tour Page Id</th>
										  <td style="text-align:left;">'.$data['tour_page_id'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Page URL</th>
										  <td style="text-align:left;">'.$data['page_url'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">First Name</th>
										  <td style="text-align:left;">'.$data['first_name'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Last Name</th>
										  <td style="text-align:left;">'.$data['last_name'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Phone</th>
										  <td style="text-align:left;">'.$data['phone'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Email</th>
										  <td style="text-align:left;">'.$data['email'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Country</th>
										  <td style="text-align:left;">'.$data['country'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Hotel Type</th>
										  <td style="text-align:left;">'.$data['hotel'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Room Type</th>
										  <td style="text-align:left;">'.$data['room_type'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Travel Date</th>
										  <td style="text-align:left;">'.$data['tour_date'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Currency</th>
										  <td style="text-align:left;">'.$data['currency'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Tour Price</th>
										  <td style="text-align:left;">'.$data['profit_price'].'</td>
										</tr>';

										for($i=0;$i<$data['traveler_information']['total_rooms'];$i++)
										{
											$travelerInformation = array();
											$travelerInformation = $data['traveler_information'][$i];

											$childInformation = '';
											if($travelerInformation['total_child']>=1)
											{
												for($j=0;$j<$travelerInformation['total_child'];$j++)
												{
													if($childInformation=="")
													{
														$childInformation = ' Child'.($j+1).':'.$travelerInformation['child_info'][$j];
													}
													else
													{
														$childInformation = $childInformation.', Child'.($j+1).':'.$travelerInformation['child_info'][$j];
													}
												}
											}
											$mailerData['message'] = $mailerData['message'].'<tr>
											  <th style="text-align:left;">No Of Person Room'.($i+1).'</th>
											  <td style="text-align:left;"> Adults:'.$travelerInformation['total_adult'].' Child:'.$travelerInformation['total_child'].'('.$childInformation.')</td>
											</tr>';
										}


										$mailerData['message'] = $mailerData['message'].'<tr>
										 <tr>
										  <th style="text-align:left;">Special Requirement</th>
										  <td style="text-align:left;">'.$data['message'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">User IP</th>
										  <td style="text-align:left;">'.$data['user_ip'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">IP Country</th>
										  <td style="text-align:left;">'.$data['ip_country'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">IP State</th>
										  <td style="text-align:left;">'.$data['ip_state'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">IP Time Zone</th>
										  <td style="text-align:left;">'.$data['ip_time_zone'].'</td>
										</tr>

									  </table>
									</body>
									</html>';

			$mailResult=$objMailer->sendUserMail($mailerData);


	}


	function sendCallbackMail($data=array())
	{

		#### SENDING MAIL TO ADMIN
		include_once(BASEPATH."class/mailer-class.php");
		$objMailer = new Mailer();
		$mailerData = array();
		$mailerData['mail_type']='html';
		$mailerData['mail_source']='php';
		$mailerData['to'] = EMAIL_WEBADMIN;
		$mailerData['subject'] = 'Information received for call back';
		$mailerData['from'] = EMAIL_FROM;
		$mailerData['bcc'] = EMAIL_BCC;
		$mailerData['message']= '<html>
									<head>
									  <title>Information received for call back</title>
									</head>
									<body>
									  <p>Here are the details received for call back</p>
									  <table padding="2" border="1">
										<tr>
										  <th style="text-align:left;">Name</th>
										  <td>'.$data['name'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Phone</th>
										  <td>'.$data['phone'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Email</th>
										  <td>'.$data['email'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Country</th>
										  <td>'.$data['country'].'</td>
										</tr>

										<tr>
										  <th style="text-align:left;">IP</th>
										  <td>'.$data['user_ip'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Country from IP</th>
										  <td>'.$data['ip_country'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">State from IP</th>
										  <td>'.$data['ip_state'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Time Zone</th>
										  <td>'.$data['ip_time_zone'].'</td>
										</tr>
									  </table>
									</body>
									</html>';
		$mailResult=$objMailer->sendUserMail($mailerData);


	}


	function processWebsitePaymetPreConfirmation($post)
	{ 

		$ipInformation=$this->getUserDetailByIp();


		$to = EMAIL_WEBADMIN;
		//$to='kr.rakesh.sinha7@gmail.com';
		
		#### SENDING MAIL TO ADMIN
		include_once(BASEPATH."class/mailer-class.php");
		$objMailer = new Mailer();
		$mailerData = array();
		
		
		$subject = 'Prepaymt of '.$post['name'].' is processing through ICICI gateway';

		$message = 'Following payment has been going to process through ICICI gateway';
	
		$message  ='<table width="400" border="1" cellpadding="0" cellspacing="0">';

		$message .= '
				<tr>
					<td>Name</td>
					<td>'.$post['name'].'</td>
			   </tr>
			   <tr>
					<td>Email</td>
					<td>'.$post['email'].'</a></td>
			   </tr>
				';

		 $message .='
				 <tr>
					<td>Currency</td>
					<td>INR</td>
				  </tr>
				  <tr>
					<td>Amount</td>
					<td>1000</td>
				  </tr>
				  ';

					$message .= '
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

				</table>';
				
			

		$mailerData['mail_type']='html';
		$mailerData['mail_source']='php';
		$mailerData['to'] = EMAIL_WEBADMIN;
		$mailerData['subject'] = $subject;
		$mailerData['from'] = EMAIL_FROM;
		$mailerData['bcc'] = EMAIL_BCC;
		$mailerData['message']= $message;
		
		$mailResult=$objMailer->sendUserMail($mailerData);

		return $mailResult;

		
	}

}
?>
