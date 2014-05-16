<!--Auf dieser Seite wird die Karte mit der Geovermessung des Schilfes eingebunden. Autor:Tilman Masur. -->
<!--DER CODE MUSS NOCH DOKUMENTIERT WERDEN!!! -->

<!-- die koordinaten aus der datenbank werden als xml hier auf der karte dargestellt
das xml wird in google_maps_createn_Tilman/xml_aus_datenbank.php erzeugt-->
<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Schilfbewuchs</title>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
	
    //<![CDATA[
    /** Erzeugt gewisse icons, überbleibsel von dem tutorial, wo ich das grundgerüst her habe, sollte aber vielleicht zur sicherheit drin bleiben
    var customIcons = {
      restaurant: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      },
      bar: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      }
    }; */
    
    //NAME des scriptes, das aus der Koordinaten Tabelle der Datenbank eine XML-datei erzeugt
    var xmlurl = "google_maps_createn_Tilman/xml_aus_datenbank.php";

    function load() { 
    //load() ist die funtion, die ganz unten im html "onload" aufgerufen wird. sie zeigt die karte, polygones, polylines und marker
    //load() verwendet einige weitere "sonstige functions", die nach der load() folge
    
    //map ist die variable, die die karte mit parametern wie zoom, type etc enthält. polylines und markers bekommen sie als option zugewiesen,
    //um auf ihr angezeigt zu werden
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(53.8305, 10.7422),
        zoom: 14,
        mapTypeId: 'hybrid'
      });
	  
	  // infoWindow wird später erzeugt. ich weiß nich ob diese deklarierung hier notwendig ist. 
	  // (generell wär gut, zu wissen, wie globale und lokale variablen in javascript funktionieren (so mit "var" oder ohne etc))
      var infoWindow = new google.maps.InfoWindow();
       
      
	  var drawnPolygone; //Dieser erste block zeigt alle polygones in der datenbank auf der karte an
	  downloadUrl(xmlurl, function(data) { //lädt  mit dem "xml_aus_datenbank.php"-script die daten aus der datenbank als xml datei herunter.
	                                       //diese wird dann weiter verwendet um die einzelne koordinaten auszulesen
	    var xml = data.responseXML; //formt xml in ein xml-array um
        var polygones = xml.documentElement.getElementsByTagName("polygone"); //array mit allen polygonen
        for (var i = 0; i < polygones.length; i++) { //ein polygon zur zeit wird ausgewählt; alle der reihe nach
          // attribute des polygons werden ausgelesen
          var name = polygones[i].getAttribute("name");
          var imgurl = polygones[i].getAttribute("imgurl");  
          var html = "<b>" + name + "</b>";
          
		  var polygoneCoords = []; //option der googlemaps apo polygone variable, die den pfad des polygones als array von koordinaten speichert
		  var point = polygones[i].getElementsByTagName("point"); //array aus allen points des polygones der xml datei
		  var firstcoord =[] //besonderheit: da das polygone sich am ende wieder schließen muss(sprich: erste koord = letzte koord), 
		                     //wird die erste coordgespeichert und später wieder angehängt
		  for (var j = 0; j < point.length; j++) { //jeweils ein point des polygones der xml datei ausgewählt
			if (j == 0) { //erste koord in "firstcoord" speichern
				firstcoord = new google.maps.LatLng(parseFloat(point[j].getAttribute("lat")), parseFloat(point[j].getAttribute("lng")))
			}
			polygoneCoords.push(new google.maps.LatLng(parseFloat(point[j].getAttribute("lat")), parseFloat(point[j].getAttribute("lng")))); 
			                    //koordinate an polygonecoords angehängt, die nachher die pfad-variable des polygones werde
		  }
		  polygoneCoords.push(firstcoord); //erste koord wird ans ende des polygones angehängt (siehe oben)
		  drawnPolygone = new google.maps.Polygon({ //polygone wird erzeugt und it "map: map," direkt auf der karte angezeigt
			map: map,
			path: polygoneCoords,
			strokeColor: "#FF8000",
			strokeOpacity: 0.8,
			strokeWeight: 3,
			fillColor: "#FF8000",
			fillOpacity: 0.2
		  });
		  //polygone bekommt infofenster
          bindInfoWindow(drawnPolygone, "polygone", map, infoWindow, html, polygoneCoords[0], new google.maps.Size(0, -5), imgurl); 
        }
		
      });
	  
      
      
      var drawnPolyline; //dieser block zeigt alle polylines aus datenbank an (für details siehe polygones)
	  downloadUrl(xmlurl, function(data) { 
	    var xml = data.responseXML;
        var polylines = xml.documentElement.getElementsByTagName("polyline");
        for (var i = 0; i < polylines.length; i++) { //eine polyline wird ausgewählt
          var name = polylines[i].getAttribute("name");
          var color = getPolylineColor(polylines[i].getAttribute("pflanze"));
          var imgurl = polylines[i].getAttribute("imgurl");
          var pflanze = polylines[i].getAttribute("pflanze");
          var html =  "Pflanze: " + pflanze;
		  var polylineCoords = [];
		  var point = polylines[i].getElementsByTagName("point");
		  for (var j = 0; j < point.length; j++) { //coord ausgewählt
			polylineCoords.push(new google.maps.LatLng(parseFloat(point[j].getAttribute("lat")), parseFloat(point[j].getAttribute("lng"))));
		  }

		  drawnPolyline = new google.maps.Polyline({ //polyline erzeugt
			map: map,
			path: polylineCoords,
			strokeColor: color,
			strokeOpacity: 0.8,
            draggable: false,
			strokeWeight: 9
		  });
          bindInfoWindow(drawnPolyline, "polyline", map, infoWindow, html, polylineCoords[0], new google.maps.Size(0, -5), imgurl);
        }
		
      });
      
      
      
	  var drawnMarker; //dieser block zeigt alle marker aus der datenbank an (für details siehe polygones)
      downloadUrl(xmlurl, function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) { //ein marker ausgewählt
          var name = markers[i].getAttribute("name");
          var imgurl = markers[i].getAttribute("imgurl");          
          // var address = markers[i].getAttribute("address"); //siehe oben ( überbleibsel vom tutorial, wo ich das her hab)
          var type = markers[i].getAttribute("type");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html = "<b>" + name + "</b>";
          //var icon = customIcons[type] || {}; //siehe oben ( überbleibsel vom tutorial, wo ich das her hab)
          
          var pinImage = getMarkerImage(name);
          
          drawnMarker = new google.maps.Marker({
            map: map,
            position: point,
            icon: pinImage,
            draggable: false
          });
          bindInfoWindow(drawnMarker, "marker", map, infoWindow, html, drawnMarker.getPosition(), new google.maps.Size(0, -40), imgurl);
        }
      });
    } 
  
    //bindet ein infowindow an jedes polygone/-line/marker
    function bindInfoWindow(object, type, map, infoWindow, html, anchor, pixeloffset, imgurl) {
      google.maps.event.addListener(object, 'click', function() { //fenster wird geöffnet wenn "mouseover" dem object
        if (type == "marker") { //unterscheidung der fenster nach marker und polyline/-gone
            //conenthtml bestimmt inhalt des fensters in html; hier jetzt html/name des markers und evtl link zum standort
            var contenthtml = '<div id="infowindow" style="width: 200px; height:80px">\
            <h2>' + html + '</h2>\
            <a href="' + imgurl + '">\
            Weiterlesen..\
            </a>\
            </div>';
        } else {
            //conenthtml bestimmt inhalt des fensters in html; hier jetzt mit bild, und html/name der polyline/polygone
            var contenthtml = '<div id="infowindow" style="width: 410px; height:340px">\
            <a href="' + imgurl + '">\
            <IMG BORDER="0" ALIGN="Left" width="400" height="300"\
            SRC="' + imgurl + '"/>\
            </a>\
            </br>' + html + '\
            </div>';
        }
        infoWindow.setContent(contenthtml); //contenthtml wird auf fenster angewendet
        infoWindow.setOptions({
        pixelOffset: pixeloffset
        });
        infoWindow.setPosition(anchor);
        infoWindow.open(map) //fenster geöffnet auf map
      });
    }
    
    function getPolylineColor(string){ //gibt richtige farbe für die jeweilige pflanzenart wieder
        if (string == "Schilf"){
            return "#ffeb0a";
        } else if (string == "Rohrkolben"){
            return "#59a0ab";
        } else if (string == "Wasserschwaden"){
            return "#ff5c47";
        } else if (string == "Schilf, Rohrkolben"){
            return "#299e43";
        } else if (string == "Schilf, Wasserschwaden"){
            return "#FFA600";
        } else if (string == "Rohrkolben, Wasserschwaden"){
            return "#F561FF";
        } else if (string == "gemischt"){
            return "#A4A4A4";
        } else if (string == "unsicher"){
            return "#FFFFFF";
        } else {
            return "#FFFFFF";
        }
    }
    function getMarkerImage(string){ //erzeugt das marker bild je nach standort/oder ob es ein normaler marker ist
         //findet richtige farbe
         var pinColor;
          if (string == "Standort Absalonshorst"){
            pinColor = "DF0101";
          } else if (string == "Standort Gross Sarau") {
            pinColor = "0101DF";
          } else if (string == "Standort Wallbrechtbruecke") {
            pinColor = "FFFFFF";
          } else if (string == "Standort Eichholz") {
            pinColor = "1D722C";
          } else if (string == "Standort Kleiner See") {
            pinColor = "EEC900";
          } else {
            pinColor = "070707"; //normale farbe
          }
          // die url erzeugt den standart google maps marker mit der entsprechenden farbe
          return {url: "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
                  size: new google.maps.Size(21, 34),
                  origin: new google.maps.Point(0,0),
                  anchor: new google.maps.Point(10, 34)};

    }
    
    //kompliziertes xml und javascript zeugs, das ich auch nich verstehe
    // NICHT ÄNDERN !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
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

    function doNothing() {}
    // NICHT ÄNDERN !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    
    //]]>

  </script>

  </head>

  <body onload="load()">
  
    <!--In diesem Code-Abschnitt wird die SideBar ausgefahren, sodass sie statisch ist und dort die LEgende angezeigt werden kann.-->
    
    <!--Damit die SideBar immer ausgefahren ist-->
	<!--div id="homeTexthead"></div-->

	<!--script type="text/javascript">

	$(document).ready(function(){
		$("#SideBar").width("22%");
		$("#center").width("75%");
		$("#sideBarInhalt").hide();
		$("#sideBarInfoBox").hide();
		$("#SideBar").append(' <div style="padding:20px;"> <h2><u>Legende:</u></h2>                                                                                                          <p style="color: #1d722c"> Schilf und Rohrkolben </p>                                                                                                                                        <p style="color: #EEC900; font-weight: bolder"> Schilf </p>                                                                                                                         <p style="color: #FFA600"> Schilf und Wasserschwaden</p>                                                                                                                                 <p style="color: #FF0000"> Wasserschwaden </p>                                                                                                                                       <p style="color: #F561FF"> Rohrkolben und Wasserschwaden </p>                                                                                                                            <p style="color: #1B26A0"> Rohrkolben </p>                                                                                                                                      <p style="color: #A4A4A4"> gemischt </p>                                                                                                                                         <p><span style="color: #FFFFFF; background-color: grey; font-weight: bold"> unsicher </span></p>                                                                                                                 </div>');

	 });
    
    </script-->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#cblegende").change(function(){
                console.log("Hallo3");
                $("#legendeContent").slideToggle("easing");
            });
        
        });
    </script>
    
    <!-- erzeugt die LEgende -->
    <div id="geolegende">
        <p><input type="checkbox" id="cblegende" name="cblegende" checked><b><u>Legende: </u></b></p>
        <div id="legendeContent">
            <p style="background-color: #299e43"> Schilf und Rohrkolben </p>
            <p style="background-color: #ffeb0a; font-weight: bolder"> Schilf </p>
            <p style="background-color: #FFA600"> Schilf und Wasserschwaden</p>
            <p style="background-color: #ff5c47"> Wasserschwaden </p>
            <p style="background-color: #F561FF"> Rohrkolben und Wasserschwaden </p>
            <p style="background-color: #59a0ab"> Rohrkolben </p>
            <p style="background-color: #ffffff; border-style:solid;border-top-width: thin;border-bottom-width: thin;border-right-width: thin;border-left-width: thin;"> gemischt </p>
            <p style="background-color: #FFFFFF; background-color: grey; font-weight: bold"> unsicher </p>
        </div>
    </div>
    
    <!--div id="map" style="width: 925px; height: 600px"></div-->
    <div id="map" style="width: 100%; height:600px;"></div>
    
    
  </body>

</html>
