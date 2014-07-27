<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title><?php echo $title; ?></title>
	<!-- Styles -->
	<link rel="stylesheet" href="<?php echo base_url('res/styles/farmapp.css'); ?>" type="text/css" media="screen" charset="utf-8">	
	<!-- JS -->
	<script type="text/javascript" src="res/scripts/jquery-1.9.0.min.js"></script>
	<script type="text/javascript" src="res/scripts/jquery-migrate-1.2.1.min.js"></script>
	<!-- Plugins & other scripts -->
	<?php if (isset($scripts)) echo $scripts;?>
</head>
<body>
	<div id="wrapper">				
		<div id="header">
			<div class="wrap">
				<div>
					<a href="<?php echo base_url(); ?>"><img id="logo" src="<?php echo base_url('res/imgs/logo.png'); ?>"></a>
					
					<ul class="nav right" style="line-height:41px;">
						<li><?php echo anchor(base_url('sue'),'Denunciar'); ?></li>
						<li><?php echo anchor(base_url('login'),'Login'); ?></li>
					</ul>
				</div>
			</div>
		</div>
		<div id="content">			
