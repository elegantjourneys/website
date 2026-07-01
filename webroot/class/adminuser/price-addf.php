<?php 
ob_start();
session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
validate_admin();
@extract($_REQUEST);



if($_POST['submitForm'] == "yes")
{
$tourtype = mysql_real_escape_string($_POST['tourtype']);
echo $tourtype;
if($tourtype=='')
{	
	if($price_id=='')
    {
	$tour_id=$id;
	echo $tour_id;
	$tour_type=mysql_real_escape_string($_POST['tour_type']);
		for($i=0;$i<100;$i++)
		{
			$start_date = mysql_real_escape_string($_POST['start_date'][$i]);
			$start_date1 = date("Y-m-d",(strtotime($start_date)));

			$end_date = mysql_real_escape_string($_POST['end_date'][$i]);
			$end_date1 = date("Y-m-d",(strtotime($end_date)));

			$star3 = mysql_real_escape_string($_POST['star3'][$i]);
			
			if($star3=='')
			$star3="--";
			
			$star4 = mysql_real_escape_string($_POST['star4'][$i]);
			
			if($star4=='')
			$star4="--";
			
			$star5 = mysql_real_escape_string($_POST['star5'][$i]);
			
			if($star5=='')
			$star5="--";
			
			if($start_date!='' && $end_date!='' && $star3!='' && $star4!='' && $star5!='')
			{
			$sql=$obj->query("insert into $tbl_tour_price set tour_id='$tour_id',tour_type='$tour_type',start_date = '$start_date',end_date = '$end_date', start_date1 = '$start_date1',end_date1 = '$end_date1',star3= '$star3',star4='$star4',star5='$star5'",$debug=1);
			$id = mysql_insert_id();
			$_SESSION['sess_msg'] = "Price has been added suceesfully.";
			}
		}
	}
	 
} 
else 
{
	if($price_id=='')
    {
	$tour_id=$id;
	echo $tour_id;
	$tour_type=mysql_real_escape_string($_POST['tour_type']);
		for($i=0;$i<100;$i++)
		{
			$id2 = mysql_real_escape_string($_POST['id2'][$i]);
			$start_date = mysql_real_escape_string($_POST['start_date'][$i]);
			$end_date = mysql_real_escape_string($_POST['end_date'][$i]);
			$star3 = mysql_real_escape_string($_POST['star3'][$i]);
			$star4 = mysql_real_escape_string($_POST['star4'][$i]);
			$star5 = mysql_real_escape_string($_POST['star5'][$i]);

			$start_date1 = date("Y-m-d",(strtotime($start_date)));
			$end_date1 = date("Y-m-d",(strtotime($end_date)));

			if($start_date!='' && $end_date!='' && $star3!='' && $star4!='' && $star5!='')
			{
			$sql=$obj->query("update $tbl_tour_price set tour_id='$tour_id',tour_type='$tour_type',start_date = '$start_date',end_date = '$end_date', start_date1 = '$start_date1',end_date1 = '$end_date1', star3= '$star3',star4='$star4',star5='$star5' where id=$id2",$debug=-1);
			$id = mysql_insert_id();
			$_SESSION['sess_msg'] = "Price has been Update suceesfully.";
			}
		}
	}
}
     

	  
	  header("Location: price-list.php?id=$tour_id");
	  exit();
}	

if($id)
{
if($tour_type)
{
	$result=$obj->query("select * from $tbl_tour_price where tour_id=$id and tour_type=$tour_type order by start_date1", $debug=-1);
	$num= $obj->numRows($result);
}
else
{
	$result=$obj->query("select * from $tbl_tour_price where tour_id=$id order by start_date1", $debug=-1);
	$num= $obj->numRows($result);

}
	
		
}?>
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
                          <td><?php if($id){?>Edit Price<?php }else{?>Add New Price<?php }?></td>
                        </tr>
                    </table></td>
                    <td width="27%" align="right" style="padding-right:20px; "><input name="b1" type="button" class="button" id="b1" value="Price Manager"
					  onclick="location.href='price-list.php?id=<?php echo $id; ?>'" />
					</td>
                  </tr>
                </table>
			</td>
          </tr>
          <tr>
            <td align="center" valign="top">
                <form name="frm" action="price-addf.php" method="post" enctype="multipart/form-data" onsubmit="return validate();">
			    <input type="hidden" name="submitForm" value="yes">
			  
				<input type="hidden" name="id" class="txtfld" value="<?php echo $id;?>">
				<?php
				if($tour_type)
				{
				
				?>  
				<input type="hidden" name="tourtype" class="txtfld" value="<?php echo $tour_type;?>">
				<table width="98%" border="0" align=center cellpadding="4" cellspacing="1" bgcolor="#D8D8D8">
					<TR align="left"> 
					<TD height="25" colspan="6" class="blueBackground">Please enter following details - </TD>
					</TR>
			    		<?php if($_SESSION['sess_msg']!=''){?>
					<tr>
						<td colspan="6" align="center"  class="warning"><?php print $_SESSION['sess_msg']; session_unregister('sess_msg'); $sess_msg='';?></td>
					</tr>
						<?php }?>
					<tr class="evenRow">
						<td class="txt" align="right" colspan="6"><span class="warning">*</span> - Required Fields</td>
					</tr>
				  
			  
				  
				    <tr class="oddRow">
				      <td align="right" class="bldTxt">Tour Type </td>
				      <td align="left" class="bldTxt"> 
					  <?php
					  	$result2=$obj->query("select * from $tbl_managetour where id='$id'", $debug=-1);
						$num2= $obj->numRows($result2);
						$line2=$obj->fetchNextObject($result2);
						if($line2->tour_type==1)
						{
					   	?>
					  	<input name="tour_type" id="tour_type" type="radio" <?php if($tour_type){ ?>checked="checked" <?php } ?> value="1" />
					 	Group 
					 	<?php
					 	}
					 	if($line2->tour_type==2 || $line2->tour_type==3 || $line2->tour_type==4 || $line2->tour_type==5 || $line2->tour_type==6 || $line2->tour_type==7 || $line2->tour_type==8 || $line2->tour_type==9 || $line2->tour_type==10 || $line2->tour_type==11 || $line2->tour_type==12)
						{
					   	?>
					  	<input name="tour_type" id="tour_type" type="radio" <?php if($tour_type){ ?>checked="checked" <?php } ?> value="2" />
					 	Private
					 	<?php
					 	}
					 	if($line2->tour_type==13)
						{
					   	?>
						<input name="tour_type" id="tour_type" type="radio" <?php if($tour_type){ ?>checked="checked" <?php } ?> value="1" />
					 	Group 
					  	<input name="tour_type" id="tour_type" type="radio" <?php if($tour_type){ ?>checked="checked" <?php } ?> value="2" />
					 	Private			
					 	<?php
					 	}
					 	?></td>
				      <td align="left" class="bldTxt">&nbsp;</td>
				      <td align="left" class="bldTxt">&nbsp;</td>
				      <td align="left" class="bldTxt">&nbsp;</td>
				      <td align="left" class="bldTxt">&nbsp;</td>
			      </tr>
				    <tr class="oddRow">
				      <td width="3%" align="right" class="bldTxt">Sno</td>
				      <td width="19%" align="left" class="bldTxt">Start Date (DD-MM-YY)</td>
				      <td width="22%" align="left" class="bldTxt">End Date (DD-MM-YY)</td>
				      <td width="18%" align="left" class="bldTxt">3 Star </td>
				      <td width="17%" align="left" class="bldTxt">4 Star </td>
				      <td width="21%" align="left" class="bldTxt">5 Star </td>
			      </tr>
			      <?php
				  $j=0;
				  while($line=$obj->fetchNextObject($result))
				  {
				  ?>

				  <tr class="evenRow">
				    <td class="bldTxt" align="right"><?php echo $j+1; ?>.</td>
				    <td align="left" class="bldTxt">
					<input name="id2[]" type="hidden" value="<?php echo $line->id; ?>" />
					<input name="start_date[<?php echo $j; ?>]" type="text" id="start_date[<?php echo $j; ?>]" value="<?php echo $line->start_date; ?>" /></td>
				    <td align="left" class="bldTxt">
					<input name="end_date[<?php echo $j; ?>]" type="text" id="end_date[<?php echo $j; ?>]" value="<?php echo $line->end_date; ?>" /></td>
				    <td align="left" class="bldTxt">
					<input name="star3[<?php echo $j; ?>]" type="text" id="star3[<?php echo $j; ?>]" value="<?php echo $line->star3; ?>" /></td>
				    <td align="left" class="bldTxt">
					<input name="star4[<?php echo $j; ?>]" type="text" id="star4[<?php echo $j; ?>]" value="<?php echo $line->star4; ?>" /></td>
				    <td align="left" class="bldTxt">
					<input name="star5[<?php echo $j; ?>]" type="text" id="star5[<?php echo $j; ?>]" value="<?php echo $line->star5; ?>" /></td>
			      </tr>
				  <?php
				  $j++;
				  }
				  ?>
				   <tr class="evenRow">
					<td align=center >&nbsp;</td>
					<td align=left >&nbsp;</td>
					<td align=left >&nbsp;</td>
					<td align=left >&nbsp;</td>
					<td align=left >&nbsp;</td>
					<td align=left ><input name="submit" type="submit" class="button" value="Submit"/></td>
				  </tr>
				</table>
				<?php
				}
				else
				{
				?>                
				<table width="98%" border="0" align=center cellpadding="4" cellspacing="1" bgcolor="#D8D8D8">
					<TR align="left"> 
					<TD height="25" colspan="6" class="blueBackground">Please enter following details - </TD>
					</TR>
			    		<?php if($_SESSION['sess_msg']!=''){?>
					<tr>
						<td colspan="6" align="center"  class="warning"><?php print $_SESSION['sess_msg']; session_unregister('sess_msg'); $sess_msg='';?></td>
					</tr>
						<?php }?>
					<tr class="evenRow">
						<td class="txt" align="right" colspan="6"><span class="warning">*</span> - Required Fields</td>
					</tr>
				  
			  
				  
				    <tr class="oddRow">
				      <td align="right" class="bldTxt">Tour Type </td>
				      <td align="left" class="bldTxt"> 
					  <?php
					  	$result2=$obj->query("select * from $tbl_managetour where id='$id'", $debug=-1);
						$num2= $obj->numRows($result2);
						$line2=$obj->fetchNextObject($result2);
						if($line2->tour_type==1)
						{
					   	?>
					  	<input name="tour_type" id="tour_type" type="radio" value="1" />
					 	Group 
					 	<?php
					 	}
					 	if($line2->tour_type==2  || $line2->tour_type==3 || $line2->tour_type==4 || $line2->tour_type==5 || $line2->tour_type==6 || $line2->tour_type==7 || $line2->tour_type==8 || $line2->tour_type==9 || $line2->tour_type==10 || $line2->tour_type==11 || $line2->tour_type==12)
						{
					   	?>
					  	<input name="tour_type" id="tour_type" type="radio" value="2" />
					 	Private
					 	<?php
					 	}
					 	if($line2->tour_type==13)
						{
					   	?>
						<input name="tour_type" id="tour_type" type="radio" value="1" />
					 	Group 
					  	<input name="tour_type" id="tour_type" type="radio" value="2" />
					 	Private
					 	<?php
					 	}
					 	?>					 </td>
				      <td align="left" class="bldTxt">&nbsp;</td>
				      <td align="left" class="bldTxt">&nbsp;</td>
				      <td align="left" class="bldTxt">&nbsp;</td>
				      <td align="left" class="bldTxt">&nbsp;</td>
			      </tr>
				    <tr class="oddRow">
				      <td width="3%" align="right" class="bldTxt">Sno</td>
				      <td width="19%" align="left" class="bldTxt">Start Date (DD-MM-YY)</td>
				      <td width="22%" align="left" class="bldTxt">End Date (DD-MM-YY)</td>
				      <td width="18%" align="left" class="bldTxt">3 Star </td>
				      <td width="17%" align="left" class="bldTxt">4 Star </td>
				      <td width="21%" align="left" class="bldTxt">5 Star </td>
			      </tr>
			      

				  <tr class="evenRow">
				    <td class="bldTxt" align="right">1.</td>
				    <td align="left" class="bldTxt"><input name="start_date[0]" type="text" id="start_date[0]" /></td>
				    <td align="left" class="bldTxt"><input name="end_date[0]" type="text" id="end_date[0]" /></td>
				    <td align="left" class="bldTxt"><input name="star3[0]" type="text" id="star3[0]" /></td>
				    <td align="left" class="bldTxt"><input name="star4[0]" type="text" id="star4[0]" /></td>
				    <td align="left" class="bldTxt"><input name="star5[0]" type="text" id="star5[0]" /></td>
			      </tr>
				   <tr class="oddRow">
				    <td class="bldTxt" align="right">2.</td>
				    <td align="left" class="bldTxt"><input name="start_date[1]" type="text" id="start_date[1]" /></td>
				    <td align="left" class="bldTxt"><input name="end_date[1]" type="text" id="end_date[1]" /></td>
				    <td align="left" class="bldTxt"><input name="star3[1]" type="text" id="star3[1]" /></td>
				    <td align="left" class="bldTxt"><input name="star4[1]" type="text" id="star4[1]" /></td>
				    <td align="left" class="bldTxt"><input name="star5[1]" type="text" id="star5[1]" /></td>
			      </tr>
				   <tr class="evenRow">
				    <td class="bldTxt" align="right">3.</td>
				    <td align="left" class="bldTxt"><input name="start_date[2]" type="text" id="start_date[2]" /></td>
				    <td align="left" class="bldTxt"><input name="end_date[2]" type="text" id="end_date[2]" /></td>
				    <td align="left" class="bldTxt"><input name="star3[2]" type="text" id="star3[2]" /></td>
				    <td align="left" class="bldTxt"><input name="star4[2]" type="text" id="star4[2]" /></td>
				    <td align="left" class="bldTxt"><input name="star5[2]" type="text" id="star5[2]" /></td>
			      </tr>
				   <tr class="oddRow">
				    <td class="bldTxt" align="right">4.</td>
				    <td align="left" class="bldTxt"><input name="start_date[3]" type="text" id="start_date[3]" /></td>
				    <td align="left" class="bldTxt"><input name="end_date[3]" type="text" id="end_date[3]" /></td>
				    <td align="left" class="bldTxt"><input name="star3[3]" type="text" id="star3[3]" /></td>
				    <td align="left" class="bldTxt"><input name="star4[3]" type="text" id="star4[3]" /></td>
				    <td align="left" class="bldTxt"><input name="star5[3]" type="text" id="star5[3]" /></td>
			      </tr>
				  <tr class="evenRow">
				    <td class="bldTxt" align="right">5.</td>
				    <td align="left" class="bldTxt"><input name="start_date[4]" type="text" id="start_date[4]" /></td>
				    <td align="left" class="bldTxt"><input name="end_date[4]" type="text" id="end_date[4]" /></td>
				    <td align="left" class="bldTxt"><input name="star3[4]" type="text" id="star3[4]" /></td>
				    <td align="left" class="bldTxt"><input name="star4[4]" type="text" id="star4[4]" /></td>
				    <td align="left" class="bldTxt"><input name="star5[4]" type="text" id="star5[4]" /></td>
			      </tr>
				   <tr class="oddRow">
				    <td class="bldTxt" align="right">6.</td>
				    <td align="left" class="bldTxt"><input name="start_date[5]" type="text" id="start_date[5]" /></td>
				    <td align="left" class="bldTxt"><input name="end_date[5]" type="text" id="end_date[5]" /></td>
				    <td align="left" class="bldTxt"><input name="star3[5]" type="text" id="star3[5]" /></td>
				    <td align="left" class="bldTxt"><input name="star4[5]" type="text" id="star4[5]" /></td>
				    <td align="left" class="bldTxt"><input name="star5[5]" type="text" id="star5[3]" /></td>
			      </tr>
				  <tr class="evenRow">
				    <td class="bldTxt" align="right">7.</td>
				    <td align="left" class="bldTxt"><input name="start_date[6]" type="text" id="start_date[6]" /></td>
				    <td align="left" class="bldTxt"><input name="end_date[6]" type="text" id="end_date[6]" /></td>
				    <td align="left" class="bldTxt"><input name="star3[6]" type="text" id="star3[6]" /></td>
				    <td align="left" class="bldTxt"><input name="star4[6]" type="text" id="star4[6]" /></td>
				    <td align="left" class="bldTxt"><input name="star5[6]" type="text" id="star5[6]" /></td>
			      </tr>
				   <tr class="oddRow">
				    <td class="bldTxt" align="right">8.</td>
				    <td align="left" class="bldTxt"><input name="start_date[7]" type="text" id="start_date[7]" /></td>
				    <td align="left" class="bldTxt"><input name="end_date[7]" type="text" id="end_date[7]" /></td>
				    <td align="left" class="bldTxt"><input name="star3[7]" type="text" id="star3[7]" /></td>
				    <td align="left" class="bldTxt"><input name="star4[7]" type="text" id="star4[7]" /></td>
				    <td align="left" class="bldTxt"><input name="star5[7]" type="text" id="star5[7]" /></td>
			      </tr>
				  <tr class="evenRow">
				    <td class="bldTxt" align="right">9.</td>
				    <td align="left" class="bldTxt"><input name="start_date[8]" type="text" id="start_date[8]" /></td>
				    <td align="left" class="bldTxt"><input name="end_date[8]" type="text" id="end_date[8]" /></td>
				    <td align="left" class="bldTxt"><input name="star3[8]" type="text" id="star3[8]" /></td>
				    <td align="left" class="bldTxt"><input name="star4[8]" type="text" id="star4[8]" /></td>
				    <td align="left" class="bldTxt"><input name="star5[8]" type="text" id="star5[8]" /></td>
			      </tr>
				   <tr class="oddRow">
				    <td class="bldTxt" align="right">10.</td>
				    <td align="left" class="bldTxt"><input name="start_date[9]" type="text" id="start_date[9]" /></td>
				    <td align="left" class="bldTxt"><input name="end_date[9]" type="text" id="end_date[9]" /></td>
				    <td align="left" class="bldTxt"><input name="star3[9]" type="text" id="star3[9]" /></td>
				    <td align="left" class="bldTxt"><input name="star4[9]" type="text" id="star4[9]" /></td>
				    <td align="left" class="bldTxt"><input name="star5[9]" type="text" id="star5[9]" /></td>
			      </tr>
				    <tr class="evenRow">
				    <td class="bldTxt" align="right">11.</td>
				    <td align="left" class="bldTxt"><input name="start_date[10]" type="text" id="start_date[10]" /></td>
				    <td align="left" class="bldTxt"><input name="end_date[10]" type="text" id="end_date[10]" /></td>
				    <td align="left" class="bldTxt"><input name="star3[10]" type="text" id="star3[10]" /></td>
				    <td align="left" class="bldTxt"><input name="star4[10]" type="text" id="star4[10]" /></td>
				    <td align="left" class="bldTxt"><input name="star5[10]" type="text" id="star5[10]" /></td>
			      </tr>
				   <tr class="oddRow">
				    <td class="bldTxt" align="right">12.</td>
				    <td align="left" class="bldTxt"><input name="start_date[11]" type="text" id="start_date[11]" /></td>
				    <td align="left" class="bldTxt"><input name="end_date[11]" type="text" id="end_date[11]" /></td>
				    <td align="left" class="bldTxt"><input name="star3[11]" type="text" id="star3[11]" /></td>
				    <td align="left" class="bldTxt"><input name="star4[11]" type="text" id="star4[11]" /></td>
				    <td align="left" class="bldTxt"><input name="star5[11]" type="text" id="star5[11]" /></td>
			      </tr>
				    <tr class="evenRow">
				    <td class="bldTxt" align="right">13.</td>
				    <td align="left" class="bldTxt"><input name="start_date[12]" type="text" id="start_date[12]" /></td>
				    <td align="left" class="bldTxt"><input name="end_date[12]" type="text" id="end_date[12]" /></td>
				    <td align="left" class="bldTxt"><input name="star3[12]" type="text" id="star3[12]" /></td>
				    <td align="left" class="bldTxt"><input name="star4[12]" type="text" id="star4[12]" /></td>
				    <td align="left" class="bldTxt"><input name="star5[12]" type="text" id="star5[12]" /></td>
			      </tr>
				   <tr class="oddRow">
				    <td class="bldTxt" align="right">14.</td>
				    <td align="left" class="bldTxt"><input name="start_date[13]" type="text" id="start_date[13]" /></td>
				    <td align="left" class="bldTxt"><input name="end_date[13]" type="text" id="end_date[13]" /></td>
				    <td align="left" class="bldTxt"><input name="star3[13]" type="text" id="star3[13]" /></td>
				    <td align="left" class="bldTxt"><input name="star4[13]" type="text" id="star4[13]" /></td>
				    <td align="left" class="bldTxt"><input name="star5[13]" type="text" id="star5[13]" /></td>
			      </tr>
				    <tr class="evenRow">
				    <td class="bldTxt" align="right">15.</td>
				    <td align="left" class="bldTxt"><input name="start_date[14]" type="text" id="start_date[14]" /></td>
				    <td align="left" class="bldTxt"><input name="end_date[14]" type="text" id="end_date[14]" /></td>
				    <td align="left" class="bldTxt"><input name="star3[14]" type="text" id="star3[14]" /></td>
				    <td align="left" class="bldTxt"><input name="star4[14]" type="text" id="star4[14]" /></td>
				    <td align="left" class="bldTxt"><input name="star5[14]" type="text" id="star5[14]" /></td>
			      </tr>
				   <tr class="oddRow">
				    <td class="bldTxt" align="right">16.</td>
				    <td align="left" class="bldTxt"><input name="start_date[15]" type="text" id="start_date[15]" /></td>
				    <td align="left" class="bldTxt"><input name="end_date[15]" type="text" id="end_date[15]" /></td>
				    <td align="left" class="bldTxt"><input name="star3[15]" type="text" id="star3[15]" /></td>
				    <td align="left" class="bldTxt"><input name="star4[15]" type="text" id="star4[15]" /></td>
				    <td align="left" class="bldTxt"><input name="star5[15]" type="text" id="star5[15]" /></td>
			      </tr>
				    <tr class="evenRow">
				    <td class="bldTxt" align="right">17.</td>
				    <td align="left" class="bldTxt"><input name="start_date[16]" type="text" id="start_date[16]" /></td>
				    <td align="left" class="bldTxt"><input name="end_date[16]" type="text" id="end_date[16]" /></td>
				    <td align="left" class="bldTxt"><input name="star3[16]" type="text" id="star3[16]" /></td>
				    <td align="left" class="bldTxt"><input name="star4[16]" type="text" id="star4[16]" /></td>
				    <td align="left" class="bldTxt"><input name="star5[16]" type="text" id="star5[16]" /></td>
			      </tr>
				   <tr class="oddRow">
				    <td class="bldTxt" align="right">18.</td>
				    <td align="left" class="bldTxt"><input name="start_date[17]" type="text" id="start_date[17]" /></td>
				    <td align="left" class="bldTxt"><input name="end_date[17]" type="text" id="end_date[17]" /></td>
				    <td align="left" class="bldTxt"><input name="star3[17]" type="text" id="star3[17]" /></td>
				    <td align="left" class="bldTxt"><input name="star4[17]" type="text" id="star4[17]" /></td>
				    <td align="left" class="bldTxt"><input name="star5[17]" type="text" id="star5[17]" /></td>
			      </tr>
				    <tr class="evenRow">
				    <td class="bldTxt" align="right">19.</td>
				    <td align="left" class="bldTxt"><input name="start_date[18]" type="text" id="start_date[18]" /></td>
				    <td align="left" class="bldTxt"><input name="end_date[18]" type="text" id="end_date[18]" /></td>
				    <td align="left" class="bldTxt"><input name="star3[18]" type="text" id="star3[18]" /></td>
				    <td align="left" class="bldTxt"><input name="star4[18]" type="text" id="star4[18]" /></td>
				    <td align="left" class="bldTxt"><input name="star5[18]" type="text" id="star5[18]" /></td>
			      </tr>
				   <tr class="oddRow">
				    <td class="bldTxt" align="right">20.</td>
				    <td align="left" class="bldTxt"><input name="start_date[19]" type="text" id="start_date[19]" /></td>
				    <td align="left" class="bldTxt"><input name="end_date[19]" type="text" id="end_date[19]" /></td>
				    <td align="left" class="bldTxt"><input name="star3[19]" type="text" id="star3[19]" /></td>
				    <td align="left" class="bldTxt"><input name="star4[19]" type="text" id="star4[19]" /></td>
				    <td align="left" class="bldTxt"><input name="star5[19]" type="text" id="star5[19]" /></td>
			      </tr>
				   	  
				 

				   <tr class="evenRow">
				     <td align=center >&nbsp;</td>
				     <td align=left >&nbsp;</td>
				     <td align=left >&nbsp;</td>
				     <td align=left >&nbsp;</td>
				     <td align=left >&nbsp;</td>
				     <td align=left >&nbsp;</td>
			      </tr>
				   <tr class="evenRow">
					<td align=center >&nbsp;</td>
					<td align=left >&nbsp;</td>
					<td align=left >&nbsp;</td>
					<td align=left >&nbsp;</td>
					<td align=left >&nbsp;</td>
					<td align=left ><input name="submit" type="submit" class="button" value="Submit"/></td>
				  </tr>
            </table>
			<?php
			}
			?>
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
