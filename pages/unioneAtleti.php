<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/scriptUtenti.js"></script>
    <script src="../js/jquery-3.7.0.js"></script>
    <script src="https://kit.fontawesome.com/ebb1b1fbd4.js" crossorigin="anonymous"></script>
    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
    <link rel="stylesheet" href="../css/styleAreaUtenti.css">
    <title>WeRun-Collegamento Atleta</title>
</head>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
</script>
<script type="text/javascript">
(function() {
    emailjs.init("FTIAu7QfSVJW5ZfgO");
})();
</script>

<body>
    <nav>
        <ul>
            <li>
                <a href="./areaAccessoAllenatore.php"> <i class="fa-solid fa-house fa-3x"
                        style="color: #ffffff;"></i></a>
            </li>
            <li>

                <i class="fa-solid fa-link fa-3x" style="color: #808080;"></i>

            </li>

            <li>
                <a href="../index.php"><i class="fa-solid fa-power-off fa-3x" style="color: #ffffff;"></i></a>
            </li>
        </ul>
    </nav>
    <section class="sUnioneAtleti">
        <p>Inserisci la mail del Atleta per collegarti</p>
        <form action="unioneAtleti.php" method="post">
            <?php
            session_start();
            require_once("../classi/allenatore.php");
            $myAllenatore = new Allenatore();
            $dtAllenatore = $myAllenatore->datiXpk($_SESSION["pkAllenatore"]);

            while ($rigaAllenatore = $dtAllenatore->fetch_object()) {
                echo "<input type='hidden' name='nome'  id='nomeAll' value='$rigaAllenatore->nome'>";
                echo "<input type='hidden' name='cognome' id='cognomeAll' value='$rigaAllenatore->cognome'>";
                echo "<input type='hidden' name='pk' id='pkAll' value='$rigaAllenatore->pkAllenatore'>";
            }
            ?>
            <div class="invio"> <input type="email" name="inptMail" id="inptMail">
                <button onclick="inviaMail()" name="invia"><i class="fa-solid fa-share fa-2x"
                        style="color: #000000;"></i></button>
            </div>

        </form>

    </section>
</body>

</html>