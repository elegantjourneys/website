<?php 
session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
validate_admin();
@extract($_REQUEST);

if(isset($_POST['submitForm']))
{
  
	$strsqlTourDel = "delete from tbl_set_inclusion_exclusion where tour_id=".$_POST['tour_id'];
	mysql_query($strsqlTourDel);

	$orderNo=1;
	foreach($_POST['inc_exc_id'] as $includsionId)
	{
		echo $strsqlTourUpd = "insert into tbl_set_inclusion_exclusion ( tour_id, inc_exc_id, order_no) values('".$_POST['tour_id']."','".$includsionId."','".$orderNo."')";
		mysql_query($strsqlTourUpd);
		$orderNo++;
		echo "<br />";
	}

	$_SESSION['sess_msg'] = "Inclusion/Exclusion set suceesfully.";
	if(isset($_POST['returnUrl']))
	{
		//header("Location: ".$_POST['returnUrl']);
		//exit();
	}
    //header("Location: set_inclusion_exclusion-list.php?id=$tour_id");
	//exit();
}	 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
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
                          <td>Manage Inclusion/Exclusion - (<?php echo $tour_name; ?>)</td>
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
					<?php
						}
					?>
					 
					 </td>  
                    </tr>
              </table>
			</td>
          </tr>
<?php 
$start=0;

if(isset($_GET['start'])) $start=$_GET['start'];
$pagesize=50;

if(isset($_GET['pagesize'])) $pagesize=$_GET['pagesize'];
$order_by='id';

if(isset($_GET['order_by2'])) $order_by2=$_GET['order_by2'];
//$sql=$obj->query("select * from $tbl_inc_exc limit $start, $pagesize",$debug=-1);

$sql=$obj->query("select * from $tbl_inc_exc ",$debug=-1);

$reccnt=$obj->numRows($obj->query("select * from $tbl_inc_exc"));

?>
          <tr>
            <td height="400" align="center" valign="top">
              <table width="98%" border="0" cellpadding="5" cellspacing="0">
			 	
                <tr>
                  <td height="347" align="center" valign="top">
				  <span class="warning">
				  <?php print $_SESSION['sess_msg']; unset($_SESSION['sess_msg']); $sess_msg='';?></span> <br />
				    <form name="frm_list" action="" method="post" style="margin:0;padding:0">
					<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
					 <input type="hidden" name="submitForm" value="yes">
					 <input name="start_id" type="hidden" value="<?php echo $start; ?>" />
					  <input type="hidden" name="tour_id" class="txtfld" value="<?php echo $id;?>">
					  <table width="100%" border="0" align=center cellpadding="4" cellspacing="1" class="greyBorder">
                        <?php if($reccnt>0){?>
                        <tr class="blueBackground">
                          <td width="13%" height="28" align="center">S.No.</td>
						   <td width="17%" align="left">Inclusions/Exclusions Type </td>
						   <td width="48%" align="left">Inclusions/Exclusions</td>
				          <td width="22%" align="center">Click Here to  Set Inclusions/Exclusions </td>
                        </tr>
                        <?php $i=0;
					while($line=$obj->fetchNextObject($sql)){
					$className = ($className == "evenRow")?"oddRow":"evenRow";
					$st_date=explode("-",$line->start_date);
					$ed_date=explode("-",$line->end_date);
					
					
					$i++;?>
                        
                        <tr class="<?php print $className?>">
                          <td align="center" class="txt" valign="top" ><?php print $i+$start; ?></td>
						   <td align="left" valign="top" class="txt" >
						  <?php if($line->incexctype==1) echo "Inclusions"; else echo "Exclusions"; ?></td>
						   <td align="left" valign="top" class="txt" ><?php echo $line->incexcdesc; ?></td>
				          <td align="center" valign="top" class="txt"><?php
						  $set_inc_exc_sql=$obj->query("select * from $tbl_set_inclusion_exclusion where tour_id=$id && inc_exc_id=$line->id",$debug=-1);
						  $set_inc_exc_line=$obj->fetchNextObject($set_inc_exc_sql);
						  ?>
                            <input type="checkbox" name="inc_exc_id[]"
						   <?php if($set_inc_exc_line->inc_exc_id==$line->id) {?>  checked="checked"<?php } ?>  
					value="<?php echo $line->id; ?>" /></td>
                        </tr>
                        <?php }?>

<tr align="right" >
                          <td valign="top" class="dark_red" colspan="3"><?php //include("../lib/paging.inc.php"); ?></td>
                          <td valign="top" class="txt">		
						  		    
                              <input name="count3" id="count3" type="hidden" value="<?php echo $reccnt; ?>" />
                              <input type="submit" name="Submit" value="Set" class="button"/></td></tr>                        
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