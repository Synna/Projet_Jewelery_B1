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

        <div id="employes">
        	<form method="post" action="cible_PA.php">	
				<?php 	
				echo "Choisissez le projet : ";
				$req = $PDO->prepare("SELECT idProjet,Nom FROM projet WHERE statut = 'fini' OR statut = 'annuler' ");
				$req->execute();
				echo "<SELECT NAME='idProjet' onChange='FocusObjet()'>";
				while ($donnees = $req->fetch()) {
					echo "<OPTION VALUE='" . $donnees["idProjet"] . "'>" . $donnees['Nom'] . "</OPTION>\n";
				}
				echo "</SELECT>";	
				?>

				<br /><br/><input type="submit" value="Rechercher">
			</form>				

		</div>

<?php /* $PDO = new PDO("mysql:host=" . config::SERVERNAME . ";dbname=" . config::DBNAME, config::USER, config::PASSWORD);            
$req = $PDO->prepare("");
        
$req->bindParam(':id', $id);  
$req->execute();

$resu = $reqE->fetch();
$totEmp = $resu["totEmp"]; */
?>

	</body>
</html>