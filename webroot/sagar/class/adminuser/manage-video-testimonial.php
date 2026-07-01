<?php 
session_start();
include_once('includes/config.php');
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
validate_admin();
@extract($_REQUEST);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />

<script>
	function checkall(objForm)
    {
	len = objForm.elements.length;
	var i=0;
	for( i=0 ; i<len ; i++){
		if (objForm.elements[i].type=='checkbox') 
		objForm.elements[i].checked=objForm.check_all.checked;
	}
   }
	function del_prompt(frmobj,comb)
		{
			if(comb=='Delete'){
				if(confirm ("Are you sure you want to delete record(s)"))
				{
					frmobj.action = "region-del.php";
					frmobj.submit();
				}
				else{ 
				return false;
				}
		}
		else if(comb=='Deactivate'){
			frmobj.action = "region-del.php";
			frmobj.submit();
		}
		else if(comb=='Activate'){
			frmobj.action = "region-del.php";
			frmobj.submit();
		}
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
                          <td>Manage Video Testimonial </td>
                        </tr>
                      </table>
                      </td>
                     <td width="27%" align="right" style="padding-right:20px; "> 
					   <input type="button" name="Submit" value="Add New Testimonial" class="button" onclick="location.href='add-new-testimonial.php'" /></td>  </tr>
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
				    <form name="frm_list" action="user_del.php" method="post" style="margin:0;padding:0">
					  <table width="100%" border="0" align=center cellpadding="4" cellspacing="1" class="greyBorder">
                        
                        <tr class="blueBackground">
                          <td width="5%" height="28" align="center">S.No.</td>
						   <td width="12%" align="center">Title</td>
						   <td width="12%" align="center">Country </td>
						   <td width="15%" align="center">Image</td>
						   <td width="22%" align="center">Description</td>
					      <td width="11%" align="center">Action</td>
                          
                        </tr>
							<?php 
								include_once('class/video-testimonial.php');
								$objVideoTestimonial = new VideoTestimonial();
								$testimonialList = $objVideoTestimonial->getAllTestimonial();
								$countRecord=1;
								foreach($testimonialList as $testimonial)
								{
							?>
                        
                        <tr class="<?php print $className?>">
                          <td align="center" class="txt" valign="top" ><?=$countRecord?>.</td>
						   <td align="center" valign="top" class="txt" ><?=$testimonial['title']?></td>
						   <td align="center" valign="top" class="txt" ><?=$testimonial['country']?></td>
						   <td align="center" valign="top" class="txt" ><img src="thumb.php?imageName=<?=$testimonial['image']?>&new_w=125&new_h=125&action=gd&location=video/&explicit=y"></td>
						   <td align="center" valign="top" class="txt" ><?=$testimonial['description']?></td>
				          <td align="center" valign="top" class="txt">
						   <a href="add-new-testimonial.php?id=<?=$testimonial['id']?>" 
						   class="orangetxt">Edit</a>  | <a href="region-addf.php?id=<?=$testimonial['id']?>" 
						   class="orangetxt">Delete</a>
						   </td>
						  
                          
                        </tr>
                        
                        <?php }?>
                      </table>
				    </form>
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