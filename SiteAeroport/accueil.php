<?php
    session_start();
    include_once("./PagesAnnexes/fonctions.php");
?>
<html>
    <head>
        <title>Gestion aéroporturaire - Page d'accueil</title>
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <section id="pageAccueil">
            <h1>Etat des vols</h1>
            <div id="containerEtat">
                <form action="accueil.php" method="get">
                    <select class="listeChoix" name="choixEtat" id="listeEtat">
                        <option value="null">Choisissez l'état des vols</option>
                        <option value="en Vol">Avions en plein vol</option>
                        <option value="au Sol">Avions encore au sol</option>
                        <option value="maintenance">Avions en maitenance</option>
                    </select>
                    <input class="boutonValider" name="boutonValider" type="submit" value="Rechercher">
                </form>
            </div>
        </section>
        <section id="pageAccueil">
            <?php
                if (isset($_GET["choixEtat"]) && $_GET["choixEtat"] != "null"){
                    echo "<div id='resultatsVols'>";
                    echo rechercheEtat();
                    echo "</div>";
                }
            ?>
        </section>
    </body>
</html>