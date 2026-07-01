<section class="heroSection w-100 p-0">
    <span class="d-block small text-secondary py-3 custom-inline-padding">Home > Contact Us</span>
    <div class="position-relative">
        <img
            src="<?=WEBROOT?>version2/assets/images/contact-us-banner.png"
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
                    <p class="text-body-secondary">
                        <span class="fi fi-au me-2"></span>+13322138200
                    </p>
                    <p class="text-body-secondary">
                        <span class="fi fi-gb me-2"></span>+442037697001
                    </p>
                    <p class="text-body-secondary">
                        <span class="fi fi-us me-2"></span>+61284880900
                    </p>
                   
                </div>
              <div class="ms-0 my-1 mt-lg-1 text-center small"><span class="text-danger">*</span> Dial in International format</div>
                <div class="mt-5">
                    <div class="d-flex align-items-center gap-0 gap-md-3 mb-3">
                        <h5>India Office</h5>
                        <p class="text-danger small m-0">
                            **Meetings with prior appointment only**
                        </p>
                    </div>
                    <p class="d-flex align-items-center gap-2 text-body-secondary">
                        <i class="ri-map-pin-fill"></i> D-8/8048 Vasant Kunj, New
                        Delhi 110070, India
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
            <form
                id="contactUsForm"
                class="p-2 width-75-100 mx-auto needs-validation"
                novalidate>
                <!-- Name -->
                <div class="mb-2">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        placeholder="Enter your name"
                        required />
                    <div class="invalid-feedback">Please enter your name.</div>
                </div>

                <!-- Phone -->
                <div class="mb-2">
                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                    <!-- <div class="input-group">
                  <span class="input-group-text">IND +91</span>
                  <input
                    type="tel"
                    class="form-control"
                    name="phone"
                    placeholder="9876543210"
                    required
                  />
                  <div class="invalid-feedback">
                    Please enter your phone number.
                  </div>
                </div> -->
                    <div class="input-group">
                        <select class="form-select" style="max-width: 100px">
                            <option value="+91">🇮🇳 +91</option>
                            <option value="+1">🇺🇸 +1</option>
                            <option value="+44">🇬 +44</option>
                            <option value="+61"> +61</option>
                            <!-- Add more countries -->
                        </select>
                        <input
                            type="tel"
                            class="form-control"
                            name="phone"
                            placeholder="+91 9876543210"
                            required
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                        <div class="invalid-feedback">
                            Please enter your phone number.
                        </div>
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
                    <div class="invalid-feedback">
                        Please enter a valid email address.
                    </div>
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
                    <div class="invalid-feedback">Please select your purpose.</div>
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
                    <label for="securityText" class="form-label">Security Text <span class="text-danger">*</span></label>
                    <div class="d-flex gap-2 align-items-center">
                        <input
                            type="text"
                            class="form-control"
                            name="securityText"
                            placeholder="Enter security text"
                            required />
                        <span class="fw-bold">C4PJ4X</span>
                    </div>
                    <div class="invalid-feedback">Please enter security code.</div>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="btn bg-teal text-white w-100"
                    onclick="submitContactUsForm(this)">
                    Send Message
                </button>
                <button class="btn text-teal mt-2 w-100">
                    Request a Callback
                </button>
            </form>
        </div>
    </div>
</section>