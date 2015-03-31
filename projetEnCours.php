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
            <a href="projet.php">
                <div id="Directeur">
                    <h1>Retour</h1>
                </div>
            </a>
        </div>
        <header>
            <div>
                <img src="Ressource/EsterEtMarie.png" height="250" width="650">
            </div>
        </header>               

<?php 

    

    $reqP = $PDO->prepare("SELECT idProjet, Nom, EmployeSuivant, TpsH, Statut FROM Projet WHERE Statut = 'en_cour'"); 
    $reqP->execute();

    while ( $resuP = $reqP->fetch()) {
        
        $totH=0;
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
			
			echo $donnees["NomEtape"] . ", " . $donnees["TpsH"] . " H, Fait par " . $prenomE . " " . $nomE;
			echo "<br />";
			
			$totH = $totH + $donnees["TpsH"];
		}

		$reqid = $PDO->prepare("SELECT prenom, nom FROM employer WHERE id = :EmployeSuivant;");
    	$reqid->bindParam(':EmployeSuivant', $EmployeSuivant);  
    	$reqid->execute();
    	$resuid = $reqid->fetch();
    	$prenomES = $resuid['prenom'];
    	$nomES = $resuid['nom'];

		echo "<br />L'employé travaillant dessus actuellement est " .$prenomES. " " . $nomES . "<br />";
		echo "<br />";
		echo $totH . " heures réellement effectuées <br /><br />";
		
		$pourcentage = ($totH / $TpsPrevu)*100;
		$nb=(int)$pourcentage;
		
		echo "Soit environ " . $nb . "% du temps prévu <br /><br />";

		echo'</div>
        <br />';
    }


                   
?>
        
    </body>
</html>