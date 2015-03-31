<!DOCTYPE html>
<?php
require_once 'config.php';

$PDO = new PDO("mysql:host=" . config::SERVERNAME . ";dbname=" . config::DBNAME, config::USER, config::PASSWORD);
$id = $_GET['id'];
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
        <?php
        $req = $PDO->prepare("SELECT nom, prenom FROM employer WHERE id=:id;");

        $req->bindParam(':id', $id);
        $req->execute();

        $resu = $req->fetch();
        $prenom = $resu["prenom"];
        $nom = $resu["nom"];
        ?>
        <div id="employes">
            <h1><?php echo 'Bonjour ' . $prenom . ' ' . $nom; ?></h1>
        </div>
        <br />

<?php


$reqP = $PDO->prepare("SELECT idProjet, Nom, EmployeSuivant, TpsH, Statut FROM Projet WHERE Statut = 'en_cour' AND EmployeSuivant = :id");
$reqP->bindParam(':id', $id);
$reqP->execute();

while ($resuP = $reqP->fetch()) {
    
    $totH = 0;
    echo '<div id="employes">';

    $idProjet = $resuP["idProjet"];
    $nomProjet = $resuP["Nom"];
    $TpsPrevu = $resuP["TpsH"];
    $Statut = $resuP["Statut"];
    $EmployeSuivant = $resuP["EmployeSuivant"];

    echo "<h1>Projet n°" . $idProjet . " : " . $nomProjet . " </h1> <br />";
    echo "Temps prévu : " . $TpsPrevu . " heures<br /><br />";

    $req = $PDO->prepare("SELECT NomEtape, TpsH, IDEmploye FROM etape WHERE idProjet = :idProjet;");
    $req->bindParam(':idProjet', $idProjet);
    $req->execute();

    while ($donnees = $req->fetch()) {

        $idEmp = $donnees["IDEmploye"];

        $reqE = $PDO->prepare("SELECT nom, prenom FROM employer WHERE id = :id;");
        $reqE->bindParam(':id', $idEmp);
        $reqE->execute();
        $resu = $reqE->fetch();
        $nomE = $resu['nom'];
        $prenomE = $resu['prenom'];

        $totH = $totH + $donnees["TpsH"];
    }

    echo $totH . " heures réellement effectuées <br /><br />";

    $pourcentage = ($totH / $TpsPrevu) * 100;
    $nb = (int) $pourcentage;

    echo "Soit environ " . $nb . "% du temps prévu <br /><br />";

    $reqid = $PDO->prepare("SELECT prenom, nom FROM employer WHERE id = :EmployeSuivant;");
    $reqid->bindParam(':EmployeSuivant', $idEmp);
    $reqid->execute();
    $resuid = $reqid->fetch();
    $prenomES = $resuid['prenom'];
    $nomES = $resuid['nom'];

    $reqN = $PDO->prepare("SELECT MAX(idEtape), MAX(Note) FROM etape WHERE idProjet = :idProjet");
    $reqN->bindParam(':idProjet', $idProjet);
    $reqN->execute();
    $resuN = $reqN->fetch();
    $idNEt = $resuN['MAX(idEtape)'];

    $reqO = $PDO->prepare("SELECT Note FROM etape WHERE idEtape = :idEtape");
    $reqO->bindParam(':idEtape', $idNEt);
    $reqO->execute();
    $resuO = $reqO->fetch();
    $Note = $resuO['Note'];

    if ( empty($prenomES) &&  empty($nomES) ) {
            
        }

    else{
            echo "Lemployé précédent est " . $prenomES . " " . $nomES . ", et il a laisser la note suivante : <br /><br />
            \" " . $Note . " \"<br /><br />";
        }

    

    echo '<form action="Cible_CP.php" method="post">
                    Nom de l`étape effectuée : <input type="text" name="nom_etape">
                    Temps passé en heures : <input type="number" name="nbH"> 
                    L`employé suivant sera ';

                    $reqz = $PDO->prepare("SELECT id,prenom,nom FROM employer WHERE statut = 'oui';");
    $reqz->execute();
    echo "<SELECT NAME='idE' onChange='FocusObjet()'>";
    while ($resuz = $reqz->fetch()) {
        echo "<OPTION VALUE='" . $resuz["id"] . "'>" . $resuz['prenom'] . " " . $resuz['nom'] . "</OPTION>\n";
    }

    echo '</SELECT> <br />
        <input type="hidden" name="idP" value=' . $idProjet . ' />
        <input type="hidden" name="id" value=' . $id . ' />
        <textarea name="note"> </textarea> <br />
        <input type="submit" name="Valider" /> </form></div> <br />';
}
?>

    </body>
</html>