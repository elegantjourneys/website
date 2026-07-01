<?php 
session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
validate_admin();
@extract($_REQUEST);
$result=$obj->query("select * from $tbl_contact", $debug=-1);
$num= $obj->numRows($result);
$line=$obj->fetchNextObject($result);
?>
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
<script type="text/javascript" src="ajax.js">
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
                          <td>Contact Us Details</td>
                        </tr>
                    </table></td>
                    <td width="27%" align="right" style="padding-right:20px; "><input name="b1" type="button" class="button" id="b1" value="Back" onclick="location.href='contact-us-list.php'" /></td>
                  </tr>
                </table>
			</td>
          </tr>
          <tr>
            <td align="center" valign="top">
                <form name="frm" action="city-slide-addf.php" method="post" enctype="multipart/form-data" onsubmit="return validate();">
			    <input type="hidden" name="submitForm" value="yes">
			    <input type="hidden" name="id" class="txtfld" value="<?php echo $id;?>">
                <table width="98%" border="0" align=center cellpadding="4" cellspacing="1" bgcolor="#D8D8D8">
				  <tr class="oddRow">
				    <td width="40%" align="right" class="bldTxt">Name</td>
				    <td width="60%" align="left"><?php echo stripslashes($line->name); ?></td>
			      </tr>
				  <tr class="evenRow">
                    <td class="bldTxt" align="right">Email id </td>
                    <td align="left"><?php echo stripslashes($line->email_id); ?></td>
			      </tr>
				  <tr class="oddRow">
				     <td align="right" class="bldTxt">Phone</td>
				     <td align="left"><?php echo stripslashes($line->phone); ?></td>
			      </tr>
				  <tr class="evenRow">
                    <td class="bldTxt" align="right">Country </td>
                    <td align="left"><?php echo stripslashes($line->country); ?></td>
			      </tr>
				  <tr class="oddRow">
				     <td align="right" class="bldTxt">Find US</td>
				     <td align="left"><?php echo stripslashes($line->find_us); ?></td>
			      </tr>
				  <tr class="evenRow">
                    <td class="bldTxt" align="right">Travel US </td>
                    <td align="left"><?php echo stripslashes($line->travel_us); ?></td>
			      </tr>
				  <tr class="oddRow">
				     <td align="right" class="bldTxt">No of Adult</td>
				     <td align="left"><?php echo stripslashes($line->no_of_adult); ?></td>
			      </tr>
				  <tr class="evenRow">
                    <td class="bldTxt" align="right">No of Children </td>
                    <td align="left"><?php echo stripslashes($line->no_of_child); ?></td>
			      </tr>
				  <tr class="oddRow">
				     <td align="right" class="bldTxt">No of Required Room</td>
				     <td align="left"><?php echo stripslashes($line->no_of_requied_room); ?></td>
			      </tr>
				  <tr class="evenRow">
                    <td class="bldTxt" align="right">Travel Type </td>
                    <td align="left"><?php echo stripslashes($line->travel_type); ?></td>
			      </tr>
				  <tr class="oddRow">
				     <td align="right" class="bldTxt">Travel Level</td>
				     <td align="left"><?php echo stripslashes($line->travel_level); ?></td>
			      </tr>
				  <tr class="evenRow">
                    <td class="bldTxt" align="right">Travel Start Date </td>
                    <td align="left"><?php echo stripslashes($line->travel_start_date); ?></td>
			      </tr>
				  <tr class="oddRow">
				     <td align="right" class="bldTxt">Travel End Date</td>
				     <td align="left"><?php echo stripslashes($line->travel_end_date); ?></td>
			      </tr>
				  <tr class="evenRow">
                    <td class="bldTxt" align="right">Message </td>
                    <td align="left"><?php echo stripslashes($line->message); ?></td>
			      </tr>
				  
				   <tr class="evenRow">
					<td align="center">&nbsp;</td>
					<td align="left"><input type="submit" class="button" value="Submit"/></td>
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
