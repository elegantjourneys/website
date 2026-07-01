<?php
include_once(BASEPATH."class/first-class.php");
class CMSTourEvent extends FirstClass
{
	
	
	function getEventList($page=1,$otherParameters=array())
	{
		$this->setDatabaseConnection();

		$queryFilter="";								//condition added to filter city based on event
		if((isset($otherParameters['query_filter']))&&($otherParameters['query_filter']!=""))
		{
			$queryFilter = $otherParameters['query_filter'];
		}

		$startFrom = ($page-1)*PAGE_LIMIT_ADMIN;
		$strsqlInvoice = "select * from tbls_tour_events ".$queryFilter." limit ".$startFrom.",".PAGE_LIMIT_ADMIN;
		$resultInvoice = mysql_query($strsqlInvoice);
		$listInvoice = array();
		while($infoInvoice = mysql_fetch_array($resultInvoice,MYSQL_ASSOC))
		{
			$listInvoice[]=$infoInvoice;
		}
		$this->closeDBConnection();
		return $listInvoice;
	}

	function updateDayEventOrder($tourDayEvent, $orderSequence)
	{
		$this->setDatabaseConnection();
		$strsqlTourDayEvent = "update cms_tour_day_plan set day_orderno='".$orderSequence."' where id=".$tourDayEvent;
		mysql_query($strsqlTourDayEvent);
		$this->closeDBConnection();
	}

	function deleteEvent($eventId)
	{
		$this->setDatabaseConnection();
		$strsqlTourDayEvent = "delete from  tbls_tour_events where id=".$eventId;
		mysql_query($strsqlTourDayEvent);
		$this->closeDBConnection();
	}

	function updateTourDaySequence($tourDay, $tourId, $dayCount)
	{
		$this->setDatabaseConnection();
		$strsqlTourDayEvent = "update cms_tour_day_plan set day_count='".$dayCount."' where tour_id='".$tourId."' and day_count='".$tourDay."'";
		$resutlTourDayEvent = mysql_query($strsqlTourDayEvent);
		$this->closeDBConnection();
		return $resultTourDayEvent; 
		
	}

	function setRequestedTourOrder($data)
	{
		$this->setDatabaseConnection();
		
		$tourDayList = $data['tourDayList'];
		$tourId =  $data['tourId'];
		$dayCount = 1;
		$rearrangedEventList = array();
		$result = true;
		foreach($tourDayList as $tourDay)
		{
			$strsqlCurrentEvent = "select id from cms_tour_day_plan where day_count='".$tourDay."' and tour_id='".$tourId."'";
			$resultCurrentEvent = mysql_query($strsqlCurrentEvent);
			$eventIds = array();
			while($infoCurrentEvent=mysql_fetch_array($resultCurrentEvent))
			{
				$eventIds[]=$infoCurrentEvent['id'];
			}
			$rearrangedEventList[]=array(
											"dayCount"			=>		$dayCount,
											"eventIds"			=>		$eventIds
								);
			$dayCount++;
		}
		

		foreach($rearrangedEventList as $rearrangedEvent)
		{
			$dayCount = $rearrangedEvent['dayCount'];
			if(count($rearrangedEvent['eventIds'])>=1)
			{
				foreach($rearrangedEvent['eventIds'] as $eventId)
				{
					$strsqlEvent = "update cms_tour_day_plan set day_count='".$dayCount."' where id=".$eventId;
					$result = mysql_query($strsqlEvent);

					if(!$result)
					{
						$this->closeDBConnection();
						return $result;
					}
				}
			}
		}
		$this->closeDBConnection();
		return $result;
	}

	function setRequestedEventOrder($data)
	{
		$this->setDatabaseConnection();
		$dayId = $data[dayId];
		$tourId = $data[tourId];
		$tourDayEvents = $data[tourDayEvents];

		// getting tour events ids 
		$dayOrderno = 1;
		foreach($tourDayEvents as $tourDayEvent)
		{
			$strsqlEvent = "update cms_tour_day_plan set day_orderno='".$dayOrderno."' where id=".$tourDayEvent;
			$result = mysql_query($strsqlEvent);
			if(!$result)
			{
				$this->closeDBConnection();
				return $result;
			}
			$dayOrderno++;
		}
		$this->closeDBConnection();
		return $result;

	}

	function addBasicEventInformation($data,$files=array(),$dayImageList=array())
	{
		if((isset($data['eventId']))&&($data['eventId']!=""))
		{
			$eventId=$this->updateBasicEventInformation($data,$files,$dayImageList);
			return $eventId;
		}
		$this->setDatabaseConnection();
		$data['image']="";
		
		if(isset($files['name']))
		{	
			$allwedExtension = array("jpg","jpeg","JPG","png","gif");
			$location = 'gallery/events/';
			$fileName=$this->uploadFileToDestination($files,$location,$allwedExtension);
			$data['image']=$fileName;
		}
		
		$strsqlEvent = "insert into tbls_tour_events(name, short_name, subregion_id, code, duration, image_caption, unique_experience, image) values('".$data['name']."','".$data['short_name']."','".$data['subregion_id']."','".$data['code']."','".$data['duration']."','".$data['image_caption']."','".$data['unique_experience']."','".$data['image']."')";
		if(mysql_query($strsqlEvent))
		{
			$eventId = mysql_insert_id();
			$this->closeDBConnection();

			for($i=1;$i<=$data['duration'];$i++)
			{

				if((isset($dayImageList[$i]['name']))&&($dayImageList[$i]['name']!=""))
				{	
					$allwedExtension = array("jpg","jpeg","JPG","png","gif");
					$location = 'gallery/events/';
					$dayImageName=$this->uploadFileToDestination($files,$location,$allwedExtension);
					
				}

				$descriptionInfo = array(
											"tour_event_id"		=>	$eventId,
											"day_count"			=>	$i,
											"description"		=>	$data['description'][$i],
											"day_title"			=>	$data['day_title'][$i],
											"tour_highlight"	=>	$data['tour_highlight'][$i],
											"image"				=>	$dayImageName
								);

				$this->saveEventDescription($descriptionInfo);
			}

			return $eventId;
		}
		else
		{
			$this->closeDBConnection();
			return false;
		}
	}

	function getEventBasicInformation($eventId)
	{
		$this->setDatabaseConnection();
		$strsqlBasicInformation = "select * from tbls_tour_events where id=".$eventId;
		$resultBasicInformation = mysql_query($strsqlBasicInformation);
		$infoBasicInformation = mysql_fetch_array($resultBasicInformation,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoBasicInformation;
	}

	function updateBasicEventInformation($data,$files=array(),$dayImageList=array())
	{
		$this->setDatabaseConnection();
		$data['image']="";
		
		if((isset($files['name']))&&($files['name']!=""))
		{	
			$allwedExtension = array("jpg","jpeg","JPG","png","gif");
			$location = 'gallery/events/';
			$fileName=$this->uploadFileToDestination($files,$location,$allwedExtension);
			$data['image']=$fileName;
		}

		if($data['image']=="")
		{
			$strsqlEvent = "update tbls_tour_events set name='".$data['name']."', short_name='".$data['short_name']."', subregion_id='".$data['subregion_id']."', code='".$data['code']."', duration='".$data['duration']."', image_caption='".$data['image_caption']."', unique_experience='".$data['unique_experience']."' where id=".$data['eventId'];
		}
		else
		{
			$strsqlEvent = "update tbls_tour_events set name='".$data['name']."', short_name='".$data['short_name']."', code='".$data['code']."', subregion_id='".$data['subregion_id']."', image_caption='".$data['image_caption']."', unique_experience='".$data['unique_experience']."', image='".$data['image']."' where id=".$data['eventId'];
		}
		if(mysql_query($strsqlEvent))
		{
			$this->closeDBConnection();
			//updating event description
			$this->deleteAllEventDescription($data['eventId']);
			for($i=1;$i<=$data['duration'];$i++)
			{
				if((isset($dayImageList[$i]['name']))&&($dayImageList[$i]['name']!=""))
				{	
					$allwedExtension = array("jpg","jpeg","JPG","png","gif");
					$location = 'gallery/events/';
					$dayImageName=$this->uploadFileToDestination($dayImageList[$i],$location,$allwedExtension);
					
				}
				

				$descriptionInfo = array(
											"tour_event_id"		=>	$data['eventId'],
											"day_count"			=>	$i,
											"description"		=>	$data['description'][$i],
											"day_title"			=>	$data['day_title'][$i],
											"tour_highlight"	=>	$data['tour_highlight'][$i],
											"image"				=>	$dayImageName
								);

				$this->saveEventDescription($descriptionInfo);
				/*$descriptionInfo = array(
											"tour_event_id"		=>	$data['eventId'],
											"day_count"			=>	$i,
											"description"		=>	$data['description'][$i],
											"day_title"			=>	$data['day_title'][$i],
											"tour_highlight"	=>	$data['tour_highlight'][$i]
								);*/
				$this->saveEventDescription($descriptionInfo);
			}
			
			return $data['eventId'];
		}
		else
		{
			$this->closeDBConnection();
			return $data['eventId'];
		}

	}

	function deleteAllEventDescription($eventId)
	{
		$this->setDatabaseConnection();
		$strsqlDescription = "delete from tbls_tour_event_descriptions where tour_event_id=".$eventId;
		$resultDescription = mysql_query($strsqlDescription);
		$this->closeDBConnection();
		return $resultDescription;

	}
	
	function saveEventDescription($data)
	{
		$this->setDatabaseConnection();
		//checking event description entry
		
		$strsqlCheckDescription = "select id from tbls_tour_event_descriptions where tour_event_id=".$data['tour_event_id']." and day_count=".$data['day_count'];
		$resultCheckDescription = mysql_query($strsqlCheckDescription);
		if(mysql_num_rows($resultCheckDescription)>=1)
		{
			if((isset($data['image']))&&($data['image']!=""))
			{
				$strsqlEventDescription = "update tbls_tour_event_descriptions set description='".addslashes($data['description'])."', day_title='".$data['day_title']."', tour_highlight='".$data['tour_highlight']."', image='".$data['image']."' where tour_event_id=".$data['tour_event_id']." and day_count=".$data['day_count'];
			}
			else
			{
				$strsqlEventDescription = "update tbls_tour_event_descriptions set description='".addslashes($data['description'])."', day_title='".$data['day_title']."', tour_highlight='".$data['tour_highlight']."' where tour_event_id=".$data['tour_event_id']." and day_count=".$data['day_count'];
			}
		}
		else
		{
			if((isset($data['image']))&&($data['image']!=""))
			{
				$strsqlEventDescription = "insert into tbls_tour_event_descriptions( tour_event_id, day_count, description, day_title, image, tour_highlight) values(".$data['tour_event_id'].",".$data['day_count'].",'".addslashes($data['description'])."','".$data['day_title']."','".$data['image']."','".$data['tour_highlight']."')";

			}
			else
			{
				$strsqlEventDescription = "insert into tbls_tour_event_descriptions( tour_event_id, day_count, description, day_title, tour_highlight) values(".$data['tour_event_id'].",".$data['day_count'].",'".addslashes($data['description'])."','".$data['day_title']."','".$data['tour_highlight']."')";
			}
		}
		$resultEventDescription = mysql_query($strsqlEventDescription);
		
		if(mysql_query($resultEventDescription))
		{
			$this->closeDBConnection();
			return true;
		}
		else
		{
			$this->closeDBConnection();
			return false;
		}

	}
	function updateEventDescription($data)
	{
		$this->setDatabaseConnection();
		$strsqlBasicInformation = "update tbls_tour_events set description='".$data['description']."' where id=".$data['eventId'];
		$resultBasicInformation = mysql_query($strsqlBasicInformation);
		
		if(mysql_query($resultBasicInformation))
		{
			$this->closeDBConnection();
			return $data['eventId'];
		}
		else
		{
			$this->closeDBConnection();
			return $data['eventId'];
		}
		
	}

	function saveEventInclusion($data)
	{
		$eventId = $data['eventId'];
		$nextSequenceId = (($this->getLastInclusionOrder($eventId, 'event'))+1);
		$eventType = $data['eventType'];
		$dayCount = $data['day_count'];
		
		$this->setDatabaseConnection();
		$strsqlBasicInformation = "insert into tbls_inclusion_exclusion (incexctype, incexcdesc, use_default) values('1','".$data['event_inclusion']."','2')";
		mysql_query($strsqlBasicInformation);
		$inclusionId = mysql_insert_id();
		if($inclusionId=="")
		{
			return false;
		}
		
		$strsqlEventInclusion = "insert into tbls_event_inclusion_exclusion (event_id, inclusion_exclusion_id, inclusion_type, order_sequence, day_count) values('".$eventId."','".$inclusionId."','".$eventType."','".$nextSequenceId."','".$dayCount."')";
		$result= mysql_query($strsqlEventInclusion);
		$this->closeDBConnection();
		
		return $result;
	}

	function getLastInclusionOrder($eventId, $inclusionType='Tour')
	{
		$this->setDatabaseConnection();
		$strsqlEventInclusion = "select max(order_sequence) last_order_sequnce from tbls_event_inclusion_exclusion where event_id='".$eventId."' and inclusion_type='".$inclusionType."'";
		$resultEventInclusion = mysql_query($strsqlEventInclusion);
		$infoEventInclusion = mysql_fetch_array($resultEventInclusion,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoEventInclusion['last_order_sequnce'];
	}

	function getEventInclusion($eventId, $inclusionType='tour')
	{
		$this->setDatabaseConnection();
		$strsqlBasicInformation = "select * from tbls_event_inclusion_exclusion where event_id=".$eventId." and inclusion_type='".$inclusionType."' order by order_sequence";
		$resultBasicInformation = mysql_query($strsqlBasicInformation);
		$inclusionList = array();
		while($infoBasicInformation = mysql_fetch_array($resultBasicInformation,MYSQL_ASSOC))
		{
			// GETTING INCLUSION TEXT
			$strsqlInclusion = "select * from tbls_inclusion_exclusion where id=".$infoBasicInformation['inclusion_exclusion_id'];
			$resultInclusion = mysql_query($strsqlInclusion);
			$infoInclusion = mysql_fetch_array($resultInclusion,MYSQL_ASSOC);
			$inclusionList[]=array(
										"inclusionId"			=>		$infoInclusion['id'],
										"eventInclusionId"		=>		$infoBasicInformation['id'],
										"inclusion_text"		=>		$infoInclusion['incexcdesc'],
										"inclusion_type"		=>		"event"
				);

		}

		$this->closeDBConnection();
		return $inclusionList;

	}

	function getEventInclusionByDay($eventId, $inclusionType='tour', $dayCount=1)
	{
		$this->setDatabaseConnection();
		$strsqlBasicInformation = "select * from tbls_event_inclusion_exclusion where event_id=".$eventId." and inclusion_type='".$inclusionType."' and day_count=".$dayCount." order by order_sequence";
		$resultBasicInformation = mysql_query($strsqlBasicInformation);
		$inclusionList = array();
		while($infoBasicInformation = mysql_fetch_array($resultBasicInformation,MYSQL_ASSOC))
		{
			// GETTING INCLUSION TEXT
			$strsqlInclusion = "select * from tbls_inclusion_exclusion where id=".$infoBasicInformation['inclusion_exclusion_id'];
			$resultInclusion = mysql_query($strsqlInclusion);
			$infoInclusion = mysql_fetch_array($resultInclusion,MYSQL_ASSOC);
			$inclusionList[]=array(
										"inclusionId"			=>		$infoInclusion['id'],
										"eventInclusionId"		=>		$infoBasicInformation['id'],
										"inclusion_text"		=>		$infoInclusion['incexcdesc'],
										"inclusion_type"		=>		"event"
				);

		}

		$this->closeDBConnection();
		return $inclusionList;

	}



	function updateEventInclusion($data)
	{
		
		$this->setDatabaseConnection();
		$strsqlInclusion = "update tbls_inclusion_exclusion set incexcdesc='".$data['description']."' where id='".$data['inclusionId']."'";
		if(mysql_query($strsqlInclusion))
		{
			$this->closeDBConnection();
			return true;
		}
		else
		{
			$this->closeDBConnection();
			return false;
		}
		
	}

	function setRequestedEventInclusionOrder($data)
	{
		$this->setDatabaseConnection();
		$dayId = $data[dayId];
		$eventId = $data[eventId];
		$eventIds = $data[eventIds];

		// getting tour events ids 
		$dayOrderno = 1;
		foreach($eventIds as $eventId)
		{
			$strsqlEvent = "update tbls_event_inclusion_exclusion  set order_sequence='".$dayOrderno."' where id=".$eventId;
			$result = mysql_query($strsqlEvent);
			if(!$result)
			{
				$this->closeDBConnection();
				return $result;
			}
			$dayOrderno++;
		}
		$this->closeDBConnection();
		return $result;
	}

	function deleteEventInclusion($data)
	{
		$this->setDatabaseConnection();
		$inclusionId = $data['inclusionId'];
		$eventInclusionId = $data['eventInclusionId'];
		
		// deleting event relation table
		$strsqlEventInclusion = "delete from tbls_event_inclusion_exclusion where id =".$eventInclusionId;
		$result = mysql_query($strsqlEventInclusion);
		if(!$result)
		{
			return false;
		}

		$strsqlInclusion = "delete from tbls_inclusion_exclusion where id = ".$inclusionId;
		$result = mysql_query($strsqlInclusion);
		$this->closeDBConnection();
		return $result;
	}

	function deleteTourDay($data)
	{
		$this->setDatabaseConnection();
		// process to delete selected day
		$strsqlSelectedDay = "select * from cms_tour_day_plan where day_count =".$data['dayId']." and tour_id=".$data['tourId'];
		$resultSelectedDay = mysql_query($strsqlSelectedDay);
		while($infoSelectedDay = mysql_fetch_array($resultSelectedDay,MYSQL_ASSOC))
		{
			$strsqlTourDay = "delete from cms_tour_day_plan where id=".$infoSelectedDay['id'];
			mysql_query($strsqlTourDay);

			$strsqlTourDayDescription = "delete from cms_tour_day_description where tour_day_plan_id =".$infoSelectedDay['id'];
			mysql_query($strsqlTourDayDescription);

			
		}

		//decreasing day duration by one
		$strsqlTour = "select * from cms_managetour where id=".$data['tourId'];
		$resultTour = mysql_query($strsqlTour);
		$infoTour = mysql_fetch_array($resultTour,MYSQL_ASSOC);
		$newTourDuration = ($infoTour['tour_duration']-1);

		$strsqlTourUpdate = "update cms_managetour set tour_duration='".$newTourDuration."' where id=".$data['tourId'];
		mysql_query($strsqlTourUpdate);

		//updating remaining day list
		for($i=($data['dayId']+1);$i<=$infoTour['tour_duration'];$i++)
		{
			$strsqlDayShift = "update cms_tour_day_plan set day_count=".($i-1)." where day_count=".$i." and tour_id=".$data['tourId'];
			mysql_query($strsqlDayShift);
		}
		$this->closeDBConnection();
		return true;
		
	}


	function deleteEventImage($data)
	{
		$eventInformation = $this->getEventBasicInformation($data['eventId']);
		
		$this->setDatabaseConnection();
		
		$strsqlEventImage = "update tbls_tour_events set image='' where id=".$eventInformation['id'];
		$resultEventImage = mysql_query($strsqlEventImage);
		if($resultEventImage)
		{
			$fileLocation = BASEPATH_REPOSITERY.'gallery/events/'.$eventInformation['image'];
			unlink($fileLocation);
		}
		$this->closeDBConnection();
		return $resultEventImage;

	}

	function getEventCostDetail($eventCostId)
	{
		$this->setDatabaseConnection();
		$strsqlEventCost = "select * from tbls_travel_cost where id=".$eventCostId;
		$resultEventCost=mysql_query($strsqlEventCost);
		$infoEventCost = mysql_fetch_array($resultEventCost,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoEventCost;
		
	}

	function addEventCosting($data)
	{
		$this->setDatabaseConnection();
		$strsqlEventCost = "insert into cms_event_costing (event_id, cost_id, day_count) values('".$data['event_id']."','".$data['cost_id']."','".$data['day_count']."')";
		$resultEventCost=mysql_query($strsqlEventCost);
		$this->closeDBConnection();
		return $resultEventCost;
	}

	function addVehicleCosting($data)
	{
		
		$this->setDatabaseConnection();
		if($data['add_to_all_days']=='y')
		{
			$parentId = 0;
			$totalDays = $data['total_days'];
			for($i=1;$i<=$totalDays;$i++)
			{
					echo $strsqlEventCost = "insert into cms_vehicle_costing (parent_id, event_id, vehicle_cost_id, day_count) values('".$parentId."','".$data['event_id']."','".$data['vehicle_cost_id']."','".$i."')";
					$resultEventCost=mysql_query($strsqlEventCost);
					if($i==1)
					{
						$parentId = mysql_insert_id();
					}
			}
		}
		else
		{
			$strsqlEventCost = "insert into cms_vehicle_costing (event_id, vehicle_cost_id, day_count) values('".$data['event_id']."','".$data['vehicle_cost_id']."','".$data['day_count']."')";
			$resultEventCost=mysql_query($strsqlEventCost);
		}
		
		$this->closeDBConnection();
		return $resultEventCost;
	}

	function getEventCostList($data,$dayCount=1)
	{
		$this->setDatabaseConnection();
		$strsqlEventCost = "select id, cost_id, edited from cms_event_costing where event_id=".$data['event_id']." and day_count=".$dayCount." order by cost_order";
		$resultEventCost = mysql_query($strsqlEventCost);
		$eventCostList = array();
		while($infoEventCost = mysql_fetch_array($resultEventCost,MYSQL_ASSOC))
		{
			$strsqlCost = "select * from tbls_travel_cost where id=".$infoEventCost['cost_id'];
			$resultCost = mysql_query($strsqlCost);
			$infoCost = mysql_fetch_array($resultCost,MYSQL_ASSOC);

			// getting description if it is edited
			if($infoEventCost['edited']==1)
			{
				$eventCostDescription = "select * from cms_event_costing_description where event_costing_id=".$infoEventCost['id'];
				$resultEventDescription = mysql_query($eventCostDescription);
				$infoEventDescription = mysql_fetch_array($resultEventDescription,MYSQL_ASSOC);
				$infoCost['cost_name']=$infoEventDescription['description'];
			}
			
			$infoCost['event_cost_id']=$infoEventCost['id'];
			$eventCostList[]=$infoCost;
		}
		$this->closeDBConnection();
		return $eventCostList;

	}

	function getEventVehicleCostList($data,$dayCount=1)
	{
		$this->setDatabaseConnection();
		$strsqlEventCost = "select id, vehicle_cost_id from cms_vehicle_costing where event_id=".$data['event_id']." and day_count=".$dayCount." order by cost_order";
		$resultEventCost = mysql_query($strsqlEventCost);
		$eventCostList = array();
		while($infoEventCost = mysql_fetch_array($resultEventCost,MYSQL_ASSOC))
		{
			$strsqlCost = "select * from tbls_vehicle_price where id=".$infoEventCost['vehicle_cost_id'];
			$resultCost = mysql_query($strsqlCost);
			$infoCost = mysql_fetch_array($resultCost,MYSQL_ASSOC);
			$infoCost['vehicle_cost_id']=$infoEventCost['id'];
			$eventCostList[]=$infoCost;
		}
		$this->closeDBConnection();
		return $eventCostList;

	}

	function getEventUniqueExperience($data,$dayCount)
	{
		$this->setDatabaseConnection();
		$strsqlEventUniqueExperience = "select id, unique_experience_id, edited from tbls_event_unique_experience where event_id=".$data['event_id']." and day_count=".$dayCount." order by order_sequence";
		$resultEventUniqueExperience = mysql_query($strsqlEventUniqueExperience);
		$eventUniqueExperienceList = array();
		while($infoEventUniqueExperience = mysql_fetch_array($resultEventUniqueExperience,MYSQL_ASSOC))
		{

			$strsqlUniqueExperience = "select * from tbls_unique_experience where id=".$infoEventUniqueExperience['unique_experience_id'];
			$resultUniqueExperience = mysql_query($strsqlUniqueExperience);
			$infoUniqueExperience = mysql_fetch_array($resultUniqueExperience,MYSQL_ASSOC);

			// getting description if it is edited
			if($infoEventUniqueExperience['edited']==1)
			{
				$eventUniqueExperienceDescription = "select * from tbls_event_unique_experience_description where event_unique_experience_id=".$infoEventUniqueExperience['id'];
				$resultEventUniqueExperienceDescription = mysql_query($eventUniqueExperienceDescription);
				$infoUniqueExperienceDescription = mysql_fetch_array($resultEventUniqueExperienceDescription,MYSQL_ASSOC);
				$infoUniqueExperience['description']=$infoUniqueExperienceDescription['description'];
			}
			
			$infoUniqueExperience['event_unique_experience_id']=$infoEventUniqueExperience['id'];
			$eventUniqueExperienceList[]=$infoUniqueExperience;
		}
		$this->closeDBConnection();
		return $eventUniqueExperienceList;


	}

	function deleteEventCost($data)
	{
		// checking for description changed
		$this->setDatabaseConnection();
		$strsqlEventCost = "select id from cms_event_costing where edited=1 and id=".$data['event_cost_id'];
		$resultEventCost = mysql_query($strsqlEventCost);
		
		$strsqlEventCostDel = "delete from cms_event_costing where id=".$data['event_cost_id'];
		$resutlEventCostDel = mysql_query($strsqlEventCostDel);

		if($resutlEventCostDel)
		{
			// checking if edited
			if(mysql_num_rows($resultEventCost)>=1)
			{
				//deleting event cost edited description
				$strsqlEventCostDescription = "delete from cms_evvent_costing_description where event_costing_id=".$data['event_cost_id'];
				mysql_query($strsqlEventCostDescription);

			}
		}
		$this->closeDBConnection();
		return $resutlEventCostDel;
	}


	function deleteVehicleCost($data)
	{
		// checking for description changed
		$this->setDatabaseConnection();
		$strsqlEventCostDel = "delete from cms_vehicle_costing where id=".$data['vehicle_cost_id'];
		$resutlEventCostDel = mysql_query($strsqlEventCostDel);
		$this->closeDBConnection();
		return $resutlEventCostDel;
	}


	function updateEventCosting($data)
	{
		
		$this->setDatabaseConnection();
		//checking for edit mark in main table
		$strsqlEventCosting = "select edited from cms_event_costing where id=".$data['event_cost_id']." and edited=1";
		$resultEventCosting = mysql_query($strsqlEventCosting);
		if(mysql_num_rows($resultEventCosting)>=1)
		{
			$strsqlCostingDescription = "update cms_event_costing_description set description='".$data['description']."' where event_costing_id='".$data['event_cost_id']."'";
			$resultCostingDescription = mysql_query($strsqlCostingDescription);
		}
		else
		{
			$strsqlCostingDescription = "insert into cms_event_costing_description (event_costing_id, description) values(".$data['event_cost_id'].",'".$data['description']."')";
			$resultCostingDescription = mysql_query($strsqlCostingDescription);

			if($resultCostingDescription)
			{
				$strsqlEventCost = "update cms_event_costing set edited=1 where id=".$data['event_cost_id'];
				mysql_query($strsqlEventCost);
			}

		}

		$this->closeDBConnection();
		return $resultCostingDescription;
		
	}

	function getTourEventDescription($data)
	{
		$this->setDatabaseConnection();
		$strsqlEventDescription = "select day_title, description, tour_highlight, image from tbls_tour_event_descriptions where day_count=".$data['day_count']." and tour_event_id=".$data['tour_event_id'];
		$resultEventDescription = mysql_query($strsqlEventDescription);
		$infoEventDescription = mysql_fetch_array($resultEventDescription);
		$this->closeDBConnection();
		return $infoEventDescription;
	}

	function addEventUniqueExperience($data)
	{
		
		
		$nextSequenceId = (($this->getLastUniqueExperienceOrder($data['event_id'],$data['day_count']))+1);
				
		
		$this->setDatabaseConnection();
		$strsqlBasicInformation = "insert into tbls_unique_experience (description, experience_type) values('".$data['description']."','".$data['experience_type']."')";
		$resultBasicInformation = mysql_query($strsqlBasicInformation);
		$uniqueExperienceId = mysql_insert_id();
		if($uniqueExperienceId=="")
		{
			return false;
		}

		if($data['exclude_current_event']=='1')
		{
			return $resultBasicInformation;
		}
		
		$strsqlEventExperience = "insert into tbls_event_unique_experience (event_id, unique_experience_id, order_sequence, day_count) values('".$data['event_id']."','".$uniqueExperienceId."','".$nextSequenceId."','".$data['day_count']."')";
		$resultEventExperience= mysql_query($strsqlEventExperience);
		$this->closeDBConnection();
		
		return $resultEventExperience;
	}

	function getLastUniqueExperienceOrder($eventId, $dayCount)
	{
		$this->setDatabaseConnection();
		$strsqlEventInclusion = "select max(order_sequence) last_order_sequnce from  tbls_event_unique_experience where event_id='".$eventId."' and day_count='".$dayCount."'";
		$resultEventInclusion = mysql_query($strsqlEventInclusion);
		$infoEventInclusion = mysql_fetch_array($resultEventInclusion,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoEventInclusion['last_order_sequnce'];
	}

	function updateEventUniqueExperience($data)
	{
		
		$this->setDatabaseConnection();
		//checking for edit mark in main table
		$strsqlEventExperience = "select edited from tbls_event_unique_experience where id=".$data['unique_experience_id']." and edited=1";
		$resultEventExperience = mysql_query($strsqlEventExperience);
		if(mysql_num_rows($resultEventExperience)>=1)
		{
			$strsqlCostingDescription = "update tbls_event_unique_experience_description set description='".$data['description']."' where event_unique_experience_id='".$data['unique_experience_id']."'";
			$resultCostingDescription = mysql_query($strsqlCostingDescription);
		}
		else
		{
			$strsqlCostingDescription = "insert into tbls_event_unique_experience_description (event_unique_experience_id, description) values(".$data['unique_experience_id'].",'".$data['description']."')";
			$resultCostingDescription = mysql_query($strsqlCostingDescription);

			if($resultCostingDescription)
			{
				$strsqlEventCost = "update tbls_event_unique_experience set edited=1 where id=".$data['unique_experience_id'];
				mysql_query($strsqlEventCost);
			}

		}

		$this->closeDBConnection();
		return $resultCostingDescription;
		
	}

	function deleteUniqueExperience($data)
	{
		// checking for description changed
		$this->setDatabaseConnection();
		$strsqlEventCost = "select id from tbls_event_unique_experience where edited=1 and id=".$data['uniqueExperienceId'];
		$resultEventCost = mysql_query($strsqlEventCost);
		
		$strsqlEventCostDel = "delete from tbls_event_unique_experience where id=".$data['uniqueExperienceId'];
		$resutlEventCostDel = mysql_query($strsqlEventCostDel);

		if($resutlEventCostDel)
		{
			// checking if edited
			if(mysql_num_rows($resultEventCost)>=1)
			{
				//deleting event cost edited description
				$strsqlEventCostDescription = "delete from tbls_event_unique_experience_description where event_unique_experience_id=".$data['uniqueExperienceId'];
				mysql_query($strsqlEventCostDescription);

			}
		}
		$this->closeDBConnection();
		return $resutlEventCostDel;
	}

	function getEventInformation($eventId)
	{
		$this->setDatabaseConnection();
		$strsqlEvent = "select * from  tbls_tour_events where id=".$eventId;
		$resultEvent = mysql_query($strsqlEvent);
		$infoEvent = mysql_fetch_array($resultEvent,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoEvent;

	}

	function getTourHightlights($data)
	{
		$this->setDatabaseConnection();
		$tourId = $data['tourId'];
		// getting events of tours
		$strsqlEvents = "select event_id, event_day from cms_tour_day_plan where tour_id=".$tourId;
		$resultEvents = mysql_query($strsqlEvents);
		$tourEvents = array();
		while($infoEvents = mysql_fetch_array($resultEvents,MYSQL_ASSOC))
		{
			$tourEvents[]=array(	
									"event_id"              => $infoEvents['event_id'],
									"event_day"				=> $infoEvents['event_day']
				);

				
		}
		$this->closeDBConnection();
	}

}
?>