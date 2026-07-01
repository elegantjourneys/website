<script type="text/javascript" src="../../royaltour3/admin/ajax.js"></script>
<?php
error_reporting(E_ALL ^ E_NOTICE);

/*define(DBSERVER,"localhost");
define(DBNAME,"tour_and_travel");
define(DBUSER,"root");
define(DBPASS,"");*/

define(DBSERVER,"dbeji.db.9187892.hostedresource.com");
define(DBNAME,"dbeji");
define(DBUSER,"dbeji");
define(DBPASS,"Raja@8048");



mysql_connect(DBSERVER,DBUSER,DBPASS) or die("cannot connect");
mysql_select_db(DBNAME) or die("error in selecting database");//validate_admin();
@extract($_REQUEST);
?>


<?php
if(isset($_GET["q9"]))
{
$q9=$_GET["q9"];
$sql="SELECT * FROM tbl_subregion WHERE region_id = '".$q9."'";
$result = mysql_query($sql);
?>
<select name="subregion_id" onchange="showUser10(this.value)">
<option value="">-- Select Subregion --</option>
<?php
while($row = mysql_fetch_array($result))
  {
  ?>
  <option value="<?php echo $row['id']; ?>"><?php echo $row['region_location']; ?></option>
 <?php
  }
?>
</select>
<?php
}
?>

<?php
if(isset($_GET["q10"]))
{
$q10=$_GET["q10"];
$sql="SELECT * FROM tbl_hotel WHERE subregion_id = '".$q10."'";
$result = mysql_query($sql);
?>
<select name="hotel_id">
<option value="">-- Select Subregion --</option>
<?php
while($row = mysql_fetch_array($result))
  {
  ?>
  <option value="<?php echo $row['subregion_id']; ?>"><?php echo $row['hotel_location']; ?></option>
 <?php
  }
?>
</select>
<?php
}
?>

<?php
if(isset($_GET["q8"]))
{
$q8=$_GET["q8"];
$sql="SELECT * FROM tbl_subregion WHERE region_id = '".$q8."'";
$result = mysql_query($sql);
?>
<select name="subregion_id">
<option value="">-- Select Subregion --</option>
<?php
while($row = mysql_fetch_array($result))
  {
  ?>
  <option value="<?php echo $row['id']; ?>"><?php echo $row['region_location']; ?></option>
 <?php
  }
?>
</select>
<?php
}
?>

<?php
if(isset($_GET["q7"]))
{
$q7=$_GET["q7"];
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
			<option value="<?php echo $row2['id'];?>"/>
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
<select name="hotel2">
<option value="">-- Select Hotel 2 --</option>
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
			<option value="<?php echo $row2['id'];?>"/>
			<?php echo $row2['hotel_type_name'];?>
			</option>
			<?php
			}
		}
	}
	?>
	
	
</select>
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
			<option value="<?php echo $row2['id'];?>"/>
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
<select name="hotel4">
<option value="">-- Select Hotel 2 --</option>
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
			<option value="<?php echo $row2['id'];?>"/>
			<?php echo $row2['hotel_type_name'];?>
			</option>
			<?php
			}
		}
	}
	?>
	
	
</select>
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
			<option value="<?php echo $row2['id'];?>"/>
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
<select name="hotel6">
<option value="">-- Select Hotel 2 --</option>
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
			<option value="<?php echo $row2['id'];?>"/>
			<?php echo $row2['hotel_type_name'];?>
			</option>
			<?php
			}
		}
	}
	?>
	
	
</select>
</td>

</tr>

</table>
<?php
}
?>

<?php
if(isset($_GET["q1"]))
{
$q1=$_GET["q1"];
$sql="SELECT * FROM tbl_tour WHERE subregion_id = '".$q1."'";
$result = mysql_query($sql);
?>
<select name="city1">
<option>-- Select City Tour --</option>
<?php
while($row = mysql_fetch_array($result))
  {
  ?>
  <option value="<?php echo $row['id']; ?>"><?php echo $row['tour_name']; ?></option>
 <?php
  }
?>
</select>
<?php
}
?>

<?php
if(isset($_GET["q2"]))
{
$q2=$_GET["q2"];
$sql="SELECT * FROM tbl_tour WHERE subregion_id = '".$q2."'";

$result = mysql_query($sql);

?>
<select name="city2">
<option>-- Select City Tour --</option>
<?php
while($row = mysql_fetch_array($result))
  {
  ?>
  <option value="<?php echo $row['id']; ?>"><?php echo $row['tour_name']; ?></option>
 <?php
  }
  
?>
</select>
<?php
}
?>




<?php

if(isset($_GET["q3"]))
{
$q3=$_GET["q3"];
$sql="SELECT * FROM tbl_tour WHERE subregion_id = '".$q3."'";

$result = mysql_query($sql);

?>
<select name="city3">
<option>-- Select City Tour --</option>
<?php
while($row = mysql_fetch_array($result))
  {
  ?>
  <option value="<?php echo $row['id']; ?>"><?php echo $row['tour_name']; ?></option>
 <?php
  }
  
?>
</select>
<?php
}
?>


<?php

if(isset($_GET["q4"]))
{
$q4=$_GET["q4"];
$sql="SELECT * FROM tbl_tour WHERE id = '".$q4."'";

$result = mysql_query($sql);
$row = mysql_fetch_array($result);
?>
<textarea name="tour_desc1" cols="30" rows="6">
<?php echo $row['tour_description']; ?>
</textarea>
<?php
}
?>

<?php

if(isset($_GET["q5"]))
{
$q5=$_GET["q5"];
$sql="SELECT * FROM tbl_tour WHERE id = '".$q5."'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
?>
<textarea name="tour_desc2" cols="30" rows="6">
<?php echo $row['tour_description']; ?>
</textarea>
<?php
}
?>


<?php

if(isset($_GET["q6"]))
{
$q6=$_GET["q6"];
$sql="SELECT * FROM tbl_tour WHERE id = '".$q6."'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
?>
<textarea name="tour_desc3" cols="30" rows="6">
<?php echo $row['tour_description']; ?>
</textarea>
<?php
}
?>




