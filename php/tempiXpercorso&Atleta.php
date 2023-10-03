<?php
session_start();
$pkUtente=$_SESSION["pkAtleta"];
$pktragitto=$_GET["pkTragitto"];
require_once("../classi/atleta.php");
$myAtleta=new Atleta();
$dtTempi=$myAtleta->tempiXpkTragittoEpkAtleta($pkUtente,$pktragitto);
$tempi=[];
while ($rigaTempi=$dtTempi->fetch_object()) {
    array_push($tempi,$rigaTempi->durata);
}

echo json_encode($tempi);

?>