<section id="hotels" class="col-lg-9 col-xl-9 col-xxl-9 col-md-11 mx-lg-auto mx-3 mb-3">
	<div class="wsbold font-3 blue mb-3">Hotels</div>

    <?php
        foreach($data['tour_hotels'] as $tourHotels)
        {
            
            
    ?>
		<div class="mb-5">
			<div class="font-23"><?=$tourHotels['hotel_alias_name']?></div>
				<div class="d-flex mb-3">
                    <?php
                        for($countRating=1;$countRating<=$tourHotels['hotel_rating'];$countRating++)
                        {
                    ?>
                            <img src="<?=WEBROOT?>tours/image/star.png" width="20" class="img-fluid" />
                    <?php
                        }
                    ?>
				</div>
				<table class="table table-bordered" style="width: 100%;">
					<thead>
					<tr class="table-header">
						<th class="col-2 text-center">Place</th>
						<th class="col text-center">Hotel</th>
					</tr>
					</thead>
					<tbody>
                    <?php
                        
                        foreach($tourHotels['hotels'] as $hotels)
                        {
                           
                    ?>
					<tr>
						<td class="text-center"><?=$hotels['city_name']?></th>
						<td>
    						<div class="d-flex flex-wrap gap-3 mx-4 my-2">
                                <?php
                                    foreach($hotels['hotel_list'] as $hotelList)
                                    {
                                       
                                ?>
                                
								<div class="mb-3 mb-lg-0 w-200">
									<button type="button" class="btn-border px-4 py-1">
                                        <div class="d-flex flex-column">
                                            <div><?=$hotelList['hotel_name']?></div>
                                            <div class="font-13"><?=$hotelList['room_name']?></div>
                                        </div>
									</button>
								</div>
                                <?php
                                    }
                                ?>
								
							</div>
						</td>
					</tr>
                    <?php
                        }
                    ?>
				
				</tbody>
			</table>
		</div>
    <?php
        }
    ?>



			</div>


		</section>