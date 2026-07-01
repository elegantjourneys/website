<?php

	include_once("includes/config.php");

	include_once(BASEPATH_CLASS."tour-class.php");

	include_once(BASEPATH_CLASS."enquiry-class.php");

	$objTour = new Tour();

	

	$processEnquiry = false;

	if((isset($_POST['process']))&&($_POST['process']=='processQuickEnquiry'))

	{

		$objEnquiry = new Enquiry();

		$processEnquiry = $objEnquiry->getShortTourEnquiry($_POST);

		if($processEnquiry)

		{



		}

		

	}

	$post = $objTour->decodeWebUrl($_REQUEST);

	$tourInformation = $objTour->getTourByTourId($post['tourId']);

	

	include_once(BASEPATH."includes/head-section-lightbox-form.php");



?>
<link rel="stylesheet" type="text/css"  href="<?=WEBROOT?>css/custom-sgr.css" />
</head>

<body>





	

	<!-- *************************** -->

	<!-- START COPYING FROM HERE     -->

	<!-- *************************** -->



	<section id="slick">

		

		<!-- Contact form -->

		<div >

			<!-- Title -->
			

			<h3 class="title center">
			<img class="plan-my-trip-icon hidden-xs" <?php if ($mobileview) {?> style="display:none" <?php }?> src="sgr-img/trip-plan2.png"> Plan My Trip</h3> <br>
			<!-- Intro text -->

			<!-- <p class="intro center" style="font-weight:bold;">Tour Name : <b> <?=$tourInformation['tour_name']?></b></p> -->
			<h3 class="center"><br><br><?=$tourInformation['tour_name']?></h3>
			<br>
			<!-- Form -->	

			<div class="w-100">

				

				<!-- Form fields -->

				<form action="" name="contact" id="contact" method="post">

				<input type="hidden" value="processQuickEnquiry" name="process">

				<input type="hidden" value="<?=$tourInformation['id']?>" name="tourId">

				<input type="hidden" value="<?=$tourInformation['tour_name']?>" name="tourName">

					<!-- Name input -->

					<div class="field">

						<input name="tour_enquiry_name" placeholder="Your Full Name" type="text" id="name" required />

						<!-- <span class="entypo-user icon"></span> -->

						<span class="slick-tip left">Enter your name</span>

					</div>

					<!-- Email input -->

					<div class="field">

						<input name="tour_enquiry_email" placeholder="Enter Email: your@domain.com" type="email" id="email" required />

						<!-- <span class="entypo-mail icon"></span> -->

						<span class="slick-tip left">Enter valid email</span>

					</div>

					<!-- Phone input -->

					<div class="field">

						<input name="tour_enquiry_phone" placeholder="Enter Phone No: +44 00 123" type="tel" id="phone" />

						<!-- <span class="entypo-mobile icon"></span> -->

						<span class="slick-tip left">Contact phone</span>

					</div>

					

					<!-- Message input -->

					<div class="field">

						<textarea name="tour_enquiry_message" placeholder="Please share any other info that will help us tailor your trip. e.g. your interests, other places to visit, duration, etc." id="message" class="message" required></textarea>

						<!-- <span class="entypo-comment icon"></span> -->

						<span class="slick-tip left">Your Message</span>

					</div>

					<!-- Message copy button -->

					<div class="w-47 mr-5">

						

						

					</div>

					<!-- Send button -->

					<input type="submit" value="Send" class="send btn btn-warning" form="contact" name="send" />

				</form>

				<!-- / Form fields -->

			</div>

		</div>

		<!-- / Contact form -->            

	</section>



	<!-- *************************** -->

	<!-- END COPYING HERE            -->

	<!-- *************************** -->





</body>

</html>