<!DOCTYPE html>
<?php 
    require_once 'config.php';

    $PDO = new PDO("mysql:host=" . config::SERVERNAME . ";dbname=" . config::DBNAME, config::USER, config::PASSWORD);

    $nom = $_POST['nom'];
?>
<html>
    <head>
        <link href="Css/Directeur.css" rel="stylesheet" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title></title>
</head>
    <body>
        <div>
            <a href="index.php">
                <div id="home">
                    <p><img src="Ressource/home.jpg" height="50" width="50" alt="home" /> retour a la page home</p>
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
    
    $reqP = $PDO->prepare("SELECT EmployeSuivant, TpsH FROM projet WHERE Nom = :nom;"); 

    $reqP->bindParam(':nom', $nom);  
    $reqP->execute();

    $resu = $reqP->fetch();
    $EmployeSuivant = $resu["EmployeSuivant"];
    $TpsH = $resu["TpsH"]; 

    $req = $PDO->prepare("SELECT nom FROM employer WHERE id = :EmployeSuivant;"); 

    $req->bindParam(':EmployeSuivant', $EmployeSuivant);  
    $req->execute();
    $resuE = $req->fetch();
    $Employe = $resuE["nom"]; 

    echo "Voici votre projet : "  . $nom . "<br />";
    echo  "L'Employe Actuelle est "  . $Employe . "<br />";
    echo  "Le temps total : "  . $TpsH . "<br />";

?> 
        </div>


    </body>
</html>