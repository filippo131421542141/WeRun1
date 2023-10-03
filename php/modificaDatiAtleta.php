<?php
require_once("../classi/atleta.php");
$myAtleta=new Atleta();
session_start();
$risultato=$myAtleta->modificaDati($_GET["nome"],$_GET["cognome"],$_GET["psw"],$_GET["mail"],$_GET["luogo"],$_SESSION["pkAtleta"]);
?>