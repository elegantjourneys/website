 <?php
	include_once("includes/config.php");

	include_once(BASEPATH_CLASS."enquiry-class.php");
	include_once(BASEPATH_CLASS."customer-class.php");
	include_once(BASEPATH_CLASS."customer-order-class.php");
	include_once(BASEPATH_CLASS."customer-payment-class.php");
	include_once(BASEPATH_CLASS."icicipg-class.php");

	include_once(BASEPATH_CRM_CLASS."cms-tour-page-name-class.php");


	$objEnquiry = new Enquiry();
	$objCustomer = new Customer();
	$objCustomerOrder = new CustomerOrder();
	$objCustomerPayment = new CustomerPayment();
	$objIciciPg = new IciciPg();

	$objTourPageName = new TourPageName();

	$resultPaymentSession = $objCustomerPayment->validatePaymentSession();


	if(!$resultPaymentSession)
	{

		header('location:'.WEBROOT);
		exit();
	}

	$paymentDetail = $objCustomerPayment->getPaymentDetailBySession();

	

	if((!isset($paymentDetail['id']))||($paymentDetail['id']==""))
	{

		header('location:'.WEBROOT);
		exit();
	}


	if($paymentDetail['total_amount']==""||$paymentDetail['currency_code']=="")
	{

		header('location:'.WEBROOT);
		exit();
	}

	$orderDetail = $objCustomerOrder->getOrderById($paymentDetail['order_id']);


	if($orderDetail['customer_id']==0||$orderDetail['customer_id']=="")
	{
		$enquuiryData = array(
									"enquiry_id"		=>	$orderDetail["order_id"]
						);
		$enquiryDetail = $objEnquiry->getEnquiryInformation($enquiryData);

		$customerDetail = array(
									"first_name"			=>		$enquiryDetail['first_name'],
									"last_name"				=>		$enquiryDetail['last_name'],
									"email"					=>		$enquiryDetail['email']
						);
	}
	else
	{
		$customerDetail = $objCustomer->getCustomerById($orderDetail['customer_id']);
	}

	if($orderDetail['tour_page_id']!="")
	{
		$tourPageTitle = $objTourPageName->getTourPageNameById($orderDetail['tour_page_id']);
	}

	#### CREATING PAYMENT PARAMETERS

	$paymentCode = str_pad($orderDetail['tour_page_id'], 4, '0', STR_PAD_LEFT).str_pad($orderDetail['tour_id'], 4, '0',  STR_PAD_LEFT).str_pad($paymentDetail['id'], 5, '0', STR_PAD_LEFT).str_pad($orderDetail['id'], 5, '0', STR_PAD_LEFT);

	$customCode = $orderDetail['tour_page_id'].'#'.$orderDetail['tour_id'].'#'.$paymentDetail['id'].'#'.$orderDetail['id'];

	
	$url = 'process=iciciPayment&payment_id='.$paymentDetail['id'].'&token='.$paymentDetail['payment_code'].'&result=success';
	$cryptUrl = $objCustomerPayment->incodeUrl($url);
	$successPaymentUrl = WEBROOT.'result-icici-payment.php?eid='.$cryptUrl;
	$url = 'process=iciciPayment&payment_id='.$paymentDetail['id'].'&token='.$paymentDetail['payment_code'].'&result=fail';
	$cryptUrl = $objCustomerPayment->incodeUrl($url);
	$failPaymentUrl = WEBROOT.'result-icici-payment.php?eid='.$cryptUrl;

	$storeInformation = array();
	switch($paymentDetail['currency_code'])
	{
		case 'INR':
				$storeInformation['store_id'] = '3396023465';
				$storeInformation['shared_secret'] = 'Ff64shPkKl';
				$storeInformation['currency_id'] = '356';
			break;
		case 'EUR':
				$storeInformation['store_id'] = '3396023466';
				$storeInformation['shared_secret'] = 'Gm11ioLiXt';
				$storeInformation['currency_id'] = '978';
			break;
		case 'GBP':
				$storeInformation['store_id'] = '3396023467';
				$storeInformation['shared_secret'] = 'Dp93ljHjZr';
				$storeInformation['currency_id'] = '826';
			break;
		case 'USD':
				$storeInformation['store_id'] = '3396023468';
				$storeInformation['shared_secret'] = 'Ra16ehHaCi';
				$storeInformation['currency_id'] = '840';
			break;
		case 'AUD':
				$storeInformation['store_id'] = '3396023469';
				$storeInformation['shared_secret'] = 'Yi62ogTrXk';
				$storeInformation['currency_id'] = '036';
			break;
		case 'AED':
				$storeInformation['store_id'] = '3396023470';
				$storeInformation['shared_secret'] = 'Ey84wsMwSn';
				$storeInformation['currency_id'] = '784';
			break;
		default:
				$storeInformation['store_id'] = '3396023465';
				$storeInformation['shared_secret'] = 'Ff64shPkKl';
				$storeInformation['currency_id'] = '356';
			break;


	}


	$paymentInfo = array(
							"tour_title"			=>		$tourPageTitle,
							"payment_code"			=>		$paymentCode,
							"custom_code"			=>		$customCode,
							"amount"				=>		$paymentDetail['total_amount'],
							"customer_first_name"	=>		$customerDetail['first_name'],
							"customer_last_name"	=>		$customerDetail['last_name'],
							"customer_email"		=>		$customerDetail['email'],
							"currency_code"			=>		$paymentDetail['currency_code'],
							"notify_url"			=>		$notifyUrl,
							"return_url"			=>		$returnUrl,
							"cancel_url"			=>		$cancelUrl
				);

	$mailData = array(
							"name"				=>			$customerDetail['first_name'].' '.$customerDetail['last_name'],
							"email"				=>			$customerDetail['email'],
							"payment_code"		=>			$paymentCode,
							"amount"			=>			$paymentDetail['total_amount'],
							"currency_code"		=>			$paymentDetail['currency_code']
				);

	


?>
	<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
</head>
<body>
		<div style="display:none;">
		<?php
			$objCustomerPayment->sendPaymentInitiateMail($mailData);
		?>
		</div>
		<br /><br /><br /><br /><br />
		<p style="text-align:center">Please wait whle we are processing your payment....</p>

    <form action="https://www4.ipg-online.com/connect/gateway/processing" method="post" id="payment" >
	<input type="hidden" name="timezone" value="IST" />
	<input type="hidden" name="authenticateTransaction" value="true" />
    <input type="hidden" name="txntype" value="sale"/>
    <input type="hidden" name="txndatetime" value="<?php echo $objIciciPg->getDateTime(); ?>" />
	<input type="hidden" name="hash" value="<?php echo $objIciciPg->createHash($paymentInfo['amount'],$storeInformation['currency_id']); ?>"/>
	<input type="hidden" name="currency" value="<?=$storeInformation['currency_id']?>" />
	<input type="hidden" name="mode" value="payonly" />
	<input type="hidden" name="storename" value="<?=$storeInformation['store_id']?>" />
	<input type="hidden" name="chargetotal" value="<?=$paymentInfo['amount']?>" />
	<input type="hidden" name="full_bypass"  value="false" >
	<input type="hidden" name="sharedsecret" value="<?=$storeInformation['shared_secret']?>" />
	<input type="hidden" name="email" value="sales@elegantjourneys.com">
	<input type="hidden" name="language" value="en_EN">
	<input type="hidden" name="responseSuccessURL" value="<?=$successPaymentUrl?>">
	<input type="hidden" name="responseFailURL" value="<?=$failPaymentUrl?>">
	<input type="hidden" name="hash_algorithm" value="SHA1"/>











</form>
		<script>
			document.getElementById('payment').submit();
		</script>


</body>
</html>
