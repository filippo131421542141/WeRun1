<?php 
require_once("../classi/performance.php");
$myPerformance= new performance();

$risultato=$myPerformance->modificaPerformance($_GET["pkPerformance"],$_GET["tempo"],$_GET["data"])

?>