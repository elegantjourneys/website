<style>
	.btn-outline-success {
		color: #28a745;
		background-color: transparent;
		background-image: none;
		border-color: #28a745;
	}

	.btn-outline-success:hover {
		color: #28a745;
		background-color: transparent;
		background-image: none;
		border-color: #28a745;
	}

	@media only screen and (max-width: 600px) {
		.buttonText{
			display:none;
		}
	}
</style>
<div role="tabpanel" class="tab-pane" id="tab02">
									<div class="row" >
										<h2 class="main-subtitle" id="tourItinerary">Itinerary </h2>
										<ol class="detail-accordion">
										<?php
											$countItineraryDays = 0;
											 for($i=1;$i<=$crmTourBasicInformation['tourInfo']['tour_duration'];$i++)
											 {
												$crmTourDayInformations = $objCRMCMSTour->getTourDayDescription($tourDetailId,$i);

												$currentTourDay = "";

												$cityName = array();
												$activities = array();
												foreach($crmTourDayInformations as $crmTourDayInformation)
												{
													if(in_array($crmTourDayInformation['city'], $cityName))
													{
														continue;
													}

													$cityName[]=$crmTourDayInformation['city'];

													if($crmTourDayInformatio['highlight']!="")
													{
														$activities[]=$crmTourDayInformation['highlight'];
													}
													
												}


												$countItineraryDays++;
										?>
										<li class="active">
											<span style="padding-left:100px; display: block; padding: 10px 20px 10px 80px; position: relative; transition: all linear .2s; outline: none !important; color:#5c5e62; text-decoration: none;">
												<span>Day <?=$i?> [<?=implode(" - ",$cityName)?>]</span>
												<span id="areaButtonDescExpand<?=$i?>" style="display:inline-block; float:right;">
													<button  type="button" class="btn btn-outline-success" onclick="displayTourDiscription('<?=$i?>');" style="float:right; disipaly:inline;"><span class="buttonText">View Description </span><span class="glyphicon glyphicon-plus-sign"></span></button>
												</span>
												<span id="areaButtonDescHide<?=$i?>" style="display:none; float:right;">
													<button type="button" class="btn btn-outline-success" onclick="hideTourDiscription('<?=$i?>');" style="float:right; disipaly:inline;"><span class="buttonText">Hide Description </span><span class="glyphicon glyphicon-minus-sign"></span></button>
												</span>		
											</span>
											

											<div class="slide" style="position: absolute; top: -9999px; left: -9999px; width: 1113px;">
												
												<div class="slide-holder" style="margin-bottom:30px;">
													<?php 
														if(count($activities)>=1)
														{
													?>
															<div style="margin-bottom:15px;">
																<ol class="tick-list">
																	<?php
																		foreach($activities as $activity)
																		{
																	?>
																	<li><?=$activity?></li>
																	<?php
																		}
																	?>
																	
																</ol>
															</div>
													<?php
														}
													?>
												<?php
													$tourDayDescription = '';

													foreach($crmTourDayInformations as $crmTourDayInformation)
													{
														$tourDayDescription .= stripslashes($crmTourDayInformation['description']);

												?>


												<?php
													}
														if((strlen($tourDayDescription))>510)
														{
															$firstTourDescription = $tourDayDescription;
														}
														else
														{
															$firstTourDescription = $tourDayDescription;
														}

														$lastTourDescription = $tourDayDescription;
												?>
														
														<div id="tourFirstDescription<?=$i?>" style="display:inline; margin-top:10px; display:none;"><?=$firstTourDescription?></div>




												</div>
											</div>
										</li>


										<?php
											}
										?>

									</ol>

									</div>
								</div>
<script>
	function displayTourDiscription(tourDayId="")
	{
		if(tourDayId=="")
		{
			return;
		}
		
		collapseAllDescription();
		
		$('#areaButtonDescHide'+tourDayId).css('display','inline-block');
		$('#areaButtonDescExpand'+tourDayId).css('display','none');
		$("#tourFirstDescription"+tourDayId).slideDown("slow");
	}

	function hideTourDiscription(tourDayId="")
	{
		if(tourDayId=="")
		{
			return;
		}
		$("#tourFirstDescription"+tourDayId).slideUp("slow");
		$('#areaButtonDescHide'+tourDayId).css('display','none');
		$('#areaButtonDescExpand'+tourDayId).css('display','inline-block');
	}

	function collapseAllDescription()
	{
		var totalDays = <?=$crmTourBasicInformation['tourInfo']['tour_duration']?>;

		for(i=1;i<=totalDays;i++)
		{
			$("#tourFirstDescription"+i).slideUp("slow");
			$('#areaButtonDescHide'+i).css('display','none');
			$('#areaButtonDescExpand'+i).css('display','inline-block');
		}
	}
</script>
