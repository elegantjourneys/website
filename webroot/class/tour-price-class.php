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
		

		$currencyPrice = $discountInfo['price'];
		
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
			$displayPrice = (($profitPrice)*(100/(100-$discountInfo['offer'])));
		}
		

		$priceInfo = array(
							'currencyPrice' => number_format($currencyPrice),
							'sell_price' => number_format($profitPrice/$discountInfo['currencyRate']),
							'discount_price' => number_format($displayPrice/$discountInfo['currencyRate'])
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

	function getPriceByDateRange($data=array())
	{
		$this->setDatabaseConnection();

		$tourId = $data['tour_id'];
		$tourType = $data['tour_type'];
		$startDate = date("Y-m-d",strtotime($data['tour_start_date']));
		
		$strsqlTourBasic = "select * from tbl_managetour where id=".$tourId;
		$resultTourBasic = mysql_query($strsqlTourBasic);
		$infoTourBasic = mysql_fetch_array($resultTourBasic,MYSQL_ASSOC);
		$endDate = date("Y-m-d",(strtotime($data['tour_start_date'])+(($infoTourBasic['tour_duraction']-1)*24*60*60)));
				
		$strsqlPrice = "select * from tbl_tour_price where tour_id=".$tourId." and tour_type=".$tourType." and price_status=1 and ( start_date <= '".$startDate."' and end_date1 >= '".$endDate."') order by star3 limit 0,1";
		$resultPrice = mysql_query($strsqlPrice);
		$priceList=array();
		while($infoPrice=mysql_fetch_array($resultPrice,MYSQL_ASSOC))
		{
			
			$infoPrice['offer']=$infoTourBasic['offer'];
			$infoPrice['profit']=$infoTourBasic['profit'];
			$priceList = $infoPrice;
		}
		$this->closeDBConnection();
		
		return $priceList;

	}

	function getPriceStack($data=array())
	{
		
		$this->setDatabaseConnection();
		if((isset($data['tour_id']))&&($data['tour_id']!=""))
		{
			$strsqlTourPrice = "select * from tour_prices where tour_id=".$data['tour_id'];
		}
		else
		{
			$strsqlTourPrice = "select * from tour_prices where low_season_price='' or high_season_price='' limit 0,1";

		}

		
		$resultTourPrice = mysql_query($strsqlTourPrice);
		
		$priceStackList = array();

		while($infoTourPrice=mysql_fetch_array($resultTourPrice,MYSQL_ASSOC))
		{
			
			$strsqlCMSTourSetting = "select low_season_price_date, high_season_price_date from  cms_tour_setting where tour_id=".$infoTourPrice['tour_id'];
			$resultCMSTourSetting = mysql_query($strsqlCMSTourSetting);
			$infoCMSTourSetting = mysql_fetch_array($resultCMSTourSetting);

			
			if($infoCMSTourSetting['low_season_price_date']=="")
			{
				$infoCMSTourSetting['low_season_price_date'] = '1-May-2024';
			}
			

			if($infoCMSTourSetting['high_season_price_date']=="")
			{
				$infoCMSTourSetting['high_season_price_date'] = '1-Oct-2024';
			}

			$priceStackList[] = array(
											"tour_price_id"			=>		$infoTourPrice['id'],
											"tour_id"				=>		$infoTourPrice['tour_id'],
											"tour_page_id"			=>		$infoTourPrice['tour_page_id'],
											"category_id "			=>		$infoTourPrice['category_id'],
											"currency_code"			=>		$infoTourPrice['currency_code'],
											"low_season_price_date"	=>		$infoCMSTourSetting['low_season_price_date'],
											"high_season_price_date"=>		$infoCMSTourSetting['high_season_price_date']
					);

		}

		$countBlankData = count($priceStackList);
		
		if($countBlankData>=10)
		{
			$this->closeDBConnection();

			return $priceStackList;
		}

		echo "-----------------------------------------B1";

		$nextLimit = (10-$countBlankData);


		/******************** GETTING NULL VALUE DATA   **************************/

		$strsqlTourPrice = "select * from tour_prices where low_season_price is null or high_season_price is null limit 0,".$nextLimit;
		$resultTourPrice = mysql_query($strsqlTourPrice);
		
		while($infoTourPrice=mysql_fetch_array($resultTourPrice,MYSQL_ASSOC))
		{
			$strsqlCMSTourSetting = "select low_season_price_date, high_season_price_date from  cms_tour_setting where tour_id=".$infoTourPrice['tour_id'];
			$resultCMSTourSetting = mysql_query($strsqlCMSTourSetting);
			$infoCMSTourSetting = mysql_fetch_array($resultCMSTourSetting);

			
			if($infoCMSTourSetting['low_season_price_date']=="")
			{
				
				$infoCMSTourSetting['low_season_price_date'] = '1-May-2024';
			}
			

			if($infoCMSTourSetting['high_season_price_date']=="")
			{
				$infoCMSTourSetting['high_season_price_date'] = '1-May-2024';
			}

			$priceStackList[] = array(
											"tour_price_id"			=>		$infoTourPrice['id'],
											"tour_id"				=>		$infoTourPrice['tour_id'],
											"tour_page_id"			=>		$infoTourPrice['tour_page_id'],
											"category_id"			=>		$infoTourPrice['category_id'],
											"currency_code"			=>		$infoTourPrice['currency_code'],
											"low_season_price_date"	=>		$infoCMSTourSetting['low_season_price_date'],
											"high_season_price_date"=>		$infoCMSTourSetting['high_season_price_date']
					);

		}

		
		$countNullData = count($priceStackList);

		if($countNullData>=10)
		{
			$this->closeDBConnection();

			return $priceStackList;
		}

		$nextLimit = (10-$countNullData);



		/******************** GETTING DATA ACCORDING TO UPDATE TIME  **************************/

		$strsqlTourPrice = "select * from tour_prices order by update_time limit 0,".$nextLimit;
		$resultTourPrice = mysql_query($strsqlTourPrice);
		
		
		while($infoTourPrice=mysql_fetch_array($resultTourPrice,MYSQL_ASSOC))
		{
			$strsqlCMSTourSetting = "select low_season_price_date, high_season_price_date from  cms_tour_setting where tour_id=".$infoTourPrice['tour_id'];
			$resultCMSTourSetting = mysql_query($strsqlCMSTourSetting);
			$infoCMSTourSetting = mysql_fetch_array($resultCMSTourSetting);

			 

			$priceStackList[] = array(
											"tour_price_id"			=>		$infoTourPrice['id'],
											"tour_id"				=>		$infoTourPrice['tour_id'],
											"tour_page_id"			=>		$infoTourPrice['tour_page_id'],
											"category_id"			=>		$infoTourPrice['category_id'],
											"currency_code"			=>		$infoTourPrice['currency_code'],
											"low_season_price_date"	=>		$infoCMSTourSetting['low_season_price_date'],
											"high_season_price_date"=>		$infoCMSTourSetting['high_season_price_date']
					);

		}

		$this->closeDBConnection();

		return $priceStackList;

	}

	function updatePriceStack($data)
	{
		$this->setDatabaseConnection();
		
		$strsqlTourPrice = "update tour_prices set low_season_price ='".$data['low_season_price']."', high_season_price ='".$data['high_season_price']."', low_season_discount_price='".$data['low_season_discount_price']."', high_season_discount_price='".$data['high_season_discount_price']."', update_time='".date("Y-m-d h:i:s",time())."' where id=".$data['tour_price_id'];
		mysql_query($strsqlTourPrice);

		$strsqlTourPriceDet = "update tour_price_details set price_data='".$data['price_data']."' where tour_price_id=".$data['tour_price_id'];
		mysql_query($strsqlTourPriceDet);

		$this->closeDBConnection();

		return true;
	}

	function getCachedTourPrice($data=array())
	{
		$this->setDatabaseConnection();
		$strsqlTourPriceDet = "select price_data from tour_price_details where tour_id=".$data['tour_id']." and tour_page_id=".$data['tour_page_id']." and currency_code='".$data['selected_currency_code']."'";
		$resultTourPriceDet = mysql_query($strsqlTourPriceDet);
		$infoTourPriceDet = mysql_fetch_array($resultTourPriceDet);

		if($infoTourPriceDet['price_data']!="")
		{
			$this->closeDBConnection();
			$priceData = unserialize($infoTourPriceDet['price_data']);	
			return $priceData;
			
		}
		else
		{
			$this->closeDBConnection();
			return false;
		}
	}
}
?>