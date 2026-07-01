<?php
	include_once("../includes/config.php");
	include_once(BASEPATH_CLASS."first-class.php");
	$objFirstClass = new FirstClass();
	$objFirstClass->verifyUserRequest();
	$requestName = $_POST['method'];

	switch($requestName)
	{
		case 'getHotelRoomInformation':
				include_once(BASEPATH_CRM_CLASS."cms-hotel-class.php");
				include_once(BASEPATH_CRM_CLASS."cms-hotel-room-class.php");

				$objCMSHotel = new CMSHotel();
				$objCMSRoomHotel = new CMSRoomHotel();

				$hotelRoomIds = $_POST['roomIds'];
				$hotelRoomList = array();
				foreach($hotelRoomIds as $hotelRoomId)
				{
					$arrHotelInfo = explode('####',$hotelRoomId);
					$hotelName = $objCMSHotel->getHotelsNameById($arrHotelInfo['0']);

					$roomData = array(
											"room_id"	=>		$arrHotelInfo['1']
								);
					$roomName = $objCMSRoomHotel->getRoomNameById($roomData);
					$hotelRoomList[] = array(
												"hotel_id"		=>		$arrHotelInfo['0'],
												"room_id"		=>		$arrHotelInfo['1'],
												"hotel_name"	=>		$hotelName,
												"room_name"		=>		$roomName,
												"row_id"		=>		$arrHotelInfo['2']
									);
				}
				echo json_encode($hotelRoomList);
			break;

	};