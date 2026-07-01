<div class="position-sticky" style="top: 90px">
              <div
                class="d-flex align-items-center gap-2 border border-1 border-light-subtle p-2 rounded-1 mb-2"
              >
                <div class="w-75">
                  <img
                    class="img-fluid"
                    src="<?=WEBROOT?>version2/assets/images/tripadvisor-banner.png"
                    alt="tripadvisor-banner"
                  />
                </div>
                <div class="text-center w-25">
                  <h4 class="fw-bold">5.0</h4>
                  <p class="small">127 reviews</p>
                </div>
              </div>
              <div
                class="border border-1 border-light-subtle p-3 rounded-1 mb-2"
              >
                <h5 class="mb-4 fw-semibold" style="font-size: 16px">
                  Let us help you
                </h5>
                <form id="reviewsForm" class="needs-validation" novalidate>
                  <input
                    type="text"
                    class="form-control mb-3"
                    placeholder="Name"
                    name="name"
                    required
                  />
                  <input
                    type="email"
                    class="form-control mb-3"
                    placeholder="Email"
                    name="email"
                    required
                  />
                  <input
                    type="tel"
                    class="form-control mb-3"
                    placeholder="Phone"
                    name="phone"
                    maxlength="13"
                    pattern="\d{10,13}"
                    required
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                  />
                  <button
                    type="submit"
                    class="btn bg-teal text-white w-100"
                    onclick="submitReviewsForm(this)"
                  >
                    Enquire Now
                  </button>
                </form>
              </div>
              <div
                class="border border-1 border-light-subtle p-2 rounded-1"
              >
			  </div>
            </div>