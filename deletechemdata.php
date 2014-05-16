<!--Auf dieser Seite kann der Admin die Daten der gemessenen chemischen Parametern, sowohl Oberflächenwasser als auch Sedimentwasser, aus der Datenbank löschen. Dies ist natürlich passwortgeschützt. Der Admin muss vorher auswählen welche Messreihe er lösche will. Diese werden über die URL (Standort und Datum) übergeben -->
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

<div id="deletechemdata">
	
     <?php
		//Die übergebenen Standort(ort) und Datum(date) Variablen werden aus der URL ausgelesen und gespeichert
        $StandortID=$_GET['ort'];
		$DatumID=$_GET['date'];
		
		//Datenbankanbindung
        include('datenbank.php');
		
		//Datenbankanfrage: Liefer mir alle Werte von diesem Standort und diesem Datum
        $anfrage = 'SELECT Standort, Datum, TempW, O2W, O2saettigung, BSB5, pHW, Sichttiefe, LeitfaehigkeitW, Haerte, NH4W, NO2W, NO3W, PO4W, Fe, SiO2, pHS, NH4S, NO2S, NO3S, PO4S, O2S, H2S, SO4S, LeitfaehigkeitS, TempS
                        FROM chemischeParameter
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
					<td>Wassertemperatur</td>
					<td>'.$zeile['TempW'].'</td>
				</tr>
				<tr>
					<td>Sauerstoffgehalt</td>
					<td>'.$zeile['O2W'].'</td>
				</tr>
				<tr>
					<td>Sauerstoffs&auml;ttigung</td>
					<td>'.$zeile['O2saettigung'].'</td>
				</tr>
				<tr>
					<td>BSB5-Wert</td>
					<td>'.$zeile['BSB5'].'</td>
				</tr>
				<tr>
					<td>pH-Wert</td>
					<td>'.$zeile['pHW'].'</td>
				</tr>
				<tr>
					<td>Sichttiefe</td>
					<td>'.$zeile['Sichttiefe'].'</td>
				</tr>
				<tr>
					<td>Leitf&auml;higkeit</td>
					<td>'.$zeile['LeitfaehigkeitW'].'</td>
				</tr>
				<tr>
					<td>Wasserh&auml;rte</td>
					<td>'.$zeile['Haerte'].'</td>
				</tr>
				<tr>
					<td>Ammonium</td>
					<td>'.$zeile['NH4W'].'</td>
				</tr>
				<tr>
					<td>Nitrit</td>
					<td>'.$zeile['NO2W'].'</td>
				</tr>
				<tr>
					<td>Nitrat</td>
					<td>'.$zeile['NO3W'].'</td>
				</tr>
				<tr>
					<td>Phosphat</td>
					<td>'.$zeile['PO4W'].'</td>
				</tr>
				<tr>
					<td>Eisen</td>
					<td>'.$zeile['Fe'].'</td>
				</tr>
				<tr>
					<td>Silikat</td>
					<td>'.$zeile['SiO2'].'</td>
				</tr>
				<tr>
					<td>pH-Wert Sed</td>
					<td>'.$zeile['pHS'].'</td>
				</tr>
				<tr>
					<td>Ammonium Sed</td>
					<td>'.$zeile['NH4S'].'</td>
				</tr>
				<tr>
					<td>Nitrit Sed</td>
					<td>'.$zeile['NO2S'].'</td>
				</tr>
				<tr>
					<td>Nitrat Sed</td>
					<td>'.$zeile['NO3S'].'</td>
				</tr>
				<tr>
					<td>Phosphat Sed</td>
					<td>'.$zeile['PO4S'].'</td>
				</tr>
				<tr>
					<td>Sauerstoff Sed</td>
					<td>'.$zeile['O2S'].'</td>
				</tr>
				<tr>
					<td>Sulfid</td>
					<td>'.$zeile['H2S'].'</td>
				</tr>
                <tr>
    				<td>Sulfat</td>
					<td>'.$zeile['SO4S'].'</td>
				</tr>
				<tr>
					<td>Leitf&auml;higkeit Sed</td>
					<td>'.$zeile['LeitfaehigkeitS'].'</td>
				</tr>
				<tr>
					<td>Wassertemperatur Sed</td>
					<td>'.$zeile['TempS'].'</td>
				</tr>
			</table>
			');
        }
		
		//Abschließende Frage zum Löschen
        echo('
                
            <p>Wollen Sie diese Messreihe wirklich l&ouml;schen?</p>
            <form action="?site=deletechemdata&ort='.$StandortID.'&date='.$DatumID.'" method="post">
                <input type="submit" value="Ja, l&ouml;schen" id="delete" name="delete">
                <input type="submit" value="Nein, nicht l&ouml;schen" id="cacel" name="cancel">
            </form>  
            ');
    
		//Wenn "Ja, löschen" gedrückt wurde
        if ( isset($_POST['delete']) ) {
        
		//Datenbankanbindung
        include('datenbank.php');
        
		//Löschanfrage mit Standort und Datum
        $anfrage = 'DELETE FROM chemischeParameter WHERE Standort="'.$StandortID.'" AND Datum="'.$DatumID.'" '; 
		//Ergebnis bleibt unbehandelt
        $ergebnis = mysql_query($anfrage) or die('Anfrage schlug fehl: '.mysql_error());
        
		//Zurückleitung zur Übersicht aller chemischen Messreihen, wo der Admin herkommt
        echo("<script language ='JavaScript'>
                 window.location.replace('?site=chemdatalist'); 
             </script>");
        } 
		
		//Wenn abbrechen gedrückt wurde
        if ( isset($_POST['cancel']) ) {
			//Zurückleitung zur Übersicht aller chemischen Messreihen, wo der Admin herkommt
            echo("<script language ='JavaScript'>
                 window.location.replace('?site=chemdatalist'); 
              </script>");
        }
    ?>
</div>