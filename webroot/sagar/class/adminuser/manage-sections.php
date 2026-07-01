<?php 
include_once('../includes/config.php');
include_once(BASEPATH_CLASS.'website-section-class.php');
$objWebsiteSection = new WebsiteSection();
$objWebsiteSection->validate_admin();


if((isset($_POST['process']))&&(!empty($_POST['process'])))
{
	switch($_POST['process'])
	{
		case 'addWebsiteSection':
				$objWebsiteSection->addNewWebsiteSection($_POST);
				header('location:'.$_POST['returnUrl']);
				exit();
			break;
		case 'updateWebsiteSection':
				$objWebsiteSection->updateWebsiteSection($_POST);
				header('location:'.$_POST['returnUrl']);
				exit();
			break;
		case 'deleteWebsiteSection':
				$objWebsiteSection->deleteWebsiteSection($_POST);
				header('location:'.$_POST['returnUrl']);
				exit();
		

	}
}

$post = $objWebsiteSection->decodeWebUrl($_REQUEST);


include_once("includes/head-section.php");
include_once("includes/tinimce.php");
?>
<script>
	
	function validateForm()
	{
		var websiteSectionName = $('#websiteSection_name').val();
		var websiteSectionImage = $('#websiteSection_image').val();
		var websiteSectionText = $('#websiteSection_text').val();
		if(websiteSectionName=="")
		{
			alert('Please enter name.');
			$('#websiteSection_name').focus();
			return false;
		}

		if(websiteSectionImage=="")
		{
			alert('Please select color image.');
			return false;
		}

		if(websiteSectionText=="")
		{
			alert('Please enter websiteSection.');
			$('#websiteSection_text').focus();
			return false;
		}
		return true;
	}

	
	function validateUpdateForm()
	{
		var guideName = $('#guide_name').val();
		var guideExpertise = $('#guide_expertise').val();
		var guideImage = $('#guide_image').val();

		if(guideName=="")
		{
			alert('Please enter guide name.');
			$('#guide_name').focus();
			return false;
		}

		if(guideExpertise=="")
		{
			alert('Please enter guide expertise.');
			$('#guide_name').focus();
			return false;
		}

		if(guideExpertise=="")
		{
			alert('Please enter guide expertise.');
			$('#guide_name').focus();
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
                          <td>Manage Website Section</td>
                        </tr>
                      </table>
                      </td>
                     <td width="27%" align="right" style="padding-right:20px; "> 
					   </td>  </tr>
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
						
						case 'editRecord':
								$websiteSectionDetail = $objWebsiteSection->getWebsiteSectionById($post['websiteSectionId']);
								
				  ?>
								<form onsubmit="return validateUpdateForm();" enctype="multipart/form-data" method="post" action="" name="frmCampaign">
										<input type="hidden" name="process" value="updateWebsiteSection">
										<input type="hidden" name="websiteSectionId" value="<?=$websiteSectionDetail['id']?>">
										<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
										<table width="98%" cellspacing="1" cellpadding="4" border="0" bgcolor="#D8D8D8" align="center">
											<tbody><tr align="left"> 
											<td height="25" class="blueBackground" colspan="2">Please enter following details - </td>
											</tr>
												<tr class="evenRow">
												<td align="right" colspan="2" class="txt"><span class="warning">*</span> - Required Fields</td>
											</tr>
										  
									  
										  
										 <tr class="oddRow">
											<td align="right" class="bldTxt" width="30%">Title <span class="warning">*</span></td>
											<td align="left">
												<input type="title" value="<?=$websiteSectionDetail['title']?>" name="title" style="width:300px;" id="websiteSection_title">
											</td>
										  </tr>
										   <tr class="oddRow">
											<td align="right" class="bldTxt" width="30%">Section Name </td>
											<td align="left">
												<input type="text" value="<?=$objWebsiteSection->getGroupNameById($websiteSectionDetail['group_id'])?>" name="group_name" style="width:300px;" id="websiteSection_group_name" disabled>
											</td>
										  </tr>
										  
										 <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Description<span class="warning">*</span></td>
											<td align="left">
											<textarea name="description" style="width:300px; height:350px;" id="websiteSection_description"><?=$objWebsiteSection->getWebsiteDesriptionBySectionId($websiteSectionDetail['id'])?></textarea>
											</td>
										  </tr>

										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Sample Code <span class="warning">*</span></td>
											<td align="left">
											<textarea name="sample_code" style="width:300px; height:350px;" id="websiteSection_sample_code" disabled><?=$objWebsiteSection->getWebsiteDesriptionSampleBySectionId($websiteSectionDetail['id'])?></textarea>
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

									function processDeleteWebsiteSection()
									{
										if(requestedIds.length<1)
										{
											alert('Please select menu to delete.');
											return false;
										}
										$('#partnersIds').val(requestedIds.join(","));
										$('#frmDeleteWebsiteSection').submit();
									}

									function processEditWebsiteSection()
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
										var editWebsiteSectionId = requestedIds.join(",");
										
										var url='displayType=editRecord&websiteSectionId='+editWebsiteSectionId;
										$.ajax({
											url: '<?=WEBROOTADMIN?>jquery-ver1.php',
											type: 'post',
											data: {action:'getCryptUrl',url:url},
											dataType: 'json',
											success: function(json) 
											{
												if(json.result=='success')
												{
													window.location='<?=$objWebsiteSection->getPageName()?>?eid='+json.cryptUrl;
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

								<form name="frmDeleteWebsiteSection" id="frmDeleteWebsiteSection" action="" method="post">
										<input type="hidden" name="process" value="deleteWebsiteSection">
										<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
										<input type="hidden" name="partnersIds" value="" id="partnersIds">
								</form>


								<form name="frm_list" action="user_del.php" method="post" style="margin:0;padding:0">
								  <table width="100%" border="0" align=center cellpadding="4" cellspacing="1" class="greyBorder">
								   
									<tr class="blueBackground">
									  <td width="4%" height="28" align="center">S.No.</td>
									   <td width="43%" align="center">Title</td>
									   <td width="43%" align="center">Page Name</td>
									   <td width="10%" align="center">
											     
									   </td>
									</tr>
								   <?php
										$data=array();
										$data['sortBy']=' group_id';
										$websiteSectionList = $objWebsiteSection->getWebsiteSectionList();
										
										$slNo=1;
										foreach($websiteSectionList as $websiteSection)
										{
									?>
											<tr class="oddRow">
												<td class="txt"><?=$slNo?></td>
												<td class="txt"><?=$websiteSection['title']?></td>
												<td class="txt"><?=$objWebsiteSection->getGroupNameById($websiteSection['group_id'])?></td>
												
												<td width="8%" align="center" class="txt"><input type="checkbox" onclick="updateRequestedIds(<?=$slNo?>);" value="<?=$websiteSection['id']?>" id="selectMenu_<?=$slNo?>"/></td>
										   </tr>
									<?php
											$slNo++;
										}
									?>
									<tr align="right" >
									  <td valign="top" class="dark_red" colspan="2">&nbsp;</td>
									  <td colspan="2" valign="top" class="txt">						    
										  <input type="button"  value="Edit" class="button" onclick="processEditWebsiteSection();" />
										  
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