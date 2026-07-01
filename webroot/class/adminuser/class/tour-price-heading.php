<?php
class TourPriceHeading
{
	function updateTourPriceHeading($post)
	{
		switch($post['fieldName'])
		{
			case 'affordable':
				$fieldName='affordable_level';
			break;
			case 'luxury':
				$fieldName='luxury_level';
			break;
			case 'royal':
				$fieldName='royal_level';
			break;
		}
		if($this->checkAvailableTourId($post['tourId']))
		{
			$strsqlPriceTitle = "update  tbl_tour_price_heading set ".$fieldName."='".$post['fieldValue']."' where tour_id=".$post['tourId'];
		}
		else
		{
			$strsqlPriceTitle = "insert into   tbl_tour_price_heading( tour_id, ".$fieldName." ) values('".$post['tourId']."','".$post['fieldValue']."')";
		}

		if(mysql_query($strsqlPriceTitle))
		{
			echo 'success';
		}
		else
		{
			echo 'fail';
		}
	}

	function updateTourPriceData($post)
	{
		$strsqlPriceTitle = "update  tbl_tour_price set ".$post['fieldName']."='".$post['fieldValue']."' where id=".$post['tourPriceId'];
		if(mysql_query($strsqlPriceTitle))
		{
			echo 'success';
		}
		else
		{
			echo 'fail';
		}

	}

	function checkAvailableTourId($tourId)
	{
		$strsqlTourData = "select id from tbl_tour_price_heading where tour_id = ".$tourId;
		$resultTourData = mysql_query($strsqlTourData);

		if(mysql_num_rows($resultTourData)>=1)
		{
			return  true;
		}
		else
		{
			return false;
		}
	}

	function getTourPriceDetail($tourPriceId)
	{
		echo $strsqlTourData = "select * from tbl_tour_price_heading where id = ".$tourPriceId;
		$resultTourData = mysql_query($strsqlTourData);
		$infoTourData = mysql_fetch_array($resultTourData);
		return $infoTourData;
	}

	
}
?>