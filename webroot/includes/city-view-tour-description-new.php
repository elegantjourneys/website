<?php
	$tourEventList = $objCRMCMSTour->getUniqueTourEvents($tourDetailId);
?>

<div role="tabpanel" class="tab-pane" id="tab02">
									<div class="row">
										<h2 class="main-subtitle" style="padding-top:96px;">Tour Overview</h2>
										<?php

										

									   ?>
										<ul class="content-lists tick-list">
									   <?php
											foreach($tourEventList as $tourEvent)
											{
												$dataOverview = array(
																		'event_id'  => $tourEvent
																	);
												$tourActivities = $objCMSTourEvent->getEventUniqueExperience($dataOverview,'1');
												foreach($tourActivities as $tourActivity)
												{
													
										?>
												
												<li><?=$tourActivity['description']?></li>

										<?php
												}
											}
										?>
												
										</ul>
									</div>
								


								</div>
								
								
								
								
								
<h2 class="main-subtitle" style="padding-top:80px;">Itinerary Summary</h2>
<table class="table" style="margin-right:30px;">
	<thead>
	  <tr>
		<th class="col-md-2">DAY</th>
		<th class="col-md-3">PLACE</th>
		<th>Highlights</th>
	  </tr>
	</thead>
	<tbody>
	<?php
		$cityIds = array();
		foreach($tourEventList as $tourEvent)
		{
			
			$tourEventData = array(
										"tour_id"		=>		$tourDetailId,
										"event_id"		=>		$tourEvent
							);
			$tourHighlightInfo = $objCRMCMSTour->getTourHighlightForCityView($tourEventData);
			
	?>
	  <tr>
		<td><?=($tourHighlightInfo['start_day']==$tourHighlightInfo['end_day'])?$tourHighlightInfo['start_day']:$tourHighlightInfo['start_day'].'-'.$tourHighlightInfo['end_day']?></td>
		<td>
			<div style="display:flex;flex-direction:column;">
				<div style="color:#a66262"><?=$tourHighlightInfo['city_name']?></div>
				
			</div>
		</td>
		<td>
			<div style="display:flex;flex-direction:column;">
				<div> <?=$tourHighlightInfo['tour_highlight']?></div>
			</div>
		</td>
	  </tr>
	<?php
		}
	?>
	 
	</tbody>
</table>
<div role="tabpanel" class="tab-pane" id="tab02">
									<div class="row" >
										<h2 class="main-subtitle" id="tourItinerary" style="margin-top:0px !important;">Itinerary </h2>
										<ul class="detail-accordion">
										<?php
											
											
											
											$cityIds = array();
											foreach($tourEventList as $tourEvent)
											{
												
												$tourEventData = array(
																			"tour_id"		=>		$tourDetailId,
																			"event_id"		=>		$tourEvent
																);
												$cityViewInfo = $objCRMCMSTour->getCityViewDescription($tourEventData);
												
												if(in_array($cityViewInfo['city_id'],$cityIds))
												{
														$displayCityStory = false;
												}
												else
												{
													$cityIds[] =  $cityViewInfo['city_id'];
													$displayCityStory = true;
												}
												
											
											
												$topActivities = $cityViewInfo['top_activities'];
												
												
												
										?>
										<li class="active">
											<span style="padding-left:100px; display: block; padding: 10px 20px 10px 80px; position: relative; transition: all linear .2s; outline: none !important; color:#5c5e62; text-decoration: none;">
												<div style="display: inline-flex;flex-direction: column;font-weight:600">
												<span>Day <?=$cityViewInfo['start_day']?><?=($cityViewInfo['start_day']!=$cityViewInfo['end_day'])?'-'.$cityViewInfo['end_day']:''?> (<?=$cityViewInfo['total_nights']?> nights)</span>
												<strong class="title" style="/*background:linear-gradient(15deg, #9c9b9b, #5a5a5a);color:#fff;padding:5px;border-radius:10px;*/ color: #000;font-weight: 600;"><?=$cityViewInfo['city_name']?></strong>
												</div>
											</span>

											<div class="slide" style="position: absolute; top: -9999px; left: -9999px; width: 1113px;">
												<div class="slide-holder" style="margin-bottom:30px;">
														<ul class="content-list">
													<?php 
															foreach($topActivities as $topActivity)
															{
													?>
															  <li>
																<i class='<?=$topActivity['icon']?>'></i> <?=$topActivity['text']?>
															  </li>
													<?php
															}
													?>
														</ul>
														<br><br>
												
													
																								
													<div id="tourFirstDescription<?=$i?>" style="display:inline; margin-top:10px;">
														<?php
															if($displayCityStory)
															{
														?>
															<p><?=$cityViewInfo['city_description']?></p>
														<?php
															}
															if($cityViewInfo['tour_description']!="")
															{
														?>
															<br>
															<h3>Included Activities</h3>
															<p><?=stripslashes($cityViewInfo['tour_description'])?></p>
														<?php
															}
														?>
													</div>




												</div>
											</div>
										</li>


										<?php
											}
										?>

									</ul>

									</div>
								</div>
