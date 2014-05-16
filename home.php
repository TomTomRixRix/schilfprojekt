<!--Dies ist die Home-Seite. Hierhin wird man weitergeleitet, wenn man auf der index.php-Seite ist. Sie dient als Startseite.-->
<div name="home">
    
    <!--Counter, wir viele Leute die Startseite der Homepage schon aufgerufen haben -->
    <?php
				//Anbindung zur Datenbank
                include('datenbank.php');
				
               $anfrage = 'SELECT counter FROM statistik LIMIT 1';
                    
                $ergebnis = mysql_query($anfrage) 
				or die('Anfrage schlug fehl: '.mysql_error());
				while($zeile = mysql_fetch_assoc($ergebnis)){
				    $counter=$zeile['counter']; 
				    $counter=$counter+1;
				    $anfrageUpdaten = 'UPDATE statistik SET counter='.$counter.'';
				    $ergebnisUpdaten = mysql_query($anfrageUpdaten) 
				    or die('Anfrage schlug fehl: '.mysql_error());
				}
				
    ?>
    
  <!-- Beschreibung des Schilfprojektes-->

<div>

<h2 id="homeTexthead">Schilfr&uuml;ckgang an der Wakenitz </h2>


<img  src="images/schilflogo_hd.jpg" alt="Logo des  Wakenitz-Projektes" style="float:right; height:200px; padding: 0px 10px 0px 20px;">
<p>In ganz Europa ist ein R&uuml;ckgang der Schilfbest&auml;nde zu beobachten. Auch bei uns an der Wakenitz ist dieser Prozess schon seit mehren Jahren zu erkennen. </p>
<p>Um dies zu dokumentieren und nach Ursachen zu suchen, erforschen bereits seit 2009 Sch&uuml;lergruppen unserer Schule unter Anleitung und Begleitung ihrer Biologielehrer/innen und Vertretern der Universit&auml;t ausgew&auml;hlte Schilfbest&auml;nde. Dazu werden an den Untersuchungsstandorten Eichholz, Kleiner See, Absalonshorst und zum Vergleich in Gro&szlig; Sarau und seit 2013 an dem Standort Wallbrechtbr&uuml;cke Daten abiotischer und biotischer Parameter erhoben. </p>
<p>In unserem Vorhaben unterst&uuml;tzt uns die Sch&uuml;lerakademie der Universit&auml;t zu L&uuml;beck, gef&ouml;rdert durch die Possehl-Stiftung, wof&uuml;r wir uns sehr herzlich bedanken.</p>


</div>



<script type="text/javascript">
    //Wenn man auf der Home-Seite ist, dann sollen in der SideBar die Termine angezeigt werden. Der div-Container der Termine ist normalerweise mit CSS display:hide; verschwunden und wird hier visible gemacht
    $("#termine").show();
    
    //Nur wenn man auf der Home-Seite ist, soll der weiße Hintergrund der Headline animiert einfliegen 
    $( "#HeadlineBackground" ).css( "animation"," einfliegenVonOben 3s");
    
    //Außerdem soll nur auf der Home-Seite die SideBar vor vornherein angezeigt werden. Deshalb wird hier mit JQuery die SideBar  auf 22% Breite verändert und er Inhalt wird sichtbar gemacht. Der center-Bereich bekommt statt 100% Breite jetzt nur noch 75% zugewiesen
    $("#SideBar").width("22%");
    $("#center").width("75%");
    $("#center").css("border-radius","25px 0px 0px 25px");
    $("#SideBar").show();
    $(window).load(function(){
        $("#SideBar").height($("#center").height());
    });
    
</script>
<br>


  <!--SlideBox mit den NewsArtikeln. Die Newsartikel sind in der Datenbank gespeichert. Die SlideBox zeigt immer abwechselnd einen der fünf neusten Artikel an. Mit den Pfeilen, die angezeigt werden, wenn man über die linke bzw. rechte Hälfte hovert, oder mit den Punkten am unteren Rand kann man zwischen den Artikel navigieren. -->
	<div id="slideBoxArtikel" >
		<div id="slideBoxPfeileMitContent">
			<!--Linke Hälfte. Bei hovern wird Pfeil anezeigt -->
			<div id="lefthalf">
				<!--Bei Klick auf den Pfeil wird previousArtikel() aufgerufen, was per JavaScript den vorherigen Artikel sichtbar macht -->
				<div id="pfeilLinks"></div>
			</div>
			<!--Rechte Hälfte. Bei hovern wird Pfeil anezeigt -->
			<div id="righthalf">
				<!--Bei Klick auf den Pfeil wird nextArtikel() aufgerufen, was per JavaScript den nächsten Artikel sichtbar macht -->
				<div id="pfeilRechts"></div>
			</div>
  

   
   
            <!--Der Inhalt der SlideBox (die 5 neusten Artikel) werden aus der Datenbank geladen -->
			<div id="slideBoxContent">
            
                <?php
				//Anbindung zur Datenbank
                include('datenbank.php');
				
                $anfrage = 'SELECT newsid, titel, einleitung, uploadzeit, bildpfad1, bildtext1
                                FROM newsartikel
                                ORDER BY newsid desc
                                LIMIT 5
                            ';
                    
                $ergebnis = mysql_query($anfrage) 
				or die('Anfrage schlug fehl: '.mysql_error());
				
                //Die $artikelNummer wird auf 0 instanziert und bei jedem Artikel vorher um 1 erhöht, sodass die Artikel die ids "artikel1" bis "artikel5" haben
				$artikelNummer=0;
				
				//Für jede der höchstens 5 Artikel wird diese Ausgabe-Schleife durchlaufen
                while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
				
                    $artikelNummer++;
				
				//Die divs werden zunächst alle auf display:none gesetzt und dann später einzeln mit display:block angezeigt
				echo('
                        <div class="artikel" id="artikel'.$artikelNummer.'" style="display:none;">
                    ');
                
                //wenn die Bilddatei existiert, wird sie angezeigt
                ///////eigentlich/früher newsarticleimages jetzt newsthumbnails
				if(file_exists('newsthumbnails/'.$zeile["bildpfad1"])){
                    echo('
							<img width="200px" height="200px" src="newsthumbnails/'.$zeile["bildpfad1"].'" alt="'.$zeile["bildtext1"].'">
						');
                }else{
					// falls nicht, dann nur die alt-ernative Beschreibung
					echo('
					    <img width="200px" height="200px" src="" alt="'.$zeile["bildtext1"].'">
					');
				}
               
                    /*
					*	Hier wird der Artikel Text, also Überschrift und die Einleitung des Artikels angezeigt
					*	Wenn man den ganzen Text lesen will, dann muss man auf den Weiterlesen... -Link klicken. 
					*	Der leitet einen weiter auf die newsartikel Seite wohin auch die eindeutige newsid des Artikels überliefert wird
					*/
                    echo('      
								<div id="artikelText">  
                                    <div id="artikelHead">
										<p>'.$zeile['titel'].'</p>
									</div>
                                    <div id="artikelBody">
										<p>'.$zeile['einleitung'].'
											<a href="?site=newsartikel&newsid='.$zeile['newsid'].'">Weiterlesen...</a>
                                        </p>
									</div>
                                </div>
                            </div>
                            ');
                }
                ?>
            
        </div>
        
		<!--Die controlPoints sind die Bedienung/Navigationspunkte für die SlideBox. 
		Die Funktionalität wird ihnen per JavaScript gegeben. Zum Beispiel, wenn man auf den Punkt klickt(onclick). -->
        <div id="controlPoints" align="center">
            <div id="pointsCentern">
                <div class="point" id="punkt1"><span>1</span></div>
                <div class="point" id="punkt2"><span>2</span></div>
                <div class="point" id="punkt3"><span>3</span></div>
                <div class="point" id="punkt4"><span>4</span></div>
                <div class="point" id="punkt5"><span>5</span></div>
            </div>
        </div>
    </div>
</div>
        
          <script language="javascript" type="text/javascript">
            /*
			*	Die SlideBox wird hier funktionsfähig/slidefähig gemacht, nachdem die Seite geladen ist
			*/
          $(document).ready(function(){
          
                /*
			    *	Wenn ein Punkt angeklickt wurde, wird der NewsArtikel mit der Nummer, die der Punkt hat, angezeigt.
			    */
                $('.point').click(function(){
                    $(this).css("background-color","black");
                    
                    if($(this).attr('id')=='punkt1'){
                        showArtikelNumber(1);    
                    }else if($(this).attr('id')=='punkt2'){
                        showArtikelNumber(2);    
                    }else if($(this).attr('id')=='punkt3'){
                        showArtikelNumber(3);    
                    }else if($(this).attr('id')=='punkt4'){
                        showArtikelNumber(4);    
                    }else if($(this).attr('id')=='punkt5'){
                        showArtikelNumber(5);    
                    }
                });
          
                /*
    			*	Beim Anklicken des rechten Pfeils wird dies aufgeführt
    			*	Wenn die SlideBox nicht am Ende(bei 5) ist, dann wird der nächsthöhere Artikel aufgerufen
    			*	Ansonsten der erste
    			*/
                $('#pfeilRechts').click(function(){
                    nextArtikel();
                });
                
                /*
    			*	Beim Anklicken des linken Pfeils wird dies aufgeführt
    			*	Wenn die SlideBox nicht am Anfang(bei 1) ist, dann wird der nächst niedrigerere Artikel aufgerufen
    			*	Ansonsten der letzte
    			*/
                $('#pfeilLinks').click(function(){
                    previousArtikel();
                });
                
                /*
				*	Dies wird aufgerufen, um den rechten Pfeil anzuzeigen.
				*	Außerdem wird dann die Höhe der rechten Hover-Fläche auf 0 gesetzt, damit weiterhin der Text und die Links dahinter zugänglich sind.  
				*   Zusätzlich wird dadurch erreicht, dass die Maus wieder außerhalb der Fläche ist, wodurch direkt hideRight() aufgerufen wird,dass aber ein Delay besitzt.
				*/
                $('#righthalf').mouseover(function(){
                    $('#pfeilRechts').show();
					$('#righthalf').css("height","0");
                });
                
                /* 
				*   Dies lässt nach 1 Sekunde den Pfeil wieder verschwinden und setzt die Höhe wieder auf 100% , sodass man wieder drüberhovern kann.
				*/
                $('#righthalf').mouseout(function(){
                    
                    setTimeout(function() {
                    
                        $('#pfeilRechts').hide();
					    $('#righthalf').css("height","100%");
                    }, 1000);
                });
                
                /*
				*	Dies wird aufgerufen, um den linken Pfeil anzuzeigen.
				*	Außerdem wird dann die Höhe der linke Hover-Fläche auf 0 gesetzt, damit weiterhin der Text und die Links dahinter zugänglich sind. 
				*   Zusätzlich wird dadurch erreicht, dass die Maus wieder außerhalb der Fläche ist, wodurch direkt hideLeft() aufgerufen wird, dass aber ein Delay besitzt.
				*/
                $('#lefthalf').mouseover(function(){
                    $('#pfeilLinks').show();
					$('#lefthalf').css("height","0");
                });
                
                /* 
				*   Dies lässt nach 1 Sekunde den Pfeil wieder verschwinden und setzt die Höhe wieder auf 100% , sodass man wieder drüberhovern kann.
				*/
                $('#lefthalf').mouseout(function(){
                    setTimeout(function() {
                        $('#pfeilLinks').hide();
					    $('#lefthalf').css("height","100%");
                    }, 1000);
                });
                
                //Die Nummer des aktiven, gerade sichtbaren Artikels wird in activeArtikelNumber gespeichert. Am Anfgang natürlich 0, aber Artikel 1 wird schon angezeigt, sodass Artikel 1 im Prinzip 2 Intervallsequenzen aktiv ist
                var activeArtikelNumber=1;
                $('#artikel1').show();
                
            //In einem Intervall von 8 Sekunden wird die nächsten Artikel aufgerufen    
            setInterval(function(){
                
                /*	Hier findet das Sliden statt. Also das durchwechseln zwischen den Artikeln.
			    *	Am Anfang (wenn die activeArtikelNumber 0 ist) wird der erste Newsartikel angezeigt; mit showArtikelNumber(1);
			    *	Wenn die SlideBox am Ende ist (also bei activeArtikelNumber>=5), dann fängt sie wieder vorne an
			    *	Andernfalls slidet sie durch. Hierzu wird immer die nächsthöhere activeArtikelNumber angezeigt
			    */
                if((activeArtikelNumber<=0)||(activeArtikelNumber>=5)){
                    showArtikelNumber(1);
                }else{
					showArtikelNumber(activeArtikelNumber+1);
				}
            },8000);
            
                /*
    			*	Beim Anklicken des rechten Pfeils wird dies aufgeführt
    			*	Wenn die SlideBox nicht am Ende(bei 5) ist, dann wird der nächsthöhere Artikel aufgerufen
    			*	Ansonsten der erste
    			*/
            function nextArtikel(){
                if(activeArtikelNumber!=5){
                    showArtikelNumber(activeArtikelNumber+1);
                }else{
                    showArtikelNumber(1);
                }
            }
            
            /*
			*	Wird beim Anklicken des linken Pfeils aufgeführt
			*	Wenn die SlideBox nicht am Anfang(bei 1) ist, dann wird der nächst niedrigerere Artikel aufgerufen
			*	Ansonsten der letzte
			*/
            function previousArtikel(){
                if(activeArtikelNumber!=1){
                    showArtikelNumber(activeArtikelNumber-1);
                }else{
                    showArtikelNumber(5);
                }
            }
            
            /*
			*	showArtikelNumber() zeigt den Newsartikel mit der übergebenen artikelNumber 
			*   alle Artikel werden gehidet und nur der mit der richtigen artikelNumber wird angezeigt
			*/
            function showArtikelNumber(artikelNumber){
                
                //Am Anfang werden alle Artikel-Container in JavaScript-Variablen gespeichert
				$('#artikel1').hide();
				$('#artikel2').hide();
				$('#artikel3').hide();
				$('#artikel4').hide();
				$('#artikel5').hide();
				
                if(artikelNumber==1){
                    $('#artikel1').fadeToggle("slow");
                }else if(artikelNumber==2){
                    $('#artikel2').fadeToggle("slow");
                }else if(artikelNumber==3){
                    $('#artikel3').fadeToggle("slow");
                }else if(artikelNumber==4){
                    $('#artikel4').fadeToggle("slow");
                }else if(artikelNumber==5){
                    $('#artikel5').fadeToggle("slow");
                }
                
				//Am Schluss wird dann activeArtikelNumber mit der nun neuen artikelNummer versehen, die jetzt aktiv ist
                activeArtikelNumber=artikelNumber;
                
				//Nun wird noch der richtige Punkt der jetzt aktiven Newsartikels farbig markiert
                setPointsColor(activeArtikelNumber);
            }
            
            /*
			*	Behandelt und aktualisiert die Farbe der Navigationspunkte, je nachdem welcher Newsartikel mit der artikelNumber gerade aktiv ist
			*	Weiß bedeutet inaktiv, schwarz aktiv und grau erscheint beim drüberhovern
			*/
            function setPointsColor(artikelNumber){
				
				//Am Anfang werden alle Punkte in JavaScript-Variablen gespeichert
                $('#punkt1').css("background-color","white");
                $('#punkt2').css("background-color","white");
                $('#punkt3').css("background-color","white");
                $('#punkt4').css("background-color","white");
                $('#punkt5').css("background-color","white");
                
                if(artikelNumber==1){
                    $('#punkt1').css("background-color","black");
                }else if(artikelNumber==2){
                    $('#punkt2').css("background-color","black");
                }else if(artikelNumber==3){
                    $('#punkt3').css("background-color","black");
                }else if(artikelNumber==4){
                    $('#punkt4').css("background-color","black");
                }else if(artikelNumber==5){
                    $('#punkt5').css("background-color","black");
                }
            }
            
          });
    </script>

</div>

