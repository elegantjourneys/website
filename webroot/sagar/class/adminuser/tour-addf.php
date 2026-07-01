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
		if($_POST['tour_image'])
		$tour_image=mysql_real_escape_string($_POST['tour_image']);
	}
	else
	{
	$tour_image = time().$_FILES['tour_image']['name'];
	move_uploaded_file($_FILES['tour_image']['tmp_name'],"../images/".$tour_image);
	}
	
	$subregion_id = mysql_real_escape_string($_POST['subregion_id']);
	$tour_location = mysql_real_escape_string($_POST['tour_location']);
	$tour_name = mysql_real_escape_string($_POST['tour_name']);
	$tour_title = mysql_real_escape_string($_POST['tour_title']);
	$tour_description = mysql_real_escape_string($_POST['tour_description']);
	$show_desc= mysql_real_escape_string($_POST['show_desc']);
	
	
	$id = mysql_real_escape_string($_POST['id']);
		
	if($tour_id=='')
    {
	   $sql=$obj->query("insert into $tbl_tour set subregion_id='$id',tour_name='$tour_name',tour_location='$tour_location',
	   tour_title = '$tour_title',tour_description ='$tour_description',show_desc='$show_desc',tour_image = '$tour_image'",$debug=-1);
	   //$id = mysql_insert_id();
		$_SESSION['sess_msg'] = "Tour has been added suceesfully.";
     }
	 else
	 {
	   $sql = "update $tbl_tour set tour_location='$tour_location',tour_name='$tour_name',tour_title = '$tour_title',tour_description ='$tour_description',tour_image = '$tour_image',show_desc='$show_desc' where id = '$tour_id'";	
	   $obj->query($sql,$debug=-1);	   			
		$_SESSION['sess_msg'] = "Tour has been updated suceesfully.";
      }
	  header("Location: tour-list.php?id=$id&region_id=$region_id");
	  exit();
}	

if($tour_id)
{
	$result=$obj->query("select * from $tbl_tour where id='$tour_id'", $debug=-1);
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
                    <td width="59%" height="25"><table width="78%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="34" align="center"><img src="images/heading_icon.gif" width="30" height="26" hspace="5" /></td>
                          <td><?php if($tour_id){?>EditTour<?php }else{?>Add New Tour
						  
						 
						  <?php }?></td>
                        </tr>
                    </table></td>
                    <td width="41%" align="right" style="padding-right:20px; ">
					 <input name="b1" type="button" class="button" id="b1" value="Region Manager" onclick="location.href='region-list.php'" />
				   <input name="b1" type="button" class="button" id="b1" value="Sub Region Manager" 
					   onclick="location.href='tour-list.php?id=<?php echo $id; ?>&region_id=<?php echo $region_id; ?>'" />
                  </tr>
                </table>
			</td>
          </tr>
          <tr>
            <td align="center" valign="top">
                <form name="frm" action="tour-addf.php" method="post" enctype="multipart/form-data" onsubmit="return validate();">
			    <input type="hidden" name="submitForm" value="yes">
			    <input type="hidden" name="id" class="txtfld" value="<?php echo $id;?>">
				 <input type="hidden" name="tour_id" class="txtfld" value="<?php echo $tour_id;?>">
				<input type="hidden" name="region_id" class="txtfld" value="<?php echo $region_id;?>">
                <table width="98%" border="0" align=center cellpadding="4" cellspacing="1" bgcolor="#D8D8D8">
					<TR align="left"> 
					<TD height="25" colspan="2" class="blueBackground">Please enter following details - </TD>
					</TR>
			    		<?php if($_SESSION['sess_msg']!=''){?>
					<tr>
						<td colspan="2" align="center"  class="warning"><?php print $_SESSION['sess_msg']; session_unregister('sess_msg'); $sess_msg='';?></td>
					</tr>
						<?php }?>
					<tr class="evenRow">
						<td class="txt" align="right" colspan="2"><span class="warning">*</span> - Required Fields</td>
					</tr>
				  
				    <tr class="oddRow">
				      <td class="bldTxt" align="right"> Tour Name </td>
				      <td align="left"><input name="tour_name" type="text" id="tour_name" 
					value="<?php if($tour_id) echo stripslashes($line->tour_name);  else  echo $tour_name;  ?>" />
			          like Delhi, Agra
			          <input name="subregion_id" type="hidden" value="<?php echo $subregion_id; ?>"></td>
			      </tr>
			      <tr class="evenRow">
				    <td class="bldTxt" align="right"> Tour Title </td>
				    <td align="left">
					<input name="tour_title" type="text" id="tour_title" 
					value="<?php if($tour_id) echo stripslashes($line->tour_title);  else  echo $tour_title;  ?>" /></td>
			      </tr>
				    <tr class="oddRow">
				    <td class="bldTxt" align="right">Small Description</td>
				    <td align="left">
					<input name="show_desc" type="text" id="show_desc" style="width:600px;" 
					value="<?php if($tour_id) echo stripslashes($line->show_desc);  else  echo $show_desc;  ?>" /></td>
			      </tr>
				  
				  <tr class="evenRow">
				    <td colspan="2" align="left" class="bldTxt">Tour Description</td>
			      </tr>
				  <tr class="evenRow">
				    <td colspan="2" align="right" class="bldTxt">
					  <textarea id="tour_description" name="tour_description" rows="15" cols="100" style="width: 100%">
			
			<?php if($tour_id) echo stripslashes($line->tour_description);  else  echo $tour_description;  ?>
			</textarea>	
			
		</td>
			      </tr>
				  
				   <?php if($tour_id!=''){ ?>
				  <tr class="oddRow">
					<td class="bldTxt" align="right" width="28%">Image</td>
					<td align="left" width="77%">
					<input name="tour_image" type="hidden" id="tour_image" 
					value="<?php if($tour_id) echo stripslashes($line->tour_image);  else  echo $tour_image;  ?>" />
					<img src="<?php echo "../images/$line->tour_image"; ?>" width="119" height="103" />					</td>
				  </tr>
				  <?php } ?>
				 
				  <tr class="evenRow">
                    <td class="bldTxt" align="right">Upload New Image</td>
                    <td align="left">
					<input name="tour_image" type="file" id="tour_image" />
					<span class="bldTxt"> (width=200px, height=185px) </span> </td>
			      </tr>
				  
					
				   <tr class="evenRow">
					<td align=center >&nbsp;</td>
					<td align=left ><input type="submit" class="button" value="Submit"/></td>
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
