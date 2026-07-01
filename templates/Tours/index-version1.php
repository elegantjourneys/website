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
			<div class="centered text-white text-center col-10">
				<div class="font-4 wsbold"><?=$data['general']['name']?></div>
				<div class="font-20 wsbolditalic ">We have a unique way of meeting your luxury expectations!</div>
			</div>
			<div class="p-3 bg-dark">
				<div class="col-lg-9 mx-lg-auto mx-3 d-md-flex justify-content-between text-white flx">
					<div><i class="fa-sharp fa-solid fa-circle-check" style="color: #e7eaee;"></i> Flexible Cancelation</div>
					<div><i class="fa-sharp fa-solid fa-circle-check" style="color: #e7eaee;"></i> 100% Customised Trips</div>
					<div><i class="fa-sharp fa-solid fa-circle-check" style="color: #e7eaee;"></i> No Hidden Costs</div>
					<div><i class="fa-sharp fa-solid fa-circle-check" style="color: #e7eaee;"></i> 24x7 Concierge</div>
				</div>
			</div>
		</section>
		<div class="border-bottomg my-3"></div>
		<section class="col-lg-9 mx-lg-auto mx-3 mb-3">
			
			<?php
				foreach($data['category_list'] as $categoryList)
				{
					
			?>


			<div>
				<div class="d-md-flex border shadow">
					<div class="col-md-3 col-12">
						<a href="<?=$categoryList['tour_page_url']?>">
							<img src="<?=$categoryList['image']?>" alt="" class="w-100" height="300">
							
						</a>
					</div>
					<div class="col-md-6 col-12 p-4">
						<a href="<?=$categoryList['tour_page_url']?>">
							<div class="wsbold font-20" style="color:#212529;"><?=$categoryList['name']?></div>
						</a>
						<div class="my-2 d-flex gap-2 font-14">
						<?php
							$destinationCount=1;
							foreach($categoryList['destinations'] as $destination)
							{
								if($destinationCount==1)
								{
						?>
									<div><span class="wsbold">(<?=($destination['duration']-1)?>)N</span> <?=$destination['city']?></div>
						<?php
								}
								else
								{
						?>
									<div> | <span class="wsbold"><?=($destination['duration']-1)?>N</span> <?=$destination['city']?></div>
							
						<?php
								}
								$destinationCount++;
							}
						?>
						</div>
						<div class="d-flex">
						<?php
							foreach($categoryList['specialities'] as $specialities)
							{
						?>
							<div class="trip-box"><?=$specialities?></div>
						<?php
							}
						?>
						
						</div>
					</div>
					<div class="col-md-3 col-12 p-4" style="background: #fafafa;">
						<div class="d-flex flex-column h-100">
							<div>
								<h6 class="wsbold mb-3">PACKAGE INCLUDE</h6>
								<div class="font-13"><i class="fa-solid fa-check"></i> Tour Guide</div>
								<div class="font-13"><i class="fa-solid fa-check"></i> 24x7 online support</div>
							</div>
							<div class="d-flex flex-column mt-auto align-items-center">
								<div class="text-decoration-line-through text-red">&#8377;<?=$categoryList['discount_price']?></div>
								<div class="wsbold font-23">INR <?=$categoryList['price']?></div>
								<div class="mt-3">
									<a href="<?=$categoryList['tour_page_url']?>">
										<button type="button" class="btn btn-border-o text-white">View Detail</button>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="my-3"></div>

			<?php
				}
			?>


			
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