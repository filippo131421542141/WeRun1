<?php  
require_once("../classi/utenti.php");
$myUtenti=new utenti();

$pkAllenatore=$_GET["pkAll"];
$pkatl = $_GET["pkAtl"];

$risultato=$myUtenti->inserimentoUnione($pkAllenatore,$pkatl);
echo $risultato;

?>