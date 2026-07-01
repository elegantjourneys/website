<?php
include_once(BASEPATH."class/first-class.php");
class Partners extends FirstClass
{
	
	function getPartnersList($data=array())
	{
		$this->setDatabaseConnection();
		$strsqlPartners = "select * from tbl_partners ";

		if((isset($data['sortBy']))&&(!empty($data['sortBy'])))
		{
			$strsqlPartners .=" order by ".$data['sortBy'];
		}

		$resultPartners = mysql_query($strsqlPartners);
		$partnersList = array();
		while($infoPartners = mysql_fetch_array($resultPartners,MYSQL_ASSOC))
		{
			$partnersList []=$infoPartners;
		}
		$this->closeDBConnection();
		return $partnersList;
	}

	function addNewPartners($post,$files)
	{
		
		$location = "partners/";
		$allowedExtension = array('jpg','jpeg','JPG','png','gif');
		$colorImageFilename=$this->uploadFileToDestination($files['color_image'],$location,$allowedExtension);
		$blackWhiteImageFilename=$this->uploadFileToDestination($files['black_white_image'],$location,$allowedExtension);
		if(!$colorImageFilename)
		{
			return false;
		}

		if(!$blackWhiteImageFilename)
		{
			return false;
		}
		
		$this->setDatabaseConnection();
		$name = $this->filterReceivedData($post['name']);
		$link = $this->filterReceivedData($post['link']);
		
		$strsqlPartners = "insert into tbl_partners (name, link, color_image, black_white_image) values('".$name."','".$link."','".$colorImageFilename."','".$blackWhiteImageFilename."')";
		if(mysql_query($strsqlPartners))
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

	function getPartnersById($topMenuId)
	{
		if($topMenuId=="")
		{
			return;
		}
		$this->setDatabaseConnection();
		$topMenuId = $this->filterReceivedData($topMenuId);
		$strsqlPartners = "select * from tbl_partners where id=".$topMenuId;
		$resultPartners = mysql_query($strsqlPartners);
		$infoPartners = mysql_fetch_array($resultPartners,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoPartners;
	}

	function updatePartners($post,$files)
	{

		$partnersDetail = $this->getPartnersById($post['topMenuId']);
		
		$this->setDatabaseConnection();
		$topMenuId = $this->filterReceivedData($post['topMenuId']);
		$name = $this->filterReceivedData($post['name']);
		$link = $this->filterReceivedData($post['link']);

		$colorImageFilename = $partnersDetail['color_image'];
		$blackWhiteImageFilename = $partnersDetail['black_white_image'];

		$location = "partners/";
		$allowedExtension = array('jpg','jpeg','JPG','png','gif');
		
		if($files['color_image']['name']!="")
		{
			$colorImageFilename=$this->uploadFileToDestination($files['color_image'],$location,$allowedExtension);
		}

		if($files['black_white_image']['name']!="")
		{
			$blackWhiteImageFilename=$this->uploadFileToDestination($files['black_white_image'],$location,$allowedExtension);
		}
		
		$strsqlPartners = "update tbl_partners set name='".$name."', color_image='".$colorImageFilename."', black_white_image='".$blackWhiteImageFilename."', link='".$link."' where id=".$topMenuId;
		if(mysql_query($strsqlPartners))
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

	function deletePartners($post)
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
			$strsqlPartners = "delete from tbl_partners where id=".$partnersId;
			if(mysql_query($strsqlPartners))
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