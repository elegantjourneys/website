<?php 
include_once('../includes/config.php');
include_once(BASEPATH_CLASS.'first-class.php');
$objFirstClass = new FirstClass();
$objFirstClass->validate_admin();
$objFirstClass->setDatabaseConnection();
$action = $objFirstClass->filterReceivedData($_REQUEST['action']);
$objFirstClass->closeDBConnection();

switch($action)
{
	case 'getCryptUrl':
			$objFirstClass->setDatabaseConnection();
			$url = $objFirstClass->filterReceivedData($_POST['url']);
			$cryptUrl = $objFirstClass->incodeUrl($url);
			$json = array();
			if($cryptUrl!="")
			{
				$json = array(
								'result'=>'success',
								'cryptUrl' =>$cryptUrl
							);
			}
			else
			{
				$json = array(
								'result'=>'mail',
								'message' =>'There is an error during process your request. Please try again.'
							);

			}
			$objFirstClass->closeDBConnection();
			echo json_encode($json);
		break;
	case 'updateSpecialTourShortDescription':
			include_once(BASEPATH_CLASS.'subregion-class.php');
			$objSubregion = new Subregion();
			$spcialTourRegionId = $_POST['spcialTourRegionId'];
			$tourShortDescription = $_POST['tourShortDescription'];
			$objSubregion->updateTourShortDescription($spcialTourRegionId,$tourShortDescription);
			$json = array(
								'result'=>'success',
								'message' =>'Record has been saved.'
							);
			echo json_encode($json);
		break;
	case 'updateSpecialTourDays':
			include_once(BASEPATH_CLASS.'subregion-class.php');
			$objSubregion = new Subregion();
			$spcialTourRegionId = $_POST['spcialTourRegionId'];
			$totalDays = $_POST['totalDays'];
			$objSubregion->updateTourDays($spcialTourRegionId,$totalDays);
			$json = array(
								'result'=>'success',
								'message' =>'Record has been saved.'
							);
			echo json_encode($json);
		break;
	case 'manageCityOrder':
			include_once(BASEPATH_CLASS.'subregion-class.php');
			$objSubregion = new Subregion();
			$objSubregion->updateSpecialTourCityOrder($_POST);
			
		break;
	case 'updateTourDaysDescription':
			include_once(BASEPATH_CLASS.'special-tour-class.php');
			$objSpecialTour = new SpecialTour();
			$objSpecialTour->addTourDescription($_POST);
		break;
	case 'updateTourDetails':
			include_once(BASEPATH_CLASS.'special-tour-class.php');
			$objSpecialTour = new SpecialTour();
			$objSpecialTour->updateTourDescription($_POST);
		break;

}

?>