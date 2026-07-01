    <?php
    $contents = $data['content'];

    ?>
    <main>
      <section id="banner-2" class="container-fluid position-relative mx-0 px-0 mt-md-5 pt-md-4">
        <?php
        if (!empty($contents["BNR_IMAGES_MAHARAJA"])) {
          echo $contents["BNR_IMAGES_MAHARAJA"]["description"];
        }
        ?>
        <div class="hero-mob d-lg-none"></div>
        <div class="banner-text text-lg-start text-center">
          <?php
          if (!empty($contents["BNR_TXT_MAHARAJAS"])) {
            echo $contents["BNR_TXT_MAHARAJAS"]["description"];
          }
          ?>
        </div>
      </section>
      <section class="about-bg">
        <div class="d-flex flex-column text-center justify-content-center">
          <div>
            <img src="<?= WEBROOT ?>trains/assets/images/pattern_bb.png" class="img-fluid" />
          </div>
          <div class="cor font-80 lh-1">
            <?php
            if (!empty($contents["ABOUT_US_THE_MAHARAJAS"])) {
              echo $contents["ABOUT_US_THE_MAHARAJAS"]["title"];
            }
            ?>
          </div>
          <div>
            <img src="<?= WEBROOT ?>trains/assets/images/pattern_bt.png" class="img-fluid" />
          </div>
        </div>
        <div class="col-lg-8 mx-lg-auto mx-3 text-center" id="aboutUs">
          <?php
          if (!empty($contents["ABOUT_US_THE_MAHARAJAS"])) {
            echo $contents["ABOUT_US_THE_MAHARAJAS"]["description"];
          }
          ?>
        </div>
      </section>
      <section class="world-bg">
        <div class="col-lg-10 mx-lg-auto mx-3 ">
          <div class="d-flex flex-column text-center justify-content-center mb-5">
            <div><img src="<?= WEBROOT ?>trains/assets/images/pattern_bb.png" class="img-fluid" /></div>
            <div class="cor red font-80 lh-1">World of The Maharajas' Express</div>
            <div><img src="<?= WEBROOT ?>trains/assets/images/pattern_bt.png" class="img-fluid" /></div>
          </div>
          <div>
            <ul class="nav nav-pills gray mob-width p-2 mb-3 rounded-pill justify-content-around gap-md-3 gap-lg-3 gap-xl-4 gap-3 box sticky-tabs z-3" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill tab-shape active" id="pills-itinerary-tab" data-bs-toggle="pill" data-bs-target="#pills-itinerary" type="button" role="tab" aria-controls="pills-itinerary" aria-selected="true">Itinerary</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill tab-shape" id="pills-cabins-tab" data-bs-toggle="pill" data-bs-target="#pills-cabins" type="button" role="tab" aria-controls="pills-cabins" aria-selected="false">Cabins</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill tab-shape" id="pills-facilities-tab" data-bs-toggle="pill" data-bs-target="#pills-facilities" type="button" role="tab" aria-controls="pills-facilities" aria-selected="false">Facilities</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill tab-shape" id="pills-experiences-tab" data-bs-toggle="pill" data-bs-target="#pills-experiences" type="button" role="tab" aria-controls="pills-experiences" aria-selected="false">Experiences</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill tab-shape" id="pills-inclusions-tab" data-bs-toggle="pill" data-bs-target="#pills-inclusions" type="button" role="tab" aria-controls="pills-inclusions" aria-selected="false">Inclusions</button>
              </li>
              
              <li class="nav-item" role="presentation">
  				<button class="nav-link rounded-pill tab-shape price-blink" id="pills-price-tab" data-bs-toggle="pill" data-bs-target="#pricing-list" type="button" role="tab">Price</button>
			  </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-itinerary" role="tabpanel" aria-labelledby="pills-itinerary-tab" tabindex="0">

                <div class="mt-5 accordion accordion-wrapper d-flex flex-column gap-3" id="accordionExample">
                  
                  <!--  Itinerary Section: Dynamically display itinerary  -->
                  <div class="row g-4 justify-content-center">
                    <?php
                    if (!empty($contents["MAHARAJA_ITINERARY_INDIAN_PANORMA"])) {
                    ?>
                      <div class="col-lg-6 col-md-4 col-sm-12">
                        <div class="card border-0 rounded-4 overflow-hidden shadow-lg position-relative group-card h-100">

                          <!-- Image Section -->
                          <div class="position-relative overflow-hidden" style="height: 250px;">
                            <img
                              src="https://www.elegantjourneys.com/trains/assets/images/the-maharajas/amer-jaipur.jpeg"
                              class="w-100 h-100 object-fit-cover img-hover"
                              alt="amer-jaipur">

                          </div>

                          <!-- Content -->
                          <div class="card-body p-4">


                            <?php
                            $title = $contents["MAHARAJA_ITINERARY_INDIAN_PANORMA"]["title"];
                            $parts = explode('—', $title);
                            ?>

                            <h5 class="mb-2 red font-50 cor-bold text-center">
                              <?= trim($parts[0]) ?>

                              <?php if (!empty($parts[1])): ?>

                                <div class="mb-2 red font-20 cor-bold">(<?= trim($parts[1]) ?>)</div>
                              <?php endif; ?>
                            </h5>
                            <h6 class="mb-2 font-18 cor-bold text-center">
                              <?= $contents["MAHARAJA_ITINERARY_INDIAN_PANORMA"]["city"] ?>
                            </h6>

                            <div class="text-center mt-4">
                              <a href="javascript:void(0);"
                                class="btn btn-danger font-16 fw-bold px-4 py-2 text-white open-itinerary"
                                data-url="<?= $contents["MAHARAJA_ITINERARY_INDIAN_PANORMA"]["page_url"] ?>">
                                View More
                              </a>
                            </div>
                          </div>

                        </div>
                      </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (!empty($contents["MAHARAJA_ITINERARY_TREASURES_OF_INDIA"])) {
                    ?>
                      <div class="col-lg-6 col-md-4 col-sm-12">
                        <div class="card border-0 rounded-4 overflow-hidden shadow-lg position-relative group-card h-100">

                          <!-- Image Section -->
                          <div class="position-relative overflow-hidden" style="height: 250px;">
                            <img
                              src="https://www.elegantjourneys.com/trains/assets/images/the-maharajas/elephant-ride-amer.jpeg"
                              class="w-100 h-100 object-fit-cover img-hover"
                              alt="elephant-ride">


                          </div>

                          <!-- Content -->
                          <div class="card-body p-4">
                            <?php
                            $title = $contents["MAHARAJA_ITINERARY_TREASURES_OF_INDIA"]["title"];
                            $parts = explode('—', $title);
                            ?>

                            <h5 class="mb-2 red font-50 cor-bold text-center">
                              <?= trim($parts[0]) ?>

                              <?php if (!empty($parts[1])): ?>

                                <div class="mb-2 red font-20 cor-bold">(<?= trim($parts[1]) ?>)</div>
                              <?php endif; ?>
                            </h5>

							<h6 class="mb-2 font-18 cor-bold text-center">
                              <?= $contents["MAHARAJA_ITINERARY_TREASURES_OF_INDIA"]["city"] ?>
                            </h6>


                            <div class="text-center mt-4">
                              <a href="javascript:void(0);"
                                class="btn btn-danger font-16 fw-bold px-4 py-2 text-white open-itinerary"
                                data-url="<?= $contents["MAHARAJA_ITINERARY_TREASURES_OF_INDIA"]["page_url"] ?>">
                                View More
                              </a>
                            </div>
                          </div>

                        </div>
                      </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (!empty($contents["MAHARAJA_ITINERARY_INDIAN_SPLENDOUR"])) {
                    ?>
                      <div class="col-lg-6 col-md-4 col-sm-12">
                        <div class="card border-0 rounded-4 overflow-hidden shadow-lg position-relative group-card h-100">

                          <!-- Image Section -->
                          <div class="position-relative overflow-hidden" style="height: 250px;">
                            <img
                              src="https://www.elegantjourneys.com/trains/assets/images/the-maharajas/taj-mahal-with-front-garden.jpeg"
                              class="w-100 h-100 object-fit-cover img-hover"
                              alt="tajmahal">


                          </div>

                          <!-- Content -->
                          <div class="card-body p-4">

                            <?php
                            $title = $contents["MAHARAJA_ITINERARY_INDIAN_SPLENDOUR"]["title"];
                            $parts = explode('—', $title);
                            ?>

                            <h5 class="mb-2 red font-50 cor-bold text-center">
                              <?= trim($parts[0]) ?>

                              <?php if (!empty($parts[1])): ?>

                                <div class="mb-2 red font-20 cor-bold">(<?= trim($parts[1]) ?>)</div>
                              <?php endif; ?>
                            </h5>
							<h6 class="mb-2 font-18 cor-bold text-center">
                              <?= $contents["MAHARAJA_ITINERARY_INDIAN_SPLENDOUR"]["city"] ?>
                            </h6>

                            <div class="text-center mt-4">
                              <a href="javascript:void(0);"
                                class="btn btn-danger font-16 fw-bold px-4 py-2 text-white open-itinerary"
                                data-url="<?= $contents["MAHARAJA_ITINERARY_INDIAN_SPLENDOUR"]["page_url"] ?>">
                                View More
                              </a>
                            </div>

                          </div>

                        </div>
                      </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (!empty($contents["MAHARAJA_ITINERARY_HERITAGE_OF_INDIA"])) {
                    ?>

                      <div class="col-lg-6 col-md-4 col-sm-12">
                        <div class="card border-0 rounded-4 overflow-hidden shadow-lg position-relative group-card h-100">

                          <!-- Image Section -->
                          <div class="position-relative overflow-hidden" style="height: 250px;">
                            <img
                              src="https://www.elegantjourneys.com/trains/assets/images/the-maharajas/lake-pichola-at-sunset.jpeg"
                              class="w-100 h-100 object-fit-cover img-hover"
                              alt="Bali Villas">


                          </div>

                          <!-- Content -->
                          <div class="card-body p-4">
                            <?php
                            $title = $contents["MAHARAJA_ITINERARY_HERITAGE_OF_INDIA"]["title"];
                            $parts = explode('—', $title);
                            ?>

                            <h5 class="mb-2 red font-50 cor-bold text-center">
                              <?= trim($parts[0]) ?>

                              <?php if (!empty($parts[1])): ?>

                                <div class="mb-2 red font-20 cor-bold">(<?= trim($parts[1]) ?>)</div>
                              <?php endif; ?>
                            </h5>
							<h6 class="mb-2 font-16 cor-bold text-center">
                              <?= $contents["MAHARAJA_ITINERARY_HERITAGE_OF_INDIA"]["city"] ?>
                            </h6>


                            <div class="text-center mt-4">
                              <a href="javascript:void(0);"
                                class="btn btn-danger font-18 fw-bold px-4 py-2 text-white open-itinerary"
                                data-url="<?= $contents["MAHARAJA_ITINERARY_HERITAGE_OF_INDIA"]["page_url"] ?>">
                                View More
                              </a>
                            </div>

                          </div>

                        </div>
                      </div>
                    <?php
                    }
                    ?>

                  </div>
                  
                  <?php /* ?>
                  <?php
                  if (!empty($contents["MAHARAJA_ITINERARY_INDIAN_PANORMA"])) {
                  ?>
                    <div class="mt-5 gray box p-3 pb-5">
                      <div class="text-center red font-50 cor-bold mb-4">
                        <?= $contents["MAHARAJA_ITINERARY_INDIAN_PANORMA"]["title"] ?>
                      </div>
                      <?= $contents["MAHARAJA_ITINERARY_INDIAN_PANORMA"]["description"] ?>
                      <!-- View More Button -->
                      <!-- <div class="text-center mt-4">
                        <a href="<?= $contents["MAHARAJA_ITINERARY_INDIAN_PANORMA"]["page_url"] ?> " class="btn btn-danger font-20 px-4 py-2 text-white">
                          View More
                        </a>
                      </div> -->
                      <div class="text-center mt-4">
                        <a href="javascript:void(0);"
                          class="btn btn-danger font-20 px-4 py-2 text-white open-itinerary"
                          data-url="<?= $contents["MAHARAJA_ITINERARY_INDIAN_PANORMA"]["page_url"] ?>">
                          View More
                        </a>
                      </div>
                    </div>

                  <?php
                  }
                  ?>



                  <?php
                  if (!empty($contents["MAHARAJA_ITINERARY_TREASURES_OF_INDIA"])) {
                  ?>
                    <div class="mt-5 gray box p-3 pb-5">
                      <div class="text-center red font-50 cor-bold mb-4">
                        <?= $contents["MAHARAJA_ITINERARY_TREASURES_OF_INDIA"]["title"] ?>
                      </div>
                      <?= $contents["MAHARAJA_ITINERARY_TREASURES_OF_INDIA"]["description"] ?>
                      <!-- View More Button -->
                      <!-- <div class="text-center mt-4">
                        <a href="<?= $contents["MAHARAJA_ITINERARY_TREASURES_OF_INDIA"]["page_url"] ?> " class="btn btn-danger font-20 px-4 py-2 text-white">
                          View More
                        </a>
                      </div> -->
                      <div class="text-center mt-4">
                        <a href="javascript:void(0);"
                          class="btn btn-danger font-20 px-4 py-2 text-white open-itinerary"
                          data-url="<?= $contents["MAHARAJA_ITINERARY_TREASURES_OF_INDIA"]["page_url"] ?>">
                          View More
                        </a>
                      </div>
                    </div>

                  <?php
                  }
                  ?>


                  <?php
                  if (!empty($contents["MAHARAJA_ITINERARY_INDIAN_SPLENDOUR"])) {
                  ?>
                    <div class="mt-5 gray box p-3 pb-5">
                      <div class="text-center red font-50 cor-bold mb-4">
                        <?= $contents["MAHARAJA_ITINERARY_INDIAN_SPLENDOUR"]["title"] ?>
                      </div>
                      <?= $contents["MAHARAJA_ITINERARY_INDIAN_SPLENDOUR"]["description"] ?>
                      <!-- View More Button -->
                      <!-- <div class="text-center mt-4">
                        <a href="<?= $contents["MAHARAJA_ITINERARY_INDIAN_SPLENDOUR"]["page_url"] ?> " class="btn btn-danger font-20 px-4 py-2 text-white">
                          View More
                        </a>
                      </div> -->
                      <div class="text-center mt-4">
                        <a href="javascript:void(0);"
                          class="btn btn-danger font-20 px-4 py-2 text-white open-itinerary"
                          data-url="<?= $contents["MAHARAJA_ITINERARY_INDIAN_SPLENDOUR"]["page_url"] ?>">
                          View More
                        </a>
                      </div>
                    </div>

                  <?php
                  }
                  ?>


                  <?php
                  if (!empty($contents["MAHARAJA_ITINERARY_HERITAGE_OF_INDIA"])) {
                  ?>
                    <div class="mt-5 gray box p-3 pb-5">
                      <div class="text-center red font-50 cor-bold mb-4">
                        <?= $contents["MAHARAJA_ITINERARY_HERITAGE_OF_INDIA"]["title"] ?>
                      </div>
                      <?= $contents["MAHARAJA_ITINERARY_HERITAGE_OF_INDIA"]["description"] ?>
                      <!-- View More Button -->
                      <!-- <div class="text-center mt-4">
                        <a href="<?= $contents["MAHARAJA_ITINERARY_HERITAGE_OF_INDIA"]["page_url"] ?> " class="btn btn-danger font-20 px-4 py-2 text-white">
                          View More
                        </a>
                      </div> -->
                      <div class="text-center mt-4">
                        <a href="javascript:void(0);"
                          class="btn btn-danger font-20 px-4 py-2 text-white open-itinerary"
                          data-url="<?= $contents["MAHARAJA_ITINERARY_HERITAGE_OF_INDIA"]["page_url"] ?>">
                          View More
                        </a>
                      </div>
                    </div>

                  <?php
                  }
                  ?>

				<?php */ ?>


                </div>
              </div>
              <div class="tab-pane fade" id="pills-cabins" role="tabpanel" aria-labelledby="pills-cabins-tab" tabindex="0">

                <?php

                if (!empty($contents["MAHARAJA_CABIN_DELUXE"])) {
                ?>
                  <div class="mt-5 gray box p-3 pb-5">
                    <div class="text-center red font-50 cor-bold">
                      <?= $contents["MAHARAJA_CABIN_DELUXE"]["title"] ?>
                    </div>
                    <?= $contents["MAHARAJA_CABIN_DELUXE"]["description"] ?>
                  </div>
                <?php
                }
                ?>

                <?php

                if (!empty($contents["MAHARAJA_JUNIOR_SUITE"])) {
                ?>
                  <div class="mt-5 gray box p-3 pb-5">
                    <div class="text-center red font-50 cor-bold">
                      <?= $contents["MAHARAJA_JUNIOR_SUITE"]["title"] ?>
                    </div>
                    <?= $contents["MAHARAJA_JUNIOR_SUITE"]["description"] ?>
                  </div>
                <?php
                }
                ?>

                <?php

                if (!empty($contents["MAHARAJA_SUITE"])) {
                ?>
                  <div class="mt-5 gray box p-3 pb-5">
                    <div class="text-center red font-50 cor-bold">
                      <?= $contents["MAHARAJA_SUITE"]["title"] ?>
                    </div>
                    <?= $contents["MAHARAJA_SUITE"]["description"] ?>
                  </div>
                <?php
                }
                ?>

                <?php

                if (!empty($contents["MAHARAJA_PRESIDENTIAL_SUITE"])) {
                ?>
                  <div class="mt-5 gray box p-3 pb-5">
                    <div class="text-center red font-50 cor-bold">
                      <?= $contents["MAHARAJA_PRESIDENTIAL_SUITE"]["title"] ?>
                    </div>
                    <?= $contents["MAHARAJA_PRESIDENTIAL_SUITE"]["description"] ?>
                  </div>
                <?php
                }
                ?>



              </div>
              <div class="tab-pane fade" id="pills-facilities" role="tabpanel" aria-labelledby="pills-facilities-tab" tabindex="0">
                <?php

                if (!empty($contents["MAHARAJA_LUXURY_RESTAURANTS"])) {
                ?>
                  <div class="mt-5 gray box p-3 pb-5">
                    <div class="text-center red font-50 cor-bold">
                      <?= $contents["MAHARAJA_LUXURY_RESTAURANTS"]["title"] ?>
                    </div>
                    <?= $contents["MAHARAJA_LUXURY_RESTAURANTS"]["description"] ?>
                  </div>
                <?php
                }
                ?>

                <?php

                if (!empty($contents["MAHARAJA_LUXURY_LOUNGE_AND_BAR"])) {
                ?>
                  <div class="mt-5 gray box p-3 pb-5">
                    <div class="text-center red font-50 cor-bold">
                      <?= $contents["MAHARAJA_LUXURY_LOUNGE_AND_BAR"]["title"] ?>
                    </div>
                    <?= $contents["MAHARAJA_LUXURY_LOUNGE_AND_BAR"]["description"] ?>
                  </div>
                <?php
                }
                ?>


              </div>
              <div class="tab-pane fade" id="pills-experiences" role="tabpanel" aria-labelledby="pills-experiences-tab" tabindex="0">
                <div class="mt-5 accordion d-flex flex-column gap-3" id="accordionExamples">


                  <?php
                  if (!empty($contents["MAHARAJA_EXPERIENCE1"])) {
                  ?>
                    <div class="accordion-item gray box">
                      <h2 class="accordion-header">
                        <button class="accordion-button gray cor font-50 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOnes" aria-expanded="false" aria-controls="collapseOnes">
                          <span class="red cor-bold"><?= $contents["MAHARAJA_EXPERIENCE1"]["title"] ?></span>
                        </button>
                      </h2>
                      <div id="collapseOnes" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                        <div class="accordion-body">
                          <?= $contents["MAHARAJA_EXPERIENCE1"]["description"] ?>
                        </div>

                      </div>
                    </div>
                  <?php
                  }
                  ?>

                  <?php
                  if (!empty($contents["MAHARAJA_EXPERIENCE2"])) {
                  ?>
                    <div class="accordion-item gray box">
                      <h2 class="accordion-header">
                        <button class="accordion-button gray cor font-50 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwos" aria-expanded="false" aria-controls="collapseTwos">
                          <span class="red cor-bold"><?= $contents["MAHARAJA_EXPERIENCE2"]["title"] ?></span>
                        </button>
                      </h2>
                      <div id="collapseTwos" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                        <div class="accordion-body">
                          <?= $contents["MAHARAJA_EXPERIENCE2"]["description"] ?>
                        </div>
                      </div>
                    </div>

                  <?php
                  }
                  ?>



                  <?php
                  if (!empty($contents["MAHARAJA_EXPERIENCE3"])) {
                  ?>
                    <div class="accordion-item gray box">
                      <h2 class="accordion-header">
                        <button class="accordion-button gray cor font-50 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThrees" aria-expanded="false" aria-controls="collapseThrees">
                          <span class="red cor-bold"><?= $contents["MAHARAJA_EXPERIENCE3"]["title"] ?></span>
                        </button>
                      </h2>
                      <div id="collapseThrees" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                        <div class="accordion-body">
                          <?= $contents["MAHARAJA_EXPERIENCE3"]["description"] ?>
                        </div>
                      </div>
                    </div>
                  <?php
                  }
                  ?>


                  <?php
                  if (!empty($contents["MAHARAJA_EXPERIENCE4"])) {
                  ?>
                    <div class="accordion-item gray box">
                      <h2 class="accordion-header">
                        <button class="accordion-button gray cor font-50 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFours" aria-expanded="false" aria-controls="collapseFours">
                          <span class="red cor-bold"><?= $contents["MAHARAJA_EXPERIENCE4"]["title"] ?></span>
                        </button>
                      </h2>
                      <div id="collapseFours" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                        <div class="accordion-body">
                          <?= $contents["MAHARAJA_EXPERIENCE4"]["description"] ?>
                        </div>
                      </div>
                    </div>
                  <?php
                  }
                  ?>


                </div>
              </div>
              <div class="tab-pane fade" id="pills-inclusions" role="tabpanel" aria-labelledby="pills-inclusions-tab" tabindex="0">

                <?php

                if (!empty($contents["MAHARAJA_INCLUSION"])) {
                ?>
                  <div class="mt-5 gray box p-3 pb-5">
                    <div class="text-center red font-50 cor-bold">
                      <?= $contents["MAHARAJA_INCLUSION"]["title"] ?>
                    </div>
                    <?= $contents["MAHARAJA_INCLUSION"]["description"] ?>
                  </div>
                <?php
                }
                ?>
                <?php

                if (!empty($contents["MAHARAJA_EXCLUSION"])) {
                ?>
                  <div class="mt-5 gray box p-3 pb-5">
                    <div class="text-center red font-50 cor-bold">
                      <?= $contents["MAHARAJA_EXCLUSION"]["title"] ?>
                    </div>
                    <?= $contents["MAHARAJA_EXCLUSION"]["description"] ?>
                  </div>
                <?php
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php
        if (!empty($contents["MAHARAJA_TESTIMONIALS_VIDEOS"])) {
      ?>
        <section class="testi-bg">
          <div class="col-lg-10 mx-lg-auto mx-3 ">
            <div class="d-flex flex-column text-center justify-content-center mb-5" id="testimonialVideos">
              <div>
                <img src="<?= WEBROOT ?>trains/assets/images/pattern_bb.png" class="img-fluid" />
              </div>
              <div class="cor red font-80 lh-1">
                <?= $contents["MAHARAJA_TESTIMONIALS_VIDEOS"]["title"] ?>
              </div>
              <div>
                <img src="<?= WEBROOT ?>trains/assets/images/pattern_bt.png" class="img-fluid" />
              </div>
            </div>
            <?= $contents["MAHARAJA_TESTIMONIALS_VIDEOS"]["description"] ?>
          </div>
        </section>
      <?php
      }
      ?>
      <section class="bg-white">
        <div class="youtube-popup" style="display:none;">
          <div class="overlay"></div>
          <div class="video-container">
            <span class="close"><img src="<?= WEBROOT ?>trains/assets/images/menu-close.png"></span>
            <iframe id="youtube-frame" width="800" height="450" frameborder="0" allowfullscreen></iframe>
          </div>
        </div>
        <div class="modal fade" id="flipbookModal" tabindex="-1" aria-labelledby="flipbookLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content" style="height: 90vh;">
              <div class="modal-header">
                <h5 class="modal-title" id="flipbookLabel">Experience Royalty - Palace on Wheels Brochure</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body p-0">
                <iframe src="https://online.fliphtml5.com/xmnmi/frhz/#p=1" width="100%" height="100%" style="border: none;"></iframe>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-10 mx-lg-auto mx-3  py-5">
          <div id="owl-demo-a" class="owl-carousel owl-theme">
            <?php
            if (!empty($contents["MAHARAJA_VIDEO_YOUTUBE"])) {
            ?>
              <article class="thumbnail item">
                <?= $contents["MAHARAJA_VIDEO_YOUTUBE"]["description"] ?>
                <div class="caption text-center">
                  <div class="flex-text">
                    <div class="cor-bold font-20 red">
                      <?= $contents["MAHARAJA_VIDEO_YOUTUBE"]["title"] ?>
                    </div>
                  </div>
                </div>
              </article>
            <?php
            }
            ?>

            <?php
            if (!empty($contents["MAHARAJA_PDF"])) {
            ?>
              <article class="thumbnail item">
                <?= $contents["MAHARAJA_PDF"]["description"] ?>
                <div class="caption text-center">
                  <div class="flex-text">
                    <div class="cor-bold font-20 red">
                      <?= $contents["MAHARAJA_PDF"]["title"] ?>
                    </div>
                  </div>
                </div>
              </article>
            <?php
            }
            ?>
          </div>
          <div id="pricing-list" class="d-flex flex-column text-center justify-content-center my-5">
            <div><img src="<?= WEBROOT ?>trains/assets/images/pattern_bb.png" class="img-fluid" /></div>
            <div class="cor font-80 lh-1">Tariff</div>
            <div><img src="<?= WEBROOT ?>trains/assets/images/pattern_bt.png" class="img-fluid" /></div>
          </div>
          <ul class="nav nav-pills mb-3 rounded-pill justify-content-center gap-lg-5 gap-3" id="pills-tab-price" role="tablist">
            <li class="nav-item rounded-pill p-2 gray box" role="presentation">
              <button class="nav-link rounded-pill tab-shapes active" id="pills-lista-tab" data-bs-toggle="pill" data-bs-target="#pills-lista" type="button" role="tab" aria-controls="pills-lista" aria-selected="true">
                <?php
                if (!empty($contents["MAHARAJA_TARRIF1"])) {
                  echo $contents["MAHARAJA_TARRIF1"]["title"];
                }
                ?>
              </button>
            </li>
            <li class="nav-item  rounded-pill p-2 gray box" role="presentation">
              <button class="nav-link rounded-pill tab-shapes" id="pills-listb-tab" data-bs-toggle="pill" data-bs-target="#pills-listb" type="button" role="tab" aria-controls="pills-listb" aria-selected="false">
                <?php
                if (!empty($contents["MAHARAJA_TARRIF3"])) {
                  echo $contents["MAHARAJA_TARRIF3"]["title"];
                }
                ?>
              </button>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-lista" role="tabpanel" aria-labelledby="pills-lista-tab" tabindex="0">
              <div class="mt-5 accordion d-flex flex-column gap-3" id="accordionExample">


                <?php if (!empty($contents["MAHARAJA_TARRIF1"])) {
                  echo $contents["MAHARAJA_TARRIF1"]["description"];
                } ?>

                <?php if (!empty($contents["MAHARAJA_TARRIF2"])) {
                  echo $contents["MAHARAJA_TARRIF2"]["description"];
                } ?>
              </div>
            </div>
            <div class="tab-pane fade show" id="pills-listb" role="tabpanel" aria-labelledby="pills-listb-tab" tabindex="0">
              <div class="mt-5 accordion d-flex flex-column gap-3" id="accordionExample">

                <?php if (!empty($contents["MAHARAJA_TARRIF3"])) {
                  echo $contents["MAHARAJA_TARRIF3"]["description"];
                } ?>

                <?php if (!empty($contents["MAHARAJA_TARRIF4"])) {
                  echo $contents["MAHARAJA_TARRIF4"]["description"];
                } ?>
              </div>
            </div>
          </div>
          <div class="my-5">

            <?php if (!empty($contents["MAHARAJA_PRICE_TERMS_AND_CONDITION"])) {
              echo $contents["MAHARAJA_PRICE_TERMS_AND_CONDITION"]["description"];
            } ?>
          </div>
        </div>
      </section>
      <section class="bg-white">
        <div class="col-lg-10 mx-lg-auto mx-3  py-5">

          <div id="pricing-list" class="d-flex flex-column text-center justify-content-center my-5">
            <div><img src="<?= WEBROOT ?>trains/assets/images/pattern_bb.png" class="img-fluid" /></div>
            <div class="cor font-80 lh-1">Departure Dates</div>
            <div><img src="<?= WEBROOT ?>trains/assets/images/pattern_bt.png" class="img-fluid" /></div>
          </div>

          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-lista" role="tabpanel" aria-labelledby="pills-lista-tab" tabindex="0">
              <div class="mt-5 accordion d-flex flex-column gap-3" id="accordionExample">


                <?php if (!empty($contents["MAHARAJA_DATE1"])) {
                  echo $contents["MAHARAJA_DATE1"]["description"];
                } ?>

                <?php if (!empty($contents["MAHARAJA_DATE2"])) {
                  echo $contents["MAHARAJA_DATE2"]["description"];
                } ?>

                <?php if (!empty($contents["MAHARAJA_DATE3"])) {
                  echo $contents["MAHARAJA_DATE3"]["description"];
                } ?>
              </div>
            </div>

          </div>

        </div>
      </section>
      <section class="container-fluid m-0 p-0">
        <div class="modal fade" id="carouselModal" tabindex="-1" aria-labelledby="carouselModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header ps-0 pb-0 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" id="modalBodyContent">
                <!-- Dynamic content will be injected here -->
              </div>
            </div>
          </div>
        </div>
        <div class="position-relative overflow-hidden">
          <img src="<?= WEBROOT ?>trains/assets/images/extension-bg.png" class="img-fluid d-none d-lg-block" />
          <img src="<?= WEBROOT ?>trains/assets/images/extension-bg.png" height="600" class="d-lg-none" />
          <div class="centered col-12 text-lg-start text-center">
            <div class="d-lg-flex align-items-center mx-3 mx-lg-0">

              <?php if (!empty($contents["MAHARAJA_TRIPEXTENSION"])) {
                echo $contents["MAHARAJA_TRIPEXTENSION"]["description"];
              } ?>
            </div>
          </div>
        </div>
      </section>

      <section id="contact-enquiry" class="contact-bg">
        <div class="col-lg-10 mx-lg-auto mx-3 ">
          <div class="d-flex flex-column text-center justify-content-center mb-lg-5">
            <div><img src="<?= WEBROOT ?>trains/assets/images/pattern_bb.png" class="img-fluid" /></div>
            <div class="cor font-80 lh-1">Contact Us</div>
            <div><img src="<?= WEBROOT ?>trains/assets/images/pattern_bt.png" class="img-fluid" /></div>
          </div>
          <div id="contact-enquiry-form" class="d-lg-flex align-items-end justify-content-between align-items-center pb-3">
            <div class="col height-set-old">
              <div>&nbsp;</div>
              <div class="col mb-1 pw-form-old" id="pwfrm">
                <div class="bg-white rounded-2 hal-reg p-3">
                  <?php if (!empty($contents["MAHARAJA_CONTACTUS_HEADING"])) {
                    echo $contents["MAHARAJA_CONTACTUS_HEADING"]["description"];
                  } ?>
                  <form id="bookingForm">
                    <div id="step1">
                      <div class="d-md-flex mb-3 gap-2">
                        <div class="col">
                          <label class="form-label fw-bold">Your Name <span class="red">*</span></label>
                          <input type="text" name="fullName" class="form-control" placeholder="Enter your name" required>
                        </div>
                        <div class="col mb-2 mb-lg-0">
                          <label class="form-label fw-bold">Email <span class="red">*</span></label>
                          <input type="email" name="email" autocomplete="off" class="form-control" placeholder="Enter your email" required>
                        </div>
                      </div>
                      <div class="d-md-flex mb-3 gap-2">
                        <div class="col">
                          <label class="form-label fw-bold">Mobile Number <span class="red">*</span></label>
                          <input type="tel" name="phone" class="form-control" placeholder="Enter your Number" minlength="5" autocomplete="off" required>
                        </div>
                        <div class="col mb-2 mb-lg-0">
                          <label class="form-label fw-bold">Country</label>
                          <input type="text" name="country" autocomplete="off" class="form-control" placeholder="Enter your country">
                        </div>
                      </div>
                      <div class="d-md-flex mb-3 gap-2">
                        <div class="col mb-2 mb-lg-0">
                          <label class="form-label fw-bold">Your Special Requirement</label>
                          <textarea class="form-control" id="enquiryComment" name="enquiryComment" rows="3" placeholder="Please specify here, if any customisation is required."></textarea>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label fw-bold">Enter CAPTCHA <span class="red">*</span></label>
                        <div class="d-md-flex align-items-center justify-content-md-between">
                          <div class="col col-lg-4">
                            <input type="text" name="captcha" id="captcha" maxlength="6" class="form-control text-uppercase" oninput="this.value = this.value.toUpperCase();">

                          </div>
                          <div class="mx-md-1 mt-3 mt-md-0 my-auto captcha-box d-flex">
                            <img id="captchaImage" src="<?= WEBROOT ?>train-captcha" class="rounded-2" width="110" alt="CAPTCHA">
                            <button class="btn btn-sm btn-dark" type="button" onclick="refreshCaptcha()"><i class="fa-solid fa-rotate-right"></i></button>
                          </div>
                          <div class="mt-3 mt-lg-0 mt-md-0">
                            <button type="button" id="next_step" class="btn btn-submit pop-bold">Proceed <img src="<?= WEBROOT ?>trains/assets/images/arrow-right.png" class="ms-2"></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="step2" style="display: none">
                      <div class="d-md-flex mb-3 gap-2">
                        <div class="col">
                          <label class="form-label fw-bold">State</label>
                          <input type="text" name="state" class="form-control" placeholder="Enter your state">
                        </div>
                        <div class="col mb-2 mb-lg-0">
                          <label class="form-label fw-bold">ZIP/Postal Code <span class="red">*</span></label>
                          <input type="text" name="zip" autocomplete="off" class="form-control" required placeholder="ZIP / Postal Code">
                        </div>
                      </div>
                      <div class="d-md-flex mb-3 gap-2">
                        <div class="col mb-2 mb-lg-0">
                          <label class="form-label fw-bold">Season <span class="red">*</span></label>
                          <select name="season" id="seasonId" class="form-select">
                            <option value="">Select Season</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                          </select>
                        </div>
                        <div class="col">
                          <label class="form-label fw-bold">Departure Date <span class="red">*</span></label>
                          <select name="months" id="monthId" class="form-select">
                            <option value="">Select Date</option>
                          </select>
                        </div>
                      </div>
                      <div class="d-md-flex mb-3 gap-2">
                        <div class="col-6 mb-2 mb-lg-0">
                          <label class="form-label fw-bold">No. of Cabins <span class="red">*</span></label>
                          <select name="cabins" id="numCabins" class="form-select"></select>
                        </div>
                      </div>
                      <div id="cabinDetails" class="row justify-content-lg-around"></div>
                      <div class="mb-3">
                        <div class="mt-3 mt-lg-0 mt-md-0 text-center">
                          <button type="submit" class="btn btn-submit pop-bold">Submit <img src="<?= WEBROOT ?>trains/assets/images/arrow-right.png" class="ms-2"></button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-6 d-none d-lg-block">
              <?php if (!empty($contents["contactus"])) {
                echo $contents["contactus"]["description"];
              } ?>
            </div>
          </div>
        </div>
      </section>
      <section class="my-5">
        <div class="col-lg-10 mx-lg-auto mx-3 ">
          <div class="cor-bold text-center font-35 mb-3">
            <?php
            if (!empty($contents["luxuarytrains"])) {
              echo $contents["luxuarytrains"]["title"];
            }
            ?>
          </div>
          <div class="row row-cols-md-3 row-cols-1 text-center">
            <?php if (!empty($contents["luxuarytrains"])) {
              echo $contents["luxuarytrains"]["description"];
            } ?>

          </div>
        </div>
      </section>
    </main>
    <div class="modal fade" id="terms" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content" style="background: #FFF6E7;">
          <div class="modal-header border-0 pb-0">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <?php if (!empty($contents["MAHARAJA_PRICE_TERMS_AND_CONDITION_DETAILS"])) {
              echo $contents["MAHARAJA_PRICE_TERMS_AND_CONDITION_DETAILS"]["description"];
            } ?>

          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="itineraryModal" tabindex="-1">
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <?php /* ?><div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title">Itinerary</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div><?php */ ?>
          
          <div class="modal-content border-0 rounded-3 position-relative">

      <!-- Close Button (top-right corner) -->
      <button type="button"
              class="btn-close position-absolute top-0 end-0 m-3 z-3 grey"
              data-bs-dismiss="modal"></button>

          <div class="modal-body p-1" id="itineraryContent">
            <div class="text-center p-5 m-3">Loading...</div>
          </div>

        </div>
      </div>
    </div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const modalEl = document.getElementById('itineraryModal');
  const modal = new bootstrap.Modal(modalEl);

  document.querySelectorAll('.open-itinerary').forEach(btn => {
    btn.addEventListener('click', function() {
      let url = this.getAttribute('data-url');

      // Show modal
      modal.show();

      // Loader
      document.getElementById('itineraryContent').innerHTML =
        '<div class="text-center p-5">Loading...</div>';

      fetch(url, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(response => response.text())
      .then(html => {
        document.getElementById('itineraryContent').innerHTML = html;

        // ✅ Wait for modal to fully open, then init slider
        modalEl.addEventListener('shown.bs.modal', function initSlider() {

          const slider = $('#itineraryContent .slider');

          // Destroy if already exists
          if (slider.hasClass('slick-initialized')) {
            slider.slick('unslick');
          }

          // Initialize slick
          slider.slick({
            slidesToShow: 3,
    slidesToScroll: 1,
    centerMode: true,
    centerPadding: '0px',
    arrows: false,
    dots: true,
    autoplay: true,
    autoplaySpeed: 3000,

    responsive: [
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                centerMode: true
            }
        }
    ]
          });

          // Remove this event after first run (important)
          modalEl.removeEventListener('shown.bs.modal', initSlider);

        });

      })
      .catch(() => {
        document.getElementById('itineraryContent').innerHTML =
          '<div class="text-danger text-center p-5">Failed to load content</div>';
      });
    });
  });

  // Cleanup on close
  modalEl.addEventListener('hidden.bs.modal', function() {
    const slider = $('#itineraryContent .slider');

    if (slider.hasClass('slick-initialized')) {
      slider.slick('unslick');
    }

    document.getElementById('itineraryContent').innerHTML = '';
  });

});
</script>

<script>
const priceTab = document.getElementById('pills-price-tab');

priceTab.addEventListener('click', function () {

    setTimeout(function () {
        const section = document.querySelector('#pricing-list');
        const tabs = document.querySelector('.sticky-tabs');

        if (section) {
            const offset = tabs.offsetHeight + 80; // adjust spacing
            const top = section.getBoundingClientRect().top + window.pageYOffset - offset;

            window.scrollTo({
                top: top,
                behavior: 'smooth'
            });
        }

    }, 200);
});
</script>
