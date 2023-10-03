<?php 
require_once("../classi/atleta.php");
$myAtelta=new Atleta();
session_start();

$dtRisutato=$myAtelta->DatiXpkAtleta($_SESSION["pkAtleta"]);

while($rigaRisutlato=$dtRisutato->fetch_object()){
    $arrDatiAtleta=array(
        "nome"=>$rigaRisutlato->nome,
        "cognome"=>$rigaRisutlato->cognome ,
    "mail"=>$rigaRisutlato->mail,
    "psw"=>$rigaRisutlato->psw,
    "luogo"=>$rigaRisutlato->luogo);
    
}

echo json_encode($arrDatiAtleta);
?>