<!-- Auch wenn man diese Seite momentan nicht erreichen kann. Hier werden alle Datenbankeinträge der Newsartikel angezeigt-->
<div name="news">
     <?php
         include('datenbank.php');
        $anfrage = 'SELECT newsid, titel, einleitung, uploadzeit, bildpfad1, bildtext1, bildpfad2, bildtext2, bildpfad3, bildtext3
                        FROM newsartikel
                        ORDER BY newsid desc
                    ';
                    
         $ergebnis = mysql_query($anfrage)
            or die('Anfrage schlug fehl: '.mysql_error());
        
        while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
         
        
            echo('
                <div class="newsbox">
                    <div class="boxhead">
                        <p id="uploadtime">'.$zeile['uploadzeit'].'</p>
                        <h3 id="title">'.$zeile['titel'].'</h3>
                    </div>
                    <div  style="white-space: wrap; min-height:120px" class="boxbody">
                    
                ');
                
            if(file_exists("newsarticleimages/".$zeile['bildpfad1']."")){
                echo('<img  id="'.$zeile['newsid'].'a" style=" display:block; float:right; margin-left:20px; margin-bottom:10px; vertical-align:text-top;" width="100" height="100" src="newsarticleimages/'.$zeile['bildpfad1'].'" alt="'.$zeile['bildtext1'].'">');
            }
            if(file_exists("newsarticleimages/".$zeile['bildpfad2']."")){
                echo('<img id="'.$zeile['newsid'].'b" style=" display:none; float:right; margin-left:20px; margin-bottom:10px; vertical-align:text-top;" width="100" height="100" src="newsarticleimages/'.$zeile['bildpfad2'].'" alt="'.$zeile['bildtext2'].'">');
            }
            if(file_exists("newsarticleimages/".$zeile['bildpfad3']."")){
                echo('<img id="'.$zeile['newsid'].'c" style=" display:none; float:right; margin-left:20px; margin-bottom:10px; vertical-align:text-top;" width="100" height="100" src="newsarticleimages/'.$zeile['bildpfad3'].'" alt="'.$zeile['bildtext3'].'">');
            }
                
                
            echo('  
                     <p>'.$zeile['einleitung'].' 
                         <a onmouseover="slideImages()" href="?site=newsartikel&newsid='.$zeile['newsid'].'"> Weiterlesen...</a>
                     </p> 
                    </div>
                    
                </div>
                ');
                
                
        }
    
        $anfrageHighestNewsId = 'SELECT newsid
                                FROM newsartikel
                                ORDER BY newsid DESC
                                LIMIT 1
                    ';
                    
        $ergebnisHighestNewsId = mysql_query($anfrageHighestNewsId)
            or die('Anfrage schlug fehl: '.mysql_error());
        $highestNewsIdZeile= mysql_fetch_assoc($ergebnisHighestNewsId) ;
        $highestNewsId=$highestNewsIdZeile['newsid'];
        $highestNewsId=$highestNewsId +1;
    echo('
    <script language ="JavaScript">
                
                var aktiv = window.setInterval("slideImages()", 5000);
                var imagenumber = 1;
                var i = 0;
                
                function slideImages(){
                    var imga = new Array();
                    var imgb = new Array();
                    var imgc = new Array();
                    
                    
                    for(x=0;x< '.$highestNewsId.' ; x++){
                        if(document.getElementById(""+x+"a")!=null){
                            imga[x] =  document.getElementById(""+x+"a");
                        }
                        if(document.getElementById(""+x+"b")!=null){
                            imgb[x] =  document.getElementById(""+x+"b");
                        }
                        if(document.getElementById(""+x+"c")!=null){
                            imgc[x] =  document.getElementById(""+x+"c");
                        }
                        
                    }
                    
                    
                    
                    if (imagenumber == 1) {
                        for(y=0; y< '.$highestNewsId.' ; y++){
                            if(imga[y]!=null){
                                imga[y].style.display="block";
                            }
                            if(imgb[y]!=null){
                                imgb[y].style.display="none";
                            }
                            if(imgc[y]!=null){
                                imgc[y].style.display="none";
                            }
                            
                        }
                        imagenumber = 2;
                      } else if(imagenumber==2) {
                        for(z=0; z< '.$highestNewsId.' ; z++){
                            if(imga[z]!=null){
                                imga[z].style.display="none";
                            }
                            if(imgb[z]!=null){
                                imgb[z].style.display="block";
                            }
                            if(imgc[z]!=null){
                                imgc[z].style.display="none";
                            }
                            
                        }
                        imagenumber = 3;
                      }else if(imagenumber==3) {
                        for(c=0; c< '.$highestNewsId.' ; c++){
                            if(imga[c]!=null){
                                imga[c].style.display="none";
                            }
                            if(imgb[c]!=null){
                                imgb[c].style.display="none";
                            }
                            if(imgc[c]!=null){
                                imgc[c].style.display="block";
                            }
                            
                        }
                        imagenumber = 1;
                      }
                      
                      i=i+1;
                    if (i >= 100)
                    window.clearInterval(aktiv);
                    
                }
            
                
            </script>');
            
            ?>
</div>