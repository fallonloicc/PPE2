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
	
	if ($decode['success'] == true) 
	{
		// C'est un humain, mettre le code pour le mail
		//vérifier si les champs sont vide 
		if(empty($_POST['name'])  	||
		   empty($_POST['email']) 	||
		   empty($_POST['subject']) 	||
		   empty($_POST['message'])	||
		   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
		   {
			echo "Pas d'argument";
			return false;
		   }
			
		$name = $_POST['name'];
		$email_address = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];
			
		// creer  un email et l'envoi	
		$to = 'gregoiresomon@gmail.com'; // mettre votre adresse email ici
		$email_subject = $subject;
		$email_body = "You have received a new message. \n\n".
						  " Here are the details:\n \nName: $name \n ".
						  "Email: $email_address\n Message: \n $message";
		$headers = "From: noreply@yourdomain.com\n"; 
		// Since this email form will be generated from your server. The From email address will be best using something like this 		noreply@yourdomain.com
		$headers .= "Reply-To: $email_address";	
		mail($to,$email_subject,$email_body,$headers);
		return true;			
	}
	
	else 
	{
		// C'est un robot ou le code de vérification est incorrecte, mettre une erreur
		echo "Validez le captcha";
	}
		
?>