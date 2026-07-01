<?php /* ?><aside id="sidebar-right" class="col-sm-4 col-md-3 sidebar">
                  <div class="sidebar-holder side-shadow">
                    <div class="accordion">
                      
                      <div class="accordion-group">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a role="button"  aria-expanded="true" aria-controls="collapse2">RECENT POSTS</a>
                          </h4>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse in" role="tabpanel">
                          <div class="panel-body">
                            <ul class="side-list post-list hovered-list">
							<?php

								$blogRecentList = $objBlog->getRecentBlog();
								
								foreach ($blogRecentList as $blogRecent) {
							?>
                              <li>
                                <a href="<?=WEBROOT?>blog-<?=$blogRecent["page_url"]?>">
                                  <time><?=$blogRecent['blog_date']?></time>
                                  <span class="text-block">
                                    <?=$blogRecent["title"]?>

                                  </span>
                                </a>
                              </li>
                               <?php
								}
								?>
                            </ul>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </aside><?php */ ?>
				<div class="card">
                        <div class="header">
                            <h2 style="margin-bottom: 15px !important;">Popular Posts</h2> 
							<div class="title-underline"></div>
                        </div>
                        <div class="body widget popular-post">
                            <div class="row">
                                <div class="col-lg-12">
								<?php

								$blogRecentList = $objBlog->getRecentBlog($_GET['blogurl']);
								
								foreach ($blogRecentList as $blogRecent) {
								?>
								<a href="<?=WEBROOT?>blog-<?=$blogRecent["page_url"]?>">
                                    <div class="single_post underline-wrapper">
                                        <strong><p class="m-b-0">&#x1F449; <?=$blogRecent["title"]?></p></strong>
                                        <span>&bull; <?=$blogRecent['blog_date']?></span>
                                        <div class="img-post">
                                            <!--<img src="https://www.bootdey.com/image/280x180/87CEFA/000000" alt="Awesome Image"> -->
											<img src="<?=$blogRecent['image']?>" alt="image description">
                                        </div>                                            
                                    </div>
								</a>	
                                    
									<?php
									}
									?>
									
                                </div>
                            </div>
                        </div>
                    </div>