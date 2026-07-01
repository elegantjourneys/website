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

	function getTourPicture($tourId,$image,$width,$height)
	{
		
		$objImageSlice = new ImageSlice();
		$imageUrl=$objImageSlice->resize($image, $width, $height);
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
		$strsqlTourInterest = "select * from tbl_managetour where tour_url='".$pageName."'";
		$resultTourInterest = mysql_query($strsqlTourInterest);
		$infoTourInterest = mysql_fetch_array($resultTourInterest,MYSQL_ASSOC);
		$this->closeDBConnection();
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

	function getRelatedTours($tourId)
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
		$this->setDatabaseConnection();
		$strsqlPopularTour = "select * from tbl_popular_tours order by rand()  limit 0,".$tourLimit;
		$resultPopularTour = mysql_query($strsqlPopularTour);
		$popularTourList = array();
		$popularTourIds = array();
		while($infoPopularTour = mysql_fetch_array($resultPopularTour,MYSQL_ASSOC))
		{
			$popularTourIds[]=$infoPopularTour['tour_id'];
		}
		$this->closeDBConnection();
		foreach($popularTourIds as $popularTourId)
		{
			$popularTourList[]=$this->getTourByTourId($popularTourId);
		}
		
		return $popularTourList;
	}


}
?>