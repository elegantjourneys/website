<section class="heroSection w-100 px-0 py-3">
        <div class="px-2 mx-2 px-md-5 mx-md-5">
        <?php echo $this->element('common/breadcrumb-ver2'); ?>
  		</div>
        <div class="position-relative">
          <img
            src="<?=WEBROOT?>version2/assets/images/contact-us-banner.png"
            alt="banner"
            class="img-fluid d-block mx-auto"
          />
          <div
            class="position-absolute top-50 start-50 translate-middle text-center text-white"
          >
            <h1 class="fw-bold custom-heading">Frequently Asked Questions</h1>
            <h4 class="fw-semibold custom-subheading">
              Everything you need to know—before, during, and after your journey with us.
            </h4>
          </div>
        </div>
      </section>
      <section class="w-100 py-4">
        <div class="row">
          <div class="col-md-8">
            <div class="accordion accordion-flush" id="accordionFlushExample">
			<?php
				$countFaq = 1;
				foreach($data['faqs'] as $faq)
				{
					$questionCssClass = 'accordion-button collapsed shadow-none';
					$answerCssClass = 'accordion-collapse collapse';
					
					if($countFaq==1)
					{
						$questionCssClass = 'accordion-button shadow-none';
						$answerCssClass = 'accordion-collapse collapse show';
						
					}
					
			?>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button
                    class="<?=$questionCssClass?>"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#flush-collapse<?=$countFaq?>"
                    aria-expanded="false"
                    aria-controls="flush-collapse<?=$countFaq?>"
                  >
                    <?=$countFaq?>. <?=$faq['question']?>
                  </button>
                </h2>
                <div
                  id="flush-collapse<?=$countFaq?>"
                  class="<?=$answerCssClass?>"
                  data-bs-parent="#accordionFlushExample"
                >
                  <div class="accordion-body small">
                   <?=$faq['answer']?>
                  </div>
                </div>
              </div>
			<?php
					$countFaq = $countFaq+1;
				}
			?>
              
             
            </div>
          </div>

          <div class="col-md-4 d-none d-md-block">
            <div class="position-sticky" style="top: 90px">
              <div
                class="p-3 border border-1 border-secondary-subtle rounded-2"
              >
                <h5 class="fw-semibold">Our Affiliations</h5>
                <div>
                  <marquee behavior="alternate" direction="left">
                   
                    <img
                      src="<?=WEBROOT?>version2/assets/images/affiliation (2).png"
                      alt="affiliation"
                    />
                    <img
                      src="<?=WEBROOT?>version2/assets/images/affiliation (3).png"
                      alt="affiliation"
                    />
                    <img
                      src="<?=WEBROOT?>version2/assets/images/affiliation (4).png"
                      alt="affiliation"
                    />
                    <img
                      src="<?=WEBROOT?>version2/assets/images/affiliation (5).png"
                      alt="affiliation"
                    />
                  </marquee>
                </div>
              </div>

              <?php echo $this->element('tours/tour-right-single-review-scroll'); ?>
            </div>
          </div>
        </div>
      </section>
     <?php //echo $this->element('common/tour-you-may-like'); ?>