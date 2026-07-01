<style>
  .image-wrapper {
    aspect-ratio: 16 / 9;
    overflow: hidden;
    background-color: #f2f2f2;
    /* fallback placeholder */
  }

  .tour-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  /* Blur effect */
  .blur-load {
    filter: blur(12px);
    transform: scale(1.05);
    transition: filter 0.4s ease, transform 0.4s ease;
  }

  /* After image loads */
  .blur-load.loaded {
    filter: blur(0);
    transform: scale(1);
  }
</style>
<section class="heroSection w-100 py-4">
      <?php echo $this->element('common/breadcrumb-ver2'); ?>
      <div class="position-relative">
        <?php /* ?> <img src="<?=$data['general']['image']?>" alt="banner" class="img-fluid d-block mx-auto" /> <?php */ ?>
         <img
              rel="preload"
            src="<?=$data['general']['image']?>"
            alt="banner"
            class="img-fluid d-md-block d-none mx-auto"
          />
        <img
              rel="preload"
            src="<?=$data['general']['mobile_image']?>"
            alt="banner"
            class="img-fluid d-block d-md-none mx-auto"
          />
        <div class="position-absolute w-75 top-50 start-50 translate-middle text-center text-white">
          <h1 class="fw-bold custom-heading h2"><?=$data['seo']['page_heading']?></h1>
          <h4 class="fw-semibold custom-subheading h5">
            <i><?=$data['seo']['page_sub_heading']?></i>
          </h4>
        </div>
      </div>
    </section>
	
	<?php 
		if($data['content']['top_description']!="")
		{
			echo $this->element('version2/category/top-description'); 
		}
	?>
		
    <section class="w-100 py-4">
	<?php
		/*
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
	  */
	?>
      <div class="row" id="tourContainer">
        <?php 
			 foreach($data['category_list'] as $categoryList)
			 {	
				
		?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card">
            <?php /*
              <div class="position-relative">
                  <span class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5">Private Tour</span>
                  
				  <!--<div class="cutomGroup position-absolute">
                    <i class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
                  </div>-->
				  
                  <img src="<?=$categoryList['image']?>" class="card-img-top tour-image" alt="3 Day Golden Triangle Tour" data-default="<?=$categoryList['image']?>" data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg" loading="lazy">
              </div>
              */ ?>
<div class="position-relative image-wrapper">
            <span class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5">
              Private Tour
            </span>

            <img rel="preload" src="<?= $categoryList['image'] ?>"
              class="card-img-top tour-image"
              alt="3 Day Golden Triangle Tour"
              loading="eager"
              fetchpriority="high">
          </div>
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <h3 class="fs-6 fw-semibold m-0 lh-g col-9">
                      <?=$categoryList['name']?>
                    </h3>
                    <span class="small text-secondary text-end col-3"><?=($categoryList['duration']-1);?> Nights</span>
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
                        /*$formatter = new \NumberFormatter('en_IN', \NumberFormatter::CURRENCY);
                        $formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, 0);
                        echo $formatter->formatCurrency($categoryList['price'], 'INR');*/
						echo '&#8377;'.$categoryList['price'];
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
	
   <?php //echo $this->element('version2/review-extension-bottom'); ?>
   <?php //echo $this->element('version2/extra-tour-you-may-like'); ?>
   