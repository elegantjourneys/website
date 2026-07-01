<?php 
session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");

validate_admin();
@extract($_REQUEST);
include_once("../library/library.php");
include_once("../class/campaign-class.php");
$objCampaign = new Campaign();

$post = decodeWebUrl($_GET);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />

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
                          <td>View Campaign Visitors</td>
                        </tr>
                      </table>
                      </td>
                     <td width="27%" align="right" style="padding-right:20px; "> 
						<?php
							$urlParameters = "campaignId=".$post['campaignId'];
							$cryptUrlParameters = incodeUrl($urlParameters);
						?>
					   <input type="button" name="Submit" value="Go To Visitor List" class="button" onclick="location.href='campaign-visitors-list.php?eid=<?=$cryptUrlParameters?>'" style="display:none;" id="gotoVisitorList"/></td>  </tr>
              </table>
			</td>
          </tr>

          <tr>
            <td height="400" align="center" valign="top">
              <table width="98%" border="0" cellpadding="5" cellspacing="0">
			 
                <tr>
                  <td height="347" align="center" valign="top">
				  <span class="warning">
				  <?php print $_SESSION['sess_msg']; unset($_SESSION['sess_msg']); $sess_msg='';?></span> <br />
				    

					<?php
						switch($post['viewType'])
						{
							case 'viewVisitorDetail':
								$visitorDetail=$objCampaign->getVisitorInfoById($post['visitorId']);
							  
					?>

									<script>
										document.getElementById('gotoVisitorList').style.display='inline';
									</script>
									<form onsubmit="return validateForm();" enctype="multipart/form-data" method="post" action="" name="frmCampaign">
									<input type="hidden" name="process" value="updateCampaign">
									<input type="hidden" name="campaign_id" value="<?=$campaignDetail['campaign_id']?>">
									<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
									<table width="98%" cellspacing="1" cellpadding="4" border="0" bgcolor="#D8D8D8" align="center">
										<tbody><tr align="left"> 
										<td height="25" class="blueBackground" colspan="2">Visitor Detail </td>
										</tr>
											<tr class="evenRow">
											<td align="right" colspan="2" class="txt"></td>
										</tr>
									  
								  
									  
									  <tr class="oddRow">
										<td align="right" class="bldTxt" width="30%">Campaign Name </td>
										<td align="left"><?=$objCampaign->getCampaignNameById($visitorDetail['campaign_id'])?>
										
										</td>
									  </tr>
									  <tr class="evenRow">
										<td align="right" class="bldTxt">Country</td>
										<td align="left"><?=$visitorDetail['country']?></td>
									  </tr>
									  
									   <tr class="oddRow">
										<td align="right" class="bldTxt" width="30%">IP </td>
										<td align="left"><?=$visitorDetail['ip']?></td>
									  </tr>	
									  
									  <tr class="evenRow">
										<td align="right" class="bldTxt" width="30%">Landing URL </td>
										<td align="left"><?=$visitorDetail['landing_url']?></td>
									  </tr>	
									  
									   <tr class="oddRow">
										<td align="right" class="bldTxt" width="30%">Landing Time </td>
										<td align="left"><?=$visitorDetail['landing_time']?></td>
									  </tr>	
									
									   <tr class="evenRow">
										<td align="right" class="bldTxt" width="30%">Thank You Page Visited </td>
										<td align="left"><?=$visitorDetail['thankyou_page_visited']?></td>
									  </tr>	
									  
									   <tr class="oddRow">
										<td align="right" class="bldTxt" width="30%">Thank You Page Landing Time </td>
										<td align="left"><?=$visitorDetail['thankyou_page_time']?></td>
									  </tr>	

									  <tr class="evenRow">
										<td align="right" class="bldTxt" width="30%">Name </td>
										<td align="left"><?=$visitorDetail['name']?></td>
									  </tr>	
									  
									   <tr class="oddRow">
										<td align="right" class="bldTxt" width="30%">Email</td>
										<td align="left"><?=$visitorDetail['email']?></td>
									  </tr>	
									  <tr class="evenRow">
										<td align="right" class="bldTxt" width="30%">Page Visited</td>
										<td align="left">
										<?php
										    if($visitorDetail['page_history']!="")
											{
												echo '<ul>';
												$pageVisitedList=unserialize($visitorDetail['page_history']);
												foreach($pageVisitedList as $pageVisited)
												{
													echo '<li>'.$pageVisited['page_visited'].' at '.$pageVisited['visit_time'],'</li>';
												}
												echo '</ul>';
											}
										?>
										</td>
									 
								</tbody></table>
								</form>


					
					<?php
								break;
						   default:
					?>
								  <form name="frmDeleteCampaign" action="" method="post">
								  <input type="hidden" name="process" value="deleteCampaign">
								  <input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
								  <input type="hidden" name="campaign_id" value="">
								  </form>
								  <table width="100%" border="1" align=center cellpadding="4" cellspacing="1" class="greyBorder">
								   
									<tr class="blueBackground">
									  <td width="5%" height="28" align="center">S.No.</td>
									   <td width="12%" align="center">Country </td>
									   <td width="12%" align="center">Landing Url </td>
									   <td width="11%" align="center">Landing Time</td>
									   <td width="11%" align="center">Thankyou Page Visited</td>
									   <td width="11%" align="center">Name</td>
									   <td width="11%" align="center">Email</td>
									   <td width="11%" align="center">Action</td>
									  
									</tr>
								   <?php
								   /**********************************************************************************/
								   $visitorList=$objCampaign->getCampaignVistorsByCampaignId($post['campaignId']);
								   
								   $i=0;
								   foreach($visitorList as $visitor)
								   {
									   $i++;
								   ?>
									
									<tr class="<?php print $className?>">
									  <td align="center" class="txt" valign="top" ><?=$i?>.</td>
									   <td align="center" valign="top" class="txt" ><?=$visitor['country']?></td>
									   <td align="center" valign="top" class="txt" ><?=$visitor['landing_url']?></td>
									   <td align="center" valign="top" class="txt" ><?=$visitor['landing_time']?></td>
									   <td align="center" valign="top" class="txt" ><?=$visitor['thankyou_page_visited']?></td>
									   <td align="center" valign="top" class="txt" ><?=$visitor['name']?></td>
									   <td align="center" valign="top" class="txt" ><?=$visitor['email']?></td>
									   <td align="center" valign="top" class="txt">
									   <?php
											$urlParameters = 'visitorId='.$visitor['visitor_id']."&viewType=viewVisitorDetail&campaignId=".$post['campaignId'];
											$cryptUrlParameters = incodeUrl($urlParameters);
										?>
									   <a href="campaign-visitors-list.php?eid=<?=$cryptUrlParameters?>" 
									   class="orangetxt">View Detail</a>
									   </td>
									   
									</tr>
									<?php 
									/********************************************************************************/	
								   }
									?>

					 
								  
								  </table>
				    <?php
						}
					?>
				

			      </td></tr>
			   <tr align="center">
                 <td>&nbsp;</td>
               </tr>
               <tr align="center">
                 <td>&nbsp;</td>
               </tr>
            </table>
         </td>
       </tr>
     </table>
	</td>
  </tr>
</table>
<?php include("footer.inc.php");?>
</body>
</html>