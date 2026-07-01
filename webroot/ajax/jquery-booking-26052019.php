<?php
	include_once("../includes/config.php");
	include_once(BASEPATH_CLASS."first-class.php");
	$objFirstClass = new FirstClass();
	$objFirstClass->verifyUserRequest();
	$requestName = $_POST['method'];

	switch($requestName)
	{
		case 'initiateBooking':
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
				$data['hotel_level']=$objEnquiry->filterReceivedData($_POST['hotel_level']);
				$data['room_type']=$objEnquiry->filterReceivedData($_POST['room_type']);
				$data['currency_code']=$objEnquiry->filterReceivedData($_POST['currency_code']);
				$rangeInfo = explode('####',$_POST['date_range']);
				$data['month']=$objEnquiry->filterReceivedData($rangeInfo['0']);
				$data['year']=$objEnquiry->filterReceivedData($rangeInfo['1']);
				$data['day']=$objEnquiry->filterReceivedData($_POST['tour_day']);
				$data['tour_id']=$objEnquiry->filterReceivedData($_POST['tour_id']);
				$data['tour_page_id']=$objEnquiry->filterReceivedData($_POST['tour_page_id']);
				$data['page_url']=$objEnquiry->filterReceivedData($_POST['page_url']);

				$objEnquiry->closeDBConnection();

				#### GETTING HOTEL TYPE INFORMATION
				$hotelData = array(
										"hotel_type_id"			=>		$data['hotel_level']
								);

				$hotelTypeInfo = $objCMSHotel->getHotelTypeById($hotelData);
				$data['hotel_type_name'] = $hotelTypeInfo['hotel_type'];
				$data['hotel_alias_name'] = $hotelTypeInfo['hotel_alias'];

				#### GETTING TOUR PAGE INFORMATION
				$tourPageData = array(
											"tour_page_id"		=>		$data['tour_page_id']
								);
				$tourPageInformation = $objTourPageName->getTourPageNameDetailById($tourPageData);
				$data['tour_name'] = $tourPageInformation['title'];
				$data['tour_code'] = $tourPageInformation['tour_code'];

				
				
				
				#### GETTING IP INFORMATIONS
				$userIp = $_SERVER['REMOTE_ADDR'];
				$data['user_ip']=$userIp;
				$ipInformation = $objIpLocator->getUserIpDetail($userIp);
				$data['ip_country']=$ipInformation['countryName'];
				$result = $objEnquiry->intiateBookingSession($data);

				
				if($result)
				{

					$json = array(
						"result"			=>	"success",
						"message"			=>	"",
						"redirect_url"		=>	WEBROOT.'tour-booking.php'
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
		case 'getBookingStep1':
				include_once(BASEPATH_CLASS."enquiry-class.php");
				$objEnquiry = new Enquiry();
				/*
					getting enquiry detail
				*/
				$objEnquiry->setDatabaseConnection();
				
				$data = array();
				$data['name']=$objEnquiry->filterReceivedData($_POST['name']);
				$data['email']=$objEnquiry->filterReceivedData($_POST['email']);
				$data['phone']=$objEnquiry->filterReceivedData($_POST['phone']);
				$data['city']=$objEnquiry->filterReceivedData($_POST['city']);
				$data['country']=$objEnquiry->filterReceivedData($_POST['country']);
				$data['step']=$objEnquiry->filterReceivedData($_POST['step']);
							
				$objEnquiry->closeDBConnection();
				$result = $objEnquiry->intiateBookingSession($data);

			
				if($result)
				{

					$json = array(
						"result"			=>	"success",
						"message"			=>	""
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
		case 'getBookingStep2':
				include_once(BASEPATH_CLASS."enquiry-class.php");
				$objEnquiry = new Enquiry();
				/*
					getting enquiry detail
				*/
				$objEnquiry->setDatabaseConnection();
				
				$data = array();
				$data['adults']=$objEnquiry->filterReceivedData($_POST['adults']);
				$data['children']=$objEnquiry->filterReceivedData($_POST['children']);
				$data['rooms']=$objEnquiry->filterReceivedData($_POST['rooms']);
				$data['special_requirement']=$objEnquiry->filterReceivedData($_POST['special_requirement']);
				$data['step']=$objEnquiry->filterReceivedData($_POST['step']);
											
				$objEnquiry->closeDBConnection();
				$result = $objEnquiry->intiateBookingSession($data);

			
				if($result)
				{

					$json = array(
						"result"			=>	"success",
						"message"			=>	""
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


	}