<?php
require_once 'config.php';
// Ajouter un membre du personel (requet)
if ((isset($_POST['nom']) && !empty($_POST['nom'])) && (isset($_POST['prenom']) && !empty($_POST['prenom']))) {
    $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname=" . config::DBNAME, config::USER, config::PASSWORD);
    $req = $pdo->prepare("INSERT INTO employer (nom, prenom, statut) VALUES (:nom,:prenom,'oui')");
    $req->bindParam((':nom'), $_POST['nom']);
    $req->bindParam((':prenom'), $_POST['prenom']);
    $req->execute();
}
// Supprimer un membre du personnel (requet)
if ((isset($_POST['id']) && !empty($_POST['id']))) {
    $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname=" . config::DBNAME, config::USER, config::PASSWORD);
    $req = $pdo->prepare("DELETE FROM `employer` WHERE id=:id");
    $req->bindParam((':id'), $_POST['id']);
    $req->execute();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="Css/Directeur.css" rel="stylesheet" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Directeur</title>
    </head>
    <body>
        <!-- boutton de retour a la page Projet -->
        <div>
            <a href="projet.php">
                <div id="home">
                    <h2>Retour</h2>
                </div>
            </a>
        </div>
        <!-- image de la societe -->
        <header>
            <div>
                <img src="Ressource/EsterEtMarie.png" height="250" width="650">
            </div>
        </header>
        <!-- Corp de la page -->
        <div id="employes">
            <!-- Cree un projet -->
            <div class="bouton">
                <h1>Créer un projet</h1>
                <form action="cree_un_projet.php" method="post">
                    Nom : <input type="text" name="nom_projet"><br />
                    Temps : <input type="number" name="temps"><br />
                    Nom premier employé : 
                    <?php
                    $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname=" . config::DBNAME, config::USER, config::PASSWORD);
                    $req = $pdo->prepare("SELECT id,prenom,nom FROM employer");
                    $req->execute();
                    echo "<SELECT NAME='id' onChange='FocusObjet()'>";
                    while ($donnees = $req->fetch()) {
                        echo "<OPTION VALUE='" . $donnees["id"] . "'>" . $donnees['prenom'] . " " . $donnees['nom'] . "</OPTION>\n";
                    }
                    echo "</SELECT>";
                    ?>
                    <input type="submit" name="Cree">
                </form>
            </div>
            <!-- Archiver un projet -->
            <div class="bouton">
                <h1>Archiver un projet</h1>
                <form method="post" action="archiver_projet.php">
                    Nom : 
                    <?php
                    $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname=" . config::DBNAME, config::USER, config::PASSWORD);
                    $req = $pdo->prepare("SELECT idProjet,Nom FROM projet");
                    $req->execute();
                    echo "<SELECT NAME='idProjet' onChange='FocusObjet()'>";
                    while ($donnees = $req->fetch()) {
                        echo "<OPTION VALUE='" . $donnees["idProjet"] . "'>" . $donnees['Nom'] . "</OPTION>\n";
                    }
                    echo "</SELECT>";
                    ?>
                    <?php
                    echo "<SELECT NAME='statut' onChange='FocusObjet()'>";
                    echo "<option value='en_cour'>en cour</option>
                    <option value='fini'>fini</option>
                    <option value='annuler'>annuler</option>
                    </select>";
                    ?>

                    <br /><br/><input type="submit" value="Modifier">
                </form>
            </div>
            <!-- Formulaire pour ajouter un membre du personel -->
            <div class="bouton">
                <h1>Ajouter un membre du personnel</h1>
                <form action="Directeur.php" method="post">
                    Nom : <input type="text" name="nom">
                    Prénom : <input type="text" name="prenom"><br /><br/>
                    <input type="submit" name="Ajouter" value="Ajouter">
                </form>
            </div>
            <!-- Le formulaire pour cchanger le statut d'un membre du personel -->
            <div class="bouton">
                <h1>Modifier un membre du personnel</h1>
                <form method="post" action="archiver_employer.php">
                    Nom : 
                    <?php
                    $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname=" . config::DBNAME, config::USER, config::PASSWORD);
                    $req = $pdo->prepare("SELECT id,prenom,nom FROM employer");
                    $req->execute();
                    echo "<SELECT NAME='id' onChange='FocusObjet()'>";
                    while ($donnees = $req->fetch()) {
                        echo "<OPTION VALUE='" . $donnees["id"] . "'>" . $donnees['prenom'] . " " . $donnees['nom'] . "</OPTION>\n";
                    }
                    echo "</SELECT>";
                    ?>
                    <?php
                    echo "<SELECT NAME='statut_modifier' onChange='FocusObjet()'>";
                    echo "<option value='oui'>oui</option>
                    <option value='non'>non</option>
                    </select>";
                    ?>
                    <br /><br/><input type="submit" value="Modifier">
                </form>
            </div>
            <!-- Suprimer un personel -->
            <div class="bouton">
                <h1>Supprimer un membre du personnel</h1>
                <form method="post" action="Directeur.php">
                    Nom : 
                    <?php
                    $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname=" . config::DBNAME, config::USER, config::PASSWORD);
                    $req = $pdo->prepare("SELECT id,prenom,nom FROM employer");
                    $req->execute();
                    echo "<SELECT NAME='id' onChange='FocusObjet()'>";
                    while ($donnees = $req->fetch()) {
                        echo "<OPTION VALUE='" . $donnees["id"] . "'>" . $donnees['prenom'] . " " . $donnees['nom'] . "</OPTION>\n";
                    }
                    echo "</SELECT>";
                    ?>
                    <br /><br/><input type="submit" value="Supprimer un membre">
                </form>
            </div>
        </div>
    </body>
</html>