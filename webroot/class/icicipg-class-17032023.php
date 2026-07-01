<?php
include_once(BASEPATH."class/first-class.php");
date_default_timezone_set('Asia/Kolkata');
class IciciPg extends FirstClass
{

	function getDateTime()
	{
		global $dateTime;
		$dateTime= date('Y:m:d-H:i:s');
		return $dateTime;
	}

	function createHash($chargetotal,$Currency)
	{
		// Please change the store Id to your individual Store ID
		$storeId = "33995001";
		// NOTE: Please DO NOT hardcode the secret in that script. For example read it from a database.
		$sharedSecret = "sharedsecret";

		$stringToHash = $storeId . $this->getDateTime() . $chargetotal . $Currency . $sharedSecret;
		$ascii = bin2hex($stringToHash);

		return sha1($ascii);
	}

}
?>
