   <?php /* ?> <header class="position-relative">
    <div id="orange-placeholder"></div>
    <div id="orange-div333" style="margin-top:80px;">
      <?php if (!empty($contents["topheader"])) {
        echo $contents["topheader"]["description"];
      } ?>
      <div class="gray py-1 hal-reg d-none d-lg-block">
        <?php if (!empty($contents["headermenu"])) {
          echo $contents["headermenu"]["description"];
        } ?>
      </div>
      <div class="grays py-2 hal-reg font-18 d-none d-lg-block">
        <div class="col-lg-10 mx-lg-auto mx-3  d-flex align-items-center justify-content-end gap-4 font-18">
          <?php if (!empty($contents["headerphone"])) {
            echo $contents["headerphone"]["description"];
          } ?>
        </div>
      </div>
      <div class="logo-img d-none d-lg-block">
        <?php if (!empty($contents["logo"])) {
          echo $contents["logo"]["description"];
        } ?>
      </div>
    </div>
  </header><?php */ ?>
  <main>
    <section id="banner-2" class="container-fluid position-relative mx-0 px-0 mt-md-5 pt-md-4">
      <?php /* ?><div class="header d-lg-none" id="header-mob">
        <a href="#" class="header-logo"><img src="trains/assets/images/logo.png" width="100" class="img-fluid" /></a>
        <div class="lh-1 mt-2 text-center font-auth" id="blinking-text">
          <div data-bs-toggle="modal" data-bs-target="#authorized-agent" style="cursor:pointer;">
            <div class="cor-bold red">Authorized Sales Agent</div>
            <div>
              <img src="trains/assets/images/authorize.png" class="me-2" />
              <span class="hal-med red font-12">Verify Certificate</span>
            </div>
          </div>
        </div>
        <div class="header-toggle">
          <img src="trains/assets/images/menu-open.png" class="img-fluid" id="header-toggle" />
        </div>
        <nav class="nav navs" id="nav-menu">
          <div class="text-end w-100 me-3">
            <img src="trains/assets/images/menu-close.png" class="img-fluid" id="header-toggle-nav" />
          </div>
          <div class="nav-content bd-grid">
            <div class="nav-menu">
              <ul class="nav-list">
                <li class="nav-item"><a href="/" class="nav-link active">Home</a></li>
                <li class="nav-item"><a href="#pills-tab" class="nav-link ">Itinerary</a></li>
                <li class="nav-item"><a href="#pills-tab" class="nav-link ">Cabins</a></li>
                <li class="nav-item"><a href="#pricing-list" class="nav-link ">Pricing</a></li>
                <li class="nav-item"><a href="#pricing-list" class="nav-link ">Offers</a></li>
                <li class="nav-item"><a href="#contact-enquiry" class="nav-link ">Enquire Now</a></li>
              </ul>
              <div class="p-3 m-2" style="border-radius:12px; border: 2px solid #AB2A2F;">
                <div class="cor font-80 red lh-1 mb-3">Contact Us</div>
                <div class="d-flex flex-column gap-3 font-18">
                  <div>
                    <img src="trains/assets/images/flag_usa.png" class="me-4">
                    <span>+1 332-213-8200</span>
                  </div>
                  <div>
                    <img src="trains/assets/images/flag_uk.png" class="me-4">
                    <span>+44 20-3769-7001</span>
                  </div>
                  <div>
                    <img src="trains/assets/images/flag_aus.png" class="me-4">
                    <span>+61 28-488-0900</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </nav>
      </div><?php */ ?>

      <?php if (!empty($contents["bannerimage"])) {
        echo $contents["bannerimage"]["description"];
      } ?>
      <div class="hero-mob d-lg-none"></div>
      <div class="banner-text text-lg-start text-center">
        <?php if (!empty($contents["bannertext"])) {
          echo $contents["bannertext"]["description"];
        } ?>
      </div>
    </section>
    <section class="about-bg">
      <div class="d-flex flex-column text-center justify-content-center">
        <div><img src="trains/assets/images/pattern_bb.png" class="img-fluid" /></div>
        <div class="cor font-80 lh-1"><?php if (!empty($contents["aboutus"])) {
                                        echo $contents["aboutus"]["title"];
                                      } ?></div>
        <div><img src="trains/assets/images/pattern_bt.png" class="img-fluid" /></div>
      </div>
      <div class="col-lg-8 mx-lg-auto mx-3 text-center" id="aboutUs">
        <?php if (!empty($contents["aboutus"])) {
          echo $contents["aboutus"]["description"];
        } ?>
      </div>
    </section>
    <section class="world-bg">
      <div class="col-lg-10 mx-lg-auto mx-3 ">
        <div class="d-flex flex-column text-center justify-content-center mb-5">
          <div><img src="trains/assets/images/pattern_bb.png" class="img-fluid" /></div>
          <div class="cor red font-80 lh-1">World of Palace on Wheels</div>
          <div><img src="trains/assets/images/pattern_bt.png" class="img-fluid" /></div>
        </div>
        <div>
          <ul class="nav nav-pills gray mob-width p-2 mb-3 rounded-pill justify-content-start gap-md-3 gap-lg-3 gap-xl-4 gap-3 box" id="pills-tab" role="tablist">
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
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-itinerary" role="tabpanel" aria-labelledby="pills-itinerary-tab" tabindex="0">

              <div class="mt-5 accordion accordion-wrapper d-flex flex-column gap-3" id="accordionExample">
                <div class="timeline-line"></div>
                <div class="accordion-row">
                  <div class="timeline-marker">
                    <div class="timeline-step"></div>
                  </div>
                  <div class="accordion-item gray box">
                    <h2 class="accordion-header">
                      <button class="accordion-button gray cor font-50 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <span class="red cor-bold day-w">Day 1 : </span><span class="accordion-heading-label cor-bold"><?php if (!empty($contents["day1"])) {
                                                                                                                          echo $contents["day1"]["title"];
                                                                                                                        } ?></span>
                      </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                      <?php if (!empty($contents["day1"])) {
                        echo $contents["day1"]["description"];
                      } ?>
                    </div>
                  </div>
                </div>
                <div class="accordion-row">
                  <div class="timeline-marker">
                    <div class="timeline-step"></div>
                  </div>
                  <div class="accordion-item gray box">
                    <h2 class="accordion-header">
                      <button class="accordion-button gray cor font-50 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <span class="red cor-bold day-w">Day 2 : </span><span class="accordion-heading-label cor-bold"><?php if (!empty($contents["day2"])) {
                                                                                                                          echo $contents["day2"]["title"];
                                                                                                                        } ?></span>
                      </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                      <?php if (!empty($contents["day2"])) {
                        echo $contents["day2"]["description"];
                      } ?>
                    </div>
                  </div>
                </div>
                <div class="accordion-row">
                  <div class="timeline-marker">
                    <div class="timeline-step"></div>
                  </div>
                  <div class="accordion-item gray box">
                    <h2 class="accordion-header">
                      <button class="accordion-button gray cor font-50 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <span class="red cor-bold day-w">Day 3 : </span><span class="accordion-heading-label cor-bold"><?php if (!empty($contents["day3"])) {
                                                                                                                          echo $contents["day3"]["title"];
                                                                                                                        } ?></span>
                      </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                      <?php if (!empty($contents["day3"])) {
                        echo $contents["day3"]["description"];
                      } ?>
                    </div>
                  </div>
                </div>
                <div class="accordion-row">
                  <div class="timeline-marker">
                    <div class="timeline-step"></div>
                  </div>
                  <div class="accordion-item gray box">
                    <h2 class="accordion-header">
                      <button class="accordion-button gray cor font-50 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <span class="red cor-bold day-w">Day 4 : </span><span class="accordion-heading-label cor-bold"><?php if (!empty($contents["day4"])) {
                                                                                                                          echo $contents["day4"]["title"];
                                                                                                                        } ?></span>
                      </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                      <?php if (!empty($contents["day4"])) {
                        echo $contents["day4"]["description"];
                      } ?>
                    </div>
                  </div>
                </div>
                <div class="accordion-row">
                  <div class="timeline-marker">
                    <div class="timeline-step"></div>
                  </div>
                  <div class="accordion-item gray box">
                    <h2 class="accordion-header">
                      <button class="accordion-button gray cor font-50 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        <span class="red cor-bold day-w">Day 5 : </span><span class="accordion-heading-label cor-bold"><?php if (!empty($contents["day5"])) {
                                                                                                                          echo $contents["day5"]["title"];
                                                                                                                        } ?></span>
                      </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                      <?php if (!empty($contents["day5"])) {
                        echo $contents["day5"]["description"];
                      } ?>
                    </div>
                  </div>
                </div>
                <div class="accordion-row">
                  <div class="timeline-marker">
                    <div class="timeline-step"></div>
                  </div>
                  <div class="accordion-item gray box">
                    <h2 class="accordion-header">
                      <button class="accordion-button gray cor font-50 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        <span class="red cor-bold day-w">Day 6 : </span><span class="accordion-heading-label cor-bold"><?php if (!empty($contents["day6"])) {
                                                                                                                          echo $contents["day6"]["title"];
                                                                                                                        } ?></span>
                      </button>
                    </h2>
                    <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                      <?php if (!empty($contents["day6"])) {
                        echo $contents["day6"]["description"];
                      } ?>
                    </div>
                  </div>
                </div>
                <div class="accordion-row">
                  <div class="timeline-marker">
                    <div class="timeline-step"></div>
                  </div>
                  <div class="accordion-item gray box">
                    <h2 class="accordion-header">
                      <button class="accordion-button gray cor font-50 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                        <span class="red cor-bold day-w">Day 7 : </span><span class="accordion-heading-label cor-bold"><?php if (!empty($contents["day7"])) {
                                                                                                                          echo $contents["day7"]["title"];
                                                                                                                        } ?></span>
                      </button>
                    </h2>
                    <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                      <?php if (!empty($contents["day7"])) {
                        echo $contents["day7"]["description"];
                      } ?>
                    </div>
                  </div>
                </div>
                <div class="accordion-row">
                  <div class="timeline-marker">
                    <div class="timeline-step"></div>
                  </div>
                  <div class="accordion-item gray box">
                    <h2 class="accordion-header">
                      <button class="accordion-button gray cor font-50 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                        <span class="red cor-bold day-w">Day 8 : </span><span class="accordion-heading-label cor-bold"><?php if (!empty($contents["day8"])) {
                                                                                                                          echo $contents["day8"]["title"];
                                                                                                                        } ?></span>
                      </button>
                    </h2>
                    <div id="collapseEight" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                      <?php if (!empty($contents["day8"])) {
                        echo $contents["day8"]["description"];
                      } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-cabins" role="tabpanel" aria-labelledby="pills-cabins-tab" tabindex="0">
              <div class="mt-5 gray box p-3 pb-5">
                <div class="text-center red font-50 cor-bold"><?php if (!empty($contents["cabin1"])) {
                                                                echo $contents["cabin1"]["title"];
                                                              } ?></div>
                <?php if (!empty($contents["cabin1"])) {
                  echo $contents["cabin1"]["description"];
                } ?>

              </div>
              <div class="mt-5 gray box p-3 pb-5">
                <div class="text-center red font-50 cor-bold"><?php if (!empty($contents["cabin2"])) {
                                                                echo $contents["cabin2"]["title"];
                                                              } ?></div>
                <?php if (!empty($contents["cabin2"])) {
                  echo $contents["cabin2"]["description"];
                } ?>
              </div>
              <div class="mt-5 gray box p-3 pb-5">
                <div class="text-center red font-50 cor-bold"><?php if (!empty($contents["cabin3"])) {
                                                                echo $contents["cabin3"]["title"];
                                                              } ?></div>
                <?php if (!empty($contents["cabin3"])) {
                  echo $contents["cabin3"]["description"];
                } ?>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-facilities" role="tabpanel" aria-labelledby="pills-facilities-tab" tabindex="0">
              <div class="mt-5 gray box p-3 pb-5">
                <div class="text-center red font-50 cor-bold"><?php if (!empty($contents["facility1"])) {
                                                                echo $contents["facility1"]["title"];
                                                              } ?></div>

                <?php if (!empty($contents["facility1"])) {
                  echo $contents["facility1"]["description"];
                } ?>
              </div>
              <div class="mt-5 gray box p-3 pb-5">
                <div class="text-center red font-50 cor-bold"><?php if (!empty($contents["facility2"])) {
                                                                echo $contents["facility2"]["title"];
                                                              } ?></div>

                <?php if (!empty($contents["facility2"])) {
                  echo $contents["facility2"]["description"];
                } ?>
              </div>
              <div class="mt-5 gray box p-3 pb-5">
                <div class="text-center red font-50 cor-bold"><?php if (!empty($contents["facility3"])) {
                                                                echo $contents["facility3"]["title"];
                                                              } ?></div>

                <?php if (!empty($contents["facility3"])) {
                  echo $contents["facility3"]["description"];
                } ?>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-experiences" role="tabpanel" aria-labelledby="pills-experiences-tab" tabindex="0">
              <div class="mt-5 accordion d-flex flex-column gap-3" id="accordionExamples">
                <div class="accordion-item gray box">
                  <h2 class="accordion-header">
                    <button class="accordion-button gray cor font-50 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOnes" aria-expanded="false" aria-controls="collapseOnes">
                      <span class="red cor-bold"><?php if (!empty($contents["experience1"])) {
                                                    echo $contents["experience1"]["title"];
                                                  } ?></span>
                    </button>
                  </h2>
                  <div id="collapseOnes" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                    <div class="accordion-body">
                      <!-- <div class="d-lg-flex">
                        <div class="col order-sm-2">
                          <div class="cor font-50 lh-1 mb-4 d-lg-none">Elephant Ride in Jaipur</div>
                          <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <div class="img-carousl">
                                  <img src="trains/assets/images/elephant-ride.png" class="d-block w-100" alt="...">
                                </div>
                              </div>
                              <div class="carousel-item">
                                <div class="img-carousl">
                                  <img src="trains/assets/images/elephant-ride.png" class="d-block w-100" alt="...">
                                </div>
                              </div>
                              <div class="carousel-item">
                                <div class="img-carousl">
                                  <img src="trains/assets/images/elephant-ride.png" class="d-block w-100" alt="...">
                                </div>
                              </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                            </button>
                          </div>
                        </div>
                        <div class="col-lg-7 me-lg-5 order-sm-1">
                          
                          <p class="hal-reg mt-3 mt-lg-0 font-18">Experience the grandeur of Jaipur with a majestic elephant ride up to the historic Amber Fort. As you ascend the cobbled path, take in the panoramic views of the Pink City, immersing yourself in the regal ambiance reminiscent of the Maharajas' era.</p>
                        </div>
                      </div> -->
                      <?php if (!empty($contents["experience1"])) {
                        echo $contents["experience1"]["description"];
                      } ?>
                    </div>

                  </div>
                </div>
                <div class="accordion-item gray box">
                  <h2 class="accordion-header">
                    <button class="accordion-button gray cor font-50 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwos" aria-expanded="false" aria-controls="collapseTwos">
                      <span class="red cor-bold"><?php if (!empty($contents["experience2"])) {
                                                    echo $contents["experience2"]["title"];
                                                  } ?></span>
                    </button>
                  </h2>
                  <div id="collapseTwos" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                    <div class="accordion-body">

                      <?php if (!empty($contents["experience2"])) {
                        echo $contents["experience2"]["description"];
                      } ?>
                    </div>
                  </div>
                </div>
                <div class="accordion-item gray box">
                  <h2 class="accordion-header">
                    <button class="accordion-button gray cor font-50 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThrees" aria-expanded="false" aria-controls="collapseThrees">
                      <span class="red cor-bold"><?php if (!empty($contents["experience3"])) {
                                                    echo $contents["experience3"]["title"];
                                                  } ?></span>
                    </button>
                  </h2>
                  <div id="collapseThrees" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                    <div class="accordion-body">

                      <?php if (!empty($contents["experience3"])) {
                        echo $contents["experience3"]["description"];
                      } ?>
                    </div>
                  </div>
                </div>
                <div class="accordion-item gray box">
                  <h2 class="accordion-header">
                    <button class="accordion-button gray cor font-50 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFours" aria-expanded="false" aria-controls="collapseFours">
                      <span class="red cor-bold"><?php if (!empty($contents["experience4"])) {
                                                    echo $contents["experience4"]["title"];
                                                  } ?></span>
                    </button>
                  </h2>
                  <div id="collapseFours" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                    <div class="accordion-body">

                      <?php if (!empty($contents["experience4"])) {
                        echo $contents["experience4"]["description"];
                      } ?>
                    </div>
                  </div>
                </div>
                <div class="accordion-item gray box">
                  <h2 class="accordion-header">
                    <button class="accordion-button gray cor font-50 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFives" aria-expanded="false" aria-controls="collapseFives">
                      <span class="red cor-bold"><?php if (!empty($contents["experience5"])) {
                                                    echo $contents["experience5"]["title"];
                                                  } ?></span>
                    </button>
                  </h2>
                  <div id="collapseFives" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                    <div class="accordion-body">

                      <?php if (!empty($contents["experience5"])) {
                        echo $contents["experience5"]["description"];
                      } ?>
                    </div>
                  </div>
                </div>
                <div class="accordion-item gray box">
                  <h2 class="accordion-header">
                    <button class="accordion-button gray cor font-50 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSixs" aria-expanded="false" aria-controls="collapseSixs">
                      <span class="red cor-bold"><?php if (!empty($contents["experience6"])) {
                                                    echo $contents["experience6"]["title"];
                                                  } ?></span>
                    </button>
                  </h2>
                  <div id="collapseSixs" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                    <div class="accordion-body">

                      <?php if (!empty($contents["experience6"])) {
                        echo $contents["experience6"]["description"];
                      } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-inclusions" role="tabpanel" aria-labelledby="pills-inclusions-tab" tabindex="0">
              <div class="mt-5">

                <?php if (!empty($contents["inclusions"])) {
                  echo $contents["inclusions"]["description"];
                } ?>
              </div>
              <div class="mt-5 pb-5">

                <?php if (!empty($contents["exclusions"])) {
                  echo $contents["exclusions"]["description"];
                } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="testi-bg">
      <div class="col-lg-10 mx-lg-auto mx-3 ">
        <div class="d-flex flex-column text-center justify-content-center mb-5" id="testimonialVideos">
          <div><img src="trains/assets/images/pattern_bb.png" class="img-fluid" /></div>
          <div class="cor red font-80 lh-1"><?php if (!empty($contents["testimonialsvideos"])) {
                                              echo $contents["testimonialsvideos"]["title"];
                                            } ?></div>
          <div><img src="trains/assets/images/pattern_bt.png" class="img-fluid" /></div>
        </div>

        <?php if (!empty($contents["testimonialsvideos"])) {
          echo $contents["testimonialsvideos"]["description"];
        } ?>
      </div>
    </section>
    <section class="bg-white">
      <div class="youtube-popup" style="display:none;">
        <div class="overlay"></div>
        <div class="video-container">
          <span class="close"><img src="trains/assets/images/menu-close.png"></span>
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
          <article class="thumbnail item">

            <?php if (!empty($contents["powfilm"])) {
              echo $contents["powfilm"]["description"];
            } ?>
            <div class="caption text-center">
              <div class="flex-text">
                <div class="cor-bold font-20 red"><?php if (!empty($contents["powfilm"])) {
                                                    echo $contents["powfilm"]["title"];
                                                  } ?></div>
              </div>
            </div>
          </article>
          <article class="thumbnail item">

            <?php if (!empty($contents["powpdf"])) {
              echo $contents["powpdf"]["description"];
            } ?>
            <div class="caption text-center">
              <div class="flex-text">
                <div class="cor-bold font-20 red"><?php if (!empty($contents["powpdf"])) {
                                                    echo $contents["powpdf"]["title"];
                                                  } ?></div>
              </div>
            </div>
          </article>
        </div>
        <div id="pricing-list" class="d-flex flex-column text-center justify-content-center my-5">
          <div><img src="trains/assets/images/pattern_bb.png" class="img-fluid" /></div>
          <div class="cor font-80 lh-1">Tariff</div>
          <div><img src="trains/assets/images/pattern_bt.png" class="img-fluid" /></div>
        </div>
        <ul class="nav nav-pills mb-3 rounded-pill justify-content-center gap-lg-5 gap-3" id="pills-tab-price" role="tablist">
          <li class="nav-item rounded-pill p-2 gray box" role="presentation">
            <button class="nav-link rounded-pill tab-shapes active" id="pills-lista-tab" data-bs-toggle="pill" data-bs-target="#pills-lista" type="button" role="tab" aria-controls="pills-lista" aria-selected="true"><?php if (!empty($contents["tarrif1"])) {
                                                                                                                                                                                                                          echo $contents["tarrif1"]["title"];
                                                                                                                                                                                                                        } ?></button>
          </li>
          <li class="nav-item  rounded-pill p-2 gray box" role="presentation">
            <button class="nav-link rounded-pill tab-shapes" id="pills-listb-tab" data-bs-toggle="pill" data-bs-target="#pills-listb" type="button" role="tab" aria-controls="pills-listb" aria-selected="false"><?php if (!empty($contents["tarrif3"])) {
                                                                                                                                                                                                                    echo $contents["tarrif3"]["title"];
                                                                                                                                                                                                                  } ?></button>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-lista" role="tabpanel" aria-labelledby="pills-lista-tab" tabindex="0">
            <div class="mt-5 accordion d-flex flex-column gap-3" id="accordionExample">

              <?php if (!empty($contents["tarrif1"])) {
                echo $contents["tarrif1"]["description"];
              } ?>

              <?php if (!empty($contents["tarrif2"])) {
                echo $contents["tarrif2"]["description"];
              } ?>
            </div>
          </div>
          <div class="tab-pane fade show" id="pills-listb" role="tabpanel" aria-labelledby="pills-listb-tab" tabindex="0">
            <div class="mt-5 accordion d-flex flex-column gap-3" id="accordionExample">

              <?php if (!empty($contents["tarrif3"])) {
                echo $contents["tarrif3"]["description"];
              } ?>

              <?php if (!empty($contents["tarrif4"])) {
                echo $contents["tarrif4"]["description"];
              } ?>
            </div>
          </div>
        </div>
        <div class="my-5">

          <?php if (!empty($contents["tnc"])) {
            echo $contents["tnc"]["description"];
          } ?>
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
        <img src="trains/assets/images/extension-bg.png" class="img-fluid d-none d-lg-block" />
        <img src="trains/assets/images/extension-bg.png" height="600" class="d-lg-none" />
        <div class="centered col-12 text-lg-start text-center">
          <div class="d-lg-flex align-items-center mx-3 mx-lg-0">

            <?php if (!empty($contents["tripextension"])) {
              echo $contents["tripextension"]["description"];
            } ?>
          </div>
        </div>
      </div>
    </section>
    <?php /* ?> 
   <section id="contact-enquiry" class="contact-bg">
      <div class="col-lg-10 mx-lg-auto mx-3 ">
        <div class="d-flex flex-column text-center justify-content-center mb-lg-5">
          <div><img src="trains/assets/images/pattern_bb.png" class="img-fluid" /></div>
          <div class="cor font-80 lh-1">Contact Us</div>
          <div><img src="trains/assets/images/pattern_bt.png" class="img-fluid" /></div>
        </div>
        <div class="d-lg-flex align-items-end justify-content-between pb-3">
          <div class="col-6 height-set">
            <div>&nbsp;</div>
            <div class="col mb-4 pw-form" id="pwfrm">
              <div class="bg-white rounded-2 hal-reg p-3">
                <?php if(!empty($contents["contactusheading"])){ echo $contents["contactusheading"]["description"]; } ?>
                <form id="bookingForm">
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
                        <img id="captchaImage" src="captcha.php" class="rounded-2" width="110" alt="CAPTCHA">
                        <button class="btn btn-sm btn-dark" type="button" onclick="refreshCaptcha()"><i class="fa-solid fa-rotate-right"></i></button>
                      </div>
                      <div class="mt-3 mt-lg-0 mt-md-0">
                        <button type="submit" class="btn btn-submit pop-bold">Submit <img src="trains/assets/images/arrow-right.png" class="ms-2"></button>
                      </div>
                    </div>
                  </div>

                </form>
              </div>
            </div>
          </div>
          <div class="col-6 d-none d-lg-block">
            
            <?php if(!empty($contents["contactus"])){ echo $contents["contactus"]["description"]; } ?>
          </div>
        </div>
      </div>
    </section>
    <?php */ ?>

    <section id="contact-enquiry" class="contact-bg">
      <div class="col-lg-10 mx-lg-auto mx-3 ">
        <div class="d-flex flex-column text-center justify-content-center mb-lg-5">
          <div><img src="trains/assets/images/pattern_bb.png" class="img-fluid" /></div>
          <div class="cor font-80 lh-1">Contact Us</div>
          <div><img src="trains/assets/images/pattern_bt.png" class="img-fluid" /></div>
        </div>
        <div  id="contact-enquiry-form" class="d-lg-flex align-items-end justify-content-between align-items-center pb-3">
          <div class="col height-set-old">
            <div>&nbsp;</div>
            <div class="col mb-1 pw-form-old" id="pwfrm">
              <div class="bg-white rounded-2 hal-reg p-3">
                <?php if (!empty($contents["contactusheading"])) {
                  echo $contents["contactusheading"]["description"];
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
                          <img id="captchaImage" src="<?=WEBROOT?>train-captcha" class="rounded-2" width="110" alt="CAPTCHA">
                          <button class="btn btn-sm btn-dark" type="button" onclick="refreshCaptcha()"><i class="fa-solid fa-rotate-right"></i></button>
                        </div>
                        <div class="mt-3 mt-lg-0 mt-md-0">
                          <button type="button" id="next_step" class="btn btn-submit pop-bold">Proceed <img src="trains/assets/images/arrow-right.png" class="ms-2"></button>
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
                        <button type="submit" class="btn btn-submit pop-bold">Submit <img src="trains/assets/images/arrow-right.png" class="ms-2"></button>
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