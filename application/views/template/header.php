<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title><?php echo $title; ?></title>
	<!-- Styles -->
	<link rel="stylesheet" href="styles/template.css" type="text/css" media="screen" charset="utf-8">	
	<!-- JS -->
	<script type="text/javascript" src="res/scripts/jquery-1.9.0.min.js"></script>
	<script type="text/javascript" src="res/scripts/jquery-migrate-1.2.1.min.js"></script>
	<!-- Plugins & other scripts -->
	<?php if (isset($scripts)) echo $scripts;?>
</head>
<body>
	<div id="wrapper">				
		<div id="header"></div>
		<div id="content">			
