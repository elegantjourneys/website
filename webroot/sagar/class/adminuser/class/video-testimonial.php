<?php
class VideoTestimonial
{
	public function getAllTestimonial()
	{
		$strsqlTestimonial = "select tbl_video_testimonial.id id, title, country, image, video_code, description from tbl_video_testimonial inner join tbl_video_testimonial_detail on tbl_video_testimonial.id = tbl_video_testimonial_detail.video_id order by title";
		$resultTestimonial = mysql_query($strsqlTestimonial);
		$testimonialList = array();
		while($infoTestimonial=mysql_fetch_array($resultTestimonial,MYSQL_ASSOC))
		{
			$testimonialList[]=$infoTestimonial;
		}
		return $testimonialList;
	}

	public function addNewTestimonial($post,$files)
	{
		//$strsqlTestimonial = ""
		$fileName='';
		if(!empty($files['name']))
		{
			$location='video/';
			$allowedExtension=array('jpg','gif','png','jpeg');
			$fileName=uploadFileToDestination($files,$location,$allowedExtension);
		}
		$strsqlTestimonial = "insert into tbl_video_testimonial (title, image, country, created, modified) values('".$post['title']."','".$fileName."','".$post['country']."','".time()."','".time()."')";
		if(mysql_query($strsqlTestimonial))
		{
			$testimonialId=mysql_insert_id();
			$strsqlTestimonialDesc = "insert into tbl_video_testimonial_detail(video_id, video_code, description, created, modified) values('".$testimonialId."','".$post['video_code']."','".$post['description']."','".time()."','".time()."')";

			if(mysql_query($strsqlTestimonialDesc))
			{
				$_SESSION['message']='Testimonial has been saved.';
				return true;
			}
			else
			{
				$_SESSION['message']='Testimonial was not saved. Please try again.';
				return true;

			}

		}

	}

	public function getTestimonialById($testimonialId)
	{
		$strsqlTestimonial = "select tbl_video_testimonial.id id, title, country, image, video_code, description from tbl_video_testimonial inner join tbl_video_testimonial_detail on tbl_video_testimonial.id = tbl_video_testimonial_detail.video_id where tbl_video_testimonial.id=".$testimonialId;
		$resultTestimonial = mysql_query($strsqlTestimonial);
		$infoTestimonial=mysql_fetch_array($resultTestimonial,MYSQL_ASSOC);
		return $infoTestimonial;

	}

}
?>