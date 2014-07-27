var locations;
var selMedi;
var display;
var isLoaded = false;
$(function () {
	
	$('#txtMedicine').autocomplete({	
			source: function( request, response ) {
				$.ajax({
					url: $("#base").val()+'farmapp/getCoincidences/' + escape($("#txtMedicine").val()),
					dataType: "json",
					success: function(data) {
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
		url: $("#base").val()+'farmapp/getTop/',
		dataType: "json",
		success: function(data) {
			var topContent = "";
			$.each(data,function(i,item){
				topContent+="<li onclick='setMedicine("+item.idmedicine+")'><div><span class='right'>$ "+Math.round(item.price * 100) / 100 +"</span><span>"+item.name+" "+item.concentration+" "+item.units+"<br/>"+item.cat+"</span></div></li>";
			});
			console.log(topContent);
			$('#topSearch').html(topContent);
		}
	});
	
	
	$.ajax({
		url: $("#base").val()+'drugstores/getTop/',
		dataType: "json",
		success: function(data) {
			var topContent = "";
			var myClass = "";
			var rating = new Array();
			$.each(data,function(i,item){											
				if (i == data.length-1) myClass="class='last'";
				topContent+="<li "+myClass+"><div><img src='"+$("#base").val()+"res/imgs/drugstores/"+item.photo+"'/></div><div class='rate'><div id='raty"+i+"' style='margin-top:8px;'></div></div></li>";				
				rating[i] = item.rating;
			});
//			console.log(topContent);
			$('#topStores').html(topContent);
			$('#raty').html(topContent);			
			
			for(var i=0;i<data.length;i++){
				$('#raty'+i).raty({ score:  rating[i]});
			}
		}
	});
	
	
});


function setMedicine(medi){	
	selMedi = medi;
	$.ajax({
		url: $("#base").val()+'farmapp/get/'+ medi,
	    dataType: "json",
	    success: function(data) {
	    	//console.log('data => '+);	    	
			$('#iniContent').css('opacity',0);			
			$('#medInfo').css('display','block');
	    	$('#medName').html(data.name);
	    	$('#medCat').html(data.cat);
			$('#allInfo').html(data.concentration +" "+ data.units+", "+data.cat);			
	    	$('#medConc').html(data.concentration +" "+ data.units);
	    	$('#medPrice').html('$ '+Math.round(data.price * 100) / 100);			
			console.log('selMedi => '+selMedi);
			setTimeout(function(){
				$('#iniContent').css('display','none');				
				$('#medInfo').css('opacity',1);
			},250);			
	   	}
	});	

	//geolocate
	if (navigator.geolocation)
		navigator.geolocation.getCurrentPosition(showPosition,showError);
	else
		alert("Geolocation is not supported by this browser.");
	
}

function showPosition(position) {
	if (!isLoaded){
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
		display = new nokia.maps.map.Display(document.getElementById("mapContainer"),
							 {
								 "components": [
										   infoBubbles,
										   new nokia.maps.map.component.ZoomBar(),
										   new nokia.maps.map.component.Behavior(),
										   new nokia.maps.map.component.TypeSelector()],
								 "zoomLevel": 12,
								 "center": [position.coords.latitude, position.coords.longitude]
							 });
		
		display.addListener("click", function (evt) {
        if ((evt.target.$href === undefined) == false) {
            window.location = evt.target.$href;
        } else if ((evt.target.$click === undefined) == false) {
            var onClickDo = new Function(evt.target.$click);
            onClickDo();
        }
		});
		
		display.objects.add(markersContainer);
		isLoaded = true;
		
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

                display.set('zoomLevel', 12);
            	display.set('center', coord);
		}
	});
}
		
	createMarkers(position.coords.latitude,position.coords.longitude);
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

function createMarkers(lat, lng) {
	$.ajax({
		url: $("#base").val()+"/drugstores/getNearest/" + lat + "/" + lng + "/" + selMedi,
		type: "GET",
		dataType: "json",
		success: function (source) {
			console.log(source);
			locations = source;
			showInfo();
		},
		error: function (dato) {
			alert("ERROR");
		}
	});
}

function showInfo() {
	display.objects.clear();

	var red = { color: "#FF0000" };

	var lat,
		lng,
		markerCoords;

	container = new nokia.maps.map.Container();

	for (var idx = 0; idx < locations.length; idx++) {
		var standardMarker;

		loc = locations[idx];

		lat = parseFloat(loc.latitude);
		lng = parseFloat(loc.longitude);

		markerCoords = new nokia.maps.geo.Coordinate(lat, lng);

		var messageTime = '$.Zebra_Dialog("<b>Farmacia:</b> ' + loc.name + '<br /><b>Direccion:</b> ' + loc.address + '<br /><b>Telefonos:</b> ' + loc.telephones + '<br />", {'+
		'"type":     "FALSE",'+
		'"title":    "'+loc.name+'",'+
		'"buttons":  ['+
						/*'{caption: "Ver más", callback: function() { window.location="drugResult.html?id=' + selMedi + '&lat=' + lat + '&lng=' + lng + '" }},'+*/
						'{caption: "Cancelar", callback: function() { return; }},'+
					']});';

		if (idx == locations.length - 1) {
			standardMarker = new nokia.maps.map.StandardMarker(markerCoords, { $click: messageTime });
			standardMarker.set("brush", red);
		}
		else
			standardMarker = new nokia.maps.map.StandardMarker(markerCoords, { $click: messageTime });

		container.objects.add(standardMarker);

	}
	display.objects.add(container);
}