<!--Auf dieser Seite kann der Admin Newsartikel bearbeiten und ändern und in die Datenbank einspeichern. Auch die Bilder können gelöscht und neu hochgeladen werden. Die NewsartikelID musste übergeben werden -->

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

<div id="editnewsartikel">
	<?php
		//Auslesen der newsid, die über die URL übergeben wurden	
        $newsartikelID=$_GET['newsid'];
        
        //Datenbankanbindung
        include('datenbank.php');
		
		//Datenbankanfrage: Liefer' alle von dem Newsartikel mit dieser ID
        $anfrage = 'SELECT newsid, titel, einleitung, text, uploadzeit, bildpfad1, bildtext1, bildpfad2, bildtext2, bildpfad3, bildtext3
                        FROM newsartikel
                        WHERE newsid='.$newsartikelID.'
                        LIMIT 1
                    ';
                   
        $ergebnis = mysql_query($anfrage)
            or die('Anfrage schlug fehl: '.mysql_error());
			
		//Die Ergebnisse werden mithilfe von value="..." in das Formular der input-Seite voreingefügt, sodass sie nur noch bearbeitet werden müssen
		$zeile = mysql_fetch_assoc($ergebnis); 
         
        echo('
<form name="editnewsartikel" action="?site=editnewsartikel&newsid='.$newsartikelID.'" method="post">
    <table id="tableone" name="tableone" align="center">
       <caption id="caption">Bearbeite Newsartikel</caption>
            <tr> 
                <td><label for="titel">&Uuml;berschrift: </label></td>
            	<td><input type="varchar" size="63" id="titel" name="titel" value="'.$zeile['titel'].'"></td>
            </tr>
            <tr>
                <td><label for="einleitung">Einleitung: </label></td>
                <td><textarea id="einleitung" name="einleitung" cols="50" rows="4">'.$zeile['einleitung'].'</textarea></td>
            </tr>
            <tr>
                <td><label for="text">Text: </label></td>
                <td><textarea id="text" name="text" cols="50" rows="8">'.$zeile['text'].'</textarea></td>
            </tr>
            
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Abbrechen und zur&uuml;ck zur Newsliste" id="cacel" name="cancel" >
                    <input type="submit" id="abschicken" name="abschicken" value="In Datenbank &auml;ndern">
                </td>
            </tr>
    </table>
</form>
        ');
     
		//Genauso wie beim erstmaligen eingeben der Daten bei "writenewsartikel". 
        if ( isset($_POST['abschicken']) ) {
		
		//TO DO: Ungültige Eingabe, wenn kein Wert eingefügt wurde. Oder -1 als default. Versuche es mal TO DO: Und Dezimalzahlen müssen mit Punkt getrennt werden
		//Die eingegebenen Werte, oder voreingegebenen, werden mit $_POST[] in PHP-Variablen gespeichert
        $titel = $_POST['titel'];
        $einleitung = $_POST['einleitung'];
        $text =  $_POST['text'];
        $bildtext1 =  $_POST['bildtext1'];
        $bildtext2 =  $_POST['bildtext2'];
        $bildtext3 =  $_POST['bildtext3'];
        
        //Datenbankanbindung
        include('datenbank.php');
		
		//Datenbank wird geupdatet
        $anfrage = "UPDATE newsartikel SET titel='".$titel."' , einleitung='".$einleitung."' , text='".$text."'WHERE newsid='".$newsartikelID."' "; 
        $ergebnis = mysql_query($anfrage) or die('Anfrage schlug fehl: '.mysql_error());
        
        //	Zurückleitung zur Newsartikelübersicht, wo der Admin herkommt
         echo("<script language ='JavaScript'>
                 window.location.replace('?site=newsartikellist'); 
              </script>");
        }
        
		//Wenn abbrechen gedrückt wurde
        if ( isset($_POST['cancel']) ) {
		
			//	Zurückleitung zur Newsartikelübersicht, wo der Admin herkommt
            echo("<script language ='JavaScript'>
                 window.location.replace('?site=newsartikellist'); 
              </script>");
        }
        
        
        //BILDER ÄNDERN
		//Erstmal Bilder und Beschreibung anzeigen, mitsamt Buttons zum löschen der alten Bilder und hochladen der neuen
echo('
    <table align="center" style="margin-bottom:25px;">
    <form action="?site=editnewsartikel&newsid='.$newsartikelID.'" method="post" enctype="multipart/form-data">
    <tr style="font-weight:bold;">
        <td>Altes Bild 1:</td>
        <td>Altes Bild 2:</td>
        <td>Altes Bild 3:</td>
    </tr>
    <tr>
        <td><img id="'.$zeile['newsid'].'a" style="width="100" height="100" src="newsarticleimages/'.$zeile['bildpfad1'].'" alt="'.$zeile['bildtext1'].'"></td>
        <td><img id="'.$zeile['newsid'].'b" style="width="100" height="100" src="newsarticleimages/'.$zeile['bildpfad2'].'" alt="'.$zeile['bildtext2'].'"></td>
        <td><img id="'.$zeile['newsid'].'c" style="width="100" height="100" src="newsarticleimages/'.$zeile['bildpfad3'].'" alt="'.$zeile['bildtext3'].'"></td>
    </tr>
     <tr>
       
            <td><input type="submit" value="Altes Bild 1 l&ouml;schen" id="delete1" name="delete1"></td>
            <td><input type="submit" value="Altes Bild 2 l&ouml;schen" id="delete2" name="delete2"></td>
            <td><input type="submit" value="Altes Bild 3 l&ouml;schen" id="delete3" name="delete3"></td>   
         
    </tr>
    <tr style="display:hidden;">
        <td style="visibility:hidden;">. </td>
        <td style="visibility:hidden;">. </td>
        <td style="visibility:hidden;">. </td>
    </tr>
    <tr style="font-weight:bold;">
        <td><label for="datei1">Neues Bild 1 (optional): </label></td>
        <td><label for="datei2">Neues Bild 2 (optional): </label></td>
        <td><label for="datei3">Neues Bild 3 (optional): </label></td>
    </tr> 
    <tr>
        <td><input type="file" id="datei1" name="datei1"></td>
        <td><input type="file" id="datei2" name="datei2"></td>
        <td><input type="file" id="datei3" name="datei3"></td>
    </tr> 
    <tr>
        <td><label for="bildtext1">Bildbeschreibung: </label></td>
        <td><label for="bildtext2">Bildbeschreibung: </label></td>
        <td><label for="bildtext3">Bildbeschreibung: </label></td>
    </tr> 
    <tr>
        <td><input type="varchar" size="20" id="bildtext1" name="bildtext1" value="'.$zeile['bildtext1'].'"></td>
        <td><input type="varchar" size="20" id="bildtext2" name="bildtext2" value="'.$zeile['bildtext2'].'"></td>
        <td><input type="varchar" size="20" id="bildtext3" name="bildtext3" value="'.$zeile['bildtext3'].'"></td>
    </tr>
    <tr style="display:hidden;">
        <td style="visibility:hidden;">. </td>
        <td style="visibility:hidden;">. </td>
        <td style="visibility:hidden;">. </td>
    </tr>
    <tr>
        <td><input type="submit" value="Neues Bild 1 hochladen" id="update1" name="update1"></td>
        <td><input type="submit" value="Neues Bild 2 hochladen" id="update2" name="update2"></td>
        <td><input type="submit" value="Neues Bild 3 hochladen" id="update3" name="update3"></td>
    </tr>
    </form>
    </table>
            ');
        
	//Wenn "Bild 1 löschen" gedrückt wurde	
    if ( isset($_POST['delete1']) ) {
	
			//Löscht die Verlinkung zum alten Bild und setzt die default-Werte
            $bildanfrage1='UPDATE newsartikel SET bildpfad1 = "keinBild.png" ,bildtext1 = "kein Bild vorhanden" WHERE newsid = "'.$newsartikelID.'"'; 
            $ergebnis = mysql_query($bildanfrage1) or die('Anfrage schlug fehl: '.mysql_error());
			
			//Geht alle Dateiformate beim Löschen durch
            for($i=0;$i<3;$i++){
            switch($i){
                case 0: 
                    $path="newsarticleimages/".$newsartikelID."a.png";
                    break;
                case 1: 
                    $path="newsarticleimages/".$newsartikelID."a.gif";
                    break;
                case 2: 
                    $path="newsarticleimages/".$newsartikelID."a.jpg";
                    break;
                case 3: 
                    $path="newsarticleimages/".$newsartikelID."a.jpeg";
                    break;
                
                default: 
                    break;
            }            
			
			//Eigentliches löschen des Bildes
            if(file_exists($path)){
                   unlink($path);
        	} 
        }
		
		//weiterleitung auf dieselbe Seite um weiter zu ändern
        echo("<script language ='JavaScript'>
                 window.location.replace('?site=editnewsartikel&newsid=".$newsartikelID."'); 
              </script>");
    }  
    
	//Wenn "Bild 2 löschen" gedrückt wurde
    if ( isset($_POST['delete2']) ) {
	
			//Löscht die Verlinkung zum alten Bild und setzt die default-Werte
            $bildanfrage1='UPDATE newsartikel SET bildpfad2 = "keinBild.png" ,bildtext2 = "kein Bild vorhanden" WHERE newsid = "'.$newsartikelID.'"'; 
            $ergebnis = mysql_query($bildanfrage1) or die('Anfrage schlug fehl: '.mysql_error());
			
			//Geht alle Dateiformate beim Löschen durch
            for($i=0;$i<3;$i++){
            switch($i){
                case 0: 
                    $path="newsarticleimages/".$newsartikelID."b.png";
                    break;
                case 1: 
                    $path="newsarticleimages/".$newsartikelID."b.gif";
                    break;
                case 2: 
                    $path="newsarticleimages/".$newsartikelID."b.jpg";
                    break;
                case 3: 
                    $path="newsarticleimages/".$newsartikelID."b.jpeg";
                    break;
                
                default: 
                    break;
            }            
			
			//Eigentliches löschen des Bildes
            if(file_exists($path)){
                   unlink($path);
            } 
        }
		
		//weiterleitung auf dieselbe Seite um weiter zu ändern
        echo("<script language ='JavaScript'>
                 window.location.replace('?site=editnewsartikel&newsid=".$newsartikelID."'); 
              </script>");
    } 
    
	//Wenn "Bild 3 löschen" gedrückt wurde
    if ( isset($_POST['delete3']) ) {
	
			//Löscht die Verlinkung zum alten Bild und setzt die default-Werte
            $bildanfrage1='UPDATE newsartikel SET bildpfad3 = "keinBild.png" ,bildtext3 = "kein Bild vorhanden" WHERE newsid = "'.$newsartikelID.'"'; 
            $ergebnis = mysql_query($bildanfrage1) or die('Anfrage schlug fehl: '.mysql_error());
			
			//Geht alle Dateiformate beim Löschen durch
            for($i=0;$i<3;$i++){
            switch($i){
                case 0: 
                    $path="newsarticleimages/".$newsartikelID."c.png";
                    break;
                case 1: 
                    $path="newsarticleimages/".$newsartikelID."c.gif";
                    break;
                case 2: 
                    $path="newsarticleimages/".$newsartikelID."c.jpg";
                    break;
                case 3: 
                    $path="newsarticleimages/".$newsartikelID."c.jpeg";
                    break;
                
                default: 
                    break;
            }            
			
			//Eigentliches löschen des Bildes
            if(file_exists($path)){
                   unlink($path);
            } 
        }
        
		//weiterleitung auf dieselbe Seite um weiter zu ändern
        echo("<script language ='JavaScript'>
                 window.location.replace('?site=editnewsartikel&newsid=".$newsartikelID."'); 
              </script>");
    } 
    
	//Wenn "neues Bild1 hochladen" gedrückt wurde, dann wie bei "writenewsartikel.php"
    if( isset($_POST['update1'])){
        
            $newsarticlenumber=$newsartikelID;
            
            //gets original name from uploaded file
			$dateiname=$_FILES['datei1']['name'];
            //gets temporary name from uploaded file
            $tempdatname=$_FILES['datei1']['tmp_name'];
            //gets size from uploaded file
            $size=$_FILES['datei1']['size'];
            //gets type of picture file name from uploaded file
            $type=$_FILES['datei1']['type'] ;
                       
			echo("Name: '.$dateiname.'");
			echo("Tempname: '.$tempdatname.'");
			echo("Size: '.$size.'");
			echo("TYP: '.$type.'");
			
			//defines file types
			if($type=='image/png'){
			$dateiendung=".png";
			}else if($type=='image/gif'){
			$dateiendung=".gif";
			}else if($type=='image/jpg'){
			$dateiendung=".jpg";
			}else if($type=='image/jpeg'){
			$dateiendung=".jpeg";
			}
			
            $bildtext1=$_POST['bildtext1'];
            
            //saves uploaded file in newsimages
    		//picture has the newsarticle nubmer + a for dateiindex=1 as file name
		    move_uploaded_file($_FILES['datei1']['tmp_name'], 
            "newsarticleimages/".$newsarticlenumber."a".$dateiendung."");
            $bildanfrage1='UPDATE newsartikel SET bildpfad1 = "'.$newsarticlenumber.'a'.$dateiendung.'" ,bildtext1 = "'.$bildtext1.'" WHERE newsid = "'.$newsarticlenumber.'"'; 
            $ergebnis = mysql_query($bildanfrage1) or die('Anfrage schlug fehl: '.mysql_error());
            
            echo("<script language ='JavaScript'>
                 window.location.replace('?site=editnewsartikel&newsid=".$newsartikelID."'); 
              </script>");
    }
    
	//Wenn "neues Bild2 hochladen" gedrückt wurde, dann wie bei "writenewsartikel.php"
    if( isset($_POST['update2'])){
            $newsarticlenumber=$newsartikelID;
            
            //gets original name from uploaded file
			$dateiname=$_FILES['datei2']['name'];
            //gets temporary name from uploaded file
            $tempdatname=$_FILES['datei2']['tmp_name'];
            //gets size from uploaded file
            $size=$_FILES['datei2']['size'];
            //gets type of picture file name from uploaded file
            $type=$_FILES['datei2']['type'] ;
                       
			echo("Name: '.$dateiname.'");
			echo("Tempname: '.$tempdatname.'");
			echo("Size: '.$size.'");
			echo("TYP: '.$type.'");
			
			//defines file types
			if($type=='image/png'){
			$dateiendung=".png";
			}else if($type=='image/gif'){
			$dateiendung=".gif";
			}else if($type=='image/jpg'){
			$dateiendung=".jpg";
			}else if($type=='image/jpeg'){
			$dateiendung=".jpeg";
			}
			
            $bildtext2=$_POST['bildtext2'];
            
            //saves uploaded file in newsimages
    		//picture has the newsarticle nubmer + b  as file name
		    move_uploaded_file($_FILES['datei2']['tmp_name'], 
            "newsarticleimages/".$newsarticlenumber."b".$dateiendung."");
            $bildanfrage2='UPDATE newsartikel SET bildpfad2 = "'.$newsarticlenumber.'b'.$dateiendung.'" ,bildtext2 = "'.$bildtext2.'" WHERE newsid = "'.$newsarticlenumber.'"'; 
            $ergebnis = mysql_query($bildanfrage2) or die('Anfrage schlug fehl: '.mysql_error());
            
            echo("<script language ='JavaScript'>
                 window.location.replace('?site=editnewsartikel&newsid=".$newsartikelID."'); 
              </script>");
    }    
    
	//Wenn "neues Bild3 hochladen" gedrückt wurde, dann wie bei "writenewsartikel.php"
    if( isset($_POST['update3'])){
            $newsarticlenumber=$newsartikelID;
            
            //gets original name from uploaded file
			$dateiname=$_FILES['datei3']['name'];
            //gets temporary name from uploaded file
            $tempdatname=$_FILES['datei3']['tmp_name'];
            //gets size from uploaded file
            $size=$_FILES['datei3']['size'];
            //gets type of picture file name from uploaded file
            $type=$_FILES['datei3']['type'] ;
                       
			echo("Name: '.$dateiname.'");
			echo("Tempname: '.$tempdatname.'");
			echo("Size: '.$size.'");
			echo("TYP: '.$type.'");
			
			//defines file types
			if($type=='image/png'){
			$dateiendung=".png";
			}else if($type=='image/gif'){
			$dateiendung=".gif";
			}else if($type=='image/jpg'){
			$dateiendung=".jpg";
			}else if($type=='image/jpeg'){
			$dateiendung=".jpeg";
			}
            
            $bildtext3=$_POST['bildtext3'];
            
            //saves uploaded file in newsimages
    		//picture has the newsarticle nubmer + c  as file name
		    move_uploaded_file($_FILES['datei3']['tmp_name'], 
            "newsarticleimages/".$newsarticlenumber."c".$dateiendung."");
            $bildanfrage3='UPDATE newsartikel SET bildpfad3 = "'.$newsarticlenumber.'c'.$dateiendung.'" ,bildtext3 = "'.$bildtext3.'" WHERE newsid = "'.$newsarticlenumber.'"'; 
            $ergebnis = mysql_query($bildanfrage3) or die('Anfrage schlug fehl: '.mysql_error());
            
            
            echo("<script language ='JavaScript'>
                 window.location.replace('?site=editnewsartikel&newsid=".$newsartikelID."'); 
              </script>");
    }
    
    ?>
</div>