<!--Auf dieser Seite kann der Admin Bilder als Thumbnails runter skalieren und speichern. Dies ist natürlich passwortgeschützt. -->

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

<div id="thumbnails">
    <h1><u>Thumbnail erstellen</u></h1>
    
    <form name="thumbnaileinstellungen" action="?site=thumbnails" method="post"> 
        <table>
            <tr>
                <td><label for="pfadIn">Urspr&uuml;nglicher Bildordner</label></td>
                <td>
                <select id="pfadIn" name="pfadIn">
                    <option value="images/">images/</option>
                    <option value="galerie/">galerie/</option>
                    <option value="newsarticleimages/">newsarticleimages/</option>
                </select>
                </td>
            </tr>
            <tr>
                <td><label for="pfadOut">Zielordner wird automatisch gew&auml;hlt</label></td>
                <td></td>
            </tr>
            <tr>
                <td><label for="pfad">Bilddatei Namen:</label></td>
                <td><input type="varchar" size="30" id="pfad" name="pfad"></td>
            </tr>
            <tr>
                <td><label for="quali">neue Bildbreite:</label></td>
                <td><input type="number" size="30" id="quali" name="quali"> px (Bei Bildergalerie 300px)</td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" id="senden" name="senden" value="senden"></td>
            </tr>
        </table>
    </form>


    <?php
    
    
    if ( isset($_POST['senden']) ) {
        
        
        //Wenn Ursprundsbildordner gewählt wurde, dann abspeichern
        if(isset($_POST['pfadIn'])){
            $PicPathIn=$_POST['pfadIn'];
        }else{
            echo "<script type='text/javascript'>alert('Es wurde kein Ursprungsbildordner ausgew&auml;hlt!');</script>";
        }
        
        
        //Zielordner wird automatisch ausgewählt, je nachdem, welcher Ursprungsordner gewählt wurde
        if($PicPathIn=="images/"){
            $PicPathOut="thumbnails/";
        }else if($PicPathIn=="galerie/"){
            $PicPathOut="thumbnailsgalerie/";
        }else if($PicPathIn=="newsarticleimages/"){
            $PicPathOut="newsthumbnails/";    
        }else{
            echo "<script type='text/javascript'>alert('Es konnte kein Zielordner ausgew&auml;hlt werden!');</script>";
        }
        
    
        
        
        // Orginalbild
        //$bild="Foto.jpg";
        $bild=$_POST['pfad'];
        
        // Bilddaten ermitteln
        $size=getimagesize("$PicPathIn"."$bild");
        $breite=$size[0];
        $hoehe=$size[1];
        $neueBreite=$_POST['quali'];
        $neueHoehe=intval($hoehe*$neueBreite/$breite);
        echo($size[2]);
        if($size[2]==1) {
        // GIF
            $altesBild=ImageCreateFromGIF("$PicPathIn"."$bild");
            $neuesBild=imageCreate($neueBreite,$neueHoehe);
            imageCopyResized($neuesBild,$altesBild,0,0,0,0,$neueBreite,$neueHoehe,$breite,$hoehe);
            imageGIF($neuesBild,"$PicPathOut".""."$bild");
            
        }
        
        if($size[2]==2) {
        // JPG
        
            /**$altesBild=ImageCreateFromJPEG("$PicPathIn"."$bild");
            $neuesBild=imageCreate($neueBreite,$neueHoehe);
            imageCopyResized($neuesBild,$altesBild,0,0,0,0,$neueBreite,$neueHoehe,$breite,$hoehe);
            ImageJPEG($neuesBild,"$PicPathOut".""."$bild");**/
            /**if($size[0]<200||$size[1]<200){**/
            $src_img=imagecreatefromjpeg("$PicPathIn"."$bild");
            $dst_img=imagecreatetruecolor($neueBreite,$neueHoehe);
            imagecopyresampled($dst_img,$src_img,0,0,0,0,$neueBreite,$neueHoehe, $size[0], $size[1]);
            imagejpeg($dst_img, "$PicPathOut"."$bild");
            imagedestroy($src_img);
            imagedestroy($dst_img);
            /**}*/
        }
        
        
        if($size[2]==3) {
        // PNG
            $altesBild=ImageCreateFromPNG("$PicPathIn"."$bild");
            $neuesBild=imageCreate($neueBreite,$neueHoehe);
            imageCopyResized($neuesBild,$altesBild,0,0,0,0,$neueBreite,$neueHoehe,$breite,$hoehe);
            ImagePNG($neuesBild,"$PicPathOut".""."$bild");
        }
        
        /**
        echo "Altes Bild:<BR>";
        echo "<IMG SRC="$PicPathIn.$bild" WIDTH="$breite" HEIGHT="$hoehe"><BR><BR>";
        echo "Neues Bild:<BR>";
        $Thumbnail=$PicPathOut."TN".$bild;
        echo "<IMG SRC="$Thumbnail" WIDTH="$neueBreite" HEIGHT="$neueHoehe">"; 
        **/
    }
    
    ?>
</div> 
