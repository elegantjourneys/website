<?php //session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucfirst(SITE_ADMIN);?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body >
<?php require_once("header.inc.php");?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>

    <td height="400" align="center" valign="top"><p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p align="center" class="warning"><?php if(isset($_SESSION['sess_msg']))echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></p>
<form name="login" method="post" action="login.php" enctype="multipart/form-data" tmt:validate="true">
      <table width="300" border="0" cellpadding="0" cellspacing="0" class="greyBorder">
        <tr>
          <td  align="left" class="blueBackground" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Secured Login</td>
        </tr>
        <tr>
          <td><table width="370" border="0" cellspacing="0" cellpadding="4">
              
              <tr class="oddRow">
                <td width="80" ><span class="txt">USERNAME</span></td>
                <td height="30" align="left"><input name="username" type="text" class="txtfld" tmt:required="true"  tmt:message="Please Enter Username"/></td>
              </tr>
              <tr>
                <td width="80"><span class="txt">PASSWORD</span></td>
                <td height="30" align="left"><input name="password" type="password" class="txtfld" tmt:required="true" tmt:message="Plesae Enter Password" /></td>
              </tr>
			  <tr class="oddRow">
                <td width="80"><span class="txt"></span></td>
                <td height="30" align="left">
		<input type='hidden' name="logged" value="yes" /><input type="image" src="images/submit.gif" width="82" height="26" /></td>
              </tr>
			  <!--<tr><td width="80"></td>
			      <td align="left"><a href="forgot_login.php" class="orangetxt">Forgot Login Information</a></td>
				</tr>-->
		</table></td>
        </tr>
      </table>
    </form>
    <p>&nbsp;</p>
    <p><br />
    </p>
    <p>&nbsp;</p></td>
  </tr>
</table>
<?php
require_once("footer.inc.php");
?>
</body>
</html>