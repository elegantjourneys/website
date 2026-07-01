<section id="enquiryform" class="col-lg-9 col-xl-9 col-xxl-9 col-md-11 mx-lg-auto mx-3 mb-3">
	<div class="wsbold font-3 text-center blue mb-3">Tour Enquiry Form</div>
	<div class="enquiry-box p-lg-5 p-4">
		<form>
		<input type="hidden" name="enquiry_type" value="enquiry" id="tourFormEnquiryType">
			<div class="d-lg-flex justify-content-between">
				<div class="col-lg-5 col">
					<div class="mb-3">
						<label for="" class="form-label blue">Full Name <span class="text-red">*</span></label>
						<input type="text" class="form-control" required autocomplete="off" name="name" id="name">
					</div>
					<div class="mb-3">
						<label for="" class="form-label blue">Phone Number <span class="text-red">*</span></label>
						<input type="text" class="form-control" required autocomplete="off" name="phone" id="phone">
					</div>
					<div class="mb-3">
						<label for="" class="form-label blue">Email <span class="text-red">*</span></label>
						<input type="email" class="form-control" required autocomplete="off" name="email" id="email">
					</div>
					<div class="mb-3">
						<label for="" class="form-label blue">Country <span class="text-red">*</span></label>
						<select class="form-select" aria-label="Default select example" id="country" name="country" required autocomplete="off">
						  <option value="">Select Country</option>
							<?php						
								foreach($countryList as $key=>$val)
								{
							?>
								<option value="<?=$val?>"><?=$val?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div class="mb-3">
						<label for="" class="form-label blue">Number of Travellers <span class="text-red">*</span></label>
						<div id="roomsContainer">
							<!-- Room 1 (default room) -->
							<div class="room" id="room1">
								<div class="room-header">Room 1</div>
								<div class="row align-items-end">
									<div class="col-md-4">
										<label for="adults1" class="form-label">Adults <span class="text-danger">*</span></label>
										<select class="form-select" id="adults1" name="adults[]" required>
											<option selected disabled>Select adults</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
										</select>
									</div>
									<div class="col-md-4">
										<label for="children1" class="form-label">Children</label>
										<select class="form-select children-select" id="children1" name="children[]">
											<option selected value="0">0</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
										</select>
									</div>
								</div>
								<div class="row mt-3 child-age-group" id="childAgeGroup1">
									<!-- Child Age Fields Will Be Dynamically Added Here -->
								</div>
								<hr>
							</div>
						</div>


						<!-- Add Room Button -->
						<button id="addRoomBtn" type="button" id="addRoomBtn" class="btn btn-outline-primary mt-3">➕ Add More Room</button>

					</div>
				</div>
				<div class="col-lg-5 col">
					<div class="mb-3">
						<label for="" class="form-label blue">Tour Start Date <span class="text-red">*</span></label>
						<input type="date" class="form-control" required autocomplete="off" id="arrival_date" name="arrival_date">
					</div>
					<div class="mb-3">
						<label for="" class="form-label blue">Hotel Category <span class="text-red">*</span></label>
						<?php
						
						$hotelCategories = [
							'LUXURY LEVEL',
							'STANDARD LEVEL',
							'DELUXE LEVEL',
							'PREMIUM LEVEL'
						];
						
						foreach ($hotelCategories as $index => $category): ?>
							<div class="form-check">
								<?= $this->Form->checkbox('hotel_categories[]', [
									'value' => $category,
									'id' => 'hotelCategory' . $index,
									'class' => 'form-check-input'
								]); ?>
								<label class="form-check-label" for="hotelCategory<?= $index ?>">
									<?= h($category) ?>
								</label>
							</div>
						<?php endforeach; ?>
					</div>

					<div class="mb-3">
						<label for="specialRequirements" class="form-label">Special Requirements</label>
						<textarea class="form-control" name="specialRequirements" id="specialRequirements" rows="6"></textarea>
					</div>
					<div class="mb-3">
						<label for="" class="form-label blue">Security Text <span class="text-red">*</span></label>
						<div class="d-md-flex align-items-center">
							<div class="col-lg-5 col-9">
								<input id="txtEnquiryCaptchaText" required autocomplete="off" type="text" class="form-control">
							</div>
							<div class="ms-lg-4 ms-0 captcha mt-3 mt-md-0">
								<img src="https://www.elegantjourneys.com/captcha.php" class="form-control" style="border:1px solid #cccccc;height:40px;">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 offset-md-6 d-md-flex">
			
			
			<div class="my-3 col-md-5">
				<button type="submit" class="btn btn-border-o text-white">Book Now</button>
			</div>
			<div class="my-3 col-md-7">
				<button type="submit" class="btn btn-blue text-white">Enquire - If Questions?</button>
			</div>
			
			</div>
			<div class="mt-3 col-md-6 offset-md-6">
			<ul style="font-size:10px;">	
				<li><i class="fa fa-arrow-right me-2"></i><b>Book Now by paying only INR 1000 or equivalent intial deposit</b>.</li>
				<li><i class="fa fa-arrow-right me-2"></i>Pay 25% deposit after receiving booking confirmation.</li>
				<li><i class="fa fa-arrow-right me-2"></i>Balance payment 60 days before arrival.</li>
				<li><i class="fa fa-arrow-right me-2"></i>For Festival period travel (like Pushkar Fair, Christmas/New Year, etc.) - balance payment 90 days before arrival.</li>
			</ul>
			</div>	
		</form>
	</div>
</section>
<script>
	$(document).ready(function () {
	var _csrfToken = '<?=$this->request->getAttribute('csrfToken')?>';	
    let roomNumbers = [1]; // Maintain an array of room numbers

    // Function to generate the next available room number
    function getNextRoomNumber() {
        let nextRoomNumber = 1;
        while (roomNumbers.includes(nextRoomNumber)) {
            nextRoomNumber++;
        }
        roomNumbers.push(nextRoomNumber);
        return nextRoomNumber;
    }

    // Add Room Button
    $('#addRoomBtn').click(function () {
        const roomNumber = getNextRoomNumber();
        let roomHTML = `<div class="room" id="room${roomNumber}">
                <div class="room-header">
                    Room ${roomNumber} 
                    <span class="remove-room" data-room-number="${roomNumber}">🗑Remove Room</span>
                </div>
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label for="adults${roomNumber}" class="form-label">Adults <span class="text-danger">*</span></label>
                        <select class="form-select" id="adults${roomNumber}" name="adults[]" required>
                            <option selected disabled value="">Select number of adults</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="children${roomNumber}" class="form-label">Children</label>
                        <select class="form-select children-select" id="children${roomNumber}" name="children[]">
                            <option selected value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3 child-age-group" id="childAgeGroup${roomNumber}">
                    <!-- Child Age Fields Will Be Dynamically Added Here -->
                </div>
                <hr>
            </div>`;
        $('#roomsContainer').append(roomHTML);
    });

    // Remove Room
    $(document).on('click', '.remove-room', function () {
        const roomNumber = $(this).data('room-number');
        $(`#room${roomNumber}`).remove();
        roomNumbers = roomNumbers.filter(num => num !== roomNumber); // Remove the room number from the array
    });

    // Generate Child Age Fields Based on Selected Children Count
    $(document).on('change', '.children-select', function () {
        const childCount = $(this).val();
        const roomId = $(this).closest('.room').attr('id');
        const childAgeGroup = $(`#${roomId} .child-age-group`);

        // Clear any existing child age fields
        childAgeGroup.empty();

        // Add new child age fields based on the selected number of children
        if (childCount > 0) {
            for (let i = 1; i <= childCount; i++) {
                childAgeGroup.append(`
                    <div class="col-md-4 mt-2">
                        <label for="${roomId}ChildAge${i}" class="form-label">Child ${i} Age</label>
                        <select class="form-select" id="${roomId}ChildAge${i}" name="child_age_${roomId}[]">
                            <option selected disabled value="">Select age</option>
                            ${Array.from({ length: 12 }, (_, j) => `<option value="${j + 1}">${j + 1}</option>`).join('')}
                        </select>
                    </div>
                `);
            }
        }
    });

    // Validate the form on submit
    $('form').on('submit', function (event) {
	
        event.preventDefault(); // Prevent default form submission

        let isValid = true;

        // Clear previous error messages
        $('.error-message').remove();

        // Check all required fields
        $('form input[required], form select[required]').each(function () {
            if ($(this).val() === '' || $(this).val() === null) {
                isValid = false;
                $(this).addClass('is-invalid'); // Add error class
                $(this).after(`<div class="error-message text-danger mt-1">This field is required.</div>`);
            } else {
                $(this).removeClass('is-invalid'); // Remove error class
            }
        });

        // Validate at least one hotel category is selected
        if ($('form .form-check-input:checked').length === 0) {
            isValid = false;
            $('.form-check:last').after(`<div class="error-message text-danger mt-1">Please select at least one hotel category.</div>`);
        }

        if (!isValid) {
            return; // Exit if the form is invalid
        }
		
		// Gather data room-wise
    let roomsData = [];
    $('.room').each(function () {
        let roomId = $(this).attr('id');
        let adults = $(this).find(`[name="adults[]"]`).val();
        let children = $(this).find(`[name="children[]"]`).val();
        let childAges = $(this)
            .find(`.child-age-group select`)
            .map(function () {
                return $(this).val();
            })
            .get();

        roomsData.push({
            room: roomId,
            adults: adults || 0,
            children: children || 0,
            childAges: childAges || [],
        });
    });

    // Additional form fields (excluding room-specific fields)
	let additionalData = $(this).serializeArray().filter(field => {
		return !field.name.startsWith("adults") &&
			   !field.name.startsWith("children") &&
			   !field.name.startsWith("child_age_");
	});

    // Merge room data and additional data
    let formData = {
        rooms: roomsData,
        additionalData: additionalData,
		pageUrl:  window.location.href,
    };

        

        // Submit the form data via AJAX
        $.ajax({
            url: '<?=WEBROOT?>/enquiry/tourEnquiry', // Replace with your server endpoint
            type: 'POST',
             data: {
            _csrfToken: _csrfToken,
            formData: JSON.stringify(formData), 
			},
            success: function (response) {
                alert('Form submitted successfully!');
                console.log(response); // Handle success response
            },
            error: function (xhr, status, error) {
                alert('Error submitting form.');
                console.error(error); // Handle error response
            }
        });
    });

    // Trigger change event for Room 1 on load
    $('#children1').trigger('change');
});

</script>