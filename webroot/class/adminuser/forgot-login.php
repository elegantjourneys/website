<?php session_start();
require_once("../lib/variables.php");
require_once("../lib/functions.php");
@extract($_POST);
if($submit=='yes'){
$sql4=executeQuery("select * from $tbl_admin where username='$username'");
$line1=mysql_num_rows($sql4);
if($username==''){
$_SESSION['sess_msg']='Please Enter Username';
}
else if($line1<=0){
$_SESSION['sess_msg']='Username is Wrong';
}
else
{
$line2=mysql_fetch_array($sql4);
//extract the email for ForGot Login Information
	           $res=executeQuery("select * from $tbl_emails where section='Admin Forgot Login Informaion'");
	           $row=mysql_fetch_assoc($res);
	           $email=$row['email'];
	           $subject=$row['subject'];
	           $email=str_replace("[USERNAME]",$line2['username'],$email);
			   $email=str_replace("[PASSWORD]",$line2['password'],$email);
			   $email=str_replace("SITE_URL",SITE_URL,$email);
	           $headers  = 'MIME-Version: 1.0' . "\r\n";
               $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
               $headers .= 'From:'.$line2['email'].  "<".$line2['email'].">\r\n";
               $to = $line2['email'];
               @mail($to, $subject, nl2br($email), $headers);
			   $_SESSION['sess_msg']='Your Login Information has been sent to your Email Address';
			   header("Location: forgot_login.php");
			   exit();
}		
}	   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="admin_css/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body >
<?php
require_once("header.inc.php");
?>
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
    <p align="center" class="warning"><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></p>
<form name="login" method="post" action="forgot_login.php" enctype="multipart/form-data" tmt:validate="true">
      <table width="300" border="0" cellpadding="0" cellspacing="0" class="greyBorder">
        <tr>
          <td height="30" align="left" class="blueBackground">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="bigWhite">Forgot Login Information </span></td>
        </tr>
        <tr>
          <td><table width="370" border="0" cellspacing="0" cellpadding="4">
              
              <tr class="oddRow">
                <td width="80" ><span class="txt">USERNAME</span></td>
                <td height="30" align="left"><input name="username" type="text" class="txtfld" tmt:required="true"  tmt:message="Please Enter Username"/></td>
              </tr>
              <tr class="evenRow">
                <td width="80"><span class="txt"></span></td>
                <td height="30" align="left"><input type='hidden' name="submit" value="yes" /><input type="image" src="images/submit.gif" width="82" height="26" /></td>
              </tr>
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
<?php require_once("footer.inc.php");?>
</body>
</html>
