<!--Diese LOGIN-Seite ist für den Anmeldevorgang zuständig-->
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
        //wenn nicht 1, dann ist der user nicht angemeldet(was eigentlich immer der Fall sein sollte) und bekommt folgende Nachricht
        echo("Sie m&uuml;ssen sich erst anmelden, um auf den Admin-Bereich zugreifen zu k&ouml;nnen!");
    }else{
        //wenn 1, dann ist der user angemeldet...
        echo("Sie sind angemeldet!");
        //...der AbmeldeButton wird angezeigt...
        echo("<script language ='JavaScript'>
                        ButtonShow();  
                    </script>");
        //...und der user wird auf die admin-Seite weitergeleitet
        echo("<script language ='JavaScript'>
             window.location.replace('?site=admin'); 
          </script>");
    }
?>

<!--Die loginbox ist das USER Interface zum Anmelden -->
<div id="loginbox" align="center">
    <!--Wenn der input-submit-Button gedrückt wird, dann werden die eingegebenen Werte mittels post(method) gesendet und man gelangt auf diese Seite(action)-->
    <form  id="loginform" action="?site=login" method="post">
        <table id="logintable">
            <tr>
                <td><lable for="username">Benutzername:</lable></td>
                <td><input id="username" name="username" type="text" size="10" autofocus="autofocus"></td>
            </tr>
            <tr>
                <td><lable for="password">Passwort:</lable></td>
                <td><input id="password" name="password" type="password" size="10"></td>
            </tr>
            <tr>
                <td></td>
                <td><input name="login" type="submit" value="Anmelden"></td>
            </tr>
        </table>
    </form>
</div>

<?php
//BENUTZERNAMEN UND PASSWORT ÜBERPRÜFUNG
if(isset($_POST['login'])){
    //wenn der login-input-submit-Button gedrückt wurde, dann werden die eingegebenen Werte von Username und PW durch $_POST übermittelt und in PHP-Variablen gespeichert
    $username=$_POST['username'];
    $password=$_POST['password'];
    
    //Die Datenbank wird angeschlossen, um die Eingabe überprüfen
    //Übrigens: Neue Benutzer können aus Sicherheitsgründen nur direkt in der Datenbank angelegt werden. Ebenso bei Passwortänderungen
    include('datenbank.php');
    
    //USERNAME
    if($username!=''){      //wenn ein Benutzername eingegeben wurde
        //Datenbankanfrage, ob es diesen Benutzernamen überhaupt gibt
        $anfrage_username= 'SELECT user FROM admin WHERE user = "'.$username.'"';
        $ergebnis_username=mysql_query($anfrage_username)
					or die('Anfrage schlug fehl: '.mysql_error());
    	$datenbankergebnis_username=mysql_fetch_assoc($ergebnis_username);
        if($username!=$datenbankergebnis_username['user']){
    		//Der Benutzername existiert so nicht in der Datenbank
    		echo('<script>alert("Anmeldeversuch schlug fehl!");</script>');
    	}
    }else{
        //Es wurde kein Benutzername eingegeben
        echo('<script>alert("Bitte geben Sie einen Benutzernamen ein!");</script>');
    }
    
    //PASSWORD
    if($password!=''){      //wenn ein Benutzername eingegeben wurde
        //Datenbankanfrage, wie das Passwort sein müsste für den Benutzernamen, den es gibt!
        $anfrage_password= 'SELECT password FROM admin WHERE user = "'.$username.'"';
        $ergebnis_password=mysql_query($anfrage_password)
					or die('Anfrage schlug fehl: '.mysql_error());
        $datenbankergebnis_password=mysql_fetch_assoc($ergebnis_password);
        //Überprüfen, ob das eingegebene PW mit dem der Datenbank übereinstimmt
        if($password == $datenbankergebnis_password['password']){
            //Anmeldung erfolgreich, SESSION-Variable status wird auf 1=angemeldet (0=nicht angemeldet) gesetzt und Weiterleitung zur Admin-Seite erfolgt
            echo('<h2>Angemeldet</h2>');
            $statuswert='1';
            $_SESSION['status']=$statuswert;
            echo("<script language ='JavaScript'>
			        window.location.replace('?site=admin'); 
			      </script>");
        }else{
            //Falsches eingegebenes Passwort
            echo('<script>alert("Anmeldeversuch schlug fehl!");</script>');
		}
    }
}
?>