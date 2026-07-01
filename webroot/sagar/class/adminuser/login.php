<?php
require_once("../lib/config.php");
require_once("../lib/variable.php");
@extract($_POST);
session_register("sess_msg");
if($logged == "yes"){
	$sql = "select * from $tbl_admin where username='$username' and password='$password'";
	$rs = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($rs) > 0){
		$rc = mysql_fetch_array($rs);
		session_register("sess_admin_id");
		session_register("sess_username");
		$_SESSION['sess_admin_id'] = $rc['id'];
		$_SESSION['sess_username'] = strtoupper($rc['username']);
		header("Location: admin-home.php");
		die();
	}
	$_SESSION['sess_msg'] = 'Invalid Username/Password';
	header("Location: index.php");
}
?>