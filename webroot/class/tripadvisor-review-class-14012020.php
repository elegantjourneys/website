<?php
include_once(BASEPATH."class/first-class.php");
class TripadvisorReview extends FirstClass
{
	
	function getReviewList($data=array())
	{
		$this->setDatabaseConnection();
		$strsqlTestimonial = "select * from tbl_trivadvisor_review ";

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


	function getReviewRandomList($limit=4)
	{
		$this->setDatabaseConnection();
		$strsqlTestimonial = "select * from tbl_trivadvisor_review order by rand() limit 0,".$limit;
		$resultTestimonial = mysql_query($strsqlTestimonial);
		$partnersList = array();
		while($infoTestimonial = mysql_fetch_array($resultTestimonial,MYSQL_ASSOC))
		{
			$partnersList []=$infoTestimonial;
		}
		$this->closeDBConnection();
		return $partnersList;
	}

	function addNewReview($post,$files)
	{
		
		$location = "tripadvisor/";
		$allowedExtension = array('jpg','jpeg','JPG','png','gif');
		$testimonialImageFilename=$this->uploadFileToDestination($files['image'],$location,$allowedExtension);
		
		if(!$testimonialImageFilename)
		{
			return false;
		}

		$this->setDatabaseConnection();
		$name = $this->filterReceivedData($post['name']);
		$place = $this->filterReceivedData($post['place']);
		$reviewDate = $this->filterReceivedData($post['review_date']);
		$description = $this->filterReceivedData($post['description']);
		
		$strsqlTestimonial = "insert into tbl_trivadvisor_review (review_date, name, place, image, description) values('".$reviewDate."','".$name."','".$place."','".$testimonialImageFilename."','".$description."')";
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

	function getReviewById($topMenuId)
	{
		if($topMenuId=="")
		{
			return;
		}
		$this->setDatabaseConnection();
		$topMenuId = $this->filterReceivedData($topMenuId);
		$strsqlTestimonial = "select * from tbl_trivadvisor_review where id=".$topMenuId;
		$resultTestimonial = mysql_query($strsqlTestimonial);
		$infoTestimonial = mysql_fetch_array($resultTestimonial,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoTestimonial;
	}

	function updateReview($post,$files)
	{
		$reviewDetail = $this->getReviewById($post['reviewId']);
		$reviewImageFilename=$reviewDetail['image'];
		
		if($files['image']['name']!="")
		{
			$location = "tripadvisor/";
			$allowedExtension = array('jpg','jpeg','JPG','png','gif');
			$reviewImageFilename=$this->uploadFileToDestination($files['image'],$location,$allowedExtension);
		}
		
		if(!$reviewImageFilename)
		{
			return false;
		}

		$this->setDatabaseConnection();
		$reviewId = $this->filterReceivedData($post['reviewId']);
		$name = $this->filterReceivedData($post['name']);
		$place = $this->filterReceivedData($post['place']);
		$reviewDate = $this->filterReceivedData($post['review_date']);
		$description = $this->filterReceivedData($post['description']);
		
		$strsqlReview = "update tbl_trivadvisor_review set name='".$name."', place='".$place."', review_date='".$reviewDate."', image='".$reviewImageFilename."', description='".$description."' where id=".$reviewId; 
		if(mysql_query($strsqlReview))
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


	function deleteReview($post)
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
			$strsqlTestimonial = "delete from tbl_trivadvisor_review where id=".$partnersId;
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