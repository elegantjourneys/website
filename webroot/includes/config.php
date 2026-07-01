<?php
	ob_start();
	@session_start();
	ini_set('memory_limit', '256M');
	ini_set('display_errors', '0');
	date_default_timezone_set('Asia/Kolkata');
	//define("EMAIL_WEBADMIN",'kr.rakesh.sinha7@gmail.com');
	define("EMAIL_WEBADMIN",'sales@elegantjourneys.co');
	define("EMAIL_BCC",'kr.rakesh.sinha7@gmail.com');
	//define("EMAIL_REPLY",'kr.rakesh.sinha7@gmail.com');
	define("EMAIL_FROM",'webmaster@elegantjourneys.co');
	define("EMAIL_SALES",'sales@elegantjourneys.co');

	$protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';

	define("WEBROOT",$protocol.'://www.elegantjourneys.com/');

	define('WEBROOT_IMAGES',$protocol.'://www.elegantjourneys.com/repositery/');
	define('WEBROOTADMIN',$protocol.'://www.elegantjourneys.com/adminuser/');

	define('WEBROOT_PRODUCT_IMAGES',$protocol.'://www.elegantjourneys.com/images/catalog/product/');
	define('WEBROOT_CATEGORY_IMAGES',$protocol.'://www.elegantjourneys.com/images/catalog/category/');
	define('WEBROOT_MEDIUM_IMAGES',$protocol.'://www.elegantjourneys.com/images/catalog/medium/');
	define('WEBROOT_VARIANT_COLOR_IMAGES',$protocol.'://www.elegantjourneys.com/images/catalog/variant/color/');
	define('WEBROOT_REPOSITERY',$protocol.'://www.elegantjourneys.com/lib/');
	define('WEBROOT_OLD_REPOSITERY',$protocol.'://www.elegantjourneys.com/images/');
	define('WEBROOT_IMAGE_REPOSITERY',$protocol.'://www.elegantjourneys.com/repositery/');
	define('WEBROOT_TOUR_IMAGE_REPOSITERY',$protocol.'://www.elegantjourneys.com/images/tours/');

	define('BASEPATH',$_SERVER["DOCUMENT_ROOT"].'/webroot/');
	define('BASEPATHWEBMASTER',$_SERVER["DOCUMENT_ROOT"].'/webmaster/');
	define('BASEPATH_REPOSITERY',$_SERVER["DOCUMENT_ROOT"].'/repositery/');
	define('BASEPATH_OLD_REPOSITERY',$_SERVER["DOCUMENT_ROOT"].'/images/');
	define('OLD_REPOSITERY',$_SERVER["DOCUMENT_ROOT"].'/lib/');
	define('BASEPATH_CLASS',$_SERVER["DOCUMENT_ROOT"].'/webroot/class/');
	define('BASEPATH_CACHE',$_SERVER["DOCUMENT_ROOT"].'/repositery/cache/price/');
	define('BASEPATH_CACHE_CALENDAR',$_SERVER["DOCUMENT_ROOT"].'/repositery/cache/calendar/');

	define('BASEPATH_CRM_CLASS','/home/elegantjourneys/controll.elegantjourneys.com/pdfs/webmaster/class/');
	define('BASEPATH_TOUR_IMAGE',$_SERVER["DOCUMENT_ROOT"].'/images/tours/');
	define('BASEPATH_IMAGES',$_SERVER["DOCUMENT_ROOT"].'/images/');

	define('FILES_CHACHE_PATH',BASEPATH.'files/cache');

	define('DB_HOST','localhost');
	define('DB_NAME','eleg_db');
	define('DB_USER','eleg_rakesh');
	define('DB_PASSWORD','fuchang##9721');

	define('LOW_SEASON_PRICE_DATE','1-MAY-2025');
	define('HIGH_SEASON_PRICE_DATE','1-OCTOBER-2025');

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
			/*include_once(BASEPATH."/class/ip-locator.php");
			$objIpLocation = new ip2location_lite();
			$userIPDetail = $objIpLocation->getUserIpDetail($_SERVER['REMOTE_ADDR']);

			$objIpLocation->setUserPreference($userIPDetail);*/


	}

	if((!isset($_SESSION['user_value']['selectedCurrencyCode']))||($_SESSION['user_value']['selectedCurrencyCode']==""))
	{
		$_SESSION['user_value']['selectedCurrencyCode'] = 'USD';
		$_SESSION['user_value']['selectedCurrencySign'] = '&#36;';
		//$_SESSION['user_value']['selectedCurrencySign'] = 'USD';

	}
	#### FEEDBACK FORM VARIABLE
	$feedbackLabel = 'Feedback';

	include_once(BASEPATH_CLASS."/campaign-handler-class.php");
	$objCampaignHandler = new CampaignHandler();
	$objCampaignHandler->setCampaignParameter();


	define('ICICI_PG_MERCHANT_ID','100000000088607');
	define('ICICI_PG_TERMINAL_ID','EG002307');
?>