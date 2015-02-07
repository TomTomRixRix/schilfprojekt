S<!--Auf dieser Seite werden die Ergebnisse bzw, Daten der Wasseranalyse, also chemischen Parameter, ausgegeben. Hierbei muss zwischen den Oberflächenwasserwerten und denen des Sedimentwassers unterschieden werden-->
<div class="tabnavigation" style="clear: both;overflow: hidden;width: 100%;position: relative;">
    <!--Man kann mithilfe von zwei Tabs zwischen den Oberflächenwerten und den Sedimentwerten wechseln.
	Dazu wird beim Anklicken das Attribut tab entweder auf "w" für Oberfläche oder "s" für Sediment gesetzt-->
	<ul>
        <li id="w"><a id="wa" href="?site=chemischewerte&tab=w">chemische Oberfl&auml;chenwasseranalyse</a></li>
        <li id="s"><a id="sa" href="?site=chemischewerte&tab=s">chemische Sedimentwasseranalyse</a></li>
    </ul> 
    <div class="tabinhalt">
    
        <?php
		
			//Überprüfen, ob eine Variable in &tab in der URL übergeben wurde. Wenn ja, dann speichern in $tab
            if ( isset($_GET['tab']) ) { 
    			$tab=$_GET['tab'];
                
                ///WASSERANALYSE: Wenn $tab gleich w ist, dann wird die Oberflächenwasseranalyse ausgegeben
                if($tab=="w"){
                
				//Der Oberflächenwasseranalysetab bekommt eine schwarze Hintergrundfarbe und eine weiße Schrift, weil er ausgewählt wurde
                echo("<script language ='JavaScript'>
                            var w = document.getElementById('w');
                            w.style.backgroundColor='black';
                            var wa = document.getElementById('wa');
                            wa.style.color='white';
                        </script>");
				
				//Sortieroptionen, die nach Anklicken in der URL in orderby gespeichert werden	
                echo('<p>Sortieren nach Standort (
                    <a href="?site=chemischewerte&tab=w&orderby=1">flussaufw&auml;rts</a> / 
                    <a href="?site=chemischewerte&tab=w&orderby=2">flussabw&auml;rts</a> ) oder Datum ( 
                    <a href="?site=chemischewerte&tab=w&orderby=3">aufsteigend</a> /
                    <a href="?site=chemischewerte&tab=w&orderby=4">absteigend</a> )
                </p>');
                    
                
                //Datenbankanbindung
                include('datenbank.php');
				
				//Wenn das Attribut "orderby" in der URL gesetzt wurde, dann wird dies in einer Variablen gespeichert. In "orderby" wird festgelegt, wonach die Daten sortiert werden sollen: entweder Standort (1=flussaufwärts, 2=flussabwärts) oder Datum(3=vorwärts, 4=rückwärts)
                if ( isset($_GET['orderby']) ) { 
                    $orderby=$_GET['orderby'];
                }else{
                    $orderby="1"; //default Wert: flussaufwärts
                }
				
		/*  
		*   Datenbankanfragen: Alle Alle Oberflächenwasser-Parameter aus chemische Parameter mit Sortierung. 
		*   "MONTH(Datum) AS Monat" liefert den Monat der Untersuchung, um später zu unterscheiden, 
		*   ob im Frühjahr oder im Herbst gemessen wurde. 
		*   Es wird je nach $orderby eine Anfrage gestellt: 
		*   Standort (1=flussaufwärts, 2=flussabwärts) oder Datum(3=vorwärts, 4=rückwärts)
		*/
		
	/*FLUSSAUFWÄRTS*/
	if($orderby=="1"){
	    
	    //Die Ergebnisse werden nach dem Standort sortiert mithilfe der StandortID, die flussabwärts steigt, deshalb wird sie absteigend sortiert; dann nach dem Datum
        
        $anfrage = 'SELECT Standort, Datum, TempW, O2W, O2saettigung, BSB5, pHW, Sichttiefe, LeitfaehigkeitW, Haerte, NH4W,      
                        NO2W, NO3W, PO4W, Fe, SiO2, MONTH(Datum) AS Monat
                    FROM chemischeParameter
                    ORDER BY StandortID DESC, Datum DESC
                    ';
                    
        
	}
       
    /*FLUSSABWÄRTS*/
    else if($orderby=="2"){   
    
        //Die Ergebnisse werden nach dem Standort sortiert mithilfe der StandortID, die flussabwärts steigt; dann nach dem Datum
        $anfrage = 'SELECT Standort, Datum, TempW, O2W, O2saettigung, BSB5, pHW, Sichttiefe, LeitfaehigkeitW, Haerte, NH4W,      
                        NO2W, NO3W, PO4W, Fe, SiO2, MONTH(Datum) AS Monat
                    FROM chemischeParameter
                    ORDER BY StandortID ASC, Datum DESC
                    ';
    }
    
    /*ZEITLICH VORWÄRTS*/
    else if($orderby=="3"){   
    
        $anfrage = 'SELECT Standort, Datum, TempW, O2W, O2saettigung, BSB5, pHW, Sichttiefe, LeitfaehigkeitW, Haerte, NH4W,      
                        NO2W, NO3W, PO4W, Fe, SiO2, MONTH(Datum) AS Monat
                    FROM chemischeParameter
                    ORDER BY Datum ASC
                    '; 
    }
    
    /*ZEITLICH RÜCKWÄRTS*/    
    else if($orderby=="4"){            
        $anfrage = 'SELECT Standort, Datum, TempW, O2W, O2saettigung, BSB5, pHW, Sichttiefe, LeitfaehigkeitW, Haerte, NH4W,      
                        NO2W, NO3W, PO4W, Fe, SiO2, MONTH(Datum) AS Monat
                    FROM chemischeParameter
                    ORDER BY Datum DESC
                    '; 
    }   
                    
                $ergebnis = mysql_query($anfrage)
                or die('Anfrage schlug fehl: '.mysql_error());
            
				//Damit die Ausgabetabelle einen festen Tabellenkopf und einen scrollbaren Tabellenkörper hat, wird zunächst nur der Tabellenkopf erzeugt ohne Tabellenkörper   
				//Hier werden in einer zweiten Zeile die Einheiten der gemessenen Parameter angezeigt   
                echo('<table class="tabellesuchergebnisse" >
				<tr>
    				<th style="width:120px;background:#BDBDBD;">Standort</th>
    				<th style="width:75px;background:#BDBDBD;">Datum</th>
            		<th style="background:#BDBDBD;" title="Wassertemperatur">Temp</th>
            		<th style="background:#BDBDBD;" title="Sauerstoffgehalt">O<sub>2</sub></th>
            		<th style="background:#BDBDBD;" title="Sauerstoffs&auml;ttigung">O<sub>2</sub>S&auml;t</sub></th>
            		<th style="background:#BDBDBD;" title="BSB5-Wert">BSB5</th>
            		<th style="background:#BDBDBD;" title="pH-Wert">pH</th>
            		<th style="background:#BDBDBD;" title="Sichttiefe">Sicht</th>
            		<th style="background:#BDBDBD;" title="Leitf&auml;higkeit">Leitf.</th>
            		<th style="background:#BDBDBD;" title="Wasserh&auml;rte">H&auml;rte</th>
                    <th style="background:#BDBDBD;" title="Ammoniumgehalt">NH<sub>4</sub><sup>+</sup></th>
                    <th style="background:#BDBDBD;" title="Nitritgehalt">NO<sub>2</sub><sup>-</sup></th>
                    <th style="background:#BDBDBD;" title="Nitratgehalt">NO<sub>3</sub><sup>-</sub></th>
                    <th style="background:#BDBDBD;" title="Phosphatgehalt">PO<sub>4</sub><sup>3-</sup></th>
                    <th style="background:#BDBDBD;" title="Eisengehalt">Fe<sub>3</sub><sup>+</sup></th>
                    <th style="background:#BDBDBD;" title="Silikatgehalt">SiO<sub>2</sub></th>
                </tr>
                <tr class="einheiten">
                    <td></td>
                    <td></td>
                    <td>&deg;C</td>
                    <td>mg/l</td>
                    <td>%</td>
                    <td>mg/l</td>
                    <td></td>
                    <td>m</td>
                    <td>&micro;S</td>
                    <td>&deg;dH</td>
                    <td>mg/l</td>
                    <td>mg/l</td>
                    <td>mg/l</td>
                    <td>mg/l</td>
                    <td>mg/l</td>
                    <td>mg/l</td>
                </tr>
                </table>');
                
				/*	An dieser Stelle wird der Tabellenkopf nocheinmal erzeugt, 
				*	aber dann über CSS mit .tablebody height:0px; dann ausgeblendet, 
				*	sodass nur der Tabellenkörper sichtbar wird. 
				*	Dieser hat dann aber dieselbe Formation(Breite ...) wird der echte Tabellenkopf.
				*	Die Breite von 100.1%,wie sie in der CSS festgelegt ist, ist entscheidend, da der übergeordnete Container eine feste Breite hat und somit die Scrollleiste an der richtigen Stelle positioniert wird
				*/
                
                echo('<div class="tablebody"><table class="tabellesuchergebnisse">
				<thead><tr>
                <th style="width:120px;"></th>
            	<th style="width:75px;"></th>
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
                <th></th>
                <th></th>
                <th></th>
                <th></th>
        		</tr></thead>');
				
				//Tabellenkörper
                echo('<tbody>');    

				// Hier wird der Tablebody mit den Daten gefüllt	
		        while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
					 
					 
					//Runden der Datenbankergebnisse auf bestimmte Anzahl an Nachkommastellen mit round([Wert], [Anzahl der Nachkommastellen])
		            $zeile['TempW']= round($zeile['TempW'],3);
		            $zeile['O2W']= round($zeile['O2W'],3);
		            $zeile['O2saettigung']= round($zeile['O2saettigung'],3);
		            $zeile['BSB5']= round($zeile['BSB5'],3);
		            $zeile['pHW']= round($zeile['pHW'],3);
		            $zeile['Sichttiefe']= round($zeile['Sichttiefe'],3);
		            $zeile['LeitfaehigkeitW']= round($zeile['LeitfaehigkeitW'],3);
		            $zeile['Haerte']= round($zeile['Haerte'],3);
		            $zeile['NH4W']= round($zeile['NH4W'],3);
		            $zeile['NO2W']= round($zeile['NO2W'],3);
		            $zeile['NO3W']= round($zeile['NO3W'],3);
		            $zeile['PO4W']= round($zeile['PO4W'],3);
		            $zeile['Fe']= round($zeile['Fe'],3);
		            $zeile['SiO2']= round($zeile['SiO2'],3);
		            
		            
                    // Da in der Datenbank keine Umlaute und ß gespeichert werden, wird der Standort "Wallbrechtbrücke" immer mit "ue" gespeichert und dann nachträglich hier korrigiert, ebenso Gro"ß" Sarau mit "ss"
                    if($zeile['Standort']=='Wallbrechtbruecke'){
                        $zeile['Standort']='Wallbrechtbr&uuml;cke'; 
                    }
                    
                    if($zeile['Standort']=='Gross Sarau'){
                        $zeile['Standort']='Gro&szlig; Sarau'; 
                    }
                    
					//Wenn kein Wert gemessen, oder zumindest nicht eingetragen, wurde, dann muss anstatt "0" "-1" in die Datenbank eingetragen werden. Denn 0 würde bedeuten, es wurde der exakte Wert 0 gemessen. "-1" wurde genommen, da die Datenbank in diesen Spalten nur Zahlen nimmt. Bei der Ausgabe soll aber "k.A." für "keine Angabe" stehen		
                    if($zeile['Sichttiefe']=='-1'){
                        $zeile['Sichttiefe']='k.A.';   
                    }
                    
					if($zeile['TempW']=='-1'){
                        $zeile['TempW']='k.A.';   
                    }
                    
					if($zeile['O2W']=='-1'){
                        $zeile['O2W']='k.A.';   
                    }
                    
					if($zeile['O2saettigung']=='-1'){
                        $zeile['O2saettigung']='k.A.';   
                    }
                    
					if($zeile['BSB5']=='-1'){
                        $zeile['BSB5']='k.A.';   
                    }
                    
					if($zeile['pHW']=='-1'){
                        $zeile['pHW']='k.A.';   
                    }
                    
					if($zeile['Haerte']=='-1'){
                        $zeile['Haerte']='k.A.';   
                    }
                    
					if($zeile['LeitfaehigkeitW']=='-1'){
                        $zeile['LeitfaehigkeitW']='k.A.';   
                    }
                    
					if($zeile['NH4W']=='-1'){
                        $zeile['NH4W']='k.A.';   
                    }
                    
					if($zeile['NO2W']=='-1'){
                        $zeile['NO2W']='k.A.';   
                    }
                    
					if($zeile['NO3W']=='-1'){
                        $zeile['NO3W']='k.A.';   
                    }
                    
					if($zeile['PO4W']=='-1'){
                        $zeile['PO4W']='k.A.';   
                    }
                    
					if($zeile['Fe']=='-1'){
                        $zeile['Fe']='k.A.';   
                    }
                    
					if($zeile['SiO2']=='-1'){
                        $zeile['SiO2']='k.A.';   
                    }
                       
                    //Da die Aussage von Frühjahrs- und Herbstwerten sehr unterschiedlich ist, wird die Hintergrundfarbe dementsprechend angepasst. Die Herbstwerte werden dunkler, die Frühjahrswerte heller angezeigt
					//Außerdem hat jeder Standort seine eigene Hintergrundfarbe: Groß Sarau:blau, Absalonshorst:rot, Kleiner See:gelb, Eichholz:grün, Wallbrechtbrücke:grau
                    if($zeile['Standort']=='Eichholz'){
                        if($zeile['Monat']==10){
                           echo('<tr style="background-color:#9AFF9A;">');//Oktober Farbe
                        }else{
                           echo('<tr style="background-color:#C4FEC4;">');//Frühjahr Farbe    
                        }
                    }
                    elseif($zeile['Standort']=='Kleiner See'){
                        if($zeile['Monat']==10){
                           echo('<tr style="background-color:#F4FA58;">'); //Oktober Farbe
                        }else{
                           echo('<tr style="background-color:#F3F697;">'); //Frühjahr Farbe    
                        }
                    }
                    elseif($zeile['Standort']=='Absalonshorst'){
                        if($zeile['Monat']==10){
                           echo('<tr style="background-color:#FF8C69;">'); //Oktober Farbe
                        }else{
                           echo('<tr style="background-color:#FABCA9;">'); //Frühjahr Farbe    
                        }
                    }
                    elseif($zeile['Standort']=='Gro&szlig; Sarau'){
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
						
                       echo('<td style="font-weight:bold;">'.$zeile['Standort'].'</td>');
					   echo('<td style="font-weight:bold;">'.$zeile['Datum'].'</td>');
                       echo('<td>'.$zeile['TempW'].'</td>');
                       echo('<td>'.$zeile['O2W'].'</td>');
                       echo('<td>'.$zeile['O2saettigung'].'</td>');
                       echo('<td>'.$zeile['BSB5'].'</td>');
                       echo('<td>'.$zeile['pHW'].'</td>');
                       echo('<td>'.$zeile['Sichttiefe'].'</td>');
                       echo('<td>'.$zeile['LeitfaehigkeitW'].'</td>');
                       echo('<td>'.$zeile['Haerte'].'</td>');
                       echo('<td>'.$zeile['NH4W'].'</td>');
                       echo('<td>'.$zeile['NO2W'].'</td>');
                       echo('<td>'.$zeile['NO3W'].'</td>');
                       echo('<td>'.$zeile['PO4W'].'</td>');
                       echo('<td>'.$zeile['Fe'].'</td>');
                       echo('<td>'.$zeile['SiO2'].'</td>');
                                             
					   echo('</tr>');
					}
                    echo('</tbody></table></div>');
                    
                }
                
                
                
                ///SEDIMENTANALYSE: Wenn $tab gleich s ist, dann wird die Sedimentwasseranalyse ausgegeben
                if($tab=="s"){
              
				//Der Sedimentwasseranalysetab bekommt eine schwarze Hintergrundfarbe und eine weiße Schrift, weil er ausgewählt wurde
                 echo("<script language ='JavaScript'>
                            var s = document.getElementById('s');
                            s.style.backgroundColor='black';
                            var sa = document.getElementById('sa');
                            sa.style.color='white';
                        </script>");
                
                //Sortieroptionen, die nach Anklicken in der URL in orderby gespeichert werden	
                echo('<p>Sortieren nach Standort (
                    <a href="?site=chemischewerte&tab=s&orderby=1">flussaufw&auml;rts</a> / 
                    <a href="?site=chemischewerte&tab=s&orderby=2">flussabw&auml;rts</a> ) oder Datum ( 
                    <a href="?site=chemischewerte&tab=s&orderby=3">aufsteigend</a> /
                    <a href="?site=chemischewerte&tab=s&orderby=4">absteigend</a> )
                </p>');
                
				//Datenbankanbindung
			    include('datenbank.php');
                
				//Wenn das Attribut "orderby" in der URL gesetzt wurde, dann wird dies in einer Variablen gespeichert. In "orderby" wird festgelegt, wonach die Daten sortiert werden sollen: entweder Standort (1=flussaufwärts, 2=flussabwärts) oder Datum(3=vorwärts, 4=rückwärts)
                if ( isset($_GET['orderby']) ) { 
                    $orderby=$_GET['orderby'];
                }else{
                    $orderby="1"; //default Wert: flussaufwärts
                }
                
                
        /*  
		*   Datenbankanfragen: Alle Sediment-Parameter  aus chemische Parameter mit Sortierung. 
		*   "MONTH(Datum) AS Monat" liefert den Monat der Untersuchung, um später zu unterscheiden, 
		*   ob im Frühjahr oder im Herbst gemessen wurde. 
		*   Es wird je nach $orderby eine Anfrage gestellt: 
		*   Standort (1=flussaufwärts, 2=flussabwärts) oder Datum(3=vorwärts, 4=rückwärts)
		*/
		
	/*FLUSSAUFWÄRTS*/
	if($orderby=="1"){
	  	
	  	//Die Ergebnisse werden nach dem Standort sortiert mithilfe der StandortID, die flussabwärts steigt, deshalb wird sie absteigend sortiert; dann nach dem Datum
	  	$anfrage = 'SELECT Standort, Datum, pHS, NH4S, NO2S, NO3S, PO4S, O2S, H2S, SO4S, 
                        LeitfaehigkeitS, TempS, MONTH(Datum) AS Monat
                    FROM chemischeParameter
                    ORDER BY StandortID DESC, Datum DESC';
                    
	
	}
	
	/*FLUSSABWÄRTS*/
    else if($orderby=="2"){   
    
    //Die Ergebnisse werden nach dem Standort sortiert mithilfe der StandortID, die flussabwärts steigt; dann nach dem Datum
    $anfrage = 'SELECT Standort, Datum, pHS, NH4S, NO2S, NO3S, PO4S, O2S, H2S, SO4S, 
                        LeitfaehigkeitS, TempS, MONTH(Datum) AS Monat
                    FROM chemischeParameter
                    ORDER BY StandortID ASC, Datum DESC';
    
   
	}
	 
	/*ZEITLICH VORWÄRTS*/
    else if($orderby=="3"){   
    
        $anfrage = 'SELECT Standort, Datum, pHS, NH4S, NO2S, NO3S, PO4S, O2S, H2S, SO4S, 
                        LeitfaehigkeitS, TempS, MONTH(Datum) AS Monat
                    FROM chemischeParameter
                    ORDER BY Datum ASC
                    '; 
    }
    
    /*ZEITLICH RÜCKWÄRTS*/    
    else if($orderby=="4"){            
        $anfrage = 'SELECT Standort, Datum, pHS, NH4S, NO2S, NO3S, PO4S, O2S, H2S, SO4S, 
                        LeitfaehigkeitS, TempS, MONTH(Datum) AS Monat
                    FROM chemischeParameter
                    ORDER BY Datum DESC
                    '; 
    } 
                    
                $ergebnis = mysql_query($anfrage)
					or die('Anfrage schlug fehl: '.mysql_error());
            
				//Damit die Ausgabetabelle einen festen Tabellenkopf und einen scrollbaren Tabellenkörper hat, wird zunächst nur der Tabellenkopf erzeugt ohne Tabellenkörper   
				//Hier werden in einer zweiten Zeile die Einheiten der gemessenen Parameter angezeigt   
                echo('<table class="tabellesuchergebnisse">
						<tr>
							<th style="width:120px; background:#BDBDBD;">Standort</th>
							<th style="width:75px; background:#BDBDBD;">Datum</th>
							<th style="background:#BDBDBD;" title="pH-Wert">pH</th>
							<th style="background:#BDBDBD;" title="Ammoniumgehalt">NH<sub>4</sub><sup>+</sup></th>
							<th style="background:#BDBDBD;" title="Nitritgehalt">NO<sub>2</sub><sup>-</sup></th>
							<th style="background:#BDBDBD;" title="Nitratgehalt">NO<sub>3</sub><sup>-</sup></th>
							<th style="background:#BDBDBD;" title="Phosphatgehalt">PO<sub>4</sub><sup>3-</sup></th>
							<th style="background:#BDBDBD;" title="Sauerstoffgehalt">O<sub>2</sub></th>
							<th style="background:#BDBDBD;" title="Sulfidgehalt">S<sup>2-</sup></th>
							<th style="background:#BDBDBD;" title="Sulfagehaltt">SO<sub>4</sub><sup>2-</sup></th>
							<th style="background:#BDBDBD;" title="Leitf&auml;igkeit">Leitf.</th>
							<th style="background:#BDBDBD;" title="Wassertemperatur">Temp</th>
						</tr>
						<tr class="einheiten">
						    <td></td>
						    <td></td>
						    <td></td>
						    <td>mg/l</td>
						    <td>mg/l</td>
						    <td>mg/l</td>
						    <td>mg/l</td>
						    <td>mg/l</td>
						    <td>mg/l</td>
						    <td>mg/l</td>
						    <td>&micro;S</td>
						    <td>&deg;C</td>
						</tr>
					</table>');
                
				/*	An dieser Stelle wird der Tabellenkopf nocheinmal erzeugt, 
				*	aber dann über CSS mit .tablebody height:0px; dann ausgeblendet, 
				*	sodass nur der Tabellenkörper sichtbar wird. 
				*	Dieser hat dann aber dieselbe Formation(Breite ...) wird der echte Tabellenkopf.
				*	Die Breite von 85.2%,wie sie im style festgelegt ist, ist entscheidend, da der übergeordnete Container eine feste Breite hat und somit die Scrollleiste an der richtigen Stelle positioniert wird
				*/
                echo('<div class="tablebody" style="width:85.2%;"><table class="tabellesuchergebnisse">
					<thead>
					<tr>
						<th style="width:120px;"></th>
						<th style="width:75px;"></th>
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
					</tr>
					</thead>');
					
				//Tabellenkörper	
                echo ('<tbody>');
                
				// Hier wird der Tablebody mit den Daten gefüllt	
		        while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
		            
		            //Runden der Datenbankergebnisse auf bestimmte Anzahl an Nachkommastellen mit round([Wert], [Anzahl der Nachkommastellen])
		            
		            $zeile['pHS']= round($zeile['pHS'],3);
		            $zeile['NH4S']= round($zeile['NH4S'],3);
		            $zeile['NO2S']= round($zeile['NO2S'],3);
		            $zeile['NO3S']= round($zeile['NO3S'],3);
		            $zeile['PO4S']= round($zeile['PO4S'],3);
		            $zeile['O2S']= round($zeile['O2S'],3);
		            $zeile['H2S']= round($zeile['H2S'],3);
		            $zeile['SO4S']= round($zeile['SO4S'],3);
		            $zeile['LeitfaehigkeitS']= round($zeile['LeitfaehigkeitS'],3);
		            $zeile['TempS']= round($zeile['TempS'],3);
		            
					 
					// Da in der Datenbank keine Umlaute und ß gespeichert werden, wird der Standort "Wallbrechtbrücke" immer mit "ue" gespeichert und dann nachträglich hier korrigiert, ebenso Gro"ß" Sarau mit "ss"
                    if($zeile['Standort']=='Wallbrechtbruecke'){
                        $zeile['Standort']='Wallbrechtbr&uuml;cke'; 
                    }
                    
                    if($zeile['Standort']=='Gross Sarau'){
                        $zeile['Standort']='Gro&szlig; Sarau'; 
                    }
                    
					//Wenn kein Wert gemessen, oder zumindest nicht eingetragen, wurde, dann muss anstatt "0" "-1" in die Datenbank eingetragen werden. Denn 0 würde bedeuten, es wurde der exakte Wert 0 gemessen. "-1" wurde genommen, da die Datenbank in diesen Spalten nur Zahlen nimmt. Bei der Ausgabe soll aber "k.A." für "keine Angabe" stehen			
                    if($zeile['pHS']=='-1'){
                        $zeile['pHS']='k.A.';   
                    }
                    
					if($zeile['NH4S']=='-1'){
                        $zeile['NH4S']='k.A.';   
                    }                    
                    
					if($zeile['NO2S']=='-1'){
                        $zeile['NO2S']='k.A.';   
                    }                    
                    
					if($zeile['NO3S']=='-1'){
                        $zeile['NO3S']='k.A.';   
                    }                    
                    
					if($zeile['PO4S']=='-1'){
                        $zeile['PO4S']='k.A.';   
                    }                    
                    
					if($zeile['O2S']=='-1'){
                        $zeile['O2S']='k.A.';   
                    }                    
                    
					if($zeile['H2S']=='-1'){
                        $zeile['H2S']='k.A.';   
                    }
                    
					if($zeile['SO4S']=='-1'){
                        $zeile['SO4S']='k.A.';   
                    }
                    
					if($zeile['LeitfaehigkeitS']=='-1'){
                        $zeile['LeitfaehigkeitS']='k.A.';   
                    }                    
                    
					if($zeile['TempS']=='-1'){
                        $zeile['TempS']='k.A.';   
                    }                    
                    
					//Da die Aussage von Frühjahrs- und Herbstwerten sehr unterschiedlich ist, wird die Hintergrundfarbe dementsprechend angepasst. Die Herbstwerte werden dunkler, die Frühjahrswerte heller angezeigt
					//Außerdem hat jeder Standort seine eigene Hintergrundfarbe: Groß Sarau:blau, Absalonshorst:rot, Kleiner See:gelb, Eichholz:grün, Wallbrechtbrücke:grau
                    if($zeile['Standort']=='Eichholz'){
                        if($zeile['Monat']==10){
                           echo('<tr style="background-color:#9AFF9A;">');//Oktober Farbe
                        }else{
                           echo('<tr style="background-color:#C4FEC4;">');//Frühjahr Farbe    
                        }
                    }
                    elseif($zeile['Standort']=='Kleiner See'){
						if($zeile['Monat']==10){
                           echo('<tr style="background-color:#F4FA58;">'); //Oktober Farbe
                        }else{
                           echo('<tr style="background-color:#F3F697;">'); //Frühjahr Farbe    
                        }
                    }
                    elseif($zeile['Standort']=='Absalonshorst'){
                        if($zeile['Monat']==10){
							echo('<tr style="background-color:#FF8C69;">'); //Oktober Farbe
                        }else{
                           echo('<tr style="background-color:#FABCA9;">'); //Frühjahr Farbe    
                        }
                    }
                    elseif($zeile['Standort']=='Gro&szlig; Sarau'){
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
                        echo('<tr>');    
                    }
                       
						//Hier erfolgt die Dateneinspeisung
                       echo('<td style="font-weight:bold;">'.$zeile['Standort'].'</td>');
					   echo('<td style="font-weight:bold;">'.$zeile['Datum'].'</td>');
                       echo('<td>'.$zeile['pHS'].'</td>');
                       echo('<td>'.$zeile['NH4S'].'</td>');
                       echo('<td>'.$zeile['NO2S'].'</td>');
                       echo('<td>'.$zeile['NO3S'].'</td>');
                       echo('<td>'.$zeile['PO4S'].'</td>');
                       echo('<td>'.$zeile['O2S'].'</td>');
                       echo('<td>'.$zeile['H2S'].'</td>');
                       echo('<td>'.$zeile['SO4S'].'</td>');
                       echo('<td>'.$zeile['LeitfaehigkeitS'].'</td>');
                       echo('<td>'.$zeile['TempS'].'</td>');
					   echo('</tr>');
					}
                    echo('</tbody></table></div>');
                }        
            }
        ?>
    </div>
    <div>
        <p>hell hinterlegte Zeilen sind Fr&uuml;hjahrswerte, dunkle Herbstwerte </p>
    </div>
</div>   