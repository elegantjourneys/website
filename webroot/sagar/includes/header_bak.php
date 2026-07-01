<header id="header" class="default-white-header top-header header-v1 top_headerMobile">
				<div class="header-top">
					<div class="container">
						<ul class="top-right-panel">
					<?php
						if($mobileView)
						{
							include_once(BASEPATH."class/first-class.php");
							$objFirstClass = new FirstClass();
							$userCountryDisplay=$objFirstClass->GetUserCountryDisplay();
					?>
						  
                            <li style="margin-top:10px;">
								 <span style="padding-right:10px;"><span style="color:#3A7B27;"><?=$userCountryDisplay?> </span>
								
								 
							</li>
					<?php
						}
						else
						{
					?>
						<li>
								<span style="padding-right:10px;"><span style="color:#3A7B27;">AU - </span> (+61) 02 8011 3300 </span>
								 <span style="padding-right:10px;"><span style="color:#3A7B27;">US - </span> (+1) 718 395 7788</span>
								 <span style="padding-right:10px;"><span style="color:#3A7B27;">UK - </span> (+44) 020 3290 4040</span>
								 <span style="padding-right:10px;"><span style="color:#3A7B27;">Canada - </span> (+1) 415 501 0055</span>
								 <span style="padding-right:10px;"><span style="color:#3A7B27;">Skype - </span><a href="skype:elegantjourneys?call">elegantjourneys</a></span> 
								 
							</li>

					<?php
						}
					?>
                            <!--<li style="padding-bottom:2px;">
								<a href="#">
								<img src="<?=WEBROOT?>img/trip-advisor-header.jpg"> 
                                </a>
							</li> !-->
							<!--<li class="visible-xs visible-sm cart-visible"><a href="my-cart.html"><span class="icon-cart-add"></span></a></li>
							<li class="hidden-xs hidden-sm nav-visible dropdown last-dropdown v-divider">
								<a href="my-cart.html" data-toggle="dropdown">
									<span class="icon icon-cart-add"></span>
									<span class="text hidden-md hidden-lg">Cart</span>
									<span class="text hidden-xs hidden-sm">3</span>
								</a>
								<div class="hidden-sm hidden-xs dropdown-menu dropdown-md">
									<div class="drop-wrap cart-wrap">
										<strong class="title">Shopping Cart</strong>
										<ul class="cart-list">
											<li>
												<div class="img">
													<a href="#">
														<img src="img/listing/img-16.jpg" height="165" width="170" alt="image description">
													</a>
												</div>
												<div class="text-holder">
													<span class="amount">x 2</span>
													<div class="text-wrap">
														<strong class="name"><a href="#">Weekend in Paradise</a></strong>
														<span class="price">$199</span>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<a href="#">
														<img src="img/listing/img-17.jpg" height="165" width="170" alt="image description">
													</a>
												</div>
												<div class="text-holder">
													<span class="amount">x 4</span>
													<div class="text-wrap">
														<strong class="name"><a href="#">Water Sports in Spain</a></strong>
														<span class="price">$199</span>
													</div>
												</div>
											</li>
											<li>
												<div class="img">
													<a href="#">
														<img src="img/listing/img-18.jpg" height="165" width="170" alt="image description">
													</a>
												</div>
												<div class="text-holder">
													<span class="amount">x 4</span>
													<div class="text-wrap">
														<strong class="name"><a href="#">Beach Party in Greece</a></strong>
														<span class="price">$199</span>
													</div>
												</div>
											</li>
										</ul>
										<div class="footer">
											<a href="my-cart.html" class="btn btn-primary">View cart</a>
											<span class="total">$3300</span>
										</div>
									</div>
								</div>
							</li>-->
							<li class="dropdown hidden-xs hidden-sm last-dropdown v-divider" style="padding-top:7px;">
								<a href="#"><span class="text" style="color:#000000;"><!--EN-->&nbsp;&nbsp;</span></a>
								<div class="dropdown-menu dropdown-sm">
									<div class="drop-wrap lang-wrap">
										<div class="lang-row">
											<div class="lang-col">
												<a href="#">
													<!--<span class="text">English</span>-->
												</a>
											</div>
										</div>
										<div class="lang-row">
											<div class="lang-col">
												<a href="#">
													<span class="text">German</span>
												</a>
											</div>
										</div>
										<div class="lang-row">
											<div class="lang-col">
												<a href="#">
													<span class="text">Russian</span>
												</a>
											</div>
										</div>
										<div class="lang-row">
											<div class="lang-col">
												<a href="#">
													<span class="text">Czech</span>
												</a>
											</div>
										</div>
										<div class="lang-row">
											<div class="lang-col">
												<a href="#">
													<span class="text">Chinese</span>
												</a>
											</div>
										</div>
										<div class="lang-row">
											<div class="lang-col">
												<a href="#">
													<span class="text">Danish</span>
												</a>
											</div>
										</div>
									</div>
								</div>
							</li>
                            <li class="" style="padding-top:7px;"><a href="#" class="search-opener"><span class="icon icon-search" style="color:#000000; display:none;"></span></a></li>
						</ul>
					</div>
				</div>
				<div class="header-bottom" style="background-color:#ffffff;">
					<div class="container">
						<div class="nav-frame">
							<!-- logo -->
							<div class="logo logo2">
								<a href="<?=WEBROOT?>">
									<img class="normal" src="<?=WEBROOT?>img/tour-logo.jpg" alt="Elegant-Journeys">
									<img class="gray-logo" src="<?=WEBROOT?>img/tour-logo.jpg" alt="Elegant-Journeys">
								</a>
							</div>
							<!-- main navigation -->
							<nav class="navbar navbar-default">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle nav-opener" data-toggle="collapse" data-target="#nav">
										
										<span class="sr-only"><i class="fa fa-window-close-o fa-4x"></i></span>
 
									</button>
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
											foreach($parentMenuList as $parentMenu)
											{
												$childMenuList = array();
												$childMenuList = $objTopMenu->getTopMenuByParentId($parentMenu['id'],$data);
												if(count($childMenuList)>=1)
												{
										 ?>
										 <li class="dropdown">
												<a href="<?=WEBROOT?><?=$parentMenu['link']?>" class="dropdown-toggle" data-toggle="dropdown"><?=$parentMenu['title']?> <b class="icon-angle-down"></b></a>
															<div class="dropdown-menu">
															   
															<ul>
																<?php
																	foreach($childMenuList as $childMenu)
																	{
																?>
																	<li><a href="<?=WEBROOT?><?=$childMenu['link']?>"><?=$childMenu['title']?></a></li>
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
											  <li class="dropdown">
												<a href="<?=WEBROOT?><?=$parentMenu['link']?>" class="dropdown-toggle"><?=$parentMenu['title']?> <b class="icon-angle-down"></b></a>
											  </li>
										 <?php
												}
											}
										?>
                                      
                                
									</ul>
							   <?php
									}
								?>
								</div>
							</nav>
						</div>
						<!-- search form -->
						<form class="search-form" action="#">
							<fieldset>
								<a href="#" class="search-opener hidden-md hidden-lg">
									<span class="icon-search"></span>
								</a>
								<div class="search-wrap">
									<a href="#" class="search-opener close">
										<span class="icon-cross"></span>
									</a>
									<div class="trip-form trip-form-v2 trip-search-main">
										<div class="trip-form-wrap">
											<div class="holder">
												<label>Departing</label>
												<div class='select-holder'>
													<div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
														<input class="form-control" type="text" readonly />
														<span class="input-group-addon"><i class="icon-drop"></i></span>
													</div>
												</div>
											</div>
											<div class="holder">
												<label>Returning</label>
												<div class='select-holder'>
													<div id="datepicker1" class="input-group date" data-date-format="mm-dd-yyyy">
														<input class="form-control" type="text" readonly />
														<span class="input-group-addon"><i class="icon-drop"></i></span>
													</div>
												</div>
											</div>
											<div class="holder">
												<label for="select-region">Select Region</label>
												<div class='select-holder'>
													<select class="trip-select trip-select-v2 region" name="region" id="select-region">
														<option value="select">all regions</option>
														<option value="select">all regions 1</option>
														<option value="select">all regions 2</option>
														<option value="select">all regions 3</option>
													</select>
												</div>
											</div>
											<div class="holder">
												<label for="select-activity">Select Activity</label>
												<div class='select-holder'>
													<select class="trip-select trip-select-v2 acitvity" name="activity" id="select-activity">
														<option value="select">all activity</option>
														<option value="select">all activity</option>
														<option value="select">all activity</option>
														<option value="select">all activity</option>
													</select>
												</div>
											</div>
											<div class="holder">
												<label for="price-range">Price Range</label>
												<div class='select-holder'>
													<select class="trip-select trip-select-v2 price" name="activity" id="price-range">
														<option value="select">all price range</option>
														<option value="select">all price range</option>
														<option value="select">all price range</option>
														<option value="select">all price range</option>
													</select>
												</div>
											</div>
											<div class="holder">
												<button class="btn btn-trip btn-trip-v2" type="submit">Find Tours</button>
											</div>
										</div>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</header>