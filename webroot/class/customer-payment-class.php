<?php
include_once(BASEPATH."class/first-class.php");
class CustomerPayment extends FirstClass
{

	function addNewPayment($data)
	{
		//$this->setDatabaseConnection();
		$objMysqli = $this->setDatabaseConnection();
		$strsqlPayment = "insert into tbls_payment(order_id, enquiry_id, payment_code, invoice_number, total_amount, currency_code, gateway, transaction_id, status, payment_date, payment_details) values('".$data['order_id']."','".$data['enquiry_id']."','".$data['payment_code']."','".$data['invoice_number']."','".$data['total_amount']."','".$data['currency_code']."','".$data['gateway']."','".$data['transaction_id']."','".$data['status']."','".$data['payment_date']."','".$data['payment_details']."')";
		$resultPayment = mysqli_query($objMysqli,$strsqlPayment);

		$paymentId = mysqli_insert_id($objMysqli);
		$this->closeDBConnection($objMysqli);
		return $paymentId;

	}

	function createPaymentSession($data)
	{

		if($data['action']=='initiate')
		{
			$_SESSION['customer_order'] = array();
		}

		foreach($data as $key=>$value)
		{
			if($key=='action')
			{
				continue;
			}
			$_SESSION['customer_order'][$key]=$value;
		}

		return true;
	}

	function validatePaymentSession()
	{
		$validationResult = true;

		if((!isset($_SESSION['customer_order']['order_id']))||($_SESSION['customer_order']['order_id']==""))
		{
			$validationResult = false;
		}

		if((!isset($_SESSION['customer_order']['payment_id']))||($_SESSION['customer_order']['payment_id']==""))
		{
			$validationResult = false;
		}

		if((!isset($_SESSION['customer_order']['payment_code']))||($_SESSION['customer_order']['payment_code']==""))
		{
			$validationResult = false;
		}
		return $validationResult;
	}

	function getPaymentDetailBySession()
	{
		//$this->setDatabaseConnection();
		$objMysqli = $this->setDatabaseConnection();
		
		$strsqlPayment = "select * from tbls_payment where id=".$_SESSION['customer_order']['payment_id']." and order_id=".$_SESSION['customer_order']['order_id']." and payment_code='".$_SESSION['customer_order']['payment_code']."'";
		$resultPayment = mysqli_query($objMysqli,$strsqlPayment);
		$infoPayment = mysqli_fetch_array($resultPayment,MYSQLI_ASSOC);
		$this->closeDBConnection($objMysqli);
		return $infoPayment;

	}

	function getPaymentDetailByPaymentCodeAndId($data)
	{
		//$this->setDatabaseConnection();

		$objMysqli = $this->setDatabaseConnection();
		$strsqlPayment = "select * from tbls_payment where id=".$data['payment_id']." and  payment_code='".$data['payment_code']."'";
		$resultPayment = mysqli_query($objMysqli,$strsqlPayment);
		$infoPayment = mysqli_fetch_array($resultPayment,MYSQLI_ASSOC);
		$this->closeDBConnection($objMysqli);
		return $infoPayment;

	}


	function getPaymentDetailByCustomerIdAndId($data)
	{
		$objMysqli = $this->setDatabaseConnection();
		
		$strsqlPayment = "select * from tbls_payment where id=".$data['payment_id']." and  customer_id='".$data['customer_id']."'";
		$resultPayment = mysqli_query($objMysqli,$strsqlPayment);
		$infoPayment = mysqli_fetch_array($resultPayment,MYSQLI_ASSOC);
		$this->closeDBConnection($objMysqli);
		return $infoPayment;

	}



	function getPaymentDetailById($paymentId)
	{
		$objMysqli = $this->setDatabaseConnection();
		
		$strsqlPayment = "select * from tbls_payment where id=".$paymentId;
		$resultPayment = mysqli_query($objMysqli,$strsqlPayment);
		$infoPayment = mysqli_fetch_array($resultPayment,MYSQLI_ASSOC);
		$this->closeDBConnection($objMysqli);
		return $infoPayment;

	}

	function getPaymentConfirmation($data=array())
	{
		include_once(BASEPATH_CLASS."customer-order-class.php");
		include_once(BASEPATH_CLASS."customer-class.php");
		include_once(BASEPATH_CLASS."enquiry-class.php");

		$objCustomerOrder = new CustomerOrder();
		$objCustomer = new Customer();
		$objEnquiry = new Enquiry();

		$objMysqli = $this->setMysqliConnection();
		$paymentId = $this->filterMysqliReceivedData($objMysqli,$data['payment_id']);
		$paymentCode = $this->filterMysqliReceivedData($objMysqli,$data['payment_code']);
		$this->closeMysqliConnection($objMysqli);

		
		$paymentValidation = true;

		if($paymentId==""||$paymentCode=="")
		{
			$paymentValidation = false;
			
		}
		else
		{
			$paymentData = array(
									"payment_id"	=>	$paymentId,
									"payment_code"	=>	$paymentCode
							);
			$paymentDetail = $this->getPaymentInformationByCodeAndId($paymentData);
			$orderDetail = $objCustomerOrder->getOrderById($paymentDetail['order_id']);

			

			#### GETTING CUSTOMER INFORMATION
			if($orderDetail['customer_id']=='0'||$orderDetail['customer_id']=='')
			{
				$enquiryId = $orderDetail['enquiry_id'];

				$enquiryData = array(
										"enquiry_id"		=>		$enquiryId
								);

				$enquiryInfo = $objEnquiry->getEnquiryInformation($enquiryData);

				if($enquiryInfo['first_name']!=""&&$enquiryInfo['last_name']!="")
				{
					$customerName = $enquiryInfo['first_name'].' '.$enquiryInfo['last_name'];
				}
				else
				{
					$customerName = $enquiryInfo['name'];
				}

				$customerDetail = array(
											"name"		=>		$customerName,
											"email"		=>		$enquiryInfo['email'],
											"phone"		=>		$enquiryInfo['phone']
								);

			}
			else
			{
				$customerId = $orderDetail['customer_id'];
				$customerInfo = $objCustomer->getCustomerById($customerId);

				if($customerInfo['first_name']!=""&&$customerInfo['last_name']!="")
				{
					$customerName = $customerInfo['first_name'].' '.$customerInfo['last_name'];
				}
				else
				{
					$customerName = $customerInfo['name'];
				}

				$customerDetail = array(
											"name"		=>		$customerName,
											"email"		=>		$customerInfo['email'],
											"phone"		=>		$customerInfo['phone']
								);
			}

			
			#### GETTING CUSTOMER INFORMATION ENDS HERE
			
			switch($paymentDetail['status'])
			{
				case 'completed':
						$description ='<div style="text-align:left">Dear '.$customerDetail['name'].'<br /><br />Thank you for the payment of '.$paymentDetail['currency_code']." ".$paymentDetail['total_amount'].'. Your payment has been received to us. We will update you shortly.<br /><br /><strong>Elegant Journeys Team</strong></div>';
						$title='Your payment has been confirmed';
					break;
				case 'pending':
						$description ='<div style="text-align:left">Dear '.$customerDetail['name'].'<br /><br />We have not received your payment confirmation. If your payment has been deducted from bank, please let us know, so that  we can check with our bank.<br /><br /><strong>Elegant Journeys Team</strong></div>';
						$title='Your payment confirmation is pending';
					break;
				case 'fail':
						$description ='<div style="text-align:left">Dear '.$customerDetail['name'].'<br /><br />Your payment was not confirmed. Please try again. If your payment has been deducted from bank, please let us know, so that  we can check with our bank. <br /><strong>Elegant Journeys Team</strong></div>';
						$title='Your payment was not confirmed.';
					break;
				default:
						$description ='<div style="text-align:left">Dear '.$customerDetail['name'].'<br /><br />Your payment was not confirmed. Please try again. If your payment has been deducted from bank, please let us know, so that  we can check with our bank. <br /><strong>Elegant Journeys Team</strong></div>';
						$title='Your payment was not confirmed.';
					break;
			}

			$this->unsetConfirmationParameter();
			$messageData = array(
										"title"			=>		$title,
										"description"		=>		$description
						);
			$this->setConfirmationParameters($messageData);

		}
	}


	function getCustomerDetailById($customerId)
	{
		$objMysqli = $this->setDatabaseConnection();
		
		$strsqlPayment = "select * from cms_customer where id=".$customerId;
		$resultPayment = mysqli_query($objMysqli,$strsqlPayment);
		$infoPayment = mysqli_fetch_array($resultPayment,MYSQLI_ASSOC);
		$this->closeDBConnection($objMysqli);
		return $infoPayment;

	}


	function sendOnHoldPaymentMail($paymentId)
	{
			$paymentDetail = $this->getPaymentDetailById($paymentId);
			$customerInfo = $this->getCustomerDetailById($paymentDetail['customer_id']);
			$transactionId = 'EJ'.str_pad($paymentDetail['id'], 6, "0", STR_PAD_LEFT);


			$message = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
							<HTML>
							<HEAD>
								<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
								<TITLE>Payment Invoice</TITLE>

								<STYLE TYPE="text/css">
								<!--
									@page { margin: 1in }
									P { margin-bottom: 0.08in; direction: ltr; widows: 2; orphans: 2 }
									A:link { color: #0000ff; so-language: zxx }
								-->
								</STYLE>
							</HEAD>
							<BODY LANG="en-IN" LINK="#0000ff" DIR="LTR">
							<center>

							<TABLE WIDTH=600 CELLPADDING=0 CELLSPACING=0 >
								<COL WIDTH=25>
								<COL WIDTH=575>
								<TR>
									<TD WIDTH=25 STYLE="border: none; padding: 0in">
										<P><BR>
										</P>
									</TD>
									<TD WIDTH=575 VALIGN=TOP STYLE="border: none; padding: 0in">
										<TABLE WIDTH=552 CELLPADDING=0 CELLSPACING=0>
											<COL WIDTH=552>
											<TR>
												<TD WIDTH=552 HEIGHT=15 STYLE="border: none; padding: 0in">
													<P><BR>
													</P>
												</TD>
											</TR>
											<TR>
												<TD WIDTH=552 STYLE="border: none; padding: 0in">
													<P><FONT COLOR="#575757"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>Dear
													'.$customerInfo['first_name'].' '.$customerInfo['last_name'].',</B></FONT></FONT></FONT></P>
												</TD>
											</TR>
											<TR>
												<TD WIDTH=552 HEIGHT=3 STYLE="border: none; padding: 0in">

												</TD>
											</TR>
											<TR>
												<TD WIDTH=552 STYLE="border: none; padding: 0in">
													<P><FONT COLOR="#575757"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt">Your payment is showing pending status with our bank. Please confrim with your bank that payment has been debited to your card account.<br><br>Your payment has not been approved by the bank. We will update you in 2 business days, after your payment is approved.</FONT></FONT></FONT></P>
												</TD>
											</TR>
											<TR>
												<TD WIDTH=552 HEIGHT=15 STYLE="border: none; padding: 0in">
													<P>
													</P>
												</TD>
											</TR>
											<TR>
												<TD WIDTH=552 VALIGN=TOP STYLE="border: none; padding: 0in">
													<CENTER>
														<TABLE WIDTH=472 CELLPADDING=3 CELLSPACING=1 BGCOLOR="#afafaf" border="1">
															<COL WIDTH=140>
															<COL WIDTH=151>
															<!-- <COL WIDTH=145> -->
															<TR>
																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-right:0px solid #ffffff;">
																	<P ALIGN=CENTER style="line-height:20px; padding-top:8px;"><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>Transaction Date </B></FONT></FONT></FONT><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><BR></FONT></FONT></FONT></P>
																</TD>

																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-left:0px solid #ffffff;">
																	<P ALIGN=CENTER><FONT COLOR="#575757"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>'.date("d-M-Y",time()).'</B></FONT></FONT></FONT></P>
																</TD>

															</TR>

															<TR>
																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-right:0px solid #ffffff;">
																	<P ALIGN=CENTER style="line-height:20px; padding-top:8px;"><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>Transaction Id </B></FONT></FONT></FONT><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><BR></FONT></FONT></FONT></P>
																</TD>

																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-left:0px solid #ffffff;">
																	<P ALIGN=CENTER><FONT COLOR="#575757"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>'.$transactionId.'</B></FONT></FONT></FONT></P>
																</TD>

															</TR>

															<TR>
																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-right:0px solid #ffffff;">
																	<P ALIGN=CENTER style="line-height:20px; padding-top:8px;"><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>Transaction Code </B></FONT></FONT></FONT><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><BR></FONT></FONT></FONT></P>
																</TD>

																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-left:0px solid #ffffff;">
																	<P ALIGN=CENTER><FONT COLOR="#575757"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>'.$paymentDetail['payment_code'].'</B></FONT></FONT></FONT></P>
																</TD>

															</TR>
														  <TR>
																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-right:0px solid #ffffff;">
																	<P ALIGN=CENTER style="line-height:20px; padding-top:8px;"><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>Transaction Amount </B></FONT></FONT></FONT><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><BR></FONT></FONT></FONT></P>
																</TD>

																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-left:0px solid #ffffff;">
																	<P ALIGN=CENTER><FONT COLOR="#575757"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>'.$paymentDetail['currency_code'].' '.number_format($paymentDetail['total_amount'],2).'</B></FONT></FONT></FONT></P>
																</TD>

															</TR>

														</TABLE>
													</CENTER>

												</TD>
											</TR>
											<TR>
												<TD WIDTH=552 HEIGHT=10 STYLE="border: none; padding: 0in">
													<P STYLE="margin-bottom: 0in; line-height: 100%"><BR>
													</P>
												</TD>
											</TR>


											<TR>
												<TD WIDTH=552 VALIGN=TOP STYLE="border: none; padding: 0in">
													<P STYLE="margin-bottom: 0in; line-height: 140%"><BR>
													</P>

													<TABLE WIDTH=552 CELLPADDING=0 CELLSPACING=0>
														<COL WIDTH=552>


														<TR>
															<TD WIDTH=552 VALIGN=TOP STYLE="border: none; padding: 0in">
																<TABLE WIDTH=528 CELLPADDING=0 CELLSPACING=0>
																	<COL WIDTH=308>
							<!-- 										<COL WIDTH=220> -->

																	<TR>
															<TD WIDTH=552 STYLE="border: none; padding: 0in">
																<P><FONT SIZE=1 STYLE="font-size: 9pt; font-weight:bold;">Thanks and regards,</FONT><br />


																	</P>
															</TD>
														</TR>


																	<TR>
																		<TD WIDTH=308 STYLE="border: none; padding: 0in">
																			<P><A NAME="_GoBack"></A><FONT><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>
							<font color="#575757" >												<span style="color:#0b2775;">ELEGANT JOURNEYS</span></B><br />
							
							Email: sales@elegantjourneys.co <br />
							Web: www.elegantjourneys.com <br />
							</font>
							</FONT></FONT></FONT><FONT COLOR="#575757"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B><BR></B></FONT></FONT></FONT><BR>
																			</P>
																		</TD>
																	</TR>
																</TABLE>
																<P STYLE="margin-bottom: 0in; line-height: 100%"><BR>
																</P>
															</TD>
														</TR>
														<TR>
															<TD WIDTH=552 HEIGHT=15 STYLE="border: none; padding: 0in">
																<P STYLE="margin-bottom: 0in; line-height: 100%"><BR>
																</P>
															</TD>
														</TR>
													</TABLE>
													<P STYLE="margin-bottom: 0in; line-height: 100%"><BR>
													</P>
												</TD>
											</TR>
										</TABLE>
										<P STYLE="margin-bottom: 0in; line-height: 100%"><BR>
										</P>
									</TD>
								</TR>
							</TABLE>
							</center>

							</BODY>
							</HTML>';

							include_once(BASEPATH."class/mailer-class.php");
							$objMailer = new Mailer();
							$mailerData = array();
							$mailerData['mail_type']='html';
							$mailerData['mail_source']='php';
							$mailerData['to'] = $customerInfo['email'];
							$mailerData['subject'] = 'Payment pending status';
							$mailerData['from'] = EMAIL_SALES;
							//$mailerData['cc'] = EMAIL_WEBADMIN;
							$mailerData['bcc'] = EMAIL_SALES;
							$mailerData['message']= $message;
							$mailResult=$objMailer->sendUserMail($mailerData);

	}


	function sendConfirmationMail($paymentId)
	{
			$paymentDetail = $this->getPaymentDetailById($paymentId);
			$customerInfo = $this->getCustomerDetailById($paymentDetail['customer_id']);
			$transactionId = 'HDFC'.str_pad($paymentDetail['id'], 6, "0", STR_PAD_LEFT);


			$message = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
							<HTML>
							<HEAD>
								<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
								<TITLE>Payment Invoice</TITLE>

								<STYLE TYPE="text/css">
								<!--
									@page { margin: 1in }
									P { margin-bottom: 0.08in; direction: ltr; widows: 2; orphans: 2 }
									A:link { color: #0000ff; so-language: zxx }
								-->
								</STYLE>
							</HEAD>
							<BODY LANG="en-IN" LINK="#0000ff" DIR="LTR">
							<center>

							<TABLE WIDTH=600 CELLPADDING=0 CELLSPACING=0 >
								<COL WIDTH=25>
								<COL WIDTH=575>
								<TR>
									<TD WIDTH=25 STYLE="border: none; padding: 0in">
										<P><BR>
										</P>
									</TD>
									<TD WIDTH=575 VALIGN=TOP STYLE="border: none; padding: 0in">
										<TABLE WIDTH=552 CELLPADDING=0 CELLSPACING=0>
											<COL WIDTH=552>
											<TR>
												<TD WIDTH=552 HEIGHT=15 STYLE="border: none; padding: 0in">
													<P><BR>
													</P>
												</TD>
											</TR>
											<TR>
												<TD WIDTH=552 STYLE="border: none; padding: 0in">
													<P><FONT COLOR="#575757"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>Dear
													'.$customerInfo['first_name'].' '.$customerInfo['last_name'].',</B></FONT></FONT></FONT></P>
												</TD>
											</TR>
											<TR>
												<TD WIDTH=552 HEIGHT=3 STYLE="border: none; padding: 0in">

												</TD>
											</TR>
											<TR>
												<TD WIDTH=552 STYLE="border: none; padding: 0in">
													<P><FONT COLOR="#575757"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt">Thank you for successfully processing your tour payment. <br><br>Please find below receipt of your transaction.</FONT></FONT></FONT></P>
												</TD>
											</TR>
											<TR>
												<TD WIDTH=552 HEIGHT=15 STYLE="border: none; padding: 0in">
													<P>
													</P>
												</TD>
											</TR>
											<TR>
												<TD WIDTH=552 VALIGN=TOP STYLE="border: none; padding: 0in">
													<CENTER>
														<TABLE WIDTH=472 CELLPADDING=3 CELLSPACING=1 BGCOLOR="#afafaf" border="1">
															<COL WIDTH=140>
															<COL WIDTH=151>
															<!-- <COL WIDTH=145> -->
															<TR>
																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-right:0px solid #ffffff;">
																	<P ALIGN=CENTER style="line-height:20px; padding-top:8px;"><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>Payment Date </B></FONT></FONT></FONT><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><BR></FONT></FONT></FONT></P>
																</TD>

																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-left:0px solid #ffffff;">
																	<P ALIGN=CENTER><FONT COLOR="#575757"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>'.date("d-M-Y",time()).'</B></FONT></FONT></FONT></P>
																</TD>

															</TR>

															<TR>
																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-right:0px solid #ffffff;">
																	<P ALIGN=CENTER style="line-height:20px; padding-top:8px;"><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>Transaction Id </B></FONT></FONT></FONT><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><BR></FONT></FONT></FONT></P>
																</TD>

																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-left:0px solid #ffffff;">
																	<P ALIGN=CENTER><FONT COLOR="#575757"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>'.$transactionId.'</B></FONT></FONT></FONT></P>
																</TD>

															</TR>

															<TR>
																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-right:0px solid #ffffff;">
																	<P ALIGN=CENTER style="line-height:20px; padding-top:8px;"><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>Payment Code </B></FONT></FONT></FONT><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><BR></FONT></FONT></FONT></P>
																</TD>

																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-left:0px solid #ffffff;">
																	<P ALIGN=CENTER><FONT COLOR="#575757"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>'.$paymentDetail['payment_code'].'</B></FONT></FONT></FONT></P>
																</TD>

															</TR>
														  <TR>
																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-right:0px solid #ffffff;">
																	<P ALIGN=CENTER style="line-height:20px; padding-top:8px;"><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>Amount Paid </B></FONT></FONT></FONT><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><BR></FONT></FONT></FONT></P>
																</TD>

																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-left:0px solid #ffffff;">
																	<P ALIGN=CENTER><FONT COLOR="#575757"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>'.$paymentDetail['currency_code'].' '.number_format($paymentDetail['total_amount'],2).'</B></FONT></FONT></FONT></P>
																</TD>

															</TR>

														</TABLE>
													</CENTER>

												</TD>
											</TR>
											<TR>
												<TD WIDTH=552 HEIGHT=10 STYLE="border: none; padding: 0in">
													<P STYLE="margin-bottom: 0in; line-height: 100%"><BR>
													</P>
												</TD>
											</TR>


											<TR>
												<TD WIDTH=552 VALIGN=TOP STYLE="border: none; padding: 0in">
													<P STYLE="margin-bottom: 0in; line-height: 140%"><BR>
													</P>

													<TABLE WIDTH=552 CELLPADDING=0 CELLSPACING=0>
														<COL WIDTH=552>


														<TR>
															<TD WIDTH=552 VALIGN=TOP STYLE="border: none; padding: 0in">
																<TABLE WIDTH=528 CELLPADDING=0 CELLSPACING=0>
																	<COL WIDTH=308>
							<!-- 										<COL WIDTH=220> -->

																	<TR>
															<TD WIDTH=552 STYLE="border: none; padding: 0in">
																<P><FONT SIZE=1 STYLE="font-size: 9pt; font-weight:bold;">Thanks and regards,</FONT><br />


																	</P>
															</TD>
														</TR>


																	<TR>
																		<TD WIDTH=308 STYLE="border: none; padding: 0in">
																			<P><A NAME="_GoBack"></A><FONT><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>
							<font color="#575757" >												<span style="color:#0b2775;">ELEGANT JOURNEYS</span></B><br />
							Email: sales@elegantjourneys.co <br />
							Web: www.elegantjourneys.com <br />
							</font>
							</FONT></FONT></FONT><FONT COLOR="#575757"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B><BR></B></FONT></FONT></FONT><BR>
																			</P>
																		</TD>
																	</TR>
																</TABLE>
																<P STYLE="margin-bottom: 0in; line-height: 100%"><BR>
																</P>
															</TD>
														</TR>
														<TR>
															<TD WIDTH=552 HEIGHT=15 STYLE="border: none; padding: 0in">
																<P STYLE="margin-bottom: 0in; line-height: 100%"><BR>
																</P>
															</TD>
														</TR>
													</TABLE>
													<P STYLE="margin-bottom: 0in; line-height: 100%"><BR>
													</P>
												</TD>
											</TR>
										</TABLE>
										<P STYLE="margin-bottom: 0in; line-height: 100%"><BR>
										</P>
									</TD>
								</TR>
							</TABLE>
							</center>

							</BODY>
							</HTML>';

							include_once(BASEPATH."class/mailer-class.php");
							$objMailer = new Mailer();
							$mailerData = array();
							$mailerData['mail_type']='html';
							$mailerData['mail_source']='php';
							$mailerData['to'] = $customerInfo['email'];
							$mailerData['subject'] = 'Payment confirmation';
							$mailerData['from'] = EMAIL_SALES;
							//$mailerData['cc'] = EMAIL_WEBADMIN;
							$mailerData['bcc'] = EMAIL_SALES;
							$mailerData['message']= $message;
							$mailResult=$objMailer->sendUserMail($mailerData);

	}


	function getPaymentInformationByCodeAndId($data=array())
	{
		$paymentId = $data['payment_id'];
		$paymentCode = $data['payment_code'];
		$objMysqli = $this->setDatabaseConnection();
		

		$strsqlPayment = "select * from tbls_payment where id='".$paymentId."' and payment_code = '".$paymentCode."'";
		$resultPayment = mysqli_query($objMysqli,$strsqlPayment);
		$infoPayment = mysqli_fetch_array($resultPayment,MYSQLI_ASSOC);
		$this->closeDBConnection($objMysqli);
		return $infoPayment;
	}

	function validateCustomerPayment($data)
	{

		$tourPageId = substr($data['item_number'],0,4);
		$tourPageId = ltrim($tourPageId,'0');

		$tourId = substr($data['item_number'],4,4);
		$tourId = ltrim($tourId,'0');

		$paymentId = substr($data['item_number'],8,5);
		$paymentId = ltrim($paymentId,'0');

		$orderId = substr($data['item_number'],13,5);
		$orderId = ltrim($orderId,'0');

		if($tourPageId==""||$tourId==""||$paymentId==""||$orderId=="")
		{
			return false;
		}

		if($data['tour_page_id']!=$tourPageId||$data['tour_id']!=$tourId||$data['payment_id']!=$paymentId||$data['order_id']!=$orderId)
		{
			return false;
		}

		#### checking for row

		$objMysqli = $this->setDatabaseConnection();
		
		$strsqlPayment = "select * from tbls_payment where id='".$paymentId."' and order_id = '".$orderId."'";
		$resultPayment = mysqli_query($objMysqli,$strsqlPayment);
		if(mysqli_num_rows($resultPayment)>=1)
		{
			$this->closeDBConnection($objMysqli);
			return true;
		}
		else
		{
			$this->closeDBConnection($objMysqli);
			return false;
		}
		return false;
	}


	function updatePaymentDetails($data)
	{

		$objMysqli = $this->setDatabaseConnection();
		

		if($data['transaction_id']!="")
		{
			$strsqlPayment = "update tbls_payment set status='".$data['status']."', transaction_id='".$data['transaction_id']."', payment_details='".$data['payment_details']."'  where id=".$data['id'];
		}
		else
		{
			$strsqlPayment = "update tbls_payment set status='".$data['status']."', payment_details='".$data['payment_details']."'  where id=".$data['id'];
		}

		
			$myFile = "testFile1.txt";
		$fh = fopen($myFile, 'w') or die("can't open file");
		$stringData = "-------------".$strsqlPayment."\n";
		fwrite($fh, $stringData);
		fclose($fh);

		$resultPayment = mysqli_query($objMysqli,$strsqlPayment);
		$this->closeDBConnection($objMysqli);
		if($data['status']=='completed')
		{
			$this->sendConfirmationMail($data['id']);
		}
		else if($data['status']=='onhold')
		{
			$this->sendOnHoldPaymentMail($data['id']);

		}




		return true;
	}

	function verifyCustomerPayment($data)
	{
		$objMysqli = $this->setDatabaseConnection();
		$result = array();
		$paymentValidation = 'fail';

		$strsqlCustomer = "select id from cms_customer where email='".$data['customer_email']."'";
		$resultCustomer = mysqli_query($objMysqli,$strsqlCustomer);
		$infoCustomer = mysqli_fetch_array($resultCustomer,MYSQLI_ASSOC);

		if((isset($infoCustomer['id']))&&($infoCustomer['id']!=""))
		{
			
			$customerId = $infoCustomer['id'];
			$strsqlPayment = "select * from tbls_payment where customer_id=".$customerId." and user_payment_code ='".$data['user_payment_code']."'";
			$resultPayment = mysqli_query($objMysqli,$strsqlPayment);
			if(mysqli_num_rows($resultPayment)>=1)
			{
				
				$infoPayment = mysqli_fetch_array($resultPayment,MYSQLI_ASSOC);

				if($infoPayment['status']=='completed')
				{
					
					$result = array(
										"result"					=>		$paymentValidation,
										"message"					=>		'Your payment has been confirmed. You do not need to pay again for this payment'
								);

					return $result;
				}
				else if($infoPayment['status']=='completed')
				{
					
					$result = array(
										"result"					=>		$paymentValidation,
										"message"					=>		'Your payment is on hold with bank. We will confirm you in 2 business day.'
								);

					return $result;
				}
				else
				{
					
					$paymentInfo = array(
											"order_id"			=>		$infoPayment['order_id'],
											"payment_id"		=>		$infoPayment['id'],
											"payment_code"		=>		$infoPayment['payment_code']
							);

					$_SESSION['customer_order'] = array();
					$_SESSION['customer_order'] = $paymentInfo;

					

					if($_SESSION['customer_order']['order_id']==$infoPayment['order_id'])
					{
						$paymentValidation = 'success';
						$optionalPGCode = $this->genRandomString(7);

						if($infoPayment['gateway']=='hdfc')
						{
								$result = array(
									"result"		=>		$paymentValidation,
									"message"		=>		'',
									"payment_url"	=>		WEBROOT.'process-hdfc-payment.php?eid='.$optionalPGCode
							);
						}
						else
						{
							$result = array(
											"result"		=>		$paymentValidation,
											"message"		=>		'',
											"payment_url"	=>		WEBROOT.'process-icici-payment.php?eid='.$optionalPGCode
									);
						}

						return $result;
					}
				}
			}
		}

		return $result;

	}


	function sendPaymentInitiateMail($data=array())
	{
		#### SENDING MAIL TO ADMIN
		include_once(BASEPATH."class/mailer-class.php");
		$objMailer = new Mailer();
		$mailerData = array();
		$mailerData['mail_type']='html';
		$mailerData['mail_source']='php';
		$mailerData['to'] = EMAIL_WEBADMIN;
		$mailerData['cc'] = 'kr.rakesh.sinha7@gmail.com';
		$mailerData['subject'] = 'Payment process through ICICI PG of '.$data['name'].' for amount '.$data['currency_code'].$data['amount'];
		$mailerData['from'] = EMAIL_FROM;
		$mailerData['message']= '<html>
									<head>
									  <title>Payment process through ICICI PG</title>
									</head>
									<body>
									  <p>Here are the details of payment going to processed through ICICI PG.</p>
									  <table border="1">
										<tr>
										  <th style="text-align:left;">Customer Name</th>
										  <td style="text-align:left;">'.$data['name'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Customer Email</th>
										  <td style="text-align:left;">'.$data['email'].'</td>
										</tr>
										<tr>
										  <th style="text-align:left;">Amount</th>
										  <th style="text-align:left;">'.$data['currency_code'].$data['amount'].'</th>
										</tr>
										<tr>
										  <th style="text-align:left;">Payment Code</th>
										  <td style="text-align:left;">'.$data['payment_code'].'</td>
										</tr>

									  </table>
									</body>
									</html>';
		$mailResult=$objMailer->sendUserMail($mailerData);

	}


	function sendPrePaymentConfirmationMail($paymentId)
	{
			$paymentDetail = $this->getPaymentDetailById($paymentId);
			
			$enquiryInfo = $this->getEnquiryDetailById($paymentDetail['enquiry_id']);
			
			$transactionId = 'ICICIPRE'.str_pad($paymentDetail['id'], 6, "0", STR_PAD_LEFT);


			$message = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
							<HTML>
							<HEAD>
								<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
								<TITLE>Payment Invoice</TITLE>

								<STYLE TYPE="text/css">
								<!--
									@page { margin: 1in }
									P { margin-bottom: 0.08in; direction: ltr; widows: 2; orphans: 2 }
									A:link { color: #0000ff; so-language: zxx }
								-->
								</STYLE>
							</HEAD>
							<BODY LANG="en-IN" LINK="#0000ff" DIR="LTR">
							<center>

							<TABLE WIDTH=600 CELLPADDING=0 CELLSPACING=0 >
								<COL WIDTH=25>
								<COL WIDTH=575>
								<TR>
									<TD WIDTH=25 STYLE="border: none; padding: 0in">
										<P><BR>
										</P>
									</TD>
									<TD WIDTH=575 VALIGN=TOP STYLE="border: none; padding: 0in">
										<TABLE WIDTH=552 CELLPADDING=0 CELLSPACING=0>
											<COL WIDTH=552>
											<TR>
												<TD WIDTH=552 HEIGHT=15 STYLE="border: none; padding: 0in">
													<P><BR>
													</P>
												</TD>
											</TR>
											<TR>
												<TD WIDTH=552 STYLE="border: none; padding: 0in">
													<P><FONT COLOR="#575757"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>Dear
													'.$enquiryInfo['name'].',</B></FONT></FONT></FONT></P>
												</TD>
											</TR>
											<TR>
												<TD WIDTH=552 HEIGHT=3 STYLE="border: none; padding: 0in">

												</TD>
											</TR>
											<TR>
												<TD WIDTH=552 STYLE="border: none; padding: 0in">
													<P><FONT COLOR="#575757"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt">Thank you for successfully processing your tour payment. <br><br>Please find below receipt of your transaction.</FONT></FONT></FONT></P>
												</TD>
											</TR>
											<TR>
												<TD WIDTH=552 HEIGHT=15 STYLE="border: none; padding: 0in">
													<P>
													</P>
												</TD>
											</TR>
											<TR>
												<TD WIDTH=552 VALIGN=TOP STYLE="border: none; padding: 0in">
													<CENTER>
														<TABLE WIDTH=472 CELLPADDING=3 CELLSPACING=1 BGCOLOR="#afafaf" border="1">
															<COL WIDTH=140>
															<COL WIDTH=151>
															<!-- <COL WIDTH=145> -->
															<TR>
																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-right:0px solid #ffffff;">
																	<P ALIGN=CENTER style="line-height:20px; padding-top:8px;"><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>Payment Date </B></FONT></FONT></FONT><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><BR></FONT></FONT></FONT></P>
																</TD>

																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-left:0px solid #ffffff;">
																	<P ALIGN=CENTER><FONT COLOR="#575757"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>'.date("d-M-Y",time()).'</B></FONT></FONT></FONT></P>
																</TD>

															</TR>

															<TR>
																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-right:0px solid #ffffff;">
																	<P ALIGN=CENTER style="line-height:20px; padding-top:8px;"><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>Transaction Id </B></FONT></FONT></FONT><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><BR></FONT></FONT></FONT></P>
																</TD>

																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-left:0px solid #ffffff;">
																	<P ALIGN=CENTER><FONT COLOR="#575757"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>'.$transactionId.'</B></FONT></FONT></FONT></P>
																</TD>

															</TR>

															<TR>
																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-right:0px solid #ffffff;">
																	<P ALIGN=CENTER style="line-height:20px; padding-top:8px;"><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>Payment Code </B></FONT></FONT></FONT><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><BR></FONT></FONT></FONT></P>
																</TD>

																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-left:0px solid #ffffff;">
																	<P ALIGN=CENTER><FONT COLOR="#575757"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>'.$paymentDetail['payment_code'].'</B></FONT></FONT></FONT></P>
																</TD>

															</TR>
														  <TR>
																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-right:0px solid #ffffff;">
																	<P ALIGN=CENTER style="line-height:20px; padding-top:8px;"><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>Amount Paid </B></FONT></FONT></FONT><FONT COLOR="#0b2775"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><BR></FONT></FONT></FONT></P>
																</TD>

																<TD WIDTH=140 BGCOLOR="#fbfbfb" STYLE="border: none; padding: 0in; border-left:0px solid #ffffff;">
																	<P ALIGN=CENTER><FONT COLOR="#575757"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>'.$paymentDetail['currency_code'].' '.number_format($paymentDetail['total_amount'],2).'</B></FONT></FONT></FONT></P>
																</TD>

															</TR>

														</TABLE>
													</CENTER>

												</TD>
											</TR>
											<TR>
												<TD WIDTH=552 HEIGHT=10 STYLE="border: none; padding: 0in">
													<P STYLE="margin-bottom: 0in; line-height: 100%"><BR>
													</P>
												</TD>
											</TR>


											<TR>
												<TD WIDTH=552 VALIGN=TOP STYLE="border: none; padding: 0in">
													<P STYLE="margin-bottom: 0in; line-height: 140%"><BR>
													</P>

													<TABLE WIDTH=552 CELLPADDING=0 CELLSPACING=0>
														<COL WIDTH=552>


														<TR>
															<TD WIDTH=552 VALIGN=TOP STYLE="border: none; padding: 0in">
																<TABLE WIDTH=528 CELLPADDING=0 CELLSPACING=0>
																	<COL WIDTH=308>
							<!-- 										<COL WIDTH=220> -->

																	<TR>
															<TD WIDTH=552 STYLE="border: none; padding: 0in">
																<P><FONT SIZE=1 STYLE="font-size: 9pt; font-weight:bold;">Thanks and regards,</FONT><br />


																	</P>
															</TD>
														</TR>


																	<TR>
																		<TD WIDTH=308 STYLE="border: none; padding: 0in">
																			<P><A NAME="_GoBack"></A><FONT><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>
							<font color="#575757" >												<span style="color:#0b2775;">ELEGANT JOURNEYS</span></B><br />
							Email: sales@elegantjourneys.co <br />
							Web: www.elegantjourneys.com <br />
							</font>
							</FONT></FONT></FONT><FONT COLOR="#575757"><FONT FACE="Arial, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B><BR></B></FONT></FONT></FONT><BR>
																			</P>
																		</TD>
																	</TR>
																</TABLE>
																<P STYLE="margin-bottom: 0in; line-height: 100%"><BR>
																</P>
															</TD>
														</TR>
														<TR>
															<TD WIDTH=552 HEIGHT=15 STYLE="border: none; padding: 0in">
																<P STYLE="margin-bottom: 0in; line-height: 100%"><BR>
																</P>
															</TD>
														</TR>
													</TABLE>
													<P STYLE="margin-bottom: 0in; line-height: 100%"><BR>
													</P>
												</TD>
											</TR>
										</TABLE>
										<P STYLE="margin-bottom: 0in; line-height: 100%"><BR>
										</P>
									</TD>
								</TR>
							</TABLE>
							</center>

							</BODY>
							</HTML>';

							include_once(BASEPATH."class/mailer-class.php");
							$objMailer = new Mailer();
							$mailerData = array();
							$mailerData['mail_type']='html';
							$mailerData['mail_source']='php';
							$mailerData['to'] = $customerInfo['email'];
							$mailerData['subject'] = 'Payment confirmation';
							$mailerData['from'] = EMAIL_SALES;
							$mailerData['cc'] = EMAIL_WEBADMIN;
							$mailerData['bcc'] = EMAIL_BCC;
							$mailerData['message']= $message;
							$mailResult=$objMailer->sendUserMail($mailerData);


							
	}

	function getEnquiryDetailById($enquiryId)
	{
		
		$objMysqli = $this->setDatabaseConnection();
		

		$strsqlEnquiry = "select * from  tbls_enquiry  where id=".$enquiryId;
		$resultEnquiry = mysqli_query($objMysqli,$strsqlEnquiry);
		$infoEnquiry = mysqli_fetch_array($resultEnquiry,MYSQLI_ASSOC);
		$this->closeDBConnection($objMysqli);
		return $infoEnquiry;
	}


	function getHdfcPaymentConfirmation($data=array())
	{
		include_once(BASEPATH_CLASS."customer-order-class.php");
		include_once(BASEPATH_CLASS."customer-class.php");
		include_once(BASEPATH_CLASS."enquiry-class.php");

		$objCustomerOrder = new CustomerOrder();
		$objCustomer = new Customer();
		$objEnquiry = new Enquiry();

		/*$this->setDatabaseConnection();
		$paymentId = $this->filterReceivedData($data['payment_id']);
		$paymentCode = $this->filterReceivedData($data['payment_code']);
		$this->closeDBConnection();

		$paymentValidation = true;

		if($paymentId==""||$paymentCode=="")
		{
			$paymentValidation = false;
		}
		else
		{
			$paymentData = array(
									"payment_id"	=>	$paymentId,
									"payment_code"	=>	$paymentCode
							);
			$paymentDetail = $this->getPaymentInformationByCodeAndId($paymentData);
			$orderDetail = $objCustomerOrder-> getOrderById($paymentDetail['order_id']);

			#### GETTING CUSTOMER INFORMATION
			if($orderDetail['customer_id']=='0'||$orderDetail['customer_id']=='')
			{
				$enquiryId = $orderDetail['enquiry_id'];

				$enquiryData = array(
										"enquiry_id"		=>		$enquiryId
								);

				$enquiryInfo = $objEnquiry->getEnquiryInformation($enquiryData);

				if($enquiryInfo['first_name']!=""&&$enquiryInfo['last_name']!="")
				{
					$customerName = $enquiryInfo['first_name'].' '.$enquiryInfo['last_name'];
				}
				else
				{
					$customerName = $enquiryInfo['name'];
				}

				$customerDetail = array(
											"name"		=>		$customerName,
											"email"		=>		$enquiryInfo['email'],
											"phone"		=>		$enquiryInfo['phone']
								);

			}
			else
			{
				$customerId = $orderDetail['customer_id'];
				$customerInfo = $objCustomer->getCustomerById($customerId);

				if($customerInfo['first_name']!=""&&$customerInfo['last_name']!="")
				{
					$customerName = $customerInfo['first_name'].' '.$customerInfo['last_name'];
				}
				else
				{
					$customerName = $customerInfo['name'];
				}

				$customerDetail = array(
											"name"		=>		$customerName,
											"email"		=>		$customerInfo['email'],
											"phone"		=>		$customerInfo['phone']
								);
			}*/

			#### GETTING CUSTOMER INFORMATION ENDS HERE

			switch($paymentDetail['status'])
			{
				case 'completed':
						$description ='<div style="text-align:left">Dear '.$customerDetail['name'].'<br /><br />Thank you for the payment of '.$paymentDetail['currency_code']." ".$paymentDetail['total_amount'].'. Your payment has been received to us. We will update you shortly.<br /><br /><strong>Elegant Journeys Team</strong></div>';
						$title='Your payment has been confirmed';
					break;
				case 'pending':
						$description ='<div style="text-align:left">Dear '.$customerDetail['name'].'<br /><br />We have not received your payment confirmation. If your payment has been deducted from bank, please let us know, so that  we can check with our bank.<br /><br /><strong>Elegant Journeys Team</strong></div>';
						$title='Your payment confirmation is pending';
					break;
				case 'fail':
						$description ='<div style="text-align:left">Dear '.$customerDetail['name'].'<br /><br />Your payment was not confirmed. Please try again. If your payment has been deducted from bank, please let us know, so that  we can check with our bank. <br /><strong>Elegant Journeys Team</strong></div>';
						$title='Your payment was not confirmed.';
					break;
				default:
						//$description ='<div style="text-align:left">Dear '.$customerDetail['name'].'<br /><br />Your payment was not confirmed. Please try again. If your payment has been deducted from bank, please let us know, so that  we can check with our bank. <br /><strong>Elegant Journeys Team</strong></div>';
						//$title='Your payment was not confirmed.';
						
						$description ='<div style="text-align:left">Dear Customer<br /><br />Thank you for the payment of <B>'.$_SESSION['hdfc_geteway']['currency'].' '.$_SESSION['hdfc_geteway']['amount'].'</B>. Your payment has been received to us. Your transaction id is <b>'.$_SESSION['hdfc_geteway']['order_id'].'</b> .We will update you shortly.<br /><br /><strong>Elegant Journeys Team</strong></div>';
						$title='Your payment has been confirmed';
					break;
			}

			$this->unsetConfirmationParameter();
			$messageData = array(
										"title"			=>		$title,
										"description"		=>		$description
						);
			$this->setConfirmationParameters($messageData);

		}
	


}
?>
