<!DOCTYPE html>
<html lang="fr" >
<head>
	<meta charset="UTF-8">
	<title>Inscription ou Connexion</title>
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:400,300'>
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
	<link rel="stylesheet" href="css/style.css">
	<link rel="shortcut icon" type="image/x-icon" href="images/groot.jpg" />
</head>
<body>
	<div class="cotn_principal">
		<div class="cont_centrar">
			<div style="position: absolute; top: 5px; left: 5px;"><a href="index.html"><input type="button" class="btn_login" value="Accueil"/></a></div>
			<div class="cont_login">
				<div class="cont_info_log_sign_up">
					<div class="col_md_login">
						<div class="cont_ba_opcitiy">
							<h2>Login</h2>  
							<p>Cliquez-ici pour vous connecter</p> 
							<button class="btn_login" onclick="cambiar_login()">Login</button>
						</div>
					</div>
					<div class="col_md_sign_up">
						<div class="cont_ba_opcitiy">
							<h2>Inscription</h2>
							<p>Cliquez-ici pour vous inscrire.</p>
							<button class="btn_sign_up" onclick="cambiar_sign_up()">INSCRIPTION</button>
						</div>
					</div>
				</div>
				<div class="cont_back_info">
					<div class="cont_img_back_grey">
						<img src="images/picc.jpg" alt="" />
					</div>
				</div>
				<div class="cont_forms" >
					<div class="cont_img_back_">
						<img src="images/pic01.jpg" alt="" />
					</div>
					<div class="cont_form_login">
						<a href="" onclick="ocultar_login_sign_up()" ><i class="material-icons">&#xE5C4;</i></a>
						<h2>LOGIN</h2>
						<form action="" method="POST">
							<input type="email" name="user" placeholder="login" />
							<input type="Password" name="passwd" placeholder="Password" />
							<input class="btn_login" type="submit" name="sub" value="INSCRIPTION">
						</form>
					</div>

					<div class="cont_form_sign_up">
						<a href="" onclick="ocultar_login_sign_up()"><i class="material-icons">&#xE5C4;</i></a>
						<h2>INSCRIPTION</h2>
						<form action="" method="POST">
							<input type="text" name="nom" placeholder="Nom" />
							<input type="text" name="prenom" placeholder="Prénom" />
							<input type="Password" name="passwd" placeholder="Password" />							
							<input type="email" name="email" placeholder="Email" />
							<input type="tel" name="tel" placeholder="Téléphone" />
							<input type="text" name="cp" placeholder="Code Postal" />
							<input type="text" name="ville" placeholder="Ville" />
							<input type="text" name="adresse" placeholder="Adresse" />
							<input type="text" name="siret" placeholder="Siret" />
							<input class="btn_login" type="submit" name="sub" value="INSCRIPTION">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script  src="js/autres/index.js"></script>
</body>
</html>