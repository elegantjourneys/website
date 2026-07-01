<?php session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
validate_admin();
@extract($_POST);

    if ($_POST['submitForm'] == "yes") {
        $query=mysql_query("select password from $tbl_admin where id='$id'");
		$result=mysql_fetch_array($query);
		 if($old_password!=$result['password']){
		$_SESSION['sess_msg']='Old Password is Wrong';
		}
		else{
		mysql_query("update $tbl_admin set password='".addslashes($new_password)."' where id='$id'");
		$_SESSION['sess_msg']='Your Password has been updated successfully';
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">
function validate_password(obj)
{
   if(obj.old_password.value=='')
		{
		alert("Please Enter Old Password");
		obj.old_password.focus();
		return false;
		}
		else if(obj.new_password.value=='')
		{
		alert("Please Enter New Password");
		obj.new_password.focus();
		return false;
		}
		else if(obj.confirm_password.value=='')
		{
		alert("Please Enter Confirm Password");
		obj.confirm_password.focus();
		return false;
		}
		else if((obj.new_password.value)!=(obj.confirm_password.value))
		{
		alert("Please Enter New an Confirm Passwords Must Be Same");
		obj.new_password.focus();
		return false;
		}
		else{
      return true;
   } 
}
	
</script>
</head>
<body  onload="javascript:document.frm.old_password.focus()">
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
                          <td>Admin Password</td>
                        </tr>
                    </table></td>
                    <td width="27%" align="right" style="padding-right:20px; "></td>
                  </tr>
                </table>
			</td>
          </tr>
		  <?php if($_SESSION['sess_admin_id'])$userid=$_SESSION['sess_admin_id'];else $userid=$_SESSION['sess_manager_id'];$query1=mysql_query("select id,username from tbl_admin where id='$userid'");
                      $result1=mysql_fetch_array($query1);?>
		<tr>
            <td  align="center" valign="top">
              <form action="change-password.php" method="post" enctype="multipart/form-data" name="frm" onsubmit="return validate_password(this);">
			  <input type="hidden" name="submitForm" value="yes">
			  <input type="hidden" name="id" class="txtfld" value="<?php echo $result1['id'];?>">
				<table width="98%" border="0" align=center cellpadding="4" cellspacing="0" class="greyBorder">
				<TR align="left"> 
					<TD height="25" colspan="2" class="blueBackground">
				    Change Password</TD>
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
					<td class="bldTxt" align="right" width="35%">Username:</td>
					<td align="left" width="65%" class="txt"><?php echo $result1['username'];?></td>
				</tr>				
				<tr class="evenRow">
					<td class="bldTxt" align="right">Old Password :</td>
					<td align="left"><input type="password" name="old_password" size="45" class="txtfld txt" /> <span class="warning">*</span></td>
				</tr>
				<tr class="oddRow">
					<td class="bldTxt" align="right">New Password :</td>
					<td align="left"><input type="password" name="new_password" size="45" class="txtfld txt" /> <span class="warning">*</span></td>
				</tr>				
				<tr class="evenRow">
					<td class="bldTxt" align="right">Confirm Password :</td>
					<td align="left"><input type="password" name="confirm_password" size="45" class="txtfld txt" /> <span class="warning">*</span></td>
				</tr>
				<TR>
				  <TD colspan=100% align=center class="oddRow"><input type="submit" class="button" value="Submit"/> <input type="reset" name="reset" class="button" value="Reset" /></TD>
				</TR>
				
				</table>
			  </form>
				</td>
       </tr>
     </table>
	</td>
  </tr>
</table>
<?php include("footer.inc.php");?>
</body>
</html>
