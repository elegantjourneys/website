<?php
	@session_start();
	ini_set('memory_limit', '256M');
	ini_set('display_errors', '0');
	define("WEBROOT",'http://www.elegant-incentives.com/');
	define("EMAIL_WEBADMIN",'kr.rakesh.sinha7@gmail.com');
	define("EMAIL_REPLY",'kr.rakesh.sinha7@gmail.com');
	
	define('WEBROOT_IMAGES','http://www.elegant-incentives.com/repositery/');
	define('WEBROOTADMIN','http://www.elegant-incentives.com/adminuser/');

	define('WEBROOT_PRODUCT_IMAGES','http://www.elegant-incentives.com/images/catalog/product/');
	define('WEBROOT_CATEGORY_IMAGES','http://www.elegant-incentives.com/images/catalog/category/');
	define('WEBROOT_MEDIUM_IMAGES','http://www.elegant-incentives.com/images/catalog/medium/');
	define('WEBROOT_VARIANT_COLOR_IMAGES','http://www.elegant-incentives.com/images/catalog/variant/color/');
	define('WEBROOT_REPOSITERY','http://www.elegant-incentives.com/lib/');
	define('WEBROOT_OLD_REPOSITERY','http://www.elegant-incentives.com/images/');
	define('WEBROOT_IMAGE_REPOSITERY','http://www.elegant-incentives.com/repositery/');
	
	define('BASEPATH',$_SERVER["DOCUMENT_ROOT"].'/');
	define('BASEPATHWEBMASTER',$_SERVER["DOCUMENT_ROOT"].'/webmaster/');
	define('BASEPATH_REPOSITERY',$_SERVER["DOCUMENT_ROOT"].'/repositery/');
	define('BASEPATH_OLD_REPOSITERY',$_SERVER["DOCUMENT_ROOT"].'/images/');
	define('OLD_REPOSITERY',$_SERVER["DOCUMENT_ROOT"].'/lib/');
	define('BASEPATH_CLASS',$_SERVER["DOCUMENT_ROOT"].'/class/');

	define('DB_HOST','elegantver2016.db.9187892.hostedresource.com');
	define('DB_NAME','elegantver2016');
	define('DB_USER','elegantver2016');
	define('DB_PASSWORD','Rimjhim##1234');


	$_SESSION['user_value']['selected_currency']='USD';



	
	$mobileView = false;
	$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
	$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
	$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
	$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
	$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
	$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");

	if($iphone || $android || $palmpre || $ipod ||  $ipad ||$berry == true)
	{
		$mobileView = true;
	}

	/*
		setting country for visitors
	*/
	
	if((!isset($_SESSION['user_value']['user_country']))||($_SESSION['user_value']['user_country']!=""))
	{
			include_once(BASEPATH_CLASS."ip-locator.php");
			$objIpLocation = new ip2location_lite();
			$userIPDetail = $objIpLocation->getUserIpDetail($_SERVER['REMOTE_ADDR']);
			
			$objIpLocation->setUserPreference($userIPDetail);
			

	}
	
?>