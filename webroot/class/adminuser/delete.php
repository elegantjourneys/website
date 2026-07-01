<?php
include '../include/database.php';
$id=$_REQUEST['id'];
$page=$_REQUEST['page'];
if($page=='category')
{
$del_category="delete from category where id=$id";
mysql_query($del_category);
header('Location:category.php?delete=yes');
}
else
{
$del_product="delete from product where id=$id";
mysql_query($del_product);
header('Location:product.php?delete=yes');
}

?>