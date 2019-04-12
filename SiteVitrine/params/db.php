<?php

	/* DEBUT D'INITIALISATION DE LA CONNEXION DB */
	try
	{
		//connexion base de données en prod
		//$bdd = new PDO('mysql:host=localhost;dbname=efficom_loic', "loicfallon", "efficom");

		//connexion base de données local
		$bdd = new PDO('mysql:host=localhost;dbname=ppe', "root", "");
		
		$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	}
	catch(PDOException $e)
	{
		echo "Impossible de se connecter";
		die();
	}
?>
