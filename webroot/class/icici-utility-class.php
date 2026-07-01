<?php
include_once(BASEPATH."class/first-class.php");
class ICICIUtility extends FirstClass
{

	

	function getDateTime()
	{
		$dateTime = date('Y:m:d-H:i:s');
		return $dateTime;
	}

	
	function createHash($chargetotal,$Currency,$currencyCode) 
	{
		$merchantInfo = $this->getPGMerchantsByCurrencyCode($currencyCode);
		// Please change the store Id to your individual Store ID
		//$storeId = "3396023465";
		// NOTE: Please DO NOT hardcode the secret in that script. For example read it from a database.
		//$sharedSecret = "Ff64shPkKl";
		$storeId = $merchantInfo['store_id'];
		$sharedSecret = $merchantInfo['shared_secret'];
		$stringToHash = $storeId .$this->getDateTime() . $chargetotal . $Currency . $sharedSecret;
		$ascii = bin2hex($stringToHash);
		
		return sha1($ascii);
	}


	function getPGMerchantsByCurrencyCode($currencyCode="")
	{
		$this->setDatabaseConnection();
		$strsqlPGMerchant = "select * from tbls_pg_merchants where currency_code='".$currencyCode."'";
		$resultPGMerchant = mysql_query($strsqlPGMerchant);
		$infoPGMerchant = mysql_fetch_array($resultPGMerchant,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoPGMerchant;


	}

}	
?>