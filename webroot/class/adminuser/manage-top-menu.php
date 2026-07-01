<?php 
include_once('../includes/config.php');
include_once(BASEPATH_CLASS.'top-menu-class.php');
$objTopMenu = new TopMenu();
$objTopMenu->validate_admin();

if((isset($_POST['process']))&&(!empty($_POST['process'])))
{
	switch($_POST['process'])
	{
		case 'addTopMenu':
				$objTopMenu->addNewTopMenu($_POST);
				header('location:'.$_POST['returnUrl']);
				exit();
			break;
		case 'updateTopMenu':
				$objTopMenu->updateTopMenu($_POST);
				header('location:'.$_POST['returnUrl']);
				exit();
			break;
		case 'deleteTopMenu':
				$objTopMenu->deleteTopMenu($_POST);
				header('location:'.$_POST['returnUrl']);
				exit();
		

	}
}

$post = $objTopMenu->decodeWebUrl($_REQUEST);


include_once("includes/head-section.php");
?>
<script>
	
	function validateForm()
	{
		var menuTitle = $('#top_menu_title').val();
		if(menuTitle=="")
		{
			alert('Please enter title');
			$('#top_menu_title').focus();
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
                          <td>Manage Top Menu </td>
                        </tr>
                      </table>
                      </td>
                     <td width="27%" align="right" style="padding-right:20px; "> 
					   <?php
							$url='displayType=addNew';
							$cryptUrl =  $objTopMenu->getPageName().'?eid='.$objTopMenu->incodeUrl($url);
						?>
					   <input type="button" name="Submit" value="Add New Menu" class="button" onclick="location.href='<?=$cryptUrl?>'" /></td>  </tr>
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
										<input type="hidden" name="process" value="addTopMenu">
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
											<input type="text" value="" name="title" style="width:300px;" id="top_menu_title">
											</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Link </td>
											<td align="left">
											<input type="text" value="" name="link" style="width:300px;" id="top_menu_link">
											</td>
										  </tr>
										  <tr class="oddRow">
											<td align="right" class="bldTxt">Parent</td>
											<td align="left">
												<select name="parent_id" id="top_menu_parent_id">
													<option value="0">None</option>
												<?php
													$parentTopMenuList = $objTopMenu->getTopMenuByParentId('0');
													foreach($parentTopMenuList as $parentMenu)
													{
												?>
														<option value="<?=$parentMenu['id']?>"><?=$parentMenu['title']?></option>
												<?php
													}
												?>

												
											</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Position </td>
											<td align="left">
											<input type="text" value="0" name="position" style="width:40px;" id="top_menu_position">
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
								$topMenuDetail = $objTopMenu->getTopMenuById($post['topMenuId']);
								
				  ?>
								<form onsubmit="return validateForm();" enctype="multipart/form-data" method="post" action="" name="frmCampaign">
										<input type="hidden" name="process" value="updateTopMenu">
										<input type="hidden" name="topMenuId" value="<?=$topMenuDetail['id']?>">
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
											<input type="text" value="<?=$topMenuDetail['title']?>" name="title" style="width:300px;" id="top_menu_title">
											</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Link </td>
											<td align="left">
											<input type="text" value="<?=$topMenuDetail['link']?>" name="link" style="width:300px;" id="top_menu_link">
											</td>
										  </tr>
										  <tr class="oddRow">
											<td align="right" class="bldTxt">Parent</td>
											<td align="left">
												<select name="parent_id" id="top_menu_parent_id">
													<option value="0">None</option>
												<?php
													$parentTopMenuList = $objTopMenu->getTopMenuByParentId('0');
													foreach($parentTopMenuList as $parentMenu)
													{
												?>
														<option value="<?=$parentMenu['id']?>" <?=($topMenuDetail['parent_id']==$parentMenu['id'])?'selected':''?>><?=$parentMenu['title']?></option>
												<?php
													}
												?>

												
											</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Position </td>
											<td align="left">
											<input type="text" value="<?=$topMenuDetail['position']?>" name="position" style="width:40px;" id="top_menu_position">
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

									function processDeleteTopMenu()
									{
										if(requestedIds.length<1)
										{
											alert('Please select menu to delete.');
											return false;
										}
										$('#topMenuIds').val(requestedIds.join(","));
										$('#frmDeleteTopMenu').submit();
									}

									function processEditTopMenu()
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
										var editTopMenuId = requestedIds.join(",");
										
										var url='displayType=editRecord&topMenuId='+editTopMenuId;
										$.ajax({
											url: '<?=WEBROOTADMIN?>jquery-ver1.php',
											type: 'post',
											data: {action:'getCryptUrl',url:url},
											dataType: 'json',
											success: function(json) 
											{
												if(json.result=='success')
												{
													window.location='<?=$objTopMenu->getPageName()?>?eid='+json.cryptUrl;
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

								<form name="frmDeleteTopMenu" id="frmDeleteTopMenu" action="" method="post">
										<input type="hidden" name="process" value="deleteTopMenu">
										<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
										<input type="hidden" name="topMenuIds" value="" id="topMenuIds">
								</form>


								<form name="frm_list" action="user_del.php" method="post" style="margin:0;padding:0">
								  <table width="100%" border="0" align=center cellpadding="4" cellspacing="1" class="greyBorder">
								   
									<tr class="blueBackground">
									  <td width="4%" height="28" align="center">S.No.</td>
									   <td width="40%" align="center">Menu Title </td>
									   <td width="43%" align="center">Link </td>
									   <td width="5%" align="center">Position </td>
									  <td width="8%" align="center">
									  <input name="check_all" type="checkbox"   id="check_all" onclick="selectAllCheckbox();" value="check_all" />                        </td>
									</tr>
								   <?php
										$parentTopMenuLists = $objTopMenu->getTopMenuByParentId('0');
										$slNo=1;
										foreach($parentTopMenuLists as $parentTopMenuList)
										{
									?>
											<tr class="oddRow">
												<td class="txt"><?=$slNo?></td>
												<td class="txt"><?=$parentTopMenuList['title']?></td>
												<td class="txt"><?=$parentTopMenuList['link']?></td>
												<td class="txt"><?=$parentTopMenuList['position']?></td>
												 <td width="8%" align="center" class="txt"><input type="checkbox" onclick="updateRequestedIds(<?=$slNo?>);" value="<?=$parentTopMenuList['id']?>" id="selectMenu_<?=$slNo?>"/></td>
										   </tr>
										   <?php
												$slNo++;
												$childMenusLists = $objTopMenu->getTopMenuByParentId($parentTopMenuList['id']);
												foreach($childMenusLists as $childMenusList)
												{
										   ?>
													<tr class="oddRow">
														<td class="txt"><?=$slNo?></td>
														<td class="txt"><?=$parentTopMenuList['title']?>><?=$childMenusList['title']?></td>
														<td class="txt"><?=$childMenusList['link']?></td>
														<td class="txt"><?=$childMenusList['position']?></td>
														 <td width="8%" align="center" class="txt"><input type="checkbox" onclick="updateRequestedIds(<?=$slNo?>);" value="<?=$childMenusList['id']?>" id="selectMenu_<?=$slNo?>"/></td>
												   </tr>

										   <?php
													$slNo++;
												}
										   ?>


									<?php
											
										}
									?>
									<tr align="right" >
									  <td valign="top" class="dark_red" colspan="2">&nbsp;</td>
									  <td colspan="2" valign="top" class="txt">						    
										  <input type="button"  value="Edit" class="button" onclick="processEditTopMenu();" />
										  <input type="button"  value="Delete" class="button" onclick="processDeleteTopMenu();" />
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