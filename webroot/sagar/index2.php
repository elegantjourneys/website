<?php

	include_once("includes/config.php");

	include_once(BASEPATH_CLASS."website-section-class.php");

	include_once(BASEPATH_CLASS."testimonial-video-class.php");

	include_once(BASEPATH_CLASS."travel-guide-class.php");

	include_once(BASEPATH_CLASS."testimonial-class.php");

	include_once(BASEPATH_CLASS."partners-class.php");

	include_once(BASEPATH_CLASS."tour-class.php");

	include_once(BASEPATH_CLASS."currency-class.php");

	include_once(BASEPATH_CLASS."tour-price-class.php");

	include_once(BASEPATH_CLASS."tour-area-class.php");

	

	



	$objWebsiteSection = new WebsiteSection();

	$objTestimonialVideo = new TestimonialVideo();

	$objTravelGuide = new TravelGuide();

	$objTestimonial = new Testimonial();

	$objPartners = new Partners();

	$objTour = new Tour();

	$objCurrency = new Currency();

	$objTourPrice = new TourPrice();

	$objTourArea = new TourArea();

	





	

	/*

		getting currency rate

	*/

	$currencyCode = $_SESSION['user_value']['selected_currency'];

	$currencyRate = $objCurrency->currencyRate($currencyCode);

	$currencySymbol = $objCurrency->getcurrencySymbol($currencyCode);



	

	include_once("includes/head-section1.php");

?>

<!-- link to fancybox css  -->

<link rel="stylesheet" type="text/css" href="<?=WEBROOT?>/js/fancyboxold/jquery.fancybox-1.3.4.css" media="screen" />

<!-- Meta Tags -->

<title>Golden Triangle Tours &amp; Luxury India Tours - Elegant Journeys</title>
<meta name="description" content="Please Note: No Hidden Fee ,We offers Golden Triangle Tours in India, luxury travel packages and customized options to explore and enjoy the beauty of India , Place order Today with Best Price you ever Got :)" />
<meta name="keywords" content="Golden Triangle Tours,best vacation packages,Luxury India Tours,tours of india" />
<meta name="language" content="en-us" />
<meta name="DC.Title" content="Elegant Journeys"/>
<meta http-equiv="CACHE-CONTROL" content="PUBLIC" />
<meta name="distribution" content="Global" />
<meta name="Robots" content="INDEX,FOLLOW" />
<meta name='googlebot' content='noodp,noydir,index,follow' />
<meta name='robots' content='noodp,noydir,index,follow' />
<meta name="rights" content="https://plus.google.com/u/0/+ElegantjourneysCo/posts" />
<meta property="og:title" content="Best Golden Triangle Tours & Luxury India Tour - Elegant Journeys">
<meta property="og:site_name" content="Elegant Journeys">
<meta property="og:url" content="http://www.elegantjourneys.co/">
<meta property="og:description" content="Elegant Journeys is a dedicated luxury travel agency in India offering an array of high quality services with first-hand knowledge on India tours, Bhutan tours and Nepal tours. Offering spectacular range of Rajasthan tours, Kerala tours, private north India tours, we not only plan but book trips for families, friends, couples, individuals and group tours, and ensure personalized services with great value for money. Our customized services and tailored luxury tours promise for the best travel experience in the Incredible India. ">
<meta property="fb:app_id" content="2347471856">
<meta property="og:type" content="website">

<link rel="stylesheet" type="text/css" href="slick/slick.css">
  <link rel="stylesheet" type="text/css" href="slick/slick-theme.css">
  <style type="text/css">
  	.slider {
        width: 100%;
        margin: 10px auto;
    }

    .slick-slide {
      margin: 0px 20px;
    }

    .slick-slide img {
      width: 100%;
    }

    .slick-prev:before,
    .slick-next:before {
      color: black;
    }


    .slick-slide {
      transition: all ease-in-out .3s;
      opacity: .2;
    }
    
    .slick-active {
      opacity: .5;
    }

    .slick-current {
      opacity: 1;
    }
  </style>
</head>

<body>

	

	<!-- main wrapper -->

	<div id="wrapper">

		<div class="page-wrapper">

			<!-- main header -->

			<?php include_once("includes/header.php"); ?>

			<!-- main banner -->

			<?php include_once("includes/main-banner1.php"); ?>

			<!-- main container -->

			<main id="main">

				<section class="content-block bg-white">

					<div class="container">

						<header class="content-heading">

							<h2 class="main-heading">LUXURY INDIA TOURS</h2>

							<span class="main-subtitle">Mastering the art of perfect adventure for 10+ years in the wild.</span>

							<div class="seperator"></div>
							<div class="centered" style="padding-top:0px;">

									<p class="intro"><?=$objWebsiteSection->getWebsiteSectionByCode('home_page')?></p>

								<a href="http://www.elegantjourneys.com/about-us.php" class="btn btn-info-sub btn-md btn-shadow radius">Read More</a>

							</div>
						</header>

						<div class="adventure-holder gallery-home-holder">

							<div class="row">

								<div class="col-md-6 img-block">

									<!-- gallery list -->

									<ul class="gallery-list gallery-with-icon">

									<?php

										$tourAreaList = $objTourArea->getAllTourArea();

										foreach($tourAreaList as $tourArea)

										{

									?>

										<li>

											<a href="#" class="thumbnail">

												<img src="<?=$tourArea['image']?>" height="165" width="170" alt="image description">

												<span class="hover <?=$tourArea['tour_type']?>"></span>

												<span class="info"><?=$tourArea['name']?></span>

											</a>

										</li>

									<?php

										}

									?>

									</ul>

								</div>

								<div class="col-md-6">
									<h2 class="main-heading">Trip Advisor Reviews</h2>
									<section class="slider single-item slick-slider slick-dotted" role="toolbar">
									   <div>
									     <div class="col-lg-3">
											         <img src="https://media-cdn.tripadvisor.com/media/photo-l/01/2a/fd/93/avatar.jpg" class="user-review-img" width="150">
											         <p class="user-review-name">JACK D. & FAMILY - UK</p>
										          </div>
										         
										          <div class="col-lg-9">
											          <h4>Elegant Journeys Highly Recommended</h4>
											          <p class="user-review-descr">I just want to thank you and your staff for setting up such a wonderful trip. Everything from the guides and drivers to the hotel accommodations were great. I will definitely recommend your services to anyone planning a trip to India. Thanks again for an amazing experience and memories that will last a lifetime.</p>
										          </div>

									    </div>
									    <div>
									     <div class="col-lg-3">
											         <img src="https://media-cdn.tripadvisor.com/media/photo-l/01/2a/fd/93/avatar.jpg" class="user-review-img" width="150">
											         <p class="user-review-name">JACK D. & FAMILY - UK</p>
										          </div>
										         
										          <div class="col-lg-9">
											          <h4>Elegant Journeys Highly Recommended</h4>
											          <p class="user-review-descr">I just want to thank you and your staff for setting up such a wonderful trip. Everything from the guides and drivers to the hotel accommodations were great. I will definitely recommend your services to anyone planning a trip to India. Thanks again for an amazing experience and memories that will last a lifetime.</p>
										          </div>

									    </div>
									</section>	
								</div>
									

								</div>

							</div>

						</div>

					</div>

				</section>

				<!-- special block -->

				<!--  <div class="browse-block">

					<div class="browse-destination column">

						<a href="#"><span> <img src="img/trip-advisor-logo2.png"></span></a>

					</div>

					<div class="browse-adventures column">

						<a href="#"><span>Email: sales@elegantjourneys.com</span></a>

					</div>

				</div> -->

				 

				 

				

				<!-- article list with boxed style -->

				<section class="content-block article-boxed">

					<div class="container">

						<header class="content-heading bottomMargin5">

							<h2 class="main-heading">POPULAR TOURS</h2>

							<span class="main-subtitle">We have a unique way of meeting your adventurous expectations!</span>

							<div class="seperator"></div>

						</header>

						<div class="content-holder content-boxed ">

							<div class="row db-3-col">

							<?php

									$popularTourList = $objTour->getPopularTours(6);

									foreach($popularTourList as $popularTour)

									{

							?>

							   <article class="col-sm-6 col-md-4 article has-hover-s1 populartour-box">

									<div class="thumbnail">

										<div class="img-wrap">

											<img src="<?=$objTour->getTourPicture($popularTour['id'],$popularTour['tour_image'],'359','228')?>" height="228" width="350" alt="image description">

											

										</div>

										<h3 class="small-space"><a href="<?=$popularTour['tour_url']?>"><?=$popularTour['tour_name']?></a></h3>

										

										<span class="info" style="">

										<?php

											$cityList=$objTour->getCityList($popularTour['tour_place']);

											$cityCount = 0;

											foreach($cityList as $city)

											{

												$cityCount++;

												echo str_replace("Days","D", $city);

												// if($cityCount>=3)
												if (1==2)
													
												
												{

													echo "...";

													break;

												}

												else

												{

													echo "&rarr;";

												}

											}

										?>

												

										</span>

										<aside class="meta"> </aside>

										<p><?=substr($popularTour['short_description'],0,150)?>...</p>

										
										<footer>
											<div class="col-sm-6">
											<a href="<?=WEBROOT?>tour/<?=$popularTour['tour_url']?>" class="btn view-details ">Inquire Now <i class="fa fa-angle-right"></i></a>
										</div>
										
										<div class="col-sm-6">
											
											 <?php

													$tourPrice = $objTourPrice->getMinimumPrice($popularTour['id']);

													$discountInfo = array();

													$discountInfo = array(

																			'offer'=>$popularTour['id'],

																			'profit'=>$popularTour['id'],

																			'price'=>$tourPrice,

																			'currencyRate'=>$currencyRate

																	);

													

													$tourPriceInfo =$objTourPrice->getPriceDetail($discountInfo);

													if($popularTour['offer']=='0'||$popularTour['offer']=='')

													{

										        ?>

														<span class="price">from   <strong class="gold"><?=$currencySymbol?><?=$tourPriceInfo['profitPrice']?></strong><br />

														

											<?php

													}

													else

													{

											?>

														<span class="price">from   <strong class="gold"><?=$currencySymbol?><?=$tourPriceInfo['profitPrice']?></strong><br /> 

														<i><?=$currencySymbol?><?=$tourPriceInfo['displayPrice']?></i> / person</span> 

											<?php

													}

											?>
										</div>

										</footer> 

									</div>

								</article>

								<?php

									}

								?>

								

								 

							</div>

						</div>

					</div>

				</section>

                

                <!-- article list holder -->

				<div class="content-block content-spacing">

					<div class="container">

						<header class="content-heading bottomMargin5">

							<h2 class="main-heading">VIDEO TESTIMONIALS</h2>

							<span class="main-subtitle">We have a unique way of meeting your adventurous expectations!</span>

							<div class="seperator"></div>

						</header>

						<div class="content-holder">

							<div class="row db-3-col">

							   <?php

									$videoTestimonials = $objTestimonialVideo->getRandomTestimonial(4);

									

									foreach($videoTestimonials as $videoTestimonial)

									{

								?>

								<article class="col-sm-6 col-md-3 col-xs-12 article">

									  <div class="video-wrap">

									  <a class="youtubeFrame iframe" href="https://www.youtube.com/embed/<?=$videoTestimonial['video_code']?>">

										<img src="<?=WEBROOT?>images/youtube-video/<?=$videoTestimonial['image']?>" style="height:240px; width:100%">

									  </a>

                                      <!--<iframe width="100%" height="215"  src="https://www.youtube.com/embed/<?=$videoTestimonial['video_code']?>" frameborder="0" allowfullscreen></iframe>-->

						            </div>

								</article>

								<?php

									}

								?>

							</div>

						</div>

					</div>

				</div>

                

                

				

                 <div class="container" style="text-align:right"><img src="img/ta_top_gif.gif"></div>

				<div class="testimonial-holder parallax" data-stellar-background-ratio="0.25" id="testimonial-home-page">

                    

<div class="container">

			<div id="testimonial-home-slide">

							<?php

								$testimonials = $objTestimonial->getTestimonialRandomList('3');

								foreach($testimonials as $testimonial)

								{

									if($testimonial['image']=="")

									{

										$testimonial['image']='tourist.png';

									}

							?>

							<div class="slide">

								<blockquote class="testimonial-quote">

									<!--<div class="img">

										<img src="img/tripadvisor.jpg" height="112" width="112" alt="image description">

									</div>-->

									<div class="text">

										<cite><?=$testimonial['name']?> - <?=$testimonial['country']?></cite>

										<q><?=$testimonial['text']?></q>

										<img src="img/tripadvisor.png" style="width:350px;">

									</div>

								</blockquote>

							</div>

							<?php

								}

							?>

							

						</div>

					</div>

				</div>

				<!-- partner list -->

				<article class="partner-block bottomPadding15">

					<div class="container">

						<header class="content-heading">

							<h2 class="main-heading">Our Travel Partners</h2>

							<span class="main-subtitle">People who always support and endorse our good work</span>

							<div class="seperator"></div>

						</header>

						<div class="partner-list" id="partner-slide">

						<?php

								$partners=$objPartners->getPartnersList();

								foreach($partners as $partner)

								{

						?>

							<div class="partner">

								<a href="#">

									<img width="130" src="image.php?w=130&h=150&img=partners/<?=$partner['color_image']?>" alt="image description">

									<img class="hover" width="130" src="image.php?w=130&h=150&img=partners/<?=$partner['black_white_image']?>" alt="image description">

								</a>

							</div>

						<?php

								}

						?>

							

						</div>

					</div>

				</article>

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
	<script src="slick/slick.js" type="text/javascript" charset="utf-8"></script>
 <script type="text/javascript">
    $(document).ready(function(){
   	  $('.single-item').slick({
   	//   	autoplay: true,
  		// autoplaySpeed: 2000,
  		speed: 500,
		  fade: true,
		  cssEase: 'linear'
   	  });
    });

  
  </script>

	<!-- fancybox  script -->

	<script src="http://www.elegantjourneys.com/vendors/fancybox/jquery.fancybox.js"></script>

	<link media="all" rel="stylesheet" href="http://www.elegantjourneys.com/vendors/fancybox/jquery.fancybox.css">

	<script type="text/javascript">

		$(document).ready(function () {

		    



			$(".youtubeFrame").fancybox({

				type: "iframe",

				 helpers: {

					overlay: {

					  locked: false

					}

				  }

				// other API options

			})





		});

		</script>


</body>

</html>