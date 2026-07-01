	<script src="<?=WEBROOT?>vendors/jquery/jquery-2.1.4.min.js"></script>
	<!-- external scripts -->
	<script src="<?=WEBROOT?>vendors/bootstrap/javascripts/bootstrap.min.js"></script>
	<script src="<?=WEBROOT?>vendors/jquery-placeholder/jquery.placeholder.min.js"></script>

	
	<script src="<?=WEBROOT?>vendors/owl-carousel/owl.carousel.min.js"></script>
	<script src="<?=WEBROOT?>vendors/jcf/js/jcf.js"></script>
	<script src="<?=WEBROOT?>vendors/jcf/js/jcf.select.js"></script>
	<script src="<?=WEBROOT?>vendors/bootstrap-datetimepicker-master/dist/js/bootstrap-datepicker.js"></script>
	<!-- custom jquery script -->
	<script src="<?=WEBROOT?>js/jquery.main.js"></script>
	
	
	<script>
	$("#button_open").click(function(){
		$("#feedback_form").addClass("slide");
	});
	$("#button_close").click(function(){
		$("#feedback_form").removeClass("slide");
	});

	function validateFeedbackForm()
	{
		var name = $('#feedback_name').val();
		var email = $('#feedback_email').val();
		var contactNumber = $('#feedback_contact_number').val();
		var feedbackType = $('#feedback_feedback_type').val();
		var feedbackMessage = $('#feedback_message').val();
		var pageUrl = $('#feedback_page_url').val();
		
		var captchaText = $('#txtFeedbackCaptchaText').val();
		var attachScreenshot = 'no';
		var validation = true;
		
		if(name=="")
		{
			//alert('Please enter your name');
			$('#feedback_name').addClass('borderAlertRed');
			$('#feedback_name').focus();
			validation = false;
		}

		if(email=="")
		{
			//alert('Please enter your email');
			$('#feedback_email').addClass('borderAlertRed');
			$('#feedback_email').focus();
			validation = false
		}

		if(contactNumber=="")
		{
			//alert('Please enter your email');
			$('#feedback_contact_number').addClass('borderAlertRed');
			$('#feedback_contact_number').focus();
			validation = false;
		}

		if(captchaText=="")
		{
			$('#txtFeedbackCaptchaText').addClass('borderAlertRed');
			$('#txtFeedbackCaptchaText').focus();
			validation = false;
		}

		if(captchaText.length!=6)
		{
			$('#txtFeedbackCaptchaText').addClass('borderAlertRed');
			$('#txtFeedbackCaptchaText').focus();
			validation = false;
		}
		
		if(!validation)
		{
			return false;
		}

		$('#submitFeedback').css('display','none');
		$('#feedbackReset').css('display','none');
		$('#buttonProcessingFeedBack').css('display','inline');

		/*if(document.getElementById('feedback_attach_screenshot').checked)
		{
			attachScreenshot = 'yes';
		}*/
		
		 $.ajax({
			url: '<?=WEBROOT?>jquery.php',
			type: 'post',
			data: {token:'<?php echo session_id();?>', method:'sendFeedback', process:'feedback_process',feedback_name:name,feedback_email:email, feedback_contact_number:contactNumber, feedback_feedback_type:feedbackType, feedback_message:feedbackMessage, feedback_attach_screenshot:attachScreenshot, page_url:pageUrl,security_text:captchaText},
			dataType: 'json',
			success: function(json) 
			{
				if(json.result=='success')
				{
					window.location='<?=WEBROOT?>confirmation.php'
				}
				else
				{
					alert(json.message);
					$('#submitFeedback').css('display','inline');
					$('#feedbackReset').css('display','inline');
					$('#buttonProcessingFeedBack').css('display','none');
				}
			}
		  
		});


		 return false

	}


	
	</script>
