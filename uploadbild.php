<!--Auf dieser Seite kann der Admin Bilder hochladen, die dann in der Bildergalerie besichtigt werden können -->
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

<div id="uploadbild">
	<!--Formular zum Eingeben der Daten. Die eingegebenen Werte werden mit post(method) an dieselbe Seite geshcickt(action) und dann im PHP-Teil in die Datenbank eingespeist-->
    <form name="uploadbild" action="?site=uploadbild" method="post" enctype="multipart/form-data">
    <table id="tableone" name="tableone" align="center">
        <caption id="caption">Bild hochladen</caption>
    	<tr>
            <td>Bild ausw&auml;hlen (max. 1,5 MB): </td>
            <td><input type="file" id="datei" name="datei"></td>
        </tr>
		<tr>
			<td><label for="gruppe">Bildgruppe:</label></td>
			<td>
				<select name="gruppe" id="gruppe">
					
		<?php
			//Um auszuwählen in welche Bildgruppe/Bildordner werden alle Bildgruppen über PHP in das Select-Feld als <option> eingefügt
			echo('<option  value="0">--- bitte Ausw&auml;hlen ---</option>');
			
			//Datenbankanbindung
			include('datenbank.php');
			
			//Datenbankanfrage: Liefer' mir alle Gruppen mit Gruppennamen
			$anfrageGruppen='SELECT gruppenname, gruppenID FROM bildgruppe ';
			$ergebnisGruppen=mysql_query($anfrageGruppen)
				or die('Anfrage schlug fehl: '.mysql_error());
			
			//Erstelle für jede Gruppe eine option mit dem Wert der Gruppenid
			while ( $zeileGruppen = mysql_fetch_assoc($ergebnisGruppen) ) {
								   
				echo('<option value="'.$zeileGruppen['gruppenID'].'">'.$zeileGruppen['gruppenname'].'</option>');
				}	
		?>
				</select>
			</td>
		</tr>
        <tr>
            <td><label for="text">kurze Bildbeschreibung:</label></td>
        	<td><input type="varchar" size="50" id="text" name="text"></td>
        </tr>
		<tr>
            <td><label for="urheber">Urheber des Fotos:</label></td>
        	<td><input type="varchar" size="50" id="urheber" name="urheber"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Bild hochladen" name="speichern" id="speichern"></td>
        </tr>
    </table>
    </form>
</div>

<?php
	
	// Der speichern-input-submit-Button wurde gedrückt				
    if ( isset($_POST['speichern']) ) {
        
		//gets original name from uploaded file via $_FILES["datei"][...]
		$dateiname=$_FILES['datei']['name'];
        //gets temporary name from uploaded file
        $tempdatname=$_FILES['datei']['tmp_name'];
        //gets size from uploaded file
        $size=$_FILES['datei']['size'];
        //gets type of picture file name from uploaded file
		$type=$_FILES['datei']['type'] ;
		
		echo("Name: '.$dateiname.'");
		echo("Tempname: '.$tempdatname.'");
		echo("Size: '.$size.'");
		echo("TYP: '.$type.'");
		
		//defines file types
		$fileExt = pathinfo($dateiname, PATHINFO_EXTENSION);
        $fileExt = strtolower($fileExt);
		echo $fileExt;
		$dateipfad="galerie/".$dateiname."";
		if(file_exists($dateipfad)){
        	unlink($dateipfad);
        }
		
		//eigentliches hochladen des Bildes
		 move_uploaded_file($_FILES['datei']['tmp_name'],$dateipfad);
		
		//ERSTELLEN EINES THUMBNAILS für die Bildergalerie mit der Breite 300px
		
		//Setzt Ursprungspfad und Zielordner
		$PicPathIn="galerie/";
		$PicPathOut="thumbnailsgalerie/";
		
		 // Orginalbild
        //$bild="Foto.jpg";
        $bild=$dateiname;
        
        // Bilddaten ermitteln
        $size=getimagesize("$PicPathIn"."$bild");
        $breite=$size[0];
        $hoehe=$size[1];
        $neueBreite=300;
        $neueHoehe=intval($hoehe*$neueBreite/$breite);
        echo($size[2]);
        if($size[2]==1) {
        // GIF
            $altesBild=ImageCreateFromGIF("$PicPathIn"."$bild");
            $neuesBild=imageCreate($neueBreite,$neueHoehe);
            imageCopyResized($neuesBild,$altesBild,0,0,0,0,$neueBreite,$neueHoehe,$breite,$hoehe);
            imageGIF($neuesBild,"$PicPathOut".""."$bild");
            
        }
        
        if($size[2]==2) {
        // JPG
        
            
            $src_img=imagecreatefromjpeg("$PicPathIn"."$bild");
            $dst_img=imagecreatetruecolor($neueBreite,$neueHoehe);
            imagecopyresampled($dst_img,$src_img,0,0,0,0,$neueBreite,$neueHoehe, $size[0], $size[1]);
            imagejpeg($dst_img, "$PicPathOut"."$bild");
            imagedestroy($src_img);
            imagedestroy($dst_img);
            /**}*/
        }
        
        
        if($size[2]==3) {
        // PNG
            $altesBild=ImageCreateFromPNG("$PicPathIn"."$bild");
            $neuesBild=imageCreate($neueBreite,$neueHoehe);
            imageCopyResized($neuesBild,$altesBild,0,0,0,0,$neueBreite,$neueHoehe,$breite,$hoehe);
            ImagePNG($neuesBild,"$PicPathOut".""."$bild");
        }
		//*Thumbnails erstellen zuende*/
		
		//übergibt mit $_POST die eingegebenen Daten
		$gruppenID = $_POST['gruppe'];
		$text = $_POST['text'];
		$urheber = $_POST['urheber'];
		       
        //Fügt die Daten in die Datenbank. 
        $anfrage = 'INSERT INTO bilder (gruppenID,text,urheber,bildpfad)'.'VALUES("'.$gruppenID.'","'.$text.'","'.$urheber.'","'.$dateipfad.'")'; 
        $ergebnis = mysql_query($anfrage) or die('Anfrage schlug fehl: '.mysql_error());
			
		//Zurückleitung auf die Adminseite	
        echo("<script language ='JavaScript'>
           		           window.location.replace('?site=admin'); 
					      </script>");
    }   
?>