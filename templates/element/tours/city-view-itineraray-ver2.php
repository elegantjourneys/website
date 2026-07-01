<table class="table w-100">
<thead>
  <tr>
	<th class="fw-semibold">Day</th>
	<th class="fw-semibold">Place</th>
  </tr>
</thead>
<tbody>
<?php
	
	foreach($data['tour_summary']['itinerary_plans'] as $itineraryPlans )
	{
		$dayTitle = 'Day '.$itineraryPlans['start_day'].'-'.$itineraryPlans['end_day'];
		
		if($itineraryPlans['start_day']==$itineraryPlans['end_day'])
		{
			$dayTitle = 'Day '.$itineraryPlans['start_day'];
		}
		
?>
  <tr>
	<td class="width-[10%]"><?=$dayTitle?></td>
	<td class="width-[90%]">
	  <div class="accordion-item">
		<h2 class="accordion-header">
		  <button
			class="accordion-button bg-transparent shadow-none p-0"
			type="button"
			data-bs-toggle="collapse"
			data-bs-target="#itineraryAccordion1"
			aria-expanded="true"
			aria-controls="itineraryAccordion1"
		  >
			<?=$itineraryPlans['city_name']?>
		  </button>
		</h2>
		<div
		  id="itineraryAccordion1"
		  class="accordion-collapse collapse show"
		>
		  <div class="accordion-body p-1">
			<div>
			<?php
				echo $itineraryPlans['description'];
			?>
			  
			</div>
			<?php //echo $this->element('tours/tour-itinerary-city-gallery'); ?>
		  </div>
		</div>
	  </div>
	</td>
  </tr>
  <?php
	}
  ?>
 
</tbody>
</table>