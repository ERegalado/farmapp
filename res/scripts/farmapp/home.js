$(function () {
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
	
	//Load topVoted
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

	//geolocate
	if (navigator.geolocation)
		navigator.geolocation.getCurrentPosition(showPosition,showError);
	else
		alert("Geolocation is not supported by this browser.");
	
}

function showPosition(position) {
        $.ajax({
	      url: "http://api.geonames.org/srtm3JSON?lat="+position.coords.latitude+"&lng="+position.coords.longitude+"&username=fanmixco",
	      async: false,
	      dataType: 'json',
	      success: function (data) {
		  
		  nokia.Settings.set("app_id", "xfWoSkntk0Ao3r8C6wZ6");
		nokia.Settings.set("app_code", "snDmPQuP-71myYTab77aIA");
		
		nokia.Settings.set("serviceMode", "cit");
				
		var infoBubbles = new nokia.maps.map.component.InfoBubbles(),
			markersContainer = new nokia.maps.map.Container();
		var display = new nokia.maps.map.Display(document.getElementById("mapContainer"),
							 {
								 "components": [
										   infoBubbles,
										   new nokia.maps.map.component.ZoomBar(),
										   new nokia.maps.map.component.Behavior(),
										   new nokia.maps.map.component.TypeSelector()],
								 "zoomLevel": 12,
								 "center": [13.7945185, -88.896530]
							 });
		
		display.objects.add(markersContainer);
		
		var TOUCH = nokia.maps.dom.Page.browser.touch,
			CLICK = TOUCH ? "tap" : "click";
		
		function extend(B, A) {
			function I() {};
			I.prototype = A.prototype;
			B.prototype = new I;
			B.prototype.constructor = B;
			B.superprototype = A.prototype;
		};
				console.log(data);
		        var latitude = data.lat;

		        var longitude = data.lng;

		        var altitude = data.srtm3;                

                var coord = new nokia.maps.geo.Coordinate(latitude, longitude),
                standardMarker = new nokia.maps.map.StandardMarker(coord, {text: "L"});
                display.objects.add(standardMarker);

                /*var g = calculateGravity(latitude, altitude);

				bubbleMarker2 = new InfoBubbleMarker(
					coord,
					infoBubbles,
					"gravity: "+g.toFixed(6)+"m/s&sup2;",
					{ 
						eventDelegationContainer: markersContainer,
                        text: "L" ,
						brush: { color: '#1080dd' }						
					}
				);*/
						
				// Add bubbleMarker to the markers container so it will be rendered onto the map
//				markersContainer.objects.add(bubbleMarker);
			
                display.set('zoomLevel', 12);
            	display.set('center', coord);
		}
	});
}

function showError(error)
{
	switch(error.code) 
	{
		case error.PERMISSION_DENIED:
		  alert("User denied the request for Geolocation.");
		  break;
		case error.POSITION_UNAVAILABLE:
		  alert("Location information is unavailable..");
		  break;
		case error.TIMEOUT:
		  alert("The request to get user location timed out.");
		  break;
		case error.UNKNOWN_ERROR:
		  alert("An unknown error occurred.");
		  break;
	}
}