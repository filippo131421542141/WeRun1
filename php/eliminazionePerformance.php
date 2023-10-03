<?php 
require_once("../classi/performance.php");
$myPerformance=new performance();
$risultato=$myPerformance->eliminazionePerformance($_GET["pkPerformance"])
?>