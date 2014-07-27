<div id="search">	
	<img src="<?php echo base_url('res/imgs/health.jpg'); ?>" />
	<div class="wrap">
		<input type="text" id="txtMedicine" name="txtMedicine" placeholder="Escribe aqu&iacute; tu medicamento" />
	</div>
</div>

<div id="tops" class="tcenter wrap">
	<h1 class="front">Top Farmacias</h1><hr class="behind"/><br/>
	<p class="tcenter">Aqu&iacute; encontrar&aacute;s un listado de las farmacias que han sido calificadas como las mejores por sus precios y servicio.</p>
	
	<hr/>
	
	<div class="half left">
		<h2>Productos m&aacute;s buscados</h2>
		<ul id="topSearch">
			
		</ul>
	</div>
	<div class="half right">
		<h2>Denuncias Ciudadanas</h2>
	</div>
</div>
<br/>

<div id="medInfo" style="display:none;">
	<h1 id="medName"></h1><hr/>
	<h2 id="medCat"></h2>
	<table border="0">
		<tr>
			<td><b>Concentraci&oacute;n</b></td>
			<td id="medConc"></td>
		</tr>
		<tr>
			<td><b>Precio de Venta</b></td>
			<td id="medPrice"></td>
		</tr>
	</table>
	<p class="tcenter">
		<a href="#">Ver Farmacias</a>
	</p>	
</div>

<div id="mapContainer" style="width:1200px; height:600px;"></div>

<script type="text/javascript" src="<?php echo base_url('res/scripts/farmapp/home.js'); ?>"></script>