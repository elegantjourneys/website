<div role="tabpanel" class="tab-pane" id="tab02">
									<div class="row" >
										<h2 class="main-subtitle" id="tourItinerary">Itinerary </h2>
										<ol class="detail-accordion">
										<?php
											$tourEventList = $objCRMCMSTour->getUniqueTourEvents($tourDetailId);
											
											foreach($tourEventList as $tourEvent)
											{
												
												$tourEventData = array(
																			"tour_id"		=>		$tourDetailId,
																			"event_id"		=>		$tourEvent
																);
												$cityViewInfo = $objCRMCMSTour->getCityViewDescription($tourEventData);
												
												$topActivities = $cityViewInfo['top_activities'];
												
												
												
										?>
										<li class="active">
											<span style="padding-left:100px; display: block; padding: 10px 20px 10px 80px; position: relative; transition: all linear .2s; outline: none !important; color:#5c5e62; text-decoration: none;">
												<span>Day <?=$cityViewInfo['start_day']?><?=($cityViewInfo['start_day']!=$cityViewInfo['end_day'])?'-'.$cityViewInfo['end_day']:''?> (<?=$cityViewInfo['total_nights']?> nights)</span>
												<strong class="title"><?=$cityViewInfo['city_name']?></strong>
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
															<p><?=$cityViewInfo['city_description']?></p>
															<br>
															<h3><?=$cityViewInfo['event_name']?></h3>
															<p><?=stripslashes($cityViewInfo['tour_description'])?></p>
													</div>




												</div>
											</div>
										</li>


										<?php
											}
										?>

									</ol>

									</div>
								</div>
