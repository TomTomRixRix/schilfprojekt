<!--Auf dieser Seite kann der Admin die Newsartikel der Datenbank überblicken. Dies ist natürlich passwortgeschützt. Von hieraus kann der Admin auswählen, ob er Newsartikel löschen oder auch bearbeiten will. Hierfür wird dann eine ID übertragen in der URL-->
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

<div id="newsartikellist">
	
    
            
    <?php
		
		//Datenbankanbindung		
        include('datenbank.php');
		
		//Datenbankanfrage: Nur NewsId, Titel und Uploadzeit werden ausgelesen und nach neuster Uploadzeit sortiert
        $anfrage = 'SELECT newsid, titel,  uploadzeit
                        FROM newsartikel
                        ORDER BY uploadzeit DESC
                    ';
                    
         $ergebnis = mysql_query($anfrage)
            or die('Anfrage schlug fehl: '.mysql_error());
        
		//Ausgabe der Newsartikelübersicht in einer Tabelle mit drei Spalten: delete-Button, Titel, Uploadzeit. Wenn man Titel anklickt, kann man den Newsartikel bearbeiten. NewsID in der URL übergeben
        echo('<table id="newsartikellisttable" align="center">
				<caption id="caption">Newsartikellist</caption>
				<thead style="font-weight:bold">
					<td></td>
					<td>Titel</td>
					<td>Uploadzeit</td>
				</thead><tbody>');
				
		//Tabellenkörper wird gefüllt		
        while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
            echo('<tr>
				<td>
					<a href="?site=deletenewsartikel&newsid='.$zeile['newsid'].'" style="color:red;"> L&ouml;schen</a>
				</td>
				<td>
					<a href="?site=editnewsartikel&newsid='.$zeile['newsid'].'">'.$zeile['titel'].'</a>
				</td>
				<td>'.$zeile['uploadzeit'].'</td>
			</tr>');
        }
        
        echo('</tbody></table>');
        
       
    ?>
</div>