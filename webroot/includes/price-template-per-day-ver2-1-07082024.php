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
   .profitPrice{ font-size: 15px; color: #428500; font-weight:500;}
   .discountPrice{color: #c94a30; font-size:14px;}
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
   @media(max-width:375px){
	.calender_prev{
		padding-left:0!important;
	}	   
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
		padding-left:50px;
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
		background: #9c9b9b!important;
	}	
	.jcf-select-drop.jcf-select-filter-select .jcf-list {
		background: #f3f3f3;
	}

	.buttonOrangeBorder{
			border: 2px solid #f0bd79 !important;

		}

	.requestPrice{
			min-width:180px;
	}

	.font16px
	{
		font-size:16px !important;
	}

	.blackFont
	{
		color:#000000;
	}

	.blink_me {
	  animation: blinker 1s linear infinite;
	}

	@keyframes blinker {
	  50% {
		opacity: 0;
	  }
	}

	.lightGreenBG{ 
			background-color:#dae9cc;
			
			margin-bottom:3px !important;
	}

	.bold6{
		font-weight:600 !important;
	}

	.noBorder{
		border:none !important;
	}

	

	.btnBlueBorder{
		
		border: 2px solid #07c !important;
	}

	.btnBlackBorder:hover{
		
		border: 2px solid #5c5e62 !important;
		color: #5c5e62 !important;
		background-color:#DAE9CC !important;
	}

	.btnBlackBorder{
		
		border: 2px solid #ffffff !important;
		background-color:#589642 !important;
		color: #ffffff !important;
	}

	

	.redBtn{ 
		padding: 10px 21px !important;
		margin: 2px 0px 10px !important;
		color:#fff !important;
		background:#b00 !important;
		border: 2px solid #ab0101 !important;
		
	}

	.sellBadge {
		background: #e68472;
		color: #fff;
		border-radius: 3px;
		padding: 4px 8px;
		margin: 0 0 10px 0;
		font-size: 12px;
		line-height: 18px;
		font-weight: 400;
		margin-left:4px;
	}

	/*.btnBlueBorder{}*/


	/*media Quriy for 7-day-golden-triangle-relax-gt-29*/
	
@media only screen and (max-width: 999px){
	.desktopHand{display:none}
}

@media only screen and (max-width: 1024px){
	.redBtn {
	    padding: 10px 3px !important;
		margin: 2px 0px 0px !important;
	}
}



@media only screen and (max-width: 834px){.htl-nm{float: none!important;
width: 100%;
font-size: 28px!important;font-weight: 100!important;

text-align: center!important;}}
@media only screen and (max-width: 834px){.ht-price {
    float:none!important;text-align: center!important;
}}


@media only screen and (max-width: 834px){.profitPrice2 {

    font-size: 24px!important;

}}
@media only screen and (max-width: 834px){.font16px {

 font-size: 20px !important;
}}
@media only screen and (max-width: 834px){.sellBadge {
    padding: 2px 6px!important;
    font-size: 14px!important;
    line-height: 18px!important;
    margin-left: 6px!important;
}}
@media only screen and (max-width: 834px){.redBtn{margin-left: 250px !important;}}
@media only screen and (max-width: 834px){.btnBlackBorder{margin-left: 270px !important;}}	

@media only screen and (max-width: 768px){.htl-nm{float: none!important;
width: 100%;
font-size: 28px!important;font-weight: 100!important;

text-align: center!important;}}
@media only screen and (max-width: 768px){.ht-price {
    float:none!important;text-align: center!important;
}}


@media only screen and (max-width: 768px){.profitPrice2 {

    font-size: 24px!important;

}}
@media only screen and (max-width: 768px){.font16px {

 font-size: 20px !important;
}}
@media only screen and (max-width: 768px){.sellBadge {
    padding: 2px 6px!important;
    font-size: 14px!important;
    line-height: 18px!important;
    margin-left: 6px!important;
}}
@media only screen and (max-width: 768px){.redBtn{margin-left: 270px !important; padding: 10px 21px !important; }}
@media only screen and (max-width: 768px){.btnBlackBorder{margin-left: 270px !important;}}

@media only screen and (max-width: 414px){.htl-nm{float: none!important;
/*width: 100%;*/
font-size: 16px!important;font-weight: 500!important;

text-align: center!important;}}
@media only screen and (max-width: 414x){.ht-price {
    float:none!important;text-align: center!important;
}}


@media only screen and (max-width: 414px){.profitPrice2 {

    font-size: 16px!important;

}}
@media only screen and (max-width: 414px){.font16px {

 font-size: 16px !important;
}}
@media only screen and (max-width: 414px){.sellBadge {
    padding: 2px 6px!important;
    font-size: 14px!important;
    line-height: 18px!important;
    margin-left: 6px!important;
}}
@media only screen and (max-width: 414px){.redBtn{margin-left:100px !important;}}
@media only screen and (max-width: 414px){.btnBlackBorder{margin-left: 100px !important;}}

@media only screen and (max-width: 320px){.htl-nm{float: none!important;
width: 100%;
font-size: 14px!important;font-weight: 100!important;

text-align: center!important;}}
@media only screen and (max-width: 320x){.ht-price {
    float:none!important;text-align: center!important;
}}


@media only screen and (max-width: 320px){.profitPrice2 {

    font-size: 14px!important;

}}
@media only screen and (max-width: 320px){.font16px {

 font-size: 12px !important;
}}
@media only screen and (max-width: 320px){.sellBadge {
    padding: 2px 6px!important;
    font-size: 14px!important;
    line-height: 18px!important;
    margin-left: 6px!important;
}}
@media only screen and (max-width: 320px){.redBtn{margin-left:70px !important;}}
@media only screen and (max-width: 320px){.btnBlackBorder{margin-left: 70px !important;}}

.font12px{ font-size:11px !important; }
</style>
<?php


	$lowestPriceData = array(
								"lowest_price_id"		=>		$lowestPriceId,
								"tour_page_id"			=>		$tourPageId
					);
	
	$lowestPriceDetail = $objCMSTourPrice->getLowestPriceDetail($lowestPriceData);

	if($lowestPriceDetail['lowest_price_day']!=""&&$lowestPriceDetail['price_month']!=""&&$lowestPriceDetail['price_year']!="")
	{
		$lowestPriceDate = date("d F Y",strtotime($lowestPriceDetail['lowest_price_day'].'-'.$lowestPriceDetail['price_month'].'-'.$lowestPriceDetail['price_year']));
	}
	else
	{
		$lowestPriceDate = date("d F Y",time());
	}
		
	$calendarHotelType = $lowestPriceDetail['hotel_type_id'];
	$calendarRoomType = $lowestPriceDetail['room_type'];
	$calendarPriceYear = $lowestPriceDetail['price_year'];
	$calendarPriceMonth = $lowestPriceDetail['price_month'];
?>
    
  <div class="layout-holder">
     
      <div class="select-holder2">
         <div class="filter-slide">
            <div class="row">
            
             <div class="hd-bg-colr brd-btm">

			 

			     <div class="col-md-1">
                    <p style="line-height: 1.3;letter-spacing: -0.4px;text-align: left; font-weight:600;" class="blackFont desktopHand">&nbsp;</p>
                    <p style="line-height: 1.3;letter-spacing: -0.4px;text-align: right; font-weight:600;" class="blackFont blink_me desktopHand"><i class="fa fa-hand-o-right fa-4x" aria-hidden="true"></i></p>

				</div>
			   
              
             
                
            <div class="col-md-9">
                  <p style="line-height: 1.3;letter-spacing: -0.4px;text-align: left;" class="blackFont">Select Currency</p>
                  <select class="filter-select" id="userSelectedCurrency" name="payments" onchange="displayDayPrice();">
                     <option value="USD" style="margin:8px 0;" data-image="<?=WEBROOT?>img/flags/usa.png" <?=($currencyCode=='USD')?'selected':''?>> USD</option>
					 <option value="AED" data-image="<?=WEBROOT?>img/flags/aed.png" <?=($currencyCode=='AED')?'selected':''?>> AED</option>
                     <option value="AUD" data-image="<?=WEBROOT?>img/flags/australia.png" <?=($currencyCode=='AUD')?'selected':''?>> AUD</option>
					 <option value="CAD" data-image="<?=WEBROOT?>img/flags/cad.png" <?=($currencyCode=='CAD')?'selected':''?>> CAD</option>
                     <option value="EUR" data-image="<?=WEBROOT?>img/flags/euro.png" <?=($currencyCode=='EUR')?'selected':''?>> EUR</option>
					 <option value="GBP" data-image="<?=WEBROOT?>img/flags/uk.png" <?=($currencyCode=='GBP')?'selected':''?>> GBP</option>
					 <option value="INR" data-image="<?=WEBROOT?>img/flags/inr.png" <?=($currencyCode=='INR')?'selected':''?>> INR</option>
                     <option value="USD" data-image="<?=WEBROOT?>img/flags/usa.png" <?=($currencyCode=='USD')?'selected':''?>> USD</option>
					 
                  </select>
               </div>
               
               
              <div class="col-md-2">
                 <!--<p style="line-height: 1.3;letter-spacing: -0.4px;">&nbsp;</p>
                 <button type="submit" class="btn redBtn" onclick="displayDayPrice();">CALCULATE PRICE </button> --> 
                   
               </div>
               
               <div class="col-md-12"><div class="spac-lin"></div></div>  
            </div>
            
           
           <!-- second row-->
				<div id="tourDayPriceRow" class="div-table">
						<div style="text-align:center;"><img src="<?=WEBROOT?>/images/please-wait-loading.gif"></div>
            
           
               </div>
               
            </div>
         </div>
      </div>
   </div>


<script>
	 
	 var totalRequest = 1;
	 function assigneDateChage()
	 {
		 
		$("#enquiryTravelDate1").change(function()
		{ 
			   displayDayPrice();
		}); 
	 }
	 
	function displayDayPrice()
	{
		
		if(totalRequest == 1)
		{
			assigneDateChage();
			totalRequest = 2;
		}
		
		$('#tourDayPriceRow').html('<div style="text-align:center;"><img src="<?=WEBROOT?>/images/please-wait-loading.gif"></div>');
		var selectedCurrencyCode = $('#userSelectedCurrency').val();
		
		var room1 = '2####0####0';
		var  roomType = $('#selectRoomType').val();
		//var tourStartDate = $('#enquiryTravelDate1').val();
		var tourStartDate = '1-May-2025';

		if(roomType=='1')
		{
			room1 = '1####0####0';
		}

		$('#priceCalculatorCurrency').html('');
	
		$.ajax({
			  url: '<?=WEBROOT?>ajax/jquery-cost.php',
			  type: 'post',
			  data: {method:'getCustomTourPriceOfDayByHotel_test',tour_id:'<?=$tourDetailId?>' , tour_start_date:tourStartDate, vehicle_id:'<?=$tourPriceParameters['vehicle_id']?>',event_tax:'<?=$tourPriceParameters['event_tax']?>',vehicle_tax:'<?=$tourPriceParameters['vehicle_tax']?>',mislaneous_cost_price:'<?=$tourPriceParameters['mislaneous_cost_price']?>',tour_page_id:'<?=$tourPageId?>',selected_currency_code:selectedCurrencyCode, room1:room1,category_id:'<?=$tourPriceParameters['category_id']?>',},
			  dataType: 'json',
			  success: function(json)
			  {
					var displayString = '';
					displayString = displayString + '<div class="brd-btm lightGreenBG noBorder div-table-row">';
					displayString = displayString + '<div class="col-md-4 div-table-col">&nbsp;';
					displayString = displayString + '<span style="font-weight:normal; color:#5c5e62; font-size:12px;">Per Person (Double/Twin)</span>';
					displayString = displayString + '</div>';

					displayString = displayString + '<div class="col-md-4 div-table-col" style="font-weight:bold;">';
					displayString = displayString + 'High Season Price';
					displayString = displayString + '</div>';

					displayString = displayString + '<div class="col-md-4 div-table-col" style="font-weight:bold;">';
					displayString = displayString + 'Low season Price';
					displayString = displayString + '</div>';

					displayString = displayString + '</div>';
					
					for(var i=0; i<json['best_price'].length; i++)
					{
						  displayString = displayString + ' <div class="brd-btm lightGreenBG noBorder div-table-row">';

						  displayString = displayString + '<div class="col-md-4 div-table-col">';
						  displayString = displayString + '<div class="htl-nm">';
						  displayString = displayString + json['best_price'][i]['hotel_type_alias'];
						  displayString = displayString + '<br>';
						  displayString = displayString + '<span class="star-rating font12px">';
						  /* CALCULATING RATING */
						  var halfRating = 0;
						  var hotelRating = parseFloat(json['best_price'][i]['hotel_rating']);
						  var fullStarRating = Math.floor(hotelRating);

						  if(hotelRating>fullStarRating)
						  {
							halfRating = hotelRating-fullStarRating;
						  }

						  for(j=1;j<=hotelRating; j++)
						  {
							displayString = displayString + '<i class="fa fa-star" aria-hidden="true"></i>';
						  }

						  if(halfRating>0)
						  {
							displayString = displayString + '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
						  }
						  displayString = displayString + '</span>';
						  displayString = displayString + '</div>';
						  displayString = displayString + '</div>';
              
						  displayString = displayString + '<div class="col-md-4 div-table-col">';
						  displayString = displayString + '<div class="ht-price" valign="top">';
						  if(json['best_price'][i]['price_exception']=='n')
						  {
								displayString = displayString + '<span class="profitPrice2 bold6">'+json['best_price'][i]['currency_code']+' '+json['best_price'][i]['profit_price']+' </span>';
								displayString = displayString + '<strike class="discountPrice2 font16px">'+json['best_price'][i]['currency_sign']+json['best_price'][i]['discount_price']+'</strike>';
								
						  }
						  else
						  {
							displayString = displayString + '<br><span style="font-weight:normal; color:#5c5e62; font-size:12px;">Contact For Price</span>';
						  }
						 
						  displayString = displayString + '</div>';
						  displayString = displayString + '</div>';
						
              
						  displayString = displayString + '<div class="col-md-4 div-table-col">';
						  displayString = displayString + '<div class="ht-price" valign="top">';
						  if(json['minimum_price'][i]['price_exception']=='n')
						  {
								displayString = displayString + '<span class="profitPrice2 bold6">'+json['minimum_price'][i]['currency_code']+' '+json['minimum_price'][i]['profit_price']+' </span>';
								displayString = displayString + '<strike class="discountPrice2 font16px">'+json['minimum_price'][i]['currency_sign']+json['minimum_price'][i]['discount_price']+'</strike>';
								
						  }
						  else
						  {
							displayString = displayString + '<br><span style="font-weight:normal; color:#5c5e62; font-size:12px;">Contact For Price</span>';
						  }
						 
						  displayString = displayString + '</div>';
						  displayString = displayString + '</div>';
						 
						 
						 displayString = displayString + '</div>';
               
               		}
					$('#priceCalculatorCurrency').html('Note: The cost of this trip is calculated based on double or twin shared accommodation and for the mentioned services. However, the price may change depending on availability, currency fluctuations, and the number of travelers. <b>For festive period or peak season, please contact us with your specific travel dates.</b>');
					$('#tourDayPriceRow').html(displayString);
					
			  }
		  });
	}



</script>