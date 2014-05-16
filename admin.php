<!--Dies ist die Admin-Seite, die nur über die URL erreichbar sein soll. Von hieraus kann die Schilfwebsite verwaltet werden.-->

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

<!--Dies ist der Admin-Bereich, der normalerweise Passwort-gesch&uuml;tzt sein soll.-->
<div name="admin">

    Guten Tag, Sie sind eingeloggt. Im Adminbereich k&ouml;nnen Sie die Schilfwebsite verwalten. Viel Spa&szlig; dabei!
    
    <!--Counter, wir viele Leute die Startseite der Homepage schon aufgerufen haben, wird ausgegeben -->
    <?php
				//Anbindung zur Datenbank
                include('datenbank.php');
				
               $anfrage = 'SELECT counter FROM statistik LIMIT 1';
                    
                $ergebnis = mysql_query($anfrage) 
				or die('Anfrage schlug fehl: '.mysql_error());
				while($zeile = mysql_fetch_assoc($ergebnis)){
				    echo("<p>Es haben bereits ".$zeile['counter']." Personen die Startseite besucht!</p>");
				   
				}
				
    ?>
    
    <!--p>Hier geht es zur <a href="?site=inputchemdata">Dateneingabe</a> der chemischen Parameter</p>
    <p>&Uuml;bersicht &uuml;ber alle <a href="?site=chemdatalist">chemischen Messreihen</a></p>
    <p>Hier geht es zur <a href="?site=inputbiodata">Dateneingabe</a> der biologischen Einzelmessergebnisse</p>
    <p>Hier geht es zur <a href="?site=inputbiomitteldata">Dateneingabe</a> der biologischen Mittelwerte</p>
    <p>&Uuml;bersicht &uuml;ber alle <a href="?site=biomitteldatalist">biologischen Mittelwerte</a> und von dortaus auch zu den 50 Einzelergebnissen</p>
    <p>Schreibe einen neuen <a href="?site=writenewsartikel">Newsartikel</a></p>
    <p><a href="?site=newsartikellist">Liste aller Newsartikel</a></p>
    <p>Bild f&uuml;r die Galerie hochladen: <a href="?site=uploadbild">Bildupload</a></p>
    <p>Zur <a href="?site=bilderlist">Bilderliste</a></p>
    <p>Einen neuen <a href="?site=writetermin">Termin</a> erstellen</p>
    <p>Zur <a href="?site=terminlist">Terminliste</a></p>
    <p>Eine neue <a href="?site=createbildgruppe">Bildgruppe</a> erstellen</p>
    <p>Zur <a href="?site=bildgruppelist">Bildgruppenliste</a></p>
    <p><a href="?site=thumbnails">Thumbnail </a> eines Bildes erstellen</p-->
    
    
    
</div>


<!--Damit die SideBar nicht ausfahrbar ist>
<div id="homeTexthead"></div>

<script type="text/javascript">

$(document).ready(function(){
    $("#SideBar").width("22%");
    $("#center").width("75%");
    $("#sideBarInhalt").hide();
    $("#sideBarInfoBox").hide();
    $("#SideBar").append('<p>Hier geht es zur <a href="?site=inputchemdata">Dateneingabe</a> der chemischen Parameter</p> <p>&Uuml;bersicht &uuml;ber alle <a href="?site=chemdatalist">chemischen Messreihen</a></p>     <p>Hier geht es zur <a href="?site=inputbiodata">Dateneingabe</a> der biologischen Einzelmessergebnisse</p>     <p>Hier geht es zur <a href="?site=inputbiomitteldata">Dateneingabe</a> der biologischen Mittelwerte</p>     <p>&Uuml;bersicht &uuml;ber alle <a href="?site=biomitteldatalist">biologischen Mittelwerte</a> und von dortaus auch zu den 50 Einzelergebnissen</p>     <p>Schreibe einen neuen <a href="?site=writenewsartikel">Newsartikel</a></p>     <p><a href="?site=newsartikellist">Liste aller Newsartikel</a></p>     <p>Bild f&uuml;r die Galerie hochladen: <a href="?site=uploadbild">Bildupload</a></p>     <p>Zur <a href="?site=bilderlist">Bilderliste</a></p>     <p>Einen neuen <a href="?site=writetermin">Termin</a> erstellen</p>     <p>Zur <a href="?site=terminlist ">Terminliste</a></p>     <p>Eine neue <a href="?site=createbildgruppe">Bildgruppe</a> erstellen</p>     <p>Zur <a href="?site=bildgruppelist">Bildgruppenliste</a></p>     <p><a href="?site=thumbnails">Thumbnail </a> eines Bildes erstellen</p> ');
});
</script-->

