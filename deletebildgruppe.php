<!--Auf dieser Seite kann der Admin Bildgruppen/Bildordner löschen. Dies ist natürlich passwortgeschützt. Der Admin muss vorher auswählen welche Gruppe er lösche will. Diese werden über die URL (mit einer ID) übergeben -->
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

<div id="deletebildgruppe">
    
     <?php
		//Die übergebene GruppenID(gruppenid) Variablen werden aus der URL ausgelesen und gespeichert
        $gruppenID=$_GET['gruppenid'];
		
		//Datenbankanbindung
        include('datenbank.php');
		
		//Datenbankanfrage: Liefer mir alle Werte(naja nur den Namen) von dieser Bildgruppe mit der eindeutigen ID
        $anfrage = 'SELECT gruppenname, gruppenID
                        FROM bildgruppe
                        WHERE gruppenID="'.$gruppenID.'"
                    ';
                    
        $ergebnis = mysql_query($anfrage)
            or die('Anfrage schlug fehl: '.mysql_error());
        
		//Ausgabe des Gruppennames zum Überprüfen 
        while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
			echo('
				<p> <b>'.$zeile['gruppenname'].'</b></p>
			');
        }
		
		//Abschließende Frage zum Löschen
        echo('  
            <p>Wollen Sie diese Bildgruppe wirklich l&ouml;schen?</p>
            <form action="?site=deletebildgruppe&gruppenid='.$gruppenID.'" method="post">
                <input type="submit" value="Ja, l&ouml;schen" id="delete" name="delete">
                <input type="submit" value="Nein, nicht l&ouml;schen" id="cacel" name="cancel">
            </form>  
            ');
		
		//Wenn "Ja, löschen" gedrückt wurde
        if ( isset($_POST['delete']) ) {
        
			//Datenbankanbindung
			include('datenbank.php');
			
			//Löschanfrage mit der GruppenID
			$anfrage = 'DELETE FROM bildgruppe WHERE gruppenID="'.$gruppenID.'" '; 
			
			//Ergebnis bleibt unbehandelt
			$ergebnis = mysql_query($anfrage) or die('Anfrage schlug fehl: '.mysql_error());
        
		//Zurückleitung zur Übersicht über die Bildgruppen, wo der Admin herkommt
        echo("<script language ='JavaScript'>
                 window.location.replace('?site=bildgruppelist'); 
             </script>");
        } 
    
		//Wenn abbrechen gedrückt wurde
        if ( isset($_POST['cancel']) ) {
		
			//Zurückleitung zur Übersicht über die Bildgruppen, wo der Admin herkommt
            echo("<script language ='JavaScript'>
                 window.location.replace('?site=bildgruppelist'); 
              </script>");
        }
    ?>
</div>