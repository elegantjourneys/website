<?php 
ob_start();
session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
validate_admin();
@extract($_REQUEST);

if($_POST['submitForm'] == "yes")
{

	if($_FILES['tour_image']['name']=='')
	{
		$tour_image=mysql_real_escape_string($_POST['tour_image2']);
	}
	else
	{
	$tour_image = time().$_FILES['tour_image']['name'];
	move_uploaded_file($_FILES['tour_image']['tmp_name'],"../images/".$tour_image);
	}
	
	$region_id = mysql_real_escape_string($_POST['region_id']);
	$region_location = mysql_real_escape_string($_POST['region_location']);
	$region_title = mysql_real_escape_string($_POST['region_title']);
	$subregion_keyword = mysql_real_escape_string($_POST['subregion_keyword']);
	$subregion_description = mysql_real_escape_string($_POST['subregion_description']);
	$region_description = mysql_real_escape_string($_POST['region_description']);
	
	$no_of_night = mysql_real_escape_string($_POST['no_of_night']);
	
	$lat = mysql_real_escape_string($_POST['lat']);
	$lng = mysql_real_escape_string($_POST['lng']);
	
	
	$id = mysql_real_escape_string($_POST['id']);
		
	if($id=='')
    {
	   $sql=$obj->query("insert into $tbl_subregion set lat='$lat',lng='$lng',region_id='$region_id',region_location='$region_location',
	   region_title = '$region_title',subregion_keyword = '$subregion_keyword',subregion_description = '$subregion_description',region_description ='$region_description',no_of_night='$no_of_night',region_image = '$tour_image'",$debug=-1);
	   $id = mysql_insert_id();
		$_SESSION['sess_msg'] = "SubRegion has been added suceesfully.";
     }
	 else 
	 {
	   $sql = "update $tbl_subregion set lat='$lat',lng='$lng',region_location='$region_location',region_title = '$region_title',subregion_keyword = '$subregion_keyword',subregion_description = '$subregion_description',region_description ='$region_description',region_image = '$tour_image',no_of_night='$no_of_night' where id = '$id'";	
	   $obj->query($sql,$debug=1);	   			
		$_SESSION['sess_msg'] = "SubRegion has been updated suceesfully.";
	   //$obj->unlink_file($tour_image,"../images");
     }
	  header("Location: sub-region-list.php?id=$region_id");
	  exit();
}	

if($id)
{
	$result=$obj->query("select * from $tbl_subregion where id='$id'", $debug=-1);
	$num= $obj->numRows($result);
	$line=$obj->fetchNextObject($result);
		
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="richtext_compressed.js"></script>
<script language="JavaScript" type="text/javascript" src="richtext.js"></script>
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

<script language="javascript">
function validate()
{
    msg = "Please fill the following information:\n\n";
	str = "";
	
	if(document.frm.user_name.value=='')
	{ 
	str+="-Please Insert User Name\n";
	}
	
	if(document.frm.password.value=='')
	{ 
	str+="-Please Insert Password\n";
	}
	
	if(document.frm.password.value!=document.frm.confirm_password.value)
	{ 
	str+="-Password and Confirm must be same\n";
	}
		
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(!document.frm.email.value.match(emailExp))
	{
		str+='-Please enter a valid email address\n';
	}
		
	if(document.frm.first_name.value=='')
	{ 
	str+="-Please Insert First Name\n";
	}
		
	if(document.frm.last_name.value=='')
	{ 
	str+="-Please Insert Last Name\n";
	}
	
	if(document.frm.company.value=='')
	{ 
	str+="-Please Insert company\n";
	}
		
	if(document.frm.company.value=='')
	{ 
	str+="-Please Insert company\n";
	}
	
	if(document.frm.phone1.value=='')
	{ 
	str+="-Please Insert phone1\n";
	}
	
	if(document.frm.phone2.value=='')
	{ 
	str+="-Please Insert phone2\n";
	}
	
	if(str)
	{
		alert(msg+str);
		return false;
	}
	else
  
	{	
	return true;
	}
}



</script>
</head>
<body >
<?php include("header.inc.php");?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" valign="top" class="rightBorder">
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
    <td align="center" valign="top">
		<table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="21" align="left" class="txt">
				<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="title">
                  <tr>
                    <td height="8" colspan="2"><img src="images/spacer.gif" width="1" height="8" /></td>
                  </tr>
                  <tr>
                    <td width="73%" height="25">
					<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="34" align="center"><img src="images/heading_icon.gif" width="30" height="26" hspace="5" /></td>
                          <td width="150">
						  <?php
						  $sql=$obj->query("select * from $tbl_subregion where id='$id'",$debug=-1);
						  $line2=$obj->fetchNextObject($sql);
						  ?>
						 <a href="sub-region-list.php?id=<?php echo $region_id; ?>"><?php echo $_SESSION['region_name']; ?></a>
						 
						 </td>
						  <td  align="center"><?php if($id){?>Edit Sub Region<?php }else{?>Add New SubRegion<?php }?></td>
                        </tr>
                    </table></td>
                    <td width="27%" align="right" style="padding-right:20px; "> <input name="b1" type="button" class="button" id="b1" value="Region Manager" onclick="location.href='region-list.php'" />
					   <input name="b1" type="button" class="button" id="b1" value="Sub Region Manager" 
					   onclick="location.href='sub-region-list.php?id=<?php echo $region_id; ?>'" /></td>
                  </tr>
                </table>
			</td>
          </tr>
          <tr>
            <td align="center" valign="top">
                <form name="frm" action="sub-region-addf.php" method="post" enctype="multipart/form-data" onsubmit="return validate();">
			    <input type="hidden" name="submitForm" value="yes">
			    <input type="hidden" name="id" class="txtfld" value="<?php echo $id;?>">
                <table width="98%" border="0" align=center cellpadding="4" cellspacing="1" bgcolor="#D8D8D8">
					<TR align="left"> 
					<TD height="25" class="blueBackground">Please enter following details - </TD>
					</TR>
			    		<?php if($_SESSION['sess_msg']!=''){?>
					<tr>
						<td align="center"  class="warning"><?php print $_SESSION['sess_msg']; session_unregister('sess_msg'); $sess_msg='';?></td>
					</tr>
						<?php }?>
					<tr class="evenRow">
						<td height="29" align="right" class="txt"><span class="warning">*</span> - Required Fields</td>
					</tr>
				  
				    <tr class="oddRow">
				      <td align="left" class="bldTxt">Enter SubRegion Details </td>
			      </tr>
				    <tr class="oddRow">
				      <td class="bldTxt" align="center"><table width="100%" border="0" cellpadding="0">
                      
                        <tr>
                          <td width="228" align="left">Sub Region Name</td>
                          <td width="352" align="left"><input name="region_location" type="text" id="region_location" 
					value="<?php if($id) echo stripslashes($line->region_location);  else  echo $region_location;  ?>" />
                            like Delhi, Agra
                          <input name="region_id" type="hidden" value="<?php echo $region_id; ?>" /></td>
                        </tr>
                        <tr>
                          <td align="left">Sub Region Title</td>
                          <td align="left"><input name="region_title" type="text" id="region_title" 
					value="<?php if($id) echo stripslashes($line->region_title);  else  echo $region_title;  ?>" /></td>
                        </tr>
						<tr>
                          <td align="left">Sub Region Meta Keyword</td>
                          <td align="left"><input name="subregion_keyword" type="text" id="subregion_keyword" 
					value="<?php if($id) echo stripslashes($line->subregion_keyword);  else  echo $subregion_keyword;  ?>" /></td>
                        </tr>
						<tr>
                          <td align="left">Sub Region Meta Description</td>
                          <td align="left"><input name="subregion_description" type="text" id="subregion_description" 
					value="<?php if($id) echo stripslashes($line->subregion_description);  else  echo $subregion_description;  ?>" /></td>
                        </tr>
						
						  <tr>
						    <td align="left">Recommended  No. of Nights</td>
						    <td align="left"><input name="no_of_night" type="text" id="no_of_night" 
					value="<?php if($id) echo stripslashes($line->no_of_night);  else  echo $no_of_night;  ?>" /></td>
					    </tr>
						  <tr>
                          <td align="left">Latitude</td>
                          <td align="left"><input name="lat" type="text" id="lat" 
					value="<?php if($id) echo stripslashes($line->lat);  else  echo $lat;  ?>" /></td>
                        </tr>
                        <tr>
                          <td align="left">Longitude</td>
                          <td align="left"><input name="lng" type="text" id="lng" 
					value="<?php if($id) echo stripslashes($line->lng);  else  echo $lng;  ?>" /></td>
                        </tr>
                        <tr>
                          <td align="left">Sub Region Description </td>
                          <td align="left">&nbsp;</td>
                        </tr>
                        <tr>
                         <td align="left" colspan="2">
						   <textarea id="region_description" name="region_description" rows="15" cols="100" style="width: 100%">
			
				<?php if(isset($id)) echo stripslashes($line->region_description); ?>
			</textarea>						 </td>
                        </tr>
						<?php
						if($id)
						{
						?>
                        <tr>
                          <td align="left">Sub Region Image</td>
                          <td align="left"><input name="tour_image2" type="hidden" id="tour_image2" 
					value="<?php if($id) echo stripslashes($line->region_image);  else  echo $tour_image;  ?>" />
                          <img src="<?php echo "../images/$line->region_image"; ?>" width="119" height="103" /></td>
                        </tr>
						<?php
						}
						?>
						
                        <tr>
                          <td align="left">Upload New Image</td>
                          <td align="left"><input name="tour_image" type="file" id="tour_image" />
                          (width=200px,height=185px)</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table></td>
			      </tr>
				    

				   
				  <tr class="oddRow">
				    <td class="bldTxt" align="right" width="52%"><input name="submit" type="submit" class="button" value="Submit"/></td>
				  </tr>
            </table>
	        </form>
	     </td>
       </tr>
	   <tr><td colspan="100%">&nbsp;</td></tr>
     </table>
	</td>
  </tr>
</table>
<?php include("footer.inc.php");?>
</body>
</html>
