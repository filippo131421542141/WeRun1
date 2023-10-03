<?php
require_once("../classi/tragitto.php");
$myTragitto=new tragitti();
$pkTragtto=$_GET["pkTragitto"];
$descrizione=$_GET["descrizione"];
$km=$_GET["km"];
$risultato=$myTragitto->modificaTragitto($pkTragtto,$descrizione,$km);
print_r($risultato);
?>