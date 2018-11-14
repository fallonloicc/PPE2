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
							<tbody>
								<tr class='table-head'>
									<td class='column-1'>Libellé</td>
									<td class='column-2'>Quantité</td>
									<td class='column-3'>Prix Unitaire</td>
									<td class='column-4'>Action</td>
								</tr>
							</tbody>

							<?php
							if (creationPanier())
							{
								$nbArticles=count($_SESSION['panier']['libelleProduit']);
								if ($nbArticles <= 0)
									echo "<tr class='table-head'><td>Votre panier est vide </td></tr>";
								else
								{
									for ($i=0 ;$i < $nbArticles ; $i++)
									{	
										echo "<tr class='table-row'>";
										echo "<td class='column-1'>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</ td>";
										echo "<td class='column-2'><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/></td>";
										echo "<td class='column-3'>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td>";
										echo "<td class='column-4'><a href=\"".htmlspecialchars("cart.php?action=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i]))."\">X</a></td>";
										echo "</tr>";
										echo "</table>";
									}

									echo '<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">';
									echo '<div class="flex-w flex-sb-m p-t-26 p-b-30">';
									echo '<span class="m-text22 w-size19 w-full-sm"> Total : </span>';
									echo " <span class='m-text22 w-size19 w-full-sm'>".MontantGlobal()." €</span>";
									echo "</div></div>";

									echo "<button class='flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4' type=\"submit\" value=\"Rafraichir\"/>";

									echo "</td></tr>";
								}
							}
							?>
						</form></br>
						<a href='../product.php'>Revenir à vos achats</a>
						<a href='../index.php'>Home Page</a>
						<?php 
						echo "</div> </div> </div>";
						?>
					</section>
				</body>
				</html>