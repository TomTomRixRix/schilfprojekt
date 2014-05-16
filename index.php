
<html>

<!-- 
Diese index.php Seite ist die Hauptwebsite, in die alle anderen Unterseiten integriert.
-->

<head>
	<title>Schilfprojekt</title>
    <!--Die keywords sind dafür, dass man die Schilfwebsite in Suchmaschinen findet.-->
	<meta name="keywords" content="Schilf, Schilfsterben, Thomas, Mann, Schule, Gymnasium, TMS, LOLA, Possehl, Stiftung, LIaS">
    
    <!--Hier wird der Zeichensatz definiert. 
	Dieser Zeichensatz stimmt mit dem der angeschlossenen Datenbank überein.
	Jedoch beduetet dies, dass für deutsche Buchtstaben und Sonderzeichen Tricks verwendet werden müssen. Zum Beispiel:
	ä wird in html durch &auml; erzeugt, die Großbuchstaben Ä durch &Auml; 
	ö &ouml; Ö &Ouml;
	ü &uuml; Ü &Uuml;
	ß durch &szlig; -->
    <meta http-equiv="content-type" content="text/html" charset="ISO-8859-1">     <!--charset=ISO-8859-1-->
    
    <!--Das Stylesheet (stylesheet.css) für die Hauptseiten wird hier eingebunden-->
	<link href="stylesheet.css" type="text/css" rel="stylesheet"/>
    
    <!--Das Stylesheet (newnavigationcss.css) für die Navigationsleiste wird hier eingebunden-->
    <link href="navi.css" type="text/css" rel="stylesheet"/>
    
    <!--Hier wird der Icon eingebunden, der bei vielen Browsern im Tab oder bei Lesezeichen für die Schilfwebsite angezeigt wird-->
    <link rel="shortcut icon" href="./images/SchilfIcon_transparent.ico" type="image/x-icon"/>
    <link rel="icon" href="./images/SchilfIconAnimation.gif" type="image/gif"/>
    <!--Hier die animierte Version, die aber nicht bei allen Browsern geht-->
    
    
    <!--Die Vollbildfunktion wird durch die lightbox-Bibliothek unterstützt, die hier durch JavaScript und CSS eingebunden wird.-->
	<script src="lightbox/js/jquery-1.10.2.min.js"></script>
    <script src="lightbox/js/lightbox-2.6.min.js"></script>
    <link href="lightbox/css/lightbox.css" type="text/css" rel="stylesheet"/>   
    
    
</head>


<body align="center">
    <?php
    //Die Session wird gestartet. Die Session ist später wichtig für die Login-Funktion für den Admin-Bereich. Durch sogenannte SESSION-Variablen können dann 
    session_start();
    ?>

    
	<div id="Header">
		<div id="Headline">
            <!--Über die ID "HeadlineBackground" wird das Hintergrundbild mit CSS in den Header eingebaut-->
            <div id="HeadlineBackground"></div>
            <div id="HeadlineText">
                <h2 id="HeadBox">Schilfprojekt der Thomas-Mann-Schule</h2>
                <h4 id="HeadSubBox">
                <p>in Kooperation mit der Universit&auml;t zu L&uuml;beck</p>
                <p style="padding-top:20px;"><i >Untersuchungen zum Schilfwachstum an der Wakenitz</i></p>
                </h4>
            </div>
		</div>
	</div>
    
    <!--Trennlinie zwischen Header und Navigation-->
	<div id="Line">
	</div> 
		
    <!--Hier beginnt die Navigationsleiste. Diese ist mithilfe einer ungeordneten Liste(ul) aufgebaut. Die einzelnen ListItems(li) beinhalten einen Link auf die verlinkten Unterseiten. Wenn die Kategorien sich nur ausfahren, aber nicht anklickbar sein sollen, dann wird kein href-Attribut gesetzt. Die ausfahrbaren Unterkategorien sind wiederum mit Listen und ListItems in den übergeordneten ListItems realisiert. Die href-Links ändern oder ergänzen nur das URL-Attribut ?site, was dann später - immer wenn die index-Seite aufgerufen wird - ausgelesen wird, sodass dann nur diese Unterseite includet wird. href="#" sollen noch tote Links darstellen, die demnächst gefüllt werden-->
    <div id="na" >
        <nav id="nav">
    	    <ul id="navigation" type="none">
                <!--Home-->
		        <li><a id="listElement1" href="?site=home">Home</a></li>
                <!--Schilfprojekt-->
		        <li><a id="listElement2">Schilfprojekt &raquo;</a>
					<ul>
						<li><a href="?site=idee">Projektidee</a></li>
						<li><a href="?site=aspekte">Forschungsaspekte</a></li>
                        <li><a href="?site=chronik">Projektverlauf</a></li>
					</ul>
				</li>
                <!--Schilfpflanze-->
                <li><a id="listElement3">Schilfpflanze &raquo;</a>
    				<ul>
                        <li><a href="?site=auto">Aut&ouml;kologisch</a></li>
						<li><a href="?site=intergraf">Syn&ouml;kologisch</a></li>
					</ul>            
				</li>
                <!--Wakenitz-->
                <li><a id="listElement4">Wakenitz &raquo;</a>
                    <ul>
						<li><a href="?site=geschi">Geschichte</a></li>
                         <li><a href="#">&Ouml;kosystem &raquo;</a>    
                            <ul>
                                <li><a href="?site=allgemeinoko">Allgemeine Betrachtung</a></li>
                                <li><a href="?site=biofakt">Biotische Faktoren</a></li>
            					<li><a href="?site=abiofakt">Abiotische Faktoren</a></li>
                                <li><a href="?site=stoffkreis">Stoffkreisl&auml;ufe</a></li>
                            </ul>
                        </li> 
                        <li><a href="#">Standorte &raquo;</a>
                            <ul>
                                <li><a href="?site=bruecke">Wallbrechtbr&uuml;cke</a></li>
                                <li><a href="?site=eichholz">Eichholz</a></li>
                                <li><a href="?site=kleinerSee">Kleiner See</a></li>
                                <li><a href="?site=absalonshorst">Absalonshorst</a></li>
                                <li><a href="?site=grossSarau">Gro&szlig; Sarau</a></li>
                            </ul>
                        </li>    
                        <!--li><a href="?site=geo">Geovermessung</a></li-->   
					</ul>  
                </li>
                <!--Untersuchungen-->
                <li><a id="listElement5">Untersuchungen &raquo;</a>
                    <ul>
                        <li><a href="#">Schilfuntersuchung &raquo;</a>
                            <ul>
                                <li><a href="?site=vermessung">Vermessung</a></li>
                                <li><a href="?site=bruchfestigkeit">Bruchfestigkeit</a></li>
                                <li><a href="?site=genanalyse">genetische Analyse</a></li>
                                <li><a href="?site=staerke">St&auml;rkegehalt</a></li>
                                <li><a href="?site=keimung">Keimf&auml;higkeit</a></li>
                                <li><a href="?site=vermehrung">Vermehrung</a></li>
                            </ul>
                        </li>
                        <li><a href="?site=wasser">Wasseranalyse</a></li>
                        <li><a href="?site=sediment">Sedimentanalyse</a></li>
						<li><a href="?site=saprobie">Gew&auml;sserg&uuml;te</a></li>
						<li><a href="?site=makrofauna">Makrofauna</a></li>
                        <li><a href="?site=geo">Geovermessung</a></li>
                    </ul>
                </li>
                <!--Mediathek-->
				<li ><a id="listElement6">Mediathek &raquo;</a>
					<ul>
                        <li><a href="?site=bildergalerie">Bildergalerie</a></li>
                        <li><a href="?site=video">Video</a></li>
                        <li><a href="?site=presse">Medienecho</a></li>
                        <li><a href="?site=links">weiterf&uuml;hrende Links</a></li>
						<li><a href="?site=download">Downloads</a></li>
					</ul>
                </li>
                <!--Admin, später unten auf der Seite, oder nur über URL erreichbar>
				<li><a id="listElement9" href="?site=login">Admin</a></li-->
			</ul>
        </nav>
    </div>

	<!--Die Tooltips sind die Fenster, die neben der SideBar erscheinen, wenn man über die Namen oder Punkte der Standorte hovert.
		Die Tooltips an sich bestehen nur aus einem Bild und einer Standortüberschrift.-->
    <div id="tooltips">
        <div  id="tooltipBruecke">
            Wallbrechtbr&uuml;cke
            <img src="thumbnails/bruecke.jpg" alt="Wallbrechtbr&uuml;cke" height="100">
        </div>
        <div  id="tooltipEichholz">
            Eichholz
            <img src="thumbnails/eichholz.JPG" alt="Eichholz" height="100">
        </div>
        <div  id="tooltipKleinerSee">
            Kleiner See
            <img src="thumbnails/kleiner see.JPG" alt="Kleiner See"  height="100">
        </div>
        <div id="tooltipAbsalonshorst">
            Absalonshorst
            <img src="thumbnails/absalonshorst.JPG" alt="Absalonshorst"  height="100">
        </div>
        <div id="tooltipGrossSarau">
            Gro&szlig; Sarau
            <img src="thumbnails/gross sarau.JPG" alt="Gross Sarau" height="100">
        </div>
        
    </div>
        
    <script language="javascript" type="text/javascript">
		//In diesem JavaScript-Teil wird den Tooltips ihre Funktionsfähiigkeit gegeben
		
		/*
		*	Wie der Name showTooltip schon sagt, wird mit dieser Funktion das Tooltip eines Standortes angezeigt.
		*	Die Bezeichnungen der Standorte sind: Bruecke , Eichholz, KleinerSee , Absalonshorst , GrossSarau
		*/
        function showTooltip(standort){
            
			//die Tooltip-divs aus dem html-Teil werden in Variablen gespeichert
            var bruecke = document.getElementById("tooltipBruecke");
            var eichholz = document.getElementById("tooltipEichholz");
            var kleinerSee = document.getElementById("tooltipKleinerSee");
            var absalonshorst = document.getElementById("tooltipAbsalonshorst");
            var grossSarau = document.getElementById("tooltipGrossSarau");
            var tooltip = document.getElementById("tooltips");
			
            tooltip.style.display="block";//setzt den tooltip-Rahmen auf sichtbar
            
			//je nachdem, welcher Standort aufgerufen wurde, wird hier ein tooltip auf sichtbar gesetzt, indem das CSS Attribut display von none auf block gesetzt wird
            if(standort=="Bruecke"){
                bruecke.style.display="block";
            }
            if(standort=="Eichholz"){
                eichholz.style.display="block";
            }
            if(standort=="KleinerSee"){
                kleinerSee.style.display="block";
            }
            if(standort=="Absalonshorst"){
                absalonshorst.style.display="block";
            }
            if(standort=="GrossSarau"){
                grossSarau.style.display="block";
            }
        }
			
		/*
		*	HideTooltip ist genau die entgegengesetzte Funktion zu showTooltip und funktioniert auch genauso
		*/
		function hideTooltip(standort){
            var bruecke = document.getElementById("tooltipBruecke");
            var eichholz = document.getElementById("tooltipEichholz");
            var kleinerSee = document.getElementById("tooltipKleinerSee");
            var absalonshorst = document.getElementById("tooltipAbsalonshorst");
            var grossSarau = document.getElementById("tooltipGrossSarau");
            var tooltip = document.getElementById("tooltips");
            tooltip.style.display="none";
            
            if(standort=="Bruecke"){
                bruecke.style.display="none";
            }
            if(standort=="Eichholz"){
                eichholz.style.display="none";
            }
            if(standort=="KleinerSee"){
                kleinerSee.style.display="none";
            }
            if(standort=="Absalonshorst"){
                absalonshorst.style.display="none";
            }
            if(standort=="GrossSarau"){
                grossSarau.style.display="none";
            }
        }
		
		/*
		*	LinkToStandortPage wird aufgerufen, wenn der Benutzer auf einen Standort in der SideBar klickt
		*  Je nach Standortwahl, wird er dann auf die Seite mit der Standortbeschreibung weitergeleitet
		*/
		
        function linkToStandortPage(standort){
            if(standort=="Bruecke"){
                window.location = "?site=bruecke";
            }
            if(standort=="Eichholz"){
                window.location = "?site=eichholz";
            }
            if(standort=="KleinerSee"){
                window.location = "?site=kleinerSee";
            }
            if(standort=="Absalonshorst"){
                window.location = "?site=absalonshorst";
            }
            if(standort=="GrossSarau"){
                window.location = "?site=grossSarau";
            }
        }
    </script>
	
	<div id="sideBarButton">
	    <p>Karte </p>
	</div>
	
	<script type="text/javascript">
	   
	    
	    $( document ).ready(function() {
	        //beim klicken SideBar öffnen
	        $("#sideBarButton").click(function(){
	            $("#SideBar").toggle();
	            $("#SideBar").css("position","fixed");
	            $("#SideBar").css("padding","0px");
	            $( "#SideBar" ).css( "animation"," einfliegenVonLinks 0.5s");
	            
	           
	        });
	        
	        
	        //beim hovern nach 2000ms SideBar öffnen
	        $('#sideBarButton').hover(function () {
                var expanding = $(this);
                var timer = window.setTimeout(function () {
                    expanding.data('timerid', null);
                    $("#SideBar").toggle();
                    $("#SideBar").css("position","fixed");
                    $("#SideBar").css("padding","0px");
                    $( "#SideBar" ).css( "animation"," einfliegenVonLinks 0.5s");    
                }, 600);
                //store ID of newly created timer in DOM object
                expanding.data('timerid', timer);
            }, function () {
                var timerid = $(this).data('timerid');
                if (timerid != null) {
                //mouse out, didn't timeout. Kill previously started timer
                window.clearTimeout(timerid);
                }
            });
            
            $("#SideBar").mouseleave(function(){
                if ($("#homeTexthead").length == 0){
                    // wenn nicht im Adminbereich oder auf HomeSeite
                    $("#SideBar").toggle();
                    
                }
                
            });
            
            
            
	   });
	    
	</script>    

<div id="wrapper">	    
	<!--Die SideBar ist neben dem Center-Container auf der Home-Seite zu sehen ist, und ansonsten nur hervorguckt und ausfahrbar ist.-->
	<div id="SideBar">
	    <div id="sideBarInhalt">
			<!--Die Legende zeigt die fünf Standorte in ihren Farben. 
			Außerden kommen hier beim hovern(onmouseover bzw. onmouseout) die JavaScript-Funktionen zum Zeigen und Verschwindenlassen zum Einsatz.
			Zusätzlich sind die Legendeneinträge verlinks, sodass man durch anklicken auf die Standortbeschreibungsseite gelangt.	-->
            <div id="legende">
				<a href="?site=bruecke">
					<p 	style="color:grey;font-weight:bold;" 
						onmouseover="showTooltip('Bruecke');" 
						onmouseout="hideTooltip('Bruecke');"> 
							Wallbrechtbr&uuml;cke
					</p>
				</a>
				<a href="?site=eichholz">
					<p 	style="color: #1d722c;font-weight:bold;" 
						onmouseover="showTooltip('Eichholz');" 
						onmouseout="hideTooltip('Eichholz');">
							Eichholz
					</p>
				</a>
				<a href="?site=kleinerSee">
					<p style="color:#EEC900;font-weight:bold;" 
						onmouseover="showTooltip('KleinerSee');" 
						onmouseout="hideTooltip('KleinerSee');">
							Kleiner See
					</P>
				</a>
				<a href="?site=absalonshorst">
					<p style="color:red;font-weight:bold;" 
						onmouseover="showTooltip('Absalonshorst');" 
						onmouseout="hideTooltip('Absalonshorst');">
							Absalonshorst
					</p>
				</a>
				<a href="?site=grossSarau">
					<p style="color:blue;font-weight:bold;" 
						onmouseover="showTooltip('GrossSarau');" 
						onmouseout="hideTooltip('GrossSarau');">
							Gro&szlig; Sarau
					</p>
				</a>
			</div>
			
			<!--Dieser Container hat eine feste Breite, die wichtig ist, da die Inhalte prozentual ausgerichtet sind. 
			Denn die Punkte der Standorte sollen immer an derselben Stelle der Karte erscheinen, auch, wenn die Bildschirmauflöösung oder das Zoom-In Level ein anderes ist-->
            <div id="festerInhaltFuerUmriss">
				<!--Die einzelnen Punkte haben die Javascript Funktionen zum Zeigen und Verschwinden-lassen der Tooltips sowie eine Link-Funktion(onclick), die den Benutzer auf die Standortbeschreibungsseite weiterleitet-->
                <div 	id="punktBruecke" 
						class="punkt" 
						onmouseover="showTooltip('Bruecke');" 
						onmouseout="hideTooltip('Bruecke');" 
						onclick="linkToStandortPage('Bruecke');">
					<!--Der inhalt der Punkte wird nicht angezeigt(display:none) muss jedoch als Platzhalter vorhanden sein-->	
                    <a style="display:none;">x</a>
                </div>
                <div 	id="punktKleinerSee" 
						class="punkt" 
						onmouseover="showTooltip('KleinerSee');" 
						onmouseout="hideTooltip('KleinerSee');" 
						onclick="linkToStandortPage('KleinerSee');">
                    <a style="display:none;">x</a>
                </div>
                <div 	id="punktEichholz" 
						class="punkt" 
						onmouseover="showTooltip('Eichholz');" 
						onmouseout="hideTooltip('Eichholz');" 
						onclick="linkToStandortPage('Eichholz');">
                    <a style="display:none;">x</a>
                </div>
                <div 	id="punktAbsalonshorst" 
						class="punkt" 
						onmouseover="showTooltip('Absalonshorst');" 
						onmouseout="hideTooltip('Absalonshorst');" 
						onclick="linkToStandortPage('Absalonshorst');">
                    <a style="display:none;">x</a>
                </div>
                <div 	id="punktGrossSarau" 
						class="punkt" 
						onmouseover="showTooltip('GrossSarau');" 
						onmouseout="hideTooltip('GrossSarau');" 
						onclick="linkToStandortPage('GrossSarau');">
                    <a style="display:none;">x</a>
                </div>
            </div>     
			
 
            
            <?php
				/*
				*	Im Folgenden werden Termine, die in der Datenbank gespeichert sind, ausgelesen und angezeigt
				*/
			
				//Durch include('datenbank.php'); wird eine php-Datei mit der Kopplungsfunktion zur Datenbank eingebunden
                include('datenbank.php');
				
				//Es werden die neusten zwei Termine abgefragt, da die terminid fortlaufend vergeben wird
                $anfrage = 'SELECT terminid, terminzeit, terminbeschreibung
                        FROM termine
                        ORDER BY terminid DESC
                        LIMIT 2
                    ';
                    
                $ergebnis = mysql_query($anfrage)
                    or die('Anfrage schlug fehl: '.mysql_error());
                    
                
                //Die Termine werden in der SideBar erzeugt, aber per CSS nicht angezeigt, nur auf der home Seite
                echo('
                    <div  id="termine">
                        <h3><u>Termine:</u></h3>
                    ');
                    
					//Für jedes der (höchstens zwei) Elemente des Ergebnisses wird die while-Schleife mit der Ausgabe durchlaufen
                    while($zeile = mysql_fetch_assoc($ergebnis)){
                        echo('<p><b>'.$zeile['terminzeit'].': </b></p>');
                        echo('<p>'.$zeile['terminbeschreibung'].'</p>');
                    }
                    
                 echo('</div>');
            ?>
		</div>
		
					<!-- Dies ist der Logout-Button, der in der SideBar erst erscheint, wenn man sich angemeldet hat.
				Bei drücken des Buttons, wird man auf die Home-Seite geleitet.-->
            <form style="text-align:right; position:absolute; right:20px; top:0px;" action="?site=home" method="post"> 
                <input  id="logout" name="logout" type="submit" value="Abmelden"> 
            </form>
            
                <input  id="toAdmin" name="toAdmin" type="submit" value="Zum Adminbereich" style="text-align:right; position:absolute; right:120px; top:0px;"> 
                <script type="text/javascript">
                    $(document).ready(function(){
					    $("#toAdmin").click(function(){ 
					        window.location.replace('?site=admin');  
					    });
					});
                </script>

            
            <?php
                //überprüfen, ob die SESSION Variable gesetzt ist
                if(isset($_SESSION['status'])){
                    //wenn ja, dann wird ihr Wert in $status gespeichert. Der Wert sollte 0 für nicht angemeldet und 1 für angemeldet sein
                    $status=$_SESSION['status'];
                }else{
                    //wenn nein, dann ist status 0
                    $status='0';
                }
                    
				//prüfen, ob der user angemeldet ist
                if($status !='1'){
                //wenn $status nicht 1 ist, dann ist der user nicht angemeldet und der LogoutButton wird nicht angezeigt
                
                     echo('<script  type="text/javascript">
							$(document).ready(function(){
							    $("#logout").hide();
							    $("#toAdmin").hide();
							});
							
                            </script>');
                }else{
                //wenn $status 1 ist, dann soll der LogoutButton angezeigt werden
                    echo('<script type="text/javascript">
							$(document).ready(function(){
							    $("#logout").show();
							    $("#toAdmin").show();
							});
							 
                            </script>');
                }
            ?>
           
            
            <?php
			// Wenn der LogoutButton gedrückt wurde, ist $_POST['logout'] gesetzt, da der input-submit-Button im Formular getätigt wurde
                if(isset($_POST['logout'])){
				
					//der Statuswert wird auf 0 gesetzt, was abgemeldet bedeutet. Und in der SESSION-Variable gespeichert
                    $statuswert='0';
                    $_SESSION['status']=$statuswert;
					
					//Anschließend wird die SESSION beendet
                    session_destroy();
					
                    //Und der User auf die Home-Seite weitergeleitet
                    echo("<script language ='JavaScript'>
    				           window.location.replace('?site=home'); 
					      </script>");
                }
            ?>
	</div>
	
    <div id="center">
        
		<?php
            /*  Das ?site-Attribut aus der URL wird mithilfe von $_GET['site'] geholt
            *   Zum Beispiel ist bei der Seite ...index.php?site=home die Variable home das ?site Attribut. 
            *   Der Attribut-Name "site" ist selber ausgedacht und muss mit ? an die URL angehängt werden. 
            *   Wenn mehrere Attribute angehängt werden sollen, dann wird das erste mit ? und die darauffolgenden mit & verbunden.
            */
            //Überprüfung, ob das ?site-Attribut gesetzt wurde (is set)
    		if( isset($_GET['site']) ){ 
					//wenn ja, dann wird die Variable in $site gespeichert
			        $site = $_GET['site'];
					/*	Hier passiert ein entscheidender Schritt. 
					*	Die index.php-Seite ist immer als Rahmen zu sehen, aber im Center-Bereich wechseln die Inhalte.  
					*	Dies wird dadurch erreicht, dass mithilfe von include([irgendeineSeite].php) Code von einer anderen Datei importiert wird.
					*	Und zwar von genau der Datei, die im ?site-Attribut steckt.
					*/
					
			        include($site.'.php');
                 
				 
				 /* Die nachfolgenden if-Bedingungen sollen überprüfen, auf welcher Seite man ist und dann in der Navigationsleiste die Kategorie, in der man sich befindet, farblich markieren.*/
    			if($site=="home"){  
    			    
                    echo("<style> #listElement1 {
                            
                        } </style> ");
                } 
                if($site=='idee'||$site=='aspekte'||$site=='chronik'){
                    
                   echo("<style > #listElement2 {
                            background: #D68453!important; 
                            background-image: -moz-linear-gradient(top, #ffffff, #d68453)!important;
                            background-image: -ms-linear-gradient(top, #ffffff, #d68453)!important;
                            background-image: -o-linear-gradient(top, #ffffff, #d68453)!important;
                            background-image: -webkit-gradient(linear, center top, center bottom, from(#ffffff), to(#d68453))!important;
                            background-image: -webkit-linear-gradient(top, #ffffff, #d68453)!important;
                            background-image: linear-gradient(top, #ffffff, #d68453)!important;
                        } </style> "); 
                }
                if($site=='auto'||$site=='syno'||$site=='intergraf'){
                    echo("<style> #listElement3 {
                            background: #D4D653!important;
                            background-image: -moz-linear-gradient(top, #ffffff, #d4d653)!important;
                            background-image: -ms-linear-gradient(top, #ffffff, #d4d653)!important;
                            background-image: -o-linear-gradient(top, #ffffff, #d4d653)!important;
                            background-image: -webkit-gradient(linear, center top, center bottom, from(#ffffff), to(#d4d653))!important;
                            background-image: -webkit-linear-gradient(top, #ffffff, #d4d653)!important;
                            background-image: linear-gradient(top, #ffffff, #d4d653)!important;
                        } </style> "); 
                } 
                if($site=='geschi'||$site=='allgemeinoko'||$site=='biofakt'||$site=='abiofakt'||$site=='stoffkreis'||$site=='eichholz'||$site=='kleinerSee'||$site=='absalonshorst'||$site=='grossSarau'||$site=='bruecke'){
                    echo("<style> #listElement4 {
                            background: #84D653!important; 
                            background-image: -moz-linear-gradient(top, #ffffff, #84d653)!important;
                            background-image: -ms-linear-gradient(top, #ffffff, #84d653)!important;
                            background-image: -o-linear-gradient(top, #ffffff, #84d653)!important;
                            background-image: -webkit-gradient(linear, center top, center bottom, from(#ffffff), to(#84d653))!important;
                            background-image: -webkit-linear-gradient(top, #ffffff, #84d653)!important;
                            background-image: linear-gradient(top, #ffffff, #84d653)!important;
                        } </style> "); 
                }
                if($site=='wasser'||$site=='genanalyse'||$site=='saprobie'||$site=='biologischewerte'||$site=='chemischewerte'||$site=='diagramme'||$site=='diagramme_vsk'||$site=='sapaus'||$site=='keimung'||$site=='createmap'||$site=='geo'||$site=='vermessung'||$site=='makrofauna'||$site=='sediment'||$site=='staerke'||$site=='vermehrung'||$site=='wasser'||$site=='bruchfestigkeit'){
                    echo("<style> #listElement5 {
                            background: #56D653!important; 
                            background-image: -moz-linear-gradient(top, #ffffff, #56d653)!important;
                            background-image: -ms-linear-gradient(top, #ffffff, #56d653)!important;
                            background-image: -o-linear-gradient(top, #ffffff, #56d653)!important;
                            background-image: -webkit-gradient(linear, center top, center bottom, from(#ffffff), to(#56d653))!important;
                            background-image: -webkit-linear-gradient(top, #ffffff, #56d653)!important;
                            background-image: linear-gradient(top, #ffffff, #56d653)!important;
                        } </style> "); 
                }
                if($site=='bildergalerie'||$site=='bilder'||$site=='video'||$site=='links'||$site=='newsartikel'||$site=='news'||$site=='presse'||$site=='download'){
                    echo("<style> #listElement6 {
                            background: #53d6d4!important; 
                            background-image: -moz-linear-gradient(top, #ffffff, #53d6d4)!important;
                            background-image: -ms-linear-gradient(top, #ffffff, #53d6d4)!important;
                            background-image: -o-linear-gradient(top, #ffffff, #53d6d4)!important;
                            background-image: -webkit-gradient(linear, center top, center bottom, from(#ffffff), to(#53d6d4))!important;
                            background-image: -webkit-linear-gradient(top, #ffffff, #53d6d4)!important;
                            background-image: linear-gradient(top, #ffffff, #53d6d4)!important;
                        } </style> "); 
                }
                if($site=='admin'){
                    
                }
		 
                        
			}else{
			
			//Wenn das ?site-Attribut nicht gesetzt wurde, wird man auf die Home-Seite weitergeleitet
    		 echo("<script language ='JavaScript' type='text/javascript'>
    		           window.location.replace('?site=home'); 
			      </script>");   
			}
		?>		
	    
		
    </div>
	
</div>

	<!--Im Footer befinden sich die Teilnehmenden Institutionen der Schilfprojektes sowie die Sponsoren, jeweils mit verlinktem Bild-->
	<div id="Footer">
        <a href="http://www.thomas-mann-schule.de/" target="_blank"><div class="Sponsor" id="tms"></div></a>
        <a href="http://www.possehl-stiftung.de/" target="_blank"><div class="Sponsor" id="possehl"></div></a>
		<a href="http://www.lola.uni-luebeck.de/" target="_blank"><div class="Sponsor" id="lola"></div></a>
		<a href="http://www.lias.uni-luebeck.de/" target="_blank"><div class="Sponsor" id="lias"></div></a>
		<a href="http://www.uni-luebeck.de/?id=2017" target="_blank"><div class="Sponsor" id="schuelerakademie"></div></a>
        <!--Impressum und Autor-->
        <p style="position:absolute; bottom:75px; right:20px;">&copy; by Thomas-Mann-Schule</p>
        <div id="imp">
            <a href="?site=impressum">Impressum</a>
        </div>
	</div>
</body>
</html>
