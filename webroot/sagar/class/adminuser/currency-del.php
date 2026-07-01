<?php 
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
validate_admin();
$arr =$_POST['ids'];
$Submit =$_POST['Submit'];
if(count($arr)>0){
	$str_rest_refs=implode(",",$arr);
	if($Submit=='Delete')
	{
		
		$sql="delete from $tbl_currency where id in ($str_rest_refs)"; 
		executeUpdate($sql);
		$sess_msg='Selected record(s) deleted successfully';
		$_SESSION['sess_msg']=$sess_msg;
    }
	
	}
	
else{
	$sess_msg="Please select check box";
	$_SESSION['sess_msg']=$sess_msg;
	header("Location: ".$_SERVER['HTTP_REFERER']);
	exit();
	}
	header("location: currency-list.php");
	exit();
	
?>
