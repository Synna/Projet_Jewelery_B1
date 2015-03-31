<?php
require_once 'config.php';

$PDO = new PDO("mysql:host=" . config::SERVERNAME . ";dbname=" . config::DBNAME, config::USER, config::PASSWORD);
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="Css/index.css" rel="stylesheet" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title></title>
    </head>
    <body>
        <div>
            <a href="projet.php">
                <div id="Directeur">
                    <h1>Directeur</h1>
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
    $reqE = $PDO->prepare("SELECT id, prenom FROM employer WHERE statut='oui' AND nom != 'Directeur';");

$reqE->execute();


while ($resu = $reqE->fetch()) {

    echo '<a href="employer.php?id=' . $resu["id"] . '" class="bouton">';
    echo '<h1>';

    $nom = $resu["prenom"];

    echo $nom;
    echo '</h1> </a>';
}
?>


        </div>

    </body>
</html>
