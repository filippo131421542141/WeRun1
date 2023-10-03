<?php 
class tipoCorsa{
    function tuttiTipi() {
          require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="SELECT * FROM tblTipo";
        $risutlato=$myGestioneDb->eseguicomando($sql);
       
        return $risutlato;
    }
}
?>