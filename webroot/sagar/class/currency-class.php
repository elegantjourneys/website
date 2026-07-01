<?php
include_once(BASEPATH."class/first-class.php");
class Currency extends FirstClass
{
	
	function currencyRate($currencyCode)
	{
		$this->setDatabaseConnection();
		$strsqlCurrency = "select * from tbl_currency where currency_code='".$currencyCode."'";
		$resultCurrency = mysql_query($strsqlCurrency);
		$infoCurrency = mysql_fetch_array($resultCurrency,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoCurrency['amount'];
	}

	function getcurrencySymbol($currencyCode)
	{
		$this->setDatabaseConnection();
		$strsqlCurrency = "select currency_sign from tbl_currency where currency_code='".$currencyCode."'";
		$resultCurrency = mysql_query($strsqlCurrency);
		$infoCurrency = mysql_fetch_array($resultCurrency,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoCurrency['currency_sign'];
	}

	function getCurrencyDetailByCode($currencyCode)
	{
		$this->setDatabaseConnection();
		$strsqlCurrency = "select * from tbl_currency where currency_code='".$currencyCode."'";
		$resultCurrency = mysql_query($strsqlCurrency);
		$infoCurrency = mysql_fetch_array($resultCurrency,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoCurrency;
	}


}
?>