<!--Was auf dieser Seite sein soll ist noch nicht so ganz klar. Autor: Jasper Specht -->
<div id="labor" name="labor">
    
    <!--a href="?site=labor_alt">Alte Version dieser Seite f&uuml;r Jasper</a-->
    
    
    <h1><u>Untersuchungen: Wasseranalyse</u></h1>
    
    
    <!--Die Navigation zwischen den Registerkarten METHODEN,ERGEBNISSE,AUSWERTUNGEN wird hier realisiert-->
    <?php include("registerkarten.php"); ?>
    
        <script type="text/javascript">
        $(document).ready(function(){
            $("#results").hide();
            $("#surface").show();
            $("#sediment").show();
            $("#diagrams").show();
            
        });
    
        </script> 
    
    

<div id="methodsContent" class="registerContent">
    <div class="bildContainer">
		<a href="images/amStandort.JPG" data-lightbox="wasser" title="Messung am Standort">	
    		<img src="thumbnails/amStandort.JPG" alt="Messung am Standort">
    		<p class="bildunterschrift">Messung am Standort</p>
    	</a>
    	<a href="images/imLabor.JPG" data-lightbox="wasser" title="Messung im Labor">	
    		<img src="thumbnails/imLabor.JPG" alt="Messung im Labor">
    		<p class="bildunterschrift">Messung im Labor</p>
    	</a>
    </div>
    
    <p>Die chemischen und physikalischen Untersuchungen werden zum Teil direkt am Standort und zum Teil im Labor (unserem Bio-Raum) durchgef&uuml;hrt. So muss der Sauerstoffgehalt sofort nach Probenentnahme gemessen und eine Probenflasche sofort mit Aluminiumfolie verdunkelt werden, um sp&auml;ter die Sauerstoffzehrung &uuml;ber den BSB<sub>5</sub>-Wert ermitteln zu k&ouml;nnen. Zur Bestimmung der Sauerstoffs&auml;ttigung ben&ouml;tigt man auch vor Ort die Temperatur des Wassers. </p>
    <p>Fast alle chemischen Analysen werden mit Nachweisk&auml;sten der Firma Merck vorgenommen. Sie beinhalteten die grundlegenden Ger&auml;te, wie Pipette, skalierter Becher oder Probenflasche, verschiede Nachweischemikalien und eine Anleitung. Der qualitative und quantitative Nachweis erfolgt dann &uuml;ber einen Farbumschlag, der in Abh&auml;ngigkeit von dem Gehalt des Stoffes variiert und mit einer Farbskala zu vergleichen ist.  </p>
    <p><span style="color:red;">Wichtig!</span> Bleistift zum Protokollieren der Werte (schreibt auch bei Regen oder Spritzwasser).</p>

    <table>
        <thead>
            <tr>
                <th><u><b>Oberfl&auml;chenwasser:</b></u></th>
                <th><u><b>Sedimentwasser:</b></u></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <p><u>am Standort:</u></p>
                    <ul>
                        <li><span id="O2">Sauerstoffgehalt</span></li>
                        <li><span id="Temp">Wassertemperatur</span></li>
                        <li><span id="Sichttiefe">Sichttiefe</span></li>
                    </ul>
                </td>
                <td>
                    <p><u>am Standort:</u></p>
                    <ul> 
                        <li><span id="O2">Sauerstoffgehalt</span></li>
                    </ul>    
                </td>
            </tr>
            <tr>
                <td>
                    <p><u>im Labor:</u></p>
                    <ul>
                        <li><span id="pH">pH-Wert</span></li>
                        <li><span id="Leitfaehigkeit">Leitf&auml;higkeit</span></li>
                        <li><span id="NH4">Ammonium/Ammoniak</span></li>
                        <li><span id="NO2">Nitrit</span></li>
                        <li><span id="NO3">Nitrat</span></li>
                        <li><span id="PO4">Phosphat</span></li>
                        <li><span id="Fe">Eisen</span></li>
                        <li><span id="SiO">Silikat</span></li>
                        <li><span id="O2%">Sauerstoffs&auml;ttigung</span></li>
                        <li><span id="BSB5">BSB5-Wert</span></li>
                        <li><span id="Haerte">H&auml;rte</span></li>
                    </ul>
                </td> 
                <td>
                    <p><u>im Labor:</u></p>
                    <ul>
                        <li><span id="pH">pH-Wert</span></li>
                        <li><span id="Leitfaehigkeit">Leitf&auml;higkeit</span></li>
                        <li><span id="NH4">Ammonium/Ammoniak</span></li>
                        <li><span id="NO2">Nitrit</span></li>
                        <li><span id="NO3">Nitrat</span></li>
                        <li><span id="PO4">Phosphat</span></li>
                        <li><span id="SO4">Sulfat</span></li>
                        <li><span id="S2-">Sulfid</span></li>
                    </ul>
                </td>    
            </tr>
        </tbody>
    </table>
    
    <script type="text/javascript">
    
    // Hier wird das Ausfahren der genauen Beschreibungen realisiert
    $( document ).ready(function(){         //Wenn Seite geladen ist...
       
       //...soll für jedes Element, was vom Typ SPAN und Teil der Auflistung sein muss,...
       
        $('#labor > #methodsContent > table > tbody > tr > td > ul > li >span').each(function() {
            /*beim hovern Curser als Finger anzeigen*/$(this).css("cursor","pointer");    
    		$(this).click( function() {     //...beim Klicken...
    			
    			//Makiere den ausgewählten Parameter soll rot, wenn er vorher blau war, ansonsten blau
    			if($(this).css("color")=="rgb(0, 0, 255)"){
    			    $(this).css("color","red");
    			}else{
    			    $(this).css("color","blue");
    			}
    			
    			//..die Id bestimmt werden. Genau dieselbe Id ist nocheinmal vergeben für das DIV des Beschreibungstexts
    			var Id = $(this).attr('id');
    		    
    		    //Gehe alle Beschreibungstexte durch...
    			$('.laborText').each(function(){
    			        
			        if($(this).attr('id')==Id){ 
			            //.. und öffne den, mit der richtigen Id
			            $(this).slideToggle("easing");
			        }
    			});
    		});
    	});
    });
    
    //Wenn irgendwo ins Fenster geklickt wird (außer natürlich auf den SPAN Link), dann soll der Beschreibungstext sich schließen
    function tryclosing(e) {
		    if(e.target.className == "laborText" || e.target.nodeName=="SPAN"|| e.target.nodeName=="P"|| e.target.nodeName=="B"|| e.target.nodeName=="U") return;
		    $('.laborText').each( function() {
			    if($(this).is(":visible")) {
				    $(this).slideToggle("easing");
			    }
		    });
		    $("li > span").css("color", "blue");
	    }
	
	//Hier wird die Funktion aufgerufen
	document.onclick = tryclosing;
    
    </script>
    
<div id="genauereBeschreibungen">    
    <div id="O2%" class="laborText">
        <p><b> Sauerstoffs&auml;ttigung</b></p>
        <p>Der Wert wird mit Hilfe einer Tabelle aus den Werten der Temperatur und des Sauerstoffgehaltes ermittelt.</p>
        
    </div>
    
    <div id="BSB5" class="laborText">
        <p><b> BSB<sub>5</sub>-Wert </b></p>
        <p>Zeigt an wie viel Sauerstoff innerhalb von <b>5 Tagen</b> in kompletter Abschirmung von Licht und anderen &auml;u&szlig;eren Einfl&uuml;ssen verbraucht wird. Dieses nennt man den<b> biochemischen Sauerstoffbedarf.</b></p>
        <p>Hierzu wird eine Wasserprobe mit einer Probenflasche entnommen und sofort mit Alufolie umwickelt, um durch diese Verdunkelung photosynthetische Prozesse zu verhindern. In dieser Weise abgedunkelt l&auml;sst man die Probe <b>5 Tage</b> bei <b>20 &deg;C</b> ruhen. Anschlie&szlig;end wird der Sauerstoffgehalt gemessen. </p>
        <p>Der BSB<sub>5</sub>-Wert wird dann aus der Differenz des Sauerstoffgehaltes vor Ort und des nun gemessenen Wertes ermittelt und in <b>mg O<sub>2</sub>/l</b> angegeben. Sie gibt den Sauerstoffverbrauch aerober Organismen des Wassers an.</p>
    </div>
    
    <div id="pH" class="laborText">
    <div class="bildContainer">
		<a href="images/jb4.JPG" data-lightbox="wasser" title="pH-Wert-Messung">	
    		<img src="thumbnails/jb4.JPG" alt="pH-Wert-Messung">
    		<p class="bildunterschrift">pH-Wert-Messung</p>
    	</a>
    </div>
        <p ><b>pH-Wert (nach Merck)<sup>1</sup> </b></p>
        <p>Die Bestimmung des pH-Wertes erfolgt am einfachsten kolorimetrisch mit einem Schnellbestimmungssatz (Universalindikator mit geeigneten Abstufungen im mittleren Bereich). Dazu werden zwei Gl&auml;ser mit <b>5ml</b> der Wasserprobe gef&uuml;llt. Dann wird in eines der Gl&auml;ser <b>ein Tropfen pH-1</b> gegeben und gemischt. Mit Hilfe des anderen Glases zum Abgleich wird der Messwert an der Farbskala abgelesen. </p>
    </div> 
    
    <div id="Leitfaehigkeit" class="laborText">
    <div class="bildContainer">
		<a href="images/jb6.jpg" data-lightbox="wasser" title="Leitf&auml;higkeitsmessger&auml;t Glf 100">	
    		<img src="thumbnails/jb6.jpg" alt="Leitf&auml;higkeitsmessger&auml;t Glf 100">
    		<p class="bildunterschrift">Leitf&auml;higkeitsmessger&auml;t Glf 100</p>
    	</a>
    </div>
        <p><b> Leitf&auml;higkeit</b></p>
        <ol>
            <li>&quot;Glf 100&quot; mit On Knopf einschalten.</li>
            <li>Schutzkappe abziehen.</li>
            <li>Messstab in das zu pr&uuml;fende Wasser halten. Es wird ein Ergebnis in <b>mikro Siemens (MikroS) </b>angegeben.</li>
        </ol>
    </div>
    
    <div id="Haerte" class="laborText">
        <p><b> H&auml;rte (nach Merck) </b></p>
        <ol>
            <li>Testglas mehrmals  mit der Probe aussp&uuml;len.</li>
            <li><b>5m</b>l der Wasserprobe in ein Testglas geben.</li>
            <li><b>3 Tropfen</b> des Reagenz H-1 zugeben, bei einer Anwesenheit von H&auml;rtebildnern f&auml;rbt sich die L&ouml;sung rot.</li>
            <li>Die Pipette bis zur <b>0 Markierung</b> mit Reagenz H-2 auff&uuml;llen.</li>
            <li>Langsam unter Schw&auml;nken Reagenz H-2 dazu geben, bis sich die L&ouml;sung &uuml;ber grauviolett zu <b>gr&uuml;n</b> f&auml;rbt, bei Gr&uuml;nf&auml;rbung den Wert an der Pipette ablesen, der Wert wird in <b>mg/l CaCO3</b> angegeben.</li>
        </ol>
    </div>   
    
    <div id="NH4" class="laborText">
        <p><b> Ammonium /Ammoniak (nach Merck) <sup>1</sup> </b></p>
        <p>F&uuml;r die Messung werden zwei Gl&auml;ser mit 20 ml der Wasserprobe gef&uuml;llt. In eines wird zuerst<b> 2,5 ml</b> NH4-1 getropft und dann <b>ein L&ouml;ffel</b> von NH4-2 gegeben. Nach gr&uuml;ndlichem Sch&uuml;tteln muss die L&ouml;sung <b>5 Minuten</b> stehen bleiben. Danach werden <b>zwei Tropfen</b> NH4-3 in das Glas gegeben und wieder gesch&uuml;ttelt. Nach weiteren <b>7 Minuten</b> Wartezeit kann der Messwert &uuml;ber den Farbabgleich bestimmt werden. Das zweite Glas, in dem sich nur die Wasserprobe befindet, wird als Orientierung genutzt.</p>
        <p><span style="color:red">Wichtig!</span>  Probekasten nach <b>Ne&szlig;ler!</b></p>
    </div>    
    
    <div id="NO2" class="laborText">
        <p><b> Nitrit (nach Merck) </b></p>
        <ol>
            <li>Beide Testgl&auml;ser bis zur Marke <b>(20ml)</b> f&uuml;llen.</li>
            <li><b>1 gestrichenen Mikrol&ouml;ffel </b>No2-1 (Sulfanils&auml;ure) dazugeben, in ein Test Glas und mit geschlossenem Deckel kr&auml;ftig sch&uuml;tteln, bis alles gel&ouml;st ist.</li>
            <li>pH-Wert von der L&ouml;sung messen, er sollte zwischen<b> 2 und 2,5</b> liegen, wenn er au&szlig;erhalb dieses Bereiches liegt, mit Natronlauge oder Schwefels&auml;ure einstellen.</li>
            <li>Farbkarte soweit durchschieben, bis Farben bestm&ouml;glich &uuml;bereinstimmen und dann Wert auf der Unterseite der Farbkarte ablesen.</li>
        </ol>
    </div>    
    
    <div id="NO3" class="laborText">
        <p><b> Nitrat (nach Merck) <sup>1</sup> </b></p>
        <ol>
            <li>Beide Gl&auml;ser mit <b>5 ml</b> der Wasserprobe f&uuml;llen.</li>
            <li><b>2 gestrichene gr&uuml;ne Mikrol&ouml;ffel</b> N03 -1 in Glas 2 geben.</li>
            <li>Glas <b>1 Minute</b> sch&uuml;tteln.</li>
            <li><b>5 min</b> stehen lassen.</li>
            <li>Farbe der Farbskala zuordnen, Messwert ablesen.</li>
        </ol>
    </div>    
    
    <div id="PO4" class="laborText">
        <p ><b> Phosphat (nach Merck) <sup>1</sup> </b></p>
        <ol>
            <li>Beide Gl&auml;ser bis zur Markierung mit Wasserprobe (5&deg;-35&deg;C) f&uuml;llen.</li>
            <li>Inneres Glas mit <b>10 Tropfen</b> P-1A versetzen und mischen.</li>
            <li>Inneres Glas mit <b>1 gestrichenen Mikrol&ouml;ffel</b> P-2A versetzen und l&ouml;sen.</li>
            <li>Farbabgleich nach <b>1 Minute.</b></li>
        </ol>
    </div>
    
    <div id="Fe" class="laborText">
        <p><b> Eisen (nach Merck) </b></p>
        <ol>
            <li>Jeweils <b>10 ml</b> Wasserprobe in beide Testgl&auml;ser geben.</li>
            <li><b>3 Tropfen</b> Reagenz Fe-1 zu einer der Messproben zugeben und mit verschlossenen Deckel mischen.</li>
            <li><b>3 Minuten</b> stehen lassen.</li>
            <li>Farbkarte soweit durchschieben, bis Farben bestm&ouml;glich &uuml;bereinstimmen und dann Wert auf der Unterseite der Farbkarte ablesen.</li>
        </ol>
    </div>
    
    <div id="SiO" class="laborText">
        <p><b> Silikat (nach Merck) </b></p>
        <ol>
            <li><b>20 ml</b> Wasserprobe in beide Testgl&auml;ser geben.</li>
            <li><b>3 Tropfen </b>Reagenz S-1 dazugeben.        </li>
            <li>L&ouml;sung mit geschlossenem Deckel sch&uuml;tteln.</li>
            <li>pH-Wert messen, muss zwischen <b>1.2 und 1.6</b> liegen.</li>
            <li><b>3 Minuten </b>reagieren lassen.</li>
            <li><b>3 Tropfen</b> Reagenz S-2 dazugeben.</li>
            <li><b>10 Tropfen</b> Reagenz S-3 dazugeben.</li>
            <li>L&ouml;sung mit geschlossenem Deckel sch&uuml;tteln.</li>
            <li><b>2 Minuten </b>reagieren lassen.</li>
            <li>Farbkarte soweit durchschieben, bis Farben bestm&ouml;glich &uuml;bereinstimmen und dann Wert auf der Unterseite der Farbkarte ablesen.</li>
        </ol>
        <p><span style="color:red;">Wichtig!</span> Silikat m&ouml;glichst vor Ort messen. Wenn nicht m&ouml;glich, die Wasserprobe <u>nicht</u> in einer Glasflasche transportieren.</p>
    </div>    
    
    <div id="SO4" class="laborText">
        <p><b>Sulfatgehalt:  </b></p>
        <p>Hinweis: Umgang mit Nachweiskasten nur durch Lehrkr&auml;ften aufgrund von Chemikalien!</p>
    </div>   
    
    <div id="S2-" class="laborText">
        <p><b>Schwefelwasserstoff &uuml;ber Sulfidgehalt:  </b></p>
        <ol>
            <li><b>6 ml</b> Wasserprobe in beide Testgl&auml;ser geben.</li>
            <li><b>1 Tropfen</b> Reagenz S-1 dazu geben.</li>
            <li><b>5 Tropfen</b> Reagenz S-2 dazu geben.</li>
            <li><b>5 Tropfen</b> Reagenz S-3 dazu geben.</li>
            <li>Beide Messgl&auml;ser in die entsprechenden &Ouml;ffnungen stellen, <b>Farbe abgleichen</b> und Wert ablesen.</li>
        </ol>
    </div>    
    
    <div id="Temp" class="laborText">
        <p><b> Temperatur </b></p>
        <p>Die Temperatur wird durch einen normalen analogen <b>Thermometer</b> festgestellt.</p>
    </div>
    
    <div id="Sichttiefe" class="laborText">
    <div class="bildContainer">
		<a href="images/jb21.jpg" data-lightbox="wasser" title="Secci-Scheibe">	
    		<img src="thumbnails/jb21.jpg" alt="Secci-Scheibe">
    		<p class="bildunterschrift">Secci-Scheibe</p>
    	</a>
    </div>
    <p><b>Sichttiefe:</b></p>
        <p>Bei der Sichttiefenmessung wird die <b>Secchi-Scheibe</b> an einen <b>Ma&szlig;band</b> befestigt, danach wird die Scheibe in das Wasser gelassen, bis sie nicht mehr zu sehen ist oder auf dem Grund aufsetzt (Grundsicht, Sichttiefe entspricht dann der Wassertiefe). Der Wert wird von dem Ma&szlig;band direkt an der Wasseroberfl&auml;che abgelesen. </p>
        <p><span style="color:red">Wichtig!</span> Messung im Schatten durchf&uuml;hren und einen konstanten Abstand zwischen Augen des Betrachters und Wasseroberfl&auml;che bewahren.</p>
    </div>
    
    <div id="O2" class="laborText">
        <div class="bildContainer">
		<a href="images/sauerstoff.JPG" data-lightbox="wasser" title="Messung des Sauerstoffgehalts vor Ort">	
    		<img src="thumbnails/sauerstoff.JPG" alt="Messung des Sauerstoffgehalts vor Ort">
    		<p class="bildunterschrift">Messung des Sauerstoffgehalts vor Ort</p>
    	</a>
    	<a href="images/jb1.JPG" data-lightbox="wasser" title="Merck-Kasten">	
    		<img src="thumbnails/jb1.JPG" alt="Merck-Kasten">
    		<p class="bildunterschrift">Merck-Kasten</p>
    	</a>
    </div>
        <p ><b> Sauerstoffgehalt (nach Merck) </b></p>
        <ol>
            <li>Eine Glasflasche, in der sich Glaskugeln befinden, mehrmals mit dem zu untersuchenden <b>Wasser</b> ausgesp&uuml;len, dann bis zum <b>&uuml;berlaufen mit diesem Wasser f&uuml;llen.</b></li>
            <li><b>5 Tropfen Reagenz 1 (Mangan(II)-chlorid) und Reagenz 2 (Natriumhydroxid)</b> dazu geben, dann das Gef&auml;&szlig; mit einem Glasstopfen verschlie&szlig;en, gut sch&uuml;ttelen und f&uuml;r <b>1 Minute</b> stehen lassen. <b>10 Tropfen Reagenz 3 (Schwefels&auml;ure)</b> zugeben, verschlie&szlig;en und gut sch&uuml;tteln.</li>
            <li>Messgef&auml;&szlig; mit der L&ouml;sung aussp&uuml;len und mit <b>5 ml f&uuml;llen.</b></li>
            <li><b>1 Tropfen Reagenz 4</b>  zugeben und sch&uuml;tteln. Die F&auml;rbung wird  je nach S&auml;ttigung <b>violett</b> bis <b>blau.</b></li>
            <li>Titrierpipette herausnehmen und bis zur<b> 0  mit Reagenz 5 </b>aufziehen.</li>
            <li>Pipette abstreifen, dann unter Schw&auml;nken des Gef&auml;&szlig;es langsam mehr Reagenz 5 dazugeben, bis ein Farbumschlag von <b>blau zu farblos</b> stattfindet.</li>
            <li>Sauerstoffgehalt des Wassers auf der Skala der Pipette ab</li>
        </ol>
        <p><span style="color:red">Wichtig!</span> Der Sauerstoffwert muss direkt  nach der Entnahme gemessen werden, da sich dieser sonst ver&auml;ndert. </p>
    </div>
    
</div>

    <!--div class="bildContainer" >
			
    		
    		<a href="images/jb15.JPG" data-lightbox="labor" title="bla">	
    			<img src="images/jb15.JPG" alt="15">
    		</a>
    		
    		<a href="images/jb16.JPG" data-lightbox="labor" title="bla">	
    			<img src="images/jb16.JPG" alt="16">
    		</a>
    		
    		<a href="images/jb17.JPG" data-lightbox="labor" title="bla">	
    			<img src="images/jb17.JPG" alt="17">
    		</a>
    		
    		<a href="images/jb18.JPG" data-lightbox="labor" title="bla">	
    			<img src="images/jb18.JPG" alt="18">
    		</a>
    		
    		<a href="images/jb19.jpg" data-lightbox="labor" title="bla">	
    			<img src="images/jb19.jpg" alt="19">
    		</a>
    		
    		<a href="images/jb20.jpg" data-lightbox="labor" title="bla">	
    			<img src="images/jb20.jpg" alt="20">
    		</a>
    		
    		<a href="images/jb21.jpg" data-lightbox="labor" title="bla">	
    			<img src="images/jb21.jpg" alt="21">
    		</a>
    		
    		<a href="images/jb22.JPG" data-lightbox="labor" title="bla">	
    			<img src="images/jb22.JPG" alt="22">
    		</a>
    		
    		<a href="images/jb23.JPG" data-lightbox="labor" title="bla">	
    			<img src="images/jb23.JPG" alt="23">
    		</a>
    		
    		<a href="images/jb24.JPG" data-lightbox="labor" title="bla">	
    			<img src="images/jb24.JPG" alt="24">
    		</a>
    		
		</div>
	
	 <ul>
        <li><a href="#O2">Sauerstoffgehalt</a></li>
        <li><a href="#O2%">Sauerstoffs&auml;ttigung</a></li>
        <li><a href="#BSB5">BSB<sub>5</sub>-Wert</a></li>
        <li><a href="#pH">pH-Wert</a></li>
        <li><a href="#Leitfaehigkeit">Leitf&auml;higkeit</a></li>
        <li><a href="#Haerte">H&auml;rte</a></li>
        <li><a href="#NH4">Ammonium/Ammoniak</a></li>
        <li><a href="#NO2">Nitrit</a></li>
        <li><a href="#NO3">Nitrat</a></li>
        <li><a href="#PO4">Phosphat</a></li>
        <li><a href="#Fe">Eisen</a></li>
        <li><a href="#SiO">Silikat</a></li>
        <li><a href="#Temp">Temperatur</a></li>
        <li><a href="#Tiefe">Tiefe</a></li>
        <li><a href="#Sichttiefe">Sichttiefe</a></li>
        <li><a href="#H2S">Schwefelwasserstoff</a></li>
    </ul>
<div class="laborText"> 

<div class="bildContainer" >
<a href="images/jb1.JPG" data-lightbox="labor" title="bla">	
    			<img src="images/jb1.JPG" alt="1">
    		</a>
</div>
        <h2><u>Chemische Untersuchung des Wassers</u></h2>
        
        <p id="O2"><b> Sauerstoffgehalt (nach Merck) </b></p>
        	
    <ol>
        <li>Eine Glasflasche, in der sich Glaskugeln befinden, wird mehrmals mit  dem zu untersuchenden <b>Wasser</b> ausgesp&uuml;lt, dann bis zum <b>&uuml;berlaufen mit diesem Wasser gef&uuml;llt.</b>
        </li>
        <li>
      <b>5 Tropfen Reagenz 1 (Mangan(II)-chlorid) und Reagenz 2 (Natriumhydroxid)</b> werden dazu gegeben, dann wir das Gef&auml;&szlig; mit einem Glasstopfen verschlossen, gut gesch&uuml;ttelt und f&uuml;r <b>1 Minute</b> stehen gelassen.
        <b>10 Tropfen Reagenz 3 (Schwefels&auml;ure)</b> zugeben, verschlie&szlig;en und gut sch&uuml;tteln.
        </li>
        <li>Messgef&auml;&szlig; mit der L&ouml;sung aussp&uuml;len und mit <b>5 ml f&uuml;llen.</b>
        </li>
        <li><b>1 Tropfen Reagenz 4</b>  zugeben und sch&uuml;tteln. Die F&auml;rbung wird  je nach S&auml;ttigung <b>Violett</b> bis <b>Blau.</b>
        </li>
        <li>    Titrierpipette herausnehmen und bis zur<b> 0  mit Reagenz 5 </b>aufziehen.
        </li>
        <li>Pipette abstreifen, dann unter Schw&auml;nken des Gef&auml;&szlig;es langsam mehr Reagenz 5 dazugeben, bis ein Farbumschlag von <b>blau zu farblos</b> stattfindet.
        </li>
        <li>Sauerstoffgehalt des Wassers auf der Skala der Pipette ab    </li>
     </ol>
        
        <p><span style="color:red">Wichtig!</span> Der Sauerstoffwert muss direkt  nach der Entnahme gemessen werden, da sich dieser sonst ver&auml;ndert. </p>
</div>
     
<div class="laborText">  

<div class="bildContainer" >
<a href="images/jb2.JPG" data-lightbox="labor" title="bla">	
    			<img src="images/jb2.JPG" alt="2">
    		</a>
</div>
        <p id="O2%"><b> Sauerstoffs&auml;ttigung  </b></p>
        <p>Der Wert wird mit Hilfe einer Tabelle aus den Werten der Temperatur und des Sauerstoffgehaltes ermittelt.</p>
        
         
        
        <p id="BSB5"><b> BSB<sub>5</sub>-Wert </b></p>
        <p>Zeigt an wie viel Sauerstoff innerhalb von <b>5 Tagen</b> in kompletter Abschirmung von Licht und anderen &auml;u&szlig;eren Einfl&uuml;ssen verbraucht wird. Dieses nennt man den<b> Biochemischen Sauerstoffbedarf.</b></p>
        <p>Hier zu muss eine Wasserprobe entnommen werden, die in einem Beh&auml;lter, der halb gef&uuml;llt ist, befindet. Dieser Beh&auml;lter wird gesch&uuml;ttelt um die Probe mit Sauerstoff zu s&auml;ttigen. Die mit Sauerstoff ges&auml;ttigte             Probe wird in 2 <b>luftleeren</b> Beh&auml;lter gef&uuml;llt, an der einen wird der Sauerstoffgehalt gemessen, die andere wird mit Alufolie umwickelt um diese abzudunkeln und bei <b>20C, 5 Tage</b> ruhen gelassen, danach wird hier auch der Sauerstoffgehalt ermittelt. Der BSB<sub>5</sub> Wert wird dann aus der Differenz der beiden Werte ermittelt und in <b>mg O2/l</b> angegeben.</p>
</div>    
     
<div class="laborText1">    

<div class="bildContainer" >
<a href="images/jb3.JPG" data-lightbox="labor" title="bla">	
    			<img src="images/jb3.JPG" alt="3">
    		</a>
</div>
        <p id="pH"><b> pH-Wert (nach Merck)<sup>1</sup> </b></p>
        <p>Die Bestimmung des pH-Wertes erfolgt am einfachsten kolorimetrisch mit einem Schnellbestimmungssatz (Universalindikator mit geeigneten Abstufungen im mittleren Bereich). Dazu werden zwei Gl&auml;ser mit <b>5ml</b> der Wasserprobe gef&uuml;llt. Dann wird in eines der Gl&auml;ser <b>ein Tropfen pH-1</b> gegeben und gemischt. Mit Hilfe des anderen Glases zum Abgleich wird der Messwert an der Farbskala abgelesen. </p>
</div>    
     
<div class="laborText">    

<div class="bildContainer" >
<a href="images/jb4.JPG" data-lightbox="labor" title="bla">	
    			<img src="images/jb4.JPG" alt="4">
    		</a>
</div>
        <p id="Leitfaehigkeit"><b> Leitf&auml;higkeit </b></p>
        <ol>
        <li>&quot;Glf 100&quot; mit On Knopf einschalten.
        </li>
        <li>Schutzkappe abziehen.
        </li>
        <li>Messstab in das zu pr&uuml;fende Wasser halten. Es wird ein Ergebnis in <b>mikro Siemens (MikroS) </b>angegeben.
        </li>
        </ol>
</div>    
    
<div class="laborText"> 

<div class="bildContainer" >
<a href="images/jb5.JPG" data-lightbox="labor" title="bla">	
    			<img src="images/jb5.JPG" alt="5">
    		</a>
</div>
       <p id="Haerte"><b> H&auml;rte (nach Merck) </b></p>
        <ol>
        <li>Testglas mehrmals  mit der Probe aussp&uuml;len.
        </li>
        <li><b>5m</b>l der Wasserprobe in ein Testglas geben.
        </li>
        <li><b>3 Tropfen</b> des Reagenz H-1 zugeben, bei einer Anwesenheit von H&auml;rtebildnern f&auml;rbt sich die L&ouml;sung rot.
        </li>
        <li>Die Pipette bis zur <b>0 Markierung</b> mit Reagenz H-2 auff&uuml;llen.
        </li>
        <li>Langsam unter Schw&auml;nken Reagenz H-2 dazu geben bis sich die L&ouml;sung &uuml;ber Grauviolett zu <b>Gr&uuml;n</b> f&auml;rbt, bei Gr&uuml;nf&auml;rbung den Wert an der Pipette ablesen, der Wert wird in <b>mg/l CaCO3</b> angegeben.
        </li>
        </ol>
</div>    
     
<div class="laborText">    

<div class="bildContainer" >
<a href="images/jb6.jpg" data-lightbox="labor" title="bla">	
    			<img src="images/jb6.jpg" alt="6">
    		</a>
</div>
        <p id="NH4"><b> Ammonium /Ammoniak (nach Merck) <sup>1</sup> </b></p>
        <p>F&uuml;r die Messung werden zwei Gl&auml;ser mit 20 ml der Wasserprobe gef&uuml;llt. In eines wird zuerst<b> 2,5 ml</b> NH4-1 getropft und dann <b>ein L&ouml;ffel</b> von NH4-2 gegeben. Nach gr&uuml;ndlichem Sch&uuml;tteln muss die L&ouml;sung <b>5 Minuten</b> stehen bleiben. Danach werden <b>zwei Tropfen</b> NH4-3 in das Glas gegeben und wieder gesch&uuml;ttelt. Nach weiteren <b>7 Minuten</b> Wartezeit kann der Messwert &uuml;ber den Farbabgleich bestimmt werden. Das zweite Glas, in dem sich nur die Wasserprobe befindet, wird als Orientierung genutzt.</p>
        <p><span style="color:red">Wichtig!</span>  Probekasten nach <b>Ne&szlig;ler!</b></p>
</div>    
     
 <div class="laborText">   
 
 <div class="bildContainer" >
 <a href="images/jb7.jpg" data-lightbox="labor" title="bla">	
    			<img src="images/jb7.jpg" alt="7">
    		</a>
</div>
        <p id="NO2"><b> Nitrit (nach Merck) </b></p>
        <ol>
        <li>Beide Testgl&auml;ser bis zur Marke <b>(20ml)</b> f&uuml;llen.
        </li>
        <li><b>1 gestrichenen Mikrol&ouml;ffel </b>No2-1 (Sulfanils&auml;ure) dazugeben, in ein Test Glas und mit geschlossenem Deckel kr&auml;ftig sch&uuml;tteln bis alles gel&ouml;st ist.
        </li>
        <li>pH-Wert von der L&ouml;sung messen, er sollte zwischen<b> 2 und 2,5</b> liegen, wenn er au&szlig;erhalb dieses Bereiches liegt mit Natronlauge oder Schwefels&auml;ure einstellen.
        </li>
        <li>Farbkarte soweit durchschieben bis Farben bestm&ouml;glich &uuml;bereinstimmen und dann Wert auf der Unterseite der Farbkarte ablesen.
        </li>
        </ol>
</div>    
     
<div class="laborText">

<div class="bildContainer" >
<a href="images/jb8.jpg" data-lightbox="labor" title="bla">	
    			<img src="images/jb8.jpg" alt="8">
    		</a>
</div>
        <p id="NO3"><b> Nitrat (nach Merck) <sup>1</sup> </b></p>
        <ol>
        <li>Beide Gl&auml;ser mit <b>5 ml</b> der Wasserprobe f&uuml;llen.
        </li>
         <li><b>2 gestrichene gr&uuml;ne Mikrol&ouml;ffel</b> N03 -1 in Glas 2 geben.
        </li>
         <li>Glas <b>1 Minute</b> sch&uuml;tteln.
        </li>
         <li><b>5 min</b> stehen lassen.
        </li>
         <li>Farbe der Farbskala zuordnen, Messwert ablesen.
        </li>
        </ol>
</div>    
     
<div class="laborText">

<div class="bildContainer" >
<a href="images/jb9.JPG" data-lightbox="labor" title="bla">	
    			<img src="images/jb9.JPG" alt="9">
    		</a>
</div>
        <p id="PO4"><b> Phosphat (nach Merck) <sup>1</sup> </b></p>
        <ol>
        <li>Beide Gl&auml;ser bis zur Markierung mit Wasserprobe (5&deg;-35&deg;C) f&uuml;llen.
        </li>
         <li>Inneres Glas mit <b>10 Tropfen</b> P-1A versetzen und mischen.
        </li>
         <li>Inneres Glas mit <b>1 gestrichenen Mikrol&ouml;ffel</b> P-2A versetzen und l&ouml;sen.
        </li>
         <li>Farbabgleich nach <b>1 Minute.</b>
        </li>
        </ol>
</div>    
     
<div class="laborText">   

<div class="bildContainer" >
<a href="images/jb10.JPG" data-lightbox="labor" title="bla">	
    			<img src="images/jb10.JPG" alt="10">
    		</a>
</div>
        <p id="Fe"><b> Eisen (nach Merck) </b></p>
        <ol>
        <li>Jeweils <b>10 ml</b> Wasserprobe in beide Testgl&auml;ser geben.
        </li>
        <li><b>3 Tropfen</b> Reagenz Fe-1 zu einer der Messproben zugeben und mit verschlossenen Deckel mischen.
        </li>
        <li><b>3 Minuten</b> stehen lassen.
        </li>
        <li>Farbkarte soweit durchschieben bis Farben bestm&ouml;glich &uuml;bereinstimmen und dann Wert auf der Unterseite der Farbkarte ablesen.
        </li>
        </ol>
</div>    
     
<div class="laborText"> 

<div class="bildContainer" >
<a href="images/jb11.JPG" data-lightbox="labor" title="bla">	
    			<img src="images/jb11.JPG" alt="11">
    		</a>
</div>
        <p id="SiO"><b> Silikat (nach Merck) </b></p>
        <ol>
        <li><b>20 ml</b> Wasserprobe in beide Testgl&auml;ser geben.
        </li>
        <li><b>3 Tropfen </b>Reagenz S-1 dazugeben.
        </li>
        <li>L&ouml;sung mit geschlossenem Deckel sch&uuml;tteln.
        </li>
        <li>pH-Wert messen, muss zwischen <b>1.2 und 1.6</b> liegen.
        </li>
        <li><b>3 Minuten </b>reagieren lassen.
        </li>
        <li><b>3 Tropfen</b> Reagenz S-2 dazugeben.
        </li>
        <li><b>10 Tropfen</b> Reagenz S-3 dazugeben.
        </li>
        <li>L&ouml;sung mit geschlossenem Deckel sch&uuml;tteln.
        </li>
        <li><b>2 Minuten </b>reagieren lassen.
        </li>
        <li>Farbkarte soweit durchschieben bis Farben bestm&ouml;glich &uuml;bereinstimmen und dann Wert auf der Unterseite der Farbkarte ablesen.
        </li>
        </ol>
</div>    
     
<div class="laborText">    

<div class="bildContainer" >
<a href="images/jb12.JPG" data-lightbox="labor" title="bla">	
    			<img src="images/jb12.JPG" alt="12">
    		</a>
</div>
        <h2><u>Untersuchung der physischen Faktoren des Wassers</u></h2>
        
        <br>
        
        <p id="Temp"><b> Temperatur </b></p>
        <p>Die Temperatur wird durch einen normalen analogen <b>Thermometer</b> festgestellt.</p>
        
         
        
        <p id="Tiefe"><b> Tiefe </b></p>
        <p>Die Tiefe wird an dem Ansatz des Schilfg&uuml;rtels zum Wasser mit Hilfe eines <b>Stabes</b> und <b>Ma&szlig;band</b> gemessen.</p>
        
         
        
        <p id="Sichttiefe"><b> Sichttiefe </b></p>
        <p>Bei der Sichttiefenmessung wird die <b>Secchi-Scheibe</b> an einen <b>Ma&szlig;band</b> befestigt, danach wird die Scheibe in das Wasser gelassen bis sie nicht mehr zu sehen ist. Der Wert wird von dem Ma&szlig;band direkt an der Wasseroberfl&auml;che abgelesen. </p>
        <p><span style="color:red">Wichtig!</span>Messung im Schatten durchf&uuml;hren und einen konstanten Abstand zwischen Augen des Betrachters und Wasseroberfl&auml;che bewahren.</p>
</div>    
     
<div class="laborText">   

<div class="bildContainer" >
<a href="images/jb13.JPG" data-lightbox="labor" title="bla">	
    			<img src="images/jb13.JPG" alt="13">
    		</a>
</div>
        <h2><u>Untersuchung der Sedimentwasserprobe</u></h2>
        
        <br>
        
        <p>Das Rohr (mit Netzstrumpf an einem und Zylinder und Kolben einer Spritze an dem anderen Ende) wird mit dem Ende, an dem der Netzstrumpf befestigt ist, so tief wie m&ouml;glich in das Sediment gedr&uuml;ckt. Wenn das Ende im Sediment ist,  wird der Kolben der Spritze <b>sehr langsam</b> nach oben gezogen, so dass der Kolben sich mit tr&uuml;ben Sedimentwasser f&uuml;llt.</p>
        
        <p>Das entnommene Sedimentwasser wird auf folgende chemische Parameter untersucht:<b> pH-Wert, Ammonium, Nitrat, Sauerstoff und Schwefelwasserstoff</b></p>
        
        <p id="H2S"><b> Schwefelwasserstoffprobe:  </b></p>
        <ol>
        <li><b>6 ml</b> Wasserprobe in beide Testgl&auml;ser geben.
        </li>
        <li><b>1 Tropfen</b> Reagenz S-1 dazu geben.
        </li>
        <li><b>5 Tropfen</b> Reagenz S-2 dazu geben.
        </li>
        <li><b>5 Tropfen</b> Reagenz S-3 dazu geben.
        </li>
        <li>Beide Messgl&auml;ser in die entsprechenden &ouml;ffnungen stellen, <b>Farbe abgleichen</b> und Wert ablesen.
        </li>
        </ol>
</div>    
     
<div class="laborText">   

<div class="bildContainer" >
<a href="images/jb14.JPG" data-lightbox="labor" title="bla">	
    			<img src="images/jb14.JPG" alt="14">
    		</a>
</div>
        <h2><u>Morphologische Untersuchung des Schilfes</u></h2>
        <p>Die folgenden Untersuchungen werden an <b>50 zuf&auml;llig ausgew&auml;hlten Schilffpflanzen</b> durchgef&uuml;hrt.</p>
        <ol>
        <li>Halml&auml;nge (Unter- und &uuml;berwasser)
        </li>
         <li>Breite Unten 
        </li>
         <li>Breite Mitte
        </li>
         <li>Bl&auml;tterbreite (2. Blatt von unten)
        </li>
         <li>L&auml;nge vom Blatt (2. Blatt von unten)
        </li>
         <li>Anzahl der Bl&auml;tter
        </li>
         <li>Nodienanzahl
        </li>
         <li>Rispenl&auml;ngen (falls vorhanden)
        </li>
        </ol>
</div> 
</div--> 
   
</div>

<div id="surfaceContent" class="registerContent">
    <!--h2 >Zu den <a href="?site=chemischewerte&tab=w">Ergebnistabellen</a> und den <a href="?site=diagramme">Diagrammen</a></h2-->
    <!--?php include("chemischewerte.php"); ?--> 
    <?php 
    //OBERFLÄCHENWASSER
    
    	//Sortieroptionen, die nach Anklicken in der URL in orderby gespeichert werden	
                 echo('<p>Sortieren nach Standort (
                    <a href="?site=wasser&register=surface&orderby=1">flussaufw&auml;rts</a> / 
                    <a href="?site=wasser&register=surface&orderby=2">flussabw&auml;rts</a> ) oder Datum ( 
                    <a href="?site=wasser&register=surface&orderby=3">aufsteigend</a> /
                    <a href="?site=wasser&register=surface&orderby=4">absteigend</a> )
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
            		<th style="background:#BDBDBD;" title="Sauerstoffs&auml;ttigung">O<sub>2</sub>S&auml;t</th>
            		<th style="background:#BDBDBD;" title="BSB5-Wert">BSB5</th>
            		<th style="background:#BDBDBD;" title="pH-Wert">pH</th>
            		<th style="background:#BDBDBD;" title="Sichttiefe">Sicht</th>
            		<th style="background:#BDBDBD;" title="Leitf&auml;higkeit">Leitf.</th>
            		<th style="background:#BDBDBD;" title="Wasserh&auml;rte">H&auml;rte</th>
                    <th style="background:#BDBDBD;" title="Ammoniumgehalt">NH<sub>4</sub><sup>+</sup></th>
                    <th style="background:#BDBDBD;" title="Nitritgehalt">NO<sub>2</sub><sup>-</sup></th>
                    <th style="background:#BDBDBD;" title="Nitratgehalt">NO<sub>3</sub><sup>-</sup></th>
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
                
                echo('<div class="tablebody" style="width:98.6%;">
                <table class="tabellesuchergebnisse">
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
		            $zeile['TempW']= round($zeile['TempW'],1);
		            $zeile['O2W']= round($zeile['O2W'],1);
		            $zeile['O2saettigung']= round($zeile['O2saettigung'],0);
		            $zeile['BSB5']= round($zeile['BSB5'],1);
		            $zeile['pHW']= round($zeile['pHW'],1);
		            $zeile['Sichttiefe']= round($zeile['Sichttiefe'],2);
		            $zeile['LeitfaehigkeitW']= round($zeile['LeitfaehigkeitW'],0);
		            $zeile['Haerte']= round($zeile['Haerte'],1);
		            $zeile['NH4W']= round($zeile['NH4W'],3);
		            $zeile['NO2W']= round($zeile['NO2W'],3);
		            $zeile['NO3W']= round($zeile['NO3W'],0);
		            $zeile['PO4W']= round($zeile['PO4W'],3);
		            $zeile['Fe']= round($zeile['Fe'],2);
		            $zeile['SiO2']= round($zeile['SiO2'],2);
		            
		            
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
                        if($zeile['Monat']>=9){
                           echo('<tr style="background-color:#9AFF9A;">');//Oktober Farbe
                        }else{
                           echo('<tr style="background-color:#C4FEC4;">');//Frühjahr Farbe    
                        }
                    }
                    elseif($zeile['Standort']=='Kleiner See'){
                        if($zeile['Monat']>=9){
                           echo('<tr style="background-color:#F4FA58;">'); //Oktober Farbe
                        }else{
                           echo('<tr style="background-color:#F3F697;">'); //Frühjahr Farbe    
                        }
                    }
                    elseif($zeile['Standort']=='Absalonshorst'){
                        if($zeile['Monat']>=9){
                           echo('<tr style="background-color:#FF8C69;">'); //Oktober Farbe
                        }else{
                           echo('<tr style="background-color:#FABCA9;">'); //Frühjahr Farbe    
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
    
    ?>
    
        <p>Legende: hell hinterlegte Zeilen sind Fr&uuml;hjahrswerte, dunkle Herbstwerte </p>
    </div>
</div>

<div id="sedimentContent" class="registerContent">
    <!--h2 >Zu den <a href="?site=chemischewerte&tab=w">Ergebnistabellen</a> und den <a href="?site=diagramme">Diagrammen</a></h2-->
    <!--?php include("chemischewerte.php"); ?-->
    <?php
    
    //SEDIMENTWASSER
    
     //Sortieroptionen, die nach Anklicken in der URL in orderby gespeichert werden	
                //Sortieroptionen, die nach Anklicken in der URL in orderby gespeichert werden	
                echo('<p>Sortieren nach Standort (
                    <a href="?site=wasser&register=sediment&orderby=1">flussaufw&auml;rts</a> / 
                    <a href="?site=wasser&register=sediment&orderby=2">flussabw&auml;rts</a> ) oder Datum ( 
                    <a href="?site=wasser&register=sediment&orderby=3">aufsteigend</a> /
                    <a href="?site=wasser&register=sediment&orderby=4">absteigend</a> )
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
                        LeitfaehigkeitS, TempS, MONTH(Datum) AS Monat, YEAR(Datum) AS Jahr
                    FROM chemischeParameter
                    ORDER BY StandortID DESC, Datum DESC';
                    
	
	}
	
	/*FLUSSABWÄRTS*/
    else if($orderby=="2"){   
    
    //Die Ergebnisse werden nach dem Standort sortiert mithilfe der StandortID, die flussabwärts steigt; dann nach dem Datum
    $anfrage = 'SELECT Standort, Datum, pHS, NH4S, NO2S, NO3S, PO4S, O2S, H2S, SO4S, 
                        LeitfaehigkeitS, TempS, MONTH(Datum) AS Monat, YEAR(Datum) AS Jahr
                    FROM chemischeParameter
                    ORDER BY StandortID ASC, Datum DESC';
    
   
	}
	 
	/*ZEITLICH VORWÄRTS*/
    else if($orderby=="3"){   
    
        $anfrage = 'SELECT Standort, Datum, pHS, NH4S, NO2S, NO3S, PO4S, O2S, H2S, SO4S, 
                        LeitfaehigkeitS, TempS, MONTH(Datum) AS Monat, YEAR(Datum) AS Jahr
                    FROM chemischeParameter
                    ORDER BY Datum ASC
                    '; 
    }
    
    /*ZEITLICH RÜCKWÄRTS*/    
    else if($orderby=="4"){            
        $anfrage = 'SELECT Standort, Datum, pHS, NH4S, NO2S, NO3S, PO4S, O2S, H2S, SO4S, 
                        LeitfaehigkeitS, TempS, MONTH(Datum) AS Monat, YEAR(Datum) AS Jahr
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
		            
		            $zeile['pHS']= round($zeile['pHS'],1);
		            $zeile['NH4S']= round($zeile['NH4S'],3);
		            $zeile['NO2S']= round($zeile['NO2S'],3);
		            $zeile['NO3S']= round($zeile['NO3S'],0);
		            $zeile['PO4S']= round($zeile['PO4S'],3);
		            $zeile['O2S']= round($zeile['O2S'],1);
		            $zeile['H2S']= round($zeile['H2S'],1);
		            $zeile['SO4S']= round($zeile['SO4S'],0);
		            $zeile['LeitfaehigkeitS']= round($zeile['LeitfaehigkeitS'],0);
		            $zeile['TempS']= round($zeile['TempS'],1);
		            
		            //Anmekrungen als Fußnoten für falsche Messwerte
		            if($zeile['Jahr']=='2009' || $zeile['Jahr']=='2010'){
                        $zeile['NH4S']=$zeile['NH4S'].'<sup>  1)</sup>'; 
                    }
					 
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
                        if($zeile['Monat']>=9){
                           echo('<tr style="background-color:#9AFF9A;">');//Oktober Farbe
                        }else{
                           echo('<tr style="background-color:#C4FEC4;">');//Frühjahr Farbe    
                        }
                    }
                    elseif($zeile['Standort']=='Kleiner See'){
						if($zeile['Monat']>=9){
                           echo('<tr style="background-color:#F4FA58;">'); //Oktober Farbe
                        }else{
                           echo('<tr style="background-color:#F3F697;">'); //Frühjahr Farbe    
                        }
                    }
                    elseif($zeile['Standort']=='Absalonshorst'){
                        if($zeile['Monat']>=9){
							echo('<tr style="background-color:#FF8C69;">'); //Oktober Farbe
                        }else{
                           echo('<tr style="background-color:#FABCA9;">'); //Frühjahr Farbe    
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
                    
    ?>
        <p>Legende: hell hinterlegte Zeilen sind Fr&uuml;hjahrswerte, dunkle Herbstwerte </p>
         <p>1) Ammoniumwerte 2009 und 2010 im Sediment sind ung&uuml;ltig, da Messkoffer (nicht mit Nesslers Reagenz gemessen) keine verwertbaren Ergebnisse geliefert hat. Es lagen im Sedimentwasser offensichtlich St&ouml;rfaktoren vor. </p>
    
</div>


<div id="diagramsContent" class="registerContent">
    <?php include("diagramme.php"); ?>
</div>
    
<div id="discussionContent" class="registerContent">
    <p>Es werden die Messwerte der einzelnen Standorte dargestellt. Eine Auswertung im Sinne einer Zuweisung von relevanten Faktoren, die das Wachstum positiv oder negativ beeinflussen kann nicht erfolgen.</p>
    <p>Zum Beispiel ist der Nitratgehalt im Sediment im Kleinen See und in Gro&szlig; Sarau ist sehr hoch. Das Schilfwachstum ist aber extrem unterschiedlich. Gleiches trifft auf den Schwefelwasserstoffgehalt im Sediment zu.</p>
</div>    
    <!--a href="http://www.biochem.uni-luebeck.de/public/publications/Tan_et_al_JVI_2013.pdf" target="_blank">Beispiel</a-->
</div>