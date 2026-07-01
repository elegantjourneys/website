<?php
include_once(BASEPATH."class/first-class.php");
class TourArea extends FirstClass
{
	

	function getAllTourArea()
	{
		$this->setDatabaseConnection();
		$strsqlTourArea = "select * from tbl_tour_area";
		$resultTourArea = mysql_query($strsqlTourArea);
		$tourAreaList = array();
		while($infoTourArea = mysql_fetch_array($resultTourArea,MYSQL_ASSOC))
		{
			$tourAreaList[]=$infoTourArea;
		}
		$this->closeDBConnection();
		return $tourAreaList;

	}

	

}
?>