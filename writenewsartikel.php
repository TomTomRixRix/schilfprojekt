<!--Auf dieser Seite kann der Admin Newsartikel erstellen und in die Datenbank einspeichern -->

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
 
<!--In dieser Infobox wird erklärt, wie man den Text eines Newsartikels formatieren(unterstreichen, fett, kursiv, Links) kann --> 
<div id="infobox">Info...
	<span id="infoInhalt">
		<p>Um den Text zu formatieren, gehen Sie wie folgt vor:</p>
        <p>Abs&auml;tze:</p>
        <p>Setzen sie &quot;&lt;p&gt;&quot; vor den Text eines Absatzes und  &quot;&lt;/p&gt;&quot; nach den Text des Absatzes</p>
        <p>Der Beispielcode: &quot; &lt;p&gt;Die Exkursion ist heute um 10 Uhr.&lt;/p&gt; &lt;p&gt;Danach wird im Labor untersucht.&lt;/p&gt;&quot; w&uuml;rde so aussehen:</p>
        <p> <p>Die Exkursion ist heute um 10 Uhr.</p><p>Danach wird im Labor untersucht.</p> </p>
        <p><u>Unterstreichen:</u></p>
        <p>Setzen sie &quot;&lt;u&gt;&quot; vor den Text und  &quot;&lt;/u&gt;&quot; nach den Text</p>
        <p>Der Beispielcode: &quot; Die Exkursion ist  &lt;u&gt; heute &lt;/u&gt; um 10 Uhr. &quot; w&uuml;rde so aussehen:</p>
        <p> Die Exkursion ist <u>heute</u> um 10 Uhr. </p>
        <p><b>Fett:</b></p>
        <p>Setzen sie &quot;&lt;b&gt;&quot; vor den Text und  &quot;&lt;/b&gt;&quot; nach den Text</p>
        <p>Der Beispielcode: &quot; Die Exkursion ist  &lt;b&gt; heute &lt;/b&gt; um 10 Uhr. &quot; w&uuml;rde so aussehen:</p>
        <p> Die Exkursion ist <b>heute</b> um 10 Uhr. </p>
        <p><i>Kursiv:</i></p>
        <p>Setzen sie &quot;&lt;i&gt;&quot; vor den Text und  &quot;&lt;/i&gt;&quot; nach den Text</p>
        <p>Der Beispielcode: &quot; Die Exkursion ist  &lt;i&gt; heute &lt;/i&gt; um 10 Uhr. &quot; w&uuml;rde so aussehen:</p>
        <p> Die Exkursion ist <i>heute</i> um 10 Uhr. </p>
        <p><a>Links:</a></p>
        <p>Setzen sie "&lt;a href='[ihre verlinkte Seite]'&gt;" vor den Text und  ";&lt;/a&gt;" nach den Text</p>
        <p>Der Beispielcode: " Die Exkursion ist  &lt;a href='http://tms-hl.de/inf1213/12/schilf/Homepage_schilf/?site=home'&gt; heute &lt;/a&gt; um 10 Uhr. " w&uuml;rde so aussehen:</p>
        <p> Die Exkursion ist <a href="http://tms-hl.de/inf1213/12/schilf/Homepage_schilf/?site=home">heute</a> um 10 Uhr. </p>
    </span>
</div>

<!--Formular zum Eingeben der Daten. Die eingegebenen Werte werden mit post(method) an dieselbe Seite geshcickt(action) und dann im PHP-Teil in die Datenbank eingespeist-->
<form name="writenewsartikel" action="?site=writenewsartikel" method="post" enctype="multipart/form-data">
    <table id="tableone" name="tableone" align="center">
       <caption id="caption">Erstelle einen Newsartikel</caption>
            <tr>
                <td><label for="titel">&Uuml;berschrift: </label></td>
        		<td><input type="varchar" size="63" id="titel" name="titel"></td>
            </tr>
            <tr>
                <td><label for="einleitung">Einleitung: </label></td>
                <td><textarea id="einleitung" name="einleitung" cols="50" rows="4"></textarea></td>
            </tr>
            <tr>
                <td><label for="text">Text: </label></td>
                <td><textarea id="text" name="text" cols="50" rows="8"></textarea></td>
            </tr>
            <tr>
				<!--Ein Bild muss vorhanden sein für die Slidebox auf der Home-Seite. Der Name name="datei1" wird später im PHP-Teil verwendet-->
                <td>Bild 1 (Pflicht für die Slidebox): </td>
                <td><input type="file" name="datei1"></td>
            </tr>
            <tr> 
                <td><label for="bildtext1">Bildbeschreibung: </label></td>
                <td><input type="varchar" size="63" id="bildtext1" name="bildtext1"></td>
            </tr>
            <tr>
                <td>Bild 2 (optional): </td>
                <td><input type="file" name="datei2"></td>
            </tr>
            <tr> 
                <td><label for="bildtext2">Bildbeschreibung: </label></td>
                <td><input type="varchar" size="63" id="bildtext2" name="bildtext2"></td>
            </tr>
            <tr>
                <td>Bild 3 (optional): </td>
                <td><input type="file" name="datei3"></td>
            </tr>
            <tr> 
                <td><label for="bildtext3">Bildbeschreibung: </label></td>
                <td><input type="varchar" size="63" id="bildtext3" name="bildtext3"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input  type="submit" id="abschicken" name="abschicken" value="Abschicken" style="float:right;">
                </td>
            </tr>
    </table>
</form>

<?php
	// Der abschicken-input-submit-Button wurde gedrückt				
    if ( isset($_POST['abschicken']) ) {
		
		//Mithilfe von $_POST werden alle eingegebenen und übergebenen Daten in PHP-Variablen gespeichert
        $titel = $_POST['titel'];
        $einleitung = $_POST['einleitung'];
        $text =  $_POST['text'];
        
		//Der Zeitpunkt der Hochladens wird mitgespeichert
        date_default_timezone_set('Europe/Berlin');
        $datetime = date('Y-m-d H:i:s');
        
		//Datenbankanbindung
        include('datenbank.php');
		
		//Anfrage: Alle Werte werden in die passenden Spalten der Tabelle newsartikel gepackt
		//Als defaulttext für die Bildbeschreibung wird "kein Bild vorhanden" gesetzt und als Bildpfad "keinbild.png", was als default-Bild im Ordner newsarticleimages liegt
        $anfrage = 'INSERT INTO newsartikel (titel, einleitung, text, uploadzeit, bildpfad1, bildtext1, bildpfad2, bildtext2, bildpfad3, bildtext3)'. 'VALUES("'.$titel.'","'.$einleitung.'","'.$text.'","'.$datetime.'","keinBild.png","keinBild.png","keinBild.png","kein Bild vorhanden","kein Bild vorhanden","kein Bild vorhanden")'; 
        $ergebnis = mysql_query($anfrage) or die('Anfrage schlug fehl: '.mysql_error());
        
		//liefert die letzte NewsartikelID aus der Datenbank via SQL, welche gerade vorher durch autoincrement erstellt wurde
		
		
		include('datenbank.php');
        $anfrage = 'SELECT newsid FROM newsartikel ORDER BY newsid DESC LIMIT 1'; 
        $ergebnis = mysql_query($anfrage) or die('Anfrage schlug fehl: '.mysql_error());
        $zeile = mysql_fetch_assoc($ergebnis);
        $newsarticlenumber=$zeile['newsid'];
		
            
			//Es werden maximal drei Bilder hochgeladen. Deshalb wir die Schliefe dreimal durchlaufen
			//über $_FILES["name"]; wird der Bezug zu den Bildern hergestellt
            for($dateiindex=1;$dateiindex<=3;$dateiindex++){
                
            switch($dateiindex){
                case 1:
                        //gets original name from uploaded file
			            $dateiname=$_FILES['datei1']['name'];
            			//gets temporary name from uploaded file
            			$tempdatname=$_FILES['datei1']['tmp_name'];
            			//gets size from uploaded file
            			$size=$_FILES['datei1']['size'];
            			//gets type of picture file name from uploaded file
            			$type=$_FILES['datei1']['type'] ;
                        break;
                case 2:
                        //gets original name from uploaded file
    		            $dateiname=$_FILES['datei2']['name'];
            			//gets temporary name from uploaded file
            			$tempdatname=$_FILES['datei2']['tmp_name'];
            			//gets size from uploaded file
            			$size=$_FILES['datei2']['size'];
            			//gets type of picture file name from uploaded file
            			$type=$_FILES['datei2']['type'] ;
                        break;
                case 3:
                        //gets original name from uploaded file
    		            $dateiname=$_FILES['datei3']['name'];
            			//gets temporary name from uploaded file
            			$tempdatname=$_FILES['datei3']['tmp_name'];
            			//gets size from uploaded file
            			$size=$_FILES['datei3']['size'];
            			//gets type of picture file name from uploaded file
            			$type=$_FILES['datei3']['type'] ;
                        break;
                default:
                        $dateiname='dateiname';
                        $tempdatname='tempdatname';
                        break;
                        
            }
		
			
			//Testausgabe der Werte
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
			
            switch($dateiindex){
                case 1:
                    //creates path for every file type with newsarticle number and 'a' for dateiindex=1
            		$path1="newsarticleimages/".$newsarticlenumber."a.png";
        			if(file_exists($path1)){
        			unlink($path1);
        			}
        			$path2="newsarticleimages/".$newsarticlenumber."a.gif";
        			if(file_exists($path2)){
        			unlink($path2);
        			}
        			$path3="newsarticleimages/".$newsarticlenumber."a.jpg";
        			if(file_exists($path3)){
        			unlink($path3);
        			}
        			$path4="newsarticleimages/".$newsarticlenumber."a.jpeg";
        			if(file_exists($path4)){
        			unlink($path4);
        			}
                    break;
                case 2:
                    //creates path for every file type with newsarticle# and 'b' for dateiindex=2
                	$path1="newsarticleimages/".$newsarticlenumber."b.png";
        			if(file_exists($path1)){
        			unlink($path1);
        			}
        			$path2="newsarticleimages/".$newsarticlenumber."b.gif";
        			if(file_exists($path2)){
        			unlink($path2);
        			}
        			$path3="newsarticleimages/".$newsarticlenumber."b.jpg";
        			if(file_exists($path3)){
        			unlink($path3);
        			}
        			$path4="newsarticleimages/".$newsarticlenumber."b.jpeg";
        			if(file_exists($path4)){
        			unlink($path4);
        			}
                    break;
                case 3:
                    //creates path for every file type with newsarticle# and 'c' for dateiindex=3
                	$path1="newsarticleimages/".$newsarticlenumber."c.png";
        			if(file_exists($path1)){
        			unlink($path1);
        			}
        			$path2="newsarticleimages/".$newsarticlenumber."c.gif";
        			if(file_exists($path2)){
        			unlink($path2);
        			}
        			$path3="newsarticleimages/".$newsarticlenumber."c.jpg";
        			if(file_exists($path3)){
        			unlink($path3);
        			}
        			$path4="newsarticleimages/".$newsarticlenumber."c.jpeg";
        			if(file_exists($path4)){
        			unlink($path4);
        			}
                    break;
                default:
                    break;
            }
			
            //übermittelt die Bildbeschreibung
            $bildtext1=$_POST['bildtext1'];
            $bildtext2=$_POST['bildtext2'];
            $bildtext3=$_POST['bildtext3'];
            
            switch($dateiindex){
                case 1:
                    //saves uploaded file in folder newsarticleimages/
    		        //picture has the newsarticle nubmer + a for dateiindex=1 as file name
		            move_uploaded_file($_FILES['datei1']['tmp_name'],"newsarticleimages/".$newsarticlenumber."a".$dateiendung."");
					
					//if file is uploaded successfully 
                    if(file_exists("newsarticleimages/".$newsarticlenumber."a".$dateiendung."")){
						
						//save information in database
						$bildanfrage1='UPDATE newsartikel SET bildpfad1 = "'.$newsarticlenumber.'a'.$dateiendung.'" ,bildtext1 = "'.$bildtext1.'" WHERE newsid = "'.$newsarticlenumber.'"'; 
                    }else{
						
						//save information in database with default values
						$bildanfrage1='UPDATE newsartikel SET bildpfad1 ="keinBild.png",bildtext1 = "kein Bild vorhanden" WHERE newsid = "'.$newsarticlenumber.'"';    
                    }
					
                    $ergebnis = mysql_query($bildanfrage1) or die('Anfrage schlug fehl: '.mysql_error());
                    break;
                    
                case 2:
                    //saves uploaded file in folder newsarticleimages/
        	        //picture has the newsarticle nubmer + b for dateiindex=2 as file name
		            move_uploaded_file($_FILES['datei2']['tmp_name'],"newsarticleimages/".$newsarticlenumber."b".$dateiendung."");
                    
					//if file is uploaded successfully 
					if(file_exists("newsarticleimages/".$newsarticlenumber."b".$dateiendung."")){
						//save information in database
						$bildanfrage2='UPDATE newsartikel SET bildpfad2 = "'.$newsarticlenumber.'b'.$dateiendung.'" ,bildtext2 = "'.$bildtext2.'" WHERE newsid = "'.$newsarticlenumber.'"'; 
                    }else{
						//save information in database with default values
						$bildanfrage2='UPDATE newsartikel SET bildpfad2 ="keinBild.png",bildtext2 = "kein Bild vorhanden" WHERE newsid = "'.$newsarticlenumber.'"';    
                    }
                    $ergebnis = mysql_query($bildanfrage2) or die('Anfrage schlug fehl: '.mysql_error());
                    break;
                    
                case 3:
                    //saves uploaded file in folder newsarticleimages/
        	        //picture has the newsarticle nubmer + c for dateiindex=3 as file name
		            move_uploaded_file($_FILES['datei3']['tmp_name'], "newsarticleimages/".$newsarticlenumber."c".$dateiendung."");
					
					//if file is uploaded successfully 
                    if(file_exists("newsarticleimages/".$newsarticlenumber."c".$dateiendung."")){
						//save information in database
						$bildanfrage3='UPDATE newsartikel SET bildpfad3 = "'.$newsarticlenumber.'c'.$dateiendung.'" ,bildtext3 = "'.$bildtext3.'" WHERE newsid = "'.$newsarticlenumber.'"'; 
                    }else{
						//save information in database with default values
						$bildanfrage3='UPDATE newsartikel SET bildpfad3 ="keinBild.png",bildtext3 = "kein Bild vorhanden" WHERE newsid = "'.$newsarticlenumber.'"';    
                    }
                    $ergebnis = mysql_query($bildanfrage3) or die('Anfrage schlug fehl: '.mysql_error());
                    break;
                    
                default:
                    break;
            }
					//switches to newsarticlelist site
                    
					echo("<script language ='JavaScript'>
					window.location.replace('?site=newsartikellist'); 
					</script>");
							
		}
    }
?> 