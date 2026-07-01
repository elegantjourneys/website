<?php 
session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
validate_admin();
@extract($_REQUEST);

if($_POST['submitForm'] == "yes")
{
	if($_FILES['image_path']['size']>0 && $_FILES['image_path']['error'] == 0)
  	{
    	$image_path = time().$_FILES['image_path']['name'];
		move_uploaded_file($_FILES['image_path']['tmp_name'],"../images/".$image_path);
  	}
	 else
  	{
   		$image_path = mysql_real_escape_string($_POST['image_hidden_path']);
  	}
	
	 
	$currency_name = mysql_real_escape_string($_POST['currency_name']);
	$currency_sign = mysql_real_escape_string($_POST['currency_sign']);
	$amount = mysql_real_escape_string($_POST['amount']);
	$currency_value = mysql_real_escape_string($_POST['currency_value']);
	
	if($id=='')
	{
	$sql=$obj->query("insert into $tbl_currency set currency_name='$currency_name',currency_symbol='$image_path',currency_sign='$currency_sign',
	amount='$amount' ,currency_value='$currency_value'",$debug=-1);
	$id = mysql_insert_id();
	$_SESSION['sess_msg'] = "Currency has been added succeesfully.";
    }
	else
	{
	$sql = "update $tbl_currency set currency_name='$currency_name',currency_symbol = '$image_path',currency_sign = '$currency_sign',amount='$amount', currency_value='$currency_value'	where id = '$id'";	
	$obj->query($sql);	   			
	$_SESSION['sess_msg'] = "Currency has been updated suceesfully.";
	}
	header("Location: currency-list.php");
	exit();
 }

if($id)
{
	$result=$obj->query("select * from $tbl_currency where id='$id'", $debug=-1);
	$num= $obj->numRows($result);
	$line=$obj->fetchNextObject($result);
		
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="ajax.js">
</script>
<script>
	function adjustCurrencyValue()
	{
		var currencyAmount = parseFloat(document.getElementById('currencyAmount').value);
		var currencyValue = (1/currencyAmount);
		currencyValue = currencyValue.toFixed(4);
		document.getElementById('currencyValue').value=currencyValue;
	}

	function adjustCurrencyAmount()
	{
		var currencyAmount = parseFloat(document.getElementById('currencyValue').value);
		var currencyValue = (1/currencyAmount);
		currencyValue = currencyValue.toFixed(6);
		document.getElementById('currencyAmount').value=currencyValue;
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
                          <td><?php if($id){?>Edit Currency<?php }else{?>Add New Currency<?php }?></td>
                        </tr>
                    </table></td>
                    <td width="27%" align="right" style="padding-right:20px; "><input name="b1" type="button" class="button" id="b1" value="Back" onclick="location.href='currency-list.php'" /></td>
                  </tr>
                </table>
			</td>
          </tr>
          <tr>
            <td align="center" valign="top">
                <form name="frm" action="currency-addf.php" method="post" enctype="multipart/form-data" onsubmit="return validate();">
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
				    <td width="37%" align="right" class="bldTxt">Currency Name </td>
				    <td width="63%" align="left"><input name="currency_name" type="text" value="<?php echo $line->currency_name; ?>" /></td>
			      </tr>
				  
				 <?php if($id!=''){ ?>
				  <tr class="evenRow">
					<td class="bldTxt" align="right" width="37%">Currency Symbol</td>
					<td width="63%" align="left" class="bldTxt">
					<input name="image_hidden_path" type="hidden" id="image_hidden_path" value="<?php echo $line->currency_symbol; ?>"  />
					<img src="<?php echo "../images/$line->currency_symbol"; ?>" width="50" height="35" />	(Size width=&quot;45&quot; height=&quot;35&quot; )				</td>
				  </tr>
				  <?php } ?>

				  <tr class="oddRow">
                    <td class="bldTxt" align="right">Currency Symbol</td>
                    <td align="left">
					<input name="image_path" type="file" />					</td>
			      </tr>
				 		  
				   <tr class="evenRow">
				     <td align="right"><span class="bldTxt">Currency Sign</span></td>
				     <td align="left" class="bldTxt"><input name="currency_sign" type="text" value="<?php echo htmlspecialchars($line->currency_sign); ?>" />
			         (like this &amp;#36;) Numerical Code </td>
				   </tr>
				   <tr class="evenRow">
				     <td align="right" class="bldTxt">Currency Amount</td>
				     <td align="left" class="bldTxt"><input name="amount" type="text" value="<?php echo $line->amount; ?>" onblur="adjustCurrencyValue()" id="currencyAmount"/>
			         <!--(like 1doller=?)--> </td>
			      </tr>
				   <tr class="evenRow">
				     <td align="right" class="bldTxt">Currency Value</td>
				     <td align="left" class="bldTxt"><input name="currency_value" type="text" value="<?php echo $line->currency_value; ?>" onblur="adjustCurrencyAmount()" id="currencyValue"/>
			         (like 1doller=?) </td>
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
