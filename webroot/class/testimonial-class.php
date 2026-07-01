<?php
include_once(BASEPATH."class/first-class.php");
class Testimonial extends FirstClass
{
	
	function getTestimonialList($data=array())
	{
		$this->setDatabaseConnection();
		$strsqlTestimonial = "select * from tbl_testimonial ";

		if((isset($data['sortBy']))&&(!empty($data['sortBy'])))
		{
			$strsqlTestimonial .=" order by ".$data['sortBy'];
		}

		$resultTestimonial = mysql_query($strsqlTestimonial);
		$partnersList = array();
		while($infoTestimonial = mysql_fetch_array($resultTestimonial,MYSQL_ASSOC))
		{
			$partnersList []=$infoTestimonial;
		}
		$this->closeDBConnection();
		return $partnersList;
	}


	function getTestimonialRandomList($limit)
	{
		$this->setDatabaseConnection();
		$strsqlTestimonial = "select * from tbl_testimonial order by rand() limit 0,".$limit;
		$resultTestimonial = mysql_query($strsqlTestimonial);
		$partnersList = array();
		while($infoTestimonial = mysql_fetch_array($resultTestimonial,MYSQL_ASSOC))
		{
			$partnersList []=$infoTestimonial;
		}
		$this->closeDBConnection();
		return $partnersList;
	}

	function addNewTestimonial($post,$files)
	{
		$testimonialImageFilename="";
		if($files['image']['name']=="")
		{
			$location = "testimonial/";
			$allowedExtension = array('jpg','jpeg','JPG','png','gif');
			$testimonialImageFilename=$this->uploadFileToDestination($files['image'],$location,$allowedExtension);
		}
		
		/*if(!$testimonialImageFilename)
		{
			return false;
		}*/

		$this->setDatabaseConnection();
		$name = $this->filterReceivedData($post['name']);
		$country = $this->filterReceivedData($post['country']);
		$text = $this->filterReceivedData($post['text']);
		$fullText = addslashes($post['full_text']);
		
		$strsqlTestimonial = "insert into tbl_testimonial (name, country, image, text, full_text) values('".$name."','".$country."','".$testimonialImageFilename."','".$text."','".$fullText."')";
		if(mysql_query($strsqlTestimonial))
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

	function getTestimonialById($topMenuId)
	{
		if($topMenuId=="")
		{
			return;
		}
		$this->setDatabaseConnection();
		$topMenuId = $this->filterReceivedData($topMenuId);
		$strsqlTestimonial = "select * from tbl_testimonial where id=".$topMenuId;
		$resultTestimonial = mysql_query($strsqlTestimonial);
		$infoTestimonial = mysql_fetch_array($resultTestimonial,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoTestimonial;
	}

	function updateTestimonial($post,$files)
	{
		$guideDetail = $this->getTestimonialById($post['testimonialId']);
		$guideImageFilename=$guideDetail['image'];
		
		if($files['image']['name']!="")
		{
			$location = "testimonial/";
			$allowedExtension = array('jpg','jpeg','JPG','png','gif');
			$testimonialImageFilename=$this->uploadFileToDestination($files['image'],$location,$allowedExtension);
		}
		
		/*if(!$testimonialImageFilename)
		{
			return false;
		}*/

		$this->setDatabaseConnection();
		$name = $this->filterReceivedData($post['name']);
		$country = $this->filterReceivedData($post['country']);
		$text = $this->filterReceivedData($post['text']);
		$fullText = addslashes($post['full_text']);
		$testimonialId = $this->filterReceivedData($post['testimonialId']);
		
		$strsqlTestimonial = "update tbl_testimonial set name='".$name."', country='".$country."', image='".$testimonialImageFilename."', text='".$text."', full_text='".$fullText."' where id=".$testimonialId; 
		if(mysql_query($strsqlTestimonial))
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


	function deleteTestimonial($post)
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
			$strsqlTestimonial = "delete from tbl_testimonial where id=".$partnersId;
			if(mysql_query($strsqlTestimonial))
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