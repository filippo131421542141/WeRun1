<?php  
require_once("../classi/atleta.php");
$myAtleta=new Atleta();
$mail=$_GET["mail"];
$psw = $_GET["psw"];

$dtRisutato=$myAtleta->verificaAtleta($mail,$psw);
if($dtRisutato->num_rows==0){
    echo "-1";
}
while($rigaAtleta=$dtRisutato->fetch_object()){
    echo $rigaAtleta->pkAtleta;
}
?>