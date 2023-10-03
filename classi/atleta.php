<?php 
class Atleta{
    public function insermentoAtleta($nome,$cognome,$psw,$mail,$luogo,$genere){
        require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="INSERT INTO tblatleta( nome,cognome,psw,mail,  luogo, sesso) VALUES ('$nome','$cognome','$psw','$mail','$luogo','$genere')";
        
        $risutlato=$myGestioneDb->eseguicomando($sql);
        return $risutlato;
    }
    public function mailAtleti() {
          require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="SELECT mail FROM tblatleta";
        $risutlato=$myGestioneDb->eseguicomando($sql);
        return $risutlato;
    }
    public function verificaAtleta($mail,$psw) {
          require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="SELECT * FROM tblatleta WHERE mail='$mail' AND psw='$psw'";
        $risutlato=$myGestioneDb->eseguicomando($sql);
        return $risutlato;
    }
    public function DatiXpkAtleta($pkAtleta) {
        require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="SELECT * FROM tblatleta WHERE pkAtleta=$pkAtleta";
        $risutlato=$myGestioneDb->eseguicomando($sql);
        return $risutlato;
        
    }
    public function tragittiXpkEtipo($pkAtleta,$descrizioneTipo) {
        require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="SELECT DISTINCT t.descrizione AS descrizioneTragitto, t.pkTragitto , tipo.descrizione FROM tblatleta as a INNER JOIN tblperformance as p on p.fkAtleta=a.pkAtleta INNER JOIN tbltragitto as t on t.pkTragitto=p.fkTragitto INNER JOIN tbltipo as tipo on tipo.pkTipo=t.fkTipo WHERE a.pkAtleta=$pkAtleta AND tipo.descrizione='$descrizioneTipo'";
        $risutlato=$myGestioneDb->eseguicomando($sql);
      
        return $risutlato;
        
    }
    public function tempiXpkTragittoEpkAtleta($pkAtleta,$pkTragitto) {
        require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="SELECT * FROM tblatleta as a INNER JOIN tblperformance as p on p.fkAtleta=a.pkAtleta INNER JOIN tbltragitto as t on t.pkTragitto=p.fkTragitto INNER JOIN tbltipo as tipo on tipo.pkTipo=t.fkTipo WHERE a.pkAtleta=$pkAtleta AND t.pkTragitto=$pkTragitto";
        $risutlato=$myGestioneDb->eseguicomando($sql);
        
        return $risutlato;
        
    }
    public function datiXAtletaEtipo($pkAtleta,$Tipologia) {
        require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="SELECT p.durata, t.km  FROM tblatleta as a INNER JOIN tblperformance as p on p.fkAtleta=a.pkAtleta INNER JOIN tbltragitto as t on t.pkTragitto=p.fkTragitto INNER JOIN tbltipo as tipo on tipo.pkTipo=t.fkTipo WHERE a.pkAtleta=$pkAtleta AND tipo.descrizione='$Tipologia'";
        $risutlato=$myGestioneDb->eseguicomando($sql);
          
        return $risutlato;
        
    }

    public function modificaDati($nome,$cognome,$psw,$mail,$luogo,$pkAtleta){
        require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="UPDATE tblatleta SET nome='$nome',cognome='$cognome',mail='$mail',psw='$psw',luogo='$luogo' WHERE pkAtleta=$pkAtleta";
        
        $risutlato=$myGestioneDb->eseguicomando($sql);
        return $risutlato;
    }
    
    public function kmXpkAtleta($pkAtleta){
        require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="SELECT p.data, p.durata, t.km FROM tblatleta AS a INNER join tblperformance as p on p.fkAtleta=a.pkAtleta inner JOIN tbltragitto as t on t.pkTragitto=p.fkTragitto WHERE a.pkAtleta=$pkAtleta GROUP BY p.data";
        $risutlato=$myGestioneDb->eseguicomando($sql);
        return $risutlato;
    }
    public function mediakm(){
        require_once("gestioneDB.php");
        $myGestioneDb=new gestionedb();
        $sql="SELECT p.data, AVG(t.km) FROM tblatleta AS a INNER join tblperformance as p on p.fkAtleta=a.pkAtleta inner JOIN tbltragitto as t on t.pkTragitto=p.fkTragitto GROUP by p.data";
        
        $risutlato=$myGestioneDb->eseguicomando($sql);
        return $risutlato;
    }
}
?>