<!--Auf dieser Seite kann der Admin die erstellten Termine aus der Datenbank überblicken. Dies ist natürlich passwortgeschützt. Von hieraus kann der Admin auswählen, ob er Termine löschen will.-->
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

<div id="terminlist">
<?php
//Zurück-Button zum Adminbereich
echo('<form action="?site=terminlist" method="post">
        <input type="submit" value="Zur&uuml;ck zum Adminbereich" id="back" name="back">
      </form> ');
	  
		//Datenbankanbindung
        include('datenbank.php');
		
		//Datenbankanfrage: Liefer' alles über die Termine sortiert von neu nach alt
        $anfrage = 'SELECT terminzeit, terminbeschreibung, terminid
                        FROM termine
                        ORDER BY terminid DESC
                    ';
                    
         $ergebnis = mysql_query($anfrage)
            or die('Anfrage schlug fehl: '.mysql_error());
        
		//Ausgabe der Messreichenübersicht in einer Tabelle mit drei Spalten: delete-Button, Terminzeit, Terminbeschreibung. TerminId wird in der URL übergeben
        echo('<table id="terminlisttable" align="center">
			<caption id="caption">Terminliste:</caption>
				<thead style="font-weight:bold">
					<td></td>
					<td>Zeit</td>
					<td>Beschreibung</td>
				</thead>
		<tbody>');
		
		//Tabellenkörper wird gefüllt
        while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
        echo('<tr>
				<td><a href="?site=deletetermin&terminid='.$zeile['terminid'].'" style="color:red;">Termin l&ouml;schen</a></td>
				<td><b>'.$zeile['terminbeschreibung'].' </b></td>
				<td> '.$zeile['terminzeit'].' </td>
			</tr>');
        }
        
        echo('</tbody></table>');
        
        //Wenn der zurück-Button gedrückt wurde
        if ( isset($_POST['back']) ) {
            echo("<script language ='JavaScript'>
                 window.location.replace('?site=admin'); 
              </script>");
        }
?>
	
</div>