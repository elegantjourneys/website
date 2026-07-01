<section class="heroSection w-100 px-0 py-4">
  
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
            <h1 class="fw-bold custom-heading">Contact Us</h1>
            <h4 class="fw-semibold custom-subheading">
                We're here to help—reach out anytime
            </h4>
        </div>
    </div>
</section>
<section class="w-100 mx-auto py-4">
    <div class="row">
        <div class="col-md-6">
            <div class="width-75-100 mx-auto p-2">
                <h3 class="fw-semibold">
                    Get in Touch— <br />
                    Your Journey Starts Here
                </h3>
                <div class="mt-5">
                    <h5 class="fw-semibold mb-3">Contact Details</h5>
                    <?php /* ?><p class="text-body-secondary">
                        <span class="fi fi-au me-2"></span>+13322138200
                    </p>
                    <p class="text-body-secondary">
                        <span class="fi fi-gb me-2"></span>+442037697001
                    </p>
                    <p class="text-body-secondary">
                        <span class="fi fi-us me-2"></span>+61284880900
                    </p><?php */ ?>
                  <p class="text-body-secondary">
                    <span class="fi fi-au me-2"></span>
                    <a href="tel:+13322138200" class="text-body-primary text-decoration-none">
                      +1-332-213-8200
                    </a>
                  </p>
                  <p class="text-body-secondary">
                    <span class="fi fi-gb me-2"></span>
                    <a href="tel:+442037697001" class="text-body-primary text-decoration-none">
                      +44-203-769-7001
                    </a>
                  </p>
                  <p class="text-body-secondary">
                    <span class="fi fi-us me-2"></span>
                    <a href="tel:+61284880900" class="text-body-primary text-decoration-none">
                      +61-28-488-0900
                    </a>
                  </p>
                  

                </div>
              <div class="ms-0 my-1 mt-lg-1 text-start small text-danger"><span>*</span> Call with International dialing code</div>
                <div class="mt-5">
                    <div class="d-flex align-items-center gap-0 gap-md-3 mb-3">
                        <h5>India Office</h5>
                        <p class="text-danger small m-0">
                            **Meetings with prior appointment only**
                        </p>
                    </div>
                    <?php /* ?><p class="d-flex align-items-center gap-2 text-body-secondary">
                        <i class="ri-map-pin-fill"></i> D-8/8048 Vasant Kunj, New
                        Delhi 110070, India
                    </p><?php */ ?>
                  	<p class="d-flex align-items-center gap-2 text-body-secondary">
                        <i class="ri-map-pin-fill"></i> 6 Worldmark, 3rd Floor, Aerocity, New Delhi, Delhi - 110037, India
                    </p>
                    <p class="d-flex align-items-center gap-2 text-body-secondary">
                        <i class="ri-phone-fill"></i>(+91) 99100-78975 | 98115-39696
                    </p>
                    <p class="d-flex align-items-center gap-2 text-body-secondary">
                        <i class="ri-mail-fill"></i>Sales@ElegantJourneys.com
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <!-- <form id="contactUsForm" method="post" action="/send-contact" class="p-2 width-75-100 mx-auto needs-validation" novalidate> -->
            <?= $this->Form->create(null, [
                'url' => ['controller' => 'Contacts', 'action' => 'sendContact'],
                'id' => 'contactUsForm',
                'class' => 'p-2 width-75-100 mx-auto needs-validation',
                'novalidate',
            ]) ?>
            <!-- Name -->
            <div class="mb-2">
                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                <input
                    type="text"
                    class="form-control"
                    name="name"
                    placeholder="Enter your name"
                    required />


            </div>

            <!-- Phone -->
            <div class="mb-2">
                <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>

                <div class="input-group">
                    <select class="form-select" style="max-width: 100px">
                        <option value="+91">🇳 +91</option>
                        <option value="+1"> +1</option>
                        <option value="+44"> +44</option>
                        <option value="+61">🇺 +61</option>
                        <!-- Add more countries -->
                    </select>
                    <input type="tel" class="form-control" name="phone"
                        placeholder="Enter your phone"
                        required
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" />

                </div>
            </div>

            <!-- Email -->
            <div class="mb-2">
                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                <input
                    type="email"
                    class="form-control"
                    name="email"
                    placeholder="Enter your email"
                    required />

            </div>

            <!-- Purpose of Contact -->
            <div class="mb-2">
                <label for="purpose" class="form-label">Purpose of contact <span class="text-danger">*</span></label>
                <select
                    class="form-select"
                    name="purpose"
                    required
                    style="font-size: 14px">
                    <option selected disabled value="">-- Select --</option>
                    <option value="inquiry">General Inquiry</option>
                    <option value="booking">Booking Request</option>
                    <option value="support">Customer Support</option>
                </select>

            </div>

            <!-- Travel Requirements -->
            <div class="mb-2">
                <label for="requirements" class="form-label">Your Travel Requirements</label>
                <textarea
                    class="form-control"
                    name="requirements"
                    rows="3"
                    placeholder="Please specify with budget, if any"></textarea>
            </div>

            <!-- Security Text -->
            <div class="mb-3">
                <label for="captcha" class="form-label">Security Text <span class="text-danger">*</span></label>
                <div class="d-flex gap-2 align-items-center">
                    <input
                        type="text"
                        class="form-control text-uppercase w-50"
                        name="captcha"
                        maxlength="6"
                        id="captchaInput"
                        placeholder="Enter security text"
                        required />
                    <span>
                        <img src="<?= WEBROOT ?>/captcha" alt="CAPTCHA Image" class="captcha-img" id="captchaImage" style="height: 40px;">
                        <a href="javascript:void(0);" onclick="document.getElementById('captchaImage').src = '<?= WEBROOT ?>captcha?' + Date.now();"><i class="fa fa-refresh" aria-hidden="true"></i></a>

                    </span>
                </div>

            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn bg-teal text-white w-100">
                Send Message
            </button>
            <!-- <button class="btn text-teal mt-2 w-100">
                    Request a Callback
                </button> -->
            <!--  </form> -->
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</section>
<script>
    $('#captchaInput').on('input', function() {
        this.value = this.value.toUpperCase();
    });

    $(function() {
        const $form = $('#contactUsForm');

        var _csrfToken = '<?= $this->request->getAttribute('csrfToken') ?>';

        // jQuery Validation with CAPTCHA remote check
        $form.validate({
            errorPlacement: function(error, element) {
                if (element.attr("name") == "phone") {
                    error.insertAfter(element.parent());
                } else if (element.attr("name") == "captcha") {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            rules: {
                name: "required",
       			phone: {
                    required: true,
                    digits: true,
                    minlength: 5,
                    maxlength: 15
                },
                email: {
                    required: true,
                    email: true
                },
                purpose: "required",

                captcha: {
                    required: true,
                    minlength: 6,
                    maxlength: 6,
                    remote: {
                        url: "<?= WEBROOT ?>verify-captcha",
                        type: "post",
                        data: {
                            captcha: function() {
                                return $('#captchaInput').val();
                            },
                            _csrfToken: _csrfToken
                        }
                    }
                }
            },
            messages: {
                name: "Please enter your name",
                phone:  {
                    required: "Please enter your phone number",
                    digits: "Phone number must contain digits only",
                    minlength: "Phone number must be at least 5 digits",
                    maxlength: "Phone number can't be longer than 15 digits"
                },
                email: {
                    required: "Please enter your email",
                    email: "Enter a valid email"
                },
                purpose: "Please select your purpose",
                captcha: {
                    required: "Please enter the security code",
                    remote: "Incorrect security text."
                }
            },
            
        });
    });
</script>