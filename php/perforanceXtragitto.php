<?php 
session_start();
require_once("../classi/performance.php");
$myPerformance=new performance();
$risultato=$myPerformance->performanceXpkTragittoePkAlteta($_GET["pkTragitto"],$_SESSION["pkAtleta"]);
$arrPkTragitti=[];
$arrTempi=[];
$arrDate=[];

while ($rigaRisultaot=$risultato->fetch_object()) {
    array_push($arrPkTragitti,$rigaRisultaot->pkPerformance);
    array_push($arrTempi,$rigaRisultaot->durata);
    array_push($arrDate,$rigaRisultaot->data);

    
}
echo json_encode($arrPkTragitti);
echo "*";
echo json_encode($arrTempi);
echo "*";
echo json_encode($arrDate);


?>