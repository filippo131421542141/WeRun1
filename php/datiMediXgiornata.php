<?php 
require_once("../classi/performance.php");
$myPerformance=new performance();
$dtmedia=$myPerformance->mediePerformance();
$mediaKm=[];
$date=[];

while ($riga=$dtmedia->fetch_object()) {
   
    array_push($mediaKm,$riga->km);
    array_push($date,$riga->data);

}
echo json_encode($mediaKm);

?>