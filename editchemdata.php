<!--Auf dieser Seite kann der Admin die Messreihen der gemessenen chemischen Parametern, sowohl Oberflächenwasser als auch Sedimentwasser, bearbeiten. Dies ist natürlich passwortgeschützt. Standort und Datum wurden über die URL übergeben.-->
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
		//Auslesen von Standort und Datum, die über die URL übergeben wurden
        $StandortID=$_GET['ort'];
		$DatumID=$_GET['date'];
        
		//Datenbankanbindung
        include('datenbank.php');
		
		//Datenbankanfrage: Liefer' alle chemischenParameter von dem Standort und Datum
        $anfrage = 'SELECT Standort, Datum, TempW, O2W, O2saettigung, BSB5, pHW, Sichttiefe, LeitfaehigkeitW, Haerte, NH4W, NO2W, NO3W, PO4W, Fe, SiO2, pHS, NH4S, NO2S, NO3S, PO4S, O2S, H2S,SO4S, LeitfaehigkeitS, TempS
                        FROM chemischeParameter
                        WHERE Standort="'.$StandortID.'"
						AND Datum="'.$DatumID.'"
                    ';
                    
         $ergebnis = mysql_query($anfrage)
            or die('Anfrage schlug fehl: '.mysql_error());
        
		//Die Ergebnisse werden mithilfe von value="..." in das Formular der input-Seite voreingefügt, sodass sie nur noch bearbeitet werden müssen
		//Bei den Select Feldern gibt es ein Problem, diese werden per if-Bedingung gesetzt
        while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
			echo('			
				<form name="dateneingabe" action="?site=editchemdata&ort='.$StandortID.'&date='.$DatumID.'" method="post">
                    <table id="tablehead" name="tablehead" align="center">
                           <caption id="caption">Chemische Daten &auml;ndern</caption>
                         
                        <tr>
                            <td><label for="Standort">Standort:</label></td>
                			<td>
                            <select id="Standort" name="Standort" size="1">
                ');
				
                if($zeile['Standort']=="Eichholz"){
                        echo('  <option selected="true" value="Eichholz">Eichholz</option>
                                <option value="Kleiner See">Kleiner See</option>
                                <option value="Absalonshorst">Absalonshorst</option>
                                <option value="Gross Sarau">Gross Sarau</option>
                                <option value="Wakenitzbruecke">Wakenitzbr&uuml;cke</option>');
                }elseif($zeile['Standort']=="Kleiner See"){
                        echo('  <option value="Eichholz">Eichholz</option>
                                <option selected="true" value="Kleiner See">Kleiner See</option>
                                <option value="Absalonshorst">Absalonshorst</option>
                                <option value="Gross Sarau">Gross Sarau</option>
                                <option value="Wakenitzbruecke">Wakenitzbr&uuml;cke</option>');
                }elseif($zeile['Standort']=="Absalonshorst"){
                        echo('  <option value="Eichholz">Eichholz</option>
                                <option value="Kleiner See">Kleiner See</option>
                                <option selected="true" value="Absalonshorst">Absalonshorst</option>
                                <option value="Gross Sarau">Gross Sarau</option>
                                <option value="Wakenitzbruecke">Wakenitzbr&uuml;cke</option>');
                }elseif($zeile['Standort']=="Gross Sarau"){
                        echo('  <option value="Eichholz">Eichholz</option>
                                <option value="Kleiner See">Kleiner See</option>
                                <option value="Absalonshorst">Absalonshorst</option>
                                <option selected="true" value="Gross Sarau">Gross Sarau</option>
                                <option value="Wakenitzbruecke">Wakenitzbr&uuml;cke</option>');
                }elseif($zeile['Standort']=="Wallbrechtbruecke"){
                        echo('  <option value="Eichholz">Eichholz</option>
                                <option value="Kleiner See">Kleiner See</option>
                                <option value="Absalonshorst">Absalonshorst</option>
                                <option value="Gross Sarau">Gross Sarau</option>
                                <option selected="true" value="Wallbrechtbruecke">Wallbrechtbr&uuml;cke</option>');
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
                		<tr>
                			<td><label for="Sichttiefe">Sichttiefe:</label></td>
                			<td><input type="number" size="5" id="Sichttiefe" name="Sichttiefe" value="'.$zeile['Sichttiefe'].'"></td>
							<td class="unit">m</td>
                		</tr>
                		<tr>
                			<td><label for="Haerte">H&auml;rte:</label></td>
                			<td><input type="number" size="5" id="Haerte" name="Haerte" value="'.$zeile['Haerte'].'"></td>
							<td class="unit">&deg;dH</td>
                		</tr>
                	</table>
                    <br>
                    <br>
                   
                	<table id="tablebody" name="tablebody" align="center"> 
                		<tr>
							<td id="wasser" name="wasser">
								<table  name="wasser">
									<tr>
										<th colspan="2" class="column">Wasser</th>
									</tr>
									<tr>
										<td><label for="TempW">Wassertemperatur:</label></td>
										<td><input type="number" size="5"  id="TempW" name="TempW" value="'.$zeile['TempW'].'"></td>
										<td class="unit">&deg;C</td>
									</tr>
									<tr>
										<td><label for="O2W">Sauerstoffgehalt:</label></td>
										<td><input type="number" size="5" id="O2W" name="O2W" value="'.$zeile['O2W'].'"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="pHW">pH-Wert:</label></td>
										<td><input type="number"  size="5" id="pHW" name="pHW" value="'.$zeile['pHW'].'"></td>
										<td class="unit"></td>
									</tr>
									<tr>
										<td><label for="LeitfaehigkeitW">Leitf&auml;higkeit:</label></td>
										<td><input type="number" size="5" id="LeitfaehigkeitW" name="LeitfaehigkeitW" value="'.$zeile['LeitfaehigkeitW'].'"></td>
										<td class="unit">&micro;S</td>
									</tr>
									<tr>
										<td><label for="NH4W">Ammoniumgehalt:</label></td>
										<td><input type="number" size="5" id="NH4W" name="NH4W" value="'.$zeile['NH4W'].'"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="NO2W">Nitritgehalt:</label></td>
										<td><input type="number" size="5" id="NO2W" name="NO2W" value="'.$zeile['NO2W'].'"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="NO3W">Nitratgehalt:</label></td>
										<td><input type="number" size="5" id="NO3W" name="NO3W" value="'.$zeile['NO3W'].'"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="PO4W">Phosphatgehalt:</label></td>
										<td><input type="number" size="5" id="PO4W" name="PO4W" value="'.$zeile['PO4W'].'"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="Fe">Eisengehalt:</label></td>
										<td><input type="number" size="5" id="Fe" name="Fe" value="'.$zeile['Fe'].'"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="SiO2">Silikatgehalt:</label></td>
										<td><input type="number" size="5" id="SiO2" name="SiO2" value="'.$zeile['SiO2'].'"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="O2saettigung">Sauerstoffs&auml;ttigung:</label></td>
										<td><input type="number" size="5" id="O2saettigung" name="O2saettigung" value="'.$zeile['O2saettigung'].'"></td>
										<td class="unit">%</td>
									</tr>
									<tr>
										<td><label for="BSB5">BSB5-Wert:</label></td>
										<td><input type="number" size="5" id="BSB5" name="BSB5" value="'.$zeile['BSB5'].'"></td>
										<td class="unit">mg/l</td>
									</tr>
								</table>
							</td>
							
                        
							<td id="sediment" name="sediment">
								<table name="sediment">
									<tr>
										<th colspan="2" class="column">Sedimentwasser</th>
									</tr>
									<tr>
										<td><label for="TempS">Wassertemperatur:</label></td>
										<td><input type="number" size="5" id="TempS" name="TempS" value="'.$zeile['TempS'].'"></td>
										<td class="unit">&deg;C</td>
									</tr>
									<tr>
										<td><label for="O2S">Sauerstoffgehalt:</label></td>
										<td><input type="number" size="5" id="O2S" name="O2S" value="'.$zeile['O2S'].'"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="pHS">pH-Wert:</label></td>
										<td><input type="number" size="5" id="pHS" name="pHS" value="'.$zeile['pHS'].'"></td>
										<td class="unit"></td>
									</tr>
									<tr>
										<td><label for="LeitfaehigkeitS">Leitf&auml;higkeit:</label></td>
										<td><input type="number" size="5" id="LeitfaehigkeitS" name="LeitfaehigkeitS" value="'.$zeile['LeitfaehigkeitS'].'"></td>
										<td class="unit">&micro;S</td>
									</tr>
									<tr>
										<td><label for="NH4S">Ammoniumgehalt:</label></td>
										<td><input type="number" size="5" id="NH4S" name="NH4S" value="'.$zeile['NH4S'].'"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="NO2S">Nitritgehalt:</label></td>
										<td><input type="number" size="5" id="NO2S" name="NO2S" value="'.$zeile['NO2S'].'"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="NO3S">Nitratgehalt:</label></td>
										<td><input type="number" size="5" id="NO3S" name="NO3S" value="'.$zeile['NO3S'].'"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="PO4S">Phosphatgehalt:</label></td>
										<td><input type="number" size="5" id="PO4S" name="PO4S" value="'.$zeile['PO4S'].'"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="H2S">Sulfidgehalt:</label></td>
										<td><input type="number" size="5" id="H2S" name="H2S" value="'.$zeile['H2S'].'"></td>
										<td class="unit">mg/l</td>
									</tr>
                                    <tr>
    									<td><label for="SO4S">Sulfatgehlat:</label></td>
										<td><input type="number" size="5" id="SO4S" name="SO4S" value="'.$zeile['SO4S'].'"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
                                        <td style="visibility:hidden">. </td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td style="visibility:hidden">. </td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td style="visibility:hidden">. </td>
                                        <td>  </td>
                                    </tr>
								</table>
							</td>
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
        
		
		//Genauso wie beim erstmaligen eingeben der Daten bei "inputchemdata". 
        if ( isset($_POST['speichern']) ) {
    			//TO DO: Ungültige Eingabe, wenn kein Wert eingefügt wurde. Oder -1 als default. Versuche es mal TO DO: Und Dezimalzahlen müssen mit Punkt getrennt werden
				echo('<script type="text/javascript">alert("Die Änderung war erfolgreich!");</script>');
				$Standort = $_POST['Standort'];
				//Datum ist direkt Datum
                $Datum = $_POST['Datum'];
				$TempW = $_POST['TempW'];
				$O2W = $_POST['O2W'];
				$O2saettigung = $_POST['O2saettigung'];
				$BSB5 = $_POST['BSB5'];
				$pHW = $_POST['pHW'];
				$Sichttiefe = $_POST['Sichttiefe'];
				$LeitfaehigkeitW = $_POST['LeitfaehigkeitW'];
				$Haerte = $_POST['Haerte'];
				$NH4W = $_POST['NH4W'];
				$NO2W = $_POST['NO2W'];
				$NO3W = $_POST['NO3W'];
				$PO4W = $_POST['PO4W'];
				$Fe = $_POST['Fe'];
				$SiO2 = $_POST['SiO2'];
				$pHS = $_POST['pHS'];
				$NH4S = $_POST['NH4S'];
				$NO2S = $_POST['NO2S'];
				$NO3S = $_POST['NO3S'];
				$PO4S = $_POST['PO4S'];
				$O2S = $_POST['O2S'];
				$H2S = $_POST['H2S'];
                $SO4S = $_POST['SO4S'];
				$LeitfaehigkeitS = $_POST['LeitfaehigkeitS'];
				$TempS = $_POST['TempS'];
				
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
					$anfrage = 'UPDATE chemischeParameter 
                    SET Standort="'.$Standort.'",
                    StandortID="'.$SID.'",
                    Datum="'.$Datum.'",
                    TempW="'.$TempW.'",
                    O2W="'.$O2W.'",
                    O2saettigung="'.$O2saettigung.'",
                    BSB5="'.$BSB5.'", 
                    pHW="'.$pHW.'",
                    Sichttiefe="'.$Sichttiefe.'",
                    LeitfaehigkeitW="'.$LeitfaehigkeitW.'",
                    Haerte="'.$Haerte.'",
                    NH4W="'.$NH4W.'",
                    NO2W="'.$NO2W.'",
                    NO3W="'.$NO3W.'",
                    PO4W="'.$PO4W.'",
                    Fe="'.$Fe.'",
                    SiO2="'.$SiO2.'",
                    pHS="'.$pHS.'",
                    NH4S="'.$NH4S.'",
                    NO2S="'.$NO2S.'",
                    NO3S="'.$NO3S.'",
                    PO4S="'.$PO4S.'",
                    O2S="'.$O2S.'",
                    H2S="'.$H2S.'",
                    SO4S="'.$SO4S.'",
                    LeitfaehigkeitS="'.$LeitfaehigkeitS.'",
                    TempS="'.$TempS.'"
                    WHERE Standort="'.$StandortID.'"
    				AND Datum="'.$DatumID.'"';
						
				$ergebnis = mysql_query($anfrage) 
					or die('Anfrage schlug fehl: '.mysql_error());
            
			//	Zurückleitung zur Messreihenübersicht, wo der Admin herkommt                        
            echo("<script language ='JavaScript'>
                 window.location.replace('?site=chemdatalist'); 
            </script>");
				}
	?>
</div>	   