<section class="heroSection w-100 px-0 py-4">
	<div class="px-2 mx-2 px-md-5 mx-md-5">
        <?php echo $this->element('common/breadcrumb-ver2'); ?>
	</div>
        <div class="position-relative">
          <img
            src="<?=WEBROOT?>version2/assets/images/reviews-banner.png"
            alt="banner"
            class="img-fluid d-block mx-auto"
          />
          <div
            class="position-absolute top-50 start-50 translate-middle text-center text-white"
          >
            <h1 class="fw-bold custom-heading">What Our Guests Say</h1>
            <h4 class="fw-semibold custom-subheading">
              Stories of discovery, elegance, and unforgettable journeys—shared by discerning travelers worldwide.
            </h4>
          </div>
        </div>
      </section>
      <section class="w-100 py-4">
        <div class="row">
          <div class="col-md-8">
            <!-- Tabs nav -->
            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link active text-decoration-none fw-semibold text-black d-flex align-items-center gap-1"
                  id="tab1-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#tab1"
                  type="button"
                  role="tab"
                  aria-controls="tab1"
                  aria-selected="true"
                >
                  <img
                    src="https://logo.clearbit.com/tripadvisor.com"
                    alt="Google Logo"
                    width="17"
                  />
                  Trip Advisor
                </button>
              </li>
			  <?php
				/*
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link text-decoration-none fw-semibold text-black d-flex align-items-center gap-0"
                  id="tab2-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#tab2"
                  type="button"
                  role="tab"
                  aria-controls="tab2"
                  aria-selected="false"
                >
                  <img
                    src="https://logo.clearbit.com/google.com"
                    alt="Google Logo"
                    width="15"
                  />
                  oogle
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link text-decoration-none fw-semibold text-black d-flex align-items-center gap-1"
                  id="tab3-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#tab3"
                  type="button"
                  role="tab"
                  aria-controls="tab3"
                  aria-selected="false"
                >
                  <img
                    src="https://logo.clearbit.com/trustpilot.com"
                    alt="Google Logo"
                    width="15"
                  />
                  Trustpilot
                </button>
              </li> */ ?>
            </ul>

            <!-- Tabs content -->
            <div
              class="tab-content border-bottom border-1 border-light-subtle mt-4"
              id="myTabContent"
              style="padding: 15px"
            >
              <div
                class="tab-pane fade show active"
                id="tab1"
                role="tabpanel"
                aria-labelledby="tab1-tab"
              >
                <div class="reviews-count">
                  <div class="d-flex align-items-center gap-2">
                    <h5 class="m-0 fw-bold">5.0</h5>
                    <span class="d-flex align-items-center text-teal">
                      <i class="ri-checkbox-blank-circle-fill"></i>
                      <i class="ri-checkbox-blank-circle-fill"></i>
                      <i class="ri-checkbox-blank-circle-fill"></i>
                      <i class="ri-checkbox-blank-circle-fill"></i>
					  <i class="ri-checkbox-blank-circle-fill"></i>
                      <?php /*<i class="ri-checkbox-blank-circle-line"></i> */ ?>
                    </span>
                    <p class="m-0 small text-light-emphasis">127 reviews</p>
                  </div>
                </div>
				
				<?php
					foreach($data['review_list']['trip_advisor'] as $review)
					{
						
				?>
                
                <div class="reviews-container mt-5">
                  <div class="reviews-wrapper">
                    <div
                      class="d-flex align-items-center justify-content-between gap-2"
                    >
                      <div class="d-flex align-items-center gap-2">
                        <img
                          class="border border-1 border-black rounded-circle"
                          style="width: 50px; height: 50px"
                          src="<?=WEBROOT?>version2/assets/images/tripadvisor-banner.png"
                          alt=""
                        />
                        <div>
                          <h6 class="m-0 small fw-bold"><?=$review['name']?></h6>
                          <p class="m-0 small">
                            <?=$review['place']?>
                          </p>
                        </div>
                      </div>
                      <div>
                        <?php /* hide thumb-up line ?>
                        <i class="ri-thumb-up-line me-2"></i>
                        <i class="ri-more-line"></i>
                        <?php */ ?>
                      </div>
                    </div>
                    <div class="mt-3">
                      <span class="d-flex align-items-center text-teal">
                        <i class="ri-checkbox-blank-circle-fill"></i>
                        <i class="ri-checkbox-blank-circle-fill"></i>
                        <i class="ri-checkbox-blank-circle-fill"></i>
                        <i class="ri-checkbox-blank-circle-fill"></i>
                        <i class="ri-checkbox-blank-circle-fill"></i>
                      </span>
                      <h6 class="fw-semibold">
                        <?=$review['short_description']?>
                      </h6>
                      <p class="text-light-emphasis fw-light">
						<?=$review['long_description']?>
                      </p>
					  <?php
						/*
                      <div class="d-flex gap-2 overflow-x-auto">
                        <img
                          class="w-25 rounded-3"
                          src="<?=WEBROOT?>version2/assets/images/10DayTour.png"
                          alt="reviews-image"
                        />
                        <img
                          class="w-25 rounded-3"
                          src="<?=WEBROOT?>version2/assets/images/10DayTour.png"
                          alt="reviews-image"
                        />
                        <img
                          class="w-25 rounded-3"
                          src="<?=WEBROOT?>version2/assets/images/10DayTour.png"
                          alt="reviews-image"
                        />
                        <img
                          class="w-25 rounded-3"
                          src="<?=WEBROOT?>version2/assets/images/10DayTour.png"
                          alt="reviews-image"
                        />
                        <img
                          class="w-25 rounded-3"
                          src="<?=WEBROOT?>version2/assets/images/10DayTour.png"
                          alt="reviews-image"
                        />
                        <img
                          class="w-25 rounded-3"
                          src="<?=WEBROOT?>version2/assets/images/10DayTour.png"
                          alt="reviews-image"
                        />
                        <img
                          class="w-25 rounded-3"
                          src="<?=WEBROOT?>version2/assets/images/10DayTour.png"
                          alt="reviews-image"
                        />
                        <img
                          class="w-25 rounded-3"
                          src="<?=WEBROOT?>version2/assets/images/10DayTour.png"
                          alt="reviews-image"
                        />
                        <img
                          class="w-25 rounded-3"
                          src="<?=WEBROOT?>version2/assets/images/10DayTour.png"
                          alt="reviews-image"
                        />
                        <img
                          class="w-25 rounded-3"
                          src="<?=WEBROOT?>version2/assets/images/10DayTour.png"
                          alt="reviews-image"
                        />
                        <img
                          class="w-25 rounded-3"
                          src="<?=WEBROOT?>version2/assets/images/10DayTour.png"
                          alt="reviews-image"
                        />
                      </div> */
					  ?>
                      
                    </div>
                  </div>
                </div>
				<?php
					}
				?>
				
			
				
				
				
				
              </div>
              <div
                class="tab-pane fade"
                id="tab2"
                role="tabpanel"
                aria-labelledby="tab2-tab"
              >
                <div class="reviews-count">
                  <div class="d-flex align-items-center gap-2">
                    <h5 class="m-0 fw-bold">4.2</h5>
                    <span class="d-flex align-items-center text-warning">
                      <i class="ri-star-fill"></i>
                      <i class="ri-star-fill"></i>
                      <i class="ri-star-fill"></i>
                      <i class="ri-star-fill"></i>
                      <i class="ri-star-half-fill"></i>
                    </span>
                    <p class="m-0 small text-light-emphasis">2,491 reviews</p>
                  </div>
                </div>
                <div class="reviews-container mt-5">
                  <div class="reviews-wrapper">
                    <div class="d-flex align-items-center gap-2">
                      <img
                        class="border border-1 border-black rounded-circle"
                        style="width: 50px; height: 50px"
                        src="<?=WEBROOT?>version2/assets/images/partners (1).png"
                        alt=""
                      />
                      <div>
                        <h6 class="m-0 small fw-bold">Sylvia J</h6>
                        <p class="m-0 small">2 reviews</p>
                      </div>
                    </div>

                    <div class="mt-3">
                      <div class="d-flex align-items-center gap-2">
                        <span class="d-flex align-items-center text-warning">
                          <i class="ri-star-fill"></i>
                          <i class="ri-star-fill"></i>
                          <i class="ri-star-fill"></i>
                          <i class="ri-star-fill"></i>
                          <i class="ri-star-half-fill"></i>
                        </span>
                        <p class="small m-0">3 months ago</p>
                      </div>
                      <p class="text-light-emphasis mt-3">
                        A really good trip to two of the most popular markets,
                        the train journey into the market was great as you got
                        to see it both on and off the train. The floating market
                        is very interesting. Guide was great and very
                        informative. Would recommend.
                      </p>
                      <div>
                        <i class="ri-thumb-up-line fs-5"></i>
                        <i class="ri-share-line ms-4 fs-5"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div
                class="tab-pane fade"
                id="tab3"
                role="tabpanel"
                aria-labelledby="tab3-tab"
              >
                <div class="reviews-count">
                  <div class="d-flex align-items-center gap-2">
                    <h5 class="m-0 fw-bold">4.8</h5>
                    <span class="d-flex align-items-center text-teal">
                      <i class="ri-star-fill"></i>
                      <i class="ri-star-fill"></i>
                      <i class="ri-star-fill"></i>
                      <i class="ri-star-fill"></i>
                      <i class="ri-star-line"></i>
                    </span>
                    <p class="m-0 small text-light-emphasis">987 reviews</p>
                  </div>
                </div>
                <div class="reviews-container mt-5">
                  <div class="reviews-wrapper">
                    <div
                      class="d-flex align-items-center justify-content-between gap-2"
                    >
                      <div class="d-flex align-items-center gap-2">
                        <img
                          class="border border-1 border-black rounded-circle"
                          style="width: 50px; height: 50px"
                          src="<?=WEBROOT?>version2/assets/images/partners (1).png"
                          alt=""
                        />
                        <div>
                          <h6 class="m-0 small fw-bold">Sylvia J</h6>
                          <p class="m-0 small">
                            London, UK &bull; 31 contributer
                          </p>
                        </div>
                      </div>
                      <div>
                        <p class="small">May 24, 2025</p>
                      </div>
                    </div>
                    <div class="mt-3">
                      <span class="d-flex align-items-center text-teal">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-line"></i>
                      </span>
                      <h6 class="fw-semibold mt-1">
                        THE ONLY WAY TO SEE INDIA
                      </h6>
                      <p class="text-light-emphasis">
                        A really good trip to two of the most popular markets,
                        the train journey into the market was great as you got
                        to see it both on and off the train. The floating market
                        is very interesting. Guide was great and very
                        informative. Would recommend.
                      </p>
                      <p class="text-light-emphasis m-0 mt-3 small">
                        <strong class="text-black">Date of experience: </strong>
                        1 March 2025
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <?php
				echo $this->element('version2/static/section-tripadvisor-review-left'); 
			?>
          </div>
        </div>
      </section>
	  <?php 
		if($data['content']['description']!="")
		{
			echo $this->element('version2/category/description'); 
		}
		?>
		<?php 
			if($data['faq']['faq_list'][0]['question']!="")
			{
				echo $this->element('version2/category/faq'); 
				
			}
		?>