<?php 
session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
validate_admin();
@extract($_REQUEST);
$tourId=mysql_real_escape_string($_REQUEST['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">

<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jscripts/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="jscripts/jquery-ui-1.7.1.custom.min.js"></script>
<style>
.listing{list-style:none; width:1000px;}
.listing li{width:1000px;  }
.listing li td{ float:left; height:23px;  border-top:1px solid #000000; border-bottom:1px solid #000000; font-size:13px; font-family:Arial,Helvetica,sans-serif; padding-top:5px; margin-bottom:4px;}
.slNo{ width:60px; border-left:1px solid #000000;}
.tourType{width:170px; }
.tourDescription{width:730px; border-right:1px solid #000000;}

#contentLeft ul{list-style:none; width:1000px;}
#contentLeft li{width:972px;  }
#contentLeft li td{  height:23px;  border-top:1px solid #5D7F00; border-bottom:1px solid #5D7F00; font-size:13px; font-family:Arial,Helvetica,sans-serif; padding-top:5px; margin-bottom:4px; padding-left:12px;}

</style>

<script type="text/javascript">
$(document).ready(function(){ 
						   
	$(function() {
		$("#contentLeft ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
			$.post("jquery.php?method=manageInclusionOrder&tourId=<?=$tourId?>", order, function(theResponse)
			{
				if(theResponse=='1')
				{
					message='Sequence has been updated in list';
				}
				else if(theResponse=='2')
				{
					message='There was an error during reprocess sequence and might be some sequence was not updated.Please check by refreshing the page';
				}
				else
				{
					message='Sequence was not updated please try again';
				}
				document.getElementById('messageBox').innerHTML=message;
			}); 															 
		}								  
		});
	});

});	
</script>

<script>
	function checkall(objForm)
    {
	len = objForm.elements.length;
	var i=0;
	for( i=0 ; i<len ; i++){
		if (objForm.elements[i].type=='checkbox') 
		objForm.elements[i].checked=objForm.check_all.checked;
	}
   }
	function del_prompt(frmobj,comb)
		{
			if(comb=='Delete'){
				if(confirm ("Are you sure you want to delete record(s)"))
				{
					frmobj.action = "edit-inc-exc-del.php";
					frmobj.submit();
				}
				else{ 
				return false;
				}
		}
		
	}



function deleteExclusion(exclusionId)
{
	if(window.confirm('Do you want to delete selected data?'))
	{
					
		$.post("jquery.php",{action:'deleteTourExclusion',exclusionId:exclusionId},function(result){
				if(result=='1')
				{
					alert('Selected record has been deleted from list');
					window.location.reload();
				}
		  });
	}

}
</script>

	
</head>
<body>
<?php include("header.inc.php");?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="180" valign="top" class="rightBorder">
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
    <td height="400" align="center" valign="top">
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
                          <td>Manage Inclusions/Exclusions - (<?php echo $tour_name; ?>)</td>
                        </tr>
                      </table>
					  <div id="messageBox" style="color:red; width:500; margin-left:200px;"></div>
                      </td>
                     <td width="27%" align="right" style="padding-right:20px; "> 
					 
					  <?php
						if(isset($_GET['returnUrl']))
						{
					?>
							 <input name="b1" type="button" class="button" id="b1" value="Tour Copy Manager" onclick="window.location='<?=$_GET['returnUrl']?>';" />
					<?php
						}
						else
						{
					?>
					   <input type="button" name="Submit" value="Tour Manager" class="button" onclick="location.href='managetour-list.php'" />
					 <?php
						}
					?>
					   </td>  </tr>
              </table>
			</td>
          </tr>
		  
          <tr>
            <td height="400" align="center" valign="top">
			<ul class="listing">
				<li>
					<table>
						<tr>
							<td  style="font-weight:bold; background-color:#009E7D; color:#ffffff; display:inline;" class="slNo">Sl No.</td>
							<td style="background-color:#009E7D;background-color:#009E7D; color:#ffffff; font-weight:bold;" class="tourType">Type</td>
							<td style="font-weight:bold; background-color:#009E7D; color:#ffffff;" class="tourDescription">Description</td>
							
						</tr>
					</table>
				</li>
			</ul>
			<div id="contentLeft" style="margin-top:-20px;">
			<ul >
				
				<?php
					$strsqlSetInclusion = "select * from tbl_set_inclusion_exclusion where tour_id=".$tourId." order  by order_no";
					$resultSetInclusion = mysql_query($strsqlSetInclusion);
					while($infoSetInclusion=mysql_fetch_array($resultSetInclusion,MYSQL_ASSOC))
					{
						$strsqlIncExc = "select * from tbl_inc_exc where id=".$infoSetInclusion['inc_exc_id'];
						$resultIncExc = mysql_query($strsqlIncExc);
						$infoIncExc = mysql_fetch_array($resultIncExc,MYSQL_ASSOC);
						
						
				?>
					<li id="recordsArray_<?=$infoSetInclusion['id']?>">
					
						<table>
						<tr>
						<td class="slNo" style="background-color:#EBEEE3;"><?=$infoSetInclusion['order_no']?></td>
						<td class="tourType" style="background-color:#EBEEE3;"><?=($infoIncExc['incexctype']==1)?'Inclusions':'Exclusions'?></td>
						<td class="tourDescription" style="background-color:#EBEEE3;"><?=$infoIncExc['incexcdesc']?>
						<img src="images/del.gif" style="float:right; cursor:pointer;" onclick="deleteExclusion('<?=$infoSetInclusion['id']?>');">
						</td>
						
						</tr>
						</table>
					</li>
				<?php
					}
				?>
				</ul>
			</div>
			
			</td>
       </tr>
     </table>
	</td>
  </tr>
</table>
<?php include("footer.inc.php");?>
</body>
</html>