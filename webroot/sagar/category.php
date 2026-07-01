<?php
	include_once("includes/config.php");
	include_once(BASEPATH_CLASS."category-class.php");
	include_once(BASEPATH_CLASS."tour-class.php");
	include_once(BASEPATH_CLASS."currency-class.php");
	include_once(BASEPATH_CLASS."tour-price-class.php");

	$objCategory = new Category();
	$objTour = new Tour();
	$objCurrency = new Currency();
	$objTourPrice = new TourPrice();
	/*
		getting parameter falue
	*/
	
	$objCategory->setDatabaseConnection();
	$categoryUrl = $objCategory->filterReceivedData($_GET['categoryurl']);
	$travelType = $objCategory->filterReceivedData($_GET['travelType']);
	$minDuration = $objCategory->filterReceivedData($_GET['minTravelDuration']);
	$maxDuration = $objCategory->filterReceivedData($_GET['maxTravelDuration']);
	$minPrice = $objCategory->filterReceivedData($_GET['minTravelPrice']);
	$maxPrice = $objCategory->filterReceivedData($_GET['maxTravelPrice']);
	$objCategory->closeDBConnection();
	/*
		getting parameter ends here
	*/
	//$categoryInfo = $objCategory->getCategoryById($categoryId);
	$categoryInfo = $objCategory->getCategoryByUrl($categoryUrl);
	
	$categoryId = $categoryInfo['id'];
	$categoryDetailInfo = $objCategory->getCategoryDetailById($categoryId);
	$breadCrumbs = $objCategory->createCategoryBreadCrumb($categoryInfo);
	$categoryTourIds = $objCategory->getCategoryTours($categoryId);

	
	/*
		getting currency rate
	*/
	$currencyCode = $_SESSION['user_value']['selected_currency'];
	$currencyRate = $objCurrency->currencyRate($currencyCode);
	$currencySymbol = $objCurrency->getcurrencySymbol($currencyCode);

	$tourList = $objTour->getTours($categoryTourIds);
	$selectedCurrency = $_SESSION['user_value']['selected_currency'];

	

	include_once(BASEPATH."includes/head-section1.php");

?>
<style>
	body{
	font-family: 'Work Sans', sans-serif;
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
</style>
<link rel="stylesheet" type="text/css" href="<?=WEBROOT?>js/fancybox/jquery.fancybox.min.css">
<link rel="stylesheet" type="text/css"  href="<?=WEBROOT?>css/custom-sgr.css" />
</head>

<body>

	

	<!-- main wrapper -->

	<div id="wrapper">

		<div class="page-wrapper">

			<!-- main header -->

			<?php include_once(BASEPATH."includes/header.php"); ?>

			<!-- main banner -->

			

			<!-- main container -->

			<section id="list-view-normal" data-stellar-background-ratio="0.5" class="banner banner-inner parallax" style="background-position: 50% 0px;">
				<div class="banner-text">
					<div class="center-text">
						<div class="container">
							<h1><?=$categoryInfo['name']?></h1>
							<strong class="subtitle"><?=$categoryDetailInfo['banner_line']?></strong>
							<!-- breadcrumb -->
							<nav class="breadcrumbs">

								<ul>
									<?php
										foreach($breadCrumbs as $breadCrumb)
										{
									?>
										<li><a href="<?=$breadCrumb['link']?>"><?=$breadCrumb['text']?></a></li>
									<?php
										}
									?>
								</ul>

							</nav>
						</div>
					</div>
				</div>
			</section>   

			
 
























			<main id="main">

							











				 <div class="content-block content-sub topPadding30 bottomPadding0">
					<div class="container">
						<div class="filter-option">
							<strong class="result-info"><?=count($tourList)?> TRIPS MATCHES YOUR SEARCH CRITERIA</strong>
							<div class="layout-holder">
								<!--<div class="layout-action">
									<a href="#" class="link link-list active"><span class="icon-list"></span></a>
									<a href="#" class="link link-grid"><span class="icon-grid"></span></a>
								</div>-->
								<div class="select-holder">
									<a href="#" class="btn btn-primary btn-filter"><i class="fa fa-sliders"></i> Filter</a>
									<div class="filter-slide">
										<div class="select-col">
											<select class="filter-select" onchange="filterResult();" id="travelThemeFilter">
												<option value="0">Travel Theme</option>
												<option value="beaches" <?=($travelType=='beaches')?'selected':''?>>Beaches</option>
												<option value="heritage_culture" <?=($travelType=='heritage_culture')?'selected':''?>>Heritage and Culture</option>
												<option value="adventure_outdoors" <?=($travelType=='adventure_outdoors')?'selected':''?>>Adventure</option>
												<option value="nature_landscapes" <?=($travelType=='nature_landscapes')?'selected':''?>>Nature</option>
												<option value="wildlife_safaris" <?=($travelType=='wildlife_safaris')?'selected':''?>>Wildlife</option>
											</select>
										</div>
										<div class="select-col">
											<select class="filter-select" onchange="filterResult();" id="travelDaysFilter">
												<option value="0">Tour Duration</option>
												<option value="1to4" <?=($minDuration.'to'.$maxDuration=='1to4')?'selected':''?>>Less Than 4 Days</option>
												<option value="4to6" <?=($minDuration.'to'.$maxDuration=='4to6')?'selected':''?>>4 to 6 Days</option>
												<option value="7to10" <?=($minDuration.'to'.$maxDuration=='7to10')?'selected':''?>>7 to 10 Days</option>
												<option value="10to15" <?=($minDuration.'to'.$maxDuration=='10to15')?'selected':''?>>10 to 15 Days</option>
											</select>
										</div>
										<div class="select-col">
											<select class="filter-select" onchange="filterResult();" id="travelPriceFilter">
												<option value="0">Price Range</option>
												<option value="1to300" <?=($minPrice.'to'.$maxPrice=='1to300')?'selected':''?>><?=$currencyCode?>1 - <?=$currencyCode?>300</option>
												<option value="301to500" <?=($minPrice.'to'.$maxPrice=='301to500')?'selected':''?>><?=$currencyCode?>301 - <?=$currencyCode?>500</option>
												<option value="501to1000" <?=($minPrice.'to'.$maxPrice=='501to1000')?'selected':''?>><?=$currencyCode?>501 - <?=$currencyCode?>1000</option>
												<option value="1001to10000" <?=($minPrice.'to'.$maxPrice=='1001to10000')?'selected':''?>><?=$currencyCode?>1001 - <?=$currencyCode?>10000</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- list view -->
						<div class="content-holder list-view topMargin30 ">

							<?php
								foreach($tourList as $tour)
								{
									$tourInterests=$objTour->getTourInterestByTourId($tour['id']);
									
							?>
							<article class="article ps-rel">
								<div class="thumbnail">
									<div class="img-wrap">
										<img src="<?=$objTour->getTourPicture($tour['id'],$tour['tour_image'],'455','296')?>" height="240" width="350" alt="image description">
									</div>
									<div class="description">
										<div class="col-left">
											<label class="label label-xs label-info tour-info-label">Private Tour</label>
											<header class="heading">
												<h3><a href="<?=WEBROOT?>tour/<?=$tour['tour_url']?>">
												<?=$tour['tour_name']?></a></h3>
											</header>
                                                
                                                
                                                <div style="font-size:13px;"><span style="" class="sub-heading">Places :</span> 
													<?php
															$cityList=$objTour->getCityList($tour['tour_place']);
															$cityCount = 0;
															foreach($cityList as $city)
															{
																$cityCount++;
																echo $city;
																if($cityCount>=4)
																{
																	echo "...";
																	break;
																}
																else
																{
																	if($cityCount<count($cityList))
																	{
																		echo "&rarr;";
																	}
																}
															}
														?>
												
												</div>
                                                <div><span style="" class="sub-heading">Tour Code :</span> <?=$tour['tour_code']?></div>
                                                
                                                <div>
                                                	<!-- <span style="" class="sub-heading">Highlights :</span>  --><?=stripslashes($tour['short_description'])?>
                                                </div>
											
											

											<footer class="info-footer">
													<ul class="ico-list" style="border-right:none;">
													<?php
														if($tourInterests['adventure_outdoors']=='1')
														{
												    ?>
														<li class="pop-opener">
															<span class="icon-hiking-camping"></span>
															<div class="popup">
															Adventure &amp; Outdoors
															</div>
														</li>
													<?php
														}

														if($tourInterests['heritage_culture']=='1')
														{
													?>
														<li class="pop-opener">
														<span class="icon-egypt"></span>
														<div class="popup">
														Heritage &amp; Culture
														</div>
														</li>
													<?php
														}

														if($tourInterests['nature_landscapes']=='1')
														{
													?>
														<li class="pop-opener">
														<span class="icon-mountain"></span>
														<div class="popup">
														Nature &amp; Landscapes
														</div>
														</li>
													<?php
														}

														if($tourInterests['wildlife_safaris']=='1')
														{
													?>
														<li class="pop-opener">
														<span class="icon-big-cat"></span>
														<div class="popup">
														WildLife &amp; Safaris
														</div>
														</li>
													<?php
														}

														if($tourInterests['wine_food']=='1')
														{
													?>
														<li class="pop-opener">
														<span class="icon-food-wine"></span>
														<div class="popup">
														Wine &amp; Food
														</div>
														</li>
													<?php
														}

														if($tourInterests['beaches']=='1')
														{
													?>
														<li class="pop-opener">
														<span class="icon-beach"></span>
														<div class="popup">
														Beaches
														</div>
														</li>
													<?php
														}

													?>
													</ul>
													<!--<ul class="ico-action">
													<li>
													<a href="#"><span class="icon-share"></span></a>
													</li>
													<li>
													<a href="#"><span class="icon-favs"></span></a>
													</li>
													</ul>-->
													</footer>
											
										</div>
										
										<aside class="info-aside">
										<div class="info-day tourDuration"><?=($tour['tour_duraction']-1)?> Nights</div>
											<footer>
												<?php
													$tourPrice = $objTourPrice->getMinimumPrice($tour['id']);
													$discountInfo = array();
													$discountInfo = array(
																			'offer'=>$tour['offer'],
																			'profit'=>$tour['profit'],
																			'price'=>$tourPrice,
																			'currencyRate'=>$currencyRate
																	);
													
													$tourPriceInfo =$objTourPrice->getPriceDetail($discountInfo);
													if($tour['offer']=='0'||$tour['offer']=='')
													{
										        ?>
												<span class="price" style="line-height:25px;">from <br /> <strong style="color:#5c5e62;"><?=$currencySymbol?><?=$tourPriceInfo['displayPrice']?></strong>
												<?php
													}
													else
													{
												?>
												<span class="price" style="line-height:25px;">from <br /> <strong style="color:#5c5e62;"><?=$currencySymbol?><?=$tourPriceInfo['profitPrice']?></strong><br /><i style="text-decoration:line-through;"><?=$currencySymbol?><?=$tourPriceInfo['displayPrice']?></i></span> 
												<?php
													}
												?>
											</footer>
											
											<div class="activity-level">
												 <!--<footer class="info-footer">
													<ul class="ico-action">
														<li>
															<a href="#"><span class="icon-share"></span></a>
														</li>
														<li>
															<a href="#"><span class="icon-favs"></span></a>
														</li>
													</ul>
												</footer>-->
                                                
                                                 
											</div>
											<?php
												$lightBoxUrl = 'tourId='.$tour['id'];
												$cryptBoxUrl = $objTour->incodeUrl($lightBoxUrl);
											?>

								  <!-- ............ LAST DESIGN START ...............		 -->
											<!-- <a  data-fancybox data-type="iframe"  class="btn btn-inquire-now" data-src="../inquire.php?eid=<?=$cryptBoxUrl?>" href="javascript:;" >INQUIRE NOW</a>

                                          <a href="<?=WEBROOT?>tour/<?=$tour['tour_url']?>" class="btn btn-view-detail" style="">VIEW DETAILS</a> -->

                                   <!-- ............ / LAST DESIGN END  ...............		 -->

                                   <!-- ............ STYLE-1 DESIGN START...............		 -->
										<a href="<?=WEBROOT?>tour/<?=$tour['tour_url']?>" class="btn view-details" style="">VIEW DETAILS <i class="fa fa-angle-right"></i></a>

										<a  data-fancybox data-type="iframe"  class="btn inquire" data-src="../inquire.php?eid=<?=$cryptBoxUrl?>" href="javascript:;" >INQUIRE NOW</a>

                                                                              
                                   <!-- ............ STYLE-1 DESIGN END...............		 -->


										</aside>
									</div>
								</div>
							</article>
						<?php
								}
						?>
							 
							 
							 
						</div>
						<!-- pagination wrap -->
						<!--<nav class="pagination-wrap">

							<div class="btn-prev">
								<a href="#" aria-label="Previous">
									<span class="icon-angle-right"></span>
								</a>
							</div>
							<ul class="pagination">
								<li><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li class="active"><a href="#">4</a></li>
								<li><a href="#">5</a></li>
								<li>...</li>
								<li><a href="#">7</a></li>
							</ul>
							<div class="btn-next">
								<a href="#" aria-label="Previous">
									<span class="icon-angle-right"></span>
								</a>
							</div>
						</nav>-->
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
	<script>
		function filterResult()
		{
			var travelParameter = "";
			var travelTheme = $('#travelThemeFilter').val();
			var travelDays = $('#travelDaysFilter').val();
			var travelPrices = $('#travelPriceFilter').val();
			if(travelTheme!="0"||travelDays!="0"||travelPrices!="0")
			{
				
				if(travelTheme!="0")
				{
					travelParameter = '&'+travelParameter+"travelType="+travelTheme;
				}

				if(travelDays!="0")
				{
					var arrTravelDuration = travelDays.split('to');
					travelParameter = travelParameter+"&minTravelDuration="+arrTravelDuration[0]+'&maxTravelDuration='+arrTravelDuration[1];
				}

				if(travelPrices!="0")
				{
					var arrTravelPrice = travelPrices.split('to');
					travelParameter = '&'+travelParameter+"&minTravelPrice="+arrTravelPrice[0]+'&maxTravelPrice='+arrTravelPrice[1];
				}
			}
			<?php
				$urls = explode("?",$_SERVER['REQUEST_URI']);
			?>
			window.location='<?=$urls[0]?>'+travelParameter;

		}
		
	</script>

	
	<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="<?=WEBROOT?>js/fancybox/jquery.fancybox.min.js"></script>
	<script>
	$(document).ready(function(){ 
  $("[data-fancybox]").fancybox({
	iframe : {
		css : {
			width : '500px',
			height: '550px'
		}
	}
});
}); 
</script>
</body>

</html>