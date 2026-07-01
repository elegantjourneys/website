<?php
session_start();
include "../include/database.php";
if(isset($_POST['btnsubmit']))
{

$category_name=mysql_real_escape_string($_POST['category_name']);
$product_name=mysql_real_escape_string($_POST['product_name']);
$product_image=mysql_real_escape_string(time().$_FILES["product_image"]["name"]);

move_uploaded_file($_FILES["product_image"]["tmp_name"],"../images/".time().$_FILES["product_image"]["name"]);

$query="insert into product values('','$category_name','$product_name','$product_image')";
mysql_query($query);

}
?>
<html>
<head>
<title>Administrator</title>
<script language="javascript">
function validate()
{
msg = "Please fill the following information:\n\n";
str = "";
if(document.frm.category_name.value=='')
{
str+="-Please Insert Category Name\n";
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
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="60%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CACACA">
  <tr>
    <td colspan="2"><?php include 'header.html'; ?></td>
  </tr>
  <tr>
    <td width="13%" bgcolor="#999999" valign="top">
	<?php include 'left.html'; ?>
	</td>
    <td width="87%">
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center">
		<form name="frm" action="" method="post" enctype="multipart/form-data">
		<table width="76%" height="147" border="0" cellpadding="0" cellspacing="0">
         
          <tr>
            <td colspan="2" align="center">
			<?php
			if($_REQUEST['delete']=='yes')
			{
			?>
			<span class="del_message">Product Successfully Delete</span><?php
			}
			?>	</td>
          </tr>
          <tr>
            <td colspan="2" align="center">Create New Product</td>
            </tr>
          <tr>
            <td width="45%">Select Category </td>
            <td width="55%">
			<select name="category_name">
			<option selected="selected">-- Select Category --</option>
			<?php
			$query2="select * from category";
			$result=mysql_query($query2);
			if(mysql_num_rows($result))
			{
			while($data=mysql_fetch_array($result))
			{
			?>
			<option value="<?php echo $data['id']; ?>"><?php echo $data['cat_name']; ?></option>
			<?php
			}
			}
			?>
			</select>			</td>
          </tr>
          <tr>
            <td>Product Name </td>
            <td><input type="text" name="product_name"></td>
          </tr>
          <tr>
            <td>Product Image </td>
            <td><input type="file" name="product_image"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>
              <input type="submit" name="btnsubmit" value="Add Product">           </td>
          </tr>
        </table>
		</form>
		</td>
      </tr>
	  
      <tr>
        <td align="center">
		
		
		<table width="76%" border="0" cellpadding="0" cellspacing="0">
                 
		  <?php
		$query2="select * from product";
		$result=mysql_query($query2);
		if(mysql_num_rows($result))
		{
		?>
		 <tr bgcolor="#999999">
            <td width="29%">Product</td>
			<td width="33%">Image</td>
            <td width="13%">Edit</td>
            <td width="25%">Delete</td>
          </tr>
		<?php
		while($data=mysql_fetch_array($result))
		{
		?>
	
          <tr bgcolor="#A8A8A8">
            <td><?php echo $data['product_name']; ?></td>
			<td><img src="<?php echo "../images/".$data['product_image']; ?>" width="80" height="67" border="1"/></td>
            <td><a href="edit_product.php?id=<?php echo $data['id']; ?>">Edit</a></td>
            <td><a href="delete.php?id=<?php echo $data['id']; ?>">Delete</a></td>
          </tr>
		  <?php
		  }
		  }
		  ?>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><?php include 'footer.html'; ?></td>
  </tr>
</table>
</body>
</html>
