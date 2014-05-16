<!--Auf dieser Seite kann der Admin erstellte Termine aus der Datenbank löschen. Dies ist natürlich passwortgeschützt. Der Admin muss vorher auswählen welchen Termin er lösche will. Dies wird über die URL (mit einer ID) übergeben -->
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

<div id="deletetermin">
    
     <?php
		//Die TerminID(terminid) wird aus der URL ausgelesen und gespeichert
        $terminID=$_GET['terminid'];
		
		//Datenbankanbindung
        include('datenbank.php');
		
		//Datenbankanfrage: Liefer mir alle Werte von diesem dieses Termins
        $anfrage = 'SELECT terminid, terminzeit, terminbeschreibung
                        FROM termine
                        WHERE terminid="'.$terminID.'"
						
                    ';
                    
         $ergebnis = mysql_query($anfrage)
            or die('Anfrage schlug fehl: '.mysql_error());
        
		 //Ausgabe dieser Werte zum Überprüfen in einer Tabelle
        while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
         
			echo('
				<p> <b>'.$zeile['terminzeit'].'</b></p>
				<p>'.$zeile['terminbeschreibung'].'</p>
			');
        }
		
		//Abschließende Frage zum Löschen
        echo('
                
            <p>Wollen Sie diesen Termin wirklich l&ouml;schen?</p>
            <form action="?site=deletetermin&terminid='.$terminID.'" method="post">
                <input type="submit" value="Ja, l&ouml;schen" id="delete" name="delete">
                <input type="submit" value="Nein, nicht l&ouml;schen" id="cacel" name="cancel">
            </form>  
            ');
    
		//Wenn "Ja, löschen" gedrückt wurde
        if ( isset($_POST['delete']) ) {
        
		//Datenbankanbindung
        include('datenbank.php');
		
		//Löschanfrage mit TerminID
        $anfrage = 'DELETE FROM termine WHERE terminid="'.$terminID.'" '; 
        $ergebnis = mysql_query($anfrage) or die('Anfrage schlug fehl: '.mysql_error());
        
		//Zurückleitung zur Übersicht aller chemischen Messreihen, wo der Admin herkommt
        echo("<script language ='JavaScript'>
                 window.location.replace('?site=terminlist'); 
             </script>");
        } 
    
		//Wenn abbrechen gedrückt wurde
        if ( isset($_POST['cancel']) ) {
			//Zurückleitung zur Übersicht aller chemischen Messreihen, wo der Admin herkommt
            echo("<script language ='JavaScript'>
                 window.location.replace('?site=terminlist'); 
              </script>");
        }
    ?>
</div>
	
</div>