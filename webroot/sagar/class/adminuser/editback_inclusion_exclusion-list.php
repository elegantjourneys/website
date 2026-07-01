<?php 
session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
validate_admin();
@extract($_REQUEST);

if(isset($_POST['submitForm']))
{

for($i=0;$i<$count;$i++)
{
$arr1 =$_POST['inc_exc_id'];
$arr2 =$_POST['set_order'];
$inc_exc_id=$arr1[$i];
$order_no=$arr2[$i];
$sql = "update $tbl_set_inclusion_exclusion set order_no=$order_no where id=$inc_exc_id";	
$obj->query($sql,$debug=1);	 
}	   			
$_SESSION['sess_msg'] = "Order Set suceesfully.";
header("Location: ".$_SERVER['HTTP_REFERER']);
exit();
}
?>