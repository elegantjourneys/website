<?php
include_once(BASEPATH."class/first-class.php");

class CampaignHandler extends FirstClass
{
	

	function setCampaignParameter()
	{
		$pageName = $this->getPageUrl();

		$resultCampaign = $this->getCampaignStartUp($pageName);

		if($resultCampaign)
		{
			return;
		}

		if((isset($_SESSION['campaign']['id']))&&($_SESSION['campaign']['id']!=""))
		{
			$_SESSION['campaign']['last_url'] =  $pageName;
		}
	}

	function getCampaignStartUp($pageName)
	{
		$domainName = $_SERVER['HTTP_HOST'];
		$campaignList = $this->getCampaignListByDomainName($domainName);

		

		foreach($campaignList as $campaign)
		{
			$parameterUrl = $campaign['parameter_name'].'='.$campaign['parameter_value'];

			if(preg_match("/{$parameterUrl}/i", strtolower($pageName)))
			{
				$campaignValue = array(
											"id"				=>		'',
											"campaign_name"		=>		$campaign['campaign_name'],
											"campaign_id"			=>		$campaign['campaign_id'],
											"first_urls"		=>		$pageName,
											"cookie_value"		=>		$this->genRandomString(10),
											"last_url"			=>		''
					
								);
				$_SESSION['campaign'] = $campaignValue;
				return true;

			}

			return false;
		}
	}

	function getCampaignListByDomainName($domainName)
	{
		$objMysqli = $this->setMysqliConnection();
		$strsqlCampaign = "select * from tbls_campaign_parameters where domain_name='".$domainName."'";
		$objResultCampaign = $objMysqli->query($strsqlCampaign);

		$campaignList = array();
		while($infoCampaign = $objResultCampaign->fetch_array(MYSQLI_ASSOC))
		{
			$campaignList[] = array(
										"campaign_id"		=>		$infoCampaign['id'],
										"campaign_name"		=>		$infoCampaign['name'],
										"domain_name"		=>		$infoCampaign['domain_name'],
										"parameter_name"	=>		$infoCampaign['parameter_name'],
										"parameter_value"	=>		$infoCampaign['parameter_value']
							);
		}

		$this->closeMysqliConnection($objMysqli);
		return $campaignList;
	
	}

	
}
?>