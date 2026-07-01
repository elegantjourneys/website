<?php 
//session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
validate_admin();
@extract($_REQUEST);
if(isset($active_id))
{
if($active_status==0)
$sql=$obj->query("update $tbl_managetour set active=1 where id='$active_id'");
else
$sql=$obj->query("update $tbl_managetour set active=0 where id='$active_id'");
header("Location:".$_SERVER['HTTP_REFERER']);
}

if(isset($publish_id))
{
if($active_status==0)
$sql=$obj->query("update $tbl_managetour set site_active=1 where id='$publish_id'");
else
$sql=$obj->query("update $tbl_managetour set site_active=0 where id='$publish_id'");
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
					frmobj.action = "managetour-del.php";
					frmobj.submit();
				}
				else{ 
				return false;
				}
		}
		else if(comb=='Deactivate'){
			frmobj.action = "managetour-del.php";
			frmobj.submit();
		}
		else if(comb=='Activate'){
			frmobj.action = "managetour-del.php";
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
                      <td width="73%" height="25"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="34" align="center"><img src="images/heading_icon.gif" width="30" height="26" hspace="5" /></td>
                          <td>Manage Tour  </td>
                        </tr>
                      </table>
                      </td>
                     <td width="27%" align="right" style="padding-right:20px; "> 
					   <input type="button" name="Submit" value="Add New Tour" class="button" onclick="location.href='managetour-addf.php'" /></td>  </tr>
              </table>
			</td>
          </tr>
<?php 
$start=0;
if(isset($_GET['start'])) $start=$_GET['start'];
$pagesize=5;
if(isset($_GET['pagesize'])) $pagesize=$_GET['pagesize'];
$order_by='id';
if(isset($_GET['order_by'])) $order_by=$_GET['order_by'];
$order_by2='desc';
$where='';

if(isset($_REQUEST['user_name']) !=''){
	$where.=" and user_name like '%". $_REQUEST['user_name']."%'";
}
if(isset($_GET['order_by2'])) $order_by2=$_GET['order_by2'];

//$sql=$obj->query("select * from $tbl_managetour where 1=1 $where order by $order_by $order_by2 limit $start, $pagesize",$debug=-1);

$sql=$obj->query("select * from $tbl_managetour where 1=1 $where order by id limit $start, $pagesize",$debug=-1);

$reccnt=$obj->numRows($obj->query("select * from $tbl_managetour where 1=1  $where "));

?>
          <tr>
            <td height="400" align="center" valign="top">
              <table width="98%" border="0" cellpadding="5" cellspacing="0">
			 
                <tr>
                  <td height="347" align="center" valign="top">
				  <span class="warning">
				  <?php 
				  if(isset($_SESSION['sess_msg']))
				  { 
				  print $_SESSION['sess_msg']; 
				   $sess_msg='';
				   unset($_SESSION['sess_msg']);
				   }
				   ?></span> <br />
				    <form name="frm_list" action="user_del.php" method="post" style="margin:0;padding:0">
					  <table width="100%" border="0" align=center cellpadding="4" cellspacing="1" class="greyBorder">
                        <?php if($reccnt>0){?>
                        <tr class="blueBackground">
                          <td width="5%" height="28" align="center">ID</td>
						   <td width="11%" align="center">Publish/Unpublish </td>
					      <td width="9%" align="center">				          Active/Dactive </td>
						   <td width="8%" align="center">Tour Name </td>
						   <td width="7%" align="center">Tour Type </td>
						   <td width="7%" align="center">Tour Price  </td>
						   <td width="14%" align="center">Image</td>
						   <td width="8%" align="center">No. of Days </td>
						   <td width="4%" align="center">Areas</td>
					      <td width="20%" align="center">Action</td>
                          <td width="7%" align="center">
						  <input name="check_all" type="checkbox"   id="check_all" onclick="checkall(this.form)" value="check_all" />                        </td>
                        </tr>
                        <?php $n=0;
							$className="evenRow";
					while($line=$obj->fetchNextObject($sql)){
					$className = ($className == "evenRow")?"oddRow":"evenRow";
					//$st_date=explode("-",$line->start_date);
					//$ed_date=explode("-",$line->end_date);
					
					
					$n++;?>
                        
                        <tr class="<?php print $className?>">
                          <td align="center" class="txt" valign="top" ><?php echo $line->id;?>.</td>
						   <td align="center" valign="top" class="txt" ><?php 
						   if($line->site_active==1)
						   echo "Published";
						   else
						   echo "Unpublished";
						   ?></td>
						   <td align="center" valign="top" class="txt" ><?php 
						   if($line->active==1)
						   echo "Active";
						   else
						   echo "Deactive";
						   ?></td>
						   <td align="center" valign="top" class="txt" ><?php echo $line->tour_name;?></td>
						   <td align="center" valign="top" class="txt" >
						   <?php 
						   if($line->tour_type==1)
						   echo "Group";
						   if($line->tour_type==2)
						   echo "Private";
						   if($line->tour_type==3)
						   echo "Group and private";
						   ?>						   </td>
						   <td align="center" valign="top" class="txt" ><?php echo $line->tour_price;?></td>
						   <td align="center" valign="top" class="txt" ><img src="<?php echo "../images/$line->tour_image"; ?>" width="119" height="103" /> </td>
					       <td align="center" valign="top" class="txt"><?php echo $line->tour_duraction;?></td>
					       <td align="left" valign="top" class="txt">
						   <?php
				  			$array_str=explode(",",$line->areas);
							for($i=0;$i<count($array_str);$i++)
							{
								$result13=$obj->query("select * from $tbl_subregion where id='$array_str[$i]'", $debug=-1);
								$line13=$obj->fetchNextObject($result13);
					   			echo $line13->region_location."<br>"; 
							}
							?>						   </td>
				          <td align="left" valign="top" class="txt">
						   <a href="managetour-addf.php?id=<?php echo $line->id;?>" 
						   class="orangetxt">Edit Tour</a>  
						   <br />
						   <a href="tourdetails-list.php?id=<?php echo $line->id;?>&tour_name=<?php echo $line->tour_name;?>" 
						   class="orangetxt">Manage Tour Details</a><br />
						   <a href="managetour-list.php?publish_id=<?php echo $line->id;?>&active_status=<?php echo $line->site_active; ?>" 
						   class="orangetxt">
						   Publish/Unpublish						   </a><br />	
						      <a href="managetour-list.php?active_id=<?php echo $line->id;?>&active_status=<?php echo $line->active; ?>" 
						   class="orangetxt">
						   Tour active/deactive						   </a>	
						   
						   <br  />
					      <a href="price-list.php?id=<?php echo $line->id;?>" class="orangetxt">Manage Price</a>	   				      
						  <br  />
					      <a href="map-order-list.php?id=<?php echo $line->id;?>" class="orangetxt">Manage Map Order</a>	   				      
						  <br  />
						  <a href="set_inclusion_exclusion-list.php?id=<?php echo $line->id;?>&tour_name=<?php echo $line->tour_name;?>" class="orangetxt">Set Inclusions/Exclusions</a>	
						    <br  />
						  <a href="edit_inclusion_exclusion-list.php?id=<?php echo $line->id;?>&tour_name=<?php echo $line->tour_name;?>" class="orangetxt">Set Order Inclusions/Exclusions</a>	   				      
						  
						  </td>
						  
                          <td valign="top" align="center"><input type="checkbox" name="ids[]" value="<?php print $line->id;?>" /></td>
                        </tr>
                        <?php }?>

<tr align="right" >
                          <td valign="top" class="dark_red" colspan="7">
						  <?php include("../lib/paging.inc.php"); ?>
						  </td>
                          <td colspan="4" valign="top" class="txt">						    
                              
                              <input type="submit" name="Submit" value="Delete" class="button" onclick="return del_prompt(this.form,this.value)" /></td></tr>                        
                        <?php }else{?>
                        <tr align="center" class="oddRow">
                          <td colspan="12" class="warning">Sorry, Currently there are no record to display</td>
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