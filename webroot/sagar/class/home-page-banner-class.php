<?php
include_once(BASEPATH."class/first-class.php");
class HomePageBanner extends FirstClass
{
	
	function getHomePageBannerList($data=array())
	{
		$this->setDatabaseConnection();
		$strsqlHomePageBanner = "select * from tbl_home_page_banner ";

		if((isset($data['sortBy']))&&(!empty($data['sortBy'])))
		{
			$strsqlHomePageBanner .=" order by ".$data['sortBy'];
		}

		$resultHomePageBanner = mysql_query($strsqlHomePageBanner);
		$partnersList = array();
		while($infoHomePageBanner = mysql_fetch_array($resultHomePageBanner,MYSQL_ASSOC))
		{
			$partnersList []=$infoHomePageBanner;
		}
		$this->closeDBConnection();
		return $partnersList;
	}

	function addNewHomePageBanner($post,$files)
	{
		
		$location = "testimonial/";
		$allowedExtension = array('jpg','jpeg','JPG','png','gif');
		$testimonialImageFilename=$this->uploadFileToDestination($files['image'],$location,$allowedExtension);
		
		if(!$testimonialImageFilename)
		{
			return false;
		}

		$this->setDatabaseConnection();
		$name = $this->filterReceivedData($post['name']);
		$country = $this->filterReceivedData($post['country']);
		$text = $this->filterReceivedData($post['text']);
		
		$strsqlHomePageBanner = "insert into tbl_home_page_banner (name, country, image, text) values('".$name."','".$country."','".$testimonialImageFilename."','".$text."')";
		if(mysql_query($strsqlHomePageBanner))
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

	function getHomePageBannerById($topMenuId)
	{
		if($topMenuId=="")
		{
			return;
		}
		$this->setDatabaseConnection();
		$topMenuId = $this->filterReceivedData($topMenuId);
		$strsqlHomePageBanner = "select * from tbl_home_page_banner where id=".$topMenuId;
		$resultHomePageBanner = mysql_query($strsqlHomePageBanner);
		$infoHomePageBanner = mysql_fetch_array($resultHomePageBanner,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoHomePageBanner;
	}

	function updateHomePageBanner($post,$files)
	{
		$guideDetail = $this->getHomePageBannerById($post['testimonialId']);
		$guideImageFilename=$guideDetail['image'];
		
		if($files['image']['name']!="")
		{
			$location = "testimonial/";
			$allowedExtension = array('jpg','jpeg','JPG','png','gif');
			$testimonialImageFilename=$this->uploadFileToDestination($files['image'],$location,$allowedExtension);
		}
		
		if(!$testimonialImageFilename)
		{
			return false;
		}

		$this->setDatabaseConnection();
		$name = $this->filterReceivedData($post['name']);
		$country = $this->filterReceivedData($post['country']);
		$text = $this->filterReceivedData($post['text']);
		$testimonialId = $this->filterReceivedData($post['testimonialId']);
		
		$strsqlHomePageBanner = "update tbl_home_page_banner set name='".$name."', country='".$country."', image='".$testimonialImageFilename."', text='".$text."' where id=".$testimonialId; 
		if(mysql_query($strsqlHomePageBanner))
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


	function deleteHomePageBanner($post)
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
			$strsqlHomePageBanner = "delete from tbl_home_page_banner where id=".$partnersId;
			if(mysql_query($strsqlHomePageBanner))
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