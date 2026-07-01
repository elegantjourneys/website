<?php
	include_once(BASEPATH_CLASS."first-class.php");
	$objFirstClass = new FirstClass();

	//$cachefile=$objFirstClass->checkCacheFile();

	if((!isset($metaTags['page_url']))||($metaTags['page_url']==""))
	{
		$metaTags['page_url'] = WEBROOT.$objFirstClass->getPageName();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?=$metaTags['meta_title']?></title>
	<meta name="description" content="<?=$metaTags['meta_description']?>" />
	<meta name="keywords" content="<?=$metaTags['meta_keyword']?>" />
	<meta name="language" content="en-us" />
	<meta name="DC.Title" content="Elegant Journeys"/>
	
	
	<meta http-equiv="Pragma" content="Public">
	<meta http-equiv="Cache-Control" content="Public">
	<meta http-equiv="Cache-Control" content="max-age=86400">
	<meta http-equiv="Cache-Control" content="Public">
	<meta http-equiv="Cache-Control" content="must-revalidate">
	<meta http-equiv="Vary" content="User-Agent">


	<meta name="distribution" content="Global" />
	<meta name="Robots" content="INDEX,FOLLOW" />
	<meta name='googlebot' content='noodp,noydir,index,follow' />
	<meta name='robots' content='noodp,noydir,index,follow' />
	<meta name="rights" content="https://plus.google.com/u/0/+ElegantjourneysCo/posts" />
	<meta property="og:title" content="<?=$metaTags['og_title']?>">
	<meta property="og:site_name" content="Elegant Journeys">
	<meta property="og:keywords" content=""/>
    <meta property="og:image" content="https://wwww.elegantjourneys.com/img/banner/img-01.jpg"/>
	<meta property="og:url" content="<?=$metaTags['page_url']?>">
	<meta property="og:description" content="<?=$metaTags['og_description']?>">
	<meta property="fb:app_id" content="2347471856">
	<meta property="og:type" content="website">

	<!-- WORK SANS = Helvetica Neue -->
	<link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600,700" rel="stylesheet">
	
	<!-- favion -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?=WEBROOT?>img/favicon-16x16.png">
	<!-- link to font awesome -->
	
	
	
	<link media="all" rel="stylesheet" href="<?=WEBROOT?>vendorsorig/font-awesome/css/font-awesome-compressed.css">
	
		<!-- link to custom icomoon fonts -->
	<link rel="stylesheet" type="text/css" href="<?=WEBROOT?>cssorig/fonts/icomoon/icomoon.css">
	
	<!-- include bootstrap css -->
	<link media="all" rel="stylesheet" href="<?=WEBROOT?>cssorig/bootstrap.css">
	<!-- include owl css -->
	<link media="all" rel="stylesheet" href="<?=WEBROOT?>vendorsorig/owl-carousel/owl.carousel-compressed.css">
	<link media="all" rel="stylesheet" href="<?=WEBROOT?>vendorsorig/owl-carousel/owl.theme-compressed.css">
	<!-- include main css -->
	<link media="all" rel="stylesheet" href="<?=WEBROOT?>cssorig/main-compressed.css">
		
	<link rel="stylesheet" type="text/css"  href="<?=WEBROOT?>css/custom-sgr-compressed.css" />
	<!-- include video css -->
	<link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />

	<script>
			(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-TFNB3MWF');
    </script>



 
 