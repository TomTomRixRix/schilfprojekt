<!--Auf dieser Seite kann der Admin die Bildgruppen der Datenbank überblicken. Dies ist natürlich passwortgeschützt. Von hieraus kann der Admin auswählen, ob er Bildgruppen löschen oder auch bearbeiten will. Hierfür wird dann eine ID übertragen in der URL-->
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

<div id="bildgruppelist">
<?php

		//Datenbankanbindung
        include('datenbank.php');
		
		//Datenbankanfrage: Nur Gruppenname und GruppenID werden ausgelesen und nach neuster ID sortiert
        $anfrage = 'SELECT gruppenname, gruppenID
                        FROM bildgruppe
                        ORDER BY gruppenID ASC
                    ';
                    
         $ergebnis = mysql_query($anfrage)
            or die('Anfrage schlug fehl: '.mysql_error());
        
		//Ausgabe der Newsartikelübersicht in einer Tabelle mit zwei Spalten: delete-Button, Gruppenname. 
        echo('<table id="bildgruppelisttable" align="center">
		<caption id="caption">Bildgruppenliste:</caption>
        <thead>
			<td></td>
			<td>Bildgruppe</td>
		</thead><tbody>');
		
		//Tabellenkörper wird gefüllt
        while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
        echo('<tr>
			<td>
				<a href="?site=deletebildgruppe&gruppenid='.$zeile['gruppenID'].'" id="deletred">Bildgruppe l&ouml;schen</a>
			</td>
			<td>
				<b>'.$zeile['gruppenname'].'</b>
			</td>
		</tr>');
        }
        
        echo('</tbody></table>');
        
        
?>
</div>