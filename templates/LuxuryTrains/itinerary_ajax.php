<!-- Banner Section -->
<?php /* ?>
<section class="page-banner world-bg">
    <div class="container-fluid p-0">
        <img src="<?=WEBROOT?>trains/assets/images/the-maharajas/the-maharaja-plateform-view.jpg" 
             alt="Palace on Wheels Luxury Train" class="img-fluid w-100">
        
    </div>
	<?php
		echo $this->element('version2/luxurytrain/common/breadcrumb');
	?>
</section>
<?php */ ?>
<style>
  .slider .slick-slide {
  transform: scale(0.85);
  transition: all 0.4s ease;
  opacity: 0.9;
}

.slider .slick-center {
  transform: scale(1);
  opacity: 1;
  z-index: 2;
}
  .slider img {
  border-radius: 16px;
}

.slider .slick-slide img {
  transition: all 0.4s ease;
}
  .slider .slick-slide {
  padding: 0 10px;
}

</style>



<!-- Itinerary Section -->
<section class="itinerary-section py-5 world-bg">
  <div class="pt-5">
 <?php echo $data['general']['itinerary_desc']?>
</div>
    <div class="container">

        <h2 class="text-center font-50 cor-bold mb-2">Itinerary – <?=$data['general']['page_name']?></h2>
		
		<h1 class="text-center mb-3 cor red font-40 lh-1"><?=$data['general']['title']?> (<?=$data['general']['total_nights']?> Nights/<?=$data['general']['total_days']?> Days)</h1>
		<h2 class="text-center form-label font-20">(<?=$data['general']['city_covered']?>)</h2>
        
		
		
		<div class="accordion mt-5" id="accordionExample">

		<?php
			foreach($data['itinerary_list'] as $itinerary)
			{
				
		?>
			<!-- Day 1 -->
			<div class="accordion-item gray box mb-3">
				<h2 class="accordion-header">
					<button class="accordion-button gray cor font-20 collapsed"
							type="button"
							data-bs-toggle="collapse"
							data-bs-target="#collapse<?=$itinerary['day_count']?>">
						<span class="red cor-bold ">
							Day <?=$itinerary['day_count']?> 
							<?php
								if($itinerary['week_day']!="")
								{
							?>
									[<?=$itinerary['week_day']?>]
							<?php
								}
							?>
							:
						</span>
						<span class="accordion-heading-label">&nbsp;&nbsp;<?=$itinerary['city']?></span>
					</button>
				</h2>

				<div id="collapse<?=$itinerary['day_count']?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
					<div class="accordion-body hal-reg font-18">
						<?=$itinerary['description']?>
					</div>
				</div>
			</div>
		<?php
			}
		?>
			

</div>	
		
    </div>
</section>
