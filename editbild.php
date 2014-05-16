<!--Auf dieser Seite kann der Admin Bilder bearbeiten, bzw. nur die Bildinformationen ändern. Dies ist natürlich passwortgeschützt. Die BildID wurden über die URL übergeben.-->
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

<div id="editbild">
	<?php
		//Auslesen der Bildid, die über die URL übergeben wurden
		$bildID=$_GET['bildid'];
		
        //Datenbankanbindung
		include('datenbank.php');
		
		//Datenbankanfrage: Liefer' alle Bildinformationen von dieser BildID
        $anfrage = 'SELECT bildID, text, urheber, bildpfad,gruppenID
                        FROM bilder
                        WHERE bildID="'.$bildID.'"	
                    ';
                    
         $ergebnis = mysql_query($anfrage)
            or die('Anfrage schlug fehl: '.mysql_error());
        
		//Die Ergebnisse werden mithilfe von value="..." in das Formular der input-Seite voreingefügt, sodass sie nur noch bearbeitet werden müssen
		//Bei den Select Feldern gibt es ein Problem, diese werden per if-Bedingung gesetzt
        while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
			echo('
				<form name="editbild" action="?site=editbild&bildid='.$bildID.'" method="post" enctype="multipart/form-data">
					<table id="tableone" name="tableone" align="center">
						<caption id="caption">Bild &auml;ndern</caption>
						<tr>
							<td></td>
                            <td>
                                <img width="100" height="100" src="'.$zeile['bildpfad'].'">
                            </td>
						</tr>
						<tr>
							<td><label for="gruppe">Bildgruppe:</label></td>
							<td>
				');
					
				//Gruppenname der GruppenID wird aus der Datenbank geholt	
				$anfrageGruppen='SELECT gruppenname, gruppenID FROM bildgruppe ';
				$ergebnisGruppen=mysql_query($anfrageGruppen)
									or die('Anfrage schlug fehl: '.mysql_error());
						echo('<select name="gruppe" id="gruppe">');
				while ( $zeileGruppen = mysql_fetch_assoc($ergebnisGruppen) ) {
					if($zeileGruppen['gruppenID']==$zeile['gruppenID']){	
						echo('<option selected="true" value="'.$zeileGruppen['gruppenID'].'">'.$zeileGruppen['gruppenname'].'</option>');
					}else{	
						echo('<option value="'.$zeileGruppen['gruppenID'].'">'.$zeileGruppen['gruppenname'].'</option>');
					}	
				}    
			echo('
				</select>
			</td>
		</tr>
        <tr>
            <td><label for="text">kurze Bildbeschreibung:</label></td>
        	<td><input type="varchar" size="50" id="text" name="text" value="'.$zeile['text'].'"></td>
        </tr>
		<tr>
            <td><label for="urheber">Urheber des Fotos:</label></td>
        	<td><input type="varchar" size="50" id="urheber" name="urheber" value="'.$zeile['urheber'].'"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Bild neu speichern" name="speichern" id="speichern"></td>
        </tr>
    </table>
    </form>
	');
			
		} 
        
		//Genauso wie beim erstmaligen eingeben der Daten bei "uploadbild". 
        if ( isset($_POST['speichern']) ) {
    			
				//TO DO: Ungültige Eingabe, wenn kein Wert eingefügt wurde. Oder -1 als default. Versuche es mal TO DO: Und Dezimalzahlen müssen mit Punkt getrennt werden
				echo('<script type="text/javascript">alert("Die Aenderung war erfolgreich!");</script>');

				//Die eingegebenen Werte, oder voreingegebenen, werden mit $_POST[] in PHP-Variablen gespeichert
				$gruppenID = $_POST['gruppe'];
				$text = $_POST['text'];
				$urheber = $_POST['urheber'];
				
					//Datenbankanbindung
					include('datenbank.php');
					
					//Datenbank wird geupdatet
					$anfrage = 'UPDATE bilder
                    SET bildID="'.$bildID.'",
                    text="'.$text.'",
                    gruppenID="'.$gruppenID.'",
                    urheber="'.$urheber.'"
                    WHERE bildID="'.$bildID.'"';
                    
					$ergebnis = mysql_query($anfrage) 
									or die('Anfrage schlug fehl: '.mysql_error());
                                    
					//	Zurückleitung zur Bilderübersicht, wo der Admin herkommt
                    echo("<script language ='JavaScript'>
					    window.location.replace('?site=bilderlist'); 
					</script>");
				}
	?>
</div>	   