<!--Auf dieser Seite kann der Admin die Daten der gemessenen biologischen Mittelwerte aus der Datenbank löschen. Dies ist natürlich passwortgeschützt. Der Admin muss vorher auswählen welche Messreihe er lösche will. Diese werden über die URL (Standort und Datum) übergeben -->
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

<div id="deletebiomittel">
	
     <?php
		//Die übergebenen Standort(ort) und Datum(date) Variablen werden aus der URL ausgelesen und gespeichert
        $StandortID=$_GET['ort'];
		$DatumID=$_GET['date'];
		
		//Datenbankanbindung
        include('datenbank.php');
		
		//Datenbankanfrage: Liefer mir alle Werte von diesem Standort und diesem Datum
        $anfrage = 'SELECT Standort, Datum, LaengeUnterWasser, LaengeUeberWasser, LaengeGesamt, DickeUnten, DickeMitte, Blattbreite, Blattlaenge,Rispenlaenge, Blattzahl, Nodienzahl
                        FROM biologischeMittelwerte
                        WHERE Standort="'.$StandortID.'"
						AND Datum="'.$DatumID.'"
                    ';
                    
         $ergebnis = mysql_query($anfrage)
            or die('Anfrage schlug fehl: '.mysql_error());
        
		//Ausgabe dieser Werte zum Überprüfen in einer Tabelle
        while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
         
			echo('
			<table align="center">
            <caption id="caption">Messreihe l&ouml;schen?:</caption>
				<tr>
					<td>Standort</td>
					<td>'.$zeile['Standort'].'</td>
				</tr>
				<tr>
					<td>Datum</td>
					<td>'.$zeile['Datum'].'</td>
				</tr>
				<tr>
					<td>Halml&auml;nge unterWasser</td>
					<td>'.$zeile['LaengeUnterWasser'].'</td>
				</tr>
				<tr>
					<td>Halml&auml;nge &uuml;ber Wasser</td>
					<td>'.$zeile['LaengeUeberWasser'].'</td>
				</tr>
				<tr>
					<td>Halml&auml;nge gesamt</td>
					<td>'.$zeile['LaengeGesamt'].'</td>
				</tr>
				<tr>
					<td>Halmdicke unten</td>
					<td>'.$zeile['DickeUnten'].'</td>
				</tr>
				<tr>
					<td>Halmdicke mitte</td>
					<td>'.$zeile['DickeMitte'].'</td>
				</tr>
				<tr>
					<td>Blattbreite</td>
					<td>'.$zeile['Blattbreite'].'</td>
				</tr>
				<tr>
					<td>Blattl&auml;nge</td>
					<td>'.$zeile['Blattlaenge'].'</td>
				</tr>
				<tr>
					<td>Rispenl&auml;nge</td>
					<td>'.$zeile['Rispenlaenge'].'</td>
				</tr>
				<tr>
					<td>Blattzahl</td>
					<td>'.$zeile['Blattzahl'].'</td>
				</tr>
				<tr>
					<td>Nodienzahl</td>
					<td>'.$zeile['Nodienzahl'].'</td>
				</tr>
				
			</table>
			');
        }
		
		//Abschließende Frage zum Löschen
        echo('
                
            <p>Wollen Sie diese Mittelwerte wirklich l&ouml;schen?</p>
            <form action="?site=deletebiomitteldata&ort='.$StandortID.'&date='.$DatumID.'" method="post">
                <input type="submit" value="Ja, l&ouml;schen" id="delete" name="delete">
                <input type="submit" value="Nein, nicht l&ouml;schen" id="cacel" name="cancel">
            </form>  
            ');
    
		//Wenn "Ja, löschen" gedrückt wurde
        if ( isset($_POST['delete']) ) {
        
		//Datenbankanbindung
        include('datenbank.php');
		
		//Löschanfrage mit Standort und Datum
        $anfrage = 'DELETE FROM biologischeMittelwerte WHERE Standort="'.$StandortID.'" AND Datum="'.$DatumID.'" '; 
		
		//Ergebnis bleibt unbehandelt
        $ergebnis = mysql_query($anfrage) or die('Anfrage schlug fehl: '.mysql_error());
        
		//Zurückleitung zur Übersicht aller chemischen Messreihen, wo der Admin herkommt
        echo("<script language ='JavaScript'>
                 window.location.replace('?site=biomitteldatalist'); 
             </script>");
        } 
    
		//Wenn abbrechen gedrückt wurde
        if ( isset($_POST['cancel']) ) {
			//Zurückleitung zur Übersicht aller chemischen Messreihen, wo der Admin herkommt
            echo("<script language ='JavaScript'>
                 window.location.replace('?site=biomitteldatalist'); 
              </script>");
        }
    ?>
</div>