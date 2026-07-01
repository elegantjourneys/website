<?php
	include_once("../includes/config.php");
	include_once(BASEPATH_CLASS."first-class.php");
	$objFirstClass = new FirstClass();
	$objFirstClass->verifyUserRequest();
	$requestName = $_POST['method'];

	switch($requestName)
	{

		case 'getBookingStep1':
				include_once(BASEPATH_CLASS."enquiry-class.php");
				include_once(BASEPATH_CLASS."ip-locator.php");
				include_once(BASEPATH_CRM_CLASS."cms-hotel-class.php");
				include_once(BASEPATH_CRM_CLASS."cms-tour-page-name-class.php");

				$objIpLocator = new ip2location_lite();
				$objEnquiry = new Enquiry();
				$objCMSHotel = new CMSHotel();
				$objTourPageName = new TourPageName();
				/*
					getting enquiry detail
				*/
				$objEnquiry->setDatabaseConnection();

				$data = array();
				$data['first_name']=$objEnquiry->filterReceivedData($_POST['first_name']);
				$data['last_name']=$objEnquiry->filterReceivedData($_POST['last_name']);
				$data['name']=$objEnquiry->filterReceivedData($_POST['name']);
				$data['email']=$objEnquiry->filterReceivedData($_POST['email']);
				$data['phone']=$objEnquiry->filterReceivedData($_POST['phone']);
				$data['city']=$objEnquiry->filterReceivedData($_POST['city']);
				$data['country']=$objEnquiry->filterReceivedData($_POST['country']);

				$data['day']=$objEnquiry->filterReceivedData($_POST['day']);
				$data['month']=$objEnquiry->filterReceivedData($_POST['month']);
				$data['year']=$objEnquiry->filterReceivedData($_POST['year']);
				$data['hotel']=$objEnquiry->filterReceivedData($_POST['hotel']);
				$data['room']=$objEnquiry->filterReceivedData($_POST['room']);
				$data['currency']=$objEnquiry->filterReceivedData($_POST['currency']);
				$data['tour_page_id']=$objEnquiry->filterReceivedData($_POST['tour_page_id']);
				$data['tour_id']=$objEnquiry->filterReceivedData($_POST['tour_id']);
				$data['page_url']= $_POST['page_url'];

				#### GETTING PRICE DATA
				$pParameter = $_POST['p_parameter'];
				$dataPrice = array(
										"eid"		=>		$pParameter
							);
				$post = $objEnquiry->decodeWebUrl($dataPrice);

				$data['profit_price'] = $post['profit_price'];
				$data['discount_price'] = $post['discount_price'];

				#### GETTING IP INFORMATIONS
				$userIp = $_SERVER['REMOTE_ADDR'];
				$data['user_ip']=$userIp;
				$ipInformation = $objIpLocator->getUserIpDetail($userIp);

				$data['ip_country']=$ipInformation['countryName'];
				$data['ip_state']=$ipInformation['regionName'];
				$data['ip_time_zone']=$ipInformation['timeZone'];



				$objEnquiry->closeDBConnection();
				$result = $objEnquiry->intiateBookingSession($data);

				if($result)
				{
					$enquiryData = array(
												"first_name"		=>		$data['first_name'],
												"last_name"			=>		$data['last_name'],
												"name"				=>		$data['name'],
												"email"				=>		$data['email'],
												"phone"				=>		$data['phone'],
												"country"			=>		$data['country'],
												"enquiry_source"	=>		'tour_booking_by_date',
												"tour_id"			=>		$data['tour_id']
									);

					$enquiryId = $objEnquiry->addMasterInformation($enquiryData);

					$enquiryData = array(
											"enquiry_id"		=>		$enquiryId
									);
					$result = $objEnquiry->intiateBookingSession($enquiryData);


					if($enquiryId)
					{
						$enquiryMessageData = array(
													"first_name"		=>		$data['first_name'],
													"last_name"			=>		$data['last_name'],
													"name"				=>		$data['name'],
													"email"				=>		$data['email'],
													"phone"				=>		$data['phone'],
													"city"				=>		$data['city'],
													"country"			=>		$data['country'],
													"user_ip"			=>		$data['user_ip'],
													"ip_country"		=>		$data['ip_country'],
													"ip_state"			=>		$data['ip_state'],
													"ip_time_zone"		=>		$data['ip_time_zone'],
													"tour_id"			=>		$data['tour_id']
									);
						$objEnquiry->sendFirstStepBookingEmail($enquiryMessageData);

						$json = array(
							"result"			=>	"success",
							"message"			=>	"",
							"enquiry_id"		=>	$enquiryId
						);
					}
					else
					{
						$json = array(
							"result"	=>	"fail",
							"message"	=>	"Your request was not processed. Please try again."
						);
					}
				}
				else
				{
					$json = array(
						"result"	=>	"fail",
						"message"	=>	"Your request was not processed. Please try again."
					);
				}
				echo json_encode($json);
			break;
		case 'getBookingStep2':
				include_once(BASEPATH_CLASS."enquiry-class.php");
				include_once(BASEPATH_CRM_CLASS."cms-tour-class.php");
				include_once(BASEPATH_CRM_CLASS."cms-hotel-class.php");

				$objEnquiry = new Enquiry();
				$objCMSTour = new CMSTour();
				$objCMSHotel = new CMSHotel();

				/*
					getting enquiry detail
				*/

				$objEnquiry->setDatabaseConnection();
				$data = array();
				$data['enquiry_id']=$objEnquiry->filterReceivedData($_POST['enquiry_id']);
				$data['special_requirement']=$objEnquiry->filterReceivedData($_POST['special_requirement']);
				$data['room_information']=$_POST['room_information'];
				$objEnquiry->closeDBConnection();

				$data['traveler_information'] =  $objEnquiry->filterTravelerInformation($data['room_information']);
				$data['adults'] = $data['traveler_information']['adults'];
				$data['children'] = $data['traveler_information']['children'];
				$data['total_travelers'] = $data['traveler_information']['total_travelers'];
				$data['total_rooms'] = $data['traveler_information']['total_rooms'];

				$objEnquiry->intiateBookingSession($data);

				$result = $objEnquiry->addSecondStepData($_SESSION['booking']);

				$arrivalDate = $_SESSION['booking']['year'].'-'.$_SESSION['booking']['month'].'-'.$_SESSION['booking']['day'];
				#### GETTING TOUR DURATION
				$tourDuration = $objCMSTour->getTourDuration($_SESSION['booking']['tour_id']);
				$departureDate = date("Y-m-d",strtotime("+".$tourDuration." days", strtotime($arrivalDate)));

				#### GETTING HOTEL TYPE
				$hotelTypeData = array(
											"hotel_type_id"			=>		$_SESSION['booking']['hotel']
								);
				$hotelTypeDetails = $objCMSHotel->getHotelTypeById($hotelTypeData);

				$jsonData = array(
										"enquiry_id"			=>		$_SESSION['booking']['enquiry_id'],
										"first_name"			=>		$_SESSION['booking']['first_name'],
										"last_name"				=>		$_SESSION['booking']['last_name'],
										"name"					=>		$_SESSION['booking']['name'],
										"email"					=>		$_SESSION['booking']['email'],
										"phone"					=>		$_SESSION['booking']['phone'],
										"arrival_date"			=>		$arrivalDate,
										"departure_date"		=>		$departureDate,
										"hotel_type"			=>		$hotelTypeDetails['hotel_alias'],
										"total_rooms"			=>		$_SESSION['booking']['total_rooms'],
										"total_travelers"		=>		$_SESSION['booking']['total_travelers'],
										"traveler_information"	=>		$_SESSION['booking']['traveler_information']
						);

				if($result)
				{

					$json = array(
						"result"			=>	"success",
						"message"			=>	"",
						"data"				=>	$jsonData
					);
				}
				else
				{
					$json = array(
						"result"	=>	"fail",
						"message"	=>	"Your request was not processed. Please try again."
					);
				}
				echo json_encode($json);
			break;
		case 'getBookingInformation':
				echo json_encode($_SESSION['booking']);
			break;
		case 'createBookingEnvironment':
				include_once(BASEPATH_CLASS."enquiry-class.php");
				include_once(BASEPATH_CLASS."customer-order-class.php");
				include_once(BASEPATH_CLASS."customer-payment-class.php");

				$objEnquiry = new Enquiry();
				$objCustomerOrder = new CustomerOrder();
				$objCustomerPayment = new CustomerPayment();

				//$enquiryId = $_SESSION['booking']['enquiry_id'];

				$enquiryId = $_POST['enquiry_id'];
				$paymentMethod = $_POST['payment_method'];

				if($paymentMethod=='credit_card')
				{
					$paymentMethod='icicipg';
				}

				$enquiryData = array(
										"enquiry_id"		=>		$enquiryId
							);
				$enquiryDetail = $objEnquiry->getEnquiryInformation($enquiryData);

				$otherEnquiryInformation = unserialize($enquiryDetail['other_information']);

				$orderData = array(
											"customer_id"				=>		'',
											"enquiry_id"				=>		$enquiryDetail['id'],
											"tour_id"					=>		$enquiryDetail['tour_id'],
											"tour_page_id"				=>		$enquiryDetail['tour_page_id'],
											"tour_price"				=>		($otherEnquiryInformation['total_travelers']*100),
											"currency_code"				=>		$otherEnquiryInformation['currency'],
											"travel_date"				=>		$otherEnquiryInformation['year'].'-'.$otherEnquiryInformation['month'].'-'.$otherEnquiryInformation['day'],
											"no_of_person"				=>		$otherEnquiryInformation['total_travelers'],
											"hotel_type"				=>		$otherEnquiryInformation['hotel'],
											"payment_status"			=>		'pending',
											"payment_method"			=>		$paymentMethod

								);



				$orderId = $objCustomerOrder->addNewOrder($orderData);

				$orderDetailData = array(
											"order_id"				=>		$orderId,
											"total_adult"			=>		$otherEnquiryInformation['adults'],
											"total_child"			=>		$otherEnquiryInformation['children'],
											"total_rooms"			=>		$otherEnquiryInformation['total_rooms'],
											"total_single_room"		=>		$otherEnquiryInformation['total_single_room'],
											"total_double_room"		=>		$otherEnquiryInformation['total_double_room'],
											"total_extra_bed_room"	=>		$otherEnquiryInformation['total_extra_bed_room']
							);

				$orderDetailId = $objCustomerOrder->addOrderDetail($orderDetailData);

				#### ADDING PAYMENT DETAILS

				/*$paymentData = array(
										"order_id"				=>		$orderId,
										"enquiry_id"			=>		$enquiryDetail['id'],
										"payment_code"			=>		$objCustomerPayment->genRandomString(10),
										"invoice_number"		=>		'',
										"total_amount"			=>		($otherEnquiryInformation['total_travelers']*100),
										"currency_code"			=>		$otherEnquiryInformation['currency'],
										"gateway"				=>		'paypal',
										"transaction_id"		=>		'',
										"status"				=>		'pending',
										"payment_date"			=>		date("Y-m-d",time()),
										"payment_details"		=>		''
							);*/
				/* COMMENTED TO GET $100 PER PERSON */


				$paymentData = array(
										"order_id"				=>		$orderId,
										"enquiry_id"			=>		$enquiryDetail['id'],
										"payment_code"			=>		$objCustomerPayment->genRandomString(10),
										"invoice_number"		=>		'',
										"total_amount"			=>		100,
										"currency_code"			=>		$otherEnquiryInformation['currency'],
										"gateway"				=>		$paymentMethod,
										"transaction_id"		=>		'',
										"status"				=>		'pending',
										"payment_date"			=>		date("Y-m-d",time()),
										"payment_details"		=>		''
							);

				$paymentId = $objCustomerPayment->addNewPayment($paymentData);

				#### ADDING VALUE TO SESSION

				$customerOrderSessionData = array(
														"action"			=>		"initiate",
														"order_id"			=>		$orderId,
														"payment_id"		=>		$paymentId,
														"enquiry_id"		=>		$enquiryDetail['id'],
														"payment_code"		=>		$paymentData['payment_code'],
											);

				$result = $objCustomerPayment->createPaymentSession($customerOrderSessionData);


				if($result)
				{
					$sessionResult = $objCustomerPayment->validatePaymentSession();
					if($sessionResult)
					{
						$_SESSION['booking'] = array();

						$bookingData = array(
													"token"		=>		$paymentData['payment_code']
										);

						$json = array(
											"result"	=>		"success",
											"data"		=>		$bookingData,
											"message"	=>		""
								);
					}
					else
					{
						$json = array(
											"result"	=>		"fail",
											"message"	=>		""
								);

					}

				}
				else
				{
					$json = array(
											"result"	=>		"fail",
											"message"	=>		""
								);

				}
				echo json_encode($json);
			break;
		case 'createBookingEnquiryEnvironment':
				include_once(BASEPATH_CLASS."enquiry-class.php");
				include_once(BASEPATH_CRM_CLASS."cms-tour-class.php");
				include_once(BASEPATH_CRM_CLASS."cms-tour-page-name-class.php");
				include_once(BASEPATH_CRM_CLASS."cms-hotel-class.php");

				$objEnquiry = new Enquiry();
				$objCMSTour = new CMSTour();
				$objTourPageName = new TourPageName();
				$objCMSHotel = new CMSHotel();

				$enquiryId = $_POST['enquiry_id'];

				$enquiryData = array(
										"enquiry_id"		=>		$enquiryId
							);
				$enquiryDetail = $objEnquiry->getEnquiryInformation($enquiryData);

				$tourDetail = $objCMSTour->getTourById($enquiryDetail['tour_id']);
				$tourPageName = $objTourPageName->getTourPageNameById($enquiryDetail['tour_page_id']);

				$otherEnquiryInformation = unserialize($enquiryDetail['other_information']);


				$hotelType = $objCMSHotel->getHotelTypeNameById($otherEnquiryInformation['hotel']);
				$enquiryMailData = array(
											"tour_name"				=>		$tourDetail['tour_title'],
											"tour_page_name"		=>		$tourPageName,
											"tour_id"				=>		$enquiryDetail['tour_id'],
											"tour_page_id"			=>		$enquiryDetail['tour_page_id'],
											"page_url"				=>		$enquiryDetail['page_url'],
											"first_name"			=>		$enquiryDetail['first_name'],
											"last_name"				=>		$enquiryDetail['last_name'],
											"email"					=>		$enquiryDetail['email'],
											"phone"					=>		$enquiryDetail['phone'],
											"country"				=>		$enquiryDetail['country'],
											"message"				=>		$enquiryDetail['message'],
											"enquiry_source"		=>		$enquiryDetail['enquiry_source'],
											"tour_date"				=>		$otherEnquiryInformation['day'].'-'.$otherEnquiryInformation['month'].'-'.$otherEnquiryInformation['year'],
											"hotel"					=>		$hotelType,
											"currency"				=>		$otherEnquiryInformation['currency'],
											"traveler_information"	=>		$otherEnquiryInformation['traveler_information'],
											"user_ip"				=>		$otherEnquiryInformation['user_ip'],
											"ip_country"			=>		$otherEnquiryInformation['ip_country'],
											"ip_country"			=>		$otherEnquiryInformation['ip_country'],
											"ip_state"				=>		$otherEnquiryInformation['ip_state'],
											"ip_time_zone"			=>		$otherEnquiryInformation['ip_time_zone'],
											"discount_price"		=>		$otherEnquiryInformation['discount_price'],
											"profit_price"			=>		$otherEnquiryInformation['profit_price'],
											"room_type"				=>		($otherEnquiryInformation['room']=='1')?'Single':'Double'
								);


				$objEnquiry->getBookingEnquiryMail($enquiryMailData);

				$json = array(
											"result"	=>		"success",
											"message"	=>		""
								);


				$confirmationPageParameter = array(
												"title" =>  "Thank You, Your query has been received",
												"description"	=>	"Thank you for contacting us. Your booking query has been received to us. We will contact you shortly."
									);
				$objEnquiry->setConfirmationParameters($confirmationPageParameter);
				echo json_encode($json);
			break;
		case 'createCallback':
				include_once(BASEPATH_CLASS."enquiry-class.php");
				include_once(BASEPATH_CLASS."ip-locator.php");
				include_once(BASEPATH_CRM_CLASS."cms-tour-class.php");
				include_once(BASEPATH_CRM_CLASS."cms-tour-page-name-class.php");

				$objIpLocator = new ip2location_lite();
				$objEnquiry = new Enquiry();
				$objCMSTour = new CMSTour();
				$objTourPageName = new TourPageName();

				$objMysqli = $objEnquiry->setMysqliConnection();

				$data = array();
				$data['name']=$objEnquiry->filterReceivedData($_POST['name']);
				$data['phone']=$objEnquiry->filterReceivedData($_POST['phone']);
				$data['tour_id']=$objEnquiry->filterReceivedData($_POST['tour_id']);
				$data['tour_page_id']=$objEnquiry->filterReceivedData($_POST['tour_page_id']);

				if((isset($_POST['email']))&&($_POST['email']!=""))
				{
					$data['email']=$objEnquiry->filterReceivedData($_POST['email']);
				}

				if((isset($_POST['country']))&&($_POST['country']!=""))
				{
					$data['country']=$objEnquiry->filterReceivedData($_POST['country']);
				}

				$objEnquiry->closeDBConnection();

				$tourDetail = $objCMSTour->getTourById($data['tour_id']);
				$tourPageName = $objTourPageName->getTourPageNameById($data['tour_page_id']);

				$data['tour_page_name']= $tourPageName;
				$data['tour_name']=$tourDetail['tour_title'];

				#### GETTING IP INFORMATIONS
				$userIp = $_SERVER['REMOTE_ADDR'];
				$data['user_ip']=$userIp;
				$ipInformation = $objIpLocator->getUserIpDetail($userIp);

				$data['ip_country']=$ipInformation['countryName'];
				$data['ip_state']=$ipInformation['regionName'];
				$data['ip_time_zone']=$ipInformation['timeZone'];

				$objEnquiry->sendCallbackMail($data);

				$json = array(
											"result"	=>		"success",
											"message"	=>		""
								);


				$confirmationPageParameter = array(
												"title" =>  "Thank You, Your request has been received",
												"description"	=>	"Thank you for contacting us. Your request has been received to us. We will contact you shortly."
									);
				$objEnquiry->setConfirmationParameters($confirmationPageParameter);
				echo json_encode($json);
			break;
		case 'createPaymentEnvironment':
				include_once(BASEPATH_CLASS."customer-payment-class.php");
				$objCustomerPayment = new CustomerPayment();
				
				$objMysqli = $objCustomerPayment->setMysqliConnection();
				
				$data = array();
				$data['customer_email'] = $objCustomerPayment->filterMysqliReceivedData($objMysqli,$_POST['email']);
				$data['user_payment_code'] = $objCustomerPayment->filterMysqliReceivedData($objMysqli,$_POST['payment_otp']);
				
				$objCustomerPayment->closeMysqliConnection($objMysqli);
				
				$result = $objCustomerPayment->verifyCustomerPayment($data);
				$optionalPGCode = $objCustomerPayment->genRandomString(7);
				echo json_encode($result);
			break;




	}
