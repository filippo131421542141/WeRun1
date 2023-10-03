<?php 
require_once("../classi/atleta.php");
session_start();
$myAtleta= new Atleta();
$risultatokm=$myAtleta->kmXpkAtleta($_SESSION["pkAtleta"]);
$arrkm=[];
$arrdurate=[];
$arrDate=[];

while ($rigaRisultato=$risultatokm->fetch_object()) {
    array_push($arrkm,$rigaRisultato->km);
    array_push($arrdurate,$rigaRisultato->durata);
    array_push($arrDate,$rigaRisultato->data);
}

echo json_encode($arrkm);
echo "*";
echo json_encode($arrdurate);
echo "*";
echo json_encode($arrDate);

?>