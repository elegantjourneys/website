<?php
$currentPath = strtolower($this->request->getPath());
?>
<div class="sidebar" data-background-color="dark">
			<div class="sidebar-logo">
				<!-- Logo Header -->
				<div class="logo-header" data-background-color="dark">

					<a href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'index', 'plugin' => 'Admin', '_ext' => NULL]) ?>" class="logo">
						<!--<img src="<?= $this->Url->assetUrl('admin_assets/img/kaiadmin/logo_light.svg');?>" alt="navbar brand" class="navbar-brand" height="20">-->
                       <img src="<?= $this->Url->assetUrl('/trains/assets/logo-pow.png');?>" alt="navbar brand" class="navbar-brand" height="60">
					</a>
					<div class="nav-toggle">
						<button class="btn btn-toggle toggle-sidebar">
							<i class="gg-menu-right"></i>
						</button>
						<button class="btn btn-toggle sidenav-toggler">
							<i class="gg-menu-left"></i>
						</button>
					</div>
					<button class="topbar-toggler more">
						<i class="gg-more-vertical-alt"></i>
					</button>

				</div>
				<!-- End Logo Header -->	
			</div>	
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav nav-secondary">
						<li class="nav-item <?= str_contains($currentPath, 'dashboard') ? 'active' : '' ?>">
							<a href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'index', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
								
							</a>
							
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Components</h4>
						</li>
						<?php
      					$isHeaderSectionActive = str_contains($currentPath, 'meta') || 
	  					str_contains($currentPath, 'script');
      					?>
						<li class="nav-item <?= $isHeaderSectionActive ? 'active' : '' ?>">
							<a data-bs-toggle="collapse" href="#head" <?= $isHeaderSectionActive ? '' : 'aria-expanded="false"' ?>>
								<i class="fas fa-layer-group"></i>
								<p>Head Section</p>
								<span class="caret"></span>
							</a>
							<div class="collapse <?= $isHeaderSectionActive ? 'show' : '' ?>" id="head">
								<ul class="nav nav-collapse">
                                  	<li class="<?= str_contains($currentPath, 'meta') ? 'active' : '' ?>">
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/meta', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Meta</span>
										</a>
									</li>
									<li class="<?= str_contains($currentPath, 'script') ? 'active' : '' ?>">
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/script', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Script</span>
										</a>
									</li>									
								</ul>
							</div>
						</li>
						<?php
      					$isHeaderActive = str_contains($currentPath, 'logo') || 
	  					str_contains($currentPath, 'topheader') ||
                        str_contains($currentPath, 'headermenu') ||
                        str_contains($currentPath, 'headerphone');
      					?>
                      <li class="nav-item <?= $isHeaderActive ? 'active' : '' ?>">
							<a data-bs-toggle="collapse" href="#base" <?= $isHeaderActive ? '' : 'aria-expanded="false"' ?>>
								<i class="fas fa-layer-group"></i>
								<p>Header</p>
								<span class="caret"></span>
							</a>
							<div class="collapse <?= $isHeaderActive ? 'show' : '' ?>" id="base">
								<ul class="nav nav-collapse">
                                  	<li class="<?= str_contains($currentPath, 'logo') ? 'active' : '' ?>">
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/logo', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Logo</span>
										</a>
									</li>
									<li class="<?= str_contains($currentPath, 'topheader') ? 'active' : '' ?>">
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/topheader', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Top Section</span>
										</a>
									</li>
									<li class="<?= str_contains($currentPath, 'headermenu') ? 'active' : '' ?>">
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/headermenu', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Menu Section</span>
										</a>
									</li>
									<li class="<?= str_contains($currentPath, 'headerphone') ? 'active' : '' ?>">
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/headerphone', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Phone Section</span>
										</a>
										
									</li>
									
								</ul>
							</div>
						</li>
						<?php
      					$isHeroActive = str_contains($currentPath, 'bannerimage') || 
	  					str_contains($currentPath, 'bannertext') ;
      					?>
						<li class="nav-item <?= $isHeroActive ? 'active' : '' ?>">
							<a data-bs-toggle="collapse" href="#sidebarLayouts" <?= $isHeroActive ? '' : 'aria-expanded="false"' ?>>
								<i class="fas fa-th-list"></i>
								<p>Hero Section</p>
								<span class="caret"></span>
							</a>
							<div class="collapse <?= $isHeroActive ? 'show' : '' ?>" id="sidebarLayouts">
								<ul class="nav nav-collapse">
									<li class="<?= str_contains($currentPath, 'bannerimage') ? 'active' : '' ?>">
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/bannerimage', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Banner Image</span>
										</a>
									</li>
									<li class="<?= str_contains($currentPath, 'bannertext') ? 'active' : '' ?>">
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/bannertext', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Hero Text</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<?php
      					$isFooterActive = str_contains($currentPath, 'footermenu') || 
	  					str_contains($currentPath, 'phonesection') ||
                        str_contains($currentPath, 'footerimagesection') ||
                        str_contains($currentPath, 'footertext');
      					?>
						<li class="nav-item <?= $isFooterActive ? 'active' : '' ?>">
							<a data-bs-toggle="collapse" href="#forms" <?= $isFooterActive ? '' : 'aria-expanded="false"' ?>>
								<i class="fas fa-pen-square"></i>
								<p>Footer</p>
								<span class="caret"></span>
							</a>
							<div class="collapse <?= $isFooterActive ? 'show' : '' ?>" id="forms">
								<ul class="nav nav-collapse">
									<li class="<?= str_contains($currentPath, 'footermenu') ? 'active' : '' ?>">
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/footermenu', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Footer Menu</span>
										</a>
									</li>
									<li class="<?= str_contains($currentPath, 'phonesection') ? 'active' : '' ?>">
										
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/phonesection', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Phone Section</span>
										</a>
									</li>
									<li class="<?= str_contains($currentPath, 'footerimagesection') ? 'active' : '' ?>">
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/footerimagesection', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Footer Image Section</span>
										</a>
									</li>
                                  <li class="<?= str_contains($currentPath, 'footertext') ? 'active' : '' ?>">
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/footertext', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Footer Text</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item <?= str_contains($currentPath, 'aboutus') ? 'active' : '' ?>">
							<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/aboutus', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
								<i class="fas fa-address-card"></i>
								<p>About Us</p>
								<span class="caret"></span>
							</a>
							
						</li>
						<li class="nav-item">
							<a data-bs-toggle="collapse" href="#maps">
								<i class="fas fa-map-marker-alt"></i>
								<p>Itinerary</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="maps">
								<ul class="nav nav-collapse">
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/day1', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Day 1</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/day2', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Day 2</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/day3', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Day 3</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/day4', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Day 4</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/day5', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Day 5</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/day6', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Day 6</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/day7', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Day 7</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/day8', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Day 8</span>
										</a>
									</li>
                                  	<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/day9', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Day 9</span>
										</a>
									</li>
                                  	<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/day10', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Day 10</span>
										</a>
									</li>
                                  	<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/day11', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Day 11</span>
										</a>
									</li>
                                  	<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/day12', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Day 12</span>
										</a>
									</li>
                                  	<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/day13', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Day 13</span>
										</a>
									</li>
                                  	<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/day14', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Day 14</span>
										</a>
									</li>
                                  
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-bs-toggle="collapse" href="#cabins">
								<i class="fas fa-building"></i>
								<p>Cabins</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="cabins">
								<ul class="nav nav-collapse">
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/cabin1', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Cabin 1</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/cabin2', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Cabin 2</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/cabin3', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Cabin 3</span>
										</a>
									</li>
                                  	<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/cabin4', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Cabin 4</span>
										</a>
									</li>
                                  	<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/cabin5', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Cabin 5</span>
										</a>
									</li>
                                  	<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/cabin6', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Cabin 6</span>
										</a>
									</li>
									
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-bs-toggle="collapse" href="#facilities">
								<i class="fas fa-file-export"></i>
								<p>Facilities</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="facilities">
								<ul class="nav nav-collapse">
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/facility1', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Facility 1</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/facility2', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Facility 2</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/facility3', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Facility 3</span>
										</a>
									</li>
                                  	<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/facility4', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Facility 4</span>
										</a>
									</li>
                                  	<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/facility5', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Facility 5</span>
										</a>
									</li>
                                  	<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/facility6', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Facility 6</span>
										</a>
									</li>
									
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-bs-toggle="collapse" href="#experiences">
								<i class="fas fa-smile"></i>
								<p>Experiences</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="experiences">
								<ul class="nav nav-collapse">
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/experience1', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Experience 1</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/experience2', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Experience 2</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/experience3', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Experience 3</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/experience4', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Experience 4</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/experience5', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Experience 5</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/experience6', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Experience 6</span>
										</a>
									</li>
                                  	<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/experience7', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Experience 7</span>
										</a>
									</li>
                                  	<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/experience8', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Experience 8</span>
										</a>
									</li>
                                  	<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/experience9', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Experience 9</span>
										</a>
									</li>
                                  	<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/experience10', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Experience 10</span>
										</a>
									</li>
                                  	<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/experience11', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Experience 11</span>
										</a>
									</li>
                                  	<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/experience12', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Experience 12</span>
										</a>
									</li>
                                  <li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/experience13', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Experience 13</span>
										</a>
									</li>
                                  <li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/experience14', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Experience 14</span>
										</a>
									</li>
									
								</ul>
							</div>
						</li>
                      
                      <li class="nav-item">
							<a data-bs-toggle="collapse" href="#ins">
								<i class="far fa-list-alt"></i>
								<p>Inclusions</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="ins">
								<ul class="nav nav-collapse">
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/inclusions', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Inclusions</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/exclusions', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Exclusions</span>
										</a>
									</li>
									
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-bs-toggle="collapse" href="#charts">
								<i class="far fa-chart-bar"></i>
								<p>Testimonials</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="charts">
								<ul class="nav nav-collapse">
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/testimonialsvideos', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Testimonials Videos</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/powfilm', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Film/Video</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/powpdf', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Brochure</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						
						<li class="nav-item">
							<a data-bs-toggle="collapse" href="#tarrif">
								<i class="fas fa-desktop"></i>
								<p>Tarrif</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="tarrif">
								<ul class="nav nav-collapse">
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/tarrif1', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Tarrif 1</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/tarrif2', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Tarrif 2</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/tarrif3', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Tarrif 3</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/tarrif4', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Tarrif 4</span>
										</a>
									</li>
                                  
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-bs-toggle="collapse" href="#toc">
								<i class="fas fa-file"></i>
								<p>Terms & Conditions</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="toc">
								<ul class="nav nav-collapse">
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/tnc', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Terms & Conditions</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/tncp', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Terms & Conditions Popup</span>
										</a>
									</li>
									
								</ul>
							</div>
						</li>
						
                      <li class="nav-item">
							<a data-bs-toggle="collapse" href="#trip">
								<i class="fas fa-bars"></i>
								<p>Trip Extension</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="trip">
								<ul class="nav nav-collapse">
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/tripextension', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Trip Extension</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/tripextensionpop', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Trip Extension Popup</span>
										</a>
									</li>
									
								</ul>
							</div>
						</li>
						<li class="nav-item">
						
                          <a data-bs-toggle="collapse" href="#contact">
								<i class="fas fa-phone"></i>
								<p>Contact Us</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="contact">
								<ul class="nav nav-collapse">
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/contactus', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Contact Us Image</span>
										</a>
									</li>
									<li>
										<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/contactusheading', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
											<span class="sub-item">Contact Us Heading</span>
										</a>
									</li>
									
								</ul>
							</div>
							
						</li>
						<li class="nav-item">
							<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'manage-content/luxuarytrains', 'plugin' => 'Admin', '_ext' => NULL]) ?>">
								<i class="fas fa-train"></i>
								<p>Luxuary Trains</p>
								<span class="caret"></span>
							</a>
							
						</li>
					</ul>
				</div>
			</div>
		</div>