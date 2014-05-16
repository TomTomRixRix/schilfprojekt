<!--Auf dieser Seite kann der Admin die Datenbank mit den gemessenen chemischen Parametern, sowohl Oberflächenwasser als auch Sedimentwasser, füllen. Dies ist natürlich passwortgeschützt -->
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

<!--Formular zum Eingeben der Daten. Die eingegebenen Werte werden mit post(method) an dieselbe Seite geshcickt(action) und dann im PHP-Teil in die Datenbank eingespeist-->
<form name="dateneingabe" action="?site=inputchemdata" method="post">
                    <table id="tablehead" name="tablehead" align="center">
                           <caption id="caption">Dateneingabe</caption>
                         
						<!--Den Standort kann man mit einem Selector auswählen. Beachte: Wallbrechtbrücke wird mit ue geschireben, da die Datenbank keine Umlaute kann. Dies muss bei der Ausgabe korrigiert werden--> 
                        <tr>
                            <td><label for="Standort">Standort:</label></td>
                			<td>
                            <select id="Standort" name="Standort" size="1">
                                <option selected="true" value"0">---w&auml;hle Standort---</option>
                                <option value"Eichholz">Eichholz</option>
                                <option value"Kleiner See">Kleiner See</option>
                                <option value"Absalonshorts">Absalonshorst</option>
                                <option value"Gross Sarau">Gross Sarau</option>
                                <option value"Wallbrechtbruecke">Wallbrechtbruecke</option>
                            </select>
                            </td>
                		</tr>
						
						<!--Jahr, Monat und Tag kann man mit einem Selector auswählen. Diese werden dann im PHP-Teil zum Datum zusammengefügt  -->
                		<tr>
                			<td><label for="Datum">Datum:</label></td>
                			<td id="Datum" name="Datum">
                            <select  id="Year" name="Year">
                                <option value="2007">2007</option>
                                <option value="2008">2008</option>
                                <option value="2009">2009</option>
                                <option value="2010">2010</option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                                <option selected="true" value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                            </select>
                            <select id="Month" name="Month">
                                <option value="01">Jan</option>
                                <option value="02">Feb</option>
                                <option value="03">M&auml;r</option>
                                <option value="04">Apr</option>
                                <option value="05">Mai</option>
                                <option value="06">Jun</option>
                                <option value="07">Jul</option>
                                <option value="08">Aug</option>
                                <option value="09">Sep</option>
                                <option value="10">Okt</option>
                                <option value="11">Nov</option>
                                <option value="12">Dez</option>
                            </select>
                            <select id="Day" name="Day">
                                <option value="01">01</option>
                            	<option value="02">02</option>
                            	<option value="03">03</option>
                            	<option value="04">04</option>
                            	<option value="05">05</option>
                            	<option value="06">06</option>
                            	<option value="07">07</option>
                            	<option value="08">08</option>
                            	<option value="09">09</option>
                            	<option value="10">10</option>
                            	<option value="11">11</option>
                            	<option value="12">12</option>
                            	<option value="13">13</option>
                            	<option value="14">14</option>
                            	<option value="15">15</option>
                            	<option value="16">16</option>
                            	<option value="17">17</option>
                            	<option value="18">18</option>
                            	<option value="19">19</option>
                            	<option value="20">20</option>
                            	<option value="21">21</option>
                            	<option value="22">22</option>
                            	<option value="23">23</option>
                            	<option value="24">24</option>
                            	<option value="25">25</option>
                            	<option value="26">26</option>
                            	<option value="27">27</option>
                            	<option value="28">28</option>
                            	<option value="29">29</option>
                            	<option value="30">30</option>
                            	<option value="31">31</option>
                        	</select>
                            </td>
                		</tr>
                		<tr>
                			<td><label for="Sichttiefe">Sichttiefe:</label></td>
                			<td><input type="number" size="5" id="Sichttiefe" name="Sichttiefe"></td>
							<td class="unit">m</td>
                		</tr>
                		<tr>
                			<td><label for="Haerte">H&auml;rte:</label></td>
                			<td><input type="number"size="5" id="Haerte" name="Haerte"></td>
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
										<td><input type="number" size="5"  id="TempW" name="TempW"></td>
										<td class="unit">&deg;C</td>
									</tr>
									<tr>
										<td><label for="O2W">Sauerstoffgehalt:</label></td>
										<td><input type="number" size="5" id="O2W" name="O2W"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="pHW">pH-Wert:</label></td>
										<td><input type="number"  size="5" id="pHW" name="pHW"></td>
										<td class="unit"></td>
									</tr>
									<tr>
										<td><label for="LeitfaehigkeitW">Leitf&auml;higkeit:</label></td>
										<td><input type="number" size="5" id="LeitfaehigkeitW" name="LeitfaehigkeitW"></td>
										<td class="unit">&micro;S</td>
									</tr>
									<tr>
										<td><label for="NH4W">Ammoniumgehalt:</label></td>
										<td><input type="number" size="5" id="NH4W" name="NH4W"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="NO2W">Nitritgehalt:</label></td>
										<td><input type="number" size="5" id="NO2W" name="NO2W"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="NO3W">Nitratgehalt:</label></td>
										<td><input type="number" size="5" id="NO3W" name="NO3W"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="PO4W">Phosphatgehalt:</label></td>
										<td><input type="number" size="5" id="PO4W" name="PO4W"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="Fe">Eisengehalt:</label></td>
										<td><input type="number" size="5" id="Fe" name="Fe"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="SiO2">Silikatgehalt:</label></td>
										<td><input type="number" size="5" id="SiO2" name="SiO2"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="O2saettigung">Sauerstoffs&auml;ttigung:</label></td>
										<td><input type="number" size="5" id="O2saettigung" name="O2saettigung"></td>
										<td class="unit">%</td>
									</tr>
									<tr>
										<td><label for="BSB5">BSB5-Wert:</label></td>
										<td><input type="number" size="5" id="BSB5" name="BSB5"></td>
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
										<td><input type="number" size="5" id="TempS" name="TempS"></td>
										<td class="unit">&deg;C</td>
									</tr>
									<tr>
										<td><label for="O2S">Sauerstoffgehalt:</label></td>
										<td><input type="number" size="5" id="O2S" name="O2S"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="pHS">pH-Wert:</label></td>
										<td><input type="number" size="5" id="pHS" name="pHS"></td>
										<td class="unit"></td>
									</tr>
									<tr>
										<td><label for="LeitfaehigkeitS">Leitf&auml;higkeit:</label></td>
										<td><input type="number" size="5" id="LeitfaehigkeitS" name="LeitfaehigkeitS"></td>
										<td class="unit">&micro;S</td>
									</tr>
									<tr>
										<td><label for="NH4S">Ammoniumgehalt:</label></td>
										<td><input type="number" size="5" id="NH4S" name="NH4S"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="NO2S">Nitritgehalt:</label></td>
										<td><input type="number" size="5" id="NO2S" name="NO2S"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="NO3S">Nitratgehalt:</label></td>
										<td><input type="number" size="5" id="NO3S" name="NO3S"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="PO4S">Phosphatgehalt:</label></td>
										<td><input type="number" size="5" id="PO4S" name="PO4S"></td>
										<td class="unit">mg/l</td>
									</tr>
									<tr>
										<td><label for="H2S">Sulfidgehalt:</label></td>
										<td><input type="number" size="5" id="H2S" name="H2S"></td>
										<td class="unit">mg/l</td>
									</tr>
                                    <tr>
    									<td><label for="SO4S">Sulfatgehalt:</label></td>
										<td><input type="number" size="5" id="SO4S" name="SO4S"></td>
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
                            <input type="submit" id="speichern" name="speichern" value="Speichern">
                            </td>
                        </tr>
						
                	</table>
                </form>
               
			<?php
			
			// Der speichern-input-submit-Button wurde gedrückt			
			if ( isset($_POST['speichern']) ) {
				/****************************************************************************************
				*	TO DO: Ungültige Eingabe, wenn kein Wert eingefügt wurde. Oder -1 als default. 
				*	TO DO: !!!!Und Dezimalzahlen müssen mit Punkt getrennt werden');
				*****************************************************************************************/
				
				echo('<script type="text/javascript">alert("Die Eintragung war erfolgreich!");</script>');//könte man auch ans Ende verschieben
				
				//Mithilfe von $_POST werden alle eingegebenen und übergebenen Daten in PHP-Variablen gespeichert
				$Standort = $_POST['Standort'];
                $Year = $_POST['Year'];
                $Month = $_POST['Month'];
				$Day = $_POST['Day'];
                $Datum = $Year."-".$Month."-".$Day;	//Hier wird das Datum zusammengebastelt
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
				
				//Datenbankanbindung
				include('datenbank.php');

				//Anfrage: Packe alle Werte in die passenden Spalten der Tabelle chemische Parameter
				$anfrage = 'INSERT INTO chemischeParameter (Standort, StandortID, Datum, TempW, O2W, O2saettigung, BSB5, pHW, Sichttiefe, LeitfaehigkeitW, Haerte, NH4W, NO2W, NO3W, PO4W, Fe, SiO2, pHS, NH4S, NO2S, NO3S, PO4S, O2S, H2S,SO4S, LeitfaehigkeitS, TempS) '.
								'VALUES ("'.
							$Standort.'","'.
							$SID.'","'.
							$Datum.'","'.
							$TempW.'","'.
							$O2W.'","'.
							$O2saettigung.'","'.
							$BSB5.'","'.
							$pHW.'","'.
							$Sichttiefe.'","'.
							$LeitfaehigkeitW.'","'.
							$Haerte.'","'.
							$NH4W.'","'.
							$NO2W.'","'.
							$NO3W.'","'.
							$PO4W.'","'.
							$Fe.'","'.
							$SiO2.'","'.
							$pHS.'","'.
							$NH4S.'","'.
							$NO2S.'","'.
							$NO3S.'","'.
							$PO4S.'","'.
							$O2S.'","'.
							$H2S.'","'.
                            $SO4S.'","'.
							$LeitfaehigkeitS.'","'.
							$TempS.'")';
							
							$ergebnis = mysql_query($anfrage) 
									or die('Anfrage schlug fehl: '.mysql_error());

				}
			?>	