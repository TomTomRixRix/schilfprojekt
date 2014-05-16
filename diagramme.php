<!--Auf dieser Seite findet die graphische Darstellung der Messergebnisse durch Diagramme statt. Autor: Jonas Tietz-->
<!--DER QEULLCODE MUSS NOCH DRINGEND DOKUMENTIERT WERDEN!-->
<form action="index.php?site=diagramme" method="post">
	<table>
		  <tr>
		     <td>Diagramm Typ:</td>
		     <td>
		        <!-- Auswahlbox für den Diagramm-Typ -->
		        <select id="Diagramm" onchange="xy_actualisieren()">
					<option value="line">Linien Diagramm</option>
					<option value="scatter">Punkt Diagramm</option>
					<option value="column" selected="selected">Balken Diagramm</option>
					<option value="boxplot">Boxplot Diagramm (nicht fertig)</option>
				</select></td>
			 <td>X-Achse:</td>
			 <td>
			    <!-- Auswahlbox für die X-Achse-->
				<select id="X" onchange="xy_actualisieren()">
					<option id="standort">Standort</option>
					<option id="datum" selected="selected">Datum</option>
                    <optgroup label="Chemische Parameter" id="chemischeParameter">
    					<option value="TempW">Temperatur Oberfl&auml;chenwasser</option>
    					<option value="O2W">Sauerstoffgehalt (O<sub>2</sub>) Oberfl&auml;chenwasser</option>
    					<option value="O2saettigung">Sauerstoffs&auml;ttigung</option>
    					<option>BSB<sub>5</sub>-Wert</option>
    					<option value="pHW">ph Wert Oberfl&auml;chenwasser</option>
    					<option >Sichttiefe</option>
    					<option value="LeitfaehigkeitW">Leitf&auml;higkeit Oberfl&auml;chenwasser</option>
    					<option value="Haerte">H&auml;rte</option>
    					<option value="NH4W">Ammoniumgehalt (NH<sub>4</sub><sup>+</sup>) Oberfl&auml;chenwasser</option>
    					<option value="NO2W">Nitritgehalt (NO<sub>2</sub><sup>-</sup>) Oberfl&auml;chenwasser</option>
    					<option value="NO3W">Nitratgehalt (NO<sub>3</sub><sup>-</sup>) Oberfl&auml;chenwasser</option>
    					<option value="PO4W">Phosphatgehalt (PO<sub>4</sub><sup>3-</sup>) Oberfl&auml;chenwasser</option>
    					<option value="Fe">Eisengehalt (Fe<sup>3+</sup>) Oberfl&auml;chenwasser</option>
    					<option value="SiO2">Silikatgehalt (SiO<sub>2</sub>) Oberfl&auml;chenwasser</option>
    					<option value="pHS">ph-Wert Sediment</option>
    					<option value="NH4S">Ammoniumgehalt (NH<sub>4</sub><sup>+</sup>) Sediment</option>
    					<option value="NO2S">Nitritgehalt (NO<sub>2</sub><sup>-</sup>) Sediment</option>
    					<option value="NO3S">Nitratgehalt (NO<sub>3</sub><sup>-</sup>) Sediment</option>
    					<option value="PO4S">Phosphatgehalt (PO<sub>4</sub><sup>3-</sup>) Sediment</option>
    					<option value="O2S">Sauerstoffgehalt (O<sub>2</sub>) Sediment</option>
    					<option value="H2S">Schwefelwasserstoffgehalt (H<sub>2</sub>S) Sediment</option>
    					<option value="LeitfaehigkeitS">Leitf&auml;higkeit Sediment</option>
    					<option value="TempS">Temperatur Sediment</option>
                    </optgroup>  
                    <optgroup label="Biologische Parameter" id="biologischeMittelwerte">
                        <option value="LaengeUnterWasser">Halml&auml;nge unterwasser</option>
        				<option value="LaengeUeberWasser">Halml&auml;nge &uuml;berwasser</option>
    					<option value="LaengeGesamt">Halml&auml;nge</option>
    					<option value="DickeUnten">Halmdicke Wasseroberfl&auml;che</option>
    					<option value="DickeMitte">Halmdicke Sprossmitte</option>
    					<option value="Blattbreite">Blattbreite</option>
    					<option value="Blattlaenge">Blattl&auml;nge</option>
    					<option value="Rispenlaenge">Rispenl&auml;nge</option>
    					<option value="Blattzahl">Blattanzahl</option>
    					<option value="Nodienzahl">Nodienanzahl</option>
                    </optgroup> 
				</select>
			</td>
		  </tr>
		  <tr>
		     <td></td>
		     <td></td>
			 <td>Y-Achse:</td>
			  <td>
			    <!-- Auswahlbox für die Y-Achse-->
				<select id="Y" onchange="xy_actualisieren()" >
                    <optgroup label="Chemische Parameter" id="chemischeParameter">
    					<option value="TempW" einheit="&deg;C">Temperatur Oberfl&auml;chenwasser</option>
    					<option value="O2W" einheit="mg/L">Sauerstoffgehalt (O<sub>2</sub>) Oberfl&auml;chenwasser</option>
    					<option value="O2saettigung" einheit="%">Sauerstoffs&auml;ttigung</option>
    					<option value="BSB5" einheit="mg/L">BSB<sub>5</sub>-Wert</option>
    					<option value="pHW" einheit="">ph Wert Oberfl&auml;chenwasser</option>
    					<option einheit="m">Sichttiefe</option>
    					<option value="LeitfaehigkeitW" einheit="&micro;S">Leitf&auml;higkeit Oberfl&auml;chenwasser</option>
    					<option value="Haerte" einheit="&deg;dH">H&auml;rte</option>
    					<option value="NH4W" einheit="mg/l">Ammoniumgehalt (NH<sub>4</sub><sup>+</sup>) Oberfl&auml;chenwasser</option>
    					<option value="NO2W" einheit="mg/l">Nitritgehalt (NO<sub>2</sub><sup>-</sup>) Oberfl&auml;chenwasser</option>
    					<option value="NO3W" einheit="mg/l">Nitratgehalt (NO<sub>3</sub><sup>-</sup>) Oberfl&auml;chenwasser</option>
    					<option value="PO4W" einheit="mg/l">Phosphatgehalt (PO<sub>4</sub><sup>3-</sup>) Oberfl&auml;chenwasser</option>
    					<option value="Fe" einheit="mg/l">Eisengehalt (Fe<sup>3+</sup>) Oberfl&auml;chenwasser</option>
    					<option value="SiO2" einheit="mg/l">Silikatgehalt (SiO<sub>2</sub>) Oberfl&auml;chenwasser</option>
    					<option value="pHS" einheit="">ph-Wert Sediment</option>
    					<option value="NH4S" einheit="mg/l">Ammoniumgehalt (NH<sub>4</sub><sup>+</sup>) Sediment</option>
    					<option value="NO2S" einheit="mg/l">Nitritgehalt (NO<sub>2</sub><sup>-</sup>) Sediment</option>
    					<option value="NO3S" einheit="mg/l">Nitratgehalt (NO<sub>3</sub><sup>-</sup>) Sediment</option>
    					<option value="PO4S" einheit="mg/l">Phosphatgehalt (PO<sub>4</sub><sup>3-</sup>) Sediment</option>
    					<option value="O2S" einheit="mg/l">Sauerstoffgehalt (O<sub>2</sub>) Sediment</option>
    					<option value="H2S" einheit="mg/l">Schwefelwasserstoffgehalt (H<sub>2</sub>S) Sediment</option>
    					<option value="LeitfaehigkeitS" einheit="&micro;S">Leitf&auml;higkeit Sediment</option>
    					<option value="TempS" einheit="&deg;C">Temperatur Sediment</option>
                    </optgroup>  
                    <optgroup label="Biologische Parameter" id="biologischeMittelwerte">
                        <option value="LaengeUnterWasser" einheit="cm">Halml&auml;nge unterwasser</option>
        				<option value="LaengeUeberWasser" einheit="cm">Halml&auml;nge &uuml;berwasser</option>
    					<option value="LaengeGesamt" einheit="cm">Halml&auml;nge</option>
    					<option value="DickeUnten" einheit="mm">Halmdicke Wasseroberfl&auml;che</option>
    					<option value="DickeMitte" einheit="mm">Halmdicke Sprossmitte</option>
    					<option value="Blattbreite" einheit="cm">Blattbreite</option>
    					<option value="Blattlaenge" einheit="cm">Blattl&auml;nge</option>
    					<option value="Rispenlaenge" einheit="cm">Rispenl&auml;nge</option>
    					<option value="Blattzahl" einheit="">Blattanzahl</option>
    					<option value="Nodienzahl" einheit="">Nodienanzahl</option>
                    </optgroup> 
				</select>
			</td>
		  </tr>
	</table>
	<p id="Bla"><p/>
</form>

<!-- Einbinden der Highchart API für das Diagramm-->
<script src="Highcharts-3.0.4/js/highcharts.js"></script>
<script src="Highcharts-3.0.4/js/highcharts-more.js"></script>
<script src="Highcharts-3.0.4/js/modules/exporting.js"></script>

<!-- DIV-Container für das Highchart Diagramm-->
<div id="container" style="min-width: 310px; width:85%; max-width:1000px height: 400px; margin: 0 auto"></div>


<script type="text/javascript">
	
	//Variablen für die Highchart Serien
	var Eichholz = new Array();
	var KleinerSee = new Array();
	var Absalonshorst = new Array();
	var GrossSarau = new Array();
	var Wallbrechtbruecke = new Array();
	// Variablen für die Standdartabweichung
	var EichholzS = new Array();
	var KleinerSeeS = new Array();
	var AbsalonshorstS = new Array();
	var GrossSarauS = new Array();
	var WallbrechtbrueckeS = new Array();
	//Variablen für die Datenbank
	var optiongroupX;
    var optiongroupY;
    //Variable für die Einheit der Y-Achse
    var einheit;
    
	xy_actualisieren();
	
	function xy_actualisieren(){
	
	    diagram = (document.getElementById('Diagramm').options[document.getElementById('Diagramm').selectedIndex].value);
	
	
	    // Auswahl limitiren
	    if(diagram == 'column' || diagram == 'boxplot'){
            for (var i = 0; i < document.getElementById('X').options.length; i++){
                document.getElementById('X').options[i].disabled = true;
            }
            document.getElementById('standort').disabled = false;
            document.getElementById('standort').selected = true;
        }
        else{
            for (var i = 0; i < document.getElementById('X').options.length; i++){
                document.getElementById('X').options[i].disabled = false;
            }
            document.getElementById('standort').disabled = true;
            if(document.getElementById('standort').selected == true){
                document.getElementById('datum').selected = true;
            }
        }
        
        // X und Y Achsenparameter
		x = (document.getElementById('X').options[document.getElementById('X').selectedIndex].value);
		y = (document.getElementById('Y').options[document.getElementById('Y').selectedIndex].value);

		// Datenbank dür die X und Y Parrameter
        optiongroupX = (document.getElementById('X').options[document.getElementById('X').selectedIndex].parentNode.id);
        optiongroupY = (document.getElementById('Y').options[document.getElementById('Y').selectedIndex].parentNode.id);
        
        //Einheit der Y-Achse
        einheit = document.getElementById('Y').options[document.getElementById('Y').selectedIndex].getAttribute('einheit');
        
        // Variablen leeren
        Eichholz.length = 0;
        KleinerSee.length = 0;
        Absalonshorst.length = 0;
        GrossSarau.length = 0;
        Wallbrechtbruecke.length = 0;
        EichholzS.length = 0;
        KleinerSeeS.length = 0;
        AbsalonshorstS.length = 0;
        GrossSarauS.length = 0;
        WallbrechtbrueckeS.length = 0;
        
        // Für Datum und Standort die Datenbank auf chemischeParameter setzen
        if(optiongroupX == 'X'){
            optiongroupX = 'chemischeParameter';
        }
        if(optiongroupY == 'Y'){
            optiongroupY = 'biologischeMittelwerte';
        }
        if(diagram == 'column' && optiongroupY == 'biologischeMittelwerte'){
            optiongroupY = 'biologischeEinzelmessergebnisse';
        }
        
        
        //Daten aus der Datenbank im Hintergrund laden und formatieren
		$.post( "datenbankabfrage.php", { WertY: y, WertX: x, GroupX: optiongroupX, GroupY: optiongroupY, typ: diagram} ).done(function( data ){eval(data);resetchart();});
		//Highchart aktualisieren
		resetchart();
	};

	function resetchart(){
			
			$.post( "highcharts_data.php", {WertY: y, WertX: x, typ: diagram} ).done(function( data ){eval(data);});
	}
	resetchart();
    
</script>














