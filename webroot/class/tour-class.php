<?php
include_once(BASEPATH."class/first-class.php");
include_once(BASEPATH."class/image-slice-class.php");
class Tour extends FirstClass
{
	

	function getTours($categoryTourIds, $data=array())
	{
		if($categoryTourIds=="")
		{
			return;
		}
		$strTourIds = implode(",",$categoryTourIds);
		$this->setDatabaseConnection();
		$strsqlTour = "select * from tbl_managetour where id in (".$strTourIds.")";
		$resultTour = mysql_query($strsqlTour);
		$tourList = array();
		while($infoTour = mysql_fetch_array($resultTour,MYSQL_ASSOC))
		{
			$tourList[]=$infoTour;
		}
		$this->closeDBConnection();
		return $tourList;

	}

	

	function getCategoryTours($categoryId, $data=array())
	{
		$tourList = array();
		if($categoryId=="")
		{
			return;
		}
		$this->setDatabaseConnection();
		$strsqlTourPage = "select tbls_tour_pages.id id, tbls_tour_pages.tour_id tour_id, title, page_url, tour_code, lowest_price_id, price_display, order_sequence from tbls_tour_pages inner join tbl_tour_category on tbls_tour_pages.id = tbl_tour_category.tour_page_id where tbl_tour_category.category_id=".$categoryId." order by tbl_tour_category.order_sequence ";
		$resultTourPage = mysql_query($strsqlTourPage);
		while($infoTourPage = mysql_fetch_array($resultTourPage,MYSQL_ASSOC))
		{

			#### getting image of tour page
			$strsqlTourPageDescription = "select image from tbls_tour_page_description where tour_page_id=".$infoTourPage['id'];
			$resultTourPageDescription = mysql_query($strsqlTourPageDescription);
			$infoTourPageDescription = mysql_fetch_array($resultTourPageDescription);

			$strsqlTour = "select * from cms_managetour where id=".$infoTourPage['tour_id'];
			$resultTour = mysql_query($strsqlTour);
			$infoTour = mysql_fetch_array($resultTour,MYSQL_ASSOC);

			$tourInformation = array();
			$tourInformation['id'] = $infoTour['id'];
			$tourInformation['tour_page_id'] = $infoTourPage['id'];
			$tourInformation['tour_name'] = $infoTourPage['title'];
			$tourInformation['tour_url'] = $infoTourPage['page_url'];
			$tourInformation['tour_code'] = $infoTourPage['tour_code'];
			$tourInformation['lowest_price_id'] = $infoTourPage['lowest_price_id'];
			$tourInformation['tour_image']= $infoTourPageDescription['image'];
			$tourInformation['tour_duration']= $infoTour['tour_duration'];
			$tourInformation['price_display'] = $infoTourPage['price_display'];
			$tourList[]=$tourInformation;
		}

		
		
		$this->closeDBConnection();
		return $tourList;

	}


	function getTourPicture($tourId,$image,$width,$height)
	{
		
		$objImageSlice = new ImageSlice();
		$imageUrl=$objImageSlice->resize($image, $width, $height);
		$imageUrl = str_replace("/images/","/images/tours/",$imageUrl);
		return $imageUrl;
		//$imageSource = WEBROOT.'image2.php?w='.$width.'&h='.$height.'&img='.$image;
		//return $imageSource;
	}

	function getTourInterestByTourId($tourId)
	{
		$this->setDatabaseConnection();
		$strsqlTourInterest = "select * from tbl_tour_interest where tour_id=".$tourId;
		$resultTourInterest = mysql_query($strsqlTourInterest);
		$infoTourInterest = mysql_fetch_array($resultTourInterest,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoTourInterest;
	}

	function getTourByPageName($pageName)
	{
		$this->setDatabaseConnection();
		####getting tour id
		$strsqlTourPage = "select * from tbls_tour_pages where page_url='".$pageName."'";
		$resultTourPage = mysql_query($strsqlTourPage);
		$infoTourPage = mysql_fetch_array($resultTourPage,MYSQL_ASSOC);
		$tourId = $infoTourPage['tour_id'];
		
		$strsqlTourInterest = "select * from cms_managetour where id='".$tourId."'";
		$resultTourInterest = mysql_query($strsqlTourInterest);
		$infoTourInterest = mysql_fetch_array($resultTourInterest,MYSQL_ASSOC);
		$this->closeDBConnection();
		
		$infoTourInterest['tour_page_title'] = $infoTourPage['title'];
		$infoTourInterest['page_name_id'] = $infoTourPage['id'];
		return $infoTourInterest;
	}

	function getTourItinerary($tourId)
	{
		$this->setDatabaseConnection();
		$strsqlSetTour = "select * from tbl_set_tour where tour_id=".$tourId." order by day";
		$resultSetTour = mysql_query($strsqlSetTour);
		$tourIteniraryList=array();
		while($infoSetTour = mysql_fetch_array($resultSetTour,MYSQL_ASSOC))
		{
			/*
				getting subregion information
			*/
			if($infoSetTour['subregion1']!="")
			{
				$strsqlRegion1 = "select * from tbl_subregion where id=".$infoSetTour['subregion1'];
				$resultRegion1 = mysql_query($strsqlRegion1);
				$infoRegion1=mysql_fetch_array($resultRegion1);
			}

			if($infoSetTour['subregion2']!="")
			{
				$strsqlRegion2 = "select * from tbl_subregion where id=".$infoSetTour['subregion2'];
				$resultRegion2 = mysql_query($strsqlRegion2);
				$infoRegion2=mysql_fetch_array($resultRegion2);
			}

			if($infoSetTour['subregion3']!="")
			{
				$strsqlRegion3 = "select * from tbl_subregion where id=".$infoSetTour['subregion3'];
				$resultRegion3 = mysql_query($strsqlRegion3);
				$infoRegion3=mysql_fetch_array($resultRegion3);
			}

			/*
				getting city information
			*/

			if($infoSetTour['city_id1']!="")
			{
				$strsqlCity1 = "select * from tbl_tour where id=".$infoSetTour['city_id1'];
				$resultCity1 = mysql_query($strsqlCity1);
				$infoCity1=mysql_fetch_array($resultCity1);
			}	
			
			if($infoSetTour['city_id2']!="")
			{
				$strsqlCity2 = "select * from tbl_tour where id=".$infoSetTour['city_id2'];
				$resultCity2 = mysql_query($strsqlCity2);
				$infoCity2=mysql_fetch_array($resultCity2);
			}

			if($infoSetTour['city_id3']!="")
			{
				$strsqlCity3 = "select * from tbl_tour where id=".$infoSetTour['city_id3'];
				$resultCity3 = mysql_query($strsqlCity3);
				$infoCity3=mysql_fetch_array($resultCity3);
			}

			$cityName = "";

			if($infoRegion1['region_location']!='' && $infoRegion2['region_location']=='' && $infoRegion3['region_location']=='')
			{
				$cityName=stripslashes($infoRegion1['region_location']);
				$infoRegion1['region_location']='';
			}
			else if($infoRegion1['region_location']!=$infoRegion2['region_location'] && $infoRegion2['region_location']==$infoRegion3['region_location'])
			{
				$cityName= stripslashes($infoRegion1['region_location'])." / ".stripslashes($infoRegion2['region_location']);
				$infoRegion1['region_location']='';
				$infoRegion2['region_location']='';
				$infoRegion3['region_location']='';
			}
			else if($infoRegion1['region_location']==$infoRegion2['region_location'] && $infoRegion3['region_location']=="")
			{
				$cityName=  stripslashes($infoRegion1['region_location']);
				$infoRegion1['region_location']='';
				$infoRegion2['region_location']='';
			}
			else if($infoRegion1['region_location']!=$infoRegion3['region_location'] && $infoRegion1['region_location']==$infoRegion2['region_location'])
			{
				$cityName=  stripslashes($infoRegion1['region_location'])." / ".stripslashes($infoRegion3['region_location']);
				$infoRegion1['region_location']='';
				$infoRegion2['region_location']='';
				$infoRegion3['region_location']='';
			}
			else if($infoRegion1['region_location']!="" && $infoRegion2['region_location']!="" && $infoRegion3['region_location']=="" )
			{
				$cityName=stripslashes($infoRegion1['region_location'])." / ".stripslashes($infoRegion2['region_location']);
				$infoRegion1['region_location']='';
				$infoRegion2['region_location']='';
			}
			else if($infoRegion1['region_location']==$infoRegion2['region_location'] && $infoRegion1['region_location']==$infoRegion3['region_location'])
			{
				$cityName=stripslashes($infoRegion1['region_location']);
				$infoRegion1['region_location']='';
				$infoRegion2['region_location']='';
			}
			else if($infoRegion1['region_location']!=$infoRegion2['region_location'])
			{
				$cityName=stripslashes($infoRegion1['region_location'])." / ".stripslashes($infoRegion2['region_location']);
				$infoRegion1['region_location']='';
				$infoRegion2['region_location']='';
			}


		    if($infoCity1['tour_description']!='')
		    {
				 $description=stripslashes($infoCity1['tour_description'])."<br>"; 
				 $infoCity1['tour_description']='';
			}
			
		    if($infoCity2['tour_description']!='')
		    {
			   $description .=stripslashes($infoCity2['tour_description'])."<br>"; 
			   $infoCity2['tour_description']='';
		    }
		
		    if($infoCity3['tour_description']!='')
		    {
			   $description .=stripslashes($infoCity3['tour_description'])."<br>";
			   $infoCity3['tour_description']='';
			   
		    }
			
			$description = str_replace('<a', '<a style="display:none;"',$description);
			$tourIteniraryList[]=array(
										'day'=>$infoSetTour['day'],
										'city'=>$cityName,
										'description'=>$description
							);

			
		}
		$this->closeDBConnection();
		return $tourIteniraryList;

	}


	function getTourHotelInformation($tourId,$tourType)
	{
		$this->setDatabaseConnection();
		$strsqlSetTour = "select * from tbl_set_tour where tour_id=".$tourId." order by day";
		$resultSetTour = mysql_query($strsqlSetTour);
		$tourIteniraryList=array();
		$hotelFourStar=array();
		$hotleFiveStar=array();
		$hotelAvailable=array();
		while($infoSetTour=mysql_fetch_array($resultSetTour,MYSQL_ASSOC))
		{
			
			if($infoSetTour['hotel1']!="")
			{
				$hotelLocation="";
				$primaryHotelName="";
				$secondaryHotelName="";
				
				
				// getting location
				$strsqlLocation = "select * from tbl_subregion where id=".$infoSetTour['hotel_location'];
				$resultLocation = mysql_query($strsqlLocation);
				$infoLocation = mysql_fetch_array($resultLocation,MYSQL_ASSOC);
				$hotelLocation = $infoLocation['region_location'];
				
				//getting four star hotel information

				// getting primary hotel name
				if($infoSetTour['hotel1']!="")
				{
					$strsqlPrimaryHotel = "select * from tbl_hotel_type where id=".$infoSetTour['hotel1'];
					$resultPrimaryHotel = mysql_query($strsqlPrimaryHotel);
					$infoPrimaryHotel = mysql_fetch_array($resultPrimaryHotel,MYSQL_ASSOC);
					$primaryHotelName = $infoPrimaryHotel['hotel_type_name'];
				}

				if($infoSetTour['hotel2']!="")
				{
					// getting seconday hotel name
					$strsqlSecondaryHotel = "select * from tbl_hotel_type where id=".$infoSetTour['hotel1'];
					$resultSecondaryHotel = mysql_query($strsqlSecondaryHotel);
					$infoSecondaryHotel = mysql_fetch_array($resultSecondaryHotel,MYSQL_ASSOC);
					$secondaryHotelName = $infoSecondaryHotel['hotel_type_name'];
				}

				$hotelAvailable['four_star'][]=array(
															'location'=>$hotelLocation,
															'primaryHotelName'=>$primaryHotelName,
															'secondaryHotelName'=>$secondaryHotelName
												);

			}

			if($infoSetTour['hotel3']!="")
			{
				//getting five star hotel information

				// getting primary hotel name
				$primaryHotelName="";
				$secondaryHotelName="";
				if($infoSetTour['hotel3']!="")
				{
					$strsqlPrimaryHotel = "select * from tbl_hotel_type where id=".$infoSetTour['hotel3'];
					$resultPrimaryHotel = mysql_query($strsqlPrimaryHotel);
					$infoPrimaryHotel = mysql_fetch_array($resultPrimaryHotel,MYSQL_ASSOC);
					$primaryHotelName = $infoPrimaryHotel['hotel_type_name'];
				}

				if($infoSetTour['hotel4']!="")
				{
					// getting seconday hotel name
					$strsqlSecondaryHotel = "select * from tbl_hotel_type where id=".$infoSetTour['hotel4'];
					$resultSecondaryHotel = mysql_query($strsqlSecondaryHotel);
					$infoSecondaryHotel = mysql_fetch_array($resultSecondaryHotel,MYSQL_ASSOC);
					$secondaryHotelName = $infoSecondaryHotel['hotel_type_name'];
				}

				$hotelAvailable['five_star'][]=array(
															'location'=>$hotelLocation,
															'primaryHotelName'=>$primaryHotelName,
															'secondaryHotelName'=>$secondaryHotelName
												);

			}

			if($infoSetTour['hotel5']!="")
			{
				//getting best available hotel information

				// getting primary hotel name
				$primaryHotelName="";
				$secondaryHotelName="";
				if($infoSetTour['hotel5']!="")
				{
					$strsqlPrimaryHotel = "select * from tbl_hotel_type where id=".$infoSetTour['hotel5'];
					$resultPrimaryHotel = mysql_query($strsqlPrimaryHotel);
					$infoPrimaryHotel = mysql_fetch_array($resultPrimaryHotel,MYSQL_ASSOC);
					$primaryHotelName = $infoPrimaryHotel['hotel_type_name'];
				}

				if($infoSetTour['hotel6']!="")
				{
					// getting seconday hotel name
					$strsqlSecondaryHotel = "select * from tbl_hotel_type where id=".$infoSetTour['hotel6'];
					$resultSecondaryHotel = mysql_query($strsqlSecondaryHotel);
					$infoSecondaryHotel = mysql_fetch_array($resultSecondaryHotel,MYSQL_ASSOC);
					$secondaryHotelName = $infoSecondaryHotel['hotel_type_name'];
				}

				$hotelAvailable['best_available'][]=array(
															'location'=>$hotelLocation,
															'primaryHotelName'=>$primaryHotelName,
															'secondaryHotelName'=>$secondaryHotelName
												);
														
			}

		}
		
		$this->closeDBConnection();
		return $hotelAvailable;
	}

	function getInclusionList($tourId)
	{
		$this->setDatabaseConnection();
		$strsqlInclusionExclusion="select * from tbl_set_inclusion_exclusion where tour_id=".$tourId." order by order_no";
		$resultInclusionExclusion=mysql_query($strsqlInclusionExclusion);
		$inclusionList = array();
		while($infoInclusionExclusion=mysql_fetch_array($resultInclusionExclusion,MYSQL_ASSOC))
		{
			 $strsqlInclusion = "select * from tbl_inc_exc where id=".$infoInclusionExclusion['inc_exc_id']." and incexctype=1";
			 $resultInclusion = mysql_query($strsqlInclusion);
			 $infoInclusion = mysql_fetch_array($resultInclusion,MYSQL_ASSOC);
			 if($infoInclusion['incexcdesc']!="")
			 {
				$inclusionList[]=$infoInclusion;
			 }
			
		}
		$this->closeDBConnection();
		return $inclusionList;
	}

	function getExclusionList($tourId)
	{
		$this->setDatabaseConnection();
		$strsqlInclusionExclusion="select * from tbl_set_inclusion_exclusion where tour_id=".$tourId." order by order_no";
		$resultInclusionExclusion=mysql_query($strsqlInclusionExclusion);
		$inclusionList = array();
		while($infoInclusionExclusion=mysql_fetch_array($resultInclusionExclusion,MYSQL_ASSOC))
		{
			 $strsqlInclusion = "select * from tbl_inc_exc where id=".$infoInclusionExclusion['inc_exc_id']." and incexctype=2";
			 $resultInclusion = mysql_query($strsqlInclusion);
			 $infoInclusion = mysql_fetch_array($resultInclusion,MYSQL_ASSOC);
			 if($infoInclusion['incexcdesc']!="")
			 {
				$inclusionList[]=$infoInclusion;
			 }
			
		}
		$this->closeDBConnection();
		return $inclusionList;
	}

	function getTourByTourId($tourId)
	{
		$this->setDatabaseConnection();
		$strsqlTourInterest = "select * from tbl_managetour where id=".$tourId;
		$resultTourInterest = mysql_query($strsqlTourInterest);
		$infoTourInterest = mysql_fetch_array($resultTourInterest,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoTourInterest;
	}

	/*function getRelatedTours($tourId)
	{
		$this->setDatabaseConnection();
		$strsqlRelatedTour = "select * from tbl_related_tours where tour_id=".$tourId;
		$resultRelatedTour = mysql_query($strsqlRelatedTour);
		$infoRelatedTour = mysql_fetch_array($resultRelatedTour,MYSQL_ASSOC);
		
		$relatedTourList = array();
		
		if($infoRelatedTour['related_tour']!="")
		{
			
			$relatedTourIds = explode(',',$infoRelatedTour['related_tour']);
			foreach($relatedTourIds as $relatedTour)
			{
				$relatedTourList[]=$this->getTourByTourId($relatedTour);
			}
		}
		$this->closeDBConnection();
		return $relatedTourList;
	}*/

	function getRelatedTours($tourId)
	{
		$this->setDatabaseConnection();
		$strsqlRelatedTour = "select tour_id from tbl_tour_categories where category_id=( select category_id from tbl_tour_categories where tour_id=".$tourId." limit 0,1) limit 0,7";
		$resultRelatedTour = mysql_query($strsqlRelatedTour);
		$relatedTourList = array();
		while($infoRelatedTour = mysql_fetch_array($resultRelatedTour,MYSQL_ASSOC))
		{
			$relatedTourList[]=$this->getTourByTourId($infoRelatedTour['tour_id']);
		}
		
		$this->closeDBConnection();
		return $relatedTourList;
	}


	function getRecentlyVisitedTours()
	{
		$this->setDatabaseConnection();
		$recentlyVistitedTours = $_SESSION['visited_tour'];
		
		$relatedTourList = array();
		foreach($recentlyVistitedTours as $recentlyVistitedTour)
		{	
			$recentlyVisitedTourList[]=$this->getTourByTourId($recentlyVistitedTour);
		
		}
		$this->closeDBConnection();
		return $recentlyVisitedTourList;
	}


	function addToRecentlyVisitedTour($tourId)
	{
		if(empty($tourId))
		{
			return;
		}
		$_SESSION['visited_tour'][]=$tourId;
	
	}


	function getPopularTours($tourLimit=3)
	{
	
		$objMysqli = $this->setMysqliConnection();
		$strsqlPopularTour = "select * from tbl_popular_tours order by rand()  limit 0,".$tourLimit;
		$objResultPopularTour = $objMysqli->query($strsqlPopularTour);
		
		while($infoPopularTour = $objResultPopularTour->fetch_array(MYSQLI_ASSOC))
		{
			
			$strsqlTourPage = "select * from tbls_tour_pages where id=".$infoPopularTour['tour_page_id'];
			$objResultTourPage = $objMysqli->query($strsqlTourPage);
			$infoTourPage = $objResultTourPage->fetch_array(MYSQLI_ASSOC);
			
			if($infoTourPage['id']=="")
			{
				continue;
			}
			
		
			#### getting image of tour page
			$strsqlTourPageDescription = "select image from tbls_tour_page_description where tour_page_id=".$infoTourPage['id'];
			$objResultTourPageDescription = $objMysqli->query($strsqlTourPageDescription);
			$infoTourPageDescription = $objResultTourPageDescription->fetch_array(MYSQLI_ASSOC);

			$strsqlTour = "select * from cms_managetour where id=".$infoTourPage['tour_id'];
			$objResultTour = $objMysqli->query($strsqlTour);
			$infoTour = $objResultTour->fetch_array(MYSQLI_ASSOC);
			
			#### GETTING CATEGORY DETAIL
			$strsqlTourCategories = "select * from   tbl_tour_category   where tour_page_id=".$infoPopularTour['tour_page_id'];
			$objResultTourCategories = $objMysqli->query($strsqlTourCategories);
			$infoTourCategories = $objResultTourCategories->fetch_array(MYSQLI_ASSOC);
			
			
			
			$strsqlCategory = "select * from  tbl_category where id = ".$infoTourCategories['category_id'];
			$resultCategory =  $objMysqli->query($strsqlCategory);
			$infoCategory = $resultCategory->fetch_array(MYSQLI_ASSOC);
			
			
			
			
			
			
			
			$infoTour['tour_name'] = $infoTourPage['title'];
			$infoTour['tour_url'] = WEBROOT.'holidays-india-'.$infoCategory['category_url'].'/'.$infoTourPage['page_url'];
			$infoTour['tour_code'] = $infoTourPage['tour_code'];
			$infoTour['tour_image']= $infoTourPageDescription['image'];
			$tourList[]=$infoTour;
		}
		
		
		
		$this->closeMysqliConnection($objMysqli);
		return $tourList;
	}
	
	function getPopularTours1($tourLimit=3)
	{
	
		$objMysqli = $this->setMysqliConnection();
		$strsqlPopularTour = "select * from tbl_popular_tours order by rand()  limit 0,".$tourLimit;
		$objResultPopularTour = $objMysqli->query($strsqlPopularTour);
		
		while($infoPopularTour = $objResultPopularTour->fetch_array(MYSQLI_ASSOC))
		{
			
			echo $strsqlTourPage = "select * from tbls_tour_pages where id=".$infoPopularTour['tour_page_id'];
			$objResultTourPage = $objMysqli->query($strsqlTourPage);
			$infoTourPage = $objResultTourPage->fetch_array(MYSQLI_ASSOC);
			
			if(infoTourPage['id']=="")
			{
				continue;
			}
			
		
			#### getting image of tour page
			$strsqlTourPageDescription = "select image from tbls_tour_page_description where tour_page_id=".$infoTourPage['id'];
			$objResultTourPageDescription = $objMysqli->query($strsqlTourPageDescription);
			$infoTourPageDescription = $objResultTourPageDescription->fetch_array(MYSQLI_ASSOC);

			$strsqlTour = "select * from cms_managetour where id=".$infoTourPage['tour_id'];
			$objResultTour = $objMysqli->query($strsqlTour);
			$infoTour = $objResultTour->fetch_array(MYSQLI_ASSOC);
			
			#### GETTING CATEGORY DETAIL
			$strsqlTourCategories = "select * from   tbl_tour_category   where tour_page_id=".$infoPopularTour['tour_page_id'];
			$objResultTourCategories = $objMysqli->query($strsqlTourCategories);
			$infoTourCategories = $objResultTourCategories->fetch_array(MYSQLI_ASSOC);
			
			
			
			$strsqlCategory = "select * from  tbl_category where id = ".$infoTourCategories['category_id'];
			$resultCategory =  $objMysqli->query($strsqlCategory);
			$infoCategory = $resultCategory->fetch_array(MYSQLI_ASSOC);
			
			echo "<pre>";
			print_r($infoCategory);
			echo "</pre>";
			
			
			
			$infoTour['tour_name'] = $infoTourPage['title'];
			$infoTour['tour_url'] = WEBROOT.'holidays-india-'.$infoCategory['category_url'].'/'.$infoTourPage['page_url'];
			$infoTour['tour_code'] = $infoTourPage['tour_code'];
			$infoTour['tour_image']= $infoTourPageDescription['image'];
			$tourList[]=$infoTour;
		}
		
		
		
		$this->closeMysqliConnection($objMysqli);
		return $tourList;
	}
	

	function getTourBreadCrumb($data=array())
	{
		$breadCrumb = array();
		$tourId = $data['tour_id'];
		$basicTourInformation = $this->getTourByTourId($tourId);

		#### GETTING CATEGORY PAGE INFORMATION
		$pageUrl = $this->getPageUrl();
		$arrPageUrl = explode("/",$pageUrl);
		$categoryPageUrl = $arrPageUrl[(count($arrPageUrl)-2)];
		$categoryDetail = array(
								"category_url"	=>	$categoryPageUrl
					);
		$categoryInformation = $this->getCategoryDetailByTourUrl($categoryDetail);


		#### ADDING BREADCRUMB ARRAY
		$breadCrumb[]=array(
								"link"		=>		WEBROOT,
								"title"		=>		'Home'
					);
		
		/*$breadCrumb[]=array(
								"link"		=>		WEBROOT.$categoryInformation['category_url'],
								"title"		=>		$categoryInformation['name']
					);*/

		$breadCrumb[]=array(
								"link"		=>		WEBROOT.$categoryInformation['category_url'].'/'.$basicTourInformation['tour_url'],
								"title"		=>		$basicTourInformation['tour_name']
					);
		
		return $breadCrumb;


	}

	function getCategoryDetailByTourUrl($data = array())
	{
		$this->setDatabaseConnection();
		$categoryUrl = $data['category_url'];
		$strsqlCategory = "select * from tbl_category where category_url='".$categoryUrl."'";
		$resultCategory = mysql_query($strsqlCategory);
		$infoCategory = mysql_fetch_array($resultCategory,MYSQL_ASSOC);
		$this->closeDBConnection();
		return $infoCategory;
	}

	function getHotelLabel($key,$code='GT')
	{
		$pageUrl = $this->getPageUrl();
		$arrTourUrl = explode("/",$pageUrl);
		$categoryUrl = $arrTourUrl[count($arrTourUrl)-2];
		switch($code)
		{
			case 'GT':
					switch($key)
					{
						case 'five_star':
								$label = 'DELUXE HOTELS (5 Star)';
							break;
						case 'four_star':
								$label = 'STANDARD HOTELS (4 Star)';
							break;
						case 'best_available':
								$label = 'LUXURY HOTELS (Best Available)';
							break;
					}
				break;
			case 'default':
					switch($key)
					{
						case 'five_star':
								$label = 'DELUXE HOTELS (5 Star)';
							break;
						case 'four_star':
								$label = 'STANDARD HOTELS (4 Star)';
							break;
						case 'best_available':
								$label = 'LUXURY HOTELS (Best Available)';
							break;
					}
				break;
		}
		return $label;
	}

	function getHotelStar($key,$code='GT')
	{
		
		switch($code)
		{
			case 'OB':
					$label = '<span>&nbsp;&nbsp;<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> </span>';
				break;
			case 'GT':
				
				switch($key)
				{
					case 'five_star':
							$label = '<span>&nbsp;&nbsp;<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> </span>';
						break;
					case 'four_star':
							$label =  '<span>&nbsp;&nbsp;<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i> </span>';
						break;
					case 'best_available':
							$label =  '<span>&nbsp;&nbsp;<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> </span>';
						break;
				}
		}
		return $label;
	}


	function getTourCity($tourId)
	{



	}
	
	function getTourPageBreadcrumb($data=array())
	{
		$this->setDatabaseConnection();
		
		$strsqlTourCategory = "select * from  tbl_tour_category where tour_id=".$data['tour_id']." and tour_page_id = ".$data['tour_page_id'];
		$resultTourCategory = mysql_query($strsqlTourCategory);
		$infoTourCategory = mysql_fetch_array($resultTourCategory,MYSQL_ASSOC);
		
		$strsqlCategory = "select * from  tbl_category where id=".$infoTourCategory['category_id'];
		$resultCategory = mysql_query($strsqlCategory);
		$infoCategory = mysql_fetch_array($resultCategory,MYSQL_ASSOC);
		
		$urlList = explode("/",str_replace(WEBROOT,"",$data['page_url']));
		
		$breadcrumbList = array();
		
		$breadcrumbList[] = array(
										"label"			=>  'Home',
										"link"			=>	str_replace("elegantjourneys.com/","elegantjourneys.com",WEBROOT),
										"link_display"	=>	true
							);
							
		$breadcrumbList[] = array(
										"label"			=>  $infoCategory['name'],
										"link"			=>	WEBROOT.$urlList[0],
										"link_display"	=>	true
							);
							
		$breadcrumbList[] = array(
										"label"			=>  $data['tour_page_name'],
										"link"			=>	$data['page_url'],
										"link_display"	=>	true
							);
		
		return $breadcrumbList;
		
	}

	public function getTourPageInfo($requestData=array())
	{
		$this->setDatabaseConnection();
		$strsqlPageName = "select * from  tbls_tour_pages where id=".$requestData['tour_page_id'];
		$resultPageName = mysql_query($strsqlPageName);
		$infoPageName = mysql_fetch_array($resultPageName,MYSQL_ASSOC);

		$this->closeDBConnection();
		return $infoPageName;
	}


}
?>