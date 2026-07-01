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
   .calender-tab{ display: table;margin: 30px 0; }
   .calender-tab .nav-tabs{
   display: table-cell;
   border: none;
   position: relative;
   }
   .select-holder {
   background: #f3f3f3;
   padding: 10px 15px 18px;
   }
   .calender-tab .nav-tabs li{
   float: none;
   width: 100%;
   padding: 0;
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
   color: #505050;
   background: transparent;
   border: none;
   }
   .calender-tab .nav-tabs li a:before,
   .calender-tab .nav-tabs li a:after{
   content: "";
   width: 100%;
   height: 100% ;
   background: #efefef;
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
</style>
<!--div class="pull-left">
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
    
   
   </div-->
<!--div class="pull-right">
   <div class="display_inline">
   			<span style="font-style:normal; color:#333;">Choose Currency12</span>
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
    
   
   </div-->
<div class="row">
   <div class="layout-holder">
      <!--<div class="layout-action">
         <a href="#" class="link link-list active"><span class="icon-list"></span></a>
         <a href="#" class="link link-grid"><span class="icon-grid"></span></a>
         </div>-->
      <div class="select-holder">
         <div class="filter-slide">
            <div class="row">
               <div class="col-md-3">
                  <p style="color:#333;">Select Hotels</p>
                  <select class="filter-select">
                     <option value="0">Luxury Room</option>
                     <option value="deluxe">Deluxe Room</option>
                  </select>
               </div>
               <div class="col-md-3">
                  <p style="color:#333;">Choose Room</p>
                  <select class="filter-select">
                     <option value="0">Double</option>
                     <option value="single">Single</option>
                  </select>
               </div>
               <div class="col-md-3">
                  <p style="color:#333;">Choose Month</p>
                  <select class="filter-select jcf-hidden" onchange="filterResult();" id="travelDaysFilter">
                     <option value="0">March 2019</option>
                     <option value="1">April 2019</option>
                  </select>
               </div>
               <div class="col-md-3">
                  <p style="color:#333;">Select Category</p>
                  <select class="filter-select id="userSelectedCurrency" name="payments" onchange="getPriceOfTheMonth();">
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
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
         <li role="presentation" class="active">
            <a href="#room1" aria-controls="home" role="tab" data-toggle="tab">
               Standard Room
               <div class="star-rating">
                  <span><span class="icon-star"></span></span>
                  <span><span class="icon-star"></span></span>
                  <span><span class="icon-star"></span></span>
                  <span><span class="icon-star"></span></span>
                  <span class="disable"><span class="icon-star"></span></span>
               </div>
            </a>
         </li>
         <li role="presentation">
            <a href="#room2" aria-controls="profile" role="tab" data-toggle="tab">
               Standard Room
               <div class="star-rating">
                  <span><span class="icon-star"></span></span>
                  <span><span class="icon-star"></span></span>
                  <span><span class="icon-star"></span></span>
                  <span><span class="icon-star"></span></span>
                  <span class="disable"><span class="icon-star"></span></span>
               </div>
            </a>
         </li>
         <li role="presentation">
            <a href="#room3" aria-controls="messages" role="tab" data-toggle="tab">
               Standard Room
               <div class="star-rating">
                  <span><span class="icon-star"></span></span>
                  <span><span class="icon-star"></span></span>
                  <span><span class="icon-star"></span></span>
                  <span><span class="icon-star"></span></span>
                  <span class="disable"><span class="icon-star"></span></span>
               </div>
            </a>
         </li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content tabs">
         <div role="tabpanel" class="tab-pane fade in active" id="room1">
            <div id="priceCalendarArea">
               <?php
                  include_once(BASEPATH_CRM_CLASS."fare-calendar.php");
                  $objFareCalendar = new FareCalendar();
                  $displayInformation = $objFareCalendar->generateFareCalendar();
                  
                  echo $displayInformation['display_string'];
                  ?>
            </div>
         </div>
         <div role="tabpanel" class="tab-pane fade" id="room2">
            <div id="priceCalendarArea">
               <?php
                  include_once(BASEPATH_CRM_CLASS."fare-calendar.php");
                  $objFareCalendar = new FareCalendar();
                  $displayInformation = $objFareCalendar->generateFareCalendar();
                  
                  echo $displayInformation['display_string'];
                  ?>
            </div>
         </div>
         <div role="tabpanel" class="tab-pane fade" id="room3">
            <div id="priceCalendarArea">
               <?php
                  include_once(BASEPATH_CRM_CLASS."fare-calendar.php");
                  $objFareCalendar = new FareCalendar();
                  $displayInformation = $objFareCalendar->generateFareCalendar();
                  
                  echo $displayInformation['display_string'];
                  ?>
            </div>
         </div>
      </div>
   </div>
</div>
<!--div id="priceCalendarArea">
   <?php
      /* include_once(BASEPATH_CRM_CLASS."fare-calendar.php");
      $objFareCalendar = new FareCalendar();
      $displayInformation = $objFareCalendar->generateFareCalendar();
      
      echo $displayInformation['display_string']; */
      ?>
</div-->
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
   			
   	$.ajax({
   		  url: '<?=WEBROOT?>ajax/jquery-cost.php',
   		  type: 'post',
   		  data: {method:'getCustomTourPriceByHotel', event_tax:'<?=$tourPriceParameters['event_tax']?>',vehicle_tax:'<?=$tourPriceParameters['vehicle_tax']?>',vehicleId:'<?=$tourPriceParameters['vehicle_id']?>',tourId:'<?=$tourDetailId?>', noOfPerson:roomType ,mislaneous_cost_price:'<?=$tourPriceParameters['mislaneous_cost_price']?>',profit:'<?=$tourPriceParameters['profit']?>', discount:'<?=$tourPriceParameters['discount']?>',selectedCurrencyCode:selectedCurrencyCode, tourPageId:'<?=$tourPageId?>',hotel_type_id:hotelType, current_month:currentMonth, current_year:currentYear, total_days:totalDaysOfMonth, room_type:roomType},
   		  dataType: 'json',
   		  success: function(json) 
   		  {
   				for(var i=0;i<json.length;i++)  				 
   				{
   					if(json[i].block_date_exception=='y')
   					{
   						/*var displayString = '<span class="profitPrice">'+json[i].currency_code+' '+json[i].currency_sign+json[i].profit_price+' </span> <br /><strike class="discountPrice">'+json[i].currency_sign+json[i].discount_price+'</strike>';*/
   						var displayString = '<span><a href="#tourBookingForms">Request Price</a></span>';
   					}
   					else if(json[i].price_exception=='y')
   					{
   						var displayString = '<span class="profitPrice">'+json[i].currency_code+' '+json[i].currency_sign+json[i].profit_price+' </span> <br /><strike class="discountPrice">'+json[i].currency_sign+json[i].discount_price+'</strike>';
   						//var displayString = '<span><a href="#tourBookingForms">Request Price</a></span>';
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