<?php session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
validate_admin();
$email=sprintf("%s",$_REQUEST['email']);
if ($_POST['submitForm'] == "yes") {
		$obj->execute("update $tbl_admin set email='".addslashes($email)."' where id='".$_SESSION['sess_admin_id']."'",$debug=-1);
		$_SESSION['sess_msg']='Your Email has been updated successfully';
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script>
	function  validSearch(obj)
	{
	if(obj.email.value=='')
	{
	alert("Please enter email.");
	return false;
	}
	else if(!validEmailAddress(obj.email.value))
	{
	alert("Please enter valid email.");
	return false;
	}
	else return true;
	}
	
function validEmailAddress(email)
{
		invalidChars = " /:,;~"
		if (email == "") 
		{
			return (false);
		}
		for (i=0; i<invalidChars.length; i++) 
		{
			badChar = invalidChars.charAt(i)
			if (email.indexOf(badChar,0) != -1) 
			{
				return (false);
			}
		}
		atPos = email.indexOf("@",1)
		if (atPos == -1) 
		{
			return (false);
		}
		if (email.indexOf("@",atPos+1) != -1) 
		{
			return (false);
		}
		periodPos = email.indexOf(".",atPos)
		if (periodPos == -1) 
		{
			return (false);
		}
		if (periodPos+3 > email.length)	
		{
			return (false);
		}
			
		return (true);
}
</script>
</head>
<body >
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
                          <td>Admin Email</td>
                        </tr>
                    </table></td>
                    <td width="27%" align="right" style="padding-right:20px; "></td>
                  </tr>
                </table>
			</td>
          </tr>
<?php   $query=$obj->query("select email from $tbl_admin where id='".$_SESSION['sess_admin_id']."'",$debug=-1);
		$result=$obj->fetchNextObject($query);
		$email =$result->email; ?>
		<tr>
            <td align="center" valign="top"><form action="admin-email.php" method="post" enctype="multipart/form-data" name="frm" onsubmit="return validSearch(this);">
			  <input type="hidden" name="submitForm" value="yes">
				<table width="98%" border="0" align="right" cellpadding="1" cellspacing="1" class="greyBorder">
                    <?php if($_SESSION['sess_msg']!=''){?>
					<tr>
						<td colspan="2" align="center"  class="warning"><?php print $_SESSION['sess_msg']; session_unregister('sess_msg'); $sess_msg='';?></td>
					</tr>
						<?php }?>
                      <tr  align="center">
                        <td ><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#D8D8D8">
                            
							<tr>
							  <td class="blueBackground" align="left" colspan="2">&nbsp;Change Email</td>
						  </tr>
							<tr class="evenRow">
								<td height="24" colspan="2" align="right" class="txt"><span class="warning">*</span> - Required Fields</td>
							</tr>
                            <tr class="oddRow">
                              <td width="40%" height="32" align="right"  class="txt"><strong>Email</strong></td>
                              <td width="60%"  align="left"  class="txt"><input name="email" type="text" class="txt" id="email" value="<?php echo stripslashes($email);?>" size="35"/>
                              <span class="warning">*</span></td>
                            </tr>
                            <tr align="center"  class="evenRow">
								<td height="32">&nbsp; </td>
                              <td height="20"  align="left" valign="middle" bgcolor="#FFFFFF"><input type="submit" name="submit" value="Update Email" class="button" onclick="return valid(this);" />
                              </td>
                            </tr>
                        </table></td>
                      </tr>
              </table>
			  </form>
				<br>
         </td>
       </tr>
     </table>
	</td>
  </tr>
</table>
<?php include("footer.inc.php");?>
</body>
</html>
