<div id="search">	
	<img src="<?php echo base_url('res/imgs/health.jpg'); ?>" />
	<div class="wrap">
		<input type="text" id="txtMedicine" name="txtMedicine" placeholder="Escribe aqu&iacute; tu medicamento" />		
	</div>
</div>
<div id="iniContent">
<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	<div id="tops" class="tcenter wrap">
		<h1 class="front">Top Farmacias</h1><hr class="behind"/><br/>
		<p class="tcenter">Aqu&iacute; encontrar&aacute;s un listado de las farmacias que han sido calificadas como las mejores por sus precios y servicio.</p>
		<br/>
		<ul id="topStores" class="clearfix">			
			<li>						
				<div><img src="<?php echo base_url('res/imgs/health.jpg'); ?>"/></div>
				<div class="rate">
					<div id="raty1"></div>
				</div>
			</li>
			<li>			
				<img src="<?php echo base_url('res/imgs/health.jpg'); ?>"/>
				<div>
					<div id="raty1"></div>
				</div>
			</li>
			<li>			
				<img src="<?php echo base_url('res/imgs/health.jpg'); ?>"/>
				<div>
					<div id="raty1"></div>
				</div>
			</li>	
		</ul>
		<br/><br/>
		<hr/>
		<br/><br/>
		<div class="half left">
			<h2>Productos m&aacute;s buscados</h2>
			<ul id="topSearch">			
			</ul>
		</div>
		<div class="half right">
			<h2 style="margin-left:30px;">Denuncias Ciudadanas</h2>
			<div style="margin-left:30px;">
			<a class="twitter-timeline" href="https://twitter.com/MedicamentosSV" data-widget-id="493487556168663042">Tweets por @MedicamentosSV</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>
		</div>
	</div>
</div>

<div id="medInfo" style="opacity:0;display:none;">
	<div class="wrap">
		<div class="clearfix">
			<div class="left" style="width:75%;">
				<h1 id="medName" class="tleft" style="display:block;width:100%;"></h1>
				<p id="allInfo"></p>
			</div>
			<p id="medPrice" class="right tcenter" style="width:15%"></p>
		</div>
		<hr/>
		<!--
		<h2 id="medCat"></h2>		
		<b>Concentraci&oacute;n:</b><p id="medConc"></p>
		-->
		<br/><br/>
		<div id="mapContainer" style="width:100%; height:400px;"></div>		
	</div>
</div>
<div class="clearfix"></div>
<br/><br/>

<script type="text/javascript" src="<?php echo base_url('res/scripts/farmapp/home.js'); ?>"></script>