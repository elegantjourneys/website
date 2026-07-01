<?php
	include_once(BASEPATH_CLASS."website-section-class.php");
	$objWebsiteSection = new WebsiteSection();

?>
<!-- <br> -->

<footer id="footer">

			<section class="content-block footer-top-section">
				<div class="container">
					<div class="row footer-pad-bottom">
						<div class="col-sm-3 box-resp-1">
							<h3>Golden Triangle Tour</h3>
							<ul class="">
								<li>
									<a href="<?=WEBROOT?>north-india/5-day-golden-triangle-express-gt-189">5 Day Golden Triangle - EXPRESS)</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/6-day-golden-triangle-regaular-gt-80">6 Day Golden Triangle - REGULAR</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/7-day-golden-triangle-relax-gt-29">7 Day Golden Triangle Tour</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/9-day-gt-jodhpur-udaipur-gt-41">9 Day GT + Jodhpur, Udaipur</a>
								</li>
								
								<li>
									<a href="<?=WEBROOT?>north-india/8-day-gt-varanasi-gt-171">8 Day GT + Varanasi</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/9-day-gt-varanasi-khajuraho-gt-58">9 Day GT + Varanasi, Khajuraho</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/8-day-golden-triangle-tour-and-tiger">8 Day GT + Tiger</a>
								</li>
							</ul>
						</div>
						<div class="col-sm-3 box-resp-1">
							<h3>Luxury Private Offers</h3>
							<ul class="">
								<li>
									<a href="<?=WEBROOT?>luxury-tours/7-day-golden-triangle-tour-ob-193">7 Day Oberoi Golden Triangle</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>luxury-tours/8-Day-Golden-Triangle-and-Udaipur-OB-195">8 Day Oberoi GT + Udaipur</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>luxury-tours/8-Day-Golden-Triangle-and-Wildlife-OB-194">8 Day Oberoi GT + Tigers</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>luxury-tours/10-Day-Golden-Triangle-Varanasi-and-Udaipur-OB-265">10 Day GT, Varanasi & Udaipur</a>
								</li>
								
								<li>
									<a href="<?=WEBROOT?>luxury-tours/11-Day-Rajasthan-Tour-and-Wildlife-OB-270">11 Day Rajasthan Tour + Wildlife</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>luxury-tours/12-Day-Golden-Triangle-Varanasi-Wildlife-and-Udaipur-OB-267">12 Day GT Varanasi, Tiger Udaipur</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>luxury-tours/13-Day-Rajasthan-Tour-and-Varanasi-and-Wildlife-OB-273">13 Day Rajasthan Tour, Varanasi</a>
								</li>
							</ul>
						</div>
						<div class="col-sm-3 box-resp-1">
							<h3>Rajsthan Tour</h3>
							<ul class="">
								<li>
									<a href="<?=WEBROOT?>north-india/8-day-rajsthan-tour-udaipur-rj-172">8 Day Rajasthan Tour + Udaipur</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/9-day-rajsthan-jodhpur-udaipur-rj-173">9 Day Rajasthan + Jodhpur, Udaipur</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/10-day-rajsthan-tiger-rj-156">10 Day Rajasthan + Tigers</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/11-day-rajsthan-tigers-rj-157">11 Day Rajasthan + Tigers</a>
								</li>
								
								<li>
									<a href="<?=WEBROOT?>north-india/11-day-rajsthan-tour-and-jaisalmer-rj-213">11 Day Rajasthan Tour + Jaisalmer</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/13-day-rajsthan-tour-and-tigers-rj-214">13 Day Rajasthan Tour + Tigers</a>
								</li>
							</ul>
						</div>
						<div class="col-sm-3 box-resp-1">
							<h3>Other Popular Tours</h3>
							<ul class="">
								
								
								<li>
									<a href="<?=WEBROOT?>north-india/7-day-golden-triangle-luxury-tour">7 Day Golden Triangle Luxury Tour</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/8-day-golden-triangle-wildlife-luxury-tour">8 Day GT + Wildlife Luxury Tour</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/8-day-golden-triangle-varanasi-luxury-tour">8 Day GT + Varanasi Luxury Tour</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/10-day-rajasthan-tour-wildlife-luxury-tour">10 Day RT + Wildlife Luxury Tour</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/12-day-golden-triangle-luxury-tour">12 Day Golden Triangle Luxury Tour</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/13-day-golden-triangle-luxury-tour">13 Day Golden Triangle Luxury Tour</a>
								</li>
							</ul>
						</div>
						
					</div>	
					<div class="row">
						<div class="col-md-12">
							<h3 class="tags-heading"></h3>
						</div>
					</div>
				</div>
			
			</section>
			


			<div class="container">
				<!-- newsletter form -->
				<!--<form action="php/subscribe.html" id="signup" method="post" class="newsletter-form">
					<fieldset>
						<div class="input-holder">
							<input type="email" class="form-control" placeholder="Email Address" name="subscriber_email" id="subscriber_email">
							<input type="submit" value="GO">
						</div>
						<span class="info" id="subscribe_message">To receive news, updates and tour packages via email.</span>
					</fieldset>
				</form>-->
				<!-- footer links -->
				<div class="row footer-holder" style="text-align:center !important;">
					<?=$objWebsiteSection->getWebsiteSectionByCode('footer_link')?>
				</div>


				<?php
					/*

				<!-- social wrap -->
				<ul class="social-wrap">
					<li class="facebook"><a href="https://www.facebook.com/elegantjourneys">
						<span class="icon-facebook"></span>
						<strong class="txt">Like Us</strong>
					</a></li>
					<li class="twitter"><a href="https://twitter.com/elegantjourney">
						<span class="icon-twitter"></span>
						<strong class="txt">Follow On</strong>
					</a></li>
					<li class="google-plus"><a href="https://plus.google.com/+ElegantjourneysCo">
						<span class="icon-google-plus"></span>
						<strong class="txt">+1 On Google</strong>
					</a></li>
					<li class="vimeo"><a href="#">
						<span class="icon-vimeo"></span>
						<strong class="txt">Share At</strong>
					</a></li>
					<li class="pin"><a href="#">
						<span class="icon-pin"></span>
						<strong class="txt">Pin It</strong>
					</a></li>
					<li class="dribble"><a href="#">
						<span class="icon-dribble"></span>
						<strong class="txt">Dribbble</strong>
					</a></li>
				</ul>

					*/
				?>

				<div class="footer-nav tags-wrap">
					<br>
					<h3 class="tags-heading">Popular Tags</h3>
					<ul>
						<li><a href="https://www.elegantjourneys.com/tour-package-golden-triangle-india-tours" class="tags">Golden Triangle Train Tour</a></li>
						<li><a href="https://www.elegantjourneys.com/tour-package-golden-triangle-india-tours/6-day-golden-triangle-regaular-gt-80" class="tags">6 Days Golden Triangle India</a></li>
						<li><a href="https://www.elegantjourneys.com/tour-package-rajasthan-tours-india" class="tags">Jaipur And Ranthambore</a></li>
						<li><a href="https://www.elegantjourneys.com/tour-package-luxury-india-tour-with-oberoi-hotels" class="tags">Oberoi Vilas holidays</a></li>
						
						<li><a href="https://www.elegantjourneys.com/tour-package-rajasthan-tours-india" class="tags">Rajasthan Tours</a></li>
					</ul>


				</div>

			</div>


			<section class="content-block">
			<div class="container">
					<div class="row">
						<div class="col-lg-12">
							
							<div class="col-lg-2">  
						   <img src="https://www.elegantjourneys.com/sagar/sgr-img/iato_member_logo.png" width="150" class="img-responsive" > 
						  </div>
							<div class="col-lg-2">                                                        
						   <img src="https://www.elegantjourneys.com/sagar/sgr-img/tofttigers_logo.png" width="250" class="img-responsive" style="margin-top:60px;">
							</div>
							
						 <div class="col-lg-2"> 
							<img src="https://www.elegantjourneys.com/sagar/sgr-img/incredible-india.png" width="150" class="img-responsive" style="margin-top:50px;"> 
						  </div>

						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<h3 class="tags-heading"></h3>
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
									<a target="_blank" href="https://www.facebook.com/elegantjourneys/">
										<i data-toggle="tooltip" class="fa fa-facebook fa-2x">
										</i>
									</a>
								</li>
							
								
							
								<li>
									<a target="_blank" href="#">
										<i data-toggle="tooltip" class="fa fa-twitter fa-2x">
										</i>
									</a>
								</li>
							
								<li>
									<a target="_blank" href="">
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
								<!--<li>
									<img src="<?=WEBROOT?>img/footer/bank-transfer.png" height="20" width="55" alt="bank transfer">
								</li>-->
							</ul>
						</div>
					</div>
				</div>
			</div>
		</footer>