<!--Hier wird die Anbindung an die Datenbank hergestellt. Diese Datei wird bei allen anderen Seiten, die mit der Datenbank zu tun haben durch include(datenbank.php); aufgerufen. Ansonsten gelangt man zur Datenbank auf folgender Website: http://tms-hl.de/phpmyadmin/index.php -->
<?php 
	$dblink = mysql_connect('localhost', 'schilf','schilf') 
	or die('Konnte keine Datenbankverbindung aufbauen: '.mysql_error()); 
	
	mysql_select_db('schilf') 
	or die('Konnte die Datenbank nicht ausgewählt werden: '.mysql_error()); 
	
?> 
