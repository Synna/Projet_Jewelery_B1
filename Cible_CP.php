<?php
require_once 'config.php';
$PDO = new PDO("mysql:host=" . config::SERVERNAME . ";dbname=" . config::DBNAME, config::USER, config::PASSWORD);

$etape = $_POST['nom_etape'];
$nbh = $_POST['nbH'];
$idE = $_POST['idE'];
$idP = $_POST['idP'];
$id = $_POST['id'];
$note = $_POST['note'];

echo "idProjet " . $idP;
echo " idEmploye " . $idE;
echo " temps heure " . $nbh;
echo " nom étape " . $etape;
echo " id ancien employe " . $id;

          
$reqP = $PDO->prepare("UPDATE projet SET EmployeSuivant = :idE WHERE idProjet = :idP;");       
$reqP->bindParam(':idP', $idP); 
$reqP->bindParam(':idE', $idE); 
$reqP->execute();

$reqE = $PDO->prepare("INSERT INTO etape (NomEtape, idProjet, IDEmploye, TpsH, Note) VALUES (:etape, :idP, :id, :nbh, :note)");      
$reqE->bindParam(':etape', $etape);
$reqE->bindParam(':idP', $idP);
$reqE->bindParam(':id', $id);
$reqE->bindParam(':nbh', $nbh);
$reqE->bindParam(':note', $note);    
$reqE->execute();

header('Location: employer.php?id=' . $id . '');
?>