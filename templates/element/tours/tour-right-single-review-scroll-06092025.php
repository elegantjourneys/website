<div id="reviewCarousel" class="carousel slide border border-1 rounded-1 p-2 mt-2 bg-white" data-bs-ride="false">
 <div class="carousel-inner">
 
<?php
	$countTripadvisorReview = 1; 
	foreach($data['tripadvisor_review_list'] as $tripadvisorReviews)
	{
		
?>
			  
			  
			  
               
                  <!-- Review 1 -->
                  <div class="carousel-item <?=($countTripadvisorReview==1)?'active':''?>">
                    <div class="card border-0 mx-auto width-[80%]">
                      <div class="card-body">
                        <div
                          class="d-flex align-items-center justify-content-start gap-3 mb-2"
                        >
                          <img
                            src="<?=WEBROOT?>version2/assets/images/tripadvisor-logo.png"
                            class="w-25 rounded-circle shadow-1-strong"
                          />
                          <div>
                            <h5 class="fw-normal fs-14 m-0"><?=$tripadvisorReviews['name']?></h5>
                            <h5 class="fw-normal fs-14 m-1"><?=$tripadvisorReviews['place']?></h5>
                          </div>
                        </div>
                        <ul
                          class="list-unstyled d-flex justify-content-start m-0 gap-[1px]"
                        >
                          <li>
                            <i class="fa-solid fa-circle fa-sm text-teal"></i>
                          </li>
                          <li>
                            <i class="fa-solid fa-circle fa-sm text-teal"></i>
                          </li>
                          <li>
                            <i class="fa-solid fa-circle fa-sm text-teal"></i>
                          </li>
                          <li>
                            <i class="fa-solid fa-circle fa-sm text-teal"></i>
                          </li>
                          <?php
							/*
						  <li>
                            <i class="fa-regular fa-circle fa-sm text-teal"></i>
                          </li>
						  */
						  ?>
                        </ul>
                        <p class="m-0 fw-semibold">
                          <?=$tripadvisorReviews['short_description']?>
                        </p>
                        <p class="mt-2 m-0 fw-normal truncate-4 review">
                          <i class="fas fa-quote-left pe-2"></i><?=$tripadvisorReviews['long_description']?>
                        </p>
                        <!-- <a class="text-primary toggle-btn" onclick="toggleTruncate(this)">See
                      More</a> -->
                        <a
                          href="#"
                          class="text-dark fw-semibold small"
                          data-bs-toggle="modal"
                          data-bs-target="#reviewModal"
                          data-name="Elizabeth R"
                          data-location="Alexandria, VA"
                          data-image="https://www.elegantjourneys.com/version2/assets/images/tripadvisor-banner.png"
                          data-rating="4.5"
                          data-title="Perfection -- do not hesitate"
                          data-review="Visiting India was a lifelong dream. A friend recommended Elegant Journeys and our high expectations were exceeded. Mr. Vivek Wadhawan is extremely responsive to requests and organizes incredible, customized trips. The positive difference between a private trip like this (at your own pace, in your own comfortable car) and a big tour cannot be overemphasized. tenetur."
                        >
                          See More
                        </a>
						<?php /*
                        <span class="fs-12 fw-light">Written 2 May 2024</span>
						*/ ?>
                      </div>
                    </div>
                  </div>

<?php
		$countTripadvisorReview++;
	}
?>
				  
				  
				  
				  


                  <!-- Carousel Controls -->
                  <button
                    class="carousel-control-prev"
                    type="button"
                    data-bs-target="#reviewCarousel"
                    data-bs-slide="prev"
                  >
                    <span
                      class="carousel-control-prev-icon border border-1 rounded-2"
                    ></span>
                  </button>
                  <button
                    class="carousel-control-next"
                    type="button"
                    data-bs-target="#reviewCarousel"
                    data-bs-slide="next"
                  >
                    <span
                      class="carousel-control-next-icon border border-1 rounded-2"
                    ></span>
                  </button>
                </div>
              </div>