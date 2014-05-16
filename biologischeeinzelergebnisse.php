<!--Auf dieser Seite werden die 50 Einzelergebnisse/Daten der Schilfvermessung, also der biologischen Parameter aus der Datenbank ausgegeben. 
Die 50 Ergebnisse sind nur von einem Standort an einem Datum. Diese beiden Parameter müssen mit übergeben werden in der URL.
Außerdem werden am Ende noch die Mittelwerte angezeigt.-->
<div id="biologischeeinzelergebnisse" >
<div id="rahmenInhaltFuerScrolltabelle" style="width:950px;">
	<?php

	
                   
            
			//Standort(ort) und Datum(date) müssen übergebenworden sein und werden aus der URL mithilfe von $_GET[] ausgelesen und in PHP-Variablen gespeicher	
            $ortID=$_GET['ort'];
			$dateID=$_GET['date'];

			//Datenbankanbindung	
            include('datenbank.php');
			
			
            
			//Datenbankanfrage: Alle Parameter aus biologischeEinzelergebnisse dieses Standortes und an diesem Datum mit Sortierung. "MONTH(Datum) AS Monat" liefert den Monat der Untersuchung, um später zu unterscheiden, ob im Frühjahr oder im Herbst gemessen wurde
			$anfrage = 'SELECT Standort, Datum, EinzelergebnisID, LaengeUnterWasser, LaengeUeberWasser, LaengeGesamt, DickeUnten, DickeMitte, Blattbreite, Blattlaenge, Rispenlaenge, Blattzahl, Nodienzahl, MONTH(Datum) AS Monat
                        FROM biologischeEinzelmessergebnisse
						WHERE Standort="'.$ortID.'" AND Datum="'.$dateID.'"
                        ORDER BY EinzelergebnisID ASC';
                        
            $ergebnis = mysql_query($anfrage)
                or die('Anfrage schlug fehl: '.mysql_error());
            
			//Damit die Ausgabetabelle einen festen Tabellenkopf und einen scrollbaren Tabellenkörper hat, wird zunächst nur der Tabellenkopf erzeugt ohne Tabellenkörper                    
			//Hier werden in einer zweiten Zeile die Einheiten der gemessenen Parameter angezeigt   
				echo('<table class="tabellesuchergebnissebio">
                <tr>
            		<th style="background:#BDBDBD;" id="tabbio1" >Standort</th>
            		<th style="background:#BDBDBD;" id="tabbio2">Datum</th>
            		<th style="background:#BDBDBD;" title="Halml&auml;nge unter Wasser">HL <sub>u</sub> W</th>
                	<th style="background:#BDBDBD;" title="Halml&auml;nge &uuml;ber Wasser">HL <sup>&uuml;</sup> W</th>
            		<th style="background:#BDBDBD;" title="Halml&auml;nge gesamt">HL <sub>ges.</sub> </th>
            		<th style="background:#BDBDBD;" title="Halmdicke unten">HD <sub>u</sub></th>
            		<th style="background:#BDBDBD;" title="Halmdicke mitte">HD m</th>
            		<th style="background:#BDBDBD;" title="Blattbreite">Bb</th>
            		<th style="background:#BDBDBD;" title="Blattl&auml;nge">Bl</th>
            		<th style="background:#BDBDBD;" title="Rispenl&auml;nge">Rl</th>
                    <th style="background:#BDBDBD;" title="Blattzahl">Bz</th>
                    <th style="background:#BDBDBD;" title="Nodienzahl">Nz</th>
                    <th style="background:#BDBDBD;" id="tabbio3" title="Einzelergebnis ID">ID</th>
            	</tr>
            	<tr class="einheiten">
                    <td></td>
                    <td></td>
                    <td>cm</td>
                    <td>cm</td>
                    <td>cm</td>
                    <td>mm</td>
                    <td>mm</td>
                    <td>cm</td>
                    <td>cm</td>
                    <td>cm</td>
                    <td></td>
                    <td></td>
                    <td></td>
            </tr>
        		</table>');
                
				/*	An dieser Stelle wird der Tabellenkopf nocheinmal erzeugt, 
				*	aber dann über CSS mit .tablebody height:0px; dann ausgeblendet, 
				*	sodass nur der Tabellenkörper sichtbar wird. 
				*	Dieser hat dann aber dieselbe Formation(Breite ...) wird der echte Tabellenkopf.
				*	Die Breite von 92.4%, die per CSS tablebody1 zugewiesen wurde, ist entscheidend, da der übergeordnete Container eine feste Breite hat und somit die Scrollleiste an der richtigen Stelle positioniert wird
				*/
                echo('<div class="tablebody1" ><table class="tabellesuchergebnissebio">
					<thead><tr>
						<th id="tabbio1"></th>
						<th id="tabbio2"></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th id="tabbio3"></th>
					</tr></thead>');
				
				//Tabellenkörper
				echo('<tbody>');

				// Hier wird der Tablebody mit den Daten gefüllt	
		        while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
		            
		            //Runden der Datenbankergebnisse auf bestimmte Anzahl an Nachkommastellen mit round([Wert], [Anzahl der Nachkommastellen])
		            $zeile['LaengeUnterWasser']= round($zeile['LaengeUnterWasser'],3);
		            $zeile['LaengeUeberWasser']= round($zeile['LaengeUeberWasser'],3);
		            $zeile['LaengeGesamt']= round($zeile['LaengeGesamt'],3);
		            $zeile['DickeUnten']= round($zeile['DickeUnten'],3);
		            $zeile['DickeMitte']= round($zeile['DickeMitte'],3);
		            $zeile['Blattbreite']= round($zeile['Blattbreite'],3);
		            $zeile['Blattlaenge']= round($zeile['Blattlaenge'],3);
		            $zeile['Rispenlaenge']= round($zeile['Rispenlaenge'],3);
		            
					
					// Da in der Datenbank keine Umlaute und ß gespeichert werden, wird der Standort "Wallbrechtbrücke" immer mit "ue" gespeichert und dann nachträglich hier korrigiert, ebenso Gro"ß" Sarau mit "ss"
                    if($zeile['Standort']=='Wallbrechtbruecke'){
                        $zeile['Standort']='Wallbrechtbr&uuml;cke'; 
                    }
                    
                    if($zeile['Standort']=='Gross Sarau'){
                        $zeile['Standort']='Gro&szlig; Sarau'; 
                    }
                    
					//Wenn kein Wert gemessen, oder zumindest nicht eingetragen, wurde, dann muss anstatt "0" "-1" in die Datenbank eingetragen werden. Denn 0 würde bedeuten, es wurde der exakte Wert 0 gemessen. "-1" wurde genommen, da die Datenbank in diesen Spalten nur Zahlen nimmt. Bei der Ausgabe soll aber "k.A." für "keine Angabe" stehen	
                    if($zeile['LaengeUnterWasser']=='-1'){
                        $zeile['LaengeUnterWasser']='k.A.';   
                    }
                    
					if($zeile['LaengeUeberWasser']=='-1'){
                        $zeile['LaengeUeberWasser']='k.A.';   
                    }
                    
					if($zeile['LaengeGesamt']=='-1'){
                        $zeile['LaengeGesamt']='k.A.';   
                    }
                    
					if($zeile['DickeUnten']=='-1'){
                        $zeile['DickeUnten']='k.A.';   
                    }
                    
					if($zeile['DickeMitte']=='-1'){
                        $zeile['DickeMitte']='k.A.';   
                    }
                    
					if($zeile['Blattbreite']=='-1'){
                        $zeile['Blattbreite']='k.A.';   
                    }
                    
					if($zeile['Blattlaenge']=='-1'){
                        $zeile['Blattlaenge']='k.A.';   
                    }
                    
					if($zeile['Rispenlaenge']=='-1'){
                        $zeile['Rispenlaenge']='k.A.';   
                    }
                    
					if($zeile['Blattzahl']=='-1'){
                        $zeile['Blattzahl']='k.A.';   
                    }
                    
					if($zeile['Nodienzahl']=='-1'){
                        $zeile['Nodienzahl']='k.A.';   
                    }
                    
					//Da die Aussage von Frühjahrs- und Herbstwerten sehr unterschiedlich ist, wird die Hintergrundfarbe dementsprechend angepasst. Die Herbstwerte werden dunkler, die Frühjahrswerte heller angezeigt
					//Außerdem hat jeder Standort seine eigene Hintergrundfarbe: Groß Sarau:blau, Absalonshorst:rot, Kleiner See:gelb, Eichholz:grün, Wallbrechtbrücke:grau
                    if($zeile['Standort']=='Eichholz'){
                        if($zeile['Monat']>=9){
                           echo('<tr id="okfarbe1">');//Oktober Farbe grün
                        }else{
                           echo('<tr id="frfarbe1">');//Frühjahr Farbe grün
                        }
                    }
                    elseif($zeile['Standort']=='Kleiner See'){
                        if($zeile['Monat']>=9){
                           echo('<tr id="okfarbe2">'); //Oktober Farbe gelb
                        }else{
                           echo('<tr id="frfarbe2">'); //Frühjahr Farbe gelb   
                        }
                    }
                    elseif($zeile['Standort']=='Absalonshorst'){
                        if($zeile['Monat']>=9){
                           echo('<tr id="okfarbe3">'); //Oktober Farbe rot
                        }else{
                           echo('<tr id="frfarbe3">'); //Frühjahr Farbe    rot
                        }
                    }
                    elseif($zeile['Standort']=='Gro&szlig; Sarau'){
                        if($zeile['Monat']>=9){
                           echo('<tr style="background-color:#8EE5EE;">');//Oktober Farbe
                        }else{
                           echo('<tr style="background-color:#C8F3F8;">'); //Frühjahr Farbe    
                        }
                    }
                    elseif($zeile['Standort']=='Wallbrechtbr&uuml;cke'){
                        if($zeile['Monat']>=9){
                           echo('<tr style="background-color:#E6E6E6;">');//Oktober Farbe
                        }else{
                           echo('<tr style="background-color:#F2F2F2;">'); //Frühjahr Farbe    
                        }
                    }
                    else{
						echo('<tr >');    
                    }
                       
						//Hier erfolgt die Dateneinspeisung
                       echo('<td style="font-weight:bold;">'.$zeile['Standort'].'</td>');
					   echo('<td style="font-weight:bold;">'.$zeile['Datum'].'</td>');
                       echo('<td>'.$zeile['LaengeUnterWasser'].'</td>');
                       echo('<td>'.$zeile['LaengeUeberWasser'].'</td>');
                       echo('<td>'.$zeile['LaengeGesamt'].'</td>');
                       echo('<td>'.$zeile['DickeUnten'].'</td>');
                       echo('<td>'.$zeile['DickeMitte'].'</td>');
                       echo('<td>'.$zeile['Blattbreite'].'</td>');
                       echo('<td>'.$zeile['Blattlaenge'].'</td>');
                       echo('<td>'.$zeile['Rispenlaenge'].'</td>');
                       echo('<td>'.$zeile['Blattzahl'].'</td>');
                       echo('<td>'.$zeile['Nodienzahl'].'</td>');
                       echo('<td>'.$zeile['EinzelergebnisID'].'</td>');
					   echo('</tr>');
					}
                    echo('</tbody></table></div>');
                    echo('<br>');
					
				//MITTELWERTE VON DIESEN 50 MESSERGEBNISSEN
                echo('<p style="text-align:center; font-weight:bold;">Mittelwerte</p>');
                
				//Datenbankanbindung	
                include('datenbank.php');
				//Datenbankanfrage: Alle Parameter aus biologischeMittelwerte an diesem Standort und diesem Datum mit Sortierung. "MONTH(Datum) AS Monat" liefert den Monat der Untersuchung, um später zu unterscheiden, ob im Frühjahr oder im Herbst gemessen wurde
                $anfragemw = 'SELECT Standort, Datum, LaengeUnterWasser, LaengeUeberWasser, LaengeGesamt, DickeUnten, DickeMitte, Blattbreite, Blattlaenge, Rispenlaenge, Blattzahl, Nodienzahl, MONTH(Datum) AS Monat
                        FROM biologischeMittelwerte
                        WHERE Standort="'.$ortID.'" AND Datum="'.$dateID.'"';
                        
                $ergebnis = mysql_query($anfragemw)
                or die('Anfrage schlug fehl: '.mysql_error());
            
				//Diesmal sind Tabellenkopf und -körper in einem, da keine Scrollfunktion vorhanden sein soll
				//Hier werden in einer zweiten Zeile die Einheiten der gemessenen Parameter angezeigt   
                echo('<table class="tabellesuchergebnissebio">
                <thead>
                <tr>
                	<th style="width:120px;background:#BDBDBD;">Standort</th>
            		<th style="width:80px;background:#BDBDBD;">Datum</th>
            		<th style="width:60px;background:#BDBDBD;" title="Halml&auml;nge unter Wasser">HL <sub>u</sub> W</th>
                	<th style="width:60px;background:#BDBDBD;" title="Halml&auml;nge &uuml;ber Wasser">HL <sup>&uuml;</sup> W</th>
            		<th style="width:60px;background:#BDBDBD;" title="Halml&auml;nge gesamt">HL <sub>ges.</sub> </th>
            		<th style="width:60px;background:#BDBDBD;" title="Halmdicke unten">HD <sub>u</sub></th>
            		<th style="width:60px;background:#BDBDBD;" title="Halmdicke mitte">HD <sub>m</sub></th>
            		<th style="width:60px;background:#BDBDBD;" title="Blattbreite">Bb</th>
            		<th style="width:60px;background:#BDBDBD;" title="Blattl&auml;nge">Bl</th>
            		<th style="width:60px;background:#BDBDBD;" title="Rispenl&auml;nge">Rl</th>
                    <th style="width:60px;background:#BDBDBD;" title="Blattzahl">Bz</th>
                    <th style="width:60px;background:#BDBDBD;" title="Nodienzahl">Nz</th>
        		</tr>
        		<tr class="einheiten">
                    <td></td>
                    <td></td>
                    <td>cm</td>
                    <td>cm</td>
                    <td>cm</td>
                    <td>mm</td>
                    <td>mm</td>
                    <td>cm</td>
                    <td>cm</td>
                    <td>cm</td>
                    <td></td>
                    <td></td>
            </tr>
        		</thead>');
				
				//Tabellenkörper
				echo('<tbody>');
                 
				// Hier wird der Tablebody mit den Daten gefüllt	
		        while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
					   
                    // Da in der Datenbank keine Umlaute gespeichert werden, wird der Standort "Wallbrechtbrücke" immer mit "ue" gespeichert und dann nachträglich korrigiert
                    if($zeile['Standort']=='Wallbrechtbruecke'){
                        $zeile['Standort']='Wallbrechtbr&uuml;cke'; 
					}
                    
					//Wenn kein Wert gemessen, oder zumindest nicht eingetragen, wurde, dann muss anstatt "0" "-1" in die Datenbank eingetragen werden. Denn 0 würde bedeuten, es wurde der exakte Wert 0 gemessen. "-1" wurde genommen, da die Datenbank in diesen Spalten nur Zahlen nimmt. Bei der Ausgabe soll aber "k.A." für "keine Angabe" stehen	
                    if($zeile['LaengeUnterWasser']=='-1'){
                        $zeile['LaengeUnterWasser']='k.A.';   
                    }
                    
					if($zeile['LaengeUeberWasser']=='-1'){
                        $zeile['LaengeUeberWasser']='k.A.';   
                    }
                    
					if($zeile['LaengeGesamt']=='-1'){
                        $zeile['LaengeGesamt']='k.A.';   
                    }
                    
					if($zeile['DickeUnten']=='-1'){
                        $zeile['DickeUnten']='k.A.';   
                    }
                    
					if($zeile['DickeMitte']=='-1'){
                        $zeile['DickeMitte']='k.A.';   
                    }
                    
					if($zeile['Blattbreite']=='-1'){
                        $zeile['Blattbreite']='k.A.';   
                    }
                    
					if($zeile['Blattlaenge']=='-1'){
                        $zeile['Blattlaenge']='k.A.';   
                    }
                    
					if($zeile['Rispenlaenge']=='-1'){
                        $zeile['Rispenlaenge']='k.A.';   
                    }
                    
					if($zeile['Blattzahl']=='-1'){
                        $zeile['Blattzahl']='k.A.';   
                    }
                    
					if($zeile['Nodienzahl']=='-1'){
                        $zeile['Nodienzahl']='k.A.';   
                    }
                    
					//Da die Aussage von Frühjahrs- und Herbstwerten sehr unterschiedlich ist, wird die Hintergrundfarbe dementsprechend angepasst. Die Herbstwerte werden dunkler, die Frühjahrswerte heller angezeigt
					//Außerdem hat jeder Standort seine eigene Hintergrundfarbe: Groß Sarau:blau, Absalonshorst:rot, Kleiner See:gelb, Eichholz:grün, Wallbrechtbrücke:grau
                    if($zeile['Standort']=='Eichholz'){
                        if($zeile['Monat']==10){
                           echo('<tr id="okfarbe1">');//Oktober Farbe grün
                        }else{
                           echo('<tr id="frfarbe1">');//Frühjahr Farbe grün
                        }
                    }
                    elseif($zeile['Standort']=='Kleiner See'){
                        if($zeile['Monat']==10){
                           echo('<tr id="okfarbe2">'); //Oktober Farbe gelb
                        }else{
                           echo('<tr id="frfarbe2">'); //Frühjahr Farbe gelb   
                        }
                    }
                    elseif($zeile['Standort']=='Absalonshorst'){
                        if($zeile['Monat']==10){
                           echo('<tr id="okfarbe3">'); //Oktober Farbe rot
                        }else{
                           echo('<tr id="frfarbe3">'); //Frühjahr Farbe    rot
                        }
                    }
                    elseif($zeile['Standort']=='Gross Sarau'){
                        if($zeile['Monat']==10){
                           echo('<tr style="background-color:#8EE5EE;">');//Oktober Farbe
                        }else{
                           echo('<tr style="background-color:#C8F3F8;">'); //Frühjahr Farbe    
                        }
                    }
                    elseif($zeile['Standort']=='Wallbrechtbr&uuml;cke'){
                        if($zeile['Monat']==10){
                           echo('<tr style="background-color:#E6E6E6;">');//Oktober Farbe
                        }else{
                           echo('<tr style="background-color:#F2F2F2;">'); //Frühjahr Farbe    
                        }
                    }
                    else{
						echo('<tr >');    
                    }
                       
                       
						//Hier erfolgt die Dateneinspeisung
						//Manche Werte sind gerundet mit  round([Wert], [Anzahl der Nachkommastellen])
						//Dabei können Probleme auftreten, wenn keine Zahlen, sondern Text eingespeichert wurde
					
                       echo('<td style="font-weight:bold;">'.$zeile['Standort'].'</td>');
					   echo('<td style="font-weight:bold;">'.$zeile['Datum'].'</td>');
                       echo('<td>'.$zeile['LaengeUnterWasser'].'</td>');
                       echo('<td>'.$zeile['LaengeUeberWasser'].'</td>');
                       echo('<td>'.$zeile['LaengeGesamt'].'</td>');
                       echo('<td>'.$zeile['DickeUnten'].'</td>');
                       echo('<td>'.$zeile['DickeMitte'].'</td>');
                       echo('<td>'.$zeile['Blattbreite'].'</td>');
                       echo('<td>'.$zeile['Blattlaenge'].'</td>');
                       echo('<td>'.$zeile['Rispenlaenge'].'</td>');
                       echo('<td>'.$zeile['Blattzahl'].'</td>');
                       echo('<td>'.$zeile['Nodienzahl'].'</td>');
                       
                       
					   echo('</tr>');
					}
                    echo('</tbody></table>');
        ?>
	</div>   
</div>