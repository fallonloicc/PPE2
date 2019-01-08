	<?php
	session_start();
	include('header.php');
	?>

		<!-- Title Page -->
		<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading-pages-02.jpg);">
			<h2 class="l-text2 t-center">
				Panier
			</h2>
		</section>

		<!-- Cart -->
		<section class="cart bgwhite p-t-70 p-b-100">
			<?php
			include_once("panier/fonction_panier.php");

			$erreur = false;

			$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
			if($action !== null)
			{
				if(!in_array($action,array('ajout', 'suppression', 'refresh')))
					$erreur=true;

					//récuperation des variables en POST ou GET
				$l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
				$p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
				$q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;

					//Suppression des espaces verticaux
				$l = preg_replace('#\v#', '',$l);
					//On verifie que $p soit un float
				$p = floatval($p);

					//On traite $q qui peut etre un entier simple ou un tableau d'entier

				if (is_array($q)){
					$QteArticle = array();
					$i=0;
					foreach ($q as $contenu){
						$QteArticle[$i++] = intval($contenu);
					}
				}
				else
					$q = intval($q);

			}

			if (!$erreur){
				switch($action){
					Case "ajout":
					ajouterArticle($l,$q,$p);
					break;

					Case "suppression":
					supprimerArticle($l);
					break;

					Case "refresh" :
					for ($i = 0 ; $i < count($QteArticle) ; $i++)
					{
						modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
					}
					break;

					Default:
					break;
				}
			}

			?>
			<div class='container'>
				<div class="container-table-cart pos-relative">
					<div class="wrap-table-shopping-cart bgwhite">
						<form method="post" action="cart.php">
							<table class="table-shopping-cart">
								<tr class='table-head'>
									<th class='column-1'>Libellé</th>
									<th  class='column-2'>Quantité</th>
									<th class='column-3'>Prix Unitaire</th>
									<th class='column-4'>Action</th>
								</tr>
								<?php

								if (creationPanier())
								{
									$nbArticles=count($_SESSION['panier']['libelleProduit']);
									if ($nbArticles <= 0)
										echo "<tr class='table-head'><td style='padding-left: 15px;'>Votre panier est vide </td>";
									else
									{
										for ($i=0 ;$i < $nbArticles ; $i++)
										{
											echo "<tr class='table-row'>";
											echo "<td class='column-2'>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</ td>";
											echo "<td class='column-3'><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/></td>";
											echo "<td class='column-4'>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td>";
											echo "<td class='column-5'><a href=\"".htmlspecialchars("cart.php?action=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i]))."\">KICK HIM</a></td>";
											echo "</tr>";
										}
										echo "</table>";
										echo "</div>";
										echo "</div>";
										echo '<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">';
										echo '<div class="flex-w flex-sb-m p-t-26 p-b-30">';
										echo '<span class="m-text22 w-size19 w-full-sm"> Total : </span>';
										echo "<span class='m-text22 w-size19 w-full-sm'>".MontantGlobal()." €</span>";

										echo "<tr><td colspan=\"4\">";
							      echo "<input type=\"submit\" class='flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4' value=\"Rafraichir\"/>";
							      echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";

							      echo "</td></tr></br>";
										echo "<input type=\"button\" class='flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4' value=\"Commander\"/>";
									}
									echo "</table>";
									echo "</div>";
								}
								?>
							</form>
							<a style='padding-left: 15px;' href='product.php'>Revenir à vos achats</a>
						</div>
					</section>


					<!-- Footer -->
					<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
						<div class="flex-w p-b-90">
							<div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
								<h4 class="s-text12 p-b-30">
									Nous Contacter
								</h4>

								<div>
									<p class="s-text7 w-size27">
										25 Boulevard Faidherbe - 06 10 82 53 81
									</p>

									<div class="flex-m p-t-30">
										<a href="#" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
										<a href="#" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
										<a href="#" class="fs-18 color1 p-r-20 fa fa-pinterest-p"></a>
										<a href="#" class="fs-18 color1 p-r-20 fa fa-snapchat-ghost"></a>
										<a href="#" class="fs-18 color1 p-r-20 fa fa-youtube-play"></a>
									</div>
								</div>
							</div>

							<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
								<h4 class="s-text12 p-b-30">
									Catégories
								</h4>

								<ul>
									<li class="p-b-9">
										<a href="#" class="s-text7">
											All
										</a>
									</li>

									<li class="p-b-9">
										<a href="#" class="s-text7">
											Bornes
										</a>
									</li>

									<li class="p-b-9">
										<a href="#" class="s-text7">
											Consommables
										</a>
									</li>
								</ul>
							</div>

							<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
								<h4 class="s-text12 p-b-30">
									Liens
								</h4>

								<ul>
									<li class="p-b-9">
										<a href="#" class="s-text7">
											A propos
										</a>
									</li>

									<li class="p-b-9">
										<a href="#" class="s-text7">
											Contactez-nous
										</a>
									</li>
								</ul>
							</div>

							<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
								<h4 class="s-text12 p-b-30">
									Aide
								</h4>

								<ul>
									<li class="p-b-9">
										<a href="#" class="s-text7">
											Besoin d'aide ?
										</a>
									</li>

									<li class="p-b-9">
										<a href="#" class="s-text7">
											Un problème ?
										</a>
									</li>
								</ul>
							</div>

							<div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
								<h4 class="s-text12 p-b-30">
									Newsletter
								</h4>

								<form>
									<div class="effect1 w-size9">
										<input class="s-text7 bg6 w-full p-b-5" type="text" name="email" placeholder="email@example.com">
										<span class="effect1-line"></span>
									</div>

									<div class="w-size2 p-t-20">
										<!-- Button -->
										<button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
											Subscribe
										</button>
									</div>

								</form>
							</div>
						</div>

						<div class="t-center p-l-15 p-r-15">
							<a href="#">
								<img class="h-size2" src="images/icons/paypal.png" alt="IMG-PAYPAL">
							</a>

							<a href="#">
								<img class="h-size2" src="images/icons/visa.png" alt="IMG-VISA">
							</a>

							<a href="#">
								<img class="h-size2" src="images/icons/mastercard.png" alt="IMG-MASTERCARD">
							</a>

							<a href="#">
								<img class="h-size2" src="images/icons/express.png" alt="IMG-EXPRESS">
							</a>

							<a href="#">
								<img class="h-size2" src="images/icons/discover.png" alt="IMG-DISCOVER">
							</a>

							<div class="t-center s-text8 p-t-20">
								Copyright © 2018 All rights reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							</div>
						</div>
					</footer>



					<!-- Back to top -->
					<div class="btn-back-to-top bg0-hov" id="myBtn">
						<span class="symbol-btn-back-to-top">
							<i class="fa fa-angle-double-up" aria-hidden="true"></i>
						</span>
					</div>

					<!-- Container Selection -->
					<div id="dropDownSelect1"></div>
					<div id="dropDownSelect2"></div>



					<!--===============================================================================================-->
					<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
					<!--===============================================================================================-->
					<script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
					<!--===============================================================================================-->
					<script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
					<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
					<!--===============================================================================================-->
					<script type="text/javascript" src="vendor/select2/select2.min.js"></script>
					<script type="text/javascript">
						$(".selection-1").select2({
							minimumResultsForSearch: 20,
							dropdownParent: $('#dropDownSelect1')
						});

						$(".selection-2").select2({
							minimumResultsForSearch: 20,
							dropdownParent: $('#dropDownSelect2')
						});
					</script>
					<!--===============================================================================================-->
					<script src="js/main.js"></script>

				</body>
				</html>
