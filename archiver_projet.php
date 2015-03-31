<?php
require_once 'config.php';
$idProjet=$_POST["idProjet"];
$statut=$_POST["statut"];
   $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname=" . config::DBNAME, config::USER, config::PASSWORD);
   $req = $pdo->prepare("UPDATE `projet` SET `statut` = :statut WHERE `idProjet` =:idProjet");
   $req->bindParam((':idProjet'), $idProjet);
   $req->bindParam((':statut'), $statut);
   $req->execute();
     header('Location: Directeur.php');