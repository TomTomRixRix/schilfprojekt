<!--Auf dieser Seite kann der Admin die Bilder der Datenbank überblicken. Dies ist natürlich passwortgeschützt. Von hieraus kann der Admin auswählen, ob er Bilder und deren Beschreibung löschen oder auch bearbeiten will. Hierfür wird dann eine BildID übertragen in der URL-->
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

<div id="bilderlist">
           
    <?php
		//Zurück-Button zum Adminbereich
        echo('<form action="?site=bilderlist" method="post">
                <input type="submit" value="Zur&uuml;ck zum Adminbereich" id="back" name="back">
            </form> ');
        
		//Datenbankanbindung
        include('datenbank.php');
		
		/*
		*	Datenbankanfrage: Nur BildID und Gruppenname werden ausgelesen und nach der GruppenId(danach der BildId) sortiert
		*	Die Werte werden aus zwei verschiedenen Tabellen genommen. Derhalb bilder.gruppenID und bildgruppe.gruppenID
		*	Dies ist notwendig, da zu den Bilddaten der Name der Gruppe angezeigt werden soll, der aber in Bildgruppe gespeichert ist
		*	Das verbindende Element ist die GruppenID, die gleich sein muss
		*/
        $anfrage = 'SELECT bildID,text, bilder.gruppenID, bildgruppe.gruppenID, gruppenname
                        FROM bilder,bildgruppe
						WHERE bilder.gruppenID=bildgruppe.gruppenID
                        ORDER BY bilder.gruppenID, bildid 
                    ';
                    
         $ergebnis = mysql_query($anfrage)
            or die('Anfrage schlug fehl: '.mysql_error());
        
		//Ausgabe der Bildübersicht in einer Tabelle mit drei Spalten: delete-Button, BildID, Gruppenname. Wenn man BildID anklickt, kann man die Bildbeschreibung bearbeiten. BildID wird dann in der URL übergeben
        echo('<table id="bilderlisttable" align="center">
			<caption id="caption">Bilderliste</caption>
			<thead style="font-weight:bold">
				<td></td>
				<td>Bild ID</td>
				<td>Bild Text</td>
				<td>Gruppe</td>
			</thead><tbody>');
		
		//Tabellenkörper wird gefüllt			
        while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
            echo('<tr>
					<td>
						<a href="?site=deletebild&bildid='.$zeile['bildID'].'" style="color:red;">Bild l&ouml;schen</a>
					</td>
					<td>
						<a href="?site=editbild&bildid='.$zeile['bildID'].'">'.$zeile['text'].'</a>
					</td>
					<td>
						<a href="?site=editbild&bildid='.$zeile['bildID'].'">'.$zeile['bildID'].'</a>
					</td>
					<td>'.$zeile['gruppenname'].'</td>
				</tr>');
        }
        
        echo('</tbody></table>');
        
        //Wenn der zurück-Button gedrückt wurde
        if ( isset($_POST['back']) ) {
			//Weiterleitung zurück zum Adminbereich
            echo("<script language ='JavaScript'>
                 window.location.replace('?site=admin'); 
              </script>");
        }
    ?>
</div>