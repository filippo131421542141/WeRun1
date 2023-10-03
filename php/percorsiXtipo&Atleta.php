<?php 
session_start();
$pkAtleta=$_SESSION["pkAtleta"];
$descriozioneTipo=$_GET["tipo"];
require_once("../classi/atleta.php");
$myAtleta=new Atleta();
$dtpercorsi=$myAtleta->tragittiXpkEtipo($pkAtleta,$descriozioneTipo);
$tragitti=[];
$pkTragitto=[];
while ($rigaPercorsi=$dtpercorsi->fetch_object()) {
    array_push($tragitti,$rigaPercorsi->descrizioneTragitto);
    array_push($pkTragitto,$rigaPercorsi->pkTragitto);
}
echo json_encode($tragitti);
echo "-";
echo json_encode($pkTragitto);
?>