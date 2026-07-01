<?php 
session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
include_once("library/library.php");
validate_admin();

@extract($_REQUEST);
switch($_REQUEST['process'])
{
	case 'copyExistingTour':
		include_once('class/managetour.php');
		$objManageTour = new ManageTour();
		$arrInsertedIds=$objManageTour->copyExistingTourByIds($_POST);
		$insertedIds = implode(",",$arrInsertedIds);
		$url = 'ids='.$insertedIds;
		$cryptUrl = incodeUrl($url);
		header('location:copy-tour-list.php?eid='.$cryptUrl);
	break;

}

?>