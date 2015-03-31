<?php
require_once 'config.php';
$id=$_POST["id"];
$statut=$_POST["statut_modifier"];
    $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname=" . config::DBNAME, config::USER, config::PASSWORD);
    $req = $pdo->prepare("UPDATE `employer` SET `statut` =:statut WHERE id=:id");
    $req->bindParam((':id'), $id);
    $req->bindParam((':statut'), $statut);
    $req->execute();

    
     header('Location: Directeur.php');