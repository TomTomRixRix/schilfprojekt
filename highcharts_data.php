<!--TO DO: Muss dringend dokumentiert werden-->
$(function () {
    
	$('#container').highcharts({
	
		colors: ['#555555','#088A08','#F7D358','#FF0000','#0101DF'],
		
		chart: {
			zoomType: 'x'
			<?php
				error_reporting(E_ALL ^ E_NOTICE);
					echo(',');
					echo("type: '".$_POST['typ']."'");
			?>
		},
		title: {
			text: 'Schilfprojekt',
			x: -20 //center
		},
		subtitle: {
			text: 'Ein Projekt der Thomas Mann Schule',
			x: -20
		},
		xAxis: {
			title: {
				text: document.getElementById('X').options[document.getElementById('X').selectedIndex].value
			},
			<!--minRange: 1, -->
			<?php
				error_reporting(E_ALL ^ E_NOTICE);

				if ($_POST['WertX'] == 'Datum'){
					echo('alternateGridColor: "#f0f0f0", tickInterval: 182 * 24 * 3600 * 1000, ');
					echo("type: 'datetime'");
				}
				if($_POST['typ'] == 'column'){
				    echo("type: 'datetime'");
				}
			?>
			
		},
		yAxis: {
			title: {
				text: document.getElementById('Y').options[document.getElementById('Y').selectedIndex].innerHTML
			},
			min: 0,
			labels: {
			    format: '{value}' + einheit
			},
            startOnTick: false
			<?php
				error_reporting(E_ALL ^ E_NOTICE);
				if ($_POST['WertY'] == 'Datum'){
					echo(',');
					echo("type: 'datetime'");
				}
			?>
		},
		tooltip: {
			valueSuffix: einheit
		},
		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'middle',
			borderWidth: 0
		},
		series: [
		{
			name: 'Wallbrechtbrücke',
			data: Wallbrechtbruecke
		},
		{
			name: 'Wallbrechtbrücke Standartabweichung',
			linkedTo:':previous',
			type: 'errorbar',
			data: WallbrechtbrueckeS
		},
		{
			name: 'Eichholz',
			data: Eichholz
		},
		{
			name: 'Eichholz Standartabweichung',
			linkedTo:':previous',
			type: 'errorbar',
			data: EichholzS
		},
		{
			name: 'Kleiner See',
			data: KleinerSee
		},
		{
			name: 'Kleiner See Standartabweichung',
			linkedTo:':previous',
			type: 'errorbar',
			data: KleinerSeeS
		},
		{
			name: 'Absalonshorst',
			data: Absalonshorst
		},
		
		{
			name: 'Absalonshorst Standartabweichung',
			linkedTo:':previous',
			type: 'errorbar',
			data: AbsalonshorstS
		},
		{
			name: 'Gross Sarau',
			data: GrossSarau
		},
		{
			name: 'GrossSarau Standartabweichung',
			linkedTo:':previous',
			type: 'errorbar',
			data: GrossSarauS
		},]
	});
});