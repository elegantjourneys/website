<?php 
//session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
validate_admin();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top"><?php include("header.inc.php");?></td>
  </tr>
  <tr>
    <td align="left" valign="top" class="pad10"><table width="898" height="307" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left" valign="top"><table width="1077" height="307"  border="0" align="center" cellpadding="0" cellspacing="0">
          
		  
		  <tr>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="right" valign="top"><a href="logout.php" class="menuBoldText">Logout</a></td>
		    </tr>
		  <tr>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top"><a href="logout.php" class="menuBoldText"></a></td>
		    </tr>
		  <tr>
          <td width="170" align="left" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" id="boxbg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="122" align="center" valign="middle"><a href="admin-email.php"><img src="images/manager.png" width="59" height="88" border="0" /></a></td>
                    </tr>
                    <tr>
                      <td height="38" align="center" valign="middle"><a href="admin-email.php" class="admin_txt2">Admin Manager</a> </td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
           
            <td width="12" align="left" valign="top"><img src="images/spacer.gif" width="1" height="1" /></td>
            <td width="170" align="left" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" id="boxbg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="122" align="center" valign="middle"><a href="user-list.php"><img src="images/users.png" width="112" height="95" border="0" /></a></td>
                    </tr>
                    <tr>
                      <td height="38" align="center" valign="middle"><a href="home-list.php" class="admin_txt2">Manage Slide Show </a> </td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
			 <td width="12" align="left" valign="top"><img src="images/spacer.gif" width="1" height="1" /></td>
            <td width="170" align="left" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" id="boxbg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="122" align="center" valign="middle"><a href="user-list.php"><img src="images/referal_manager.png" width="99" height="95" border="0" /></a></td>
                    </tr>
                    <tr>
                      <td height="38" align="center" valign="middle"><a href="region-list.php" class="admin_txt2">Manage Region</a> </td>
                    </tr>
                </table>				</td>
              </tr>
            </table></td>
			 <td width="12" align="left" valign="top"><img src="images/spacer.gif" width="1" height="1" /></td>
            <td width="170" align="left" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" id="boxbg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="122" align="center" valign="middle"><a href="user-list.php"><img src="images/rating.png" width="112" height="105" border="0" /></a></td>
                    </tr>
                    <tr>
                      <td height="38" align="center" valign="middle"><a href="managetour-list.php" class="admin_txt2">Manage Tour</a> </td>
                    </tr>
                </table>				</td>
              </tr>
            </table></td>
			<td width="12" align="left" valign="top">&nbsp;</td>
			<td align="left" valign="top" id="boxbg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="122" align="center" valign="middle"><a href="user-list.php"><img src="images/rating.png" width="112" height="105" border="0" /></a></td>
                    </tr>
                    <tr>
                      <td height="38" align="center" valign="middle"><a href="citywise-list.php" class="admin_txt2">Miscellaneous Section
</a> </td>
                    </tr>
                </table>				</td>
			<td width="12" align="left" valign="top"><img src="images/spacer.gif" width="1" height="1" /></td>
			<td align="left" valign="top" id="boxbg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="122" align="center" valign="middle"><a href="user-list.php"><img src="images/rating.png" width="112" height="105" border="0" /></a></td>
                    </tr>
                    <tr>
                      <td height="38" align="center" valign="middle"><a href="citywise-list.php" class="admin_txt2">Enquiry Manager</a> </td>
                    </tr>
                </table>				</td>
			</tr>
		

		
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top" class="top12">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top"><?php include("footer.inc.php");?></td>
  </tr>
</table>
</body>
</html>
