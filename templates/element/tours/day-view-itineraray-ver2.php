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
		$cityListForDay = array();
		foreach($itineraryPlans['cities'] as $cityInfoDay)
		{
			$cityListForDay[] =  $cityInfoDay['name'];
		}
		
?>
  <tr>
	<td class="width-[10%]">Day <?=$itineraryPlans['day']?></td>
	<td class="width-[90%]">
	  <div class="accordion-item">
		<h4 class="accordion-header">
		  <button
			class="accordion-button bg-transparent shadow-none p-0"
			type="button"
			data-bs-toggle="collapse"
			data-bs-target="#itineraryAccordion1"
			aria-expanded="true"
			aria-controls="itineraryAccordion1"
		  >
			<?=implode(" - ",$cityListForDay)?>
		  </button>
		</h4>
		<div
		  id="itineraryAccordion1"
		  class="accordion-collapse collapse show"
		>
		  <div class="accordion-body p-1">
			<div>
			<?php
				foreach($itineraryPlans['events'] as $itineraryEvent)
				{
					echo $itineraryEvent['description'];
				}
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