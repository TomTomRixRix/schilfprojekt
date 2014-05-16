<!--Die Navigation zwischen den Registerkarten METHODEN,ERGEBNISSE,AUSWERTUNGEN wird hier realisiert-->

<!--TODO: Damit auch non-script User die Navigation nutzen können könnte man mit <A href=""> Tags Verweiser auf die jeweiligen Unterseiten mit href="&register=methods"-->
    <div id="register">
        <div id="methods" class="registerKarte">Methoden</div>
        <div id="results" class="registerKarte">Ergebnisse</div>
        <div style="display:none;" id="surface" class="registerKarte">Ergebnisse: <span style="font-size:10pt;">Oberfl&auml;che</span></div>
        <div style="display:none;" id="sediment" class="registerKarte">Ergebnisse: <span style="font-size:10pt;">Sediment </span></div>
        <div style="display:none;" id="diagrams" class="registerKarte">Diagramme</div></a>
        <div id="discussion" class="registerKarte">Auswertungen</div>
        <div style="clear:both;"></div>
    </div>
    
<script tpye="text/javascript">
    $(document).ready(function(){ 
    
<?php
    
                     
    
        if(isset($_GET['register'])){
        echo $_GET['register'];
            if($_GET['register']=="methods"){
               echo('
                //wählt die Methoden als erstes aus
                $("#methods").toggleClass("registerKarteSelected");
                $("#methodsContent").toggle();
                $("#methodsContent").toggleClass("registerContentSelected");
               ');
            }else if($_GET['register']=="results"){
                echo('
                //wählt die Ergebnisse  als erstes aus
                $("#results").toggleClass("registerKarteSelected");
                $("#resultsContent").toggle();
                $("#resultsContent").toggleClass("registerContentSelected");        
                ');
            }
            else if($_GET['register']=="discussion"){
                echo('
                //wählt die Auswertungen als erstes aus
                $("#discussion").toggleClass("registerKarteSelected");
                $("#discussionContent").toggle();
                $("#discussionContent").toggleClass("registerContentSelected");        
                ');
            }else if($_GET['register']=="diagrams"){
                echo('
                //wählt die Auswertungen als erstes aus
                $("#diagrams").toggleClass("registerKarteSelected");
                $("#diagramsContent").toggle();
                $("#diagramsContent").toggleClass("registerContentSelected");        
                ');
            }else if($_GET['register']=="sediment"){
                echo('
                //wählt die Ergebnisse des Sedimentwassers als erstes aus
                $("#sediment").toggleClass("registerKarteSelected");
                $("#sedimentContent").toggle();
                $("#sedimentContent").toggleClass("registerContentSelected");        
                ');
            }else if($_GET['register']=="surface"){
                echo('
                //wählt die Ergebnisse des Oberflächenwassers als erstes aus
                $("#surface").toggleClass("registerKarteSelected");
                $("#surfaceContent").toggle();
                $("#surfaceContent").toggleClass("registerContentSelected");        
                ');
            }
            else{ 
                echo('
                //wählt die Ergebnisse immer als erstes aus
                $("#results").toggleClass("registerKarteSelected");
                $("#resultsContent").toggle();
                $("#resultsContent").toggleClass("registerContentSelected");        
                ');
            }
        }else{
            //wählt die Ergebnisse immer als erstes aus, außer auf der Wasseranalyseseite
            if($_GET['site']=='wasser'){
                echo(' 
                $("#surface").toggleClass("registerKarteSelected"); 
                $("#surfaceContent").toggle(); 
                $("#surfaceContent").toggleClass("registerContentSelected");         
                ');
            }else{
                echo(' 
                $("#results").toggleClass("registerKarteSelected"); 
                $("#resultsContent").toggle(); 
                $("#resultsContent").toggleClass("registerContentSelected");         
                ');
            }
        }    
    
?>    
      
        
        //wenn eine Registerkarte angecklickt wurde...
        $(".registerKarte").click(function(){
            
            //...wird der Zustand der vorher angeklickten geändert, auf nicht ausgewählt
            $(".registerKarteSelected").toggleClass("registerKarteSelected");
            //...wird der Zustand der angeklickten geändert, auf ausgewählt
            $(this).toggleClass("registerKarteSelected");
            
            //der vorherige Inhalt wird nicht mehr angezeigt
            $(".registerContentSelected").toggle("easing");
            $(".registerContentSelected").toggleClass("registerContentSelected");
            
            //je nachdem, welche Karte angeklickt wurde, wird der dazugehörige Inhalt angezeigt
            if($(this).attr('id')=="methods"){
                $("#methodsContent").toggleClass("registerContentSelected");
                $("#methodsContent").toggle("easing");
            }
            else if($(this).attr('id')=="results"){
                $("#resultsContent").toggleClass("registerContentSelected");
                $("#resultsContent").toggle("easing");
            }
            else if($(this).attr('id')=="surface"){
                $("#surfaceContent").toggleClass("registerContentSelected");
                $("#surfaceContent").toggle("easing");
            }
            else if($(this).attr('id')=="sediment"){
                $("#sedimentContent").toggleClass("registerContentSelected");
                $("#sedimentContent").toggle("easing");
            }
            else if($(this).attr('id')=="diagrams"){
                $("#diagramsContent").toggleClass("registerContentSelected");
                $("#diagramsContent").toggle("easing");    
            }
            else if($(this).attr('id')=="discussion"){
                $("#discussionContent").toggleClass("registerContentSelected");
                $("#discussionContent").toggle("easing");
            }
        });
    });
</script>