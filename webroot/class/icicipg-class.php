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

	/*function createHash($chargetotal,$Currency)
	{
		// Please change the store Id to your individual Store ID
		$storeId = "3396023465";
		// NOTE: Please DO NOT hardcode the secret in that script. For example read it from a database.
		$sharedSecret = "Ff64shPkKl";
		
		$stringToHash = $storeId . $this->getDateTime() . $chargetotal . $Currency . $sharedSecret;
		$ascii = bin2hex($stringToHash);
		
		return sha1($ascii);
	}*/


	function createHash($chargetotal,$Currency)
	{
		// Please change the store Id to your individual Store ID
		//$storeId = "3396023465";
		// NOTE: Please DO NOT hardcode the secret in that script. For example read it from a database.
		//$sharedSecret = "Ff64shPkKl";
		
		$storeInformation = array();
		switch($Currency)
		{
			case '356':
					$storeInformation['store_id'] = '3396023465';
					$storeInformation['shared_secret'] = 'Ff64shPkKl';
					$storeInformation['currency_id'] = '356';
				break;
			case '978':
					$storeInformation['store_id'] = '3396023466';
					$storeInformation['shared_secret'] = 'Gm11ioLiXt';
					$storeInformation['currency_id'] = '978';
				break;
			case '826':
					$storeInformation['store_id'] = '3396023467';
					$storeInformation['shared_secret'] = 'Dp93ljHjZr';
					$storeInformation['currency_id'] = '826';
				break;
			case '840':
					$storeInformation['store_id'] = '3396023468';
					$storeInformation['shared_secret'] = 'Ra16ehHaCi';
					$storeInformation['currency_id'] = '840';
				break;
			case '036':
					$storeInformation['store_id'] = '3396023469';
					$storeInformation['shared_secret'] = 'Yi62ogTrXk';
					$storeInformation['currency_id'] = '036';
				break;
			case '784':
					$storeInformation['store_id'] = '3396023470';
					$storeInformation['shared_secret'] = 'Ey84wsMwSn';
					$storeInformation['currency_id'] = '784';
				break;
			default:
					$storeInformation['store_id'] = '3396023465';
					$storeInformation['shared_secret'] = 'Ff64shPkKl';
					$storeInformation['currency_id'] = '356';
				break;


		}

		//echo "----------".$chargetotal;
		
		$stringToHash = $storeInformation['store_id']. $this->getDateTime() . $chargetotal . $Currency . $storeInformation['shared_secret'];
		$ascii = bin2hex($stringToHash);
		
		return sha1($ascii);
	}

}
?>
