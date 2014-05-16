<!--Auf dieser Seite werden die Forschungsaspekte vorgestellt. Autor:?J&ouml;rg Clement -->
<div name="aspekte" id="aspekte">
<h1 ><u>Forschungsaspekte</u></h1>
<h2>M&ouml;gliche Ursachen des Schilfr&uuml;ckgangs</h2>
<p>Um sich dem Problem des Schilfsterbens zu n&auml;hern, werden entsprechend naturwissenschaftlicher Vorgehensweise zun&auml;chst Hypothesen m&ouml;glicher Einflussfaktoren aufgestellt. Diese werden hier gelistet und kurz erl&auml;utert. </p>   
<p>Einige Faktoren wie beispielsweise der <a href="?site=staerke">St&auml;rkegehalt im Rhizom</a> wurden bereits bestimmt, die <a href="?site=wasser">Wasser- und Sedimentwasserqualit&auml;t</a> werden regelm&auml;&szlig;ig untersucht und einige Parameter sind noch zu betrachten.</p>   
<p>Die Untersuchung dieser Faktoren erfordert &Uuml;berlegungen zum methodischen Vorgehen, eine Ergebnisdarstellung und eine Auswertung (siehe Untersuchungen).  </p>   

    <ul>
        <li ><span id="beschattung" style="color:blue;">Beschattung durch Ufergeh&ouml;lze und/oder Konkurrenz durch krautige Pflanzen</span></li>
        <li ><span id="zerstoerung" style="color:blue;">Direkte Zerst&ouml;rung</span></li>
        <li><span id="insekten" style="color:blue;">Insekten und Pilzbefall</span></li>
        <li ><span id="wasservoegel" style="color:blue;">Fra&szlig;sch&auml;den durch Wasserv&ouml;gel</span></li>
        <li><span id="wirbeltiere" style="color:blue;">Fra&szlig;sch&auml;den durch andere Wirbeltiere</span></li>
        <li ><span id="mechanik" style="color:blue;">Mechanische Sch&auml;digungen</span></li>
        <li><span id="wasserqualitaet" style="color:blue;">Wasserqualit&auml;t (aquatisch - freies Wasser)</span></li>
        <li><span id="wasserstandsfuehrung" style="color:blue;">Ver&auml;nderung der Wasserstandsf&uuml;hrung</span></li>
        <li><span id="sedimentbeschaffenheit" style="color:blue;">Sedimentbeschaffenheit</span></li>
        <li><span id="sedimentwasser" style="color:blue;">Sedimentwasser</span></li>
        <li ><span id="organik" style="color:blue;">Ver&auml;nderung der Sedimente durch Anreicherung von organischem Material</span></li>
        <li><span id="sedimentverdichtung" style="color:blue;">Sedimentverdichtung</span></li>
        <li><span id="genetik" style="color:blue;">Genetische Ursachen</span></li>
        <li ><span id="staerke" style="color:blue;">St&auml;rkegehalt</span></li>
    </ul>
    
<script type="text/javascript">
    
    // Her wird das Ausfahren der genauen Beschreibungen realisiert
    $( document ).ready(function(){         //Wenn Seite geladen ist...
       
       //...soll für jedes Element, was vom Typ SPAN und Teil der Auflistung sein muss,...
        $('#aspekte > ul > li >span').each(function() {
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
		    if(e.target.className == "aspekt laborText" || e.target.nodeName=="SPAN"|| e.target.nodeName=="P"|| e.target.nodeName=="B"|| e.target.nodeName=="U")return;
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
<div id="genauereBeschreibungen" >  

<div class="aspekt laborText" id="beschattung">  
    <div class="bildContainer">
		<a href="images/Kraut.JPG" data-lightbox="aspekte" title="Krautige Pflanzen st&ouml;ren Lichtdurchfluss">	
    		<img src="thumbnails/Kraut.JPG" alt="Krautige Pflanzen st&ouml;ren Lichtdurchfluss">
    		<p class="bildunterschrift">Krautige Pflanzen st&ouml;ren Lichtdurchfluss</p>
    	</a>
    	<a href="images/Erlenbruch.jpg" data-lightbox="aspekte" title="Erlenbruchwald">	
    		<img src="thumbnails/Erlenbruch.jpg" alt="Erlenbruchwald">
    		<p class="bildunterschrift">Erlenbruchwald</p>
    	</a>
    </div>
    <p><b><u>Beschattung durch Ufergeh&ouml;lze und/oder Konkurrenz durch krautige Pflanzen:</u></b></p>
        <p><b>Beurteilung der Wahrscheinlichkeit und Befunde:</b></p>
            <p>Die Beschattung durch Erlen hat in Absalonshorst zugenommen und k&ouml;nnte dort Ursache f&uuml;r den R&uuml;ckgang des Schilfbestandes sein. In Eichholz und am Kleinen See liegen die Best&auml;nde jedoch im vollen Sonnenlicht und werden nicht durch B&auml;ume beschattet, dennoch geht hier das Schilf massiv zur&uuml;ck. </p>
            <p>Die Restbulte der Schilfpflanzen in Eichholz und am Kleinen See werden von Wasserampfer und Erlen besiedelt. Die freigewordenen Wasserfl&auml;chen (Schilfr&uuml;ckgang) werden von Teich und Seerosen besiedelt. </p>
        <p><b>Untersuchte Faktoren:</b></p>
            <p><i>(Es wurde dokumentiert und wird weiter untersucht)</i></p> 
   
</div>

<div class="aspekt laborText" id="zerstoerung">
    <div class="bildContainer">
		<a href="images/zerstoerung.jpg" data-lightbox="aspekte" title="Palmen statt Schilf?">	
    		<img src="thumbnails/zerstoerung.jpg" alt="Palmen statt Schilf?">
    		<p class="bildunterschrift">Palmen statt Schilf?</p>
    	</a>
    </div>
    <p><b><u>Direkte Zerst&ouml;rung durch:</u></b></p>
        <ul>
            <li>Landgewinnung</li>
            <li>Erholungsverkehr</li>
            <li>Stegebau</li>
            <li>Sommermahd</li>
            <li>Uferverbau</li>
        </ul>
        <p><b>Beurteilung der Wahrscheinlichkeit und Befunde:</b></p>
            <p><i>Noch zu bearbeiten!</i></p>
   
</div>

<div class="aspekt laborText" id="insekten">  
    <div class="bildContainer">
		<a href="images/Parasitenkot.JPG" data-lightbox="aspekte" title="Parasitenkot">	
    		<img src="thumbnails/Parasitenkot.JPG" alt="Parasitenkot">
    		<p class="bildunterschrift">Parasitenkot</p>
    	</a>
    </div>
    <p><b><u>Insekten und Pilzbefall:</u></b></p>
        <p><b>Beurteilung der Wahrscheinlichkeit und Befunde:</b></p>
            <p><i>Noch zu bearbeiten!</i></p>
   
</div>

<div class="aspekt laborText" id="wasservoegel">        
    <div class="bildContainer">
		<a href="images/Grauganspaar im Kleinen See.jpg" data-lightbox="aspekte" title="Grauganspaar im Kleinen See">	
    		<img src="thumbnails/Grauganspaar im Kleinen See.jpg" alt="Grauganspaar im Kleinen See">
    		<p class="bildunterschrift">Grauganspaar im Kleinen See</p>
    	</a>
    	<a href="images/Verbissspuren am Schilfspross.jpg" data-lightbox="aspekte" title="Verbissspuren am Schilfspross">	
    		<img src="thumbnails/Verbissspuren am Schilfspross.jpg" alt="Verbissspuren am Schilfspross">
    		<p class="bildunterschrift">Verbissspuren am Schilfspross</p>
    	</a>
    </div>
    <p><b><u>Fra&szlig;sch&auml;den durch Wasserv&ouml;gel:</u></b></p>
        <p><b>Beurteilung der Wahrscheinlichkeit und Befunde:</b></p>
            <p>Die Fra&szlig;sch&auml;den durch G&auml;nse sind insbesondere in Eichholz und im Kleinen See erkennbar. Dieses wurde aber erst in den letzten vier Jahren beobachtet. Der Schilfr&uuml;ckgang ist aber schon l&auml;nger erkennbar.</p>
        <p><b>Untersuchte Faktoren:</b></p>
            <p><i>( Es wurde dokumentiert und auch weiterhin beobachtet)</i></p> 
   
</div>

<div class="aspekt laborText" id="wirbeltiere">
    <p><b><u>Fra&szlig;sch&auml;den durch andere Wirbeltiere:</u></b></p>
        <p><b>Beurteilung der Wahrscheinlichkeit und Befunde:</b></p>
            <p>Bisamratte oder Nutria sind heute nicht mehr an der Wakenitz aktiv.</p>
   
</div>

<div class="aspekt laborText" id="mechanik">
    <div class="bildContainer">
		<a href="images/MechanischeZerstoerung.JPG" data-lightbox="aspekte" title="Mechanische Zerst&uuml;rung">	
    		<img src="thumbnails/MechanischeZerstoerung.JPG" alt="Mechanische Zerst&uuml;rung">
    		<p class="bildunterschrift">Mechanische Zerst&uuml;rung</p>
    	</a>
    </div>
    <p><b><u>Mechanische Sch&auml;digungen durch:</u></b></p>
        <ul>
            <li>Eis und Wellengang</li>
            <li>Treibholz</li>
            <li>M&uuml;ll</li>
            <li>Freizeitaktivit&auml;ten</li>
            <li>Algenmatten oder andere Wasserpflanzen</li>
        </ul>
        <p><b>Beurteilung der Wahrscheinlichkeit und Befunde:</b></p>
            <p><i>Noch zu bearbeiten!</i></p>
   
</div>

<div class="aspekt laborText" id="wasserqualitaet">
    <div class="bildContainer">
		<a href="images/Drainagerohr.JPG" data-lightbox="aspekte" title="Drainagerohr von einem Maisacker direkt in den Erlenbruchwald kurz vor M&uuml;ggenbusch">	
    		<img src="thumbnails/Drainagerohr.JPG" alt="Drainagerohr von einem Maisacker direkt in den Erlenbruchwald kurz vor M&uuml;ggenbusch">
    		<p class="bildunterschrift">Drainagerohr von einem Maisacker direkt in den Erlenbruchwald kurz vor M&uuml;ggenbusch</p>
    	</a>
    </div>
    <p><b><u>Wasserqualit&auml;t (aquatisch - freies Wasser):</u></b></p>
        <p><b>Beurteilung der Wahrscheinlichkeit und Befunde:</b></p>
            <p>Es wurde an allen Standorten eine gute bis sehr gute Wasserqualit&auml;t festgestellt. </p>
            <p>Eine kontinuierliche N&auml;hrsalzzufuhr von den Nebenb&auml;chen f&uuml;hrt zu erheblichem Wuchs der submersen Pflanzen im Wasserk&ouml;rper (Fadenalgen, Kieselalgen, Laichkr&auml;uter, Wasserpest) </p>
        <p><b>Untersuchte Faktoren:</b></p>
            <p>Die Wasserqualit&auml;t wurde untersucht. Eine Korrelation des Schilfr&uuml;ckgangs zu bestimmten Parametern konnte nicht eindeutig festgestellt werden<i>(wurde <a href="?site=wasser">dokumentiert</a> - wird weiter untersucht).</i></p> 

</div>

<div class="aspekt laborText" id="wasserstandsfuehrung">   
 
    <p><b><u>Ver&auml;nderung der Wasserstandsf&uuml;hrung:</u></b></p>
        <p><b>Beurteilung der Wahrscheinlichkeit und Befunde:</b></p>
            <p>Die Wasserst&auml;nde in der Wakenitz werden durch den D&uuml;kerkanal geregelt. Es treten nur geringf&uuml;gige Wasserstandsschwankungen w&auml;hrend der Schneeschmelze oder starken andauernden Niederschl&auml;gen auf. Eine Niedrigwasserphase im Sommer ist nicht zu beobachten. Uferbereiche fallen nicht trocken - deshalb ist wahrscheinlich keine Neubesiedelung durch Aussaat m&ouml;glich.  </p>
        <p><b>Untersuchte Faktoren:</b></p>
            <p>Die Pegelst&auml;nde der Wakenitz aus den letzten 30 Jahren sollten abgefragt werden. </p> 
   
</div>

<div class="aspekt laborText" id="sedimentbeschaffenheit">
    <div class="bildContainer">
		<a href="images/organischesMaterial.jpg" data-lightbox="aspekte" title="Schlammproben nach dem Entfernen des organischen Materials">	
    		<img src="thumbnails/organischesMaterial.jpg" alt="Schlammproben nach dem Entfernen des organischen Materials">
    		<p class="bildunterschrift">Schlammproben nach dem Entfernen des organischen Materials</p>
    	</a>
    </div>
    <p><b><u>Sedimentbeschaffenheit:</u></b></p>
        <p><b>Beurteilung der Wahrscheinlichkeit und Befunde:</b></p>
            <p>Die Sedimente an den untersuchten Standorten sind sehr unterschiedlich. An den Standorten Eichholz und Kleiner See ist ein gro&szlig;er Anteil von organischem Material vorhanden. Besonders das Eichholzer Sediment ist sehr feink&ouml;rnig und schlammig. Der Standort Absalonshorst ist dagegen tonig und enth&auml;lt deutlich weniger organische Stoffe. Gro&szlig; Sarau hat ein sandiges Sediment mit geringem Anteil organischer Stoffe. </p>
        <p><b>Untersuchte Faktoren:</b></p>
            <p>Schlammproben wurden entnommen und die organischen Stoffe im bennofen entfernt.</p> 
            <p>Auch Stechproben zeigen ein sehr unterschiedliches Bild der jeweiligen Standorte.
            <i>(wurde <a href="?site=sediment">dokumentiert</a> - wird weiter untersucht)</i></p> 
   
</div>

<div class="aspekt laborText" id="sedimentwasser">        
    <p><b><u>Sedimentwasser:</u></b></p>
        <p><b>Beurteilung der Wahrscheinlichkeit und Befunde:</b></p>
            <p>Bei den Untersuchungen des Sedimentwassers wurden an den Standorten deutliche Unterschiede festgestellt.</p>
            <p>Eine Korrelation zum Schilfr&uuml;ckgang ist nicht eindeutig feststellbar. Z.T. sind die Ergebnisse widerspr&uuml;chlich. So treten hohe Schwefelwasserstoffwerte in Gro&szlig; Sarau (gutes Schilfwachstum) und im Kleinen See (geringes Schilfwachstum) auf. Auch eine Korrelation zu den Ammoniumwerten ist nicht eindeutig.</p>
        <p><b>Untersuchte Faktoren:</b></p>
            <p>Die Probenentnahme aus dem Sediment (30 cm Tiefe) ist schwierig. Es wurden trotzdem viele Messergebnisse gewonnen und in den Jahren 2009 bis 2011 dokumentiert. Im Jahr 2012 werden regelm&auml;&szlig;ig Messungen durchgef&uuml;hrt und erg&auml;nzt durch die Parameter Nitrit (Sediment), Leitf&auml;higkeit (Sediment) und Wassertemperatur (Sediment). 
            <i>(Es wird weiter untersucht und <a href="?site=wasser&register=sediment">dokumentiert</a>)</i></p> 
   
</div>

<div class="aspekt laborText" id="organik">
    <div class="bildContainer">
		<a href="images/organischesMaterial.jpg" data-lightbox="aspekte" title="Schlammproben nach dem Entfernen des organischen Materials">	
    		<img src="thumbnails/organischesMaterial.jpg" alt="Schlammproben nach dem Entfernen des organischen Materials">
    		<p class="bildunterschrift">Schlammproben nach dem Entfernen des organischen Materials</p>
    	</a>
    </div>
    <p><b><u>Ver&auml;nderung der Sedimente durch Anreicherung von organischem Material:</u></b></p>
        <p><b>Beurteilung der Wahrscheinlichkeit und Befunde:</b></p>
            <p>Durch langj&auml;hrige Eintr&auml;ge von N&auml;hrsalzen aus den Nebenb&auml;chen (Schattiner M&uuml;hlenbach, L&uuml;dersdorfer Graben, Gr&ouml;nau und Niemarker Landgraben) haben die Produzenten (Submerse Wasserpflanzen und Phytoplankton) erhebliche Mengen toter organischer Substanz gebildet. Schlammsedimente haben im langsam flie&szlig;enden Teil der Wakenitz erheblich zugenommen. Betrifft die Standorte Eichholz und Kleiner See.</p>
        <p><b>Untersuchte Faktoren:</b></p>
            <p>Durch langj&auml;hrige Messungen ist die Zufuhr erheblicher N&auml;hrsalzmengen (Nitrat, Ammonium und Phosphat) aus den benannten Nebenb&auml;chen nachgewiesen. </p>
    <p>Die Sedimente an den Standorten wurden untersucht. <i>(Es wurde <a href="?site=sediment">dokumentiert</a> und es wird weiter untersucht) </i></p> 
   
</div>

<div class="aspekt laborText" id="sedimentverdichtung">        
    <p><b><u>Sedimentverdichtung:</u></b></p>
        <p><b>Beurteilung der Wahrscheinlichkeit und Befunde:</b></p>
            <p><i>Noch zu bearbeiten!</i></p>
   
</div>

<div class="aspekt laborText" id="genetik">
    <p><b><u>Genetische Ursachen:</u></b></p>
        <p><b>Beurteilung der Wahrscheinlichkeit und Befunde: <a href="?site=genanalyse">siehe hier</a></b></p>
            <p><i>Noch zu bearbeiten!</i></p>
   
</div>

<div class="aspekt laborText" id="staerke">
    <p><b><u>St&auml;rkegehalt im Rhizom:</u></b></p>
        <p><b>Beurteilung der Wahrscheinlichkeit und Befunde: <a href="?site=staerke">siehe hier</a></b></p>
            <p><i>Noch zu bearbeiten!</i></p>
   
</div>
</div>
</div>