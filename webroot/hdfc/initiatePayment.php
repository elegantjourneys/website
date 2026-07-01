<?php
session_start();
use PaymentHandler\APIException;
require_once realpath("./PaymentHandler.php");
use PaymentHandler\PaymentHandler;

$paymentHandler = new PaymentHandler("resources/config.json");

$orderId = $_SESSION['hdfc_geteway']['order_id'];
$customerId = $_SESSION['hdfc_geteway']['customer_id'];
$orderAmount = $_SESSION['hdfc_geteway']['amount'];
$currency = $_SESSION['hdfc_geteway']['currency'];
// block:start:session-function

if($currency=='INR')
{
	$params = json_decode("{\n\"amount\":\"$orderAmount\",\n\"order_id\":\"$orderId\",\n\"customer_id\":\"$customerId\",\n\"action\":\"paymentPage\",\n\"return_url\": \"https://www.elegantjourneys.com/hdfc/handlePaymentResponse.php\"\n}", true);
}
else
{
	$params = json_decode("{\n\"amount\":\"$orderAmount\",\n\"order_id\":\"$orderId\",\n\"customer_id\":\"$customerId\",\n\"action\":\"paymentPage\",\n\"return_url\": \"https://www.elegantjourneys.com/hdfc/handlePaymentResponse.php\",\n\"currency\":\"$currency\"\n}", true);
	
}


try {
    $session = $paymentHandler->orderSession($params);
	
    // block:end:session-function
	
    $redirect = $session["payment_links"]["web"];
    header("Location: {$redirect}");
    exit;

} catch (APIException $e ) {
    http_response_code(500);
    $error = json_encode(["message" => $e->getErrorMessage(), "error_code" => $e->getErrorCode(), "http_response_code" => $e->getHttpResponseCode()]);
    echo "<p> Payment server threw a non-2xx error. Error message: {$error} </p>";
    exit;
 } catch (Exception $e) {
    http_response_code(500);
    echo " <p> Unexpected error occurred, Error message:  {$e->getMessage()} </p>";
    exit;
}
?>
