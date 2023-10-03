<?php
$pkAllenatore;
if (!isset($_GET["invio"])) {

    $pkAllenatore = $_GET["pkAll"];
    echo "<div style='display: none;' id='pkAll'>$pkAllenatore</div>";
}

?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleAreaUtenti.css">
    <script src="../js/scriptUtenti.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/jquery-3.7.0.js"></script>
    <script src="https://kit.fontawesome.com/ebb1b1fbd4.js" crossorigin="anonymous"></script>
    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
    <title>WeRun-Collegamento</title>
</head>
<script>
function collegamento(idMail, idpsw) {
    let mail = document.getElementById(idMail).value;
    let psw = document.getElementById(idpsw).value;

    $.ajax({
        type: "get",
        url: "../php/pkAtletaXmailePsw.php",
        data: {
            mail: mail,
            psw: psw
        },
        success: function(response) {
            let pkAlteta = response
            let pkall = document.getElementById("pkAll").innerHTML
            if (response > 0) {
                $.ajax({
                    type: "get",
                    url: "../php/aggiungiUnione.php",
                    data: {
                        pkAll: pkall,
                        pkAtl: pkAlteta
                    },

                    success: function(response) {
                        if (response == 1) {
                            alert("Evvai, Collegamento avvenuto con successo!!")
                            window.location.href = "../index.php"

                        }
                    }
                });
            } else {
                alert("Nome utente o Password Errati");
            }
        },
    });
}
</script>

<body>
    <div class="unioneDescrzione">
        <p>Benvenuto nella pagina di collegamento</p>
        <p>inserisci nome utente e Password per completare il collegamento</p>
    </div>
    <form action="./aggiungiUnioneDb.php" class="frmInput">
        <input type="mail" id="mail" placeholder="Inserisci la tua mail">
        <input type="password" id="psw" placeholder="Inserisci la tua Password">
        <div> <button onclick="collegamento('mail','psw')" name="invio"><i class="fa-solid fa-paper-plane fa-3x"
                    style="color: #000000;"></i></button>
        </div>

    </form>
</body>

</html>