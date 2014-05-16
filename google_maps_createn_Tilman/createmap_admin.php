<!DOCTYPE html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Schilfbewuchs</title>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
    
    //<![CDATA[
    

    var customIcons = {
      restaurant: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      },
      bar: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      }
    };
    
    //NAME OF FILE THAT CREATES XML from database
    var xmlurl = "http://tms-hl.de/inf1213/12/schilf/Homepage_schilf/google_maps_createn_Tilman/xml_aus_datenbank.php";
    

    function load() {
      MYMap = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(53.8305, 10.7422),
        zoom: 13,
        mapTypeId: 'hybrid'
      });
	   
      myglobalInfoWindow = new google.maps.InfoWindow();
       
      //create POLYGONES
	  var drawnPolygone = []; 
	  downloadUrl(xmlurl, function(data) { //"xml_aus_datenbank.php" 
	    var xml = data.responseXML;
        myxml = data.responseXML;
        var polygones = xml.documentElement.getElementsByTagName("polygone");
        for (var i = 0; i < polygones.length; i++) { //polygon wird ausgewählt
          var name = polygones[i].getAttribute("name");
          var imgurl = polygones[i].getAttribute("imgurl");  
          var html = "<b>" + name + "</b>";
		  var polygoneCoords = [];
		  var point = polygones[i].getElementsByTagName("point");
		  var firstcoord =[]
		  for (var j = 0; j < point.length; j++) {
			if (j == 0) { //erste koord speichern
				firstcoord = new google.maps.LatLng(parseFloat(point[j].getAttribute("lat")), parseFloat(point[j].getAttribute("lng")))
			}
			polygoneCoords.push(new google.maps.LatLng(parseFloat(point[j].getAttribute("lat")), parseFloat(point[j].getAttribute("lng"))));
		  }
		  polygoneCoords.push(firstcoord); //erste koord ans ende des polygpones der map wieder einfügen
		  drawnPolygone[i] = new google.maps.Polygon({
			map: MYMap,
			path: polygoneCoords,
			strokeColor: "#FF8000",
			strokeOpacity: 0.8,
			strokeWeight: 3,
			fillColor: "#FF8000",
			fillOpacity: 0.2
		  });
          bindInfoWindow(drawnPolygone[i], "polygone", MYMap, myglobalInfoWindow, html, polygoneCoords[0], new google.maps.Size(0, -5), imgurl, name);
        }
		
      });
	  
      
      //create POLYLINES
      drawnPolyline = [];
	  downloadUrl(xmlurl, function(data) { //"xml_aus_datenbank.php" 
	    var xml = data.responseXML;
        var polylines = xml.documentElement.getElementsByTagName("polyline");
        for (var i = 0; i < polylines.length; i++) { //polyline wird ausgewählt
          var name = polylines[i].getAttribute("name");
          var imgurl = polylines[i].getAttribute("imgurl");
          var html = "<b>" + name + "</b>";
		  var polylineCoords = [];
		  var point = polylines[i].getElementsByTagName("point");
		  for (var j = 0; j < point.length; j++) {
			polylineCoords.push(new google.maps.LatLng(parseFloat(point[j].getAttribute("lat")), parseFloat(point[j].getAttribute("lng"))));
		  }
		  drawnPolyline[i] = new google.maps.Polyline({
			map: MYMap,
			path: polylineCoords,
			strokeColor: "#FF8000",
			strokeOpacity: 0.8,
            draggable: false,
			strokeWeight: 9
		  });
          bindInfoWindow(drawnPolyline[i], "polyline", MYMap, myglobalInfoWindow, html, polylineCoords[0], new google.maps.Size(0, -5), imgurl, name);
        }
		
      });
      
      //create MARKERS
	  drawnMarker=[]; 
      downloadUrl(xmlurl, function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("name");
          var imgurl = markers[i].getAttribute("imgurl");          
          var address = markers[i].getAttribute("address");
          var type = markers[i].getAttribute("type");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html = "<b>" + name + "</b>";
          var icon = customIcons[type] || {};
          drawnMarker[i] = new google.maps.Marker({
            map: MYMap,
            position: point,
            icon: icon.icon,
            draggable: false,
            animation: 'DROP',
            shadow: icon.shadow
          });
          bindInfoWindow(drawnMarker[i], "marker", MYMap, myglobalInfoWindow, html, drawnMarker[i].getPosition(), new google.maps.Size(0, -40), imgurl, name);
        }
      }); //MARKERS
    } 
  

    function bindInfoWindow(object, type, map, infoWindow, html, anchor, pixeloffset, imgurl, name) {
      google.maps.event.addListener(object, 'click', function() {
        if (type == "marker") {
            var contenthtml = '<div id="infowindow" style="width: 200px; height:100px">\
            <h2>' + html + '</h2>\
            <a href="' + imgurl + '">\
            Weiterlesen..\
            </a>\
            </div>';
        } else if (type == "polyline") {
            var contenthtml = '<div id="infowindow" style="width: 400px; height:300px">\
            <a href="' + imgurl + '">\
            <IMG BORDER="0" ALIGN="Left" width="400" height="100"\
            SRC="' + imgurl + '"/>\
            </a>\
            </br>' + html + '<div id="onclickchange"  onclick= "straighten(&quot;' + name + '&quot;);"> straighten </div></br>\
            <div id="onclickchange"  onclick= "shift(&quot;' + name + '&quot;, &quot;up&quot;);"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; up </div>\
            <span id="onclickchange1"  onclick= "shift(&quot;' + name + '&quot;, &quot;left&quot;);"> left </span>\
            <span id="onclickchange2"  onclick= "shift(&quot;' + name + '&quot;, &quot;right&quot;);"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; right </span>\
            <div id="onclickchange3"  onclick= "shift(&quot;' + name + '&quot;, &quot;down&quot;);"> &nbsp;&nbsp;&nbsp;&nbsp; down </div>\
            </div>';
        } else {
            var contenthtml = '<div id="infowindow" style="width: 400px; height:380px">\
            <a href="' + imgurl + '">\
            <IMG BORDER="0" ALIGN="Left" width="400" height="300"\
            SRC="' + imgurl + '"/>\
            </a>\
            </br>' + html + '<div id="onclickchange"> change </div>\
            </div>';
        }
        infoWindow.setContent(contenthtml);
        infoWindow.setOptions({
        pixelOffset: pixeloffset
        });
        infoWindow.setPosition(anchor);
        infoWindow.open(map)
      });
    }
    
    function shift(name, dir) {
      koords = getKoords(name);
      var newkoords=[];
      if (dir == "up") {
        for (i=0; i < koords.length; i++) {
        newkoords.push(new google.maps.LatLng(parseFloat(koords[i].getAttribute("lat")) + 0.00002,
                                              parseFloat(koords[i].getAttribute("lng"))));
        }
      } else if (dir == "left") {
        for (i=0; i < koords.length; i++) {
        newkoords.push(new google.maps.LatLng(parseFloat(koords[i].getAttribute("lat")),
                                              parseFloat(koords[i].getAttribute("lng")) - 0.00002));
        }
      } else if (dir == "right") {
        for (i=0; i < koords.length; i++) {
        newkoords.push(new google.maps.LatLng(parseFloat(koords[i].getAttribute("lat")),
                                              parseFloat(koords[i].getAttribute("lng")) + 0.00002));
        }
      } else if (dir == "down") {
        for (i=0; i < koords.length; i++) {
        newkoords.push(new google.maps.LatLng(parseFloat(koords[i].getAttribute("lat")) - 0.00002,
                                              parseFloat(koords[i].getAttribute("lng"))));
        }
      }
      drawNewPolyline(newkoords, "#FFFF00");
      myxml = giveNewMyxml(name, newkoords);
    }
    
    
    function straighten(name) {
      var koords = getKoords(name);
      var deltay = koords[koords.length-1].getAttribute("lat") - koords[0].getAttribute("lat");
      var deltax = koords[koords.length-1].getAttribute("lng") - koords[0].getAttribute("lng");
      var steigung = (deltay) / (deltax);
      var lenght = Math.pow((Math.pow(deltay, 2) + Math.pow(deltax, 2)), 0.5);
      var singlelength = length / koords.length;
      var singlelengthx = deltax / (koords.length-1);
      var singlelengthy = deltay / (koords.length-1);
      
      var newkoords=[];
      for (i=0; i < koords.length; i++) {
        newkoords.push(new google.maps.LatLng(parseFloat(koords[0].getAttribute("lat")) + (singlelengthy * i),
                                              parseFloat(koords[0].getAttribute("lng")) + (singlelengthx * i)));
      }
      drawNewPolyline(newkoords, "#FFFF00");
      myxml = giveNewMyxml(name, newkoords);
    }
    
    function getKoords(name){
      var polylines = myxml.documentElement.getElementsByTagName("polyline");
      for (i=0; i < polylines.length; i++) {
        if (polylines[i].getAttribute("name") == name) {
            polylineid = i;
            drawnPolyline[polylineid].setMap(null);
            return (polylines[i].getElementsByTagName("point"));
        }
      }
    }
    
    function drawNewPolyline(newkoords, color){
      drawnPolyline[polylineid]= new google.maps.Polyline({
            map: MYMap,
			path: newkoords,
			strokeColor: color,
			strokeOpacity: 0.8,
            draggable: false,
			strokeWeight: 9
	  });
    }
    
    function giveNewMyxml(name, newkoords) {
        var polylines = myxml.documentElement.getElementsByTagName("polyline");
        for (i=0; i < polylines.length; i++) {
          if (polylines[i].getAttribute("name") == name) {
            id = i;
            var coords = polylines[i].getElementsByTagName("point");
            for (j=0; j < coords.length; j++) {
                myxml.getElementsByTagName("polyline")[id].getElementsByTagName("point")[j].setAttribute("lat", newkoords[j].lat());
                myxml.getElementsByTagName("polyline")[id].getElementsByTagName("point")[j].setAttribute("lng", newkoords[j].lng());

            }
          }
        }
        return (myxml);
    }

    
    function drawMarker() {
        var point = new google.maps.LatLng(53.838153835171234, 10.725318156475311);
        var  onclickmarker = new google.maps.Marker({
            position: point
        });
        onclickmarker.setMap(MYMap);
    }
    
    
    //**/
    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }
    
    function savetodb() {
        var xmlsend = new XMLHttpRequest();
        xmlsend.open("POST", "http://tms-hl.de/inf1213/12/schilf/Homepage_schilf/google_maps_createn_Tilman/createmap_admin_edit_in_db.php", true);
        xmlsend.send();
        //$.post(, {'myxml' : myxmlarray});
    }

    function doNothing() {}

    //]]>

  </script>

  </head>

  <body onload="load()">
    <div id="save" onclick="savetodb()">Save Changes!</div>
    <div id="map" style="width: 925px; height: 600px"></div>
  </body>

</html>
