<?php
	include_once("includes/config.php");
	include_once(BASEPATH_CLASS."first-class.php");
	$objFirstClass = new FirstClass();

	if((isset($_REQUEST['eid']))&&($_REQUEST['eid']!=""))
	{
		$post = $objFirstClass->decodeWebUrl($_REQUEST);

		if((isset($post['process']))&&($post['process']!=''))
		{
			
			switch($post['process'])
			{
				case 'paypalPayment':
						include_once(BASEPATH_CLASS."customer-payment-class.php");
						$objCustomerPayment = new CustomerPayment();
						$paymentData=array(
												"payment_id"		=>		$post['payment_id'],
												"payment_code"		=>		$post['token']
									);

						$objCustomerPayment->getPaymentConfirmation($paymentData);
					break;
				case 'hdfc':
						
						include_once(BASEPATH_CLASS."customer-payment-class.php");
						$objCustomerPayment = new CustomerPayment();
						$paymentData=array(
												"payment_id"		=>		$post['payment_id'],
												"payment_code"		=>		$post['token']
									);

						echo "------------------------------------------------b";
						$objCustomerPayment->getHdfcPaymentConfirmation($paymentData);
						echo "-------------------------------------------------a";
					break;
			

			}
		}
	}
	$messageInfo = $objFirstClass->getConfirmationMessage();
	include_once("includes/head-section1.php");

?>
<?php
	/**********MARKETING TAGS *****/
?>
<!-- Event snippet for Elegant Journeys.com Conversion Code conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-984632813/dMUNCJ7CtqYBEO2bwdUD'});
</script>
<?php
	/**********MARKETING TAGS END HERE *****/
?>
</head>
<body>
	 
	<!-- main wrapper -->
	<div id="wrapper">
		<div class="page-wrapper">
			<!-- main header -->
			       			<?php include_once("includes/header.php"); ?>

			<!-- main banner -->
			<section class="banner banner-inner parallax" data-stellar-background-ratio="0.5" id="banner-contact">
				<div class="banner-text">
					<div class="center-text">
						<div class="container">
							<h1>High quality services with first-hand knowledge</h1>
							<strong class="subtitle">We offer an array of high quality services with first-hand knowledge on India tours</strong>
							<!-- breadcrumb -->
							<nav class="breadcrumbs">
								<ul>
									<li><a href="<?=WEBROOT?>">HOME</a></li>
									<li><span>CONFIRMATION</span></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</section>
			<!-- main container -->
			<main>
				<div class="inner-main common-spacing" style="padding-top:20px;">
					<div class="container">
						
						<div class="col-sm-6 demo-wrapper" style="width:90%; margin-right:5%;">
							<header class="content-heading" style="margin-bottom:40px;">
							<h2 class="main-heading">Confirmation</h2>
							<strong class="main-subtitle" style="font-size:20px;"><?=$messageInfo['title']?></strong>
							<br /><br />
							<p>	<?=$messageInfo['description']?> </div>';
							</p>
						</header>
						
							
						</div>
					</div>
				</div>
			</main>
		</div>
		<!-- main footer -->
		<?php include_once("includes/footer.php"); ?>
	</div>
	<!-- scroll to top -->
	<div class="scroll-holder text-center">
		<a href="javascript:" id="scroll-to-top"><i class="icon-arrow-down"></i></a>
	</div>
	<!-- jquery library -->
	<?php include_once("includes/footer-script.php"); ?>
	<script src="js/contact-form.js"></script>
	<!-- custom script -->
	
	
	
</body>
</html>