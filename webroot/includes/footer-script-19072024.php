	<script src="<?=WEBROOT?>vendors/jquery/jquery-2.1.4.min.js"></script>
	<!-- external scripts -->
	<script src="<?=WEBROOT?>vendors/bootstrap/javascripts/bootstrap.min.js"></script>
	<script src="<?=WEBROOT?>vendors/jquery-placeholder/jquery.placeholder.min.js"></script>
	<script src="<?=WEBROOT?>vendors/match-height/jquery.matchHeight.js"></script>
	<script src="<?=WEBROOT?>vendors/wow/wow.min.js"></script>
	<script src="<?=WEBROOT?>vendors/stellar/jquery.stellar.min.js"></script>
	<script src="<?=WEBROOT?>vendors/validate/jquery.validate.js"></script>
	<script src="<?=WEBROOT?>vendors/waypoint/waypoints.min.js"></script>
	<script src="<?=WEBROOT?>vendors/counter-up/jquery.counterup.min.js"></script>
	<script src="<?=WEBROOT?>vendors/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?=WEBROOT?>vendors/jQuery-touch-punch/jquery.ui.touch-punch.min.js"></script>
	
	<script src="<?=WEBROOT?>vendors/owl-carousel/owl.carousel.min.js"></script>
	<script src="<?=WEBROOT?>vendors/jcf/js/jcf.js"></script>
	<script src="<?=WEBROOT?>vendors/jcf/js/jcf.select.js"></script>
	<script src="<?=WEBROOT?>js/mailchimp.js"></script>
	
	<script src="<?=WEBROOT?>vendors/bootstrap-datetimepicker-master/dist/js/bootstrap-datepicker.js"></script>
	<!-- custom jquery script -->
	<script src="<?=WEBROOT?>js/jquery.main.js"></script>
	<!-- revolution slider plugin -->
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/jquery.themepunch.tools.min.js"></script>
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/jquery.themepunch.revolution.min.js"></script>
	<!-- rs5.0 core files -->
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/jquery.themepunch.tools.min.js?rev=5.0"></script>
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/jquery.themepunch.revolution.min.js?rev=5.0"></script>
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/extensions/revolution.extension.actions.min.js"></script>
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/extensions/revolution.extension.video.min.js"></script>
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
	<!-- revolutions slider script -->
	<script src="<?=WEBROOT?>js/revolution.js"></script>
	<script>
	$(document).ready(function(){
		$('.header-animated').click(function(){
			$(this).toggleClass('open');
		});
	});
	</script>
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
			data: {token:'<?php echo session_id();?>', method:'sendFeedback', process:'feedback_process',feedback_name:name,feedback_email:email, feedback_contact_number:contactNumber, feedback_feedback_type:feedbackType, feedback_message:feedbackMessage, feedback_attach_screenshot:attachScreenshot, page_url:pageUrl},
			dataType: 'json',
			success: function(json) 
			{
				if(json.result=='success')
				{
					window.location='<?=WEBROOT?>confirmation.php'
				}
			}
		  
		});


		 return false

	}


	
	</script>

	<?/**********************PRINCE SCRIPT FOR MOUSE TRACK******************************/?>
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-128748434-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-128748434-1');
		</script>
	<?/**********************PRINCE SCRIPT FOR MOUSE TRACK ENDS******************************/?>

	<!-- Global site tag (gtag.js) - Google Analytics -->
