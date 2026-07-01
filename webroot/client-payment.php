 <?php
	include_once("includes/config.php");

	include_once(BASEPATH."includes/head-section1.php");

?>
<style>
	body{
	font-family: 'Work Sans', sans-serif;
	}
		main#main {
    padding: 84px 0;
}
	#footer > .container
	{
		padding-top: 20px !important;
	}
	<?php
		if($categoryInfo['image']!="")
		{
	?>
	#list-view-normal {
		background-image: url("<?=WEBROOT_IMAGE_REPOSITERY?>category/<?=$categoryInfo['image']?>");
	}
	<?php
		}
	?>
	.tour-offer-label::after {
		content: "";
		width: 14px;
		height: 13px;
		left: -6px;
		border-bottom: 8px solid #f98764;
		border-left: 8px solid #f98764;
		position: absolute;
		transform: rotate(45deg);
		top: 4px;
	}
	.tour-offer-label {
			font-weight: 400;
			font-size: 12px;
			position: relative;
			top: -4px;
			margin-left: 22px;
			background: #f98764;
		}

		.article h3 a {
			color: #5c5e62 !important;
			font-weight: 600;
			font-size: 17px !important;
			text-transform: capitalize;
			padding: 0px;
		}


@media only screen and (max-width: 568px){
.fancybox-slide--iframe .fancybox-content{
	   max-height: 470px!important;
}
#slick .field textarea.message {
    height: 105px!important;

}
}
@media only screen and (max-width: 414px){
.places_new{
	font-size:13px!important;
}
}
@media only screen and (max-width: 375px){
.places_new{
	font-size:10px!important;
}
}
	.fancybox-slide--iframe .fancybox-content {
	width  : 500px!important;
	height : 650px!important;
	max-width  : 90%!important;
	margin: 0!important;
		}
.filter-option{
	box-shadow: 0px 0px 6px rgba(0,0,0,0.18) !important;
    padding: 10px;
    background: #fff;
    display: block;
}
.inquire_fixed-plan-button {
    position: fixed;
    z-index: 99;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #f2f2f1;
    padding: 12px;
    text-align: center;
}
.inquire_fixed-plan-button .btn {
    display: inline-block;
    width: 280px;
    max-width: 100%;
}
.btn.primary {

    font-size: 17px;
    color: #fff;
    background-color: #f29821;
    -ms-filter: "alpha(opacity=85)";
    opacity: .85;
    -webkit-transition: opacity .15s ease-in;
    -moz-transition: opacity .15s ease-in;
    -o-transition: opacity .15s ease-in;
    transition: opacity .15s ease-in;
    text-align: center;
    padding: 14px 12px;
    padding-bottom: 13px;
    font-weight: 600;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    line-height: 1;

}
@media screen and (min-width: 1000px){
.inquire_fixed-plan-button {
    display: none !important;
}
}
@media screen and (max-width: 480px){
.btn.primary{padding: 12px 12px;}
.inquire_fixed-plan-button .btn {width: 255px;}
#scroll-to-top {z-index: 0;}
}

.error{
			color:red;
			text-align:center;
}
.pa-click-box{margin-left: 150px; display: inline-block;}
@media screen and (max-width: 600px){.pa-click-box{margin-left: 0px;}}

div.scroll {
		margin:1%;
		padding:4px;

		height: 180px;
		overflow-x: hidden;
		overflow-x: auto;
		border:1px solid #ccc;
		border-top:3px solid #ccc;
		border-left:2px solid #ccc;

}

</style>
<link rel="stylesheet" type="text/css" href="<?=WEBROOT?>js-php/fancybox/jquery.fancybox.min.css">
<link rel="stylesheet" type="text/css"  href="<?=WEBROOT?>css-php/custom-sgr.css" />
</head>

<body>



	<div id="wrapper">

		<div class="page-wrapper">

			<!-- main header -->

			<?php include_once(BASEPATH."includes/header.php"); ?>

			<!-- main banner -->



			<!-- main container -->


			<!-- Inquire Now -->
			<div class="inquire_fixed-plan-button">

				<a data-fancybox data-type="iframe" data-src="../inquire.php?eid=<?=$cryptBoxUrl?>"  href="javascript:;" class="btn primary"> Inquire Now</a>
			</div>
			<!-- Inquire Now -->


			<main id="main" style="background-color:#FAFAFA;">

				 <div class="content-block content-sub topPadding30 bottomPadding0">
					<div class="container">
						<div class="filter-option">
							<strong class="result-info">Client Payment Area</strong>

						</div>
						<!-- list view -->
						<div class="content-holder list-view topMargin30 ">





						<div class="col-md-12">
							<div class="col-md-1"></div>






						<div class="col-md-10">


                               <form class="booking-form con-form" action="" onsubmit="return processClientPayment();" method="post" style="border:none;">
							   <input type="hidden" name="process" value="submitContactUs">


								<div class="form-holder col-md-12" >
									<h2 class="small-size">Please Enter Your Payment Information</h2>
									<div class="error" id="paymentErrorArea"> </div>
									<div class="wrap">
										<div class="row">
											<div class="col-md-2"></div>
											<div class="col-md-8">
												<div class="hold">
													<label for="name">Your Email</label>
													<input type="email" class="form-control" placeholder="Your Email" id="payment_email" name="payment_email" required >
												</div>
											</div>
											<div class="col-md-2"></div>

										</div>

                                        <div class="row">
											<div class="col-md-2"></div>
											<div class="col-md-8">
												<div class="hold">
													<label for="em">One Time Password (OTP)</label>
													<input type="text" class="form-control" placeholder="One Time Password" id="payment_otp" name="payment_otp" required>
												</div>
											</div>
											<div class="col-md-2"></div>

										</div>





										 <div class="row">
											<div class="col-md-2"></div>
											<div class="col-md-8">
												<div class="hold pa-click-box">

													<input type="checkbox" id="paymentTermsCondition" name="payment_terms_condition" required oninvalid="setCustomValidity('Click to accept.')"
    onchange="try{setCustomValidity('')}catch(e){}" >

												</div>
												<span style="padding: 0px 10px;display: inline-block;text-align: center;"><strong>I accept <a style="color:#4587d9; text-decoration:underline;" href="#" onclick="displayTermsAndConditions(); return false; ">standard terms & conditions</a></strong></span>
											</div>
											<div class="col-md-2"></div>
										</div>











										 <div class="row" id="termsAndConditionSection" style="display:none;">
											<div class="col-md-12">
												<div class="hold">
													<label for="em">STANDARD TERMS & CONDITIONS:</label>
													<div  class=" scroll">
						<p>Elegant Journeys is incorporated under the laws of India, with its office located at New Delhi, India. Our business and the services we offer are governed by the applicable laws of India. No representations and/or warranties of any kind, express or implied, are given as to the compliance of the information shown on this Site, the services offered by or on behalf of us, any information relating to such services and our business in any respect with any laws of any other country which do not, in any event, affect or apply to the same.</p><br>

						<h3>Privacy Policy:</h3>

						<p>Elegant Journeys respects your privacy and recognizes the need to protect the personally identifiable information (any information by which you can be identified, such as name, address, and telephone number) you share with us. We would like to assure you that we follow appropriate standards when it comes to protecting your privacy on our web sites.
						<br><br>
						In general, you can visit Elegant Journeys website without telling us who you are or revealing any personal information about yourself. We track the Internet address of the domains from which people visit us and analyze this data for trends and statistics, but the individual user remains anonymous.
						<br><br>
						Some of our web pages use "cookies" so that we can better serve you with customized information when you return to our site. Cookies are identifiers which a web site can send to your browser to keep on your computer to facilitate your next visit to our site. You can set your browser to notify you when you are sent a cookie, giving you the option to decide whether or not to accept it. The information we collect and analyze is used to improve our service to you.
						<br><br>
						There are times when we may collect personal information from you such as name, physical address or telephone number. It is our intent to inform you before we do that and to tell you what we intend to do with the information.
						<br><br>
						Elegant Journeys is not going to share your personal information with any outside agency/person or sell, trade or disclose to third parties any information derived from the registration for, or use of, any online service (including names and addresses) without the consent of the user or customer, except for the below purposes: </p>

						<ul class="content-list tick-list">
							<li>For making various reservations for your Trip</li>
							<li>For your payments through the Banks/Financial institutions/Credit Card Processors that we deal with.</li>
							<li>For providing information to Indian Government or other Statutory Authorities.</li>
						</ul>
						<p>If our privacy policy changes in the future, it will be posted here. You should access our privacy policy regularly to ensure you understand our current policies.</p><br>

						<h3>Prices:</h3>
						<p>All rates quoted on the website are per person, based on double occupancy. If not listed, single supplements are available upon request in the 'Comments" section in each 'Enquiry Form'. All prices are subject to change at any time at the sole discretion of Elegant Journeys, except for when a deposit payment for your tour has been accepted by Elegant Journeys.</p><p><br>

						</p><h3>Booking:</h3>
						<p>The agreement exists between you as as Traveler/Customer and Elegant Journeys once we have confirmed you on the tour of your choice, received payment after reviewing terms &amp; conditions.</p><p><br>

						</p><h3>Payment:</h3>
						<p>All the payments to be made to Elegant Journeys in advance by electronic bank wire transfer or Credit credit to our bank account in India.
							<br><br>
							It is your obligation to make timely payments as per the payment schedule sent at time of booking. Failure to make the payment within the specified period will result in the cancellation of the booking.
							<br><br>
							We as a merchant shall be under no liability whatsoever in respect of any loss or damage arising directly or indirectly out of the decline of authorization for any Transaction, on Account of the Cardholder having exceeded the preset limit mutually agreed by us with our acquiring bank from time to time.
						</p><p>

						</p><h3>If you cancel your Trip:</h3>
						<p>If you or any member of your party wishes to cancel the Tour, the cancellation request must be submitted through your registered correspondence email address only (Phone request will not be taken).<br><br>
						On receiving your request for cancellation, Elegant Journeys will send you details of the final amount refundable to you. Once we receive your acceptance on refund amount, if any; Elegant Journeys will process your refund immediately as mentioned in the refund section below.
						<br><br>As cancellation of Trip incurs administrative cost and retention charges by hotel, the cancellation charges will apply on the following scale:<br><br>
						<strong>Number of days prior to arrival / Cancellation charges on Land Cost (Per Person in US Dollars)</strong>
						<br><br>
						<strong>More then 96 Days prior</strong> / $150 or 25% of total Tour cost, whichever is higher
						<br><br>
						<strong>95-66 Days</strong> / $250 or 50% of the total Tour Cost, whichever is higher. Note- 75% of your Total tour cost is charged upon cancellation of hotel stay during 15 October to 30 November and 20 December to 10 January.
						<br><br>
						<strong>65-46 Days</strong> / $500 or 75% of the total Tour Cost, whichever is higher. Note- 90% of your Total tour cost is charged upon cancellation of hotel stay during 15 October to 30 November and 20 December to 10 January.<br><br>
						<strong>45- 16 Days</strong> / $1000 or 90% of the total Tour Cost, whichever is higher. Note- 100% of your Total tour cost is charged upon cancellation of hotel stay during 15 October to 30 November and 20 December to 10 January.<br><br>
						<strong>15 Days or less</strong>	/ Cancellation is considered as no show, hence does not qualify for any refunds, for any part of the tour except at the sole discretion of Elegant Journeys.<br><br>

						In addition, any cancellation charges levied by the Airlines or Hotels will be additional.<br><br>


The Airline tickets purchased by Elegant Journeys for travel if cancelled will incur charges levied by Airlines ($50 per person/per sector).

						</p>

						<p><strong>If you change your booking:</strong><br>
Changes in your Tour package can be done at a sole discretion of Elegant Journeys, once acceptance/payment is received for the tour package. You can request for a change by email (No such request is taken on phone).<br><br>

We may make small changes to your travel arrangements at any time (we reserve a right to do so) and shall advice you on same at the earliest possible date. These changes may be result of Force Majeure or similar reasons beyond our control, such as riots or strikes, closure or overbooking of a hotel, weather conditions, delay in departures, decision taken by State Government or Tourist Organizations etc. It may result in a change in itinerary, exclusion of a destination or change in timings at a particular destination. If possible we will make alternate arrangements, but if not, give you a refund as per our policies defined in our refund section. </p>

					<p><strong>Refund:</strong>
<br>In accordance with the agreed-to terms and conditions, all payments and transportation, or travel service, unutilized shall be swiftly refunded, unless the passenger otherwise instruct the Elegant Journeys in writing.<br><br>

If you do not make payments as per the schedule agreed upon, or cancel you tour, Elegant Journeys shall process the refund after deducting the cancellation cost; in less than 30 days from the earliest of the mentioned below: </p>
						<ul class="content-list tick-list">
							<li>Scheduled date of Departure.</li>
							<li> Request received by the guest for refund.</li>
							<li>Day of cancellation by Elegant Journeys.</li>
						</ul>

					<p>In the event of cancellation due to any unforeseeable situations, beyond the control of Elegant Journeys (such as natural calamity), Elegant Journeys will process a full refund after deducting any Non Refundable Charges incurred, within 30 days of cancellation, after adjusting for any unrecoverable payments already tendered to our suppliers.<br><br>

					<strong>No Show's, as defined above, do not qualify for any refunds, for any part of their tour, except at the sole discretion of Elegant Journeys.</strong></p>

					<p><strong>Liability:</strong><br>
Besides looking after your comfort and enjoyment, we do our best to ensure that you travel, explore, and reside in a safe and risk free environment. However, Elegant Journeys is not responsible, in any sense of the term, for the safety, health, and/or condition, of any guest's person, their wards, or their property. Your acceptance of our standard terms &amp; conditions is also your legal, binding, &amp; unconditional acceptance of the preceding statement.<br><br>

You, and each person traveling in your tour expressly acknowledge that you are cognizant of all risks of travel and arrangements for trips of this nature and fully disclaim, waive and discharge Elegant Journeys (including it's shareholders, management, directors, and employees) from any and all liability, claims. damages, loss, or responsibilities (including damage to or loss of your property, or your injury or death) with regard to the proposed tour and/or visit, and arrangements made with respect thereto, even if caused by the negligence of any airlines, transportation companies, hotels, restaurants, or any other party providing services or accommodations included in the tour/visit.<br><br>

Elegant Journeys will similarly not be liable for any claims, losses, damages for delayed or lost baggage or other property, or any loss of intangibles such as pleasure, or feelings of disappointment, distress, or frustration, whether mental or physical, which may have resulted from any act or omission of any other party providing services to you during your tour/visit. </p>

					<p> <strong>Financial Liability:</strong><br>
Elegant Journeys liability in any and all cases will be limited to a refund of the payments made directly by you to us, subject to our cancellation and refund policies. Your acceptance of our standard terms &amp; condition is also your legal, binding, and unconditional acceptance of the preceding statement. </p>

					<p><strong>Passports &amp; Visas:</strong><br>
There is a visa required to enter India. A foreign citizen needs a passport that is valid for at least six months beyond the completion of the tour and a current visa to enter India. Passport must also contain two blank visa pages. 'Visa on Arrival' in India facility is available for few courtries - please consult Indian Embassy/Consulate in your Country. It is of utmost importance that you thoroughly check your visa requirements and validity before your intended date of travel.
<br><br>
Additionally if your trip includes a visit to Nepal or Bhutan and requires you to return to India to take your international flight home, you would have to apply for a double/multiple entry Indian visa. Please be aware that is the traveler's responsibility to obtain all correct documentation prior to arrival in India.</p>

<p><strong>Site Content:</strong><br>
The descriptions and views expressed on this web site are based on the knowledge and opinions of the principals of Elegant Journeys. There is no guarantee of accuracy, implied or otherwise, in these descriptions and views.<br><br>

Elegant Journeys website resides on a secure server that encrypts personal information. Elegant Journeys uses all reasonable endeavors to protect personal information from loss, misuse and alteration. Only authorized Elegant Journeys employees or agents, who are under appropriate confidentiality obligations, will have access to personal information. Customers should take due care to protect them. Elegant Journeys is not responsible for any errors, omissions or representations on the website. </p>
<p><strong>All matters of dispute would be subject to the legal jurisdiction of Delhi only. </strong></p>
													</div>
												</div>
											</div>

										</div>














										 <br>
										 <button type="submit" class="btn btn-default" style="margin-left:0px;">Submit</button>
									</div>
								</div>

					</form>




							</div>

					</div>

					<br><br><br><br><br><br>

















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



	<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>

	<script>
		function processClientPayment()
		{
			var paymentEmail = $('#payment_email').val();
			var paymentOTP = $('#payment_otp').val();

			if(paymentEmail=="")
			{
				alert('Please enter your email.');
				$('#payment_email').focus();
				return false;
			}

			if(paymentOTP=="")
			{
				alert('Please enter your OTP.');
				$('#payment_email').focus();
				return false;
			}

			if (!document.getElementById('paymentTermsCondition').checked)
			{
				alert('Please accept terms and conditions.');
				return false;
			}


			$.ajax({
				url: '<?=WEBROOT?>ajax/jquery-booking.php',
				type: 'post',
				data: {token:'<?php echo session_id();?>', method:'createPaymentEnvironment', email:paymentEmail, payment_otp:paymentOTP },
				dataType: 'json',
				success: function(json)
				{
					if(json.result=='success')
					{
						window.location=json.payment_url;
					}
					else
					{
						$('#paymentErrorArea').html(json.message);
					}
				}

			});
			return false;

		}

		function displayTermsAndConditions()
		{
			if($('#termsAndConditionSection').css("display")=='block')
			{
				$('#termsAndConditionSection').css("display","none");
			}
			else
			{
				$('#termsAndConditionSection').css("display","block");
			}
		}
	</script>

</body>

</html>
