<?php 
class tragitti{
    function aggiungiTragitto($descrizione,$km,$pkTipo) {
          require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="INSERT INTO tbltragitto(descrizione,km, fkTipo) VALUES ('$descrizione','$km','$pkTipo')";
        
        $risutlato=$myGestioneDb->eseguicomando($sql);
        return $risutlato;
    }
     function pkXDescrizioneKmTipo($descrizione,$km,$pkTipo) {
          require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="SELECT DISTINCT t.pkTragitto FROM tbltragitto as t WHERE t.descrizione='$descrizione' AND t.km='$km' AND t.fkTipo='$pkTipo'";
        
        $risutlato=$myGestioneDb->eseguicomando($sql);
        return $risutlato;
    }
    function tragittiXpkAtleta($pkAtleta) {
          require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="SELECT DISTINCT t.descrizione,t.km,t.pkTragitto FROM tblatleta as a INNER JOIN tblperformance as p on a.pkAtleta=p.fkAtleta INNER JOIN tbltragitto as t on t.pkTragitto=p.fkTragitto WHERE	a.pkAtleta=$pkAtleta ORDER by t.fkTipo";
        
        $risutlato=$myGestioneDb->eseguicomando($sql);
        return $risutlato;
    }
    function modificaTragitto($pkTragitto,$descrizione,$km) {
          require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="UPDATE tbltragitto SET descrizione='$descrizione',km='$km' WHERE pkTragitto=$pkTragitto";
        
        $risutlato=$myGestioneDb->eseguicomando($sql);
        return $risutlato;
    }
}
?>