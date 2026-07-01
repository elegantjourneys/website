<?php
include_once(BASEPATH."class/first-class.php");
class Blog extends FirstClass
{
	
	function getBlogList($data=array())
	{
		$objMysqli = $this->setMysqliConnection();
		$strsqlBlog = "select * from blogs";

		if((isset($data['sortBy']))&&(!empty($data['sortBy'])))
		{
			$strsqlBlog .=" order by ".$data['sortBy'];
		}

		$objResultBlog = $objMysqli->query($strsqlBlog);
		
		$blogList = array();
		while($infoBlog = $objResultBlog->fetch_array(MYSQLI_ASSOC))
		{
			####GETTING DESCRIPTION
			$strsqlBlogDescription = "select description from blog_descriptions where blog_id=".$infoBlog['id'];
			$objResultBlogDescription = $objMysqli->query($strsqlBlogDescription);
			
			$infoBlogDescription = $objResultBlogDescription->fetch_array(MYSQLI_ASSOC);

			$blogList[] = array(
										"id"			=>		$infoBlog['id'],
										"title"			=>		$infoBlog['title'],
										"page_url"		=>		$infoBlog['page_url'],
										"image"			=>		"https://dev.elegantjourneys.com/files/files/big/".$infoBlog['image'],
										"blog_date"	    =>		date("M j, Y",strtotime($infoBlog['modified'])),
										"description" 	=>		$infoBlogDescription['description']
										
										
							);
		}
		$this->closeMysqliConnection($objMysqli);
		return $blogList;
	}
	
	function getBlogIdByBlogPageURL($blogPageUrl)
	{
		$this->setDatabaseConnection();
		$strsqlBlogPageDesc = "select * from blogs where page_url ='".$blogPageUrl."'";
		$resultBlogPageDesc = mysql_query($strsqlBlogPageDesc);
		$infoBlogPageDesc = mysql_fetch_array($resultBlogPageDesc, MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoBlogPageDesc;
	}
	
	function getBlogDetail($blogId)
	{
		$objMysqli = $this->setMysqliConnection();
		$strsqlBlog = "select * from blogs where id ='".$blogId."'";

		$objResultBlog = $objMysqli->query($strsqlBlog);
		
		$blogList = array();
		while($infoBlog = $objResultBlog->fetch_array(MYSQLI_ASSOC))
		{
			####GETTING DESCRIPTION
			$strsqlBlogDescription = "select description from blog_descriptions where blog_id=".$infoBlog['id'];
			$objResultBlogDescription = $objMysqli->query($strsqlBlogDescription);
			
			$infoBlogDescription = $objResultBlogDescription->fetch_array(MYSQLI_ASSOC);

			$blogList = array(
										"id"			=>		$infoBlog['id'],
										"title"			=>		$infoBlog['title'],
										"page_url"		=>		$infoBlog['page_url'],
										"image"			=>		"https://dev.elegantjourneys.com/files/files/big/".$infoBlog['image'],
										"blog_date"	    =>		date("M j, Y",strtotime($infoBlog['modified'])),
										"description" 	=>		$infoBlogDescription['description']
										
										
							);
		}
		$this->closeMysqliConnection($objMysqli);
		return $blogList;
	}
	
	function getRecentBlog($blogPageUrl){
		$objMysqli = $this->setMysqliConnection();
		//$strsqlBlog = "select * from blogs ORDER BY modified DESC LIMIT 10";
		$blogPageUrl = str_replace('blog-', '', $blogPageUrl);
		$strsqlBlog = "SELECT * 
FROM blogs 
WHERE page_url != '".$blogPageUrl."' 
ORDER BY modified DESC 
LIMIT 10";

		$objResultBlog = $objMysqli->query($strsqlBlog);
		
		$blogList = array();
		while($infoBlog = $objResultBlog->fetch_array(MYSQLI_ASSOC))
		{
			

			$blogList[] = array(
										"id"			=>		$infoBlog['id'],
										"title"			=>		$infoBlog['title'],
										"page_url"		=>		$infoBlog['page_url'],
										"image"			=>		"https://dev.elegantjourneys.com/files/files/med/".$infoBlog['image'],
										"blog_date"	    =>		date("M j, Y",strtotime($infoBlog['modified']))										
							);
		}
		$this->closeMysqliConnection($objMysqli);
		return $blogList;
	}
	
}
?>