$(document).ready(function () {
  refreshCaptcha();

  $("#next_step").on("click", function () {
    if ($("#bookingForm").valid()) {
      const pageUrl = window.location.href;
      // Validate only Step 1 fields before showing Step 2
      const step1Fields = ["fullName", "email", "phone", "captcha"];
      let isValid = true;

      step1Fields.forEach(function (fieldName) {
        if (!$(`[name="${fieldName}"]`).valid()) {
          isValid = false;
        }
      });

      if (isValid) {
        // Send short mail (Step 1 data only)
        const step1Data = {
          fullName: $("input[name=fullName]").val(),
          email: $("input[name=email]").val(),
          phone: $("input[name=phone]").val(),
          country: $("input[name=country]").val(),
          enquiryComment: $("#enquiryComment").val(),
          captcha: $("#captcha").val(),
          page_url: pageUrl,
        };

        // Show full-screen loader
        $("#fullLoader").removeClass("d-none");

        $.ajax({
          url: trainShortEnquiryUrl,
          method: "POST",
          data: step1Data,
          dataType: "json",
           headers: {
          "X-CSRF-Token": csrfToken
        },
          success: function (res) {
            if (res.status === "success") {
              $("#fullLoader").addClass("d-none");
              $("#step1").hide();
              $("#step2").show();
            } else {
              $("#fullLoader").addClass("d-none");
              alert("CAPTCHA failed or error in step 1 submission.");
              refreshCaptcha();
            }
          },
          error: function () {
            $("#fullLoader").addClass("d-none");
            alert("Error sending short mail. Please try again.");
            refreshCaptcha();
          },
        });
      }
    }
  });

  $("#bookingForm").validate({
     
    errorElement: "div",
    errorClass: "invalid-feedback",
    highlight: function (element) {
      $(element).addClass("is-invalid");
    },
    unhighlight: function (element) {
      $(element).removeClass("is-invalid");
    },
    rules: {
      fullName: "required",
      email: {
        required: true,
        email: true,
      },
      phone: {
        required: true,
        minlength: 5,
        digits: true,
      },
      zip: "required",
      season: "required",
      months: "required",
      cabins: "required",
      captcha: {
        required: true,
        remote: {
          url: tVerifyCaptchaUrl,
          type: "POST",
           headers: {
            "X-CSRF-Token": csrfToken
          },  
          data: {
            captcha: function () {
              return $("#captcha").val(); // Send the current captcha input value
            },
          },
          dataType: "json",
          complete: function (response) {
            console.log("Captcha validation response:", response.responseText);
          },
        },
      },
    },
    messages: {
      fullName: "Please enter your name",
      email: {
        required: "Please enter your email",
        email: "Enter a valid email",
      },
      phone: {
        required: "Please enter your mobile number",
        minlength: "At least 5 digits",
        digits: "Only numbers allowed",
      },
      zip: "Please enter ZIP/Postal Code",
      season: "Please select a season",
      months: "Please select a departure date",
      cabins: "Please select number of cabins",
      captcha: {
        required: "Please enter captcha",
        remote: "Incorrect captcha, please try again",
      },
    },
    errorPlacement: function (error, element) {
      if (element.attr("name") === "captcha") {
        error.insertAfter("#captcha");
      } else {
        error.insertAfter(element);
      }
    },
    submitHandler: function (form) {
      if (!validateCabinOccupancy()) {
        return false;
      }
      // Show full-screen loader
      $("#fullLoader").removeClass("d-none");
      $.ajax({
        url: trainContactEnquiryUrl,
        type: "POST",
        //data: $(form).serialize(),
        data: $(form).serialize() + '&page_url=' + encodeURIComponent(window.location.href),
        dataType: "json",
        headers: {
          "X-CSRF-Token": csrfToken
        },
        success: function (response) {
          let message = response.message || "Form submission result.";
          $("#modalMessage").html(`<p>${message}</p>`);

          if (response.status === "success") {
            $("#fullLoader").addClass("d-none");
            $("#responseModalLabel").text("Success");
            $("#modalMessage")
              .addClass("text-success")
              .removeClass("text-danger");
            form.reset();
            $("#step1").show();
            $("#step2").hide();
            refreshCaptcha();
          } else {
            $("#fullLoader").addClass("d-none");
            $("#responseModalLabel").text("Error");
            $("#modalMessage")
              .addClass("text-danger")
              .removeClass("text-success");
            $("#step1").show();
            $("#step2").hide();

            refreshCaptcha();
          }

          const modal = new bootstrap.Modal(
            document.getElementById("responseModal")
          );
          modal.show();
        },
        error: function () {
          $("#modalMessage").html(
            `<p>Something went wrong. Please try again.</p>`
          );
          $("#responseModalLabel").text("Error");
          $("#modalMessage")
            .addClass("text-danger")
            .removeClass("text-success");

          const modal = new bootstrap.Modal(
            document.getElementById("responseModal")
          );
          modal.show();
          $("#step1").show();
          $("#step2").hide();

          refreshCaptcha();
        },
      });
    },
  });
});
$("#numCabins").append(`<option value="">Select Cabin</option>`);

for (let i = 0; i < 10; i++) {
  $("#numCabins").append(`<option value="${i + 1}">Cabin ${i + 1}</option>`);
}

const monthsBySeason = {
  2025: [
    "17-Sep-2025",

    "24-Sep-2025",

    "01-Oct-2025",

    "08-Oct-2025",

    "15-Oct-2025",

    "22-Oct-2025",

    "29-Oct-2025",

    "05-Nov-2025",

    "12-Nov-2025",

    "19-Nov-2025",

    "26-Nov-2025",

    "03-Dec-2025",

    "10-Dec-2025",

    "17-Dec-2025",

    "24-Dec-2025",

    "31-Dec-2025",
  ],

  2026: [
    "07-Jan-2026",

    "14-Jan-2026",

    "21-Jan-2026",

    "28-Jan-2026",

    "04-Feb-2026",

    "11-Feb-2026",

    "18-Feb-2026",

    "25-Feb-2026",

    "04-Mar-2026",

    "11-Mar-2026",

    "18-Mar-2026",

    "25-Mar-2026",

    "01-Apr-2026",

    "08-Apr-2026",

    "15-Apr-2026",

    "22-Apr-2026",

    "29-Apr-2026",

    "02-Sep-2026",

    "09-Sep-2026",

    "16-Sep-2026",

    "23-Sep-2026",

    "30-Sep-2026",

    "07-Oct-2026",

    "14-Oct-2026",

    "21-Oct-2026",

    "28-Oct-2026",

    "04-Nov-2026",

    "11-Nov-2026",

    "18-Nov-2026",

    "25-Nov-2026",

    "02-Dec-2026",

    "09-Dec-2026",

    "16-Dec-2026",

    "23-Dec-2026",

    "30-Dec-2026",
  ],

  2027: [
    "06-Jan-2027",

    "13-Jan-2027",

    "20-Jan-2027",

    "27-Jan-2027",

    "03-Feb-2027",

    "10-Feb-2027",

    "17-Feb-2027",

    "24-Feb-2027",

    "03-Mar-2027",

    "10-Mar-2027",

    "17-Mar-2027",

    "24-Mar-2027",

    "31-Mar-2027",

    "07-Apr-2027",

    "14-Apr-2027",

    "21-Apr-2027",

    "28-Apr-2027",

    "08-Sep-2027",

    "15-Sep-2027",

    "22-Sep-2027",

    "29-Sep-2027",

    "06-Oct-2027",

    "13-Oct-2027",

    "20-Oct-2027",

    "27-Oct-2027",

    "03-Nov-2027",

    "10-Nov-2027",

    "17-Nov-2027",

    "24-Nov-2027",

    "01-Dec-2027",

    "08-Dec-2027",

    "15-Dec-2027",

    "22-Dec-2027",

    "29-Dec-2027",
  ],
};

$("#seasonId").on("change", function () {
  const season = $(this).val();

  const months = monthsBySeason[season] || [];

  const $monthDropdown = $("#monthId");

  // Clear previous options

  $monthDropdown

    .empty()

    .append('<option value="">Select Month</option>');

  // Populate new options

  months.forEach(function (month) {
    $monthDropdown.append(`<option value="${month}">${month}</option>`);
  });
});

$("#numCabins").on("change", function () {
  let count = parseInt($(this).val());

  let html = "";

  for (let i = 1; i <= count; i++) {
    html += `

              <div class="col-md-5 p-4 border rounded-lg mb-3 cabin-bg">

                <strong>Cabin ${i}</strong><br>

                <label>Category:</label>

                <select name="cabin_category_${i}" class="form-control mb-2">

                  <option value="">Select Category</option>

                  <option value="Deluxe">Deluxe</option>

                  <option value="Superior Deluxe">Superior Deluxe</option>

                  <option value="Suite">Suite</option>

                </select>

                <label>Adults:</label>

                  <select name="adults_${i}" class="form-control mb-2">

                    <option value="1">1</option>

                    <option value="2">2</option>

                  </select>

                <div class="d-md-flex gap-2">

                  

                  <div class="col px-0 pr-md-2"> 

                    <label>Child (0-5 yrs):</label>

                    <select name="infants_${i}" class="form-control mb-2">

                      <option value="0">0</option>

                      <option value="1">1</option>

                    </select>

                  </div>

                  <div class="col px-0 pl-md-2">

                    <label>Child (5-12 yrs):</label>

                    <select name="children_${i}" class="form-control mb-2">

                      <option value="0">0</option>

                      <option value="1">1</option>

                      <option value="2">2</option>

                    </select>

                  </div>

                </div>

              </div>`;
  }

  $("#cabinDetails").html(html);
});

function validateCabinOccupancy() {
  let isValid = true;

  let errorMsg =
    "Total passengers (Adult + Child + Infant) cannot exceed 3 per cabin.";

  $("#cabinDetails .col-md-5").each(function () {
    const adults = parseInt($(this).find("select[name^=adults_]").val()) || 0;

    const infants = parseInt($(this).find("select[name^=infants_]").val()) || 0;

    const children =
      parseInt($(this).find("select[name^=children_]").val()) || 0;

    const total = adults + infants + children;

    $(this).find(".cabin-error").remove(); // clear previous errors

    if (total > 3) {
      isValid = false;

      $(this).append(
        `<div class="text-danger cabin-error mt-1">${errorMsg}</div>`
      );
    }
  });

  return isValid;
}

// Add validation rules for dynamically created cabin fields

$("#cabinDetails")
  .find('select[name^="cabin_category_"], select[name^="adults_"]')

  .each(function () {
    $(this).rules("add", {
      required: true,

      messages: {
        required: "This field is required",
      },
    });
  });

$('select[name^="cabin_category_"]').each(function () {
  $(this).rules("add", {
    required: true,

    messages: {
      required: "Please select a category",
    },
  });
});

$(document).on("click", "#refreshCaptchaBtn", function () {
  refreshCaptcha();
});

function refreshCaptcha() {
  document.getElementById("captchaImage").src = captchaUrl + "?" + Date.now();
}
/*
function refreshCaptcha() {
  document.getElementById("captchaImage").src = "train-captcha";
}*/
function trefreshCaptcha() {
  document.getElementById("captchaImage").src = "train-ecaptcha";
}

/****************************************Enquiry Form***********************************************/
$(document).ready(function () {

  refreshCaptcha();

  var _csrfToken = csrfToken;

  $("#enquiryForm").validate({

    errorElement: "div",
    errorClass: "invalid-feedback",

    highlight: function (element) {
      $(element).addClass("is-invalid");
    },

    unhighlight: function (element) {
      $(element).removeClass("is-invalid");
    },

    rules: {
      ename: "required",

      eemail: {
        required: true,
        email: true,
      },

      ephone: {
        required: true,
        minlength: 5,
        digits: true,
      },

      ecaptcha: {
        required: true,
        remote: {
          url: trainVerifyCaptchaUrl,
          type: "POST",
          headers: {
            "X-CSRF-Token": _csrfToken
          },
          data: {
            captcha: function () {
              return $("#ecaptcha").val();
            }
          },
          dataType: "json"
        }
      }
    },

    messages: {
      ename: "Please enter your name",

      eemail: {
        required: "Please enter your email",
        email: "Enter a valid email"
      },

      ephone: {
        required: "Please enter your mobile number",
        minlength: "At least 5 digits",
        digits: "Only numbers allowed"
      },

      ecaptcha: {
        required: "Please enter captcha",
        remote: "Incorrect captcha, please try again"
      }
    },

    errorPlacement: function (error, element) {
      if (element.attr("name") === "ecaptcha") {
        error.insertAfter("#ecaptcha");
      } else {
        error.insertAfter(element);
      }
    },

    submitHandler: function (form) {

      $("#fullLoader").removeClass("d-none");

      $.ajax({

        url: trainSendEnquiryUrl,

        type: "POST",

        headers: {
          "X-CSRF-Token": _csrfToken
        },

        data: $(form).serialize(),

        dataType: "json",

        success: function (response) {

          let message = response.message || "Form submission result.";

          $("#modalMessage").html(`<p>${message}</p>`);

          $("#fullLoader").addClass("d-none");

          if (response.status === "success") {

            $("#formPopup").hide();

            $("#responseModalLabel").text("Success");

            $("#modalMessage")
              .addClass("text-success")
              .removeClass("text-danger");

            form.reset();

          } else {

            $("#responseModalLabel").text("Error");

            $("#modalMessage")
              .addClass("text-danger")
              .removeClass("text-success");
          }

          refreshCaptcha();

          const modal = new bootstrap.Modal(
            document.getElementById("responseModal")
          );

          modal.show();
        },

        error: function () {

          $("#fullLoader").addClass("d-none");

          $("#modalMessage").html(
            `<p>Something went wrong. Please try again.</p>`
          );

          $("#responseModalLabel").text("Error");

          $("#modalMessage")
            .addClass("text-danger")
            .removeClass("text-success");

          refreshCaptcha();

          const modal = new bootstrap.Modal(
            document.getElementById("responseModal")
          );

          modal.show();
        }

      });

    }

  });

});

/****************************************Offer Price Enquiry Form***********************************************/
    $(document).ready(function() {

      $('#claimNowBtn').on('click', function() {
        const price = $('#modalPrice').text();
        $('#tprice').val(price); // store price for email use
        $('#claimStep').addClass('d-none');
        $('#tarrifForm').removeClass('d-none').hide().fadeIn(400);
      });

      // --- STEP 1: Show modal price ---
      $('[data-bs-target="#popper-popup"]').on('click', function() {
        var price = $(this).data('price');
        $('#modalPrice').hide().text(price).fadeIn(400);
      });

      // --- STEP 1 → STEP 2 ---
      $('#claimNowBtn').on('click', function() {
        $('#claimStep').addClass('d-none');
        $('#tarrifForm').removeClass('d-none').hide().fadeIn(400);
      });

      // --- RESET MODAL ---

      $('#popper-popup').on('hidden.bs.modal', function() {
        // Hide Step 2 form and Step 3
        $('#tarrifForm').addClass('d-none');
        $('#step3').addClass('d-none');

        // Show Step 1 (Claim Now)
        $('#claimStep').removeClass('d-none');

        // Reset all form fields in Step 2 and Step 3
        $('#tarrifForm')[0].reset();

        // Reset validation messages
        $("#tarrifForm").validate().resetForm();

        // Make sure all Step 2 divs are visible again
        $("#tarrifForm > div").not("#step3").removeClass("d-none");

        // Optional: if you have dynamic select options or cabin details, clear them too
        $('#tmonthId').html('<option value="">Select Date</option>');
        $('#tnumCabins').val('');
        $('#tcabinDetails').empty();
      });

      // --- POPULATE CABIN OPTIONS ---
      $("#tnumCabins").append(`<option value="">Select Cabin</option>`);
      for (let i = 1; i <= 10; i++) {
        $("#tnumCabins").append(`<option value="${i}">Cabin ${i}</option>`);
      }

      // --- VALIDATION ---
      var tariffValidator = $("#tarrifForm").validate({
        errorElement: "span",
        errorClass: "text-danger small",
        rules: {
          tname: {
            required: true,
            minlength: 2
          },
          tphone: {
            required: true,
            digits: true,
            minlength: 5,
           /*  maxlength: 10 */
          },
          temail: {
            required: true,
            email: true
          },
          tcaptcha: {
            required: true,
            remote: {
              url: oVerifyCaptchaUrl,
              type: "POST",
              headers: {
                "X-CSRF-Token": csrfToken
              },
              data: {
                captcha: () => $("#tcaptcha").val()
              },
              dataType: "json",
            },
          },
          tseason: {
            required: true
          },
          tmonths: {
            required: true
          },
          tcabins: {
            required: true
          }
        },
        messages: {
          tname: {
            required: "Please enter your name",
            minlength: "Name must be at least 2 characters long"
          },
          tphone: {
            required: "Please enter your mobile number",
            digits: "Enter digits only",
            minlength: "Must be 5 digits",
           /*  maxlength: "Must be 10 digits" */
          },
          temail: {
            required: "Please enter your email",
            email: "Enter a valid email"
          },
          tcaptcha: {
            required: "Please enter CAPTCHA",
            remote: "Invalid CAPTCHA, try again"
          },
          tseason: {
            required: "Select a season"
          },
          tmonths: {
            required: "Select a departure date"
          },
          tcabins: {
            required: "Select number of cabins"
          }
        },
        errorPlacement: function(error, element) {
          if (element.attr("name") === "tcaptcha") {
            error.insertAfter("#tcaptcha");
          } else {
            error.insertAfter(element);
          }
        },

        submitHandler: function(form, event) {
          event.preventDefault();

          // 🔹 Step 2  Step 3 transition + send email #1
          if ($("#step3").hasClass("d-none")) {
            if (!tvalidateCabinOccupancy()) return false;

            // Send Step 2 data via AJAX (email #1)
            let step2Data = new FormData(form);
            $.ajax({
              url: tariffEnquiryMailUrl,
              type: "POST",
              
              data: step2Data,
              processData: false,
              contentType: false,
              headers: {
                "X-CSRF-Token": csrfToken
              },
              beforeSend: function() {
                $("#claimNowBtn, #tarrifForm button[type='submit']").prop("disabled", true);
              },
              success: function(response) {
                $("#claimNowBtn, #tarrifForm button[type='submit']").prop("disabled", false);
                console.log("Step 2 email sent:", response);
              },
              error: function() {
                console.warn("Error sending Step 2 email (non-blocking).");
              }
            });

            // Now open Step 3
            $("#tarrifForm > div:not(#step3)").addClass("d-none");
            $("#step3").removeClass("d-none").hide().fadeIn(400);
            $(".modal-body").animate({
              scrollTop: 0
            }, 400);
            return false;
          }

          // 🔹 Step 3 submission → send final email #2
          let fullData = new FormData(form);
          $.ajax({
            url: tariffdetailEnquiryMailUrl,
            type: "POST",
            headers: {
                "X-CSRF-Token": csrfToken
              },
            data: fullData,
            processData: false,
            contentType: false,
            beforeSend: function() {
              $("#step3 button[type='submit']").prop("disabled", true).text("Sending...");
            },
            success: function(res) {
              $("#step3 button[type='submit']").prop("disabled", false).text("Submit");

              /* let res = {};
              try {
                res = JSON.parse(response);
              } catch (e) {
                console.warn("Invalid JSON:", response);
                res = { status: "error", message: "Unexpected response from server." };
              } */

              const message = res.message || "Form submission result.";

              // Update response modal text and color
              $("#responseModalLabel").text(res.status === "success" ? "Success" : "Error");
              $("#modalMessage")
                .html(`<p>${message}</p>`)
                .removeClass("text-success text-danger")
                .addClass(res.status === "success" ? "text-success" : "text-danger");

              // Hide tariff modal first, then show response modal
              $("#popper-popup").modal("hide");

              // Wait for main modal to fully hide before showing message modal
              $("#popper-popup").one("hidden.bs.modal", function() {
                $("#responseModal").modal("show");
              });

              if (res.status === "success") {
                // Reset all form fields
                $("#tarrifForm")[0].reset();
                $("#step3").addClass("d-none");
                $("#claimStep").removeClass("d-none");
              } else {
                trefreshCaptcha(); // Refresh captcha only on error
              }
            },
            error: function() {
              $("#responseModalLabel").text("Error");
              $("#modalMessage").html(`<p>Something went wrong. Please try again.</p>`).addClass("text-danger").removeClass("text-success");
              const modal = new bootstrap.Modal(document.getElementById("responseModal"));
              modal.show();
              trefreshCaptcha();
            }
          });
        }

      });


      $("#tnumCabins").on("change", function() {
        let count = parseInt($(this).val()) || 0;
        let html = "";

        for (let i = 1; i <= count; i++) {
          html += `
        <div class="col-md-5 p-4 border rounded-lg mb-3 cabin-bg">
          <strong>Cabin ${i}</strong><br>
          <label>Category:</label>
          <select name="cabin_category_${i}" class="form-control mb-2">
            <option value="">Select Category</option>
            <option value="Deluxe">Deluxe</option>
            <option value="Superior Deluxe">Superior Deluxe</option>
            <option value="Suite">Suite</option>
          </select>
          <label>Adults:</label>
          <select name="adults_${i}" class="form-control mb-2">
            <option value="1">1</option>
            <option value="2">2</option>
          </select>
          <label>Child Details:</label>
          <div class="d-md-flex gap-2">
            <div class="col px-0 pr-md-2">
              <label>(0-5 yrs):</label>
              <select name="infants_${i}" class="form-control mb-2">
                <option value="0">0</option>
                <option value="1">1</option>
              </select>
            </div>
            <div class="col px-0 pl-md-2">
              <label>(5-12 yrs):</label>
              <select name="children_${i}" class="form-control mb-2">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
              </select>
            </div>
          </div>
        </div>`;
        }

        $("#tcabinDetails").html(html);
        addCabinRules();
      });

      function addCabinRules() {
        $("#tcabinDetails").find("select").each(function() {
          var name = $(this).attr("name");
          if (!name) return;
          try {
            $(this).rules("remove");
          } catch (e) {}
          $(this).rules("add", {
            required: true,
            messages: {
              required: "This field is required"
            },
          });
        });
      }

      function tvalidateCabinOccupancy() {
        let isValid = true;
        let errorMsg = "Total passengers (Adult + Child + Infant) cannot exceed 3 per cabin.";

        // iterate the generated cabin wrappers
        $("#tcabinDetails .col-md-5").each(function() {
          const adults = parseInt($(this).find('select[name^="adults_"]').val()) || 0;
          const infants = parseInt($(this).find('select[name^="infants_"]').val()) || 0;
          const children = parseInt($(this).find('select[name^="children_"]').val()) || 0;
          const total = adults + infants + children;

          $(this).find(".cabin-error").remove(); // clear previous errors

          if (total > 3) {
            isValid = false;
            $(this).append(`<div class="text-danger cabin-error mt-1">${errorMsg}</div>`);
          }
        });

        return isValid;
      }

      // if you have season -> months logic, keep it:
      $("#tseasonId").on("change", function() {
        const tseason = $(this).val();
        const tmonths = tmonthsBySeason[tseason] || [];
        const $tmonthDropdown = $("#tmonthId");
        $tmonthDropdown.empty().append('<option value="">Select Month</option>');
        tmonths.forEach(function(tmonth) {
          $tmonthDropdown.append(`<option value="${tmonth}">${tmonth}</option>`);
        });
      });
      const tmonthsBySeason = {
        2025: [
          "17-Sep-2025",

          "24-Sep-2025",

          "01-Oct-2025",

          "08-Oct-2025",

          "15-Oct-2025",

          "22-Oct-2025",

          "29-Oct-2025",

          "05-Nov-2025",

          "12-Nov-2025",

          "19-Nov-2025",

          "26-Nov-2025",

          "03-Dec-2025",

          "10-Dec-2025",

          "17-Dec-2025",

          "24-Dec-2025",

          "31-Dec-2025",
        ],

        2026: [
          "07-Jan-2026",

          "14-Jan-2026",

          "21-Jan-2026",

          "28-Jan-2026",

          "04-Feb-2026",

          "11-Feb-2026",

          "18-Feb-2026",

          "25-Feb-2026",

          "04-Mar-2026",

          "11-Mar-2026",

          "18-Mar-2026",

          "25-Mar-2026",

          "01-Apr-2026",

          "08-Apr-2026",

          "15-Apr-2026",

          "22-Apr-2026",

          "29-Apr-2026",

          "02-Sep-2026",

          "09-Sep-2026",

          "16-Sep-2026",

          "23-Sep-2026",

          "30-Sep-2026",

          "07-Oct-2026",

          "14-Oct-2026",

          "21-Oct-2026",

          "28-Oct-2026",

          "04-Nov-2026",

          "11-Nov-2026",

          "18-Nov-2026",

          "25-Nov-2026",

          "02-Dec-2026",

          "09-Dec-2026",

          "16-Dec-2026",

          "23-Dec-2026",

          "30-Dec-2026",
        ],

        2027: [
          "06-Jan-2027",

          "13-Jan-2027",

          "20-Jan-2027",

          "27-Jan-2027",

          "03-Feb-2027",

          "10-Feb-2027",

          "17-Feb-2027",

          "24-Feb-2027",

          "03-Mar-2027",

          "10-Mar-2027",

          "17-Mar-2027",

          "24-Mar-2027",

          "31-Mar-2027",

          "07-Apr-2027",

          "14-Apr-2027",

          "21-Apr-2027",

          "28-Apr-2027",

          "08-Sep-2027",

          "15-Sep-2027",

          "22-Sep-2027",

          "29-Sep-2027",

          "06-Oct-2027",

          "13-Oct-2027",

          "20-Oct-2027",

          "27-Oct-2027",

          "03-Nov-2027",

          "10-Nov-2027",

          "17-Nov-2027",

          "24-Nov-2027",

          "01-Dec-2027",

          "08-Dec-2027",

          "15-Dec-2027",

          "22-Dec-2027",

          "29-Dec-2027",
        ],
      };

    });
/***********************************************End of Offer Price Enquiry Form***********************************************/
