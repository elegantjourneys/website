<?php
	include_once(BASEPATH_CLASS."first-class.php");
	$objFirstClass = new FirstClass();

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
	<meta http-equiv="CACHE-CONTROL" content="PUBLIC" />
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
	<link media="all" rel="stylesheet" href="<?=WEBROOT?>vendorsorig/font-awesome/css/font-awesome.css">
	<!-- link to material icon font -->
	<link media="all" rel="stylesheet" href="<?=WEBROOT?>vendorsorig/material-design-icons/material-icons.css">
	<!-- link to custom icomoon fonts -->
	<link rel="stylesheet" type="text/css" href="<?=WEBROOT?>cssorig/fonts/icomoon/icomoon.css">
	<!-- link to wow js animation -->
	<link media="all" rel="stylesheet" href="<?=WEBROOT?>vendorsorig/animate/animate.css">
	<!-- include bootstrap css -->
	<link media="all" rel="stylesheet" href="<?=WEBROOT?>cssorig/bootstrap.css">
	<!-- include owl css -->
	<link media="all" rel="stylesheet" href="<?=WEBROOT?>vendorsorig/owl-carousel/owl.carousel.css">
	<link media="all" rel="stylesheet" href="<?=WEBROOT?>vendorsorig/owl-carousel/owl.theme.css">
	<!-- include main css -->
	<link media="all" rel="stylesheet" href="<?=WEBROOT?>cssorig/main.css">
	<!-- link to revolution css  -->
	<link rel="stylesheet" type="text/css" href="<?=WEBROOT?>vendorsorig/revolution/css/settings.css">
	
	<link rel="stylesheet" type="text/css"  href="<?=WEBROOT?>css/custom-sgr.css" />

	<? /******** MARKETING TAGS *******************/ ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-88646643-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-88646643-1');
	</script>

	<!-- Global site tag (gtag.js) - Google Ads: 984632813 -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=AW-984632813"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'AW-984632813');
	</script>

	<? /******** MARKETING TAGS ends *******************/ ?>
	
	<!-- Miscrosft Clarity code start given by Abhijeet-->
    
    <script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "ikmpndyzit");
</script>

 <!-- Miscrosft Clarity conversion code End -->
 
 
 
 <!-- Meta Pixel Code Start -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '990215722193640');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=990215722193640&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
 