<?php 
session_start();
require_once("../classi/atleta.php");
require_once("../classi/allenatore.php");
$myAtleta=new Atleta();
$myAllenatore=new Allenatore();
$mail=$_GET["mail"];
$psw=$_GET["psw"];

$risutatoAllenatore=$myAllenatore->verificaAllenatore($mail,$psw);
$risultatoAtleta=$myAtleta->verificaAtleta($mail,$psw);
$datiAtleta=[];
$datiAllenatore=[];

while ($rigaAtleta=$risultatoAtleta->fetch_object()){
    $datiAtleta=$rigaAtleta;
}
while ($rigaAllenatore=$risutatoAllenatore->fetch_object()){
    $datiAllenatore=$rigaAllenatore;
}


if($risultatoAtleta->num_rows>0){
    echo "atleta";
    $_SESSION["pkAtleta"]=$datiAtleta->pkAtleta;
}elseif($risutatoAllenatore->num_rows>0){
    echo "allenatore";
    $_SESSION["pkAllenatore"]=$datiAllenatore->pkAllenatore;
}else{
    echo "manca";
}

?>