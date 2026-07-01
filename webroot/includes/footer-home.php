<?php
	include_once(BASEPATH_CLASS."website-section-class.php");
	$objWebsiteSection = new WebsiteSection();

?>
<style>
.set-img{
	display: flex;
	justify-content: space-between;
	align-items: center;
}
.effect{
	filter: drop-shadow(-1px 0px 24px #5a5a5a);
	/*box-shadow: 0px 9px 6px #00000029;*/
}
@media (min-width: 320px) and (max-width: 480px) {
	.set-img{
		display: block;		
	}
	.set-img img{ 
		margin-bottom: 21px;
		height: auto !important;
	}
}
</style>


<footer id="footer">




<div class="container" style="padding-bottom: 5px;">
				
<div class="row footer-holder" style="text-align:center !important;">
					<? //echo $objWebsiteSection->getWebsiteSectionByCode('footer_link'); ?>


<nav class="col-sm-4 col-lg-3 footer-nav active">
<h3>Most Popular Tours</h3>
<ul class="slide">
<li><a href="https://www.elegantjourneys.com/holidays-india-luxury-travel-special-offers/3-day-golden-triangle-tour-with-delhi-agra-and-jaipur-322">3 Day Golden Triangle Tour</a></li>
<li><a href="https://www.elegantjourneys.com/holidays-india-luxury-travel-special-offers/4-day-golden-triangle-tour-with-delhi-agra-and-jaipur-323">4 Day Golden Triangle Tour</a></li>
<li><a href="https://www.elegantjourneys.com/holidays-india-luxury-travel-special-offers/5-day-golden-triangle-tour-with-delhi-agra-and-jaipur-189">5 Day Golden Triangle Tour</a></li>
<li><a href="https://www.elegantjourneys.com/holidays-india-luxury-travel-special-offers/6-day-golden-triangle-tour-with-delhi-agra-and-jaipur-190">6 Day Golden Triangle Tour</a></li>
<li><a href="https://www.elegantjourneys.com/holidays-india-luxury-travel-special-offers/7-day-golden-triangle-tour-with-delhi-agra-and-jaipur-193">7 Day Golden Triangle Tour</a></li>
<li><a href="https://www.elegantjourneys.com/holidays-india-luxury-travel-special-offers/8-day-golden-triangle-with-delhi-agra-jaipur-and-udaipur-195">8 Day Golden Triangle Udaipur </a></li>
<li><a href="https://www.elegantjourneys.com/holidays-india-luxury-travel-special-offers/8-day-golden-triangle-with-delhi-agra-ranthambore-wildlife-and-jaipur-194">8 Day Golden Triangle Ranthambore</a></li>
<li><a href="https://www.elegantjourneys.com/holidays-india-luxury-travel-special-offers/9-day-golden-triangle-with-delhi-varanasi-agra-and-jaipur-264">9 Day Golden Triangle with Varanasi</a></li>
</ul>
</nav>
<nav class="col-sm-4 col-lg-3 footer-nav">
<h3>Luxury Offers</h3>
<ul class="slide">
<li><a href="https://www.elegantjourneys.com/holidays-india-luxury-travel-special-offers/10-day-golden-triangle-with-delhi-agra-jaipur-jodhpur-udaipur-jodhpur-and-udaipur-269">10 Day Golden Triangle with Jodhpur</a></li>
<li><a href="https://www.elegantjourneys.com/holidays-india-luxury-travel-special-offers/10-days-golden-triangle-with-delhi-agra-ranthambore-wildlife-jaipur-and-udaipur-204">10 Day Golden Triangle Rajasthan</a></li>
<li><a href="https://www.elegantjourneys.com/holidays-india-luxury-travel-special-offers/11-day-golden-triangle-with-delhi-varanasi-agra-ranthambore-and-jaipur-266">11 Day Golden Triangle With Varanasi</a></li>
<li><a href="https://www.elegantjourneys.com/holidays-india-luxury-travel-special-offers/11-day-golden-triangle-with-delhi-varanasi-agra-jaipur-and-udaipur-265">11 Day Golden Triangle With Varanasi</a></li>
<li><a href="https://www.elegantjourneys.com/holidays-india-luxury-travel-special-offers/12-day-rajasthan-tour-with-delhi-agra-ranthambore-wildlife-jaipur-jodhpur-and-udaipur-270">12 Day Rajasthan Tour </a></li>
<li><a href="https://www.elegantjourneys.com/holidays-india-luxury-travel-special-offers/13-day-rajasthan-tour-with-delhi-varanasi-agra-jaipur-jodhpur-and-udaipur-272">13 Day Rajasthan Tour with Varanasi</a></li>
<li><a href="https://www.elegantjourneys.com/holidays-india-luxury-travel-special-offers/13-day-golden-triangle-tour-with-delhi-varanasi-agra-ranthambore-jaipur-and-udaipur-267">13 Day Golden Triangle With Varanasi</a></li>
<li><a href="https://www.elegantjourneys.com/holidays-india-luxury-travel-special-offers/15-day-golden-triangle-tour-with-delhi-varanasi-agra-ranthambore-jaipur-and-udaipur-273">15 Day Rajasthan Tour with Varanasi</a></li>
</ul>
</nav>
<nav class="col-sm-4 col-lg-3 footer-nav">
<h3>Information</h3>
<ul class="slide">
<li><a href="https://www.elegantjourneys.com/about-us.php">About Us</a></li>
<li><a href="https://www.elegantjourneys.com/tripadvisor-review.php">Trip Advisor Reviews</a></li>
<li><a href="https://www.elegantjourneys.com/review.php">Guest Email Testimonial</a></li>
<li><a href="https://www.elegantjourneys.com/travel-guide.php">Travel Guide</a></li>
<li><a href="https://www.elegantjourneys.com/faq.php">General FAQ's</a></li>
<li><a href="https://www.elegantjourneys.com/terms-privacy.php">Terms &amp; Condition</a></li>
<li><a href="https://www.elegantjourneys.com/terms-privacy.php#cancellation">Refund &amp; Cancellation</a></li>
<li><a href="https://www.elegantjourneys.com/terms-privacy.php#privacy">Privacy Policy</a></li>
<li><a href="https://www.elegantjourneys.com/client-payment.php">Client Payment</a></li>
</ul>
</nav>
<nav class="col-sm-4 col-lg-3 footer-nav">
<h3>Enquiry</h3>
<ul class="slide">
<li><a href="https://www.elegantjourneys.com/tailor-make-a-tour.php">Tailor-Make A Tour</a></li>
<li><a href="https://www.elegantjourneys.com/contact-us.php">Contact Us</a></li>
<li><a href="https://www.elegantjourneys.com/tailor-make-a-tour.php">Enquiry</a></li>
</ul>
</nav>
<nav class="col-sm-4 col-lg-3 footer-nav">
<h3>Contact Us</h3>
<ul class="slide address-block">

<li class="wrap-text"> <a href="tel:91 99100 78975">(+91) 99100 78975</a></li>
<li class="wrap-text"> <a href="mailto:sales@elegantjourneys.com">Sales@ElegantJourneys.com</a></li>
</ul>
</nav>
















				</div>




			</div>


			<section class="content-block">
			<div class="container">
					<div class="row">
						<div class="col-lg-12 set-img">
							
							<div class="col">  
						   <img src="https://www.elegantjourneys.com/sagar/sgr-img/iato_new.png" class="img-responsive center-block effect" style="width: 90px;height: 100px;"/> 
						  </div>
							<div class="col">                                                  <img src="https://www.elegantjourneys.com/sagar/sgr-img/toft.png" class="img-responsive center-block effect" style="width: 150px;height: 100px;"/>
							</div>
							<div class="col"> 
							<img src="https://www.elegantjourneys.com/sagar/sgr-img/mtgi.png" class="img-responsive center-block effect" style="width: 150px;height: 100px;"/> 
						  </div>
						 <div class="col"> 
							<img src="https://www.elegantjourneys.com/sagar/sgr-img/visit-india.png" class="img-responsive center-block effect" style="width: 150px;height: 100px;"/> 
						  </div>
						  
						  <div class="col"> 
							<img src="https://www.elegantjourneys.com/sagar/sgr-img/faith.png" class="img-responsive center-block effect" style="width: 150px;height: 100px;" /> 
						  </div>

						</div>
					</div>

					
			</div>
			</section>


			<div class="footer-bottom">
				<div class="container">
					
					



					<div class="row">
						<div class="col-lg-4 col-xs-12">
							<!-- copyright -->
							<strong class="copyright"><i class="fa fa-copyright"></i> Copyright <?=date("Y")?> -  Elegant Journeys   <a href="#"> </a></strong>
						</div>
						<div class="col-lg-4 col-xs-12">
								<ul class="payment-option" style="text-align:center; float:none;">
								<li>
									<a target="_blank" href="https://www.facebook.com/elegantjourneys">
										<i data-toggle="tooltip" class="fa fa-facebook fa-2x">
										</i>
									</a>
								</li>
							
								
							
								<!--<li>
									<a target="_blank" href="#">
										<i data-toggle="tooltip" class="fa fa-twitter fa-2x">
										</i>
									</a>
								</li>-->
							
								<li>
									<a target="_blank" href="https://www.instagram.com/elegantjourneys">
										<i data-toggle="tooltip" class="fa fa-instagram fa-2x">
										</i>
									</a>
								</li>
							</ul>
						</div>
						<div class="col-lg-4 col-xs-12">
							<ul class="payment-option">
								<li>
									<img src="<?=WEBROOT?>img/footer/visa.png" alt="visa" height="20" width="33" alt="visa card">
								</li>
								<li>
									<img src="<?=WEBROOT?>img/footer/mastercard.png" height="20" width="33" alt="master card">
								</li>
								<li>
									<img src="<?=WEBROOT?>img/footer/paypal.png" height="20" width="72" alt="paypal">
								</li>
								<li>
									<img src="<?=WEBROOT?>img/footer/maestro.png" height="20" width="33" alt="maestro">
								</li>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</footer>
		