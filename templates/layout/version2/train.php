<!DOCTYPE html>
<html lang="en">
<?php echo $this->element("trains/head_section");?>
<body>  
    <?php echo $this->element('version2/header'); ?>
    
        
        <?php //echo $this->element('version2/enquiry_modal'); ?>
        
        <?= $this->fetch('content') ?>     
        <?php echo $this->element('version2/our_partner'); ?>
        <?php echo $this->element('version2/footer'); ?>
    
    <!-- Full-Page Loader -->
    <div id="pageLoader" class="position-fixed top-0 start-0 w-100 h-100 d-none align-items-center justify-content-center bg-white bg-opacity-75" style="z-index: 1055;">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
  
  <style>
  .whatsapp-button {
    position: fixed;
    bottom: 30px;
    left: 50px;
    z-index: 9999;
    background-color: #25d366;
    border-radius: 50px;
    color: #ffffff !important;
    text-decoration: none;
    width: 50px;
    height: 50px;
    font-size: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    -webkit-box-shadow: 0px 0px 25px -6px rgba(0, 0, 0, 1);
    -moz-box-shadow: 0px 0px 25px -6px rgba(0, 0, 0, 1);
    box-shadow: 0px 0px 25px -6px rgba(0, 0, 0, 1);
    /*animation: effect 5s infinite ease-in;*/
    animation-name: pulse;
    animation-duration: 1.5s;
    animation-timing-function: ease-out;
    animation-iteration-count: infinite;
  }

  @keyframes effect {

    20%,
    100% {
      width: 50px;
      height: 50px;
      font-size: 30px;
    }

    0%,
    10% {
      width: 55px;
      height: 55px;
      font-size: 35px;
    }

    5% {
      width: 50px;
      height: 50px;
      font-size: 30px;
    }
  }

  @keyframes pulse {
    0% {
      box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.5);
    }

    80% {
      box-shadow: 0 0 0 14px rgba(37, 211, 102, 0);
    }
  }
</style>

   
    <a target="_blank" href="https://wa.me/9811539696?text=Hi%20I%20want%20to%20know%20about%20POW" class="whatsapp-button"><i class="fa-brands fa-whatsapp"></i></a>
<script>  $(document).ready(function () {    setTimeout(function () {      $('html, body').animate({ scrollTop: 400 }, 'slow');    }, 2500);   });</script>        
 
  
  <!-- Modal section -->
  
  
  <div class="modal fade" id="authorized-agent" tabindex="-1" aria-labelledby="authorizedAgentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content" style="background: #FFF6E7;">
        <div class="modal-header border-0 pb-0">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="height: 80vh;">
          <iframe src="https://www.elegantjourneys.com/trains/assets/letterhead.pdf" width="100%" height="100%" style="border: none;"></iframe>

        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="terms" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content" style="background: #FFF6E7;">
        <div class="modal-header border-0 pb-0">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
          <?php if(!empty($contents["tncp"])){ echo $contents["tncp"]["description"]; } ?>
          
        </div>
      </div>
    </div>
  </div> 
       
        <div class="xx">
          <div id="service-provider" class="mb-4">
            <div class="outer-circle">
              <div class="inner-circle">
                <img src="<?=WEBROOT?>trains/assets/images/service-provider.png" width="50" />
              </div>
            </div>
          </div>
          <?php /* ?>
          <div>
            <a href="https://wa.me/9811539696?text=Hi%20I%20want%20to%20know%20about%20POW" target="_blank">
              <img src="trains/assets/images/whatsapp.png" width="50" />
            </a>
          </div>
          <?php */ ?>

          <div class="pop-item arrow-right-center" id="formPopup">
            <button type="button" class="close-circle" onclick="document.getElementById('formPopup').style.display='none'">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
              </svg>
            </button>
            <div class="p-4 gray" style="border-radius: 18px;">
              
              <?= $this->Form->create(null, ['url' => ['controller' => 'TrainEnquiries', 'action' => 'trainSendEnquiry'], 'id' => 'enquiryForm', 'novalidate',]) ?>
                       <input type="hidden" name="page_url" id="page_url">   
                <div class="mb-3">
                  <input type="text" name="ename" class="form-control" placeholder="Name">
                </div>
                <div class="mb-3">
                  <input type="text" name="ephone" class="form-control" placeholder="Mobile">
                </div>
                <div class="mb-3">
                  <input type="email" name="eemail" class="form-control" placeholder="Email">
                </div>
                <div class="mb-3">
                  <textarea class="form-control" id="eComment" name="eComment" placeholder="Your message" rows="2"></textarea>
                </div>
                <div class="d-md-flex align-items-center justify-content-md-between mb-3">
                  <div class="col">
                    <input type="text" name="ecaptcha" id="ecaptcha" maxlength="6" class="form-control text-uppercase" oninput="this.value = this.value.toUpperCase();">

                  </div>
                  <div class="col-lg-4 col-8 mx-md-3 mt-3 mt-md-0 my-auto captcha-box">
                    <img id="captchaImage" src="<?= WEBROOT ?>/train-ecaptcha" class="rounded-2" width="120" alt="CAPTCHA">
                  </div>

                </div>
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-submit pop-bold">Submit <img src="<?= WEBROOT ?>trains/assets/images/arrow-right.png" class="ms-2" /></button>
                </div>
              <?php echo $this->Form->end(); ?>
            </div>
          </div>
        </div>
        <div id="modalContents" style="display: none;">
          
          <?php if(!empty($contents["tripextensionpop"])){ echo $contents["tripextensionpop"]["description"]; } ?>
        </div>
  
  <!-- Response Modal -->
  <div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center">
        <div class="modal-header">
          <!-- <h2 class="modal-title" id="responseModalLabel">Message</h2> -->
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modalMessage">
          <!-- Message goes here -->
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="popper-popup" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content gray">
        <div class="modal-header border-0 p-2 w-100">
          <h3 class="modal-title w-100 text-center">
            <span class="flash">Exclusive Offer!</span>
          </h3>
          <button type="button" class="position-absolute btn btn-close btn-sm p-0 offer-modal-btn" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body px-2 pb-2 pt-0">
          <div class="flash-price mb-3 text-center fw-bold" id="modalPrice"></div>
          <div class="highlight-message text-center mb-3">
            Secure your journey now – limited cabins available!
          </div>

          <!-- Step 1: Claim Button -->
          <div id="claimStep" class="d-flex justify-content-center my-3">
            <button class="button-claim" id="claimNowBtn">
              <p class="title-claim">Claim Now!</p>
              <img class="img-claim"
                src="<?= WEBROOT ?>trains/assets/images/Locked.png"
                alt="Handshake" />
              <p class="description-claim">Enjoy Benefits</p>
            </button>
          </div>

          <!-- Step 2: Hidden Form -->
         
          <?= $this->Form->create(null, ['url' => ['controller' => 'TrainEnquiries', 'action' => 'tarrifSendEnquiry'], 'id' => 'tarrifForm', 'novalidate', "class"=>"d-none mt-3"]) ?>
                
            <div class="mb-3">
              <input type="text" name="tname" class="form-control" placeholder="Name">
              <input type="hidden" id="tprice" name="tprice" value="">
              <input type="hidden" name="tarrif_page_url" id="tarrif_page_url">   
            </div>
            <div class="mb-3">
              <input type="text" name="tphone" class="form-control" placeholder="Mobile">
            </div>
            <div class="mb-3">
              <input type="email" name="temail" class="form-control" placeholder="Email">
            </div>
            <div class="d-flex align-items-center justify-content-md-around mb-3">
              <div class="col col-lg-6">
                <input type="text" placeholder="Captcha" name="tcaptcha" id="tcaptcha" maxlength="6"
                  class="form-control text-uppercase" oninput="this.value = this.value.toUpperCase();">
              </div>
              <div class="col-lg-5 col-4 mt-3 mt-md-0 my-auto captcha-box">
                <img id="ocaptchaImage" src="<?= WEBROOT ?>/offer-captcha" class="rounded-2" width="150" alt="CAPTCHA">
              </div>
            </div>
            <div class="d-flex justify-content-center my-3">
              <button class="button-submit" type="submit">
                <p class="title-submit">Avail Now</p>
                <img class="img-submit"
                  src="<?= WEBROOT ?>trains/assets/images/Handshake.png"
                  alt="Handshake" />
                <!-- <p class="description-submit">Enjoy Offers</p> -->
              </button>
            </div>

            <!--step 3-->
            <div id="step3" class="d-none">

              <div class="mb-3 gap-2">
                <div class="col mb-2 mb-lg-0">
                  <label class="form-label fw-bold">Season <span class="red">*</span></label>
                  <select name="tseason" id="tseasonId" class="form-select">
                    <option value="">Select Season</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                  </select>
                </div>
              </div>
              <div class="mb-3 gap-2">
                <div class="col">
                  <label class="form-label fw-bold">Departure Date <span class="red">*</span></label>
                  <select name="tmonths" id="tmonthId" class="form-select">
                    <option value="">Select Date</option>
                  </select>
                </div>
              </div>
              <div class="mb-3 gap-2">
                <div class="col-6 mb-2 mb-lg-0">
                  <label class="form-label fw-bold">No. of Cabins <span class="red">*</span></label>
                  <select name="tcabins" id="tnumCabins" class="form-select"></select>
                </div>
              </div>
              <div id="tcabinDetails" class="row flex-wrap justify-content-lg-around"></div>
              <div class="mb-3">
                <div class="mt-3 mt-lg-0 mt-md-0 text-center">
                  <button type="submit" class="btn btn-submit pop-bold">Submit <img src="<?= WEBROOT ?>trains/assets/images/arrow-right.png" class="ms-2"></button>
                </div>
              </div>
            </div>


          <?php echo $this->Form->end(); ?>
        </div>

      </div>
    </div>
  </div>
  <div id="google_translate_element" class="translate-floating" style="display:none;"></div>

  <div id="menu-backdrop" class="menu-backdrop"></div>

  <div id="fullLoader" class="loader-overlay d-none">
    <div class="loader-spinner"></div>
  </div>
  
  <!-- -->
<script>
	var trainVerifyCaptchaUrl = "<?= $this->Url->build('/train-verify-captcha') ?>";
	var trainSendEnquiryUrl = "<?= $this->Url->build('/train-send-enquiry') ?>";
	var csrfToken = "<?= $this->request->getAttribute('csrfToken') ?>";
  	var tVerifyCaptchaUrl = "<?= $this->Url->build('/tverify-captcha') ?>";
  	var trainShortEnquiryUrl = "<?= $this->Url->build('/train-short-enquiry') ?>";
  	var trainContactEnquiryUrl = "<?= $this->Url->build('/train-contact-enquiry') ?>";
  	var oVerifyCaptchaUrl = "<?= $this->Url->build('/overify-captcha') ?>";
  	var tariffEnquiryMailUrl = "<?= $this->Url->build('/tariff-enquiry-mail') ?>";
  	var tariffdetailEnquiryMailUrl = "<?= $this->Url->build('/tariff-detail-enquiry-mail') ?>";
  	var captchaUrl = "<?= $this->Url->build('/train-captcha', ['fullBase' => true]) ?>";
  	$(document).ready(function () {
  		$('#page_url').val(window.location.href);
    	$('#tarrif_page_url').val(window.location.href);
	});
</script>

    <?php //echo $this->element('trains/script_section'); ?>
   <?php echo $this->element('trains/luxury_train_script'); ?>
</body>
</html>