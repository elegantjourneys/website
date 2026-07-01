<?php
	include_once("../includes/config.php");
	include_once(BASEPATH_CLASS."first-class.php");
	$objFirstClass = new FirstClass();
	$objFirstClass->verifyUserRequest();
	$requestName = $_POST['method'];

	switch($requestName)
	{
		case 'getTourShortEnquiry':
				include_once(BASEPATH_CLASS."enquiry-class.php");
				include_once(BASEPATH_CLASS."ip-locator.php");
				$objEnquiry = new Enquiry();
				$objIpLocator = new ip2location_lite();
				/*
					getting enquiry detail
				*/
				$objEnquiry->setDatabaseConnection();
				
				$data = array();
				$data['name']=$objEnquiry->filterReceivedData($_POST['name']);
				$data['email']=$objEnquiry->filterReceivedData($_POST['email']);
				$data['phone']=$objEnquiry->filterReceivedData($_POST['phone']);
				$data['message']=$_POST['message'];
				$data['tour_id']=$objEnquiry->filterReceivedData($_POST['tour_id']);
				$data['tour_name']=$objEnquiry->filterReceivedData($_POST['tour_name']);
				$data['page_url']=$objEnquiry->filterReceivedData($_POST['page_url']);
				$data['enquiry_source']='short_tour_enquiry';
				$objEnquiry->closeDBConnection();
				
				#### GETTING IP INFORMATIONS
				$userIp = $_SERVER['REMOTE_ADDR'];
				$data['user_ip']=$userIp;
				$ipInformation = $objIpLocator->getUserIpDetail($userIp);
				$data['country']=$ipInformation['countryName'];
				$result = $objEnquiry->getShortTourEnquiry($data);
				if($result)
				{
					$json = array(
						"result"	=>	"success",
						"message"	=>	""
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
		case 'getCustomPrice':
				include_once(BASEPATH_CLASS."tour-price-class.php");
				$objTourPrice = new TourPrice();
				$data = array();
				$data['tour_id']=$_POST['tourId'];
				$data['tour_type'] = $_POST['tourType'];
				$data['tour_start_date'] = $_POST['tourStartDate'];
				$currencyRate = $_POST['currencyRate'];
				$tourPrice = $objTourPrice->getPriceByDateRange($data);
				
				
				$discountInfo = array();
				$discountInfo = array(
								'offer'=>$tourPrice['offer'],
					            'profit'=>$tourPrice['profit'],
								'price'=>$tourPrice['star3'],
								'currencyRate'=>$currencyRate
						);
				
				
				$star3tourPriceInfo =$objTourPrice->getPriceDetail($discountInfo);

				$discountInfo = array(
								'offer'=>$tourPrice['offer'],													
					            'profit'=>$tourPrice['profit'],
								'price'=>$tourPrice['star4'],
								'currencyRate'=>$currencyRate
						);
				$star4tourPriceInfo =$objTourPrice->getPriceDetail($discountInfo);

				$discountInfo = array(
								'offer'=>$tourPrice['offer'],													
					            'profit'=>$tourPrice['profit'],
								'price'=>$tourPrice['star5'],
								'currencyRate'=>$currencyRate
						);
				$star5tourPriceInfo =$objTourPrice->getPriceDetail($discountInfo);
				echo $star3tourPriceInfo['profitPrice'].'##'.$star3tourPriceInfo['displayPrice'].'####'.$star4tourPriceInfo['profitPrice'].'##'.$star4tourPriceInfo['displayPrice'].'####'.$star5tourPriceInfo['profitPrice'].'##'.$star5tourPriceInfo['displayPrice'];
			break;


	}