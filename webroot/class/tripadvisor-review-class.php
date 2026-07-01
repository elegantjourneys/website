<?php
include_once(BASEPATH."class/first-class.php");
class TripadvisorReview extends FirstClass
{
	
	function getReviewList($data=array())
	{
		$objMysqli = $this->setMysqliConnection();
		$strsqlTestimonial = "select * from tbls_tripadvisor_reviews";

		if((isset($data['sortBy']))&&(!empty($data['sortBy'])))
		{
			$strsqlTestimonial .=" order by ".$data['sortBy'];
		}

		$objResultTestimonial = $objMysqli->query($strsqlTestimonial);
		
		$testimonialList = array();
		while($infoTestimonial = $objResultTestimonial->fetch_array(MYSQLI_ASSOC))
		{
			####GETTING DESCRIPTION
			$strsqlTestimonialDetail = "select short_description, long_description from tbls_tripadvisor_review_details where review_id=".$infoTestimonial['id'];
			$objResultTestimonialDetail = $objMysqli->query($strsqlTestimonialDetail);
			
			$infoTestimonialDetail = $objResultTestimonialDetail->fetch_array(MYSQLI_ASSOC);

			$testimonialList[] = array(
										"id"				=>		$infoTestimonial['id'],
										"name"				=>		$infoTestimonial['name'],
										"place"				=>		$infoTestimonial['place'],
										"image"				=>		$infoTestimonial['image'],
										"review_date"	    =>		$infoTestimonial['review_date'],
										"short_description" =>		$infoTestimonialDetail['short_description'],
										"long_description"	=>		$infoTestimonialDetail['long_description']
										
							);
		}
		$this->closeMysqliConnection($objMysqli);
		return $testimonialList;
	}


	function getReviewRandomList($limit=4)
	{
		$objMysqli = $this->setMysqliConnection();
		$strsqlTestimonial = "select * from tbls_tripadvisor_reviews order by rand() limit 0,".$limit;
		$objResultTestimonial = $objMysqli->query($strsqlTestimonial);
		$partnersList = array();
		while($infoTestimonial = $objResultTestimonial->fetch_array(MYSQLI_ASSOC))
		{
			####GETTING DESCRIPTION
			$strsqlTestimonialDetail = "select short_description, long_description from tbls_tripadvisor_review_details where review_id=".$infoTestimonial['id'];
			$objResultTestimonialDetail = $objMysqli->query($strsqlTestimonialDetail);
			$infoTestimonialDetail = $objResultTestimonialDetail->fetch_array(MYSQLI_ASSOC);

			$testimonialList[]= array(
										"id"				=>		$infoTestimonial['id'],
										"name"				=>		$infoTestimonial['name'],
										"place"				=>		$infoTestimonial['place'],
										"image"				=>		$infoTestimonial['image'],
										"review_date"	    =>		$infoTestimonial['review_date'],
										"short_description" =>		$infoTestimonialDetail['short_description'],
										"long_description"	=>		$infoTestimonialDetail['long_description']
							);


			
		}
		$this->closeMysqliConnection($objMysqli);
		return $testimonialList;
	}

	function addNewReview($post,$files)
	{
		
		//$location = "tripadvisor/";
		//$allowedExtension = array('jpg','jpeg','JPG','png','gif');
		//$testimonialImageFilename=$this->uploadFileToDestination($files['image'],$location,$allowedExtension);
		
		/*if(!$testimonialImageFilename)
		{
			return false;
		}*/

		$this->setDatabaseConnection();
		$name = $this->filterReceivedData($post['name']);
		$place = $this->filterReceivedData($post['place']);
		$reviewDate = $this->filterReceivedData($post['review_date']);
		$description = $this->filterReceivedData($post['description']);
		$shortDescription = $this->filterReceivedData($post['short_description']);
		
		$strsqlTestimonial = "insert into tbls_tripadvisor_reviews (review_date, name, place, image) values('".$reviewDate."','".$name."','".$place."','".$testimonialImageFilename."')";
		if(mysql_query($strsqlTestimonial))
		{
			$reviewId = mysql_insert_id();

			$strsqlTestimonialDet = "insert into tbls_tripadvisor_review_details  (review_id , short_description, long_description) values('".$reviewId."','".$shortDescription."','".$description."')";
			mysql_query($strsqlTestimonialDet);
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
			$strsqlTestimonial = "delete from tbls_tripadvisor_reviews where id=".$partnersId;
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