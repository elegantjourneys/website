<?php 
include_once("../includes/config.php");

switch($_REQUEST['method'])
{
	case 'getCustomTourPriceByHotel':
			include_once(BASEPATH_CRM_CLASS."cms-cost-class.php");
			$objCMSCost = new CMSCost();
			$data = $_POST;
			if($_POST['noOfPerson']=='2')
			{
				$roomsData[]='2####0####0'; #### ADDED FOR ROOM PRICE CALCULATION
			}
			else if($_POST['noOfPerson']=='1')
			{
				$roomsData[]='1####0####0'; #### ADDED FOR ROOM PRICE CALCULATION
			}
			else
			{
				$roomsData[]='2####0####0'; #### ADDED FOR ROOM PRICE CALCULATION
			}

			$data['rooms'] = $roomsData;
			$data['number_of_room']='1';
			$costList = $objCMSCost->getTourMonthPrice($data);
			//echo json_encode($costList);
		break;
	case 'getMonthCalendar':
			
			$filePath =  BASEPATH_CACHE_CALENDAR.'month_calendar_'.$_POST['month'].'_'.$_POST['year'].'.txt';
			if(file_exists($filePath))
			{
				
				$fh = fopen($filePath, 'r');
				$displayInformation = fread($fh,filesize($filePath));
				fclose($fh);
				
			}
			
			if($displayInformation=="")
			{
				include_once(BASEPATH_CRM_CLASS."fare-calendar.php");
				$objFareCalendar = new FareCalendar();
				$displayInformation = $objFareCalendar->generateFareCalendar($_POST['month'],$_POST['year']);
				$displayInformation = json_encode($displayInformation);
				$objFareCalendar->createCacheCalendar($displayInformation, $_POST['month'], $_POST['year']);
			}
			echo $displayInformation;
		break;
	case 'getCustomTourPriceOfDayByHotel':
				include_once(BASEPATH_CRM_CLASS."cms-cost-class.php");
				
				$objCMSCost = new CMSCost();
				$data = $_POST;

				$roomsData = array();
				$roomsData[]=$_POST['room1'];

				if($_POST['room1']=='')
				{
					$roomsData = array();
					$roomsData[]='2####0####0'; #### ADDED FOR ROOM PRICE CALCULATION
				}
				
				$data['rooms'] = $roomsData;
				$data['number_of_room']='1'; 
				#### FORMATTING DATE
				$data['tour_start_date'] = date("d-m-Y",strtotime($data['tour_start_date']));
				$costList = $objCMSCost->getTourOneDayPrice($data);
				echo json_encode($costList);
			break;
}

?>