<style>
/*
*, *:before, *:after {
  box-sizing: border-box;
}

html {
  overflow-y: scroll;
}
*/
a {
  text-decoration: none;
  color: #1ab188;
  transition: .5s ease;
}
a:hover {
  color: #179b77;
}

.form {
  background: rgba(19, 35, 47, 0.9);
  padding: 40px;
  max-width: 520px;
  margin: 20px auto;
  border-radius: 4px;
  box-shadow: 0 4px 10px 4px rgba(19, 35, 47, 0.3);
}

.tab-group {
  list-style: none;
  padding: 0;
  margin: 0 0 25px 0;
}
.tab-group:after {
  content: "";
  display: table;
  clear: both;
}
.tab-group li a {
  display: block;
  text-decoration: none;
  padding: 10px;
  background: rgba(160, 179, 176, 0.25);
  color: #a0b3b0;
  font-size: 18px;
  float: left;
  width: 50%;
  text-align: center;
  cursor: pointer;
  transition: .5s ease;
}
.tab-group li a:hover {
  background: #6485b4;
  color: #ffffff;
}
.tab-group .active a {
  background: #34549c;
  color: #ffffff;
}

.tab-content > div:last-child {
  display: none;
}

input, textarea, select {
  font-size: 20px;
  display: block;
  width: 100%;
  height: 100%;
  padding: 5px 10px;
  background: none;
  background-image: none;
  border: 1px solid #a0b3b0;
  color: #ffffff;
  border-radius: 0;
  transition: border-color .25s ease, box-shadow .25s ease;
}
select option {
  margin: 40px;
  background: rgba(19, 35, 47, 0.9);
  color: #fff;
}
input:focus, textarea:focus {
  outline: 0;
  border-color: #1ab188;
}

textarea {
  border: 2px solid #a0b3b0;
  resize: vertical;
}

.field-wrap {
  position: relative;
  margin-bottom: 16px;
}

.top-row:after {
  content: "";
  display: table;
  clear: both;
}
.top-row > div {
  float: left;
  width: 48%;
  margin-right: 4%;
}
.top-row > div:last-child {
  margin: 0;
}

.btn-t {
  border: 0;
  outline: none;
  border-radius: 0;
  padding: 3px 0;
  font-size: 1.5rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: .1em;
  background: #ec601d;
  color: #ffffff;
  transition: all 0.5s ease;
  -webkit-appearance: none;
}
.btn-t:hover, .button:focus {
  background: #CA4415;
}

.button-block {
  display: block;
  width: 100%;
}
input[type="date"]::-webkit-calendar-picker-indicator {
  cursor: pointer;
  border-radius: 4px;
  margin-right: 2px;
  filter: invert(96%) sepia(100%) saturate(5%) hue-rotate(250deg) brightness(105%) contrast(100%);
}
</style>
<section class="sig">
    <div class="form">
      
      <ul class="tab-group">
        <li class="tab active"><a id="personal-info-tab" href="#personal-info">Your Information</a></li>
        <li class="tab"><a id="travel-info-tab" href="#travel-info">Travel Information</a></li>
      </ul>  
 
<?php echo $this->Form->create(null, ['url' => ['controller' => 'Tours', 'action' => 'tailorMakeTour']]); ?> 
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
          
          <button id="nextBtn" type="button" disabled class="btn btn-t button-block"/>Next</button>
          
          

        </div>
        
        <div id="travel-info">   
          
          
          
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
    $('#personal-info input, #personal-info select').on('input change', function() {
        if (checkFormCompletion()) {
            $('#nextBtn').prop('disabled', false); // Enable the Next button if form is complete
			$('#travel-info-tab').removeClass('disabled').css('pointer-events', 'auto'); // Enable Travel Info tab
        } else {
            $('#nextBtn').prop('disabled', true); // Disable the Next button if form is incomplete
			$('#travel-info-tab').addClass('disabled').css('pointer-events', 'none'); // Disable Travel Info tab
        }
    });

     // Click event for the Next button to activate the Travel Info tab
    $('#nextBtn').on('click', function() {
        $('a[href="#travel-info"]').click();
    });
});


</script>