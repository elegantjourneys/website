<?php

	include_once("includes/config.php");

	include_once("includes/head-section.php");

?>

	<link href="tailor-make/includes/css/custom.min.css" rel="stylesheet">
	   
	<script src="tailor-make/includes/js/jquery.min.js"></script>
	<script src="tailor-make/includes/js/app.min.js"></script>


</head>
<body>
	 
	<!-- main wrapper -->
	<div id="wrapper">
		<div class="page-wrapper">
			<!-- main header -->
			       			<?php include_once("includes/header.php"); ?>

			<!-- main banner -->
			<!-- <section class="banner banner-inner parallax" data-stellar-background-ratio="0.5" id="banner-contact">
				<div class="banner-text">
					<div class="center-text">
						<div class="container">
							<h1>Tailor Make a Tour</h1>
							<strong class="subtitle">Get a free Itinerary & Quote for your Tailor-made or Customized Tour</strong>
							
							<nav class="breadcrumbs">
								<ul>
									<li><a href="#">HOME</a></li>
									<li><span>contact US</span></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</section> -->

			<!-- main container -->
			<main id="main">
				<!-- main contact information block -->
				<div class="content-block bg-white">
							  <div class="container">
								  <div class="row" style="min-height: 700px">
								  	<div id="PPHContainer">
								        <div class="header">
								                      

								            <div class="title">
								                <span class="stepper">Steps 
								                    <strong><span id="stepcounter">1</span></strong> of 4
								                </span>
								                <div class="navbar-progress">
								                    <div class="navbar-progress-bar"></div>
								                </div>
								            </div>
								        </div>
        <form id="" name="" method="post">
            <div class="content-container">
                <div class="floor"></div>
                <div class="left page">
                    <div class="page1 content-page">
                        <h2>Let Us Make a Great Tour For You </h2>
                        <!-- <h3>Planning to start a business or a new project? No clue how much capital you need? No problem.</h3> -->
                        <ul>
                            <li style="margin-bottom: .3em;"><i class="fa fa-check" aria-hidden="true"></i>
                                Text
                            </li>
                            <li style="margin-bottom: .3em;"><i class="fa fa-check" aria-hidden="true"></i>
                                Text
                            </li>
                            <li style="margin-bottom: .3em;"><i class="fa fa-check" aria-hidden="true"></i>
                                Text
                            </li>
                        </ul>
                        <div class="hgap30"></div>
                        <button style="width: 270px; padding: 1.1em;" class="btnNext btnPage1Next">GET STARTED</button>
                        <div class="clearFix"></div>
                    </div>
                    <div id="page02" class="page2 content-page">
                         <h2> Please share your details </h2>
                        <div class="row">
                            <label for="">First Name: <span style="color:#FF0000">*</span></label>
                            <br>
                            <input id="" name="" required="" type="text" class="new-input">
                        </div>
                        <div class="row">
                            <label for="">Last Name: <span style="color:#FF0000">*</span></label>
                            <br>
                            <input id="" name="" required="" type="text" class="new-input">
                        </div>
                        <div class="row">
                            <label for="">Email ID: <span style="color:#FF0000">*</span></label>
                            <br>
                            <input id="" name="" required="" type="email">
                        </div>
                        <!-- <div class="error-message page8ErrorMessage">Oops! It looks like you forgot something.</div> -->
                        <div class="hgap30"></div>
                        <!-- <div class="steps"> -->
                            <button class="btnNext btnPage2Next">NEXT
                            </button>
                            <button class="btnBack btnPage2Back">Back
                            </button>
                            <div class="clearFix"></div>
                        <!-- </div> -->
                    </div>
                    <div id="page3" class="page3 caclPage content-page">
                        <h2>Where Are You From</h2>
                        <div class="row">
                            <label for="">City/Town: <span style="color:#FF0000">*</span></label>
                            <br>
                            <input id="" name="" required="" type="text" class="new-input">
                        </div>
                        <div class="row">
                            <label for="">Country: <span style="color:#FF0000">*</span></label>
                            <br>
                            <input id="" name="" required="" type="text" class="new-input">
                        </div>
                       
                        <div class="hgap30"></div>
                        <div class="steps">
                            <button class="btnNext btnPage3Next">NEXT
                            </button>
                            <button class="btnBack btnPage3Back">Back
                            </button>
                            <div class="clearFix"></div>
                        </div>
                    </div>
                    <div class="page4 caclPage content-page">
                        <h2>Please Share Your Travel Requirements</h2>
                      	<div class="row">
                            <label for="">Your Requirement: <span style="color:#FF0000">*</span></label>
                            <br>
                            <input id="" name="" required="" type="text" class="new-input requirement">
                        </div>
                        <div class="hgap30"></div>
                         <button class="btnNext btnPage8Next" type="submit">Make A Tour</button>
                        <button class="btnBack btnPage4Back">Back</button>
                        <div class="clearFix"></div>

                        <!-- <div class="steps">
                            <button class="btnNext btnPage4Next">NEXT
                            </button>
                            <button class="btnBack btnPage4Back">Back
                            </button>
                            <div class="clearFix"></div>
                        </div> -->
                    </div>
                   
                                        
                </div>
                <div class="right">
                    <div class="page1 illus-wrapper">
                        <img class="main-illus" src="tailor-make/images/trip-plan-tailor.png">
                    </div>
                     <div class="page2 caclPage illus-wrapper">
                        <img class="main-illus" src="tailor-make/images/personal-information-icon.png">
                    </div>
                    <div class="page3 caclPage illus-wrapper">
                        <img class="main-illus" src="tailor-make/images/locate.png">
                    </div>
                    <div class="page4 caclPage illus-wrapper">
                        <img class="main-illus" src="tailor-make/images/travel1.png">
                    </div>
                

                </div>             </div>
            
        </form>
    </div>
								  </div>
							    <!-- <div class="row" style="margin-top:30px;">
							      <div class="col-md-6 wow fadeInLeft" style="width:70%; margin-left:15%;">
							        <form class="booking-form con-form" action="#">
							          <div class="form-holder">
							            <h2 class="small-size">
							              Tailor Make a Tour Form
							            </h2>
							            <div class="wrap">
							              <div class="row">
							                <div class="col-md-6">
							                  <div class="hold">
							                    <label for="name">First Name</label>
							                    <input type="text" class="new-input" id="name" class="form-control" />
							                  </div>
							                </div>
							                <div class="col-md-6">
							                  <div class="hold">
							                    <label for="lname">Last Name</label>
							                    <input type="text" class="new-input" id="lname" class="form-control" />
							                  </div>
							                </div>
							              </div>
							              <div class="row">
							                <div class="col-md-6">
							                  <div class="hold">
							                    <label for="em">Email address</label>
							                    <input type="email" id="em" class="form-control" />
							                  </div>
							                </div>
							                <div class="col-md-6">
							                  <div class="hold">
							                    <label for="phn">Phone</label> <input type=	"text" id="phn" class="form-control" />
							                  </div>
							                </div>
							              </div>
							              <div class="row">
							                <div class="col-md-6">
							                  <div class="hold">
							                    <label for="city">City / Town</label>
							                    <input type="text" class="new-input" id="city" class= "form-control" />
							                  </div>
							                </div>
							                <div class="col-md-6">
							                  <div class="hold">
							                    <label for="country">Country</label>
							                    <input type="text" class="new-input" id="country" class="form-control" />
							                  </div>
							                </div>
							              </div>
							              <div class="hold" style="margin-bottom:0px;">
							                <label for="txt">Your Travel Requirements:</label> 
							                <textarea id="txt" class="form-control"
							                placeholder="Please specify along with budget, if any">


							</textarea>
							              </div>
							              <div class="btn-hold">
							                <button type="submit" class="btn btn-default"
							                style="margin-left:0%;">Login</button>
							              </div>
							            </div>
							          </div>
							        </form>
							      </div>
							    </div> -->
							  </div>
							</div>
				 
				 
			</main>
		</div>
		<!-- main footer -->
		<?php include_once("includes/footer.php"); ?>
	</div>
	<!-- scroll to top -->
	<div class="scroll-holder text-center">
		<a href="javascript:" id="scroll-to-top"><i class="icon-arrow-down"></i></a>
	</div>
	<!-- jquery library -->
	<?php include_once("includes/footer-script.php"); ?>
	<script src="js/contact-form.js"></script>
	<!-- custom script -->
	
</body>
</html>