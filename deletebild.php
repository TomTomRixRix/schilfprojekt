<!--Auf dieser Seite kann der Admin Bilder löschen. Dies ist natürlich passwortgeschützt. Der Admin muss vorher auswählen welches Bild er lösche will. Dieses wird über die URL (mit einer ID) übergeben

Das Bild wird nur aus der Datenbank gelösch, sodass die Verknüpfung nicht mehr besteht. Das Bild bleibt aber trotzdem auf den Server. TO DO: Das könnte man noch ändern mit unlink([bildpfad])-->
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

<div id="deletebild">
    
     <?php
		//Die übergebene BildID(bildid) Variablen werden aus der URL ausgelesen und gespeichert
        $bildID=$_GET['bildid'];
		
		//Datenbankanbindung
        include('datenbank.php');
		
		//Datenbankanfrage: Liefer mir alle Werte von diesem Bild durch die eindeutige bildID
        $anfrage = 'SELECT bildID, text, urheber, bildpfad
                        FROM bilder
                        WHERE bildID="'.$bildID.'"
                    ';
                    
         $ergebnis = mysql_query($anfrage)
            or die('Anfrage schlug fehl: '.mysql_error());
        
		//Ausgabe der Bilddaten und des Bildes zum Überprüfen 
        while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
         
			echo('
				<p> <b>'.$zeile['bildID'].'</b></p>
				<p>Bildbeschreibung: '.$zeile['text'].'</p>
				<p>Bildurheber: '.$zeile['urheber'].'</p>
				<img width="400" height="400" src="'.$zeile['bildpfad'].'">
			');
        }
			
		//Abschließende Frage zum Löschen
        echo('
                
            <p>Wollen Sie dieses Bild wirklich l&ouml;schen?</p>
            <form action="?site=deletebild&bildid='.$bildID.'" method="post">
                <input type="submit" value="Ja, l&ouml;schen" id="delete" name="delete">
                <input type="submit" value="Nein, nicht l&ouml;schen" id="cacel" name="cancel">
            </form>  
            ');
    
		//Wenn "Ja, löschen" gedrückt wurde
        if ( isset($_POST['delete']) ) {
        
			//Datenbankanbindung
			include('datenbank.php');
			
			//Löschanfrage mit der bildID
			$anfrage = 'DELETE FROM bilder WHERE bildID="'.$bildID.'" '; 
			$ergebnis = mysql_query($anfrage) or die('Anfrage schlug fehl: '.mysql_error()); //Ergebnis bleibt unbehandelt
        
			//Zurückleitung zur Übersicht über die Bilder, wo der Admin herkommt
			echo("<script language ='JavaScript'>
                 window.location.replace('?site=bilderlist'); 
             </script>");
        } 
    
		//Wenn abbrechen gedrückt wurde
        if ( isset($_POST['cancel']) ) {
		
			//Zurückleitung zur Übersicht über die Bilder, wo der Admin herkommt
            echo("<script language ='JavaScript'>
                 window.location.replace('?site=bilderlist'); 
              </script>");
        }
    ?>
</div> 