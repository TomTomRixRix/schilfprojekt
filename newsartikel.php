<!--Auf dieser Seite wird ein einzelner Newsartikel angezeigt.-->
<div name="newsartikel" id="newsartikel">
<?php
    /*
    *   Über die URL muss beim Aufrufen dieser Seite ein Attribut übergeben werden
    *   Zum Beispiel so: ....index.php?site=newsartikel&newsid=25
    *   Der Wert für die newsid wird über $_GET['newsid'] aus der URL gelesen und in $newsartikelID gespeichert
    */
	$newsartikelID=$_GET['newsid'];
	
	//Einbinden der Datenbank
	include('datenbank.php');
	
	//Datenbankanfrage: Gib mir alle Inhalte zu dem Newsartikel mit der newsid, die wie $newsartikelID
    $anfrage = 'SELECT newsid, titel, einleitung, text, uploadzeit, bildpfad1, bildtext1, bildpfad2, bildtext2, bildpfad3, bildtext3
                        FROM newsartikel
                        WHERE newsid='.$newsartikelID.'
                        LIMIT 1
                    ';
    
    //Datenbankergebnis               
    $ergebnis = mysql_query($anfrage)
            or die('Anfrage schlug fehl: '.mysql_error());
	$zeile = mysql_fetch_assoc($ergebnis);
	
	//Ausgabe des Ergebnisses	
	echo('
        <div class="newsbox">
            <div class="boxhead">
                <p id="uploadtime">'.$zeile['uploadzeit'].'</p>
                <h2 id="title">'.$zeile['titel'].'</h2>
            </div>
            <div style="white-space: wrap; min-height:800px" class="boxbody">
	               <div id="rightSide" style="float:right; margin-left:10px;">
        ');
                
        //Wenn das Bild existiert, dann wird es angezeigt und die lightbox-Funktion wird hinzugefügt
            if(file_exists("newsarticleimages/".$zeile['bildpfad1']."")){
                echo('
                    <a 
                        href="newsarticleimages/'.$zeile['bildpfad1'].'" 
                        data-lightbox="newsbilder" 
                        title="'.$zeile['bildtext1'].'">
                        
                        <img  
                            id="'.$zeile['newsid'].'a"  
                            width="200" 
                            height="200" 
                            src="newsarticleimages/'.$zeile['bildpfad1'].'" 
                            alt="'.$zeile['bildtext1'].'">
                    </a>
                ');
                
                //Überprüfen, ob eine Bildbeschreibung vorhanden ist, gegebenenfalls Ausgabe dieser
                 if($zeile['bildtext1']!="kein Bild vorhanden"){
                    echo('<p style="clear:right; ">'.$zeile['bildtext1'].'</p>');
                 }  else{
                     echo('<p style="clear:right; "></p>');
                 }  
            }
            
            //Wenn das Bild2 existiert, dann wird es angezeigt und die lightbox-Funktion wird hinzugefügt
            if(file_exists("newsarticleimages/".$zeile['bildpfad2']."")){
                echo('
                    <a 
                        href="newsarticleimages/'.$zeile['bildpfad2'].'" 
                        data-lightbox="newsbilder" 
                        title="'.$zeile['bildtext2'].'">
                        
                        <img  
                            id="'.$zeile['newsid'].'b"  
                            width="200" 
                            height="200" 
                            src="newsarticleimages/'.$zeile['bildpfad2'].'" 
                            alt="'.$zeile['bildtext2'].'">
                    </a>
                ');
                
                //Überprüfen, ob eine Bildbeschreibung vorhanden ist, gegebenenfalls Ausgabe dieser
                 if($zeile['bildtext2']!="kein Bild vorhanden"){
                    echo('<p style="clear:right; ">'.$zeile['bildtext2'].'</p>');
                 }  else{
                     echo('<p style="clear:right; "></p>');
                 }  
            }
            
            //Wenn das Bild3 existiert, dann wird es angezeigt und die lightbox-Funktion wird hinzugefügt
            if(file_exists("newsarticleimages/".$zeile['bildpfad3']."")){
                echo('
                    <a 
                        href="newsarticleimages/'.$zeile['bildpfad3'].'" 
                        data-lightbox="newsbilder" 
                        title="'.$zeile['bildtext3'].'">
                        
                        <img  
                            id="'.$zeile['newsid'].'c"  
                            width="200" 
                            height="200" 
                            src="newsarticleimages/'.$zeile['bildpfad3'].'" 
                            alt="'.$zeile['bildtext3'].'">
                    </a>
                ');
                
                //Überprüfen, ob eine Bildbeschreibung vorhanden ist, gegebenenfalls Ausgabe dieser
                 if($zeile['bildtext3']!="kein Bild vorhanden"){
                    echo('<p style="clear:right; ">'.$zeile['bildtext3'].'</p>');
                 }  else{
                     echo('<p style="clear:right; "></p>');
                 }  
            }
                
            //Der Text wird ausgegeben    
            echo('  
                        </div>
                        <p style="font-weight:bold;">'.$zeile['einleitung'].'</p> 
                     <p>'.$zeile['text'].'</p> 
                    </div>
                </div>
                ');
         
?>
</div> 