<!--Auf dieser Seite findet die graphische Darstellung der Messergebnisse durch Diagramme statt. Autor: Jonas Tietz-->
<!--DER QEULLCODE MUSS NOCH DRINGEND DOKUMENTIERT WERDEN!-->

<script src="Highcharts-3.0.4/js/highcharts.js"></script>
<script src="Highcharts-3.0.4/js/modules/exporting.js"></script>
<script src="Highcharts-3.0.4/js/highcharts-more.js"></script>

<div id="BSB5" style="width:100%; height:400px;"></div>
<div id="Nitratw" style="width:100%; height:400px;"></div>
<div id="Nitrats" style="width:100%; height:400px;"></div>
<div id="NH4" style="width:100%; height:400px;"></div>
<div id="Leitfaehigkeit" style="width:100%; height:400px;"></div>
<div id="Sichttiefe" style="width:100%; height:400px;"></div>
<div id="pHW" style="width:100%; height:400px;"></div>
<div id="O2" style="width:100%; height:400px;"></div>
<div id="PO4" style="width:100%; height:400px;"></div>
<div id="H2S" style="width:100%; height:400px;"></div>
<div id="Halmlange" style="width:100%; height:400px;"></div>

<?php
    include('datenbank.php');
    $Standortanfrage = 'SELECT DISTINCT Standort FROM chemischeParameter ';
    $Standortergebnis = mysql_query($Standortanfrage);

    $anfrage = 'SELECT BSB5, Standort FROM chemischeParameter WHERE BSB5 != -1 ORDER BY BSB5';
    $ergebnis = mysql_query($anfrage);
    
    $standort = '';
    $series = '';
    
    while ( $zeile = mysql_fetch_assoc($ergebnis) ) {
        $data[$zeile['Standort']][] = $zeile['BSB5'];
    }
    
    while ( $zeile = mysql_fetch_assoc($Standortergebnis) ) {
        $standort .= "'".$zeile['Standort']."', "; 
        $series .= '['.$data[$zeile['Standort']][0].', '. $data[$zeile['Standort']][count($data[$zeile['Standort']])/100*25].', '. $data[$zeile['Standort']][count($data[$zeile['Standort']])/100*50].', '. $data[$zeile['Standort']][count($data[$zeile['Standort']])/100*75].', '. $data[$zeile['Standort']][count($data[$zeile['Standort']])-1].'], ';
    }
?>

                    

<script type="text/javascript">
     $(function () {
        $('#BSB5').highcharts({
    
            chart: {
    	        type: 'boxplot'
    	    },
            title: {
                text: 'BSB5 Boxplot Diagramm'
            },
            xAxis: {
                categories: [
                    <?php
                        echo($standort);
                    ?>
                ],
    	        title: {
    	            text: 'Standorte'
    	        }
	        },
            yAxis: {
                title: {
    	            text: 'BSB5'
    	        }
	        },
    	    series: [{
    	        data: [
                    <?php
                        echo($series);
                    ?> 
    	        ]
    	    }]
    	
    	});
    });

</script>

<?php
    $Standortanfrage = 'SELECT DISTINCT Standort FROM chemischeParameter ';
    $Standortergebnis = mysql_query($Standortanfrage);

    $anfrage1 = 'SELECT NO3W, Standort FROM chemischeParameter WHERE NO3W != -1 ORDER BY NO3W';
    $ergebnis1 = mysql_query($anfrage1);
    
    $anfrage2 = 'SELECT NO2W, Standort FROM chemischeParameter WHERE NO2W != -1 ORDER BY NO2W';
    $ergebnis2 = mysql_query($anfrage2);
    
    $standort = '';
    $series1 = '';
    $series2 = '';

    while ( $zeile = mysql_fetch_assoc($ergebnis1) ) {
        $data1[$zeile['Standort']][] = $zeile['NO3W'];
    }
    while ( $zeile = mysql_fetch_assoc($ergebnis2) ) {
        $data2[$zeile['Standort']][] = $zeile['NO2W'];
    }
    
    while ( $zeile = mysql_fetch_assoc($Standortergebnis) ) {
        $standort .= "'".$zeile['Standort']."', "; 
        $series1 .= '['.$data1[$zeile['Standort']][0].', '. $data1[$zeile['Standort']][count($data[$zeile['Standort']])/100*25].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])/100*50].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])/100*75].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])-1].'], ';
        $series2 .= '['.$data2[$zeile['Standort']][0].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])/100*25].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])/100*50].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])/100*75].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])-1].'], ';
   }
?>

                    

<script type="text/javascript">
     $(function () {
        $('#Nitratw').highcharts({
    
            chart: {
                type: 'boxplot'
    	    },
            title: {
                text: 'Nitrat/Nitrit im Wasser'
            },
            xAxis: {
                categories: [
                    <?php
                        echo($standort);
                    ?>
                ],
    	        title: {
    	            text: 'Standorte'
    	        }
	        },
            yAxis: {
                title: {
    	            text: 'Nitrat/Nitrit'
    	        }
	        },
    	    series: [{
                name: 'Nitrat',
    	        data: [
                    <?php
                        echo($series1);
                    ?> 
    	        ]
    	    },
            {
                name: 'Nitrit',
                data: [
                    <?php
                        echo($series2);
                    ?> 
    	        ]
    	    }]
    	
    	});
    });

</script>

<?php
    $Standortanfrage = 'SELECT DISTINCT Standort FROM chemischeParameter ';
    $Standortergebnis = mysql_query($Standortanfrage);

    $anfrage1 = 'SELECT NO3S, Standort FROM chemischeParameter WHERE NO3S != -1 ORDER BY NO3S';
    $ergebnis1 = mysql_query($anfrage1);
    
    $anfrage2 = 'SELECT NO2S, Standort FROM chemischeParameter WHERE NO2S != -1 ORDER BY NO2S';
    $ergebnis2 = mysql_query($anfrage2);
    
    $standort = '';
    $series1 = '';
    $series2 = '';
    $data1 = array();
    $data2 = array();

    while ( $zeile = mysql_fetch_assoc($ergebnis1) ) {
        $data1[$zeile['Standort']][] = $zeile['NO3S'];
    }
    while ( $zeile = mysql_fetch_assoc($ergebnis2) ) {
        $data2[$zeile['Standort']][] = $zeile['NO2S'];
    }
    
    while ( $zeile = mysql_fetch_assoc($Standortergebnis) ) {
        $standort .= "'".$zeile['Standort']."', "; 
            $series1 .= '['.$data1[$zeile['Standort']][0].', '. $data1[$zeile['Standort']][count($data[$zeile['Standort']])/100*25].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])/100*50].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])/100*75].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])-1].'], ';
            $series2 .= '['.$data2[$zeile['Standort']][0].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])/100*25].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])/100*50].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])/100*75].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])-1].'], ';
        
   }
?>

                    

<script type="text/javascript">
     $(function () {
        $('#Nitrats').highcharts({
    
            chart: {
                type: 'boxplot'
            },
            title: {
                text: 'Nitrat/Nitrit im Sediment'
            },
            xAxis: {
                categories: [
                    <?php
                        echo($standort);
                    ?>
                ],
    	        title: {
    	            text: 'Standorte'
    	        }
	        },
            yAxis: {
                title: {
    	            text: 'Nitrat/Nitrit'
    	        }
	        },
    	    series: [{
                name: 'Nitrat',
    	        data: [
                    <?php
                        echo($series1);
                    ?> 
    	        ]
    	    },
            {
                name: 'Nitrit',
                data: [
                    <?php
                        echo($series2);
                    ?> 
    	        ]
    	    }]
    	
    	});
    });

</script>


<?php
    $Standortanfrage = 'SELECT DISTINCT Standort FROM chemischeParameter ';
    $Standortergebnis = mysql_query($Standortanfrage);

    $anfrage1 = 'SELECT NH4W, Standort FROM chemischeParameter WHERE NH4W != -1 ORDER BY NH4W';
    $ergebnis1 = mysql_query($anfrage1);
    
    $anfrage2 = 'SELECT NH4S, Standort FROM chemischeParameter WHERE NH4S != -1 ORDER BY NH4S';
    $ergebnis2 = mysql_query($anfrage2);
    
    $standort = '';
    $series1 = '';
    $series2 = '';
    $data1 = array();
    $data2 = array();

    while ( $zeile = mysql_fetch_assoc($ergebnis1) ) {
        $data1[$zeile['Standort']][] = $zeile['NH4W'];
    }
    while ( $zeile = mysql_fetch_assoc($ergebnis2) ) {
        $data2[$zeile['Standort']][] = $zeile['NH4S'];
    }
    
    while ( $zeile = mysql_fetch_assoc($Standortergebnis) ) {
        $standort .= "'".$zeile['Standort']."', "; 
        $series1 .= '['.$data1[$zeile['Standort']][0].', '. $data1[$zeile['Standort']][count($data[$zeile['Standort']])/100*25].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])/100*50].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])/100*75].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])-1].'], ';
        $series2 .= '['.$data2[$zeile['Standort']][0].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])/100*25].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])/100*50].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])/100*75].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])-1].'], ';
   }
?>

                    

<script type="text/javascript">
     $(function () {
        $('#NH4').highcharts({
    
            chart: {
                type: 'boxplot'
            },
            title: {
                text: 'Ammonium Wasser und Sediment'
            },
            xAxis: {
                categories: [
                    <?php
                        echo($standort);
                    ?>
                ],
                title: {
    	            text: 'Standorte'
    	        }
	        },
            yAxis: {
                title: {
    	            text: 'NH4'
    	        }
	        },
    	    series: [{
                name: 'Wasser',
    	        data: [
                    <?php
                        echo($series1);
                    ?> 
    	        ]
    	    },
            {
                name: 'Sediment',
                data: [
                    <?php
                        echo($series2);
                    ?> 
    	        ]
    	    }]
    	
    	});
    });

</script>




<?php
    $Standortanfrage = 'SELECT DISTINCT Standort FROM chemischeParameter ';
    $Standortergebnis = mysql_query($Standortanfrage);

    $anfrage1 = 'SELECT LeitfaehigkeitW, Standort FROM chemischeParameter WHERE LeitfaehigkeitW != -1 ORDER BY LeitfaehigkeitW';
    $ergebnis1 = mysql_query($anfrage1);
    
    $anfrage2 = 'SELECT LeitfaehigkeitS, Standort FROM chemischeParameter WHERE LeitfaehigkeitS != -1 ORDER BY LeitfaehigkeitS';
    $ergebnis2 = mysql_query($anfrage2);
    
    $standort = '';
    $series1 = '';
    $series2 = '';
    $data1 = array();
    $data2 = array();

    while ( $zeile = mysql_fetch_assoc($ergebnis1) ) {
        $data1[$zeile['Standort']][] = $zeile['LeitfaehigkeitW'];
    }
    while ( $zeile = mysql_fetch_assoc($ergebnis2) ) {
        $data2[$zeile['Standort']][] = $zeile['LeitfaehigkeitS'];
    }
    
    while ( $zeile = mysql_fetch_assoc($Standortergebnis) ) {
        $standort .= "'".$zeile['Standort']."', "; 
        $series1 .= '['.$data1[$zeile['Standort']][0].', '. $data1[$zeile['Standort']][count($data[$zeile['Standort']])/100*25].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])/100*50].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])/100*75].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])-1].'], ';
        $series2 .= '['.$data2[$zeile['Standort']][0].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])/100*25].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])/100*50].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])/100*75].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])-1].'], ';
   }
?>

                    

<script type="text/javascript">
     $(function () {
        $('#Leitfaehigkeit').highcharts({
    
            chart: {
                type: 'boxplot'
            },
            title: {
                text: 'Leitfaehigkeit Wasser und Sediment'
            },
            xAxis: {
                categories: [
                    <?php
                        echo($standort);
                    ?>
                ],
                title: {
                    text: 'Standorte'
    	        }
	        },
            yAxis: {
                title: {
    	            text: 'Leitfaehigkeit'
    	        }
	        },
    	    series: [{
                name: 'Wasser',
    	        data: [
                    <?php
                        echo($series1);
                    ?> 
    	        ]
    	    },
            {
                name: 'Sediment',
                data: [
                    <?php
                        echo($series2);
                    ?> 
    	        ]
    	    }]
    	
    	});
    });

</script>




<?php
    $Standortanfrage = 'SELECT DISTINCT Standort FROM chemischeParameter ';
    $Standortergebnis = mysql_query($Standortanfrage);

    $anfrage1 = 'SELECT Sichttiefe, Standort FROM chemischeParameter WHERE Sichttiefe != -1 ORDER BY Sichttiefe';
    $ergebnis1 = mysql_query($anfrage1);
    
    $standort = '';
    $series1 = '';
    $data1 = array();

    while ( $zeile = mysql_fetch_assoc($ergebnis1) ) {
        $data1[$zeile['Standort']][] = $zeile['Sichttiefe'];
    }
    
    while ( $zeile = mysql_fetch_assoc($Standortergebnis) ) {
        $standort .= "'".$zeile['Standort']."', "; 
        $series1 .= '['.$data1[$zeile['Standort']][0].', '. $data1[$zeile['Standort']][count($data[$zeile['Standort']])/100*25].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])/100*50].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])/100*75].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])-1].'], ';
   }
?>

                    

<script type="text/javascript">
     $(function () {
        $('#Sichttiefe').highcharts({
    
            chart: {
                type: 'boxplot'
            },
            title: {
                text: 'Sichttiefe'
            },
            xAxis: {
                categories: [
                    <?php
                        echo($standort);
                    ?>
                ],
                title: {
                    text: 'Standorte'
                }
	        },
            yAxis: {
                title: {
    	            text: 'Sichttiefe'
    	        }
	        },
    	    series: [{
    	        data: [
                    <?php
                        echo($series1);
                    ?> 
    	        ]
    	    }]
    	
    	});
    });

</script>



<?php
    $Standortanfrage = 'SELECT DISTINCT Standort FROM chemischeParameter ';
    $Standortergebnis = mysql_query($Standortanfrage);

    $anfrage1 = 'SELECT pHW, Standort FROM chemischeParameter WHERE pHW != -1 ORDER BY pHW';
    $ergebnis1 = mysql_query($anfrage1);
    
    $standort = '';
    $series1 = '';
    $data1 = array();

    while ( $zeile = mysql_fetch_assoc($ergebnis1) ) {
        $data1[$zeile['Standort']][] = $zeile['pHW'];
    }
    
    while ( $zeile = mysql_fetch_assoc($Standortergebnis) ) {
        $standort .= "'".$zeile['Standort']."', "; 
        $series1 .= '['.$data1[$zeile['Standort']][0].', '. $data1[$zeile['Standort']][count($data[$zeile['Standort']])/100*25].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])/100*50].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])/100*75].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])-1].'], ';
   }
?>

                    

<script type="text/javascript">
     $(function () {
        $('#pHW').highcharts({
    
            chart: {
                type: 'boxplot'
            },
            title: {
                text: 'PH-Wert'
            },
            xAxis: {
                categories: [
                    <?php
                        echo($standort);
                    ?>
                ],
                title: {
                    text: 'Standorte'
                }
            },
            yAxis: {
                title: {
    	            text: 'PH-Wert'
    	        },
                plotLines: [{
                color: '#FF0000',
                width: 2,
                value: 7
                }],
                minRange: 13,
                max: 14,
                tickInterval: 2
	        },
    	    series: [{
    	        data: [
                    <?php
                        echo($series1);
                    ?> 
    	        ]
    	    }]
    	
    	});
    });

</script>





<?php
    $Standortanfrage = 'SELECT DISTINCT Standort FROM chemischeParameter ';
    $Standortergebnis = mysql_query($Standortanfrage);

    $anfrage1 = 'SELECT O2saettigung, Standort FROM chemischeParameter WHERE O2saettigung != -1 ORDER BY O2saettigung';
    $ergebnis1 = mysql_query($anfrage1);
    
    $anfrage2 = 'SELECT O2W, Standort FROM chemischeParameter WHERE O2W != -1 ORDER BY O2W';
    $ergebnis2 = mysql_query($anfrage2);
    
    $anfrage3 = 'SELECT O2S, Standort FROM chemischeParameter WHERE O2S != -1 ORDER BY O2S';
    $ergebnis3 = mysql_query($anfrage3);
    
    $standort = '';
    $series1 = '';
    $series2 = '';
    $series3 = '';
    $data1 = array();
    $data2 = array();
    $data3 = array();

    while ( $zeile = mysql_fetch_assoc($ergebnis1) ) {
        $data1[$zeile['Standort']][] = $zeile['O2saettigung'];
    }
    while ( $zeile = mysql_fetch_assoc($ergebnis2) ) {
        $data2[$zeile['Standort']][] = $zeile['O2W'];
    }
    while ( $zeile = mysql_fetch_assoc($ergebnis3) ) {
        $data3[$zeile['Standort']][] = $zeile['O2S'];
    }
    
    while ( $zeile = mysql_fetch_assoc($Standortergebnis) ) {
        $standort .= "'".$zeile['Standort']."', "; 
        $series1 .= '['.$data1[$zeile['Standort']][0].', '. $data1[$zeile['Standort']][count($data[$zeile['Standort']])/100*25].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])/100*50].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])/100*75].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])-1].'], ';
        $series2 .= '['.$data2[$zeile['Standort']][0].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])/100*25].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])/100*50].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])/100*75].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])-1].'], ';
        $series3 .= '['.$data3[$zeile['Standort']][0].', '. $data3[$zeile['Standort']][count($data3[$zeile['Standort']])/100*25].', '. $data3[$zeile['Standort']][count($data3[$zeile['Standort']])/100*50].', '. $data3[$zeile['Standort']][count($data3[$zeile['Standort']])/100*75].', '. $data3[$zeile['Standort']][count($data3[$zeile['Standort']])-1].'], ';
   }
?>

                    

<script type="text/javascript">
     $(function () {
        $('#O2').highcharts({
    
            chart: {
                type: 'boxplot'
            },
            title: {
                text: 'Sauerstoff'
            },
            xAxis: {
                categories: [
                    <?php
                        echo($standort);
                    ?>
                ],
                title: {
                    text: 'Standorte'
    	        }
	        },
            yAxis: [{
                title: {
    	            text: '%'
    	        }}, 
                {
                title: {
                    text: 'mg/l'
                },
                    opposite: true
    	        }],
    	    series: [{
                yAxis: 0,
                name: 'Sättigung im Wasser',
    	        data: [
                    <?php
                        echo($series1);
                    ?> 
    	        ]
    	    },
            {
                name: 'Sauerstoffgehalt Wasser',
                yAxis: 1,
                data: [
                    <?php
                        echo($series2);
                    ?> 
    	        ]
    	    },
            {
                name: 'Sauerstoffgehalt Sediment',
                yAxis: 1,
                data: [
                    <?php
                        echo($series3);
                    ?> 
                ]
    	    }]
    	
    	});
    });

</script>




<?php
    $Standortanfrage = 'SELECT DISTINCT Standort FROM chemischeParameter ';
    $Standortergebnis = mysql_query($Standortanfrage);

    $anfrage1 = 'SELECT PO4W, Standort FROM chemischeParameter WHERE PO4W != -1 ORDER BY PO4W';
    $ergebnis1 = mysql_query($anfrage1);
    
    $anfrage2 = 'SELECT PO4S, Standort FROM chemischeParameter WHERE PO4S != -1 ORDER BY PO4S';
    $ergebnis2 = mysql_query($anfrage2);
    
    $standort = '';
    $series1 = '';
    $series2 = '';
    $data1 = array();
    $data2 = array();

    while ( $zeile = mysql_fetch_assoc($ergebnis1) ) {
        $data1[$zeile['Standort']][] = $zeile['PO4W'];
    }
    while ( $zeile = mysql_fetch_assoc($ergebnis2) ) {
        $data2[$zeile['Standort']][] = $zeile['PO4S'];
    }
    
    while ( $zeile = mysql_fetch_assoc($Standortergebnis) ) {
        $standort .= "'".$zeile['Standort']."', "; 
        $series1 .= '['.$data1[$zeile['Standort']][0].', '. $data1[$zeile['Standort']][count($data[$zeile['Standort']])/100*25].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])/100*50].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])/100*75].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])-1].'], ';
        $series2 .= '['.$data2[$zeile['Standort']][0].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])/100*25].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])/100*50].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])/100*75].', '. $data2[$zeile['Standort']][count($data2[$zeile['Standort']])-1].'], ';
   }
?>

                    

<script type="text/javascript">
     $(function () {
        $('#PO4').highcharts({
    
            chart: {
                type: 'boxplot'
            },
            title: {
                text: 'Phosphat Wasser und Sediment'
            },
            xAxis: {
                categories: [
                    <?php
                        echo($standort);
                    ?>
                ],
                title: {
                    text: 'Standorte'
                }
	        },
            yAxis: {
                title: {
    	            text: 'Phosphat'
    	        }
	        },
    	    series: [{
                name: 'Wasser',
    	        data: [
                    <?php
                        echo($series1);
                    ?> 
    	        ]
    	    },
            {
                name: 'Sediment',
                data: [
                    <?php
                        echo($series2);
                    ?> 
    	        ]
    	    }]
    	
    	});
    });
</script>



<?php
    $Standortanfrage = 'SELECT DISTINCT Standort FROM chemischeParameter ';
    $Standortergebnis = mysql_query($Standortanfrage);

    $anfrage1 = 'SELECT H2S, Standort FROM chemischeParameter WHERE H2S != -1 ORDER BY H2S';
    $ergebnis1 = mysql_query($anfrage1);
    
    $standort = '';
    $series1 = '';
    $data1 = array();

    while ( $zeile = mysql_fetch_assoc($ergebnis1) ) {
        $data1[$zeile['Standort']][] = $zeile['H2S'];
    }
    
    while ( $zeile = mysql_fetch_assoc($Standortergebnis) ) {
        $standort .= "'".$zeile['Standort']."', "; 
        $series1 .= '['.$data1[$zeile['Standort']][0].', '. $data1[$zeile['Standort']][count($data[$zeile['Standort']])/100*25].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])/100*50].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])/100*75].', '. $data1[$zeile['Standort']][count($data1[$zeile['Standort']])-1].'], ';
   }
?>

                    

<script type="text/javascript">
     $(function () {
        $('#H2S').highcharts({
    
            chart: {
                type: 'boxplot'
            },
            title: {
                text: 'Schwefelwasserstoff'
            },
            xAxis: {
                categories: [
                    <?php
                        echo($standort);
                    ?>
                ],
                title: {
                    text: 'Standorte'
                }
            },
            yAxis: {
                title: {
    	            text: 'Schwefelwasserstoff'
    	        }
	        },
    	    series: [{
    	        data: [
                    <?php
                        echo($series1);
                    ?> 
    	        ]
    	    }]
    	
    	});
    });

</script>

<?php
    $Standortanfrage = 'SELECT DISTINCT Standort FROM biologischeEinzelmessergebnisse ';
    $Standortergebnis = mysql_query($Standortanfrage);
    
    $Datumanfrage = 'SELECT DISTINCT DATE_FORMAT(Datum, "%Y") AS Dat FROM biologischeEinzelmessergebnisse ';
    $Datumergebnis = mysql_query($Datumanfrage);
    $n= mysql_affected_rows();
    $anfrage1 = 'SELECT LaengeUnterWasser, LaengeUeberWasser, Standort, DATE_FORMAT(Datum, "%Y") AS Dat FROM biologischeEinzelmessergebnisse WHERE LaengeUnterWasser != -1 AND LaengeUeberWasser != -1 ORDER BY Dat';
    $ergebnis1 = mysql_query($anfrage1);
    
    $series = array(); 
    $data = array();


    
    while ( $zeile = mysql_fetch_assoc($ergebnis1) ) {
            for ( $i = $n ;$i > 0 ; $i-- ) {
            if ($zeile['Dat'] == 2008 + $i){
                $data[$i][$zeile['Standort']][] = $zeile['LaengeUnterWasser']+$zeile['LaengeUeberWasser'] ;
            }
        }

    }

    
    while ( $zeile = mysql_fetch_assoc($Standortergebnis) ) {
        for ( $i = $n ;$i > 0 ; $i-- ) {
           $series[$i] .= '['.$data[$i][$zeile['Standort']][0].', '. $data[$i][$zeile['Standort']][count($data[$i][$zeile['Standort']])/100*25].', '. $data[$i][$zeile['Standort']][count($data[$i][$zeile['Standort']])/100*50].', '. $data[$i][$zeile['Standort']][count($data[$i][$zeile['Standort']])/100*75].', '. $data[$i][$zeile['Standort']][count($data[$i][$zeile['Standort']])-1].'], '; 
        }

    }
?>

             
<script type="text/javascript">
     $(function () {
        $('#Halmlange').highcharts({
    
            chart: {
                type: 'boxplot'
            },
            title: {
                text: 'Halmlänge(gesamt)'
            },
            xAxis: {
                categories: [
                    <?php
                        echo($standort);
                    ?>
                ],
                title: {
                    text: 'Standorte'
                }
            },
            yAxis: {
                title: {
    	            text: 'Halmlänge (Gesammt)'
    	        }
	        },
    	    series:[
    	        <?php
        	        for ( $i = $n ;$i > 0 ; $i-- ) {
        	        echo('{');
        	        echo("name: '".($i + 2008)."',");
        	        echo('data: [');
                        echo($series[$i]);
                        
        	        echo(']');
        	        echo('},');
        	        }
    	    ?>
    	    ]
    	
    	});
    });

</script>
