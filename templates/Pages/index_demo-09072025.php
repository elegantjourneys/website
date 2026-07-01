<style>
.nav-tabs .nav-link {
   color: #000;
   white-space: nowrap;
   &:hover {
     text-decoration: none;
   }
}

.nav-tabs .nav-item.show .nav-link,
.nav-tabs .nav-link.active {
  border-radius: 0;
  background-color: #e8f4ff;
  border-bottom: 0px !important;
}
</style>
<section class="heroSection heroSection-homePage w-100 p-0">
        <div
          id="homePageCarousel"
          class="carousel slide position-relative"
          data-bs-ride="carousel"
          data-bs-interval="3000"
        >
          <div class="carousel-indicators">
            <button
              type="button"
              data-bs-target="#homePageCarousel"
              data-bs-slide-to="0"
              class="active"
              aria-current="true"
              aria-label="Slide 1"
            ></button>
            <button
              type="button"
              data-bs-target="#homePageCarousel"
              data-bs-slide-to="1"
              aria-label="Slide 2"
            ></button>
            <button
              type="button"
              data-bs-target="#homePageCarousel"
              data-bs-slide-to="2"
              aria-label="Slide 3"
            ></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img
                src="<?=WEBROOT?>version2/assets/images/home-page-banner.png"
                class="d-block w-100"
                alt="..."
              />
            </div>
            <div class="carousel-item">
              <img
                src="<?=WEBROOT?>version2/assets/images/home-page-banner.png"
                class="d-block w-100"
                alt="..."
              />
            </div>
            <div class="carousel-item">
              <img
                src="<?=WEBROOT?>version2/assets/images/home-page-banner.png"
                class="d-block w-100"
                alt="..."
              />
            </div>
          </div>
          <div
            class="w-75 h-100 position-absolute top-50 start-50 translate-middle text-center text-white"
            style="place-content: center"
          >
            <h1 class="fw-bold custom-heading">
              Unforgettable Journeys, Tailored for You
            </h1>
            <p class="my-4">
              Handpicked destinations, seamless experiences, and custom tours
            </p>
            <button class="btn bg-white text-teal py-2 px-3 fw-semibold z-3">
              Explore Tours
            </button>
          </div>
        </div>
      </section>
      <section class="w-100 py-4">
        <h3 class="fw-semibold mb-5 mt-3">Most Popular Tours</h3>
        <div class="row">
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
              <div class="position-relative">
                <span
                  class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5"
                  >Private Tour</span
                >
                <div class="cutomGroup position-absolute">
                  <i
                    class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"
                  ></i>
                </div>
                <img
                  src="<?=WEBROOT?>version2/assets/images/3DayTour.png"
                  class="card-img-top tour-image"
                  alt="3 Day Golden Triangle Tour"
                  data-default="<?=WEBROOT?>version2/assets/images/3DayTour.png"
                  data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg"
                />
              </div>
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                  <p class="fs-6 fw-semibold m-0 lh-g col-9">
                    3 Day Golden Triangle Tour
                  </p>
                  <span class="small text-secondary text-end col-3"
                    >2 Nights</span
                  >
                </div>
                <p class="small fw-medium my-2">Tour Code : GT-322</p>
                <p class="small fw-regular m-0 text-secondary">
                  Delhi → Agra → Jaipur
                </p>
                <div
                  class="d-flex align-items-center justify-content-between mt-3"
                >
                  <h4 class="fw-semibold text-teal m-0">
                    ₹14,411 <span class="fs-10 text-secondary">onwards</span>
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
                <span
                  class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5"
                  >Private Tour</span
                >
                <div class="cutomGroup position-absolute">
                  <i
                    class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"
                  ></i>
                </div>
                <img
                  src="<?=WEBROOT?>version2/assets/images/4DayTour.png"
                  class="card-img-top tour-image"
                  alt="4 Day Golden Triangle Tour"
                  data-default="<?=WEBROOT?>version2/assets/images/4DayTour.png"
                  data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg"
                />
              </div>
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                  <p class="fs-6 fw-semibold m-0 lh-g col-9">
                    4 Day Golden Triangle Tour
                  </p>
                  <span class="small text-secondary text-end col-3"
                    >3 Nights</span
                  >
                </div>
                <p class="small fw-medium my-2">Tour Code : GT-323</p>
                <p class="small fw-regular m-0 text-secondary">
                  Delhi → Agra → Jaipur
                </p>
                <div
                  class="d-flex align-items-center justify-content-between mt-3"
                >
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
                <span
                  class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5"
                  >Private Tour</span
                >
                <div class="cutomGroup position-absolute">
                  <i
                    class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"
                  ></i>
                </div>
                <img
                  src="<?=WEBROOT?>version2/assets/images/5DayTour.png"
                  class="card-img-top tour-image"
                  alt="5 Day Golden Triangle Tour"
                  data-default="<?=WEBROOT?>version2/assets/images/5DayTour.png"
                  data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg"
                />
              </div>
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                  <p class="fs-6 fw-semibold m-0 lh-g col-9">
                    5 Day Golden Triangle Tour
                  </p>
                  <span class="small text-secondary text-end col-3"
                    >4 Nights</span
                  >
                </div>
                <p class="small fw-medium my-2">Tour Code : GT-189</p>
                <p class="small fw-regular m-0 text-secondary">
                  Delhi → Jaipur → Agra
                </p>
                <div
                  class="d-flex align-items-center justify-content-between mt-3"
                >
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
        </div>
      </section>
      <section class="w-100 py-4">
        <div class="row rounded-3 px-3" style="background: #f5f5f5">
          <div
            class="col-md-6 py-3 pb-5 d-flex gap-4 justify-content-between flex-column"
          >
            <h1>Mastering the art of luxury travel for 10+ years</h1>
            <div>
              <div class="row">
                <div class="col-4">
                  <h1 class="text-teal fw-bold">10K+</h1>
                  <p class="small fw-semibold text-muted">Travelers Served</p>
                </div>
                <div class="col-4">
                  <h1 class="text-teal fw-bold">4.9/5</h1>
                  <p class="small fw-semibold text-muted">
                    Customer Satisfaction
                  </p>
                </div>
                <div class="col-4">
                  <h1 class="text-teal fw-bold">95%</h1>
                  <p class="small fw-semibold text-muted">
                    Repeat & Referral Rate
                  </p>
                </div>
              </div>
            </div>
            <p class="text-muted">
              Elegant Journeys is a dedicated luxury travel agency in India
              offering an array of high quality services with first-hand
              knowledge on India tours, Bhutan tours and Nepal tours.
            </p>
            <div
              class="carousel-indicator w-75 d-flex gap-2 px-1 align-items-center"
            >
              <span
                class="d-inline-block bg-primary rounded-pill"
                style="height: 2px; width: 40%"
              ></span>
              <span
                class="d-inline-block bg-primary rounded-pill"
                style="height: 2px; width: 20%; opacity: 0.5"
              ></span>
              <span
                class="d-inline-block bg-primary rounded-pill"
                style="height: 2px; width: 20%; opacity: 0.5"
              ></span>
              <span
                class="d-inline-block bg-primary rounded-pill"
                style="height: 2px; width: 20%; opacity: 0.5"
              ></span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="slider-container overflow-hidden" style="height: 400px">
              <div id="sliderInner" class="d-flex flex-column gap-4">
                <div
                  class="slider-card bg-white p-4 pb-0 rounded-3 border border-1 border-secondary-subtle"
                >
                  <h5 class="fw-semibold">About Elegant Journeys</h5>
                  <p class="mt-4 text-secondary">
                    Elegant Journeys is a dedicated luxury travel agency in
                    India offering an array of high quality services with
                    first-hand knowledge on India tours, Bhutan tours and Nepal
                    tours. Offering spectacular range of Rajasthan tours, Kerala
                    tours, private north India tours, we not only plan but book
                    trips for families, friends, couples, individuals and group
                    tours, and ensure personalized services with great value for
                    money. Our customized services and tailored luxury tours
                    promise for the best travel experience in the Incredible
                    India.
                  </p>
                  <div>
                    <img
                      class="img-fluid rounded-top-3"
                      src="<?=WEBROOT?>version2/assets/images/test-img.png"
                      alt=""
                    />
                  </div>
                </div>
                <div
                  class="slider-card bg-white p-4 pb-0 rounded-3 border border-1 border-secondary-subtle"
                >
                  <h5 class="fw-semibold">About Elegant Journeys</h5>
                  <p class="mt-4 text-secondary">
                    Elegant Journeys is a dedicated luxury travel agency in
                    India offering an array of high quality services with
                    first-hand knowledge on India tours, Bhutan tours and Nepal
                    tours. Offering spectacular range of Rajasthan tours, Kerala
                    tours, private north India tours, we not only plan but book
                    trips for families, friends, couples, individuals and group
                    tours, and ensure personalized services with great value for
                    money. Our customized services and tailored luxury tours
                    promise for the best travel experience in the Incredible
                    India.
                  </p>
                  <div>
                    <img
                      class="img-fluid rounded-top-3"
                      src="<?=WEBROOT?>version2/assets/images/test-img.png"
                      alt=""
                    />
                  </div>
                </div>
                <div
                  class="slider-card bg-white p-4 pb-0 rounded-3 border border-1 border-secondary-subtle"
                >
                  <h5 class="fw-semibold">About Elegant Journeys</h5>
                  <p class="mt-4 text-secondary">
                    Elegant Journeys is a dedicated luxury travel agency in
                    India offering an array of high quality services with
                    first-hand knowledge on India tours, Bhutan tours and Nepal
                    tours. Offering spectacular range of Rajasthan tours, Kerala
                    tours, private north India tours, we not only plan but book
                    trips for families, friends, couples, individuals and group
                    tours, and ensure personalized services with great value for
                    money. Our customized services and tailored luxury tours
                    promise for the best travel experience in the Incredible
                    India.
                  </p>
                  <div>
                    <img
                      class="img-fluid rounded-top-3"
                      src="<?=WEBROOT?>version2/assets/images/test-img.png"
                      alt=""
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- new ui start -->
      <section class="w-100 py-4">
        <div class="text-center">
          <h1 class="fw-semibold">Our Signature Services</h1>
          <p class="text-muted maxWidth-[350px] w-100 mx-auto mt-3">
            From handpicked stays to custom itineraries, we take care of every
            detail
          </p>
        </div>
        <div class="mt-5">
          <div class="row">
            <div class="col-md-6 col-lg-4">
              <img
                class="img-fluid"
                src="<?=WEBROOT?>version2/assets/images/EJ-Homepage (3).png"
                alt="1"
              />
              <div>
                <h5 class="fw-semibold mt-3">Tailor-Made Itineraries</h5>
                <p class="text-muted">
                  Trips crafted around your interests & preferences
                </p>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <img
                class="img-fluid"
                src="<?=WEBROOT?>version2/assets/images/EJ-Homepage (1).png"
                alt="1"
              />
              <div>
                <h5 class="fw-semibold mt-3">Luxury & Boutique Stays</h5>
                <p class="text-muted">Handpicked accommodations for comfort</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <img
                class="img-fluid"
                src="<?=WEBROOT?>version2/assets/images/EJ-Homepage (2).png"
                alt="1"
              />
              <div>
                <h5 class="fw-semibold mt-3">Cultural & Experiential Tours</h5>
                <p class="text-muted">
                  Immersive journeys that go beyond the surface
                </p>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <img
                class="img-fluid"
                src="<?=WEBROOT?>version2/assets/images/EJ-Homepage (6).png"
                alt="1"
              />
              <div>
                <h5 class="fw-semibold mt-3">Group & Corporate Travel</h5>
                <p class="text-muted">
                  Incentives, events, and group arrangements
                </p>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <img
                class="img-fluid"
                src="<?=WEBROOT?>version2/assets/images/EJ-Homepage (4).png"
                alt="1"
              />
              <div>
                <h5 class="fw-semibold mt-3">24x7 On-Trip Assistance</h5>
                <p class="text-muted">Dedicated support while you travel</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <img
                class="img-fluid"
                src="<?=WEBROOT?>version2/assets/images/EJ-Homepage (5).png"
                alt="1"
              />
              <div>
                <h5 class="fw-semibold mt-3">Local Expertise</h5>
                <p class="text-muted">
                  In-depth insights from destination specialists
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="w-100 py-4">
        <div>
          <h1 class="fw-semibold">Plan Your Journey, Your Way</h1>
          <p class="text-muted maxWidth-[450px] w-100 mt-3">
            From spiritual getaways to adrenaline-packed adventures, find the
            travel style that suits you best
          </p>
        </div>
        <div>
          <!-- Nav tabs -->
          <ul
            class="w-100 overflow-x-auto overflow-y-hidden flex-nowrap nav nav-tabs justify-content-between"
            id="myTab"
            role="tablist"
          >
            <li class="nav-item" role="presentation">
              <button
                class="nav-link active"
                id="home-tab"
                data-bs-toggle="tab"
                data-bs-target="#culturalTour"
                type="button"
                role="tab"
                aria-controls="home"
                aria-selected="true"
              >
                Cultural Tours
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link"
                id="profile-tab"
                data-bs-toggle="tab"
                data-bs-target="#adventureWildlife"
                type="button"
                role="tab"
                aria-controls="profile"
                aria-selected="false"
              >
                Adventure & Wildlife
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link"
                id="contact-tab"
                data-bs-toggle="tab"
                data-bs-target="#wellnessSpirituality"
                type="button"
                role="tab"
                aria-controls="contact"
                aria-selected="false"
              >
                Wellness & Spirituality
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link"
                id="contact-tab"
                data-bs-toggle="tab"
                data-bs-target="#luxuryEscape"
                type="button"
                role="tab"
                aria-controls="contact"
                aria-selected="false"
              >
                Luxury Escapes
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link"
                id="contact-tab"
                data-bs-toggle="tab"
                data-bs-target="#familyTour"
                type="button"
                role="tab"
                aria-controls="contact"
                aria-selected="false"
              >
                Family-Friendly Tours
              </button>
            </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content p-3 border-0 mt-5" id="myTabContent">
            <div
              class="tab-pane fade show active"
              id="culturalTour"
              role="tabpanel"
              aria-labelledby="home-tab"
            >
              <div
                class="row align-items-center flex-column-reverse flex-lg-row gap-4 gap-lg-0"
              >
                <div class="col-lg-7">
                  <h3 class="fw-semibold">Cultural Tours</h3>
                  <p class="text-black-50">
                    Experience the richness of centuries-old traditions, vibrant
                    festivals, and timeless architecture. Our cultural tours are
                    designed to immerse you in the stories behind the
                    destinations — from royal palaces and heritage forts to
                    bustling bazaars and local art forms. Whether you're walking
                    through Jaipur’s pink alleys, attending a traditional dance
                    in Kerala, or exploring the temples of Varanasi, every
                    moment is a chapter in history.
                  </p>
                  <h6 class="fw-semibold">Best For:</h6>
                  <p style="word-wrap: break-word">
                    Delhi&nbsp;&bull;&nbsp;Varanasi&nbsp;&bull;&nbsp;Agra&nbsp;&bull;&nbsp;Ranthambore&nbsp;&bull;&nbsp;Jaipur&nbsp;&bull;&nbsp;Jodhpur&nbsp;&bull;&nbsp;Udaipur
                  </p>
                  <div
                    class="w-100 btn-group gap-3 mt-2 flex-column flex-md-row ms-auto"
                  >
                    <button
                      class="py-2 px-3 border-0 bgC-[#25365C] text-white fw-semibold rounded-2"
                    >
                      View Cultural Itineraries
                    </button>
                    <button
                      style="border: 1.5px solid #25365c"
                      class="py-2 px-3 rounded-2 bgC-[transparent] color-[#25365C] fw-semibold"
                    >
                      Customize Your Cultural Tour
                    </button>
                  </div>
                </div>
                <div class="col-lg-5">
                  <img
                    class="img-fluid"
                    src="<?=WEBROOT?>version2/assets/images/EJ-Homepage-Tab1.png"
                    alt="a"
                  />
                </div>
              </div>
            </div>
            <div
              class="tab-pane fade"
              id="adventureWildlife"
              role="tabpanel"
              aria-labelledby="profile-tab"
            >
              <h4>Profile Tab Content</h4>
              <p>This is the content for the Profile tab.</p>
            </div>
            <div
              class="tab-pane fade"
              id="wellnessSpirituality"
              role="tabpanel"
              aria-labelledby="contact-tab"
            >
              <h4>Contact Tab Content</h4>
              <p>This is the content for the Contact tab.</p>
            </div>
            <div
              class="tab-pane fade"
              id="luxuryEscape"
              role="tabpanel"
              aria-labelledby="contact-tab"
            >
              <h4>Contact Tab Content</h4>
              <p>This is the content for the Contact tab.</p>
            </div>
            <div
              class="tab-pane fade"
              id="familyTour"
              role="tabpanel"
              aria-labelledby="contact-tab"
            >
              <h4>Contact Tab Content</h4>
              <p>This is the content for the Contact tab.</p>
            </div>
          </div>
        </div>
      </section>
      <!-- new ui end -->
      <section class="w-100 py-4">
        <h2>
          Your Next Favorite <br />
          Place Awaits
        </h2>

        <div class="d-flex gap-2 mt-4 overflow-x-auto">
          <img
            src="<?=WEBROOT?>version2/assets/images/homePage-card-xs.png"
            alt="card"
            style="width: 12rem"
            class="img-fluid"
          />
          <img
            src="<?=WEBROOT?>version2/assets/images/homePage-card-xs.png"
            alt="card"
            style="width: 12rem"
            class="img-fluid"
          />
          <img
            src="<?=WEBROOT?>version2/assets/images/homePage-card-xs.png"
            alt="card"
            style="width: 12rem"
            class="img-fluid"
          />
          <img
            src="<?=WEBROOT?>version2/assets/images/homePage-card-xs.png"
            alt="card"
            style="width: 12rem"
            class="img-fluid"
          />
          <img
            src="<?=WEBROOT?>version2/assets/images/homePage-card-xs.png"
            alt="card"
            style="width: 12rem"
            class="img-fluid"
          />
        </div>
      </section>
      <section class="w-100 py-4">
        <h2>
          Your Next Favorite <br />
          Place Awaits
        </h2>
        <div class="row mt-4">
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <img
              class="img-fluid"
              src="<?=WEBROOT?>version2/assets/images/homePage-card-md (1).png"
              alt="card-md"
            />
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <img
              class="img-fluid"
              src="<?=WEBROOT?>version2/assets/images/homePage-card-md (2).png"
              alt="card-md"
            />
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <img
              class="img-fluid"
              src="<?=WEBROOT?>version2/assets/images/homePage-card-md (3).png"
              alt="card-md"
            />
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <img
              class="img-fluid"
              src="<?=WEBROOT?>version2/assets/images/homePage-card-md (4).png"
              alt="card-md"
            />
          </div>
        </div>
      </section>
      <section class="w-100 py-4">
        <h2>Gallery</h2>
        <div class="d-flex gap-2 mt-4 overflow-x-auto">
          <img
            class="img-fluid"
            src="<?=WEBROOT?>version2/assets/images/homePage-card-xss.png"
            alt="card-xss"
            style="width: 12rem"
          />
          <img
            class="img-fluid"
            src="<?=WEBROOT?>version2/assets/images/homePage-card-xss.png"
            alt="card-xss"
            style="width: 12rem"
          />
          <img
            class="img-fluid"
            src="<?=WEBROOT?>version2/assets/images/homePage-card-xss.png"
            alt="card-xss"
            style="width: 12rem"
          />
          <img
            class="img-fluid"
            src="<?=WEBROOT?>version2/assets/images/homePage-card-xss.png"
            alt="card-xss"
            style="width: 12rem"
          />
          <img
            class="img-fluid"
            src="<?=WEBROOT?>version2/assets/images/homePage-card-xss.png"
            alt="card-xss"
            style="width: 12rem"
          />
        </div>
      </section>
      <section class="w-100 py-4">
        <h3 class="fw-semibold mb-5 mt-3">Luxury Tours</h3>
        <div class="row">
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
              <div class="position-relative">
                <span
                  class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5"
                  >Private Tour</span
                >
                <div class="cutomGroup position-absolute">
                  <i
                    class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"
                  ></i>
                </div>
                <img
                  src="<?=WEBROOT?>version2/assets/images/7DayTour.png"
                  class="card-img-top tour-image"
                  alt="7 Day Golden Triangle Tour"
                  data-default="<?=WEBROOT?>version2/assets/images/7DayTour.png"
                  data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg"
                />
              </div>
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                  <p class="fs-6 fw-semibold m-0 lh-g col-9">
                    7 Day Golden Triangle Tour
                  </p>
                  <span class="small text-secondary text-end col-3"
                    >6 Nights</span
                  >
                </div>
                <p class="small fw-medium my-2">Tour Code : GT-193</p>
                <p class="small fw-regular m-0 text-secondary">
                  Delhi → Agra → Jaipur
                </p>
                <div
                  class="d-flex align-items-center justify-content-between mt-3"
                >
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
                <span
                  class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5"
                  >Private Tour</span
                >
                <div class="cutomGroup position-absolute">
                  <i
                    class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"
                  ></i>
                </div>
                <img
                  src="<?=WEBROOT?>version2/assets/images/8DayTour.png"
                  class="card-img-top tour-image"
                  alt="8 Day Golden Triangle Tour"
                  data-default="<?=WEBROOT?>version2/assets/images/8DayTour.png"
                  data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg"
                />
              </div>
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                  <p class="fs-6 fw-semibold m-0 lh-g col-9">
                    8 Day Golden Triangle Tour
                  </p>
                  <span class="small text-secondary text-end col-3"
                    >7 Nights</span
                  >
                </div>
                <p class="small fw-medium my-2">Tour Code : GT-195</p>
                <p class="small fw-regular m-0 text-secondary">
                  Delhi → Agra → Jaipur → Udaipur
                </p>
                <div
                  class="d-flex align-items-center justify-content-between mt-3"
                >
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
                <span
                  class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5"
                  >Private Tour</span
                >
                <div class="cutomGroup position-absolute">
                  <i
                    class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"
                  ></i>
                </div>
                <img
                  src="<?=WEBROOT?>version2/assets/images/8WildlifeDayTour.png"
                  class="card-img-top tour-image"
                  alt="8 Day Golden Triangle with Ranthambore Wildlife"
                  data-default="<?=WEBROOT?>version2/assets/images/8WildlifeDayTour.png"
                  data-map="<?=WEBROOT?>version2/assets/images/delhi-jaipur.jpg"
                />
              </div>
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                  <p class="fs-6 fw-semibold m-0 lh-g col-9">
                    8 Day Golden Triangle with Ranthambore Wildlife
                  </p>
                  <span class="small text-secondary text-end col-3"
                    >7 Nights</span
                  >
                </div>
                <p class="small fw-medium my-2">Tour Code : GT-194</p>
                <p class="small fw-regular m-0 text-secondary">
                  Delhi → Agra → Ranthambore → Jaipur
                </p>
                <div
                  class="d-flex align-items-center justify-content-between mt-3"
                >
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
        </div>
      </section>
      <section class="w-100 py-4">
        <div class="row">
          <div class="col-md-7 mx-auto">
            <h5 class="fw-semibold">
              FAQ<span class="small fw-semibold">s</span>
            </h5>
            <div class="accordion accordion-flush" id="accordionFlushExample">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button
                    class="accordion-button shadow-none"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseOne"
                    aria-expanded="false"
                    aria-controls="flush-collapseOne"
                  >
                    1. How does the website work?
                  </button>
                </h2>
                <div
                  id="flush-collapseOne"
                  class="accordion-collapse collapse show"
                  data-bs-parent="#accordionFlushExample"
                >
                  <div class="accordion-body small text-light-emphasis">
                    Our website gives you all the relevant information in a
                    simple way on India & its main tourist destinations than any
                    other sites offering tours to India. While going through the
                    various pages on our website you will find information in
                    detail of destinations you can visit through us. <br />
                    <br />You can submit your Tour Enquiry from the relevant
                    tour page after your tour search is completed. You can also
                    combine various tours or inform us to make changes to
                    planned independent tour itinerary.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button
                    class="accordion-button collapsed shadow-none"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseTwo"
                    aria-expanded="false"
                    aria-controls="flush-collapseTwo"
                  >
                    2. How to process a Tailor-made tour request?
                  </button>
                </h2>
                <div
                  id="flush-collapseTwo"
                  class="accordion-collapse collapse"
                  data-bs-parent="#accordionFlushExample"
                >
                  <div class="accordion-body"></div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button
                    class="accordion-button collapsed shadow-none"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseThree"
                    aria-expanded="false"
                    aria-controls="flush-collapseThree"
                  >
                    3. What happens if I change my booking?
                  </button>
                </h2>
                <div
                  id="flush-collapseThree"
                  class="accordion-collapse collapse"
                  data-bs-parent="#accordionFlushExample"
                >
                  <div class="accordion-body"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
<script>
      const sliderInner = document.getElementById("sliderInner");
      const container = document.querySelector(".slider-container");

      const indicators = document.querySelectorAll(".carousel-indicator span");
      let activeIndex = 0;

      const scrollSpeed = 0.8;
      const intervalTime = 20;

      function updateIndicators(index) {
        indicators.forEach((el, i) => {
          if (i === index) {
            el.style.width = "40%";
            el.style.opacity = "1";
          } else {
            el.style.width = "20%";
            el.style.opacity = "0.5";
          }
        });
      }

      let carouselInterval;

      sliderInner.addEventListener("mouseenter", () =>
        clearInterval(carouselInterval)
      );
      sliderInner.addEventListener("mouseleave", startScrolling);

      function startScrolling() {
        carouselInterval = setInterval(() => {
          container.scrollTop += scrollSpeed;

          const firstCard = sliderInner.children[0];
          const cardHeight =
            firstCard.offsetHeight +
            parseInt(getComputedStyle(firstCard).marginBottom);

          if (container.scrollTop >= cardHeight) {
            sliderInner.appendChild(firstCard);
            container.scrollTop -= cardHeight;

            // Move to next indicator
            activeIndex = (activeIndex + 1) % indicators.length;
            updateIndicators(activeIndex);
          }
        }, intervalTime);
      }

      updateIndicators(activeIndex); // initialize
      startScrolling();
    </script>