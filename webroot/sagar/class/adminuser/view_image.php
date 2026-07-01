<?php session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
validate_admin();
//@extract($_REQUEST);
if(isset($_REQUEST['id']))
{
$_SESSION['property_id']=$_REQUEST['id'];
}

if(isset($_REQUEST['user_id']))
{
$_SESSION['user_id']=$_REQUEST['user_id'];
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
					frmobj.action = "view-del.php";
					frmobj.submit();
				}
				else{ 
				return false;
				}
		}
		else if(comb=='Deactivate'){
			frmobj.action = "view-del.php";
			frmobj.submit();
		}
		else if(comb=='Activate'){
			frmobj.action = "view-del.php";
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
                      <td width="73%" height="25">
					  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="34" align="center"><img src="images/heading_icon.gif" width="30" height="26" hspace="5" /></td>
                          <td>Manage Image </td>
                        </tr>
                      </table>
                      </td>
                     <td width="27%" align="right" style="padding-right:20px; "> 
					  <input type="button" name="Submit" value="Back" class="button" onclick="location.href='property-list.php'" />
					   <input type="button" name="Submit" value="Add New Image" class="button" onclick="location.href='add-property-image.php'" /></td>  </tr>
              </table>
			</td>
          </tr>
<?php
$query=$obj->query("select * from $tbl_manage_image where user_id=".$_SESSION['user_id']." and property_id=".$_SESSION['property_id']."",$debug=-1);
$reccnt=$obj->numRows($query);
?>
          <tr>
            <td height="400" align="center" valign="top">
              <table width="98%" border="0" cellpadding="5" cellspacing="0">
			  
                <tr>
                  <td height="347" align="center" valign="top">
				  <span class="warning"><?php print $_SESSION['sess_msg']; session_unregister('sess_msg'); $sess_msg='';?></span> <br />
				    <form name="frm_list" action="view-del.php" method="post" style="margin:0;padding:0 ">
					  <table width="100%" border="0" align=center cellpadding="4" cellspacing="1" class="greyBorder">
                        <?php if($reccnt>0){?>
                        <tr class="blueBackground">
                          <td width="7%" height="28" align="center">S.No.</td>
						  <td width="23%" align="center"> Image</td>
						
						  <td width="19%" align="center">Image Title</td>
						  <td width="13%" align="center">Status</td>
                          <td width="11%" align="center">Action</td>
                          <td width="6%" align="center"  ><input name="check_all" type="checkbox"   id="check_all" onclick="checkall(this.form)" value="check_all" />
                        </td>
                        </tr>
                        <?php
						 $i=0;
					while($line=$obj->fetchNextObject($query))
					{
					if($j%2==0)
					{
					?>
                        
                        <tr class="evenRow">
                          <td align="center" class="txt" valign="top" ><?php print ++$i;?></td>
						   <td align="center" valign="top" class="txt" >
						
						   <img src="<?php echo "thumb/".$line->image_path ;?>"/></td>
							  
						  
						   <td align="center" valign="top" class="txt">
						   <?php echo $line->image_title ;?></td>
						   <td align="center" class="txt" valign="top"><?php if($line->status==1){?>Activate<? }else{?>Deactivate<? }?></td>
						   <td valign="top" class="txt" align="center"><a href="add-property-image.php?id=<?php echo $line->image_id;?>" class="orangetxt">Edit</a></td>
                      <td valign="top" align="center"><input type="checkbox" name="ids[]" value="<?php print $line->image_id;?>" /></td>
                        </tr>
						
						
						<?php 
						}
						else 
						{
						?>
						
						
						  <tr class="oddRow">
                          <td align="center" class="txt" valign="top" ><?php print ++$i;?></td>
						   <td align="center" valign="top" class="txt" >
						
						   <img src="<?php echo "thumb/".$line->image_path ;?>"/></td>
							  
						  
						   <td align="center" valign="top" class="txt">
						   <?php echo $line->image_title ;?></td>
						   <td align="center" class="txt" valign="top"><?php if($line->status==1){?>Activate<? }else{?>Deactivate<? }?></td>
						   <td valign="top" class="txt" align="center"><a href="add-property-image.php?id=<?php echo $line->image_id;?>" class="orangetxt">Edit</a></td>
                      <td valign="top" align="center"><input type="checkbox" name="ids[]" value="<?php print $line->image_id;?>" /></td>
                        </tr>
						
						
						     <?php
							 }$j++;
							 ?>
						
						
                        <?php }?>
                        <?php }else{?>
                        <tr align="center" class="oddRow">
                          <td colspan="7" class="warning">Sorry, Currently there are no record to display</td>
                        </tr>
                        <?php }?>
						<tr align="right" >
                          <td valign="top" class="dark_red" colspan="2">&nbsp;
</td>
                          <td colspan="6" valign="top" class="txt" >						    <input type="submit" name="Submit" value="Activate" class="button" onclick="return del_prompt(this.form,this.value)" />
                              <input type="submit" name="Submit" value="Deactivate" class="button" onclick="return del_prompt(this.form,this.value)" />
                              <input type="submit" name="Submit" value="Delete" class="button" onclick="return del_prompt(this.form,this.value)" /></td></tr>   
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