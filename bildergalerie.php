<!-- Auf dieser Seite wird eine Übersicht über die Bildgruppen geboten. Durch anklicken gelangt man in die Gruppe hinein und kann dort alle Bilder ansehen. Auf dieser Seite wird nur ein Bild angezeigt, das aber beim drüberhovern durchwechselt-->
<div name="bilder">

	<h1 id="bildgr"><u>Bildergalerie</u></h1>
<?php
        
//Datenbankanbindung    
include('datenbank.php');

//Liefert alle Ordner
$anfrageOrdner = 'SELECT gruppenname, gruppenID
                        FROM bildgruppe
                        ORDER BY gruppenID DESC';
                        
$ergebnisOrdner = mysql_query($anfrageOrdner)
    or die('Anfrage schlug fehl: '.mysql_error());
	
//Ausgabe aller Bildordner
while ( $zeileOrdner = mysql_fetch_assoc($ergebnisOrdner) ) {
    echo (
        '<div class="ordner">'
        );
    echo ('    
        <p>
        '.$zeileOrdner['gruppenname'].'
        </p>
        ');
        
			//Pro Bildgruppenordner wird eine Anfrage gestellt, welche Bilder sich in dieser Gruppe befinden, und stellt eines als verlinktes Bild zum Ordnerinhalt dar
              $anfrageEinzelbilder = 'SELECT bildpfad,bildID, gruppenID
                        FROM bilder
                        WHERE gruppenID = '.$zeileOrdner['gruppenID'].'
                        GROUP BY gruppenID
                        ORDER BY bildID DESC';
                        
                $ergebnisEinzelbilder = mysql_query($anfrageEinzelbilder)
                or die('Anfrage schlug fehl: '.mysql_error());
                while ( $zeileEinzelbild = mysql_fetch_assoc($ergebnisEinzelbilder) ) {
                
					//bei hover per JavaScript: Bilder dieser Gruppen sollen sliden
					//bei raushover per JavaScript: Sliden aufhören
					//das Bild bekommt eine id="" mit der GruppenID, die später per JavaScript herangezogen wird
                    echo(
                         '<a href="?site=bilder&ordnerID='.$zeileOrdner['gruppenID'].'">
                            <div id="bildpos"
                                 onmouseover="slideBilder('.$zeileOrdner['gruppenID'].');" 
							     onmouseout="dontSlideBilderAnymore();"
							     
							     >
                                <img id="bildordner'.$zeileOrdner['gruppenID'].'" 
							        width="300" height="300" 
							        src="thumbnails'.$zeileEinzelbild['bildpfad'].'">
							 </div>
                            </a>'
                        );
                }
                
                echo('</div>');
           
            }
				//Alle Bilderpfade und GruppenIDs, die sich in der Datenbank befinden, werden ausgelesen und in derselben Reihenfolge in PHP-Arrays gespeichert
                $anfrageAlleBilder = 'SELECT bildpfad,bildID, gruppenID
									FROM bilder
                                   ORDER BY bildID DESC';
                                                            
				$ergebnisAlleBilder = mysql_query($anfrageAlleBilder)
					or die('Anfrage schlug fehl: '.mysql_error());
                
				while ( $zeileAlleBilder = mysql_fetch_assoc($ergebnisAlleBilder) ) {
					$alleBildPfade[] = $zeileAlleBilder['bildpfad'];
                    $alleBildGruppenids[] = $zeileAlleBilder['gruppenID'];
                }
                                                    
				//Der JavaScript-Teil liefert die SlideFunktion
				echo('  <script type="text/javascript">
                
					/*Nummer des aktuellen Bildes*/
					var aktuellesBild = 0;
					var aktiv;
												
					var Images = new Array();	/*Hier werden die Bildpfade eingespeichert*/
					var Imageids= new Array();	/*Hier die GruppenIDs der Bilder in derselben Reihenfolge*/
					var ImagesDieserGruppe = new Array();	/*Hier nur die Bildpfade der Gruppe, über der die Maus gerade hovert*/
					
				');
                                            
				/*Hier werden die Bildpfade eingespeichert*/							
                foreach ($alleBildPfade as $key => $wert)
                {
					echo('Images['.$key.'] = "'.$wert.'";');
                }
                
				/*Hier die GruppenIDs der Bilder in derselben Reihenfolge*/
				foreach ($alleBildGruppenids as $key => $wert)
                {
					echo('Imageids['.$key.'] = "'.$wert.'";');
                }
                                            
				echo('
                
				/*Hier werden nur die Bildpfade der Gruppe, über der die Maus gerade hovert, im Arrays gespeichert*/
				function slideBilder(ordnerID){
                    for (var i = 0; i <Images.length; i++){
                        if(Imageids[i]==ordnerID){
                            ImagesDieserGruppe.push(Images[i]);
                        }
					}
                     
					/*Im Abstand von 1 Sekunde wird slidenAktiv() aufgerufen*/
					aktiv = window.setInterval("slidenAktiv("+ordnerID+")", 1000);    
                }
                                            
                function slidenAktiv(ordnernummer){
                                                
					/*Holt das img-Objekt, über das gehovert wird, und speichert es*/							
					var bildelement = document.getElementById("bildordner"+ordnernummer);
                    
					/*Die aktuelle Bildquelle wird gespeichert, indem an dem BildquellenArray dieser Gruppe an die aktuelle Position gegangen wird*/
                    var imageSource = ImagesDieserGruppe[aktuellesBild];
                     
					/*Das Bildelement bekommt eine neue Bildquelle*/
                    bildelement.src = imageSource;
					
                    if(aktuellesBild<ImagesDieserGruppe.length-1){
						
						/*Wenn die aktuelle Bildnummer kleine als die höchstmögliche ist, dann wird sie um 1 erhöht*/
                        aktuellesBild++;     
                    }else{
						
						/*ansonsten wieder an den Anfang gesetzt*/
						aktuellesBild=0; 
                    }
                                                
                }
                
				/*Beim Stoppen des hovern wird diese Funktion aufgerufen*/
				
                function dontSlideBilderAnymore(ordnernummer){
					
					/*Löscht alle Array-Elemente von 0 bis zum letzten Element,sodass der Array wiederverwendet werden kann*/
                    ImagesDieserGruppe.splice(0,ImagesDieserGruppe.length);
					
					/*cleart das Intervall, bevor es wiederverwendet wird*/
                    clearInterval(aktiv);
                }
                </script>');
?>
</div>