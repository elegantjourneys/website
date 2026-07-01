<?php
include_once(BASEPATH."class/first-class.php");
class WebsiteSection extends FirstClass
{
	
	function getWebsiteSectionList($data=array())
	{
		$this->setDatabaseConnection();
		$strsqlWebsiteSection = "select * from tbl_website_sections ";

		if((isset($data['sortBy']))&&(!empty($data['sortBy'])))
		{
			$strsqlWebsiteSection .=" order by ".$data['sortBy'];
		}

		$resultWebsiteSection = mysql_query($strsqlWebsiteSection);
		$partnersList = array();
		while($infoWebsiteSection = mysql_fetch_array($resultWebsiteSection,MYSQL_ASSOC))
		{
			$partnersList []=$infoWebsiteSection;
		}
		$this->closeDBConnection();
		return $partnersList;
	}

	function addNewWebsiteSection($post,$files)
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
		
		$strsqlWebsiteSection = "insert into tbl_website_sections (name, country, image, text) values('".$name."','".$country."','".$testimonialImageFilename."','".$text."')";
		if(mysql_query($strsqlWebsiteSection))
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

	function getWebsiteSectionById($websiteSectionId)
	{
		if($websiteSectionId=="")
		{
			return;
		}
		$this->setDatabaseConnection();
		$websiteSectionId = $this->filterReceivedData($websiteSectionId);
		$strsqlWebsiteSection = "select * from tbl_website_sections where id=".$websiteSectionId;
		$resultWebsiteSection = mysql_query($strsqlWebsiteSection);
		$infoWebsiteSection = mysql_fetch_array($resultWebsiteSection,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoWebsiteSection;
	}

	function updateWebsiteSection($post)
	{
		$this->setDatabaseConnection();
		$title = $this->filterReceivedData($post['title']);
		$description = $post['description'];
		$websiteSectionId = $this->filterReceivedData($post['websiteSectionId']);
		
		$strsqlWebsiteSection = "update tbl_website_sections set title='".$title."' where id=".$websiteSectionId; 
		if(mysql_query($strsqlWebsiteSection))
		{
			$this->closeDBConnection();
			$this->updateWebsiteSectionDescription($websiteSectionId, $description);
			$_SESSION['sess_msg']='Record has been saved in the list.';
			return true;
		}
		else
		{
			$_SESSION['sess_msg']='Record was not added in the list. Please try again';
			$this->closeDBConnection();
			return false;
		}
		

	}

	function updateWebsiteSectionDescription($websiteSectionId, $description)
	{
		$this->setDatabaseConnection();
		$websiteSectionId = $this->filterReceivedData($websiteSectionId);
		
				
		$strsqlWebsiteSection = "update tbl_website_sections_detail set description='".$description."' where section_id=".$websiteSectionId; 
		if(mysql_query($strsqlWebsiteSection))
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


	function deleteWebsiteSection($post)
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
			$strsqlWebsiteSection = "delete from tbl_website_sections where id=".$partnersId;
			if(mysql_query($strsqlWebsiteSection))
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

	function getGroupNameById($websiteSectionGroupId)
	{
		$this->setDatabaseConnection();
		$strsqlWebsiteSection = "select name from tbl_website_sections_group where id=".$websiteSectionGroupId;
		$resultWebsiteSection = mysql_query($strsqlWebsiteSection);
		$infoWebsiteSection = mysql_fetch_array($resultWebsiteSection,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoWebsiteSection['name'];
	}

	function getWebsiteDesriptionBySectionId($websiteSectionId)
	{
		$this->setDatabaseConnection();
		$strsqlWebsiteSection = "select description from tbl_website_sections_detail where id=".$websiteSectionId;
		$resultWebsiteSection = mysql_query($strsqlWebsiteSection);
		$infoWebsiteSection = mysql_fetch_array($resultWebsiteSection,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoWebsiteSection['description'];
	}

	function getWebsiteDesriptionSampleBySectionId($websiteSectionId)
	{
		$this->setDatabaseConnection();
		$strsqlWebsiteSection = "select description from tbl_website_sections_detail_sample where id=".$websiteSectionId;
		$resultWebsiteSection = mysql_query($strsqlWebsiteSection);
		$infoWebsiteSection = mysql_fetch_array($resultWebsiteSection,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoWebsiteSection['description'];
	}

	function getWebsiteSectionByCode($sectionCode)
	{
		$this->setDatabaseConnection();
		$strsqlWebsiteSection = "select description from tbl_website_sections_detail where section_id = (select id from tbl_website_sections where section_code='".$sectionCode."' )";
		$resultWebsiteSection = mysql_query($strsqlWebsiteSection);
		$infoWebsiteSection = mysql_fetch_array($resultWebsiteSection,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoWebsiteSection['description'];

	}

}
?>