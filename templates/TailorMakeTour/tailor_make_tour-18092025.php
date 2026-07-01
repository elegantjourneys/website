<section class="heroSection w-100 p-0">
  <div class="position-relative">
    <img
      src="<?= WEBROOT ?>version2/assets/images/customize-journey-banner.png"
      alt="banner"
      class="img-fluid d-block mx-auto customizeJourney-heroSection-img" />
    <div class="w-100 customizeJourney-heroSection text-white px-3 px-lg-5 py-4 py-lg-0">
      <div class="row align-items-center gap-5 gap-lg-0">
        <div class="col-lg-6 text-center text-lg-start">
          <h1>
            Your Journey, <br />
            Designed by You
          </h1>
          <p>
            From dream to destination—let us craft a travel plan that’s
            truly yours
          </p>
          <div
            class="d-flex flex-column flex-sm-row gap-3 mt-4 mx-auto mx-lg-0"
            style="width: fit-content">
            <div
              class="d-flex align-items-center gap-2 bg-white px-4 py-3 rounded-3">
              <h5 class="m-0 fw-bold text-black">4.5</h5>
              <span class="d-flex align-items-center text-teal">
                <i class="ri-checkbox-blank-circle-fill"></i>
                <i class="ri-checkbox-blank-circle-fill"></i>
                <i class="ri-checkbox-blank-circle-fill"></i>
                <i class="ri-checkbox-blank-circle-fill"></i>
                <i class="ri-checkbox-blank-circle-line"></i>
              </span>
              <p class="m-0 small text-light-emphasis">1,991 reviews</p>
            </div>
            <!-- <div
              class="d-flex align-items-center gap-2 bg-white px-4 py-3 rounded-3">
              <h5 class="m-0 fw-bold text-black">4.5</h5>
              <span class="d-flex align-items-center text-teal">
                <i class="ri-checkbox-blank-circle-fill"></i>
                <i class="ri-checkbox-blank-circle-fill"></i>
                <i class="ri-checkbox-blank-circle-fill"></i>
                <i class="ri-checkbox-blank-circle-fill"></i>
                <i class="ri-checkbox-blank-circle-line"></i>
              </span>
              <p class="m-0 small text-light-emphasis">1,991 reviews</p>
            </div> -->
          </div>
        </div>
        <div class="col-lg-6">
         
          <?= $this->Form->create(null, [
                'url' => ['controller' => 'TailorMakeTour', 'action' => 'tailorMakeTour'],
                'id' => 'customizeForm',
                'class' => 'w-75 bg-white mx-auto rounded-3 p-4 text-start needs-validation',
                'novalidate',
            ]) ?>  
            <div class="progress mb-3">
              <div
                id="progressBar"
                class="progress-bar"
                role="progressbar"
                style="width: 0%"></div>
            </div>

            <!-- Step 1 -->
           <!--  <div class="step">
              
              
            </div> -->

            <!-- Step 2 -->
            <div class="step">
              <h6 class="text-black">
                Tour Start Date <span class="text-danger">*</span>
              </h6>
              <div class="mb-3">
                <input
                  class="form-control"
                  type="date"
                  name="date"
                  required />
              </div>
              <div class="mb-3" id="hotelPrefWrapper">
                <label class="form-label text-black">Hotel Category <span class="text-danger">*</span></label>
                <div class="d-flex gap-3">
                  <div class="form-check">
                    <input class="form-check-input hotel-checkbox" type="checkbox" name="hotel_preferences[]" id="3_star" value="3-star" />
                    <label class="form-check-label text-black" for="3_star">3 Star</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input hotel-checkbox" type="checkbox" name="hotel_preferences[]" id="4_star" value="4-star" />
                    <label class="form-check-label text-black" for="4_star">4 Star</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input hotel-checkbox" type="checkbox" name="hotel_preferences[]" id="5_star" value="5-star" />
                    <label class="form-check-label text-black" for="5_star">5 Star</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input hotel-checkbox" type="checkbox" name="hotel_preferences[]" id="luxury" value="Luxury" />
                    <label class="form-check-label text-black" for="luxury">Luxury</label>
                  </div>
                </div>
                <label id="hotel_preferences-error" class="error text-danger d-block" for="hotel_preferences[]" style="display: none;"></label>
              </div>
              <div class="mb-3">
                <label for="no_of_rooms" class="form-label text-black">No of Rooms <span class="text-danger">*</span></label>
                <select name="no_of_rooms" id="no_of_rooms" class="form-select" required>
                  <option value="">--select--</option>
                  <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                  <?php } ?>
                </select>
              </div>

              <!-- Room-wise adult/child containers will be generated here -->
              <div id="roomDetailsWrapper" class="overflow-y-auto" style="max-height: 190px;">
                <div id="roomDetailsContainer"></div>
              </div>

              <div class="mb-3">
                <label for="tcaptcha" class="d-block form-label text-black">Security Text <span class="text-danger">*</span></label>
                <div class="d-flex gap-2 align-items-center">
                  <input
                    type="text"
                    class="form-control text-uppercase w-50"
                    name="tcaptcha"
                    maxlength="6"
                    id="captchaInput"
                    placeholder="Enter security text"
                    required />
                  <span>
                    <img src="<?= WEBROOT ?>/tcaptcha" alt="CAPTCHA Image" class="captcha-img" id="tcaptchaImage" style="height: 40px;">
                    <a href="javascript:void(0);" onclick="document.getElementById('tcaptchaImage').src = '<?= WEBROOT ?>tcaptcha?' + Date.now();"><i class="fa fa-refresh" aria-hidden="true"></i></a>

                  </span>
                </div>

              </div>

              

            </div>

            <!-- Step 3 -->
            <div class="step d-none">
              <div class="mb-3">
                <label for="name" class="form-label text-black">Full Name <span class="text-danger">*</span></label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  name="name"
                  placeholder="Full Name"
                  required />
              </div>

              <div class="mb-3">
                <label for="email" class="form-label text-black">Email ID <span class="text-danger">*</span></label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="email"
                  placeholder="Email ID"
                  required />
              </div>

              <div class="mb-3">
                <label for="phone" class="form-label text-black">Phone <span class="text-danger">*</span></label>
                <input
                  type="tel"
                  class="form-control"
                  id="phone"
                  name="phone"
                  placeholder="Phone"
                  maxlength="15"
                  pattern="\d{5,13}"
                  required
                  oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
              </div>

              <div class="mb-3">
                <label for="country" class="form-label text-black">Country <span class="text-danger">*</span></label>
                <select class="form-select" name="country" id="country" required autocomplete="off">
                  <option value="">Select Country</option>
                  <?php
                  foreach ($countryList as $key => $val) {
                  ?>
                    <option value="<?= $val ?>"><?= $val ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>

              <h6 class="text-black">Any Special Requirements</h6>
              <div class="mb-3">
                <textarea
                  class="form-control"
                  rows="2"
                  name="requirement"
                  placeholder="Please specify here, if any customization required"></textarea>
              </div>
              
            </div>

            <div class="d-flex gap-2">
              <button
                type="button"
                class="w-75 btn bg-teal text-white"
                id="prevBtn">
                Previous
              </button>
              <button
                type="button"
                class="w-25 btn border-teal text-teal"
                id="nextBtn">
                Next
              </button>
            </div>
          <?php echo $this->Form->end(); ?>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="w-100 py-4">
  <h5 class="fw-semibold mb-5 mt-3">Suggested Tours</h5>
  <div class="row">
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card">
        <div class="position-relative">
          <span
            class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5">Private Tour</span>
          <div class="cutomGroup position-absolute">
            <i
              class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
          </div>
          <img
            src="<?= WEBROOT ?>version2/assets/images/7DayTour.png"
            class="card-img-top tour-image"
            alt="7 Day Golden Triangle Tour"
            data-default="<?= WEBROOT ?>version2/assets/images/7DayTour.png"
            data-map="<?= WEBROOT ?>version2/assets/images/delhi-jaipur.jpg" />
        </div>
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <p class="fs-6 fw-semibold m-0 lh-g col-9">
              7 Day Golden Triangle Tour
            </p>
            <span class="small text-secondary text-end col-3">6 Nights</span>
          </div>
          <p class="small fw-medium my-2">Tour Code : GT-193</p>
          <p class="small fw-regular m-0 text-secondary">
            Delhi → Agra → Jaipur
          </p>
          <div
            class="d-flex align-items-center justify-content-between mt-3">
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
            class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5">Private Tour</span>
          <div class="cutomGroup position-absolute">
            <i
              class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
          </div>
          <img
            src="<?= WEBROOT ?>version2/assets/images/8DayTour.png"
            class="card-img-top tour-image"
            alt="8 Day Golden Triangle Tour"
            data-default="<?= WEBROOT ?>version2/assets/images/8DayTour.png"
            data-map="<?= WEBROOT ?>version2/assets/images/delhi-jaipur.jpg" />
        </div>
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <p class="fs-6 fw-semibold m-0 lh-g col-9">
              8 Day Golden Triangle Tour
            </p>
            <span class="small text-secondary text-end col-3">7 Nights</span>
          </div>
          <p class="small fw-medium my-2">Tour Code : GT-195</p>
          <p class="small fw-regular m-0 text-secondary">
            Delhi → Agra → Jaipur → Udaipur
          </p>
          <div
            class="d-flex align-items-center justify-content-between mt-3">
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
            class="badge bg-gradient position-absolute rounded-1 text-white fw-medium p-2 left-5">Private Tour</span>
          <div class="cutomGroup position-absolute">
            <i
              class="ri-map-pin-2-fill bg-white p-2 rounded-circle location-icon"></i>
          </div>
          <img
            src="<?= WEBROOT ?>version2/assets/images/8WildlifeDayTour.png"
            class="card-img-top tour-image"
            alt="8 Day Golden Triangle with Ranthambore Wildlife"
            data-default="<?= WEBROOT ?>version2/assets/images/8WildlifeDayTour.png"
            data-map="<?= WEBROOT ?>version2/assets/images/delhi-jaipur.jpg" />
        </div>
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <p class="fs-6 fw-semibold m-0 lh-g col-9">
              8 Day Golden Triangle with Ranthambore Wildlife
            </p>
            <span class="small text-secondary text-end col-3">7 Nights</span>
          </div>
          <p class="small fw-medium my-2">Tour Code : GT-194</p>
          <p class="small fw-regular m-0 text-secondary">
            Delhi → Agra → Ranthambore → Jaipur
          </p>
          <div
            class="d-flex align-items-center justify-content-between mt-3">
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
<script>
  $(document).ready(function() {
    const $roomContainer = $("#roomDetailsContainer");
    const $form = $("#customizeForm");
    var _csrfToken = '<?= $this->request->getAttribute('csrfToken') ?>';
    $.validator.addMethod("maxThreePerRoom", function(value, element) {
      const $room = $(element).closest(".room-section");
      const adults = parseInt($room.find(".room-adults").val()) || 0;
      const children = parseInt($room.find(".room-children").val()) || 0;
      return (adults + children) <= 3;
    }, "Max 3 people (adult + child) allowed per room.");

    function buildRooms(roomCount) {
      $roomContainer.empty();

      for (let i = 1; i <= roomCount; i++) {
        const roomHTML = `
        <div class="room-section border p-2 mb-2 rounded bg-light" data-room-index="${i}">
          <div class="row">
            <div class="col-md-3 mb-2"><h6 class="text-black mb-0 room-title">Room ${i}</h6></div>
            <div class="col-md-4 mb-2">
              <label class="form-label text-black">Adults <span class="text-danger">*</span></label>
              <select name="room_${i}_adults" class="form-select room-adults" required>
                ${[1, 2, 3].map(n => `<option value="${n}">${n}</option>`).join('')}
              </select>
              <label class="error text-danger d-block room-adults-error"></label>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label text-black">Child</label>
              <select name="room_${i}_children" class="form-select room-children" required>
                ${[0, 1, 2].map(n => `<option value="${n}">${n}</option>`).join('')}
              </select>
              <label class="error text-danger d-block room-children-error"></label>
            </div>
            <div class="col-md-1 mb-2 remove-room-btn" style="cursor:pointer">
              <i class="fa fa-times text-danger"></i>
            </div>
          </div>

          <div class="child-age-wrapper row mt-2 mx-3 justify-content-end"></div>
        </div>
      `;

        $roomContainer.append(roomHTML);
      }

      // Dynamic age dropdowns when child count changes
      $roomContainer.off("change", ".room-children").on("change", ".room-children", function() {
        const $select = $(this);
        const numChildren = parseInt($select.val()) || 0;
        const $wrapper = $select.closest(".room-section").find(".child-age-wrapper");

        // Remove previous validation rules on existing child age dropdowns
        $wrapper.find("select").each(function() {
          $(this).rules("remove");
        });

        // Clear the wrapper before appending
        $wrapper.empty();

        for (let i = 1; i <= numChildren; i++) {
          const ageName = `${$select.attr('name')}_age_${i}`;

          // Append raw HTML string directly
          $wrapper.append(`
            <div class="col-md-4 mb-2">
              <label class="form-label text-black">Child ${i} Age</label>
              <select name="${ageName}" class="form-select child-age-select" required>
                
                ${[1,2,3,4,5,6,7,8,9,10,11,12].map(age => `<option value="${age}">${age}</option>`).join('')}
              </select>
            </div>
          `);

          // Use `find()` AFTER appending to target newly inserted select
          const $newSelect = $wrapper.find(`select[name="${ageName}"]`);

          // Attach validation
          /* $form.validate().settings.ignore = "";
          $form.validate().element($newSelect);
          $newSelect.rules("add", {
            required: true,
            messages: {
              required: "Please select age"
            }
          }); */
        }
      });
      // Add validation rules
      for (let i = 1; i <= roomCount; i++) {
        $(`select[name="room_${i}_adults"]`).rules("add", {
          required: true,
          maxThreePerRoom: true
        });
        $(`select[name="room_${i}_children"]`).rules("add", {
          required: true,
          maxThreePerRoom: true
        });
      }
    }

    // Remove room on close button click
    $roomContainer.on("click", ".remove-room-btn", function() {
      $(this).closest(".room-section").remove();
      reindexRooms();
    });

    // Reindex room titles and input names after removal
    function reindexRooms() {
      let index = 1;
      $roomContainer.find(".room-section").each(function() {
        $(this).attr("data-room-index", index);
        $(this).find(".room-title").text(`Room ${index}`);
        $(this).find(".room-adults").attr("name", `room_${index}_adults`);
        $(this).find(".room-children").attr("name", `room_${index}_children`);
        index++;
      });

      // Also update the room count dropdown to reflect current number
      $('#no_of_rooms').val(index - 1);
    }

    // Handle room count change
    $('#no_of_rooms').on('change', function() {
      const roomCount = parseInt($(this).val()) || 0;
      buildRooms(roomCount);
    });


    $roomContainer.off("change", ".room-adults, .room-children").on("change", ".room-adults, .room-children", function() {
      $(this).valid(); // triggers validation and displays error if invalid
    });


  });
</script>
<script>
  $(document).ready(function() {
    let currentStep = 0;
    const steps = $(".step");
    const progressBar = $("#progressBar");
    const form = $("#customizeForm");
    const _csrfToken = '<?= $this->request->getAttribute("csrfToken") ?>';

    // Convert captcha to uppercase
    $('#captchaInput').on('input', function() {
      this.value = this.value.toUpperCase();
    });

    // Setup validation
    form.validate({
      ignore: ":hidden:not(.step:visible input):not(.step:visible select):not(.step:visible textarea)",
      errorPlacement: function(error, element) {
        if (element.attr("name") === "tcaptcha") {
          error.insertAfter(element.closest('div'));
        } else if (element.hasClass("room-adults")) {
          element.closest(".mb-3").find(".room-adults-error").html(error);
        } else if (element.hasClass("room-children")) {
          element.closest(".mb-3").find(".room-children-error").html(error);
        } else if (element.attr("name") === "hotel_preferences[]") {
          error.appendTo("#hotelPrefWrapper");
        } else {
          error.insertAfter(element);
        }
      },
      rules: {
        name: "required",
        email: {
          required: true,
          email: true,
        },
        phone: {
          required: true,
          digits: true,
          minlength: 5,
          maxlength: 15,
        },
        country: "required",
        tcaptcha: {
          required: true,
          minlength: 6,
          maxlength: 6,
          remote: {
            url: "<?= $this->Url->build('/tverify-captcha') ?>",
            type: "post",
            data: {
              captcha: function() {
                return $('#captchaInput').val();
              },
              _csrfToken: _csrfToken
            }
          }
        },
        date: "required",
        'hotel_preferences[]': {
          required: true,
          minlength: 1
        },
        no_of_rooms: "required",

      },
      messages: {
        tcaptcha: {
          remote: "Incorrect security text."
        },
        'hotel_preferences[]': {
          required: "Please select at least one hotel preference."
        }
      }
    });

    $(".hotel-checkbox").on("change", function() {
      $("input[name='hotel_preferences[]']").valid();
    });

    // Function to update step UI
    function updateStep() {
      steps.addClass("d-none").eq(currentStep).removeClass("d-none");
      let percent = ((currentStep + 1) / steps.length) * 100;
      progressBar.css("width", percent + "%").text(`Step ${currentStep + 1} of ${steps.length}`);
      $("#prevBtn").prop("disabled", currentStep === 0);
      $("#nextBtn").text(currentStep === steps.length - 1 ? "Submit" : "Next");
    }

    // Handle Next
    $("#nextBtn").click(function() {
      if (!form.valid()) return;

      if (currentStep < steps.length - 1) {
        currentStep++;
        updateStep();
      } else {
        // Final submission
        $(this).html(`<span class="spinner-border spinner-border-sm" role="status"></span>`);
        $(this).prop("disabled", true);
        
        form.submit();
      }
    });

    // Handle Previous
    $("#prevBtn").click(function() {
      if (currentStep > 0) {
        currentStep--;
        updateStep();
      }
    });

    updateStep();

    function reindexRooms() {
      const $roomContainer = $("#roomDetailsContainer");
      const $rooms = $roomContainer.find(".room-section");
      const $dropdown = $('#no_of_rooms');

      let index = 1;

      $rooms.each(function() {
        $(this).attr("data-room-index", index);
        $(this).find(".room-title").text(`Room ${index}`);

        const $adults = $(this).find(".room-adults");
        const $children = $(this).find(".room-children");

        // Update name attributes and re-attach validation
        $adults
          .attr("name", `room_${index}_adults`)
          .rules("remove")
          .rules("add", {
            required: true,
            maxThreePerRoom: true
          });

        $children
          .attr("name", `room_${index}_children`)
          .rules("remove")
          .rules("add", {
            required: true,
            maxThreePerRoom: true
          });

        index++;
      });

      const newRoomCount = $rooms.length;

      //Update dropdown to match current room count
      $dropdown.empty().append(`<option value="">--select--</option>`);
      for (let i = 1; i <= 5; i++) {
        $dropdown.append(`<option value="${i}">${i}</option>`);
      }

      //Set selected value only if there's at least one room
      if (newRoomCount > 0) {
        $dropdown.val(newRoomCount);
      } else {
        $dropdown.val(""); // Reset to default --select--
      }

      //Show/Hide remove buttons conditionally
      if (newRoomCount <= 1) {
        $rooms.find(".remove-room-btn").prop("disabled", true).hide();
      } else {
        $rooms.find(".remove-room-btn").prop("disabled", false).show();
      }
    }
  });
</script>