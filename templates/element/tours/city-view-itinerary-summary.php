<section class="col-lg-9 col-xl-9 col-xxl-9 col-md-11 mx-lg-auto mx-3 mb-3">
	<div id="itinerary" class="wsbold font-3 blue mb-3">Itinerary Summary</div>
	<?php
		
		foreach($data['tour_summary']['summary'] as $summary)
		{
			$summaryDayTitle = 'Day '.$summary['start_day'].'-'.$summary['end_day'];
		
			if($summary['start_day']==$summary['end_day'])
			{
				$summaryDayTitle = 'Day '.$summary['start_day'];
			}
			
			
	?>
	<div class="row justify-content-between mb-3 row-cols-1 row-cols-md-2 m-0">
		<div class="col grey-box p-3 position-relative"> 
			<div class="ribbon left wsbolditalic" style="top:calc(100% - 163px);--f:15px;--r:20px;background:#ececec">
				Day <?=$summary['start_day']?> to <?=$summary['end_day']?>, <?=$summary['city_name']?>
			</div>
			<p class="mt-7"><?=$summary['city_description']?></p>
		</div>
		<div class="gr ps-md-3 p-0"><img src="<?=$summary['image']?>" class="img-fluid" alt="<?=$summary['city_name']?>"></div>
	</div>
	<?php
		}
	?>
</section>
