<style>
	/* css for calender goes here */
.tdWeekDays{font-size;10px; font-weight:normal; color:#1C7896; border:1px solid #cccccc; font-family:Arial, Helvetica, sans-serif; height:35px; width:132px; text-align:center;}
.tdCalenderDays{font-size;10px; font-weight:normal; color:#000000; border:1px solid #cccccc; font-family:Arial, Helvetica, sans-serif; text-align:center; width:132px; height:100px;}

.redButtonLink{margin: 14px 4px 0 0;  padding: 7px; background-color:#B80000; color:#ffffff; min-width:120px;}
.topContactInfo{float:right; margin-top:20px; color:#ffffff; font-size:13px; font-family: Arial,Helvetica,sans-serif;}
.selectGrey{width:120px; border:1px solid #848383; height:20px;}
</style>
<?php

	$roomsData = array();
	$roomsData[]='2####0####0';
	$priceDateList[]=	$tourDate['start_date'];							
	$tourData = array(
								"event_tax"					=>	$tourPriceParameters['event_tax'],
								"vehicle_tax"				=>	$tourPriceParameters['vehicle_tax'],
								"vehicleId"					=>	$tourPriceParameters['vehicle_id'],
								"tourId"					=>	$tourDetailId,
								"noOfPerson"				=>	$tourPriceParameters['noOfPerson'],
								"mislaneous_cost_price"		=>	$tourPriceParameters['mislaneous_cost_price'],
								"profit"					=>	$tourPriceParameters['profit'],
								"discount"					=>	$tourPriceParameters['discount'],
								"selectedCurrencyCode"		=>	$tourPriceParameters['selectedCurrencyCode'],
								"number_of_room"			=>	'1',
								"rooms"						=>	$roomsData,
								"hotel_type_id"				=>	"11"
								
							);
	include_once(BASEPATH_CRM_CLASS."fare-calendar.php");
	$objFareCalendar = new FareCalendar();
	$objFareCalendar->generageLargeCalender($tourData);
?>
<div class="display_inline" style="margin-left:15px;">
							
								<h2 class="main-subtitle pull-left" style="display:inline;">Dates &amp Prices</h2><br/>
								<label class="label label-xs label-info tours-info-label">You can come any day to start your trip</label>								
								<div class="select_travel">
									<a data-fancybox="" data-type="iframe" data-src="../customize.php?tourId=<?=$tourDetail['id']?>&pageId=<?=$tourPageDetail['id']?>&slabId=<?=$tourPageDetail['discount_slab_id']?>" href="javascript:;">
										<img src="<?=WEBROOT?>img/calender_img.jpeg" height="35" width="35">
									</a>
									<span>&nbsp;</span>
									<a data-fancybox="" data-type="iframe" data-src="../customize.php?tourId=<?=$tourDetail['id']?>&pageId=<?=$tourPageDetail['id']?>&slabId=<?=$tourPageDetail['discount_slab_id']?>" href="javascript:;"><label style="text-align:right;color:#F98764;position: relative;top: 0;font-style: normal; cursor:pointer;">Select Your Travel Date</label></a>
								</div>									
							</div>
							
								


							
							

						 
							<div class="pull-right">
							<div class="display_inline">
										<span style="font-style:normal; color:#333;">Choose Currency</span>
							</div>
							<div class="border">
							<?php
								$currencyCode = $_SESSION['user_value']['selectedCurrencyCode'];
							?>
							 <select id="userSelectedCurrency" name="payments" onchange="displayPriceInSelectedCurrency();">                         
								  <option value="USD" data-image="<?=WEBROOT?>img/flags/usa.png" <?=($currencyCode=='USD')?'selected':''?>> USD</option>
								  <option value="AUD" data-image="<?=WEBROOT?>img/flags/australia.png" <?=($currencyCode=='AUD')?'selected':''?>> AUD</option>
								  <option value="EUR" data-image="<?=WEBROOT?>img/flags/euro.png" <?=($currencyCode=='EUR')?'selected':''?>> EUR</option>
								  <option value="USD" data-image="<?=WEBROOT?>img/flags/usa.png" <?=($currencyCode=='USD')?'selected':''?>> USD</option>
							  </select>
							  </div>
							 
							
							</div>






							
							
							<div class="table-container">
								<div class="table-responsive">
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th class="text-center">
													<strong>Dates</strong>
													
												</th>
												<?php
													$tourHotelIds = array();
													foreach($tourHotelList as $tourHotel)
													{

														$tourHotelIds[]=$tourHotel['id'];
												?>
												<th class="text-center">
													<div class="border_px mobile">
													<select id="payments" name="payments" style="font-size: 12px;">                         
														  <option> 3 Stars</option>
														  <option> 4 Stars</option>
														  <option> 5 Stars</option>
													  </select>
													 
													  <br>
													 </div>
													 <div class=""> <?=$tourHotel['hotel_alias']?></div>
													 <div class="display_inline mobile" style="margin-top:7px; margi">
														<i class="fa fa-flag" aria-hidden="true"></i>
																	<span>Select other Hotel Category</span>
														</div>
													 
													
												</th>
												<?php
													}
												?>
												
												
												
											</tr>
										</thead>
										<tbody>
											<?php
												
												
												$currencySign = $_SESSION['user_value']['selectedCurrencySign'];
										$tourPriceData = array(
																	"tour_id"	=>	$tourDetailId
														);
										
										$tourDateList = $objCMSTourPrice->getTourPriceDates($tourPriceData);
										$priceDateList = array();
										foreach($tourDateList as $tourDate)
										{
												$roomsData = array();
												$roomsData[]='2####0####0';
												$priceDateList[]=	$tourDate['start_date'];							
												$tourData = array(
																			"event_tax"					=>	$tourPriceParameters['event_tax'],
																			"vehicle_tax"				=>	$tourPriceParameters['vehicle_tax'],
																			"vehicleId"					=>	$tourPriceParameters['vehicle_id'],
																			"tourId"					=>	$tourDetailId,
																			"tourStartDate"				=>	$tourDate['start_date'],
																			"noOfPerson"				=>	$tourPriceParameters['noOfPerson'],
																			"mislaneous_cost_price"		=>	$tourPriceParameters['mislaneous_cost_price'],
																			"profit"					=>	$tourPriceParameters['profit'],
																			"discount"					=>	$tourPriceParameters['discount'],
																			"selectedCurrencyCode"		=>	$tourPriceParameters['selectedCurrencyCode'],
																			"number_of_room"			=>	'1',
																			"rooms"						=>	$roomsData,
																			"hotel_type_id"				=>	"2"
																			
																		);
												  
												 $costList = $objCMSCost->getTourPrice($tourData);
												
														 
											?>
											<tr>
												<td><div class="cell" style="height: 65px;"><div class="middle"><?=$tourDate['start_date']?> <br>To<br> <?=$tourDate['end_date']?> </div></div></td>
												<?php
													foreach($tourHotelList as $tourHotel)
													{
														
												?>
													
												<td  class="text-center">
													<div class="cell" style="height: 65px;">
														<?php
															if($costList[$tourHotel['id']]['price_exception']=='n')
															{
														?>
														<div class="middle priceDisplay" id="tourPrice_<?=$tourHotel['id']?>_<?=str_replace("-","_",$tourDate['start_date'])?>">
															<span><?=$currencyCode?> <?=$currencySign?><?=$costList[$tourHotel['id']]['profit_price']?></span> <br>
															<strike class="discount"><?=$currencySign?><?=$costList[$tourHotel['id']]['discount_price']?></strike>
														</div>
														<span class="priceLoader" id="tourPrice_<?=$tourHotel['id']?>_<?=str_replace("-","_",$tourDate['start_date'])?>_loader" style="display:none;"><br /><img src="<?=WEBROOT?>images/icons/ajax-loader.gif"></span>
														<?php
															}
															else
															{
														?>
															<div class="middle priceDisplay" id="tourPrice_<?=$tourHotel['id']?>_<?=str_replace("-","_",$tourDate['start_date'])?>">
															<span>Click Here to<br /><a href="#tourBookingForms">Request Price</a></span>
															</div>
															<span class="priceLoader" style="display:none;" id="tourPrice_<?=$tourHotel['id']?>_<?=str_replace("-","_",$tourDate['start_date'])?>_loader"><br /><img src="<?=WEBROOT?>images/icons/ajax-loader.gif"></span>
														<?php
															}
														?>
													</div>
												</td>
												<?php
													}
												?>
												
											</tr>
											<?php
													
												}
											?>
											

										</tbody>
									</table>
									<label class="label label-xs label-danger tours-offer-label">DEAL</label>&nbsp;&nbsp;<span style="font-size:17px;">&nbsp;All tour prices are per person on double occupancy</span>
								</div>
								
							</div>


		