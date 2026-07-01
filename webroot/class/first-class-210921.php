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

	function setMysqliConnection()
	{
		$hostName=DB_HOST;
		$dbUserName=DB_USER;
		$dbUserPassword=DB_PASSWORD;
		$dbName=DB_NAME;
		
		$mysqli = new mysqli($hostName,$dbUserName,$dbUserPassword,$dbName);

		if ($mysqli->connect_errno) {
			printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
		}

		return $mysqli;
	}
	
	function freeMysqliConnection()
	{
		$result->free_result();
	}

	function closeMysqliConnection($mysqli)
	{
		$mysqli->close();
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

	function getPageUrl()
	{
		$pageUrl = "https://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];
		return $pageUrl;
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

	function verifyUserRequest($data = array())
	{


	}

	function setConfirmationParameters($data)
	{
		$_SESSION['confirmtion_message'] = array();
		$_SESSION['confirmation_message'] = $data;
		return true;
	}

	function unsetConfirmationParameter()
	{
		$_SESSION['confirmtion_message'] = array();
	}

	function getConfirmationMessage()
	{
		$data = $_SESSION['confirmation_message'];
		return $data;				
	}

	function validateGoogleRecaptcha($data)
	{
		$curl = curl_init();

		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

		$response = curl_exec($curl);
		$response = json_decode($response, true);

		if($response['success'] === false)
		{
			return false;
		} 
		else 
		{
			return true;
		}

	}

	function getPriceSettingByKeyValue($keyValue)
	{
		$this->setDatabaseConnection();
		$strsqlSetting = "select setting_value from tbls_price_setting where setting_key ='".$keyValue."'";
		$resultSetting = mysql_query($strsqlSetting);
		$infoSetting = mysql_fetch_array($resultSetting,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoSetting['setting_value'];
	}


	function getCurrencyDetailByCurrencyCode($currencyCode)
	{
		$this->setDatabaseConnection();
		$strsqlCurrency = "select * from tbl_currency where currency_code='".$currencyCode."'";
		$resultCurrency = mysql_query($strsqlCurrency);
		$infoCurrency = mysql_fetch_array($resultCurrency,MYSQL_ASSOC);
		$infoCurrency['currency_value'] = ($infoCurrency['currency_value']*0.95);  // added to decrease currency value;
		$this->closeDBConnection();
		return $infoCurrency;
	}

	function formateNumericData($number)
	{
		$number = str_replace(",","",$number);
		return $number;
	}

	function getDiscountValue($data=array())
	{
		$this->setDatabaseConnection();
		$requestedDate = date("Y-m-d",strtotime($data['discount_date']));
		
		$strsqlDiscountTour ="select * from cms_discount_slab where start_date <= '".$requestedDate."' and end_date >='".$requestedDate."'";
		$resultDiscountTour = mysql_query($strsqlDiscountTour);

		if(mysql_num_rows($resultDiscountTour)>=1)
		{
			$infoDiscountTour = mysql_fetch_array($resultDiscountTour,MYSQL_ASSOC);

			$discountData = array(
										"profit"			=>		$infoDiscountTour['profit'],
										"discount"			=>		$infoDiscountTour['discount'],
										"discount_type"		=>		$infoDiscountTour['discount_type']
							);

			$this->closeDBConnection();
			return $discountData;

		}
		else
		{
			$discountData = array();
			$this->closeDBConnection();
			return $discountData;
		}
	}

	function calculateDiscountPrice($data)
	{
		
		$data['cost_price'] = str_replace(",","",$data['cost_price']);
		
		$profitAmount = ($data['cost_price']*($data['profit']/100));
		$totalAmountAfterProfit = ($profitAmount+$data['cost_price']);
		$finalAmount = (($totalAmountAfterProfit)*(100/(100-$data['discount'])));

		
		$priceInfo = array(
								"profit_price"								=>		$totalAmountAfterProfit,
								"discount_price"							=>		$finalAmount,
								
					);
		return $priceInfo;

	}

	function validateSecurityText($data)
	{
		$sessionSecurityText = $data['session_security_text'];
		$enteredSecurityText = $data['entered_security_text'];
		$validation = false;
		if($sessionSecurityText!=""&&$enteredSecurityText!="")
		{
			
			if($sessionSecurityText==$enteredSecurityText)
			{
				
				$validation = true;
			}
			
		}
		
		return $validation;

	}

	function getBreadCrumb($breadCrumbData)
	{	
		$breadcrumbText = '';
		$breadcrumbText = $breadcrumbText.'<div>';
		$breadcrumbText = $breadcrumbText.'<ol class="breadcrumb">';
		foreach($breadCrumbData as $breadCrumbLink)
		{
			if($breadCrumbLink['link']!="")
			{
				$breadcrumbText = $breadcrumbText.'<li class="breadcrumb-item"><a href="'.$breadCrumbLink['link'].'">'.$breadCrumbLink['text'].'</a></li>';
			}
			else
			{
				$breadcrumbText = $breadcrumbText.'<li class="breadcrumb-item"><a>'.$breadCrumbLink['text'].'</a></li>';
			}
		}
		$breadcrumbText = $breadcrumbText.'</ol>';
		$breadcrumbText = $breadcrumbText.'</div>';

		echo $breadcrumbText;
	}


	function checkCacheFile($depth='single')
	{

				
		$url = $this->getPageUrl();
		$break = Explode('/', $url);

		
		if($depth=='single')
		{
			$file = $break[count($break) - 1];
		}
		else if($depth=='double')
		{
			if(count($break)==2)
			{
				$file = $break[count($break) - 1];
			}
			else
			{
				$file = $break[count($break) - 2].'-'.$break[count($break) - 1];
			}
		}
		else if($depth=='triple')
		{
			if(count($break)==3)
			{
				$file = $break[count($break) - 2].'-'.$break[count($break) - 1];
			}
			else if(count($break)==2)
			{
				$file = $break[count($break) - 1];
			}
			else
			{
				$file = $break[count($break) - 3].'-'.$break[count($break) - 2].'-'.$break[count($break) - 1];
			}
		}
		//$cachefile = FILES_CHACHE_PATH.'/cached-'.substr_replace($file ,"",-4).'.txt';
		$cachefile = FILES_CHACHE_PATH.'/cached-'.$file.'.txt';
		$cachetime = 18000;

		
		// Serve from the cache if it is younger than $cachetime

		if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile))
		{
			echo "<!-- Cached copy, generated ".date('H:i', filemtime($cachefile))." -->\n";
			$cachedData = readfile($cachefile);
			echo $cachedData;
			exit;
		}

		return $cachefile;
	}

}
?>
