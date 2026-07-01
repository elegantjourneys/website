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

	$set_order = mysql_real_escape_string($_POST['set_order']);
	$question = mysql_real_escape_string($_POST['question']);
	$answer = mysql_real_escape_string($_POST['answer']);
	$id = mysql_real_escape_string($_POST['id']);
	if($id=='')
    {
	   $sql=$obj->query("insert into $tbl_faq set question='$question',answer='$answer',set_order='$set_order'",$debug=-1);
	   $id = mysql_insert_id();
		$_SESSION['sess_msg'] = "FAQ has been added suceesfully.";
     }
	 else 
	 {
	   $sql = "update $tbl_faq set question='$question',answer='$answer',set_order='$set_order' where id = '$id'";	
	   $obj->query($sql);	   			
		$_SESSION['sess_msg'] = "FAQ has been updated suceesfully.";
      }
	  header("Location: faq-list.php");
	  exit();
}	

if($id)
{
	$result=$obj->query("select * from $tbl_faq where id='$id'", $debug=-1);
	$num= $obj->numRows($result);
	$line=$obj->fetchNextObject($result);
		
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
                    <td width="73%" height="25"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="34" align="center"><img src="images/heading_icon.gif" width="30" height="26" hspace="5" /></td>
                          <td><?php if($id){?>Edit FAQRegion<?php }else{?>Add New FAQ<?php }?></td>
                        </tr>
                    </table></td>
                    <td width="27%" align="right" style="padding-right:20px; ">
					 <input name="b1" type="button" class="button" id="b1" value="FAQ Management" onclick="location.href='faq-list.php'" />
					  
					</td>
                  </tr>
                </table>
			</td>
          </tr>
          <tr>
            <td align="center" valign="top">
                <form name="frm" action="faq-addf.php" method="post" enctype="multipart/form-data" onsubmit="return validate();">
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
				    <td width="28%" align="right" class="bldTxt"> Set Order </td>
				    <td width="77%" align="left">
					<input name="set_order" type="text" value="<?php if($id) echo stripslashes($line->set_order);  else  echo $set_order;  ?>" /></td>
			      </tr>
				  <tr class="evenRow">
				    <td class="bldTxt" align="right">FAQ Question </td>
				    <td align="left">
					<input name="question" type="text" id="question" 
					value="<?php if($id) echo stripslashes($line->question);  else  echo $question;  ?>" />					</td>
			      </tr>
				  
				  <tr class="evenRow">
				    <td class="bldTxt" align="right">FAQ Answer </td>
				    <td align="left"><textarea name="answer" cols="50" rows="10">
					<?php if($id) echo stripslashes($line->answer);  else  echo $answer;  ?></textarea></td>
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
