<?php 
session_start();
$pkAtleta=$_SESSION["pkAtleta"];
$data=$_GET["data"];
$durata=$_GET["durata"];
$fkTragitto=$_GET["fkTragitto"];
$fkTragitto=trim($fkTragitto," ");
require_once("../classi/performance.php");
$myPerforance=new performance();

$risultato=$myPerforance->aggiungiPerfoamnce($data,$durata,$fkTragitto,$pkAtleta);
if($risultato>0){
    echo "Performance Inserita Con Successo";
}


?>