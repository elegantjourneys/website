<?php
include_once(BASEPATH."class/first-class.php");
class Customer extends FirstClass
{
	
	function addNewCustomer($data)
	{
		$objMysqli = $this->setDatabaseConnection();
		$strsqlCustomer = "insert into cms_customer (first_name, last_name, email, address1, address2, city, state, zip_code, country, phone, group_id) values('".$data['first_name']."','".$data['last_name']."','".$data['email']."','".$data['address1']."','".$data['address2']."','".$data['city']."','".$data['state']."','".$data['zip_code']."','".$data['country']."','".$data['phone']."','".$data['group_id']."')";
		$resultCustomer = mysqli_query($objMysqli,$strsqlCustomer);
		
		$customerId = mysql_insert_id();
		$this->closeDBConnection($objMysqli);
		return $customerId;

	}


	function getCustomerById($customerId)
	{
		$objMysqli = $this->setDatabaseConnection();
		$strsqlCustomer = "select * from cms_customer where id=".$customerId;
		$resultCustomer = mysqli_query($objMysqli,$strsqlCustomer);
		$infoCustomer = mysqli_fetch_array($resultCustomer,MYSQLI_ASSOC);
		$this->closeDBConnection($objMysqli);
		return $infoCustomer;
	
	}

	

}
?>