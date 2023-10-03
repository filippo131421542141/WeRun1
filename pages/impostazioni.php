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
    <title>We-Run Impostazioni</title>
</head>

<?php session_start(); ?>
<script>
function oscuraDati(idgestioneUtente) {
    let pkAllenatore = <?php

                            echo json_encode($_SESSION["pkAllenatore"]); ?>;
    if (pkAllenatore != null) {

        let divGestioneUtente = document.getElementById(idgestioneUtente);
        divGestioneUtente.style.display = "none";
    }
}
</script>

<body
    onload="inseirmentoPerformance('divPerformance'); inserimentoDatiUtente('gestioneUtente');oscuraDati('gestioneUtente')">
    <nav>
        <ul>
            <li>
                <a href="areaAccessoAtleta.php"> <i class="fa-solid fa-house fa-3x" style="color: #ffffff;"></i></a>
            </li>
            <li>
                <a href="grafici.html">
                    <lord-icon src="https://cdn.lordicon.com/gqdnbnwt.json" trigger="hover"
                        colors="primary:#ffffff,secondary:#ffffff" style="width:4em; height:4em">
                    </lord-icon>
                </a>
            </li>
            <li>
                <i class="fa-solid fa-gear fa-3x" style="color: #808080;"></i>
            </li>
            <li>
                <a href="../index.php"><i class="fa-solid fa-power-off fa-3x" style="color: #ffffff;"></i></a>
            </li>
        </ul>
    </nav>
    <section id="gestionePercorsi" class="gestionePercorsi">
        <legend>Gestione Percorsi</legend>
        <div class="percosiUtente">

            <?php

            require_once("../classi/tragitto.php");
            $myTragitti = new tragitti();
            $dtTragitti = $myTragitti->tragittiXpkAtleta($_SESSION["pkAtleta"]);
            while ($rigaTragitti = $dtTragitti->fetch_object()) {
                echo "<details class='rigaTragitto' id='$rigaTragitti->pkTragitto'>
                <summary>
                <div class='descrizioneTragitti'>
                    <span>$rigaTragitti->descrizione</span><span> $rigaTragitti->km km</span>
                </div> 
                <div>
                    <button onclick='modificaTragitto($rigaTragitti->pkTragitto, this)'><lord-icon
    src='https://cdn.lordicon.com/sbiheqdr.json'
    trigger='hover'
    colors='primary:#000000,secondary:#000000'
    stroke='100'
    style='width:8rem;height:8rem'>
</lord-icon></button>
                <button onclick='eliminaTragitto($rigaTragitti->pkTragitto, this)'><lord-icon
    src='https://cdn.lordicon.com/gsqxdxog.json'
    trigger='hover'
    colors='primary:#000000,secondary:#000000'
    stroke='100'
    style='width:8rem;height:8rem'>
</lord-icon></button></div></summary>
<div class='divPerformance'></div>
            </details>";
            }
            ?>
        </div>
    </section>
    <section id="gestioneUtente">
        <legend>Gestione Utente</legend>
    </section>

</body>

</html>