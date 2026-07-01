<?php 

require_once("lib/config.php");
require_once("lib/functions.php");
require_once("lib/variable.php");


@extract($_REQUEST);

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

$start=0;
if(isset($_GET['start'])) $start=$_GET['start'];
$pagesize=10;
if(isset($_GET['pagesize'])) $pagesize=$_GET['pagesize'];



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>travel india tours | north india tour | india tours and travels</title>
<meta name="keywords" content="travel india tours, north india tour, india tours and travels, group tours to india"/>
<meta name="description" content="India tours is the best destination tours for all ages. Tourists from all corners of the world tour in India. You can not visit the entire country, only one round, and because many of India tour packages are offered throughout the country. India tours" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/jquery_004.js"></script>


   
<!--<link rel="stylesheet" type="text/css" href="images/jquery.css" media="screen">-->


<link href="js/style1.css" rel="stylesheet" type="text/css" media="screen">
<style type="text/css">
html .jqueryslidemenu{height: 1%;} 
</style>
<?php include "include/right-click.php"; ?>
 <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23249583-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
<?php include_once("analyticstracking.php") ?>
<div id="container">
    <?php include "include/header.html"; ?>
    <?php include "include/top_link.php"; ?>
    <!--<div id="banner-inside"><img src="img/taj_1.gif" /></div>-->
    <div id="middle-con">
    <div class="side-menu-inside">
		 <?php include "include/main_offer_link.php"; ?>
	<?php include "include/change_currency.php"; ?>
   	<?php /*?><?php include "include/phone-offer.php"; ?><?php */?>
   	<?php include "include/comment-side.php"; ?>
	
    <?php /*?><?php include "include/group_tours.php"; ?>
   	<?php include "include/private_tours.php"; ?>
	<?php include "quick_contact.php"; ?><?php */?>
	</div>
        <div class="side-content">
        		<div class="tourg">
                	<ul class="blue-txt">
                    	<li style="background:none; padding:0px 5px 0px 0px; margin:0px; color:#666666;">You are here:</li>
                    	<li><a href="index.php">Home</a></li>
                        <li style="background:none; font-weight:bold;">Special Offers</li>
                    </ul>
                </div>
        		
                
                <div class="tour-head-bg">
                	<h1 style="line-height:44px; padding-left:10px; color:#717582;">Oberoi Vilas Holidays</h1></div>
					<!--<div class="toura">
					  <h1 class="normal-txt">
				There are no offers available at this time. 
				<br /><br />
				Please bookmark this page (from link at the top of this page) to visit later for available offers.</h1>
					</div>-->
                
			<?php
			
			$sql1=$obj->query("select * from $tbl_managetour where site_active=1 and offer!=0 and tour_type=6 order by tour_order limit $start, $pagesize",$debug=-1);
			
			$reccnt=$obj->numRows($obj->query("select * from $tbl_managetour where site_active=1 and offer!=0"));

			while($line1=$obj->fetchNextObject($sql1))
			{
			?>
        		<div class="tourhighlight">
				
                	 <div class="data">
                     	  <div class="head">
                          		<p>
                           	<div id="offer-top">
                                    	<div class="offer-high">
                                        	<p>
                                            	<span class="underline-txt">
												 <a href="itinerary.php?id=<?php echo $line1->id; ?>">
												
												<?php echo $line1->tour_name;?></a></span>
                                            	
                                            </p>
                                            <p>
                                            	<span class="dollar-bold"> Price from: </span>
                          		<span class="dollar-txt" style="color:#FF0000; font-size:18px;">
<?php echo $line_change_cur->currency_sign.number_format(($line1->tour_price-(($line1->tour_price)*$line1->offer/100))*$line_change_cur->amount);?>

										<span class="dollar-txt" style="text-decoration:line-through;">
																							 
		<?php echo $line_change_cur->currency_sign.number_format($line1->tour_price*$line_change_cur->amount);?></span>
		
										    </p>
                                            <p>
											
                                            	<?php /*?><span class="dollar-bold">Offer Price:</span>

                                            	<span class="dollar-txt" style="color:#990000">From 
<?php echo $line_change_cur->currency_sign.number_format(($line1->tour_price-(($line1->tour_price)*$line1->offer/100))*$line_change_cur->amount);?>
												</span><?php */?>
                                            </p>
                              </div>
                                        <div class="offer-img"><?php echo $line1->offer; ?>%</div>
										   <p class="dollar-bold" style="padding:10px 0px 0px 0px;"><?php echo $line1->offer_date; ?> </p>
                                        <div class="clear"></div>
                            </div>
                                </p>	
                                
                                
                          </div>
						  <div class="tour-detail" style="margin:0px 0px 10px 0px;">
						  		<h2 class="little-txt">
								<?php 
								$length=strlen($line1->tour_description);
								$main=$line1->tour_description;
								for($i=0;$i<580;$i++){
								echo $main[$i]; 
								}
								if($length>=580)
								{
								echo "...";
								}
                                ?>
								</h2>
						  </div>
						  <?php /*?><div class="tour-detail">
                          		<div class="place">Series :</div>
                                <div class="city">
								<?php 
						$myseries=explode(",",$line1->series);
						for($my=0;$my<count($myseries);$my++)
						{
						if($myseries[$my]!="" && $myseries[$my]=="series1")
						echo series1;
						if($myseries[$my]!="" && $myseries[$my]=="series2")
						echo series2;
						if($myseries[$my]!="" && $myseries[$my]=="series3")
						echo series3;
						if($myseries[$my]!="" && $myseries[$my]=="series4")
						echo series4;
						if($myseries[$my]!="" && $myseries[$my]=="series5")
						echo series5;
						if($myseries[$my]!="" && $myseries[$my]=="series6")
						echo series6;
						if($myseries[$my]!="" && $myseries[$my]=="series7")
						echo series7;
						if($myseries[$my]!="" && $myseries[$my]=="series8")
						echo series8;
						}
						//print_r($myseries);
						?>
								</div>
                                <div class="clear"></div>
                          </div><?php */?>
                          <?php /*?><div class="tour-detail">
                          		<div class="place">Tour Type :</div>
                                <div class="city"><?php 
								if($line1->tour_type==3)
								echo "Group or Private";
								else if($line1->tour_type==2)
								echo "Private";
								else
								echo "Group";
								?></div>
                                <div class="clear"></div>
                          </div><?php */?>
                          <?php /*?><div class="tour-detail">
                          		<div class="place">Duration :</div>
                                <div class="city"><?php echo $line1->tour_duraction." days / ".(($line1->tour_duraction)-1)." nights"; ?></div>
                                <div class="clear"></div>
                          </div><?php */?>
                          <?php /*?><div class="tour-detail" style="border:none;">
                          		<div class="place">Places Covered :</div>
                                <div class="city" style="height:auto;">
									
								<?php 
								
								$map_data_sql=$obj->query("select * from $tbl_map_order where tour_id=$line1->id order by order_no",$debug=-1);
								$count=$obj->numRows($map_data_sql);
								while($map_data_line=$obj->fetchNextObject($map_data_sql))
								{
								
									if($count>2)
									{
									$my_sql=$obj->query("select * from $tbl_subregion where id=".$map_data_line->subregion_id,$debug=-1);
									$my_line=$obj->fetchNextObject($my_sql);
									echo $my_line->region_location.", ";
									$count--;
									}
									else if($count==2)
									{
									$my_sql=$obj->query("select * from $tbl_subregion where id=".$map_data_line->subregion_id,$debug=-1);
									$my_line=$obj->fetchNextObject($my_sql);
									echo $my_line->region_location." &amp; ";
									$count--;
									}
									else
									{
									$my_sql=$obj->query("select * from $tbl_subregion where id=".$map_data_line->subregion_id,$debug=-1);
									$my_line=$obj->fetchNextObject($my_sql);
									echo $my_line->region_location;
									$count--;
									}
								}
								?>
								
								</div>
                                <div class="clear"></div>
                          </div><?php */?>
                     </div>
			
                     <?php /*?><div class="image"><img src="<?php echo "images/".$line1->tour_image; ?>" width="218" height="240"/></div><?php */?>
					<div class="image"><a href="itinerary.php?id=<?php echo $line1->id; ?>"><img src="<?php echo "images/".$line1->tour_image; ?>" width="218" height="240"/></a></div>
                </div> <?php
			 }
			?>
			
	   <?php include("lib/paging.inc.php"); ?>
      </div>
        <div class="tourp">
                	
                </div>
        	
       
        <div class="clear"></div>
    </div>
     <?php include "include/bottom_link.php"; ?>
    <!--<div id="Follow-us">
    	<span><img src="img/followus.gif" /></span>
        <span style="width:32px; height:30px; padding:5px;"><img src="img/twitter.gif" /></span>
        <span><img src="img/facebook.gif" /></span>
        <span style="margin-right:100px;"><img src="img/youtube.gif" /></span>
        <span style="margin-right:10px;"><img src="img/signup.gif" /></span>
        <span style="height:30px;"><img src="img/input.gif" /></span>
        <span style="margin-right:10px;"><img src="img/email.gif" /></span>
        <span style="height:30px;"><img src="img/input.gif" /></span>
        <span><img src="img/submit.gif" /></span>
    </div>-->
    <?php include 'include/footer.php';  ?>
   
</div>
<?php include 'include/submitnet.php';  ?>
</body>
</html>
