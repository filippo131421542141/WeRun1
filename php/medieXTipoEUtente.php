<?php 
session_start();
require_once("../classi/atleta.php");
$myatleti=new Atleta();
$pkAtleta=$_SESSION["pkAtleta"];
$pkTipo=$_GET["tipo"];

$dtMedie=$myatleti->datiXAtletaEtipo($pkAtleta,$pkTipo);
$arrDurate=[];
$arrKm=[];
while($rigaDati=$dtMedie->fetch_object()){
    array_push($arrKm,$rigaDati->km);
    array_push($arrDurate,$rigaDati->durata);
}
echo json_encode($arrDurate);
echo "-";
echo json_encode($arrKm);
?>