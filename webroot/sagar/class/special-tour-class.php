<?php
include_once(BASEPATH."class/first-class.php");
class SpecialTour extends FirstClass
{
	function addFirstStep($post,$files=array())
	{
		$this->setDatabaseConnection();
		$tourTitle = $post['tourTitle'];
		$tourSlogan = $post['tourSlogan'];
		$tourStartDate = $this->filterReceivedData($post['tourStartDate']);
		$totalDays = $this->filterReceivedData($post['totalDays']);
		$tourImage="";
		if((isset($files['tourImage']))&&(!empty($files['tourImage'])))
		{
			$location = "specialtour/";
			$allowedExtension = array('jpg','jpeg','JPG','png','gif');
			$tourImage=$this->uploadFileToDestination($files['tourImage'],$location,$allowedExtension);
		}

		$strsqlSpecialTour = "insert into tbls_special_tour (tour_title, tour_slogan, tour_start_date, total_days, tour_token) values('".addslashes($tourTitle)."','".addslashes($tourSlogan)."','".$tourStartDate."','".$totalDays."','".$tourImage."')";
		mysql_query($strsqlSpecialTour);
		$specialTourId = mysql_insert_id();
		$this->closeDBConnection();
		$this->addSpecialTourRegion($specialTourId,$post['subregion']);
		return $specialTourId;
		
	}

	function addSpecialTourRegion($specialTourId,$tourRegions=array())
	{
		$this->setDatabaseConnection();
		$itineraryOrder=1;
		foreach($tourRegions as $tourRegion)
		{
			/*
				getting tour region description
			*/
			$strsqlRegionDetail = "select * from tbl_subregion where id=".$tourRegion;
			$resultRegionDetail = mysql_query($strsqlRegionDetail);
			$infoRegionDetail = mysql_fetch_array($resultRegionDetail,MYSQL_ASSOC);
			$strsqlRegion = "insert into tbls_special_tour_regions (special_tour_id, sub_region_id, itinerary_order, short_description) values('".$specialTourId."','".$tourRegion."',".$itineraryOrder.",'".$infoRegionDetail['subregion_description']."')";
			mysql_query($strsqlRegion);
			$itineraryOrder++;
		}
		$this->closeDBConnection();
	}

	function getSpecialTourById($tourId)
	{
		$this->setDatabaseConnection();
		$strsqlTour = "select * from tbls_special_tour where id=".$tourId;
		$resultTour = mysql_query($strsqlTour);
		$infoTour = mysql_fetch_array($resultTour,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoTour;

	}

	function getSpecialTourRegion($tourId)
	{
		$this->setDatabaseConnection();
		$strsqlTour = "select * from tbls_special_tour_regions where special_tour_id=".$tourId." order by itinerary_order";
		$resultTour = mysql_query($strsqlTour);
		$tourRegionList=array();
		while($infoTour = mysql_fetch_array($resultTour,MYSQL_ASSOC))
		{
			
			$tourRegionList[]=$infoTour;
		}
		$this->closeDBConnection();
		return $tourRegionList;
	}

	function addTourDescription($post)
	{
		$hotel1=$post[hotels][0];
		$hotel2=$post[hotels][1];
		$specialTourRegionId = $post['specialTourRegionId'];
		$specialTourId = $post['specialTourId'];
		$this->setDatabaseConnection();
		
		/*
			deleting old record
		*/

		$strsqlHotelDel = "delete from tbls_special_tour_hotels where special_tour_region_id=".$specialTourRegionId;
		mysql_query($strsqlHotelDel);

		/*
			adding hotel details
		*/
		$strsqlHotel = "insert into tbls_special_tour_hotels (special_tour_region_id, hotel1_id, hotel2_id ) values(".$specialTourRegionId.",".$hotel1.",".$hotel2.")";
		mysql_query($strsqlHotel);

		/*
			adding hotel description
		*/
		for($i=0;$i<$post['totalDayForSubregion'];$i++)
		{
			/*
				getting tour description
			*/
			$strsqlTourDescription ="select tour_description from tbl_tour where id=".$post['description'][$i];
			$resultTourDescription = mysql_query($strsqlTourDescription);
			$infoTourDescription = mysql_fetch_array($resultTourDescription,MYSQL_ASSOC);
			$tourDescription = $infoTourDescription['tour_description'];
			
			/*
					checking if insertion is made earlier
			*/
			$strsqlDescriptionDel = "delete from tbls_special_tour_detail where special_tour_id=".$specialTourId." and special_tour_region_id=".$specialTourRegionId." and day_count=".($i+1);
			mysql_query($strsqlDescriptionDel);

			if($i<($post['totalDayForSubregion']-1))
			{
				

				$strsqlTourDescription = "insert into tbls_special_tour_detail (special_tour_id, special_tour_region_id, day_count, description_id, description) values(".$specialTourId.",".$specialTourRegionId.",".($i+1).",".$post['description'][$i].",'".$tourDescription."')";
				mysql_query($strsqlTourDescription);
			}
			else
			{
				$nextTourDescription =="";
				if($post['nextTourDescription']!="")
				{
					$strsqlNextTourDescription ="select tour_description from tbl_tour where id=".$post['nextTourDescription'];
					$resultNextTourDescription = mysql_query($strsqlNextTourDescription);
					$infoNextTourDescription = mysql_fetch_array($resultNextTourDescription,MYSQL_ASSOC);
					$nextTourDescription = $infoNextTourDescription['tour_description'];
				}

				$strsqlTourDescription = "insert into tbls_special_tour_detail (special_tour_id, special_tour_region_id, day_count, description_id, description, next_tour_description_id, next_tour_description) values(".$specialTourId.",".$specialTourRegionId.",".($i+1).",".$post['description'][$i].",'".$tourDescription."',".$post['nextTourDescription'].",'".$nextTourDescription."')";
				mysql_query($strsqlTourDescription);
			}
		}
		$this->closeDBConnection();
		$json=array(
					 'result'=>'success',
					 'message'=>'Record has been saved'
			);
		echo json_encode($json);


	}

	function updateTourDescription($post)
	{
		$this->setDatabaseConnection();
		
		$hotel1Price = $post['hotelsAmount'][0];
		$hotel2Price = $post['hotelsAmount'][1];
		$specialTourRegionId = $post['specialTourRegionId'];
		$specialTourId = $post['specialTourId'];
		/*
			updating hotel price
		*/
		$strsqlHotel = "update tbls_special_tour_hotels set hotel1_cost=".$hotel1Price.", hotel2_cost=".$hotel2Price." where special_tour_region_id=".$specialTourRegionId;
		mysql_query($strsqlHotel);
		/*
			updating day tour description
		*/
		for($i=0;$i<$post['totalDayForSubregion'];$i++)
		{
			if($i<($post['totalDayForSubregion']-1))
			{
				$strsqlTourDetail ="update tbls_special_tour_detail set description='".addslashes($post['tourDescription'][$i])."', description_cost=".$post['tourDescriptionAmount'][$i]." where special_tour_id=".$specialTourId." and special_tour_region_id=".$specialTourRegionId." and day_count=".($i+1);
			}
			else
			{
				$strsqlTourDetail ="update tbls_special_tour_detail set description='".addslashes($post['tourDescription'][$i])."', description_cost=".$post['tourDescriptionAmount'][$i].", next_tour_description='".addslashes($post['nextTourDescription'])."', next_tour_description_cost=".$post['nextTourDescriptionAmount']." where special_tour_id=".$specialTourId." and special_tour_region_id=".$specialTourRegionId." and day_count=".($i+1);
			
			}
			
			mysql_query($strsqlTourDetail);

		}

		$this->closeDBConnection();
		$json=array(
					 'result'=>'success',
					 'message'=>'Record has been saved'
			);
		echo json_encode($json);
		
	}

	function getHotelNameById($hotelId)
	{
		$this->setDatabaseConnection();
		$strsqlHotel = "select hotel_type_name from tbl_hotel_type where hotel_id=".$hotelId." limit 0,1";
		$resultHotel = mysql_query($strsqlHotel);
		$infoHotel = mysql_fetch_array($resultHotel,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoHotel['hotel_type_name'];
	}

	function getSpecialTourRegionHotelDetail($specialTourRegionId)
	{
		$this->setDatabaseConnection();
		$strsqlHotel = "select * from tbls_special_tour_hotels where special_tour_region_id=".$specialTourRegionId;
		$resultHotel = mysql_query($strsqlHotel);
		$infoHotel = mysql_fetch_array($resultHotel,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoHotel;
	}

	function getSpecialTourDescription($specialTourRegionId, $dayCount)
	{
		$this->setDatabaseConnection();
		$strsqlDescription = "select * from tbls_special_tour_detail where special_tour_region_id=".$specialTourRegionId." and day_count=".$dayCount;
		$resultDescription = mysql_query($strsqlDescription);
		$infoDescription = mysql_fetch_array($resultDescription,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoDescription;
	}

}
?>