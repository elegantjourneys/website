<?php
	$generalData = $data['general'];
	$cityList = array();

	foreach($data['general']['destinations'] as $cities)
	{
		if(in_array($cities['city'],$cityList))
		{
			continue;
		}
		$cityList[] = $cities['city'];
	}
	

?>
<script>
	var _csrfToken = '<?=$this->request->getAttribute('csrfToken')?>';	
</script>
 <div class="bottom-strip row align-items-center position-fixed start-0 bottom-0 py-3">
 	<div class="col-md-6 fw-semibold bs-fs text-start d-none d-md-block">
 		<p class="m-0" aria-label="Tour title"><?=$generalData['name']?></p>
 	</div>
 	<div class="col-md-6 fw-semibold bs-fs text-center text-md-end text-nowrap">Prices starting from
 		<span><?=$data['tour_prices']['base_price']['currency_code']?> <?=$data['general']['price']?></span>
 		<button class="btn bg-teal text-white rounded-1 ms-3" data-bs-toggle="modal" data-bs-target="#enquireModal">Enquire Now</button>
 	</div>
 </div>
 <section class="heroSection w-100 py-4">
 	<?php echo $this->element('common/breadcrumb-ver2'); ?>
 	<div class="row align-items-center">
 		<div class="col-12 col-md-6">
 			<h1 class="fs-3 fw-bold"><?=$generalData['name']?></h1>
 		</div>
 		<div class="col-12 col-md-6 text-start text-md-end mt-md-0 mt-2">
 			<!-- mark -->
 			<a href="#" class="d-inline-flex align-items-center justify-content-center rounded-pill border-teal py-2 px-4 text-black text-decoration-none btn-hover" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-upload-2-line"></i>
 				<span class="ms-2">Share</span>
 				<i class="ms-1 ri-arrow-down-s-line"></i>
 			</a>
 			<ul class="dropdown-menu">
 				<li><a class="dropdown-item d-flex align-items-center gap-2" href="#"><i class="fa-brands fa-facebook"></i> Facebook</a></li>
 				<li><a class="dropdown-item d-flex align-items-center gap-2" href="#"><i class="fa-brands fa-x-twitter"></i> Twitter</a></li>
 				<li><a class="dropdown-item d-flex align-items-center gap-2" href="#"><i class="fa-brands fa-linkedin-in"></i> LinkedIn</a></li>
 				<li><a class="dropdown-item d-flex align-items-center gap-2" href="#"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a></li>
 			</ul>
 			<a href="#" class="d-inline-flex align-items-center justify-content-center rounded-pill border-teal py-2 px-4 text-black text-decoration-none ms-1 ms-md-3 btn-hover">
 				<i class="ri-bookmark-fill"></i>
 				<span class="ms-2">Save</span>
 			</a>
 		</div>
 	</div>
 	<div class="w-100 mt-3 mt-md-2 text-secondary">
 		<p><?=implode("-",$cityList)?> · <?=($generalData['duration']-1)?> Nights</p>
 	</div>
 	<div class="row g-2">
 		<div class="col-9 col-md-6">
 			<img src="<?= WEBROOT ?>version2/assets/images/grid-img1.png" class="img-fluid w-100 h-100" alt="Large Image" />
 		</div>
 		<div class="col-3 d-flex flex-column gap-2">
 			<img src="<?= WEBROOT ?>version2/assets/images/grid-img2.png" class="img-fluid w-100" alt="Small Image 1" />
 			<img src="<?= WEBROOT ?>version2/assets/images/grid-img3.png" class="img-fluid w-100" alt="Small Image 2" />
 			<img src="<?= WEBROOT ?>version2/assets/images/grid-img5.png" class="img-fluid w-100 d-block d-md-none" alt="Small Image 2" />
 		</div>
 		<div class="col-3 d-none d-md-flex flex-column gap-2">
 			<img src="<?= WEBROOT ?>version2/assets/images/grid-img4.png" class="img-fluid w-100" alt="Small Image 3" />
 			<div class="position-relative">
 				<div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
 				<img src="<?= WEBROOT ?>version2/assets/images/grid-img5.png" class="img-fluid w-100" alt="Small Image 4" />
 				<div class="position-absolute top-50 start-50 translate-middle text-white text-center">
 					<!--<h5 class="fw-bold">+120 More</h5>                
						<p class="mb-0">View all</p>-->
 				</div>
 			</div>
 		</div>
 	</div>
 	<div class="affiliationImgContainer w-100 d-flex align-items-center justify-content-around mt-3 overflow-x-auto">
 		<img class="img-fluid" src="<?= WEBROOT ?>version2/assets/images/affiliation (1).png" alt="affiliation-img" />
 		<img class="img-fluid" src="<?= WEBROOT ?>version2/assets/images/affiliation (2).png" alt="affiliation-img" />
 		<img class="img-fluid" src="<?= WEBROOT ?>version2/assets/images/affiliation (3).png" alt="affiliation-img" />
 		<img class="img-fluid" src="<?= WEBROOT ?>version2/assets/images/affiliation (4).png" alt="affiliation-img" />
 		<img class="img-fluid" src="<?= WEBROOT ?>version2/assets/images/affiliation (5).png" alt="affiliation-img" />
 		<img class="img-fluid" src="<?= WEBROOT ?>version2/assets/images/affiliation (6).png" alt="affiliation-img" />
 	</div>
 </section>
 <section class="w-100 py-4">
 	<div class="row">
 		<div class="col-md-8">
 			<!-- Navigation -->
 			<ul id="accordionScrollSpy" class="nav nav-pills w-100 d-flex align-items-center justify-content-between gap-1 gap-sm-3 list-unstyled border-bottom px-0 px-md-4 position-sticky bg-white py-2" style="top: 90px">
 				<li class="nav-item"><a href="#spyScroll1" class="text-black text-decoration-none fs-18 nav-link px-1 py-2 px-sm-3" data-bs-target="#collapseOne">Itinerary</a></li>
 				<li class="nav-item"><a href="#spyScroll2" class="text-black text-decoration-none fs-18 nav-link px-1 px-sm-3" data-bs-target="#collapseTwo">Inclusions</a></li>
 				<li class="nav-item"><a href="#spyScroll3" class="text-black text-decoration-none fs-18 nav-link px-1 px-sm-3" data-bs-target="#collapseThree">Hotels</a></li>
 				<li class="nav-item"><a href="#spyScroll4" class="text-black text-decoration-none fs-18 nav-link px-1 px-sm-3" data-bs-target="#collapseFour">Prices</a></li>
 				<li class="btn bg-blue rounded-1 text-white d-none d-md-block fw-semibold" data-bs-toggle="modal" data-bs-target="#enquireModal">Request a Callback</li>
 			</ul>
 			<p class="w-100 text-secondary lh-lg">New Delhi is the capital of India, has been inhabited continuously since the
 				6th century BCE and has served as the capital of multiple kingdoms and empires throughout its history. In the 1920s, it
 				was redesigned by Sir Edwin Lutyens and Sir Herbert Baker. Today, Delhi is a bustling metropolis that serves as a
 				vibrant hub of international arts and culture and a thriving commercial centre.</p>
 			<div class="accordion accordion-flush scrollspy-example position-relative" id="accordionExample" data-bs-spy="scroll" data-bs-target="#accordionScrollSpy" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
 				<div class="accordion-item mt-3 border border-1" id="spyScroll1">
 					<h2 class="accordion-header bg-light-subtle">
 						<button class="accordion-button bg-transparent shadow-none fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Itinerary</button>
 					</h2>
 					<div id="collapseOne" class="accordion-collapse collapse show">
 						<div class="accordion-body">
 							<!-- Content -->
 							<div class="row">
 								<!-- Table Column -->
 								<div class="col-md-8">
 									<table class="table w-100">
 										<thead>
 											<tr>
 												<th class="fw-semibold">Day</th>
 												<th class="fw-semibold">Place</th>
 											</tr>
 										</thead>
 										<tbody>
 											<tr>
 												<td>1-1</td>
 												<td>
 													<div>
 														<p class="m-0">Delhi</p>
 													</div>
 													<div class="text-secondary lh-lg">
 														<p class="m-0">Highlights: Red Fort, Humayuns Tomb, Jama Masjid, Qutab Minar, India Gate</p>
 													</div>
 												</td>
 											</tr>
 											<tr>
 												<td>1-2</td>
 												<td>
 													<div>
 														<p class="m-0">Agra</p>
 													</div>
 													<div class="text-secondary lh-lg">
 														<p class="m-0">Highlights: Taj Mahal, Agra Fort, Fatehpur Sikri</p>
 													</div>
 												</td>
 											</tr>
 											<tr>
 												<td>1-3</td>
 												<td>
 													<div>
 														<p class="m-0">Jaipur</p>
 													</div>
 													<div class="text-secondary lh-lg">
 														<p class="m-0">Highlights: Amber Fort, City Palace, The Palace of Winds, Jantar Mantar </p>
 													</div>
 												</td>
 											</tr>
 										</tbody>
 									</table>
 									<div>
 										<span class="fs-12 text-teal cursor-[pointer]" data-bs-toggle="modal" data-bs-target="#itineraryPopup"> See Detailed Itinerary </span>
 										<div class="modal fade" id="itineraryPopup" tabindex="-1" aria-labelledby="itineraryPopupLabel" aria-hidden="true">
 											<div class="modal-dialog modal-lg">
 												<div class="modal-content">
 													<div class="modal-header">
 														<h5 class="modal-title fw-semibold" id="itineraryPopupLabel"> 3 Day Golden Triangle Tour (GT-05) </h5> <!-- <button class="btn bg-teal rounded-1 fs-12 text-white" data-bs-toggle="modal"                                  data-bs-target="#enquireModal">                                  Enquire Now                                </button> --> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 													</div>
 													<div class="modal-body"> <!-- Detailed itinerary content goes here -->
 														<table class="table w-100">
 															<thead>
 																<tr>
 																	<th class="fw-semibold">Day</th>
 																	<th class="fw-semibold">Place</th>
 																</tr>
 															</thead>
 															<tbody>
 																<tr>
 																	<td class="width-[10%]">Day 1</td>
 																	<td class="width-[90%]">
 																		<div class="accordion-item">
 																			<h2 class="accordion-header"> <button class="accordion-button bg-transparent shadow-none p-0" type="button" data-bs-toggle="collapse" data-bs-target="#itineraryAccordion1" aria-expanded="true" aria-controls="itineraryAccordion1"> Delhi </button> </h2>
 																			<div id="itineraryAccordion1" class="accordion-collapse collapse show">
 																				<div class="accordion-body p-1">
 																					<div>
 																						<p class="text-grey fs-14"> Your tour starts with your early morning pick-up from your Delhi hotel or airport and drive to the love city of Agra (approx. 4-hour drive). </p>
 																						<p class="text-grey fs-14"> Agra Sightseeing </p>
 																						<p class="text-grey fs-14"> Drive to the love city of Agra by a private chauffeur-driven vehicle.Agra, the capital of the Mughal Empire during the 16th and 17th centuries, boasts three UNESCO world heritage sites that serve as legacies from that period: the Taj Mahal, Agra Fort, and the ancient city of Fatehpur Sikri. </p>
 																						<p class="text-grey fs-14"> AFTERNOON: TOUR OF AGRA FORT AND TAJ MAHAL </p>
 																						<p class="text-grey fs-14"> Visit the Red Fort, also called as the Lal-Qila, is a red sandstone fort, built by Akbar, is admired for its splendour, architectural beauty and magnificent halls. A UNESCO World Heritage Site, the fort is the emblem of resilience, power and strength. Once the capital of the Mughal Sultanate, the citadel brags about several majestic palaces, masjids and halls; the most prominent amongst them are Macchi Bhawan, Shah Jahani Mahal, Khas Mahal, Mina Masjid, Nagina Masjid and Hall of Public Audience (Diwan-I-Am). </p>
 																						<p class="text-grey fs-14"> Enjoy a horse-drawn carriage ride to the fabled Taj Mahal, the legendary Mughal monument built in the 17th century. The Taj Mahal is one of the Seven Wonders of the World and stands tall as a memorial to the beloved queen of Emperor Shah Jahan. The spectacular white marble mausoleum is well-complimented by the sprawling gardens, royal audience halls and private chambers. </p>
 																						<p class="text-grey fs-14"> INCLUDED: Monument Entrance Fees, Decorated Horse-carriage/Battery Van ride, personal English-speaking guide and private Chauffeur-driven vehicle </p>
 																					</div>
 																					<div class="d-flex gap-2">
 																						<div class="ratio ratio-1x1 w-25"> <img src="<?= WEBROOT ?>version2/assets/images/itinerary1.webp" class="img-fluid object-fit-cover rounded" alt="Responsive image" /> </div>
 																						<div class="ratio ratio-1x1 w-25"> <img src="<?= WEBROOT ?>version2/assets/images/itinerary2.webp" class="img-fluid object-fit-cover rounded" alt="Responsive image" /> </div>
 																						<div class="ratio ratio-1x1 w-25"> <img src="<?= WEBROOT ?>version2/assets/images/itinerary3.avif" class="img-fluid object-fit-cover rounded" alt="Responsive image" /> </div>
 																						<div class="ratio ratio-1x1 w-25"> <img src="<?= WEBROOT ?>version2/assets/images/itinerary4.webp" class="img-fluid object-fit-cover rounded" alt="Responsive image" /> </div>
 																					</div>
 																				</div>
 																			</div>
 																		</div>
 																	</td>
 																</tr>
 																<tr>
 																	<td>Day 2</td>
 																	<td>
 																		<div class="accordion-item">
 																			<h2 class="accordion-header"> <button class="accordion-button collapsed bg-transparent shadow-none p-0" type="button" data-bs-toggle="collapse" data-bs-target="#itineraryAccordion2" aria-expanded="true" aria-controls="itineraryAccordion2"> Agra </button> </h2>
 																			<div id="itineraryAccordion2" class="accordion-collapse collapse">
 																				<div class="accordion-body p-1"> <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow. </div>
 																			</div>
 																		</div>
 																	</td>
 																</tr>
 																<tr>
 																	<td>Day 3</td>
 																	<td>
 																		<div class="accordion-item">
 																			<h2 class="accordion-header"> <button class="accordion-button collapsed bg-transparent shadow-none p-0" type="button" data-bs-toggle="collapse" data-bs-target="#itineraryAccordion3" aria-expanded="true" aria-controls="itineraryAccordion3"> Jaipur </button> </h2>
 																			<div id="itineraryAccordion3" class="accordion-collapse collapse">
 																				<div class="accordion-body p-1"> <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow. </div>
 																			</div>
 																		</div>
 																	</td>
 																</tr>
 															</tbody>
 														</table>
 													</div>
 												</div>
 											</div>
 										</div> <span class="fs-12 text-teal ms-4 cursor-[pointer]">Download</span>
 									</div>
 								</div> <!-- Map Column -->
 								<div class="col-md-4 position-relative"> <img src="<?= WEBROOT ?>version2/assets/images/delhi-jaipur.jpg" alt="delhi-jaipur" class="img-fluid h-100 object-fit-cover" /> <i class="ri-fullscreen-line position-absolute bottom-0 right-[17px] fontSize-[30px] cursor-[pointer]" data-bs-toggle="modal" data-bs-target="#mapModal"></i> <!-- Modal Structure -->
 									<div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
 										<div class="modal-dialog modal-dialog-centered">
 											<div class="modal-content">
 												<div class="modal-header">
 													<h5 class="m-0 fs-16 fw-semibold"> Delhi → Agra → Jaipur </h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 												</div>
 												<div class="modal-body"> <img src="<?= WEBROOT ?>version2/assets/images/delhi-jaipur.jpg" alt="delhi-jaipur" class="img-fluid rounded" /> </div>
 											</div>
 										</div>
 									</div>
 								</div>
 							</div>
 						</div>
 					</div>
 				</div>
 				<div class="accordion-item mt-3 border border-1" id="spyScroll2">
 					<h2 class="accordion-header bg-light-subtle"> <button class="accordion-button collapsed bg-transparent shadow-none fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> Inclusions </button> </h2>
 					<div id="collapseTwo" class="accordion-collapse collapse">
 						<div class="accordion-body"> <!-- Content -->
 							<?php echo $this->element('tours/ver2/tour-inclusion-exclusion'); ?>
 						</div>
 					</div>
 				</div>
 				<div class="accordion-item mt-3 border border-1" id="spyScroll3">
 					<h2 class="accordion-header bg-light-subtle"> <button class="accordion-button collapsed bg-transparent shadow-none fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> Hotels </button> </h2>
 					<div id="collapseThree" class="accordion-collapse collapse">
 						<div class="accordion-body p-0"> <!-- Nested Accordion -->
 							<div class="accordion" id="nestedAccordion"> <!-- Nested Item 1 -->
 								<div class="accordion-item border-0">
 									<h2 class="accordion-header"> <button class="accordion-button collapsed fw-semibold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#nestedCollapseOne"> Standard Hotels </button> </h2>
 									<div id="nestedCollapseOne" class="accordion-collapse collapse">
 										<div class="accordion-body">
 											<div class="w-100 border-bottom pb-2 mb-3">
 												<p class="fw-semibold p-2 rounded border-halfwhite bg-custom-gray"> Hotels in Agra </p>
 												<div class="w-100 d-flex gap-2 overflow-x-auto">
 													<div class="card clickable-card position-relative flex-shrink-0 p-0 border-0" data-title="Card Title" data-content="Card Content"> <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Heritage Luxury</span> <img src="<?= WEBROOT ?>version2/assets/images/hotel-img1.png" class="card-img-top" alt="..." />
 														<div class="card-body p-0 pt-2">
 															<p class="m-0 fw-semibold fs-14"> Howard Plaza - The Fern </p>
 															<p class="m-0 text-secondary fs-12"> Winter Green Room (CP) </p>
 														</div>
 													</div>
 												</div>
 											</div>
 											<div class="w-100 border-bottom pb-2 mt-4">
 												<p class="fw-semibold p-2 rounded border-halfwhite bg-custom-gray"> Hotels in Jaipur </p>
 												<div class="w-100 d-flex gap-2 overflow-x-auto">
 													<div class="card clickable-card position-relative flex-shrink-0 p-0 border-0" data-title="Card Title" data-content="Card Content"> <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Majestic Roots</span> <img src="<?= WEBROOT ?>version2/assets/images/pexels-pixabay-164595.jpg" class="card-img-top hotel-images" alt="..." style="width: 200px; height: 115px" />
 														<div class="card-body p-0 pt-2">
 															<p class="m-0 fw-semibold fs-14"> Howard Plaza - The Fern </p>
 															<p class="m-0 text-secondary fs-12"> Winter Green Room (CP) </p>
 														</div>
 													</div>
 													<div class="card clickable-card position-relative flex-shrink-0 p-0 border-0" data-title="Card Title" data-content="Card Content"> <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Legacy Luxe</span> <img src="<?= WEBROOT ?>version2/assets/images/pexels-pixabay-271624.jpg" class="card-img-top hotel-images" alt="..." />
 														<div class="card-body p-0 pt-2">
 															<p class="m-0 fw-semibold fs-14"> Howard Plaza - The Fern </p>
 															<p class="m-0 text-secondary fs-12"> Winter Green Room (CP) </p>
 														</div>
 													</div>
 												</div>
 											</div>
 										</div>
 									</div>
 								</div> <!-- Nested Item 2 -->
 								<div class="accordion-item border-0">
 									<h2 class="accordion-header"> <button class="accordion-button collapsed fw-semibold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#nestedCollapseTwo"> Delux Hotels </button> </h2>
 									<div id="nestedCollapseTwo" class="accordion-collapse collapse">
 										<div class="accordion-body">
 											<div class="w-100 border-bottom pb-2 mb-3">
 												<p class="fw-semibold p-2 rounded border-halfwhite bg-custom-gray"> Hotels in Agra </p>
 												<div class="w-100 d-flex gap-2 overflow-x-auto">
 													<div class="card clickable-card position-relative flex-shrink-0 p-0 border-0" data-title="Card Title" data-content="Card Content"> <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Royal Heirloom</span> <img src="<?= WEBROOT ?>version2/assets/images/pexels-pixabay-258154.jpg" class="card-img-top hotel-images" alt="..." />
 														<div class="card-body p-0 pt-2">
 															<p class="m-0 fw-semibold fs-14"> Howard Plaza - The Fern </p>
 															<p class="m-0 text-secondary fs-12"> Winter Green Room (CP) </p>
 														</div>
 													</div>
 												</div>
 											</div>
 											<div class="w-100 border-bottom pb-2 mt-4">
 												<p class="fw-semibold p-2 rounded border-halfwhite bg-custom-gray"> Hotels in Jaipur </p>
 												<div class="w-100 d-flex gap-2 overflow-x-auto">
 													<div class="card clickable-card position-relative flex-shrink-0 p-0 border-0" data-title="Card Title" data-content="Card Content" ]> <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Heritage Luxury</span> <img src="<?= WEBROOT ?>version2/assets/images/pexels-pixabay-261102.jpg" class="card-img-top hotel-images" alt="..." />
 														<div class="card-body p-0 pt-2">
 															<p class="m-0 fw-semibold fs-14"> Howard Plaza - The Fern </p>
 															<p class="m-0 text-secondary fs-12"> Winter Green Room (CP) </p>
 														</div>
 													</div>
 													<div class="card clickable-card position-relative flex-shrink-0 p-0 border-0" data-title="Card Title" data-content="Card Content" ]> <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Heritage Luxury</span> <img src="<?= WEBROOT ?>version2/assets/images/pexels-pixabay-53464.jpg" class="card-img-top hotel-images" alt="..." />
 														<div class="card-body p-0 pt-2">
 															<p class="m-0 fw-semibold fs-14"> Howard Plaza - The Fern </p>
 															<p class="m-0 text-secondary fs-12"> Winter Green Room (CP) </p>
 														</div>
 													</div>
 												</div>
 											</div>
 										</div>
 									</div>
 								</div> <!-- Nested Item 3 -->
 								<div class="accordion-item border-0">
 									<h2 class="accordion-header"> <button class="accordion-button collapsed fw-semibold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#nestedCollapseThree"> Premium Hotels </button> </h2>
 									<div id="nestedCollapseThree" class="accordion-collapse collapse">
 										<div class="accordion-body">
 											<div class="w-100 border-bottom pb-2 mb-3">
 												<p class="fw-semibold p-2 rounded border-halfwhite bg-custom-gray"> Hotels in Agra </p>
 												<div class="w-100 d-flex gap-2 overflow-x-auto">
 													<div class="card clickable-card position-relative flex-shrink-0 p-0 border-0" data-title="Card Title" data-content="Card Content" ]> <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Classic Prestige</span> <img src="<?= WEBROOT ?>version2/assets/images/pexels-pixabay-271624.jpg" class="card-img-top hotel-images" alt="..." />
 														<div class="card-body p-0 pt-2">
 															<p class="m-0 fw-semibold fs-14"> Howard Plaza - The Fern </p>
 															<p class="m-0 text-secondary fs-12"> Winter Green Room (CP) </p>
 														</div>
 													</div>
 												</div>
 											</div>
 											<div class="w-100 border-bottom pb-2 mt-4">
 												<p class="fw-semibold p-2 rounded border-halfwhite bg-custom-gray"> Hotels in Jaipur </p>
 												<div class="w-100 d-flex gap-2 overflow-x-auto">
 													<div class="card clickable-card position-relative flex-shrink-0 p-0 border-0" data-title="Card Title" data-content="Card Content" ]> <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Regal Essence </span> <img src="<?= WEBROOT ?>version2/assets/images/pexels-pixabay-164595.jpg" class="card-img-top hotel-images" alt="..." />
 														<div class="card-body p-0 pt-2">
 															<p class="m-0 fw-semibold fs-14"> Howard Plaza - The Fern </p>
 															<p class="m-0 text-secondary fs-12"> Winter Green Room (CP) </p>
 														</div>
 													</div>
 													<div class="card clickable-card position-relative flex-shrink-0 p-0 border-0" data-title="Card Title" data-content="Card Content" ]> <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Heritage Luxury</span> <img src="<?= WEBROOT ?>version2/assets/images/pexels-pixabay-258154.jpg" class="card-img-top hotel-images" alt="..." />
 														<div class="card-body p-0 pt-2">
 															<p class="m-0 fw-semibold fs-14"> Howard Plaza - The Fern </p>
 															<p class="m-0 text-secondary fs-12"> Winter Green Room (CP) </p>
 														</div>
 													</div>
 												</div>
 											</div>
 										</div>
 									</div>
 								</div> <!-- Nested Item 4 -->
 								<div class="accordion-item border-0">
 									<h2 class="accordion-header"> <button class="accordion-button collapsed fw-semibold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#nestedCollapseFour"> Luxury Hotels </button> </h2>
 									<div id="nestedCollapseFour" class="accordion-collapse collapse">
 										<div class="accordion-body">
 											<div class="w-100 border-bottom pb-2">
 												<p class="fw-semibold p-2 rounded border-halfwhite bg-custom-gray"> Hotels in Agra </p>
 												<div class="w-100 d-flex gap-2 overflow-x-auto">
 													<div class="card clickable-card position-relative flex-shrink-0 p-0 border-0" data-title="Card Title" data-content="Card Content" ]> <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Heritage Luxury</span> <img src="<?= WEBROOT ?>version2/assets/images/pexels-pixabay-258154.jpg" class="card-img-top hotel-images" alt="..." />
 														<div class="card-body p-0 pt-2">
 															<p class="m-0 fw-semibold fs-14"> Howard Plaza - The Fern </p>
 															<p class="m-0 text-secondary fs-12"> Winter Green Room (CP) </p>
 														</div>
 													</div>
 												</div>
 											</div>
 											<div class="w-100 border-bottom pb-2 mt-4">
 												<p class="fw-semibold p-2 rounded border-halfwhite bg-custom-gray"> Hotels in Jaipur </p>
 												<div class="w-100 d-flex gap-2 overflow-x-auto">
 													<div class="card clickable-card position-relative flex-shrink-0 p-0 border-0" data-title="Card Title" data-content="Card Content" ]> <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Royal Heirloom</span> <img src="<?= WEBROOT ?>version2/assets/images/pexels-pixabay-271624.jpg" class="card-img-top hotel-images" alt="..." />
 														<div class="card-body p-0 pt-2">
 															<p class="m-0 fw-semibold fs-14"> Howard Plaza - The Fern </p>
 															<p class="m-0 text-secondary fs-12"> Winter Green Room (CP) </p>
 														</div>
 													</div>
 													<div class="card clickable-card position-relative flex-shrink-0 p-0 border-0" data-title="Card Title" data-content="Card Content" ]> <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Classic Prestige</span> <img src="<?= WEBROOT ?>version2/assets/images/pexels-pixabay-164595.jpg" class="card-img-top hotel-images" alt="..." />
 														<div class="card-body p-0 pt-2">
 															<p class="m-0 fw-semibold fs-14"> Howard Plaza - The Fern </p>
 															<p class="m-0 text-secondary fs-12"> Winter Green Room (CP) </p>
 														</div>
 													</div>
 												</div>
 											</div>
 										</div>
 									</div>
 								</div>
 							</div> <!-- End Nested Accordion -->
 						</div>
 					</div>
 				</div>
 				<div class="accordion-item mt-3 border border-1" id="spyScroll4">
 					<h2 class="accordion-header bg-light-subtle"> <button class="accordion-button collapsed bg-transparent shadow-none fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"> Price <div id="priceDropdown" class="btn btn-sm dropdown-toggle border border-1 ms-3 z-5" type="button" data-bs-toggle="dropdown" aria-expanded="false"> 🏳️‍🌈 INR <ul class="dropdown-menu">
 									<li><a class="dropdown-item" href="#">USD</a></li>
 									<li><a class="dropdown-item" href="#">EURO</a></li>
 									<li><a class="dropdown-item" href="#">INR</a></li>
 								</ul>
 							</div> </button> </h2>
 					<div id="collapseFour" class="accordion-collapse collapse">
 						<div class="accordion-body p-2"> <!-- Content -->
 							<table class="table border-bottom">
 								<thead>
 									<tr>
 										<th class="fw-semibold">Tour Category</th>
 										<th class="fw-semibold">High Season</th>
 										<th class="fw-semibold">Low Season</th>
 									</tr>
 								</thead>
 								<tbody>
 									<tr>
 										<td class="fs-14">Oberoi Luxury</td>
 										<td class="fs-14">
 											<p class="m-0 text-success fw-semibold"> INR 267,344 </p>
 											<p class="m-0 text-decoration-line-through text-danger"> INR 267,344 </p>
 										</td>
 										<td class="fs-14">
 											<p class="m-0 text-success fw-semibold"> INR 155,802 </p>
 											<p class="m-0 text-decoration-line-through text-danger"> INR 155,802 </p>
 										</td>
 									</tr>
 									<tr>
 										<td class="fs-14">Opulent Palaces</td>
 										<td class="fs-14">
 											<p class="m-0 text-success fw-semibold"> INR 309,856 </p>
 											<p class="m-0 text-decoration-line-through text-danger"> INR 309,856 </p>
 										</td>
 										<td class="fs-14 text-muted">Contact For Price</td>
 									</tr>
 									<tr>
 										<td class="fs-14">Oberoi Luxury</td>
 										<td class="fs-14">
 											<p class="m-0 text-success fw-semibold"> INR 267,344 </p>
 											<p class="m-0 text-decoration-line-through text-danger"> INR 267,344 </p>
 										</td>
 										<td class="fs-14">
 											<p class="m-0 text-success fw-semibold"> INR 155,802 </p>
 											<p class="m-0 text-decoration-line-through text-danger"> INR 155,802 </p>
 										</td>
 									</tr>
 									<tr>
 										<td class="fs-14">Opulent Palaces</td>
 										<td class="fs-14">
 											<p class="m-0 text-success fw-semibold"> INR 309,856 </p>
 											<p class="m-0 text-decoration-line-through text-danger"> INR 309,856 </p>
 										</td>
 										<td class="fs-14">
 											<p class="m-0 text-success fw-semibold"> INR 204,044 </p>
 											<p class="m-0 text-decoration-line-through text-danger"> INR 204,044 </p>
 										</td>
 									</tr>
 								</tbody>
 							</table>
 							<p class="mt-2 text-muted fs-12 lh-base"> <strong class="text-black">Note:</strong> The cost of this trip is calculated based on double or twin shared accommodation and for the mentioned services on a per person basis. However, the price may change depending on availability, currency fluctuations, and the number of travelers. For festive periods, holiday weekends, or peak seasons, please contact us with your specific travel dates. </p>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 		<div class="col-md-4 d-none d-md-block">
 			<div class="position-sticky" style="top: 100px">
 				<div id="reviewCarousel" class="carousel slide border border-1 rounded-1 p-2 mt-2 bg-white" data-bs-ride="carousel">
 					<div class="carousel-inner"> <!-- Review 1 -->
 						<div class="carousel-item active">
 							<div class="card border-0 mx-auto width-[80%]">
 								<div class="card-body">
 									<div class="d-flex align-items-center justify-content-start gap-3 mb-2"> <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" class="w-25 rounded-circle shadow-1-strong" />
 										<div>
 											<h5 class="fw-normal fs-14 m-0">Elizabeth R</h5>
 											<h5 class="fw-normal fs-14 m-1">Alexandria, VA</h5>
 										</div>
 									</div>
 									<ul class="list-unstyled d-flex justify-content-start m-0">
 										<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 										<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 										<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 										<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 										<li> <i class="fas fa-star-half-alt fa-sm text-teal"></i> </li>
 									</ul>
 									<p class="m-0 fw-semibold"> Perfection -- do not hesitate </p>
 									<p class="mt-2 m-0 fw-normal truncate-4 review"> <i class="fas fa-quote-left pe-2"></i>Visiting India was a lifelong dream. A friend recommended Elegant Journeys and our high expectations were exceeded. Mr. Vivek Wadhawan is extremely responsive to requests and organizes incredible, customized trips. The positive difference between a private trip like this (at your own pace, in your own comfortable car) and a big tour cannot be overemphasized. tenetur. </p> <!-- <a class="text-primary toggle-btn" onclick="toggleTruncate(this)">See                      More</a> --> <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#reviewModal" data-name="Elizabeth R" data-location="Alexandria, VA" data-image="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" data-rating="4.5" data-title="Perfection -- do not hesitate" data-review="Visiting India was a lifelong dream. A friend recommended Elegant Journeys and our high expectations were exceeded. Mr. Vivek Wadhawan is extremely responsive to requests and organizes incredible, customized trips. The positive difference between a private trip like this (at your own pace, in your own comfortable car) and a big tour cannot be overemphasized. tenetur."> See More </a> <span class="fs-12 fw-light">Written 2 May 2024</span>
 								</div>
 							</div>
 						</div> <!-- Review 2 -->
 						<div class="carousel-item">
 							<div class="card border-0 mx-auto width-[80%]">
 								<div class="card-body">
 									<div class="d-flex align-items-center justify-content-start gap-3 mb-2"> <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" class="w-25 rounded-circle shadow-1-strong" />
 										<div>
 											<h5 class="fw-normal fs-14 m-0">Jenny T</h5>
 											<h5 class="fw-normal fs-14 m-1"> St Leonards, Australia </h5>
 										</div>
 									</div>
 									<ul class="list-unstyled d-flex justify-content-start m-0">
 										<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 										<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 										<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 										<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 										<li> <i class="fas fa-star-half-alt fa-sm text-teal"></i> </li>
 									</ul>
 									<p class="m-0 fw-semibold">BEYOND MY EXPECTATIONS</p>
 									<p class="mt-2 m-0 fw-normal truncate-4 review"> <i class="fas fa-quote-left pe-2"></i>Absolutely everything. My expectations were exceeded far & away more than I thought. Perfection from day 1 to day 14. Amazing itinerary, the best driver, wonderful guides, sublime accommodation. tenetur. </p> <!-- <a class="text-primary toggle-btn" onclick="toggleTruncate(this)">See                      More</a> --> <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#reviewModal" data-name="Jenny T" data-location="St Leonards, Australia" data-image="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" data-rating="4.5" data-title="BEYOND MY EXPECTATIONS" data-review="Absolutely everything. My expectations were exceeded far & away more than I thought. Perfection from day 1 to day 14. Amazing itinerary, the best driver, wonderful guides, sublime accommodation. tenetur."> See More </a> <span class="fs-12 fw-light">Written Apr 2023</span>
 								</div>
 							</div>
 						</div> <!-- Review 3 -->
 						<div class="carousel-item">
 							<div class="card border-0 mx-auto width-[80%]">
 								<div class="card-body">
 									<div class="d-flex align-items-center justify-content-start gap-3 mb-2"> <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" class="w-25 rounded-circle shadow-1-strong" />
 										<div>
 											<h5 class="fw-normal fs-14 m-0">Melissa E</h5>
 											<h5 class="fw-normal fs-14 m-1">Westport, CT</h5>
 										</div>
 									</div>
 									<ul class="list-unstyled d-flex justify-content-start m-0">
 										<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 										<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 										<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 										<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 										<li> <i class="fas fa-star-half-alt fa-sm text-teal"></i> </li>
 									</ul>
 									<p class="m-0 fw-semibold"> Excellent India Tour Operator </p>
 									<p class="mt-2 m-0 fw-normal truncate-4 review"> <i class="fas fa-quote-left pe-2"></i>Elegant Journeys is a five-star tour company headed by Vivek Wadhawan. He is on top of very single issue. Tours are custom-made, and private. Vivek meets you personally at the beginning of the tour and he sends a company representative to every city we visited. </p> <!-- <a class="text-primary toggle-btn" onclick="toggleTruncate(this)" data-state="collapsed">See                      More</a> --> <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#reviewModal" data-name="Melissa E" data-location="Westport, CT" data-image="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" data-rating="4.5" data-title="Excellent India Tour Operator" data-review="Elegant Journeys is a five-star tour company headed by Vivek Wadhawan. He is on top of very single issue. Tours are custom-made, and private. Vivek meets you personally at the beginning of the tour and he sends a company representative to every city we visited."> See More </a> <span class="fs-12 fw-light">Written 2 Jun 2019</span>
 								</div>
 							</div>
 						</div> <!-- Carousel Controls --> <button class="carousel-control-prev" type="button" data-bs-target="#reviewCarousel" data-bs-slide="prev"> <span class="carousel-control-prev-icon border border-1 rounded-2"></span> </button> <button class="carousel-control-next" type="button" data-bs-target="#reviewCarousel" data-bs-slide="next"> <span class="carousel-control-next-icon border border-1 rounded-2"></span> </button>
 					</div>
 				</div>
 				<div class="w-100 border border-1 rounded-1 px-2 py-3 mt-2 bg-white">
 					<h5 class="fw-semibold">Videos</h5>
 					<div class="w-100 d-flex gap-2 overflow-x-auto">
 						<div class="col-10"> <video class="w-100 h-auto" controls>
 								<source src="https://www.elegantjourneys.com/repositery/video/gemma.mp4" type="video/mp4" /> Your browser does not support the video tag.
 							</video> </div>
 						<div class="col-10"> <video class="w-100 h-auto" controls>
 								<source src="https://www.elegantjourneys.com/repositery/video/gemma.mp4" type="video/mp4" /> Your browser does not support the video tag.
 							</video> </div>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </section>
 <section class="w-100 py-4">
 	<div class="w-100 d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
 		<div>
 			<h5 class="fw-semibold">Reviews</h5>
 			<p class="text-secondary"> Don't take it from us - here's what people have to say about this operator </p>
 		</div>
 		<div> <i class="remixIcon ri-arrow-left-s-line border border-1 p-1 rounded-1" onclick="moveReviewCards('left')"></i> <i class="remixIcon ri-arrow-right-s-line border border-1 p-1 rounded-1 ms-2" onclick="moveReviewCards('right')"></i> </div>
 	</div>
 	<div class="row flex-nowrap mt-2 overflow-hidden" id="reviewContainer">
 		<div class="col-sm-4 col-md-3" id="reviewCard">
 			<div class="card">
 				<div class="card-body">
 					<div class="d-flex align-items-center justify-content-start gap-3 mb-2"> <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" class="w-25 rounded-circle shadow-1-strong" />
 						<div>
 							<h5 class="fw-normal fs-14 m-0">Elizabeth R</h5>
 							<h5 class="fw-normal fs-14 m-1">Alexandria, VA</h5>
 						</div>
 					</div>
 					<ul class="list-unstyled d-flex justify-content-start m-0">
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star-half-alt fa-sm text-teal"></i> </li>
 					</ul>
 					<p class="m-0 fw-semibold">Perfection -- do not hesitate</p>
 					<p class="mt-2 m-0 fw-normal truncate-4 review"> <i class="fas fa-quote-left pe-2"></i>Visiting India was a lifelong dream. A friend recommended Elegant Journeys and our high expectations were exceeded. Mr. Vivek Wadhawan is extremely responsive to requests and organizes incredible, customized trips. </p> <!-- <a class="text-primary toggle-btn" onclick="toggleTruncate(this)" data-state="collapsed">See More</a> --> <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#reviewModal" data-name="Elizabeth R" data-location="Alexandria, VA" data-image="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" data-rating="4.5" data-title="Perfection -- do not hesitate" data-review="Visiting India was a lifelong dream. A friend recommended Elegant Journeys and our high expectations were exceeded. Mr. Vivek Wadhawan is extremely responsive to requests and organizes incredible, customized trips."> See More </a> <span class="fs-12 fw-light">Written May 2024</span>
 				</div>
 			</div>
 		</div>
 		<div class="col-sm-4 col-md-3">
 			<div class="card">
 				<div class="card-body">
 					<div class="d-flex align-items-center justify-content-start gap-3 mb-2"> <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" class="w-25 rounded-circle shadow-1-strong" />
 						<div>
 							<h5 class="fw-normal fs-14 m-0">gumchiu</h5>
 							<h5 class="fw-normal fs-14 m-1">Hong Kong</h5>
 						</div>
 					</div>
 					<ul class="list-unstyled d-flex justify-content-start m-0">
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star-half-alt fa-sm text-teal"></i> </li>
 					</ul>
 					<p class="m-0 fw-semibold">Our 2nd incredible India</p>
 					<p class="mt-2 m-0 fw-normal truncate-4 review"> <i class="fas fa-quote-left pe-2"></i>We had an incredible holiday in India organised by Elegant Journey Mr Vivek 11th years ago, I’m so glad we ask Mr Vivek to helped us again this time. And without fail this was another incredible holiday, </p> <!-- <a class="text-primary toggle-btn" onclick="toggleTruncate(this)" data-state="collapsed">See More</a> --> <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#reviewModal" data-name="gumchiu" data-location="Hong Kong" data-image="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" data-rating="4.5" data-title="Our 2nd incredible India" data-review="We had an incredible holiday in India organised by Elegant Journey Mr Vivek 11th years ago, I’m so glad we ask Mr Vivek to helped us again this time. And without fail this was another incredible holiday."> See More </a> <span class="fs-12 fw-light">Written Oct 2023</span>
 				</div>
 			</div>
 		</div>
 		<div class="col-sm-4 col-md-3">
 			<div class="card">
 				<div class="card-body">
 					<div class="d-flex align-items-center justify-content-start gap-3 mb-2"> <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" class="w-25 rounded-circle shadow-1-strong" />
 						<div>
 							<h5 class="fw-normal fs-14 m-0">Jenny T</h5>
 							<h5 class="fw-normal fs-14 m-1">St Leonards, Australia</h5>
 						</div>
 					</div>
 					<ul class="list-unstyled d-flex justify-content-start m-0">
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star-half-alt fa-sm text-teal"></i> </li>
 					</ul>
 					<p class="m-0 fw-semibold">BEYOND MY EXPECTATIONS</p>
 					<p class="mt-2 m-0 fw-normal truncate-4 review"> <i class="fas fa-quote-left pe-2"></i>Absolutely everything. My expectations were exceeded far & away more than I thought. Perfection from day 1 to day 14. Amazing itinerary, the best driver, wonderful guides, sublime accommodation. If you plan to visit India </p> <!-- <a class="text-primary toggle-btn" onclick="toggleTruncate(this)" data-state="collapsed">See More</a> --> <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#reviewModal" data-name="Jenny T" data-location="St Leonards, Australia" data-image="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" data-rating="4.5" data-title="BEYOND MY EXPECTATIONS" data-review="Absolutely everything. My expectations were exceeded far & away more than I thought. Perfection from day 1 to day 14. Amazing itinerary, the best driver, wonderful guides, sublime accommodation. If you plan to visit India."> See More </a> <span class="fs-12 fw-light">Written Apr 2023</span>
 				</div>
 			</div>
 		</div>
 		<div class="col-sm-4 col-md-3">
 			<div class="card">
 				<div class="card-body">
 					<div class="d-flex align-items-center justify-content-start gap-3 mb-2"> <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" class="w-25 rounded-circle shadow-1-strong" />
 						<div>
 							<h5 class="fw-normal fs-14 m-0">Nir E</h5>
 							<h5 class="fw-normal fs-14 m-1">Austin, TX</h5>
 						</div>
 					</div>
 					<ul class="list-unstyled d-flex justify-content-start m-0">
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star-half-alt fa-sm text-teal"></i> </li>
 					</ul>
 					<p class="m-0 fw-semibold">Highly recommended tour operator</p>
 					<p class="mt-2 m-0 fw-normal truncate-4 review"> <i class="fas fa-quote-left pe-2"></i>They arranged one of the best tours we ever had. The guides and the driver they provided us were extremely knowledgeable, polite, helpful and were able to answer all our questions. The service was excellent </p> <!-- <a class="text-primary toggle-btn" onclick="toggleTruncate(this)" data-state="collapsed">See More</a> --> <a href="#" class="text-primary see-more-btn" data-bs-toggle="modal" data-bs-target="#reviewModal" data-name="Nir E" data-location="Austin, TX" data-image="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" data-rating="4.5" data-title="Highly recommended tour operator" data-review="They arranged one of the best tours we ever had. The guides and the driver they provided us were extremely knowledgeable, polite, helpful and were able to answer all our questions. The service was excellent"> See More </a> <span class="fs-12 fw-light">Written Jan 2020</span>
 				</div>
 			</div>
 		</div>
 		<div class="col-sm-4 col-md-3">
 			<div class="card">
 				<div class="card-body">
 					<div class="d-flex align-items-center justify-content-start gap-3 mb-2"> <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" class="w-25 rounded-circle shadow-1-strong" />
 						<div>
 							<h5 class="fw-normal fs-14 m-0">Melissa E</h5>
 							<h5 class="fw-normal fs-14 m-1">Westport, CT</h5>
 						</div>
 					</div>
 					<ul class="list-unstyled d-flex justify-content-start m-0">
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star-half-alt fa-sm text-teal"></i> </li>
 					</ul>
 					<p class="m-0 fw-semibold">Excellent India Tour Operator</p>
 					<p class="mt-2 m-0 fw-normal truncate-4"> <i class="fas fa-quote-left pe-2"></i>Elegant Journeys is a five-star tour company headed by Vivek Wadhawan. He is on top of very single issue. Tours are custom-made, and private. Vivek meets you personally at the beginning of the tour and he sends a company representative to every city we visited. You have your own AC car, driver and guide for every destination. </p> <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#reviewModal" data-name="Melissa E" data-location="Westport, CT" data-image="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" data-rating="4.5" data-title="Excellent India Tour Operator" data-review="Elegant Journeys is a five-star tour company headed by Vivek Wadhawan. He is on top of very single issue. Tours are custom-made, and private. Vivek meets you personally at the beginning of the tour and he sends a company representative to every city we visited. You have your own AC car, driver and guide for every destination."> See More </a> <span class="fs-12 fw-light">Written Jun 2019</span>
 				</div>
 			</div>
 		</div>
 		<div class="col-sm-4 col-md-3">
 			<div class="card">
 				<div class="card-body">
 					<div class="d-flex align-items-center justify-content-start gap-3 mb-2"> <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" class="w-25 rounded-circle shadow-1-strong" />
 						<div>
 							<h5 class="fw-normal fs-14 m-0">crisismanager6</h5>
 							<h5 class="fw-normal fs-14 m-1">NYG</h5>
 						</div>
 					</div>
 					<ul class="list-unstyled d-flex justify-content-start m-0">
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star fa-sm text-teal"></i> </li>
 						<li> <i class="fas fa-star-half-alt fa-sm text-teal"></i> </li>
 					</ul>
 					<p class="m-0 fw-semibold">GREAT INDIA TOUR OPERATOR</p>
 					<p class="mt-2 m-0 fw-normal truncate-4"> <i class="fas fa-quote-left pe-2"></i>Elegant Journeys is an excellent company headed by Vivek Wadhawan who is very hands on. All of the tours offered are private and there are both predetermined tours and special itineraries if desired. </p> <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#reviewModal" data-name="crisismanager6" data-location="NYG" data-image="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" data-rating="4.5" data-title="GREAT INDIA TOUR OPERATOR" data-review="Elegant Journeys is an excellent company headed by Vivek Wadhawan who is very hands on. All of the tours offered are private and there are both predetermined tours and special itineraries if desired."> See More </a> <span class="fs-12 fw-light">Written Feb 2019</span>
 				</div>
 			</div>
 		</div>
 	</div>
 </section>
 <section class="w-100 py-4 d-md-none">
 	<h5 class="fw-semibold">Videos</h5>
 	<div class="w-100 row custom-scroll">
 		<div class="col-11 col-sm-6 col-md-3 mb-3"> <video class="w-100 h-auto rounded" controls>
 				<source src="https://www.elegantjourneys.com/repositery/video/1693112627_alex-olga-j-usa.mp4" type="video/mp4" /> Your browser does not support the video tag.
 			</video> </div>
 		<div class="col-11 col-sm-6 col-md-3 mb-3"> <video class="w-100 h-auto rounded" controls>
 				<source src="https://www.elegantjourneys.com/repositery/video/andrew.mp4" type="video/mp4" /> Your browser does not support the video tag.
 			</video> </div>
 		<div class="col-11 col-sm-6 col-md-3 mb-3"> <video class="w-100 h-auto rounded" controls>
 				<source src="https://www.elegantjourneys.com/repositery/video/rebecca.mp4" type="video/mp4" /> Your browser does not support the video tag.
 			</video> </div>
 		<div class="col-11 col-sm-6 col-md-3 mb-3"> <video class="w-100 h-auto rounded" controls>
 				<source src="https://www.elegantjourneys.com/repositery/video/kat.mp4" type="video/mp4" /> Your browser does not support the video tag.
 			</video> </div>
 	</div>
 </section>
 <section class="w-100 py-4">
 	<div class="w-100 d-flex align-items-center justify-content-between">
 		<h5 class="fw-semibold">You may also like</h5>
 		<div> <i class="remixIcon ri-arrow-left-s-line border border-1 p-1 rounded-1" onclick="moveHotelCards('left')"></i> <i class="remixIcon ri-arrow-right-s-line border border-1 p-1 rounded-1 ms-2" onclick="moveHotelCards('right')"></i> </div>
 	</div>
 	<div class="row flex-nowrap gap-2 mt-1 overflow-hidden ps-2" id="hotelContainer">
 		<div class="hotel-card card position-relative flex-shrink-0 p-0 border-0" id="hotelCard"> <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Regal Essence</span> <img src="<?= WEBROOT ?>version2/assets/images/3DayTour.png" class="card-img-top h-75" alt="..." />
 			<div class="card-body p-0 pt-2">
 				<p class="m-0 fw-semibold fs-14">3 Day Golden Triangle Tour</p>
 				<p class="m-0 text-secondary fs-14">Delhi → Agra → Jaipur</p>
 			</div>
 		</div>
 		<div class="hotel-card card position-relative flex-shrink-0 p-0 border-0"> <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Legacy Luxe</span> <img src="<?= WEBROOT ?>version2/assets/images/4DayTour.png" class="card-img-top h-75" alt="..." />
 			<div class="card-body p-0 pt-2">
 				<p class="m-0 fw-semibold fs-14">4 Day Golden Triangle Tour</p>
 				<p class="m-0 text-secondary fs-14">Delhi → Agra → Jaipur</p>
 			</div>
 		</div>
 		<div class="hotel-card card position-relative flex-shrink-0 p-0 border-0"> <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Majestic Roots</span> <img src="<?= WEBROOT ?>version2/assets/images/5DayTour.png" class="card-img-top h-75" alt="..." />
 			<div class="card-body p-0 pt-2">
 				<p class="m-0 fw-semibold fs-14">5 Day Golden Triangle Tour</p>
 				<p class="m-0 text-secondary fs-14">Delhi → Agra → Jaipur</p>
 			</div>
 		</div>
 		<div class="hotel-card card position-relative flex-shrink-0 p-0 border-0"> <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Heritage Luxury</span> <img src="<?= WEBROOT ?>version2/assets/images/6DayTour.png" class="card-img-top h-75" alt="..." />
 			<div class="card-body p-0 pt-2">
 				<p class="m-0 fw-semibold fs-14">7 Day Golden Triangle Tour</p>
 				<p class="m-0 text-secondary fs-14">Delhi → Agra → Jaipur</p>
 			</div>
 		</div>
 		<div class="hotel-card card position-relative flex-shrink-0 p-0 border-0"> <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Classic Prestige</span> <img src="<?= WEBROOT ?>version2/assets/images/7DayTour.png" class="card-img-top h-75" alt="..." />
 			<div class="card-body p-0 pt-2">
 				<p class="m-0 fw-semibold fs-14"> 8 Day Golden Triangle with Udaipur </p>
 				<p class="m-0 text-secondary fs-14"> Delhi → Agra → Jaipur → Udaipur </p>
 			</div>
 		</div>
 		<div class="hotel-card card position-relative flex-shrink-0 p-0 border-0"> <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Heritage Luxury</span> <img src="<?= WEBROOT ?>version2/assets/images/8DayTour.png" class="card-img-top h-75" alt="..." />
 			<div class="card-body p-0 pt-2">
 				<p class="m-0 fw-semibold fs-14"> 8 Day Golden Triangle Ranthambore </p>
 				<p class="m-0 text-secondary fs-14"> Delhi → Agra → Ranthambore → Jaipur </p>
 			</div>
 		</div>
 	</div>
 </section>
 <section class="w-100 py-4">
 	<h2 class="fw-semibold mb-3">Let us help you</h2>
 	<form class="row p-2 py-4 p-md-5 rounded-2 shadow-sm needs-validation" id="myForm" novalidate>
 		<div class="col-md-6">
 			<h5 class="border-bottom pb-2">Your Details</h5> <!-- Full Name -->
 			<div class="col-md-12"> <label for="fullName" class="form-label">Full Name <span class="text-danger">*</span></label> <input type="text" class="form-control" name="fullName" placeholder="Full Name" required />
 				<div class="invalid-feedback">Please enter your full name.</div>
 				<div id="error-name" class="error"></div>
 			</div> <!-- Email -->
 			<div class="col-md-12 mt-3"> <label for="email" class="form-label">Email ID <span class="text-danger">*</span></label> <input type="email" class="form-control" name="email" placeholder="Email Id" required />
 				<div class="invalid-feedback"> Please enter a valid email address. </div>
 				<div id="error-email" class="error"></div>
 			</div> <!-- Phone -->
 			<div class="col-md-12 mt-3"> <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label> <input type="tel" class="form-control" name="phone" maxlength="13" pattern="\d{10,13}" required oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
 				<div class="invalid-feedback"> Please enter a valid phone number. </div>
 				<div id="error-phone" class="error"></div>
 			</div> <!-- Country -->
 			<div class="col-md-12 mt-3"> <label for="country" class="form-label">Country <span class="text-danger">*</span></label> <select class="form-select" name="country" required>
 					<option disabled selected value="">--Select--</option>
 					<option value="USA">USA</option>
 					<option value="India">India</option>
 					<option value="UK">UK</option>
 				</select>
 				<div class="invalid-feedback">Please select a country.</div>
 			</div> <!-- Tour Start Date -->
 			<div class="col-md-12 mt-2"> <label for="tourStartDate" class="form-label">Tour Start Date <span class="text-danger">*</span></label> <input type="date" class="form-control" name="tourStartDate" required />
 				<div class="invalid-feedback">Please select a start date.</div>
 			</div>
 		</div>
 		<div class="col-md-6"> <!-- Hotel Category -->
 			<div class="col-md-12 mb-3 mt-3 mt-md-0"> <label class="form-label">Hotel Category <span class="text-danger">*</span></label>
 				<div class="hotel-cat">
 					<div class="form-check"> <input class="form-check-input" type="checkbox" name="hotelCategory" value="Oberoi Luxury" required /> <label class="form-check-label" for="hotelCategory1">Oberoi Luxury</label> </div>
 					<div class="form-check"> <input class="form-check-input" type="checkbox" name="hotelCategory" value="Opulent Palaces" required /> <label class="form-check-label" for="hotelCategory2">Opulent Palaces</label> </div>
 					<div class="form-check"> <input class="form-check-input" type="checkbox" name="hotelCategory" value="Opulent Palaces" required /> <label class="form-check-label" for="hotelCategory3">Opulent Palaces</label> </div>
 				</div>
 				<div class="invalid-feedback"> Please select a hotel category. </div>
 			</div>
 			<h5 class="border-bottom pb-2 mt-3 mt-md-0 fs-14"> Number of Travelers </h5> <!-- Number of Travelers -->
 			<div id="roomContainer">
 				<div id="roomTemplate" class="mt-1"> <span class="d-flex align-items-center gap-1 fs-12 text-secondary">Room 1 </span>
 					<div class="d-flex gap-2">
 						<div class="col-6"> <label for="adults" class="form-label">Adults <span class="text-danger">*</span></label> <select class="form-select" name="adults" required>
 								<option disabled selected value="">--Select--</option>
 								<option>1</option>
 								<option>2</option>
 								<option>3</option>
 							</select>
 							<div class="invalid-feedback"> Please select number of adults. </div>
 						</div>
 						<div class="col-6"> <label for="childs" class="form-label">Child</label> <select class="form-select" name="childs" id="childs" onchange="showChildCount(this, 1)">
 								<option disabled selected value="0">--select--</option>
 								<option>1</option>
 								<option>2</option>
 								<option>3</option>
 							</select> </div>
 					</div>
 					<div class="d-flex gap-2 mt-1" id="childContainer1"></div>
 				</div>
 			</div> <button type="button" class="d-inline-flex align-items-center gap-1 fs-12 text-secondary border-0 bg-transparent mt-2" onclick="addRooms(event)"> <i class="ri-add-box-line"></i> Add Room </button> <!-- Special Requirements -->
 			<div class="col-md-12 mt-3"> <label for="specialRequests" class="form-label">Your Special Requirements</label> <textarea class="form-control" name="specialRequests" rows="3" placeholder="Please specify here, if any customization required"></textarea> </div> <!-- Security Text -->
 			<div class="col-md-12 mt-3"> <label for="securityText" class="form-label">Security Text</label>
 				<div class=""> <input type="text" class="form-control d-inline me-2" style="width: 45%" name="securityText" required placeholder="Security text" /> <input type="text" class="form-control fw-semibold d-inline" style="width: 45%" value="K8CMC6" readonly />
 					<div class="invalid-feedback">Please enter security text.</div>
 				</div>
 			</div>
 		</div>
 		<hr class="my-4" />
 		<div class="col-12 d-flex gap-2 justify-content-start mb-3"> <button type="submit" class="btn bg-teal text-white fw-semibold" onclick="submitForm(this)"> Enquire Now </button> <button class="btn border-teal border-1 fw-semibold"> Book Now </button> </div> <!-- Payment Details -->
 		<div class="col-md-12">
 			<ul class="fs-14 m-0 p-md-0">
 				<li> Book Now by paying only INR 1000 or equivalent initial deposit. </li>
 				<li>Pay 25% deposit after receiving booking confirmation.</li>
 				<li>Balance payment 60 days before arrival.</li>
 				<li> For Festival period travel (like Pushkar Fair, Christmas/New Year, etc.) - balance payment 90 days before arrival. </li>
 			</ul>
 		</div>
 	</form>
 </section>