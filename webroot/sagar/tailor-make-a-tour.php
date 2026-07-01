<?php

	include_once("includes/config.php");

	include_once("includes/head-section1.php");

?>
<style type="text/css">

</style>
<link rel="stylesheet" type="text/css" href="css/tailor-make-sgr.css">
</head>
<body>
	 
	<!-- main wrapper -->
	<div id="wrapper">
		<div class="page-wrapper">
			<!-- main header -->
			       			<?php include_once("includes/header.php"); ?>

			<main id="main">
				<!-- main contact information block -->
				<div class="bg-white">
					<div class=" container-fluid p-none" style="background: url('img/tailor-2.jpg');background-size: cover;">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                   

                        
						 <!-- <div style="height:40px;"></div> -->
                            <div class="assessment-container ">
                                <div class="row">
                                    <div class="col-lg-6 col-lg-offset-3 form-box">
                                        <form role="form" class="registration-form" action="javascript:void(0);">
                                            <fieldset>
                                                <div class="form-top text-center">
                                                    <div class="form-top-left">
                                                    <h1 class="text-center font-weight-500 tmt-heading">Tailor Make a Tour</h1>

                                                        <h3>1. Your Info</h3>
                                                        
                                                    </div>
                                                </div>
                                                <div class="form-bottom row m-none">
                                                   
                                                    <div class="form-group col-lg-6 p-4">
                                                        <input type="text" class="form-control" placeholder="Full Name*" id="fname">
                                                    </div>
                                                    <div class="form-group col-lg-6 p-4">
                                                        <input type="text" class="form-control" placeholder="Phone No*" id="">
                                                    </div>
                                                      
                                                    <div class="form-group col-lg-12 p-4">
                                                        <input type="text" name="email" placeholder="Email ID*" class="form-email form-control" id="" required>
                                                    </div>

                                                    
                                                    <button type="button" class="btn btn-next view-details pull-right">Next <i class="fa fa-angle-right"></i> </button>
                                                </div>
                                            </fieldset>
                                             
                                            <fieldset>
                                                <div class="form-top">
                                                    <div class="form-top-left text-center">
                                                    <h1 class="text-center font-weight-500 tmt-heading">Tailor Make a Tour</h1>
                                                        <h3>2. Trip Details</h3>
                                                        
                                                    </div>
                                                </div>
                                                <div class="form-bottom row m-none">
                                                   
                                                     <div class="form-group col-lg-6 p-4">
                                                        <input type="text" class="form-control" placeholder="No. Of Adults Travelling*" id="">
                                                    </div>
                                                     <div class="form-group col-lg-6 p-4">
                                                        <input type="text" class="form-control" placeholder="Number of Children traveling*" id="">
                                                    </div>

                                                    <div class="form-group col-lg-6 p-4">
                                                        <input type="text" class="form-control" placeholder=" Nationality of Travelers*" id="">
                                                    </div>
                                                     <div class="form-group col-lg-6 p-4">
                                                        <input type="text" class="form-control" placeholder="Number of Rooms required*" id="">
                                                    </div>
                                                     <div class="form-group col-lg-6 p-4">
                                                        <input type="text" class="form-control" placeholder="Number of Days or Nights*" id="">
                                                    </div>
                                                    <!-- .... -->
                                                    <div class="form-group col-lg-6 p-4">
                                                        <input type="text" class="form-control" placeholder="Date of arrival & departure (with approx time, if available)*" id="">
                                                    </div>
                                                    <div class="form-group col-lg-6 p-4">
                                                        <input type="text" class="form-control" placeholder="Preferred City or cities of entry/exit, if any*" id="">
                                                    </div>
                                                    <div class="form-group col-lg-6 p-4">
                                                        <input type="text" class="form-control" placeholder="Places or attractions that you want to visit*" id="">
                                                    </div>
                                                    <div class="form-group col-lg-6 p-4">
                                                        <input type="text" class="form-control" placeholder="Class of Hotels required: 5 Star Luxury / 5 Star Standard / 4 Star / Budget (2-3 star)*" id="">
                                                    </div> 
                                                    <!-- .... -->
                                                    <div class="form-group col-lg-6 p-4">
                                                        <input type="text" class="form-control" placeholder="Travel Budget Per Person (without airfare)*" id="">
                                                    </div>
                                                    <div class="form-group col-lg-6 p-4">
                                                        <input type="text" class="form-control" placeholder="Your preferred currency to get quote (USD / AUD / EUR / GBP)*" id="">
                                                    </div>
                                                    <div class="form-group col-lg-6 p-4">
                                                        <input type="text" class="form-control" placeholder="Any other Special requirements*" id="">
                                                    </div>
                                                   
                                                    <button type="button" class="btn btn-previous view-details pull-left"><i class="fa fa-angle-left"></i> Previous</button>
                                                    <button type="submit" class="btn view-details pull-right">Submit</button>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        
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
	
	<script type="text/javascript" src="js/tailor-make-sgr.js"></script>
	<script src="js/contact-form.js"></script>
	<!-- custom script -->
	
</body>
</html>