<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/jquery-3.7.0.js"></script>
    <script src="js/script.js"></script>
    <script src="js/scriptUtenti.js"></script>
    <title>WeRun-Home Page</title>
</head>
<?php 
require_once("classi/atleta.php");
require_once("classi/allenatore.php");
$myAtleti=new Atleta();
$myAllenatori=new Allenatore();
$arrMailAllenatori=[];
$arrMailAtleti=[];
$risMailAllenatori=$myAllenatori->mailAllenatori();
$risMailAtleti=$myAtleti->mailAtleti();
while($rigaAtleti=$risMailAtleti->fetch_object()){
    $arrMailAtleti[]=$rigaAtleti->mail;
}
while($righaAllenatori=$risMailAllenatori->fetch_object()){
    $arrMailAllenatori[]=$righaAllenatori->mail;
}


?>
<script>
function controlloDati() {
    let mailAtleti = <?php echo json_encode($arrMailAtleti); ?>;
    let mailAllenatori = <?php echo json_encode($arrMailAllenatori); ?>;

    let tuttOk = true;
    const tuttInput = document.querySelectorAll("input");
    let rbtnMaschio;
    let rbtnFemmina;
    let rbtnAtleta;
    let rbtnAllenatore;
    let txtMail
    let inptRegistrazione = [];
    for (let i = 0; i < tuttInput.length; i++) {
        if (tuttInput[i].id == "maschio") {
            rbtnMaschio = tuttInput[i];
        }

        if (tuttInput[i].id == "femmina") {
            rbtnFemmina = tuttInput[i];
        }

        if (tuttInput[i].id == "atleta") {
            rbtnAtleta = tuttInput[i];
        }

        if (tuttInput[i].id == "allenatore") {
            rbtnAllenatore = tuttInput[i];
        }

        if (tuttInput[i].id == "rMail") {
            txtMail = tuttInput[i];
        }
        if (
            tuttInput[i].id == "switch" ||
            tuttInput[i].id == "mailAccesso" ||
            tuttInput[i].id == "pswAccesso"
        ) {} else {
            inptRegistrazione.push(tuttInput[i]);
        }
    }

    let psw;
    let cpsw;
    for (let i = 0; i < inptRegistrazione.length; i++) {
        if (
            inptRegistrazione[i].value == "" ||
            (rbtnAllenatore.checked == false) & (rbtnAtleta.checked == false) ||
            (rbtnMaschio.checked == false) & (rbtnFemmina.checked == false)
        ) {
            alert("Dato Mancante");
            inptRegistrazione[i].focus();
            tuttOk = false;
            break;
        }

        if (inptRegistrazione[i].id == "psw") {
            psw = inptRegistrazione[i].value;
        }
        if (inptRegistrazione[i].id == "cPsw") {
            cpsw = inptRegistrazione[i].value;
        }
    }
    if (psw != cpsw) {
        alert("Password non Corrispondenti");
        tuttOk = false;
    }
    if (mailAtleti.includes(txtMail.value)) {
        alert("Attenzione, Mail già presente come Atleta");
        tuttOk = false;
    }
    if (mailAllenatori.includes(txtMail.value)) {
        alert("Attenzione, Mail già presente come Allenatore");
        tuttOk = false;
    }
    return tuttOk;
}
</script>



<body onload="popoladtl('dtlProvincie');showSlides('carouselImmagini')">

    <div class="introduzione">

        <div class="wrapper">
            <div>
                <h1>We Run</h1>
                <h4>Tieni Traccia dei tuoi Risultati </h4>
            </div>
        </div>
        <div class="container">
            <div class="slider">
                <div class="box1">
                </div>
                <div class="box2">
                </div>
                <div class="box3">
                </div>
                <div class="box4">
                </div>
                <div class="box5">
                </div>
                <div class="box6">
                </div>
                <div class="box7">
                </div>
            </div>
        </div>
        <div id="test"></div>
    </div>



    </div>

    <div class="main" id="main">

        <input type="checkbox" id="switch" onchange="aumentaAltezza('switch','main')" />
        <div class="accedi">
            <label for="switch" aria-hidden="true">Accedi</label>
            <div class="input-container">
                <input placeholder="Email" class="input-field" type="email" id="mailAccesso" name="aMail" />
                <label for="input-field" class="input-label">Email</label>
                <span class="input-highlight"></span>
            </div>

            <div class="input-container">
                <input placeholder="Password" class="input-field" type="password" id="pswAccesso" name="aPsw" />
                <label for="input-field" class="input-label">Password</label>
                <span class="input-highlight"></span>
            </div>
            <button onclick="VerificaUtente('mailAccesso','pswAccesso')">Accedi</button>


        </div>
        <div class="registrati">
            <form action="php/inserimentoUtente.php" method="post" onsubmit="return controlloDati()"
                id="frmRegistrazione">
                <label for="switch" aria-hidden="true" class="labelRegistrati">Registrati</label>
                <div class="input-container">
                    <input placeholder="Nome" class="input-field" type="text" name="rNome" />
                    <label for="input-field" class="input-label">Nome</label>
                    <span class="input-highlight"></span>
                </div>
                <div class="input-container">
                    <input placeholder="Cognome" class="input-field" type="text" name="cognome" id="rCognome" />
                    <label for="input-field" class="input-label">Cognome</label>
                    <span class="input-highlight"></span>
                </div>
                <div class="input-container">
                    <input placeholder="Email" class="input-field" type="email" name="mail" id="rMail" />
                    <label for="input-field" class="input-label">Email</label>
                    <span class="input-highlight"></span>
                </div>
                <div class="input-container">
                    <input placeholder="Password" class="input-field" type="text" name="psw" id="psw" />
                    <label for="input-field" class="input-label">Password</label>
                    <span class="input-highlight"></span>
                </div>
                <div class="input-container">
                    <input placeholder="Conferma Password" class="input-field" type="text" id="cPsw" />
                    <label for="input-field" class="input-label">Conferma Password</label>
                    <span class="input-highlight"></span>
                </div>
                <div class="luogo">
                    <p>Seleziona la tua provincia </p>
                    <input list="dtlProvincie" id="inptProvincia" name="luogo">
                    <datalist id="dtlProvincie">
                    </datalist>
                </div>
                <p>Seleziona il genere</p>
                <div class="genere">
                    <div>
                        <label for="maschio">Maschio</label><input type="radio" name="rbtnGenere" id="maschio"
                            value="Maschio" />
                    </div>
                    <div>
                        <label for="femmina">femmina</label><input type="radio" name="rbtnGenere" id="femmina"
                            value="Femmina" />
                    </div>
                </div>
                <p>Seleziona il tuo Ruolo</p>
                <div class="tipo">
                    <div>
                        <label for="atleta">Atleta</label>
                        <input type="radio" name="rbtnRuolo" id="atleta" value="atleta" />
                    </div>
                    <div>
                        <label for="allenatore">Allenatore</label>
                        <input type="radio" name="rbtnRuolo" id="allenatore" value="allenatore" />
                    </div>
                </div>
                <button type="submit">Registrati</button>
            </form>
        </div>
    </div>
</body>


</html>