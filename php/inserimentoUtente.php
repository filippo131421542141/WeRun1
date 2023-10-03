<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
    <title>Conferma Inserimeto</title>
</head>

<body>
    <?php 
    
$nome=$_POST["rNome"];
$cognome=$_POST["cognome"];
$psw=$_POST["psw"];
$mail=$_POST["mail"];
$luogo=$_POST["luogo"];
$genere=$_POST["rbtnGenere"];
$ruolo=$_POST["rbtnRuolo"];

if($ruolo=="atleta"){
    require_once("../classi/atleta.php");
    $myatleta= new Atleta();
    $risultato=$myatleta->insermentoAtleta($nome,$cognome,$psw,$mail,$luogo,$genere);
    if($risultato==true){
        
    }

}else{
     require_once("../classi/allenatore.php");
    $myAllenatore= new Allenatore();
    $risultato=$myAllenatore->insermentoAllenatore($nome,$cognome,$psw,$mail,$genere);
    if($risultato==true){
        
    }
    
}



?>
    <div class="confermaInserimento">
        <span>Iscrizione Completata con Successo </span>
        <span>vai alla home per Accedere</span>
        <a href="../index.php">

            <lord-icon src="https://cdn.lordicon.com/gmzxduhd.json" trigger="hover"
                colors="primary:#000000,secondary:#000000" style="width:250px;height:250px">
            </lord-icon>
        </a>
    </div>
</body>

</html>