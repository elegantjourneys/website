<?php 
ob_start();
$k=0;

//session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
include_once("class/managetour.php");
$objManageTour = new ManageTour();

validate_admin();
@extract($_REQUEST);

if(isset($_POST['submitForm']))
{
	if($_FILES['tour_image']['name']=='')
	{
		if($_POST['tour_image2'])
		$tour_image=mysql_real_escape_string($_POST['tour_image2']);
	}
	else
	{
		$tour_image = time().$_FILES['tour_image']['name'];
		move_uploaded_file($_FILES['tour_image']['tmp_name'],"../images/".$tour_image);
	}
	
	$tour_name = mysql_real_escape_string($_POST['tour_name']);		
	$tour_name2 = mysql_real_escape_string($_POST['tour_name2']);
	$tour_code = mysql_real_escape_string($_POST['tour_code']);
	$tour_place = mysql_real_escape_string($_POST['tour_place']);
	$tour_title = mysql_real_escape_string($_POST['tour_title']);
	$meta_description = mysql_real_escape_string($_POST['meta_description']);
	$meta_keyword = mysql_real_escape_string($_POST['meta_keyword']);	
	$tour_price = mysql_real_escape_string($_POST['tour_price']);
	$internal_airprice = mysql_real_escape_string($_POST['internal_airprice']);
	$route = mysql_real_escape_string($_POST['route']);
	$tour_description = mysql_real_escape_string($_POST['tour_description']);
	$offer = mysql_real_escape_string(ltrim($_POST['offer']));
	$profit = mysql_real_escape_string(ltrim($_POST['profit']));
	
	$zoom_level = mysql_real_escape_string($_POST['zoom_level']);
	$center_lat = mysql_real_escape_string($_POST['center_lat']);
	$center_lng = mysql_real_escape_string($_POST['center_lng']);

	$tour_url = mysql_real_escape_string($_POST['tour_url']);
	
	
	$series= $_POST['series1'].",".$_POST['series2'].",".$_POST['series3'].",".$_POST['series4'].",".$_POST['series5'].",".$_POST['series6'].",".$_POST[  
	'series7'].",".$_POST['series8'].",".$_POST['series9'].",".$_POST['series10'];
		
	$tour_category= $_POST['tour_category1'].",".$_POST['tour_category2'].",".$_POST['tour_category3'].",".$_POST['tour_category4'].",".$_POST['tour_category5'].",".$_POST['tour_category6'].",".$_POST['tour_category7'];
	
	$str_area="";
	$areas_order="";
	$count=0;
	$count2=$_POST['count2'];
	
	for($i=0;$i<$count2;$i++)
    {
	  if($_POST['areas'][$i]!='')
	  {
	  	$str_area=$str_area.$_POST['areas'][$i].",";
		$count3++;
	  }
	  
	 }
	
	
		
	$len=strlen($str_area)-1;
	
	$str_area=substr($str_area,0,$len);

	$tourtype1 = $_POST['tourtype1'];

	$tourtype2 = $_POST['tourtype2'];
	
	$tourtype3 = $_POST['tourtype3'];
	
	$tourtype4 = $_POST['tourtype4'];
	
	$tourtype5 = $_POST['tourtype5'];
	
	$tourtype6 = $_POST['tourtype6'];
	
	$tourtype7 = $_POST['tourtype7'];
	
	$tourtype8 = $_POST['tourtype8'];
	
	$tourtype9 = $_POST['tourtype9'];
	
	$tourtype10 = $_POST['tourtype10'];
	
	$tourtype11 = $_POST['tourtype11'];
	
	$tourtype12 = $_POST['tourtype12'];

	$tourtype13a = $_POST['tourtype13'];
		
	$tourtype13=$tourtype1+$tourtype2+$tourtype3+$tourtype4+$tourtype5+$tourtype6+$tourtype7+$tourtype8+$tourtype9+$tourtype10+$tourtype11+$tourtype12+$tourtype13a;
	
	$tour_duraction = mysql_real_escape_string($_POST['tour_duraction']);
	
	$id = mysql_real_escape_string($_POST['id']);
	
	$offer_date = mysql_real_escape_string($_POST['offer_date']);
	
	$group_remarks = mysql_real_escape_string($_POST['group_remarks']);
	
	$private_remarks = mysql_real_escape_string($_POST['private_remarks']);
	
	$tour_order = mysql_real_escape_string($_POST['tour_order']);

	$selectedTourId = mysql_real_escape_string($_POST['available_id']);
		
	if($id=='')
    {
		
	  $sql=$obj->query("insert into $tbl_managetour set id='$selectedTourId' , tour_name = '$tour_name', tour_name2 = '$tour_name2', tour_code = '$tour_code', tour_place = '$tour_place',tour_title='$tour_title',meta_keyword='$meta_keyword',meta_description='$meta_description',tour_price = '$tour_price',tour_description = '$tour_description',tour_type='$tourtype13',tour_duraction='$tour_duraction',tour_image='$tour_image',areas='$str_area',series='$series', tour_url='$tour_url',
internal_airprice='$internal_airprice',route='$route',offer='$offer', profit='$profit', group_remarks='$group_remarks',private_remarks='$private_remarks',offer_date='$offer_date',tour_category='$tour_category',tour_order='$tour_order',zoom_level='$zoom_level',center_lat='$center_lat',center_lng='$center_lng';
",$debug=1);
	 $id = mysql_insert_id();
	
	 for($i=0;$i<$count8;$i++)
     {
		$subregion_id=$_POST['areas'][$i];
		$order_no=$i+1;
		$sql_order=$obj->query("insert into $tbl_map_order set tour_id=$id,subregion_id=$subregion_id,order_no=$order_no",$debug=1);
	 }
	  
	  
		$_SESSION['sess_msg'] = "Tour has been added suceesfully.";
     }
	 else 
	 {
	   $sql = "update $tbl_managetour set tour_name = '$tour_name', tour_name2 = '$tour_name2', tour_code = '$tour_code',tour_place='$tour_place', tour_title='$tour_title', meta_keyword='$meta_keyword',meta_description='$meta_description',tour_price = '$tour_price',tour_description = '$tour_description',tour_type='$tourtype13',tour_duraction='$tour_duraction',tour_image='$tour_image',areas='$str_area',series='$series',  tour_url='$tour_url',
internal_airprice='$internal_airprice',route='$route',offer='$offer', profit='$profit',group_remarks='$group_remarks',private_remarks='$private_remarks',offer_date='$offer_date',tour_category='$tour_category',tour_order='$tour_order',zoom_level='$zoom_level',center_lat='$center_lat',center_lng='$center_lng' where id = '$id'";	
	   $obj->query($sql,$debug=-1);	
	  
	$sql2="delete from $tbl_map_order where tour_id=$id";
	$obj->query($sql2,$debug=1); 
	$order_no=0;
	 for($i=0;$i<$count3;$i++)
     {
		$subregion_id=$_POST['areas'][$i];
		$order_no=$i+1;
		$sql_order=$obj->query("insert into $tbl_map_order set tour_id=$id,subregion_id=$subregion_id,order_no=$order_no",$debug=1);
	 }
	
	   			
		$_SESSION['sess_msg'] = "Tour has been updated suceesfully.";
      }

	 if(isset($_POST['returnUrl']))
	{
		header("Location: ".$_POST['returnUrl']);
		exit();
	}
	 header("Location: managetour-list.php");
		exit();
}	

if(isset($id))
{
	$result=$obj->query("select * from $tbl_managetour where id='$id'", $debug=-1);
	$num= $obj->numRows($result);
	$line=$obj->fetchNextObject($result);
		
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript" src="richtext_compressed.js"></script>
<script language="JavaScript" type="text/javascript" src="richtext.js"></script>
<!-- TinyMCE -->
<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function validate()
{
    msg = "Please fill the following information:\n\n";
	str = "";
	
	if(document.frm.user_name.value=='')
	{ 
	str+="-Please Insert User Name\n";
	}
	
	if(document.frm.password.value=='')
	{ 
	str+="-Please Insert Password\n";
	}
	
	if(document.frm.password.value!=document.frm.confirm_password.value)
	{ 
	str+="-Password and Confirm must be same\n";
	}
		
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(!document.frm.email.value.match(emailExp))
	{
		str+='-Please enter a valid email address\n';
	}
		
	if(document.frm.first_name.value=='')
	{ 
	str+="-Please Insert First Name\n";
	}
		
	if(document.frm.last_name.value=='')
	{ 
	str+="-Please Insert Last Name\n";
	}
	
	if(document.frm.company.value=='')
	{ 
	str+="-Please Insert company\n";
	}
		
	if(document.frm.company.value=='')
	{ 
	str+="-Please Insert company\n";
	}
	
	if(document.frm.phone1.value=='')
	{ 
	str+="-Please Insert phone1\n";
	}
	
	if(document.frm.phone2.value=='')
	{ 
	str+="-Please Insert phone2\n";
	}
	
	if(str)
	{
		alert(msg+str);
		return false;
	}
	else
  
	{	
	return true;
	}
}


function calculateTotalPrice()
{
	var tourPrice = parseFloat($('#tour_price').val());
	var discountType = $('#profit_type :selected').val();
	
	var tourProfitPrice = parseFloat($('#tour_profit_price').val());
	if(discountType=='percentage_profit')
	{
		tourProfitPrice = (tourPrice*(tourProfitPrice/100));
	}

	var tourTotalPrice = tourPrice + tourProfitPrice;
	$('#tour_total_price').val(tourTotalPrice);
}

function processTourForm()
{
	document.frm.submit();
	
}
</script>
</head>
<body >
<?php include("header.inc.php");?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" valign="top" class="rightBorder">
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center"><?php include("left-menu.inc.php");?></td>
        </tr>
        <tr>
          <td width="23">&nbsp;</td>
        </tr>
      </table>
    <br />
    <br /></td>
    <td width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td align="center" valign="top">
		<table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="21" align="left" class="txt">
				<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="title">
                  <tr>
                    <td height="8" colspan="2"><img src="images/spacer.gif" width="1" height="8" /></td>
                  </tr>
                  <tr>
                    <td width="73%" height="25"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="34" align="center"><img src="images/heading_icon.gif" width="30" height="26" hspace="5" /></td>
                          <td><?php if(isset($id)){?>Edit Tour<?php }else{?>Add New Tour<?php }?></td>
                        </tr>
                    </table></td>
                    <td width="27%" align="right" style="padding-right:20px; ">

					<?php
						if(isset($_GET['returnUrl']))
						{
					?>
							 <input name="b1" type="button" class="button" id="b1" value="Tour Copy Manager" onclick="window.location='<?=$_GET['returnUrl']?>';" />
							 <input type="button" class="button" value="Submit" onclick="processTourForm();" style="cursor:pointer;"/>
					<?php
						}
						else
						{
					?>
				    <input name="b1" type="button" class="button" id="b1" value="Tour Manager" onclick="location.href='managetour-list.php'" />
					<input type="button" class="button" value="Submit" onclick="processTourForm();" style="cursor:pointer;"/>
					<?php
						}
					?>
					
					</td>
                  </tr>
                </table>
			</td>
          </tr>
          <tr>
            <td align="center" valign="top">
                <form name="frm" action="managetour-addf.php" method="post" enctype="multipart/form-data" onsubmit="return validate();">
			    <input type="hidden" name="submitForm" value="yes">
			    <input type="hidden" name="id" class="txtfld" value="<?php echo $id;?>">
				<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
                <table width="98%" border="0" align=center cellpadding="4" cellspacing="1" bgcolor="#D8D8D8">
					<TR align="left"> 
					<TD height="25" colspan="3" class="blueBackground">Please enter following details - </TD>
					</TR>
			    		<?php if(isset($_SESSION['sess_msg'])!=''){?>
					<tr>
						<td colspan="3" align="center"  class="warning"><?php print $_SESSION['sess_msg']; unset($_SESSION['sess_msg']); $sess_msg='';?></td>
					</tr>
						<?php }?>
					<tr class="evenRow">
						<td class="txt" align="right" colspan="3"><span class="warning">*</span> - Required Fields</td>
					</tr>
				  
				    <tr class="oddRow">
				      <td width="332" align="left" class="headTxt" style="width:350px;">Tour Basic Details </td>
				      <td width="330" align="left" class="headTxt" >Tour Map Details </td>
				      <td width="304" align="left" class="headTxt">Tour Image </td>
			      </tr>
				    <tr class="oddRow">
				      <td class="bldTxt" align="left" valign="top"><table width="100%" border="0">
					  <?php
							if(!isset($id))
							{
					  ?>
						<tr>
                          <td width="28%">Available Tour Id</td>
                          <td width="3%">&nbsp;</td>
                          <td width="69%">
						  <? 
								$availableTourIds=$objManageTour->getAvailableTourId(); 
						 ?>
						 <select name="available_id">
							<option value="">New</option>
						<?php
							foreach($availableTourIds as $availableTourId)
							{
						?>
							<option value="<?=$availableTourId?>"><?=$availableTourId?></option>
						<?php
							}
						?>
						 </select>
						  
						  </td>
                        </tr>
						<?php
							}
						  ?>
                        <tr>
                          <td width="28%">Tour Name</td>
                          <td width="3%">&nbsp;</td>
                          <td width="69%"><input name="tour_name" style="width:200px;" type="text" 
						  value="<?php if(isset($id)) echo stripslashes($line->tour_name);   ?>" /></td>
                        </tr>
						<tr>
                          <td width="28%">Tour Name - Line 2</td>
                          <td width="3%">&nbsp;</td>
                          <td width="69%"><input name="tour_name2" style="width:200px;" type="text" 
						  value="<?php if(isset($id)) echo stripslashes($line->tour_name2);   ?>" /></td>
                        </tr>
						<tr>
                          <td width="28%">Tour Code</td>
                          <td width="3%">&nbsp;</td>
                          <td width="69%"><input name="tour_code" style="width:200px;" type="text" 
						  value="<?php if(isset($id)) echo stripslashes($line->tour_code);   ?>" /></td>
                        </tr>
						<tr>
                          <td width="28%">Tour Place</td>
                          <td width="3%">&nbsp;</td>
                          <td width="69%"><input name="tour_place" style="width:200px;" type="text" 
						  value="<?php if(isset($id)) echo stripslashes($line->tour_place);   ?>" /></td>
                        </tr>
                        <tr>
                          <td>Tour Title</td>
                          <td>&nbsp;</td>
                          <td><input name="tour_title" style="width:200px;" type="text" value="<?php if(isset($id)) echo stripslashes($line->tour_title);    ?>" /></td>
                        </tr>
						<tr>
                          <td>Meta Keyword</td>
                          <td>&nbsp;</td>
                          <td><input name="meta_keyword" style="width:200px;" type="text" value="<?php if(isset($id)) echo stripslashes($line->meta_keyword);    ?>" /></td>
                        </tr>
						<tr>
                          <td>Meta Description</td>
                          <td>&nbsp;</td>
                          <td><input name="meta_description" style="width:200px;" type="text" value="<?php if(isset($id)) echo stripslashes($line->meta_description);    ?>" /></td>
                        </tr>
						<tr>
                          <td>Page Name</td>
                          <td>&nbsp;</td>
                          <td><input name="tour_url" style="width:200px;" type="text" value="<?php if(isset($id)) echo stripslashes($line->tour_url);    ?>" />.html</td>
                        </tr>
                       
                        <tr>
                          <td>Tour  Duration</td>
                          <td>&nbsp;</td>
                          <td><input name="tour_duraction" style="width:50px;" type="text" id="tour_duraction" 
					value="<?php if(isset($id)) echo stripslashes($line->tour_duraction);  ?>" />
                          in days</td>
                        </tr>
						
									
                       <tr>
                          <td>Tour Type </td>
                          <td>&nbsp;</td>
                          <td>
						  <?php 
						  if($id)
						  {
						  switch($line->tour_type)
						  {
						  case 1:
						  ?>
						  <input name="tourtype1" id="tourtype1" type="checkbox" checked="checked" value="1" />Group (1)<br />
						  <input name="tourtype2" id="tourtype2" type="checkbox"   value="2" />Private3 (2)<br />
						  <input name="tourtype3" id="tourtype3" type="checkbox"   value="3" />Private1 (3)<br />
  						  <input name="tourtype4" id="tourtype4" type="checkbox"   value="4" />GT (4)<br />					  						                 <input name="tourtype5" id="tourtype5" type="checkbox"   value="5" />GT+VNS (5)<br />
						  <input name="tourtype6" id="tourtype6" type="checkbox"   value="6" />Oberoi (6)<br />
						  <input name="tourtype7" id="tourtype7" type="checkbox"   value="7" />GT+RAJ (7)<br />
						  <input name="tourtype8" id="tourtype8" type="checkbox"   value="8" />Taj (8)<br />
						  <input name="tourtype9" id="tourtype9" type="checkbox"   value="9" />Kerala (9)<br />
						  <input name="tourtype10" id="tourtype10" type="checkbox"   value="10" />Bhutan (10)<br />
						  <input name="tourtype11" id="tourtype11" type="checkbox"   value="11" />Nepal (11)<br />
						  <input name="tourtype12" id="tourtype12" type="checkbox"   value="12" />Misc (12)<br />
						  <input name="tourtype13" id="tourtype13" type="checkbox"   value="13" />Misc (13)		

			              <?php
						  break;
						 case 2:
						  ?>
						  <input name="tourtype1" id="tourtype1" type="checkbox"  value="1" />Group (1)<br />
						  <input name="tourtype2" id="tourtype2" type="checkbox"  checked="checked" value="2" />Private3 (2)<br />
						  <input name="tourtype3" id="tourtype3" type="checkbox"   value="3" />Private1 (3)<br />
  						  <input name="tourtype4" id="tourtype4" type="checkbox"   value="4" />GT (4)	<br />					  						  <input name="tourtype5" id="tourtype5" type="checkbox"   value="5" />GT+VNS (5)<br /> 
						  <input name="tourtype6" id="tourtype6" type="checkbox"   value="6" />Oberoi (6)<br />
						  <input name="tourtype7" id="tourtype7" type="checkbox"   value="7" />GT+RAJ (7)<br />					                          <input name="tourtype8" id="tourtype8" type="checkbox"   value="8" />Taj (8)<br />
						  <input name="tourtype9" id="tourtype9" type="checkbox"   value="9" />Kerala (9)<br />
						  <input name="tourtype10" id="tourtype10" type="checkbox"   value="10" />Bhutan (10)<br />
						  <input name="tourtype11" id="tourtype11" type="checkbox"   value="11" />Nepal (11)<br />
						  <input name="tourtype12" id="tourtype12" type="checkbox"   value="12" />Misc (12)<br />
						  <input name="tourtype13" id="tourtype13" type="checkbox"   value="13" />Misc (13)	
						<?php
						  break;
						 case 3:
						  ?>
						  <input name="tourtype1" id="tourtype1" type="checkbox"  value="1" />Group (1)<br />
						  <input name="tourtype2" id="tourtype2" type="checkbox"   value="2" />Private3 (2)<br />
						  <input name="tourtype3" id="tourtype3" type="checkbox" checked="checked"  value="3" />Private1 (3)<br />
  						  <input name="tourtype4" id="tourtype4" type="checkbox"   value="4" />GT (4)<br />				  						  <input name="tourtype5" id="tourtype5" type="checkbox"   value="5" />GT+VNS (5)<br />
						  <input name="tourtype6" id="tourtype6" type="checkbox"   value="6" />Oberoi (6)<br />
						  <input name="tourtype7" id="tourtype7" type="checkbox"   value="7" />GT+RAJ (7)<br />
						  <input name="tourtype8" id="tourtype8" type="checkbox"   value="8" />Taj (8)<br />
						  <input name="tourtype9" id="tourtype9" type="checkbox"   value="9" />Kerala (9)<br />
						  <input name="tourtype10" id="tourtype10" type="checkbox"   value="10" />Bhutan (10)<br />
						  <input name="tourtype11" id="tourtype11" type="checkbox"   value="11" />Nepal (11)<br />
						  <input name="tourtype12" id="tourtype12" type="checkbox"   value="12" />Misc (12)<br />
						  <input name="tourtype13" id="tourtype13" type="checkbox"   value="13" />Misc (13)	
						  <?php
						  break;
						 case 4:
						  ?>
						  <input name="tourtype1" id="tourtype1" type="checkbox"  value="1" />Group (1)<br />
						  <input name="tourtype2" id="tourtype2" type="checkbox"   value="2" />Private3 (2)<br />
						  <input name="tourtype3" id="tourtype3" type="checkbox"   value="3" />Private1 (3)<br />
  						 <input name="tourtype4" id="tourtype4" type="checkbox" checked="checked"  value="4" />GT (4)<br />
						  <input name="tourtype5" id="tourtype5" type="checkbox"   value="5" />GT+VNS (5)<br />
						  <input name="tourtype6" id="tourtype6" type="checkbox"   value="6" />Oberoi (6)<br />
						  <input name="tourtype7" id="tourtype7" type="checkbox"   value="7" />GT+RAJ (7)<br />
						  <input name="tourtype8" id="tourtype8" type="checkbox"   value="8" />Taj (8)<br />
						  <input name="tourtype9" id="tourtype9" type="checkbox"   value="9" />Kerala (9)<br />
						  <input name="tourtype10" id="tourtype10" type="checkbox"   value="10" />Bhutan (10)<br />
						  <input name="tourtype11" id="tourtype11" type="checkbox"   value="11" />Nepal (11)<br />
						  <input name="tourtype12" id="tourtype12" type="checkbox"   value="12" />Misc (12)<br />
						  <input name="tourtype13" id="tourtype13" type="checkbox"   value="13" />Misc (13)	
						  <?php
						  break;
						 case 5:
						  ?>
						  <input name="tourtype1" id="tourtype1" type="checkbox"  value="1" />Group (1)<br />
						  <input name="tourtype2" id="tourtype2" type="checkbox"   value="2" />Private3 (2)<br />
						  <input name="tourtype3" id="tourtype3" type="checkbox"   value="3" />Private1 (3)<br />
  						  <input name="tourtype4" id="tourtype4" type="checkbox"   value="4" />GT (4)<br />						  						  <input name="tourtype5" id="tourtype5" type="checkbox" checked="checked"  value="5" />GT+VNS (5)<br />
						  <input name="tourtype6" id="tourtype6" type="checkbox"   value="6" />Oberoi (6)<br />
						  <input name="tourtype7" id="tourtype7" type="checkbox"   value="7" />GT+RAJ (7)<br />
						  <input name="tourtype8" id="tourtype8" type="checkbox"   value="8" />Taj (8)<br />
						  <input name="tourtype9" id="tourtype9" type="checkbox"   value="9" />Kerala (9)<br />
						  <input name="tourtype10" id="tourtype10" type="checkbox"   value="10" />Bhutan (10)<br />
						  <input name="tourtype11" id="tourtype11" type="checkbox"   value="11" />Nepal (11)<br />
						  <input name="tourtype12" id="tourtype12" type="checkbox"   value="12" />Misc (12)<br />
						  <input name="tourtype13" id="tourtype13" type="checkbox"   value="13" />Misc (13)	
						  <?php
						  break;
						 case 6:
						  ?>
						  <input name="tourtype1" id="tourtype1" type="checkbox"  value="1" />Group (1)<br />
						  <input name="tourtype2" id="tourtype2" type="checkbox"   value="2" />Private3 (2)<br />
						  <input name="tourtype3" id="tourtype3" type="checkbox"   value="3" />Private1 (3)<br />
  						  <input name="tourtype4" id="tourtype4" type="checkbox"   value="4" />GT (4)<br />						  						  <input name="tourtype5" id="tourtype5" type="checkbox"   value="5" />GT+VNS (5)<br />
						  <input name="tourtype6" id="tourtype6" type="checkbox" checked="checked"  value="6" />Oberoi (6)<br />
						  <input name="tourtype7" id="tourtype7" type="checkbox"   value="7" />GT+RAJ (7)<br />
						  <input name="tourtype8" id="tourtype8" type="checkbox"   value="8" />Taj (8)<br />
						  <input name="tourtype9" id="tourtype9" type="checkbox"   value="9" />Kerala (9)<br />
						  <input name="tourtype10" id="tourtype10" type="checkbox"   value="10" />Bhutan (10)<br />
						  <input name="tourtype11" id="tourtype11" type="checkbox"   value="11" />Nepal (11)<br />
						  <input name="tourtype12" id="tourtype12" type="checkbox"   value="12" />Misc (12)<br />
						  <input name="tourtype13" id="tourtype13" type="checkbox"   value="13" />Misc (13)	
						  <?php
						  break;
						 case 7:
						  ?>
						  <input name="tourtype1" id="tourtype1" type="checkbox"  value="1" />Group (1)<br />
						  <input name="tourtype2" id="tourtype2" type="checkbox"   value="2" />Private3 (2)<br />
						  <input name="tourtype3" id="tourtype3" type="checkbox"   value="3" />Private1 (3)<br />
  						  <input name="tourtype4" id="tourtype4" type="checkbox"   value="4" />GT (4)<br />					  						  <input name="tourtype5" id="tourtype5" type="checkbox"   value="5" />GT+VNS (5)<br /> 
						  <input name="tourtype6" id="tourtype6" type="checkbox"   value="6" />Oberoi (6)<br />
						  <input name="tourtype7" id="tourtype7" type="checkbox" checked="checked"  value="7" />GT+RAJ (7)<br />						                          <input name="tourtype8" id="tourtype8" type="checkbox"   value="8" />Taj (8)<br />
						  <input name="tourtype9" id="tourtype9" type="checkbox"   value="9" />Kerala (9)<br />
						  <input name="tourtype10" id="tourtype10" type="checkbox"   value="10" />Bhutan (10)<br />
						  <input name="tourtype11" id="tourtype11" type="checkbox"   value="11" />Nepal (11)<br />
						  <input name="tourtype12" id="tourtype12" type="checkbox"   value="12" />Misc (12)<br />
						  <input name="tourtype13" id="tourtype13" type="checkbox"   value="13" />Misc (13)	
						<?php
						  break;
						 case 8:
						  ?>
						  <input name="tourtype1" id="tourtype1" type="checkbox"  value="1" />Group (1)<br />
						  <input name="tourtype2" id="tourtype2" type="checkbox"   value="2" />Private3 (2)<br />
						  <input name="tourtype3" id="tourtype3" type="checkbox"   value="3" />Private1 (3)<br />
  						  <input name="tourtype4" id="tourtype4" type="checkbox"   value="4" />GT (4)<br />					  						  <input name="tourtype5" id="tourtype5" type="checkbox"   value="5" />GT+VNS (5)<br /> 
						  <input name="tourtype6" id="tourtype6" type="checkbox"   value="6" />Oberoi (6)<br />
						  <input name="tourtype7" id="tourtype7" type="checkbox"  value="7" />GT+RAJ (7)<br />						                          <input name="tourtype8" id="tourtype8" type="checkbox" checked="checked"  value="8" />Taj (8)<br />
						  <input name="tourtype9" id="tourtype9" type="checkbox"   value="9" />Kerala (9)<br />
						  <input name="tourtype10" id="tourtype10" type="checkbox"   value="10" />Bhutan (10)<br />
						  <input name="tourtype11" id="tourtype11" type="checkbox"   value="11" />Nepal (11)<br />
						  <input name="tourtype12" id="tourtype12" type="checkbox"   value="12" />Misc (12)
						  <?php
						  break;
						 case 9:
						  ?>
						  <input name="tourtype1" id="tourtype1" type="checkbox"  value="1" />Group (1)<br />
						  <input name="tourtype2" id="tourtype2" type="checkbox"   value="2" />Private3 (2)<br />
						  <input name="tourtype3" id="tourtype3" type="checkbox"   value="3" />Private1 (3)<br />
  						  <input name="tourtype4" id="tourtype4" type="checkbox"   value="4" />GT (4)<br />					  						  <input name="tourtype5" id="tourtype5" type="checkbox"   value="5" />GT+VNS (5)<br /> 
						  <input name="tourtype6" id="tourtype6" type="checkbox"   value="6" />Oberoi (6)<br />
						  <input name="tourtype7" id="tourtype7" type="checkbox"  value="7" />GT+RAJ (7)<br />						                          <input name="tourtype8" id="tourtype8" type="checkbox"   value="8" />Taj (8)<br />
						  <input name="tourtype9" id="tourtype9" type="checkbox"  checked="checked"  value="9" />Kerala (9)<br />
						  <input name="tourtype10" id="tourtype10" type="checkbox"   value="10" />Bhutan (10)<br />
						  <input name="tourtype11" id="tourtype11" type="checkbox"   value="11" />Nepal (11)<br />
						  <input name="tourtype12" id="tourtype12" type="checkbox"   value="12" />Misc (12)<br />
						  <input name="tourtype13" id="tourtype13" type="checkbox"   value="13" />Misc (13)	
						  <?php
						  break;
						 case 10:
						  ?>
						  <input name="tourtype1" id="tourtype1" type="checkbox"  value="1" />Group (1)<br />
						  <input name="tourtype2" id="tourtype2" type="checkbox"   value="2" />Private3 (2)<br />
						  <input name="tourtype3" id="tourtype3" type="checkbox"   value="3" />Private1 (3)<br />
  						  <input name="tourtype4" id="tourtype4" type="checkbox"   value="4" />GT (4)<br />					  						  <input name="tourtype5" id="tourtype5" type="checkbox"   value="5" />GT+VNS (5)<br /> 
						  <input name="tourtype6" id="tourtype6" type="checkbox"   value="6" />Oberoi (6)<br />
						  <input name="tourtype7" id="tourtype7" type="checkbox"   value="7" />GT+RAJ (7)<br />						                          <input name="tourtype8" id="tourtype8" type="checkbox"   value="8" />Taj (8)<br />
						  <input name="tourtype9" id="tourtype9" type="checkbox"   value="9" />Kerala (9)<br />
					 <input name="tourtype10" id="tourtype10" type="checkbox"  checked="checked"  value="10" />Bhutan (10)<br />
						  <input name="tourtype11" id="tourtype11" type="checkbox"   value="11" />Nepal (11)<br />
						  <input name="tourtype12" id="tourtype12" type="checkbox"   value="12" />Misc (12)<br />
						  <input name="tourtype13" id="tourtype13" type="checkbox"   value="13" />Misc (13)	
						  <?php
						  break;
						 case 11:
						  ?>
						  <input name="tourtype1" id="tourtype1" type="checkbox"  value="1" />Group (1)<br />
						  <input name="tourtype2" id="tourtype2" type="checkbox"   value="2" />Private3 (2)<br />
						  <input name="tourtype3" id="tourtype3" type="checkbox"   value="3" />Private1 (3)<br />
  						  <input name="tourtype4" id="tourtype4" type="checkbox"   value="4" />GT (4)<br />					  						  <input name="tourtype5" id="tourtype5" type="checkbox"   value="5" />GT+VNS (5)<br /> 
						  <input name="tourtype6" id="tourtype6" type="checkbox"   value="6" />Oberoi (6)<br />
						  <input name="tourtype7" id="tourtype7" type="checkbox"   value="7" />GT+RAJ (7)<br />						                          <input name="tourtype8" id="tourtype8" type="checkbox"   value="8" />Taj (8)<br />
						  <input name="tourtype9" id="tourtype9" type="checkbox"   value="9" />Kerala (9)<br />
						  <input name="tourtype10" id="tourtype10" type="checkbox"   value="10" />Bhutan (10)<br />
						  <input name="tourtype11" id="tourtype11" type="checkbox"  checked="checked"  value="11" />Nepal (11)<br />
						  <input name="tourtype12" id="tourtype12" type="checkbox"   value="12" />Misc (12)<br />
						  <input name="tourtype13" id="tourtype13" type="checkbox"   value="13" />Misc (13)	
						  <?php
						  break;
						 case 12:
						  ?>
						  <input name="tourtype1" id="tourtype1" type="checkbox"  value="1" />Group (1)<br />
						  <input name="tourtype2" id="tourtype2" type="checkbox"   value="2" />Private3 (2)<br />
						  <input name="tourtype3" id="tourtype3" type="checkbox"   value="3" />Private1 (3)<br />
  						  <input name="tourtype4" id="tourtype4" type="checkbox"   value="4" />GT (4)<br />					  						  <input name="tourtype5" id="tourtype5" type="checkbox"   value="5" />GT+VNS (5)<br /> 
						  <input name="tourtype6" id="tourtype6" type="checkbox"   value="6" />Oberoi (6)<br />
						  <input name="tourtype7" id="tourtype7" type="checkbox"   value="7" />GT+RAJ (7)<br />						                          <input name="tourtype8" id="tourtype8" type="checkbox"   value="8" />Taj (8)<br />
						  <input name="tourtype9" id="tourtype9" type="checkbox"   value="9" />Kerala (9)<br />
						  <input name="tourtype10" id="tourtype10" type="checkbox"   value="10" />Bhutan (10)<br />
						  <input name="tourtype11" id="tourtype11" type="checkbox"   value="11" />Nepal (11)<br />
						  <input name="tourtype12" id="tourtype12" type="checkbox"  checked="checked"  value="12" />Misc (12)<br />
						  <input name="tourtype13" id="tourtype13" type="checkbox"   value="13" />Misc (13)	
						  <?php
						break;
						  case 13:
						  ?>
						  <input name="tourtype1" id="tourtype1" type="checkbox"  value="1" />Group (1)<br />
						  <input name="tourtype2" id="tourtype2" type="checkbox"   value="2" />Private3 (2)<br />
						  <input name="tourtype3" id="tourtype3" type="checkbox"   value="3" />Private1 (3)<br />
  						  <input name="tourtype4" id="tourtype4" type="checkbox"   value="4" />GT (4)<br />					  						  <input name="tourtype5" id="tourtype5" type="checkbox"   value="5" />GT+VNS (5)<br /> 
						  <input name="tourtype6" id="tourtype6" type="checkbox"   value="6" />Oberoi (6)<br />
						  <input name="tourtype7" id="tourtype7" type="checkbox"   value="7" />GT+RAJ (7)<br />						                          <input name="tourtype8" id="tourtype8" type="checkbox"   value="8" />Taj (8)<br />
						  <input name="tourtype9" id="tourtype9" type="checkbox"   value="9" />Kerala (9)<br />
						  <input name="tourtype10" id="tourtype10" type="checkbox"   value="10" />Bhutan (10)<br />
						  <input name="tourtype11" id="tourtype11" type="checkbox"   value="11" />Nepal (11)<br />
						  <input name="tourtype12" id="tourtype12" type="checkbox"    value="12" />Misc (12)<br />
						  <input name="tourtype13" id="tourtype13" type="checkbox"   value="13" checked="checked"/>Misc (13)	
						  <?php
						break;
						default:
						?>
     					  <input name="tourtype1" id="tourtype1" type="checkbox"  value="1" />Group1 (1)<br />
						  <input name="tourtype2" id="tourtype2" type="checkbox"   value="2" />Private3 (2)<br />
						  <input name="tourtype3" id="tourtype3" type="checkbox"   value="3" />Private1 (3)<br />
  						  <input name="tourtype4" id="tourtype4" type="checkbox"   value="4" />GT (4)<br /> 						  						  <input name="tourtype5" id="tourtype5" type="checkbox"   value="5" />GT+VNS (5)<br /> 
						  <input name="tourtype6" id="tourtype6" type="checkbox"   value="6" />Oberoi (6)<br />
						  <input name="tourtype7" id="tourtype7" type="checkbox"   value="7" />GT+RAJ (7)<br />
						  <input name="tourtype8" id="tourtype8" type="checkbox"   value="8" />Taj (8)<br />
						  <input name="tourtype9" id="tourtype9" type="checkbox"   value="9" />Kerala (9)<br />
						  <input name="tourtype10" id="tourtype10" type="checkbox"   value="10" />Bhutan (10)<br />
						  <input name="tourtype11" id="tourtype11" type="checkbox"   value="11" />Nepal (11)<br />
						  <input name="tourtype12" id="tourtype12" type="checkbox"   value="12" />Misc (12)<br />
						  <input name="tourtype13" id="tourtype13" type="checkbox"   value="13" />Misc (13)	
						<?php
						}
						}
						else
						{
						?>
                          <input name="tourtype1" id="tourtype1" type="checkbox"  value="1" />Group (1)<br />
						  <input name="tourtype2" id="tourtype2" type="checkbox"  value="2" />Private3 (2)<br />
						  <input name="tourtype3" id="tourtype3" type="checkbox"   value="3" />Private1 (3) <br />
  						  <input name="tourtype4" id="tourtype4" type="checkbox"   value="4" />GT (4) 	<br />					  						  <input name="tourtype5" id="tourtype5" type="checkbox"   value="5" />GT+VNS (5)<br />
	     				  <input name="tourtype6" id="tourtype6" type="checkbox"   value="6" />Oberoi (6)<br />
						  <input name="tourtype7" id="tourtype7" type="checkbox"   value="7" />GT+RAJ (7)<br />
						  <input name="tourtype8" id="tourtype8" type="checkbox"   value="8" />Taj (8)<br />
						  <input name="tourtype9" id="tourtype9" type="checkbox"   value="9" />Kerala (9)<br />
						  <input name="tourtype10" id="tourtype10" type="checkbox"   value="10" />Bhutan (10)<br />
						  <input name="tourtype11" id="tourtype11" type="checkbox"   value="11" />Nepal (11)<br />
						  <input name="tourtype12" id="tourtype12" type="checkbox"   value="12" />Misc (12)<br />
						  <input name="tourtype13" id="tourtype13" type="checkbox"   value="13" />Misc (13)	
						
						<?php
						}
						?></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table></td>
				      <td class="bldTxt" align="left" valign="top"><table width="346" border="0">
                        <tr>
                          <td width="40%">Zoom Level </td>
                          <td width="60%"><input name="zoom_level" style="width:150px;" type="text" value="<?php if(isset($id)) echo stripslashes($line->zoom_level);   ?>" /></td>
                        </tr>
                        <tr>
                          <td>Center Latitude </td>
                          <td><input name="center_lat" style="width:150px;" type="text" value="<?php if(isset($id)) echo stripslashes($line->center_lat);   ?>" /></td>
                        </tr>
                        <tr>
                          <td>Center Lanitude </td>
                          <td><input name="center_lng" style="width:150px;" type="text" value="<?php if(isset($id)) echo stripslashes($line->center_lng);   ?>" /></td>
                        </tr>
                      </table>
					  <br />

					 <!-- <table width="100%" border="0">
						<tr>
                          <td colspan="2" class="headTxt" style="padding:5px;">Price Setting </td>
                         
                        </tr>
                        <tr>
                          <td>Tour Price</td>
                          <td><input name="tour_price" style="width:100px;" type="text" id="tour_price" 
					value="<?php if(isset($id)) echo stripslashes($line->tour_price);   ?>" onchange="calculateTotalPrice();"/></td>
                        </tr>
                         <tr>
                          <td>Profit </td>
                          <td><input name="offer" type="text" style="width:100px"
						  value="<?php if(isset($id)) echo stripslashes($line->profit);  ?>"
						   id="tour_profit_price" onchange="calculateTotalPrice();"/>

						   <select id="profit_type" name="profit_type" onchange="calculateTotalPrice();">
								<option value="flat_profit">Flat Profit</option>
								<option value="percentage_profit">Percentage Profit</option>
						   </select>
                         </td>
                        </tr>
                        <tr>
                          <td>Total Price </td>
                          <td><input name="profit" style="width:100px" type="text" value="<?php if(isset($id)) echo stripslashes($line->total_price);   ?>" id="tour_total_price" onchange="calculateTotalPrice();"/></td>
                        </tr>
                      </table>-->
					  
					   <table width="100%" border="0">
						<tr>
                          <td colspan="2" class="headTxt" style="padding:5px;">Price Setting </td>
                         
                        </tr>
                        <tr>
                          <td>Tour Price</td>
                          <td><input name="tour_price" style="width:100px;" type="text" id="tour_price" 
					value="<?php if(isset($id)) echo stripslashes($line->tour_price);   ?>" /></td>
                        </tr>
                         <tr>
						
                          <td>Profit </td>
                          <td><input name="profit" type="text" style="width:40px"
						  value="<?php if(isset($id)) echo stripslashes($line->profit);  ?>"
						   id="tour_profit_price" />%

						  
                         </td>
                        </tr>

						<tr>
						
                          <td>Offer </td>
                          <td><input name="offer" type="text" style="width:40px"
						  value="<?php if(isset($id)) echo stripslashes($line->offer);  ?>"
						   id="tour_profit_price" />%

						  
                         </td>
                        </tr>
                       
                      </table>
					  
					  </td>
				      <td class="bldTxt" align="left" valign="top"><table width="100%" border="0">
                        <tr>
                          <td><span class="bldTxt" style="width:300px;"><img src="<?php echo "../images/$line->tour_image"; ?>" width="210" height="173" /><span class="bldTxt" style="width:300px;">
                            <input name="tour_image2" type="hidden" id="tour_image2" 
					value="<?php if($id) echo stripslashes($line->tour_image);  else  echo $tour_image;  ?>" />
                          </span></span></td>
                        </tr>
                        <tr>
                          <td><input name="tour_image" type="file" id="tour_image" />
                          (Width=218,Height=240px)</td>
                        </tr>
                      </table></td>
			      </tr>
				    
				    <tr class="oddRow">
				      <td colspan="3" align="left" class="bldTxt" style="width:300px;">&nbsp;</td>
			      </tr>
				    <tr class="oddRow">
				      <td colspan="3" align="left" class="headTxt" style="width:300px;">Tour Other Details </td>
			      </tr>
				    <tr class="oddRow">
				      <td colspan="3" align="left" valign="top" class="bldTxt"><table width="100%" border="0">
                        <tr>
                          <td width="23%"><span class="bldTxt" style="width:300px;">Tour Category </span></td>
                          <td width="77%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="13%">
							  <?php 
							  if(isset($id)) 
							  {
							  $tour_category_array=explode(",",stripslashes($line->tour_category));
							  }
							  ?>
							  <input name="tour_category1" type="checkbox"
							  <?php  if(isset($id)){if(in_array("All India",$tour_category_array)) {?>checked="checked"<?php }} ?> 
							  value="All India"  />
                              All India</td>
                              <td width="15%"><input name="tour_category2" type="checkbox"
							  <?php  if(isset($id)){if(in_array("North India",$tour_category_array)) {?>checked="checked"<?php }} ?> 
							  value="North India" />
                              North India</td>
                              <td width="12%">
							  <input name="tour_category4" type="checkbox"
							  <?php  if(isset($id)){if(in_array("Festival",$tour_category_array)) {?>checked="checked"<?php }} ?> 
							  value="Festival" />
                              Festival</td>
                              <td width="14%">
<input name="tour_category3" type="checkbox"
							  <?php  if(isset($id)){if(in_array("South India",$tour_category_array)) {?>checked="checked"<?php }} ?> 
							  value="South India" />                              
South India</td>
                              <td width="16%"><input name="tour_category5" type="checkbox"
							  <?php  if(isset($id)){if(in_array("Trip Extensions",$tour_category_array)) {?>checked="checked"<?php }} ?> 
							  value="Trip Extensions" />
                              Trip Extensions</td>
                              <td width="13%"><input name="tour_category6" type="checkbox"
							  <?php  if(isset($id)){if(in_array("East-West",$tour_category_array)) {?>checked="checked"<?php }} ?> 
							  value="East-West" />
                              East-West</td>
                              <td width="17%"><input name="tour_category7" type="checkbox"
							  <?php  if(isset($id)){if(in_array("Other Nations",$tour_category_array)) {?>checked="checked"<?php }} ?> 
							  value="Other Nations" />
                              Other Nations</td>
                            </tr>
                            
                            
                          </table></td>
                        </tr>
                        <tr>
                          <td>Covered Area</td>
                          <td><table border="1" cellpadding="0" cellspacing="0">
                            <tr>
                     <?php
							   
					if(isset($id)) 
					{
							  $tour_areas_array=explode(",",stripslashes($line->areas));
				    }
							  
					$sql3=$obj->query("select * from $tbl_subregion order by region_location",$debug=-1);
					$count=0;
					while($line3=$obj->fetchNextObject($sql3))
					{
					if($count==7)
					{
					echo "</tr><tr>";
					$count=0;
					}	
					?>
                     <td>
					 <input type="checkbox" name="areas[]"  
					<?php  if(isset($id)){if(in_array($line3->id,$tour_areas_array)) 
					{?>checked="checked"<?php }} ?>  value="<?php echo $line3->id; ?>" />
                                  <?php
					 echo $line3->region_location; 
					 $count++;
					 $count2++;
					 ?>
							  
				     <?php 
					 
					
					}
					?>					</td>
					<td><input type="hidden" name="count2" value="<?php echo $count2; ?>" />					</td>
                            </tr>
                          </table>                          </td>
                        </tr>
                        <tr>
                          <td>Series</td>
                          <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
						  <?php 
						     if(isset($id)) 
							  {
							  $tour_series_array=explode(",",stripslashes($line->series));
							  }
					      ?>
                            <tr>
                              <td width="109"><input name="series1" id="series1" type="checkbox"
							  <?php  if(isset($id)){if(in_array("series1",$tour_series_array)) {?>checked="checked"<?php }} ?>
						      value="series1" />
                                series1</td>
                              <td width="109"><input name="series2" id="series2" type="checkbox"
							   <?php  if(isset($id)){if(in_array("series2",$tour_series_array)) {?>checked="checked"<?php }} ?>
							   value="series2" />
                                series2</td>
                              <td width="109"><input name="series3" id="series3" type="checkbox"
							  <?php  if(isset($id)){if(in_array("series3",$tour_series_array)) {?>checked="checked"<?php }} ?>
							   value="series3" />
                                series3</td>
                              <td width="148"><input name="series4" id="series4" type="checkbox"
							  <?php  if(isset($id)){if(in_array("series4",$tour_series_array)) {?>checked="checked"<?php }} ?>
							   value="series4" />
                              series4</td>
                              <td width="241"><input name="series5" id="series5" type="checkbox"
							  <?php  if(isset($id)){if(in_array("series5",$tour_series_array)) {?>checked="checked"<?php }} ?>
							   value="series5" />
                              series5</td>
                              <td width="241"><input name="series6" id="series6" type="checkbox"
                              <?php  if(isset($id)){if(in_array("series6",$tour_series_array)) {?>checked="checked"<?php }} ?>
							   value="series6" />
                              series6</td>
                              <td width="241"><input name="series7" id="series7" type="checkbox"
							 <?php  if(isset($id)){if(in_array("series7",$tour_series_array)) {?>checked="checked"<?php }} ?>
							   value="series7" />
                              series7</td>
                              <td width="241"><input name="series8" id="series8" type="checkbox"
							<?php  if(isset($id)){if(in_array("series8",$tour_series_array)) {?>checked="checked"<?php }} ?>
							   value="series8" />
                              series8</td>
                            </tr>
                            
                          </table></td>
                        </tr>
                       
                        <tr>
                          <td>Offer Date</td>
                          <td><input name="offer_date" type="text"
						  value="<?php if(isset($id)) echo stripslashes($line->offer_date);  ?>"
						  />
like 25-Nov-2010</td>
                        </tr>
                        <tr>
                          <td>Tour Order </td>
                          <td><input name="tour_order" type="text" style="width:40px"
						  value="<?php if(isset($id)) echo stripslashes($line->tour_order);  ?>"></td>
                        </tr>
                        <tr>
                          <td>Internal Air Travel</td>
                          <td><input name="internal_airprice" style="width:200px;" type="text" id="internal_airprice" 
					value="<?php if(isset($id)) echo stripslashes($line->internal_airprice);  ?>" /></td>
                        </tr>
                        <tr>
                          <td>Route </td>
                          <td><input name="route" style="width:400px;" type="text" id="route" 
					value="<?php if(isset($id)) echo stripslashes($line->route);  ?>" /></td>
                        </tr>
						   
						
                      </table>				  	  					</td>
			      </tr>
				    
				    <tr class="oddRow">
				      <td colspan="3" align="left" class="bldTxt">&nbsp;</td>
			      </tr>
				    <tr class="oddRow">
				      <td colspan="3" align="left" class="headTxt">Tour Description </td>
			      </tr>
				    <tr class="oddRow">
				      <td colspan="3" align="left" class="bldTxt">
					  <textarea id="tour_description" name="tour_description" rows="15" cols="100" style="width: 100%">
			
				<?php if(isset($id)) echo stripslashes($line->tour_description); ?>
			</textarea>					  </td>
			      </tr>
				    <tr class="oddRow">
				      <td colspan="3" align="left" class="bldTxt">&nbsp;</td>
			      </tr>
				    <tr class="oddRow">
				      <td colspan="3" align="left" class="bldTxt">
					  <table width="100%" border="0">
                        <tr>
                          <td>Group Price Remarks </td>
                        </tr>
                        <tr>
                          <td>
						  <textarea name="group_remarks" rows="3" cols="100" style="width: 100%">
						  <?php if($id) echo stripslashes($line->group_remarks);  else  echo $group_remarks;  ?>
						  </textarea></td>
                        </tr>
                        <tr>
                          <td>Private Price Remarks </td>
                        </tr>
                        <tr>
                          <td>
						  <textarea name="private_remarks" rows="3" cols="100" style="width: 100%">
						  <?php if($id) echo stripslashes($line->private_remarks);  else  echo $private_remarks;  ?>
						  </textarea>						  </td>
                        </tr>
                      </table>					  </td>
			      </tr>
			      
				  
				 				 

				  
				   <tr class="evenRow">
					<td align=center >&nbsp;</td>
					<td align=left >&nbsp;</td>
					<td align=right ><input type="submit" class="button" value="Submit"/></td>
			    </tr>
            </table>
	        </form>
	     </td>
       </tr>
	   <tr><td colspan="100%">&nbsp;</td></tr>
     </table>
	</td>
  </tr>
</table>
<?php include("footer.inc.php");?>
</body>
</html>
