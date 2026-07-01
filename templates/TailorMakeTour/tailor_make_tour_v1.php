<section class="sig">
    <div class="form">
      <ul class="tab-group">
        <li class="tab active"><a id="personal-info-tab" href="#personal-info">Your Information</a></li>
        <li class="tab disabled"><a id="travel-info-tab" href="#travel-info">Travel Information</a></li>
      </ul>  
<?php echo $this->Form->create(null, ['url' => ['controller' => 'TailorMakeTour', 'action' => 'tailorMakeTour']]); ?> 
      <div class="tab-content">
        <div id="personal-info">
            <div class="field-wrap">
              <label class="form-label">
                Name<span class="ps-1 text-danger">*</span>
              </label>
              <input type="text" name="name" required autocomplete="off" />
            </div>     
          <div class="field-wrap">

            <label class="form-label">

              Email<span class="ps-1 text-danger">*</span>

            </label>

            <input type="email" name="email" required autocomplete="off"/>

          </div>

		  <div class="field-wrap">

            <label class="form-label">

              Phone<span class="ps-1 text-danger">*</span>

            </label>

            <input type="text" name="phone" id="phone" required autocomplete="off"/>

          </div>

		  <div class="field-wrap">

            <label class="form-label">

              Country<span class="ps-1 text-danger">*</span>

            </label>

			<select class="" aria-label="Default select example" name="country" required autocomplete="off">

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
          <div class="field-wrap">
            <label class="form-label">
              City<span class="ps-1 text-danger">*</span>
            </label>
			<input type="text" name="city" required autocomplete="off"/>
          </div>
		  <div class="row">
    <div class="col-12 col-md-6 field-wrap">
        <label class="form-label">Security Text</label>
        <span class="ps-1 text-danger">*</span>
        
        <input id="txtEnquiryCaptchaText" required autocomplete="off" class="text-uppercase" type="text" name="enquiry_captcha_text" maxlength="6">
		<span id="captcha-error" class="text-danger"></span>
    </div>
    
		<div class="col-12 col-md-6 captcha field-wrap">
			<label class="form-label" style="font-weight:normal;">&nbsp;</label>
			<div class="d-flex align-items-center">
				<span id="captcha-text" class="fw-bold fs-4 me-3"></span>
				<button type="button" class="btn btn-secondary btn-sm" id="refresh-captcha"><i class="fa fa-refresh" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
          <button id="nextBtn" type="button" disabled class="btn btn-t button-block"/>Proceed</button>
        </div>
        <div id="travel-info" style="display:none;">   
            <div class="field-wrap">
            <label class="form-label">
              Number of Adults<span class="ps-1 text-danger">*</span>
            </label>
			<select name="no_of_adults" class="select-field" aria-label="Default select example" required autocomplete="off">
			<?php
				for($i=1;$i<30;$i++)
				{
			?>
				<option value="<?=$i?>"><?=$i?></option>
			<?php
				}
			?>
			</select>
          </div>
          <div class="field-wrap">

            <label class="form-label">

              Number of Children<span class="ps-1 text-danger">*</span>

            </label>

            

			<select name="no_of_children" class="select-field" onchange="displayAgeOption();" id="selectNoOfChildren" aria-label="Default select example" required autocomplete="off">

							<?php

								for($i=0;$i<=3;$i++)

								{

							?>

								<option value="<?=$i?>"><?=$i?></option>

							<?php

								}

							?>

							</select>

          </div>

		  

		  

			<div class="field-wrap" style="display:none;" id="lableAgeOfChild1">

				<label class="form-label">

				  Age of Child 1<span class="ps-1 text-danger">*</span>

				</label>

				<input type="text" name="age_of_child1" id="ageOfChild1" placeholder="Age of Child 1" value="1" required autocomplete="off"/>

			</div>

			<div class="field-wrap" style="display:none;" id="lableAgeOfChild2">

				<label class="form-label">

				  Age of Child 2<span class="ps-1 text-danger">*</span>

				</label>

				<input type="text" name="age_of_child2" id="ageOfChild2" placeholder="Age of Child 2" value="1" required autocomplete="off"/>

			</div>

			<div class="field-wrap" style="display:none;" id="lableAgeOfChild3">

				<label class="form-label">

				  Age of Child 3<span class="ps-1 text-danger">*</span>

				</label>

				<input type="text" name="age_of_child3" id="ageOfChild3" placeholder="Age of Child 3" value="1" required autocomplete="off"/>

			</div>

		  

          <div class="field-wrap">

            <label class="form-label">

              Number of Days<span class="ps-1 text-danger">*</span>

            </label>

			<input type="text" name="no_of_days" placeholder="Days/Nights" required autocomplete="off"/>

		  </div>

		  <div class="field-wrap">

            <label class="form-label">

              Travel Budget<span class="ps-1 text-danger">*</span>

            </label>

			<input type="text" name="travel_budget" placeholder="Budget per person" required autocomplete="off"/>

		  </div>

		  <div class="field-wrap">

            <label class="form-label">

              Travel Date<span class="ps-1 text-danger">*</span>

            </label>

			<input type="date" name="travel_date" placeholder="Travel Start Date" required autocomplete="off"/>

		  </div>

		  <div class="field-wrap">

            <label class="form-label">

              Number of Rooms<span class="ps-1 text-danger">*</span>

            </label>

			

			<select name="no_of_rooms" class="select-field" aria-label="Default select example" required autocomplete="off">

				<?php

						for($i=0;$i<20;$i++)

						{

					?>

						<option value="<?=$i?>"><?=$i?></option>

					<?php

						}

					?>

			</select>

		  </div>

          <div class="field-wrap">

		  <div class="form-label">Hotels</div>

			<div class="form-check form-check-inline ms-2">

			  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="hotel_preferences[]" value="3_star_hotel">

			  <label class="form-check-label" for="inlineCheckbox1">3 Star</label>

			</div>

			<div class="form-check form-check-inline">

			  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="hotel_preferences[]" value="4_star_hotel">

			  <label class="form-check-label" for="inlineCheckbox2">4 Star</label>

			</div>

			<div class="form-check form-check-inline">

			  <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="hotel_preferences[]" value="luxury_hotel">

			  <label class="form-check-label" for="inlineCheckbox3">Luxury</label>

			</div>

		  </div>

		  <div class="field-wrap">

			<textarea name="message" class="field-style" rows="4" placeholder="Any Special Requirement"></textarea>

		  </div>

          <button class="btn btn-t button-block"/>Submit</button>

          

         



        </div>

        

      </div><!-- tab-content -->

      <?php echo $this->Form->end(); ?>

</div> <!-- /form -->

        </section>

		

<script>
$(document).ready(function() {
	var _csrfToken = '<?=$this->request->getAttribute('csrfToken')?>';
loadCaptcha(); // Load CAPTCHA on page load

    // Refresh CAPTCHA on button click
    $("#refresh-captcha").click(function () {
        loadCaptcha();
    });

    function loadCaptcha() {
        $.ajax({
            url: "<?= $this->Url->build(['controller' => 'TailorMakeTour', 'action' => 'getCaptcha']) ?>",
            type: "GET",
            dataType: "json",
            success: function (response) {
                $("#captcha-text").text(response.captcha);
            },
            error: function () {
                console.error("Failed to load CAPTCHA.");
            }
        });
    }
	 // Validate CAPTCHA when clicking "Proceed"
    $("#nextBtn").click(function () {
        var captchaInput = $("#txtEnquiryCaptchaText").val();

        $.ajax({
            url: "<?= $this->Url->build(['controller' => 'TailorMakeTour', 'action' => 'validateCaptcha']) ?>",
            type: "POST",
            data: {_csrfToken: _csrfToken, enquiry_captcha_text: captchaInput },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    $("#captcha-error").text("").hide(); // Clear error
                    //submitForm(); // Proceed with form submission
					// Enable Travel Information tab and move to it
                    $('#travel-info-tab').removeClass('disabled').css('pointer-events', 'auto');
                    $('a[href="#travel-info"]').click(); // Activate the Travel Information tab

                } else {
                    $("#captcha-error").text(response.errorMessage).show(); // Show error
                }
            },
            error: function () {
                $("#captcha-error").text("An error occurred. Please try again.").show();
            }
        });
    });
});	
 

function displayAgeOption()

		{

			var noOfChildren = parseInt($('#selectNoOfChildren').val());

			

			for(i=1;i<=3;i++)

			{

				$('#lableAgeOfChild'+i).css('display','none');

			}



			for(i=1;i<=noOfChildren;i++)

			{

				$('#lableAgeOfChild'+i).css('display','block');

			}



		}

$('.form').find('input, textarea').on('keyup blur focus', function (e) {

  

  var $this = $(this),

      label = $this.prev('label');



	  if (e.type === 'keyup') {

			if ($this.val() === '') {

          label.removeClass('active highlight');

        } else {

          label.addClass('active highlight');

        }

    } else if (e.type === 'blur') {

    	if( $this.val() === '' ) {

    		label.removeClass('active highlight'); 

			} else {

		    label.removeClass('highlight');   

			}   

    } else if (e.type === 'focus') {

      

      if( $this.val() === '' ) {

    		label.removeClass('highlight'); 

			} 

      else if( $this.val() !== '' ) {

		    label.addClass('highlight');

			}

    }



});



$('.tab a').on('click', function (e) {

  

  e.preventDefault();

  

  $(this).parent().addClass('active');

  $(this).parent().siblings().removeClass('active');

  

  target = $(this).attr('href');



  $('.tab-content > div').not(target).hide();

  

  $(target).fadeIn(600);

  

});



$(document).ready(function() {

    // Disable the Next button by default
    $('#nextBtn').prop('disabled', true);
	// Disable the Travel Info tab initially
    $('#travel-info-tab').addClass('disabled').css('pointer-events', 'none');

    // Function to check if all required fields (input/select) are filled
    function checkFormCompletion() {
        let isValid = true;
        // Check all required inputs
        $('#personal-info input[required]').each(function() {
            if ($(this).val().trim() === '') {
                isValid = false; // If any input field is empty, set isValid to false
            }
        });
        // Check all required select elements
        $('#personal-info select[required]').each(function() {
            if ($(this).val() === '') {
                isValid = false; // If the select box is not selected, set isValid to false
            }
        });
        return isValid;
    }



    // Trigger when input or select changes

    /*$('#personal-info input, #personal-info select').on('input change', function() {
        if (checkFormCompletion()) {
            $('#nextBtn').prop('disabled', false); // Enable the Next button if form is complete
			$('#travel-info-tab').removeClass('disabled').css('pointer-events', 'auto'); // Enable Travel Info tab
        } else {
            $('#nextBtn').prop('disabled', true); // Disable the Next button if form is incomplete
			$('#travel-info-tab').addClass('disabled').css('pointer-events', 'none'); // Disable Travel Info tab
        }
    });*/
	
	// Enable Next Button only if required fields are filled
    $('#personal-info input, #personal-info select').on('input change', function () {
        if (checkFormCompletion()) {
            $('#nextBtn').prop('disabled', false);
        } else {
            $('#nextBtn').prop('disabled', true);
        }
    });



     // Click event for the Next button to activate the Travel Info tab

   /* $('#nextBtn').on('click', function() {

        $('a[href="#travel-info"]').click();

    });*/
	
	

});
</script>