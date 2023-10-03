<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleAreaUtenti.css">
    <script src="../js/scriptUtenti.js"></script>
    <script src="../js/jquery-3.7.0.js"></script>

    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/add-r.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/check-r.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/ebb1b1fbd4.js" crossorigin="anonymous"></script>
    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
    <title>WeRun-Atleta</title>
</head>



<body onload="caricaDatiUtente();positioSticky()">

    <nav>
        <ul>
            <li>
                <i class="fa-solid fa-house fa-3x" style="color: #808080;"></i>
            </li>
            <li>
                <a href="grafici.html">
                    <lord-icon src="https://cdn.lordicon.com/gqdnbnwt.json" trigger="hover"
                        colors="primary:#ffffff,secondary:#ffffff" style="width:4em; height:4em">
                    </lord-icon>
                </a>
            </li>
            <li>
                <a href="impostazioni.php"><i class="fa-solid fa-gear fa-3x" style="color: #ffffff;"></i></a>
            </li>
            <li>
                <a href="../index.php"><i class="fa-solid fa-power-off fa-3x" style="color: #ffffff;"></i></a>
            </li>
        </ul>
    </nav>
    <div class="IntestazioneAreaRiservata">
        <legend><?php
        session_start();
        require_once("../classi/atleta.php");
        $myAtleta = new Atleta();
        $dtDatiAlteta = $myAtleta->DatiXpkAtleta($_SESSION["pkAtleta"]);
        $arrDatiAtleta = [];
        while ($rigaAtleta = $dtDatiAlteta->fetch_object()) {  
            echo "$rigaAtleta->nome " . "$rigaAtleta->cognome";
        }

                ?>
        </legend>
    </div>
    <section class="sTipiCorse">
        <?php
        require_once("../classi/tipoCorsa.php");
        $myTipo = new tipoCorsa();
        $dtTuttiTipiCorse = $myTipo->TuttiTipi();
        while ($rigaTipi = $dtTuttiTipiCorse->fetch_object()) {
            echo "
    <div class='tipoCorsa' id='$rigaTipi->descrizione'>
            <legend>$rigaTipi->descrizione</legend>
            
            <div class='statisticheMedie'>
                
            </div>
            <span class='intestazionePercorsi'>Percorsi</span>
            <div class='percorsi' id='tuttiPercorsi' name='$rigaTipi->pkTipo'></div>
            
<input type='button' class='btnNewPercorso' onclick='displayAggiungiPercorso($rigaTipi->pkTipo,this)'
            value='Aggiungi Percorso'>

            
        </div>

   ";
        }

        ?>
    </section>

</body>

</html>