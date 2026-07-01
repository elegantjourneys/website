<?php

	include_once("includes/config.php");

	include_once(BASEPATH."includes/head-section.php");

	

?>

</head>

<body>

<div class="container-fluid margin-top-168 contact-bg">

			    <div class="contact-width">

						<h1>inquiry form</h1>

						<hr>

						<form>

							 <div class="main-form-div">

							 		<div class="form-icon"><img src="img/tours/name.png"></div>

							 		<div class="form-input">

							 			<lable>Name</lable>

							 			<input name="name" type="text">

							 		</div><div class="clearfix"></div>

							 </div>	

							 <div class="main-form-div">

							 		<div class="with50">

								 		<div class="form-icon image-left"><img src="img/tours/contact.png"></div>

								 		<div class="form-input">

								 			<lable>Contact Number</lable>

								 			<input value=" (Do NOT enter 'plus, minus sign - hyphen or blank space') " name="name" type="text">

								 		</div><div class="clearfix"></div>

							 		</div>

							 		<div class="with50 float-right">

								 		<div class="form-icon"><img src="img/tours/email.png"></div>

								 		<div class="form-input">

								 			<lable>Email Address</lable>

								 			<input name="name" type="text">

								 		</div><div class="clearfix"></div>

							 		</div>							 		

							 </div>	

							 <div class="main-form-div">

							 		<div class="with50">

								 		<div class="form-icon image-left"><img src="img/tours/city.png"></div>

								 		<div class="form-input">

								 			<lable>City &amp; Country</lable>

								 			<input name="name" type="text">

								 		</div><div class="clearfix"></div>

							 		</div>

							 		<div class="with50 float-right">

								 		<div class="form-icon"><img src="img/tours/number.png"></div>

								 		<div class="form-input">

								 			<lable>Number of travellers</lable>

								 			<div class="travellers-info">

								 				<span class="main-speciy">Adults  

								 				<div class="tooltip-m">i</div>

								 				<div class="hover-div">3 Days to go</div>	

								 				</span>

								 				<input type="">

								 			</div>

								 			<div class="travellers-info">

								 				<span>Children

								 				<div class="tooltip-m">i</div>

								 				<div class="hover-div">3 Days to go</div>	

								 				</span>

								 				<input type="">

								 			</div>

								 			<div class="travellers-info">

								 			    <span>Adults

								 				<div class="tooltip-m">i</div>

								 				<div class="hover-div">3 Days to go</div>	

								 				</span>

								 				<input type="">

								 			</div>

								 		</div><div class="clearfix"></div>

							 		</div>							 		

							 </div>

							 <div class="main-form-div">

							 		<div class="with50">

								 		<div class="form-icon image-left"><img src="img/tours/rooms.png"></div>

								 		<div class="form-input">

								 			<lable>Room Required</lable>

								 			<input name="name" type="text">

								 		</div><div class="clearfix"></div>

							 		</div>

							 		<div class="with50 float-right">

								 		<div class="form-icon"><img src="img/tours/travel.png"></div>

								 		<div class="form-input">

								 			<lable>Travel Type</lable>

											<select class="mine-select jcf-hidden">

											  <option value="volvo">Volvo</option>

											  <option value="saab">Saab</option>

											  <option value="mercedes">Mercedes</option>

											  <option value="audi">Audi</option>

											</select><span class="jcf-select jcf-unselectable jcf-select-mine-select"><span class="jcf-select-text"><span class="">Volvo</span></span><span class="jcf-select-opener"></span></span>

								 		</div><div class="clearfix"></div>

							 		</div>							 		

							 </div>	

							 <div class="main-form-div">

							 		<div class="with50">

								 		<div class="form-icon image-left"><img src="img/tours/hotel.png"></div>

								 		<div class="form-input">

								 		    <lable>Hotel Preference </lable>

								 			<span class="form-radio"><input type="radio"> <lable>Luxury Hotels (Best Available)</lable></span>

								 			<span class="form-radio"><input type="radio"> <lable>Deluxe Hotels (5 Star)</lable></span>

								 			<span class="form-radio"><input type="radio"> <lable>Standard Hotels (4 Star) </lable></span>

								 		</div><div class="clearfix"></div>

							 		</div>

							 		<div class="with50 float-right">

								 		<div class="form-icon"><img src="img/tours/arrival.png"></div>

								 		<div class="form-input arrival">

								 			<lable>Arrival Date</lable>

								 			<input value="30/09/2016" type="text">

								 		</div><div class="clearfix"></div>

							 		</div>							 		

							 </div>	

						</form>

							 <div class="main-form-div" style="border-bottom:0px;">

							 		<div class="form-icon"><img src="img/tours/requirements.png"></div>

							 		<div class="form-input">

							 			<lable> Your Special Requirements</lable>

							 			<textarea value="please specify - if any"></textarea>

							 		</div><div class="clearfix"></div>

							 </div>	

							 <div class="capcha">

							 		<div class="select-box">

							 			<input name="vehicle" value="Bike" type="checkbox"> I I'm not a robot<br>

							 		</div>

							 		<div class="capcha-image">

							 			<img src="img/tours/capcha.png">

							 		</div>

							 </div>

							 <div class="submit-btn">

							 		<input value="submit" type="submit">

							 </div>						

				</div>

			</div>

			</body>

</html>