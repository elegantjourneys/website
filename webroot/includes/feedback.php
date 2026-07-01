<?php
	include_once(BASEPATH."class/enquiry-class.php");
	$objEnquiry = new Enquiry();
	
?>
<style>
	.close {
		  cursor: pointer;		 
		  top: 10%;
		  right: 0%;
		  padding: 12px 0;
		  font-weight:normal;
		  transform: translate(0%, -50%);
		}

	.feedbackLoaderButton{
			display: inline-block;
			padding: 8px 25px;
			background: #f39820;
			color: #fff;
			outline: none;
			box-shadow: none;
			border: none;
			margin-right: 10px;
	}

	.borderAlertRed{border:1px solid red !important;}

	
</style>
			
			<div class="feedbabk_wrapper" id="feedback_form">
				<div class="feedback_bx">
									<span class="close" onclick='$( "#button_close" ).trigger( "click" );'><i class="fas fa-window-close"></i>x</span>
					<form name="sendFeedback" action="" method="post" onsubmit="return validateFeedbackForm();">
					<input type="hidden" value="submit_feedback" name="process" id="feedback_process">
					<input type="hidden" value="<?=$objEnquiry->getPageUrl()?>" name="page_url" id="feedback_page_url">
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="feedback_name" id="feedback_name">
						</div>
						<div class="form-group">
							<label>Email <sup>*</sup></label>
							<input type="email" name="feedback_email" id="feedback_email">
						</div>
						<div class="form-group">
							<label>Contact Number <sup>*</sup></label>
							<input type="text" name="feedback_contact_number" id="feedback_contact_number">
						</div>
						<div class="form-group" id="fieldFeedbackType">
							<label>Feedback Type <sup>*</sup></label>
							<div class="select_wr">
								<select name="feedback_feedback_type" id="feedback_feedback_type">
									<option selected="selected" value="Sales Enquiry">Sales Enquiry</option>	
									<option value="Website Issue">Website Issue</option>
									<option value="Suggestion">Suggestion</option>
									<option value="Other">Other</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label>Message </label>
							<textarea name="feedback_message" id="feedback_message"></textarea>
						</div>
						<!--<label for="field_attachement_SCREENSHOT" class="choice ltr" id="fieldAttachment">
							<input type="checkbox" name="feedback_attach_screenshot" id="feedback_attach_screenshot" value="1"> Click to automatically attach a screenshot of this page
						</label>-->
						
						<div class="form-group row">
										
							<div class="col-md-6">
								<label>Security Text <sup>*</sup></label>
								 <span id="txtFeedbackCaptchaTextAlert" class="formAlert"></span>
								<input id="txtFeedbackCaptchaText" class="form-control" type="text" name="enquiry_captcha_text" style="text-transform:uppercase;" maxlength="6">
							</div>
							
							<div class="col-md-6 captcha">
								<label style="font-weight:normal;">&nbsp;</label>
								<img src="https://www.elegantjourneys.com/captcha-feedback.php" class="form-control" style="border:1px solid #cccccc;">
							
							</div>

						</div>
						
						<div class="form-group">
							<input type="submit" value="Submit" name="" id="submitFeedback" style="display:inline;">
							<button class="feedbackLoaderButton" id="buttonProcessingFeedBack" style="display:none;"><i class="fa fa-refresh fa-spin"></i> Processing</button>
							<button type="reset" id="feedbackReset" style="display:inline;">Cancel</button>
						</div>
					</form>
				</div>
				<input type="checkbox" id="feedback_btn">
				<label for="feedback_btn">
					<span id="button_open"><?=$feedbackLabel?></span>
					<span id="button_close"><?=$feedbackLabel?></span>
				</label>
			</div>