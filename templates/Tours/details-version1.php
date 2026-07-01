<?php
	$generalData = $data['general'];

	$cityList = array();
	foreach($data['general']['destinations'] as $cities)
	{
		if(in_array($cities['city'],$cityList))
		{
			continue;
		}
		$cityList[] = $cities['city'];
	}

?>
<script>
	var _csrfToken = '<?=$this->request->getAttribute('csrfToken')?>';	
</script>
<section class="position-relative">
	<video id="video-background" preload muted crossorigin autoplay loop playsinline poster="noposter">
		<source src="<?=WEBROOT?>tours/videos/tour.mp4" type="video/mp4">
	</video>

	<div class="banner-text text-white">
		<div class="d-lg-flex d-md-flex justify-content-between">
			<div class="d-flex flex-column wsbold">
				<div class="wsbolditalic font-23 font-18"><?=$generalData['name']?></div>
					<div>
						<?php
							
								echo implode(" -> ",$cityList);
						
						?>

					</div>
						<div><?=($generalData['duration']-1)?> Nights</div>
					</div>
					<div class="text-md-start text-center">
						<div class="wsbold font-23 font-18"><?=$data['tour_prices']['base_price']['currency_code']?> <?=$data['general']['price']?> <span class="ps-1 text-decoration-line-through text-red"><?=$data['general']['discount_price']?></span></div>
						<div class="font-13">Per Person</div>
					</div>
				</div>
			</div>
			<div class="position-absolute top-img">
				<?php echo $this->element('common/breadcrumb'); ?>
				
			</div>
</section>
<div class="border-bottomg my-3"></div>
<section class="col-lg-9 col-xl-9 col-xxl-9 col-md-11 mx-lg-auto mx-3">
	<div class="mt-2">
		<div class="swiper awards-slider" style="height:100px;--swiper-wrapper-transition-timing-function:linear;">
			<div class="swiper-wrapper awards-swiper-wrapper">
				<div class="swiper-slide d-flex align-items-center justify-content-center">
				<img src="<?=WEBROOT?>tours/image/iato_new.png" alt="reward 1" class="img-fluid" style="max-height: 100%;" />
			</div>
			<div class="swiper-slide d-flex align-items-center justify-content-center">
				<img src="<?=WEBROOT?>tours/image/toftiger.png" alt="reward 2" class="img-fluid" style="max-height: 100%;" />
			</div>
			<div class="swiper-slide d-flex align-items-center justify-content-center">
				<img src="<?=WEBROOT?>tours/image/tourism.png" alt="reward 3" class="img-fluid" style="max-height: 100%;" />
			</div>
			<div class="swiper-slide d-flex align-items-center justify-content-center">
				<img src="<?=WEBROOT?>tours/image/visit-india.png" alt="reward 4" class="img-fluid" style="max-height: 100%;" />
			</div>
			<div class="swiper-slide d-flex align-items-center justify-content-center">
				<img src="<?=WEBROOT?>tours/image/header/govt.png" alt="reward 5" class="img-fluid" style="max-height: 100%;" />
			</div>
			<div class="swiper-slide d-flex align-items-center justify-content-center">
				<img src="<?=WEBROOT?>tours/image/faith.png" alt="reward 6" class="img-fluid" style="max-height: 100%;" />
			</div>
		</div>
		</div>
	</div>
</section>
<div class="border-bottomg my-3"></div>
		
		<?php echo $this->element('tours/tour-page-submenu'); ?>
		<?php echo $this->element('tours/city-view-itinerary-summary'); ?>

		<div class="border-bottomg my-3"></div>


		<?php echo $this->element('tours/customer-reviews'); ?>


		<div class="border-bottomg my-3"></div>


		<?php 
			if($data['general']['view_type']=='city_view')
			{
				echo $this->element('tours/city-view-itinerary'); 
			}
			else
			{
				
				echo $this->element('tours/day-view-itinerary'); 
			}
		?>


		<div class="border-bottomg mt-5 mb-3"></div>
		<?php echo $this->element('tours/tour-hotels'); ?>


		<div class="border-bottomg my-3"></div>

		<?php echo $this->element('tours/tour-inclusion-exclusion'); ?>

		<div class="border-bottomg my-3"></div>

		<?php echo $this->element('tours/tour-hotel-price'); ?>


		<div class="border-bottomg my-3"></div>


		<?php //echo $this->element('tours/tour-extension'); ?>
		<div class="border-bottomg my-3"></div>


		<?php echo $this->element("tours/enquiry_form"); ?>


		<div class="border-bottomg my-3"></div>
		<?php echo $this->element("tours/download-brochure"); ?>
		
		