
<?php

if ($handle = opendir('bildergalerie/')) {
	/*
    echo "Directory handle: $handle\n<br>";
    echo "Files:\n<br>";
	*/
    /* Das ist der korrekte Weg, ein Verzeichnis zu durchlaufen. */

	$links = true;
	echo("
					<table>
	");
    while (false !== ($file = readdir($handle))) {
        /*echo "$file\n<br>";*/
		
		if ($file[0] != ".") {
			
			if ($links == true)
			{
				echo("
						<tr>
							<td>
				");
				echo("
							<img src=\"bildergalerie/$file\" width=\"500\" height=\"500\">
				");
				echo("
						</td>
				");
			}
			else
			{
				echo("
						<td>
				");
				echo("
							<img src=\"bildergalerie/$file\" width=\"500\" height=\"500\">
				");
				echo("
						</td>
					</tr>
				");
			}
			$links = !$links;
		}
    }
	echo("
				</table>
	");
	
    closedir($handle);
}
?>
