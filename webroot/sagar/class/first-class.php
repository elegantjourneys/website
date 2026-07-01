<?php
class FirstClass
{
	/*
		variable used to set seo tags
	*/
	public $metaTitle;
	public $metaKeyword;
	public $metaDescription;

	/*
		setting varialble for db connection
	*/
	var $dbLink;
		
	function setMetaTag()
	{
		$this->metaTitle="";
		$this->metaKeyword="";

		$this->metaDescription="";

		
	}

	function setDatabaseConnection()
	{
		$hostName=DB_HOST;
		$dbUserName=DB_USER;
		$dbUserPassword=DB_PASSWORD;
		$dbName=DB_NAME;
		$connectionLink = mysql_connect($hostName,$dbUserName,$dbUserPassword) or die('coundl not connect');
		mysql_select_db($dbName,$connectionLink) or die('could not select');
		$this->dbLink = $connectionLink;

	}

	function closeDBConnection()
	{
		mysql_close($this->dbLink);
	}

	function _destruct()
	{
		$this->closeDBConnection();

	}

	function redirectTo404()
	{
		header('location:'.WEBROOT.'404.php');
		exit();
	}

	function decodeWebUrl($crypt)
	{
		$incrypt=base64_decode($crypt['eid']);
		$splitVariable=array();
		$splitVariable=explode("&",$incrypt);
		foreach($splitVariable as $valueVariable)
		{
			$singleData=explode("=",$valueVariable);
			$postedData[$singleData['0']]=$singleData['1'];
		}
		return $postedData;

	}

	function incodeUrl($incrypt)
	{
		return base64_encode($incrypt);
	}
	
	
	


	function getFileExtension($fileName)
	{
		
		$fileDet = explode(".",$fileName);
		$countFileDet=count($fileDet);
		return $fileDet[$countFileDet-1];
	}

	function uploadFileToDestination($files,$location,$allowedExtension=array())
	{
		
		$fileExtension = $this->getFileExtension($files['name']);
		if(!in_array($fileExtension,$allowedExtension))
		{
			
			$_SESSION['error']['message'][]='Invalid file format';
			return false;
		}
		
		$fileName=time()."_".$files['name'];
		
		$fileLocation = BASEPATH_REPOSITERY.$location.$fileName;
		
		if(move_uploaded_file($files['tmp_name'],$fileLocation))
		{
		   
			return $fileName;
		}
		else
		{
			
			return false;
		}
	}


	function varifyLoggedUser()
	{
		if((isset($_SESSION['admin']['user']['id']))&&($_SESSION['admin']['user']['id']!=""))
		{

		}
		else
		{
			header('location:index.php');
		}
		
	}

	function genRandomString($length) 
	{
		
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$string = "";    

		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters))];
		}

		return $string;
	}

	
	function validateCaptcha($captchaText)
	{
		$captchaText = strtoupper($captchaText);

		if($_SESSION['security_code']!=$captchaText)
		{
			$_SESSION['security_code']=='';
			return false;
		}
		else if($captchaText=="")
		{
			$_SESSION['security_code']=='';
			return false;
		}
		else
		{
			$_SESSION['security_code']=='';
			return true;
		}

	}

	function filterReceivedData($data)
	{
		return mysql_real_escape_string($data);
		
	}

	function validate_admin()
	{
		if($_SESSION['sess_admin_id']=='')
		{
			header("location:index.php?back=$_SERVER[REQUEST_URI]");
			exit();
		}
	}

	function getPageName()
	{
		return basename($_SERVER['PHP_SELF']);
	}

	function getPriceInCurrency($amount,$currency='USD')
	{

		$this->setDatabaseConnection();
		$strsqlCurrency = "select amount from tbl_currency where currency_code='".$currency."'";
		$resultCurrency = mysql_query($strsqlCurrency);
		$infoCurrency = mysql_fetch_array($resultCurrency);
		$this->closeDBConnection();
		return number_format(($amount*$infoCurrency['amount']),2);
	}

	function getCityList($tourPlaces)
	{
		$cityList = array();
		$cityList = explode(",",$tourPlaces);
		return $cityList;
	}

	function setUserPreference($userIPDetail)
	{
		$_SESSION['user_value']['user_country'] = $userIPDetail['countryCode'];

	}

	function GetUserCountryDisplay()
	{
		return 'United States:</span> (718) 395-7788 | (415) 501-0055</span><br /><span style="color:#3A7B27;">Australia/NZ :</span> (2) 8011-3300 ';
	}


}
?>
