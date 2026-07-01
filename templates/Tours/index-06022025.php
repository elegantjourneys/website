<style>
	.ellipsis {
				text-overflow: ellipsis; /* enables ellipsis */
				white-space: nowrap; /* keeps the text in a single line */
				overflow: hidden; /* keeps the element from overflowing its parent */
		}
</style>

<section class="mb-3">
			<div class="position-relative">
				<img src="<?=$data['general']['image']?>" class="img-fluid w-100" />
			</div>
			<div class="centered text-white text-center">
				<div class="font-4 wsbold"><?=$data['general']['name']?></div>
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
			<div class="row row-cols-md-3 row-cols-1 my-4 tourdd">


			<?php
				foreach($data['category_list'] as $categoryList)
				{
					
			?>
				<div class="col p-4 px-md-2 px-3">
					<div class="card border-0">
						<img src="<?=$categoryList['image']?>" class="card-img-top" alt="...">
						<div class="trip-card">
							<div class="card-body">
								<a href="<?=$categoryList['tour_page_url']?>" class="tool " data-tip="<?=$categoryList['name']?>">
									<div class="wsbold font-20 ellipsis"><?=$categoryList['name']?></div>
								</a>
								<div class="my-2 d-flex gap-2 font-14">
									<?php
										$destinationCount=1;
										foreach($categoryList['destinations'] as $destination)
										{
											if($destinationCount==1)
											{
									?>
												<div><b><?=($destination['duration']-1)?></b> <?=$destination['city']?></div>
									<?php
											}
											else
											{
									?>
												| <div><b><?=($destination['duration']-1)?></b> <?=$destination['city']?></div>
									<?php
											}
											$destinationCount++;
										}
									?>
									
								</div>
								<!--<div class="d-flex">
								<?php
									foreach($categoryList['specialities'] as $specialities)
									{
								?>
									<div class="trip-box"><?=$specialities?></div>
								<?php
									}
								?>
									
								</div>-->
							</div>
							<div class="card-body card-m">
								<div class="d-flex justify-content-between align-items-center">
									<div class="font-13"><img src="<?=WEBROOT?>images/time-b.png" width="14" class="img-fluid me-1"><?=($categoryList['duration']-1)?> Nights</div>
									<div><a href="<?=$categoryList['tour_page_url']?>">
										<button type="button" class="btn btn-blue font-13 text-white">
											<img src="<?=WEBROOT?>images/yellow.png" width="12" class="me-1" />From  &#8377; 15000</button></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
				}
			?>

			









			</div>
			
		</section>
		<div class="border-bottomg my-3"></div>
		<section class="col-lg-9 mx-lg-auto mx-3 mb-3">
			<div class="wsbold font-3 blue mb-3">Explore Vibrant Cities Across The Globe</div>
			<div class="wrapper">
				<a href="#" class="tile">
					<img src="images/destinations/delhi-indiagate.png" alt="" class="tile__media">
					<div class="content-details fadeIn-bottom">
						<h3 class="content-title wsbold">Delhi</h3>
					</div>
				</a>
				<a href="#" class="tile">
					<img src="images/destinations/jaipur-hawa-mahal.png" alt="" class="tile__media">
					<div class="content-details fadeIn-bottom">
						<h3 class="content-title wsbold">Jaipur</h3>
					</div>
				</a>
				<a href="#" class="tile">
					<img src="images/destinations/agra-taj-mahal.png" alt="" class="tile__media">
					<div class="content-details fadeIn-bottom">
						<h3 class="content-title wsbold">Agra</h3>
					</div>
				</a>
				<a href="#" class="tile">
					<img src="images/destinations/udaipur-lake.jpeg" alt="" class="tile__media">
					<div class="content-details fadeIn-bottom">
						<h3 class="content-title wsbold">Udaipur</h3>
					</div>
				</a>
				<a href="#" class="tile">
					<img src="images/destinations/varanasi-ghat.png" alt="" class="tile__media">
					<div class="content-details fadeIn-bottom">
						<h3 class="content-title wsbold">Varanasi</h3>
					</div>
				</a>
				<a href="#" class="tile">
					<img src="images/destinations/ranthambore-tiger.jpg" alt="" class="tile__media">
					<div class="content-details fadeIn-bottom">
						<h3 class="content-title wsbold">Ranthambore</h3>
					</div>
				</a>
				<a href="#" class="tile">
					<img src="images/destinations/ajmer-temple.jpg" alt="" class="tile__media">
					<div class="content-details fadeIn-bottom">
						<h3 class="content-title wsbold">Ajmer</h3>
					</div>
				</a>
				<a href="#" class="tile">
					<img src="images/destinations/jaisalmer-tent.png" alt="" class="tile__media">
					<div class="content-details fadeIn-bottom">
						<h3 class="content-title wsbold">Jaisalmer</h3>
					</div>
				</a>
		  	</div>
		</section>