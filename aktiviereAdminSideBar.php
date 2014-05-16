<!--In dieser Datein wird die SideBar in den Admin-Modus gesetzt. Dabei ist sie immer ausgefahren und zeigt die Navigationslinks an.-->
<div id="aktiviereAdminSideBar">
	<!--Damit die SideBar immer ausgefahren ist-->
	<div id="homeTexthead"></div>
 
	<script type="text/javascript"> 
 
	$(document).ready(function(){
	   // $("#sideBarButton").hide();
		$("#SideBar").width("22%"); 
		$("#center").width("75%"); 
		$("#SideBar").show(); 
		$("#sideBarInhalt").hide(); 
		$("#SideBar").append(' <div style="padding:20px; font-size:11pt;"><p>Hier geht es zur <a href="?site=inputchemdata">Dateneingabe</a> der chemischen Parameter</p> <p>&Uuml;bersicht &uuml;ber alle <a href="?site=chemdatalist">chemischen Messreihen</a></p>     <p>Hier geht es zur <a href="?site=inputbiodata">Dateneingabe</a> der biologischen Einzelmessergebnisse</p>     <p>Hier geht es zur <a href="?site=inputbiomitteldata">Dateneingabe</a> der biologischen Mittelwerte</p>     <p>&Uuml;bersicht &uuml;ber alle <a href="?site=biomitteldatalist">biologischen Mittelwerte</a> und von dortaus auch zu den 50 Einzelergebnissen</p>     <p>Schreibe einen neuen <a href="?site=writenewsartikel">Newsartikel</a></p>     <p><a href="?site=newsartikellist">Liste aller Newsartikel</a></p>     <p>Bild f&uuml;r die Galerie hochladen: <a href="?site=uploadbild">Bildupload</a></p>     <p>Zur <a href="?site=bilderlist">Bilderliste</a></p>     <p>Einen neuen <a href="?site=writetermin">Termin</a> erstellen</p>     <p>Zur <a href="?site=terminlist ">Terminliste</a></p>     <p>Eine neue <a href="?site=createbildgruppe">Bildgruppe</a> erstellen</p>     <p>Zur <a href="?site=bildgruppelist">Bildgruppenliste</a></p>     <p><a href="?site=thumbnails">Thumbnail </a> eines Bildes erstellen</p> </div>'); 
	    $('#toAdmin').hide();
	    
	    
	 });
	
	
	</script>
</div>