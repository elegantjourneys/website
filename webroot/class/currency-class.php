<?php
include_once(BASEPATH."class/first-class.php");
class Currency extends FirstClass
{
	
	function currencyRate($currencyCode)
	{
		$objMysqli = $this->setMysqliConnection();
		$strsqlCurrency = "select * from tbl_currency where currency_code='".$currencyCode."'";
		$objResultCurrency = $objMysqli->query($strsqlCurrency);
		$infoCurrency = $objResultCurrency->fetch_array(MYSQLI_ASSOC);
		$currencyInfo = $infoCurrency;
		$this->closeMysqliConnection($objMysqli);
		return $currencyInfo['amount'];
	}

	function getcurrencySymbol($currencyCode)
	{
		$objMysqli = $this->setMysqliConnection();
		$strsqlCurrency = "select currency_sign from tbl_currency where currency_code='".$currencyCode."'";
		$objResultCurrency = $objMysqli->query($strsqlCurrency);
		$infoCurrency = $objResultCurrency->fetch_array(MYSQLI_ASSOC);
		$currencyInfo = $infoCurrency;
		$this->closeMysqliConnection($objMysqli);
		return $currencyInfo['currency_sign'];
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

	function getCurrencyCodeList()
	{
		$this->setDatabaseConnection();
		$strsqlCurrency = "select currency_code from tbl_currency order by currency_code";
		$resultCurrency = mysql_query($strsqlCurrency);

		$currencyCodeList = array();
		while($infoCurrency = mysql_fetch_array($resultCurrency,MYSQL_ASSOC))
		{
			$currencyCodeList[] = $infoCurrency['currency_code'];
		}
		$this->closeDBConnection();
		return $currencyCodeList;
	}


}
?>