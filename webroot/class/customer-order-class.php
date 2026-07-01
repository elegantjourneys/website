<?php
include_once(BASEPATH."class/first-class.php");
class CustomerOrder extends FirstClass
{
	
	function addNewOrder($data)
	{
		$this->setDatabaseConnection();
		$strsqlOrder = "insert into tbls_order (customer_id, enquiry_id, tour_id, tour_page_id, tour_price, currency_code, travel_date, no_of_person, hotel_type, payment_status, payment_method ) values('".$data['customer_id']."','".$data['enquiry_id']."','".$data['tour_id']."','".$data['tour_page_id']."','".$data['tour_price']."','".$data['currency_code']."','".$data['travel_date']."','".$data['no_of_person']."','".$data['hotel_type']."','".$data['payment_status']."','".$data['payment_method']."')";
		$resultOrder = mysql_query($strsqlOrder);
		
		$orderId = mysql_insert_id();
		$this->closeDBConnection();
		return $orderId;

	}

	function addOrderDetail($data)
	{
		$this->setDatabaseConnection();
		$strsqlOrderDetail = "insert into tbls_order_detail (order_id, total_adult, total_child, total_rooms, total_single_room, total_double_room, total_extra_bed_room ) values('".$data['order_id']."','".$data['total_adult']."','".$data['total_child']."','".$data['total_rooms']."','".$data['total_single_room']."','".$data['total_double_room']."','".$data['total_extra_bed_room']."')";
		$resultOrderDetail = mysql_query($strsqlOrderDetail);
		
		$orderDetailId = mysql_insert_id();
		$this->closeDBConnection();
		return $orderDetailId;

	}

	function getOrderById($orderId)
	{
		$objMysqli = $this->setDatabaseConnection();
		$strsqlOrder = "select * from tbls_order where id=".$orderId;
		$resultOrder = mysqli_query($objMysqli,$strsqlOrder);
		$infoOrder = mysqli_fetch_array($resultOrder,MYSQLI_ASSOC);
		$this->closeDBConnection($objMysqli);
		return $infoOrder;

	}

	function copyEnquiryDataToCustomer($orderId)
	{
		$orderDetail = $this->getOrderById($orderId);

		if($orderDetail['enquiry_id']==""||$orderDetail['enquiry_id']=="0")
		{
			return false;
		}
		$this->setDatabaseConnection();
		#### GETTING ENQUIRY DETAIL
		$strsqlEnquiry = "select * from tbls_enquiry where id=".$orderDetail['enquiry_id'];
		$resultEnquiry = mysql_query($strsqlEnquiry);
		$infoEnquiry = mysql_fetch_array($resultEnquiry);
		#### ADDING TO CUSTOMER DETAIL
		$strsqlCustomer = "insert into cms_customer (first_name, last_name, name, email, phone, city) values('".$infoEnquiry['first_name']."','".$infoEnquiry['last_name']."','".$infoEnquiry['name']."','".$infoEnquiry['email']."','".$infoEnquiry['phone']."','".$infoEnquiry['city']."')";
		$resultCustomer = mysql_query($strsqlCustomer);
		$customerId = mysql_insert_id();
		#### UPDATING CUSTOMER DETAIL IN ORDER TABLE
		$strsqlOrder = "update tbls_order set customer_id='".$customerId."' where id=".$orderId;
		$resultOrder = mysql_query($strsqlOrder);

		$this->closeDBConnection();
		return $customerId;
		
	}

	

}
?>