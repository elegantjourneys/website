<?php
include_once(BASEPATH . "class/first-class.php");
class TourPageName extends FirstClass
{

	function getTourPageNameByTourId($data, $page = 1)
	{

		$objMysqli = $this->setDatabaseConnection();
		$startFrom = ($page - 1) * PAGE_LIMIT_ADMIN;
		$strsqlPageName = "select * from tbls_tour_pages where tour_id =" . $data['tour_id'] . " limit " . $startFrom . "," . (PAGE_LIMIT_ADMIN * 50);
		$resultPageName = $objMysqli->query($strsqlPageName);
		$pageNameList = array();
		while ($infoPageName = $resultPageName->fetch_array(MYSQLI_ASSOC)) {

			$pageNameList[] = $infoPageName;
		}

		$this->closeDBConnection($objMysqli);
		return $pageNameList;
	}

	private function getTourDayListCityView($tourId)
	{
		$objMysqli = $this->setDatabaseConnection();
		$strsqlTourMaster = "select * from cms_managetour where id=" . $tourId;
		$resultTourMaster = $objMysqli->query($strsqlTourMaster);
		$infoTourMaster = $resultTourMaster->fetch_array(MYSQLI_ASSOC);

		$strsqlTourSetting = "select exclude_last_day_hotel from cms_tour_setting where tour_id=" . $tourId;
		$resultTourSetting = $objMysqli->query($strsqlTourSetting);
		$infoTourSetting = $resultTourSetting->fetch_array(MYSQLI_ASSOC);

		// setting day for indian format
		if ($infoTourMaster['tour_start_date'] != "" && $infoTourMaster['tour_start_date'] != '0000-00-00') {
			$infoTourMaster['tour_start_date'] = date("d M Y", strtotime($infoTourMaster['tour_start_date']));
		} else {
			$infoTourMaster['tour_start_date'] = "";
		}
		/*
			getting tour Information
		*/
		$tourStartDate = $infoTourMaster['tour_start_date'];
		$tourDaysList = array();
		$noOfDays = $infoTourMaster['tour_duration'];

		//$strsqlCmsTourDayPlanMaster = "select distinct event_id from cms_tour_day_plan where event_id in (select event_id from cms_tour_day_plan where tour_id=".$tourId." order by day_orderno)";
		$strsqlCmsTourDayPlanMaster = "select event_id from cms_tour_day_plan where tour_id=" . $tourId . " order by day_count";
		$resultCmsTourDayPlanMaster = $objMysqli->query($strsqlCmsTourDayPlanMaster);

		$eventIds = array();
		while ($infoCmsTourDayPlanMaster = $resultCmsTourDayPlanMaster->fetch_array(MYSQLI_ASSOC)) {
			if (in_array($infoCmsTourDayPlanMaster['event_id'], $eventIds)) {
				continue;
			}
			$eventIds[] = $infoCmsTourDayPlanMaster['event_id'];
		}


		$cityViewList = array();

		//while($infoCmsTourDayPlanMaster=mysql_fetch_array($resultCmsTourDayPlanMaster,MYSQLI_ASSOC))
		foreach ($eventIds as $eventId) {
			$strsqlCmsTourDayPlanStartDay = " select * from cms_tour_day_plan where event_id =" . $eventId . " and tour_id=" . $tourId . " order by day_count asc limit 1";
			$resultCmsTourDayPlanStartDay = $objMysqli->query($strsqlCmsTourDayPlanStartDay);
			$infoCmsTourDayPlanStartDay = $resultCmsTourDayPlanStartDay->fetch_array(MYSQLI_ASSOC);

			$strsqlSubregion = "select id,region_location from tbls_subregion where id = (select subregion_id from tbls_tour_events where id=" . $infoCmsTourDayPlanStartDay['event_id'] . ")";
			$resultSubregion = $objMysqli->query($strsqlSubregion);
			$infoSubregion = $resultSubregion->fetch_array(MYSQLI_ASSOC);

			$strsqlCmsTourDayPlanEndDay = " select * from cms_tour_day_plan where event_id =" . $eventId . " and tour_id=" . $tourId . " order by day_count desc limit 1";
			$resultCmsTourDayPlanEndDay = $objMysqli->query($strsqlCmsTourDayPlanEndDay);
			$infoCmsTourDayPlanEndDay = $resultCmsTourDayPlanEndDay->fetch_array(MYSQLI_ASSOC);

			$addCity = true;

			foreach ($cityViewList as $cityView) {
				if ($cityView['city_id'] == $infoSubregion['id']) {
					$addCity = false;
					break;
				}
			}

			if ($addCity) {
				$cityViewList[] = array(
					"event_id"				=>		$infoCmsTourDayPlanStartDay['event_id'],
					"city_name"				=>		$infoSubregion['region_location'],
					"city_id"				=>		$infoSubregion['id'],
					"start_day"				=>		$infoCmsTourDayPlanStartDay['day_count'],
					"end_day"				=>		$infoCmsTourDayPlanEndDay['day_count'],
					"duration"				=>		$infoCmsTourDayPlanStartDay['event_duration']
				);
			}
		}



		$this->closeDBConnection($objMysqli);

		return $cityViewList;
	}

	/* function updateTourPageName($post,$files)
	{
			
		include_once(BASEPATH_CLASS."cms-cost-class.php");
		include_once(BASEPATH_CLASS."cms-tour-price-discount-dates-class.php");

		$tourCities = $this->getTourDayListCityView($post['tour_id']);
		
		
		$cityList = array();
		foreach($tourCities as $tourCity)
		{
			
			$cityList[] = array(
									"duration"	=>		$tourCity['duration'],
									"city"		=>		$tourCity['city_name']
						);
		}
		
				
		$cityInfo = serialize($cityList);

		$objCMSCost = new CMSCost();
		$objCMSTourPriceDiscountDates = new CMSTourPriceDiscountDates();
		
		$objMysqli = $this->setDatabaseConnection();

		$priceDisplay = 'n';
		if((isset($post['price_display']))&&($post['price_display']!=""))
		{
			$priceDisplay = $post['price_display'];
		}
		
		if($post['price_date']!="")
		{
			$post['price_date'] = date("Y-m-d",strtotime($post['price_date']));
		}

		if($post['hotel_type_price']=="")
		{
			$post['hotel_type_price']='';
		}

		if($post['price']!=""&&$post['hotel_type_price']!="")
		{
			$strsqlPageName = "update tbls_tour_pages set title='".$post['title']."', page_url ='".$post['page_url']."', tour_code = '".$post['tour_code']."', price_display='".$priceDisplay."', price_hotel_type_id='".$post['hotel_type_price']."', view_type='".$post['view_type']."' where id=".$post['tour_page_id'];
		}
		else
		{
			$strsqlPageName = "update tbls_tour_pages set title='".$post['title']."', page_url ='".$post['page_url']."', tour_code = '".$post['tour_code']."', price_display='".$priceDisplay."', view_type='".$post['view_type']."' where id=".$post['tour_page_id'];
			
		}

		$resultPageName = $objMysqli->query($strsqlPageName);
		if($resultPageName)
		{
			$pageId = $post['tour_page_id'];
			$this->closeDBConnection($objMysqli);

			#### SETTING TOUR DETAIL
			$tourDetaildata = array(
										"tour_page_id"				=>  $post['tour_page_id'],
										"video"						=>	$post['video'],
										"default_banner"			=>	$post['default_banner'],
										"destinations"				=>	$cityInfo
							);
			
			$this->addTourPageDetail($tourDetaildata,$files);

			#### SETTING META TAGS
			$tourPageMetadata = array(
											"tour_page_id"			=>		$pageId,
											"meta_title"			=>		$post['meta_title'],
											"meta_keyword"			=>		$post['meta_keyword'],
											"meta_description"		=>		$post['meta_description'],
											"canonical_url"			=>		$post['canonical_url'],
											"og_title"				=>		$post['og_title'],
											"og_keyword"			=>		$post['og_keyword'],
											"og_description"		=>		$post['og_description']
								);

			$this->addTourPageMetaDescription($tourPageMetadata);

			#### ADDING HOTEL TYPES FOR TOUR PAGE
			$dataHotelFlus = array(
											"tour_page_id"		=>		$pageId,
							);
			$this->flushAllTourPageHotel($dataHotelFlus);
			
			foreach($post['hotel_type'] as $hotelType)
			{
				$dataHotelType = array(
											"tour_page_id"		=>		$pageId,
											"hotel_type_id"		=>		$hotelType
								);
				$this->addHotelTypes($dataHotelType);
			}

			

			$dataDiscountInfo = array();
			$dataDiscountInfo['tour_id'] = $post['tour_id'];
			$dataDiscountInfo['tour_page_id'] = $pageId;
			$discountInfo = $objCMSTourPriceDiscountDates->getTourDiscountDetail($dataDiscountInfo);

			$data = array();

			$roomsData = array();
			$roomsData[]='2####0####0'; #### ADDED FOR ROOM PRICE CALCULATION
			$data['tour_id'] = $post['tour_id'];
			$data['vehicle_id'] = VEHICLE_ID;
			$data['event_tax'] = EVENT_TAX;
			$data['vehicle_tax'] = VEHICLE_TAX;
			$data['mislaneous_cost_price'] = MISLANEOUS_COST_PRICE;
			$data['selected_currency_code'] = SELECTED_CURRENCY_CODE;
			$data['rooms'] = $roomsData;
			$data['number_of_room']='1'; 
			$data['room1'] = '2####0####0';
			#### FORMATTING DATE
			$data['tour_start_date'] = date("d-m-Y",strtotime($discountInfo['best_price_discount_date']));
			$data['best_price_discount_id'] = $discountInfo['best_price_discount_id'];
			
			
			$bestPriceList = $objCMSCost->getTourOneDayPriceRevised($data);
			
			
			#### FORMATTING DATE
			$data['tour_start_date'] = date("d-m-Y",strtotime($discountInfo['minimum_price_discount_date']));
			$data['best_price_discount_id'] = $discountInfo['minimum_price_discount_id'];

			$minimumPriceList = $objCMSCost->getTourOneDayPriceRevised($data);

			$revisedBestPrices = array();
			$highSeasonPrice = array();

			foreach($bestPriceList as $bestPrice)
			{
				if(in_array($bestPrice['hotel_type_id'], $post['hotel_type']))
				{
					$revisedBestPrices[] = $bestPrice;
				}
				else if($minimumPrice['hotel_type_id']=='land_price')
				{
					$revisedBestPrices[] = $bestPrice;
				}

				if($bestPrice['hotel_type_id']==$post['hotel_type_price'])
				{
					$highSeasonPrice = array(
												"high_season_price"				=>	str_replace(",", "",$bestPrice['profit_price']),
												"high_season_discount_price"	=>	str_replace(",", "",$bestPrice['discount_price'])
									);
				}
			}

			$revisedMinimumPrices = array();
			$lowSeasonPrice = array();

			foreach($minimumPriceList as $minimumPrice)
			{
				if(in_array($minimumPrice['hotel_type_id'], $post['hotel_type']))
				{
					$revisedMinimumPrices[] = $minimumPrice;
				}
				else if($minimumPrice['hotel_type_id']=='land_price')
				{
					$revisedMinimumPrices[] = $minimumPrice;
				}

				if($minimumPrice['hotel_type_id']==$post['hotel_type_price'])
				{
					$lowSeasonPrice = array(
												"low_season_price"				=>	str_replace(",", "",$minimumPrice['profit_price']),
												"low_season_discount_price"		=>	str_replace(",", "",$minimumPrice['discount_price'])
									);
				}
			}

			 $costList = array(
								"best_price"		=>	 $revisedBestPrices,
								"minimum_price"		=>	 $revisedMinimumPrices
						);
						
			
			
			 $priceList = array();
			 $priceList['tour_id'] = $data['tour_id'];
			 $priceList['tour_page_id'] = $pageId;
			 $priceList['currency_code'] = SELECTED_CURRENCY_CODE;
			 $priceList['low_season'] = $lowSeasonPrice;
			 $priceList['high_season'] = $highSeasonPrice;
			 $priceList['price_data'] = serialize($costList);
			 
			
			 $objCMSCost->updateTourPagePrice($priceList);

			$data=array(
							'message_type'	=>	'success',
							'message'	=>	'Tour page has been saved in the list.'
					);
			$this->createInformation($data);
			
			return true;
		}
		else
		{
			
			$data=array(
							'message_type'	=>	'warning',
							'message'	=>	'Tour page was not saved in the list. Please try again.'
					);
			$this->createInformation($data);
			
			return false;
		}

	} */



	function updateTourPageName($post, $files = array())
	{
		include_once(BASEPATH_CLASS . "cms-cost-class.php");
		include_once(BASEPATH_CLASS . "cms-tour-price-discount-dates-class.php");

		$tourId = isset($post['tour_id']) ? $post['tour_id'] : '';
		$tourPageId = isset($post['tour_page_id']) ? $post['tour_page_id'] : '';
		$title = isset($post['title']) ? $post['title'] : '';
		$page_url = isset($post['page_url']) ? $post['page_url'] : '';
		$tour_code = isset($post['tour_code']) ? $post['tour_code'] : '';
		$view_type = isset($post['view_type']) ? $post['view_type'] : 'day_view';
		$price_display = (isset($post['price_display']) && $post['price_display'] == 'y') ? 'y' : 'n';
		$hotel_type_price = isset($post['hotel_type_price']) ? $post['hotel_type_price'] : '';
		$meta_title = isset($post['meta_title']) ? $post['meta_title'] : '';
		$meta_keyword = isset($post['meta_keyword']) ? $post['meta_keyword'] : '';
		$meta_description = isset($post['meta_description']) ? $post['meta_description'] : '';
		$hotel_types = isset($post['hotel_type']) ? $post['hotel_type'] : array();

		// Optional fields
		$video = isset($post['video']) ? $post['video'] : '';
		$default_banner = isset($post['default_banner']) ? $post['default_banner'] : '';
		$canonical_url = isset($post['canonical_url']) ? $post['canonical_url'] : '';
		$og_title = isset($post['og_title']) ? $post['og_title'] : '';
		$og_keyword = isset($post['og_keyword']) ? $post['og_keyword'] : '';
		$og_description = isset($post['og_description']) ? $post['og_description'] : '';

		// Get city info for this tour
		$tourCities = $this->getTourDayListCityView($tourId);
		$cityList = array();
		foreach ($tourCities as $tourCity) {
			$cityList[] = array(
				"duration" => $tourCity['duration'],
				"city"     => $tourCity['city_name']
			);
		}
		$cityInfo = serialize($cityList);

		$objCMSCost = new CMSCost();
		$objCMSTourPriceDiscountDates = new CMSTourPriceDiscountDates();
		$objMysqli = $this->setDatabaseConnection();

		// Build update query for tbls_tour_pages
		if ($hotel_type_price !== '') {
			$strsqlPageName = "UPDATE tbls_tour_pages SET title='{$title}', page_url='{$page_url}', tour_code='{$tour_code}', price_display='{$price_display}', price_hotel_type_id='{$hotel_type_price}', view_type='{$view_type}' WHERE id={$tourPageId}";
		} else {
			$strsqlPageName = "UPDATE tbls_tour_pages SET title='{$title}', page_url='{$page_url}', tour_code='{$tour_code}', price_display='{$price_display}', view_type='{$view_type}' WHERE id={$tourPageId}";
		}

		$resultPageName = $objMysqli->query($strsqlPageName);
		if ($resultPageName) {
			$pageId = $tourPageId;
			$this->closeDBConnection($objMysqli);

			// Update tour page detail (image, etc.)
			$tourDetaildata = array(
				"tour_page_id"    => $pageId,
				"video"           => $video,
				"default_banner"  => $default_banner,
				"destinations"    => $cityInfo
			);
			$this->addTourPageDetail($tourDetaildata, $files);

			// Save Tour Overview
			$tour_overview = isset($post['tour_overview']) ? $post['tour_overview'] : '';
			$this->saveTourPageOverview($pageId, $tour_overview);

			// Update meta tags
			$tourPageMetadata = array(
				"tour_page_id"      => $pageId,
				"meta_title"        => $meta_title,
				"meta_keyword"      => $meta_keyword,
				"meta_description"  => $meta_description,
				"canonical_url"     => $canonical_url,
				"og_title"          => $og_title,
				"og_keyword"        => $og_keyword,
				"og_description"    => $og_description
			);
			$this->addTourPageMetaDescription($tourPageMetadata);

			// Update hotel types for this tour page
			$dataHotelFlush = array("tour_page_id" => $pageId);
			$this->flushAllTourPageHotel($dataHotelFlush);

			if (is_array($hotel_types)) {
				foreach ($hotel_types as $hotelType) {
					$dataHotelType = array(
						"tour_page_id"   => $pageId,
						"hotel_type_id"  => $hotelType
					);
					$this->addHotelTypes($dataHotelType);
				}
			}

			// Update price information
			$dataDiscountInfo = array();
			$dataDiscountInfo['tour_id'] = $tourId;
			$dataDiscountInfo['tour_page_id'] = $pageId;
			$discountInfo = $objCMSTourPriceDiscountDates->getTourDiscountDetail($dataDiscountInfo);

			$data = array();
			$roomsData = array();
			$roomsData[] = '2####0####0'; // For room price calculation
			$data['tour_id'] = $tourId;
			$data['vehicle_id'] = defined('VEHICLE_ID') ? VEHICLE_ID : '';
			$data['event_tax'] = defined('EVENT_TAX') ? EVENT_TAX : '';
			$data['vehicle_tax'] = defined('VEHICLE_TAX') ? VEHICLE_TAX : '';
			$data['mislaneous_cost_price'] = defined('MISLANEOUS_COST_PRICE') ? MISLANEOUS_COST_PRICE : '';
			$data['selected_currency_code'] = defined('SELECTED_CURRENCY_CODE') ? SELECTED_CURRENCY_CODE : '';
			$data['rooms'] = $roomsData;
			$data['number_of_room'] = '1';

			// High season
			$data['tour_start_date'] = isset($discountInfo['best_price_discount_date']) ? date("d-m-Y", strtotime($discountInfo['best_price_discount_date'])) : '';
			$data['best_price_discount_id'] = isset($discountInfo['best_price_discount_id']) ? $discountInfo['best_price_discount_id'] : '';
			
			$bestPriceList = $objCMSCost->getTourOneDayPriceRevised($data);

			// Low season
			$data['tour_start_date'] = isset($discountInfo['minimum_price_discount_date']) ? date("d-m-Y", strtotime($discountInfo['minimum_price_discount_date'])) : '';
			$data['best_price_discount_id'] = isset($discountInfo['minimum_price_discount_id']) ? $discountInfo['minimum_price_discount_id'] : '';
			$minimumPriceList = $objCMSCost->getTourOneDayPriceRevised($data);
			
			

			$revisedBestPrices = array();
			$highSeasonPrice = array();
			foreach ($bestPriceList as $bestPrice) {
				if (in_array($bestPrice['hotel_type_id'], $hotel_types)) {
					$revisedBestPrices[] = $bestPrice;
				} else if ($bestPrice['hotel_type_id'] == 'land_price') {
					$revisedBestPrices[] = $bestPrice;
				}
				if ($bestPrice['hotel_type_id'] == $hotel_type_price) {
					$highSeasonPrice = array(
						"high_season_price"         => str_replace(",", "", $bestPrice['profit_price']),
						"high_season_discount_price" => str_replace(",", "", $bestPrice['discount_price'])
					);
				}
			}

			$revisedMinimumPrices = array();
			$lowSeasonPrice = array();
			foreach ($minimumPriceList as $minimumPrice) {
				if (in_array($minimumPrice['hotel_type_id'], $hotel_types)) {
					$revisedMinimumPrices[] = $minimumPrice;
				} else if ($minimumPrice['hotel_type_id'] == 'land_price') {
					$revisedMinimumPrices[] = $minimumPrice;
				}
				if ($minimumPrice['hotel_type_id'] == $hotel_type_price) {
					$lowSeasonPrice = array(
						"low_season_price"          => str_replace(",", "", $minimumPrice['profit_price']),
						"low_season_discount_price" => str_replace(",", "", $minimumPrice['discount_price'])
					);
				}
			}

			$costList = array(
				"best_price"    => $revisedBestPrices,
				"minimum_price" => $revisedMinimumPrices
			);
			
			

			$priceList = array();
			$priceList['tour_id'] = $tourId;
			$priceList['tour_page_id'] = $pageId;
			$priceList['currency_code'] = defined('SELECTED_CURRENCY_CODE') ? SELECTED_CURRENCY_CODE : '';
			$priceList['low_season'] = $lowSeasonPrice;
			$priceList['high_season'] = $highSeasonPrice;
			$priceList['price_data'] = serialize($costList);

			$objCMSCost->updateTourPagePrice($priceList);

			// Success message
			$data = array(
				'message_type' => 'success',
				'message'      => 'Tour page has been saved in the list.'
			);
			$this->createInformation($data);
			return true;
		} else {
			// Failure message
			$data = array(
				'message_type' => 'warning',
				'message'      => 'Tour page was not saved in the list. Please try again.'
			);
			$this->createInformation($data);
			return false;
		}
	}


	/* function addNewPageName($post,$files=array())
	{
		
		include_once(BASEPATH_CLASS."cms-cost-class.php");
		include_once(BASEPATH_CLASS."cms-tour-price-discount-dates-class.php");

		$tourCities = $this->getTourDayListCityView($post['tour_id']);

		$cityList = array();
		foreach($tourCities as $tourCity)
		{
			$cityList[] = array(
									"duration"	=>		$tourCity['duration'],
									"city"		=>		$tourCity['city_name']
						);
		}
		
		$cityInfo = serialize($cityList);

		$objCMSCost = new CMSCost();
		$objCMSTourPriceDiscountDates = new CMSTourPriceDiscountDates();
		
		$objMysqli = $this->setDatabaseConnection();

		$priceDisplay = 'n';
		if((isset($post['price_display']))&&($post['price_display']!=""))
		{
			$priceDisplay = $post['price_display'];
		}
		
		if($post['price_date']!="")
		{
			$post['price_date'] = date("Y-m-d",strtotime($post['price_date']));
		}

		if($post['hotel_type_price']=="")
		{
			$post['hotel_type_price']='';
		}

		if($post['price']!=""&&$post['hotel_type_price']!="")
		{
			$strsqlPageName = "insert into tbls_tour_pages (tour_id, title, page_url, tour_code, price_display, price_hotel_type_id, view_type) values('".$post['tour_id']."','".$post['title']."','".$post['page_url']."','".$post['tour_code']."','".$priceDisplay."','".$post['hotel_type_price']."','".$post['view_type']."')";
		}
		else
		{
			$strsqlPageName = "insert into tbls_tour_pages (tour_id, title, page_url, tour_code, price_display, view_type) values('".$post['tour_id']."','".$post['title']."','".$post['page_url']."','".$post['tour_code']."','".$priceDisplay."','".$post['view_type']."')";
		}

		
	
		$resultPageName = $objMysqli->query($strsqlPageName);
		if($resultPageName)
		{
			$pageId = $objMysqli->insert_id;
			$this->closeDBConnection($objMysqli);

			#### SETTING TOUR DETAIL
			$tourDetaildata = array(
										"tour_page_id"				=>  $pageId,
										"video"						=>	$post['video'],
										"default_banner"			=>	$post['default_banner'],
										"destinations"				=>	$cityInfo
							);
			
			$this->addTourPageDetail($tourDetaildata,$files);

			#### SETTING META TAGS
			$tourPageMetadata = array(
											"tour_page_id"			=>		$pageId,
											"meta_title"			=>		$post['meta_title'],
											"meta_keyword"			=>		$post['meta_keyword'],
											"meta_description"		=>		$post['meta_description'],
											"canonical_url"			=>		$post['canonical_url'],
											"og_title"				=>		$post['og_title'],
											"og_keyword"			=>		$post['og_keyword'],
											"og_description"		=>		$post['og_description']
								);

			$this->addTourPageMetaDescription($tourPageMetadata);

			#### ADDING HOTEL TYPES FOR TOUR PAGE
			foreach($post['hotel_type'] as $hotelType)
			{
				$dataHotelType = array(
											"tour_page_id"		=>		$pageId,
											"hotel_type_id"		=>		$hotelType
								);
				$this->addHotelTypes($dataHotelType);
			}

			
			$dataDiscountInfo = array();
			$dataDiscountInfo['tour_id'] = $post['tour_id'];
			$dataDiscountInfo['tour_page_id'] = $pageId;
			$discountInfo = $objCMSTourPriceDiscountDates->getTourDiscountDetail($dataDiscountInfo);

			$data = array();

			$roomsData = array();
			$roomsData[]='2####0####0'; #### ADDED FOR ROOM PRICE CALCULATION
			$data['tour_id'] = $post['tour_id'];
			$data['vehicle_id'] = VEHICLE_ID;
			$data['event_tax'] = EVENT_TAX;
			$data['vehicle_tax'] = VEHICLE_TAX;
			$data['mislaneours_cost_price'] = MISLANEOUS_COST_PRICE;
			$data['selected_currency_code'] = SELECTED_CURRENCY_CODE;
			$data['rooms'] = $roomsData;
			$data['number_of_room']='1'; 
			#### FORMATTING DATE
			$data['tour_start_date'] = date("d-m-Y",strtotime($discountInfo['best_price_discount_date']));
			$data['best_price_discount_id'] = $discountInfo['best_price_discount_id'];

			$bestPriceList = $objCMSCost->getTourOneDayPriceRevised($data);
			
			#### FORMATTING DATE
			$data['tour_start_date'] = date("d-m-Y",strtotime($discountInfo['minimum_price_discount_date']));
			$data['best_price_discount_id'] = $discountInfo['minimum_price_discount_id'];

			$minimumPriceList = $objCMSCost->getTourOneDayPriceRevised($data);

			$revisedBestPrices = array();
			$highSeasonPrice = array();

			foreach($bestPriceList as $bestPrice)
			{
				if(in_array($bestPrice['hotel_type_id'], $post['hotel_type']))
				{
					$revisedBestPrices[] = $bestPrice;
				}
				else if($minimumPrice['hotel_type_id']=='land_price')
				{
					$revisedBestPrices[] = $bestPrice;
				}

				if($bestPrice['hotel_type_id']==$post['hotel_type_price'])
				{
					$highSeasonPrice = array(
												"high_season_price"				=>	str_replace(",", "",$bestPrice['profit_price']),
												"high_season_discount_price"	=>	str_replace(",", "",$bestPrice['discount_price'])
									);
				}
			}

			$revisedMinimumPrices = array();
			$lowSeasonPrice = array();

			foreach($minimumPriceList as $minimumPrice)
			{
				if(in_array($minimumPrice['hotel_type_id'], $post['hotel_type']))
				{
					$revisedMinimumPrices[] = $minimumPrice;
				}
				else if($minimumPrice['hotel_type_id']=='land_price')
				{
					$revisedMinimumPrices[] = $minimumPrice;
				}

				if($minimumPrice['hotel_type_id']==$post['hotel_type_price'])
				{
					$lowSeasonPrice = array(
												"low_season_price"				=>	str_replace(",", "",$minimumPrice['profit_price']),
												"low_season_discount_price"		=>	str_replace(",", "",$minimumPrice['discount_price'])
									);
				}
			}

			 $costList = array(
								"best_price"		=>	 $revisedBestPrices,
								"minimum_price"		=>	 $revisedMinimumPrices
						);

			
			 $priceList = array();
			 $priceList['tour_id'] = $data['tour_id'];
			 $priceList['tour_page_id'] = $pageId;
			 $priceList['currency_code'] = SELECTED_CURRENCY_CODE;
			 $priceList['low_season'] = $lowSeasonPrice;
			 $priceList['high_season'] = $highSeasonPrice;
			 $priceList['price_data'] = serialize($costList);

			 $objCMSCost->updateTourPagePrice($priceList);

			$data=array(
							'message_type'	=>	'success',
							'message'	=>	'Tour page has been saved in the list.'
					);
			$this->createInformation($data);
			
			return true;
		}
		else
		{
			
			$data=array(
							'message_type'	=>	'warning',
							'message'	=>	'Tour page was not saved in the list. Please try again.'
					);
			$this->createInformation($data);
			
			return false;
		}

	} */



	function addNewPageName($post, $files = array())
	{
		include_once(BASEPATH_CLASS . "cms-cost-class.php");
		include_once(BASEPATH_CLASS . "cms-tour-price-discount-dates-class.php");

		$tourId = isset($post['tour_id']) ? $post['tour_id'] : '';
		$title = isset($post['title']) ? $post['title'] : '';
		$page_url = isset($post['page_url']) ? $post['page_url'] : '';
		$tour_code = isset($post['tour_code']) ? $post['tour_code'] : '';
		$view_type = isset($post['view_type']) ? $post['view_type'] : 'day_view';
		$price_display = (isset($post['price_display']) && $post['price_display'] == 'y') ? 'y' : 'n';
		$hotel_type_price = isset($post['hotel_type_price']) ? $post['hotel_type_price'] : '';
		$meta_title = isset($post['meta_title']) ? $post['meta_title'] : '';
		$meta_keyword = isset($post['meta_keyword']) ? $post['meta_keyword'] : '';
		$meta_description = isset($post['meta_description']) ? $post['meta_description'] : '';
		$hotel_types = isset($post['hotel_type']) ? $post['hotel_type'] : array();

		// Optional fields (not present in add form, but handled for compatibility)
		$video = isset($post['video']) ? $post['video'] : '';
		$default_banner = isset($post['default_banner']) ? $post['default_banner'] : '';
		$canonical_url = isset($post['canonical_url']) ? $post['canonical_url'] : '';
		$og_title = isset($post['og_title']) ? $post['og_title'] : '';
		$og_keyword = isset($post['og_keyword']) ? $post['og_keyword'] : '';
		$og_description = isset($post['og_description']) ? $post['og_description'] : '';

		// Get city info for this tour
		$tourCities = $this->getTourDayListCityView($tourId);
		$cityList = array();
		foreach ($tourCities as $tourCity) {
			$cityList[] = array(
				"duration" => $tourCity['duration'],
				"city"     => $tourCity['city_name']
			);
		}
		$cityInfo = serialize($cityList);

		$objCMSCost = new CMSCost();
		$objCMSTourPriceDiscountDates = new CMSTourPriceDiscountDates();
		$objMysqli = $this->setDatabaseConnection();

		// Build insert query for tbls_tour_pages
		if ($hotel_type_price !== '') {
			$strsqlPageName = "INSERT INTO tbls_tour_pages (tour_id, title, page_url, tour_code, price_display, price_hotel_type_id, view_type)
            VALUES ('{$tourId}', '{$title}', '{$page_url}', '{$tour_code}', '{$price_display}', '{$hotel_type_price}', '{$view_type}')";
		} else {
			$strsqlPageName = "INSERT INTO tbls_tour_pages (tour_id, title, page_url, tour_code, price_display, view_type)
            VALUES ('{$tourId}', '{$title}', '{$page_url}', '{$tour_code}', '{$price_display}', '{$view_type}')";
		}

		$resultPageName = $objMysqli->query($strsqlPageName);
		if ($resultPageName) {
			$pageId = $objMysqli->insert_id;
			$this->closeDBConnection($objMysqli);

			// Add tour page detail (image, etc.)
			$tourDetaildata = array(
				"tour_page_id"    => $pageId,
				"video"           => $video,
				"default_banner"  => $default_banner,
				"destinations"    => $cityInfo
			);
			$this->addTourPageDetail($tourDetaildata, $files);

			// Save Tour Overview
			$tour_overview = isset($post['tour_overview']) ? $post['tour_overview'] : '';
			$this->saveTourPageOverview($pageId, $tour_overview);

			// Add meta tags
			$tourPageMetadata = array(
				"tour_page_id"      => $pageId,
				"meta_title"        => $meta_title,
				"meta_keyword"      => $meta_keyword,
				"meta_description"  => $meta_description,
				"canonical_url"     => $canonical_url,
				"og_title"          => $og_title,
				"og_keyword"        => $og_keyword,
				"og_description"    => $og_description
			);
			$this->addTourPageMetaDescription($tourPageMetadata);

			// Add hotel types for this tour page
			if (is_array($hotel_types)) {
				foreach ($hotel_types as $hotelType) {
					$dataHotelType = array(
						"tour_page_id"   => $pageId,
						"hotel_type_id"  => $hotelType
					);
					$this->addHotelTypes($dataHotelType);
				}
			}

			// Add price information (if needed)
			$dataDiscountInfo = array();
			$dataDiscountInfo['tour_id'] = $tourId;
			$dataDiscountInfo['tour_page_id'] = $pageId;
			$discountInfo = $objCMSTourPriceDiscountDates->getTourDiscountDetail($dataDiscountInfo);

			$data = array();
			$roomsData = array();
			$roomsData[] = '2####0####0'; // For room price calculation
			$data['tour_id'] = $tourId;
			$data['vehicle_id'] = defined('VEHICLE_ID') ? VEHICLE_ID : '';
			$data['event_tax'] = defined('EVENT_TAX') ? EVENT_TAX : '';
			$data['vehicle_tax'] = defined('VEHICLE_TAX') ? VEHICLE_TAX : '';
			$data['mislaneours_cost_price'] = defined('MISLANEOUS_COST_PRICE') ? MISLANEOUS_COST_PRICE : '';
			$data['selected_currency_code'] = defined('SELECTED_CURRENCY_CODE') ? SELECTED_CURRENCY_CODE : '';
			$data['rooms'] = $roomsData;
			$data['number_of_room'] = '1';

			// High season
			$data['tour_start_date'] = isset($discountInfo['best_price_discount_date']) ? date("d-m-Y", strtotime($discountInfo['best_price_discount_date'])) : '';
			$data['best_price_discount_id'] = isset($discountInfo['best_price_discount_id']) ? $discountInfo['best_price_discount_id'] : '';
			$bestPriceList = $objCMSCost->getTourOneDayPriceRevised($data);

			// Low season
			$data['tour_start_date'] = isset($discountInfo['minimum_price_discount_date']) ? date("d-m-Y", strtotime($discountInfo['minimum_price_discount_date'])) : '';
			$data['best_price_discount_id'] = isset($discountInfo['minimum_price_discount_id']) ? $discountInfo['minimum_price_discount_id'] : '';
			$minimumPriceList = $objCMSCost->getTourOneDayPriceRevised($data);
		
			$revisedBestPrices = array();
			$highSeasonPrice = array();
			foreach ($bestPriceList as $bestPrice) {
				if (in_array($bestPrice['hotel_type_id'], $hotel_types)) {
					$revisedBestPrices[] = $bestPrice;
				} else if ($bestPrice['hotel_type_id'] == 'land_price') {
					$revisedBestPrices[] = $bestPrice;
				}
				if ($bestPrice['hotel_type_id'] == $hotel_type_price) {
					$highSeasonPrice = array(
						"high_season_price"         => str_replace(",", "", $bestPrice['profit_price']),
						"high_season_discount_price" => str_replace(",", "", $bestPrice['discount_price'])
					);
				}
			}

			$revisedMinimumPrices = array();
			$lowSeasonPrice = array();
			foreach ($minimumPriceList as $minimumPrice) {
				if (in_array($minimumPrice['hotel_type_id'], $hotel_types)) {
					$revisedMinimumPrices[] = $minimumPrice;
				} else if ($minimumPrice['hotel_type_id'] == 'land_price') {
					$revisedMinimumPrices[] = $minimumPrice;
				}
				if ($minimumPrice['hotel_type_id'] == $hotel_type_price) {
					$lowSeasonPrice = array(
						"low_season_price"          => str_replace(",", "", $minimumPrice['profit_price']),
						"low_season_discount_price" => str_replace(",", "", $minimumPrice['discount_price'])
					);
				}
			}

			$costList = array(
				"best_price"    => $revisedBestPrices,
				"minimum_price" => $revisedMinimumPrices
			);

			$priceList = array();
			$priceList['tour_id'] = $tourId;
			$priceList['tour_page_id'] = $pageId;
			$priceList['currency_code'] = defined('SELECTED_CURRENCY_CODE') ? SELECTED_CURRENCY_CODE : '';
			$priceList['low_season'] = $lowSeasonPrice;
			$priceList['high_season'] = $highSeasonPrice;
			$priceList['price_data'] = serialize($costList);

			$objCMSCost->updateTourPagePrice($priceList);

			// Success message
			$data = array(
				'message_type' => 'success',
				'message'      => 'Tour page has been saved in the list.'
			);
			$this->createInformation($data);
			return true;
		} else {
			// Failure message
			$data = array(
				'message_type' => 'warning',
				'message'      => 'Tour page was not saved in the list. Please try again.'
			);
			$this->createInformation($data);
			return false;
		}
	}

	private function saveTourPageOverview($tour_page_id, $overview)
	{
		$objMysqli = $this->setDatabaseConnection();
		$tour_page_id = intval($tour_page_id);
		$overview = $objMysqli->real_escape_string($overview);

		// Check if overview exists
		$sqlCheck = "SELECT id FROM tbls_tour_page_overviews WHERE tour_page_id = $tour_page_id";
		$result = $objMysqli->query($sqlCheck);

		if ($result && $result->num_rows > 0) {
			// Update
			$sql = "UPDATE tbls_tour_page_overviews SET description = '$overview' WHERE tour_page_id = $tour_page_id";
		} else {
			// Insert
			$sql = "INSERT INTO tbls_tour_page_overviews (tour_page_id, description) VALUES ($tour_page_id, '$overview')";
		}
		$objMysqli->query($sql);
		$this->closeDBConnection($objMysqli);
	}


	function addHotelTypes($data)
	{
		$objMysqli = $this->setDatabaseConnection();
		$strsqlPageHotelType = "insert into tbls_tour_pages_hotels ( tour_page_id, hotel_type_id) values(" . $data['tour_page_id'] . "," . $data['hotel_type_id'] . ")";
		$resultPageHotelType = $objMysqli->query($strsqlPageHotelType);
		$this->closeDBConnection($objMysqli);
		return $resultPageHotelType;
	}


	function flushAllTourPageHotel($data)
	{
		$objMysqli = $this->setDatabaseConnection();
		$strsqlPageHotelType = "delete from tbls_tour_pages_hotels where tour_page_id=" . $data['tour_page_id'];
		$resultPageHotelType = $objMysqli->query($strsqlPageHotelType);
		$this->closeDBConnection($objMysqli);
		return $resultPageHotelType;
	}

	function checkHotelType($data)
	{
		$objMysqli = $this->setDatabaseConnection();
		$strsqlPageHotelType = "select id from tbls_tour_pages_hotels where tour_page_id=" . $data['tour_page_id'] . " and hotel_type_id=" . $data['hotel_type_id'];
		$resultPageHotelType = $objMysqli->query($strsqlPageHotelType);
		if ($resultPageHotelType && $resultPageHotelType->num_rows >= 1) {
			$this->closeDBConnection($objMysqli);
			return true;
		} else {
			$this->closeDBConnection($objMysqli);
			return false;
		}
	}

	function deleteTourPage($data)
	{
		$objMysqli = $this->setDatabaseConnection();

		$strsqlTourPage = "delete from tbls_tour_pages where id=" . $data['tour_page_id'];
		$resultTourPage = $objMysqli->query($strsqlTourPage);

		$strsqlTourPageDesc = "delete from  tbls_tour_page_description where tour_page_id=" . $data['tour_page_id'];
		$resultTourPageDesc = $objMysqli->query($strsqlTourPageDesc);

		$strsqlPageHotelType = "delete from tbls_tour_pages_hotels where tour_page_id=" . $data['tour_page_id'];
		$resultPageHotelType = $objMysqli->query($strsqlPageHotelType);

		$this->closeDBConnection($objMysqli);
		return $resultPageHotelType;
	}

	function deleteAllTourPageHotel($data)
	{
		$objMysqli = $this->setDatabaseConnection();
		$strsqlPageHotelType = "delete from tbls_tour_pages_hotels where tour_page_id=" . $data['tour_page_id'];
		$resultPageHotelType = $objMysqli->query($strsqlPageHotelType);
		$this->closeDBConnection($objMysqli);
		return $resultPageHotelType;
	}

	function addTourPageMetaDescription($data = array())
	{
		$tourPageId = $data['tour_page_id'];

		$metaTitle = $data['meta_title'];
		$metaKeyword = $data['meta_keyword'];
		$metaDescription = $data['meta_description'];
		$canonicalUrl = $data['canonical_url'];
		$ogTitle = ($data['og_title'] != "") ? $data['og_title'] : $data['meta_title'];
		$ogKeyword = ($data['og_keyword'] != "") ? $data['og_keyword'] : $data['meta_keyword'];
		$ogDescription = ($data['og_description'] != "") ? $data['og_description'] : $data['meta_description'];

		$pageMetaDescId = $this->checkPageMetaDescription($tourPageId);
		$objMysqli = $this->setDatabaseConnection();
		if ($pageMetaDescId) {
			$strsqlMetaDesc = "update tbls_tour_page_meta_description set meta_title='" . $metaTitle . "', meta_keyword='" . $metaKeyword . "', meta_description='" . $metaDescription . "' where id=" . $pageMetaDescId;
		} else {
			$strsqlMetaDesc = "insert into tbls_tour_page_meta_description (tour_page_id, meta_title, meta_keyword, meta_description) values('" . $tourPageId . "','" . $metaTitle . "','" . $metaKeyword . "','" . $metaDescription . "')";
		}

		$resultMetaDesc = $objMysqli->query($strsqlMetaDesc);
		$this->closeDBConnection($objMysqli);
		return $resultMetaDesc;
	}

	function checkPageMetaDescription($tourPageId)
	{
		$objMysqli = $this->setDatabaseConnection();
		$strsqlMetaDesc = "select id from tbls_tour_page_meta_description where tour_page_id =" . $tourPageId;
		$resultMetaDesc = $objMysqli->query($strsqlMetaDesc);
		if ($resultMetaDesc && $resultMetaDesc->num_rows < 1) {
			$this->closeDBConnection($objMysqli);
			return false;
		}
		$infoMetaDesc = $resultMetaDesc->fetch_array(MYSQLI_ASSOC);
		$this->closeDBConnection($objMysqli);
		return $infoMetaDesc['id'];
	}



	function addTourPageDetail($data, $files = array())
	{
      
      	$data['default_banner'] = 'image';//avoid error-- empty not supported

		$imageName = "";
		$imageThumbnailName = "";

		if ((isset($files['image']['name'])) && ($files['image']['name'] != "")) {
			$allowedExtension = array("jpg", "jpeg", "JPEG", "JPG", "png", "gif", "webp", "WEBP", "avif", "AVIF");
			$location = "tours/";
			$repositeryPath = WEBSITE_IMAGE_FOLDER;
			$imageData = array(
				"allowedExtension"		=>		$allowedExtension,
				"location"				=>		$location,
				"repositeryPath"		=>		$repositeryPath
			);

			$imageName = $this->uploadFileToLocation($files['image'], $imageData);
		}

		if ((isset($files['thumbnail']['name'])) && ($files['thumbnail']['name'] != "")) {
			$allowedThumbnailExtension = array("jpg", "jpeg", "JPEG", "JPG", "png", "gif", "webp", "WEBP", "avif", "AVIF");
			$locationThumbnail = "tours/";
			$repositeryThumbnailPath = WEBSITE_IMAGE_FOLDER;
			$imageThumbnailData = array(
				"allowedExtension"		=>		$allowedThumbnailExtension,
				"location"				=>		$locationThumbnail,
				"repositeryPath"		=>		$repositeryThumbnailPath
			);



			$imageThumbnailName = $this->uploadFileToLocation($files['thumbnail'], $imageThumbnailData);
		}

		$tourPageDescId = $this->checkTourPageDetail($data['tour_page_id']);

		if ($tourPageDescId) {

			$strsqlTourPageDesc = "update tbls_tour_page_description set";

			if ($imageName != "") {

				$strsqlTourPageDesc = $strsqlTourPageDesc . " image='" . $imageName . "', ";
			}

			if ($imageThumbnailName != "") {

				$strsqlTourPageDesc = $strsqlTourPageDesc . " thumbnail='" . $imageThumbnailName . "', ";
			}

			$strsqlTourPageDesc = $strsqlTourPageDesc . " video='" . $data['video'] . "', default_banner='" . $data['default_banner'] . "', destinations='" . $data['destinations'] . "' where id=" . $tourPageDescId;
		} else {
			if ($imageName != "" || $imageThumbnailName != "") {
				$strsqlTourPageDesc = "insert into tbls_tour_page_description ( tour_page_id, image, video, default_banner, destinations) values('" . $data['tour_page_id'] . "','" . $imageName . "','" . $data['video'] . "','" . $data['default_banner'] . "','" . $data['destinations'] . "')";
			} else {
				$strsqlTourPageDesc = "insert into tbls_tour_page_description ( tour_page_id, video, default_banner, destinations) values('" . $data['tour_page_id'] . "','" . $data['video'] . "','" . $data['default_banner'] . "','" . $data['destinations'] . "')";
			}
		}

     // echo $strsqlTourPageDesc;exit;

		$objMysqli = $this->setDatabaseConnection();
		$resultTourPageDesc = $objMysqli->query($strsqlTourPageDesc);
		$this->closeDBConnection($objMysqli);

		return $resultTourPageDesc;
	}

	function checkTourPageDetail($tourPageId)
	{
		$objMysqli = $this->setDatabaseConnection();
		$strsqlTourPageDesc = "select id from tbls_tour_page_description where tour_page_id =" . $tourPageId;
		$resultTourPageDesc = $objMysqli->query($strsqlTourPageDesc);
		if ($resultTourPageDesc && $resultTourPageDesc->num_rows < 1) {
			return false;
		}
		$infoTourPageDesc = $resultTourPageDesc->fetch_array(MYSQLI_ASSOC);
		$this->closeDBConnection($objMysqli);
		return $infoTourPageDesc['id'];
	}


	function getTourPageNameDetailById($data)
	{
		$objMysqli = $this->setMysqliConnection();
		$strsqlPageName = "select * from tbls_tour_pages where id =" . $data['tour_page_id'];
		$objResultPageName = $objMysqli->query($strsqlPageName);
		$infoPageName = $objResultPageName->fetch_array(MYSQLI_ASSOC);
		$this->closeMysqliConnection($objMysqli);

		return $infoPageName;
	}

	function getTourPageNameById($tourPageId)
	{

		$objMysqli = $this->setMysqliConnection();
		$strsqlPageName = "select title from tbls_tour_pages where id =" . $tourPageId;
		$resultPageName = $objMysqli->query($strsqlPageName);
		$infoPageName = $resultPageName->fetch_array(MYSQLI_ASSOC);
		$this->closeMysqliConnection($objMysqli);
		return $infoPageName['title'];
	}


	/*function updateTourPageName($post,$files)
	{
		echo "<pre>";
		print_r($files);
		echo "</pre>";
		
		include_once(BASEPATH_CLASS."cms-cost-class.php");
		include_once(BASEPATH_CLASS."cms-tour-price-discount-dates-class.php");
		
		$objCMSCost = new CMSCost();
		$objCMSTourPriceDiscountDates = new CMSTourPriceDiscountDates();

		$tourCities = $this->getTourDayListCityView($post['tour_id']);

		$cityList = array();
		foreach($tourCities as $tourCity)
		{
			$cityList[] = array(
									"duration"	=>		$tourCity['duration'],
									"city"		=>		$tourCity['city_name']
						);
		}
		
		$cityInfo = serialize($cityList);

		
		
		$this->setDatabaseConnection();

		$priceDisplay = 'n';
		if((isset($post['price_display']))&&($post['price_display']!=""))
		{
			$priceDisplay = $post['price_display'];
		}
		
		if($post['price_date']!="")
		{
			$post['price_date'] = date("Y-m-d",strtotime($post['price_date']));
		}

		if($post['hotel_type_price']<1)
		{
			$post['hotel_type_price']='';
			$post['price'] = '';
		}

		if($post['hotel_type_price']!="")
		{
			
			$strsqlPageName = "update tbls_tour_pages set title='".$post['title']."', page_url='".$post['page_url']."', tour_code='".$post['tour_code']."', price_display='".$priceDisplay."', price_hotel_type_id='".$post['hotel_type_price']."' where id=".$post['tour_page_id'];
		}
		else if(post['price_hotel_type_id']=="")
		{
			
			$strsqlPageName = "update tbls_tour_pages set title='".$post['title']."', page_url='".$post['page_url']."', tour_code='".$post['tour_code']."', price_display='".$priceDisplay."', price_hotel_type_id='0' where id=".$post['tour_page_id'];
		}
		else if($post['price']=="")
		{
			
			$strsqlPageName = "update tbls_tour_pages set title='".$post['title']."', page_url='".$post['page_url']."', tour_code='".$post['tour_code']."', price_display='".$priceDisplay."', price_hotel_type_id='0', price_date='".$post['price_date']."' where id=".$post['tour_page_id'];
		}
		else if($post['price_hotel_type_id']=="")
		{
			
			$strsqlPageName = "update tbls_tour_pages set title='".$post['title']."', page_url='".$post['page_url']."', tour_code='".$post['tour_code']."', price_display='".$priceDisplay."', price_date='".$post['price_date']."', price='".$post['price']."' where id=".$post['tour_page_id'];
		}

		$resultPageName = mysql_query($strsqlPageName);
		if($resultPageName)
		{
			
			$pageId = $post['tour_page_id'];
			$this->closeDBConnection();

			#### SETTING TOUR DETAIL
			$tourDetaildata = array(
										"tour_page_id"				=>  $pageId,
										"video"						=>	$post['video'],
										"default_banner"			=>	$post['default_banner'],
										"destinations"				=>	$cityInfo
							);
			
			$this->addTourPageDetail($tourDetaildata,$files);

			#### SETTING META TAGS
			$tourPageMetadata = array(
											"tour_page_id"			=>		$pageId,
											"meta_title"			=>		$post['meta_title'],
											"meta_keyword"			=>		$post['meta_keyword'],
											"meta_description"		=>		$post['meta_description'],
											"canonical_url"			=>		$post['canonical_url'],
											"og_title"				=>		$post['og_title'],
											"og_keyword"			=>		$post['og_keyword'],
											"og_description"		=>		$post['og_description']
								);

			$this->addTourPageMetaDescription($tourPageMetadata);

			#### ADDING HOTEL TYPES FOR TOUR PAGE
			$dataDelHotelType = array(
											"tour_page_id"		=>	$pageId
								);
			$this->deleteAllTourPageHotel($dataDelHotelType);

			foreach($post['hotel_type'] as $hotelType)
			{
				$dataHotelType = array(
											"tour_page_id"		=>		$pageId,
											"hotel_type_id"		=>		$hotelType
								);
				$this->addHotelTypes($dataHotelType);
			}*/

	/********** SPACE TO ADD PRICE STARTS HERE  *************/

	/*$dataDiscountInfo = array();
			$dataDiscountInfo['tour_id'] = $post['tour_id'];
			$dataDiscountInfo['tour_page_id'] = $pageId;

			$discountInfo = $objCMSTourPriceDiscountDates->getTourDiscountDetail($dataDiscountInfo);



			$data = array();

			$roomsData = array();
			$roomsData[]='2####0####0'; #### ADDED FOR ROOM PRICE CALCULATION
			$data['tour_id'] = $post['tour_id'];
			$data['vehicle_id'] = VEHICLE_ID;
			$data['event_tax'] = EVENT_TAX;
			$data['vehicle_tax'] = VEHICLE_TAX;
			$data['mislaneours_cost_price'] = MISLANEOUS_COST_PRICE;
			$data['selected_currency_code'] = SELECTED_CURRENCY_CODE;
			$data['rooms'] = $roomsData;
			$data['number_of_room']='1'; 
			#### FORMATTING DATE
			$data['tour_start_date'] = date("d-m-Y",strtotime($discountInfo['best_price_discount_date']));
			$data['best_price_discount_id'] = $discountInfo['best_price_discount_id'];

			$bestPriceList = $objCMSCost->getTourOneDayPriceRevised($data);

			
			#### FORMATTING DATE
			$data['tour_start_date'] = date("d-m-Y",strtotime($discountInfo['minimum_price_discount_date']));
			$data['best_price_discount_id'] = $discountInfo['minimum_price_discount_id'];

			$minimumPriceList = $objCMSCost->getTourOneDayPriceRevised($data);

			$revisedBestPrices = array();
			$highSeasonPrice = array();

			foreach($bestPriceList as $bestPrice)
			{
				
				if(in_array($bestPrice['hotel_type_id'], $post['hotel_type']))
				{
					
					$revisedBestPrices[] = $bestPrice;
				}
				else if($bestPrice['hotel_type_id']=='land_price')
				{
					$revisedBestPrices[] = $bestPrice;
				}

				if($bestPrice['hotel_type_id']==$post['hotel_type_price'])
				{
					$highSeasonPrice = array(
												"high_season_price"				=>	str_replace(",", "",$bestPrice['profit_price']),
												"high_season_discount_price"	=>	str_replace(",", "",$bestPrice['discount_price'])
									);
				}
			}

		

			$revisedMinimumPrices = array();
			$lowSeasonPrice = array();

			foreach($minimumPriceList as $minimumPrice)
			{
				if(in_array($minimumPrice['hotel_type_id'], $post['hotel_type']))
				{
					$revisedMinimumPrices[] = $minimumPrice;
				}
				else if($minimumPrice['hotel_type_id']=='land_price')
				{
					$revisedMinimumPrices[] = $minimumPrice;
				}

				if($minimumPrice['hotel_type_id']==$post['hotel_type_price'])
				{
					$lowSeasonPrice = array(
												"low_season_price"				=>	str_replace(",", "",$minimumPrice['profit_price']),
												"low_season_discount_price"		=>	str_replace(",", "",$minimumPrice['discount_price'])
									);
				}
			}

			
			 $costList = array(
								"best_price"		=>	 $revisedBestPrices,
								"minimum_price"		=>	 $revisedMinimumPrices
						);

			 
			 $priceList = array();
			 $priceList['tour_id'] = $data['tour_id'];
			 $priceList['tour_page_id'] = $pageId;
			 $priceList['currency_code'] = SELECTED_CURRENCY_CODE;
			 $priceList['low_season'] = $lowSeasonPrice;
			 $priceList['high_season'] = $highSeasonPrice;
			 $priceList['price_data'] = serialize($costList);

			 $objCMSCost->updateTourPagePrice($priceList);*/




	/********** SPACE TO ADD PRICE ENDS HERE  *************/

	/*	$data=array(
							'message_type'	=>	'success',
							'message'	=>	'Tour page has been saved in the list.'
					);
			$this->createInformation($data);
			return true;
		}
		else
		{
			
			$data=array(
							'message_type'	=>	'warning',
							'message'	=>	'Tour page was not saved in the list. Please try again.'
					);
			$this->createInformation($data);
			$this->closeDBConnection();
			return false;
		}

	}*/

	function getTourCategoryList($tourPageId)
	{
		$objMysqli = $this->setDatabaseConnection();
	}

	function getAllTourPageNameByTourId($data)
	{

		$objMysqli = $this->setDatabaseConnection();
		$strsqlPageName = "select * from tbls_tour_pages where tour_id =" . $data['tour_id'] . " order by title ";
		$resultPageName = $objMysqli->query($strsqlPageName);
		$pageNameList = array();
		while ($infoPageName = $resultPageName->fetch_array(MYSQLI_ASSOC)) {

			$pageNameList[] = $infoPageName;
		}

		$this->closeDBConnection($objMysqli);
		return $pageNameList;
	}

	function getTourPageDescriptionByTourPageId($tourPageId)
	{
		$objMysqli = $this->setDatabaseConnection();
		$strsqlTourPageDesc = "select * from tbls_tour_page_description where tour_page_id =" . $tourPageId;
		$resultTourPageDesc = $objMysqli->query($strsqlTourPageDesc);
		$infoTourPageDesc = $resultTourPageDesc->fetch_array(MYSQLI_ASSOC);
		$this->closeDBConnection($objMysqli);
		return $infoTourPageDesc;
	}

	function getTourPageOverviewByTourPageId($tourPageId)
	{
		$objMysqli = $this->setDatabaseConnection();
		$strsqlTourPageOverview = "select * from tbls_tour_page_overviews where tour_page_id =" . $tourPageId;
		$resultTourPageOverview = $objMysqli->query($strsqlTourPageOverview);
		$infoTourPageOverview = $resultTourPageOverview->fetch_array(MYSQLI_ASSOC);
		$this->closeDBConnection($objMysqli);
		return $infoTourPageOverview;
	}

	function getTourPageMetaDescriptionByTourPageId($tourPageId)
	{
		$objMysqli = $this->setDatabaseConnection();
		$strsqlTourPageMetaDesc = "select * from tbls_tour_page_meta_description where tour_page_id =" . $tourPageId;
		$resultTourPageMetaDesc = $objMysqli->query($strsqlTourPageMetaDesc);
		$infoTourPageMetaDesc = $resultTourPageMetaDesc->fetch_array(MYSQLI_ASSOC);
		$this->closeDBConnection($objMysqli);
		return $infoTourPageMetaDesc;
	}

	function getTourIdByTourPageURL($tourPageUrl)
	{
		$objMysqli = $this->setMysqliConnection();
		$strsqlTourPageDesc = "select * from tbls_tour_pages where page_url ='" . $tourPageUrl . "'";
		$objResultTourPageDesc = $objMysqli->query($strsqlTourPageDesc);
		$infoTourPageDesc = $objResultTourPageDesc->fetch_array(MYSQLI_ASSOC);
		$this->closeMysqliConnection($objMysqli);
		return $infoTourPageDesc;
	}

	function getTourPageByTourCode($tourCode)
	{
		$objMysqli = $this->setMysqliConnection();
		$strsqlTourPageDesc = "select * from tbls_tour_pages where tour_code ='" . $tourCode . "'";
		$objResultTourPageDesc = $objMysqli->query($strsqlTourPageDesc);
		$infoTourPageDesc = $objResultTourPageDesc->fetch_array(MYSQLI_ASSOC);
		$this->closeMysqliConnection($objMysqli);
		return $infoTourPageDesc;
	}

	function getTourPageHotelGroups($tourPageId, $tourDuration)
	{
		$tourPageData = array(
			"tour_page_id"	=>	$tourPageId
		);
		$tourPageDetail = $this->getTourPageNameDetailById($tourPageData);

		$objMysqli = $this->setMysqliConnection();

		$strsqlHotelGroup = "select * from cms_hotel_group where tour_id=" . $tourPageDetail['tour_id'] . " and hotel_type in (select hotel_type_id from tbls_tour_pages_hotels where tour_page_id=" . $tourPageId . ") order by order_sequence asc";
		$objResultHotelGroup = $objMysqli->query($strsqlHotelGroup);

		$hotelGroupList = array();
		while ($infoHotelGroup = $objResultHotelGroup->fetch_array(MYSQLI_ASSOC)) {
			#### GETING HOTEL TYPE INFORMATION
			$strsqlHotelType = "select * from tbls_hotel_type where id=" . $infoHotelGroup['hotel_type'];
			$objResultHotelType = $objMysqli->query($strsqlHotelType);
			$infoHotelType = $objResultHotelType->fetch_array(MYSQLI_ASSOC);

			$dayInformation = array();
			for ($i = 1; $i < $tourDuration; $i++) {
				$strsqlTourHotels = "select * from cms_tour_hotel where group_id=" . $infoHotelGroup['id'] . " and day_count=" . $i;
				$objResultTourHotels = $objMysqli->query($strsqlTourHotels);

				$dayHotelList = array();
				while ($infoTourHotels = $objResultTourHotels->fetch_array(MYSQLI_ASSOC)) {

					$cityId = $infoTourHotels['city_id'];
					$dayHotelList[] = array(
						"id"		=>		$infoTourHotels['id'],
						"hotel_id"	=>		$infoTourHotels['hotel_id'],
						"day_count"	=>		$infoTourHotels['day_count'],
						"room_id"	=>		$infoTourHotels['room_id']
					);
				}

				$strsqlCity = "select * from tbls_city where id=" . $cityId;
				$objResultCity = $objMysqli->query($strsqlCity);
				$infoCity = $objResultCity->fetch_array(MYSQLI_ASSOC);

				$dayInformation[] = array(
					"day_count"		=>		$i,
					"city_name"		=>		$infoCity['city_name'],
					"city_id"		=>		$infoCity['id'],
					"hotel_list"	=>		$dayHotelList
				);
			}

			$hotelGroupList[] = array(
				"group_id"				=>		$infoHotelGroup['id'],
				"hotel_type_id"			=>		$infoHotelType['id'],
				"hotel_type_name"		=>		$infoHotelType['hotel_type'],
				"hotel_alias_name"		=>		$infoHotelType['hotel_alias'],
				"hotel_rating"			=>		$infoHotelType['rating'],
				"hotels"				=>		$dayInformation
			);
		}

		$this->closeMysqliConnection($objMysqli);
		return $hotelGroupList;

		//$strsqlTour
	}
}
