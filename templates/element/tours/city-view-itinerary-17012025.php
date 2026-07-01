<section class="col-lg-9 mx-lg-auto mx-3 mb-3"> 
	<div class="d-flex justify-content-between align-items-center">
		<div class="wsbold font-3 blue mb-3">Itinerary Details</div>
		<div class="text-decoration-underline blue">View All</div>
	</div>
	<div class="accordion" id="accordionPanelsStayOpenExample">

    <?php
        $countItinerary = 1;
		foreach($data['tour_summary']['itinerary_plans'] as $itineraryPlans)
		{
         
	?>

		<div class="accordion-item rounded-3 border-0  mb-3">
		  <h2 class="accordion-header shadow" id="panelsStayOpen-heading<?=$countItinerary?>">
			<button class="accordion-button wsbold font-20 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
				<span class="p-3 wsbolditalic"> Day <?=$itineraryPlans['start_day']?> to <?=$itineraryPlans['end_day']?>, (<?=($itineraryPlans['duration']-1)?> nights) <?=$itineraryPlans['city_name']?></span>
			</button>
		  </h2>
		  <div id="panelsStayOpen-collapse<?=$countItinerary?>" class="accordion-collapse collapse <?=($countItinerary==1)?'show':''?>" aria-labelledby="panelsStayOpen-heading<?=$countItinerary?>">
			<div class="accordion-body">
              <p><b><?=$itineraryPlans['tour_highlight']?></b></p>
			  <p><?=$itineraryPlans['description']?></p>
			</div>
		  </div>
		</div>
    <?php
            $countItinerary++;
        }
    ?>

	</div>
</section>