<!--Auf dieser Seite kann der Admin Termine erstellen. Dies ist natürlich passwortgeschützt. Die Termine werden dann in der SideBar angezeigt.-->
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

<!--Formular zum Eingeben der Daten (Datum/Uhrzeit als Text). Die eingegebenen Werte werden mit post(method) an dieselbe Seite geshcickt(action) und dann im PHP-Teil in die Datenbank eingespeist-->
<div id="writetermin">
    <form name="writetermin" action="?site=writetermin" method="post">
    <table id="tableone" name="tableone" align="center">
       <caption id="caption">Erstelle einen Termin</caption>
        <tr>
            <td><label for="terminzeit">Datum / Uhrzeit: </label></td>
        	<td><input type="varchar" size="63" id="terminzeit" name="terminzeit"></td>
        </tr>
        <tr>
            <td><label for="terminbeschreibung">Beschreibung: </label></td>
            <td><textarea id="terminbeschreibung" name="terminbeschreibung" cols="50" rows="10"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Termin speichern" name="speichern" id="speichern"></td>
        </tr>
    </table>
    </form>
	
</div>

<?php
	// Der speichern-input-submit-Button wurde gedrückt	
    if ( isset($_POST['speichern']) ) {
	
		/****************************************************************************************
		*	TO DO: Ungültige Eingabe, wenn kein Wert eingefügt wurde.  
		*****************************************************************************************/
		
		//Mithilfe von $_POST werden alle eingegebenen und übergebenen Daten in PHP-Variablen gespeichert
        $terminzeit = $_POST['terminzeit'];
        $terminbeschreibung = $_POST['terminbeschreibung'];
        
		//Datenbankanbindung
        include('datenbank.php');
		
		//Anfrage: Packe alle Werte in die passenden Spalten der Tabelle termine
        $anfrage = 'INSERT INTO termine (terminzeit,terminbeschreibung)'.'VALUES("'.$terminzeit.'","'.$terminbeschreibung.'")'; 
        $ergebnis = mysql_query($anfrage) or die('Anfrage schlug fehl: '.mysql_error());
        
		//Zurückleitung zur Adminseite
        echo("<script language ='JavaScript'>
            		           window.location.replace('?site=admin'); 
					      </script>");
    }
    
    
?>