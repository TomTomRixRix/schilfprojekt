<!-- TO DO: Muss dringend dokumentiert werden-->
<?php error_reporting(E_ALL ^ E_NOTICE);
	
    //Datenbankabfrage
    //###########################################################################################
	include('datenbank.php');
    $anfrage = 'SELECT DATE_FORMAT('.$_POST['GroupY'].'.Datum, "%Y, %m, %d") AS Dat, '.$_POST['GroupY'].'.Standort, '.$_POST['GroupY'].'.Datum ';
    
    //X-Achse
    if ($_POST['WertX'] != 'Datum') {
        $anfrage .= ', '.$_POST['GroupX'].'.'.$_POST['WertX'];
    }
    //Y-Achse
    if ($_POST['WertY'] != 'Datum') {
        $anfrage .= ', '.$_POST['GroupY'].'.'.$_POST['WertY'];
    }
    //Tabellen zusammenfügen falls nötig
    if ($_POST['GroupX'] != $_POST['GroupY']){
    $anfrage .= ' FROM '.$_POST['GroupX'].' INNER JOIN '.$_POST['GroupY'].' ON '.$_POST['GroupY'].'. Datum = '.$_POST['GroupX'].'.Datum WHERE '.$_POST['GroupX'].'.'.$_POST['WertX'].' != "-1" AND '.$_POST['GroupY'].'.'.$_POST['WertY'].' != "-1" AND '.$_POST['GroupY'].'.Standort = '.$_POST['GroupX'].'.Standort';
    }
    //Einfache Tabelle
    else{
        $anfrage .= ' FROM '.$_POST['GroupX'] .' WHERE '.$_POST['WertY'].' != "-1"' ;  
    }
    //Sotieren 
    $anfrage .= ' ORDER BY '.$_POST['GroupX'].'.'.$_POST['WertX'];


	$ergebnis=mysql_query($anfrage) or die("Error" . mysql_error() );
	//###################################################################################################
	

    //Variablen
    //############
    //
	$e = 0;
	$k = 0;
	$a = 0;
	$g = 0;
	$w = 0;
	//##############################################################################################

		
	
            //Formatierung der Daten 
		if($_POST['typ'] == 'line' or $_POST['typ'] == 'scatter' ){
		    while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
				if($zeile['Standort']== 'Eichholz'){
					echo('Eichholz['.$e.'] =  ');
					if($_POST['WertX']=='Datum'){
						echo('[Date.UTC('.$zeile['Dat'].')');
					}
					else{
						echo('['.$zeile[$_POST['WertX']]);
					}
					if($_POST['WertY']=='Datum'){
						echo(',Date.UTC('.$zeile['Dat'].')];');
					}
					else{
						echo(','.$zeile[$_POST['WertY']].'];');
					}
					$e = $e +1;
				}
				if($zeile['Standort']== 'Kleiner See'){
					echo('KleinerSee['.$k.'] =  ');
					if($_POST['WertX']=='Datum'){
						echo('[Date.UTC('.$zeile['Dat'].')');
					}
					else{
						echo('['.$zeile[$_POST['WertX']]);
					}
					if($_POST['WertY']=='Datum'){
						echo(',Date.UTC('.$zeile['Dat'].')];');
					}
					else{
						echo(','.$zeile[$_POST['WertY']].'];');
					}
					$k = $k +1;
				}
				if($zeile['Standort']== 'Absalonshorst'){
					echo('Absalonshorst['.$a.'] =  ');
					if($_POST['WertX']=='Datum'){
						echo('[Date.UTC('.$zeile['Dat'].')');
					}
					else{
						echo('['.$zeile[$_POST['WertX']]);
					}
					if($_POST['WertY']=='Datum'){
						echo(',Date.UTC('.$zeile['Dat'].')];');
					}
					else{
						echo(','.$zeile[$_POST['WertY']].'];');
					}
					$a = $a +1;
				}
				if($zeile['Standort']== 'Gross Sarau'){
    				echo('GrossSarau['.$g.'] =  ');
    				if($_POST['WertX']=='Datum'){
    					echo('[Date.UTC('.$zeile['Dat'].')');
    				}
    				else{
    					echo('['.$zeile[$_POST['WertX']]);
    				}
    				if($_POST['WertY']=='Datum'){
    					echo(',Date.UTC('.$zeile['Dat'].')];');
    				}
    				else{
    					echo(','.$zeile[$_POST['WertY']].'];');
    				}
    				$g = $g +1;
			    }
			    if($zeile['Standort']== 'Wallbrechtbruecke'){
    				echo('Wallbrechtbruecke['.$w.'] =  ');
    				if($_POST['WertX']=='Datum'){
    					echo('[Date.UTC('.$zeile['Dat'].')');
    				}
    				else{
    					echo('['.$zeile[$_POST['WertX']]);
    				}
    				if($_POST['WertY']=='Datum'){
    					echo(',Date.UTC('.$zeile['Dat'].')];');
    				}
    				else{
    					echo(','.$zeile[$_POST['WertY']].'];');
    				}
    				$w = $w +1;
			    }
			}
		}
			
			
			if($_POST['typ'] == 'column' ){
            // Berechnung der Standartabweichung und Mittelwerte
            $anfrage = 'SELECT STDDEV( '.$_POST['GroupY'].'.'.$_POST['WertY'].' ) AS Abweichung, AVG( '.$_POST['GroupY'].'.'.$_POST['WertY'].' ) AS Durchschnitt, DATE_FORMAT(Datum, "%Y") AS Dat, '.$_POST['GroupY'].'.Standort FROM '.$_POST['GroupY'].' WHERE '.$_POST['GroupY'].'.Standort = "Eichholz" AND '.$_POST['GroupY'].'.'.$_POST['WertY'].' != -1 GROUP BY Dat'; 
            $anfrage .= ' UNION SELECT STDDEV( '.$_POST['GroupY'].'.'.$_POST['WertY'].' ) AS Y, AVG( '.$_POST['GroupY'].'.'.$_POST['WertY'].' ) AS Durchschnitt, DATE_FORMAT(Datum, "%Y") AS Dat, '.$_POST['GroupY'].'.Standort FROM '.$_POST['GroupY'].' WHERE '.$_POST['GroupY'].'.Standort = "Absalonshorst" AND '.$_POST['GroupY'].'.'.$_POST['WertY'].' != -1 GROUP BY Dat';
            $anfrage .= ' UNION SELECT STDDEV( '.$_POST['GroupY'].'.'.$_POST['WertY'].' ) AS Y, AVG( '.$_POST['GroupY'].'.'.$_POST['WertY'].' ) AS Durchschnitt, DATE_FORMAT(Datum, "%Y") AS Dat, '.$_POST['GroupY'].'.Standort FROM '.$_POST['GroupY'].' WHERE '.$_POST['GroupY'].'.Standort = "Gross Sarau" AND '.$_POST['GroupY'].'.'.$_POST['WertY'].' != -1 GROUP BY Dat';
            $anfrage .= ' UNION SELECT STDDEV( '.$_POST['GroupY'].'.'.$_POST['WertY'].' ) AS Y, AVG( '.$_POST['GroupY'].'.'.$_POST['WertY'].' ) AS Durchschnitt, DATE_FORMAT(Datum, "%Y") AS Dat, '.$_POST['GroupY'].'.Standort FROM '.$_POST['GroupY'].' WHERE '.$_POST['GroupY'].'.Standort = "Kleiner See" AND '.$_POST['GroupY'].'.'.$_POST['WertY'].' != -1 GROUP BY Dat';
            $anfrage .= ' UNION SELECT STDDEV( '.$_POST['GroupY'].'.'.$_POST['WertY'].' ) AS Y, AVG( '.$_POST['GroupY'].'.'.$_POST['WertY'].' ) AS Durchschnitt, DATE_FORMAT(Datum, "%Y") AS Dat, '.$_POST['GroupY'].'.Standort FROM '.$_POST['GroupY'].' WHERE '.$_POST['GroupY'].'.Standort = "Wallbrechtbruecke" AND '.$_POST['GroupY'].'.'.$_POST['WertY'].' != -1 GROUP BY Dat';
            
			$ergebnis=mysql_query($anfrage) or die("Error" . mysql_error() );
			
			//Ausgabe der Mittelwerte und der Standartabweichung
			
		        while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
    				if($zeile['Standort'] == 'Eichholz'){
				        echo("Eichholz[".$e."] = [Date.UTC(".$zeile['Dat']."),". round($zeile['Durchschnitt'],2)."];");
					    echo("EichholzS[".$e."] = [Date.UTC(".$zeile['Dat']."), ". round($zeile['Durchschnitt'] - $zeile['Abweichung'],2).",". round($zeile['Durchschnitt'] + $zeile['Abweichung'],2)."];");
					    $e = $e +1;
    				}
    				if($zeile['Standort'] == 'Kleiner See' ){
    				    echo("KleinerSee[".$k."] = [Date.UTC(".$zeile['Dat']."),". round($zeile['Durchschnitt'],2)."];");
    				    echo("KleinerSeeS[".$k."] = [Date.UTC(".$zeile['Dat']."), ". round($zeile['Durchschnitt'] - $zeile['Abweichung'],2).",". round($zeile['Durchschnitt'] + $zeile['Abweichung'],2)."];");
    					$k = $k +1;
    				}
    				if($zeile['Standort'] == 'Absalonshorst'){
    				    echo("Absalonshorst[".$a."] = [Date.UTC(".$zeile['Dat']."),". round($zeile['Durchschnitt'],2)."];");
    					echo("AbsalonshorstS[".$a."] = [Date.UTC(".$zeile['Dat']."), ". round($zeile['Durchschnitt'] - $zeile['Abweichung'],2).",". round($zeile['Durchschnitt'] + $zeile['Abweichung'],2)."];");
    					$a = $a +1;
    				}
    				if($zeile['Standort'] == 'Gross Sarau'){
    				    echo("GrossSarau[".$g."] = [Date.UTC(".$zeile['Dat']."),". round($zeile['Durchschnitt'],2)."];");
    					echo("GrossSarauS[".$g."] = [Date.UTC(".$zeile['Dat']."), ". round($zeile['Durchschnitt'] - $zeile['Abweichung'],2).",". round($zeile['Durchschnitt']+ $zeile['Abweichung'],2)."];");
    					$g = $g +1;
    				}
    				if($zeile['Standort'] == 'Wallbrechtbruecke'){
    				    echo("Wallbrechtbruecke[".$w."] = [Date.UTC(".$zeile['Dat']."),". round($zeile['Durchschnitt'],2)."];");
    					echo("WallbrechtbrueckeS[".$w."] = [Date.UTC(".$zeile['Dat']."), ". round($zeile['Durchschnitt'] - $zeile['Abweichung'],2).",". round($zeile['Durchschnitt']+ $zeile['Abweichung'],2)."];");
    					$w = $w +1;
    				}
		    	}
			}
			
			
			if($_POST['typ'] == 'boxplot'){
			    
			    $anfrage = 'SELECT '.$_POST['WertY'].', DATE_FORMAT(Datum, "%Y") AS Dat, Standort FROM '.$_POST['GroupY'].' WHERE '.$_POST['WertY'].' != -1 GROUP BY '.$_POST['WertY'].''; 
			    $ergebnis=mysql_query($anfrage) or die("Error" . mysql_error() );
			
    			while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
                    $data[$zeile['Standort']][] = $zeile[$_POST['WertY']];
                }

    			 echo("Eichholz = [".$data['Eichholz'][0].",".$data['Eichholz'][count($data['Eichholz'])*0.25].",".$data['Eichholz'][count($data['Eichholz'])*0.5].",".$data['Eichholz'][count($data['Eichholz'])*0.75].",".$data['Eichholz'][count($data['Eichholz'])-1]."];");  
    			 
    			 echo("KleinerSee = [".$data['Kleiner See'][0].",".$data['Kleiner See'][count($data['Kleiner See'])*0.25].",".$data['Kleiner See'][count($data['Kleiner See'])*0.5].",".$data['Kleiner See'][count($data['Kleiner See'])*0.75].",".$data['Kleiner See'][count($data['Kleiner See'])-1]."];");
    			 
    			 echo("Absalonshorst = [".$data['Absalonshorst'][0].",".$data['Absalonshorst'][count($data['Absalonshorst'])*0.25].",".$data['Absalonshorst'][count($data['Absalonshorst'])*0.5].",".$data['Absalonshorst'][count($data['Absalonshorst'])*0.75].",".$data['Absalonshorst'][count($data['Absalonshorst'])-1]."];");
    			 
    			 echo("GrossSarau = [".$data['Gross Sarau'][0].",".$data['Gross Sarau'][count($data['Gross Sarau'])*0.25].",".$data['Gross Sarau'][count($data['Gross Sarau'])*0.5].",".$data['Gross Sarau'][count($data['Gross Sarau'])*0.75].",".$data['Gross Sarau'][count($data['Gross Sarau'])-1]."];");
    			 
    			 echo("Wallbrechtbruecke = [".$data['Wallbrechtbruecke'][0].",".$data['Wallbrechtbruecke'][count($data['Wallbrechtbruecke'])*0.25].",".$data['Wallbrechtbruecke'][count($data['Wallbrechtbruecke'])*0.5].",".$data['Wallbrechtbruecke'][count($data['Wallbrechtbruecke'])*0.75].",".$data['Wallbrechtbruecke'][count($data['Wallbrechtbruecke'])-1]."];");
    			

			}
		
?>