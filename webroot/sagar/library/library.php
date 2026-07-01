<?php
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



function getNoOfPage($tableName,$filterString="")
{
	$strsqlRec = "select count(*) noOfRecord from ".$tableName.$filterString;
	$resultRec = mysql_query($strsqlRec);
	$infoRec = mysql_fetch_array($resultRec);
	$noOfPage = ceil(($infoRec['noOfRecord'])/PAGE_LIMIT);
	return $noOfPage;
}


function displayPaging($tableName,$currentPage,$pageName,$filterString="",$otherParamter="")
{
	?>
	<div id="paging" >
	<?php
		if($currentPage!=1)
		{
	?>
			<a href="<?=$pageName?>?page=<?=($currentPage-1)?><?=$otherParamter?>" ><</a>
	<?php
		}
	?>

	<?php
		$noOfPage = getNoOfPage($tableName,$filterString);
		for($i=1;$i<$noOfPage+1;$i++)
		{
	?>
			<a href="<?=$pageName?>?page=<?=$i?><?=$otherParamter?>" <?=($currentPage==$i)?'class="selected"':''?>><?=$i?></a>
		
	<?
		}
	?>
	<?php
		if($currentPage!=$noOfPage)
		{
	?>
			<a href="<?=$pageName?>?page=<?=($currentPage-1)?><?=$otherParamter?>" ><</a>
	<?php
		}
	?>
	</div>
 <?php
}

function contentSearch($tableName,$fieldName,$actionUrl,$secondSearch="")
{
?>
	  <form name="frmSearch" action="<?=$actionUrl?>" method="post" onsubmit="return validate_search();">
	  <input type="hidden" name="process" value="searchData">
	  <input type="hidden" name="source" value="<?=$tableName?>">
	  <input type="hidden" name="field" value="<?=$fieldName?>">
	  <?php
		if(!empty($secondSearch))
		{
	  ?>
	  <input type="hidden" name="secondSearch" value="<?=$secondSearch?>">
	  <?php
		}
	  ?>
	  <input type="hidden" name="cancelUrl" value="<?=$_SERVER['REQUEST_URI']?>">
	  <div class="select-bar">
		<label>
		<input type="text" name="txtSearch" />
		</label>
		<label>
		<input type="submit" name="Submit" value="Search" />
		</label>
                <span style="float:right; margin-right:30px; "><a href="#" onclick="window.history.back();"style="color:#9097A9; font-weight:bold; font-size:13px; text-decoration:none;">&lt; &lt; Back</a></span>
	  </div>
	  </form>

<?php
}

function getSearchList($post)
{
	global $searchList;
	$searchList=array();

	if(empty($post['txtSearch']))
	{
		$_SESSION['message']="Please enter text to search.";
		return;
	}

	$strsqlSearch = "select * from ".$post['source']." where ".$post['field']." like '".strtolower($post['txtSearch'])."%'".$post['secondSearch'];
	$resultSearch = mysql_query($strsqlSearch);
	if(mysql_num_rows($resultSearch)>=1)
	{
		
		while($infoSearch = mysql_fetch_array($resultSearch,MYSQL_ASSOC))
		{
			$searchList[]=$infoSearch;
		}
		return($searchList);
	}
	else
	{
		$_SESSION['message']="No record found related to search string.";
		return;
	}
}

function processWebsiteMail($to,$messageText,$subject,$headers)
{
	
	if(mail($to,$subject,$messageText,$headers))
	{
		
		return true;
	}
	else
	{
		
		return false;
	}
}


function fileDownload($file,$location)
{
	$file=WEBROOT_DEPOSITORY.$location.$file;
	header("Expires: 0");  
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");  
	header("Cache-Control: no-store, no-cache, must-revalidate");  
	header("Cache-Control: post-check=0, pre-check=0", false);  
	header("Pragma: no-cache");  
	header("Content-type: application/pdf");
	header("Content-type: application/msword");
	// tell file size  
	header('Content-length: '.filesize($file));  
	// set file name  
	header('Content-disposition: attachment; filename='.basename($file));  
	readfile($file);  
	// Exit script. So that no useless data is output-ed.  
	exit;  
}

function getFileExtension($fileName)
{
	$fileDet = explode(".",$fileName);
	$countFileDet=count($fileDet);
	return $fileDet[$countFileDet-1];
}

function uploadFileToDestination($files,$location,$allowedExtension=array())
{
	$fileExtension = getFileExtension($files['name']);
	if(!in_array($fileExtension,$allowedExtension))
	{
		
		$_SESSION['error']['message'][]='Invalid file format';
		return false;
	}
	
	$fileName=time().".".$fileExtension;
	
	$fileLocation = WEBROOT_DEPOSITORY.$location.$fileName;
	
	if(move_uploaded_file($files['tmp_name'],$fileLocation))
	{
	   
	    return $fileName;
	}
	else
	{
	    return false;
	}
}


function getUserIpDetail()
{
	include('class/ip-locator.php');
 
	//Load the class
	$ipLite = new ip2location_lite;
	$ipLite->setKey('f2a1699e7e2662e37434b7cf95380c2d6a15eb7cdb686a61a972796f835ca3c2');
	 
	//Get errors and locations
	$locations = $ipLite->getCity($_SERVER['REMOTE_ADDR']);
	return $locations;
}

function sendShortCustomerInfo($post)
{
	$userLocation=@getUserIpDetail();
	$to = 'sales@elegantjourneys.co';
	//$to='kr.rakesh.sinha7@gmail.com';
	$subject = 'Short information for tour enquiry from '.$post['customerName'].' for '.$post['tourName'];
	$message="<table width=\"400\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\">
	  <tr>
		<td>Tour Name</td>
		<td><a href=\"http://elegantjourneys.co/itinerary.php?id=".$post['tourId']."\">".$post['tourName']."</a></td>
	  </tr>
	  <tr>
		<td>IP Address</td>
		<td>".$_SERVER['REMOTE_ADDR']."</td>
	  </tr>";
	  if((isset($_SESSION['campaignName']))&&(!empty($_SESSION['campaignName'])))
	  {
		$message .="<tr>
			<td>Campaign Name</td>
			<td>".$_SESSION['campaignName']."</td>
		 </tr>";
	  }
	  $message .="<tr>
		<td>Client Name</td>
		<td>".$post['customerName']."</td>
	  </tr>
	  <tr>
		<td>Email ID</td>
		<td>".$post['customerEmail']."</td>
	  </tr>
	  <tr>
		<td>Phone</td>
		<td>".$post['customerPhone']."</td>
	  </tr>
	   <tr>
			<td colspan='2'><strong> Details retrieve from IP address</strong></td>
	  </tr>
	  <tr>
		<td>Country</td>
		<td>".@$userLocation['countryName']."</td>
	  </tr>
	  <tr>
		<td>Region</td>
		<td>".@$userLocation['regionName']."</td>
	  </tr>
	  <tr>
		<td>Time Zone</td>
		<td>".@$userLocation['timeZone']."</td>
	  </tr>
	</table>";

	$from='wadhawan.vivek@gmail.com';

	$headers = "From:".$from."\r\n";
	$headers .= "Bcc:kr.rakesh.sinha7@gmail.com"."\r\n";
	$headers .= 'Content-type: text/html;';
	if(mail($to, $subject, $message, $headers))
	{
		
		return true;
	}
}


function sendShortTailorMadeInfo($post)
{
	$userLocation=@getUserIpDetail();
	$to = 'sales@elegantjourneys.co';
	//$to='kr.rakesh.sinha7@gmail.com';
	$subject = 'Short information from tailor make a tour from '.$post['customerName'];
	$message="<table width=\"400\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\">
	  
	  <tr>
		<td>IP Address</td>
		<td>".$_SERVER['REMOTE_ADDR']."</td>
	  </tr>
	  <tr>
		<td>Client Name</td>
		<td>".$post['customerName']."</td>
	  </tr>
	  <tr>
		<td>Email ID</td>
		<td>".$post['customerEmail']."</td>
	  </tr>
	  <tr>
		<td>Phone</td>
		<td>".$post['customerPhone']."</td>
	  </tr>
	   <tr>
			<td colspan='2'><strong> Details retrieve from IP address</strong></td>
	  </tr>
	  <tr>
		<td>Country</td>
		<td>".@$userLocation['countryName']."</td>
	  </tr>
	  <tr>
		<td>Region</td>
		<td>".@$userLocation['regionName']."</td>
	  </tr>
	  <tr>
		<td>Time Zone</td>
		<td>".@$userLocation['timeZone']."</td>
	  </tr>
	</table>";

	$from='wadhawan.vivek@gmail.com';

	$headers = "From:".$from."\r\n";
	$headers .= "Bcc:kr.rakesh.sinha7@gmail.com"."\r\n";
	$headers .= 'Content-type: text/html;';
	if(mail($to, $subject, $message, $headers))
	{
		
		return true;
	}
}


function sendFullTailorMadeInfo($post)
{
	$userLocation=@getUserIpDetail();
	$to = 'sales@elegantjourneys.co';
	//$to='kr.rakesh.sinha7@gmail.com';
	$subject = 'Full information from tailor make a tour from '.$post['customerName'];
	$message="<table width=\"400\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\">
	  
	  <tr>
		<td>IP Address</td>
		<td>".$_SERVER['REMOTE_ADDR']."</td>
	  </tr>
	  <tr>
		<td>Client Name</td>
		<td>".$post['customerName']."</td>
	  </tr>
	  <tr>
		<td>Email ID</td>
		<td>".$post['customerEmail']."</td>
	  </tr>
	  <tr>
		<td>Phone</td>
		<td>".$post['customerPhone']."</td>
	  </tr>
	  <tr>
		<td>Country</td>
		<td>".$post['customerCountry']."</td>
	  </tr>
	   <tr>
		<td>Description</td>
		<td>".$post['tourDescription']."</td>
	  </tr>
	   <tr>
			<td colspan='2'><strong> Details retrieve from IP address</strong></td>
	  </tr>
	  <tr>
		<td>Country</td>
		<td>".@$userLocation['countryName']."</td>
	  </tr>
	  <tr>
		<td>Region</td>
		<td>".@$userLocation['regionName']."</td>
	  </tr>
	  <tr>
		<td>Time Zone</td>
		<td>".@$userLocation['timeZone']."</td>
	  </tr>
	</table>";

	$from='wadhawan.vivek@gmail.com';

	$headers = "From:".$from."\r\n";
	$headers .= "Bcc:kr.rakesh.sinha7@gmail.com"."\r\n";
	$headers .= 'Content-type: text/html;';
	if(mail($to, $subject, $message, $headers))
	{
		
		return true;
	}
}


function sendContactUsInfo($post)
{
	$userLocation=@getUserIpDetail();
	$to = 'sales@elegantjourneys.co';
	//$to='kr.rakesh.sinha7@gmail.com';
	$subject = 'Short information from contact us form from '.$post['customerName'];
	$message="<table width=\"400\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\">
	  
	  <tr>
		<td>IP Address</td>
		<td>".$_SERVER['REMOTE_ADDR']."</td>
	  </tr>
	  <tr>
		<td>Client Name</td>
		<td>".$post['customerName']."</td>
	  </tr>
	  <tr>
		<td>Email ID</td>
		<td>".$post['customerEmail']."</td>
	  </tr>
	  <tr>
		<td>Phone</td>
		<td>".$post['customerPhone']."</td>
	  </tr>
	   <tr>
			<td colspan='2'><strong> Details retrieve from IP address</strong></td>
	  </tr>
	  <tr>
		<td>Country</td>
		<td>".@$userLocation['countryName']."</td>
	  </tr>
	  <tr>
		<td>Region</td>
		<td>".@$userLocation['regionName']."</td>
	  </tr>
	  <tr>
		<td>Time Zone</td>
		<td>".@$userLocation['timeZone']."</td>
	  </tr>
	</table>";

	$from='wadhawan.vivek@gmail.com';

	$headers = "From:".$from."\r\n";
	$headers .= "Bcc:kr.rakesh.sinha7@gmail.com"."\r\n";
	$headers .= 'Content-type: text/html;';
	if(mail($to, $subject, $message, $headers))
	{
		
		return true;
	}
}




function sendFullContactUsInfo($post)
{
	$userLocation=@getUserIpDetail();
	$to = 'sales@elegantjourneys.co';
	//$to='kr.rakesh.sinha7@gmail.com';
	$subject = 'Full information from contact us form from '.$post['customerName'];
	$message="<table width=\"400\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\">
	  
	  <tr>
		<td>IP Address</td>
		<td>".$_SERVER['REMOTE_ADDR']."</td>
	  </tr>
	  <tr>
		<td>Client Name</td>
		<td>".$post['customerName']."</td>
	  </tr>
	  <tr>
		<td>Email ID</td>
		<td>".$post['customerEmail']."</td>
	  </tr>
	  <tr>
		<td>Phone</td>
		<td>".$post['customerPhone']."</td>
	  </tr>
	  <tr>
		<td>Country</td>
		<td>".$post['customerCountry']."</td>
	  </tr>
	   <tr>
		<td>Country</td>
		<td>".$post['customerRequirement']."</td>
	  </tr>
	   <tr>
			<td colspan='2'><strong> Details retrieve from IP address</strong></td>
	  </tr>
	  <tr>
		<td>Country</td>
		<td>".@$userLocation['countryName']."</td>
	  </tr>
	  <tr>
		<td>Region</td>
		<td>".@$userLocation['regionName']."</td>
	  </tr>
	  <tr>
		<td>Time Zone</td>
		<td>".@$userLocation['timeZone']."</td>
	  </tr>
	</table>";

	$from='wadhawan.vivek@gmail.com';

	$headers = "From:".$from."\r\n";
	$headers .= "Bcc:kr.rakesh.sinha7@gmail.com"."\r\n";
	$headers .= 'Content-type: text/html;';
	if(mail($to, $subject, $message, $headers))
	{
		
		return true;
	}
}


function getPriceColumnName($tourId)
{
	$strsqlPriceTitle = "select * from tbl_tour_price_heading where tour_id=".$tourId;
	$resultPriceTitle = mysql_query($strsqlPriceTitle);
	$infoPriceTitle = mysql_fetch_array($resultPriceTitle);

	$arrColumnsName = array();

	if($infoPriceTitle['affordable_level']=="")
	{
		$arrColumnsName['affordableLevel'] = 'Affordable Level Hotels';
	}
	else
	{
		$arrColumnsName['affordableLevel'] = $infoPriceTitle['affordable_level'];
	}

	if($infoPriceTitle['luxury_level']=="")
	{
		$arrColumnsName['luxuryLevel'] = 'Luxury Level Hotels';
	}
	else
	{
		$arrColumnsName['luxuryLevel'] = $infoPriceTitle['luxury_level'];
	}

	if($infoPriceTitle['royal_level']=="")
	{
		$arrColumnsName['royalLevel'] = 'Royal Level Hotels';
	}
	else
	{
		$arrColumnsName['royalLevel'] = $infoPriceTitle['royal_level'];
	}
	//print_r($arrColumnsName);
	return $arrColumnsName;
}
?>