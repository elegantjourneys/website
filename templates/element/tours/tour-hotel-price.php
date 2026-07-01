
<section id="datesprices" class="col-lg-9 col-xl-9 col-xxl-9 col-md-11 mx-lg-auto mx-3 mb-3">
	<div class="d-lg-flex justify-content-between align-items-center">
		<div class="d-flex align-items-center">
			<div class="col wsbold font-3 blue me-lg-3">Tour Prices (2024-25)</div>
				<div class="me-lg-3 text-center text-lg-start mb-lg-0">
					<button type="button" class="lh-1 wsregular btn btn-green font-13">Sale Price</button>
				</div>
			</div>
		<div class="fake-input p-3 mb-3 col-lg-5">
			<select class="pp form-control form-bg" id="selectHotelPriceCurrency" name="" placeholder="888 888 8888" onchange="changeTourCurrencyPrice();">
				<?php
					foreach($data['master']['currency_list'] as $currency)
					{
						$selected ="";
						if($currency['default_currency'])
						{
							$currencyImage = $currency['image'];
							$selected = 'selected';
						}
						
				?>
				<option value="<?=$currency['code']?>" <?=$selected?>><?=$currency['name']?></option>
				<?php
					}
				?>
				
			</select>
			<div class="contr">
				<img src="<?=$currencyImage?>" class="img-fluid" id="hotelCurrencyFlag">
			</div>
		</div>
	</div>
	<table class="table table-bordered tt" style="width: 100%;">
		<thead>
			<tr class="table-header">
				<th class="col-lg-4 col text-center">Hotel Category</th>
				<th class="col-lg-4 col text-center">Low Season Price</th>
				<th class="col-lg-4 col text-center">High Season Price</th>
			</tr>
			</thead>
			<tbody id="areaHotelPrice">

            <?php 
               
                for($i=0;$i<count($data['tour_prices']['hotel_price']['best_price']);$i++)
		        {
                    $bestPrice = $data['tour_prices']['hotel_price']['best_price'][$i];
                    $minimumPrice = $data['tour_prices']['hotel_price']['minimum_price'][$i];

                    if($bestPrice['hotel_type_id']=='land_price')
                    {
                        continue;
                    }

                   
            ?>

    			<tr>
    				<td>
						<div class="d-flex flex-column mx-lg-4">
                            <div><?=$bestPrice['hotel_type_alias']?></div>
                            
                            <div class="d-flex">
                                <?php
                                   
                                    for($j=1;$j<=$bestPrice['hotel_rating'];$j++)
                                    {
                                ?>
                                <img src="<?=WEBROOT?>tours/image/star.png" width="15" class="img-fluid" />
                               <?php
                                    }
                                ?>
                            </div>
						</div>
					</td>
					<td>
						<div class="d-flex flex-column mx-lg-4">
							<div class="wsbold font-20"><?=$minimumPrice['currency_code']?>&nbsp;<?=$minimumPrice['profit_price']?> 
                                <span class="ps-1 text-decoration-line-through text-red"><?=$minimumPrice['currency_sign']?><?=$minimumPrice['discount_price']?></span>
                            </div>
							<div class="font-13">Per Person</div>
						</div>
					</td>
					<td>
						<div class="d-flex flex-column mx-lg-4">
                        <div class="wsbold font-20"><?=$bestPrice['currency_code']?>&nbsp;<?=$bestPrice['profit_price']?> 
                                <span class="ps-1 text-decoration-line-through text-red"><?=$bestPrice['currency_sign']?><?=$bestPrice['discount_price']?></span>
                            </div>
							<div class="font-13">Per Person</div>
						</div>
					</td>
				</tr>
            <?php
                }
            ?>
			</tbody>
		</table>
	<div>

    <p class="font-13">
		<span class="wsbold">Note:</span> The cost of this trip is calculated based on low season rates for shared twin accommodation and the mentioned services. However, the price is subject to change based on availability, currency fluctuations, and the number of travelers. For high season rates, please get in touch with us and provide your specific travel dates and preferences.
	</p>
</div>
</section>
<script>
	function changeTourCurrencyPrice()
	{
		var currencyCode= $('#selectHotelPriceCurrency').val();
		var flagUrl =  '<?=WEBROOT_REPOSITORY?>flags/'+currencyCode.toLowerCase()+".png";
		var tourPageId = '<?=$data['general']['tour_page_id']?>';
		var tourId = '<?=$data['general']['tour_id']?>';

		$.ajax({
					url: '<?=WEBROOT?>get-tour-price-by-currency',
					type: 'post',
					data: {_csrfToken:_csrfToken,currency_code:currencyCode,tour_id:tourId,tour_page_id:tourPageId},
					dataType: 'json',
					success: function(json)
					{
						if(json.result=='success')
						{
							
							var data = json.data;
							var hotelPrices = data.hotel_price;
							var bestPrice = hotelPrices.best_price;
							var minimumPrice = hotelPrices.minimum_price

							var htmlString = '';
							for(var i=0;i<minimumPrice.length; i++)
							{
								if(minimumPrice[i].hotel_type_id=='land_price')
								{
									continue;
								}

								htmlString = htmlString+'<tr>';
    							htmlString = htmlString+'<td>';
								htmlString = htmlString+'<div class="d-flex flex-column mx-lg-4">';
                            	htmlString = htmlString+'<div>'+bestPrice[i].hotel_type_alias+'</div>';
								htmlString = htmlString+'<div class="d-flex">';
                               
								for(var j=1;j<=bestPrice[i].hotel_rating;j++)
                                {
                                        htmlString = htmlString+'<img src="<?=WEBROOT?>tours/image/star.png" width="15" class="img-fluid" />';
                                }
                                htmlString = htmlString+'</div>';
								htmlString = htmlString+'</div>';
								htmlString = htmlString+'</td>';
								htmlString = htmlString+'<td>';
								htmlString = htmlString+'<div class="d-flex flex-column mx-lg-4">';
								htmlString = htmlString+'<div class="wsbold font-20">'+minimumPrice[i].currency_code+'&nbsp;'+minimumPrice[i].profit_price; 
                                htmlString = htmlString+'<span class="ps-1 text-decoration-line-through text-red">'+minimumPrice[i].currency_sign+minimumPrice[i].discount_price+'</span>';
                            	htmlString = htmlString+'</div>';
								htmlString = htmlString+'<div class="font-13">Per Person</div>';
								htmlString = htmlString+'</div>';
								htmlString = htmlString+'</td>';
								htmlString = htmlString+'<td>';
								htmlString = htmlString+'<div class="d-flex flex-column mx-lg-4">';
								htmlString = htmlString+'<div class="wsbold font-20">'+bestPrice[i].currency_code+'&nbsp;'+bestPrice[i].profit_price; 
                                htmlString = htmlString+'<span class="ps-1 text-decoration-line-through text-red">'+bestPrice[i].currency_sign+bestPrice[i].discount_price+'</span>';
                                htmlString = htmlString+'</div>';
								htmlString = htmlString+'<div class="font-13">Per Person</div>';
								htmlString = htmlString+'</div>';
								htmlString = htmlString+'</td>';
								htmlString = htmlString+'</tr>'; 
				
							}

							$('#areaHotelPrice').html(htmlString);
						}
					}
			});

			$('#hotelCurrencyFlag').attr("src", flagUrl);
	}
</script>