<?php 
class Allenatore{
    public function insermentoAllenatore($nome,$cognome,$psw,$mail,$genere){
        require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="INSERT INTO tblallenatore(nome, cognome, psw, sesso, mail) VALUES ('$nome','$cognome','$psw','$genere[0]','$mail')";
        
        $risutlato=$myGestioneDb->eseguicomando($sql);
    }
    function mailAllenatori() {
          require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="SELECT mail FROM tblatleta ";
        
        $risutlato=$myGestioneDb->eseguicomando($sql);
        return $risutlato;
    }
    function verificaAllenatore($mail,$psw) {
          require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="SELECT * FROM tblallenatore WHERE mail='$mail' AND psw='$psw'";
        $risutlato=$myGestioneDb->eseguicomando($sql);
        return $risutlato;
    }

      function atletiAllenatore($pkAllenatore) {
          require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="SELECT * FROM tblsegue as s  INNER JOIN tblallenatore as a ON s.fkAllenatore=a.pkAllenatore INNER JOIN tblatleta as atl on atl.pkAtleta=s.fkAtleta WHERE a.pkAllenatore=$pkAllenatore";
        $risutlato=$myGestioneDb->eseguicomando($sql);
        return $risutlato;
    }
       function datiXpk($pkAllenatore) {
          require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="SELECT * FROM tblallenatore WHERE pkallenatore=$pkAllenatore";
        $risutlato=$myGestioneDb->eseguicomando($sql);
        return $risutlato;
    }
}
?>