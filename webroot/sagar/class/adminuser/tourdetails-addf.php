<?php 
ob_start();

require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
validate_admin();
@extract($_REQUEST);

if(isset($_POST['submitForm']))
{

$tour_description1=mysql_real_escape_string(ltrim($_POST['tour_desc1']));
$tour_description2=mysql_real_escape_string(ltrim($_POST['tour_desc2']));
$tour_description3=mysql_real_escape_string(ltrim($_POST['tour_desc3']));

$hotel_location=mysql_real_escape_string($_POST['hotel_location']);

$day = mysql_real_escape_string($_POST['day']);
$city_hotel = mysql_real_escape_string($_POST['city_hotel']);

$subregion1 = mysql_real_escape_string($_POST['subregion1']);
$subregion2 = mysql_real_escape_string($_POST['subregion2']);
$subregion3 = mysql_real_escape_string($_POST['subregion3']);

$city_id1 = mysql_real_escape_string($_POST['city1']);
$city_id2 = mysql_real_escape_string($_POST['city2']);
$city_id3 = mysql_real_escape_string($_POST['city3']);

$hotel1 = mysql_real_escape_string($_POST['hotel1']);
$hotel2 = mysql_real_escape_string($_POST['hotel2']);
$hotel3 = mysql_real_escape_string($_POST['hotel3']);

	$id = mysql_real_escape_string($_POST['id']);
	
	if($hotel1!="")
	{
	$hotel_facility1=$_POST['b1']." ".$_POST['l1']." ".$_POST['d1'];
	$hotel2 = mysql_real_escape_string($_POST['hotel2']);
	}
	else
	{
	$hotel_facility1="";
	$hotel2="";
	}
	
	if($hotel3!="")
	{
	$hotel_facility2=$_POST['b2']." ".$_POST['l2']." ".$_POST['d2'];
	$hotel4 = mysql_real_escape_string($_POST['hotel4']);
	}
	else
	{
	$hotel_facility2="";
	$hotel4="";
	}
	
	if($hotel5!="")
	{
	$hotel_facility3=$_POST['b3']." ".$_POST['l3']." ".$_POST['d3'];
	$hotel6 = mysql_real_escape_string($_POST['hotel6']);
	}
	else
	{
	$hotel_facility3="";
	$hotel6="";
	}
	
	if($id=='')
    {
	   $sql=$obj->query("insert into $tbl_set_tour set day='$day',tour_id='$tour_id',subregion1='$subregion1',subregion2='$subregion2',subregion3='$subregion3', city_hotel='$city_hotel',hotel_location='$hotel_location',city_id1='$city_id1',city_id2='$city_id2',city_id3='$city_id3',hotel1='$hotel1',hotel2='$hotel2',
	   hotel3='$hotel3',hotel4='$hotel4',hotel5='$hotel5',hotel6='$hotel6',hotel_facility1='$hotel_facility1',
	   hotel_facility2='$hotel_facility2',hotel_facility3='$hotel_facility3'",$debug=-1);
	   $id = mysql_insert_id();
		$_SESSION['sess_msg'] = "Tour Details has been added suceesfully.";
     }
	 else 
	 {
	   $sql = "update $tbl_set_tour set 
	  day='$day',tour_id='$tour_id',subregion1='$subregion1',subregion2='$subregion2',subregion3='$subregion3', 
	city_hotel='$city_hotel',hotel_location='$hotel_location',
	 city_id1='$city_id1',city_id2='$city_id2',city_id3='$city_id3',hotel1='$hotel1',hotel2='$hotel2',
	   hotel3='$hotel3',hotel4='$hotel4',hotel5='$hotel5',hotel6='$hotel6',hotel_facility1='$hotel_facility1',
	   hotel_facility2='$hotel_facility2',hotel_facility3='$hotel_facility3'
	    where id=$id";	
	   $obj->query($sql,$debug=1);	   			
		$_SESSION['sess_msg'] = "Tour Details has been updated suceesfully.";
      }
	 header("Location: tourdetails-list.php?id=$tour_id");
	  exit();
}	

if(isset($id))
{
	$result=$obj->query("select * from $tbl_set_tour where id='$id'", $debug=-1);
	$num= $obj->numRows($result);
	$line=$obj->fetchNextObject($result);
		
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
<script type="text/javascript" src="ajax.js">
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
                          <td><?php if(isset($id)){?>Edit Details<?php }else{?>Add New Tour Details<?php }?>
						  <?php echo "(".$tour_name.")"; ?>
						  </td>
                        </tr>
                    </table></td>
                    <td width="27%" align="right" style="padding-right:20px; ">
				<input name="b1" type="button" class="button" id="b1" value="Tour Details" 
				onclick="location.href='tourdetails-list.php?id=<?php echo $tour_id; ?>'" />
					   
					</td>
                  </tr>
                </table>
			</td>
          </tr>
          <tr>
            <td align="center" valign="top">
			
                <form name="frm" action="tourdetails-addf.php" method="post" enctype="multipart/form-data" onsubmit="return validate();">
			    <input type="hidden" name="submitForm" value="yes">
			    <input type="hidden" name="id" class="txtfld" value="<?php echo $id;?>">
				<input type="hidden" name="tour_id" class="txtfld" value="<?php echo $tour_id;?>">
                <table width="98%" height="570" border="0" align=center cellpadding="4" cellspacing="1" bgcolor="#D8D8D8">
					<TR align="left"> 
					<TD height="25" colspan="4" class="blueBackground">
					Please enter following details - </TD>
					</TR>
			    		<?php if(isset($_SESSION['sess_msg'])!=''){?>
					<tr>
						<td colspan="4" align="center"  class="warning"><?php print $_SESSION['sess_msg']; session_unregister('sess_msg'); $sess_msg='';?></td>
					</tr>
						<?php }?>
					<tr class="evenRow">
						<td class="txt" align="right" colspan="4"><span class="warning">*</span> - Required Fields</td>
					</tr>
					 	<?php
					if(isset($id))
					{
					$result4=$obj->query("select * from $tbl_set_tour where id=$id", $debug=-1);
					$line4=$obj->fetchNextObject($result4);
					}
					?>
				    <tr class="oddRow">
				      <td colspan="4" align="left" class="bldTxt">Day
				        <input name="day" type="text" style="width:40px;" 
						value="<?php if($id) echo stripslashes($line4->day);  else  echo $day;  ?>" />
			          like 1,2 etc. </td>
			      </tr>
			        <tr class="oddRow">
			          <td colspan="4" align="left"  class="headTxt">Tour Information </td>
		          </tr>
				  <?php
				  
				  if(isset($tour_id))
					{
						//echo "select * from $tbl_managetour where id='$tour_id'";
						$result2=$obj->query("select * from $tbl_managetour where id='$tour_id'", $debug=-1);
						$num2= $obj->numRows($result2);
						$line2=$obj->fetchNextObject($result2);
						$array_str=explode(",",$line2->areas);
					
						
					}
				  ?>
		          <tr class="oddRow">
		            <td align="right" class="bldTxt">Order</td>
		            <td align="center">1</td>
		            <td align="center">2</td>
		            <td align="center">3</td>
	              </tr>
		          <tr class="oddRow">
				    <td width="16%" align="right" class="bldTxt">  City </td>
				    <td width="26%" align="left">
				  
					<select name="subregion1" onchange="showUser1(this.value)">
					<option value="">-- Select City --</option>
					<?php
					for($i=0;$i<count($array_str);$i++)
						{
						echo "select * from $tbl_subregion where id=$array_str[$i]";
						$result31=$obj->query("select * from $tbl_subregion where id=$array_str[$i]", $debug=-1);
						$line31=$obj->fetchNextObject($result31);
						
					?>
					<option value="<?php echo $line31->id;  ?>" 
					<?php if($line31->id==$line4->subregion1){ ?> selected="selected" <?php } ?>><?php echo $line31->region_location;  ?>					</option>
					<?php
					}
					?>
                    </select>					</td>
				    <td width="28%" align="left">
				   <select name="subregion2" onchange="showUser2(this.value)">
					<option value="">-- Select City --</option>
					<?php
					for($i=0;$i<count($array_str);$i++)
						{
						$result32=$obj->query("select * from $tbl_subregion where id='$array_str[$i]'", $debug=-1);
						$line32=$obj->fetchNextObject($result32);
						
					?>
                    <option value="<?php echo $line32->id;  ?>"
					<?php if($line32->id==$line4->subregion2){ ?> selected="selected" <?php } ?>>
					<?php echo $line32->region_location;  ?></option>
					<?php
					}
					?>
                    </select>					</td>
				    <td width="30%" align="left">
					<select name="subregion3" onchange="showUser3(this.value)">
					<option value="">-- Select City --</option>
					<?php
					for($i=0;$i<count($array_str);$i++)
						{
						$result33=$obj->query("select * from $tbl_subregion where id='$array_str[$i]'", $debug=-1);
						$line33=$obj->fetchNextObject($result33);
						
					?>
                    <option value="<?php echo $line33->id;  ?>"
					<?php if($line33->id==$line4->subregion3){ ?> selected="selected" <?php } ?>>
					<?php echo $line33->region_location;  ?>					</option>
					<?php
					}
					?>
                    </select>					</td>
			      </tr>
				  
				  <tr class="evenRow">
				    <td height="77" align="right" class="bldTxt">City Tour</td>
				    <td align="left">
					<div id="txtHint1">
					<?php
					if(isset($id))
					
					{
						$result35=$obj->query("select * from $tbl_set_tour where id=$id", $debug=-1);
						$line35=$obj->fetchNextObject($result35);
						if($line4->subregion1!="")
						{
						$result34=$obj->query("select * from $tbl_tour where subregion_id=$line4->subregion1", $debug=-1);
					?>
					<select name="city1">
					<option value="">-- Select City Tour --</option>
					<?php
					while($line34=$obj->fetchNextObject($result34))
					{
					?>
					<option <?php if($line34->id==$line35->city_id1){ ?> selected="selected" <?php } ?> 
					value="<?php echo $line34->id; ?>">
					<?php echo $line34->tour_name;  ?></option>
					<?php
					}
					?>
					</select>
					<?php
					}
						else
						{
						?>
					<select name="select6">
                    <option value="">-- Select City Tour --</option>
                    </select>
						<?php }
					}
					else
					{
					?>
					<select name="select6">
                    <option value="">-- Select City Tour --</option>
                    </select>
					<?php
					}
					
					?>
					</div></td>
				    <td align="left">
					<div id="txtHint2">
					<?php
					if(isset($id))
					
					{
						$result36=$obj->query("select * from $tbl_set_tour where id=$id", $debug=-1);
						$line36=$obj->fetchNextObject($result36);
						if($line4->subregion2!="")
						{
						$result37=$obj->query("select * from $tbl_tour where subregion_id=$line4->subregion2", $debug=-1);
					?>
					<select name="city2">
					<option value="">-- Select City Tour --</option>
					<?php
					while($line37=$obj->fetchNextObject($result37))
					{
					?>
					<option <?php if($line37->id==$line36->city_id2){ ?> selected="selected" <?php } ?> 
					value="<?php echo $line37->id; ?>"><?php echo $line37->tour_name;  ?></option>
					<?php
					}
					?>
					</select>
					<?php
					}
						else
						{
						?>
					<select name="select6">
                    <option value="">-- Select City Tour --</option>
                    </select>
						<?php }
					}
					else
					{
					?>
					<select name="select6">
                    <option value="">-- Select City Tour --</option>
                    </select>
					<?php
					}
					?>
					</div></td>
				    <td align="left">
					<div id="txtHint3">
					<?php
					if(isset($id))
					
					{
						$result38=$obj->query("select * from $tbl_set_tour where id=$id", $debug=-1);
						$line38=$obj->fetchNextObject($result38);
						if($line4->subregion3!="")
						{
						$result39=$obj->query("select * from $tbl_tour where subregion_id=$line4->subregion3", $debug=-1);
					?>
					<select name="city3">
					<option value="">-- Select City Tour --</option>
					<?php
					while($line39=$obj->fetchNextObject($result39))
					{
					?>
					<option <?php if($line39->id==$line38->city_id3){ ?> selected="selected" <?php } ?> 
					value="<?php echo $line39->id; ?>"><?php echo $line39->tour_name;  ?></option>
					<?php
					}
					?>
					</select>
					<?php
					}
						else
						{
						?>
					<select name="select6">
                    <option value="">-- Select City Tour --</option>
                    </select>
						<?php }
					}
					else
					{
					?>
					<select name="select6">
                    <option value="">-- Select City Tour --</option>
                    </select>
					<?php
					}
					?>
					</div></td>
			      </tr>
				  
				   
				  
				   <tr class="oddRow">
				     <td class="bldTxt" align="right">&nbsp;</td>
				     <td align="left">&nbsp;</td>
				     <td align="left">&nbsp;</td>
				     <td align="left">&nbsp;</td>
			      </tr>
				   <tr class="oddRow">
				     <td colspan="4" align="left" class="headTxt">Choose Hotel Area </td>
			      </tr>
				   <tr class="oddRow">
				     <td height="174" colspan="4" align="left" class="bldTxt"><table width="100%" height="145" border="0" cellpadding="0" cellspacing="0">
                       
                       <tr>
                         <td width="10%">Select City </td>
                         <td width="39%">
						 <?php
						   if(isset($id))
						   {
						   $result40=$obj->query("select * from $tbl_set_tour where id=$id", $debug=-1);
						   $line40=$obj->fetchNextObject($result40);
						   }
						 ?>
						 <select name="hotel_location" onchange="showUser7(this.value)">
                           <option value="">-- Select City --</option>
                           <?php
						 
					for($i=0;$i<count($array_str);$i++)
						{
						$result3=$obj->query("select * from $tbl_subregion where id='$array_str[$i]'", $debug=-1);
						$line3=$obj->fetchNextObject($result3);
						
					?>
                           <option value="<?php echo $line3->id;  ?>"  
						 <?php if($line40->hotel_location==$line3->id && $id) { ?> selected="selected" <?php  }?> >
						 <?php echo $line3->region_location;  ?></option>
                           <?php
					}
					?>
                         </select>
						 
						 </td>
                         <td width="51%">
						  
										 </td>
                       </tr>
                       <tr>
                         <td>Hotel 5 star<br />
                         <br /> 
                         Hotel 4 star<br />
                         <br /> 
                         Hotel 3 star </td>
                         <td>
						 <div id="txtHint7"><br />
						 <?php
if($id)
{
$q7=$line40->hotel_location;
?>
<table width="312" height="108" border="0" cellpadding="0" cellspacing="0">
<tr>
<td>
<select name="hotel1">
<option value="">-- Select Hotel 1 --</option>
<?php
$sql="SELECT * FROM tbl_hotel WHERE subregion_id = ".$q7."";
$result = mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
	$sql2="SELECT * FROM tbl_hotel_type WHERE hotel_id = ".$row['id']."";
	$result2 = mysql_query($sql2);
	?>
	
	<?php
		while($row2 = mysql_fetch_array($result2))
		{
			if($row2['hotel_type_name']) 
			{
			?>
			<option <?php if($line40->hotel1==$row2['id']){ ?>selected="selected" <?php } ?> value="<?php echo $row2['id'];?>"/>
			<?php echo $row2['hotel_type_name'];?>
			</option>
			<?php
			}
		}
	}
	?>
	
	
</select>
</td>
<td>

</td>

</tr>
<tr>
<td>
<select name="hotel3">
<option value="">-- Select Hotel 1 --</option>
<?php
$sql="SELECT * FROM tbl_hotel WHERE subregion_id = ".$q7."";
$result = mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
	$sql2="SELECT * FROM tbl_hotel_type WHERE hotel_id = ".$row['id']."";
	$result2 = mysql_query($sql2);
	?>
	
	<?php
		while($row2 = mysql_fetch_array($result2))
		{
			if($row2['hotel_type_name']) 
			{
			?>
			<option <?php if($line40->hotel3==$row2['id']){ ?>selected="selected" <?php } ?> value="<?php echo $row2['id'];?>"/>
			<?php echo $row2['hotel_type_name'];?>
			</option>
			<?php
			}
		}
	}
	?>
	
	
</select>
</td>
<td>

</td>

</tr>
<tr>
<td>
<select name="hotel5">
<option value="">-- Select Hotel 1 --</option>
<?php
$sql="SELECT * FROM tbl_hotel WHERE subregion_id = ".$q7."";
$result = mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
	$sql2="SELECT * FROM tbl_hotel_type WHERE hotel_id = ".$row['id']."";
	$result2 = mysql_query($sql2);
	?>
	
	<?php
		while($row2 = mysql_fetch_array($result2))
		{
			if($row2['hotel_type_name']) 
			{
			?>
			<option <?php if($line40->hotel5==$row2['id']){ ?>selected="selected" <?php } ?> value="<?php echo $row2['id'];?>"/>
			<?php echo $row2['hotel_type_name'];?>
			</option>
			<?php
			}
		}
	}
	?>
	
	
</select>
</td>
<td>

</td>

</tr>

</table>
<?php
}
?>

						
	


						 </div></td>
                         <td>
						 </td>
                       </tr>
                       
                     </table></td>
			      </tr>
				
				 
				   <tr class="evenRow">
					<td align=center >&nbsp;</td>
					<td align=left >&nbsp;</td>
					<td align=left >&nbsp;</td>
					<td align=left >
					<input type="submit" class="button" value="Submit"/>					</td>
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
