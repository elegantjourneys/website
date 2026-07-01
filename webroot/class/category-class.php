<?php
include_once(BASEPATH."class/first-class.php");
class Category extends FirstClass
{
	
	function getCategoryList($data=array())
	{
		$this->setDatabaseConnection();
		$strsqlCategory = "select * from tbl_category ";

		if(isset($data['parentId']))
		{
			$strsqlCategory .=" where parent_id= ".$data['parentId'];
		}

		if((isset($data['sortBy']))&&(!empty($data['sortBy'])))
		{
			$strsqlCategory .=" order by ".$data['sortBy'];
		}
		
		$resultCategory = mysql_query($strsqlCategory);
		$partnersList = array();
		while($infoCategory = mysql_fetch_array($resultCategory,MYSQL_ASSOC))
		{
			$partnersList []=$infoCategory;
		}
		$this->closeDBConnection();
		return $partnersList;
	}

	function addNewCategory($post,$files)
	{
		
		$location = "category/";
		$allowedExtension = array('jpg','jpeg','JPG','png','gif');
		$categoryImageFilename=$this->uploadFileToDestination($files['image'],$location,$allowedExtension);
		
		if(!$categoryImageFilename)
		{
			return false;
		}

		$this->setDatabaseConnection();
		$parentId = $this->filterReceivedData($post['parent_id']);
		$name = $this->filterReceivedData($post['name']);
		$categoryUrl = $this->filterReceivedData($post['category_url']);
		
		$strsqlCategory = "insert into tbl_category (parent_id, name, category_url, image) values('".$parentId."','".$name."','".$categoryUrl."','".$categoryImageFilename."')";
		if(mysql_query($strsqlCategory))
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

	function getCategoryById($topMenuId)
	{
		if($topMenuId=="")
		{
			return;
		}
		$this->setDatabaseConnection();
		$topMenuId = $this->filterReceivedData($topMenuId);
		$strsqlCategory = "select * from tbl_category where id=".$topMenuId;
		$resultCategory = mysql_query($strsqlCategory);
		$infoCategory = mysql_fetch_array($resultCategory,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoCategory;
	}


	function getCategoryByUrl($categoryUrl)
	{
		if($categoryUrl=="")
		{
			return;
		}
		$this->setDatabaseConnection();
		$categoryUrl = $this->filterReceivedData($categoryUrl);
		$strsqlCategory = "select * from tbl_category where category_url='".$categoryUrl."'";
		$resultCategory = mysql_query($strsqlCategory);
		$infoCategory = mysql_fetch_array($resultCategory,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoCategory;
	}



	function getCategoryDetailById($topMenuId)
	{
		if($topMenuId=="")
		{
			return;
		}
		$this->setDatabaseConnection();
		$topMenuId = $this->filterReceivedData($topMenuId);
		$strsqlCategory = "select * from tbl_category_detail where category_id=".$topMenuId;
		$resultCategory = mysql_query($strsqlCategory);
		$infoCategory = mysql_fetch_array($resultCategory,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoCategory;
	}

	function updateCategory($post,$files)
	{
		$categoryDetail = $this->getCategoryById($post['categoryId']);
		
		$categoryImageFilename=$guideDetail['image'];
		
		if($files['image']['name']!="")
		{
			$location = "category/";
			$allowedExtension = array('jpg','jpeg','JPG','png','gif');
			$categoryImageFilename=$this->uploadFileToDestination($files['image'],$location,$allowedExtension);
		}
		
		if(!$categoryImageFilename)
		{
			return false;
		}
		
		$this->setDatabaseConnection();
		$parentId = $this->filterReceivedData($post['parent_id']);
		$name = $this->filterReceivedData($post['name']);
		$categoryUrl = $this->filterReceivedData($post['category_url']);
		$categoryId = $this->filterReceivedData($post['categoryId']);
		
		$strsqlCategory = "update tbl_category set parent_id='".$parentId."', name='".$name."', image='".$categoryImageFilename."', category_url='".$categoryUrl."' where id=".$categoryId; 
		if(mysql_query($strsqlCategory))
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


	function deleteCategory($post)
	{
		
		if($post['categoryIds']=="")
		{
			return;
		}
		$this->setDatabaseConnection();
		$partnersIds = $this->filterReceivedData($post['categoryIds']);
		$partnersIdsList = array();
		$partnersIdsList = explode(",",$partnersIds);
		
		$countDelete = 0;
		foreach($partnersIdsList as $partnersId)
		{
			$strsqlCategory = "delete from tbl_category where id=".$partnersId;
			if(mysql_query($strsqlCategory))
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

	function createCategoryBreadCrumb($categoryInfo)
	{
		$breadCrumbs = array();
		$breadCrumbs[]=array(
								'link'=>WEBROOT,
								'text'=>'Home'
						);
		$breadCrumbs[]=array(
								'link'=>'',
								'text'=>$categoryInfo['name']
						);
		return $breadCrumbs;
		
	}

	function getCategoryTours($categoryId,$data=array())
	{
		$this->setDatabaseConnection();
		$categoryId = $this->filterReceivedData($categoryId);
		$strsqlCategory = "select tour_id from tbl_tour_categories where category_id=".$categoryId;

		if((isset($data['sortBy']))&&(!empty($data['sortBy'])))
		{
			$strsqlCategory .=" order by ".$data['sortBy'];
		}

		$resultCategory = mysql_query($strsqlCategory);
		$categoryList = array();
		while($infoCategory = mysql_fetch_array($resultCategory,MYSQL_ASSOC))
		{
			$categoryList[]=$infoCategory['tour_id'];
		}
		$this->closeDBConnection();
		return $categoryList;

	}

	function getCategoriesByTourId($tourId)
	{
		$this->setDatabaseConnection();
		$categoryId = $this->filterReceivedData($categoryId);
		$strsqlCategory = "select category_id from tbl_tour_categories where tour_id=".$tourId;
		$resultCategory = mysql_query($strsqlCategory);
		$categoryList = array();
		while($infoCategory = mysql_fetch_array($resultCategory,MYSQL_ASSOC))
		{
			
			$categoryList[]=$infoCategory['category_id'];
		}
		$this->closeDBConnection();
		$categoryList = array_unique($categoryList);
		return $categoryList;

	}

	function addTourCategories($arrCategoryIds,$tourId)
	{
		$this->setDatabaseConnection();
		foreach($arrCategoryIds as $categoryId)
		{
			$strsqlTourCategories = "insert into tbl_tour_categories (category_id, tour_id) values(".$categoryId.",".$tourId.")";
			mysql_query($strsqlTourCategories);
		}
		$this->closeDBConnection();
	}

	function removeTourCategories($tourId)
	{
		$this->setDatabaseConnection();
		$strsqlTourCategory = "delete from tbl_tour_categories where tour_id=".$tourId;
		mysql_query($strsqlTourCategory);
		$this->closeDBConnection();
	}

	function updateTourCategories($categoryIds,$tourId)
	{
		$arrCategoryIds = explode(",",$categoryIds);
		$this->removeTourCategories($tourId);
		$this->addTourCategories($arrCategoryIds,$tourId);
		return;
	}

	function getCategoryDetail($categoryId)
	{
		$this->setDatabaseConnection();
		$strsqlCategoryDesc = "select * from tbl_category_detail where category_id=".$categoryId;
		$resultCategoryDesc= mysql_query($strsqlCategoryDesc);
		$infoCategoryDesc = mysql_fetch_array($resultCategoryDesc,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoCategoryDesc;
	}

	function getCategoryMetaTags($categoryId)
	{
		if($categoryId=="")
		{
			return;
		}

		$this->setDatabaseConnection();
		
		$strsqlCategoryMeta = "select * from  tbl_category_seo_tags  where category_id=".$categoryId;
		$resultCategoryMeta= mysql_query($strsqlCategoryMeta);
		$infoCategoryMeta = mysql_fetch_array($resultCategoryMeta,MYSQL_ASSOC);
		
		

		$this->closeDBConnection();

		$metaTags = array(
								"meta_title"			=>		$infoCategoryMeta['meta_title'],
								"meta_description"		=>		$infoCategoryMeta['meta_description'],
								"meta_keyword"			=>		$infoCategoryMeta['meta_keyword'],
								"og_title"				=>		$infoCategoryMeta['meta_title'],
								"page_url"				=>		$this->getPageUrl(),
								"og_description"		=>		$infoCategoryMeta['meta_description'],
								"og_image"				=>		'https://wwww.elegantjourneys.com/img/banner/img-01.jpg'
					);
		return $metaTags;	
	}
	
	function getCategoryIdByTourPageAndId($data=array())
	{
		$this->setDatabaseConnection();
		$strsqlTourCategory = "select * from  tbl_tour_category where tour_page_id=".$data['tour_page_id']." and tour_id=".$data['tour_id'];
		$resultTourCategory = mysql_query($strsqlTourCategory);
		$infoTourCategory = mysql_fetch_array($resultTourCategory,MYSQL_ASSOC);
		
		$this->closeDBConnection();
		
		return $infoTourCategory;
	}

	function getCategoryTourList($categoryId,$data=array())
	{
		$this->setDatabaseConnection();
		$categoryId = $this->filterReceivedData($categoryId);
		$strsqlCategory = "select * from tbl_tour_category where category_id=".$categoryId;

		if((isset($data['sortBy']))&&(!empty($data['sortBy'])))
		{
			$strsqlCategory .=" order by ".$data['sortBy'];
		}

		$resultCategory = mysql_query($strsqlCategory);
		$categoryList = array();
		while($infoCategory = mysql_fetch_array($resultCategory,MYSQL_ASSOC))
		{
			$categoryList[]=$infoCategory;
		}
		$this->closeDBConnection();
		return $categoryList;

	}

	function addPriceStack($data)
	{
		$this->setDatabaseConnection();

		$strsqlCheckTourPrice = "select id from tour_prices where tour_id=".$data['tour_id']." and tour_page_id=".$data['tour_page_id']." and category_id=".$data['category_id']." and currency_code='".$data['currency_code']."'";
		$resultCheckTourPrice = mysql_query($strsqlCheckTourPrice);
		
		if((mysql_num_rows($resultCheckTourPrice))<1)
		{
			
			$strsqlTourPrice = "insert into tour_prices (tour_id, tour_page_id, category_id, currency_code) values(".$data['tour_id'].",".$data['tour_page_id'].",".$data['category_id'].",'".$data['currency_code']."')";
			$resultTourPrice = mysql_query($strsqlTourPrice);

			$data['tour_price_id'] = mysql_insert_id();
			
			 $strsqlCheckTourPriceDet = "select * from tour_price_details where tour_id=".$data['tour_id']." and currency_code='".$data['currency_code']."' and tour_page_id=".$data['tour_page_id'];
			$resultCheckTourPriceDet = mysql_query($strsqlCheckTourPriceDet);
			
			if((mysql_num_rows($resultCheckTourPriceDet))>=1)
			{
				
				$infoCheckTourPriceDet = mysql_fetch_array($resultCheckTourPriceDet);
				$strsqlTourPriceDet = "update tour_price_details set tour_price_id = ".$data['tour_price_id']." where id=".$infoCheckTourPriceDet['id'];
			}
			else
			{
				$strsqlTourPriceDet = "insert into tour_price_details (tour_price_id, tour_id, currency_code, tour_page_id) values(".$data['tour_price_id'].",".$data['tour_id'].",'".$data['currency_code']."',".$data['tour_page_id'].")";
			}
			$resultTourPriceDet = mysql_query($strsqlTourPriceDet);

		}

		$this->closeDBConnection();

	}
	
	
}
?>