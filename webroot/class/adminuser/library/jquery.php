<?php
	include_once("../includes/config.php");
	include_once("../includes/connect.php");
	include_once("../library/library.php");
	switch($_REQUEST['method'])
	{
		case 'getAdminBtUserId':
			include_once('../class/admin.php');
			$objAdmin = new Admin();
			$adminUserInfo = $objAdmin->getAdminById($_POST['userId']);
			foreach($adminUserInfo as $key=>$value)
			{
				echo $key.'##'.$value.'####';
			}
			break;
		
		//sudish code start here
		case 'getPaymentsId':
			include_once('../class/payments.php');
			$objPayments = new Payments();
			$PaymentsUserInfo = $objPayments->getPaymentsById($_POST['paymentsId']);
			foreach($PaymentsUserInfo as $key=>$value)
			{
				echo $key.'##'.$value.'####';
			}
			break;
		//end
		case 'getMembershipById':
			include_once('../class/membership-detail.php');
			$objMembershipDetail = new MembershipDetail();
			$membershipInfo=$objMembershipDetail->getMembershipById($_POST['membershipId']);
			foreach($membershipInfo as $key=>$value)
			{
				echo $key.'##'.$value.'####';
			}
			break;
		case 'getStateList':
			include_once('../class/network-exist.php');
			$objNetworkExist = new NetworkExist();
			$stateList = $objNetworkExist->getStateList($_POST['countryId']);
			
			foreach($stateList as $state)
			{	
				echo $state['id']."##".$state['region_name']."####";

			}
			break;
		case 'getCityList':
			include_once('../class/network-exist.php');
			$objNetworkExist = new NetworkExist();
			$stateList = $objNetworkExist->getCityListByStateId($_POST['stateId']);
			
			foreach($stateList as $state)
			{	
				echo $state['id']."##".$state['region_name']."####";

			}
			break;
		case 'getWebiteUserDetail':
			include_once('../class/user.php');
			$objUser = new User();
			$userInfo=$objUser->getUserById($userId);
			foreach($userInfo as $key=>$value)
			{
				echo $key.'##'.$value.'####';
			}

	}
?>