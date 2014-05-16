<!--Aturo:Tilman Masur.  -->
<?php

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


// Select all marker rows in the Koordinaten table
$querymarker = 'SELECT * FROM Koordinaten WHERE Art = "marker"';
$resultmarker = mysql_query($querymarker);
if (!$resultmarker) {
  die('Invalid querymarker: ' . mysql_error());
}

header("Content-type: text/xml");

echo '<doc>';

echo '<markers>'; //marker in xml schreiben
while ($row = mysql_fetch_assoc($resultmarker)){ 
	// ADD TO XML DOCUMENT NODE
	echo '<marker ';
	echo 'name="' . parseToXML($row['Name']) . '" ';
	echo 'lat="' . $row['lat'] . '" ';
	echo 'lng="' . $row['lng'] . '" ';
	echo '/>';	
}
echo '</markers>';

// Select all polygone names in the Koordinaten table
$querypolygone = 'SELECT DISTINCT Name FROM Koordinaten WHERE Art = "polygone"';
$resultpolygone = mysql_query($querypolygone);
if (!$resultpolygone) {
  die('Invalid querypolygone: ' . mysql_error());
}

echo '<polygones>'; //polygones in xml schreiben
while ($row = mysql_fetch_assoc($resultpolygone)){
	
	$name = $row['Name'];
	echo '<polygone ';
	echo 'name="' . parseToXML($row['Name']) . '"> ';
	$queryname = 'SELECT * FROM Koordinaten WHERE Name ="'. $name . '" '; //all lines of databank with the name of that polygone
	$resultname = mysql_query($queryname)
        or die ("MySQL-Error: " . mysql_error());
	// ADD TO XML DOCUMENT NODE
	while ($namerow = mysql_fetch_assoc($resultname)){
		echo '<point ';
		echo 'lat="' . $namerow['lat'] . '" ';
		echo 'lng="' . $namerow['lng'] . '" ';
		echo 'ordnungszahl="' . $namerow['Ordnungszahl'] . '" ';
		echo '/>';
	}
	echo '</polygone>';
	
}
echo '</polygones>';

echo ('<polylines>'); //polylines in xml schreiben
// Select all polyline names in the Koordinaten table
$querypolyline = 'SELECT DISTINCT Name FROM Koordinaten WHERE Art = "polyline"';
$resultpolyline = mysql_query($querypolyline);
if (!$resultpolyline) {
  die('Invalid querypolyline: ' . mysql_error());
}


while ($row = mysql_fetch_assoc($resultpolyline)){
	$name = $row['Name'];
	echo '<polyline ';
	echo 'name="' . parseToXML($row['Name']) . '"> ';
	$queryname = 'SELECT * FROM Koordinaten WHERE name ="'. $name.'"';
	$resultname = mysql_query($queryname);
	// ADD TO XML DOCUMENT NODE
	while ($namerow = mysql_fetch_assoc($resultname)) {
		echo '<point ';
		echo 'lat="' . $namerow['lat'] . '" ';
		echo 'lng="' . $namerow['lng'] . '" ';
		echo 'ordnungszahl="' . $namerow['Ordnungszahl'] . '" ';
		echo '/>';
	}
	echo '</polyline>';
}
echo '</polylines>';

// End XML file
echo '</doc>';


?>
