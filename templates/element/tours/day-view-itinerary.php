<section class="col-lg-9 col-xl-9 col-xxl-9 col-md-11 mx-lg-auto mx-3 mb-3"> 
	<div class="d-flex justify-content-between align-items-center">
		<div class="wsbold font-3 blue mb-3">Itinerary Details</div>
		<!--<div class="text-decoration-underline blue">View All</div>-->
	</div>
	<div class="accordion" id="accordionPanelsStayOpenExample">

    <?php
        $countItinerary = 1;
		foreach($data['tour_summary']['itinerary_plans'] as $itineraryPlans)
		{
			$cityList = array();
			foreach($itineraryPlans['cities'] as $cities)
			{
				$cityList[] = $cities['name'];
			}
			
	?>

		<div class="accordion-item rounded-3 border-0  mb-3">
		  <h2 class="accordion-header shadow" id="panelsStayOpen-heading<?=$countItinerary?>">
			<button class="accordion-button wsbold font-20 p-0 <?=($countItinerary>1)?'collapsed':''?>" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?=$countItinerary?>" aria-expanded="<?=($countItinerary==1)?'true':'false'?>" aria-controls="panelsStayOpen-collapse<?=$countItinerary?>">
				<span class="p-3 wsbolditalic"> Day <?=$itineraryPlans['day']?>&nbsp;&nbsp;&nbsp;<span class="h6 text-dark margin-left-2">[<?=implode("-",$cityList)?>]</span></span>
			</button>
		  </h2>
		  <div id="panelsStayOpen-collapse<?=$countItinerary?>" class="accordion-collapse collapse <?=($countItinerary==1)?'show':''?>" aria-labelledby="panelsStayOpen-heading<?=$countItinerary?>">
			<div class="accordion-body">
			  <?php
			  	foreach($itineraryPlans['events'] as $events)
				{
					
					
			  ?>
              <p><b><?=$events['highlight']?></b></p>
			  <p><?=$events['description']?></p>
			  <?php
				}
			  ?>
			</div>
		  </div>
		</div>




    <?php
            $countItinerary++;
        }
    ?>

	</div>
</section>