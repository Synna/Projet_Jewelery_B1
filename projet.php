<?php
require_once 'config.php';
$PDO = new PDO("mysql:host=" . config::SERVERNAME . ";dbname=" . config::DBNAME, config::USER, config::PASSWORD);
?>
<html>
    <head>
        <link href="Css/index.css" rel="stylesheet" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title></title>
    </head>
    <body>
        <div>
            <a href="index.php">
                <div id="directeur">
                    <h2> Retour à la page home</h2>
                </div>
            </a>
        </div>
        <div>
            <a href="Directeur.php">
                <div id="Administration">
                    <h2> Administration</h2>
                </div>
            </a>
        </div>
        <header>
            <div>
                <img src="Ressource/EsterEtMarie.png" height="250" width="650">
            </div>
        </header>
        <div id="employes">
            <?php
            echo '<a href="projetEnCours.php" class="bouton">';
            echo '<h1>';
            echo 'Projets en cours';
            echo '</h1> </a>';

            echo " ";

            echo '<a href="projetArchives.php" class="bouton">';
            echo '<h1>';
            echo 'Projets Archivés';
            echo '</h1> </a>';
            ?>
        </div>
    </body>
</html>;


