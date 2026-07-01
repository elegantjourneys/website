<?php 
include_once('../includes/config.php');
include_once(BASEPATH_CLASS.'partners-class.php');
$objPartners = new Partners();
$objPartners->validate_admin();

if((isset($_POST['process']))&&(!empty($_POST['process'])))
{
	switch($_POST['process'])
	{
		case 'addParners':
				$objPartners->addNewPartners($_POST,$_FILES);
				header('location:'.$_POST['returnUrl']);
				exit();
			break;
		case 'updatePartners':
				$objPartners->updatePartners($_POST,$_FILES);
				header('location:'.$_POST['returnUrl']);
				exit();
			break;
		case 'deletePartners':
				$objPartners->deletePartners($_POST);
				header('location:'.$_POST['returnUrl']);
				exit();
		

	}
}

$post = $objPartners->decodeWebUrl($_REQUEST);


include_once("includes/head-section.php");
?>
<script>
	
	function validateForm()
	{
		var partnersName = $('#parners_name').val();
		var partnersColorImage = $('#partners_color_image').val();
		var partnersBlackWhiteImage = $('#partners_black_white_image').val();
		if(partnersName=="")
		{
			alert('Please enter name.');
			$('#parners_name').focus();
			return false;
		}

		if(partnersColorImage=="")
		{
			alert('Please select color image.');
			return false;
		}

		if(partnersBlackWhiteImage=="")
		{
			alert('Please select black and white image.');
			return false;
		}

		return true;
	}

	
	function validateUpdateForm()
	{
		var partnersName = $('#parners_name').val();
		if(partnersName=="")
		{
			alert('Please enter name.');
			$('#parners_name').focus();
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
                          <td>Manage Partners </td>
                        </tr>
                      </table>
                      </td>
                     <td width="27%" align="right" style="padding-right:20px; "> 
					   <?php
							$url='displayType=addNew';
							$cryptUrl =  $objPartners->getPageName().'?eid='.$objPartners->incodeUrl($url);
						?>
					   <input type="button" name="Submit" value="Add New Partner" class="button" onclick="location.href='<?=$cryptUrl?>'" /></td>  </tr>
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
										<input type="hidden" name="process" value="addParners">
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
												<input type="text" value="" name="name" style="width:300px;" id="parners_name">
											</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Color Image <span class="warning">*</span></td>
											<td align="left">
												<input type="file" value="" name="color_image" style="width:300px;" id="partners_color_image">
											</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Blank &amp; White Image <span class="warning">*</span></td>
											<td align="left">
												<input type="file" value="" name="black_white_image" style="width:300px;" id="partners_black_white_image">
											</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Link </td>
											<td align="left">
											<input type="text" value="" name="link" style="width:300px;" id="partners_link">
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
								$partnersDetail = $objPartners->getPartnersById($post['partnerId']);
								
				  ?>
								<form onsubmit="return validateUpdateForm();" enctype="multipart/form-data" method="post" action="" name="frmCampaign">
										<input type="hidden" name="process" value="updatePartners">
										<input type="hidden" name="topMenuId" value="<?=$partnersDetail['id']?>">
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
												<input type="text" value="<?=$partnersDetail['name']?>" name="name" style="width:300px;" id="parners_name">
											</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Color Image <span class="warning">*</span></td>
											<td align="left">
												<input type="file" value="" name="color_image" style="width:300px;" id="partners_color_image">
												<?php
													if($partnersDetail['color_image']!="")
													{
											    ?>
														<img src="image.php?w=50&h=50&img=partners/<?=$partnersDetail['color_image']?>">
												<?php
													}
												?>
											</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Blank &amp; White Image <span class="warning">*</span></td>
											<td align="left">
												<input type="file" value="" name="black_white_image" style="width:300px;" id="partners_black_white_image">
												<?php
													if($partnersDetail['black_white_image']!="")
													{
											    ?>
														<img src="image.php?w=50&h=50&img=partners/<?=$partnersDetail['black_white_image']?>">
												<?php
													}
												?>
											</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Link </td>
											<td align="left">
											<input type="text" value="<?=$partnersDetail['link']?>" name="link" style="width:300px;" id="partners_link">
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

									function processDeletePartners()
									{
										if(requestedIds.length<1)
										{
											alert('Please select menu to delete.');
											return false;
										}
										$('#partnersIds').val(requestedIds.join(","));
										$('#frmDeletePartners').submit();
									}

									function processEditPartners()
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
										var editPartnersId = requestedIds.join(",");
										
										var url='displayType=editRecord&partnerId='+editPartnersId;
										$.ajax({
											url: '<?=WEBROOTADMIN?>jquery-ver1.php',
											type: 'post',
											data: {action:'getCryptUrl',url:url},
											dataType: 'json',
											success: function(json) 
											{
												if(json.result=='success')
												{
													window.location='<?=$objPartners->getPageName()?>?eid='+json.cryptUrl;
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

								<form name="frmDeletePartners" id="frmDeletePartners" action="" method="post">
										<input type="hidden" name="process" value="deletePartners">
										<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
										<input type="hidden" name="partnersIds" value="" id="partnersIds">
								</form>


								<form name="frm_list" action="user_del.php" method="post" style="margin:0;padding:0">
								  <table width="100%" border="0" align=center cellpadding="4" cellspacing="1" class="greyBorder">
								   
									<tr class="blueBackground">
									  <td width="4%" height="28" align="center">S.No.</td>
									   <td width="26%" align="center">Name </td>
									   <td width="42%" align="center">Link</td>
									   <td width="10%%" align="center">Color Image </td>
									   <td width="10%" align="center">Black &amp; White Image </td>
									   <td width="8%" align="center">
											<input name="check_all" type="checkbox"   id="check_all" onclick="selectAllCheckbox();" value="check_all" />       
									   </td>
									</tr>
								   <?php
										$partnersList = $objPartners->getPartnersList();
										$slNo=1;
										foreach($partnersList as $partner)
										{
									?>
											<tr class="oddRow">
												<td class="txt"><?=$slNo?></td>
												<td class="txt"><?=$partner['name']?></td>
												<td class="txt"><?=$partner['link']?></td>
												<td class="txt"><img src="image.php?w=75&h=75&img=partners/<?=$partner['color_image']?>"></td>
												<td class="txt"><img src="image.php?w=75&h=75&img=partners/<?=$partner['black_white_image']?>"></td>
												 <td width="8%" align="center" class="txt"><input type="checkbox" onclick="updateRequestedIds(<?=$slNo?>);" value="<?=$partner['id']?>" id="selectMenu_<?=$slNo?>"/></td>
										   </tr>
									<?php
											$slNo++;
										}
									?>
									<tr align="right" >
									  <td valign="top" class="dark_red" colspan="2">&nbsp;</td>
									  <td colspan="2" valign="top" class="txt">						    
										  <input type="button"  value="Edit" class="button" onclick="processEditPartners();" />
										  <input type="button"  value="Delete" class="button" onclick="processDeletePartners();" />
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