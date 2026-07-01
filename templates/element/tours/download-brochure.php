<style>
    .floating-download-btn {
  position: fixed;
  right: 20px; /* Distance from the left side */
  top: 90%; /* Center vertically */
  transform: translateY(-50%) rotate(90deg); /* Vertical center and rotate by 90 degrees */
  transform-origin: right center; /* Ensure it rotates around the left edge */
  background-color: #0a6938; /* Button color */
  color: #fff;
  padding: 12px 20px;
  text-decoration: none;
  font-size: 16px;
  border-radius: 5px;
  border: none;
  z-index: 1000; /* Keep on top of other elements */
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional shadow */
  transition: background-color 0.3s ease;
}

.floating-download-btn:hover {
  background-color: #0a6938; /* Darker blue on hover */
}

.floating-download-btn i {
  margin-right: 8px; /* Space between icon and text */
  }

@media (max-width: 768px) {
  .floating-download-btn {
    right: 10px; /* Adjust for mobile */
    padding: 10px 15px; /* Smaller padding */
    font-size: 14px;
  }
}

</style>

<button class="floating-download-btn" title="Download Brochure" data-bs-toggle="modal" data-bs-target="#brochure" data-tour-id="123">
  <i class="fa-solid fa-file-pdf"></i> Brochure
</button>


<!-- Modal -->
<div class="modal fade" id="brochure" tabindex="-1" aria-labelledby="brochureModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3">
      <h5 class="modal-title" id="staticBackdropLabel">Download Brochure</h5>

      <div class="modal-body">
        <!-- Hidden input to store Tour ID -->
        <input type="hidden" id="tour-id" name="tour-id">

        <!-- Form Fields -->
        <div class="mb-3">
          <label class="form-label blue">Full Name <span class="text-red">*</span></label>
          <input type="text" class="form-control" name="name" id="name">
          <div class="text-danger mt-1" id="name-error"></div>
        </div>
        <div class="mb-3">
          <label class="form-label blue">Phone Number <span class="text-red">*</span></label>
          <input type="text" class="form-control" name="phone" id="phone">
          <div class="text-danger mt-1" id="phone-error"></div>
        </div>
        <div class="mb-3">
          <label class="form-label blue">Email <span class="text-red">*</span></label>
          <input type="email" class="form-control" name="email" id="email">
          <div class="text-danger mt-1" id="email-error"></div>
        </div>

        <!-- Submit Button -->
        <div class="text-end">
          <button type="button" class="btn btn-success" id="download-btn">
            <i class="fa-solid fa-file-pdf"></i> Download Brochure
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- AJAX Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // Capture tour ID when modal is shown
  $('#brochure').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var tourId = button.data('tour-id');
    $('#tour-id').val(tourId);

    // Clear previous error messages
    $('.text-danger').text('');
    $('input').removeClass('is-invalid');
  });

  // Handle form submission and download PDF
  $('#download-btn').click(function () {
    var tourId = $('#tour-id').val();
    var name = $('#name').val().trim();
    var phone = $('#phone').val().trim();
    var email = $('#email').val().trim();

    // Clear previous error messages
    $('.text-danger').text('');
    $('input').removeClass('is-invalid');

    // Validate form
    var hasError = false;

    // Name Validation
    if (name === '') {
      $('#name-error').text('Please enter your full name.');
      $('#name').addClass('is-invalid');
      hasError = true;
    }

    // Phone Validation
    if (phone === '') {
      $('#phone-error').text('Please enter your phone number.');
      $('#phone').addClass('is-invalid');
      hasError = true;
    }

    // Email Validation
    if (email === '') {
      $('#email-error').text('Please enter your email.');
      $('#email').addClass('is-invalid');
      hasError = true;
    }

    if (hasError) return;

    // AJAX Request to Save Form Data
    $.ajax({
      url: 'http://dev.elegantjourneys.com/api/save-form',
      method: 'POST',
      data: {
        tour_id: tourId,
        name: name,
        phone: phone,
        email: email
      },
      success: function (response) {
        if (response.success) {
          // Trigger PDF download if saved successfully
          var downloadUrl = 'http://dev.elegantjourneys.com/tours/pdf?tour_id=' + tourId;
          window.location.href = downloadUrl;
        } else {
          alert('Failed to save form. Please try again.');
        }
      },
      error: function () {
        alert('An error occurred. Please try again.');
      }
    });
  });

  // Hide error messages if input is not empty
  $('input').on('input', function () {
    var input = $(this);
    var errorDiv = $('#' + input.attr('id') + '-error');
    if (input.val().trim() !== '') {
      errorDiv.text('');
      input.removeClass('is-invalid');
    }
  });
</script>