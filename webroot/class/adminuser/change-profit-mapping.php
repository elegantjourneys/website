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
function calculateTotalPrice()
{
	var tourPrice = parseFloat($('#tour_price').val());
	var discountType = $('#profit_type :selected').val();
	
	var tourProfitPrice = parseFloat($('#tour_profit_price').val());
	if(discountType=='percentage_profit')
	{
		tourProfitPrice = (tourPrice*(tourProfitPrice/100));
	}

	var tourTotalPrice = tourPrice + tourProfitPrice;
	$('#tour_total_price').val(tourTotalPrice);
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
				    Profit Mapping</TD>
				</TR>
				<?php if($_SESSION['sess_msg']!=''){?>
				<tr>
					<td colspan="2" align="center"  class="warning"><?php print $_SESSION['sess_msg']; session_unregister('sess_msg'); $sess_msg='';?></td>
				</tr>
				<?php }?>
				
						 <tr>
                          <td>Tour Group</td>
                          <td>
						  <select name="tour_group" onchange="calculateTotalPrice();">
								  <option  value="0" >All Group</option>
								  <option  value="1" >Group1 (1)</option>
								  <option   value="2" >Private3 (2)</option>
								  <option   value="3" >Private1 (3)</option>
								  <option  value="4" >GT (4)</option> 						  						  
								  <option   value="5" >GT+VNS (5)</option> 
								  <option   value="6" >Oberoi (6)</option>
								  <option   value="7" >GT+RAJ (7)</option>
								  <option   value="8" >Taj (8)</option>
								  <option   value="9" >Kerala (9)</option>
								  <option   value="10" >Bhutan (10)</option>
								  <option   value="11" >Nepal (11)</option>
								  <option   value="12" >Misc (12)</option>
						  </select>
						  </td>
                        </tr>
                        <tr>
                          <td>Tour Price</td>
                          <td><input name="tour_price" style="width:100px;" type="text" id="tour_price" 
					value="<?php if(isset($id)) echo stripslashes($line->tour_price);   ?>" onchange="calculateTotalPrice();"/></td>
                        </tr>
                         <tr>
                          <td>Profit </td>
                          <td><input name="offer" type="text" style="width:100px"
						  value="<?php if(isset($id)) echo stripslashes($line->profit);  ?>"
						   id="tour_profit_price" onchange="calculateTotalPrice();"/>

						   <select id="profit_type" name="profit_type" onchange="calculateTotalPrice();">
								<option value="flat_profit">Flat Profit</option>
								<option value="percentage_profit">Percentage Profit</option>
						   </select>
                         </td>
                        </tr>
                        <tr>
                          <td>Total Price </td>
                          <td><input name="profit" style="width:100px" type="text" value="<?php if(isset($id)) echo stripslashes($line->total_price);   ?>" id="tour_total_price" onchange="calculateTotalPrice();"/></td>
                        </tr>
                 
				
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
