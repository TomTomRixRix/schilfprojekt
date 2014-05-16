<!--Auf dieser Seite werden die Ergebnisse/Daten der Schilfvermessung, also der biologischen Parameter aus der Datenbank ausgegeben. 
Jedoch nur die Mittelwerte aus ca. 50 Untersuchungen an einem Standort pro Datum. Zu den 50 Einzelergebnissen kommt man durch einen Link.-->
<div id="rahmenInhaltFuerScrolltabelle" style="width:950px;">

	<h1 style="text-align:center;">Schilfvermessung Mittelwerte</h1>
	
	<!--Sortieroptionen, die nach Anklicken in der URL in orderby gespeichert werden-->
    <p>Sortieren nach Standort (
		<a href="?site=biologischewerte&orderby=1">flussaufw&auml;rts</a> /
		<a href="?site=biologischewerte&orderby=2">flussabw&auml;rts</a> ) oder Datum (
        <a href="?site=biologischewerte&orderby=3">aufsteigend</a> /
        <a href="?site=biologischewerte&orderby=4">absteigend</a> )
    </p>
    
    
	<?php
		//Datenbankanbindung
		include('datenbank.php');
		
		//Wenn das Attribut "orderby" in der URL gesetzt wurde, dann wird dies in einer Variablen gespeichert. In "orderby" wird festgelegt, wonach die Daten sortiert werden sollen: entweder Standort (1=flussaufwärts, 2=flussabwärts) oder Datum(3=vorwärts, 4=rückwärts)
        if ( isset($_GET['orderby']) ) { 
            $orderby=$_GET['orderby'];
        }else{
            $orderby="1"; //default Wert: flussaufwärts
        }
		
		/*  
		*   Datenbankanfragen: Alle Parameter aus biologischeMittelwerte mit Sortierung. 
		*   "MONTH(Datum) AS Monat" liefert den Monat der Untersuchung, um später zu unterscheiden, 
		*   ob im Frühjahr oder im Herbst gemessen wurde. 
		*   Es wird je nach $orderby eine Anfrage gestellt: 
		*   Standort (1=flussaufwärts, 2=flussabwärts) oder Datum(3=vorwärts, 4=rückwärts)
		*/
		
	/*FLUSSAUFWÄRTS*/
	if($orderby=="1"){
	    
	    //Die Ergebnisse werden nach dem Standort sortiert mithilfe der StandortID, die flussabwärts steigt, deshalb wird sie absteigend sortiert; dann nach dem Datum
	    $anfrage = 'SELECT Standort, Datum, LaengeUnterWasser, LaengeUeberWasser, LaengeGesamt, DickeUnten, DickeMitte, Blattbreite,                                                                  
                        Blattlaenge, Rispenlaenge, Blattzahl, Nodienzahl, MONTH(Datum) AS Monat 
                    FROM biologischeMittelwerte
                    ORDER BY StandortID DESC, Datum DESC';
                    

    }
                    
    /*FLUSSABWÄRTS*/                
    else if($orderby=="2"){   
            
        //Die Ergebnisse werden nach dem Standort sortiert mithilfe der StandortID, die flussabwärts steigt; dann nach dem Datum
        $anfrage = 'SELECT Standort, Datum, LaengeUnterWasser, LaengeUeberWasser, LaengeGesamt, DickeUnten, DickeMitte, Blattbreite,                                                                  
                        Blattlaenge, Rispenlaenge, Blattzahl, Nodienzahl, MONTH(Datum) AS Monat 
                    FROM biologischeMittelwerte
                    ORDER BY StandortID ASC, Datum DESC
                    ';      
             
    }
                    
    /*ZEITLICH VORWÄRTS*/
    else if($orderby=="3"){                    
        $anfrage='SELECT Standort, Datum, LaengeUnterWasser, LaengeUeberWasser, LaengeGesamt, DickeUnten, DickeMitte, Blattbreite,                                                                  
                        Blattlaenge, Rispenlaenge, Blattzahl, Nodienzahl, MONTH(Datum) AS Monat
                    FROM biologischeMittelwerte
                    ORDER BY Datum ASC
                    ';
    }
                    
    /*ZEITLICH RÜCKWÄRTS*/    
    else if($orderby=="4"){            
        $anfrage='SELECT Standort, Datum, LaengeUnterWasser, LaengeUeberWasser, LaengeGesamt, DickeUnten, DickeMitte, Blattbreite,                                                                  
                        Blattlaenge, Rispenlaenge, Blattzahl, Nodienzahl, MONTH(Datum) AS Monat
                    FROM biologischeMittelwerte
                    ORDER BY Datum DESC
                    ';     
    }               
                    
                        
                       
                        
        $ergebnis = mysql_query($anfrage)
            or die('Anfrage schlug fehl: '.mysql_error());
            
           
            
    //Damit die Ausgabetabelle einen festen Tabellenkopf und einen scrollbaren Tabellenkörper hat, wird zunächst nur der Tabellenkopf erzeugt ohne Tabellenkörper   
    //Hier werden in einer zweiten Zeile die Einheiten der gemessenen Parameter angezeigt     
    echo('
		<table class="tabellesuchergebnissebio">
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
				<th style="width:20px;background:#BDBDBD;" title="Zu den Einzelergebnissen"><div id="gedreht">Einzel- <br>ergebnisse</div></th>
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
            </table>
            <style>
				/* Die Beschriftung "Zu den Einzelergebnissen" ist um 270° gedreht, damit sie besser in die Tabelle passt*/
                 #gedreht{
                        -moz-transform: rotate(270deg);
                        -ms-transform: rotate(270deg);
                        -o-transform: rotate(270deg);
                        -webkit-transform: rotate(270deg);
                        transform: rotate(270deg);
                        font-size:6pt;
                        }
                </style>');
             
		/*	An dieser Stelle wird der Tabellenkopf nocheinmal erzeugt, 
		*	aber dann über CSS mit .tablebody height:0px; dann ausgeblendet, 
		*	sodass nur der Tabellenkörper sichtbar wird. 
		*	Dieser hat dann aber dieselbe Formation(Breite ...) wird der echte Tabellenkopf.
		*	Die Breite von 92.9% ist entscheidend, da der übergeordnete Container eine feste Breite hat und somit die Scrollleiste an der richtigen Stelle positioniert wird
		*/
        echo('
			<div class="tablebody" style="width:97.8%;">
				<table class="tabellesuchergebnissebio" >
					<thead>
					<tr>
						<th style="width:120px;"></th>
						<th style="width:80px;"></th>
						<th style="width:60px;"></th>
						<th style="width:60px;"></th>
						<th style="width:60px;"></th>
						<th style="width:60px;"></th>
						<th style="width:60px;"></th>
						<th style="width:60px;"></th>
						<th style="width:60px;"></th>
						<th style="width:60px;"></th>
						<th style="width:60px;"></th>
						<th style="width:60px;"></th>
						<th style="width:20px;"></th>
					</tr>
					</thead>');
					
        //Tabellenkörper					
		echo('<tbody>');
					
			// Hier wird der Tablebody mit den Daten gefüllt
		    while ( $zeile = mysql_fetch_assoc($ergebnis)) {
		            
		            //Runden der Datenbankergebnisse auf bestimmte Anzahl an Nachkommastellen mit round([Wert], [Anzahl der Nachkommastellen])
		            $zeile['LaengeUnterWasser']= round($zeile['LaengeUnterWasser'],3);
		            $zeile['LaengeUeberWasser']= round($zeile['LaengeUeberWasser'],3);
		            $zeile['LaengeGesamt']= round($zeile['LaengeGesamt'],3);
		            $zeile['DickeUnten']= round($zeile['DickeUnten'],3);
		            $zeile['DickeMitte']= round($zeile['DickeMitte'],3);
		            $zeile['Blattbreite']= round($zeile['Blattbreite'],3);
		            $zeile['Blattlaenge']= round($zeile['Blattlaenge'],3);
		            $zeile['Rispenlaenge']= round($zeile['Rispenlaenge'],3);
		            $zeile['Blattzahl']= round($zeile['Blattzahl'],3);
		            $zeile['Nodienzahl']= round($zeile['Nodienzahl'],3);
					
					// Da in der Datenbank keine Umlaute und ß gespeichert werden, wird der Standort "Wallbrechtbrücke" immer mit "ue" gespeichert und dann nachträglich hier korrigiert, ebenso Gro"ß" Sarau mit "ss"
                    if($zeile['Standort']=='Wallbrechtbruecke'){
                        $zeile['Standort']='Wallbrechtbr&uuml;cke'; 
                    }
                    
                    if($zeile['Standort']=='Gross Sarau'){
                        $zeile['Standort']='Gro&szlig; Sarau'; 
                    }
                    
                    if($zeile['Standort']=='Wallbrechtbr&uuml;cke' && $zeile['Datum']=='2013-10-17'){
                        $zeile['LaengeUnterWasser']='33.3<sup> 1)</sup>'; 
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
                    
					/* 	
					*	Die Pfeile "->" sind Links zum Weiterleiten auf die Seite der Einzelergebnisse. 
					*	Dazu werden Standort(ort) und Datum(date) an die Ziel-URL(biologischeeinzellergebnisse) angehängt
					*	Hier gibt es wieder Probleme mit dem ü von Wakenitzbrücke, weshalb bei der Wallunterscheidung das ü wieder zum ue geändert wird, ebenso das "ß" von Groß Sarau in Gross Sarau
					*/
                    if($zeile['Standort']=='Wallbrechtbr&uuml;cke'){
                        echo('<td><a href="?site=biologischeeinzelergebnisse&ort=Wallbrechtbruecke&date='.$zeile['Datum'].'"> -> </a></td>');
                    }
                    elseif($zeile['Standort']=='Gro&szlig; Sarau'){
                        echo('<td><a href="?site=biologischeeinzelergebnisse&ort=Gross Sarau&date='.$zeile['Datum'].'"> -> </a></td>');        
                    }else{
                        echo('<td><a href="?site=biologischeeinzelergebnisse&ort='.$zeile['Standort'].'&date='.$zeile['Datum'].'"> -> </a></td>');
                    }
				   echo('</tr>');
				}
                echo('</tbody></table></div>');
              
    ?>
    
    <p>hell hinterlegte Zeilen sind Fr&uuml;hjahrswerte, dunkle Herbstwerte </p>
</div>
   