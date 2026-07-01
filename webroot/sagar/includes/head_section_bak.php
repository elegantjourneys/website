<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Entrada</title>

	<!-- favion -->

	<link rel="icon" type="image/png" sizes="16x16" href="<?=WEBROOT?>img/favicon-16x16.png">

	<!-- link to font awesome -->

	<link media="all" rel="stylesheet" href="<?=WEBROOT?>vendors/font-awesome/css/font-awesome.css">

	<!-- link to material icon font -->

	<link media="all" rel="stylesheet" href="<?=WEBROOT?>vendors/material-design-icons/material-icons.css">

	<!-- link to custom icomoon fonts -->

	<link rel="stylesheet" type="text/css" href="<?=WEBROOT?>css/fonts/icomoon/icomoon.css">

	<!-- link to wow js animation -->

	<link media="all" rel="stylesheet" href="<?=WEBROOT?>vendors/animate/animate.css">

	<!-- include bootstrap css -->

	<link media="all" rel="stylesheet" href="<?=WEBROOT?>css/bootstrap.css">

	<!-- include owl css -->

	<link media="all" rel="stylesheet" href="<?=WEBROOT?>vendors/owl-carousel/owl.carousel.css">

	<link media="all" rel="stylesheet" href="<?=WEBROOT?>vendors/owl-carousel/owl.theme.css">

	<!-- include main css -->

	<link media="all" rel="stylesheet" href="<?=WEBROOT?>css/main.css">

	<!-- link to revolution css  -->

	<link rel="stylesheet" type="text/css" href="<?=WEBROOT?>vendors/revolution/css/settings.css">

    <!-- CUSTOM stylesheet -->

	<link rel="stylesheet" type="text/css" href="<?=WEBROOT?>css/style.css">

    <!-- CUSTOM fonts -->

	<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i,900i" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

	<link href="<?=WEBROOT?>css/jquery.bxslider.css" rel="stylesheet" />



	<?php

		if($mobileView)

		{

	?>

	<link rel="stylesheet" type="text/css"  href="<?=WEBROOT?>css/small-device.css" />

	<?php

		}

	?>

	<style>

		.top-right-panel {

				float: right;

				max-width: 100%;

			}

		.header-top {

			background-color:#F8F8F8

		}



		.navbar-nav > li {

				padding: 40px 14px 0 !important;

			}

		.navbar-default .navbar-nav {

				max-width: calc(100% - 240px);

				padding-top: 40px;

			}

		.top-right-panel > li {

			display: inline-block;

			font-size: 12px;

			font-weight: normal;

			padding: 0 10px;

			vertical-align: top;

		}



		.navbar-default .navbar-nav > li > a {

				height: 25px;

			}



		.logo2 {

			border-right: 0 none;

			padding: 30px 15px 21px 0;

			width: 240px;

		}



		.navbar-default .navbar-nav > li > a {

			height: 25px;

			white-space: nowrap !important;

		}

	</style>