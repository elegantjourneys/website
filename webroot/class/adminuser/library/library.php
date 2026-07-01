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


function setLoginHomePage($userType=0)
{
	switch($_SESSION['user']['user_type'])
	{
	       case '1':
			$pageName='faculty-dashboard.php';
	       break;
	       case '2':
			$pageName='student-edit-profile.php';
	       break;
	       case '4':
			$pageName='institute-edit-profile.php';
	       break;
	       default:
			$pageName='index.php';
	       break;
	}
	return $pageName;
}


function getUserLeftPanel($userType)
{
	switch($userType)
	{
		case 1:
		include_once("includes/faculty-leftbar.php");
		break;
		
		case 2:
		include_once("includes/student-leftbar.php");
		break;
		
		case 3:
		include_once("includes/professional-leftbar.php");
		break;
		
		case 4:
		include_once("includes/institute-leftbar.php");
		break;
		
		
	}

}

?>