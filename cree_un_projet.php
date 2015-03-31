<?php
require_once 'config.php';
$nom_projet=$_POST["nom_projet"];
$temps=$_POST["temps"];
$id=$_POST["id"];
    $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname=" . config::DBNAME, config::USER, config::PASSWORD);
    $req = $pdo->prepare("INSERT INTO projet (Nom, EmployeSuivant, TpsH) VALUES (:nom_projet,:id,:temps)");
    $req->bindParam((':nom_projet'), $nom_projet);
    $req->bindParam((':id'), $id);
    $req->bindParam((':temps'), $temps);
    $req->execute();

     header('Location: Directeur.php');