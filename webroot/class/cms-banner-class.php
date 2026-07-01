<?php
include_once(BASEPATH."class/first-class.php");
class Banner extends FirstClass
{
	function getTourDetailBannerByCity($cityList = array())
	{
		$bannerList = array();
		
		foreach($cityList as $city)
		{
			$filePath = "";
			$fileName = trim(str_replace(" ","-",strtolower($city))).'.jpg';
			$filePath = BASEPATH_IMAGES.'banner/'.$fileName;

			if(file_exists($filePath))
			{
				$fileUrl = WEBROOT.'images/banner/'.$fileName;
				$bannerList[] = $fileUrl;
			}
		}

		return $bannerList;
	}
}
?>