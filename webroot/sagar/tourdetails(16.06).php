<?php
	include_once("includes/config.php");

	include_once(BASEPATH_CLASS."category-class.php");
	include_once(BASEPATH_CLASS."tour-class.php");
	include_once(BASEPATH_CLASS."currency-class.php");
	include_once(BASEPATH_CLASS."tour-price-class.php");
	include_once(BASEPATH_CLASS."tripadvisor-review-class.php");
	include_once(BASEPATH_CLASS."testimonial-video-class.php");
	include_once(BASEPATH_CLASS."breadcrumb-class.php");

	$objTour = new Tour();
	$objCurrency = new Currency();
	$objTourPrice = new TourPrice();
	$objTripadvisorReview = new TripadvisorReview();
	$objTestimonialVideo = new TestimonialVideo();
	$objBreadcrumb = new Breadcrumb();

	$tourUrl = $_GET['toururl'];
	$tourDetail=$objTour->getTourByPageName($tourUrl);

	include_once("includes/head-section1.php");
?>
<link href="  https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css" rel="stylesheet">
<style type="text/css">
.populartour-box .thumbnail {
    height: 620px;
}
body {
      position: relative; 
  }
 .form-style-9{
    max-width: 62%;
    background: #f2f2f1;
    padding: 30px;
	border-radius: 8px;
	margin: 0 0 20px;
	
    
}
 .enquiry-form .enquire_form input[type=text], .enquiry-form input[type=date] {
    margin-bottom: 22px;
    background: #ffffff;
    color: #000;
    height: 40px;
    border: 1px solid;
}
</style>
<!-- bootstrap-datepicker3.min.css -->
<link rel="stylesheet" type="text/css" href="<?=WEBROOT?>sagar/css/msdropdown/dd.css" />
</head>
<body>
	 
	<!-- main wrapper -->
	<div id="wrapper" data-spy="scroll" data-target=".strip-top" data-offset="100">
		<div class="page-wrapper">
			<!-- main header -->
                  <?php include_once("includes/header.php"); ?>

			<main id="main">
				<!-- main contact information block -->
				<div class="bg-white tour-details">
 			  <div class="hidden-xs">
                        <br>
                          <br>
                          <br>
                          <br>
                          <br>
                    </div>
                    
                   
                   <div class="container">
                   	<div class="col-lg-12">
                   		<?php
								$breadCrumbData = array(
															"section_name"		=>		"tourDetail",
															"tour_id"			=>		$tourDetail['id']
												);
								echo $objBreadcrumb->getBreadcrumbList($breadCrumbData);
						?>
                   		
                   	</div>
                   	<div class="col-lg-12">
                   		<div class="col-lg-7 col-md-7 col-sm-7">
                              <!-- bootstrap carousel -->
								<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
						<!-- Indicators -->
      
		

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
		<?php

					$videoTestimonials = $objTestimonialVideo->getRandomTestimonial(6);
					$countVideo = 1;
					$arrVideoImage = array();
					foreach($videoTestimonials as $videoTestimonial)
					{

						$arrVideoImage[]=$videoTestimonial['image'];
						if($countVideo=='1')
						{
		?>
						<div class="item active srle">
								<div class="wrapper">
									   <iframe width="620" height="344" src="https://www.youtube.com/embed/<?=$videoTestimonial['video_code']?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
									  
								  </div>
							
					  </div>
					  <?php
						}
					  ?>
					  
					  <div class="item video-iframe">
						  <div class="wrapper">
							<iframe width="620" height="344" src="https://www.youtube.com/embed<?=$videoTestimonial['video_code']?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
						  </div>
					  </div>
		<?php
					    $countVideo++;
					}
		?>


        </div>

        <!-- Controls -->
      

        <!-- Thumbnails --> 
        <ul class="thumbnails-carousel clearfix">
		<?php
			foreach($arrVideoImage as $image)
			{
		?>
            <li class="col-lg-2 col-xs-2"><img src="<?=WEBROOT?>images/youtube-video/<?=$image?>" alt="" ></li>
        <?php
			}
		?>
        </ul>
      </div>

					
                              </div>

                   		<div class="col-lg-5 col-md-5 col-sm-5 top-section-right">
                   			<label class="label label-xs label-info tour-info-label">Private Tour</label>
                   			<label class="label label-xs label-danger tour-offer-label"><?=number_format($tourDetail['offer'])?>% Off</label>
							
							<h1><?=$tourDetail['tour_name']?></h1>
								<label class="icon"><img src="<?=WEBROOT?>sagar/sgr-img/suitcase.png">TOUR CODE : <?=$tourDetail['tour_code']?>&nbsp;&nbsp;</label>  |    &nbsp;&nbsp;<label class="icon"><img src="<?=WEBROOT?>sagar/sgr-img/night.png">	NIGHTS :  <?=$tourDetail['tour_duraction']?></label> 
								<?php
									############ SETTING MINUMUM PRICE FOR TOUR ###############
									$currencyCode = $_SESSION['user_value']['selected_currency'];
									$currencyRate = $objCurrency->currencyRate($currencyCode);
									$currencySymbol = $objCurrency->getcurrencySymbol($currencyCode);

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
								<div class="col-lg-6 p-none">
									<span class="price" style="line-height:25px;font-size: 17px;font-family: 'Montserrat', sans-serif;">from <i style="text-decoration:line-through;"><?=$currencySymbol?><?=$tourPriceInfo['profitPrice']?></i>   <strong style="color:#5c5e62; font-weight: 500;"><?=$currencySymbol?><?=$tourPriceInfo['displayPrice']?></strong> <span style="font-size: 14px;">/ Person</span></span>
								</div>
								<div class="col-lg-6">
                  <div class="select-holder">
                    
                    <select id="payments" name="payments" style="width: 88px;font-size: 12px;">                         
                          <option value="USD" data-image="<?=WEBROOT?>sagar/sgr-img/flag.png"> USD</option>
                          <option value="USD" data-image="<?=WEBROOT?>sagar/sgr-img/flag.png"> EUR</option>
                          <option value="USD" data-image="<?=WEBROOT?>sagar/sgr-img/flag.png"> INR</option>
                          <option value="USD" data-image="<?=WEBROOT?>sagar/sgr-img/flag.png"> USD</option>
                      </select>
                      <span style=" font-size: 10px; line-height: 14px; font-weight: 600; text-align: center; position: absolute; padding: 5px; "></span>
                  </div>
                  
									
				</div>			

						<hr class="col-lg-12" style="border-top: 2px solid #7e7f82;">
            <div class="col-lg-12 p-none">
			<label class="icon text-uppercase" style="
			background: linear-gradient(90deg, transparent 40%, #212121 14%, #212121 72%, transparent 69%);
			background-size: 97% 2px;
			background-position: -4px 91%;
			background-repeat: no-repeat;
			">
				<img src="<?=WEBROOT?>sagar/sgr-img/places-icon.png"> Places
			</label>
									<div style="font-size:13px;margin: 0 25px;font-weight:500;">
									<?php
										$cityList=$objTour->getCityList($tourDetail['tour_place']);
										$strCity = implode("&rarr;",$cityList);
										echo $strCity;
									?>
									</div>
								</div>
                   		</div>

                   	</div> <!-- first section -->
                   </div> <!-- container -->
                   
                   <div class="container-fluid p-none">
                   	<div class="strip strip-top hidden-xs fix-strip">
                   		<div class="container">
                   			<div class="col-lg-7 col-sm-7">
                   				<ul>
                   					<li class="active"><a href="#itinerary" class="scroll">Itinerary</a></li>
                   					<li class=""><a href="#hotels" class="scroll">Hotels</a></li>
                   					
                   					<li class=""><a href="#datesprices" class="scroll">Dates-Prices</a></li>
                            <li class=""><a href="#inclusions" class="scroll">Inclusions</a></li>
                   				</ul>
                   			</div>
                   			<div class="col-lg-4 col-lg-offset-1 p-none col-sm-5">
                   				<ul>
                   					<li class="active"><a href="">Book Now</a></li>
                   					<li><a href="" class="bg-darkblue">Send Query</a></li>
                   					
                   				</ul>	
                   			</div>
                   		</div>
                   	</div>
                   	<br><br>
                   	<div class="container">
                   		<div class="col-lg-7"><br>
                   			<div class="overview col-lg-12" id="">
                   				<h2 class="heading ">Overview</h2>
                   				<p class="fadedbelow"><span class="more"><?=$tourDetail['tour_description']?></span></p>
							
                          <div class="bottom_fade" id="overviewHideButton"></div>
                          <div class="col-lg-12" id="itinerary"></div>
                   				<div class="text-center col-lg-12" id="boxOverviewMore"><br>
                   				   <a href="#" class="btn readmore btn-shadow radius text-capitalize" onclick="return displayOverview();">Read More</a>
                   				</div>

                   			</div>

                   			<hr class="col-lg-12">
                   			<div class="itinerary col-lg-12" id="">
                   				<h2 class="heading">Itinerary</h2>
                   				<div class="itinerary-detail">

								<?php
								
									$itineraryList = array();
									$itineraryList = $objTour->getTourItinerary($tourDetail['id']);
									$countItineraryDays = 0;
									foreach($itineraryList as $itinerary)
									{
										$countItineraryDays++;
										if($countItineraryDays<4)
										{
								?>
										<div class="col-lg-11 col-lg-offset-1 oneday" style=" padding-left: 32px; border-left: 5px dotted #ccc;">
											<img src="http://www.elegant-incentives.com/sagar/sgr-img/sun.png" style="position: absolute;left: -27px;background: #fff;padding-bottom: 5px;">
													
										  
											<span> <label class="btn btn-shadow radius">Day <?=$itinerary['day']?> - <?=$itinerary['city']?></label></span>
											<br>
											<p class="fadedbelow" style="  /* border-left: 5px dotted #ccc; */">
											 <?=$itinerary['description']?>

											</p>
										  
										</div>
								<?php
										}
										else
										{
											if($countItineraryDays==4)
											{
								?>
													<div class="col-lg-12" id="hotels"><br><br></div>
														  <div class="text-center col-lg-12" id="displayItineraryButton">
																		 <a href="" class="btn readmore btn-shadow radius" onclick="return displayItinerary();">Read More</a>

																	</div>
														</div>
								  <?php
											}
								  ?>
												<div class="col-lg-11 col-lg-offset-1 oneday tourDays4" style=" padding-left: 32px; border-left: 5px dotted #ccc; display:none;">
													<img src="http://www.elegant-incentives.com/sagar/sgr-img/sun.png" style="position: absolute;left: -27px;background: #fff;padding-bottom: 5px;">
															
												  
													<span> <label class="btn btn-shadow radius">Day <?=$itinerary['day']?> - <?=$itinerary['city']?></label></span>
													<br>
													<p class="fadedbelow" style="  /* border-left: 5px dotted #ccc; */">
													 <?=$itinerary['description']?>
													</p>
												  
												</div>

								<?php
										}
								?>
											
								<?php
									}
								?>
									

                            

	                   			
                   			</div>

                   			<hr class="col-lg-12" style="border-top: 2px solid #7e7f82;">

							<?php
								$hotelInformations=$objTour->getTourHotelInformation($tourDetail['id'],$tourDetail['tour_type']);
								
							?>
                   			<div class="hotels col-lg-12" id="">
                   				<h2 class="heading">Hotels</h2>
								<?php
									foreach($hotelInformations as $key=>$hotelInformation)
									{
										$hotelLable=$objTour->getHotelLabel($key);
									
								?>
                   				<div class="hotel-category col-lg-12">
                   					<h4><?=$hotelLable?> <span>&nbsp;&nbsp;<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i> </span></h4>
									<?php
										foreach($hotelInformation as $hotel)
										{
									?>
                   					<div class="col-lg-12 p-none oneday" style="font-weight: 600;">
                   						<div class="col-lg-3">
                   							<img src="<?=WEBROOT?>sagar/sgr-img/mapmarker.png">&nbsp; <?=$hotel['location']?>
                   						</div>
                   						<div class="col-lg-9">
                   							<img src="<?=WEBROOT?>sagar/sgr-img/hotel.png">&nbsp; <?=$hotel['primaryHotelName']?>
                   						</div>
                   					</div> <!-- one place -->
									<?php
										}
									?>
                   					
                   					<hr class="col-lg-12">
                   				</div> <!-- one category -->
								<?php
									}
								?>
                   				
                              <!--<div class="col-lg-12 " id="datesprices"></div>
                   				<div class="col-lg-12">
                   					<p><span class="blue">Note:</span>&nbsp;&nbsp;Hotel check-in is at 2 pm and check-out is at 12 noon for almost all the hotels in India.</p>
                   				</div>-->
                          

                   			</div>
                   			<hr class="col-lg-12" style="border-top: 2px solid #7e7f82;">

                   		</div>

                   		<div class="col-lg-4 col-lg-offset-1 hidden-xs">
                                    <br>
                                    <div class="col-lg-12 p-none tripadvisor">
                                          <h2 class="heading no-bg" style="background: none; margin: 0;  padding-left: 0;">Reviews from Travelers Like you..</h2>
                                          <img src="<?=WEBROOT?>sagar/sgr-img/tripadvisor.png" alt="tripadvisor">
                                                <div class="review-wrap">
                                                      <div class="tripadvisor-review">
                                                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                                                <!-- Indicators -->
                                                                <ol class="carousel-indicators carousel-indicators-numbers">
                                                                  <li data-target="#myCarousel" data-slide-to="0" class="active">1</li>
                                                                  <li data-target="#myCarousel" data-slide-to="1">2</li>
                                                                  <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                                                </ol>

                                                                <!-- Wrapper for slides -->
                                                                <div class="carousel-inner">

                                                                  <div class="item active">
                                                                    
                                                                    <div class="carousel-caption">
                                                                    <div class="col-lg-3">
                                                                           <img src="https://media-cdn.tripadvisor.com/media/photo-l/01/2a/fd/93/avatar.jpg" class="user-review-img" width="74" height="74">
                                                                           <p class="user-review-name">Reviewer name</p>
                                                                      </div>
                                                                     
                                                                      <div class="col-lg-9 text-left">
                                                                             
                                                                            <h4 class="blackbold text-capitalize">Elegant Journeys Highly Recommended</h4>
                                                                             <span>
                                                                                          15 April, 2016 15:16
                                                                                    </span><br>
                                                                                    <div class="review-circle-wrap">
                                                                                     
                                                                                    <ul>
                                                                                          <li><img src="sgr-img/trip-review-circle.png" width="20"></li>
                                                                                          <li><img src="sgr-img/trip-review-circle.png" width="20"></li>
                                                                                          <li><img src="sgr-img/trip-review-circle.png" width="20"></li>
                                                                                          <li><img src="sgr-img/trip-review-circle.png" width="20"></li>
                                                                                          <li><img src="sgr-img/trip-review-circle.png" width="20"></li>
                                                                                    </ul>
                                                                                  
                                                                              </div>
                                                                            <p class="user-review-descr">I just want to thank you and your staff for setting up such a wonderful trip. Everything from the guides and drivers to the hotel accommodations were great. I will definitely recommend your services to anyone planning a trip to India. Thanks again for an amazing experience and memories that will last a lifetime.</p>
                                                                           <!--  <span class="extra-line">Ask Andrew about Real Journeys</span>
                                                                            <br>
                                                                            <span class="extra-button"><i class="fa fa-thumbs-up"></i> Thanks Andrew Smith</span>
                                                                            <p class="text-muted border-top-eee">
                                                                              <em>This review is the subjective opinion of a Tripadvisor member and not of Tripadvisor LLC.</em>
                                                                            </p> -->
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                  <div class="item">
                                                                    

                                                                     
                                                                    <div class="carousel-caption">
                                                                    <div class="col-lg-3">
                                                                           <img src="https://media-cdn.tripadvisor.com/media/photo-l/01/2a/fd/93/avatar.jpg" class="user-review-img" width="74" height="74">
                                                                           <p class="user-review-name">Reviewer name</p>
                                                                      </div>
                                                                     
                                                                      <div class="col-lg-9 text-left">
                                                                             
                                                                            <h4 class="blackbold text-capitalize">Elegant Journeys Highly Recommended</h4>
                                                                             <span>
                                                                                          15 April, 2016 15:16
                                                                                    </span><br>
                                                                                    <div class="review-circle-wrap">
                                                                                     
                                                                                    <ul>
                                                                                          <li><img src="<?=WEBROOT?>sagar/sgr-img/trip-review-circle.png" width="20"></li>
                                                                                          <li><img src="<?=WEBROOT?>sagar/sgr-img/trip-review-circle.png" width="20"></li>
                                                                                          <li><img src="<?=WEBROOT?>sagar/sgr-img/trip-review-circle.png" width="20"></li>
                                                                                          <li><img src="<?=WEBROOT?>sagar/sgr-img/trip-review-circle.png" width="20"></li>
                                                                                          <li><img src="<?=WEBROOT?>sagar/sgr-img/trip-review-circle.png" width="20"></li>
                                                                                    </ul>
                                                                                  
                                                                              </div>
                                                                            <p class="user-review-descr">I just want to thank you and your staff for setting up such a wonderful trip. Everything from the guides and drivers to the hotel accommodations were great. I will definitely recommend your services to anyone planning a trip to India. Thanks again for an amazing experience and memories that will last a lifetime.</p>
                                                                           <!--  <span class="extra-line">Ask Andrew about Real Journeys</span>
                                                                            <br>
                                                                            <span class="extra-button"><i class="fa fa-thumbs-up"></i> Thanks Andrew Smith</span>
                                                                            <p class="text-muted border-top-eee">
                                                                              <em>This review is the subjective opinion of a Tripadvisor member and not of Tripadvisor LLC.</em>
                                                                            </p> -->
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                <hr>
                                                                </div>

                                                                <!-- Left and right controls -->
                                                               <!--  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                                                  <span class="glyphicon glyphicon-chevron-left"></span>
                                                                  <span class="sr-only">Previous</span>
                                                                </a>
                                                                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                                                  <span class="glyphicon glyphicon-chevron-right"></span>
                                                                  <span class="sr-only">Next</span>
                                                                </a> -->
                                                              </div>


                                                      </div>
                                                      </div>
                                    </div> <!-- review -wrap -->
                                  
                                    <div class="col-lg-12 tripadvisor p-none">
                                          <br>
                                          <h2 class="heading ">Tour Map</h2>
                                          <!-- <div class="video-wrap">
                                                 <div id="random_number1" class="carousel slide youtube-carousel"  data-ride="carousel" data-interval="false">
                                                        <div class="carousel-inner">
                                                          <div class="video-container item active">
                                                            <div class="youtube-video" id='AO89eXKO0c4'></div>
                                                            <div class="carousel-caption">Video 1</div>
                                                          </div>
                                                          <div class="video-container item">
                                                            <div class="youtube-video" id='6MjRVkm9CF0'></div>
                                                            <div class="carousel-caption">Video 2</div>
                                                          </div>
                                                          <div class="video-container item ">
                                                            <div class="youtube-video" id='R8poo-zCK9g'></div>
                                                            <div class="carousel-caption">Video 3</div>
                                                          </div>
                                                        </div>
                                                        <div class="controls">
                                                          <a class="left carousel-control" href="#random_number1" data-slide="prev">
                                                            <div class="left-button">
                                                              <div class="glyphicon glyphicon-chevron-left"></div>
                                                            </div>
                                                          </a>
                                                          <a class="right carousel-control" href="#random_number1" data-slide="next">        
                                                            <div class="right-button">
                                                              <div class="glyphicon glyphicon-chevron-right"></div>
                                                            </div>
                                                          </a>
                                                        </div>
                                                      </div>
                                          </div> -->
                                            <div id="video" class="carousel slide video-scroll" data-ride="carousel">
                                                                <!-- Indicators -->
                                                                <ol class="carousel-indicators carousel-indicators-numbers">
                                                                  <li data-target="#video" data-slide-to="0" class="active">1</li>
                                                                  <li data-target="#video" data-slide-to="1">2</li>
                                                                  <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                                                </ol>

                                                                <!-- Wrapper for slides -->
                                                    <div class="carousel-inner">

                                                      <div class="item active">
                                                        
                                                        <img src="<?=WEBROOT?>images/golden-triangle-tour.jpg" width="360" height="233">
                                                      </div>
                                                      <div class="item ">
                                                        
                                                        <img src="<?=WEBROOT?>images/golden-triangle-tour.jpg" width="360" height="233">
                                                      </div>
                                                    
                                                    </div>

                                                              </div>
                                    </div>

                              </div>

                   		<div class="row">
                   			<div class="col-lg-12 dates-prices" id="">
                   				<div class="col-lg-12 p-none">
	                   				<div class="col-lg-4 text-left"><h2 class="heading">Date - Prices</h2></div>
	                   				<div class="col-lg-8 text-right">
	                   					<!--<select class="replacewithselect">
											<option value="">2 Rooms</option>
										  </select>-->
	                   					<label class="label label-xs label-danger tour-offer-label">Web Booking Special 30% Off</label>
	                   				</div>
                   				</div>
								<?php
									$tourPriceList = $objTourPrice->getPriceByTourType($tourDetail['id'],'2');
									
								?>
                   				<div class="col-lg-12 ">
                   					<div class="col-lg-12 table-responsive">
                                                      <h3 class="date-subhead text-uppercase">LAND PRICE in US Dollar (USD) - Per Person on Double/Twin share</h3>
                   					<table class="">
                   						<thead>
	                   						<tr>
	                   							<th>Session Start Date</th>
	                   							<th>Session End Date</th>
	                   							<!--<th><span class="blue text-uppercase">standard</span>(4 star)</th>-->
	                   							<th><span class="blue text-uppercase">Deluxe</span>(3 star)</th>
	                   							<!--<th><span class="blue text-uppercase">standard</span>(4 star)</th>-->
	                   							<th><span class="blue text-uppercase">Deluxe</span>(4 star)</th>
	                   							<!--<th><span class="blue text-uppercase">standard</span>(5 star)</th>-->
	                   							<th><span class="blue text-uppercase">Deluxe</span>(5 star)</th>
	                   							
	                   						</tr>
                   						</thead>
										<?php
											foreach($tourPriceList as $tourPrice)
											{
												
									
												
										?>
                   						<tr>
                   							<td><?=$tourPrice['start_date']?></td>
                   							<td><?=$tourPrice['end_date']?></td>
											<?php
												$discountInfo = array();
												$discountInfo = array(
															'offer'=>$tourDetail['offer'],
															'profit'=>$tourDetail['profit'],
															'price'=>$tourPrice['star3'],
															'currencyRate'=>$currencyRate
													);
												$tourPriceInfo =$objTourPrice->getPriceDetail($discountInfo);
												
											?>
                   							<td><?=$currencySymbol?><?=$tourPriceInfo['profitPrice']?> <span class="normalprice"><?=$currencySymbol?><?=$tourPriceInfo['displayPrice']?></span></td>
											<?php
												$discountInfo = array();
												$discountInfo = array(
															'offer'=>$tourDetail['offer'],
															'profit'=>$tourDetail['profit'],
															'price'=>$tourPrice['star4'],
															'currencyRate'=>$currencyRate
													);
												$tourPriceInfo =$objTourPrice->getPriceDetail($discountInfo);
											?>
                   							<td><?=$currencySymbol?><?=$tourPriceInfo['profitPrice']?> <span class="normalprice"><?=$currencySymbol?><?=$tourPriceInfo['displayPrice']?></span></td>
											<?php
												$discountInfo = array();
												$discountInfo = array(
															'offer'=>$tourDetail['offer'],
															'profit'=>$tourDetail['profit'],
															'price'=>$tourPrice['star5'],
															'currencyRate'=>$currencyRate
													);
												$tourPriceInfo =$objTourPrice->getPriceDetail($discountInfo);
												
											?>
                   							<td><?=$currencySymbol?><?=$tourPriceInfo['profitPrice']?> <span class="normalprice"><?=$currencySymbol?><?=$tourPriceInfo['displayPrice']?></span></td>
                   							
                   						</tr>
										<?php
											}
										?>
                   						
                   					</table>
                                               <br>
                                        </div>   

                                           <div class="col-lg-12" id="inclusions"></div>
                                                 <h3 class="date-subhead text-uppercase">Pricing Remarks</h3>
												 <ul>
                                                       <li>Single Room Supplement Available on Request.</li>
                                                       <li>Peak travel periods supplement may be applicable during Chrismas/New Year period (20-Dec to 05-Jan).</li>
                                                 </ul>
                                           </div>
                   				
                        </div>
                        <div class="col-lg-12">
                                          <hr class="col-lg-12">
                                          <div class="col-lg-12 Tour-Inclusions" id="">
                                             <h2 class="heading">Tour Inclusions</h2>
                                              <ul>
													<?php
														$tourInclusions = $objTour->getInclusionList($tourDetail['id']);
														foreach($tourInclusions as $tourInclusion)
														{
													?>
													<li> › <?=$tourInclusion['incexcdesc']?></li>
													<?php
														}
													?>
											  </ul>
                                          </div>

                                          <hr class="col-lg-12">
                                          <div class="col-lg-12 Tour-Inclusions">
                                             <h2 class="heading">Tour exclusions</h2>
                                              <ul>
												<?php
													$tourInclusions = $objTour->getExclusionList($tourDetail['id']);
													foreach($tourInclusions as $tourInclusion)
													{
												?>
												<li> › <?=$tourInclusion['incexcdesc']?></li>
												<?php
													}
												?>
																						
											 </ul>
                                          </div>

                                          <hr class="col-lg-12">
                                          <div class="col-lg-12 enquiry-form">
                                             <div class="p-none col-lg-12">
                                                <h2 class="heading">Enquiry Form</h2>
                                             </div>
                                             
                                             <form class="">
                                                <div class="col-lg-8 form-style-9 enquire_form">  
                                                 <div class="col-lg-6">
                                                         <input type="text" placeholder="Your Full Name" name="" class="form-control">
                                                   </div>
                                                   <div class="col-lg-6">
                                                         <input type="text" placeholder="Email Id" name="" class="form-control">
                                                   </div>
                                                   <div class="col-lg-6">
                                                         <input type="text" placeholder="Phone Number" name="" class="form-control">
                                                   </div>
                                                   <div class="col-lg-6">
                                                         <input type="text" placeholder="City & Country" name="" class="form-control">
                                                   </div>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="col-lg-12">
                                                  <h3 class="date-subhead text-capitalize">Number of Travellers</h3>
                                                </div>
                                             </div>
                                                    <div class="col-lg-6">
                                                      <div class="col-lg-12">
                                                          <div class="col-lg-4">
                                                                <label  class="blue">
                                                                      Adults (12 yrs)
                                                                </label><br>
                                                                <select class="p-4">
                                                                  <option value="">2 Adults</option>
                                                                </select>
                                                               <!--  <span class="">2 Adults <i class="fa fa-caret-down"></i></span> -->
                                                          </div>
                                                          <div class="col-lg-4">
                                                                <label  class="blue">
                                                                      Children (2-12 yrs)
                                                                </label><br>
                                                                 <select class="p-4">
                                                                  <option value="">2 Children</option>
                                                                </select>
                                                                <!-- <span class="">2 Children <i class="fa fa-caret-down"></i></span> -->
                                                          </div>
                                                          </div>
                                                          <div class="col-lg-12">
                                                          <div class="col-lg-4">
                                                                <label  class=""><br>
                                                                      Rooms Required
                                                                </label><br>
                                                                <select class="p-4">
                                                                  <option value="">2 Rooms</option>
                                                                </select>
                                                                <!-- <span class="">2 Rooms <i class="fa fa-caret-down"></i></span> -->
                                                          </div>
                                                          <div class="col-lg-4">
                                                                <label  class=""><br>
                                                                      Travel Type
                                                                </label><br>
                                                                <select class="p-4">
                                                                  <option value="">Private Travel</option>
                                                                </select>
                                                                <!-- <span class="">2 Private Travel <i class="fa fa-caret-down"></i></span> -->
                                                          </div>
                                                          </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                      <br>
                                                      <div class="col-lg-12">
                                                        <h3 class="date-subhead text-capitalize">Hotel Preference <span class="blue">(Select One)</span></h3>
                                                      </div>
                                                      <div class="col-lg-12">
                                                          <div class="pretty p-default p-round p-smooth">
                                                              <input type="radio" name="hotel" value="Luxury hotel" />
                                                              <div class="state p-primary-o">
                                                                  <label> Luxury Hotels (Best Available) </label>
                                                              </div>
                                                          </div>
                                                          <br>

                                                          <div class="pretty p-default p-round p-smooth">
                                                              <input type="radio" name="hotel" value="Deluxe hotel" />
                                                              <div class="state p-primary-o">
                                                                  <label> Deluxe Hotels (5 Star)  </label>
                                                              </div>
                                                          </div>
                                                          <br>
                                                          <div class="pretty p-default p-round p-smooth">
                                                              <input type="radio" name="hotel" value="Standard hotel" />
                                                              <div class="state p-primary-o">
                                                                  <label> Standard Hotels (4 Star) </label>
                                                              </div>
                                                          </div>           
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                      <br>
                                                      <div class="col-lg-12">
                                                        <h3 class="date-subhead text-capitalize">Arrival Date</h3>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-12">
                                                         <div class="col-lg-4">
                                                               <input type="text"  id=""  placeholder="dd/mm/yyyy" name="" class="form-control datepicker1" readonly>
                                                         </div>
                                                   </div>
                                                    <div class="col-lg-8">
                                                      <div class="col-lg-12">
                                                         <textarea class="form-control" rows="8" placeholder="Your Special Requirements:"></textarea>
                                                         </div>
                                                   </div>
                                                   <div class="text-left col-lg-12">
                                                      <div class="col-lg-12">
                                                         <button class="bg-darkblue btn btn-submit">
                                                               SUBMIT
                                                         </button>
                                                      </div>
                                                   </div>
                                             </form>
                                             
                                          </div>

                                          <hr class="col-lg-12">
                                          
                                          <div class="col-lg-12 features">
                                                <div class="col-lg-4 text-center">
                                                      <img src="<?=WEBROOT?>sagar/sgr-img/bottom-section-1.png"><br>
                                                            <h3 class="date-subhead text-uppercase">Best Selection</h3>

                                                      <ul>
                                                            <li><img src="<?=WEBROOT?>sagar/sgr-img/tick.png"> Choose between 20,000+ tours</li>
                                                            <li><img src="<?=WEBROOT?>sagar/sgr-img/tick.png"> Choose between 20,000+ tours</li>
                                                            <li><img src="<?=WEBROOT?>sagar/sgr-img/tick.png"> Choose between 20,000+ tours</li>
                                                      </ul>
                                                </div>
                                                <div class="col-lg-4 text-center">
                                                      <img src="<?=WEBROOT?>sagar/sgr-img/bottom-section-2.png"><br>
                                                            <h3 class="date-subhead text-uppercase">Best Prices</h3>
                                                      <ul>
                                                            <li><img src="<?=WEBROOT?>sagar/sgr-img/tick.png"> Never pay credit card or booking fees</li>
                                                            <li><img src="<?=WEBROOT?>sagar/sgr-img/tick.png"> Never pay credit card or booking fees</li>
                                                            <li><img src="<?=WEBROOT?>sagar/sgr-img/tick.png"> Never pay credit card or booking fees</li>
                                                      </ul>
                                                </div>
                                                <div class="col-lg-4 text-center">
                                                      <img src="<?=WEBROOT?>sagar/sgr-img/bottom-section-3.png"><br>
                                                            <h3 class="date-subhead text-uppercase">Trusted Payments</h3>
                                                      <ul>
                                                            <li><img src="<?=WEBROOT?>sagar/sgr-img/tick.png"> Trusted by thousands of satisfied travellers</li>
                                                            <li><img src="<?=WEBROOT?>sagar/sgr-img/tick.png"> Trusted by thousands of satisfied travellers</li>
                                                            <li><img src="<?=WEBROOT?>sagar/sgr-img/tick.png"> Trusted by thousands of satisfied travellers</li>
                                                      </ul>
                                                </div>

                                          </div>

                                          
                                          

                   			</div>
                     		</div>  <!-- ... end desktop view section -->
                        <div class="col-lg-4 col-lg-offset-1 visible-xs">
                                    <br>
                                    <div class="col-lg-12 p-none tripadvisor">
                                          <h2 class="heading no-bg" style="background: none; margin: 0;  padding-left: 0;">Reviews from Travelers Like you..</h2>
                                          <img src="<?=WEBROOT?>sagar/sgr-img/tripadvisor.png" alt="tripadvisor">
                                                <div class="review-wrap">
                                                      <div class="tripadvisor-review">
                                                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                                                <!-- Indicators -->
                                                                <ol class="carousel-indicators carousel-indicators-numbers">
                                                                  <li data-target="#myCarousel" data-slide-to="0" class="active">1</li>
                                                                  <li data-target="#myCarousel" data-slide-to="1">2</li>
                                                                  <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                                                </ol>

                                                                <!-- Wrapper for slides -->
                                                                <div class="carousel-inner">

                                                                  <div class="item active">
                                                                    
                                                                    <div class="carousel-caption">
                                                                    <div class="col-lg-3">
                                                                           <img src="https://media-cdn.tripadvisor.com/media/photo-l/01/2a/fd/93/avatar.jpg" class="user-review-img" width="74" height="74">
                                                                           <p class="user-review-name">Reviewer name</p>
                                                                      </div>
                                                                     
                                                                      <div class="col-lg-9 text-left">
                                                                             
                                                                            <h4 class="blackbold text-capitalize">Elegant Journeys Highly Recommended</h4>
                                                                             <span>
                                                                                          15 April, 2016 15:16
                                                                                    </span><br>
                                                                                    <div class="review-circle-wrap">
                                                                                     
                                                                                    <ul>
                                                                                          <li><img src="sgr-img/trip-review-circle.png" width="20"></li>
                                                                                          <li><img src="sgr-img/trip-review-circle.png" width="20"></li>
                                                                                          <li><img src="sgr-img/trip-review-circle.png" width="20"></li>
                                                                                          <li><img src="sgr-img/trip-review-circle.png" width="20"></li>
                                                                                          <li><img src="sgr-img/trip-review-circle.png" width="20"></li>
                                                                                    </ul>
                                                                                  
                                                                              </div>
                                                                            <p class="user-review-descr">I just want to thank you and your staff for setting up such a wonderful trip. Everything from the guides and drivers to the hotel accommodations were great. I will definitely recommend your services to anyone planning a trip to India. Thanks again for an amazing experience and memories that will last a lifetime.</p>
                                                                           <!--  <span class="extra-line">Ask Andrew about Real Journeys</span>
                                                                            <br>
                                                                            <span class="extra-button"><i class="fa fa-thumbs-up"></i> Thanks Andrew Smith</span>
                                                                            <p class="text-muted border-top-eee">
                                                                              <em>This review is the subjective opinion of a Tripadvisor member and not of Tripadvisor LLC.</em>
                                                                            </p> -->
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                  <div class="item">
                                                                    

                                                                     
                                                                    <div class="carousel-caption">
                                                                    <div class="col-lg-3">
                                                                           <img src="https://media-cdn.tripadvisor.com/media/photo-l/01/2a/fd/93/avatar.jpg" class="user-review-img" width="74" height="74">
                                                                           <p class="user-review-name">Reviewer name</p>
                                                                      </div>
                                                                     
                                                                      <div class="col-lg-9 text-left">
                                                                             
                                                                            <h4 class="blackbold text-capitalize">Elegant Journeys Highly Recommended</h4>
                                                                             <span>
                                                                                          15 April, 2016 15:16
                                                                                    </span><br>
                                                                                    <div class="review-circle-wrap">
                                                                                     
                                                                                    <ul>
                                                                                          <li><img src="sgr-img/trip-review-circle.png" width="20"></li>
                                                                                          <li><img src="sgr-img/trip-review-circle.png" width="20"></li>
                                                                                          <li><img src="sgr-img/trip-review-circle.png" width="20"></li>
                                                                                          <li><img src="sgr-img/trip-review-circle.png" width="20"></li>
                                                                                          <li><img src="sgr-img/trip-review-circle.png" width="20"></li>
                                                                                    </ul>
                                                                                  
                                                                              </div>
                                                                            <p class="user-review-descr">I just want to thank you and your staff for setting up such a wonderful trip. Everything from the guides and drivers to the hotel accommodations were great. I will definitely recommend your services to anyone planning a trip to India. Thanks again for an amazing experience and memories that will last a lifetime.</p>
                                                                           <!--  <span class="extra-line">Ask Andrew about Real Journeys</span>
                                                                            <br>
                                                                            <span class="extra-button"><i class="fa fa-thumbs-up"></i> Thanks Andrew Smith</span>
                                                                            <p class="text-muted border-top-eee">
                                                                              <em>This review is the subjective opinion of a Tripadvisor member and not of Tripadvisor LLC.</em>
                                                                            </p> -->
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                <hr>
                                                                </div>

                                                                <!-- Left and right controls -->
                                                               <!--  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                                                  <span class="glyphicon glyphicon-chevron-left"></span>
                                                                  <span class="sr-only">Previous</span>
                                                                </a>
                                                                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                                                  <span class="glyphicon glyphicon-chevron-right"></span>
                                                                  <span class="sr-only">Next</span>
                                                                </a> -->
                                                              </div>


                                                      </div>
                                                      </div>
                                    </div> <!-- review -wrap -->
                                  
                                    <div class="col-lg-12 tripadvisor p-none">
                                          <br>
                                          <h2 class="heading ">Video Testimonials</h2>
                                          <!-- <div class="video-wrap">
                                                 <div id="random_number1" class="carousel slide youtube-carousel"  data-ride="carousel" data-interval="false">
                                                        <div class="carousel-inner">
                                                          <div class="video-container item active">
                                                            <div class="youtube-video" id='AO89eXKO0c4'></div>
                                                            <div class="carousel-caption">Video 1</div>
                                                          </div>
                                                          <div class="video-container item">
                                                            <div class="youtube-video" id='6MjRVkm9CF0'></div>
                                                            <div class="carousel-caption">Video 2</div>
                                                          </div>
                                                          <div class="video-container item ">
                                                            <div class="youtube-video" id='R8poo-zCK9g'></div>
                                                            <div class="carousel-caption">Video 3</div>
                                                          </div>
                                                        </div>
                                                        <div class="controls">
                                                          <a class="left carousel-control" href="#random_number1" data-slide="prev">
                                                            <div class="left-button">
                                                              <div class="glyphicon glyphicon-chevron-left"></div>
                                                            </div>
                                                          </a>
                                                          <a class="right carousel-control" href="#random_number1" data-slide="next">        
                                                            <div class="right-button">
                                                              <div class="glyphicon glyphicon-chevron-right"></div>
                                                            </div>
                                                          </a>
                                                        </div>
                                                      </div>
                                          </div> -->
                                            <div id="video" class="carousel slide" data-ride="carousel">
                                                                <!-- Indicators -->
                                                                <ol class="carousel-indicators carousel-indicators-numbers">
                                                                  <li data-target="#video" data-slide-to="0" class="active">1</li>
                                                                  <li data-target="#video" data-slide-to="1">2</li>
                                                                  <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                                                </ol>

                                                                <!-- Wrapper for slides -->
                                                    <div class="carousel-inner">

                                                      <div class="item active">
                                                        
                                                        <iframe width="360" height="233" src="https://www.youtube.com/embed/EMpfCxPwOsk" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                      </div>
                                                      <div class="item ">
                                                        
                                                        <iframe width="360" height="233" src="https://www.youtube.com/embed/K2qjgCRkmt8" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                      </div>
                                                    
                                                    </div>

                                                              </div>
                                    </div>
                                    <br><br><br><br>
                              </div>

                   	</div>
                        
						<?php
							$relatedTourList = $objTour->getRelatedTours($tourDetail['id']);
							if(count($relatedTourList)>=1)
							{
						?>
                        <div class="strip content-holder content-boxed hidden-xs">
                              <div class="container related-tours">
                                      <div class="p-none col-lg-12">
                                                <h2 class="heading">Related Tours</h2>
                                             </div>
                               <article class="col-sm-6 col-md-4 article has-hover-s1 populartour-box m-none">
                                  <div class="thumbnail p-none">
                                            <div class="img-wrap">
                                              <img src="http://www.elegant-incentives.com/sagar/img/tour-related.jpg"
                                              height="228" width="350" alt="image description" />
                                            </div>
                                            <div class="p-10">
                                            <h3 class="small-space">
                                              <a href="8-day-golden-triangle-tour-gt-75">8 Day GT + Tigers
                                              (GT-75)</a>
                                            </h3><span class="info" style="">Delhi (2 D)→ Agra (1 Day)→
                                            Ranthambore (2 D)→ Jaipur (2 D)→</span>
                                            <p>
                                             Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.
                                            </p>
                                            
                                            <div class="footer-article">
                                              <div class="col-sm-6">
                                                <a href="http://www.elegant-incentives.com/tour/8-day-golden-triangle-tour-gt-75"
                                                class="btn view-details-new">Inquire Now</a>
                                              </div>
                                              <div class="col-sm-6">
                                                <span class="price" style="line-height:25px;font-size: 17px;font-family: 'Montserrat', sans-serif;">from <i style="text-decoration:line-through;">$620</i> <strong style="color:#1d3444;">$372</strong> / Person</span>
                                              </div>
                                            </div>
                                            </div>
                                          </div>
                                    </article> 
                                   
                                    

                              
                              </div>
                        </div>
						<?php
							}
						?>
                   </div> <!-- container-fluid -->
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
	<script src="<?=WEBROOT?>sagar/js/msdropdown/jquery.dd.min.js"></script> 
	<!-- custom script -->
<script>
//var tc;
$(document).ready(function(e) {
  $("#payments").msDropdown({visibleRows:4});
  $("#tech").msDropdown().data("dd");//{animStyle:'none'} /{animStyle:'slideDown'} {animStyle:'show'}   
  //no use
  try {
    var pages = $("#pages").msDropdown({on:{change:function(data, ui) {
                        var val = data.value;
                        if(val!="")
                          window.location = val;
                      }}}).data("dd");

    var pagename = document.location.pathname.toString();
    pagename = pagename.split("/");
    pages.setIndexByValue(pagename[pagename.length-1]);
    $("#ver").html(msBeautify.version.msDropdown);
  } catch(e) {
    //console.log(e); 
  }
  
  $("#ver").html(msBeautify.version.msDropdown);
});

</script>
      <script type="text/javascript">
                        // thumbnails.carousel.js jQuery plugin
            ;(function(window, $, undefined) {

                  var conf = {
                        center: true,
                        backgroundControl: false
                  };

                  var cache = {
                        $carouselContainer: $('.thumbnails-carousel').parent(),
                        $thumbnailsLi: $('.thumbnails-carousel li'),
                        $controls: $('.thumbnails-carousel').parent().find('.carousel-control')
                  };

                  function init() {
                        cache.$carouselContainer.find('ol.carousel-indicators').addClass('indicators-fix');
                        cache.$thumbnailsLi.first().addClass('active-thumbnail');

                        if(!conf.backgroundControl) {
                              cache.$carouselContainer.find('.carousel-control').addClass('controls-background-reset');
                        }
                        else {
                              cache.$controls.height(cache.$carouselContainer.find('.carousel-inner').height());
                        }

                        if(conf.center) {
                              cache.$thumbnailsLi.wrapAll("<div class='center clearfix'></div>");
                        }
                  }

                  function refreshOpacities(domEl) {
                        cache.$thumbnailsLi.removeClass('active-thumbnail');
                        cache.$thumbnailsLi.eq($(domEl).index()).addClass('active-thumbnail');
                  }     

                  function bindUiActions() {
                        cache.$carouselContainer.on('slide.bs.carousel', function(e) {
                              refreshOpacities(e.relatedTarget);
                        });

                        cache.$thumbnailsLi.click(function(){
                              cache.$carouselContainer.carousel($(this).index());
                        });
                  }

                  $.fn.thumbnailsCarousel = function(options) {
                        conf = $.extend(conf, options);

                        init();
                        bindUiActions();

                        return this;
                  }

            })(window, jQuery);

            $('.thumbnails-carousel').thumbnailsCarousel();
      </script>
	<script type="text/javascript">
                  $(function() {
                var header = $(".fix-strip");
                $(window).scroll(function() {    
                    var scroll = $(window).scrollTop();
                
                    if (scroll >= 435){
                        header.removeClass('fix-strip').addClass("scroll-strip");
                    } else {
                        header.removeClass("scroll-strip").addClass('fix-strip');
                    }
                });
            });

                  $(function() {
                var header = $(".video-scroll");
                $(window).scroll(function() {    
                    var scroll = $(window).scrollTop();
                
                    if (scroll >= 1000){
                        header.removeClass('video-scroll').addClass("video-fixed");
                    } else {
                        header.removeClass("video-fixed").addClass('video-scroll');
                    }
                });
            });
            </script>

            <script src="<?=WEBROOT?>sagar/js/bootstrap-datepicker.min.js">
                        var dateToday = new Date(); 
                  $(function() {
                      $( ".datepicker1" ).datepicker({
                          numberOfMonths: 3,
                          showButtonPanel: true,
                          minDate: dateToday,
                          startDate: new Date(),
                      format: 'dd-mm-yyyy',
                          autoclose: true
                      });
                  });
            </script>

            <script type="text/javascript">
             

$(document).ready(function() {
  
  var scrollLink = $('.scroll');
  
  // Smooth scrolling
  scrollLink.click(function(e) {
    e.preventDefault();
    $('body,html').animate({
      scrollTop: $(this.hash).offset().top
    }, 1000 );
  });
  
  // Active link switching
  $(window).scroll(function() {
    var scrollbarLocation = $(this).scrollTop();
    
    scrollLink.each(function() {
      
      var sectionOffset = $(this.hash).offset().top - 100;
      
      if ( sectionOffset <= scrollbarLocation ) {
        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');
      }
    })
    
  })
  
})


// ---------- readmore----------------
$(document).ready(function() {
  // Configure/customize these variables.
  var showChar = 700; // How many characters are shown by default
  var ellipsestext = "...";
  var moretext = "Read More";
  var lesstext = "Show less";

  $(".more").each(function() {
    var content = $(this).html();

    if (content.length > showChar) {
      var c = content.substr(0, showChar);
      var h = content.substr(showChar, content.length - showChar);

      var html =
        c +
        '<span class="moreellipses">' +
        ellipsestext +
        '&nbsp;</span><span class="morecontent"><span>' +
        h +
        '</span>&nbsp;&nbsp;<a href="" class="morelink btn readmore btn-shadow radius text-capitalize">' +
        moretext +
        "</a></span>";

      $(this).html(html);
    }
  });

  $(".morelink").click(function() {
    if ($(this).hasClass("less")) {
      $(this).removeClass("less");
      $(this).html(moretext);
    } else {
      $(this).addClass("less");
      $(this).html(lesstext);
    }
    $(this)
      .parent()
      .prev()
      .toggle();
    $(this)
      .prev()
      .toggle();
    return false;
  });
});

$(document).ready(function(){
    $(".morelink").click(function(){
        $(".bottom_fade").toggle(500);
    });
});

// youtube video
// Find all YouTube videos
var $allVideos = $("iframe[src^='//www.youtube.com']"),

    // The element that is fluid width
    $fluidEl = $("body");

// Figure out and save aspect ratio for each video
$allVideos.each(function() {

  $(this)
    .data('aspectRatio', this.height / this.width)

    // and remove the hard coded width/height
    .removeAttr('height')
    .removeAttr('width');

});

// When the window is resized
$(window).resize(function() {

  var newWidth = $fluidEl.width();

  // Resize all videos according to their own aspect ratio
  $allVideos.each(function() {

    var $el = $(this);
    $el
      .width(newWidth)
      .height(newWidth * $el.data('aspectRatio'));

  });

// Kick off one resize to fix all videos on page load
}).resize();
</script>

<script>
/*
	SCRIPT BY RAKESH
*/
	function displayOverview()
	{
		$('#overviewHideButton').css('display','none');
		$('#boxOverviewMore').css('display','none');
		return false;
	}

	function displayItinerary()
	{
		$('.tourDays4').css('display','block');
		$('#displayItineraryButton').css('display','none');
		return false;

	}

</script>
</body>
</html>
