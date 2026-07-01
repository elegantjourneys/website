<?php
	$objCMSTourPrice->getStaticPriceTourHOtel($tourDetailId);
?>
<div class="display_inline" style="margin-left:15px;">
	<h2 class="main-subtitle pull-left" style="display:inline;">Dates &amp Prices</h2><br/>
</div>
<div class="pull-right">
	<div class="display_inline">
				<span style="font-style:normal; color:#333;">Choose Currency</span>
	</div>
	<div class="border">
		<?php
			$currencyCode = $_SESSION['user_value']['selectedCurrencyCode'];
		?>
		 <select id="userSelectedCurrency" name="payments" onchange="displayStaticPriceInSelectedCurrency();">                         
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
														"rooms"						=>	$roomsData
														
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
							<span class="priceLoader" style="display:none;"><br /><img src="<?=WEBROOT?>images/icons/ajax-loader.gif"></span>
							<?php
								}
								else
								{
							?>
								<div class="middle priceDisplay" id="tourPrice_<?=$tourHotel['id']?>_<?=str_replace("-","_",$tourDate['start_date'])?>">
								<span>Click Here to<br /><a href="#tourBookingForms">Request Price</a></span>
								</div>
								<span class="priceLoader" style="display:none;"><br /><img src="<?=WEBROOT?>images/icons/ajax-loader.gif"></span>
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


						