<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Admin::Elegant Journeys</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?= $this->Url->assetUrl('admin_assets/img/kaiadmin/favicon.ico'); ?>" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="<?= $this->Url->assetUrl('admin_assets/js/plugin/webfont/webfont.min.js');?>"></script>
	<script>
		WebFont.load({
			google: {"families":["Public Sans:300,400,500,600,700"]},
			custom: {"families":["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ["<?= $this->Url->assetUrl('admin_assets/css/fonts.min.css')?>"]},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="<?= $this->Url->assetUrl('admin_assets/css/bootstrap.min.css');?>">
	<link rel="stylesheet" href="<?= $this->Url->assetUrl('admin_assets/css/plugins.min.css');?>">
	<link rel="stylesheet" href="<?= $this->Url->assetUrl('admin_assets/css/kaiadmin.css');?>">
	

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="<?= $this->Url->assetUrl('admin_assets/css/demo.css');?>">
	<link rel="stylesheet" href="<?= $this->Url->assetUrl('admin_assets/css/admin-style.css');?>">
	<script src="<?= $this->Url->assetUrl('admin_assets/js/core/jquery-3.7.1.min.js');?>"></script>

	<?php
		echo $this->Html->script('ckeditor/ckeditor');
		echo $this->Html->script('ckfinder/ckfinder');
	?>
	<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
</head>
<body>
	<div class="wrapper">
		<!-- Sidebar -->
		<?php //echo $this->element("sidebar"); ?>
		<!-- End Sidebar -->

		<div class="main-panel col-md-12">
    	    <?php echo $this->element("header"); ?>		
    		<?php echo $this->fetch('content'); ?>
		    <?php echo $this->element("footer"); ?>
			
	    </div>
		
		<!-- Custom template | don't include it in your project! -->
		<?php /* ?><div class="custom-template">
			<div class="title">Settings</div>
			<div class="custom-content">
				<div class="switcher">
					<div class="switch-block">
						<h4>Logo Header</h4>
						<div class="btnSwitch">
							<button type="button" class=" selected changeLogoHeaderColor" data-color="dark"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="white"></button>
							<br/>
							<button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Navbar Header</h4>
						<div class="btnSwitch">
							<button type="button" class="changeTopBarColor" data-color="dark"></button>
							<button type="button" class="changeTopBarColor" data-color="blue"></button>
							<button type="button" class="changeTopBarColor" data-color="purple"></button>
							<button type="button" class="changeTopBarColor" data-color="light-blue"></button>
							<button type="button" class="changeTopBarColor" data-color="green"></button>
							<button type="button" class="changeTopBarColor" data-color="orange"></button>
							<button type="button" class="changeTopBarColor" data-color="red"></button>
							<button type="button" class="selected changeTopBarColor" data-color="white"></button>
							<br/>
							<button type="button" class="changeTopBarColor" data-color="dark2"></button>
							<button type="button" class="changeTopBarColor" data-color="blue2"></button>
							<button type="button" class="changeTopBarColor" data-color="purple2"></button>
							<button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
							<button type="button" class="changeTopBarColor" data-color="green2"></button>
							<button type="button" class="changeTopBarColor" data-color="orange2"></button>
							<button type="button" class="changeTopBarColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Sidebar</h4>
						<div class="btnSwitch">
							<button type="button" class="changeSideBarColor" data-color="white"></button>
							<button type="button" class="selected changeSideBarColor" data-color="dark"></button>
							<button type="button" class="changeSideBarColor" data-color="dark2"></button>
						</div>
					</div>
				</div>
			</div>
			<div class="custom-toggle">
				<i class="icon-settings"></i>
			</div>
		</div><?php */ ?>
		<!-- End Custom template -->

	</div>
	<!--   Core JS Files   -->
	
	<script src="<?= $this->Url->assetUrl('admin_assets/js/core/popper.min.js');?>"></script>
	<script src="<?= $this->Url->assetUrl('admin_assets/js/core/bootstrap.min.js');?>"></script>

	<!-- jQuery Scrollbar -->
	<script src="<?= $this->Url->assetUrl('admin_assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js');?>"></script>

	<!-- Chart JS -->
	<script src="<?= $this->Url->assetUrl('admin_assets/js/plugin/chart.js/chart.min.js');?>"></script>

	<!-- jQuery Sparkline -->
	<script src="<?= $this->Url->assetUrl('admin_assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')?>"></script>

	<!-- Chart Circle -->
	<script src="<?= $this->Url->assetUrl('admin_assets/js/plugin/chart-circle/circles.min.js');?>"></script>

	<!-- Datatables -->
	<script src="<?= $this->Url->assetUrl('admin_assets/js/plugin/datatables/datatables.min.js');?>"></script>

	<!-- Bootstrap Notify -->
	<script src="<?= $this->Url->assetUrl('admin_assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js');?>"></script>

	<!-- jQuery Vector Maps -->
	<script src="<?= $this->Url->assetUrl('admin_assets/js/plugin/jsvectormap/jsvectormap.min.js');?>"></script>
	<script src="<?= $this->Url->assetUrl('admin_assets/js/plugin/jsvectormap/world.js');?>"></script>

	<!-- Sweet Alert -->
	<script src="<?= $this->Url->assetUrl('admin_assets/js/plugin/sweetalert/sweetalert.min.js')?>"></script>

	<!-- Kaiadmin JS -->
	<script src="<?= $this->Url->assetUrl('admin_assets/js/kaiadmin.min.js');?>"></script>

	<!-- Kaiadmin DEMO methods, don't include it in your project! -->
	<!-- <script src="<?= $this->Url->assetUrl('admin_assets/js/setting-demo.js');?>"></script>
	<script src="<?= $this->Url->assetUrl('admin_assets/js/demo.js');?>"></script> -->
	<script>
		$('#lineChart').sparkline([102,109,120,99,110,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#177dff',
			fillColor: 'rgba(23, 125, 255, 0.14)'
		});

		$('#lineChart2').sparkline([99,125,122,105,110,124,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#f3545d',
			fillColor: 'rgba(243, 84, 93, .14)'
		});

		$('#lineChart3').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#ffa534',
			fillColor: 'rgba(255, 165, 52, .14)'
		});
	</script>
</body>
</html>