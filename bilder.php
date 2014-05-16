<!--Auf dieser Seite werden die Bilder aus einer Bildergruppe angezeigt. Die bildgruppenID(ordnerID)  wird mit der URL übertragen -->
<div name="bilder">

    <?php
        //Datenbankanbindung  
        include('datenbank.php');

        //Die BildgruppenID(ordnerID) wird aus der URL ausgelesen und in einer PHP-Variablen gespeichert
        $gruppenID=$_GET['ordnerID'];
        
        //Der Gruppenname von der GruppenID von der wird über eine Datenbankanfrage geliefert 
        $anfrageGruppenname='SELECT gruppenID, gruppenname
                        FROM  bildgruppe
                        WHERE gruppenID = '.$gruppenID.'
                        ORDER BY gruppenID DESC';
                        
        
        $ergebnisGruppenname = mysql_query($anfrageGruppenname)
                or die('Anfrage schlug fehl: '.mysql_error());

        //Der Gruppenname wird als Überschrift angezeigt
        while ( $zeile = mysql_fetch_assoc($ergebnisGruppenname) ) {
            echo('<h1 id="bildgr">'.$zeile['gruppenname'].' </h1>');    
        }
                                        
        
        //Datenbankanfrage: Liefert alle Bilder dieser Gruppe mit Zusatzinformationen
        //Dier bilder.gruppenID muss gleich bildgruppe.gruppenID um den Gruppenname herauszubekommen
        $anfrageEinzelbilder = 'SELECT bildpfad,bildID,text, urheber, bilder.gruppenID, bildgruppe.gruppenID, gruppenname
                        FROM bilder, bildgruppe
                        WHERE bilder.gruppenID = '.$gruppenID.'
                        AND bilder.gruppenID = bildgruppe.gruppenID
                        ORDER BY bildID DESC';
                        
                $ergebnisEinzelbilder = mysql_query($anfrageEinzelbilder)
                or die('Anfrage schlug fehl: '.mysql_error());
                
                
                //Alle Bilder werden als Link ausgegeben, sodass die Vollbildfunktion mit der lightbox funktioniert. Als hyperreference wird der Bildpfad übergeben. data-lightbox="[gruppenID]" bekommt bei allen die GruppenID übergeben. Da diese gleich ist, werden später im Vollbildmodus alle Bilder als Gruppe angezeigt, sodass man vorwärts und rückwärts navigieren kann. Die Bildbeschreibung wird im title-Attribut des Links übergeben und kann somit im Vollbildmodus angezeigt werden.
                //Wie die lightbox funktioniert kann man auf http://lokeshdhakar.com/projects/lightbox2/ lesen
                while ( $zeile = mysql_fetch_assoc($ergebnisEinzelbilder) ) {
                
                echo('
                <a 
                    href="'.$zeile['bildpfad'].'" 
                    data-lightbox="'.$zeile['gruppenID'].'" 
                    title="'.$zeile['text'].' '.$zeile['urheber'].'">
                        <div id="bildpos">
                            <img src="thumbnails'.$zeile['bildpfad'].'" alt="'.$zeile['text'].'">
                            <p>'.$zeile['text'].'</p>
                        </div>
                </a>'
                    );
                }
    ?>
</div>