<style>/* Show dropdown on hover */
.nav-item.dropdown:hover .dropdown-menu {
  display: block;
  margin-top: 0;
}

/* Optional smooth effect */
.dropdown-menu {
  transition: all 0.3s ease;
}
/* Reduce dropdown padding & make compact */
.dropdown-menu {
  padding: 2px 0;
  min-width: 160px; /* optional: reduce width */
  border-radius: 6px;
}

/* Submenu item styling */
.dropdown-menu .dropdown-item {
  font-size: 13px;          /* smaller font */
  font-weight: 600;         /* bolder text */
  padding: 2px 12px;        /* compact spacing */
  color: #333 !important;              /* default color */
  transition: all 0.2s ease;
}

/* Hover effect */
.dropdown-menu .dropdown-item:hover {
  background-color: #f8f9fa;  /* light background */
  color: #0d6efd !important;             /* Bootstrap primary color */
}
.dropdown-menu {
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Hover open (already added earlier) */
@media (min-width: 992px) {
  .nav-item.dropdown:hover .dropdown-menu {
    display: block;
  }
}
@media (min-width: 992px) {
  .nav-item.dropdown:hover .dropdown-menu {
    display: block;
  }
}
</style> 
<nav
        class="w-100 navbar navbar-expand-lg bg-white border-bottom navbar-dark position-fixed top-0 z-5"
      >
        <div class="container">
          <a class="navbar-brand" href="/">
            <img src="<?=WEBROOT?>version2/assets/images/new-logo.png" alt="Elegant Journeys – Luxury Travel & Tours in India" />
          </a>
          <button
            class="navbar-toggler border-0"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon" style="filter: invert(1)"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav gap-xl-2 ms-auto mr-custom">
              <li class="nav-item">
                <a
                  class="nav-link text-black fw-semibold"
                  href="<?=WEBROOT?>tours-popular-golden-triangle"
                  style="font-size: 14px"
                  ;
                  >Popular Tours</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link text-black fw-semibold"
                  href="<?=WEBROOT?>tours-luxury-offers"
                  style="font-size: 14px"
                  ;
                >
                  Luxury Offers
                </a>
              </li>
			  <li class="nav-item">
                <a
                  class="nav-link text-black fw-semibold"
                  href="<?=WEBROOT?>tours-featured-india-asia-packages"
                  style="font-size: 14px"
                  ;
                >
                  Featured Tour</a
                >
              </li>
			   <?php /* ?><li class="nav-item">
                <a class="nav-link text-black fw-semibold" href="<?=WEBROOT?>luxury-trains" style="font-size: 14px";>Luxury Trains</a>
              </li><?php */ ?>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle text-black fw-semibold"
                  href="<?= WEBROOT ?>luxury-trains"
                  id="luxuryDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  style="font-size: 14px;">
                  Luxury Trains
                </a>

                <ul class="dropdown-menu" aria-labelledby="luxuryDropdown">
                  <li><a class="dropdown-item" href="<?= WEBROOT ?>india-luxury-trains/palace-on-wheels">Palace On Wheels</a></li>
                  <li><a class="dropdown-item" href="<?= WEBROOT ?>india-luxury-trains/maharajas-express">Maharajas Express</a></li>
                  <?php /* ?><li><a class="dropdown-item" href="<?= WEBROOT ?>deccan-odyssey">The Deccan Odyssey</a></li>
                  <li><a class="dropdown-item" href="<?= WEBROOT ?>golden-chariot">The Golden Chariot</a></li><?php */ ?>
                </ul>
              </li>
              <li class="nav-item">
                <a
                  class="nav-link text-black fw-semibold"
                  href="<?=WEBROOT?>tailor-make-a-tour"
                  style="font-size: 14px"
                  ;
                  >Plan Your Trip</a
                >
              </li>
             
              
            </ul>
            <?php /* ?>
            <address
              class="dropdown number-dropdown border border-1 m-0 rounded-2"
              style="height: 36px"
            >
              <!-- Dropdown Toggle -->
              <button
                class="btn dropdown-toggle p-0 px-2 overflow-hidden border-0"
                style="height: 36px"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <div class="number-items">
                                <img
                                    src="<?=WEBROOT?>version2/assets/images/usa.png"
                                    alt="usa-flag"
                                    width="30"
                                    height="30" />
                                (+1) 332-213-8200
                            </div>
                            <div class="number-items">
                                <img
                                    src="<?=WEBROOT?>version2/assets/images/united-kingdom.png"
                                    alt="uk-flag"
                                    width="30"
                                    height="30" />
                                (+44) 20-3769-7001
                            </div>
                            <div class="number-items">
                                <img
                                    src="<?=WEBROOT?>version2/assets/images/australia.png"
                                    alt="australia-flag"
                                    width="30"
                                    height="30" />
                                (+61) 28-488-0900
                            </div>
              </button>

              <!-- Dropdown Menu -->
              <ul class="dropdown-menu number-dropdown-menu">
                <li class="dropdown-item">
                                <img
                                    src="<?=WEBROOT?>version2/assets/images/usa.png"
                                    alt="usa-flag"
                                    width="30"
                                    height="30" />
                                (+1) 332-213-8200
                            </li>
                            <li class="dropdown-item">
                                <img
                                    src="<?=WEBROOT?>version2/assets/images/united-kingdom.png"
                                    alt="uk-flag"
                                    width="30"
                                    height="30" />
                                (+44) 20-3769-7001
                            </li>
                            <li class="dropdown-item">
                                <img
                                    src="<?=WEBROOT?>version2/assets/images/australia.png"
                                    alt="aus-flag"
                                    width="30"
                                    height="30" />
                                (+61) 28-488-0900
                            </li>
              </ul>
            </address><?php */ ?>
            <address class="dropdown number-dropdown border border-1 m-0 rounded-2" style="height:36px">

  <!-- Dropdown Toggle -->
  <button
    class="btn dropdown-toggle p-0 px-2 overflow-hidden border-0 number-toggle"
    style="height:36px"
    type="button"
    data-bs-toggle="dropdown"
    aria-expanded="false"
  >
    <div class="number-wrapper">
      <div class="number-items">
        <img src="<?=WEBROOT?>version2/assets/images/usa.png" width="30" height="30">
        +1-332-213-8200
      </div>

      <div class="number-items">
        <img src="<?=WEBROOT?>version2/assets/images/united-kingdom.png" width="30" height="30">
        +44-203-769-7001
      </div>

      <div class="number-items">
        <img src="<?=WEBROOT?>version2/assets/images/australia.png" width="30" height="30">
        +61-28-488-0900
      </div>
    </div>
  </button>
              <div class="ms-0 my-1 mt-lg-1 text-start text-danger" style="font-size:11px;">* Call with International dialing code</div>

  <!-- Dropdown Menu -->
  <ul class="dropdown-menu number-dropdown-menu">
    <li class="dropdown-item">
      <img src="<?=WEBROOT?>version2/assets/images/usa.png" width="30"> +1-332-213-8200
    </li>
    <li class="dropdown-item">
      <img src="<?=WEBROOT?>version2/assets/images/united-kingdom.png" width="30"> +44-203-769-7001
    </li>
    <li class="dropdown-item">
      <img src="<?=WEBROOT?>version2/assets/images/australia.png" width="30"> +61-28-488-0900
    </li>
  </ul>
              
</address>
            

            <div class="ms-0 ms-lg-3 mt-3 mt-lg-0">
			<?php
				/*
              <div class="dropdown">
                <button
                  class="btn dropdown-toggle border border-1"
                  type="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  EN
                </button>
                <ul class="dropdown-menu" style="width: 100px; min-width: 0">
                  <li><a class="dropdown-item" href="#">FR</a></li>
                  <li><a class="dropdown-item" href="#">ES</a></li>
                  <li><a class="dropdown-item" href="#">DE</a></li>
                  <li><a class="dropdown-item" href="#">HI</a></li>
                </ul>
              </div>
			  */
			  ?>
            </div>
          </div>
          
        </div>
   
      </nav>

