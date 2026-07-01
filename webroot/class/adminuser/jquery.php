<?php 
session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
validate_admin();
@extract($_REQUEST);

switch($_REQUEST['action'])
{
	case 'updateRecordsListings':
		include_once('class/set-inclusion-exclusion.php');
		$objSetInclusion = new SetInclusion();
		$result=$objSetInclusion->setInclusionExclusionOrder($_POST);
		echo $result;
	break;
	case 'saveCopiedTour':
		include_once('class/managetour.php');
		$objManageTour = new ManageTour();
		$result=$objManageTour->saveCopiedTourById($_POST['tourId']);
		echo $result;
	break;
	case 'flushCopiedTour':
		include_once('class/managetour.php');
		$objManageTour = new ManageTour();
		$result=$objManageTour->flushCopiedTour();
		echo $result;
	break;
	case 'deleteTourExclusion':
		include_once('class/set-inclusion-exclusion.php');
		$objSetInclusion = new SetInclusion();
		$result=$objSetInclusion->deleteTourInclusionById($_POST['exclusionId']);
		echo $result;
	break;
	case 'autoSuggestText':
		include_once('class/managetour.php');
		$objManageTour = new ManageTour();
		$objManageTour->getSearchText($_REQUEST['q']);
		echo $result;
	case 'addExclusionInclusion':
		include_once('class/set-inclusion-exclusion.php');
		$objSetInclusion = new SetInclusion();
		$result=$objSetInclusion->addInclusionExclusion($_POST);
		echo $result;
	break;
	case 'removeExclusionInclusion':
		include_once('class/set-inclusion-exclusion.php');
		$objSetInclusion = new SetInclusion();
		$result=$objSetInclusion->removeInclusionExclusion($_POST);
		echo $result;
	break;
	case 'updatePriceField':
		include_once('class/tour-price-heading.php');
		$objTourPriceHeading = new TourPriceHeading();
		$result=$objTourPriceHeading->updateTourPriceHeading($_POST);
	break;
	case 'updateTourPriceField':
		include_once('class/tour-price-heading.php');
		$objTourPriceHeading = new TourPriceHeading();
		$result=$objTourPriceHeading->updateTourPriceData($_POST);
	break;

	


}

?>