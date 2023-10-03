<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleAreaUtenti.css">
    <script src="../js/scriptUtenti.js"></script>
    <script src="../js/jquery-3.7.0.js"></script>
    <script src="https://kit.fontawesome.com/ebb1b1fbd4.js" crossorigin="anonymous"></script>
    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
    <title>WeRun-Allenatore</title>
</head>
<nav>
    <ul>
        <li>
            <i class="fa-solid fa-house fa-3x" style="color: #808080;"></i>
        </li>
        <li>
            <a href="unioneAtleti.php">
                <i class="fa-solid fa-link fa-3x" style="color: #ffffff;"></i>
            </a>
        </li>
        <li>
            <a href="../index.php"><i class="fa-solid fa-power-off fa-3x" style="color: #ffffff;"></i></a>
        </li>
    </ul>
</nav>


<body>
    <div class="intestazione">
        <span>Benvenuto</span>
        <?php
        session_start();
        require_once("../classi/allenatore.php");
        $myAllenatore = new Allenatore();
        $dtAllenatore = $myAllenatore->datiXpk($_SESSION["pkAllenatore"]);
        while ($rigaAllenatore = $dtAllenatore->fetch_object()) {
            echo "$rigaAllenatore->nome  $rigaAllenatore->cognome";
        }
        ?>
    </div>
    <p>Seleziona un Atleta</p>
    <div class="selezioneAtleti">
        <?php

        require_once("../classi/allenatore.php");
        $myAllenatore = new Allenatore();
        $dtAtleti = $myAllenatore->atletiAllenatore($_SESSION["pkAllenatore"]);
        while ($rigaAtleti = $dtAtleti->fetch_object()) {
            echo "<button class='btnSceltaAtelta' onclick='reindirizzamento($rigaAtleti->pkAtleta)'>$rigaAtleti->nome  $rigaAtleti->cognome</button>";
        }
        ?>
    </div>
</body>


</html>