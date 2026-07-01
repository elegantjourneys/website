<header id="header" class="default-white-header top-header header-v1 top_headerMobile">
  <div class="header-top hidden-xs">
    <div class="container">
      <ul class="top-right-panel">
        <li> <span  class="pd-10"><span  class="clr-country"><img src="<?=WEBROOT?>images/icons/usa.png" alt="USA" style="width:30px; height:30px;" ></span> (+1) 718 395 7788</span> <span  class="pd-10" style="padding-left:10px;"><span  class="clr-country"><img src="<?=WEBROOT?>images/icons/uk.png" alt="UK" style="width:30px; height:30px;" ></span> (+44) 020 3290 4040</span> <span  class="pd-10" style="padding-left:10px;"><span  class="clr-country"><img src="<?=WEBROOT?>images/icons/canada.png" alt="Canada" style="width:30px; height:30px;" ></span> (+1) 415 501 0055</span> <span  class="pd-10" style="padding-left:10px;"><span  class="clr-country"><img src="<?=WEBROOT?>images/icons/australia.png" alt="Australia" style="width:32px; height:32px;" ></span> (+61) 02 8011 3300 </span> <span  class="pd-10" style="padding-left:10px;"><span  class="clr-country"><span  class="clr-country"> <i class="fa fa-envelope" aria-hidden="true"></i> - </span><a href="mailto:sales@elegantjourneys.com">sales@elegantjourneys.com</a></span> </span> </li>
      </ul>
    </div>
  </div>
  <div class="header-bottom" style="background-color:#ffffff;box-shadow: 0 1px 2px 0 rgba(0,0,0,0.1);">
    <div class="container">
      <div class="nav-frame">
        <!-- logo -->
        <div class="logo logo2"> <a href="<?=WEBROOT?>"> <img class="normal" src="<?=WEBROOT?>img/new-logo.png" alt="Elegant-Journeys"> <img class="gray-logo" src="<?=WEBROOT?>img/new-logo.png" alt="Elegant-Journeys"> </a> </div>
        <!-- main navigation -->
        <nav class="navbar navbar-default">
          <div class="navbar-header">
            <button id="ChangeToggle" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav" aria-expanded="false" aria-label="Toggle navigation">
            <div class="header-animated"> <span></span><span></span><span></span><span></span></div>
            </button>
            <!-- <button type="button" class="navbar-toggle nav-opener" data-toggle="collapse" data-target="#nav">
										
										<span class="sr-only"><i class="fa fa-window-close-o fa-4x"></i></span>
 
									</button> -->
          </div>
          <!-- main menu items and drop for mobile -->
          <div class="collapse navbar-collapse" id="nav">
            <!-- main navbar -->
            <?php
									include_once(BASEPATH_CLASS."top-menu-class.php");
									$objTopMenu = new TopMenu();
									$data = array(
													'sortBy'=>'position'
												);
									$parentMenuList = array();
									$parentMenuList = $objTopMenu->getTopMenuByParentId('0',$data);
									if(count($parentMenuList)>=1)
									{
								?>
            <ul class="nav navbar-nav">
              <?php
										 //print_r($parentMenuList);
											foreach($parentMenuList as $parentMenu)
											{
												$childMenuList = array();
												$childMenuList = $objTopMenu->getTopMenuByParentId($parentMenu['id'],$data);
												if(count($childMenuList)>=1)
												{
										 ?>
              <li class="dropdown"> <a href="<?=WEBROOT?><?=$parentMenu['link']?>" class="dropdown-toggle" data-toggle="dropdown" onclick="window.location='<?=WEBROOT?><?=$parentMenu['link']?>'">
                <?=$parentMenu['title']?>
                <b class="icon-angle-down"></b></a>
                <div class="dropdown-menu">
                  <ul>
                    <?php
																	foreach($childMenuList as $childMenu)
																	{
																?>
                    <li><a href="<?=WEBROOT?><?=$childMenu['link']?>">
                      <?=$childMenu['title']?>
                      </a></li>
                    <?php
																	}
																?>
                  </ul>
                </div>
              </li>
              <?php
												}
												else
												{
											?>
              <li class="dropdown"> <a href="<?=WEBROOT?><?=$parentMenu['link']?>" class="dropdown-toggle">
                <?=$parentMenu['title']?>
                <b class="icon-angle-down"></b></a> </li>
              <?php
												}
											}
										?>
              <!-- <li><a href=""><img src="<?=WEBROOT?>img/tripadvisor-sticker1.png" alt="tripadvisor" class="tripadvisor-sticker hidden-xs"></a></li> -->
            </ul>
            <?php
									}
								?>
          </div>
        </nav>
      </div>
      
    </div>
  </div>
</header>
<?php include_once(BASEPATH."includes/feedback.php"); ?>
