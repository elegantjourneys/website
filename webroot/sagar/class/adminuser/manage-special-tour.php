<?php 
include_once('../includes/config.php');
include_once(BASEPATH_CLASS.'special-tour-class.php');
include_once(BASEPATH_CLASS.'subregion-class.php');
$objSpecialTour = new SpecialTour();
$objSubregion = new Subregion();
$objSpecialTour->validate_admin();



if((isset($_POST['process']))&&(!empty($_POST['process'])))
{
	switch($_POST['process'])
	{
		case 'addNewFirstStep':
				$specialTourId=$objSpecialTour->addFirstStep($_POST,$_FILES);
				$url='displayType=addNewSecondStep&tourId='.$specialTourId;
				$cryptUrl =  $objSpecialTour->getPageName().'?eid='.$objSpecialTour->incodeUrl($url);
				header('location:'.$cryptUrl);
				exit();
			break;
		case 'updateTour':
				$objSpecialTour->updateTour($_POST,$_FILES);
				header('location:'.$_POST['returnUrl']);
				exit();
			break;
		case 'deleteTour':
				$objSpecialTour->deleteTour($_POST);
				header('location:'.$_POST['returnUrl']);
				exit();
		

	}
}

$post = $objSpecialTour->decodeWebUrl($_REQUEST);

include_once("includes/head-section.php");
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
.adminButton
{
	width:150px;
	height:30px; 
	cursor:pointer; 
	background-color:#009E7D; 
	color:#ffffff; 
	font-size:13px; 
	font-weight:bold;
}
</style>
<script>
	 $(function() 
	 {
		$( ".datepicker" ).datepicker({
		  dateFormat: "yy-mm-dd"
		});
	 });

	
	function validateForm()
	{
		var TourName = $('#parners_name').val();
		var TourColorImage = $('#Tour_color_image').val();
		var TourBlackWhiteImage = $('#Tour_black_white_image').val();
		if(TourName=="")
		{
			alert('Please enter name.');
			$('#parners_name').focus();
			return false;
		}

		if(TourColorImage=="")
		{
			alert('Please select color image.');
			return false;
		}

		if(TourBlackWhiteImage=="")
		{
			alert('Please select black and white image.');
			return false;
		}

		return true;
	}

	
	function validateUpdateForm()
	{
		var TourName = $('#parners_name').val();
		if(TourName=="")
		{
			alert('Please enter name.');
			$('#parners_name').focus();
			return false;
		}

		return true;
	}

	
</script>
<style>

</style>
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
                          <td>Manage Special Tours </td>
                        </tr>
                      </table>
                      </td>
                     <td width="27%" align="right" style="padding-right:20px; "> 
					   <?php
							$url='displayType=addNewFirstStep';
							$cryptUrl =  $objSpecialTour->getPageName().'?eid='.$objSpecialTour->incodeUrl($url);
						?>
					   <input type="button" name="Submit" value="Add New Tour" class="button " onclick="location.href='<?=$cryptUrl?>'" /></td>  </tr>
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
						case 'addNewFirstStep':
				  ?>
									
									<form onsubmit="return validateForm();" enctype="multipart/form-data" method="post" action="" name="frmCampaign">
										<input type="hidden" name="process" value="addNewFirstStep">
										<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
										<table width="98%" cellspacing="1" cellpadding="4" border="0" bgcolor="#D8D8D8" align="center">
											<tbody><tr align="left"> 
											<td height="25" class="blueBackground" colspan="2">Please enter following details - </td>
											</tr>
												<tr class="oddRow">
												<td align="right" colspan="2" class="txt"><span class="warning">*</span> - Required Fields</td>
											</tr>
										  
									  
										  <tr>
											<td class="headTxt" colspan="2">Tour Basic Details</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Tour Title<span class="warning">*</span></td>
											<td align="left">
												<input type="text" value="" name="tourTitle" style="width:400px;" id="tourTitle">
											</td>
										  </tr>
										 
										  <tr class="oddRow">
											<td align="right" class="bldTxt" width="30%">Tour Slogan<span class="warning">*</span></td>
											<td align="left">
												<input type="text" value="" name="tourSlogan" style="width:400px;" id="tourSlogan">
											</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Tour Image <span class="warning">*</span></td>
											<td align="left">
												<input type="file" value="" name="tourImage" style="width:300px;" id="tourImage">
											</td>
										  </tr>
										  <tr class="oddRow">
											<td align="right" class="bldTxt" width="30%">Tour Start Date<span class="warning ">*</span></td>
											<td align="left">
												<input type="text" value="" name="tourStartDate" style="width:110px;" id="tourStartDate" class="datepicker" readonly>
											</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Total Days<span class="warning">*</span></td>
											<td align="left">
												<select name="totalDays">
													<?php
														for($i=1;$i<=15;$i++)
														{
													?>
													<option value="<?=$i?>"><?=$i?></option>
													<?php
														}
													?>
												</select>
											</td>
										  </tr>
										   <tr class="oddRow">
											<td align="right" class="bldTxt" width="30%">Covered Area<span class="warning">*</span></td>
											<td align="left">
												<table width="100%" border="1" cellpadding="2" cellspacing="2">
												<tr>
												<?php
													$data=array('sortBy'=>'region_location');
													$subRegionList = $objSubregion->getSubregionList($data);
													$count = 0;
													foreach($subRegionList as $subRegion)
													{
												?>
														<td><input type="checkbox" name="subregion[]" value="<?=$subRegion['id']?>"><?=$subRegion['region_location']?></td>
												<?php
														$count++;
														if($count==7)
														{
															echo '</tr><tr>';
															$count=0;
														}
													}
												?>
												</tr>
												</table>
											</td>
										  </tr>
										  <tr class="evenRow">
											<td align="center">&nbsp;</td>
											<td align="left"><input type="submit" value="Next Step" class="button adminButton" style=""></td>
										</tr>
									</tbody></table>
								</form>
					<?php
					  		break;
					 case 'addNewSecondStep':
								$tourId = $post['tourId'];
								$specialTourDetail = $objSpecialTour->getSpecialTourById($tourId);
								$specialTourId = $specialTourDetail['id'];
														
				   ?>
								<script>
									var totalDaysOfTour = <?=$specialTourDetail['total_days']?>;
									var tourIds = new Array();
								</script>
								<form onsubmit="return validateForm();" enctype="multipart/form-data" method="post" action="" name="frmCampaign">
										<input type="hidden" name="process" value="addNewFirstStep">
										<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
										<table width="98%" cellspacing="1" cellpadding="4" border="0" bgcolor="#D8D8D8" align="center">
											<tbody><tr align="left"> 
											<td height="25" class="blueBackground" colspan="2">Please enter following details - </td>
											</tr>
												<tr class="oddRow">
												<td align="right" colspan="2" class="txt"><span class="warning">*</span> - Required Fields</td>
											</tr>
										  
									  
										  <tr>
											<td class="headTxt" colspan="2">Tour Region Details [Second Step]</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Tour Title<span class="warning">*</span></td>
											<td align="left"><?=$specialTourDetail['tour_title']?></td>
										  </tr>
										 
										  
										  <tr class="oddRow">
											<td align="right" class="bldTxt" width="30%">Tour Start Date<span class="warning ">*</span></td>
											<td align="left"><?=$specialTourDetail['tour_start_date']?></td>
										  </tr>
										  <tr class="oddRow">
											<td align="right" class="bldTxt" width="30%">Total Days<span class="warning ">*</span></td>
											<td align="left"><?=$specialTourDetail['total_days']?></td>
										  </tr>
										  <tr class="oddRow">
											<td align="right" class="bldTxt" width="30%">Tour End Date<span class="warning ">*</span></td>
											<td align="left"><?=date("Y-m-d",strtotime("+".($specialTourDetail['total_days']-1)." day",strtotime($specialTourDetail['tour_start_date'])))?></td>
										  </tr>
										  <tr>
											<td class="headTxt" colspan="2">City List</td>
										  </tr>
										  <tr>
											<td colspan="2">
													<div id="contentLeft" style="margin-top:-20px;">
															<ul>
															<?php
																  $subRegionList=$objSubregion->getSubRegionListByTourId($tourId);
																   $countIndex=0;											  
																  foreach($subRegionList as $subRegion)
																  {
																	   $subRegionDetail=$objSubregion->getSubRegionDetail($subRegion['sub_region_id']);
															  ?>
																		<script>
																			tourIds[<?=$countIndex?>]=<?=$subRegion['id']?>;
																		</script>
																		<li id="recordsArray_<?=$subRegion['id']?>">
															
																			<table>
																				<tr>
																				<td class="slNo" style="background-color:#EBEEE3; cursor:pointer;" id="tourOrder<?=$subRegion['id']?>"><?=$subRegion['itinerary_order']?></td>
																				<td class="tourType" style="background-color:#EBEEE3;"><?=$subRegionDetail['region_location']?></td>
																				<td class="tourDescription" style="background-color:#EBEEE3;">
																					<div id="cityShortDescription<?=$subRegion['id']?>" style="display:block;">
																					    <span id="cityShortDescriptionText<?=$subRegion['id']?>" style="display:block;">
																							<?=$subRegion['short_description']?>
																						</span>
																						<a href="#" class="menuLinks" style="float:right; margin-top:10px; margin-right:5px;" onclick="showEditBox('<?=$subRegion['id']?>');">Edit</a>
																					</div>
																					<div id="cityShortDescriptionEdit<?=$subRegion['id']?>" style="display:none;">
																						<textarea style="width:500px; border:1px solid #000000; height:70px;" id="boxCityShortDescription<?=$subRegion['id']?>"><?=$subRegion['short_description']?></textarea>
																						<input name="Save" value="Save Description" class="button " type="button" style="margin-top:8px;" onclick="saveTourShortDescription('<?=$subRegion['id']?>');"> 
																						<input name="Save" value="Close" class="button " type="button" style="margin-top:8px;" onclick="hideEditBox('<?=$subRegion['id']?>');">
																					</div>
																				</td>
																				<td class="tourDays" style="background-color:#EBEEE3;">
																					Total Days:
																					<select name="tourDays" onchange="saveTourDays(this.value, '<?=$subRegion['id']?>');" id="tourDays<?=$subRegion['id']?>">
																						<?php
																							for($i=0;$i<=$specialTourDetail['total_days'];$i++)
																							{
																						?>
																									<option value="<?=$i?>" <?=($subRegion['total_days']==$i)?'selected':''?>><?=$i?></option>
																						<?php
																							}
																						?>
																					</select>
																				</td>
																				</tr>

																			</table>
																		</li>
															  <?php
																		$countIndex++;
																  }
															  ?>
														
															</ul>
													</div>
											</td>
										  </tr>
										  

										  <tr class="evenRow">
											<td align="center">&nbsp;</td>
											<td align="left"><input type="button" value="Next Step" class="button adminButton" onclick="gotoNextStep();"></td>
										</tr>
									</tbody></table>
								</form>

								<script type="text/javascript">
									$(document).ready(function(){ 
															   
										$(function() {
											$("#contentLeft ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
												var order = $(this).sortable("serialize") + '&action=manageCityOrder&specialTourId=<?=$specialTourDetail['id']?>'; 
												$.post("jquery-ver1.php", order, function(theResponse)
												{
													if(theResponse=='1')
													{
														message='Sequence has been updated in list';
														/*for(i=1;i<=tourIds.length;i++)
														{
															$('#tourOrder'+tourIds[i-1]).html(i);
														}*/
													}
													else if(theResponse=='2')
													{
														message='There was an error during reprocess sequence and might be some sequence was not updated.Please check by refreshing the page';
													}
													else
													{
														message='Sequence was not updated please try again';
													}
													alert(message);
												}); 															 
											}								  
											});
										});

									});	


									function showEditBox(divId)
									{
										$('#cityShortDescription'+divId).css('display','none');
										$('#cityShortDescriptionEdit'+divId).css('display','block');
										return false;
									}

									function hideEditBox(divId)
									{
										$('#cityShortDescription'+divId).css('display','block');
										$('#cityShortDescriptionEdit'+divId).css('display','none');
										return false;

									}

									function saveTourShortDescription(divId)
									{
										var tourShortDescription = $('#boxCityShortDescription'+divId).val();
										$.ajax({
											url: 'jquery-ver1.php',
											type: 'post',
											data: {action:'updateSpecialTourShortDescription', tourShortDescription:tourShortDescription, spcialTourRegionId:divId},
											dataType: 'json',
											success: function(json) 
											{
												if(json.result=='success')
												{
													alert(json.message);
													$('#cityShortDescriptionText'+divId).html(tourShortDescription);
													hideEditBox(divId);
												}
												else
												{
													alert('Record was not updated.Please try again.');
												}

											}
											  
										  });
									}

									function saveTourDays(totalDays, spcialTourRegionId)
									{
										$.ajax({
											url: 'jquery-ver1.php',
											type: 'post',
											data: {action:'updateSpecialTourDays', totalDays:totalDays, spcialTourRegionId:spcialTourRegionId},
											dataType: 'json',
											success: function(json) 
											{
												if(json.result=='success')
												{
													alert(json.message);
												}
												else
												{
													alert('Record was not updated.Please try again.');
												}

											}
											  
										  });
									}

									function calculateTotalDays()
									{
										var totalDays=0;
										for(i=0;i<tourIds.length;i++)
										{
											totalDays = totalDays + parseInt($('#tourDays'+tourIds[i]).val())
										}
										return totalDays;
									}

									function gotoNextStep()
									{
										var totalDays=calculateTotalDays();
										if(totalDays!=totalDaysOfTour)
										{
											alert('Your total days is not equal to selected date for city.');
											return false;
										}
										
										<?php
											$url='displayType=addNewThirdStep&tourId='.$specialTourId;
											$cryptUrl =  $objSpecialTour->getPageName().'?eid='.$objSpecialTour->incodeUrl($url);
										?>
										window.location='<?=$cryptUrl?>';
									}
							</script>

					<?php
					  		break;
					 case 'addNewThirdStep':
								$tourId = $post['tourId'];
								$specialTourDetail = $objSpecialTour->getSpecialTourById($tourId);
								$specialTourId = $specialTourDetail['id'];
														
				   ?>
								
								<form onsubmit="return validateForm();" enctype="multipart/form-data" method="post" action="" name="frmCampaign">
										<input type="hidden" name="process" value="addNewFirstStep">
										<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
										<table width="98%" cellspacing="1" cellpadding="4" border="0" bgcolor="#D8D8D8" align="center">
											<tbody><tr align="left"> 
											<td height="25" class="blueBackground" colspan="2">Tour details - </td>
										
										  <tr>
											<td class="headTxt" colspan="2">Tour Region Details [Third Step]</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Tour Title<span class="warning">*</span></td>
											<td align="left"><?=$specialTourDetail['tour_title']?></td>
										  </tr>
										 
										  
										  <tr class="oddRow">
											<td align="right" class="bldTxt" width="30%">Tour Start Date<span class="warning ">*</span></td>
											<td align="left"><?=$specialTourDetail['tour_start_date']?></td>
										  </tr>
										  <tr class="oddRow">
											<td align="right" class="bldTxt" width="30%">Total Days<span class="warning ">*</span></td>
											<td align="left"><?=$specialTourDetail['total_days']?></td>
										  </tr>
										  <tr class="oddRow">
											<td align="right" class="bldTxt" width="30%">Tour End Date<span class="warning ">*</span></td>
											<td align="left"><?=date("Y-m-d",strtotime("+".($specialTourDetail['total_days']-1)." day",strtotime($specialTourDetail['tour_start_date'])))?></td>
										  </tr>
										 
										  
									</tbody></table>
									<script>
										var regionList = new Array();
									   
									</script>
									<?php
										$subRegionList=$objSubregion->getSubRegionListByTourId($tourId);
										$dayCount=1;
										$loopCount=0;
										foreach($subRegionList as $subRegionKey=>$subRegion)
										{
											 $subRegionDetail=$objSubregion->getSubRegionDetail($subRegion['sub_region_id']);
											 $hotelList = $objSubregion->getHotelList($subRegion['sub_region_id']);
											 $totalDaysForSubregion = $subRegion['total_days'];
											 $subRegionDescription=$objSubregion->getTourDetail($subRegion['sub_region_id']);
											
											 
									?>
									<table width="98%" cellspacing="1" cellpadding="4" border="0" bgcolor="#D8D8D8" align="center">
										<tbody>
											<tr align="left"> 
												<td height="25" class="headTxt" colspan="2"><?=$subRegionDetail['region_location']?> - </td>
											</tr>
											<tr class="evenRow">
												<td align="right" class="bldTxt" width="30%">Select Hotel1</td>
												<td align="left">
													<select name="tourHotel" id="tourHotel<?=$subRegion['id']?>_1">
															<option value="">Select Hotel Name</option>
														<?php
															foreach($hotelList as $hotel)
															{
																if($hotel['hotel_type_name']=="")
																	continue;
														?>
																<option value="<?=$hotel['id']?>"><?=$hotel['hotel_type_name']?></option>
														<?php
															}
														?>
													</select> 
												</td>
										    </tr>
											<tr class="oddRow">
												<td align="right" class="bldTxt" width="30%">Select Hotel2</td>
												<td align="left">
													<select name="tourHotel" id="tourHotel<?=$subRegion['id']?>_2">
															<option value="">Select Hotel Name</option>
														<?php
															foreach($hotelList as $hotel)
															{
																if($hotel['hotel_type_name']=="")
																	continue;
														?>
																<option value="<?=$hotel['id']?>"><?=$hotel['hotel_type_name']?></option>
														<?php
															}
														?>
													</select> 
												</td>
										    </tr>
											<tr class="evenRow">
												<td colspan="2" class="bldTxt"><strong>Tour Description</strong></td>
											</tr>
											<?php
												for($i=1;$i<=$totalDaysForSubregion;$i++)
												{
											?>																					
											<tr class="oddRow">
												<td align="right" class="bldTxt" width="30%">Day <?=$dayCount?></td>
												<td align="left">
													<select name="tourHotel" id="description<?=$subRegion['id']?>_<?=$i?>">
															<option value="" >Select Description</option>
														<?php
															foreach($subRegionDescription as $description)
															{
																
														?>
																<option value="<?=$description['id']?>"><?=$description['tour_name']?></option>
														<?php
															}
														?>
													</select> 
												</td>
										    </tr>
											<?php
													$dayCount++;
												}

												if(count($subRegionList)>($subRegionKey+1))
												{
													 $nextRegionDescription=$objSubregion->getTourDetail($subRegionList[($subRegionKey+1)]['sub_region_id']);
													 $nextSubRegionDetail=$objSubregion->getSubRegionDetail($subRegionList[($subRegionKey+1)]['sub_region_id']);
													 
											?>
											<tr class="oddRow">
												<td align="right" class="bldTxt" width="30%">Day <?=($dayCount-1)?> [<?=$nextSubRegionDetail['region_location']?>]</td>
												<td align="left">
													<select name="tourHotel" id="otherdescription<?=$subRegion['id']?>">
															<option value="">Select Description</option>
														<?php
															foreach($nextRegionDescription as $nextDescription)
															{
																
														?>
																<option value="<?=$nextDescription['id']?>"><?=$nextDescription['tour_name']?></option>
														<?php
															}
														?>
													</select> 
												</td>
										    </tr>
											<?php
												}
											?>

											<tr class="evenRow">
												<td align="right" class="bldTxt" width="30%">&nbsp;</td>
												<td align="left">
													<input name="Submit" value="Save Tour" class="button "  type="button" onclick="saveTourDescription('<?=$subRegion['id']?>','<?=$totalDaysForSubregion?>');" id="saveButton<?=$subRegion['id']?>">
												</td>
										    </tr>

										</tbody>
									</table>
									<script>
										regionList[<?=$loopCount?>]='<?=$subRegion['id']?>';
										
									</script>
								  <?php
											$loopCount++;
										}
								 ?>
									<table width="98%" cellspacing="1" cellpadding="4" border="0" bgcolor="#D8D8D8" align="center">
									  <tbody>
										<tr class="evenRow">
											<td align="center">&nbsp;</td>
											<td align="left"><input type="button" value="Next Step" class="button adminButton" onclick="gotoNextStep();"></td>
										</tr>
									
										</tbody>
									</table>
								</form>
								<script>
									
									 function saveTourDescription(specialTourRegionId,totalDayForSubregion)
									 {
										if($('#tourHotel'+specialTourRegionId+'_1').val()=="")
										{
											alert('Please select a hotel for hotel1');
											return false;
										}
										for(i=1;i<=totalDayForSubregion;i++)
										{
											if($('#description'+specialTourRegionId+'_'+i).val()=="")
											{
												alert('Please select all day description');
												return false;
											}
										} 

										

										/*
											creating variables array
										*/
										var hotels = new Array();
										var description = new Array();
										var nextTourDescription = $('#otherdescription'+specialTourRegionId).val();
										var specialTourId = '<?=$specialTourId?>';
										
										for(i=1;i<=2;i++)
										{
											hotels[(i-1)]=$('#tourHotel'+specialTourRegionId+'_'+i).val()
										}

										for(i=1;i<=totalDayForSubregion;i++)
										{
											description[(i-1)]=$('#description'+specialTourRegionId+'_'+i).val();
											
										} 

										$.ajax({
											url: 'jquery-ver1.php',
											type: 'post',
											data: {action:'updateTourDaysDescription', hotels:hotels, description:description,specialTourRegionId:specialTourRegionId,nextTourDescription:nextTourDescription,totalDayForSubregion:totalDayForSubregion,specialTourId:specialTourId},
											dataType: 'json',
											success: function(json) 
											{
												if(json.result=='success')
												{
													alert(json.message);
													$('#saveButton'+specialTourRegionId).attr('disabled',true);

												}
												else
												{
													alert('Record was not updated.Please try again.');
												}

											}
											  
										  });


									 }

									function gotoNextStep()
									{
										var isdisabled = true;
										for(i=0;i<regionList.length;i++)
										{
											isdisabled=$("#saveButton"+regionList[i]).is(":disabled")
											if(!isdisabled)
											{
												alert('Please save all your data');
												return false;
											}
										}
										<?php
											$url='displayType=addNewFourStep&tourId='.$specialTourId;
											$cryptUrl =  $objSpecialTour->getPageName().'?eid='.$objSpecialTour->incodeUrl($url);
										?>
										window.location='<?=$cryptUrl?>';
									}
								
								</script>


					<?php
					  		break;
					 case 'addNewFourStep':
								$tourId = $post['tourId'];
								$specialTourDetail = $objSpecialTour->getSpecialTourById($tourId);
								$specialTourId = $specialTourDetail['id'];

														
				   ?>
								<!-- TinyMCE -->
							<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
							<script type="text/javascript">
								tinyMCE.init({
									// General options
									mode : "textareas",
									theme : "advanced",
									plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

									// Theme options
									theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
									theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
									theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
									theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
									theme_advanced_toolbar_location : "top",
									theme_advanced_toolbar_align : "left",
									theme_advanced_statusbar_location : "bottom",
									theme_advanced_resizing : true,

									// Example content CSS (should be your site CSS)
									content_css : "css/content.css",

									// Drop lists for link/image/media/template dialogs
									template_external_list_url : "lists/template_list.js",
									external_link_list_url : "lists/link_list.js",
									external_image_list_url : "lists/image_list.js",
									media_external_list_url : "lists/media_list.js",

									// Style formats
									style_formats : [
										{title : 'Bold text', inline : 'b'},
										{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
										{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
										{title : 'Example 1', inline : 'span', classes : 'example1'},
										{title : 'Example 2', inline : 'span', classes : 'example2'},
										{title : 'Table styles'},
										{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
									],

									// Replace values for the template plugin
									template_replace_values : {
										username : "Some User",
										staffid : "991234"
									}
								});
							</script>
								<form onsubmit="return validateForm();" enctype="multipart/form-data" method="post" action="" name="frmCampaign">
										<input type="hidden" name="process" value="addNewFirstStep">
										<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
										<table width="98%" cellspacing="1" cellpadding="4" border="0" bgcolor="#D8D8D8" align="center">
											<tbody><tr align="left"> 
											<td height="25" class="blueBackground" colspan="2">Tour details - </td>
										
										  <tr>
											<td class="headTxt" colspan="2">Tour Region Details [Third Step]</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Tour Title<span class="warning">*</span></td>
											<td align="left"><?=$specialTourDetail['tour_title']?></td>
										  </tr>
										 
										  
										  <tr class="oddRow">
											<td align="right" class="bldTxt" width="30%">Tour Start Date<span class="warning ">*</span></td>
											<td align="left"><?=$specialTourDetail['tour_start_date']?></td>
										  </tr>
										  <tr class="oddRow">
											<td align="right" class="bldTxt" width="30%">Total Days<span class="warning ">*</span></td>
											<td align="left"><?=$specialTourDetail['total_days']?></td>
										  </tr>
										  <tr class="oddRow">
											<td align="right" class="bldTxt" width="30%">Tour End Date<span class="warning ">*</span></td>
											<td align="left"><?=date("Y-m-d",strtotime("+".($specialTourDetail['total_days']-1)." day",strtotime($specialTourDetail['tour_start_date'])))?></td>
										  </tr>
										 
										  
									</tbody></table>
									<script>
										var regionList = new Array();
									   
									</script>
									<?php
										$subRegionList=$objSubregion->getSubRegionListByTourId($tourId);
									    $dayCount=1;
										
										foreach($subRegionList as $subRegionKey=>$subRegion)
										{
											 $totalDaysForSubregion = $subRegion['total_days'];
											 $subRegionHotel=$objSpecialTour->getSpecialTourRegionHotelDetail($subRegion['id']);
											 $subRegionDetail=$objSubregion->getSubRegionDetail($subRegion['sub_region_id']);
											
											
									?>
									<table width="98%" cellspacing="1" cellpadding="4" border="0" bgcolor="#D8D8D8" align="center">
										<tbody>
											<tr align="left"> 
												<td height="25" class="headTxt" colspan="4"><?=$subRegionDetail['region_location']?> - </td>
											</tr>
											<tr class="evenRow">
												<td align="right" class="bldTxt" width="10%">Hotel1</td>
												<td align="left" width="70%"><?=$objSpecialTour->getHotelNameById($subRegionHotel['hotel1_id'])?></td>
												<td align="left" width="10%" class="bldTxt">Amount:</td>
												<td align="left">
													<input name="tourHotelAmount<?=$subRegion['id']?>_1" id="tourHotelAmount<?=$subRegion['id']?>_1" style="width:40px" value="<?=$subRegionHotel['hotel1_cost']?>" type="text">
												</td>
										    </tr>
											<tr class="evenRow">
												<td align="right" class="bldTxt" width="10%">Hotel2</td>
												<td align="left"><?=$objSpecialTour->getHotelNameById($subRegionHotel['hotel2_id'])?></td>
												<td align="left" class="bldTxt">Amount:</td>
												<td align="left">
													<input name="tourHotelAmount<?=$subRegion['id']?>_2" id="tourHotelAmount<?=$subRegion['id']?>_2" style="width:40px" value="<?=$subRegionHotel['hotel2_cost']?>" type="text">
												</td>
										    </tr>
										
											<?php
												for($i=1;$i<=$totalDaysForSubregion;$i++)
												{
													$specialTourDetail=$objSpecialTour->getSpecialTourDescription($subRegion['id'], $i);
													
											?>
												<tr class="evenRow">
													<td align="right" class="bldTxt" width="10%">Day <?=$dayCount?></td>
													<td align="left">
													<table>
														<tr>
															<td>Description</td>
															<td>
																<textarea style="width:90%; height:150px;" id="tourDescription<?=$subRegion['id']?>_<?=$i?>"><?=$specialTourDetail['description']?></textarea>
															</td>
														</tr>
														<tr>
															<td>Image</td>
															<td><input type="file"></td>
														</tr>
													</table>
													</td>
													<td align="left" class="bldTxt">Amount:</td>
													<td align="left">
														<input name="tourDescriptionAmount<?=$subRegion['id']?>_<?=$i?>" id="tourDescriptionAmount<?=$subRegion['id']?>_<?=$i?>" style="width:40px" value="<?=$specialTourDetail['description_cost']?>" type="text">
													</td>
												</tr>


											<?php
													$dayCount++;
												}
												
											?>
											<tr class="evenRow">
												<td align="right" class="bldTxt" width="10%">Day <?=$dayCount-1?> <br />[Next Tour City]</td>
												<td align="left"><textarea style="width:90%; height:150px;" id="nextTourDescription<?=$subRegion['id']?>"><?=$specialTourDetail['next_tour_description']?></textarea></td>
												<td align="left" class="bldTxt">Amount:</td>
												<td align="left">
													<input name="nextTourDescriptionAmount<?=$subRegion['id']?>" id="nextTourDescriptionAmount<?=$subRegion['id']?>" style="width:40px" value="<?=$specialTourDetail['next_tour_description_cost']?>" type="text">
												</td>
											</tr>
											<tr class="evenRow">
												<td align="right" class="bldTxt" >&nbsp;</td>
												<td align="right">
													<input name="Submit" value="Save Tour" class="button "  type="button" onclick="saveTourDetail('<?=$subRegion['id']?>','<?=$totalDaysForSubregion?>');" id="saveButton<?=$subRegion['id']?>" style="cursor:pointer;">
												</td>
												<td align="right" class="bldTxt" >&nbsp;</td>
												<td align="right" class="bldTxt" >&nbsp;</td>
										    </tr>
										 </tbody>
									  </table>
								  <?php
											
										}
								 ?>
									<table width="98%" cellspacing="1" cellpadding="4" border="0" bgcolor="#D8D8D8" align="center">
									  <tbody>
										<tr class="evenRow">
											<td align="center">&nbsp;</td>
											<td align="center"><input type="button" value="Retun to List" class="button adminButton"></td>
											<td align="center">&nbsp;</td>
											<td align="center">&nbsp;</td>
										</tr>
									
										</tbody>
									</table>
								</form>
								<script>
									
									 function saveTourDetail(specialTourRegionId,totalDayForSubregion)
									 {
										/*
											creating variables array
										*/
										var hotelsAmount = new Array();
										var tourDescription = new Array();
										var tourDescriptionAmount = new Array();
										var nextTourDescription = $('#nextTourDescription'+specialTourRegionId).val();
										var nextTourDescriptionAmount = $('#nextTourDescriptionAmount'+specialTourRegionId).val();
										var specialTourId = '<?=$specialTourId?>';
										
										for(i=1;i<=2;i++)
										{
											hotelsAmount[(i-1)]=$('#tourHotelAmount'+specialTourRegionId+'_'+i).val()
										}
										
										for(i=1;i<=totalDayForSubregion;i++)
										{
											tourDescription[(i-1)]=$('#tourDescription'+specialTourRegionId+'_'+i).val();
										} 

										for(i=1;i<=totalDayForSubregion;i++)
										{
											
											tourDescriptionAmount[(i-1)]=$('#tourDescriptionAmount'+specialTourRegionId+'_'+i).val();
										} 


										
										$.ajax({
											url: 'jquery-ver1.php',
											type: 'post',
											data: {action:'updateTourDetails', hotelsAmount:hotelsAmount, tourDescription:tourDescription,tourDescriptionAmount:tourDescriptionAmount,specialTourRegionId:specialTourRegionId,nextTourDescription:nextTourDescription,nextTourDescriptionAmount:nextTourDescriptionAmount,totalDayForSubregion:totalDayForSubregion,specialTourId:specialTourId},
											dataType: 'json',
											success: function(json) 
											{
												if(json.result=='success')
												{
													alert(json.message);
													$('#saveButton'+specialTourRegionId).attr('disabled',true);

												}
												else
												{
													alert('Record was not updated.Please try again.');
												}

											}
											  
										  });


									 }

									function gotoNextStep()
									{
										var isdisabled = true;
										for(i=0;i<regionList.length;i++)
										{
											isdisabled=$("#saveButton"+regionList[i]).is(":disabled")
											if(!isdisabled)
											{
												alert('Please save all your data');
												return false;
											}
										}
										<?php
											$url='displayType=addNewFourStep&tourId='.$specialTourId;
											$cryptUrl =  $objSpecialTour->getPageName().'?eid='.$objSpecialTour->incodeUrl($url);
										?>
										window.location='<?=$cryptUrl?>';
									}
								
								</script>



				   <?php
					  		break;
					 case 'editRecord':
								$TourDetail = $objSpecialTour->getTourById($post['partnerId']);
								
				  ?>
								<form onsubmit="return validateUpdateForm();" enctype="multipart/form-data" method="post" action="" name="frmCampaign">
										<input type="hidden" name="process" value="updateTour">
										<input type="hidden" name="topMenuId" value="<?=$TourDetail['id']?>">
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
												<input type="text" value="<?=$TourDetail['name']?>" name="name" style="width:300px;" id="parners_name">
											</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Color Image <span class="warning">*</span></td>
											<td align="left">
												<input type="file" value="" name="color_image" style="width:300px;" id="Tour_color_image">
												<?php
													if($TourDetail['color_image']!="")
													{
											    ?>
														<img src="image.php?w=50&h=50&img=Tour/<?=$TourDetail['color_image']?>">
												<?php
													}
												?>
											</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Blank &amp; White Image <span class="warning">*</span></td>
											<td align="left">
												<input type="file" value="" name="black_white_image" style="width:300px;" id="Tour_black_white_image">
												<?php
													if($TourDetail['black_white_image']!="")
													{
											    ?>
														<img src="image.php?w=50&h=50&img=Tour/<?=$TourDetail['black_white_image']?>">
												<?php
													}
												?>
											</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Link </td>
											<td align="left">
											<input type="text" value="<?=$TourDetail['link']?>" name="link" style="width:300px;" id="Tour_link">
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

									function processDeleteTour()
									{
										if(requestedIds.length<1)
										{
											alert('Please select menu to delete.');
											return false;
										}
										$('#TourIds').val(requestedIds.join(","));
										$('#frmDeleteTour').submit();
									}

									function processEditTour()
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
										var editTourId = requestedIds.join(",");
										
										var url='displayType=editRecord&partnerId='+editTourId;
										$.ajax({
											url: '<?=WEBROOTADMIN?>jquery-ver1.php',
											type: 'post',
											data: {action:'getCryptUrl',url:url},
											dataType: 'json',
											success: function(json) 
											{
												if(json.result=='success')
												{
													window.location='<?=$objSpecialTour->getPageName()?>?eid='+json.cryptUrl;
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

								<form name="frmDeleteTour" id="frmDeleteTour" action="" method="post">
										<input type="hidden" name="process" value="deleteTour">
										<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
										<input type="hidden" name="TourIds" value="" id="TourIds">
								</form>


								<form name="frm_list" action="user_del.php" method="post" style="margin:0;padding:0">
								  <table width="100%" border="0" align=center cellpadding="4" cellspacing="1" class="greyBorder">
								   
									<tr class="blueBackground">
									  <td width="4%" height="28" align="center">S.No.</td>
									   <td width="26%" align="center">Tour Name </td>
									   <td width="42%" align="center">Link</td>
									   <td width="10%%" align="center">Start Date</td>
									   <td width="10%" align="center">Client Name </td>
									   <td width="8%" align="center">
											<input name="check_all" type="checkbox"   id="check_all" onclick="selectAllCheckbox();" value="check_all" />       
									   </td>
									</tr>
								   <?php
										$tourList=array();
										//$TourList = $objSpecialTour->getTourList();
										$slNo=1;
										foreach($tourList as $partner)
										{
									?>
											<tr class="oddRow">
												<td class="txt"><?=$slNo?></td>
												<td class="txt"><?=$partner['name']?></td>
												<td class="txt"><?=$partner['link']?></td>
												<td class="txt"><img src="image.php?w=75&h=75&img=Tour/<?=$partner['color_image']?>"></td>
												<td class="txt"><img src="image.php?w=75&h=75&img=Tour/<?=$partner['black_white_image']?>"></td>
												 <td width="8%" align="center" class="txt"><input type="checkbox" onclick="updateRequestedIds(<?=$slNo?>);" value="<?=$partner['id']?>" id="selectMenu_<?=$slNo?>"/></td>
										   </tr>
									<?php
											$slNo++;
										}
									?>
									<tr align="right" >
									  <td valign="top" class="dark_red" colspan="2">&nbsp;</td>
									  <td colspan="2" valign="top" class="txt">						    
										  <input type="button"  value="Edit" class="button" onclick="processEditTour();" />
										  <input type="button"  value="Delete" class="button" onclick="processDeleteTour();" />
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