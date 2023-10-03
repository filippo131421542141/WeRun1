<?php 
class performance{
    function aggiungiPerfoamnce($data,$durata,$fkTragitto,$fkAtleta) {
          require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="INSERT INTO tblperformance( data, durata, fkTragitto, fkAtleta) VALUES ('$data','$durata','$fkTragitto','$fkAtleta')";
        $risutlato=$myGestioneDb->eseguicomando($sql);
        
        return $risutlato;
    }
    function performanceXpkTragittoePkAlteta($pkTragitto,$pkAtleta) {
          require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="SELECT * FROM tblperformance AS p INNER JOIN tblatleta as a on a.pkAtleta=p.fkAtleta WHERE p.fkTragitto=$pkTragitto AND a.pkAtleta=$pkAtleta";
        $risutlato=$myGestioneDb->eseguicomando($sql);
        
        return $risutlato;
    }
    function eliminazionePerformance($pkPerformance) {
          require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="DELETE FROM tblperformance WHERE pkPerformance=$pkPerformance";
        $risutlato=$myGestioneDb->eseguicomando($sql);
        
        return $risutlato;
    }

    function modificaPerformance($pkPerformance,$tempo,$data) {
          require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="UPDATE tblperformance SET data='$data',durata='$tempo' WHERE pkPerformance=$pkPerformance";
        $risutlato=$myGestioneDb->eseguicomando($sql);
        
        return $risutlato;
    }

    function mediePerformance() {
          require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="SELECT p.data, AVG(t.km) as km FROM tblperformance as p INNER JOIN tbltragitto as t on t.pkTragitto=p.fkTragitto GROUP by p.data";
        $risutlato=$myGestioneDb->eseguicomando($sql);
        
        return $risutlato;
    }
}
?>