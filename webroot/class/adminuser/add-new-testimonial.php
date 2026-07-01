<?php 
ob_start();
session_start();
include_once("includes/config.php");
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
include_once("library/library.php");
validate_admin();
@extract($_REQUEST);
include_once("class/video-testimonial.php");
$objVideoTestimonial = new VideoTestimonial();
if($_POST['submitForm'] == "yes")
{
	
	$objVideoTestimonial->addNewTestimonial($_POST,$_FILES['image']);
	header("Location: region-list.php");
	exit();
}	

if($id)
{
	$testimonialDetail=$objVideoTestimonial->getTestimonialById($id);
	echo "<pre>";
	print_r($testimonialDetail);
	echo "</pre>";
		
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function validate()
{
    msg = "Please fill the following information:\n\n";
	str = "";
	objFrm = document.frmTestimonial;
	
	if(objFrm.title.value=='')
	{ 
	str+="-Please Insert Title\n";
	}
	
	if(objFrm.country.value=='')
	{ 
	str+="-Please Insert Country\n";
	}video_code
	
	if(objFrm.video_code.value=='')
	{ 
	str+="-Please Insert Video Code\n";
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
                    <td width="73%" height="25"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="34" align="center"><img src="images/heading_icon.gif" width="30" height="26" hspace="5" /></td>
                          <td><?php if($id){?>Edit Video Testimonial<?php }else{?>Add New Video Testimonial<?php }?></td>
                        </tr>
                    </table></td>
                    <td width="27%" align="right" style="padding-right:20px; ">
					
					</td>
                  </tr>
                </table>
			</td>
          </tr>
          <tr>
            <td align="center" valign="top">
                <form name="frmTestimonial" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" onsubmit="return validate();">
			    <input type="hidden" name="submitForm" value="yes">
			    <input type="hidden" name="id" class="txtfld" value="<?php echo $id;?>">
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
				    <td class="bldTxt" align="right">Title</td>
				    <td align="left">
					<input name="title" type="text" value="" /></td>
			      </tr>
				  <tr class="evenRow">
				    <td class="bldTxt" align="right">Country</td>
				    <td align="left">
					<input name="country" type="text" id="country" 
					value="" />					</td>
			      </tr>
				  <tr class="evenRow">
				    <td class="bldTxt" align="right">Video Code</td>
				    <td align="left">
					<input name="video_code" type="text" id="video_code" 
					value="" />					</td>
			      </tr>
				  <tr class="evenRow">
				    <td class="bldTxt" align="right">Image</td>
				    <td align="left">
					<input type="file" name="image">
					</td>
			      </tr>
				  
				  <tr class="evenRow">
				    <td class="bldTxt" align="right">Description </td>
				    <td align="left">
						<textarea name="description" cols="50" rows="10">
						</textarea>
					</td>
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
