<?php
include_once(BASEPATH."class/first-class.php");
class Subregion extends FirstClass
{
	
	function getSubregionList($data=array())
	{
		$this->setDatabaseConnection();
		$strsqlSubregion = "select * from tbl_subregion ";

		if((isset($data['sortBy']))&&(!empty($data['sortBy'])))
		{
			$strsqlSubregion .=" order by ".$data['sortBy'];
		}

		$resultSubregion = mysql_query($strsqlSubregion);
		$subregionList = array();
		while($infoSubregion = mysql_fetch_array($resultSubregion,MYSQL_ASSOC))
		{
			$subregionList []=$infoSubregion;
		}
		$this->closeDBConnection();
		return $subregionList;
	}


	function getSubRegionListByTourId($specialTourId)
	{
		$this->setDatabaseConnection();
		$strsqlRegion = "select * from tbls_special_tour_regions where special_tour_id = ".$specialTourId." order by itinerary_order";
		$resultRegion = mysql_query($strsqlRegion);
		$subRegionList = array();
		while($infoRegion = mysql_fetch_array($resultRegion,MYSQL_ASSOC))
		{
			$subRegionList[]=$infoRegion;
		}
		$this->closeDBConnection();
		return $subRegionList;
	}

	function getSubRegionDetail($subRegionId)
	{
		$this->setDatabaseConnection();
		$strsqlRegion = "select * from tbl_subregion where id=".$subRegionId;
		$resultRegion = mysql_query($strsqlRegion);
		$infoRegion = mysql_fetch_array($resultRegion,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoRegion;

	}

	function updateTourShortDescription($spcialTourRegionId,$tourShortDescription)
	{
		$this->setDatabaseConnection();
		$strsqlRegion = "update tbls_special_tour_regions set short_description='".addslashes($tourShortDescription)."' where id=".$spcialTourRegionId;
		mysql_query($strsqlRegion);
		$this->closeDBConnection();
	}

	function updateTourDays($spcialTourRegionId,$totalDays)
	{
		$this->setDatabaseConnection();
		$strsqlRegion = "update tbls_special_tour_regions set total_days='".$totalDays."' where id=".$spcialTourRegionId;
		mysql_query($strsqlRegion);
		$this->closeDBConnection();
	}

	
	function updateSpecialTourCityOrder($post)
	{
		$this->setDatabaseConnection();
		$tourCountOrder = 1;
		foreach($post['recordsArray'] as $subRegionId)
		{
			$strsqlSubRegion = "update tbls_special_tour_regions set itinerary_order=".$tourCountOrder." where id=".$subRegionId." and special_tour_id=".$post['specialTourId'];
			mysql_query($strsqlSubRegion);
			$tourCountOrder++;
		}
		$this->closeDBConnection();
		echo "1";
		return true;
	}

	function getHotelList($subregionId)
	{
		$this->setDatabaseConnection();
		$strsqlHotel="select tbl_hotel.id id, hotel_type_name from tbl_hotel inner join tbl_hotel_type on tbl_hotel.id=tbl_hotel_type.hotel_id where subregion_id=".$subregionId;
		$resultHotel = mysql_query($strsqlHotel);
		$hotelList = array();
		while($infoHotel=mysql_fetch_array($resultHotel,MYSQL_ASSOC))
		{
			$hotelList[]=$infoHotel;
		}
		$this->closeDBConnection();
		return $hotelList;
	}

	function getTourDetail($subregionId)
	{
		$this->setDatabaseConnection();
		$strsqlDescription ="select * from tbl_tour where subregion_id=".$subregionId;
		$resultDescription = mysql_query($strsqlDescription);
		$tourDescriptionList = array();
		while($infoDescription=mysql_fetch_array($resultDescription,MYSQL_ASSOC))
		{
			$tourDescriptionList[]=$infoDescription;
		}
		$this->closeDBConnection();
		return $tourDescriptionList;

	}

	function getTourDetailById($tourId)
	{
		$this->setDatabaseConnection();
		$strsqlDescription ="select * from tbl_tour where id=".$tourId;
		$resultDescription = mysql_query($strsqlDescription);
		$infoDescription=mysql_fetch_array($resultDescription,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoDescription;
	}


	


	
}
?>