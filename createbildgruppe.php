<!--Auf dieser Seite kann der Admin Bildergruppen erstellen. In diese Gruppen kann er dann später Bilder einfügen. -->

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

<div id="createbildgruppe">

    <!--Formular zum Eingeben der Daten. Die eingegebenen Werte werden mit post(method) an dieselbe Seite geshcickt(action) und dann im PHP-Teil in die Datenbank eingespeist-->
    <form name="createbildgruppe" action="?site=createbildgruppe" method="post">
    <table id="tableone" name="tableone" align="center">
       <caption id="caption">Erstelle Bildgruppe</caption>
        <tr>
            <td><label for="groupname">Gruppenname: </label></td>
        	<td><input type="varchar" size="50" id="groupname" name="groupname"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Bildgruppe erstellen" name="speichern" id="speichern"></td>
        </tr>
    </table>
    </form>
	
</div>

<?php
    // Der speichern-input-submit-Button wurde gedrückt
    if ( isset($_POST['speichern']) ) {
        
        //Mithilfe von $_POST werden alle eingegebenen und übergebenen Daten in PHP-Variablen gespeichert
        $groupname = $_POST['groupname'];
        
        //Datenbankanbindung
        include('datenbank.php');
        
        //Anfrage: Der Gruppenname wird in die Datenbank bildgruppe gespeichert
        $anfrage = 'INSERT INTO bildgruppe (gruppenname)'.'VALUES("'.$groupname.'")'; 
        $ergebnis = mysql_query($anfrage) or die('Anfrage schlug fehl: '.mysql_error());
        
        //Zurückleitung zut Admin-Seite
        echo("<script language ='JavaScript'>
                   window.location.replace('?site=admin'); 
		      </script>");
    }
    
    
?>