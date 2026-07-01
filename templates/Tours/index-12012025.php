<section class="mb-3">

			<div class="position-relative">

				<img src="<?=WEBROOT?>tours/image/tour-banner.png" class="img-fluid w-100" />

			</div>

			<div class="centered text-white text-center">

				<div class="font-4 wsbold">Plan a Hassel Free Tour</div>

				<div class="font-20 wsbolditalic ">We have a unique way of meeting your luxury expectations!</div>

			</div>

			<div class="p-3 bg-dark">

				<div class="col-lg-9 mx-lg-auto mx-3 d-flex justify-content-between text-white">

					<div><i class="fa-sharp fa-solid fa-circle-check" style="color: #e7eaee;"></i> Flexible Cancelation</div>

					<div><i class="fa-sharp fa-solid fa-circle-check" style="color: #e7eaee;"></i> 100% Customised Trips</div>

					<div><i class="fa-sharp fa-solid fa-circle-check" style="color: #e7eaee;"></i> No Hidden Costs</div>

					<div><i class="fa-sharp fa-solid fa-circle-check" style="color: #e7eaee;"></i> 24x7 Concierge</div>

				</div>

			</div>

		</section>

		<div class="border-bottomg my-3"></div>

		<section class="col-lg-9 mx-lg-auto mx-3 mb-3">

			<div class="wsbold font-3 blue mb-3">Discover Places & Plan Your Holidays!</div>

			<div class="row row-cols-md-3 row-cols-1 my-4 tourdd tour-zoom" id="tours-container">

				<?php 
					foreach($tourInfo as $td)
					{ 
						
				?>

				

				<div class="col p-4 px-md-2 px-3">

					

					<a href="<?=WEBROOT?>holidays-india-<?=$categoryInfo['category_url']?>/<?=$td['tour_url']?>">

					<div class="card border-0 p-3" style="background: #F1F4F7;">

						<img src="<?=WEBROOT?>tours/image/<?=$td["tour_image"]?>" class="card-img-top" alt="<?=$td["tour_name"]?>">

						<div class="card-body px-0">

							<a href="<?=WEBROOT?>/holidays-india-<?=$categoryInfo['category_url']?>/<?=$td['tour_url']?>" class="tool" data-tip="<?=$td["tour_name"]?>">

								<div class="wsbold font-20"><?=mb_strimwidth($td["tour_name"], 0, 30, '...')?></div>

							</a>

							<?php  $allTourCities = $this->Tours->getTourCityList($td["id"]); 

							

							if(!empty($allTourCities)){

							?>

							<div class="my-2 d-flex flex-wrap gap-2 font-14">

							<?php 

							$length = count($allTourCities);

							$index = 0;

							foreach($allTourCities as $cityName){ 

							$index++;

							?>

								<!--<div><span class="wsbold">2N</span> <?=$cityName?> |</div>-->

								<div><?=$cityName?> <?php if ($index !== $length) { ?>|<?php } ?></div>

								

							<?php } ?>	

							</div>

							<?php } ?>

							<?php /* ?><div class="d-flex">

								<div class="trip-box">Daily Breakfast</div>

								<div class="trip-box">Accomodations</div>

								<div class="trip-box">Camel Ride</div>

							</div>

							<?php */ ?>

						</div>

						<div class="card-body card-m">

							<div class="d-flex justify-content-between align-items-center">

								<div class="font-13"><img src="<?=WEBROOT?>tours/image/time-b.png" width="14" class="img-fluid me-1"><?=$td["tour_duration"]?> Nights</div>

								<div><a href="<?=WEBROOT?>holidays-india-<?=$categoryInfo['category_url']?>/<?=$td['tour_url']?>">

									<button type="button" class="btn btn-blue font-13 text-white">

										<img src="<?=WEBROOT?>tours/image/yellow.png" width="12" class="me-1" />View Details</button></a>

								</div>

							</div>

						</div>

					</div></a>

				</div>

				<?php } ?>

				

			</div>

			

			<div class="my-3 text-center">

				<button type="button" id="load-more" data-page="2" class="btn btn-border-o text-white" onclick="getTours();">

				    <span id="loader" style="display:none;" class="spinner-border spinner-border-sm" aria-hidden="true"></span>

                    <span role="status">Load More</span>

				</button>

			</div>

		</section>

		<div class="border-bottomg my-3"></div>

		<section class="col-lg-9 mx-lg-auto mx-3 mb-3">

			<div class="wsbold font-3 blue mb-3">Explore Vibrant Cities Across The Globe</div>

			<div class="wrapper">

				<a href="#" class="tile">

					<img src="<?=WEBROOT?>tours/image/cities/delhi.jpg" alt="" class="tile__media">

					<div class="content-details fadeIn-bottom">

						<h3 class="content-title wsbold">Delhi</h3>

					</div>

				</a>

				<a href="#" class="tile">

					<img src="<?=WEBROOT?>tours/image/cities/jaipur.jpg" alt="" class="tile__media">

					<div class="content-details fadeIn-bottom">

						<h3 class="content-title wsbold">Jaipur</h3>

					</div>

				</a>

				<a href="#" class="tile">

					<img src="<?=WEBROOT?>tours/image/cities/agra.jpg" alt="" class="tile__media">

					<div class="content-details fadeIn-bottom">

						<h3 class="content-title wsbold">Agra</h3>

					</div>

				</a>

				<a href="#" class="tile">

					<img src="<?=WEBROOT?>tours/image/cities/udaipur.jpg" alt="" class="tile__media">

					<div class="content-details fadeIn-bottom">

						<h3 class="content-title wsbold">Udaipur</h3>

					</div>

				</a>

				<a href="#" class="tile">

					<img src="<?=WEBROOT?>tours/image/cities/varanasi.jpg" alt="" class="tile__media">

					<div class="content-details fadeIn-bottom">

						<h3 class="content-title wsbold">Varanasi</h3>

					</div>

				</a>

				<a href="#" class="tile">

					<img src="<?=WEBROOT?>tours/image/cities/ranthambore.jpg" alt="" class="tile__media">

					<div class="content-details fadeIn-bottom">

						<h3 class="content-title wsbold">Ranthambore</h3>

					</div>

				</a>

				<a href="#" class="tile">

					<img src="<?=WEBROOT?>tours/image/cities/ajmer-dargha.jpg" alt="" class="tile__media">

					<div class="content-details fadeIn-bottom">

						<h3 class="content-title wsbold">Ajmer</h3>

					</div>

				</a>

				<a href="#" class="tile">

					<img src="<?=WEBROOT?>tours/image/cities/jaisalmer.jpg" alt="" class="tile__media">

					<div class="content-details fadeIn-bottom">

						<h3 class="content-title wsbold">Jaisalmer</h3>

					</div>

				</a>

		  	</div>

		</section>

	<script>	

		var categoryId = '<?= $categoryId ?>';

    	var _csrfToken = '<?= $this->request->getAttribute('csrfToken') ?>';

	    

		

		function getTours() {



         var page = document.getElementById('load-more').getAttribute('data-page');

         

         $('#loader').show(); // Show loader



		$.ajax({

			url: '<?= WEBROOT ?>tours/get_load_more_tours',

			type: 'post',

			data: {

				_csrfToken: _csrfToken,

				category_id: categoryId,

				page: page

			},

			dataType: 'json',

			success: function(json) {

				if (json.result == 'success') {

				    

				    document.getElementById('load-more').setAttribute('data-page', parseInt(page) + 1);

					var data = json.data['tour_info'];



					var displayData = '';

					

					for (i = 0; i < data.length; i++) {

						//displayData = displayData + '<tr>';

						//displayData = displayData + '<td class="align-middle">' + data[i].id + '</td>';

						

						

						

						displayData = displayData + '<div class="col p-4 px-md-2 px-3">';

					

					    displayData = displayData + '<a href="#">';

					    displayData = displayData + '<div class="card border-0 p-3" style="background: #F1F4F7;">';

						displayData = displayData + '<img src="<?=WEBROOT?>tours/image/' + data[i].tour_image + '" class="card-img-top" alt="'+ data[i].tour_image + '">';

						displayData = displayData + '<div class="card-body px-0">';

						displayData = displayData + '<a href="" class="tool" data-tip="' + data[i].tour_name + '">';

						displayData = displayData + '<div class="wsbold font-20">'+data[i].tour_name.substr(0, data[i].tour_name.lastIndexOf(' ', 30)) + '...' +'</div>';

						displayData = displayData + '</a>';

						

						<?php  $allTourCities = $this->Tours->getTourCityList($td["id"]); 

							

                        if(!empty($allTourCities)){

                        ?>

                        displayData = displayData + '<div class="my-2 d-flex flex-wrap gap-2 font-14">';

                        <?php 

                        $length = count($allTourCities);

                        $index = 0;

                        foreach($allTourCities as $cityName){ 

                        $index++;

                        ?>

                        

                        displayData = displayData + '<div>';

                        displayData = displayData + '<?=$cityName?>';

                        <?php if ($index !== $length) { ?>

                        displayData = displayData + ' |';

                        <?php } ?>

                        displayData = displayData + '</div>';

                        	

                        <?php } ?>	

                        displayData = displayData + '</div>';

                        <?php } ?>

							

						displayData = displayData + '</div>';

						displayData = displayData + '<div class="card-body card-m">';

						displayData = displayData + '<div class="d-flex justify-content-between align-items-center">';

						displayData = displayData + '<div class="font-13"><img src="<?=WEBROOT?>tours/image/time-b.png" width="14" class="img-fluid me-1">' + data[i].tour_duration + ' Nights</div>';

						displayData = displayData + '<div><a href="index.html">';

						displayData = displayData + '<button type="button" class="btn btn-blue font-13 text-white">';

						displayData = displayData + '<img src="<?=WEBROOT?>tours/image/yellow.png" width="12" class="me-1" />View Details</button></a>';

						displayData = displayData + '</div>';

						displayData = displayData + '</div>';

						displayData = displayData + '</div>';

					    displayData = displayData + '</div></a>';

				        displayData = displayData + '</div>';

						

					}

					

					 $('#tours-container').append(displayData);

					

					 $('#loader').hide(); // Hide loader

					if (!json.data['hasMore']) {

                        $('#load-more').hide();

                    }

				} else {

					alert(json.message);

					 $('#loader').hide(); // Hide loader

				}

			}

		});



	}

	</script>	