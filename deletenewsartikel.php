<!--Auf dieser Seite kann der Admin Newsartikel aus der Datenbank löschen. Dies ist natürlich passwortgeschützt. Der Admin muss vorher auswählen welchen Newsartikel er lösche will. Die NewsartikelID wird über die URL übergeben -->
<?php
//überprüfen, ob die SESSION Variable gesetzt ist
if(isset($_SESSION['status'])){

    //wenn ja, dann wird ihr Wert in $status gespeichert. Der Wert sollte 0 für nicht angemeldet und 1 für angemeldet sein
    $status=$_SESSION['status'];
        
}else{
    //wenn nein, dann ist $status 0
    $status='0';
}
        
//prüfen, ob der user angemeldet ist
if($status !='1'){
    //wenn nicht 1, dann ist der user nicht angemeldet und wird auf die login seite weitergeleitet
    echo("<script language ='JavaScript'>
	           window.location.replace('?site=login'); 
      </script>");
}
//wenn er angemeldet ist, passiert nichts und die Seite wird weiter geladen

//In dieser Zeile wird die SideBar in den Admin-Modus gesetzt. Dabei ist sie immer ausgefahren und zeigt die Navigationslinks an.
include('aktiviereAdminSideBar.php');
?>

<div id="deletenewsartikel">
	
     <?php
		//Die übergebene NewsartikelID(newsid) Variablen werden aus der URL ausgelesen und gespeichert
        $newsartikelID=$_GET['newsid'];
		
		//Datenbankanbindung
        include('datenbank.php');
		
		//Datenbankanfrage: Liefer mir alle Werte von des Newsartikels mit dieser ID
        $anfrage = 'SELECT newsid, titel, text, uploadzeit
                        FROM newsartikel
                        WHERE newsid= '.$newsartikelID.'
                    ';
                    
         $ergebnis = mysql_query($anfrage)
            or die('Anfrage schlug fehl: '.mysql_error());
        
		/*********************************
		//	Ausgabe dieser Werte zum Überprüfen in Newsartikelform 
		*	TO DO: ohne Einleitung, Bilder ...
		**********************************************/
        while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
         
        
            echo('
                <div class="newsbox" style="border-bottom: 2px solid black; background-color: white; border-radius:10px; padding: 1px 15px 5px 15px;
                    margin-bottom:10px;">
                    <div class="boxhead">
                        <p style="float:right;font-size:8pt;">'.$zeile['uploadzeit'].'</p>
                        <h2 style="text-decoration:underline;">'.$zeile['titel'].'</h2>
                    </div>
                    <div style="white-space: wrap;" class="boxbody">
                        <p style="white-space: wrap;">'.$zeile['text'].'</p>
                    </div>
                
                </div>
                ');
        }
        
		//Abschließende Frage zum Löschen
        echo('
                
            <p>Wollen Sie diesen Artikel wirklich l&ouml;schen?</p>
            <form action="?site=deletenewsartikel&newsid='.$newsartikelID.'" method="post">
                <input type="submit" value="Ja, l&ouml;schen" id="delete" name="delete">
                <input type="submit" value="Nein, nicht l&ouml;schen" id="cacel" name="cancel">
            </form>  
            ');
    ?>
    
    <?php
		//Wenn "Ja, löschen" gedrückt wurde
        if ( isset($_POST['delete']) ) {
        
		//Datenbankanbindung
        include('datenbank.php');
		
		//Löschanfrage mit NewsartikelID
        $anfrage = "DELETE FROM newsartikel WHERE newsid='".$newsartikelID."' "; 
        $ergebnis = mysql_query($anfrage) or die('Anfrage schlug fehl: '.mysql_error());
        //Ergebnis bleibt unbehandelt
		
		//Löschen, bzw. unlinken der Bilder. Da hier egal sein soll, welche Bildformate vorliegen, werden alle möglichen in der Schleife durchgegangen. a,b,c steht für die drei möglichen Bilder pro Artikel
        for($i=0;$i<=11;$i++){
            switch($i){
                case 0: 
                    $path="newsarticleimages/".$newsartikelID."a.png";
                    break;
                case 1: 
                    $path="newsarticleimages/".$newsartikelID."b.png";
                    break;
                case 2: 
                    $path="newsarticleimages/".$newsartikelID."c.png";
                    break;
                case 3: 
                    $path="newsarticleimages/".$newsartikelID."a.gif";
                    break;
                case 4: 
                    $path="newsarticleimages/".$newsartikelID."b.gif";
                    break;
                case 5: 
                    $path="newsarticleimages/".$newsartikelID."c.gif";
                    break;
                case 6: 
                    $path="newsarticleimages/".$newsartikelID."a.jpg";
                    break;
                case 7: 
                    $path="newsarticleimages/".$newsartikelID."b.jpg";
                    break;
                case 8: 
                    $path="newsarticleimages/".$newsartikelID."c.jpg";
                    break;
                case 9: 
                    $path="newsarticleimages/".$newsartikelID."a.jpeg";
                    break;
                case 10: 
                    $path="newsarticleimages/".$newsartikelID."b.jpeg";
                    break;
                case 11: 
                    $path="newsarticleimages/".$newsartikelID."c.jpeg";
                    break;
                default: 
                    
                    break;
            }            
			
			//Hier geschiet das Löschen ansich
            if(file_exists($path)){
               	unlink($path);
        	}    
        }
        
		//Zurückleitung zur Übersicht aller chemischen Messreihen, wo der Admin herkommt
        echo("<script language ='JavaScript'>
                 window.location.replace('?site=newsartikellist'); 
              </script>");
        } 
		
		//Wenn abbrechen gedrückt wurde
        if ( isset($_POST['cancel']) ) {
			//Zurückleitung zur Übersicht aller chemischen Messreihen, wo der Admin herkommt
            echo("<script language ='JavaScript'>
                 window.location.replace('?site=newsartikellist'); 
              </script>");
        }
    ?>
</div>