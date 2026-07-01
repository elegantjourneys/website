<style>
  .container .card {
    width: 100%;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    background: #fff;
    border-radius: 0px;
  }


  .btn.btn-primary {
    background-color: #ddd;
    color: black;
    box-shadow: none;
    border: none;
    font-size: 20px;
    width: 100%;
    height: 100%;
  }

  .btn.btn-primary:focus {
    box-shadow: none;
  }


  .cardimg {
    width: 100%;
    object-fit: fill;
  }

  .container .card .number {
    font-size: 24px;
  }

  .container .card-body .btn.btn-primary .fab.fa-cc-paypal {
    font-size: 32px;
    color: #3333f7;
  }

  .fab.fa-cc-amex {
    color: #1c6acf;
    font-size: 32px;
  }

  .fab.fa-cc-mastercard {
    font-size: 32px;
    color: red;
  }

  .fab.fa-cc-discover {
    font-size: 32px;
    color: orange;
  }

  .c-green {
    color: green;
  }

  .box {
    height: 40px;
    width: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ddd;
  }

  .btn.btn-primary.payment {
    background-color: #1c6acf;
    color: white;
    border-radius: 0px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 24px;
  }


  .form__div {
    height: 50px;
    position: relative;
    margin-bottom: 24px;
  }
</style>
<section class="heroSection w-100 px-0 py-3">
  <div class="px-2 mx-2 px-md-5 mx-md-5">
    <?php echo $this->element('common/breadcrumb-ver2'); ?>
  </div>
  <div class="position-relative">
    <img
      src="<?= WEBROOT ?>version2/assets/images/contact-us-banner.png"
      alt="banner"
      class="img-fluid d-block mx-auto" />
    <div
      class="position-absolute top-50 start-50 translate-middle text-center text-white">
      <h1 class="fw-bold custom-heading">Finalize Your Travel Plans</h1>
      <h4 class="fw-semibold custom-subheading">
        Safe, fast, and secure payment for your upcoming journey.
      </h4>
    </div>
  </div>
</section>
<section class="w-100 py-4">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center mb-4">
        <p class="mb-0 fw-bold h3 text-uppercase text-danger">Flexible Payments in Your Preferred Currency</p>
      </div>
    </div>
    <div class="row justify-content-md-center">
      <?php /* ?><div class="col-lg-2 mb-3">
        <div class="card p-3">
          <div class="img-box">
            <img class="cardimg" src="<?= WEBROOT ?>assets/image/payment-flags/usa.jpg" alt="">
          </div>
          <div class="number text-center">
            <span class="fw-bold fs-5">USA</span>
          </div>

        </div>
      </div>
      <div class="col-lg-2 mb-3">
        <div class="card p-3">
          <div class="img-box">
            <img class="cardimg" src="<?= WEBROOT ?>assets/image/payment-flags/australia.jpg" alt="">
          </div>
          <div class="number text-center">
            <span class="fw-bold fs-5">AUS</span>
          </div>

        </div>
      </div>
      <div class="col-lg-2 mb-3">
        <div class="card p-3">
          <div class="img-box">
            <img class="cardimg" src="<?= WEBROOT ?>assets/image/payment-flags/british.jpg" alt="">
          </div>
          <div class="number text-center">
            <span class="fw-bold fs-5">GBP</span>
          </div>

        </div>
      </div>
      <div class="col-lg-2 mb-3">
        <div class="card p-3">
          <div class="img-box">
            <img class="cardimg" src="<?= WEBROOT ?>assets/image/payment-flags/euro.jpg" alt="">
          </div>
          <div class="number text-center">
            <span class="fw-bold fs-5">EURO</span>
          </div>

        </div>
      </div>
      <div class="col-lg-2 mb-3">
        <div class="card p-3">
          <div class="img-box">
            <img class="cardimg" src="<?= WEBROOT ?>assets/image/payment-flags/united-arab-emirates.jpg" alt="">
          </div>
          <div class="number text-center">
            <span class="fw-bold fs-5">AED</span>
          </div>

        </div>
      </div>
      <div class="col-lg-2 mb-3">
        <div class="card p-3">
          <div class="img-box">
            <img class="cardimg" src="<?= WEBROOT ?>assets/image/payment-flags/canada.jpg" alt="">
          </div>
          <div class="number text-center">
            <span class="fw-bold fs-5">CAD</span>
          </div>

        </div>
      </div>
      <div class="col-lg-2 mb-3">
        <div class="card p-3">
          <div class="img-box">
            <img class="cardimg" src="<?= WEBROOT ?>assets/image/payment-flags/india.jpg" alt="">
          </div>
          <div class="number text-center">
            <span class="fw-bold fs-5">INR</span>
          </div>

        </div>
      </div>
      <div class="col-12 mt-4">
        <div class="card p-3">
          <p class="mb-0 fw-bold h4">Multiple Currencies, One Seamless Payment</p>
        </div>
      </div> <?php */ ?>
      <div class="col-12">
        <div class="card p-3">

          <div class="card-body border p-0">
            <p>
              <a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between"
                data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true"
                aria-controls="collapseExample">
                <span class="fw-bold">Easy and Flexible Payment Solutions</span>
                <span class="">
                  <span class="fab fa-cc-amex"></span>
                  <span class="fab fa-cc-mastercard"></span>
                  <span class="fab fa-cc-discover"></span>
                </span>
              </a>
            </p>
            <div class="collapse show p-3 pt-0" id="collapseExample">
              <div class="row">
                <div class="col-lg-5 mb-lg-0 mb-3">

                  <p class="mb-0">At Elegant Journeys, we value your comfort, not just in travel but in every step of the process. Our secure payment gateway allows you to pay in your preferred currency, ensuring convenience and transparency. Whether you choose USD, AUD, GBP, EUR, AED, CAD, or INR, your transaction is protected with the latest encryption technology.</p>
                  <p>Your journey deserves nothing less than the utmost professionalism, discretion, and care.</p>

                </div>
                <div class="col-lg-6 offset-lg-1">

                  <div class="row">
                    <div class="col-12">
                      <div class="form__div">
                        

                        <div class="dropdown w-100">
                          <button class="btn btn-outline-secondary dropdown-toggle w-100 d-flex align-items-center justify-content-between"
                            type="button" id="currencyDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <span data-currency="">Select Currency</span>
                          </button>
                          <ul class="dropdown-menu w-100" aria-labelledby="currencyDropdown">
                            <li><a class="dropdown-item" data-currency="USD" href="#"><img src="https://flagcdn.com/w20/us.png" class="me-2"> USD - United States Dollar</a></li>
                            <li><a class="dropdown-item" data-currency="AUD" href="#"><img src="https://flagcdn.com/w20/au.png" class="me-2"> AUD - Australian Dollar</a></li>
                            <li><a class="dropdown-item" data-currency="GBP" href="#"><img src="https://flagcdn.com/w20/gb.png" class="me-2"> GBP - British Pound</a></li>
                            <li><a class="dropdown-item" data-currency="EUR" href="#"><img src="https://flagcdn.com/w20/eu.png" class="me-2"> EUR - Euro</a></li>
                            <li><a class="dropdown-item" data-currency="AED" href="#"><img src="https://flagcdn.com/w20/ae.png" class="me-2"> AED - UAE Dirham</a></li>
                            <li><a class="dropdown-item" data-currency="CAD" href="#"><img src="https://flagcdn.com/w20/ca.png" class="me-2"> CAD - Canadian Dollar</a></li>
                            <li><a class="dropdown-item" data-currency="INR" href="#"><img src="https://flagcdn.com/w20/in.png" class="me-2"> INR - Indian Rupee</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form__div">
                        <div class="form-check mt-3">
                          <input class="form-check-input" type="checkbox" id="termsCheck">
                          <label class="form-check-label h6" for="termsCheck">
                            I agree to the <a href="<?=WEBROOT?>terms-privacy" target="_blank">Terms & Conditions</a>
                          </label>
                        </div>
                      </div>
                    </div>

                    <!-- Payment form container -->
                    <div class="col-12" id="paymentSection" style="display:none;"></div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
<script>
  document.querySelectorAll('#currencyDropdown + .dropdown-menu .dropdown-item').forEach(item => {
    item.addEventListener('click', function(e) {
      e.preventDefault(); // Stop page from scrolling to top
      document.querySelector('#currencyDropdown span').innerHTML = this.innerHTML; // Update button content
    });
  });
</script>
<script>
  $(document).ready(function() {

    let selectedCurrency = "";

    // Payment IDs mapping
    const paymentIds = {
      "USD": "pb_HSWSj4f4rwsK",
      "AUD": "pb_YkJDIjRuNZPp",
      "GBP": "pb_f0TFjx0VpcO0",
      "EUR": "pb_zeFentU5i5gO",
      "AED": "pb_OhmZfRvIlr18",
      "CAD": "pb_uCC6d8pdIo87",
      "INR": "pb_eLd2fSFGWlfd"
    };

    // Currency dropdown selection
    $('.dropdown-item').on('click', function(e) {
      e.preventDefault();
      selectedCurrency = $(this).data('currency');
      $('#currencyDropdown span').html($(this).html()).attr('data-currency', selectedCurrency);
      validateForm();
    });

    // Terms checkbox
    $('#termsCheck').on('change', function() {
      validateForm();
    });

    function validateForm() {
      const termsAccepted = $('#termsCheck').is(':checked');
      const currencyChosen = selectedCurrency !== "";

      if (currencyChosen && termsAccepted) {
        // Clear old content
        $('#paymentSection').empty().slideDown();

        // Add form element
        $('#paymentSection').append(`<form id="payForm"></form>`);

        // Create and append script tag
        let script = document.createElement('script');
        script.src = "https://oneclick.payglocal.in/simple.js";
        script.setAttribute("data-pb-id", paymentIds[selectedCurrency]);

        document.getElementById("payForm").appendChild(script);

      } else {
        $('#paymentSection').slideUp().empty();
      }
    }
  });
</script>