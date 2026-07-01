<?php
class Campaign
{
	function addCampaignVistorData($data)
	{

		$visitorId = $this->checkCampaignVistorEntry($data['visitor_session_id']);
		if($visitorId)
		{
			$this->updateCampaignData($data,$visitorId);
		}
		else
		{
			$this->addVisitorData($data);
		}

	}


	function checkCampaignVistorEntry($visitorSessionId)
	{
		$strsqlCampaignVisitors="select visitor_id from tbl_campaign_visitors where session_id='".$visitorSessionId."'";
		$resultCampaignVisitors = mysql_query($strsqlCampaignVisitors);
		if((mysql_num_rows($resultCampaignVisitors))>=1)
		{
			$infoCampaignVisitors = mysql_fetch_array($resultCampaignVisitors);
			return $infoCampaignVisitors['visitor_id'];
		}
		else
		{
			return false;
		}

	}

	function addVisitorData($data)
	{
		
		include_once("library/library.php");
		
		$campaignDetail=$this->getCampaignInfo($data['utm_campaign_param']);
		$userIpInfo=getUserIpDetail();

		$session_id = @$data['visitor_session_id'];
		$campaign_id = @$campaignDetail['campaign_id'];
		$name = @$data['name'];
		$email = @$data['email'];
		$country = @$userIpInfo['countryName'];
		$ip = @$userIpInfo['ipAddress'];
		$landing_url = @$data['page_link'];
		
		$strsqlCampaignVisitor = "insert into tbl_campaign_visitors (session_id, campaign_id, name, email, country, ip, landing_url, landing_time) values('".$session_id."','".$campaign_id."','".$name."','".$email."','".$country."','".$ip."','".$landing_url."',now())";
		mysql_query($strsqlCampaignVisitor);
		$campaignVisitorId = mysql_insert_id();
		$_SESSION['campaignVisitorId']=$campaignVisitorId;
		$_SESSION['campaignName']=$campaignDetail['name'];
		if((isset($data['page_link']))&&(!empty($data['page_link'])))
		{
			$this->updatePageVisitHistory($campaignVisitorId,$data['page_link']);
		}
		return true;
		
	}

	function getCampaignInfo($utm_campaign_param)
	{
		$strsqlCampaign="select * from tbl_campaign where utm_campaign_param ='".trim($utm_campaign_param)."'";
		$resultCampaign = mysql_query($strsqlCampaign);
		$infoCampaign = mysql_fetch_array($resultCampaign,MYSQL_ASSOC);
		return $infoCampaign;

	}

	function getCampaignInfoById($campaignId)
	{
		$strsqlCampaign="select * from tbl_campaign where campaign_id ='".trim($campaignId)."'";
		$resultCampaign = mysql_query($strsqlCampaign);
		$infoCampaign = mysql_fetch_array($resultCampaign,MYSQL_ASSOC);
		return $infoCampaign;

	}

	function updateCampaignData($data,$visitorId)
	{
		$update = false;
		$strsqlCampaign = "update tbl_campaign_visitors set";
		if(isset($data['name']))
		{
			$update = true;
			$dataList .= " name='".$data['name']."'";
		}

		if(isset($data['email']))
		{
			$update = true;
			if($dataList=="")
			{
				$dataList .= " email='".$data['email']."'";
			}
			else
			{
				$dataList .= ", email='".$data['email']."'";
			}
		}

		if(isset($data['thankyou_page_visited']))
		{
			$update = true;
			if($dataList=="")
			{
				$dataList .= " thankyou_page_visited='".$data['thankyou_page_visited']."'";
			}
			else
			{
				$dataList .= ", thankyou_page_visited='".$data['thankyou_page_visited']."'";
			}

			if($data['thankyou_page_visited']=="yes")
			{
				$dataList .= ", thankyou_page_time=now()";
			}
		}
		
		$strsqlCampaign = $strsqlCampaign.$dataList." where session_id ='".$data['visitor_session_id']."' and visitor_id=".$visitorId;
		if($update)
		{
			mysql_query($strsqlCampaign);
			if((isset($data['page_link']))&&(!empty($data['page_link'])))
			{
				$this->updatePageVisitHistory($visitorId,$data['page_link']);
			}
			return true;
		}
		else
		{
			return false;
		}

	}

	function updatePageVisitHistory($visitorId,$pageLink)
	{
		
		$pageHistory = $this->getPageHistory($visitorId);
		
			
		$arrPageHistory = array();
		$arrPageHistory=unserialize($pageHistory);
		if($pageHistory!="")
		{	
			foreach($arrPageHistory as $userPageHistory)
			{
				if($userPageHistory['page_visited']==$pageLink)
					return;
			}
		}
		$arrPageHistory[] = array(
									'page_visited' => $pageLink,
									'visit_time' => date("d-m-Y H:i")
								);
		$pageHistory = serialize($arrPageHistory);

		$strsqlCampaignVisitor = "update tbl_campaign_visitors set page_history='".$pageHistory."' where visitor_id=".$visitorId;
		mysql_query($strsqlCampaignVisitor);

	}

	function getPageHistory($visitorId)
	{
		$strsqlCampaignVisitor = "select page_history from tbl_campaign_visitors where visitor_id=".$visitorId;
		$resultCampaignVisitor = mysql_query($strsqlCampaignVisitor);
		$infoCampaignVisitor = mysql_fetch_array($resultCampaignVisitor);
		return $infoCampaignVisitor['page_history'];
	}

	function getAllCampaign()
	{
		$strsqlCampaign = "select * from tbl_campaign order by campaign_id desc";
		$resultCampaign = mysql_query($strsqlCampaign);
		$campaignList = array();
		while($infoCampaign=mysql_fetch_array($resultCampaign,MYSQL_ASSOC))
		{
			$campaignList[]=$infoCampaign;
		}
		return $campaignList;
	}

	function updateCampaign($post)
	{
		$strsqlCampaign = "update tbl_campaign set name='".$post['name']."', utm_campaign_param='".$post['utm_campaign_param']."' where campaign_id=".$post['campaign_id'];
		if(mysql_query($strsqlCampaign))
			$_SESSION['sess_msg']="Record has been saved";
		else
			$_SESSION['sess_msg']="Record was not saved. Please try again.";
		return true;
	}

	function addCampaign($post)
	{
		
		if($this->checkUniqueCampaignParam($post['utm_campaign_param']))
		{
			
			$name = $post['name'];
			$utm_campaign_param = trim($post['utm_campaign_param']);

			$strsqlCampaign = "insert into tbl_campaign ( name, utm_campaign_param) values('".$name."','".$utm_campaign_param."')";
			if(mysql_query($strsqlCampaign))
			{
				$_SESSION['sess_msg']="Record has been saved";
				return true;
			}
			else
			{
				$_SESSION['sess_msg']="Record was not saved. Please try again.";
				return false;
			}
			
		}
		else
		{
			
			$_SESSION['sess_msg']="Please enter a unique parameter";
			return false;
		}
	}


	function checkUniqueCampaignParam($utmCampaignParam)
	{
		$strsqlCampaign = "select campaign_id from tbl_campaign where utm_campaign_param='".trim($utmCampaignParam)."'";
		$resultCampaign = mysql_query($utmCampaignParam);
		if(mysql_num_rows($resultCampaign)>=1)
		{
			return false;
		}
		else
		{
			return true;
		}

	}

	function deleteCampaignById($campaign_id)
	{
		$strsqlCampaign = "delete from tbl_campaign where campaign_id=".$campaign_id;
		if(mysql_query($strsqlCampaign))
		{
			$_SESSION['sess_msg']="Record has been deleted from list.";
			return true;
		}
		else
		{
			$_SESSION['sess_msg']="Record was not deleted. Please try again.";
			return false;
		}

	}

	function getCampaignVistorsByCampaignId($campaignId)
	{
		$strsqlCampaignVisitors = "select * from tbl_campaign_visitors where campaign_id=".$campaignId;
		$resultCampaignVisitors = mysql_query($strsqlCampaignVisitors);
		$visitorList = array();
		while($infoCampaignVisitors = mysql_fetch_array($resultCampaignVisitors,MYSQL_ASSOC))
		{
			$visitorList[]=$infoCampaignVisitors;

		}
		return $visitorList;
	}

	function getVisitorInfoById($visitorId)
	{
		$strsqlCampaignVisitors = "select * from tbl_campaign_visitors where visitor_id=".$visitorId;
		$resultCampaignVisitors = mysql_query($strsqlCampaignVisitors);
		$infoCampaignVisitors = mysql_fetch_array($resultCampaignVisitors,MYSQL_ASSOC);
		return $infoCampaignVisitors;
	}


	function getCampaignNameById($campaignId)
	{
		$strsqlCampaign="select name from tbl_campaign where campaign_id ='".trim($campaignId)."'";
		$resultCampaign = mysql_query($strsqlCampaign);
		$infoCampaign = mysql_fetch_array($resultCampaign,MYSQL_ASSOC);
		return $infoCampaign['name'];

	}
}
?>