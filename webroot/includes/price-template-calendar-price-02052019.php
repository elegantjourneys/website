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
</style>
<div class="pull-left">
	<div class="display_inline">
				<span style="font-style:normal; color:#333;">Choose Rooms</span>
	</div>
	<div class="border">
	<?php
		$currencyCode = $_SESSION['user_value']['selectedCurrencyCode'];
	?>
	 <select id="selectRoomType" onchange="getPriceOfTheMonth();">                         
		  <option value="1">Single</option>
		  <option value="2" selected>Double </option>
		  <option value="1">Single</option>
	  </select>
	  </div>
	 
	
</div>
<div class="pull-right">
	<div class="display_inline">
				<span style="font-style:normal; color:#333;">Choose Currency</span>
	</div>
	<div class="border">
	<?php
		$currencyCode = $_SESSION['user_value']['selectedCurrencyCode'];
	?>
	 <select id="userSelectedCurrency" name="payments" onchange="getPriceOfTheMonth();">                         
		  <option value="USD" data-image="<?=WEBROOT?>img/flags/usa.png" <?=($currencyCode=='USD')?'selected':''?>> USD</option>
		  <option value="AUD" data-image="<?=WEBROOT?>img/flags/australia.png" <?=($currencyCode=='AUD')?'selected':''?>> AUD</option>
		  <option value="EUR" data-image="<?=WEBROOT?>img/flags/euro.png" <?=($currencyCode=='EUR')?'selected':''?>> EUR</option>
		  <option value="USD" data-image="<?=WEBROOT?>img/flags/usa.png" <?=($currencyCode=='USD')?'selected':''?>> USD</option>
	  </select>
	  </div>
	 
	
</div>
<div id="priceCalendarArea">
<?php

	include_once(BASEPATH_CRM_CLASS."fare-calendar.php");
	$objFareCalendar = new FareCalendar();
	$displayInformation = $objFareCalendar->generateFareCalendar();

	echo $displayInformation['display_string'];
?>
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

			  }
		  });
		 return false;
	}

	
	function getPriceOfTheMonth()
	{
		
		selectedCurrencyCode = $('#userSelectedCurrency').val();
		roomType = $('#selectRoomType').val();
		hotelType = 7;
				
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
							}
							else
							{
								var displayString = '<span class="profitPrice">'+json[i].currency_code+' '+json[i].profit_price+' </span> <br /><strike class="discountPrice">'+json[i].currency_sign+json[i].discount_price+'</strike>';
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

	

</script>