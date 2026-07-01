<section class="w-100 py-4">
        <div
          class="w-100 d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row"
        >
          <div>
            <h5 class="fw-semibold">Reviews</h5>
            <p class="text-secondary">
              Don't take it from us - here's what people have to say about this
              operator
            </p>
          </div>
          <div>
            <i
              class="remixIcon ri-arrow-left-s-line border border-1 p-1 rounded-1"
              onclick="moveReviewCards('left')"
            ></i>

            <i
              class="remixIcon ri-arrow-right-s-line border border-1 p-1 rounded-1 ms-2"
              onclick="moveReviewCards('right')"
            ></i>
          </div>
        </div>
		
		<div class="row flex-nowrap mt-2 overflow-hidden" id="reviewContainer">
		<?php
			$countTestimonial = 1;
			foreach($data['client_review']['testimonials'] as $testimonial)
			{
				
		?>
          <div class="col-sm-4 col-md-3" id="reviewCard">
            <div class="card rounded-4">
              <div class="card-body">
                <div
                  class="d-flex align-items-center justify-content-start gap-3 mb-2"
                >
                  <img
                    src="<?=WEBROOT?>version2/assets/images/tripadvisor-logo.png"
                    class="w-25 rounded-circle shadow-1-strong"
                  />
                  <div>
                    <h5 class="fw-normal fs-14 m-0"><?=$testimonial['name']?></h5>
                    <h5 class="fw-normal fs-14 m-1"><?=$testimonial['place']?></h5>
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
                <p class="m-0 fw-semibold"><?=substr($testimonial['short_description'], 0, 28)?></p>
                <p class="mt-2 m-0 fw-normal truncate-4 review">
                  <i class="fas fa-quote-left pe-2"></i><?=substr($testimonial['long_description'], 0, 112)?>
                </p>
                <!-- <a class="text-primary toggle-btn" onclick="toggleTruncate(this)" data-state="collapsed">See More</a> -->
                <a
                  href="#"
                  class="text-dark fw-semibold small"
                  data-bs-toggle="modal"
                  data-bs-target="#reviewModal"
                  data-name="<?=$testimonial['name']?>"
                  data-location="<?=$testimonial['place']?>"
                  data-image="<?=WEBROOT?>version2/assets/images/tripadvisor-logo.png"
                  data-rating="5.0"
                  data-title="<?=$testimonial['short_description']?>"
                  data-review="<?=$testimonial['long_description']?>"
                >
                  See More
                </a>
				<?php
					/*
                <span class="fs-12 fw-light">Written <?=$testimonial['review_date']->format('d F Y')?></span>
				*/
				?>
              </div>
            </div>
          </div>
		<?php
				$countTestimonial++;
			}
		?>
		  
		
        </div>

        <!-- Review modal -->
        <div
          class="modal fade"
          id="reviewModal"
          tabindex="-1"
          aria-labelledby="reviewModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Review</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body max-height">
                <div
                  class="d-flex align-items-center justify-content-start gap-3 mb-2"
                >
                  <img
                    id="modalImg"
                    class="w-25 rounded-circle shadow-1-strong"
                  />
                  <div>
                    <h5 class="fw-normal fs-14 m-0" id="modalName"></h5>
                    <h5 class="fw-normal fs-14 m-1" id="modalLocation"></h5>
                  </div>
                </div>
                <ul
                  id="modalStars"
                  class="list-unstyled d-flex justify-content-start m-0 gap-[1px]"
                ></ul>
                <p class="m-0 fw-semibold" id="modalTitle"></p>
                <p class="mt-2 m-0 fw-normal review" id="modalReview"></p>
              </div>
            </div>
          </div>
        </div>
      </section>
    