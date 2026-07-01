<?php
include_once(BASEPATH."class/first-class.php");
class TravelGuide extends FirstClass
{
	
	function getTravelGuideList($data=array())
	{
		$this->setDatabaseConnection();
		$strsqlTravelGuide = "select * from tbl_travel_guides ";

		if((isset($data['sortBy']))&&(!empty($data['sortBy'])))
		{
			$strsqlTravelGuide .=" order by ".$data['sortBy'];
		}

		$resultTravelGuide = mysql_query($strsqlTravelGuide);
		$partnersList = array();
		while($infoTravelGuide = mysql_fetch_array($resultTravelGuide,MYSQL_ASSOC))
		{
			$partnersList []=$infoTravelGuide;
		}
		$this->closeDBConnection();
		return $partnersList;
	}

	function getRandomTravelGuideList($limit)
	{
		$this->setDatabaseConnection();
		$strsqlTravelGuide = "select * from tbl_travel_guides order by rand() limit 0,".$limit;
		$resultTravelGuide = mysql_query($strsqlTravelGuide);
		$partnersList = array();
		while($infoTravelGuide = mysql_fetch_array($resultTravelGuide,MYSQL_ASSOC))
		{
			$partnersList []=$infoTravelGuide;
		}
		$this->closeDBConnection();
		return $partnersList;
	}

	function addNewTravelGuide($post,$files)
	{
		
		$location = "guide/";
		$allowedExtension = array('jpg','jpeg','JPG','png','gif');
		$guideImageFilename=$this->uploadFileToDestination($files['image'],$location,$allowedExtension);
		
		if(!$guideImageFilename)
		{
			return false;
		}

		$this->setDatabaseConnection();
		$name = $this->filterReceivedData($post['name']);
		$expertise = $this->filterReceivedData($post['expertise']);
		
		$strsqlTravelGuide = "insert into tbl_travel_guides (name, expertise, image) values('".$name."','".$expertise."','".$guideImageFilename."')";
		if(mysql_query($strsqlTravelGuide))
		{
			$_SESSION['sess_msg']='Record has been saved in the list.';
			$this->closeDBConnection();
			return true;
		}
		else
		{
			$_SESSION['sess_msg']='Record was not added in the list. Please try again';
			$this->closeDBConnection();
			return false;
		}
	}

	function getTravelGuideById($topMenuId)
	{
		if($topMenuId=="")
		{
			return;
		}
		$this->setDatabaseConnection();
		$topMenuId = $this->filterReceivedData($topMenuId);
		$strsqlTravelGuide = "select * from tbl_travel_guides where id=".$topMenuId;
		$resultTravelGuide = mysql_query($strsqlTravelGuide);
		$infoTravelGuide = mysql_fetch_array($resultTravelGuide,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoTravelGuide;
	}

	function updateTravelGuide($post,$files)
	{
		$guideDetail = $this->getTravelGuideById($post['travelGuideId']);
		$guideImageFilename=$guideDetail['image'];
		
		if($files['image']['name']!="")
		{
			$location = "guide/";
			$allowedExtension = array('jpg','jpeg','JPG','png','gif');
			$guideImageFilename=$this->uploadFileToDestination($files['image'],$location,$allowedExtension);
		}
		
		if(!$guideImageFilename)
		{
			return false;
		}

		$this->setDatabaseConnection();
		$name = $this->filterReceivedData($post['name']);
		$expertise = $this->filterReceivedData($post['expertise']);
		$travelGuideId = $this->filterReceivedData($post['travelGuideId']);
		
		$strsqlTravelGuide = "update tbl_travel_guides set name='".$name."', expertise='".$expertise."', image='".$guideImageFilename."' where id=".$travelGuideId; 
		if(mysql_query($strsqlTravelGuide))
		{
			$_SESSION['sess_msg']='Record has been saved in the list.';
			$this->closeDBConnection();
			return true;
		}
		else
		{
			$_SESSION['sess_msg']='Record was not added in the list. Please try again';
			$this->closeDBConnection();
			return false;
		}

	}


	function deleteTravelGuide($post)
	{
		if($post['partnersIds']=="")
		{
			return;
		}
		$this->setDatabaseConnection();
		$partnersIds = $this->filterReceivedData($post['partnersIds']);
		$partnersIdsList = array();
		$partnersIdsList = explode(",",$partnersIds);
		
		$countDelete = 0;
		foreach($partnersIdsList as $partnersId)
		{
			$strsqlTravelGuide = "delete from tbl_travel_guides where id=".$partnersId;
			if(mysql_query($strsqlTravelGuide))
			{
				$countDelete++;
			}
		}

		if($countDelete>0)
		{
			$_SESSION['sess_msg']=$countDelete.' Record has been deleted from the list.';
			$this->closeDBConnection();
			return true;
		}
		else
		{
			$_SESSION['sess_msg']='Record was not deleted from the list. Please try again';
			$this->closeDBConnection();
			return false;
		}
	}

}
?>