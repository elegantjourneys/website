<?php 
//session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
validate_admin();
@extract($_REQUEST);
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
					frmobj.action = "tourdetails-del.php";
					frmobj.submit();
				}
				else{ 
				return false;
				}
		}
		else if(comb=='Deactivate'){
			frmobj.action = "user-del.php";
			frmobj.submit();
		}
		else if(comb=='Activate'){
			frmobj.action = "user-del.php";
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
                          <td>Manage Tour Details( Days Wise) 
						  <?php echo $tour_name; ?>
						  </td>
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
					   <input name="b1" type="button" class="button" id="b1" value="Tour Manager" onclick="location.href='managetour-list.php'" />
					   <input type="button" name="Submit" value="Add New Details" class="button" 
	 onclick="location.href='tourdetails-addf.php?tour_id=<?php echo $id;?>&tour_name=<?php echo $tour_name;?>'" />
					<?php
						}
					?>
					   </td>  </tr>
              </table>
			</td>
          </tr>
<?php 
$start=0;
if(isset($_GET['start'])) $start=$_GET['start'];
$pagesize=25;
if(isset($_GET['pagesize'])) $pagesize=$_GET['pagesize'];
$order_by='id';
if(isset($_GET['order_by'])) $order_by=$_GET['order_by'];
$order_by2='desc';
$where='';

if(isset($_REQUEST['user_name']) !=''){
	$where.=" and user_name like '%". $_REQUEST['user_name']."%'";
}
if(isset($_GET['order_by2'])) $order_by2=$_GET['order_by2'];
$sql=$obj->query("select * from $tbl_set_tour where tour_id=$id order by day limit $start, $pagesize",$debug=-1);

$reccnt=$obj->numRows($obj->query("select * from $tbl_set_tour where tour_id=$id order by day desc"));

?>
          <tr>
            <td height="400" align="center" valign="top">
              <table width="98%" border="0" cellpadding="5" cellspacing="0">
			 
                <tr>
                  <td height="347" align="center" valign="top">
				  <span class="warning"><?php if(isset($_SESSION['sess_msg']))
				 {print $_SESSION['sess_msg'];} unset($_SESSION['sess_msg']); $sess_msg='';?></span> <br />
				    <form name="frm_list" action="user_del.php" method="post" style="margin:0;padding:0">
					<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
					  <table width="100%" border="0" align=center cellpadding="4" cellspacing="1" class="greyBorder">
                        <?php if($reccnt>0){?>
                        <tr class="blueBackground">
                          
						   <td width="10%" align="center">Day </td>
						   <td width="10%" align="center">Description 1 </td>
						   <td width="11%" align="center">Description 2</td>
						   <td width="9%" align="center">Description 3</td>

						   <td width="10%" align="center">Hotel 1</td>
						   <td width="10%" align="center">Hotel 2</td>
						   <td width="10%" align="center">Hotel 3</td>
						   
					       <td width="9%" align="center">Action</td>
                          <td width="8%" align="center">
						  <input name="check_all" type="checkbox"   id="check_all" onclick="checkall(this.form)" value="check_all" />                        </td>
                        </tr>
                        <?php $i=0;
					while($line=$obj->fetchNextObject($sql)){
					$className = ($className == "evenRow")?"oddRow":"evenRow";
					$st_date=explode("-",$line->start_date);
					$ed_date=explode("-",$line->end_date);
					
					$i++;?>
                        
                        <tr class="<?php print $className?>">
                         
						   <td align="center" valign="top" class="txt" ><?php echo $line->day;?></td>
						   <td align="center" valign="top" class="txt" >
						   <?php
								if($line->city_id1!="")
								 {
									$strsqlDescription1 = "select id, subregion_id, tour_name from tbl_tour where id=".$line->city_id1;
									$resultDescription1 = mysql_query($strsqlDescription1);
									$infoDescription1 = mysql_fetch_array($resultDescription1,MYSQL_ASSOC);
									echo "<a href='tour-addf.php?tour_id=".$infoDescription1['id']."' target='_blank'>".$infoDescription1['id']."</a><br />".$infoDescription1['tour_name'];
								 }
							?>
						   </td>
						   <td align="center" valign="top" class="txt" > 
							<?php
								if($line->city_id2!="")
								 {
									$strsqlDescription2 = "select id, subregion_id, tour_name from tbl_tour where id=".$line->city_id2;
									$resultDescription2 = mysql_query($strsqlDescription2);
									$infoDescription2 = mysql_fetch_array($resultDescription2,MYSQL_ASSOC);
									echo "<a href='tour-addf.php?tour_id=".$infoDescription2['id']."' target='_blank'>".$infoDescription2['id']."</a><br />".$infoDescription2['tour_name'];
								 }
							?>
						  </td>
						   <td align="center" valign="top" class="txt" >
								<?php
								 if($line->city_id3!="")
								 {
									$strsqlDescription3 = "select id, subregion_id, tour_name from tbl_tour where id=".$line->city_id3;
									$resultDescription3 = mysql_query($strsqlDescription3);
									$infoDescription3 = mysql_fetch_array($resultDescription3,MYSQL_ASSOC);
									echo "<a href='tour-addf.php?tour_id=".$infoDescription3['id']."' target='_blank'>".$infoDescription3['id']."<a><br />".$infoDescription3['tour_name'];
								 }

							?>
						   </td>
						   <td align="center" valign="top" class="txt" ><?php 
						if($line->hotel1)
						{
						$sql2=$obj->query("select * from $tbl_hotel_type where id=$line->hotel1",$debug=-1);
						$line2=$obj->fetchNextObject($sql2);
						echo $line2->hotel_type_name;
						}
						  
						   
						   ?></td>
						   <td align="center" valign="top" class="txt" ><?php 
						 if($line->hotel3)
						{
						 $sql2=$obj->query("select * from $tbl_hotel_type where id=$line->hotel3",$debug=-1);
						$line2=$obj->fetchNextObject($sql2);
						echo $line2->hotel_type_name;
						}
						   echo "<br>".$line->hotel_facility3." ";
						   
						   ?></td>
					       <td align="center" valign="top" class="txt"><?php 
						if($line->hotel5)
						{
						 $sql2=$obj->query("select * from $tbl_hotel_type where id=$line->hotel5",$debug=-1);
						$line2=$obj->fetchNextObject($sql2);
						echo $line2->hotel_type_name;
						}
						   echo "<br>".$line->hotel_facility6." ";
						   
						   ?></td>
				          <td align="center" valign="top" class="txt">
						   <a href="tourdetails-addf.php?id=<?php echo $line->id;?>&tour_id=<?php echo $id;?>" 
						   class="orangetxt">Edit</a></td>
						  
                          <td valign="top" align="center"><input type="checkbox" name="ids[]" value="<?php print $line->id;?>" /></td>
                        </tr>
                        <?php }?>

<tr align="right" >
                          <td valign="top" class="dark_red" colspan="7">&nbsp;</td>
                          <td colspan="3" valign="top" class="txt">						    
                              
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