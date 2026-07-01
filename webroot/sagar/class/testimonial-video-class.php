<?php
include_once(BASEPATH."class/first-class.php");
class TestimonialVideo extends FirstClass
{
	
	function getTestimonialVideoList($data=array())
	{
		$this->setDatabaseConnection();
		$strsqlTestimonialVideo = "select * from tbl_testimonial_video ";

		if((isset($data['sortBy']))&&(!empty($data['sortBy'])))
		{
			$strsqlTestimonialVideo .=" order by ".$data['sortBy'];
		}

		$resultTestimonialVideo = mysql_query($strsqlTestimonialVideo);
		$partnersList = array();
		while($infoTestimonialVideo = mysql_fetch_array($resultTestimonialVideo,MYSQL_ASSOC))
		{
			$partnersList []=$infoTestimonialVideo;
		}
		$this->closeDBConnection();
		return $partnersList;
	}

	function getRandomTestimonial($limit)
	{
		$this->setDatabaseConnection();
		$strsqlTestimonialVideo = "select * from tbl_testimonial_video order by rand() limit 0,".$limit;
		$resultTestimonialVideo = mysql_query($strsqlTestimonialVideo);
		$partnersList = array();
		while($infoTestimonialVideo = mysql_fetch_array($resultTestimonialVideo,MYSQL_ASSOC))
		{
			$partnersList []=$infoTestimonialVideo;
		}
		$this->closeDBConnection();
		return $partnersList;
	}

	function addNewTestimonialVideo($post)
	{
		$this->setDatabaseConnection();
		$title = $this->filterReceivedData($post['title']);
		$videoCode = $this->filterReceivedData($post['video_code']);
		
		$strsqlTestimonialVideo = "insert into tbl_testimonial_video (title, video_code) values('".$title."','".$videoCode."')";
		if(mysql_query($strsqlTestimonialVideo))
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

	function getTestimonialVideoById($testimonialVideoId)
	{
		if($testimonialVideoId=="")
		{
			return;
		}
		$this->setDatabaseConnection();
		$testimonialVideoId = $this->filterReceivedData($testimonialVideoId);
		$strsqlTestimonialVideo = "select * from tbl_testimonial_video where id=".$testimonialVideoId;
		$resultTestimonialVideo = mysql_query($strsqlTestimonialVideo);
		$infoTestimonialVideo = mysql_fetch_array($resultTestimonialVideo,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoTestimonialVideo;
	}

	function updateTestimonialVideo($post)
	{

		$this->setDatabaseConnection();
		$title = $this->filterReceivedData($post['title']);
		$videoCode = $this->filterReceivedData($post['video_code']);
		$videoTestimonialId = $this->filterReceivedData($post['videoTestimonialId']);

		$strsqlTestimonialVideo = "update tbl_testimonial_video set title='".$title."', video_code='".$videoCode."' where id=".$videoTestimonialId;
		if(mysql_query($strsqlTestimonialVideo))
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

	function deleteTestimonialVideo($post)
	{
		if($post['testimonialIds']=="")
		{
			return;
		}
		$this->setDatabaseConnection();
		$testimonialIds = $this->filterReceivedData($post['testimonialIds']);
		$testimonialList = array();
		$testimonialList = explode(",",$testimonialIds);
		
		$countDelete = 0;
		foreach($testimonialList as $testimonialId)
		{
			$strsqlTestimonialVideo = "delete from tbl_testimonial_video where id=".$testimonialId;
			if(mysql_query($strsqlTestimonialVideo))
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