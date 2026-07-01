<?php
class ManageTour
{
	function copyExistingTourByIds($post)
	{
		$tourIds=implode(",",$post['ids']);
		$strsqlTourData = "select * from tbl_managetour where id in (".$tourIds.")";

		$resultTourData = mysql_query($strsqlTourData);
		$insertedIds=array();
		while($infoTourData=mysql_fetch_array($resultTourData,MYSQL_ASSOC))
		{
			
			/* $strsqlTour ="insert into tbl_managetour(tour_url, tour_name, tour_title, meta_description, meta_keyword, tour_price,  	tour_description, tour_type, tour_duraction, tour_image, areas, site_active, series, internal_airprice, route, offer, offer_date, tour_category, zoom_level, center_lat,  group_remarks, private_remarks, tour_order, temp) values('".$infoTourData['tour_url']."','".$infoTourData['tour_name']."','".$infoTourData['tour_title']."','".$infoTourData['meta_description']."','".$infoTourData['meta_keyword']."','".$infoTourData['tour_price']."','".addslashes($infoTourData['tour_description'])."','".$infoTourData['tour_type']."','".$infoTourData['tour_duraction']."','".$infoTourData['tour_image']."','".$infoTourData['area']."','0','".$infoTourData['series']."','".$infoTourData['internal_airprice']."','".$infoTourData['route']."','".$infoTourData['offer']."','".$infoTourData['offer_date']."','".$infoTourData['tour_category']."','".$infoTourData['zoom_level']."','".$infoTourData['center_lat']."','".$infoTourData['center_lat']."','".$infoTourData['private_remarks']."','".$infoTourData['tour_order']."','1')";
			$result = mysql_query($strsqlTour) or die('error');*/

			 $strsqlTour ="insert into tbl_managetour(tour_url, tour_name, tour_title, meta_description, meta_keyword, tour_price,  	tour_description, tour_type, tour_duraction, tour_image, areas, site_active, series, internal_airprice, route, offer, offer_date, tour_category, zoom_level, group_remarks, private_remarks, tour_order, temp) values('".$infoTourData['tour_url']."','".$infoTourData['tour_name']."','".$infoTourData['tour_title']."','".$infoTourData['meta_description']."','".$infoTourData['meta_keyword']."','".$infoTourData['tour_price']."','".addslashes($infoTourData['tour_description'])."','".$infoTourData['tour_type']."','".$infoTourData['tour_duraction']."','".$infoTourData['tour_image']."','".$infoTourData['area']."','0','".$infoTourData['series']."','".$infoTourData['internal_airprice']."','".$infoTourData['route']."','".$infoTourData['offer']."','".$infoTourData['offer_date']."','".$infoTourData['tour_category']."','".$infoTourData['zoom_level']."','".$infoTourData['center_lat']."','".$infoTourData['private_remarks']."','".$infoTourData['tour_order']."','1')";
			 $result = mysql_query($strsqlTour) or die('error');
			 $newTourId = mysql_insert_id();
			 $insertedIds[]=$newTourId;

			 /*
				copying tbl_set_tour_data
			*/
			$strsqlSetTour = "select * from tbl_set_tour where tour_id=".$infoTourData['id'];
			$resultSetTour = mysql_query($strsqlSetTour);
			while($infoSetTour=mysql_fetch_array($resultSetTour,MYSQL_ASSOC))
			{
				$strsqlSetTourData = "insert into tbl_set_tour (day, tour_id, city_hotel, city_id1, city_id2, city_id3, hotel1, hotel2, hotel3, hotel4, hotel5, hotel6, hotel_facility1, hotel_facility2, hotel_facility3, subregion1, subregion2, subregion3, hotel_location, temp) values ('".$infoSetTour['day']."','".$newTourId."','".$infoSetTour['city_hotel']."','".$infoSetTour['city_id1']."','".$infoSetTour['city_id2']."','".$infoSetTour['city_id3']."','".$infoSetTour['hotel1']."','".$infoSetTour['hotel2']."','".$infoSetTour['hotel3']."','".$infoSetTour['hotel4']."','".$infoSetTour['hotel5']."','".$infoSetTour['hotel6']."','".$infoSetTour['hotel_facility1']."','".$infoSetTour['hotel_facility2']."','".$infoSetTour['hotel_facility3']."','".$infoSetTour['subregion1']."','".$infoSetTour['subregion2']."','".$infoSetTour['subregion3']."','".$infoSetTour['hotel_location']."','1')";
				mysql_query($strsqlSetTourData) or die('error in tbl_set_tour');

			}

			/*
				copying tbl_tour_price
			*/

			$strsqlTourPrice = "select * from tbl_tour_price where tour_id=".$infoTourData['id'];
			$resultTourPrice = mysql_query($strsqlTourPrice);
			while($infoTourPrice=mysql_fetch_array($resultTourPrice,MYSQL_ASSOC))
			{
				$strsqlTourPriceData = "insert into tbl_tour_price ( tour_id, tour_type, start_date, end_date, star3, star4, star5, status, price_status, temp) values('".$newTourId."','".$infoTourPrice['tour_type']."','".$infoTourPrice['start_date']."','".$infoTourPrice['end_date']."','".$infoTourPrice['star3']."','".$infoTourPrice['star4']."','".$infoTourPrice['star5']."','".$infoTourPrice['status']."','".$infoTourPrice['price_status']."','1')";
				mysql_query($strsqlTourPriceData) or die('error in tbl_tour_price');

			}

			/*
				copying tbl_map_order
			*/

			$strsqlMapOrder = "select * from tbl_map_order where tour_id=".$infoTourData['id'];
			$resultMapOrder = mysql_query($strsqlMapOrder);
			while($infoMapOrder=mysql_fetch_array($resultMapOrder,MYSQL_ASSOC))
			{
				$strsqlMapOrderData = "insert into tbl_map_order(tour_id, order_no, subregion_id,temp) values('".$newTourId."','".$infoMapOrder['order_no']."','".$infoMapOrder['subregion_id']."','1')";
				mysql_query($strsqlMapOrderData) or die('error in tbl_map_order');


			}

			/*
				copying tbl_set_inclusion_exclusion
			*/
			$strsqlInclusionExclusion = "select * from tbl_set_inclusion_exclusion where tour_id=".$infoTourData['id'];
			$resultInclusionExclusion = mysql_query($strsqlInclusionExclusion);
			while($infoInclusionexclusion=mysql_fetch_array($resultInclusionExclusion,MYSQL_ASSOC))
			{
				$strsqlIncExc = "insert into tbl_set_inclusion_exclusion (tour_id, inc_exc_id, order_no, temp) values('".$newTourId."','".$infoInclusionexclusion['inc_exc_id']."','".$infoInclusionexclusion['order_no']."','1')";
				mysql_query($strsqlIncExc) or die('error in tbl_set_inclusion_exclusion');

			}
			
		}
		return $insertedIds;
		
	}


	function saveCopiedTourById($tourId)
	{
		$updateCount=0;
		$strsqlManageTour = "update tbl_managetour set temp=0 where id=".$tourId;
		if(mysql_query($strsqlManageTour))
		{
			$updateCount++;
		}

		$strsqlSetTour = "update tbl_set_tour set temp=0 where tour_id=".$tourId;
		if(mysql_query($strsqlSetTour))
		{
			$updateCount++;
		}

		$strsqlTourPrice = "update tbl_tour_price set temp=0 where tour_id=".$tourId;
		if(mysql_query($strsqlTourPrice))
		{
			$updateCount++;
		}

		$strsqlMapOrder = "update tbl_map_order set temp=0 where tour_id=".$tourId;
		if(mysql_query($strsqlMapOrder))
		{
			$updateCount++;
		}

		$strsqlInclusion = "update tbl_set_inclusion_exclusion set temp=0 where tour_id=".$tourId;
		if(mysql_query($strsqlInclusion))
		{
			$updateCount++;
		}
		return $updateCount;

		

	}

	function flushCopiedTour()
	{
		$strsqlTourData = "select * from tbl_managetour where temp=1";
		$resultTourData = mysql_query($strsqlTourData);
		while($infoTourData=mysql_fetch_array($resultTourData,MYSQL_ASSOC))
		{
			$strsqlSetTour = "delete from tbl_set_tour where tour_id=".$infoTourData['id'];
			mysql_query($strsqlSetTour);
			
			$strsqlSetTour = "delete from tbl_tour_price where tour_id=".$infoTourData['id'];
			mysql_query($strsqlSetTour);

			$strsqlSetTour = "delete from tbl_map_order where tour_id=".$infoTourData['id'];
			mysql_query($strsqlSetTour);

			$strsqlSetTour = "delete from tbl_set_inclusion_exclusion where tour_id=".$infoTourData['id'];
			mysql_query($strsqlSetTour);

			$strsqlSetTour = "delete from tbl_managetour where id=".$infoTourData['id'];
			mysql_query($strsqlSetTour);

			echo "1";
		}
	}


	function getSearchText($searchText)
	{
		
		if(is_numeric($searchText))
		{
			$strsqlTourData="select id search_text from tbl_managetour where id='".$searchText."%'";
		}
		else
		{
			$strsqlTourData="select tour_name search_text from tbl_managetour where tour_name like '".$searchText."%'";
		}
		$resultTourData = mysql_query($strsqlTourData);
		while($infoTourData=mysql_fetch_array($resultTourData,MYSQL_ASSOC))
		{
			echo $infoTourData['search_text']."\r\n";
		}

	}


	function getAvailableTourId()
	{
		$strsqlTourData = "select max(id) maxId from tbl_managetour";
		$resultTourData = mysql_query($strsqlTourData);
		$infoTourData = mysql_fetch_array($resultTourData, MYSQL_ASSOC);

		$maxTourId = $infoTourData['maxId'];

		$strsqlAvailableTour = "select id from tbl_managetour where id < ".$maxTourId;
		$resultAvailableTour = mysql_query($strsqlAvailableTour);
		$usedTourId=array();
		while($infoAvailableTour = mysql_fetch_array($resultAvailableTour,MYSQL_ASSOC))
		{
			$usedTourId[]=$infoAvailableTour['id'];

		}
		$availableTourId=array();
		for($i=1;$i<=$maxTourId;$i++)
		{
			if(!in_array($i,$usedTourId))
			{
				$availableTourId[]=$i;
			}
		}

		return $availableTourId;
	}

	function getTourInterest($tourId)
	{
		$strsqlTour = "select * from tbl_tour_interest where tour_id=".$tourId;
		$resultTour = mysql_query($strsqlTour);
		$infoTour = mysql_fetch_array($resultTour,MYSQL_ASSOC);
		return $infoTour;
	}

	function saveTourInterest($data, $tourId)
	{
		$strsqlCheckInterest = "select id from tbl_tour_interest where tour_id=".$tourId;
		$resultCheckInterest = mysql_query($strsqlCheckInterest);
		if(mysql_num_rows($resultCheckInterest)>=1)
		{
			$strsqlInterest = "update tbl_tour_interest set adventure_outdoors='".$data['adventure_outdoors']."', heritage_culture='".$data['heritage_culture']."', nature_landscapes='".$data['nature_landscapes']."',  wildlife_safaris='".$data['wildlife_safaris']."', wine_food='".$data['wine_food']."', beaches='".$data['beaches']."' where tour_id=".$tourId;
		}
		else
		{
			$strsqlInterest = "insert into tbl_tour_interest (tour_id, adventure_outdoors, heritage_culture, nature_landscapes, wildlife_safaris, wine_food, beaches) values(".$tourId.",'".$data['adventure_outdoors']."','".$data['heritage_culture']."','".$data['nature_landscapes']."','".$data['wildlife_safaris']."','".$data['wine_food']."','".$data['beaches']."')";
		}

		mysql_query($strsqlInterest);
	}

	
}
?>