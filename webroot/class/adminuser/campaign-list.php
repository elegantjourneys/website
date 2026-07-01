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


if((isset($_POST['process']))&&(!empty($_POST['process'])))
{
	switch($_POST['process'])
	{
		case 'updateCampaign':
				$objCampaign->updateCampaign($_POST);
				header('location:'.$_POST['returnUrl']);
				exit();
			break;
		case 'addCampaign':
				if($objCampaign->addCampaign($_POST))
				{
					header('location:'.$_POST['returnUrl']);
					exit();
				}
			break;
		case 'deleteCampaign':
				$objCampaign->deleteCampaignById($_POST['campaign_id']);
				header('location:'.$_POST['returnUrl']);
				exit();
			
			

	}
}
$post = decodeWebUrl($_GET);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script>
	function validateForm()
	{
		var objForm = document.frmCampaign;
		if(objForm.name.value=="")
		{
			alert('Please enter campaign name.');
			objForm.name.focus();
			return false;
		}

		if(objForm.utm_campaign_param.value=="")
		{
			alert('Please enter UTM Campaign Parameter.');
			objForm.utm_campaign_param.focus();
			return false;
		}
		return true;
	}

	function deleteCampaign(campaign_id)
	{
		if(window.confirm('Do you want to delete selected record?'))
		{
			var objForm = document.frmDeleteCampaign;
			objForm.campaign_id.value=campaign_id;
			objForm.submit();
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
                          <td>Manage Campaign </td>
                        </tr>
                      </table>
                      </td>
                     <td width="27%" align="right" style="padding-right:20px; "> 
						<?php
							$urlParameters = "viewType=addCampaign";
							$cryptUrlParameters = incodeUrl($urlParameters);
						?>
					   <input type="button" name="Submit" value="Add New Campaign" class="button" onclick="location.href='campaign-list.php?eid=<?=$cryptUrlParameters?>'" /></td>  </tr>
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
							case 'editCampaign':
								$campaignDetail=$objCampaign->getCampaignInfoById($post['campaignId']);
							  
					?>


									<form onsubmit="return validateForm();" enctype="multipart/form-data" method="post" action="" name="frmCampaign">
									<input type="hidden" name="process" value="updateCampaign">
									<input type="hidden" name="campaign_id" value="<?=$campaignDetail['campaign_id']?>">
									<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
									<table width="98%" cellspacing="1" cellpadding="4" border="0" bgcolor="#D8D8D8" align="center">
										<tbody><tr align="left"> 
										<td height="25" class="blueBackground" colspan="2">Please enter following details - </td>
										</tr>
											<tr class="evenRow">
											<td align="right" colspan="2" class="txt"><span class="warning">*</span> - Required Fields</td>
										</tr>
									  
								  
									  
									  <tr class="oddRow">
										<td align="right" class="bldTxt" width="30%">Name </td>
										<td align="left">
										<input type="text" value="<?=$campaignDetail['name']?>" name="name" style="width:200px;" >
										</td>
									  </tr>
									  <tr class="evenRow">
										<td align="right" class="bldTxt">UTM Campaign Parameter</td>
										<td align="left">
											<input type="text" value="<?=$campaignDetail['utm_campaign_param']?>" id="utm_campaign_param" name="utm_campaign_param" style="width:200px;">	
										</td>
									  </tr>
									  
									  								  
										
									   <tr class="evenRow">
										<td align="center">&nbsp;</td>
										<td align="left"><input type="submit" value="Submit" class="button"></td>
									</tr>
								</tbody></table>
								</form>


					<?php
								break;
						   case 'addCampaign':
					?>

								<form onsubmit="return validateForm();" enctype="multipart/form-data" method="post" action="" name="frmCampaign">
									<input type="hidden" name="process" value="addCampaign">
									<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI']?>">
									<table width="98%" cellspacing="1" cellpadding="4" border="0" bgcolor="#D8D8D8" align="center">
										<tbody><tr align="left"> 
										<td height="25" class="blueBackground" colspan="2">Please enter following details - </td>
										</tr>
											<tr class="evenRow">
											<td align="right" colspan="2" class="txt"><span class="warning">*</span> - Required Fields</td>
										</tr>
									  
								  
									  
									  <tr class="oddRow">
										<td align="right" class="bldTxt" width="30%">Name </td>
										<td align="left">
										<input type="text" value="" name="name" style="width:200px;" >
										</td>
									  </tr>
									  <tr class="evenRow">
										<td align="right" class="bldTxt">UTM Campaign Parameter</td>
										<td align="left">
											<input type="text" value="" id="utm_campaign_param" name="utm_campaign_param" style="width:200px;">	
										</td>
									  </tr>
									  
									  								  
										
									   <tr class="evenRow">
										<td align="center">&nbsp;</td>
										<td align="left"><input type="submit" value="Submit" class="button"></td>
									</tr>
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
									   <td width="12%" align="center">Campaign Name </td>
									   <td width="12%" align="center">Campaign Param </td>
									   <td width="11%" align="center">Action</td>
									  
									</tr>
								   <?php
								   /**********************************************************************************/
								   $campaignList=$objCampaign->getAllCampaign();
								   $i=0;
								   foreach($campaignList as $campaign)
								   {
									   $i++;
								   ?>
									
									<tr class="<?php print $className?>">
									  <td align="center" class="txt" valign="top" ><?=$i?>.</td>
									   <td align="center" valign="top" class="txt" ><?=$campaign['name']?></td>
									   <td align="center" valign="top" class="txt" ><?=$campaign['utm_campaign_param']?></td>
									   <td align="center" valign="top" class="txt">
									   <?php
											$urlParameters = 'campaignId='.$campaign['campaign_id']."&viewType=editCampaign";
											$cryptUrlParameters = incodeUrl($urlParameters);
										?>
									   <a href="campaign-list.php?eid=<?=$cryptUrlParameters?>" 
									   class="orangetxt">Edit</a> |
										  <?php
											$urlParameters = 'campaignId='.$campaign['campaign_id'];
											$cryptUrlParameters = incodeUrl($urlParameters);
										?>
									   <a href="campaign-visitors-list.php?eid=<?=$cryptUrlParameters?>" 
									   class="orangetxt">View Vistors</a> |

									   <a href="#" 
									   class="orangetxt" onclick="deleteCampaign('<?=$campaign['campaign_id']?>'); return false;">Delete</a>
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