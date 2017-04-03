<!DOCTYPE html>

<html>
		
	<head>
		<meta charset="utf-8"/>
		<title> Exercice n°2 - Script HTML </title>
	</head>
	
	<body>
		<h3> Informations sur le stage </h3>
		
		<form method="post" action="ex2.php">
		
			Date de début du stage 
			<input type="date" name = "t_dDeb"/>
			</br>
			Heure de début du stage
			<input type="time" name = "t_hDeb"/>
			</br>
			Tarif : 
			<input type="text" name = "t_Tarif"/>
			</br>
		
			<input type="submit" name="b_Valider"/>
		
		</form>
		
		
	</body>

</html>



<?php

	if(isset($_POST['b_Valider']))
	{
		//On affecte les valeurs des champs à des variables
		if (isset($_POST['t_dDeb']))
			$dDeb = $_POST['t_dDeb'];
		else 
			$dDeb = "";
		
		if (isset($_POST['t_hDeb']))
			$hDeb = $_POST['t_hDeb'];
		else 
			$hDeb = "";
		
		if (isset($_POST['t_Tarif']))
			$tarif = $_POST['t_Tarif'];
		else 
			$tarif = "";
	
	
		//On teste si les valeurs sont vides
		if(empty($dDeb) OR empty($hDeb) OR empty($tarif))
		{
			//On affiche un message d'erreur à l'utilisateur
			echo "Merci de remplir l'intégralité des champs";
		}
		
		else
		{
			//Champs bien remplies donc on peut lancer la connexion à la BDD
			try
			{
				//Lancement connexion
				$bdd = new PDO('mysql:host=localhost;dbname=golf', 'root', '');
			}
			catch(PDOException $e)
			{
				echo "Erreur connexion";
				//On coupe la connexion en cas d'erreur
				die();
			}
			
			$bdd->exec("INSERT INTO Stage(idStage, dateDebut, heureDebut, tarifStage) VALUES('','$dDeb','$hDeb','$tarif')");
			
			$bdd = null;
			
			echo "Vos informations ont été ajoutés.";
			
		}
	}
	
	


?>