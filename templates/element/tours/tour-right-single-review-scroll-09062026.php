<?php
	$singleTripadvisorReview = $data['client_review']['single_tripadvisor_review'];
?>
<div id="reviewCarousel" class="carousel slide border border-1 rounded-1 p-2 mt-2 py-3 bg-white" data-bs-ride="false">

 <div class="carousel-inner">
				<div class="text-center">
					<h2 class="fw-semibold fs-5">What Our Guests Say on Tripadvisor</h2>
					<p class="text-muted">Authentic Tripadvisor Reviews from Real Guests</p>
				</div>
                  <!-- Review 1 -->
                  <div class="carousel-item active">
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
                            <h5 class="fw-normal fs-14 m-0"><?=$singleTripadvisorReview['name']?></h5>
                            <h5 class="fw-normal fs-14 m-1"><?=$singleTripadvisorReview['place']?></h5>
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
                          <?=$singleTripadvisorReview['short_description']?>
                        </p>
                        <p class="mt-2 m-0 fw-normal truncate-4 review">
                          <i class="fas fa-quote-left pe-2"></i><?=$singleTripadvisorReview['description']?>
                        </p>
                        <!-- <a class="text-primary toggle-btn" onclick="toggleTruncate(this)">See
                      More</a> -->
                        <a
                          href="<?=WEBROOT?>tripadvisor-review"
                          class="text-dark fw-semibold small"
                          
                        >
                          See More
                        </a>
						<?php /*
                        <span class="fs-12 fw-light">Written 2 May 2024</span>
						*/ ?>
                      </div>
                    </div>
                  </div>

			  
				  
				  
				  


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