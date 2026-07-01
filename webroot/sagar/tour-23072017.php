<?php
	include_once("includes/config.php");
	include_once(BASEPATH_CLASS."category-class.php");
	include_once(BASEPATH_CLASS."tour-class.php");
	include_once(BASEPATH_CLASS."currency-class.php");
	include_once(BASEPATH_CLASS."tour-price-class.php");
	include_once(BASEPATH_CLASS."tripadvisor-review-class.php");
	include_once(BASEPATH_CLASS."testimonial-video-class.php");

	$objTour = new Tour();
	$objCurrency = new Currency();
	$objTourPrice = new TourPrice();
	$objTripadvisorReview = new TripadvisorReview();
	$objTestimonialVideo = new TestimonialVideo();

	$tourUrl = $_GET['toururl'];

	$tourDetail=$objTour->getTourByPageName($tourUrl);
	
	
	$currencyCode = $_SESSION['user_value']['selected_currency'];
	$currencyRate = $objCurrency->currencyRate($currencyCode);
	$currencyDetail = $objCurrency->getCurrencyDetailByCode($currencyCode);
	$currencySymbol = $currencyDetail['currency_sign'];

	$metaTitle=$tourDetail['tour_title'];
	$metaDescription=$tourDetail['meta_description'];
	$metaKeyword=$tourDetail['meta_keyword'];

	// setting recently visited tour
	$objTour->addToRecentlyVisitedTour($tourDetail['id']);
	include_once(BASEPATH."includes/head-section.php");
	
?>
<style>
			.margin-top-header {
				margin-top: 145px;
			}

			.fixed-tab {
				position: fixed;
				top: 128px;
				width: 100%;
				z-index: 99;
			}

			.itineraryMore {
				background: #33c200 url("<?=WEBROOT?>img/tours/eye-bg.png") no-repeat scroll 28px 11px;
				color: #fff !important;
				
				margin-left: 9.5%;
				margin-top: 1%;
				margin-bottom: 12%;
				padding: 10px 36px;
				text-align: right;
				text-transform: uppercase;
				width: 200px;
				cursor:pointer;
				
			}

			#viewMoreItinerary
			{
				
			}

			#viewLessItinerary
			{
				
			}

			.hideItinerary
			{
				display:none;
			}

			.showItinerary
			{
				display:block;
			}


</style>
<script>
	function displayFullItinerary()
	{
		$('#extraItineray').removeClass('hideItinerary');
		$('#extraItineray').addClass('showItinerary');
		$('#viewMoreItinerary').removeClass('showItinerary');
		$('#viewMoreItinerary').addClass('hideItinerary');
		$('#viewLessItinerary').addClass('showItinerary');
		$('#viewLessItinerary').removeClass('hideItinerary');
	}

	function displayLessItinerary()
	{
		$('#extraItineray').addClass('hideItinerary');
		$('#extraItineray').removeClass('showItinerary');
		$('#viewMoreItinerary').addClass('showItinerary');
		$('#viewMoreItinerary').removeClass('hideItinerary');
		$('#viewLessItinerary').removeClass('showItinerary');
		$('#viewLessItinerary').addClass('hideItinerary');
	}

	function showFullOverview()
	{
		$('#tourOverview').css('display','none');
		$('#tourDescription').css('display','block');
		//return false;
	}

	function hideFullOverview()
	{
		$('#tourOverview').css('display','block');
		$('#tourDescription').css('display','none');
		//return false;
	}

</script>
</head>
<body>
	<!--<div class="preloader" id="pageLoad">
		<div class="holder">
			<div class="coffee_cup"></div>
		</div>
	</div>-->
	<!-- main wrapper -->
	<div id="wrapper">
		<div class="page-wrapper">
			<!-- main header -->

			<?php include_once(BASEPATH."includes/header.php"); ?>

			<!---BRADE CRUMS-->
			<div class="container-fluid gray-background border-top margin-top-header">
			    <div class="container">
					<ul class="brade-crum">
						<li><a href="">Home </a></li>
						<li><a href="">Most Popular Tours </a></li>
						<li><a href=""  class="active">Golden Triangle Tours </a></li>
					</ul>
				</div>
			</div>
			<!---BRADE CRUMS END-->
			<!--Video and video information-->
            <div class="container-fluid background-white padding-left-0">
            	<div class="col-md-6 padding-left-0">
            		<!--<iframe width="100%" height="415" src="https://www.youtube.com/embed/ixdov26hzr4" frameborder="0" allowfullscreen></iframe>-->
					<img  src="<?=$objTour->getTourPicture($tourDetail['id'],$tourDetail['tour_image3'],'650','415')?>">
            	</div>
            	<div class="col-md-6 padding-video-details">
            		<h1><?=$tourDetail['tour_name']?> </h1>
					<?php
						$tourPrice = $objTourPrice->getMinimumPrice($tourDetail['id']);
						$discountInfo = array();
						$discountInfo = array(
												'offer'=>$tourDetail['offer'],
												'profit'=>$tourDetail['profit'],
												'price'=>$tourPrice,
												'currencyRate'=>$currencyRate
										);
						
						$tourPriceInfo =$objTourPrice->getPriceDetail($discountInfo);

					?>
            		<div class="price-discount">
            			<span class="form-i">from</span> 
            			<span class="old-price"><?=$currencySymbol?><?=$tourPriceInfo['displayPrice']?></span> 
            			<span class="new-price"><?=$currencySymbol?><?=$tourPriceInfo['profitPrice']?></span> 
            			<span class="discount-price"><?=number_format($tourDetail['offer'],2)?> % off</span>
            		</div>
            		<div class="tour-types">
            			<ul>
            				<li>
            					<span><img src="<?=WEBROOT?>img/tours/group-private.png"></span>
            					<span>Tour Type : </span>
            					<span>Private Trael</span>
            				</li>
            				<li>
            					<span><img src="<?=WEBROOT?>img/tours/private.png"></span>
            					<span>Tour Code : </span>
            					<span><?=$tourDetail['tour_code']?></span>
            				</li>
            				<li>
            					<span><img src="<?=WEBROOT?>img/tours/night.png"></span>
            					<span>Nights: </span>
            					<span><?=($tourDetail['tour_duraction']-1)?></span>
            				</li>
            			</ul>	
            	    </div>
            	    <div class="customh">OVERVIEW</div>
					<span id="tourOverview" style="display:block;">
            			<p class="customp"><?=$tourDetail['overview']?>...<a href="" style="font-weight:bold;" onclick="showFullOverview(); return false;">Read More</a></p>
					</span>
					<span id="tourDescription" style="display:none;">
            			<p class="customp"><?=$tourDetail['tour_description']?><a href="" style="font-weight:bold;" onclick="hideFullOverview(); return false;">Hide Overview</a></p>
					</span>
            	</div>
            </div> 	
            <!---Same page linking-->
			<div class="container-fluid fixed gray-background">
				<div class="container">	
					 <ul class="same-pagelinking">
					 	 <li id="itineryone"><a href="#itinery" class="active">Itinerary</a></li>
					 	 <li id="datedtwo"><a href="#dated">Dates-Prices</a></li>
					 	 <li id="hotelsthree"><a href="#hotels">Hotels</a></li>
					 	 <li><a class="various" data-fancybox-type="iframe" href="<?=WEBROOT?>enquiry.php">ENQUIRY NOW</a></li>		
					 </ul>
				</div> 
			</div>	
			<!---MAIN PAGE -->		
            <div class="container-fluid background-white">
                <div class="container">
            	 <div class="col-md-8 padding-left-0 padding-60-t-b">
            	 		<h1>DESTINATION</h1>
            	 		<div class="desti-bradecrum" style="padding-top:10px; padding-bottom:20px;">
            	 			<ul>
								<?php
									$tourPlaces = explode('&#8594;',$tourDetail['tour_place']);
									$totalIndex = count($tourPlaces);
									for($i=0;$i<$totalIndex;$i++)
									{
										if($i<($totalIndex-1))
										{
								?>
            	 							<li><?=str_replace('<br/>','',$tourPlaces[$i])?> <i class="fa fa-arrow-right" aria-hidden="true"></i></li>
								<?php
										}
										else
										{
								?>
											<li><?=str_replace('<br/>','',$tourPlaces[$i])?></li>
								<?php
										}
									}
								?>
            	 				
            	 					
            	 			</ul>	
            	 		</div>
            	 		<!--<span class="heading-third">UNIQUE EXPERIENCES ON THIS TOUR</span>	-->
            	 		<div class="tours-text">
            	 			<!--<div class="main-photo-image">
		            	 		<div class="photo-image"><img src="img/img1.png"></div>
		            	 		<div class="photo-text">Traditional cycle rickshaw ride in the back streets and bazaars of Old Delhi
		            	 		</div>
            	 			</div>
            	 			<div class="main-photo-image">
		            	 		<div class="photo-image"><img src="img/img1.png"></div>
		            	 		<div class="photo-text">Visit to the majestic fort of Jaipur
		            	 		</div>
            	 			</div>
            	 			<div class="main-photo-image">
		            	 		<div class="photo-image"><img src="img/img1.png"></div>
		            	 		<div class="photo-text">Enjoy an Elephant ride at the Amber Fort in Jaipur

		            	 		</div>
            	 			</div>
             	 			<div class="main-photo-image">
		            	 		<div class="photo-image"><img src="img/img1.png"></div>
		            	 		<div class="photo-text">View the Taj Mahal at sunrise and sunset to see change in color of the marble
		            	 		</div>
            	 			</div>
             	 			<div class="main-photo-image">
		            	 		<div class="photo-image"><img src="img/img1.png"></div>
		            	 		<div class="photo-text">A Horse drawn carriage ride to the Taj Mahal in Agra
		            	 		</div>
            	 			</div> 
             	 			<div class="main-photo-image">
		            	 		<div class="photo-image"><img src="img/img1.png"></div>
		            	 		<div class="photo-text">Visit India’s most significant UNESCO World Heritage Sites such as Jantar Mantar Observatory in Jaipur; Agra Fort & and Fatehpur Sikri in Agra and .... many other interesting sights listed in the detailed itinerary.
		            	 		</div>
            	 			</div>  
            	 			<hr /> <div class="clearfix"></div>-->
            	 			<div class="itinery" id="itinery"> 
            	 				<h1>ITINERY</h1>
								<?php
									$itineraryList = array();
									$itineraryList = $objTour->getTourItinerary($tourDetail['id']);
								
									
									$countItinery = 1;
									foreach($itineraryList as $itinerary)
									{
										if($countItinery==4)
										{
											echo '<span id="extraItineray" class="hideItinerary">';
										}
										
								?>
											
								
            	 				<div class="main_I">
            	 					<div class="icon-I"><img src="<?=WEBROOT?>img/tours/sun.png"></div>
            	 					<div class="text-I">
            	 						 <span class="heading-third">Day <?=$itinerary['day']?></span>
            	 						 <span class="sub-heading"><?=$itinerary['city']?></span>
            	 						 <p><?=$itinerary['description']?></p>
            	 					</div><div class="clearfix"></div>
            	 				</div>


								<?php
										
										$countItinery++;
									}

									if($countItinery>3)
									{
								?>
										</span>
										<span class="itineraryMore showItinerary" id="viewMoreItinerary" onclick="displayFullItinerary();">View More</span>
										<span class="itineraryMore hideItinerary" id="viewLessItinerary" onclick="displayLessItinerary();">View Less</span>

										
								<?php
									}
								?>
									
            	 			</div>  
							<?php
								$tourPriceList1 = $objTourPrice->getPriceByTourType($tourDetail['id'],'1');
								$tourPriceList2 = $objTourPrice->getPriceByTourType($tourDetail['id'],'2');
								
							?>
            	 			    
							<div class="dates-prices" id="dated">
							<span><h1>DATES-PRICES</h1></span>
							<div class="positon-relative">
								<span class="discount-price">Web Booking Special <?=number_format($tourDetail['offer'],0)?>% OFF </span>
							</div>
							<div class="sub-heading">LAND PRICE in <?=$currencyDetail['currency_name']?> - Per Person on Double/Twin share</div>
							
							<?php
								include('includes/price-template.php');
							?>

            	 			<div class="sub-heading">PRICING REMARKS:</div>
							<?=$tourDetail['private_remarks']?>
            	 				<!--<ul class="pricing-r">
            	 					<li>Single room supplement available on request.</li>
            	 					<li>Peak travel period supplement may be applicable during Christmas/New Year period 
									(20-Dec to 05-Jan).</li>
            	 				</ul>-->
            	 			</div>    
            	 			<hr /> 
  	 			

							<?php
								$hotelInformation=$objTour->getTourHotelInformation($tourDetail['id'],$tourDetail['tour_type']);
								include('includes/hotel-template.php');
							?>
							
            	 			
            	 			<p>Note : Hotel check-in is at 2 pm and check-out is at 12 noon for almost all the hotels in India.</p>          	 			                     	 			                  	 			            	 		
            	 		</div>	
            	 </div>
            	 <div class="col-md-4 padding-60-t-b">
            	 	 <h1>Reviews from Travelers like You...</h1>
            	 	 <img src="<?=WEBROOT?>img/trip-advisor.jpg">
            	 	 <div class="slider">
            	 	 	<ul class="bxslider">
						<?php
							$reviewList = $objTripadvisorReview->getReviewRandomList(4);
							foreach($reviewList as $review)
							{
						?>
						  <li>
						  	<div class="slider-left">
						  		<img src="<?=WEBROOT?>img/slider-img.png">
						  		<div class="slider-headin-one"><?=$review['name']?></div>
						  		<p><?=$review['place']?></p>
						  	</div>
						  	<div class="slider-right">
						  		<div class="slider-headin-one">Elegant Journeys India</div>
						  		<div class="slider-date"><?=date("d M, Y",strtotime($review['review_date']))?></div>
						  		<!--<img src="img/rating.png" style="width: 20%;margin-top: 5px;margin-bottom: 5px;">-->
						  		<p><?=$review['description']?></p>
						  	</div>
						  	<hr />
						  </li>
						  <?php
							}
						 ?>
						 
						</ul>
						<!--<div class="reply">Reply</div>-->
            	 	 </div><div class="clearfix"></div>
            	 	 <!---video page-->
            	 	 <div class="video">
            	 	 	<h1>Video Testimonials</h1>
            	 	 	<div class="video-main">
						<?php
							$testimonialVideoDetail = $objTestimonialVideo->getRandomTestimonial(1);
							
						?>
            	 	 		<iframe width="100%" height="300" src="https://www.youtube.com/embed/<?=$testimonialVideoDetail[0]['video_code']?>" frameborder="0" allowfullscreen></iframe>
            	 	 	</div>
            	 	 	<div class="view-more-videos">
            	 	 		<img src="<?=WEBROOT?>img/tours/video.png" onclick="window.open('https://www.youtube.com/user/elegantjourneys/videos');">VIEW MORE VIDEOS
            	 	 	</div>
            	 	 </div>
            	 	 <!--End vidoe page-->
            	 	 <!---Tours-wxclusive-->
            	 	 <div class="tours-exclusive">
            	 	 	<h1>Tour Inclusions & Exclusions</h1>
            	 	 	<div class="tours-main">

	                     <div id="accordion-first" class="clearfix">
	                        <div class="accordion" id="accordion2">
	                          <div class="accordion-group">
	                            <div class="accordion-heading">
	                              <a class="accordion-toggle active" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
	                                <em class="icon-fixed-width fa fa-plus"></em><b>TOUR INCLUSIONS.</b>
	                              </a>
	                            </div>
	                            <div id="collapseOne" class="accordion-body collapse in">
	                              <div class="accordion-inner">
	                                 <ul>
										<?php
											$tourInclusions = $objTour->getInclusionList($tourDetail['id']);
											foreach($tourInclusions as $tourInclusion)
											{
										?>
	                                 	<li><?=$tourInclusion['incexcdesc']?></li>
										<?php
											}
										?>
	                                 	         		    
	                                 </ul>
	                              </div>
	                            </div>
	                          </div>
	                          <div class="accordion-group">
	                            <div class="accordion-heading">
	                              <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
	                                <em class="icon-fixed-width fa fa-plus"></em><b>TOUR EXCLUSIONS</b>
	                              </a>
	                            </div>
	                            <div style="height: 0px;" id="collapseTwo" class="accordion-body collapse">
	                              <div class="accordion-inner">
	                                 <ul>
	                                 	<?php
											$tourInclusions = $objTour->getExclusionList($tourDetail['id']);
											foreach($tourInclusions as $tourInclusion)
											{
										?>
	                                 	<li><?=$tourInclusion['incexcdesc']?></li>
										<?php
											}
										?>
	                                                                  		    
	                                 </ul>.
	                              </div>
	                            </div>
	                          </div>
            	 	 	</div>
            	 	 </div>
            	 </div>
            </div>
           <!--- ENd of tours-->
           <!--- recent visit tours-->  
           <div class="visited-tours"> 
		   <?php
				$relatedTourList = $objTour->getRelatedTours($tourDetail['id']);
				if(count($relatedTourList)>=1)
				{
			?>
           <h1>Related Tours</h1>  
           		<div class="tours-slider">
					
           			<ul class="bxslidertwo">
					<?php
						foreach($relatedTourList as $relatedTour)
						{
							$tourPrice = $objTourPrice->getMinimumPrice($relatedTour['id']);
							$relatedTourDiscountInfo = array();
							$relatedTourDiscountInfo = array(
																'offer'=>$relatedTour['offer'],
																'profit'=>$relatedTour['profit'],
																'price'=>$tourPrice,
																'currencyRate'=>$currencyRate
														);
							
							$relatedTourPriceInfo =$objTourPrice->getPriceDetail($relatedTourDiscountInfo);
					?>
					  <li>
							<img src="<?=$objTour->getTourPicture($relatedTour['id'],$relatedTour['tour_image'],'421','232')?>" />
							<div class="slider-headin-one" style="margin-top:10px;">
								 <?=$relatedTour['tour_name']?>
								<p><?=$relatedTour['tour_place']?></p>
								<div class="enqure-now-btn">
									<a href="<?=WEBROOT?>tour/<?=$relatedTour['tour_url']?>"> Explore </a>
								</div>
								<div class="from-person">
									<span class="form-i">from</span> 
									<?php
										if($relatedTour['offer']=='0'||$relatedTour['offer']=='')
										{
									?>
											<span class="new-price"><?=$currencySymbol?><?=$relatedTourPriceInfo['profitPrice']?></span>  / 
											<span class="form-i">Person</span>
									<?php
										}
										else
										{
									?>
											<span class="new-price"><?=$currencySymbol?><?=$relatedTourPriceInfo['profitPrice']?></span> 						
											<span class="old-price"><?=$currencySymbol?><?=$relatedTourPriceInfo['displayPrice']?>pp</span> / 
											<span class="form-i">Person</span>
									<?php
										}
									?>
								</div>
							</div>	
							
					  </li>
					<?php
						}
					?>
					</ul>
				</div>
				<?php
				}
				?>
           </div>
           <!--- recent visit tours-->  
           <div class="visited-tours"> 
		   <?php
				$recentlyVistitedTours = $objTour->getRecentlyVisitedTours();
				if(count($recentlyVistitedTours)>=1)
				{
			?>
           <h1>Recently Viewed Tours</h1>  
           		<div class="tours-slider">
           			<ul class="bxslidertwo">
					 <?php
						foreach($recentlyVistitedTours as $relatedTour)
						{
							$tourPrice = $objTourPrice->getMinimumPrice($relatedTour['id']);
							$relatedTourDiscountInfo = array();
							$relatedTourDiscountInfo = array(
																'offer'=>$relatedTour['offer'],
																'profit'=>$relatedTour['profit'],
																'price'=>$tourPrice,
																'currencyRate'=>$currencyRate
														);
							
							$relatedTourPriceInfo =$objTourPrice->getPriceDetail($relatedTourDiscountInfo);
					?>
					  <li>
							<img src="<?=$objTour->getTourPicture($relatedTour['id'],$relatedTour['tour_image'],'421','232')?>" />
							<div class="slider-headin-one" style="margin-top:10px;">
								 <?=$relatedTour['tour_name']?>
								<p><?=$relatedTour['tour_place']?></p>
								<div class="enqure-now-btn">
									<a href="<?=WEBROOT?>tour/<?=$relatedTour['tour_url']?>"> Explore </a>
								</div>
								<div class="from-person">
									<span class="form-i">from</span> 
									<?php
										if($relatedTour['offer']=='0'||$relatedTour['offer']=='')
										{
									?>
											<span class="new-price"><?=$currencySymbol?><?=$relatedTourPriceInfo['profitPrice']?></span>  / 
											<span class="form-i">Person</span>
									<?php
										}
										else
										{
									?>
											<span class="new-price"><?=$currencySymbol?><?=$relatedTourPriceInfo['profitPrice']?></span> 						
											<span class="old-price"><?=$currencySymbol?><?=$relatedTourPriceInfo['displayPrice']?>pp</span> / 
											<span class="form-i">Person</span>
									<?php
										}
									?>
								</div>
							</div>	
							
					  </li>
					<?php
						}
					?>
					</ul>
				</div>
			<?php
				}
			?>
           </div>
           <!---End of visit tours-->
		</div>
	    </div>	
	</div>
</div>
	<div class="clearfix"></div>
		<!-- main footer -->
		<?php include_once("includes/footer.php"); ?>
	</div>
	<!-- scroll to top -->
	<div class="scroll-holder text-center">
		<a href="javascript:" id="scroll-to-top"><i class="icon-arrow-down"></i></a>
	</div>
	
	<?php 
		
		include_once("includes/tour-footer-script.php"); 
	?>


</body>
</html>