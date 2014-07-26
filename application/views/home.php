<input type="text" id="txtMedicine" name="txtMedicine" placeholder="Escriba el nombre del medicamento a buscar" />
<br/>
<a id="custom-search" href="#">B&uacute;squeda Personalizada</a>

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

<div id="mapContainer" style="width:200px; height:200px;"></div>

<script type="text/javascript">
$(function () {
	$('#custom-search').click(function(){
		console.log('Here I am');		
	});
	


	$('#txtMedicine').autocomplete({	
				source: function( request, response ) {
	                $.ajax({
	                    url: "<?php echo base_url('farmapp/getCoincidences')."/" ?>" + escape($("#txtMedicine").val()),
	                    dataType: "json",
	                    success: function(data) {
	                    			console.log ("url => "+"<?php echo base_url('farmapp/getCoincidences')."/" ?>" + escape($("#txtMedicine").val()));	                    	                    	                    
	                                response($.map(data, function(item, index) {
	                                return {
	                                    label: item.name +' '+ item.concentration+item.units,
	                                    val: item.idmedicine
	                                    //abbrev: item.abbrev
	                                    };
	                            }));
	                        }
	                    });
	                },
	            minLength: 2,
				position: { my: "left bottom", at: "left top", collision: "flip" },
				select: function (event, ui) { console.log('selected'+ui.item.val); setMedicine(ui.item.val);  } 
			});
});


function setMedicine(medi){	
	$.ajax({
		url: "<?php echo base_url('farmapp/get')."/" ?>" + medi,
	    dataType: "json",
	    success: function(data) {
	    	//console.log('data => '+);	    	
	    	$('#medInfo').show();
	    	$('#medName').html(data.name);
	    	$('#medCat').html(data.cat);
	    	$('#medConc').html(data.concentration +" "+ data.units);
	    	$('#medPrice').html(data.price);	    	
	   	}
	});	
}

</script>