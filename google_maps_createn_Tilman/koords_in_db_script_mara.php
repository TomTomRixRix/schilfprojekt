<?php 
//script tut aus koordinaten aus gpx datei (xmlurl) in datenbank

function parseToXML($htmlStr) // macht sonderzeichen sinnvoll
{ 
$xmlStr=str_replace('<', '&lt;', $htmlStr); 
$xmlStr=str_replace('>', '&gt;', $xmlStr); 
$xmlStr=str_replace('"', '&quot;', $xmlStr); 
$xmlStr=str_replace("'", '&#39;', $xmlStr); 
$xmlStr=str_replace("&", '&amp;', $xmlStr); 
return $xmlStr;
}

// Opens a connection to a MySQL server
$dblink = mysql_connect('localhost', 'inf12','12inf') 
    or die('Konnte keine Datenbankverbindung aufbauen: '.mysql_error()); 
    
mysql_select_db('inf12_Schilfprojekt') 
    or die('Konnte die Datenbank nicht ausgewählt werden: '.mysql_error()); 
    
$deletequery = "DELETE Koordinaten WHERE Name LIKE 'mara%'";
$deleteresult = mysql_query($deletequery);
			    if (!$deleteresult) {die('Invalid deletequery: ' . mysql_error());
			    
// -----in .xml konvertierte .gpx-datei, in "UTF-8 with BOM" konvertieren(!) 
// $xmlurl = "http://tms-hl.de/inf1213/12/schilf/Homepage_schilf/google_maps_createn_Tilman/2013-10-23_Tilman_WakenitzSW_mitbildlinks.xml";
$xmlurl = "2013-10-23_Mara_WakenitzSO_mitbildlinksundpflanze.xml";

$lastlat=0;
$lastlon=0;
$i=0;
$bildlk="";
$xml = simplexml_load_file($xmlurl);
foreach ($xml as $route){
    $i=$i+1;
    $j=0;
    $art = "polyline";
    $datum = "2013-10-23"; // ------------------------------------------------ Datum eintragen
    $bildlk = "";
    foreach ($xml -> rte[$i-1] -> imgurl as $bildlink){
        $bildlk = "".$bildlink['link'];
    }
    foreach ($xml -> rte[$i-1] -> pflanze as $pfl){
        $pflanze = "".$pfl['plant'];
    }
    foreach ($xml -> rte[$i-1] -> rtept as $point){
        $lat = $point['lat'];
        
        $lon = $point['lon'];
        if ($lastlat != $lat or $lastlon != $lon) { // wenn die koordinate neu ist
            if ($lat <= 53.825183137881613 and $lat >= 53.824327009951911 and $lon < 10.764730439779457 and $lon > 10.758261506673956) { //wenn koordinaten bei absalonshorst sind
                $name = "Absalonshorst";
            // } elseif (koordinaten wie bei kl see, wakenitz brücke, gr sarau...) {
            } else {
                $name = "mara".$i; // ------------------------------------------- an aufzeichner/ung anpassen (wird name der polyline)
            }

            $lastlat = $lat;
            $lastlon = $lon;
            $j =$j + 1;
            $ordnungszahl = $j;
            $insertquery = "INSERT INTO `inf12_Schilfprojekt`.`Koordinaten` (`Art`, `Name`, `Ordnungszahl`, `lat`, `lng`, `Datum`, `bildlink`,  `Pflanze`) VALUES ('".$art."', '".$name."', '".$ordnungszahl."', '".$lat."', '".$lon."', '".$datum."', '".$bildlk."', '".$pflanze."');";
		    $result = mysql_query($insertquery);
			    if (!$result) {die('Invalid insertquery: ' . mysql_error());
            }
        }
    }
}


?>
