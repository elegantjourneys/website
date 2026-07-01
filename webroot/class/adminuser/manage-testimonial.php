<?php 
include_once('../includes/config.php');
include_once(BASEPATH_CLASS.'testimonial-class.php');
$objTestimonial = new Testimonial();
$objTestimonial->validate_admin();


if((isset($_POST['process']))&&(!empty($_POST['process'])))
{
	
	switch($_POST['process'])
	{
		case 'addTestimonial':
				$objTestimonial->addNewTestimonial($_POST,$_FILES);
				header('location:'.$_POST['returnUrl']);
				exit();
			break;
		case 'updateTestimonial':
				$objTestimonial->updateTestimonial($_POST,$_FILES);
				header('location:'.$_POST['returnUrl']);
				exit();
			break;
		case 'deleteTestimonial':
				$objTestimonial->deleteTestimonial($_POST);
				header('location:'.$_POST['returnUrl']);
				exit();
		

	}
}

$post = $objTestimonial->decodeWebUrl($_REQUEST);


include_once("includes/head-section.php");
?>
<script>
	
	function validateForm()
	{
		var testimonialName = $('#testimonial_name').val();
		var testimonialImage = $('#testimonial_image').val();
		var testimonialText = $('#testimonial_text').val();
		if(testimonialName=="")
		{
			alert('Please enter name.');
			$('#testimonial_name').focus();
			return false;
		}

		/*if(testimonialImage=="")
		{
			alert('Please select color image.');
			return false;
		}*/

		if(testimonialText=="")
		{
			alert('Please enter testimonial.');
			$('#testimonial_text').focus();
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
                          <td>Manage Testimonial</td>
                        </tr>
                      </table>
                      </td>
                     <td width="27%" align="right" style="padding-right:20px; "> 
					   <?php
							$url='displayType=addNew';
							$cryptUrl =  $objTestimonial->getPageName().'?eid='.$objTestimonial->incodeUrl($url);
						?>
					   <input type="button" name="Submit" value="Add New Testimonial" class="button" onclick="location.href='<?=$cryptUrl?>'" /></td>  </tr>
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
										<input type="hidden" name="process" value="addTestimonial">
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
												<input type="text" value="" name="name" style="width:300px;" id="testimonial_name">
											</td>
										  </tr>
										   <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Country <span class="warning">*</span></td>
											<td align="left">
											<input type="text" value="" name="country" style="width:300px;" id="testimonial_expertise">
											</td>
										  </tr>
										  <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Image <span class="warning">*</span></td>
											<td align="left">
												<input type="file" value="" name="image" style="width:300px;" id="testimonial_image">
											</td>
										  </tr>
										   <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Testimonial <span class="warning">*</span></td>
											<td align="left">
											<textarea name="text" style="width:300px; height:100px;" id="testimonial_text"></textarea>
											</td>
										  </tr>
										  <tr class="oddRow">
											<td align="right" class="bldTxt" width="30%">Full Testimonial <span class="warning">*</span></td>
											<td align="left">
												<textarea name="full_text" style="width:300px; height:100px;" id="full_text"></textarea>
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
								$testimonialDetail = $objTestimonial->getTestimonialById($post['testimonialId']);
								
				  ?>
								<form onsubmit="return validateUpdateForm();" enctype="multipart/form-data" method="post" action="" name="frmCampaign">
										<input type="hidden" name="process" value="updateTestimonial">
										<input type="hidden" name="testimonialId" value="<?=$testimonialDetail['id']?>">
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
												<input type="text" value="<?=$testimonialDetail['name']?>" name="name" style="width:300px;" id="testimonial_name">
											</td>
										  </tr>
										   <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Country <span class="warning">*</span></td>
											<td align="left">
											<input type="text" value="<?=$testimonialDetail['country']?>" name="country" style="width:300px;" id="testimonial_expertise">
											</td>
										  </tr>
										   
										  <tr class="oddRow">
											<td align="right" class="bldTxt" width="30%">Image <span class="warning">*</span></td>
											<td align="left">
												<input type="file" value="" name="image" style="width:300px;" id="guide_image">
												<?php
													if($testimonialDetail['image']!="")
													{
											    ?>
														<img src="image.php?w=50&h=50&img=testimonial/<?=$testimonialDetail['image']?>">
												<?php
													}
												?>
											</td>
										  </tr>
										 <tr class="evenRow">
											<td align="right" class="bldTxt" width="30%">Testimonial <span class="warning">*</span></td>
											<td align="left">
											<textarea name="text" style="width:300px; height:100px;" id="testimonial_text"><?=$testimonialDetail['text']?></textarea>
											</td>
										  </tr>
										  <tr class="oddRow">
											<td align="right" class="bldTxt" width="30%">Full Testimonial <span class="warning">*</span></td>
											<td align="left">
											<textarea name="full_text" style="width:300px; height:100px;" id="full_text"><?=$testimonialDetail['full_text']?></textarea>
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
													window.location='<?=$objTestimonial->getPageName()?>?eid='+json.cryptUrl;
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
										<input type="hidden" name="process" value="deleteTestimonial">
										<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
										<input type="hidden" name="partnersIds" value="" id="partnersIds">
								</form>


								<form name="frm_list" action="user_del.php" method="post" style="margin:0;padding:0">
								  <table width="100%" border="0" align=center cellpadding="4" cellspacing="1" class="greyBorder">
								   
									<tr class="blueBackground">
									  <td width="4%" height="28" align="center">S.No.</td>
									   <td width="8%" align="center">Name </td>
									   <td width="8%" align="center">Country</td>
									   <td width="10%%" align="center">Image </td>
									    <td width="52%" align="center">Text</td>
									   <td width="8%" align="center">
											<input name="check_all" type="checkbox"   id="check_all" onclick="selectAllCheckbox();" value="check_all" />       
									   </td>
									</tr>
								   <?php
										$testimonialList = $objTestimonial->getTestimonialList();
										$slNo=1;
										foreach($testimonialList as $testimonial)
										{
									?>
											<tr class="oddRow">
												<td class="txt"><?=$slNo?></td>
												<td class="txt"><?=$testimonial['name']?></td>
												<td class="txt"><?=$testimonial['country']?></td>
												<td class="txt"><img src="image.php?w=75&h=75&img=testimonial/<?=$testimonial['image']?>"></td>
												<td class="txt"><?=$testimonial['text']?></td>
												<td width="8%" align="center" class="txt"><input type="checkbox" onclick="updateRequestedIds(<?=$slNo?>);" value="<?=$testimonial['id']?>" id="selectMenu_<?=$slNo?>"/></td>
										   </tr>
									<?php
											$slNo++;
										}
									?>
									<tr align="right" >
									  <td valign="top" class="dark_red" colspan="2">&nbsp;</td>
									  <td colspan="4" valign="top" class="txt">						    
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