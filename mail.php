<?php
    	
	// Ma clé privée
	$secret = "6LfHlnQUAAAAAGPLIP-Of6mWUUhzIpFIjGaMqLO3";
	// Paramètre renvoyé par le recaptcha
	$response = $_POST['g-recaptcha-response'];
	// On récupère l'IP de l'utilisateur
	$remoteip = $_SERVER['REMOTE_ADDR'];
	
	$api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
	    . $secret
	    . "&response=" . $response
	    . "&remoteip=" . $remoteip ;
	
	$decode = json_decode(file_get_contents($api_url), true);
	
	if ($decode['success'] == true) {
		// C'est un humain, mettre le code pour le mail
	}
	
	else {
		// C'est un robot ou le code de vérification est incorrecte, mettre une erreur
	}
		
?>