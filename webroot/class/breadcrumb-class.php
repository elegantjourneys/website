<?php
include_once(BASEPATH."class/first-class.php");
class Breadcrumb extends FirstClass
{
	
	function getBreadcrumbList($data=array())
	{
		$sectionName = '';
		$breadCrumbList = array();
		if((isset($data['section_name']))&&($data['section_name']!=''))
		{
			$sectionName=$data['section_name'];
		}

		switch($sectionName)
		{
			case 'tourDetail':
					include_once(BASEPATH."class/tour-class.php");
					$objTour = new Tour();
					$breadCrumbInfo = array(
												"tour_id"	=>	$data['tour_id']
									);
					$breadCrumbList = $objTour->getTourBreadCrumb($breadCrumbInfo);
				break;
		}
		
		$breadCrumbHtml = $this->writeBreadCrumbList($breadCrumbList);
		return $breadCrumbHtml;
	}

	
	function writeBreadCrumbList($data)
	{
		$htmlString = '';
		$htmlString = '<ul class="breadcrumb">';
		$countBreadCrumb = 0;
		foreach($data as $breadCrumb)
		{
			if($countBreadCrumb==((count($data)-1)))
			{
				$htmlString .= '<li><a href="'.$breadCrumb['link'].'" class="active" onclick="return false;">'.$breadCrumb['title'].'</a></li>';
			}
			else
			{
				$htmlString .= '<li><a href="'.$breadCrumb['link'].'">'.$breadCrumb['title'].'</a></li>';
			}
			$countBreadCrumb++;
		}
		$htmlString .= '</ul>';
		return $htmlString;
	}
}
?>