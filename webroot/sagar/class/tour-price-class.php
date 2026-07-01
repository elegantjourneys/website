<?php
include_once(BASEPATH."class/first-class.php");
class TourPrice extends FirstClass
{
	
	function getMinimumPrice($tourId)
	{
		$this->setDatabaseConnection();
		$strsqlTourPrice = "select min(star3) tour_price from tbl_tour_price where tour_id='".$tourId."'";
		$resultTourPrice = mysql_query($strsqlTourPrice);
		$infoTourPrice = mysql_fetch_array($resultTourPrice,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoTourPrice['tour_price'];
	}

	function getPriceDetail($discountInfo)
	{
		

		$currencyPrice = round($discountInfo['price']*$discountInfo['currencyRate']);
		
		if($discountInfo['profit']==""||$discountInfo['profit']==0)
		{
			$profitPrice = $currencyPrice;
		}
		else
		{
			$profitPrice = $currencyPrice + ($currencyPrice*($discountInfo['profit']/100));
		}

		if($discountInfo['offer']==""||$discountInfo['offer']==0)
		{
			$displayPrice = $profitPrice;
		}
		else
		{
			$displayPrice = $profitPrice + ($profitPrice*($discountInfo['offer']/100));
		}
		

		$priceInfo = array(
							'currencyPrice' => number_format($currencyPrice),
							'profitPrice' => number_format($profitPrice),
							'displayPrice' => number_format($displayPrice)
				);
		return $priceInfo;
	}

	function getPriceByTourType($tourId,$tourType=1)
	{
		$this->setDatabaseConnection();
		$strsqlPrice = "select * from tbl_tour_price where tour_id=".$tourId." and tour_type=".$tourType." and price_status=1 and end_date1 >= '".date("Y-m-d")."' order by start_date1";
		$resultPrice = mysql_query($strsqlPrice);
		$priceList=array();
		while($infoPrice=mysql_fetch_array($resultPrice,MYSQL_ASSOC))
		{
			$priceList[]=$infoPrice;
		}
		$this->closeDBConnection();
		return $priceList;
	}
}
?>