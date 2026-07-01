<?php
	include_once(BASEPATH_CLASS."website-section-class.php");
	$objWebsiteSection = new WebsiteSection();

?>


<footer id="footer">




			<div class="container" style="padding-bottom: 5px;">
				
				<div class="row footer-holder" style="text-align:center !important;">
					<?=$objWebsiteSection->getWebsiteSectionByCode('footer_link')?>
				</div>




			</div>


			<section class="content-block">
			<div class="container">
					<div class="row">
						<div class="col-lg-12">
							
							<div class="col-lg-3">  
						   <img src="https://www.elegantjourneys.com/sagar/sgr-img/iato_new.png" class="img-responsive center-block" style="width: 150px;height: 100px;" > 
						  </div>
							<div class="col-lg-3">                                                  <img src="https://www.elegantjourneys.com/sagar/sgr-img/toft.png" class="img-responsive center-block" style="width: 150px;height: 100px;" >
							</div>
							
						 <div class="col-lg-4"> 
							<img src="https://www.elegantjourneys.com/sagar/sgr-img/visit-india.png" class="img-responsive center-block" style="width: 350px;height: 100px;" > 
						  </div>
						  
						  <div class="col-lg-2"> 
							<img src="https://www.elegantjourneys.com/sagar/sgr-img/faith.jpg" class="img-responsive center-block" style="width: 150px;height: 100px;" > 
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