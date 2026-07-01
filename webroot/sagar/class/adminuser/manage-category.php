<?php 
include_once('../includes/config.php');
include_once(BASEPATH_CLASS.'category-class.php');
$objCategory = new Category();
$objCategory->validate_admin();

if((isset($_POST['process']))&&(!empty($_POST['process'])))
{
	
	switch($_POST['process'])
	{
		case 'addCategory':
				$objCategory->addNewCategory($_POST,$_FILES);
				header('location:'.$_POST['returnUrl']);
				exit();
			break;
		case 'updateCategory':
				$objCategory->updateCategory($_POST,$_FILES);
				header('location:'.$_POST['returnUrl']);
				exit();
			break;
		case 'deleteCategory':
				$objCategory->deleteCategory($_POST);
				header('location:'.$_POST['returnUrl']);
				exit();
		

	}
}

$post = $objCategory->decodeWebUrl($_REQUEST);
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
                          <td>Manage Category </td>
                        </tr>
                      </table>
                      </td>
                     <td width="27%" align="right" style="padding-right:20px; "> 
					   <?php
							$url='displayType=addNew';
							$cryptUrl =  $objCategory->getPageName().'?eid='.$objCategory->incodeUrl($url);
						?>
					   <input type="button" name="Submit" value="Add New Category" class="button" onclick="location.href='<?=$cryptUrl?>'" /></td>  </tr>
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
										<input type="hidden" name="process" value="addCategory">
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
											<input type="text" value="" name="name" style="width:300px;" id="name">
											</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">URL </td>
											<td align="left">
											<input type="text" value="" name="category_url" style="width:300px;" id="category_url">
											</td>
										  </tr>
										  <tr class="oddRow">
											<td align="right" class="bldTxt">Parent</td>
											<td align="left">
												<select name="parent_id" id="parent_id">
													<option value="0">None</option>
												<?php
													$parentData = array();
													$parentData['parentId']='0';
													$parentCategoryList = $objCategory->getCategoryList($parentData);
													foreach($parentCategoryList as $parentCategory)
													{
												?>
														<option value="<?=$parentCategory['id']?>" ><?=$parentCategory['name']?></option>
												<?php
													}
												?>

												
											</td>
										  </tr>
										   <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Banner </td>
											<td align="left">
												<input type="file"  name="image">
												
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
								$categoryDetail = $objCategory->getCategoryById($post['categoryId']);
								
								
				  ?>
								<form onsubmit="return validateForm();" enctype="multipart/form-data" method="post" action="" name="frmCampaign">
										<input type="hidden" name="process" value="updateCategory">
										<input type="hidden" name="categoryId" value="<?=$categoryDetail['id']?>">
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
											<input type="text" value="<?=$categoryDetail['name']?>" name="name" style="width:300px;" id="name">
											</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">URL </td>
											<td align="left">
											<input type="text" value="<?=$categoryDetail['category_url']?>" name="category_url" style="width:300px;" id="category_url">
											</td>
										  </tr>
										  <tr class="oddRow">
											<td align="right" class="bldTxt">Parent</td>
											<td align="left">
												<select name="parent_id" id="parent_id">
													<option value="0">None</option>
												<?php
													$parentData = array();
													$parentData['parentId']='0';
													$parentCategoryList = $objCategory->getCategoryList($parentData);
													foreach($parentCategoryList as $parentCategory)
													{
												?>
														<option value="<?=$parentCategory['id']?>" <?=($categoryDetail['parent_id']==$parentCategory['id'])?'selected':''?>><?=$parentCategory['name']?></option>
												<?php
													}
												?>

												
											</td>
										  </tr>
										   <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Banner </td>
											<td align="left">
												<input type="file"  name="image">
												<?php
													if($categoryDetail['image']!="")
													{
											    ?>
														<img src="image.php?w=50&h=50&img=category/<?=$categoryDetail['image']?>">
												<?php
													}
												?>
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

									function processDeleteCategory()
									{
										if(requestedIds.length<1)
										{
											alert('Please select menu to delete.');
											return false;
										}
										$('#topMenuIds').val(requestedIds.join(","));
										$('#frmDeleteCategory').submit();
									}

									function processEditCategory()
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
										var editCategoryId = requestedIds.join(",");
										
										var url='displayType=editRecord&categoryId='+editCategoryId;
										$.ajax({
											url: '<?=WEBROOTADMIN?>jquery-ver1.php',
											type: 'post',
											data: {action:'getCryptUrl',url:url},
											dataType: 'json',
											success: function(json) 
											{
												if(json.result=='success')
												{
													window.location='<?=$objCategory->getPageName()?>?eid='+json.cryptUrl;
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

								<form name="frmDeleteCategory" id="frmDeleteCategory" action="" method="post">
										<input type="hidden" name="process" value="deleteCategory">
										<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
										<input type="hidden" name="categoryIds" value="" id="topMenuIds">
								</form>


								<form name="frm_list" action="user_del.php" method="post" style="margin:0;padding:0">
								  <table width="100%" border="0" align=center cellpadding="4" cellspacing="1" class="greyBorder">
								   
									<tr class="blueBackground">
									  <td width="4%" height="28" align="center">S.No.</td>
									   <td width="40%" align="center">Category</td>
									   <td width="43%" align="center">Link </td>
									   <td width="43%" align="center">Image </td>
									   <td width="8%" align="center">
									  <input name="check_all" type="checkbox"   id="check_all" onclick="selectAllCheckbox();" value="check_all" />                        </td>
									</tr>
								   <?php
										$parentData = array();
										$parentData['parentId']='0';
										$parentCategoryLists = $objCategory->getCategoryList($parentData);
										
										$slNo=1;
										foreach($parentCategoryLists as $parentCategoryList)
										{
											
									?>
											<tr class="oddRow">
												<td class="txt"><?=$slNo?></td>
												<td class="txt"><?=$parentCategoryList['name']?></td>
												<td class="txt"><?=$parentCategoryList['category_url']?></td>
												<td class="txt"><img src="image.php?w=50&h=50&img=category/<?=$parentCategoryList['image']?>"></td>
												 <td width="8%" align="center" class="txt"><input type="checkbox" onclick="updateRequestedIds(<?=$slNo?>);" value="<?=$parentCategoryList['id']?>" id="selectMenu_<?=$slNo?>"/></td>
										   </tr>
										   <?php
												$slNo++;
												$childData=array();
												$childData['parentId']= $parentCategoryList['id'];
												$childMenusLists = $objCategory->getCategoryList($childData);
												foreach($childMenusLists as $childMenusList)
												{
										   ?>
													<tr class="oddRow">
														<td class="txt"><?=$slNo?></td>
														<td class="txt"><?=$parentCategoryList['name']?>><?=$childMenusList['name']?></td>
														<td class="txt"><?=$childMenusList['category_url']?></td>
														<td class="txt"><img src="image.php?w=50&h=50&img=category/<?=$childMenusList['image']?>"></td>
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
										  <input type="button"  value="Edit" class="button" onclick="processEditCategory();" />
										  <input type="button"  value="Delete" class="button" onclick="processDeleteCategory();" />
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