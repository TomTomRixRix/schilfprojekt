<?php 
echo "hello";
//script tut alle daten neu in datenbank wie sie aus createmap_admin.php ($_POST['myxml']) kommen

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
    
print_r ( $_POST );
$xml = $_POST['myxml'];
echo $xml;
$deletequery = "TRUNCATE TABLE `Koordinaten`;";
$result = mysql_query($deletequery);
    if (!$result) {die('Invalid deletequery: ' . mysql_error());}

$mk;
$n = 0;
foreach ($xml -> polylines -> polyline as $mk){
    echo ($mk);
    $testquery = "INSERT INTO `inf12_Schilfprojekt`.`Koordinaten` (`Art`, `Name`, `Ordnungszahl`, `lat`, `lng`, `Datum`, `bildlink`) VALUES ('s', 'tests', '".$n."', '54', '11', '2013-10-23', 's');";
    $result = mysql_query($testquery);
    if (!$result) {die('Invalid testquery: ' . mysql_error());}
    $n = $n + 1;
}
?>
