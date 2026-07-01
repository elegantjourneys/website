<section class="heroSection w-100 p-0">
      <span class="d-block small text-secondary py-3 custom-inline-padding">Home > Most Popular</span>
      <div class="position-relative">
        <!-- <img src="<?=$data['general']['image']?>" alt="banner" class="img-fluid d-block mx-auto" /> -->
         <img
            src="<?=WEBROOT?>version2/assets/images/popular-tours-banner.png"
            alt="banner"
            class="img-fluid d-block mx-auto"
          />
        <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
          <h1 class="fw-bold custom-heading"><?=$data['general']['name']?></h1>
          <h4 class="fw-semibold custom-subheading">
            The trips we recommend
          </h4>
        </div>
      </div>
    </section>
    <section class="w-100 py-4">
      <div class="w-100 d-flex align-items-center justify-content-between mb-4">
        <p class="fs-6 fw-semibold m-0" id="resultsShowing">
          Showing <?=$data['total_count'];?> results
        </p>
        <div class="dropdown">
          <button class="btn dropdown-toggle fs-6 border-black border-1 px-3 rounded-1 fw-semibold" type="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            Duration
          </button>
          <ul class="dropdown-menu">
            <li class="dropdown-item cursor-[pointer]">1 to 3 Days</li>
            <li class="dropdown-item cursor-[pointer]">4 to 7 Days</li>
            <li class="dropdown-item cursor-[pointer]">8 to 15 Days</li>
          </ul>
        </div>
      </div>
      <div class="row" id="tourContainer">
        <?php 
			 foreach($data['category_list'] as $categoryList)
			 {	
					
			
		?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card">
              <div class="position-relative">
                  <span class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5">Private Tour</span>
                  <div class="cutomGroup position-absolute">
                    <i class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
                  </div>
                  <img src="<?=$categoryList['image']?>" class="card-img-top tour-image" alt="3 Day Golden Triangle Tour" data-default="<?=$categoryList['image']?>" data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg">
              </div>
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-6 fw-semibold m-0 lh-g col-9">
                      <?=$categoryList['name']?>
                    </p>
                    <span class="small text-secondary text-end col-3"><?=$categoryList['duration'];?> Nights</span>
                  </div>
                  <p class="small fw-medium my-2">Tour Code : <?=$categoryList['tour_code']?></p>
                  <p class="small fw-regular m-0 text-secondary">
                    
                    <?php
							$destinationCount=1;
							foreach($categoryList['destinations'] as $destination)
							{
								if($destinationCount==1)
								{
						?>
									<span> <?=$destination['city']?></span>
						<?php
								}
								else
								{
						?>
									<span> → <?=$destination['city']?></span>
							
						<?php
								}
								$destinationCount++;
							}
						?>
                  </p>
                  <div class="d-flex align-items-center justify-content-between mt-3">
                    <h4 class="fw-semibold text-teal m-0">
                     <!--  ₹<?=$categoryList['price']?> --> 
                      <?php
                        $formatter = new \NumberFormatter('en_IN', \NumberFormatter::CURRENCY);
                        $formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, 0);
                        echo $formatter->formatCurrency($categoryList['price'], 'INR');
                      ?>
                      <span class="fs-10 text-secondary">onwards</span>
                    </h4>
                    <a href="<?=$categoryList['tour_page_url']?>">
                    <button class="btn bg-teal text-white fw-semibold rounded-1">
                      View Tour
                    </button>
                    </a>
                  </div>
              </div>
          </div>
      </div>
      <?php } ?>
      <!-- <div class="col-lg-4 col-md-6 mb-4">
          <div class="card">
              <div class="position-relative">
                  <span class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5">Private Tour</span>
                  <div class="cutomGroup position-absolute">
                    <i class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
                  </div>
                  <img src="<?=WEBROOT?>version2/assets/images/4DayTour.png" class="card-img-top tour-image" alt="4 Day Golden Triangle Tour" data-default="<?=WEBROOT?>version2/assets/images/4DayTour.png" data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg">
              </div>
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-6 fw-semibold m-0 lh-g col-9">
                      4 Day Golden Triangle Tour
                    </p>
                    <span class="small text-secondary text-end col-3">3 Nights</span>
                  </div>
                  <p class="small fw-medium my-2">Tour Code : GT-323</p>
                  <p class="small fw-regular m-0 text-secondary">
                    Delhi → Agra → Jaipur
                  </p>
                  <div class="d-flex align-items-center justify-content-between mt-3">
                    <h4 class="fw-semibold text-teal m-0">
                      ₹25,388 <span class="fs-10 text-secondary">onwards</span>
                    </h4>
  
                    <button class="btn bg-teal text-white fw-semibold rounded-1">
                      View Tour
                    </button>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
          <div class="card">
              <div class="position-relative">
                  <span class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5">Private Tour</span>
                  <div class="cutomGroup position-absolute">
                    <i class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
                  </div>
                  <img src="<?=WEBROOT?>version2/assets/images/5DayTour.png" class="card-img-top tour-image" alt="5 Day Golden Triangle Tour" data-default="<?=WEBROOT?>version2/assets/images/5DayTour.png" data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg">
              </div>
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-6 fw-semibold m-0 lh-g col-9">
                      5 Day Golden Triangle Tour
                    </p>
                    <span class="small text-secondary text-end col-3">4 Nights</span>
                  </div>
                  <p class="small fw-medium my-2">Tour Code : GT-189</p>
                  <p class="small fw-regular m-0 text-secondary">
                    Delhi → Jaipur → Agra
                  </p>
                  <div class="d-flex align-items-center justify-content-between mt-3">
                    <h4 class="fw-semibold text-teal m-0">
                      ₹34,411 <span class="fs-10 text-secondary">onwards</span>
                    </h4>
  
                    <button class="btn bg-teal text-white fw-semibold rounded-1">
                      View Tour
                    </button>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
          <div class="card">
              <div class="position-relative">
                  <span class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5">Private Tour</span>
                  <div class="cutomGroup position-absolute">
                    <i class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
                  </div>
                  <img src="<?=WEBROOT?>version2/assets/images/6DayTour.png" class="card-img-top tour-image" alt="6 Day Golden Triangle Tour " data-default="<?=WEBROOT?>version2/assets/images/6DayTour.png" data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg">
              </div>
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-6 fw-semibold m-0 lh-g col-9">
                      6 Day Golden Triangle Tour 
                    </p>
                    <span class="small text-secondary text-end col-3">5 Nights</span>
                  </div>
                  <p class="small fw-medium my-2">Tour Code : GT-190</p>
                  <p class="small fw-regular m-0 text-secondary">
                    Delhi → Agra → Jaipur
                  </p>
                  <div class="d-flex align-items-center justify-content-between mt-3">
                    <h4 class="fw-semibold text-teal m-0">
                      ₹38,900 <span class="fs-10 text-secondary">onwards</span>
                    </h4>
  
                    <button class="btn bg-teal text-white fw-semibold rounded-1">
                      View Tour
                    </button>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
          <div class="card">
              <div class="position-relative">
                  <span class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5">Private Tour</span>
                  <div class="cutomGroup position-absolute">
                    <i class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
                  </div>
                  <img src="<?=WEBROOT?>version2/assets/images/7DayTour.png" class="card-img-top tour-image" alt="7 Day Golden Triangle Tour" data-default="<?=WEBROOT?>version2/assets/images/7DayTour.png" data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg">
              </div>
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-6 fw-semibold m-0 lh-g col-9">
                      7 Day Golden Triangle Tour
                    </p>
                    <span class="small text-secondary text-end col-3">6 Nights</span>
                  </div>
                  <p class="small fw-medium my-2">Tour Code : GT-193</p>
                  <p class="small fw-regular m-0 text-secondary">
                    Delhi → Agra → Jaipur
                  </p>
                  <div class="d-flex align-items-center justify-content-between mt-3">
                    <h4 class="fw-semibold text-teal m-0">
                      ₹44,411 <span class="fs-10 text-secondary">onwards</span>
                    </h4>
  
                    <button class="btn bg-teal text-white fw-semibold rounded-1">
                      View Tour
                    </button>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
          <div class="card">
              <div class="position-relative">
                  <span class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5">Private Tour</span>
                  <div class="cutomGroup position-absolute">
                    <i class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
                  </div>
                  <img src="<?=WEBROOT?>version2/assets/images/8DayTour.png" class="card-img-top tour-image" alt="8 Day Golden Triangle Tour" data-default="<?=WEBROOT?>version2/assets/images/8DayTour.png" data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg">
              </div>
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-6 fw-semibold m-0 lh-g col-9">
                      8 Day Golden Triangle Tour
                    </p>
                    <span class="small text-secondary text-end col-3">7 Nights</span>
                  </div>
                  <p class="small fw-medium my-2">Tour Code : GT-195</p>
                  <p class="small fw-regular m-0 text-secondary">
                    Delhi → Agra → Jaipur → Udaipur
                  </p>
                  <div class="d-flex align-items-center justify-content-between mt-3">
                    <h4 class="fw-semibold text-teal m-0">
                      ₹48,781 <span class="fs-10 text-secondary">onwards</span>
                    </h4>
  
                    <button class="btn bg-teal text-white fw-semibold rounded-1">
                      View Tour
                    </button>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
          <div class="card">
              <div class="position-relative">
                  <span class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5">Private Tour</span>
                  <div class="cutomGroup position-absolute">
                    <i class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
                  </div>
                  <img src="<?=WEBROOT?>version2/assets/images/8WildlifeDayTour.png" class="card-img-top tour-image" alt="8 Day Golden Triangle with Ranthambore Wildlife" data-default="<?=WEBROOT?>version2/assets/images/8WildlifeDayTour.png" data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg">
              </div>
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-6 fw-semibold m-0 lh-g col-9">
                      8 Day Golden Triangle with Ranthambore Wildlife
                    </p>
                    <span class="small text-secondary text-end col-3">7 Nights</span>
                  </div>
                  <p class="small fw-medium my-2">Tour Code : GT-194</p>
                  <p class="small fw-regular m-0 text-secondary">
                    Delhi → Agra → Ranthambore → Jaipur
                  </p>
                  <div class="d-flex align-items-center justify-content-between mt-3">
                    <h4 class="fw-semibold text-teal m-0">
                      ₹50,411 <span class="fs-10 text-secondary">onwards</span>
                    </h4>
  
                    <button class="btn bg-teal text-white fw-semibold rounded-1">
                      View Tour
                    </button>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
          <div class="card">
              <div class="position-relative">
                  <span class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5">Private Tour</span>
                  <div class="cutomGroup position-absolute">
                    <i class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
                  </div>
                  <img src="<?=WEBROOT?>version2/assets/images/9DayTour.png" class="card-img-top tour-image" alt="9 Day Golden Triangle with Varanasi" data-default="<?=WEBROOT?>version2/assets/images/9DayTour.png" data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg">
              </div>
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-6 fw-semibold m-0 lh-g col-9">
                      9 Day Golden Triangle with Varanasi
                    </p>
                    <span class="small text-secondary text-end col-3">8 Nights</span>
                  </div>
                  <p class="small fw-medium my-2">Tour Code : GT-264</p>
                  <p class="small fw-regular m-0 text-secondary">
                    Delhi → Varanasi  Agra → Jaipur
                  </p>
                  <div class="d-flex align-items-center justify-content-between mt-3">
                    <h4 class="fw-semibold text-teal m-0">
                      ₹52,200 <span class="fs-10 text-secondary">onwards</span>
                    </h4>
  
                    <button class="btn bg-teal text-white fw-semibold rounded-1">
                      View Tour
                    </button>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
          <div class="card">
              <div class="position-relative">
                  <span class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5">Private Tour</span>
                  <div class="cutomGroup position-absolute">
                    <i class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
                  </div>
                  <img src="<?=WEBROOT?>version2/assets/images/10DayTour.png" class="card-img-top tour-image" alt="10 Day Golden Triangle with Jodhpur &amp; Udaipur" data-default="<?=WEBROOT?>version2/assets/images/10DayTour.png" data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg">
              </div>
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-6 fw-semibold m-0 lh-g col-9">
                      10 Day Golden Triangle with Jodhpur &amp; Udaipur
                    </p>
                    <span class="small text-secondary text-end col-3">9 Nights</span>
                  </div>
                  <p class="small fw-medium my-2">Tour Code : GT-269</p>
                  <p class="small fw-regular m-0 text-secondary">
                    Delhi → Agra → Jaipur → Jodhpur → Udaipur
                  </p>
                  <div class="d-flex align-items-center justify-content-between mt-3">
                    <h4 class="fw-semibold text-teal m-0">
                      ₹54,411 <span class="fs-10 text-secondary">onwards</span>
                    </h4>
  
                    <button class="btn bg-teal text-white fw-semibold rounded-1">
                      View Tour
                    </button>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
          <div class="card">
              <div class="position-relative">
                  <span class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5">Private Tour</span>
                  <div class="cutomGroup position-absolute">
                    <i class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
                  </div>
                  <img src="<?=WEBROOT?>version2/assets/images/10DayTour1.png" class="card-img-top tour-image" alt="10 Day Golden Triangle with Ranthambore &amp; Udaipur" data-default="<?=WEBROOT?>version2/assets/images/10DayTour1.png" data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg">
              </div>
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-6 fw-semibold m-0 lh-g col-9">
                      10 Day Golden Triangle with Ranthambore &amp; Udaipur
                    </p>
                    <span class="small text-secondary text-end col-3">9 Nights</span>
                  </div>
                  <p class="small fw-medium my-2">Tour Code : GT-204</p>
                  <p class="small fw-regular m-0 text-secondary">
                    Delhi → Agra → Ranthambore → Jaipur → Udaipur
                  </p>
                  <div class="d-flex align-items-center justify-content-between mt-3">
                    <h4 class="fw-semibold text-teal m-0">
                      ₹59,519 <span class="fs-10 text-secondary">onwards</span>
                    </h4>
  
                    <button class="btn bg-teal text-white fw-semibold rounded-1">
                      View Tour
                    </button>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
          <div class="card">
              <div class="position-relative">
                  <span class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5">Private Tour</span>
                  <div class="cutomGroup position-absolute">
                    <i class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
                  </div>
                  <img src="<?=WEBROOT?>version2/assets/images/11DayTour.png" class="card-img-top tour-image" alt="11 Day Golden Triangle With Varanasi &amp; Ranthambore Wildlife" data-default="<?=WEBROOT?>version2/assets/images/11DayTour.png" data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg">
              </div>
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-6 fw-semibold m-0 lh-g col-9">
                      11 Day Golden Triangle With Varanasi &amp; Ranthambore Wildlife
                    </p>
                    <span class="small text-secondary text-end col-3">10 Nights</span>
                  </div>
                  <p class="small fw-medium my-2">Tour Code : GT-266</p>
                  <p class="small fw-regular m-0 text-secondary">
                    Delhi → Varanasi → Agra → Ranthambore → Jaipur
                  </p>
                  <div class="d-flex align-items-center justify-content-between mt-3">
                    <h4 class="fw-semibold text-teal m-0">
                      ₹64,111 <span class="fs-10 text-secondary">onwards</span>
                    </h4>
  
                    <button class="btn bg-teal text-white fw-semibold rounded-1">
                      View Tour
                    </button>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
          <div class="card">
              <div class="position-relative">
                  <span class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5">Private Tour</span>
                  <div class="cutomGroup position-absolute">
                    <i class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
                  </div>
                  <img src="<?=WEBROOT?>version2/assets/images/11DayTour1.png" class="card-img-top tour-image" alt="11 Day Golden Triangle With Varanasi &amp; Udaipur" data-default="<?=WEBROOT?>version2/assets/images/11DayTour1.png" data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg">
              </div>
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-6 fw-semibold m-0 lh-g col-9">
                      11 Day Golden Triangle With Varanasi &amp; Udaipur
                    </p>
                    <span class="small text-secondary text-end col-3">10 Nights</span>
                  </div>
                  <p class="small fw-medium my-2">Tour Code : GT-265</p>
                  <p class="small fw-regular m-0 text-secondary">
                    Delhi → Varanasi → Agra → Jaipur → Udaipur
                  </p>
                  <div class="d-flex align-items-center justify-content-between mt-3">
                    <h4 class="fw-semibold text-teal m-0">
                      ₹68,501 <span class="fs-10 text-secondary">onwards</span>
                    </h4>
  
                    <button class="btn bg-teal text-white fw-semibold rounded-1">
                      View Tour
                    </button>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
          <div class="card">
              <div class="position-relative">
                  <span class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5">Private Tour</span>
                  <div class="cutomGroup position-absolute">
                    <i class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
                  </div>
                  <img src="<?=WEBROOT?>version2/assets/images/12DayTour.png" class="card-img-top tour-image" alt="12 Day Rajasthan Tour with Ranthambore Wildlife" data-default="<?=WEBROOT?>version2/assets/images/12DayTour.png" data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg">
              </div>
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-6 fw-semibold m-0 lh-g col-9">
                      12 Day Rajasthan Tour with Ranthambore Wildlife
                    </p>
                    <span class="small text-secondary text-end col-3">11 Nights</span>
                  </div>
                  <p class="small fw-medium my-2">Tour Code : GT-270</p>
                  <p class="small fw-regular m-0 text-secondary">
                    Delhi → Agra → Ranthambore → Jaipur → Jodhpur → Udaipur
                  </p>
                  <div class="d-flex align-items-center justify-content-between mt-3">
                    <h4 class="fw-semibold text-teal m-0">
                      ₹75,611 <span class="fs-10 text-secondary">onwards</span>
                    </h4>
  
                    <button class="btn bg-teal text-white fw-semibold rounded-1">
                      View Tour
                    </button>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
          <div class="card">
              <div class="position-relative">
                  <span class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5">Private Tour</span>
                  <div class="cutomGroup position-absolute">
                    <i class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
                  </div>
                  <img src="<?=WEBROOT?>version2/assets/images/13DayTour.png" class="card-img-top tour-image" alt="13 Day Rajasthan Tour with Varanasi" data-default="<?=WEBROOT?>version2/assets/images/13DayTour.png" data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg">
              </div>
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-6 fw-semibold m-0 lh-g col-9">
                      13 Day Rajasthan Tour with Varanasi
                    </p>
                    <span class="small text-secondary text-end col-3">12 Nights</span>
                  </div>
                  <p class="small fw-medium my-2">Tour Code : GT-272</p>
                  <p class="small fw-regular m-0 text-secondary">
                    Delhi → Varanasi → Agra → Jaipur → Jodhpur → Udaipur
                  </p>
                  <div class="d-flex align-items-center justify-content-between mt-3">
                    <h4 class="fw-semibold text-teal m-0">
                      ₹78,301 <span class="fs-10 text-secondary">onwards</span>
                    </h4>
  
                    <button class="btn bg-teal text-white fw-semibold rounded-1">
                      View Tour
                    </button>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
          <div class="card">
              <div class="position-relative">
                  <span class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5">Private Tour</span>
                  <div class="cutomGroup position-absolute">
                    <i class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
                  </div>
                  <img src="<?=WEBROOT?>version2/assets/images/13DayTour1.png" class="card-img-top tour-image" alt="13 Day Golden Triangle With Varanasi, Ranthambore ..." data-default="<?=WEBROOT?>version2/assets/images/13DayTour1.png" data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg">
              </div>
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-6 fw-semibold m-0 lh-g col-9">
                      13 Day Golden Triangle With Varanasi, Ranthambore ...
                    </p>
                    <span class="small text-secondary text-end col-3">12 Nights</span>
                  </div>
                  <p class="small fw-medium my-2">Tour Code : GT-267</p>
                  <p class="small fw-regular m-0 text-secondary">
                    Delhi → Varanasi → Agra → Ranthambore → Jaipur → Udaipur
                  </p>
                  <div class="d-flex align-items-center justify-content-between mt-3">
                    <h4 class="fw-semibold text-teal m-0">
                      ₹82,211 <span class="fs-10 text-secondary">onwards</span>
                    </h4>
  
                    <button class="btn bg-teal text-white fw-semibold rounded-1">
                      View Tour
                    </button>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
          <div class="card">
              <div class="position-relative">
                  <span class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5">Private Tour</span>
                  <div class="cutomGroup position-absolute">
                    <i class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
                  </div>
                  <img src="<?=WEBROOT?>version2/assets/images/15DayTour.jpg" class="card-img-top tour-image" alt="15 Day Rajasthan Tour with Varanasi &amp; Ranthambore Wildlife" data-default="<?=WEBROOT?>version2/assets/images/15DayTour.jpg" data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg">
              </div>
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-6 fw-semibold m-0 lh-g col-9">
                      15 Day Rajasthan Tour with Varanasi &amp; Ranthambore Wildlife
                    </p>
                    <span class="small text-secondary text-end col-3">14 Nights</span>
                  </div>
                  <p class="small fw-medium my-2">Tour Code : GT-273</p>
                  <p class="small fw-regular m-0 text-secondary">
                    Delhi → Varanasi → Agra → Ranthambore → Jaipur → Jodhpur → Udaipur
                  </p>
                  <div class="d-flex align-items-center justify-content-between mt-3">
                    <h4 class="fw-semibold text-teal m-0">
                      ₹85,411 <span class="fs-10 text-secondary">onwards</span>
                    </h4>
  
                    <button class="btn bg-teal text-white fw-semibold rounded-1">
                      View Tour
                    </button>
                  </div>
              </div>
          </div>
      </div> -->
    </div>
    </section>
    <section class="w-100 py-4">
      <div class="w-100 d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
        <div>
          <h5 class="fw-semibold">Reviews</h5>
          <p class="text-secondary">
            Don't take it from us - here's what people have to say about this
            operator
          </p>
        </div>
        <div>
          <i class="remixIcon ri-arrow-left-s-line border border-1 p-1 rounded-1" onclick="moveReviewCards('left')"></i>

          <i class="remixIcon ri-arrow-right-s-line border border-1 p-1 rounded-1 ms-2"
            onclick="moveReviewCards('right')"></i>
        </div>
      </div>
      <div class="row flex-nowrap mt-2 overflow-hidden" id="reviewContainer">
        <div class="col-sm-4 col-md-3" id="reviewCard">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-start gap-3 mb-2">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp"
                  class="w-25 rounded-circle shadow-1-strong" />
                <div>
                  <h5 class="fw-normal fs-14 m-0">Elizabeth R</h5>
                  <h5 class="fw-normal fs-14 m-1">Alexandria, VA</h5>
                </div>
              </div>
              <ul class="list-unstyled d-flex justify-content-start m-0">
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star-half-alt fa-sm text-teal"></i>
                </li>
              </ul>
              <p class="m-0 fw-semibold">Perfection -- do not hesitate</p>
              <p class="mt-2 m-0 fw-normal truncate-4 review">
                <i class="fas fa-quote-left pe-2"></i>Visiting India was a
                lifelong dream. A friend recommended Elegant Journeys and our
                high expectations were exceeded. Mr. Vivek Wadhawan is
                extremely responsive to requests and organizes incredible,
                customized trips.
              </p>
              <!-- <a class="text-primary toggle-btn" onclick="toggleTruncate(this)" data-state="collapsed">See More</a> -->
              <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#reviewModal"
                onclick="openReviewModal(this)" data-name="Elizabeth R" data-location="Alexandria, VA"
                data-image="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" data-rating="4.5"
                data-title="Perfection -- do not hesitate"
                data-review="Visiting India was a lifelong dream. A friend recommended Elegant Journeys and our high expectations were exceeded. Mr. Vivek Wadhawan is extremely responsive to requests and organizes incredible, customized trips. The positive difference between a private trip like this (at your own pace, in your own comfortable car) and a big tour cannot be overemphasized. tenetur.">
                See More
              </a>

              <!-- generalized modal -->
              <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="reviewModalLabel">Review</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body max-height">
                      <div class="d-flex align-items-center justify-content-start gap-3 mb-2">
                        <img id="modalImg" class="w-25 rounded-circle shadow-1-strong" />
                        <div>
                          <h5 class="fw-normal fs-14 m-0" id="modalName"></h5>
                          <h5 class="fw-normal fs-14 m-1" id="modalLocation"></h5>
                        </div>
                      </div>
                      <ul id="modalStars" class="list-unstyled d-flex justify-content-start m-0"></ul>
                      <p class="m-0 fw-semibold" id="modalTitle"></p>
                      <p class="mt-2 m-0 fw-normal review" id="modalReview"></p>
                    </div>
                  </div>
                </div>
              </div>
              <!--  -->
            </div>
          </div>
        </div>
        <div class="col-sm-4 col-md-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-start gap-3 mb-2">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp"
                  class="w-25 rounded-circle shadow-1-strong" />
                <div>
                  <h5 class="fw-normal fs-14 m-0">gumchiu</h5>
                  <h5 class="fw-normal fs-14 m-1">Hong Kong</h5>
                </div>
              </div>
              <ul class="list-unstyled d-flex justify-content-start m-0">
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star-half-alt fa-sm text-teal"></i>
                </li>
              </ul>
              <p class="m-0 fw-semibold">Our 2nd incredible India</p>
              <p class="mt-2 m-0 fw-normal truncate-4 review">
                <i class="fas fa-quote-left pe-2"></i>We had an incredible
                holiday in India organised by Elegant Journey Mr Vivek 11th
                years ago, I’m so glad we ask Mr Vivek to helped us again this
                time. And without fail this was another incredible holiday,
              </p>
              <!-- <a class="text-primary toggle-btn" onclick="toggleTruncate(this)" data-state="collapsed">See More</a> -->
              <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#reviewModal"
                onclick="openReviewModal(this)" data-name="gumchiu" data-location="Hong Kong"
                data-image="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" data-rating="4.5"
                data-title="Our 2nd incredible India"
                data-review="We had an incredible holiday in India organised by Elegant Journey Mr Vivek 11th years ago, I’m so glad we ask Mr Vivek to helped us again this time. And without fail this was another incredible holiday.">
                See More
              </a>
              <span class="fs-12 fw-light">Written Oct 2023</span>
            </div>
          </div>
        </div>
        <div class="col-sm-4 col-md-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-start gap-3 mb-2">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp"
                  class="w-25 rounded-circle shadow-1-strong" />
                <div>
                  <h5 class="fw-normal fs-14 m-0">Jenny T</h5>
                  <h5 class="fw-normal fs-14 m-1">St Leonards, Australia</h5>
                </div>
              </div>
              <ul class="list-unstyled d-flex justify-content-start m-0">
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star-half-alt fa-sm text-teal"></i>
                </li>
              </ul>
              <p class="m-0 fw-semibold">BEYOND MY EXPECTATIONS</p>
              <p class="mt-2 m-0 fw-normal truncate-4 review">
                <i class="fas fa-quote-left pe-2"></i>Absolutely everything.
                My expectations were exceeded far & away more than I thought.
                Perfection from day 1 to day 14. Amazing itinerary, the best
                driver, wonderful guides, sublime accommodation. If you plan
                to visit India
              </p>
              <!-- <a class="text-primary toggle-btn" onclick="toggleTruncate(this)" data-state="collapsed">See More</a> -->.
              <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#reviewModal"
                onclick="openReviewModal(this)" data-name="Jenny T" data-location="St Leonards, Australia"
                data-image="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" data-rating="4.5"
                data-title="BEYOND MY EXPECTATIONS"
                data-review="Absolutely everything. My expectations were exceeded far & away more than I thought. Perfection from day 1 to day 14. Amazing itinerary, the best driver, wonderful guides, sublime accommodation. If you plan to visit India.">
                See More
              </a>
              <span class="fs-12 fw-light">Written Apr 2023</span>
            </div>
          </div>
        </div>
        <div class="col-sm-4 col-md-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-start gap-3 mb-2">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp"
                  class="w-25 rounded-circle shadow-1-strong" />
                <div>
                  <h5 class="fw-normal fs-14 m-0">Nir E</h5>
                  <h5 class="fw-normal fs-14 m-1">Austin, TX</h5>
                </div>
              </div>
              <ul class="list-unstyled d-flex justify-content-start m-0">
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star-half-alt fa-sm text-teal"></i>
                </li>
              </ul>
              <p class="m-0 fw-semibold">Highly recommended tour operator</p>
              <p class="mt-2 m-0 fw-normal truncate-4 review">
                <i class="fas fa-quote-left pe-2"></i>They arranged one of the
                best tours we ever had. The guides and the driver they
                provided us were extremely knowledgeable, polite, helpful and
                were able to answer all our questions. The service was
                excellent
              </p>
              <!-- <a class="text-primary toggle-btn" onclick="toggleTruncate(this)" data-state="collapsed">See More</a> -->
              <a href="#" class="text-primary see-more-btn" data-bs-toggle="modal" data-bs-target="#reviewModal"
                onclick="openReviewModal(this)" data-name="Nir E" data-location="Austin, TX"
                data-image="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" data-rating="4.5"
                data-title="Highly recommended tour operator"
                data-review="They arranged one of the best tours we ever had. The guides and the driver they provided us were extremely knowledgeable, polite, helpful and were able to answer all our questions. The service was excellent">
                See More
              </a>
              <span class="fs-12 fw-light">Written Jan 2020</span>
            </div>
          </div>
        </div>
        <div class="col-sm-4 col-md-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-start gap-3 mb-2">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp"
                  class="w-25 rounded-circle shadow-1-strong" />
                <div>
                  <h5 class="fw-normal fs-14 m-0">Melissa E</h5>
                  <h5 class="fw-normal fs-14 m-1">Westport, CT</h5>
                </div>
              </div>
              <ul class="list-unstyled d-flex justify-content-start m-0">
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star-half-alt fa-sm text-teal"></i>
                </li>
              </ul>
              <p class="m-0 fw-semibold">Excellent India Tour Operator</p>
              <p class="mt-2 m-0 fw-normal truncate-4 review">
                <i class="fas fa-quote-left pe-2"></i>Elegant Journeys is a
                five-star tour company headed by Vivek Wadhawan. He is on top
                of very single issue. Tours are custom-made, and private.
                Vivek meets you personally at the beginning of the tour and he
                sends a company representative to every city we visited. You
                have your own AC car, driver and guide for every destination.
              </p>
              <!-- <a class="text-primary toggle-btn" onclick="toggleTruncate(this)" data-state="collapsed">See More</a> -->
              <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#reviewModal"
                onclick="openReviewModal(this)" data-name="Melissa E" data-location="Westport, CT"
                data-image="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" data-rating="4.5"
                data-title="Excellent India Tour Operator"
                data-review="Elegant Journeys is a five-star tour company headed by Vivek Wadhawan. He is on top of very single issue. Tours are custom-made, and private. Vivek meets you personally at the beginning of the tour and he sends a company representative to every city we visited.">
                See More
              </a>
              <span class="fs-12 fw-light">Written Jun 2019</span>
            </div>
          </div>
        </div>
        <div class="col-sm-4 col-md-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-start gap-3 mb-2">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp"
                  class="w-25 rounded-circle shadow-1-strong" />
                <div>
                  <h5 class="fw-normal fs-14 m-0">crisismanager6</h5>
                  <h5 class="fw-normal fs-14 m-1">NYG</h5>
                </div>
              </div>
              <ul class="list-unstyled d-flex justify-content-start m-0">
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star fa-sm text-teal"></i>
                </li>
                <li>
                  <i class="fas fa-star-half-alt fa-sm text-teal"></i>
                </li>
              </ul>
              <p class="m-0 fw-semibold">GREAT INDIA TOUR OPERATOR</p>
              <p class="mt-2 m-0 fw-normal truncate-4 review">
                <i class="fas fa-quote-left pe-2"></i>Elegant Journeys is an
                excellent company headed by Vivek Wadhawan who is very hands
                on. All of the tours offered are private and there are both
                predetermined tours and special itineraries if desired.
              </p>
              <!-- <a class="text-primary toggle-btn" onclick="toggleTruncate(this)" data-state="collapsed">See More</a> -->
              <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#reviewModal"
                onclick="openReviewModal(this)" data-name="crisismanager6" data-location="NYG"
                data-image="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" data-rating="4.5"
                data-title="GREAT INDIA TOUR OPERATOR"
                data-review="Elegant Journeys is an excellent company headed by Vivek Wadhawan who is very hands on. All of the tours offered are private and there are both predetermined tours and special itineraries if desired.">
                See More
              </a>
              <span class="fs-12 fw-light">Written Feb 2019</span>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="w-100 py-4">
      <div class="w-100 d-flex align-items-center justify-content-between">
        <h5 class="fw-semibold">You may also like</h5>
        <div>
          <i class="remixIcon ri-arrow-left-s-line border border-1 p-1 rounded-1" onclick="moveHotelCards('left')"></i>
          <i class="remixIcon ri-arrow-right-s-line border border-1 p-1 rounded-1 ms-2"
            onclick="moveHotelCards('right')"></i>
        </div>
      </div>
      <div class="row flex-nowrap gap-2 mt-1 overflow-hidden ps-2" id="hotelContainer">
        <div class="hotel-card position-relative flex-shrink-0 p-0 border-0" id="hotelCard">
          <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Heritage Luxury</span>
          <img src="<?=WEBROOT?>version2/assets/images/3DayTour.png" class="card-img-top h-75" alt="..." />
          <div class="card-body p-0 pt-2">
            <p class="m-0 fw-semibold fs-14">3 Day Golden Triangle Tour</p>
            <p class="m-0 text-secondary fs-14">Delhi → Agra → Jaipur</p>
          </div>
        </div>
        <div class="hotel-card card position-relative flex-shrink-0 p-0 border-0">
          <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Heritage Luxury</span>
          <img src="<?=WEBROOT?>version2/assets/images/4DayTour.png" class="card-img-top h-75" alt="..." />
          <div class="card-body p-0 pt-2">
            <p class="m-0 fw-semibold fs-14">4 Day Golden Triangle Tour</p>
            <p class="m-0 text-secondary fs-14">Delhi → Agra → Jaipur</p>
          </div>
        </div>
        <div class="hotel-card card position-relative flex-shrink-0 p-0 border-0">
          <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Heritage Luxury</span>
          <img src="<?=WEBROOT?>version2/assets/images/5DayTour.png" class="card-img-top h-75" alt="..." />
          <div class="card-body p-0 pt-2">
            <p class="m-0 fw-semibold fs-14">5 Day Golden Triangle Tour</p>
            <p class="m-0 text-secondary fs-14">Delhi → Agra → Jaipur</p>
          </div>
        </div>
        <div class="hotel-card card position-relative flex-shrink-0 p-0 border-0">
          <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Heritage Luxury</span>
          <img src="<?=WEBROOT?>version2/assets/images/6DayTour.png" class="card-img-top h-75" alt="..." />
          <div class="card-body p-0 pt-2">
            <p class="m-0 fw-semibold fs-14">7 Day Golden Triangle Tour</p>
            <p class="m-0 text-secondary fs-14">Delhi → Agra → Jaipur</p>
          </div>
        </div>
        <div class="hotel-card card position-relative flex-shrink-0 p-0 border-0">
          <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Heritage Luxury</span>
          <img src="<?=WEBROOT?>version2/assets/images/7DayTour.png" class="card-img-top h-75" alt="..." />
          <div class="card-body p-0 pt-2">
            <p class="m-0 fw-semibold fs-14">
              8 Day Golden Triangle with Udaipur
            </p>
            <p class="m-0 text-secondary fs-14">
              Delhi  Agra → Jaipur → Udaipur
            </p>
          </div>
        </div>
        <div class="hotel-card card position-relative flex-shrink-0 p-0 border-0">
          <span class="badge text-bg-light position-absolute fw-medium right-[5px]">Heritage Luxury</span>
          <img src="<?=WEBROOT?>version2/assets/images/8DayTour.png" class="card-img-top h-75" alt="..." />
          <div class="card-body p-0 pt-2">
            <p class="m-0 fw-semibold fs-14">
              8 Day Golden Triangle Ranthambore
            </p>
            <p class="m-0 text-secondary fs-14">
              Delhi → Agra → Ranthambore  Jaipur
            </p>
          </div>
        </div>
      </div>
    </section>