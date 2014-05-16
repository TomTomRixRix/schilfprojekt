<!--Auf dieser Seite kann der Admin die 50 Einzelergebnisse der gemessenen biologischen Parameter aus der Datenbank überblicken. Dies ist natürlich passwortgeschützt. Von hieraus kann der Admin auswählen, ob er eine Messreihe löschen oder auch bearbeiten will.-->
<?php
//überprüfen, ob die SESSION Variable gesetzt ist
if(isset($_SESSION['status'])){

    //wenn ja, dann wird ihr Wert in $status gespeichert. Der Wert sollte 0 für nicht angemeldet und 1 für angemeldet sein
    $status=$_SESSION['status'];
        
}else{
    //wenn nein, dann ist $status 0
    $status='0';
}
        
//prüfen, ob der user angemeldet ist
if($status !='1'){
    //wenn nicht 1, dann ist der user nicht angemeldet und wird auf die login seite weitergeleitet
    echo("<script language ='JavaScript'>
	           window.location.replace('?site=login'); 
      </script>");
}
//wenn er angemeldet ist, passiert nichts und die Seite wird weiter geladen

//In dieser Zeile wird die SideBar in den Admin-Modus gesetzt. Dabei ist sie immer ausgefahren und zeigt die Navigationslinks an.
include('aktiviereAdminSideBar.php');
?>

<div id="chemdatalist">
    <?php
	
		//Übergebener Standort und Datum werden aus der URL ausgelesen und gespeichert. Den die Einzelergebnisse gehören zu einer Messreihe	
		$StandortID=$_GET['ort'];
		$DatumID=$_GET['date'];
		
		//Datenbankanbindung
        include('datenbank.php');
		
		//Datenbankanfrage: Nur Standort, Datum und EinzelergebnisID, was eindeutige Schlüssel für eine Messreihe sind werden ausgelesen und nach der ID sortiert
        $anfrage = 'SELECT Standort, Datum, EinzelergebnisID
                        FROM biologischeEinzelmessergebnisse
						WHERE Standort="'.$StandortID.'"
						AND Datum="'.$DatumID.'"
                        ORDER BY EinzelergebnisID ASC
                    ';
                    
         $ergebnis = mysql_query($anfrage)
            or die('Anfrage schlug fehl: '.mysql_error());
        
		//Ausgabe der Messreichenübersicht in einer Tabelle mit zwei Spalten: delete-Button und ID. Wenn man ID anklickt, kann man die Messreihe bearbeiten. Standort, Datum und ID werden in der URL übergeben
        echo('<table id="chemdatalisttable" align="center">
		<caption id="caption">Biologische Einzelergebnisse:</caption>
			<thead>
				<td></td>
				<td>Einzelergebnissnummer</td>
			</thead><tbody>');
			
		//Tabellenkörper wird gefüllt		
        while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
        echo('
		<tr>
        <td>
			<a href="?site=deletebiodata&ort='.$zeile['Standort'].'&date='.$zeile['Datum'].'&id='.$zeile['EinzelergebnisID'].'" id="deletbio">Einzelergebnis l&ouml;schen </a>
		</td>
        <td>
			<a href="?site=editbiodata&ort='.$zeile['Standort'].'&date='.$zeile['Datum'].'&id='.$zeile['EinzelergebnisID'].'"> '.$zeile['EinzelergebnisID'].' </a>
		</td>
        
        </tr>');
        }
        
        echo('</tbody></table>');
        
	
    ?>
</div>