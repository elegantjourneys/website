<?php
include_once(BASEPATH."class/first-class.php");
class SubRegion extends FirstClass
{
	
	function getSubregionList()
	{
		$this->setDatabaseConnection();
		$strsqlSubregion = "select * from tbls_subregion order by region_location ";
		$resultSubregion = mysql_query($strsqlSubregion);
		$tourSubregions = array();
		while($infoSubregion = mysql_fetch_array($resultSubregion,MYSQL_ASSOC))
		{
			$tourSubregions[]=$infoSubregion;
		}
		
		$this->closeDBConnection();
		return $tourSubregions;
	}

	function getCityNameById($cityId)
	{
		$this->setDatabaseConnection();
		$strsqlCity = "select region_location from tbls_subregion where id=".$cityId;
		$resultCity = mysql_query($strsqlCity);
		$infoCity = mysql_fetch_array($resultCity,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoCity['region_location'];
	}

	
}
?>