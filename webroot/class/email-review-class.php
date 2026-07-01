<?php
include_once(BASEPATH."class/first-class.php");
class EmailReview extends FirstClass
{
	
	function getReviewList()
	{
		$this->setDatabaseConnection();
		$strsqlEmail = "select * from tbl_testimonial";

		
		$resultEmail = mysql_query($strsqlEmail);
		$emailList = array();
		while($infoEmail = mysql_fetch_array($resultEmail,MYSQL_ASSOC))
		{
			
			$emailList[] = array(
										"id"				=>		$infoEmail['id'],
										"name"				=>		$infoEmail['name'],
										"country"			=>		$infoEmail['country'],
										"text"				=>		$infoEmail['text'],
										
							);
		}
		$this->closeDBConnection();
		return $emailList;
	}


	

}
?>