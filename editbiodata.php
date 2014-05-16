<!--Auf dieser Seite kann der Admin die Messreihen der gemessenen biologischen Einzelergebnisse bearbeiten. Dies ist natürlich passwortgeschützt. Standort, Datum und ID wurden über die URL übergeben.-->
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

<div id="editchemdata">
	<?php
		//Auslesen von Standort und Datum und ID, die über die URL übergeben wurden
        $StandortID=$_GET['ort'];
		$DatumID=$_GET['date'];
        $EinzelergebnisID=$_GET['id'];
		
		//Datenbankanbindung
        include('datenbank.php');
		
		//Datenbankanfrage: Liefer' alle biologischenEinzelergebnisse von dem Standort und Datum und der ID
        $anfrage = 'SELECT Standort, Datum, EinzelergebnisID, LaengeUnterWasser, LaengeUeberWasser, LaengeGesamt, DickeUnten, DickeMitte, Blattbreite, Blattlaenge,Rispenlaenge, Blattzahl, Nodienzahl
                        FROM biologischeEinzelmessergebnisse
                        WHERE Standort="'.$StandortID.'"
						AND Datum="'.$DatumID.'"
						AND EinzelergebnisID="'.$EinzelergebnisID.'"
                    ';
                    
         $ergebnis = mysql_query($anfrage)
            or die('Anfrage schlug fehl: '.mysql_error());
        
		//Die Ergebnisse werden mithilfe von value="..." in das Formular der input-Seite voreingefügt, sodass sie nur noch bearbeitet werden müssen
		//Bei den Select Feldern gibt es ein Problem, diese werden per if-Bedingung gesetzt
        while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
			echo('			
				<form name="dateneingabe" action="?site=editbiodata&ort='.$StandortID.'&date='.$DatumID.'&id='.$EinzelergebnisID.'" method="post">
                    <table id="tablehead" name="tablehead" align="center">
                           <caption id="caption">Biologische Mittelwerte &auml;ndern</caption>
                         
                        <tr>
                            <td><label for="Standort">Standort:</label></td>
                			<td>
                            <select id="Standort" name="Standort" size="1">
                ');
                if($zeile['Standort']=="Eichholz"){
                        echo('  <option selected="true" value="Eichholz">Eichholz</option>
                                <option value="Kleiner See">Kleiner See</option>
                                <option value="Absalonshorts">Absalonshorst</option>
                                <option value="Gross Sarau">Gross Sarau</option>
                                <option value="Wakenitzbruecke">Wakenitzbr&uuml;cke</option>');
                }elseif($zeile['Standort']=="Kleiner See"){
                        echo('  <option value="Eichholz">Eichholz</option>
                                <option selected="true" value="Kleiner See">Kleiner See</option>
                                <option value="Absalonshorts">Absalonshorst</option>
                                <option value="Gross Sarau">Gross Sarau</option>
                                <option value="Wakenitzbruecke">Wakenitzbr&uuml;cke</option>');
                }elseif($zeile['Standort']=="Absalonshorst"){
                        echo('  <option value="Eichholz">Eichholz</option>
                                <option value="Kleiner See">Kleiner See</option>
                                <option selected="true" value="Absalonshorts">Absalonshorst</option>
                                <option value="Gross Sarau">Gross Sarau</option>
                                <option value="Wakenitzbruecke">Wakenitzbr&uuml;cke</option>');
                }elseif($zeile['Standort']=="Gross Sarau"){
                        echo('  <option value="Eichholz">Eichholz</option>
                                <option value="Kleiner See">Kleiner See</option>
                                <option value="Absalonshorts">Absalonshorst</option>
                                <option selected="true" value="Gross Sarau">Gross Sarau</option>
                                <option value="Wakenitzbruecke">Wakenitzbr&uuml;cke</option>');
                }elseif($zeile['Standort']=="Wakenitzbruecke"){
                        echo('  <option value="Eichholz">Eichholz</option>
                                <option value="Kleiner See">Kleiner See</option>
                                <option value="Absalonshorts">Absalonshorst</option>
                                <option value="Gross Sarau">Gross Sarau</option>
                                <option selected="true" value="Wakenitzbruecke">Wakenitzbr&uuml;cke</option>');
                }
                                
                echo('            </select>
                            
                            </td>
                		</tr>
                		<tr>
                			<td><label for="Datum">Datum:</label></td>
                			<td id="Datum" name="Datum">
                                <input type="date" size="15" id="Datum" name="Datum" value="'.$zeile['Datum'].'">
                            </td>
                		</tr>
                		
                	</table>
                    <br>
                    <br>
                   
                	<table id="tablebody" name="tablebody" align="center"> 
									<tr>
										<td><label for="EinzelergebnisID">EinzelergebnisID:</label></td>
										<td><input type="number" size="5" id="EinzelergebnisID" name="EinzelergebnisID" value="'.$zeile['EinzelergebnisID'].'"></td>
										<td class="unit">cm</td>
									</tr>
									<tr>
										<td><label for="LaengeUnterWasser">Mittelwert Halml&auml;nge unter Wasser:</label></td>
										<td><input type="number" size="5" id="LaengeUnterWasser" name="LaengeUnterWasser" value="'.$zeile['LaengeUnterWasser'].'"></td>
										<td class="unit">cm</td>
									</tr>
									<tr>
										<td><label for="LaengeUeberWasser">Mittelwert Halml&auml;nge &uuml;ber Wasser:</label></td>
										<td><input type="number"  size="5" id="LaengeUeberWasser" name="LaengeUeberWasser" value="'.$zeile['LaengeUeberWasser'].'"></td>
										<td class="unit">cm</td>
									</tr>
									<tr>
										<td><label for="LaengeGesamt">Mittelwert Halml&auml;nge gesamt:</label></td>
										<td><input type="number" size="5" id="LaengeGesamt" name="LaengeGesamt" value="'.$zeile['LaengeGesamt'].'"></td>
										<td class="unit">cm</td>
									</tr>
									<tr>
										<td><label for="DickeUnten">Mittelwert Halmdicke unten:</label></td>
										<td><input type="number" size="5" id="DickeUnten" name="DickeUnten" value="'.$zeile['DickeUnten'].'"></td>
										<td class="unit">mm</td>
									</tr>
									<tr>
										<td><label for="DickeMitte">Mittelwert Halmdicke mitte:</label></td>
										<td><input type="number" size="5" id="DickeMitte" name="DickeMitte" value="'.$zeile['DickeMitte'].'"></td>
										<td class="unit">mm</td>
									</tr>
									<tr>
										<td><label for="Blattbreite">Mittelwert Blattbreite:</label></td>
										<td><input type="number" size="5" id="Blattbreite" name="Blattbreite" value="'.$zeile['Blattbreite'].'"></td>
										<td class="unit">cm</td>
									</tr>
									<tr>
										<td><label for="Blattlaenge">Mittelwert Blattl&auml;nge:</label></td>
										<td><input type="number" size="5" id="Blattlaenge" name="Blattlaenge" value="'.$zeile['Blattlaenge'].'"></td>
										<td class="unit">cm</td>
									</tr>
									<tr>
										<td><label for="Rispenlaenge">Mittelwert Rispenl&auml;nge:</label></td>
										<td><input type="number" size="5" id="Rispenlaenge" name="Rispenlaenge" value="'.$zeile['Rispenlaenge'].'"></td>
										<td class="unit">cm</td>
									</tr>
									<tr>
										<td><label for="Blattzahl">Mittelwert Blattzahl:</label></td>
										<td><input type="number" size="5" id="Blattzahl" name="Blattzahl" value="'.$zeile['Blattzahl'].'"></td>
										<td class="unit"></td>
									</tr>
									<tr>
										<td><label for="Nodienzahl">Mittelwert Nodienzahl:</label></td>
										<td><input type="number" size="5" id="Nodienzahl" name="Nodienzahl" value="'.$zeile['Nodienzahl'].'"></td>
										<td class="unit"></td>
									</tr>
                        <tr>
                            <td></td>
                            <td>
                            <input type="submit" id="speichern" name="speichern" value="&Auml;ndern">
                            </td>
                        </tr>
						
                	</table>
                </form>
			');
               
		} 
        
		//Genauso wie beim erstmaligen eingeben der Daten bei "inputbiodata". 
        if ( isset($_POST['speichern']) ) {
    			//TO DO: Ungültige Eingabe, wenn kein Wert eingefügt wurde. Oder -1 als default. Versuche es mal TO DO: Und Dezimalzahlen müssen mit Punkt getrennt werden
				echo('<script type="text/javascript">alert("Die Änderung war erfolgreich!");</script>');
				$Standort = $_POST['Standort'];
				//Datum ist direkt Datum
                $Datum = $_POST['Datum'];
				$EinzelergebnisID= $_POST['EinzelergebnisID'];
				$LaengeUnterWasser = $_POST['LaengeUnterWasser'];
                $LaengeUeberWasser = $_POST['LaengeUeberWasser'];
				$LaengeGesamt = $_POST['LaengeGesamt'];
				$DickeUnten = $_POST['DickeUnten'];
				$DickeMitte = $_POST['DickeMitte'];
				$Blattbreite = $_POST['Blattbreite'];
				$Blattlaenge = $_POST['Blattlaenge'];
				$Rispenlaenge = $_POST['Rispenlaenge'];
				$Blattzahl = $_POST['Blattzahl'];
				$Nodienzahl = $_POST['Nodienzahl'];
				
				//Die Standorteingabe wird in eine ID umgewandelt und in $SID gespeichert; default ist 0
				$SID = 0;
				if($Standort=="Gross Sarau"){
				    $SID=1;
				}else if($Standort=="Absalonshorst"){
				    $SID=2;
				}else if($Standort=="Kleiner See"){
				    $SID=3;
				}else if($Standort=="Eichholz"){
				    $SID=4;
				}else if($Standort=="Wallbrechtbruecke"){
				    $SID=5;
				}else{
				    $SID=0;
				}
				
					//Datenbank wird geupdatet
					include('datenbank.php');
					$anfrage = 'UPDATE biologischeEinzelmessergebnisse 
                    SET Standort="'.$Standort.'",
                    Standort="'.$SID.'",
                    Datum="'.$Datum.'",
					EinzelergebnisID="'.$EinzelergebnisID.'",
                    LaengeUnterWasser="'.$LaengeUnterWasser.'",
                    LaengeUeberWasser="'.$LaengeUeberWasser.'",
                    LaengeGesamt="'.$LaengeGesamt.'",
                    DickeUnten="'.$DickeUnten.'", 
                    DickeMitte="'.$DickeMitte.'",
                    Blattbreite="'.$Blattbreite.'",
                    Blattlaenge="'.$Blattlaenge.'",
                    Rispenlaenge="'.$Rispenlaenge.'",
                    Blattzahl="'.$Blattzahl.'",
                    Nodienzahl="'.$Nodienzahl.'"
                    WHERE Standort="'.$StandortID.'"
    				AND Datum="'.$DatumID.'"';
						
						
					$ergebnis = mysql_query($anfrage) 
						or die('Anfrage schlug fehl: '.mysql_error());
                        
			//	Zurückleitung zur Messreihenübersicht, wo der Admin herkommt 						
             echo("<script language ='JavaScript'>
                 window.location.replace('?site=biodatalist&ort=".$StandortID."&date=".$DatumID."'); 
             </script>");

				}
	?>
</div>	   