<?php 
session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
validate_admin();
@extract($_REQUEST);
if(isset($_POST['submitForm']))
{
    $update_count=$_POST['update_count'];
	echo $update_count;
	for($r=0;$r<$update_count;$r++)
	{
	
		$order_no=$_POST['order_no'][$r];
		$tour_id=$_POST['tour_id'][$r];
		
		$sql = "update $tbl_map_order set order_no=$order_no where id=$tour_id";	
		
		$obj->query($sql,$debug=1);	   			
		$_SESSION['sess_msg'] = "Map Order has been updated suceesfully.";
		
	}
	if(isset($_POST['returnUrl']))
	{
		header("Location: ".$_POST['returnUrl']);
		exit();
	}
	 header("Location: managetour-list.php");
		exit();
}
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
					frmobj.action = "map-order-del.php";
					frmobj.submit();
				}
				else{ 
				return false;
				}
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
                          <td>
						  <?php
						  $sql2=$obj->query("select * from $tbl_managetour where id='$id'",$debug=-1);
						  $line2=$obj->fetchNextObject($sql2)
						  ?>
						  Manage Map Order >> <?php echo $line2->tour_name; ?></td>
                        </tr>
                      </table>
                      </td>
                     <td width="27%" align="right" style="padding-right:20px; "> 
					  <?php
						if(isset($_GET['returnUrl']))
						{
					?>
							 <input name="b1" type="button" class="button" id="b1" value="Tour Copy Manager" onclick="window.location='<?=$_GET['returnUrl']?>';" />
					<?php
						}
						else
						{
					?>
					 <input type="button" name="Submit" value="Tour Manager" class="button" onclick="location.href='managetour-list.php'" />
					   <input type="button" name="Submit" value="Add New Price" class="button" onclick="location.href='price-addf.php?id=<?php echo $id; ?>'" />
					   <?php
						}
					   ?>
					   </td>  </tr>
              </table>
			</td>
          </tr>
<?php 
$reccnt=$obj->numRows($obj->query("select * from $tbl_map_order where tour_id='$id'"));
$sql=$obj->query("select * from $tbl_map_order where tour_id='$id' order by order_no",$debug=-1);
?>
          <tr>
            <td height="400" align="center" valign="top">
              <table width="98%" border="0" cellpadding="5" cellspacing="0">
			 
                <tr>
                  <td height="347" align="center" valign="top">
				  <span class="warning">
				  <?php print $_SESSION['sess_msg']; unset($_SESSION['sess_msg']); $sess_msg='';?></span> <br />
				    <form name="frm_list" action="map-order-list.php?id=<?php echo $id; ?>" method="post" style="margin:0;padding:0">
					<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
					 <input type="hidden" name="submitForm" value="yes">
					  <table width="100%" border="0" align=center cellpadding="4" cellspacing="1" class="greyBorder">
                        <?php if($reccnt>0){?>
                        <tr class="blueBackground">
                          <td width="5%" height="28" align="center">S.No.</td>
						   <td width="12%" align="center">Subregion </td>
						   <td width="12%" align="center">Order </td>
					      <td width="11%" align="center">
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
						   <td align="center" valign="top" class="txt" >
						   <?php
						   $map_sql=$obj->query("select * from $tbl_subregion where id='$line->subregion_id'",$debug=-1);
						   while($map_line=$obj->fetchNextObject($map_sql))
						   {
						   echo $map_line->region_location;
						   }
						   
						   ?>						   </td>
						   <td align="center" valign="top" class="txt" >
						   <input name="tour_id[]" type="hidden" value="<?php echo $line->id;?>" style="width:40px;"  />
						   <input name="order_no[]" type="text" value="<?php echo $line->order_no;?>" style="width:40px;"  /></td>
					      <td valign="top" align="center"><input type="checkbox" name="ids[]" value="<?php print $line->id;?>" /></td>
                        </tr>
                        <?php }?>

<tr align="right" >
                          <td valign="top" class="dark_red" colspan="3">&nbsp;</td>
                          <td valign="top" class="txt">
						  <input name="update_count" type="hidden" value="<?php echo $i; ?>" />
                                <input type="submit" name="Submit" value="Update" class="button"/>
                              <input type="submit" name="Submit" value="Delete" class="button" onclick="return del_prompt(this.form,this.value)" /></td></tr>                        
                        <?php }else{?>
                        <tr align="center" class="oddRow">
                          <td colspan="5" class="warning">Sorry, Currently there are no record to display</td>
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