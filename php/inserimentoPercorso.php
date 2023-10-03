<?php 
session_start();
$pkUtente=$_SESSION["pkAtleta"];
$pkTIpo=$_GET["fkTipo"];
$descrizione=$_GET["descrizione"];
$distanza;

require_once("../classi/tragitto.php");
$myTragitto=new tragitti();
switch ($pkTIpo) {
    case 1:
        $distanza=0.1;
        break;
    
        case 2:
        $distanza=0.2;
        break;
        case 3:
        $distanza=0.4;
        break;
        case 8:
        $distanza=21.1;
        break;
         case 9:
        $distanza=42.195;
        break;
        
    default:
        $distanza=null;
        break;
}
if(isset($_GET["distanza"])){
    $distanza=$_GET["distanza"];
}
$risultato=$myTragitto->aggiungiTragitto($descrizione,$distanza,$pkTIpo);
if($risultato==1){
    $pkTragitto=$myTragitto->pkXDescrizioneKmTipo($descrizione,$distanza,$pkTIpo);
    while($rigatragitto=$pkTragitto->fetch_object()){
        echo $rigatragitto->pkTragitto;
        break;
    }
    
}

?>