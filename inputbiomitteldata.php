<!--Auf dieser Seite kann der Admin die biologischen Mittelwerte eingeben.  -->
<!-- Momentanes Problem: Die Mittelwerte müssen selber berechnet werden und dann auf einer anderen Seite eingegeben werden. Vielleicht kann man das direkt hier mit PHP berechnen lassen!?! Oder die Mittelwerte werden erst mit PHP/SQL beim Ausgeben errechnet?-->
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

<!--Wichtige Anweisung für Nichts-Ahnende. Die Datenbank ist englisch und braucht also Punkte! -->
Kommazahlen mit Punkt trennen!

<!--Formular zum Eingeben der Daten. Die eingegebenen Werte werden mit post(method) an dieselbe Seite geshcickt(action) und dann im PHP-Teil in die Datenbank eingespeist-->
<form name="dateneingabe" action="?site=inputbiomitteldata" method="post">
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
                         
                	</table>
                    <br>
                    
                    <br>
                  
                	<table id="tablebody" name="tablebody" align="center"> 
                	
									
									<tr>
										<td><label for="LaengeUnterWasser">Mittelwert Halml&auml;nge unter Wasser:</label></td>
										<td><input type="number" size="5" id="LaengeUnterWasser" name="LaengeUnterWasser"></td>
										<td >cm</td>
									</tr>
									<tr>
										<td><label for="LaengeUeberWasser">Mittelwert Halml&auml;nge &uuml;ber Wasser:</label></td>
										<td><input type="number"  size="5" id="LaengeUeberWasser" name="LaengeUeberWasser"></td>
										<td >cm</td>
									</tr>
									<tr>
										<td><label for="LaengeGesamt">Mittelwert Halml&auml;nge gesamt:</label></td>
										<td><input type="number" size="5" id="LaengeGesamt" name="LaengeGesamt"></td>
										<td >cm</td>
									</tr>
									<tr>
										<td><label for="DickeUnten">Mittelwert Halmdicke unten:</label></td>
										<td><input type="number" size="5" id="DickeUnten" name="DickeUnten"></td>
										<td >mm</td>
									</tr>
									<tr>
										<td><label for="DickeMitte">Mittelwert Halmdicke mitte:</label></td>
										<td><input type="number" size="5" id="DickeMitte" name="DickeMitte"></td>
										<td >mm</td>
									</tr>
									<tr>
										<td><label for="Blattbreite">Mittelwert Blattbreite:</label></td>
										<td><input type="number" size="5" id="Blattbreite" name="Blattbreite"></td>
										<td >cm</td>
									</tr>
									<tr>
										<td><label for="Blattlaenge">Mittelwert Blattl&auml;nge:</label></td>
										<td><input type="number" size="5" id="Blattlaenge" name="Blattlaenge"></td>
										<td >cm</td>
									</tr>
									<tr>
										<td><label for="Rispenlaenge">Mittelwert Rispenl&auml;nge:</label></td>
										<td><input type="number" size="5" id="Rispenlaenge" name="Rispenlaenge"></td>
										<td >cm</td>
									</tr>
									<tr>
										<td><label for="Blattzahl">Mittelwert Blattzahl:</label></td>
										<td><input type="number" size="5" id="Blattzahl" name="Blattzahl"></td>
										<td ></td>
									</tr>
									<tr>
										<td><label for="Nodienzahl">Mittelwert Nodienzahl:</label></td>
										<td><input type="number" size="5" id="Nodienzahl" name="Nodienzahl"></td>
										<td ></td>
									</tr>
									<tr>
										<td></td>
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
				echo('<script type="text/javascript">alert("Die Eintragung war erfolgreich!");</script>');  //könte man auch ans Ende verschieben
				
				//Mithilfe von $_POST werden alle eingegebenen und übergebenen Daten in PHP-Variablen gespeichert
				$Standort = $_POST['Standort'];
                $Year = $_POST['Year'];
                $Month = $_POST['Month'];
				$Day = $_POST['Day'];
                $Datum = $Year."-".$Month."-".$Day;  //Hier wird das Datum zusammengebastelt
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
				
					//Datenbankanbindung
					include('datenbank.php');
					
					//Anfrage: Packe alle Werte in die passenden Spalten der Tabelle biologischeMittelwerte
					$anfrage = 'INSERT INTO biologischeMittelwerte (Standort, StandortID, Datum,  LaengeUnterWasser, LaengeUeberWasser, LaengeGesamt, DickeUnten, DickeMitte, Blattbreite, Blattlaenge,Rispenlaenge, Blattzahl, Nodienzahl) '.
								'VALUES ("'.
							$Standort.'","'.
							$SID.'","'.
							$Datum.'","'.
							$LaengeUnterWasser.'","'.
							$LaengeUeberWasser.'","'.
							$LaengeGesamt.'","'.
							$DickeUnten.'","'.
							$DickeMitte.'","'.
							$Blattbreite.'","'.
							$Blattlaenge.'","'.
							$Rispenlaenge.'","'.
							$Blattzahl.'","'.
							$Nodienzahl.'")';
							
							$ergebnis = mysql_query($anfrage) 
									or die('Anfrage schlug fehl: '.mysql_error());

				}
			?>	