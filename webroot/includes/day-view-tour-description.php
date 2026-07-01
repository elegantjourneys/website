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
												<span>Day <?=$i?></span>
												<strong class="title"><?=implode(" - ",$cityName)?></strong>
											</span>

											<div class="slide" style="position: absolute; top: -9999px; left: -9999px; width: 1113px;">
												<div class="slide-holder" style="margin-bottom:30px;">
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
														<div id="tourFirstDescription<?=$i?>" style="display:inline; margin-top:10px;"><?=$firstTourDescription?></div>




												</div>
											</div>
										</li>


										<?php
											}
										?>

									</ol>

									</div>
								</div>
