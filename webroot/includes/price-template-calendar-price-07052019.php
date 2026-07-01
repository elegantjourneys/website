<script>
   /* VARIABLE FOR PRICE CALENDAR */
   var previousMonth = '';
   var previousYear = '';
   
   var currentMonth = '';
   var currentYear = '';
   
   var nextMonth = '';
   var nextYear = '';
   
   var totalDaysOfMonth = '';
   
   var roomType='2';
   var hotelType='5';
   var selectedCurrencyCode='';
   
</script>
<style>
   /* css for calender goes here */
   .tdWeekDays{font-size;10px; font-weight:normal; color:#1C7896; border:1px solid #cccccc; font-family:Arial, Helvetica, sans-serif; height:35px; width:132px; text-align:center;}
   .tdCalenderDays{font-size;10px; font-weight:normal; color:#000000; border:1px solid #cccccc; font-family:Arial, Helvetica, sans-serif; text-align:center; width:132px; height:100px;}
   .redButtonLink{margin: 14px 4px 0 0;  padding: 7px; background-color:#B80000; color:#ffffff; min-width:120px;}
   .topContactInfo{float:right; margin-top:20px; color:#ffffff; font-size:13px; font-family: Arial,Helvetica,sans-serif;}
   .selectGrey{width:120px; border:1px solid #848383; height:20px;}
   .disabledDate{background-color:#EFEFEF}
   .profitPrice{ font-size: 14px; color: #428500;}
   .discountPrice{color: #c94a30;}
   a:hover,a:focus{
   text-decoration: none;
   outline: none;
   }
   .calender-tab{ display: inherit;margin: 30px 0; }
   .calender-tab .nav-tabs{
   display: table-cell;
   border: none;
   position: relative;
   }
   .select-holder {
   background: #efefef;
   padding: 10px 15px 20px;
   border-radius: 4px;
   }
   .calender-tab .nav-tabs li{
   float: none;
   width: 100%;
   padding: 0 2px;
   }
   .calender-tab .nav-tabs li a{
   display: block;
   padding: 10px 18px;
   margin: 0;
   font-size: 14px;
   font-weight: 600;
   color: #505050;
   text-transform: capitalize;
   text-align: left;
   border-radius: 0;
   border: none;
   overflow: hidden;
   z-index: 1;
   position: relative;
   transition: all 0.3s ease 0s;
   background:rgba(241, 241, 241, 0.8);
   width:200px;
   }
   .jcf-select.jcf-select-filter-select
   {
   background: #fff;
   }
   .jcf-select.jcf-select-filter-select .jcf-select-opener:after{
   color:#000;
   }
   .calender-tab .nav-tabs li a:hover,
   .calender-tab .nav-tabs li.active a{
   color: #fff;
   background: transparent;
   border: none;
   }
   .calender-tab .nav-tabs li a:before,
   .calender-tab .nav-tabs li a:after{
   content: "";
   width: 100%;
   height: 100% ;
   background: #03a9f4;
   position: absolute;
   top: 0;
   left: 100%;
   z-index: -1;
   transition: all 0.3s ease 0s;
   }
   .calender-tab .nav-tabs li a:after{
   width: 5px;
   background: #03A9F4;
   /*left: 97%;*/
   }
   .calender-tab .nav-tabs li.active a:before,
   .calender-tab .nav-tabs li a:hover:before,
   .calender-tab .nav-tabs li.active a:after,
   .calender-tab .nav-tabs li a:hover:after{ left: 0; }
   .calender-tab .tab-content{
   display: table-cell;
   padding: 0px 25px 0 0;
   font-size: 15px;
   color: #505050;
   line-height: 24px;
   letter-spacing: 1px;
   text-align: justify;
   vertical-align: top;
   position: relative;
   }
   .calender-tab .nav-tabs > li
   {
   display: inline-flex;
   top: 38px;
   }
   .calender-tab .tab-content h3{
   font-size: 24px;
   color: #505050;
   margin: 0 0 5px 0;
   }
   @media only screen and (max-width: 479px){
   .calender-tab .nav-tabs {
   display: block;
   width: 100%;
   border-right: none;
   }
   .calender-tab .nav-tabs li{ margin-bottom: 10px; }
   .calender-tab .nav-tabs li a { padding: 10px; }
   .calender-tab .nav-tabs li a:before{
   top: 100%;
   left: 0;
   }
   .calender-tab .nav-tabs li a:after{
   width: 100%;
   height: 4px;
   top: 90%;
   left: 0;
   }
   .calender-tab .nav-tabs li.active a:before,
   .calender-tab .nav-tabs li a:hover:before,
   .calender-tab .nav-tabs li.active a:after,
   .calender-tab .nav-tabs li a:hover:after{ top: 0; }
   .calender-tab .tab-content {
   display: block;
   padding: 20px 15px 5px;
   }
   .calender-tab .tab-content h3{ font-size: 18px; }
   }
   .star-rating{
   color:#FF4500;
   }
   .jcf-select-text img {
   margin: 8px 0!important;
   }

   @media(max-width:812px){
	.calender_price {
		width: 100%!important;
		margin-bottom: 1.5rem!important;
		border-collapse: collapse;
		table-layout: fixed!important;
		background-color: #ffffff;
	}
	.tdWeekDays{
		width:100%;
	}
	.tdCalenderDays{
		width:100%;
	}
	.calender_prev{
		width:100%!important;
		padding-left:50px!important;
	}
	.tdCalenderDaystr{
		width:100%!important;
	}
	.tdCalenderDaystd{
		text-align:center!important;
	}
	.tdCalenderDaystdtr{
		height:30px!important;
	}
	.calender-tab .tab-content{
	display: table-row!important;
	}
	.calender-tab .nav-tabs > li{
		top: 14px!important;
	}
	.calender-tab .nav-tabs li a{
	width:100%!important;
	}
	.calender-tab .nav-tabs{
	display:inline-table!important;
	}
	}
@media(max-width:414px){
.calender-tab .nav-tabs > li {
    top: -10px!important;
}
.calender-tab .nav-tabs li {
    margin-bottom: 0;
}
.calender_prevt{
	font-size:12px!important;
}
.currentYearct
{
	padding: 0px 15px!important;
}
}
.jcf-select-drop.jcf-select-filter-select .jcf-option {
    padding-left: 15px;
    color: #333!important;
}
.jcf-select-drop.jcf-select-filter-select .jcf-option.jcf-hover {
    background: #fff!important;
}	
.jcf-select-drop.jcf-select-filter-select .jcf-list {
    background: #f3f3f3;
}
</style>
<?php
	$lowestPriceData = array(
								"lowest_price_id"		=>		$lowestPriceId,
								"tour_page_id"			=>		$tourPageId
					);
	$lowestPriceDetail = $objCMSTourPrice->getLowestPriceDetail($lowestPriceData);
	$calendarHotelType = $lowestPriceDetail['hotel_type_id'];
	$calendarRoomType = $lowestPriceDetail['room_type'];
	$calendarPriceYear = $lowestPriceDetail['price_year'];
	$calendarPriceMonth = $lowestPriceDetail['price_month'];
?>
   <div class="layout-holder">
     
      <div class="select-holder">
         <div class="filter-slide">
            <div class="row">
               <div class="col-md-3">
                  <p style="line-height: 1.3;letter-spacing: -0.4px;text-align: left;color: #a1a1a1;">Select Hotels</p>
                  <select class="filter-select" id="selectHotelType" onchange="getPriceOfTheMonth();">
					 <option value="">Select Hotel</option>
					<?php
						foreach($hotelSelectionList as $hotelSelection)
						{
					?>
                     <option value="<?=$hotelSelection['id']?>" <?=($calendarHotelType==$hotelSelection['id'])?'selected':''?>><?=$hotelSelection['alias']?></option>
					<?php
						}
					?>
                     
                  </select>
               </div>
               <div class="col-md-3">
                  <p style="line-height: 1.3;letter-spacing: -0.4px;text-align: left;color: #a1a1a1;">Choose Room</p>
                  <select class="filter-select" id="selectRoomType" onchange="getPriceOfTheMonth();">
					 <option value="">Select Room</option>
                     <option value="2" <?=($calendarRoomType=='2')?'selected':''?>>Double</option>
                     <option value="1" <?=($calendarRoomType=='1')?'selected':''?>>Single</option>
                  </select>
               </div>
               <div class="col-md-3">
                  <p style="line-height: 1.3;letter-spacing: -0.4px;text-align: left;color: #a1a1a1;">Choose Month</p>
                  <select class="filter-select jcf-hidden" onchange="selectMonthCalendarTop();" id="selectPriceMonthTop">
					 <option value="">Select Month</option>
					 <?php
						for($countSelection=0;$countSelection<24;$countSelection++)
						{
							$currentSelectionMonth = date("F Y",strtotime('+ '.$countSelection.' month', time()));
							$selectionMonth = date("m",strtotime('+ '.$countSelection.' month', time()));
							$selectionYear = date("Y",strtotime('+ '.$countSelection.' month', time()));
							$selectedMonth = '';

							if(($calendarPriceYear==$selectionYear)&&($selectionMonth==$calendarPriceMonth))
							{
								$selectedMonth = 'selected';
							}
					 ?>
                     <option value="<?=$selectionMonth?>####<?=$selectionYear?>" <?=$selectedMonth?>><?=$currentSelectionMonth?></option>
                     <?php
						}
					 ?>
                  </select>
               </div>
               <div class="col-md-3">
                  <p style="line-height: 1.3;letter-spacing: -0.4px;text-align: left;color: #a1a1a1;">Select Category</p>
                  <select class="filter-select" id="userSelectedCurrency" name="payments" onchange="getPriceOfTheMonth();">
                     <option value="USD" style="margin:8px 0;" data-image="<?=WEBROOT?>img/flags/usa.png" <?=($currencyCode=='USD')?'selected':''?>> USD</option>
                     <option value="AUD" data-image="<?=WEBROOT?>img/flags/australia.png" <?=($currencyCode=='AUD')?'selected':''?>> AUD</option>
                     <option value="EUR" data-image="<?=WEBROOT?>img/flags/euro.png" <?=($currencyCode=='EUR')?'selected':''?>> EUR</option>
                     <option value="USD" data-image="<?=WEBROOT?>img/flags/usa.png" <?=($currencyCode=='USD')?'selected':''?>> USD</option>
                  </select>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="calender-tab" role="tabpanel">
			<div class="tableresponsive">
            <div id="priceCalendarArea">
               <?php
                  include_once(BASEPATH_CRM_CLASS."fare-calendar.php");
                  $objFareCalendar = new FareCalendar();
                  $displayInformation = $objFareCalendar->generateFareCalendar($calendarPriceMonth, $calendarPriceYears);
                  echo $displayInformation['display_string'];
               ?>
            </div>
   </div>


<script>
	previousMonth = '<?=$displayInformation['previous_month']?>';
	previousYear = '<?=$displayInformation['previous_year']?>';

	currentMonth = '<?=$displayInformation['current_month']?>';
	currentYear = '<?=$displayInformation['current_year']?>';

	nextMonth = '<?=$displayInformation['next_month']?>';
	nextYear = '<?=$displayInformation['next_year']?>';

	totalDaysOfMonth = '<?=$displayInformation['total_days']?>';

	

	function getMonthCalendar(month, year)
	{
		$.ajax({
			  url: '<?=WEBROOT?>ajax/jquery-cost.php',
			  type: 'post',
			  data: {method:'getMonthCalendar', month:month, year:year },
			  dataType: 'json',
			  success: function(json) 
			  {
					$('#priceCalendarArea').html(json.display_string);

					previousMonth = json.previous_month;
					previousYear = json.previous_year;

					currentMonth = json.current_month;
					currentYear = json.current_year;

					nextMonth = json.next_month;
					nextYear = json.next_year;

					totalDaysOfMonth = json.total_days;
					
					getPriceOfTheMonth();
					
					assignedTopMonthValue();
			  }
		  });
		 return false;
	}

	function assignedTopMonthValue()
	{
		$('#selectPriceMonthTop').val(currentMonth+'####'+currentYear);
		
		var monthName = getMonthText(currentMonth);
		var selectHtml = '<span class="jcf-select jcf-unselectable jcf-select-filter-select jcf-select-jcf-hidden"><span class="jcf-select-text"><span class="">'+monthName+' '+currentYear+'</span></span><span class="jcf-select-opener"></span></span>';
		$('#selectPriceMonthTop').next().html(selectHtml);

	}

	function getMonthText(month)
	{
		var monthName = '';
		
		switch(month)
		{
			case '1':
			case '01':
					 monthName = 'January';
				break
			case '2':
			case '02':
					monthName = 'February';
				break;
			case '3':
			case '03':
					monthName = 'March';
				break;
			case '4':
			case '04':
					monthName = 'April';
				break;
			case '5':
			case '05':
					monthName = 'May';
				break;
			case '6':
			case '06':
					monthName = 'June';
				break;
			case '7':
			case '07':
					monthName = 'July';
				break;
			case '8':
			case '08':
					monthName = 'August';
				break;
			case '9':
			case '09':
					monthName = 'September';
				break;
			case '10':
					monthName = 'October';
				break;
			case '11':
					monthName = 'November';
				break;
			case '12':
					monthName = 'December';
				break;
		}

		return monthName;

	}

	
	function getPriceOfTheMonth()
	{
		
		selectedCurrencyCode = $('#userSelectedCurrency').val();
		roomType = $('#selectRoomType').val();
		hotelType = $('#selectHotelType').val();
		
		

		$.ajax({
			  url: '<?=WEBROOT?>ajax/jquery-cost.php',
			  type: 'post',
			  data: {method:'getCustomTourPriceByHotel', event_tax:'<?=$tourPriceParameters['event_tax']?>',vehicle_tax:'<?=$tourPriceParameters['vehicle_tax']?>',vehicleId:'<?=$tourPriceParameters['vehicle_id']?>',tourId:'<?=$tourDetailId?>', noOfPerson:roomType ,mislaneous_cost_price:'<?=$tourPriceParameters['mislaneous_cost_price']?>',profit:'<?=$tourPriceParameters['profit']?>', discount:'<?=$tourPriceParameters['discount']?>',selectedCurrencyCode:selectedCurrencyCode, tourPageId:'<?=$tourPageId?>',hotel_type_id:hotelType, current_month:currentMonth, current_year:currentYear, total_days:totalDaysOfMonth, room_type:roomType},
			  dataType: 'json',
			  success: function(json) 
			  {
					for(var i=0;i<json.length;i++)  				 
					{
						if(json[i].block_date_exception=='y'||json[i].price_exception=='y')
						{
							
							var displayString = '<span><a href="#tourBookingForms">Request Price</a></span>';
						}
						else
						{
							if(json[i].currency_sign+json[i].profit_price==json[i].currency_sign+json[i].discount_price)
							{
								var displayString = '<span class="profitPrice">'+json[i].currency_code+' '+json[i].discount_price+'</span>';

								displayString = displayString+'<a href="#" class="bookbtn"  style="padding: 3px 8px;font-size:10px;border-radius:5px;background:#cf3720;color:#fff;position:relative;float: right;top: 10px;" onclick="requestBooking('+json[i].current_day+',\''+json[i].discount_price+'\'); return false;">Book</a>';
							}
							else
							{
								var displayString = '<span class="profitPrice">'+json[i].currency_code+' '+json[i].profit_price+' </span> <br /><strike class="discountPrice">'+json[i].currency_sign+json[i].discount_price+'</strike>';

								displayString = displayString+'<a href="#" class="bookbtn"    style="padding: 3px 8px;font-size:10px;border-radius:5px;background:#cf3720;color:#fff;position:relative;float: right;top: 10px;"  onclick="requestBooking('+json[i].current_day+',\''+json[i].discount_price+'\',\''+json[i].profit_price+'\'); return false;">Book</a>';
							}
							
						}
						$('#priceDay'+json[i].current_day).html(displayString);

						
					}

			  }
		  });
	}

	function selectMonthCalendar()
	{
		var selectedValue = $('#selectPriceMonth').val();
		var filterSelection = selectedValue.split('####');
		var month = filterSelection[0];
		var year = filterSelection[1];

		getMonthCalendar(month, year);
	}

	function selectMonthCalendarTop()
	{
		var selectedValue = $('#selectPriceMonthTop').val();
		var filterSelection = selectedValue.split('####');
		var month = filterSelection[0];
		var year = filterSelection[1];

		getMonthCalendar(month, year);
	}


	function requestBooking(selectedDay, tourPrice, offerPrice=0)
	{
		var hotelLevel = $('#selectHotelType').val();
		var roomType = $('#selectRoomType').val();
		var currencyCode = $('#userSelectedCurrency').val();
		var selectedDateRange = $('#selectPriceMonthTop').val();
		var tourId = '<?=$tourDetailId?>';
		var tourPageId = '<?=$tourPageId?>';
		var pageUrl = '<?=$objCMSTourPrice->getPageUrl()?>';

		$.ajax({
			  url: '<?=WEBROOT?>ajax/jquery-booking.php',
			  type: 'post',
			  data: {method:'initiateBooking', hotel_level:hotelLevel,room_type:roomType,currency_code:currencyCode,date_range:selectedDateRange, tour_id:tourId, tour_page_id:tourPageId,page_url:pageUrl, tour_day:selectedDay, offerPrice, tourPrice, step:'intiate' },
			  dataType: 'json',
			  success: function(json) 
			  {
					if(json.result=='success')
					{
						window.location=json.redirect_url;
					}
			  }
		  });
		
	}

	

</script>