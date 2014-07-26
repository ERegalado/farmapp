<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

function jUI(){
	$jui = '
	<!-- jQuery-UI -->
	<script src="'.base_url('res/scripts/jquery-ui/jquery-ui.js').'"></script>
	<link rel="stylesheet" type="text/css" href="'.base_url('res/scripts/jquery-ui/jquery-ui.css').'"/>';
	
	return $jui;
}

function maps(){
	$maps = '
	<!-- MAPS -->
	<script src="'.base_url('res/scripts/maps/getLanguage.js').'"></script>
	<!-- Nokia Here section-->	
	<script src="http://js.cit.api.here.com/se/2.5.3/jsl.js?with=all"></script>  
	<script src="'.base_url('res/scripts/maps/markerclusterer.js').'"></script>
	<script src="http://developer.here.com/apiexplorer/examples/templates/js/exampleHelpers.js"></script>	
	<link rel="stylesheet" type="text/css" href="http://developer.here.com/apiexplorer/examples/templates/js/exampleHelpers.css"/>
	<script src="'.base_url('res/scripts/maps/zebra_dialog.js').'"></script>	
	
	<script type="text/javascript" src="'.base_url('res/scripts/maps/getLanguage.js').'"></script>
	<script type="text/javascript" src="'.base_url('res/scripts/maps/mapData.js').'"></script>	
	';
	
	return $maps;
}

?>