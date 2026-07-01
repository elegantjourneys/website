<?php
	include_once("includes/config.php");

	include_once(BASEPATH_CLASS."enquiry-class.php");
	include_once(BASEPATH_CLASS."customer-class.php");
	include_once(BASEPATH_CLASS."customer-order-class.php");
	include_once(BASEPATH_CLASS."customer-payment-class.php");
	include_once(BASEPATH_CLASS."icici-utility-class.php");

	include_once(BASEPATH_CRM_CLASS."cms-tour-page-name-class.php");
	

	$objEnquiry = new Enquiry();
	$objCustomer = new Customer();
	$objCustomerOrder = new CustomerOrder();
	$objCustomerPayment = new CustomerPayment();
	$objICICIUtility = new ICICIUtility();

	$objTourPageName = new TourPageName();

	$resultPaymentSession = $objCustomerPayment->validatePaymentSession();

	if(!$resultPaymentSession)
	{
		
		header('location:'.WEBROOT);
		exit();
	}
	
	$paymentDetail = $objCustomerPayment->getPaymentDetailBySession();
		
	$gateway = $paymentDetail['gateway'];
	

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

	$tourPageTitle = $objTourPageName->getTourPageNameById($orderDetail['tour_page_id']);

	#### CREATING PAYMENT PARAMETERS
	
	$paymentCode = str_pad($orderDetail['tour_page_id'], 4, '0', STR_PAD_LEFT).str_pad($orderDetail['tour_id'], 4, '0',  STR_PAD_LEFT).str_pad($paymentDetail['id'], 5, '0', STR_PAD_LEFT).str_pad($orderDetail['id'], 5, '0', STR_PAD_LEFT);
	
	$customCode = $orderDetail['tour_page_id'].'#'.$orderDetail['tour_id'].'#'.$paymentDetail['id'].'#'.$orderDetail['id'];

	$notifyUrl = WEBROOT.'update-paypal.php';
	$url = 'process=paypalPayment&payment_id='.$paymentDetail['id'].'&token='.$paymentDetail['payment_code'].'&result=success';
	$cryptUrl = $objCustomerPayment->incodeUrl($url);
	$returnUrl = WEBROOT.'confirmation.php?eid='.$cryptUrl;
	$url = 'process=paypalPayment&payment_id='.$paymentDetail['id'].'&token='.$paymentDetail['payment_code'].'&result=fail';
	$cryptUrl = $objCustomerPayment->incodeUrl($url);
	$cancelUrl = WEBROOT.'confirmation.php?eid='.$cryptUrl;
	

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
								
	$objCustomerPayment->sendPaymentInitiateMail($mailData);

			
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
		<br /><br /><br /><br /><br />
		<p style="text-align:center">Please wait whle we are processing your payment....</p>
<?php
	if($gateway=='paypal')
	{
?>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="payment">
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="business" value="sales@elegantjourneys.com">
			<input type="hidden" name="item_name" value="Travel Booking for <?=$paymentInfo['tour_title']?>">
			<input type="hidden" name="item_number" value="<?=$paymentInfo['payment_code']?>">
			<input type="hidden" name="custom" value="<?=$paymentInfo['custom_code']?>">
			<input type="hidden" name="amount" value="<?=$paymentInfo['amount']?>">
			<input type="hidden" name="no_note" value="1">
			<input type="hidden" name="currency_code" value="<?=$paymentInfo['currency_code']?>">
			<input type="hidden" name="notify_url" value="<?=$paymentInfo['notify_url']?>" >
			
			<input type="hidden" name="return" value="<?=$paymentInfo['return_url']?>" >
			<input type="hidden" name="cancel_return" value="<?=$paymentInfo['cancel_url']?>" >
			
		</form>
<?php
	}
	else if($gateway=='icicipg')
	{
		$paymentUrlParameters = 'p='.$paymentDetail['id'].'&c='.$paymentDetail['payment_code'];
		$cryptParameters = base64_encode(base64_encode($paymentUrlParameters));
		
		
		$responseSuccessURL = "https://www.elegantjourneys.com/success-icici.php?eid=".$cryptParameters;
		$responseFailURL = "https://www.elegantjourneys.com/fail-icici.php?eid=".$cryptParameters;
		//$paymentInfo['amount'] = 1;
		$currencyCode = $paymentInfo['currency_code'];
		//$currencyCode = 'INR';
		$merchantInfo = $objICICIUtility->getPGMerchantsByCurrencyCode($currencyCode);
		
?>


		<form action="https://www4.ipg-online.com/connect/gateway/processing" method="post" id="payment" >
			<input type="hidden" name="timezone" value="IST" />
			<input type="hidden" name="authenticateTransaction" value="true" />
			<input type="hidden" name="txntype" value="sale"/>
			<input type="hidden" name="txndatetime" value="<?php echo $objICICIUtility->getDateTime(); ?>" />
			<input type="hidden" name="hash" value="<?php echo $objICICIUtility->createHash($paymentInfo['amount'],$merchantInfo['currency_number'],$currencyCode); ?>"/>
			<input type="hidden" name="currency" value="<?=$merchantInfo['currency_number']?>" />
			<input type="hidden" name="mode" value="payonly" />
			<input type="hidden" name="storename" value="<?=$merchantInfo['store_id']?>" />
			<input type="hidden" name="chargetotal" value="<?=$paymentInfo['amount']?>" />
			<input type="hidden" name="sharedsecret" value="<?=$merchantInfo['shared_secret']?>" />
			<input type="hidden" name="email" value="sales@elegantjourneys.com">
			<input type="hidden" name="language" value="en_EN">
			<input type="hidden" name="responseSuccessURL" value="<?php echo $responseSuccessURL ?>"/>
			<input type="hidden" name="responseFailURL" value="<?php echo $responseFailURL ?>"/>
			<input type="hidden" name="hash_algorithm" value="SHA1"/>
		</form>
<?php
	}
?>
   
		<script>
			document.getElementById('payment').submit();
		</script>

		
</body>
</html>