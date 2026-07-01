<?php 
session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
validate_admin();
@extract($_REQUEST);

if($_POST['submitForm'] == "yes")
{
	$reccnt2=$obj->numRows($obj->query("select * from $tbl_home_page_tour"));
	for($tour_id=1;$tour_id<=$reccnt2;$tour_id++)
	{
	$set_order=mysql_real_escape_string($_POST['set_order'][$tour_id-1]);
	$sql = "update $tbl_home_page_tour set set_order='$set_order[$i]' where id='$tour_id'";	
	$obj->query($sql,$debug=-1);				
	$_SESSION['sess_msg'] = "Tour Order set successfully.";
	}
}

if(isset($active_id))
{
if($active_status==0)
$sql=$obj->query("update $tbl_home_page_tour set active_status=1 where id='$active_id'");
else
$sql=$obj->query("update $tbl_home_page_tour set active_status=0 where id='$active_id'");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />

<script>
	
	function enable_disable(value)
	{
	alert(set_order[0]);
	document.getElementById("set_order[0]").disabled=false;
	}
	
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
					frmobj.action = "currency-del.php";
					frmobj.submit();
				}
				else{ 
				return false;
				}
		}
		else if(comb=='Deactivate'){
			frmobj.action = "hotel-del.php";
			frmobj.submit();
		}
		else if(comb=='Activate'){
			frmobj.action = "hotel-del.php";
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
                      <td width="59%" height="25"><table width="87%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="34" align="center"><img src="images/heading_icon.gif" width="30" height="26" hspace="5" /></td>
                          <td>
						  Manage Currency </td>
                        </tr>
                      </table>
                      </td>
                     <td width="41%" align="right" style="padding-right:20px; "><input type="button" name="Submit" value="Add New Currency" class="button" 
					   
					   onclick="location.href='currency-addf.php'" /></td>  </tr>
              </table>
			</td>
          </tr>
<?php 
$sql=$obj->query("select * from $tbl_currency",$debug=-1);
$reccnt=$obj->numRows($obj->query("select * from $tbl_currency"));
?>
          <tr>
            <td height="400" align="center" valign="top">
              <table width="98%" border="0" cellpadding="5" cellspacing="0">
			 
                <tr>
                  <td height="347" align="center" valign="top">
				  <span class="warning"><?php print $_SESSION['sess_msg']; unset($_SESSION['sess_msg']); $sess_msg='';?></span> <br />
				    <form name="frm_list" action="home-page-tour.php" method="post" style="margin:0;padding:0">
					<input type="hidden" name="submitForm" value="yes">
					 <table width="100%" border="0" align=center cellpadding="4" cellspacing="1" class="greyBorder">
                        <?php if($reccnt>0){?>
                        <tr class="blueBackground">
                          <td width="6%" height="28" align="center">S.No.</td>
						   <td width="11%" align="center">Currency Name</td>
						   <td width="12%" align="center">Currency Amount<br />
						     (like 1Rs=0.16Dollar) </td>
						    <td width="12%" align="center">Currency Value<br />
						     (like 1doller=48Rs.) </td>
						   <td width="16%" align="center">Currency Image </td>
						   <td width="16%" align="center">Currency Symbol</td>
					       <td width="15%" align="center">Action</td>
                          <td width="9%" align="center">
						  <input name="check_all" type="checkbox"   id="check_all" onclick="checkall(this.form)" value="check_all" />                        </td>
                        </tr>
                        <?php $i=0;
					while($line=$obj->fetchNextObject($sql)){
					$className = ($className == "evenRow")?"oddRow":"evenRow";
					$st_date=explode("-",$line->start_date);
					$ed_date=explode("-",$line->end_date);
					
					
					$i++;?>
                        
                        <tr class="<?php print $className?>">
                          <td align="center" class="txt" valign="top" ><?php print $i+$start;?>.</td>
						   <td align="center" valign="top" class="txt" ><?php print $line->currency_name;?></td>
						   <td align="center" valign="top" class="txt" >
						   <?php print $line->amount;?>
   						   </td>
						   <td align="center" valign="top" class="txt" >
						   <?php print $line->currency_value;?>
   						   </td>
						   <td align="center" valign="top" class="txt">
						   <img src="<?php echo "../images/".$line->currency_symbol;?>" width="50" height="35" /></td>
						   <td align="center" valign="top" class="txt">
						   <?php print $line->currency_sign;?>
						   </td>
				          <td align="center" valign="top" class="txt">
				<a href="currency-addf.php?id=<?php echo $line->id;?>" 
			   class="orangetxt">Edit</a></td>
						  
                          <td valign="top" align="center"><input type="checkbox" name="ids[]" value="<?php print $line->id;?>" /></td>
                        </tr>
                        <?php }?>

<tr align="right" >
                          <td valign="top" class="dark_red" colspan="3">&nbsp;</td>
                          <td colspan="5" valign="top" class="txt"><input type="submit" name="Submit" value="Delete" class="button" onclick="return del_prompt(this.form,this.value)" /></td></tr>                        
                        <?php }else{?>
                        <tr align="center" class="oddRow">
                          <td colspan="8" class="warning">Sorry, Currently there are no record to display</td>
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