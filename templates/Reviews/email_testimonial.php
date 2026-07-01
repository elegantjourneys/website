<section class="heroSection w-100 px-0 py-4">
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
            <h1 class="fw-bold custom-heading">Journeys Remembered. Stories Shared.</h1>
            <h4 class="fw-semibold custom-subheading">
              Hear from travelers who’ve experienced the soul of India through our curated luxury tours.
            </h4>
          </div>
        </div>
      </section>
      <section class="w-100 py-4">
        <div class="row">
          <div class="col-md-12">
				
				<p><b>From the regal corridors of Rajasthan to the serene ghats of Varanasi, every Elegant Journeys guest 
				carries home more than memories—they carry stories. Read what travelers from the US, Australia, and beyond 
				have to say about their bespoke experiences, thoughtful service, and the quiet luxury that defines every journey with us.</b></p>
				
				
				<div class="row row-cols-md-2 row-cols-1 pt-4">
			<?php 
				foreach($data['testimonials'] as $td)
				{ 
			?>
					<div class="col d-flex border-bottom pb-3 mb-4">
						<div class="email-box">
							<div class="d-flex align-items-center">
								<div class="me-4"><img src="<?=WEBROOT?>version1/image/man.jpg" width="45" /></div>
									<div class="flex-wrap">
										<h6 class="wsbold"><?=$td["name"];?></h6>
									<div class="fw-bold"><?=$td["country"];?></div></div>
								</div>
								<div>
								<div class="mt-4">	
									<?php echo $this->Text->truncate(stripslashes($td["text"]),120,['ellipsis' => '...','exact' => false]);?><a class="fw-bold openPopup" data-href="<?= $this->Url->build(['controller' => 'Reviews', 'action' => 'emailTestimonialView', $td["id"]]); ?>" data-bs-toggle="modal" href="#exampleModalToggle<?=$td["id"];?>" role="button">View more</a>
								</div>
							</div>
						</div>
					</div>
					
					
					
					
					
					<div class="modal fade" id="exampleModalToggle<?=$td["id"];?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel<?=$td["id"];?>" tabindex="-1">
					  <div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							
						  <div class="modal-header">
							<div class="me-4"><img src="<?=WEBROOT?>version1/image/man.jpg" width="45" /></div>
							<h5 class="modal-title" id="exampleModalToggleLabel"><?=$td["name"];?></h5>
							
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							
						  </div>
						  <div class="modal-body">
							<?=stripslashes($td["text"])?>
						  </div>
						</div>
					  </div>
					</div>
			<?php 
				} 
			?>
		</div>
		   
		   
		   
		   
		   
		   
		   
		   
		   
          </div>

        
        </div>
      </section>
     <?php //echo $this->element('common/tour-you-may-like'); ?>