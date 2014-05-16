<!--Auf dieser Seite kann der Admin die Mittelwerte der gemessenen biologischen Parameter aus der Datenbank überblicken. Dies ist natürlich passwortgeschützt. Von hieraus kann der Admin auswählen, ob er eine Mittelwert-Messreihe löschen oder auch bearbeiten will. Zusätzlich kann er zu den 50 Einzelergebnissen, die er auch bearbeiten und löschen kann-->
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

<div id="biomitteldatalist">
    <?php
	
		//Datenbankanbindung		
        include('datenbank.php');
		
		//Datenbankanfrage: Nur Standort, und Datum, was eindeutige Schlüssel für eine Messreihe sind werden ausgelesen und nach Datum sortiert
        $anfrage = 'SELECT Standort, Datum
                        FROM biologischeMittelwerte
                        ORDER BY Datum DESC
                    ';
                    
         $ergebnis = mysql_query($anfrage)
            or die('Anfrage schlug fehl: '.mysql_error());
        
		//Ausgabe der Messreichenübersicht in einer Tabelle mit vier Spalten: delete-Button, Standort, Datum und Link zu den Einzelmessergebnissen. Wenn man Standort anklickt, kann man die Messreihe bearbeiten. Standort, und Datum werden in der URL übergeben
        echo('<table id="biomitteldatalisttable" align="center">
		<caption id="caption">Biologische Mittelwerte:</caption>
			<thead style="font-weight:bold">
				<td></td>
				<td>Standort</td>
				<td>Datum</td>
				<td> -> </td>
			</thead>
		<tbody>');
		
		//Tabellenkörper wird gefüllt
        while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
        echo('<tr>
					<td>
						<a href="?site=deletebiomitteldata&ort='.$zeile['Standort'].'&date='.$zeile['Datum'].'" style="color:red;">Mittelwerte l&ouml;schen </a>
					</td>
					<td>
						<a href="?site=editbiomitteldata&ort='.$zeile['Standort'].'&date='.$zeile['Datum'].'"> '.$zeile['Standort'].'</a>
					</td>
					<td>
						'.$zeile['Datum'].'
					</td>
					<td>
						<a href="?site=biodatalist&ort='.$zeile['Standort'].'&date='.$zeile['Datum'].'">Zu den Einzelergebnissen</a>
					</td>
		</tr>');
        }
        
        echo('</tbody></table>');
        
	
    ?>
</div>