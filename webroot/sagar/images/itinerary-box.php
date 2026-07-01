<?php
	ob_start();
?>
<?php 
require_once("lib/config.php");
require_once("lib/functions.php");
require_once("lib/variable.php");
include_once("library/library.php");
@extract($_REQUEST);

$visitorIPDetail=@getUserIpDetail();


$sql=$obj->query("select * from $tbl_managetour where site_active=1 and  id='$id'",$debug=-1);
$line=$obj->fetchNextObject($sql);



if($id=='54' || $id=='80' || $id=='29')
{
	$conversionLabel='YbYtCKv99QMQ7ZvB1QM';
}
else if($id=='73' || $id=='78' || $id=='76')
{
	$conversionLabel='EcPsCJv_9QMQ7ZvB1QM';
}
else if($id=='41' || $id=='58' || $id=='39' || $id=='56' || $id=='57')
{
	$conversionLabel='kALoCJOA9gMQ7ZvB1QM';
}

if(isset($_SESSION['change_cur']))
{
$sql_change_cur=$obj->query("select * from $tbl_currency where active_status=1",$debug=-1);
$line_change_cur=$obj->fetchNextObject($sql_change_cur);
}
else
{
$sql_change_cur=$obj->query("select * from $tbl_currency where id=1",$debug=-1);
$line_change_cur=$obj->fetchNextObject($sql_change_cur);
$_SESSION['currency_symbol']="images/".$line_change_cur->currency_symbol;
}

if($_POST['submitForm'] == "yes")
{


$fname=mysql_real_escape_string($_POST['fname']);
$email_id=mysql_real_escape_string($_POST['email_id']);
$phone=mysql_real_escape_string($_POST['phone']);
$country=mysql_real_escape_string($_POST['country']);
$no_of_adult=mysql_real_escape_string($_POST['no_of_adult']);
$no_of_child=mysql_real_escape_string($_POST['no_of_child']);
$child1=mysql_real_escape_string($_POST['child1']);
$child2=mysql_real_escape_string($_POST['child2']);
$child3=mysql_real_escape_string($_POST['child3']);
$child4=mysql_real_escape_string($_POST['child4']);
$child5=mysql_real_escape_string($_POST['child5']);
$child6=mysql_real_escape_string($_POST['child6']);
$no_of_room=mysql_real_escape_string($_POST['no_of_room']);
$room_type=mysql_real_escape_string($_POST['room_type']);
$travel_type=mysql_real_escape_string($_POST['travel_type']);

if($_POST['testinput']!='')
$start_date=mysql_real_escape_string($_POST['testinput']);
else
$start_date=mysql_real_escape_string($_POST['testinput2']);

$remarks=mysql_real_escape_string($_POST['remarks']);

$_SESSION['remarks']=$remarks;

$tour_name2=mysql_real_escape_string($_POST['tour_name2']);
$tour_id=mysql_real_escape_string($_POST['tour_id']);
$_SESSION['start_date']=$start_date;

$_SESSION['no_of_child']=$no_of_child;

$_SESSION['child'][1]=$child1;
$_SESSION['child'][2]=$child2;
$_SESSION['child'][3]=$child3;
$_SESSION['child'][4]=$child4;
$_SESSION['child'][5]=$child5;
$_SESSION['child'][6]=$child6;


$key=substr($_SESSION['key'],0,5);
$number = $_REQUEST['number'];
if($number!=$key)
{

header('Location:'.'itinerary.php?valid_status=1&fname='.$fname.'&email_id='.$email_id.'&phone='.$phone.'&country='.$country.'&no_of_adult='.$no_of_adult.'&no_of_child='.$no_of_child.'&child1='.$child1.'&child2='.$child2.'&child3='.$child3.'&child4='.$child4.'&child5='.$child5.'&child6='.$child6.'&no_of_room='.$no_of_room.'&id='.$tour_id.'#tabs-4');

}
else
{
	/*
		extra validation for spam prevention
	*/
	if($_SESSION['varificationCode']!=$_POST['varificationCode'])
	{

		header('Location:'.'itinerary.php?valid_status=1&fname='.$fname.'&email_id='.$email_id.'&phone='.$phone.'&country='.$country.'&no_of_adult='.$no_of_adult.'&no_of_child='.$no_of_child.'&child1='.$child1.'&child2='.$child2.'&child3='.$child3.'&child4='.$child4.'&child5='.$child5.'&child6='.$child6.'&no_of_room='.$no_of_room.'&id='.$tour_id.'#tabs-4');
		exit();
		
	}

	if (!preg_match("/itinerary.php/", $_SERVER['HTTP_REFERER']))
	{
		header('Location:'.'itinerary.php?valid_status=1&fname='.$fname.'&email_id='.$email_id.'&phone='.$phone.'&country='.$country.'&no_of_adult='.$no_of_adult.'&no_of_child='.$no_of_child.'&child1='.$child1.'&child2='.$child2.'&child3='.$child3.'&child4='.$child4.'&child5='.$child5.'&child6='.$child6.'&no_of_room='.$no_of_room.'&id='.$tour_id.'#tabs-4');
		exit();

	}


	/*
		adding extra validation to prevent spam 
	*/
	$submission = true;
	
	if(!preg_match("/^[a-zA-Z .-]*$/", $fname, $matches))
	{
		$submission=false;
		$messageId=1;
	}

	if(strstr($remarks,"www"))
	{
		$submission=false;
		$messageId=2;
	}

	if(strstr($remarks,"http"))
	{
		$submission=false;
		$messageId=2;
	}
	
	if (!$submission)
	{
		header('Location:'.'itinerary.php?field_status='.$messageId.'&fname='.$fname.'&email_id='.$email_id.'&phone='.$phone.'&country='.$country.'&no_of_adult='.$no_of_adult.'&no_of_child='.$no_of_child.'&child1='.$child1.'&child2='.$child2.'&child3='.$child3.'&child4='.$child4.'&child5='.$child5.'&child6='.$child6.'&no_of_room='.$no_of_room.'&id='.$tour_id.'#tabs-4');
		exit();

	}

if (getenv('HTTP_CLIENT_IP')) {
			$ip = getenv('HTTP_CLIENT_IP');
		}
		elseif (getenv('HTTP_X_FORWARDED_FOR')) {
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		}
		elseif (getenv('HTTP_X_FORWARDED')) {
			$ip = getenv('HTTP_X_FORWARDED');
		}
		elseif (getenv('HTTP_FORWARDED_FOR')) {
			$ip = getenv('HTTP_FORWARDED_FOR');
		}
		elseif (getenv('HTTP_FORWARDED')) {
			$ip = getenv('HTTP_FORWARDED');
		}
		else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		
$_SESSION['key']='';
$_SESSION['varificationCode']='';
$_SESSION['start_date']='';
/*
	getting user location by ip
*/

$userLocation=@getUserIpDetail();

$sql=$obj->query("insert into $tbl_enquiry set fname='$fname',email_id='$email_id',phone='$phone',country='$country',no_of_adult='$no_of_adult',no_of_child='$no_of_child',child1='$child1',child2='$child2',child3='$child3',child4='$child4',child5='$child5',child6='$child6',no_of_room='$no_of_room',room_type='$room_type',travel_type='$travel_type',remarks='$remarks'",$debug=1);
	   //$id = mysql_insert_id();
		
$to = 'sales@elegantjourneys.co';
//$to='kr.rakesh.sinha7@gmail.com';
$subject = 'Tour enquiry from '.$fname.' for '.$tour_name2;
$pageName = $_SERVER['SCRIPT_URI'];
$message="<table width=\"400\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\">
  <tr>
    <td>Tour Name</td>
    <td><a href=\"http://elegantjourneys.co/itinerary.php?id=$tour_id\">$tour_name2</a></td>
  </tr>
  <tr>
    <td>Page Name</td>
    <td>$pageName</td>
  </tr>
  <tr>
    <td>IP Address</td>
    <td>$ip</td>
  </tr>
  <tr>
    <td>Client Name</td>
    <td>$fname</td>
  </tr>
  <tr>
    <td>Email ID</td>
    <td>$email_id</td>
  </tr>
  <tr>
    <td>Phone</td>
    <td>$phone</td>
  </tr>
  <tr>
    <td>Country</td>
    <td>$country</td>
  </tr>
  <tr>
    <td>No of Adult</td>
    <td>$no_of_adult</td>
  </tr>
  <tr>
    <td>No of Children</td>
    <td>$no_of_child</td>
  </tr>
  <tr>
    <td>Children Ages</td>
    <td>$child1&nbsp;&nbsp;$child2&nbsp;&nbsp;$child3&nbsp;&nbsp;$child4&nbsp;&nbsp;$child5&nbsp;&nbsp;$child6</td>
  </tr>
  <tr>
    <td>No of Room Required</td>
    <td>$no_of_room</td>
  </tr>
   <tr>
    <td>Room Type</td>
    <td>$room_type</td>
  </tr>
   <tr>
    <td>Travel Type</td>
    <td>$travel_type</td>
  </tr>
   <tr>
    <td>Start Date of Tour</td>
    <td>$start_date</td>
  </tr>
 <tr>
    <td>Remarks</td>
    <td>$remarks</td>
  </tr>
  <tr>
    <td colspan='2'><strong> Details retrieve from IP address</strong></td>
  </tr>
  <tr>
    <td>Country</td>
    <td>".@$userLocation['countryName']."</td>
  </tr>
  <tr>
    <td>Region</td>
    <td>".@$userLocation['regionName']."</td>
  </tr>
  <tr>
    <td>Time Zone</td>
    <td>".@$userLocation['timeZone']."</td>
  </tr>
</table>";

$from='wadhawan.vivek@gmail.com';

$headers = "From:".$from."\r\n";
$headers .= "Bcc:kr.rakesh.sinha7@gmail.com"."\r\n";
$headers .= 'Content-type: text/html;';
if($fname && $phone && $email_id && $country && $start_date )
{
	mail($to, $subject, $message, $headers);
	$_SESSION['remarks']="";
}
		
$_SESSION['sess_msg'] = "<strong>Your inquiry form is successfully submited. We will get in touch with you within one business day.</strong><br><br>Tips: Please add sales@elegantjourneys.co to your email contact-list or safelist to ensure that you can receive a reply from us. If you do not receive a reply from us within one business day in your inbox, please check your bulk mail or junk mail folders. Thank you!";



//header("Location: itinerary.php?valid=1&id=$tour_id");
if($fname && $phone && $email_id && $country && $start_date )
{
	header("Location: http://elegantjourneys.co/thankyou.php");
}
//header("Location:".$_SERVER['HTTP_REFERER']);
}
}

//$line_change_cur->amount=1;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $line->tour_title; ?></title>

<meta name="description" content="<?php echo $line->meta_description; ?>" />

<meta name="keywords" content="<?php echo $line->meta_keyword; ?>" />



<link rel="stylesheet" type="text/css" href="style.css" />


<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.4.custom.min.js"></script>

	<!-- Forms stylesheet -->
	
	<link rel="stylesheet" type="text/css" href="css/slick_qfb.css" media="screen" />

	
	
	<script type="text/javascript" src="js/datetimepicker_css.js"></script>
	<link href="js/style1.css" rel="stylesheet" type="text/css" media="screen">

	

	
	<script>
	$(function() {
	$( "#datepicker" ).datepicker();
	});
	</script>
	<script>

	$(document).ready(function() { 
		
		$('#tabs').tabs();
		$('#timeframe').datepicker();
		
	});


	</script>
	

	<script type="text/javascript">''</script>
	<style>
	 body{ background:none !important; }
	 </style>
	<!-- form element ends here -->

	<script language="javascript" type="text/javascript">
	var totalBlock=0;
	function show2(str)
	{
	if(str==2)
	{
	document.getElementById("my_travel1").style.display='block';
	document.getElementById("my_travel2").style.display='none';
	}
	if(str==3)
	{
	document.getElementById("my_travel2").style.display='block';
	document.getElementById("my_travel1").style.display='none';
	}
	}
	function show(a)
	{
	document.getElementById("start_date").value=a;
	}
	</script>


	<script language="JavaScript" type="text/javascript">
	function validate()
	{
	var str=true;
	document.getElementById("msg1").innerHTML="";
	document.getElementById("msg2").innerHTML="";
	document.getElementById("msg3").innerHTML="";
	document.getElementById("msg4").innerHTML="";
	document.getElementById("msg5").innerHTML="";
	document.getElementById("msg6").innerHTML="";
	document.getElementById("msg7").innerHTML="";
	document.getElementById("msg8").innerHTML="";
	document.getElementById("msg9").innerHTML="";


	var tour_date1="<?php echo $line->tour_type; ?>";

	if(document.testform.number.value==0)
	{
	document.getElementById("msg8").innerHTML="Please Enter the Code";
	str=false;
	}
			
	if(document.testform.fname.value=='')
	{
	document.getElementById("msg1").innerHTML="Please Insert Name";
	str=false;
	}


	if(tour_date1==2)
	{
			if(document.testform.testinput.value=='')
			{
					document.getElementById("msg9").innerHTML="Please Select Tour Date";
					str=false;
			}
	}
	else if(tour_date1==1)
	{
			if(document.testform.testinput2.value=='')
			{
					document.getElementById("msg9").innerHTML="Please Select Tour Date from Price Tab";
					str=false;
			}
	}
	else
	{
			if(document.testform.testinput.value=='' && document.testform.testinput.value=='')
			{
					document.getElementById("msg9").innerHTML="Please Select Tour Date";
					str=false;
			}
	}


	var validate_char= /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(!document.testform.email_id.value.match(validate_char))
	{
	document.getElementById("msg2").innerHTML="Please Enter a valid email address";
	str=false;
	}

	/*
		capturing phone value
	*/
	 var phoneNo = document.testform.phone.value
		 phoneNo = phoneNo.replace('-','');
		 phoneNo = phoneNo.replace('+','');
		 //alert(phoneNo);
	if(isNaN(phoneNo)||document.testform.phone.value.indexOf(" ")!=-1)
	{
	document.getElementById("msg3").innerHTML="Please Insert Numeric Phone Number";
	str = false;
	}else if(document.testform.phone.value.length<7)
		{
		document.getElementById("msg3").innerHTML="Please Insert Valid Phone Number";
		str = false;
		}
		else
		{
		}


	if(document.testform.country.value=='')
	{
	document.getElementById("msg4").innerHTML="Please Insert Country";
	str = false;
	}

	if(document.testform.no_of_child.value!='')
	{
	if(document.testform.no_of_child.value==1)
	{
		if(document.testform.child1.value=='')
		{
		document.getElementById("msg6").innerHTML="Please Select Child Age";
		str=false;
		}
	}

	if(document.testform.no_of_child.value==2)
	{
		if(document.testform.child1.value=='' || document.testform.child2.value=='')
		{	
		document.getElementById("msg6").innerHTML="Please Select Child Age";
		str=false;
		}
	}
	if(document.testform.no_of_child.value==3)
	{
		if(document.testform.child1.value=='' || document.testform.child2.value=='' || document.testform.child3.value=='')
		{	
		document.getElementById("msg6").innerHTML="Please Select Child Age";
		str=false;
		}
	}

	if(document.testform.no_of_child.value==4)
	{
		if(document.testform.child1.value=='' || document.testform.child2.value=='' || document.testform.child3.value=='' || document.testform.child4.value=='')
		{	
		document.getElementById("msg6").innerHTML="Please Select Child Age";
		str=false;
		}
	}

	if(document.testform.no_of_child.value==5)
	{
	if(document.testform.child1.value=='' || document.testform.child2.value==''  || document.testform.child3.value==''  || document.testform.child4.value==''  || document.testform.child5.value=='')
		{	
		document.getElementById("msg6").innerHTML="Please Select Child Age";
		str=false;
		}
	}

	if(document.testform.no_of_child.value==6)
	{
	if(document.testform.child1.value=='' || document.testform.child2.value==''  || document.testform.child3.value==''  || document.testform.child4.value==''  || document.testform.child5.value=='' || document.testform.child6.value=='')

		{	
		document.getElementById("msg6").innerHTML="Please Select Child Age";
		str=false;
		}
	}

	}


	if(document.testform.room_type.value=='')
	{
	document.getElementById("msg5").innerHTML="Please Select Travel Type";
	str = false;
	}


	if(document.testform.room_type.value==3)
	{
		if(document.testform.travel_type1.checked || document.testform.travel_type2.checked || document.testform.travel_type3.checked)
		{
			if(document.testform.start_date.value=='' || document.testform.end_date.value=='')
			document.getElementById("msg7").innerHTML="Please Select Travel date";
		}
		else
		{
		if(document.testform.start_date.value=='' || document.testform.end_date.value=='')
		document.getElementById("msg7").innerHTML="Please Select Travel date<br>Please Check Travel Level";
		else
		document.getElementById("msg7").innerHTML="Please Check Travel Level";
		str=false;
		}
	}

	if(document.testform.room_type.value==2)
	{
		if(document.testform.travel_type1.checked || document.testform.travel_type2.checked)
		{
			if(document.testform.start_date.value=='')
			document.getElementById("msg7").innerHTML="Please Select Travel date";
		}
		else
		{
		if(document.testform.start_date.value=='')
		document.getElementById("msg7").innerHTML="Please Select Travel date<br>Please Check Travel Level";
		else
		document.getElementById("msg7").innerHTML="Please Check Travel Level";
		str=false;
		}
	}


	return str;

	}


	function hide_text()
	{
	document.testform.remarks.value="";
	}

	<?php
		
		if((isset($_SESSION['shortMessageSent']))&&($_SESSION['shortMessageSent']==1))
		{
	?>
		var informationSend=true;
		
	<?php
		}
		else
		{
	?>
			var informationSend=false;
	<?php
		}
	?>

	function sendShortInformation()
	{
		var objForm = document.testform;
		customerName = objForm.fname.value;
		customerEmail = objForm.email_id.value;
		customerPhone = objForm.phone.value;

		if(customerName!=""&&customerEmail!=""&&customerPhone!="")
		{
			if(!informationSend)
			{
				$.post("jquery.php",{method:'sendShortCustomerInfo',customerName:customerName,customerEmail:customerEmail,customerPhone:customerPhone,tourId:'<?=$line->id?>',tourName:'<?=$line->tour_name?>'},function(result){
					if(result=='1')
					{
						informationSend=true;
					}
				});
			}

		}

	}

	function displayTourPrice(selectedId)
	{
		var currentCSSProperty=$('#priceDescription'+selectedId).css('display');
		if(currentCSSProperty=='none')
		{
			$('#priceDescription'+selectedId).css('display','block');
			$('#priceTitleIcon'+selectedId).removeClass("sliderIconInactive");
			$('#priceTitleIcon'+selectedId).addClass("sliderIconActive");
			$('#priceTitleIcon'+selectedId).html("Click to Close Price");
			$('#priceTitle'+selectedId).css("border","1px solid #E3422A");
			//$('#priceTitle'+selectedId).css("font-size","11px");
			//$('#priceTitle'+selectedId).css("font-weight","bold");
			
			
		}
		else
		{
			$('#priceDescription'+selectedId).css('display','none');
			$('#priceTitleIcon'+selectedId).removeClass("sliderIconActive");
			$('#priceTitleIcon'+selectedId).addClass("sliderIconInactive");
			$('#priceTitleIcon'+selectedId).html("Click to Open Price");
			$('#priceTitle'+selectedId).css("border","1px solid #7e99dc");
			
		}
	}

	function closeAllBlock()
	{
		for(i=1;i<=totalBlock;i++)
		{
			$('#priceDescription'+i).css('display','none');
			$('#priceTitleIcon'+i).removeClass("sliderIconActive");
			$('#priceTitleIcon'+i).addClass("sliderIconInactive");
			$('#priceTitleIcon'+i).html("Click to Open Price");
			$('#priceTitle'+i).css("border","1px solid #7e99dc");
		}
	}

	function openAllBlock()
	{
		for(i=1;i<=totalBlock;i++)
		{
			$('#priceDescription'+i).css('display','block');
			$('#priceTitleIcon'+i).removeClass("sliderIconInactive");
			$('#priceTitleIcon'+i).addClass("sliderIconActive");
			$('#priceTitleIcon'+i).html("Click to Close Price");
			$('#priceTitle'+i).css("border","1px solid #E3422A");
		}
	}

	</script>





   

<style type="text/css">
html .jqueryslidemenu{height: 1%;} 
</style>
<?php include "include/google_analytics_tracking_code.php"; ?>

<!-- loader css -->
<style>
	#loading {
  width: 100%;
  height: 100%;
  top: 0px;
  left: 0px;
  position: fixed;
  display: block;
  opacity: 0.4;
  background-color: #000000;
  z-index: 9999;
  text-align: center;
}

#loading-image {
  position: absolute;
  top: 50%;
  left: 50%;
  z-index: 9999;
}

#offer
{
	width:auto !important;
}

.side-content
{
	width:auto !important;
	padding-right:10px;
}

.itinerary
{
	width:700px!important;
}

.hotel-border
{
	width:700px!important;
}

.hotel-bg
{
	width:690px!important;
}

.hotel
{
	width:690px!important;
}

.tab-inclusions
{
	width:690px !important;
}

.tab-box1
{
	width:690px !important;
	background-color:#ffffff;
}



.tab-p
{
	width:690px !important;
}

.month-name
{
	width:145px !important;
}

.month-name1
{
	width:100px !important;
}

.land-price
{
	width:180px !important;
}

.land-price1
{
	width:100px !important;
}

.on-tour
{
	width:180px !important;
}

.on-tour1
{
	width:100px !important;
}
.tab-box2
{
	width:690px !important;
	border:none;
	
}

.itinerary ul
{
	width:690px !important;
}


.answer-1
{
	width:685px !important;
}

.tab-box-form
{
	width:685px !important;
}

.tab-box-form .line
{
	width:680px !important;
}

/* css for button/tab */
.ui-widget-header {
    border-bottom: 2px solid #d9dce7;
    height: 30px;
}

.ui-tabs-nav li a {
	background:none !important;
    background: #FF6820 !important;
    color: #ffffff;
    float: left;
    font-family: verdana;
    font-size: 14px;
    height: 30px;
    line-height: 30px;
    margin: 0;
    padding: 0 4px 0 0;
    text-align: center;
    text-decoration: none;
    width: 128px !important;
	border:2px solid #ffffff;
}

.ui-widget-header {
    border-bottom: 2px solid #d9dce7;
    height: 39px;
}

.ui-tabs-nav li.ui-tabs-selected a {
    margin-bottom: 0;
    padding-bottom: 1px;
	background:#BB0400 !important;
	color:#ffffff !important;
	font-
	
	
}

.ui-tabs .ui-tabs-nav li.ui-tabs-selected a, .ui-tabs .ui-tabs-nav li.ui-state-disabled a, .ui-tabs .ui-tabs-nav li.ui-state-processing a {
    cursor: text;
	background:#CB0303;
}

.toggleDate
{
	font-size:13px;
	width:350px;
	display:inline;
	width:20px;
    height:20px;
	background: url("images/icons/animated_arrow.gif") no-repeat scroll 10px center #e4e4e4;
	padding-left:45px;
	background-color:#ffffff;
}

.sliderIconInactive
{
	float:right;
	background: url("images/icons/left-slider-icon.png") no-repeat scroll right center #ffffff;
	width:160px;
	display:inline;
	background-color:#ffffff;
}

.sliderIconActive
{
	float:right;
	background: url("images/icons/down-slider-icon.png") no-repeat scroll right center #ffffff;
	width:160px;
	display:inline;
	background-color:#ffffff;
}

a.tryitbtn{
    background-color: #B30000;
    border: 1px solid #B30000;
    border-radius: 5px;
    color: #ffffff;
    display: inline-block;
    font-size: 12px;
    font-weight: bold;
	 margin-top: 8px;
    margin-bottom: 5px;
    margin-left: 10;
    margin-top: 0;
    padding: 3px 10px 4px;
    text-align: center;
    text-decoration: none;
    white-space: nowrap;
	font-family: verdana;
	
}
a.tryitbtn:hover, a.tryitbtn:active, a.showbtn:hover, a.showbtn:active {
    background-color: #ffffff;
    color: #B30000;
}

.priceInquiry
{
	width:600px;
	display:block;
}

.priceTitleBox
{
	background-color:#EBEEF6; border:0px solid; width:698px !important; font-weight:bold !important;
}

.offer {
    background: none repeat scroll 0 0 #BB0400;
    color: #fff;
    font-size: 9px;
    font-weight: 700;
    height: 16px;
    letter-spacing: 2px;
    line-height: 16px;
    margin: 0 0 5px;
    padding: 2px 4px;
    text-align: center;
    text-transform: uppercase;
    width: 50px;
}
</style>
<!-- loader ends here -->

</head>
<body>

<!-- added loader to load page -->
<div id="loading">
  <img id="loading-image" src="images/ajax-loader.gif" alt="Loading..." />
</div>
<!-- loader of the page ends here -->
<FORM METHOD=POST ACTION="">

</FORM>
<div id="container">
  <?php include "include/header.html"; ?>
    <?php include "include/top_link.php"; ?>
   <!--div id="banner-inside"><img src="img/tour_picture" width="1000" height="250" /></div-->
   <?php /*?><div id="banner-inside"><?php include "include/tour_slideshow-itenary.php"; ?></div>
  <?php */?>
    <div id="middle-con">
    	<div class="side-menu-inside" style="float:right;">

    	  <?php include "include/change_currency.php"; ?>
		 <?php /*?> <?php //include "include/special_offer_link.php"; ?><?php */?>
    	  <!--<div class="hori-con">
             		<div class="button-head">
                    	<h1 style="line-height:44px; padding-left:10px; color:#717582;">Route Map</h1>
                    </div>
          </div>-->
		  <br />
		  
             <?php /*?><div class="hori-con">
             	  <?php include "include/map.php"; ?>
             </div><?php */?>
     
              	  <?php include "include/comment-side1.php"; ?><br />
				  <div class="ity-gallery"><img width="216" height="925" src="img/usp_gray"></div>
     </div>
    	<div class="side-content">
      		<div class="tourg">
                	<ul class="blue-txt">
                    	<li style="background:none; padding:0px 5px 0px 0px; margin:0px; color:#666666;">You are here:</li>
                    	<li>Home</li>
						
						<li>
						<?php 
						if($line->tour_type==4 ||  $line->tour_type==5  || $line->tour_type==7)
						echo "Most Popular Tours";
						else if($line->tour_type==6)
						echo "Luxury Tour Offers";
						else if($line->tour_type==9 || $line->tour_type==10)
						echo "Signature Journeys";
						?>	
						</li>
							
							
																									
						<li style="background:none; font-weight:bold;">
						<?php 
						if($line->tour_type==4)
						echo "&nbsp;Golden Triangle Tours";
						else if($line->tour_type==5)
						echo "&nbsp;North India Varanasi Tours";
						else if($line->tour_type==6)
						echo "&nbsp;Oberoi Holidays";
						else if($line->tour_type==1)
						echo "&nbsp;Small Group Tours";
						else if($line->tour_type==7)
						echo "&nbsp;Rajasthan Tours";
						else if($line->tour_type==9)
						echo "&nbsp;North India &amp; Kerala Tours";
						else if($line->tour_type==10)
						echo "&nbsp;Bhutan Tours";
						?>	
						</li>
                    </ul>
            </div>
			<a name="top"></a>
      		<div class="itinerary">
            	<h1 style="color:#000066; margin:0px 0px 20px 0px;">
                	<?php echo $line->tour_name; ?></span>
					
                	<?php /*?><span class="dollar-txt">(<?php echo $line->tour_duraction." days / ".(($line->tour_duraction)-1)." nights"; ?>)</span><?php */?>
                 <br />
				 <hr width="98%" align="left">
				<span class="dollar-txt">Private Journey | <?php echo (($line->tour_duraction)-1). " Nights"; ?> | Tour Code: <?php echo $line->tour_code; ?></span>
				 </h1>
				 
            	<div id="tabs">
                
                    <ul>
                        <li><a href="#tabs-2">Itinerary</a></li>
                        <li><a href="#tabs-1">Hotels</a></li>
                        <li><a href="#tabs-5">Inclusions</a></li>
						<li><a href="#tabs-3">Dates-Prices</a></li>
						<li id="enquiry"><a style="background-image: url(img/enq-bg.gif);color:#fff; padding-left:2px;"  href="#tabs-4">ENQUIRE</a></li>
                    </ul>
					
									
				    <div id="tabs-2">
					<?php /*?><p><h2 class="dollar-txt" style="text-align:center; font-size:14px; padding:10px 0px 5px 2px; font-weight:normal; color:#0000FF;">Limited Time Discount = <span style=" font-size:16px; font-weight:bold;"><?php echo $line->offer; ?>% Off</span> <br />
					<span style=" font-size:14px; font-weight:normal;">Special Price = start from <span style=" font-size:16px; font-weight:bold;"><?php echo $line_change_cur->currency_sign.number_format(($line->tour_price-(($line->tour_price)*$line->offer/100))*$line_change_cur->amount);?></span> pp (Refer above Prices tab for all seasons)</span></h2>
					</p><?php */?>
					<p>
					<!--<h2 class="dollar-txt" style="text-align:center; font-size:18px; padding:5px 0px 10px 2px; color:#FF0000; ">(Click above tabs to see Hotels list, Prices &amp; Inclusions)
					</h2>-->
					</p>
					<?php /*?><p><h2 class="dollar-txt" style="text-align:center; font-size:14px; padding:10px 0px 5px 2px; font-weight:normal; color:#0000FF;">Special Offer <span style=" font-size:15px; font-weight:bold;"><?php echo $line->offer; ?>% Discount </span>for Limited Period Only! <br />
Prices Starting Low Season (April to Sept) - <span style=" font-size:15px; font-weight:bold;"><?php echo $line_change_cur->currency_sign.number_format(($line->tour_price-(($line->tour_price)*$line->offer/100))*$line_change_cur->amount);?></span> per person</span></h2><?php */?>
					</p>
					<br />

                      <p><h1 class="normal-txt";>
					  <!--<strong>DESTINATIONS:</strong> <?php echo $line->tour_place;?>-->
					<?php echo  stripslashes($line->tour_description); ?>
					</h1></p>
					<br />
					 
							
                	        <div class="it">
                    <h1 class="normal-txt"  style="padding:30px 0px 30px 2px;">
					<span style="color:#FF0000; font-size:16px;">
					<?php
					if(isset($_SESSION['sess_msg']))
					{
					echo $_SESSION['sess_msg'];
					echo "<br>";
					echo "<br>";
					echo "<br>";
					unset($_SESSION['sess_msg']);
					}
					?>
										
					

					<?php
						$sql2=$obj->query("select * from $tbl_set_tour where tour_id=$id order by day",$debug=-1);
						while($line2=$obj->fetchNextObject($sql2))
						{
						?>
														  
				  
                	<h4>
                    	<span>Day <?php echo $line2->day; ?>  - </span>
						<?php
						
						if($line2->subregion1)
						{
							$sql3=$obj->query("select * from $tbl_subregion where id=$line2->subregion1",$debug=-1);
							$line3=$obj->fetchNextObject($sql3);
						}
						
						if($line2->subregion2)
						{
						$sql4=$obj->query("select * from $tbl_subregion where id=$line2->subregion2",$debug=-1);
						$line4=$obj->fetchNextObject($sql4);
						}
						
						if($line2->subregion3)
						{
						$sql5=$obj->query("select * from $tbl_subregion where id=$line2->subregion3",$debug=-1);
						$line5=$obj->fetchNextObject($sql5);
						}
						
						if($line2->city_id1)
						{
						$sql10=$obj->query("select * from $tbl_tour where id=$line2->city_id1",$debug=-1);
						$line10=$obj->fetchNextObject($sql10);
						}
						
						if($line2->city_id2)
						{
						$sql11=$obj->query("select * from $tbl_tour where id=$line2->city_id2",$debug=-1);
						$line11=$obj->fetchNextObject($sql11);
						}
						
						if($line2->city_id3)
						{
						$sql12=$obj->query("select * from $tbl_tour where id=$line2->city_id3",$debug=-1);
						$line12=$obj->fetchNextObject($sql12);
						}				
						
						?>
                        <span>
						
						
						<?php 
						if($line3->region_location!='' && $line4->region_location=='' && $line5->region_location=='')
						{
						echo stripslashes($line3->region_location);
						$line3->region_location='';
						}
						else if($line3->region_location!=$line4->region_location && $line4->region_location==$line5->region_location)
						{
						echo stripslashes($line3->region_location)." / ";
						echo stripslashes($line4->region_location);
						$line3->region_location='';
						$line4->region_location='';
						$line5->region_location='';
						}
						else if($line3->region_location==$line4->region_location && $line5->region_location=="")
						{
						echo stripslashes($line3->region_location);
						$line3->region_location='';
						$line4->region_location='';
						}
						else if($line3->region_location!=$line5->region_location && $line3->region_location==$line4->region_location)
						{
						echo stripslashes($line3->region_location)." / ";
						echo stripslashes($line5->region_location);
						$line3->region_location='';
						$line4->region_location='';
						$line5->region_location='';
						}
						else if($line3->region_location!="" && $line4->region_location!="" && $line5->region_location=="" )
						{
						echo stripslashes($line3->region_location)." / ";
						echo stripslashes($line4->region_location);
						$line3->region_location='';
						$line4->region_location='';
						}
						else if($line3->region_location==$line4->region_location && $line3->region_location==$line5->region_location)
						{
						echo stripslashes($line3->region_location);
						$line3->region_location='';
						$line4->region_location='';
						}
						else if($line3->region_location!=$line4->region_location)
						{
						echo stripslashes($line3->region_location)." / ";
						echo stripslashes($line4->region_location);
						$line3->region_location='';
						$line4->region_location='';
						}
						
						
						
						?>
						
						</span>
                  </h4>
                    <div class="answer-1">
					
								
					
                   <?php 
				   if($line10->tour_description!='')
				   {
				   echo stripslashes($line10->tour_description); 
				   $line10->tour_description='';
				   echo "<br>";
				   }
				   ?>
				  
				   <?php 
				   if($line11->tour_description!='')
				   {
				   echo stripslashes($line11->tour_description); 
				   $line11->tour_description='';
				   echo "<br>";
				   }
				   ?>
				 
				  <?php 
				   if($line12->tour_description!='')
				   {
				   echo stripslashes($line12->tour_description); 
				   $line12->tour_description='';
				   echo "<br>";
				   }
				   ?>
				   
				     </div>
				   	<?php
					}
					?>   
                    </div>
					<!--<a href="#tabs-4" onclick="showEnquiryForm('tabs-4');"><img src="/images/inquire_now.jpg"></a>-->
					<a href="#slick-popup" ><img src="/images/inquire_now.jpg"></a>
					<h2 class="dollar-txt" style="text-align:right; font-size:14px; padding:0px 10px 0px 0px; font-weight:normal;"><a href="#top">BACK TO TOP OF PAGE</a></h2>
                </div>
				
				
				<div id="tabs-1">				
				
				<div class="booking-form">
                        	
						<?php
						if($line->tour_type==3   ||  $line->tour_type==6  || $line->tour_type==10)
						{
						?>
                           <?php
				$sql6=$obj->query("select * from $tbl_set_tour where tour_id=$id order by day",$debug=-1);
				?>
                	
					
					<div class="tab-box" style="margin:0px;">
                    	<h2 class="dollar-txt" style="text-align:left; font-size:16px; padding:20px 0px 10px 10px; font-weight:bold; ">HOTELS:</h2>
                    </div>
                    <div class="hotel-border" style="margin:0px;">
                            <div class="hotel-bg">
                            	<!--<div class="day">Day</div>-->
                                <div class="hotel-city">City</div>
                                <div class="hotel-name" style="text-align:left;">Hotel Names</div>
                                <!--<div class="hotel-meals">Meals</div>-->
                                <div class="clear"></div>
                            </div>
							<?php
							while($line6=$obj->fetchNextObject($sql6))
							{
							if($line6->hotel1!='')
							{
							?>
                            <div class="hotel">
                            	<?php /*?><div class="day"><?php echo "Day ".$line6->day; ?></div><?php */?>
                                <div class="hotel-city">
								<?php 
								$sql_5star=$obj->query("select * from $tbl_subregion where id=$line6->hotel_location",$debug=-1);
								$line_5star=$obj->fetchNextObject($sql_5star);
								echo $line_5star->region_location;
								?>
								
								</div>
                                <div class="hotel-name">
                                	<h5 class="normal-txt">
									<?php 
									if($line6->hotel1)
									{ 
									$sql_5star=$obj->query("select * from $tbl_hotel_type where id=$line6->hotel1",$debug=-1);
									$line_5star=$obj->fetchNextObject($sql_5star);
									echo $line_5star->hotel_type_name;
									}
									?>
									</h5>
                                    <h5 class="normal-txt">
									<?php 
									if($line6->hotel2)
									{ 
									$sql_5star=$obj->query("select * from $tbl_hotel_type where id=$line6->hotel2",$debug=-1);
									$line_5star=$obj->fetchNextObject($sql_5star);
									echo $line_5star->hotel_type_name;
									}
									?>
									</h5>
                                </div>
                                <?php /*?><div class="hotel-meals"><?php echo $line6->hotel_facility1; ?></div><?php */?>
                                <div class="clear"></div>
                            </div>
							<?php
							}
							}
							?>
							                           
                    </div>
						  
                        <?php
						}
						elseif ($line->tour_type==2 || $line->tour_type==4  || $line->tour_type==5  || $line->tour_type==7 || $line->tour_type==8 || $line->tour_type==9 || $line->tour_type==11 || $line->tour_type==12)
						{
						?>
						 <?php
				$sql6=$obj->query("select * from $tbl_set_tour where tour_id=$id order by day",$debug=-1);
				?>
                	
					
					<div class="tab-box">
                    	
						
						<h2 class="dollar-txt" style="text-align:left; font-size:16px; padding:10px 0px 0px 10px; font-weight:bold;">5 STAR HOTELS:</h2>
                    </div>
                    <div class="hotel-border">
                            <div class="hotel-bg">
                            	<!--<div class="day">Day</div>-->
                                <div class="hotel-city">City</div>
                                <div class="hotel-name" style="text-align:left;">Hotel Names</div>
                                <!--<div class="hotel-meals">Meals</div>-->
                                <div class="clear"></div>
                            </div>
							<?php
							while($line6=$obj->fetchNextObject($sql6))
							{
							if($line6->hotel1!='')
							{
							?>
                            <div class="hotel">
                            	<?php /*?><div class="day"><?php echo "Day ".$line6->day; ?></div><?php */?>
                                <div class="hotel-city">
								<?php 
								$sql_5star=$obj->query("select * from $tbl_subregion where id=$line6->hotel_location",$debug=-1);
								$line_5star=$obj->fetchNextObject($sql_5star);
								echo $line_5star->region_location;
								?>
								
								</div>
                                <div class="hotel-name">
                                	<h5 class="normal-txt">
									<?php 
									if($line6->hotel1)
									{ 
									$sql_5star=$obj->query("select * from $tbl_hotel_type where id=$line6->hotel1",$debug=-1);
									$line_5star=$obj->fetchNextObject($sql_5star);
									echo $line_5star->hotel_type_name;
									}
									?>
									</h5>
                                    <h5 class="normal-txt">
									<?php 
									if($line6->hotel2)
									{ 
									$sql_5star=$obj->query("select * from $tbl_hotel_type where id=$line6->hotel2",$debug=-1);
									$line_5star=$obj->fetchNextObject($sql_5star);
									echo $line_5star->hotel_type_name;
									}
									?>
									</h5>
                                </div>
                                <?php /*?><div class="hotel-meals"><?php echo $line6->hotel_facility1; ?></div><?php */?>
                                <div class="clear"></div>
                            </div>
							<?php
							}
							}
							?>
                           
                    </div>
					
					
					<!--4 star hotel-->
					<?php
				$sql7=$obj->query("select * from $tbl_set_tour where tour_id=$id order by day",$debug=-1);
				?>
                	
					<div class="tab-box">
                    	<h2 class="dollar-txt" style="text-align:left; font-size:16px; padding:10px 0px 0px 10px; font-weight:bold;">4 STAR HOTELS:</h2>
                    </div>
                    <div class="hotel-border">
                            <div class="hotel-bg">
                            	<!--<div class="day">Day</div>-->
                                <div class="hotel-city">City</div>
                                <div class="hotel-name" style="text-align:left;">Hotel Names</div>
                                <!--<div class="hotel-meals">Meals</div>-->
                                <div class="clear"></div>
                            </div>
							<?php
							while($line7=$obj->fetchNextObject($sql7))
							{
							if($line7->hotel3!='')
							{
							?>
                            <div class="hotel">
                            	<?php /*?><div class="day"><?php echo "Day ".$line7->day; ?></div><?php */?>
                                <div class="hotel-city">
								<?php 
								$sql_5star=$obj->query("select * from $tbl_subregion where id=$line7->hotel_location",$debug=-1);
								$line_5star=$obj->fetchNextObject($sql_5star);
								echo $line_5star->region_location;
								?>
								</div>
                                <div class="hotel-name">
                                	<h5 class="normal-txt">
									<?php 
									if($line7->hotel3)
									{
									$sql_5star=$obj->query("select * from $tbl_hotel_type where id=$line7->hotel3",$debug=-1);
									$line_5star=$obj->fetchNextObject($sql_5star);
									echo $line_5star->hotel_type_name;
									}
									?>
									</h5>
                                    <h5 class="normal-txt">
									<?php
									if($line7->hotel4)
									{ 
									$sql_5star=$obj->query("select * from $tbl_hotel_type where id=$line7->hotel4",$debug=-1);
									$line_5star=$obj->fetchNextObject($sql_5star);
									echo $line_5star->hotel_type_name;
									}
									?>
									</h5>
                                </div>
                                <?php /*?><div class="hotel-meals"><?php echo $line7->hotel_facility2; ?></div><?php */?>
                                <div class="clear"></div>
                            </div>
							<?php
							}
							}
							?>
                           
                    </div>
					
					<!-- 3 Star Hotel-->
					
					<?php
				$sql8=$obj->query("select * from $tbl_set_tour where tour_id=$id order by day",$debug=-1);
				?>
                	
					<div class="tab-box">
                    	<h2 class="dollar-txt" style="text-align:left; font-size:16px; padding:10px 0px 0px 10px; font-weight:bold;">3 STAR / SMALL BOUTIQUE HOTELS:
</h2>
                    </div>
                    <div class="hotel-border">
                            <div class="hotel-bg">
                            	<!--<div class="day">Day</div>-->
                                <div class="hotel-city">City</div>
                                <div class="hotel-name" style="text-align:left;">Hotel Names</div>
                                <!--<div class="hotel-meals">Meals</div>-->
                                <div class="clear"></div>
                            </div>
							<?php
							while($line8=$obj->fetchNextObject($sql8))
							{
							if($line8->hotel5!='')
							{
							?>
                            <div class="hotel">
                            	<?php /*?><div class="day"><?php echo "Day ".$line8->day; ?></div><?php */?>
                                <div class="hotel-city">
								<?php 
								$sql_5star=$obj->query("select * from $tbl_subregion where id=$line8->hotel_location",$debug=-1);
								$line_5star=$obj->fetchNextObject($sql_5star);
								echo $line_5star->region_location;
								?></div>
                                <div class="hotel-name">
                                	<h5 class="normal-txt">
									<?php 
									if($line8->hotel5)
									{ 
									$sql_5star=$obj->query("select * from $tbl_hotel_type where id=$line8->hotel5",$debug=-1);
									$line_5star=$obj->fetchNextObject($sql_5star);
									echo $line_5star->hotel_type_name;
									}
									?>
									</h5>
                                    <h5 class="normal-txt"><?php 
									if($line8->hotel6)
									{ 
									$sql_5star=$obj->query("select * from $tbl_hotel_type where id=$line8->hotel6",$debug=-1);
									$line_5star=$obj->fetchNextObject($sql_5star);
									echo $line_5star->hotel_type_name;
									}
									?></h5>
                                </div>
                                <?php /*?><div class="hotel-meals"><?php echo $line8->hotel_facility3; ?></div><?php */?>
                                <div class="clear"></div>
                            </div>
							<?php
							}
							}
							?>
                           
                    </div>
                
                
                		
						<?php
						}
						else
						{
						?>  
				<?php
				$sql6=$obj->query("select * from $tbl_set_tour where tour_id=$id order by day",$debug=-1);
				?>
                	
					
					<div class="tab-box">
                    	<h2 class="dollar-txt" style="text-align:left; font-size:16px; font-weight:bold; padding:10px 0px 0px 10px">5 STAR HOTELS:</h2>
                    </div>
                    <div class="hotel-border">
                            <div class="hotel-bg">
                            	<!--<div class="day">Day</div>-->
                                <div class="hotel-city">City</div>
                                <div class="hotel-name" style="text-align:left;">Hotel Names</div>
                                <!--<div class="hotel-meals">Meals</div>-->
                                <div class="clear"></div>
                            </div>
							<?php
							while($line6=$obj->fetchNextObject($sql6))
							{
							if($line6->hotel1!='')
							{
							?>
                            <div class="hotel">
                            	<?php /*?><div class="day"><?php echo "Day ".$line6->day; ?></div><?php */?>
                                <div class="hotel-city">
								<?php 
								$sql_5star=$obj->query("select * from $tbl_subregion where id=$line6->hotel_location",$debug=-1);
								$line_5star=$obj->fetchNextObject($sql_5star);
								echo $line_5star->region_location;
								?>
								
								</div>
                                <div class="hotel-name">
                                	<h5 class="normal-txt">
									<?php 
									if($line6->hotel1)
									{ 
									$sql_5star=$obj->query("select * from $tbl_hotel_type where id=$line6->hotel1",$debug=-1);
									$line_5star=$obj->fetchNextObject($sql_5star);
									echo $line_5star->hotel_type_name;
									}
									?>
									</h5>
                                    <h5 class="normal-txt">
									<?php 
									if($line6->hotel2)
									{ 
									$sql_5star=$obj->query("select * from $tbl_hotel_type where id=$line6->hotel2",$debug=-1);
									$line_5star=$obj->fetchNextObject($sql_5star);
									echo $line_5star->hotel_type_name;
									}
									?>
									</h5>
                                </div>
                                <div class="hotel-meals"><?php echo $line6->hotel_facility1; ?></div>
                                <div class="clear"></div>
                            </div>
							<?php
							}
							}
							?>
                           
                    </div>
					
					
					                   
						<?php
						}
						?> 
				  </div>
						<div class="clear"></div>
						<h2 class="dollar-txt" style="text-align:left; font-size:12px; padding:20px 0px 20px 5px; ">
                        Note: Hotel check-in is at 2 pm and check-out is at 12 noon for almost all the hotels in India.
            			</h2>
					<a href="#tabs-4" onclick="showEnquiryForm('tabs-4');"><img src="/images/inquire_now.jpg"></a>
                  </div>	
						
				<div id="tabs-5">
				<?php /*?><?php
				
				$sql3=$obj->query("select * from $tbl_tour_price where tour_id=$id and tour_type=1 and price_status=0 and end_date1 >= '".date("Y-m-d").' order by start_date1",$debug=-1);
				
				$sql4=$obj->query("select * from $tbl_tour_price where tour_id=$id and tour_type=2 and price_status=0 and end_date1 >= '".date("Y-m-d").' order by start_date1",$debug=-1);
				
				
				$sql5=$obj->query("select * from $tbl_managetour where site_active=1 and id=$id",$debug=-1);
				$line5=$obj->fetchNextObject($sql5);
				?>
				<?php
				if($line5->tour_type==1)
				{
				?>
                	<div class="booking-form">
					<!--<h2 class="dollar-txt" style="text-align:center; font-size:18px; color:#fe370e; padding:20px 0px 5px 10px; font-weight:bold;">
                     Special 15% Discount Offer Ends: 15-Jun-2011
					</h2>-->
					
                    	<h2 class="dollar-txt" style="text-align:left; font-size:16px; padding:20px 0px 5px 10px; font-weight:bold;">
                        Small Group Travel
                        <span style=" font-style:italic; font-size:12px; color:#414141; padding:20px 0px 5px 160px; font-weight:normal;">Prices quoted on per person basis</span>
                        </h2>
                    </div>
                	<div class="tab-p">
						<div class="tab-box1">
                    	<div class="month-name">
                        <p>Tour</p>
                        <p>Start Date</p>
                        </div>
                        <div class="month-name">
                         <p>Tour</p>
                         <p>End Date</p>
                        </div>
                       
                        <div class="land-price">
                          <p>Deluxe</p>
                          <p>Hotels</p>
                        </div>
                        
                        <div class="on-tour">
                          <p>Premier</p>
                          <p>Hotels</p>
                          </div>
                        <div class="total">
                        <p>Tour</p>
                        <p>Availability</p>
                        </div>
                        <div class="clear"></div>
                    </div>
					<?php 
					while($line3=$obj->fetchNextObject($sql3))
					{
					$current_date=date("d")."-".date("M")."-".date("Y"); 
						$diff2=strtotime($current_date)-strtotime($line3->end_date);
						$cal_diff2=$diff2/(60*60*24);
						if(!($line3->status==0 || $line3->end_date==0 || $cal_diff2>=3 || $cal_diff2==1 || $cal_diff2==2 || $cal_diff2==0)) {
					?>
                    <div class="tab-box2">
                    	<div class="month-name">
						<?php 
						$current_date=date("d")."-".date("M")."-".date("Y"); 
						$diff=strtotime($current_date)-strtotime($line3->start_date);
						$cal_diff=$diff/(60*60*24);
						?>
						<span>
						<input name="select_tour" type="radio" 
						<?php if($line3->status==0 || $line3->start_date==0 || $cal_diff>=3 || $cal_diff==1 || $cal_diff==2 || $cal_diff==0) { ?> disabled="disabled" <?php } ?> value="<?php echo $line3->start_date." to ".$line3->end_date; ?>" 
						onclick="show(this.value)" />
						</span>
						<?php echo $line3->start_date; ?></div>
                      	<div class="month-name"><?php echo $line3->end_date; ?></div>
                        <div class="land-price">
						<span class="dollar-txt" <?php if($line->offer!=0){?>style="text-decoration:line-through;" <?php } ?>>
						<?php 
						if($line3->star3=='--')
						echo $line3->star3;
						else
						echo $line_change_cur->currency_sign.number_format($line3->star3*$line_change_cur->amount);
						?>
						</span>
						<br />
						<span class="dollar-txt" style="color:#990000">
						<?php
						if($line3->star3=='--')
						echo $line3->star3;
						else
						{
						if($line->offer!=0)
						 echo $line_change_cur->currency_sign.number_format(($line3->star3-(($line3->star3)*$line->offer/100))*$line_change_cur->amount);
						}
						?>
						</span>
						</div>
                        <div class="on-tour">
						<span class="dollar-txt" <?php if($line->offer!=0){?>style="text-decoration:line-through;" <?php } ?>>
						<?php 
						if($line3->star4=='--')
						echo $line3->star4;
						else
						echo $line_change_cur->currency_sign.number_format($line3->star4*$line_change_cur->amount);
						?>
						</span>
						<br />
						<span class="dollar-txt" style="color:#990000">
						<?php
						if($line3->star4=='--')
						echo $line3->star4;
						else
						{
						if($line->offer!=0)
					 echo $line_change_cur->currency_sign.number_format(($line3->star4-(($line3->star4)*$line->offer/100))*$line_change_cur->amount);
					 	}
						?>
						</span>
						</div>
                        
                      <div class="total">
					  <span class="dollar-txt">
						<?php 
					  if($line3->status==0 || $line3->start_date==0 || $cal_diff>=3 || $cal_diff==1 || $cal_diff==2 || $cal_diff==0)  
					  echo "<strong>Sold Out</strong>";
					  else
					  echo "Available";
					  ?>
						</span>
					  </div>
                        <div class="clear"></div>
                   </div>
                   <?php
				   }
				   }
				   ?>
						
					</div>
					<div class="tab-box1" style="margin:10px 0px 0px 0px; border:solid 1px #7e99dc;">
                    	<div class="month-remark-1">Internal Air Travel<br />
(Economy Class)</div>
						 <div class="land-price-1">
			<?php echo $line_change_cur->currency_sign.number_format($line->internal_airprice*$line_change_cur->amount);?></div>
                      	<div class="on-tour-1"><?php echo $line->route; ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="tab-remarks">
                  		<?php echo $line->group_remarks; ?>
                    </div><?php }?>
					<?php
				if($line5->tour_type==2)
				{
				
				?>
             
			        <div class="booking-form">
					<h2 class="dollar-txt" style="text-align:left; font-size:16px; padding:30px 0px 5px 10px; font-weight:bold;">Private Travel
                   <span style=" font-style:italic; font-size:12px; color:#414141; padding:20px 0px 5px 195px; font-weight:normal;">Prices quoted on per person basis
				   </span>
                  </h2>
                  </div>
				  <div class="tab-p">
                    <div class="tab-box1">
                    	<div class="month-name">
                        <p>Season</p>
                        <p>Start Date</p>
                        </div>
                        <div class="month-name">
                         <p>Season</p>
                         <p>End Date</p>
                        </div>
                       
                        <div class="land-price">
                          <p>Superior</p>
                          <p>Hotels</p>
                        </div>
                        
                        <div class="on-tour">
                          <p>Deluxe</p>
                          <p>Hotels</p>
                        </div>
                        <div class="total">
                        <p>Premier</p>
                        <p>Hotels</p>
                        </div>
                        <div class="clear"></div>
                    </div>
					<?php 
					while($line4=$obj->fetchNextObject($sql4))
					{
					?>
					<div class="tab-box2">
                    	<div class="month-name"><?php echo $line4->start_date; ?> </div>
                      	<div class="month-name"><?php echo $line4->end_date; ?></div>
                        <div class="land-price">
						<span class="dollar-txt" <?php if($line->offer!=0){?>style="text-decoration:line-through;" <?php } ?>>
						<?php 
						if($line4->star3=='--')
						echo $line4->star3;
						else
						echo $line_change_cur->currency_sign.number_format($line4->star3*$line_change_cur->amount);
						?>
						</span>
						<br />
						<span class="dollar-txt" style="color:#990000;">
						<?php
						if($line4->star3=='--')
						echo $line4->star3;
						else
						{
						if($line->offer!=0)
						 echo $line_change_cur->currency_sign.number_format(($line4->star3-(($line4->star3)*$line->offer/100))*$line_change_cur->amount);
						 }
						?>
						</span>
						</div>
                        <div class="on-tour">
						<span class="dollar-txt" <?php if($line->offer!=0){?>style="text-decoration:line-through;" <?php } ?>>
						<?php 
						if($line4->star4=='--')
						echo $line4->star4;
						else
						echo $line_change_cur->currency_sign.number_format($line4->star4*$line_change_cur->amount);
						?>
						</span>
						<br />
						<span class="dollar-txt" style="color:#990000;">
						<?php
						if($line4->star4=='--')
						echo $line4->star4;
						else
						{
						if($line->offer!=0)
					 echo $line_change_cur->currency_sign.number_format(($line4->star4-(($line4->star4)*$line->offer/100))*$line_change_cur->amount);
					    }
						?>
						</span>
						</div>
                         <div class="total">
						<span class="dollar-txt" <?php if($line->offer!=0){?>style="text-decoration:line-through;" <?php } ?>>
						<?php 
						if($line4->star5=='--')
						echo $line4->star5;
						else
						echo $line_change_cur->currency_sign.number_format($line4->star5*$line_change_cur->amount);
						?>
						</span>
						<br />
						<span class="dollar-txt" style="color:#990000;">
						<?php
						if($line4->star5=='--')
						echo $line4->star5;
						else
						{
						if($line->offer!=0)
					 echo $line_change_cur->currency_sign.number_format(($line4->star5-(($line4->star5)*$line->offer/100))*$line_change_cur->amount);
					    }
						?>
						</span>
					</div>
					<div class="clear"></div>
                  </div>
				   <?php
				   }
				   ?>
						
			  </div>
					<div class="tab-box1" style="margin:10px 0px 0px 0px; border:solid 1px #7e99dc;">
                    	<div class="month-remark-1">Internal Air Travel<br />
(Economy Class)</div>
                        <div class="land-price-1"><?php echo $line_change_cur->currency_sign.number_format($line->internal_airprice*$line_change_cur->amount);?></div>
                      	<div class="on-tour-1"><?php echo $line->route; ?></div>
                        <div class="clear"></div>
                  </div>
					<div class="tab-remarks"><?php echo $line->private_remarks; ?>                    </div>
					<?php } ?>
					
					
					
					<!--<Start Tour Type 3>-->
					<?php
				if($line5->tour_type==3)
				{
				
				?>
					
			        <div class="booking-form">
					<h2 class="dollar-txt" style="text-align:left; font-size:16px; padding:30px 0px 5px 10px; font-weight:bold;">Private Travel
                   <span style=" font-style:italic; font-size:12px; color:#414141; padding:20px 0px 5px 195px; font-weight:normal;">Prices quoted on per person basis
				   </span>
                  </h2>
                  </div>
				  <div class="tab-p">
                    <div class="tab-box1">
                    	<div class="month-name">
                        <p>Season</p>
                        <p>Start Date</p>
                        </div>
                        <div class="month-name">
                         <p>Season</p>
                         <p>End Date</p>
                        </div>
                       
                        <div class="land-price">
                          <p>Double</p>
                          <p>Occupancy</p>
                        </div>
                        
                        <div class="on-tour">
                          <p>Single Room</p>
                          <p>Supplement</p>
                        </div>
                       
                        <div class="clear"></div>
                    </div>
					<?php 
					while($line4=$obj->fetchNextObject($sql4))
					{
					?>
					<div class="tab-box2">
                    	<div class="month-name"><?php echo $line4->start_date; ?> </div>
                      	<div class="month-name"><?php echo $line4->end_date; ?></div>
                        <div class="land-price">
						<span class="dollar-txt" <?php if($line->offer!=0){?>style="text-decoration:line-through;" <?php } ?>>
						<?php 
						if($line4->star3=='--')
						echo $line4->star3;
						else
						echo $line_change_cur->currency_sign.number_format($line4->star3*$line_change_cur->amount);
						?>
						</span>
						<br />
						<span class="dollar-txt" style="color:#990000">
						<?php
						if($line4->star3=='--')
						echo $line4->star3;
						else
						{
						if($line->offer!=0)
						 echo $line_change_cur->currency_sign.number_format(($line4->star3-(($line4->star3)*$line->offer/100))*$line_change_cur->amount);
						 }
						?>
						</span>
						</div>
                        <div class="on-tour">
						<span class="dollar-txt" <?php if($line->offer!=0){?>style="text-decoration:line-through;" <?php } ?>>
						<?php 
						if($line4->star4=='--')
						echo $line4->star4;
						else
						echo $line_change_cur->currency_sign.number_format($line4->star4*$line_change_cur->amount);
						?>
						</span>
						<br />
						<span class="dollar-txt" style="color:#990000">
						<?php
						if($line4->star4=='--')
						echo $line4->star4;
						else
						{
						if($line->offer!=0)
					 echo $line_change_cur->currency_sign.number_format(($line4->star4-(($line4->star4)*$line->offer/100))*$line_change_cur->amount);
					    }
						?>
						</span>
						</div>
                         <?php /*?><div class="total">
						<?php 
						if($line4->star5=='--')
						echo $line4->star5;
						else
						echo "$".$line4->star5;
						?>
					</div>
					<div class="clear"></div>
                  </div>
				   <?php
				   }
				   ?>
						
			  </div>
					<div class="tab-box1" style="margin:10px 0px 0px 0px; border:solid 1px #7e99dc;">
                    	<div class="month-remark-1">Internal Air Travel<br />
(Economy Class)</div>
                        <div class="land-price-1"><?php echo $line_change_cur->currency_sign.number_format($line->internal_airprice*$line_change_cur->amount);?></div>
                      	<div class="on-tour-1"><?php echo $line->route; ?></div>
                        <div class="clear"></div>
                  </div>
					<div class="tab-remarks"><?php echo $line->private_remarks; ?>                    </div>
					<?php } ?><?php */?>
					
					<!--<End Tour Type 3>-->
					
					<div class="booking-form">

					<h2 class="dollar-txt" style="text-align:left; font-size:16px; padding:20px 0px 10px 10px; font-weight:bold;">TOUR INCLUSIONS:</h2>
					</div>
					<?php
					$p=0;
					$q=0;
					
					$set_inc_exc_sql=$obj->query("select * from $tbl_set_inclusion_exclusion where tour_id=$id order by order_no",$debug=-1);
					while($inc_exc_line=$obj->fetchNextObject($set_inc_exc_sql))
					{

						$set_inc_exc_sql2=$obj->query("select * from $tbl_inc_exc where id=$inc_exc_line->inc_exc_id",$debug=-1);
						$inc_exc_line2=$obj->fetchNextObject($set_inc_exc_sql2);
					
						if($inc_exc_line2->incexctype==1)
						{
						$my_inc1[$p]=$inc_exc_line2->incexcdesc;
						$p++;
						}
					
						if($inc_exc_line2->incexctype==2)
						{
						$my_inc2[$q]=$inc_exc_line2->incexcdesc;
						$q++;
						}
					}
					
					?>
					<?php
					for($i=0;$i<count($my_inc1);$i++)
					{
					?>
					<div class="tab-inclusions">
                            <?php echo $my_inc1[$i]; ?>
                    </div>
					<?php
					}
					?>
					<div class="booking-form">
					<h2 class="dollar-txt" style="text-align:left; font-size:16px; padding:20px 0px 5px 10px; font-weight:bold;">TOUR EXCLUSIONS:</h2>
					</div>
					<?php
					for($i=0;$i<count($my_inc2);$i++)
					{
					?>
					<div class="tab-inclusions">
                            <?php echo $my_inc2[$i]; ?>
                    </div>
                   <?php
					}
					?>
					<br />
				<a href="#tabs-4" onclick="showEnquiryForm('tabs-4');"><img src="/images/inquire_now.jpg"></a>
          </div>
				  
				<div id="tabs-3">
				<h2 style="text-align:left; font-size:16px; padding:20px 0px 10px 10px; text-transform:uppercase;" class="dollar-txt"><strong>Dates and Prices:</strong></h2>
						<?php

							$priceColumns=getPriceColumnName($id);
							$strsqlPrice = "select * from $tbl_tour_price where tour_id=$id  and price_status=1 and end_date1 >= '".date("Y-m-d")."' order by start_date1";
							$resultPrice = mysql_query($strsqlPrice);
							$priceCount=1;
							$arrLatestFare = array();
							$arrLowestfare['price']='500000';
							$arrLowestfare['id']='0';
							while($infoPrice=mysql_fetch_array($resultPrice,MYSQL_ASSOC))
							{
								$threeStarPrice = (getDiscountedTourPrice($infoPrice['star3'], $line->offer, $line->profit)*$line_change_cur->amount);
								if($arrLowestfare['price']>$threeStarPrice)
								{
									$arrLowestfare['price'] = $threeStarPrice;
									$arrLowestfare['id']=$priceCount;
								}
						?>
								<div class="tab-box1" id="priceTitle<?=$priceCount?>" style="border: 1px solid #7e99dc; margin-bottom:0px; margin-bottom:10px; padding:4px; cursor:pointer; background-color:#ffffff;" onclick="displayTourPrice('<?=$priceCount?>');">
									<div class="toggleDate"><strong>Travel Date: </strong><?=str_replace('-',' ',$infoPrice['start_date'])?> - <?=str_replace('-',' ',$infoPrice['end_date'])?></div>

									<div class="sliderIconInactive" id="priceTitleIcon<?=$priceCount?>">Click to Open Price</div>
								</div>

								<div id="priceDescription<?=$priceCount?>" style="display:none; border:1px solid #DDDDDD; margin-bottom:10px;">
								  <?php
										if($infoPrice['star5']=='--')
										{
								 ?>
										<div class="tab-box1 priceTitleBox" >
											<div class="month-name" style="width:60px !important;"> <span class="offer" style="background-color:#EBEEF6; color:#EBEEF6;">offer</span></div>
											<div class="land-price" style="width:300px !important;">
											  <p><?=$priceColumns['affordableLevel']?></p>
											</div>
											
											<div class="on-tour" style="width:300px !important;">
											  <p><?=$priceColumns['luxuryLevel']?></p>
											</div>
											
											<div class="clear"></div>
										</div>

										<div class="tab-box2">
												<div class="month-name" style="width:60px !important;"><span class="offer">offer</span> </div>
												<div class="land-price" style="width:300px !important;">
												
												
												<span style="color:#FF0000;" class="dollar-txt-16">
													<?php	echo $line_change_cur->currency_sign.number_format(getDiscountedTourPrice($infoPrice['star3'], $line->offer, $line->profit)*$line_change_cur->amount);
												?>
												</span>
												<span style="text-decoration:line-through;" class="dollar-txt">
												<?php	echo $line_change_cur->currency_sign.number_format(getTourPrice($infoPrice['star3'], $line->offer, $line->profit)*$line_change_cur->amount);
												?>
												</span>
												</div>
												<div class="on-tour"  style="width:300px !important;">
												
												<span style="color:#FF0000;" class="dollar-txt-16">
												<?php	echo $line_change_cur->currency_sign.number_format(getDiscountedTourPrice($infoPrice['star4'], $line->offer, $line->profit)*$line_change_cur->amount);
												?>					
												</span>

												<span style="text-decoration:line-through;" class="dollar-txt">
												<?php	echo $line_change_cur->currency_sign.number_format(getTourPrice($infoPrice['star4'], $line->offer, $line->profit)*$line_change_cur->amount);
												?>					
												</span>
												
												</div>
																	<div class="clear"></div>
										  </div>

									<?php
										}
										else
										{
									?>
												<div class="tab-box1  priceTitleBox" >
													<div class="month-name" style="width:60px !important;"> <span class="offer" style="background-color:#EBEEF6; color:#EBEEF6;">offer</span></div>
													<div class="land-price" style="width:200px !important;">
													 
													  <p><?=$priceColumns['affordableLevel']?></p>
													 
													</div>
													
													<div class="on-tour" style="width:200px !important;">
													  <p><?=$priceColumns['luxuryLevel']?></p>
													  
													</div>
													<div class="total" style="width:200px !important;">
													<p><?=$priceColumns['royalLevel']?></p>
													
													</div>
													<div class="clear"></div>
												</div>



												<div class="tab-box2">
												<div class="month-name" style="width:60px !important;"><span class="offer">offer</span> </div>
												<div class="land-price" style="width:200px !important;">
												
												<span style="color:#FF0000;" class="dollar-txt-16">
													<?php	echo $line_change_cur->currency_sign.number_format(getDiscountedTourPrice($infoPrice['star3'], $line->offer, $line->profit)*$line_change_cur->amount);
												?>
												</span>
												<span style="text-decoration:line-through;" class="dollar-txt">
												
												<?php	echo $line_change_cur->currency_sign.number_format(getTourPrice($infoPrice['star3'], $line->offer, $line->profit)*$line_change_cur->amount);
												?>
												</span>
												</div>
												<div class="on-tour" style="width:200px !important;">
																								
												<span style="color:#FF0000;" class="dollar-txt-16">
												<?php	echo $line_change_cur->currency_sign.number_format(getDiscountedTourPrice($infoPrice['star4'], $line->offer, $line->profit)*$line_change_cur->amount);
												?>					
												</span>
												<span style="text-decoration:line-through;" class="dollar-txt">
												<?php	echo $line_change_cur->currency_sign.number_format(getTourPrice($infoPrice['star4'], $line->offer, $line->profit)*$line_change_cur->amount);
												?>					
												</span>
												</div>


												<div class="total" style="width:200px !important;">
												 
													
												<span style="color:#FF0000;" class="dollar-txt-16">
													<?php	echo $line_change_cur->currency_sign.number_format(getDiscountedTourPrice($infoPrice['star5'], $line->offer, $line->profit)*$line_change_cur->amount);
												?>						
												</span>

												 <span style="text-decoration:line-through;" class="dollar-txt">
													<?php	echo $line_change_cur->currency_sign.number_format(getTourPrice($infoPrice['star5'], $line->offer, $line->profit)*$line_change_cur->amount);
													?>
												 </span>

												</div>
																	<div class="clear"></div>
										  </div>

									<?php
										}
									?>
										  <div class="tab-box2">&nbsp;
										  <!--<a href="#" class="tryitbtn" target="_blank" onclick="showEnquiryForm('tabs-4'); return false;">Request Booking</a>-->
										  </div>
								</div>

						<?php
								$priceCount++;

							}
						?>
					
					<script>
						totalBlock = <?=$priceCount?>;
						displayTourPrice('<?=$arrLowestfare['id']?>');
					</script>
					<a href="#tabs-4" onclick="showEnquiryForm('tabs-4');"><img src="/images/inquire_now.jpg"></a>
				<div style="color: #405fab; font-family: verdana; font-size:12px; font-weight:bold; float:right;">
					<span style="cursor:pointer;" onclick="openAllBlock();">>> Open All Price</span><br />
					<span style="line-height:35px; cursor:pointer;" onclick="closeAllBlock();">>> Close All Price</span>
				</div>
                </div>
                
            	<div id="tabs-4">
				
				<?php include_once("include/new-itinerary-form.php"); ?>
                </div>
	  </div>
<script>
function showEnquiryForm(id)
{
var tabsArr = new Array('tabs-1','tabs-2','tabs-3','tabs-4','tabs-5');
	for(var i=0;i<tabsArr.length;i++)
	{
		if(tabsArr[i]==id)
		{
			document.getElementById(id).className="ui-tabs ui-widget ui-widget-content ui-corner-all";
			if ($("li").hasClass("ui-state-default ui-corner-top ui-tabs-selected ui-state-active"))
			{
				 var n = $(".ui-tabs-nav li").length;
				$(".ui-tabs-nav li").each(function(n){
				   $(".ui-tabs-nav li").removeClass("ui-tabs-selected");
				   $(".ui-tabs-nav li").removeClass("ui-state-active");
				   $(".ui-tabs-nav li").addClass("ui-state-default ui-corner-top");

				});
			}
			window.scrollTo(100,500);
		}
		else
		{
			document.getElementById(tabsArr[i]).className="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide";
		}
	}
}
</script>
  </div>
  
  
  
  
            <?php /*?><div class="ity-gallery">
			
            	
				
				
				<?php
				$sql3=$obj->query("select * from $tbl_set_tour where tour_id=$id",$debug=-1);
			    while($line3=$obj->fetchNextObject($sql3))
				{
				?>
				
				<?php
					if($line3->city_id1)
					{
					$sql4=$obj->query("select * from $tbl_tour where id=$line3->city_id1",$debug=-1);
					$line4=$obj->fetchNextObject($sql4);
					if($line4->tour_image!="")
					{
					?>
					<div class="hori-gallery">
					<img src="<?php echo "images/".$line4->tour_image;  ?>" width="216" height="220" />
					</div>
					<?php
					}
					}
					
					if($line3->city_id2)
					{
					
					$sql4=$obj->query("select * from $tbl_tour where id=$line3->city_id2",$debug=-1);
					$line4=$obj->fetchNextObject($sql4);
					if($line4->tour_image!="")
					{
					?>
					<div class="hori-gallery">
					<img src="<?php echo "images/".$line4->tour_image;  ?>" width="216" height="220" />
					</div>
					<?php
					}
					}
					
					if($line3->city_id3)
					{
					$sql4=$obj->query("select * from $tbl_tour where id=$line3->city_id3",$debug=-1);
					$line4=$obj->fetchNextObject($sql4);
					if($line4->tour_image!="")
					{
					?>
					<div class="hori-gallery">
					<img src="<?php echo "images/".$line4->tour_image;  ?>" width="216" height="220" />
					</div>
					<?php
					}
					}
					?>
					
				<?php	
				}
				?>
				
				
             	
            </div><?php */?>
      		<div class="clear"></div>
      </div>

        <div class="clear"></div>
  </div>
	<?php
	if($conversionLabel){
	?>
		<!-- Google Code for Remarketing than USA Remarketing List -->
		<script type="text/javascript">
		/* <![CDATA[ */
		var google_conversion_id = 984632813;
		var google_conversion_language = "en";
		var google_conversion_format = "3";
		var google_conversion_color = "ffffff";
		var google_conversion_label = "<?=$conversionLabel?>";
		var google_conversion_value = 0;
		/* ]]> */
		</script>
		<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
		</script>
		<noscript>
		<div style="display:inline;">
		<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/984632813/?label=<?=$conversionLabel?>&guid=ON&script=0"/>
		</div>
		</noscript>
	<?php	
	}
	?>
   <?php include "include/bottom_link.php"; ?>
    
    <?php include 'include/footer.php';  ?>
</div>

</body>
<!-- script to stop loader goes here -->
<script language="javascript" type="text/javascript">
  $(window).load(function() {
    $('#loading').hide();
  });
  
</script>

<!-- script to stop loader ends here -->
</html>
