<?php 
session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
validate_admin();
@extract($_REQUEST);

if(isset($active_id))
{
if($active_status==0)
$sql=$obj->query("update $tbl_tour_price set status=1 where id='$active_id'");
else
$sql=$obj->query("update $tbl_tour_price set status=0 where id='$active_id'");
header("Location:".$_SERVER['HTTP_REFERER']);
}

if(isset($active_id2))
{
if($price_status==0)
$sql=$obj->query("update $tbl_tour_price set price_status=1 where id='$active_id2'");
else
$sql=$obj->query("update $tbl_tour_price set price_status=0 where id='$active_id2'");
header("Location:".$_SERVER['HTTP_REFERER']);
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
					frmobj.action = "price-del.php";
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
                      <td width="60%" height="25"><table width="97%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="46" align="center"><img src="images/heading_icon.gif" width="30" height="26" hspace="5" /></td>
                          <td width="567">
						  <?php
						  $sql2=$obj->query("select * from $tbl_managetour where id='$id'",$debug=-1);
						  $line2=$obj->fetchNextObject($sql2)
						  ?>
						  Manage Price List >> <?php echo $line2->tour_name; ?></td>
                        </tr>
                      </table>
                      </td>
                     <td width="40%" align="right" style="padding-right:20px; "> 
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
					  <?php if($line2->tour_type==1){ ?>
					 <input name="b1" type="button" class="button" id="b1" value="Group Price Edit"
					  onclick="location.href='price-addf.php?id=<?php echo $id; ?>&tour_type=1'" />
					  <?php } ?>
					   <?php if($line2->tour_type==2  || $line2->tour_type==3 || $line2->tour_type==4 || $line2->tour_type==5 || $line2->tour_type==6 || $line2->tour_type==7 || $line2->tour_type==8 || $line2->tour_type==9 || $line2->tour_type==10 || $line2->tour_type==11 || $line2->tour_type==12){ ?>
					  <input name="b1" type="button" class="button" id="b1" value="Private Price Edit"
					  onclick="location.href='price-addf.php?id=<?php echo $id; ?>&tour_type=2'" />
					    <?php } ?>
				      <input type="button" name="Submit" value="Add New Price" class="button" onclick="location.href='price-addf.php?id=<?php echo $id; ?>'" />
					  <?php
						}
					  ?>
					  
					  </td>  </tr>
              </table>
			</td>
          </tr>
<?php 
$reccnt=$obj->numRows($obj->query("select * from $tbl_tour_price where tour_id='$id'"));
$sql=$obj->query("select * from $tbl_tour_price where tour_id='$id'",$debug=-1);
?>
          <tr>
            <td height="400" align="center" valign="top">
              <table width="98%" border="0" cellpadding="5" cellspacing="0">
			 
                <tr>
                  <td height="347" align="center" valign="top">
				  <span class="warning">
				  <?php print $_SESSION['sess_msg']; unset($_SESSION['sess_msg']); $sess_msg='';?></span> <br />
				    <form name="frm_list" action="user_del.php" method="post" style="margin:0;padding:0">
					<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
					  <table width="100%" border="0" align=center cellpadding="4" cellspacing="1" class="greyBorder">
                        <?php if($reccnt>0){?>
                        <tr class="blueBackground">
                          <td width="5%" height="28" align="center">S.No.</td>
						   <td width="12%" align="center">Start Date </td>
						   <td width="12%" align="center">End Date </td>
						   <td width="15%" align="center">Tour Type </td>
						   <td width="15%" align="center">Affordable Level Hotels:</td>
						   <td width="15%" align="center">Luxury Level Hotels:</td>
						   <td width="15%" align="center">Royale Level Hotels:</td>
					       <td width="11%" align="center">Low Price/High Price</td>
					       <td width="11%" align="center">Active/Deactive</td>
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
						   <td align="center" valign="top" class="txt" ><?php echo $line->start_date;?></td>
						   <td align="center" valign="top" class="txt" ><?php echo $line->end_date;?></td>
						   <td align="center" valign="top" class="txt" >
						   <?php 
						   if($line->tour_type==1)
						   echo "Group";
						   if($line->tour_type==2  || $line->tour_type==3 || $line->tour_type==4 || $line->tour_type==5 || $line->tour_type==6 || $line->tour_type==7 || $line->tour_type==8 || $line->tour_type==9 || $line->tour_type==10 || $line->tour_type==11 || $line->tour_type==12)
						   echo "Private";
						   ?>						   </td>
						   <td align="center" valign="top" class="txt" ><?php echo $line->star3;?></td>
						   <td align="center" valign="top" class="txt" ><?php echo $line->star4;?></td>
						   <td align="center" valign="top" class="txt" ><?php echo $line->star5;?></td>
				           <td valign="top" align="center">
						   <a href="price-list.php?active_id2=<?php echo $line->id;?>&price_status=<?php echo $line->price_status; ?>">
				             <?php if($line->price_status==1)  echo "Low Price"; else echo "High Price";?>
				           </a></td>
				           <td valign="top" align="center">
						   <a href="price-list.php?active_id=<?php echo $line->id;?>&active_status=<?php echo $line->status; ?>">
						   <?php if($line->status==1)  echo "Active"; else echo "Deactive";?></a>						   </td>
			              <td valign="top" align="center"><input type="checkbox" name="ids[]" value="<?php print $line->id;?>" /></td>
                        </tr>
                        <?php }?>

<tr align="right" >
                          <td valign="top" class="dark_red" colspan="7">&nbsp;</td>
                          <td valign="top" class="txt">&nbsp;</td>
                          <td valign="top" class="txt">&nbsp;</td>
                          <td valign="top" class="txt">						    
                              
                              <input type="submit" name="Submit" value="Delete" class="button" onclick="return del_prompt(this.form,this.value)" /></td></tr>                        
                        <?php }else{?>
                        <tr align="center" class="oddRow">
                          <td colspan="11" class="warning">Sorry, Currently there are no record to display</td>
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