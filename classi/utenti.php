<?php 
class utenti{
    function mailUtenti() {
          require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="SELECT a.mail FROM tblatleta as a 
UNION 
SELECT al.mail FROM tblallenatore as al";
        
        $risutlato=$myGestioneDb->eseguicomando($sql);
        return $risutlato;
    }

    function inserimentoUnione($pkAll,$pkAtl)
    {
        require_once("gestioneDB.php");
        $myGestioneDb = new gestionedb();
        $sql = "INSERT INTO tblsegue(fkAllenatore,fkAtleta) VALUES ($pkAll,$pkAtl)";
        $risutlato = $myGestioneDb->eseguicomando($sql);
        return $risutlato;
    }
}
?>