<?php 
include_once('../includes/config.php');
include_once(BASEPATH_CLASS.'tripadvisor-review-class.php');
$objTripadvisorReview = new TripadvisorReview();
$objTripadvisorReview->validate_admin();


if((isset($_POST['process']))&&(!empty($_POST['process'])))
{
	switch($_POST['process'])
	{
		case 'addTripadvisorReview':
				$objTripadvisorReview->addNewReview($_POST,$_FILES);
				header('location:'.$_POST['returnUrl']);
				exit();
			break;
		case 'updateTripAdvisorReview':
				$objTripadvisorReview->updateReview($_POST,$_FILES);
				header('location:'.$_POST['returnUrl']);
				exit();
			break;
		case 'deleteTripAdvisorReview':
				$objTripadvisorReview->deleteReview($_POST);
				header('location:'.$_POST['returnUrl']);
				exit();
			break;
		

	}
}

$post =$objTripadvisorReview->decodeWebUrl($_REQUEST);


include_once("includes/head-section.php");
?>
<script>
	
	function validateForm()
	{
		var reviewName = $('#review_name').val();
		var reviewPlace = $('#review_place').val();
		var reviewDate = $('#review_date').val();
		var reviewImage = $('#review_image').val();
		var reviewDescription = $('#review_description').val();
		if(reviewName=="")
		{
			alert('Please enter name.');
			$('#review_name').focus();
			return false;
		}

		if(reviewPlace=="")
		{
			alert('Please enter place.');
			$('#review_place').focus();
			return false;
		}

		if(reviewDate=="")
		{
			alert('Please enter date.');
			$('#review_date').focus();
			return false;
		}

		if(reviewImage=="")
		{
			alert('Please select image.');
			return false;
		}

		if(reviewDescription=="")
		{
			alert('Please enter review description.');
			$('#review_description').focus();
			return false;
		}
		return true;
	}

	
	function validateUpdateForm()
	{
		var reviewName = $('#review_name').val();
		var reviewPlace = $('#review_place').val();
		var reviewDate = $('#review_date').val();
		var reviewImage = $('#review_image').val();
		var reviewDescription = $('#review_description').val();
		if(reviewName=="")
		{
			alert('Please enter name.');
			$('#review_name').focus();
			return false;
		}

		if(reviewPlace=="")
		{
			alert('Please enter place.');
			$('#review_place').focus();
			return false;
		}

		if(reviewDate=="")
		{
			alert('Please enter date.');
			$('#review_date').focus();
			return false;
		}

	

		if(reviewDescription=="")
		{
			alert('Please enter review description.');
			$('#review_description').focus();
			return false;
		}
		return true;
	}

	
</script>
</head>
<body>
<?php include("header.inc.php");?>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="180" valign="top" class="rightBorder">
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center"><?php include("left-menu.inc.php");?></td>
        </tr>
        <tr>
          <td width="23">&nbsp;</td>
        </tr>
      </table>
    <br />
    <br /></td>
    <td width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td height="400" align="center" valign="top">
		<table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="21" align="left" class="txt">
				<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="title">
                    <tr>
                      <td height="8" colspan="2"><img src="images/spacer.gif" width="1" height="8" /></td>
                    </tr>
                    <tr>
                      <td width="73%" height="25"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="34" align="center"><img src="images/heading_icon.gif" width="30" height="26" hspace="5" /></td>
                          <td>Manage Tripadvisor Review</td>
                        </tr>
                      </table>
                      </td>
                     <td width="27%" align="right" style="padding-right:20px; "> 
					   <?php
							$url='displayType=addNew';
							$cryptUrl =  $objTripadvisorReview->getPageName().'?eid='.$objTripadvisorReview->incodeUrl($url);
						?>
					   <input type="button" name="Submit" value="Add New Review" class="button" onclick="location.href='<?=$cryptUrl?>'" /></td>  </tr>
              </table>
			</td>
          </tr>

          <tr>
            <td height="400" align="center" valign="top">
              <table width="98%" border="0" cellpadding="5" cellspacing="0">
			 
                <tr>
                  <td height="347" align="center" valign="top">
				  <span class="warning">
				  <?php print $_SESSION['sess_msg']; unset($_SESSION['sess_msg']); $sess_msg='';?></span> <br />
				  <?php
					switch($post['displayType'])
					{
						case 'addNew':
				  ?>
									
									<form onsubmit="return validateForm();" enctype="multipart/form-data" method="post" action="" name="frmCampaign">
										<input type="hidden" name="process" value="addTripadvisorReview">
										<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
										<table width="98%" cellspacing="1" cellpadding="4" border="0" bgcolor="#D8D8D8" align="center">
											<tbody><tr align="left"> 
											<td height="25" class="blueBackground" colspan="2">Please enter following details - </td>
											</tr>
												<tr class="evenRow">
												<td align="right" colspan="2" class="txt"><span class="warning">*</span> - Required Fields</td>
											</tr>
										  
									  
										  
										  <tr class="oddRow">
											<td align="right" class="bldTxt" width="30%">Name <span class="warning">*</span></td>
											<td align="left">
												<input type="text" value="" name="name" style="width:300px;" id="review_name">
											</td>
										  </tr>
										   <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Place <span class="warning">*</span></td>
											<td align="left">
											<input type="text" value="" name="place" style="width:300px;" id="review_place">
											</td>
										  </tr>
										   <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Review Date <span class="warning">*</span></td>
											<td align="left">
											<input type="text" value="" name="review_date" style="width:300px;" id="review_date"> (YYYY-MM-DD)
											</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Image <span class="warning">*</span></td>
											<td align="left">
												<input type="file" value="" name="image" style="width:300px;" id="review_image">
											</td>
										  </tr>
										   <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Review Description <span class="warning">*</span></td>
											<td align="left">
											<textarea name="description" style="width:300px; height:100px;" id="review_description"></textarea>
											</td>
										  </tr>
										 							 
										  <tr class="evenRow">
											<td align="center">&nbsp;</td>
											<td align="left"><input type="submit" value="Submit" class="button"></td>
										</tr>
									</tbody></table>
								</form>
				   <?php
					  		break;
					 case 'editRecord':
								$testimonialDetail = $objTripadvisorReview->getReviewById($post['testimonialId']);
								
				  ?>
								<form onsubmit="return validateUpdateForm();" enctype="multipart/form-data" method="post" action="" name="frmCampaign">
										<input type="hidden" name="process" value="updateTripAdvisorReview">
										<input type="hidden" name="reviewId" value="<?=$testimonialDetail['id']?>">
										<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
										<table width="98%" cellspacing="1" cellpadding="4" border="0" bgcolor="#D8D8D8" align="center">
											<tbody><tr align="left"> 
											<td height="25" class="blueBackground" colspan="2">Please enter following details - </td>
											</tr>
												<tr class="evenRow">
												<td align="right" colspan="2" class="txt"><span class="warning">*</span> - Required Fields</td>
											</tr>
										  
									  
										  
										  <tr class="oddRow">
											<td align="right" class="bldTxt" width="30%">Name <span class="warning">*</span></td>
											<td align="left">
												<input type="text" value="<?=$testimonialDetail['name']?>" name="name" style="width:300px;" id="review_name">
											</td>
										  </tr>
										   <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Place <span class="warning">*</span></td>
											<td align="left">
											<input type="text" value="<?=$testimonialDetail['place']?>" name="place" style="width:300px;" id="review_place">
											</td>
										  </tr>
										   <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Review Date <span class="warning">*</span></td>
											<td align="left">
											<input type="text" value="<?=$testimonialDetail['review_date']?>" name="review_date" style="width:300px;" id="review_date"> (YYYY-MM-DD)
											</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Image <span class="warning">*</span></td>
											<td align="left">
												<input type="file" value="" name="image" style="width:300px;" id="review_image">
												<?php
													if($testimonialDetail['image']!="")
													{
											    ?>
														<img src="image.php?w=50&h=50&img=tripadvisor/<?=$testimonialDetail['image']?>">
												<?php
													}
												?>
											</td>
										  </tr>
										   <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Review Description <span class="warning">*</span></td>
											<td align="left">
											<textarea name="description" style="width:300px; height:100px;" id="review_description"><?=$testimonialDetail['description']?></textarea>
											</td>
										  </tr>
										 							 
										  <tr class="evenRow">
											<td align="center">&nbsp;</td>
											<td align="left"><input type="submit" value="Submit" class="button"></td>
										</tr>
									</tbody></table>
							</form>
				  <?php
							break;
					  default:
				  ?>


								<script>
									var requestedIds = [];
									var totalCheckboxIds = 0;

									function updateRequestedIds(checkboxSlNo)
									{
										
										var checkboxValue = $('#selectMenu_'+checkboxSlNo).val();
										if($('#selectMenu_'+checkboxSlNo).prop("checked"))
										{
											requestedIds[requestedIds.length]=checkboxValue;
										}
										else
										{
											var index = requestedIds.indexOf(checkboxValue);
											if (index > -1)
											{
												requestedIds.splice(index, 1);
											}
										}
										

												
									}

									function processDeleteTestimonial()
									{
										
										if(requestedIds.length<1)
										{
											alert('Please select menu to delete.');
											return false;
										}
										$('#partnersIds').val(requestedIds.join(","));
										$('#frmDeleteTestimonial').submit();
									}

									function processEditTestimonial()
									{
										if(requestedIds.length<1)
										{
											alert('Please select menu to edit.');
											return false;
										}

										if(requestedIds.length>1)
										{
											alert('Please select one menu to edit.');
											return false;
										}
										var editTestimonialId = requestedIds.join(",");
										
										var url='displayType=editRecord&testimonialId='+editTestimonialId;
										$.ajax({
											url: '<?=WEBROOTADMIN?>jquery-ver1.php',
											type: 'post',
											data: {action:'getCryptUrl',url:url},
											dataType: 'json',
											success: function(json) 
											{
												if(json.result=='success')
												{
													window.location='<?=$objTripadvisorReview->getPageName()?>?eid='+json.cryptUrl;
												}
												else
												{
													alert(json.message);
												}

											}
											  
										  });
									}

									function selectAllCheckbox()
									{
										if($('#check_all').prop("checked"))
										{
											for(i=1;i<=totalCheckboxIds;i++)
											{
												$( "#selectMenu_"+i ).prop( "checked", true );
												updateRequestedIds(i);
											}
										}
										else
										{
											for(i=1;i<=totalCheckboxIds;i++)
											{
												$( "#selectMenu_"+i ).prop( "checked", false );
												updateRequestedIds(i);
											}
										}
									}
								</script>

								<form name="frmDeleteTestimonial" id="frmDeleteTestimonial" action="" method="post">
										<input type="hidden" name="process" value="deleteTripAdvisorReview">
										<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
										<input type="hidden" name="partnersIds" value="" id="partnersIds">
								</form>


								<form name="frm_list" action="user_del.php" method="post" style="margin:0;padding:0">
								  <table width="100%" border="0" align=center cellpadding="4" cellspacing="1" class="greyBorder">
								   
									<tr class="blueBackground">
									  <td width="4%" height="28" align="center">S.No.</td>
									   <td width="8%" align="center">Name </td>
									   <td width="8%" align="center">Place</td>
									   <td width="8%" align="center">Review Date</td>
									   <td width="10%%" align="center">Image </td>
									    <td width="52%" align="center">Text</td>
									   <td width="8%" align="center">
											<input name="check_all" type="checkbox"   id="check_all" onclick="selectAllCheckbox();" value="check_all" />       
									   </td>
									</tr>
								   <?php
										$reviewList = $objTripadvisorReview->getReviewList();
										$slNo=1;
										foreach($reviewList as $review)
										{
									?>
											<tr class="oddRow">
												<td class="txt"><?=$slNo?></td>
												<td class="txt"><?=$review['name']?></td>
												<td class="txt"><?=$review['place']?></td>
												<td class="txt"><?=$review['review_date']?></td>
												<td class="txt"><img src="image.php?w=75&h=75&img=tripadvisor/<?=$review['image']?>"></td>
												<td class="txt"><?=$review['description']?></td>
												<td width="8%" align="center" class="txt"><input type="checkbox" onclick="updateRequestedIds(<?=$slNo?>);" value="<?=$review['id']?>" id="selectMenu_<?=$slNo?>"/></td>
										   </tr>
									<?php
											$slNo++;
										}
									?>
									<tr align="right" >
									  <td valign="top" class="dark_red" colspan="2">&nbsp;</td>
									  <td colspan="5" valign="top" class="txt">						    
										  <input type="button"  value="Edit" class="button" onclick="processEditTestimonial();" />
										  <input type="button"  value="Delete" class="button" onclick="processDeleteTestimonial();" />
									  </td>
									</tr>                        
									
								  </table>
								</form>
								<script>
									  totalCheckboxIds = <?=($slNo-1)?>;
								 </script>
					<?php
						}
						/*
							end of switch case
						*/
					?>
			      </td></tr>
			   <tr align="center">
                 <td>&nbsp;</td>
               </tr>
               <tr align="center">
                 <td>&nbsp;</td>
               </tr>
            </table>
         </td>
       </tr>
     </table>
	</td>
  </tr>
</table>
<?php include("footer.inc.php");?>
</body>
</html>