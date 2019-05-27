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
    include("params/db.php");
           
            
    $click =  (isset($_POST['click'])? $_POST['click']:  (isset($_GET['click'])? $_GET['click']:null )) ;
    if($click == 1)
    {       
            //On défini la plsu grande date de la commande et la plus petite pour les dates dans la table commande
            $debDate ="";
            $finDate ="";
            for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++)
            {   
                $datedold = $_SESSION['panier']['debut'][$i];
                $datefold = $_SESSION['panier']['fin'][$i];
                if($datedold == "00/00/0000" && $datefold == "00/00/0000")
                {

                }else{
                    $jourd = $datedold[0] . $datedold[1];
                    $moid=$datedold[3] . $datedold[4];
                    $anneed=$datedold[6] . $datedold[7] . $datedold[8] . $datedold[9];
                    $dated = $anneed . "-" . $moid . "-" . $jourd;                
                    
                    $jourf = $datefold[0] . $datefold[1];
                    $moif=$datefold[3] . $datefold[4];
                    $anneef=$datefold[6] . $datefold[7] . $datefold[8] . $datefold[9];
                    $datef = $anneef . "-" . $moif . "-" . $jourf;
    
                    if ($debDate=="" && $finDate =="") {
                        $debDate = $dated;
                        $finDate = $datef;
                    }else{
                        if($debDate > $dated)
                        {
                            $debDate = $dated;
                        }
                        if ($finDate < $datef) {
                            $finDate = $datef;
                        }
                    }
                }
            }
            //Récupére la date du jour pour savoir à quelle date on a passé la commande
            $today = date("Y-m-d");

            //Création du codeEvent 
            function creaCode(): string
            {
                $codeEvent="";
                for ($i=0; $i < 4; $i++) 
                { 
                    $rand = rand(0,25);
                    $alpha = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
                    $codeEvent = $codeEvent . $alpha[$rand];
                }
                return $codeEvent;
            }

            //Initialisation de la variable codeEvent
            $codeEvent = creaCode();

            //Vérification du code
            for ($verif=6; $verif > 5 ; $verif++) { 
                $req ='SELECT codeEvent FROM commande WHERE codeEvent = "'.$codeEvent.'" ';
                if($verifCode = $bdd->query($req))
                {
                    if($usr = $verifCode->fetch())
                    {
                        //le code existe dejae
                        $codeEvent = creaCode();
                    }else{
                        //Le code n'existe pas 
                        $verif=1;
                    }                    
                }
            }
            
            //Insertion de la commande dans la base de données
            $req='INSERT INTO commande (dateCommande, debutDate, finDate, codeEvent) 
                  VALUES ("' . $today . '","'.$debDate.'","'.$finDate.'", "'.$codeEvent.'")';
            if ($insertCmd = $bdd->query($req)) 
            {
                //Récupère la valeur de l'id de la commande
                $idCommande = $bdd->lastInsertId();
                //On va chercher l'id du client actuel
                $req ='SELECT idClient FROM clients WHERE email = "' . $_SESSION["email"] .'"';
                if ($recupId = $bdd->query($req))
                {
                    if ($idclient = $recupId->fetch())
                    {
                        $idClient = $idclient->idClient;
                        //On associe la commande et le client
                        $req='INSERT INTO commande_client (idClient, idCommande) 
                        VALUES ("' . $idClient . '","' . $idCommande . '")';
                        if ($insertCmdCli = $bdd->query($req)) 
                        {

                        }else{
                            echo "problème d'insertion dans la base de données";
                        }
                    }
                     
                }
                //On parcours tout les articles du panier pour les rentrer dans la table bornes_commandes ou consommable_commande
                for($j = 0; $j < count($_SESSION['panier']['libelleProduit']); $j++)
                { 
                $datedold = $_SESSION['panier']['debut'][$j];
                $datefold = $_SESSION['panier']['fin'][$j];
                //Si les dates sont a 00/00/0000 c'est que c'est un consommable
                if($datedold == "00/00/0000" && $datefold == "00/00/0000")
                {
                    $idConso = $_SESSION['panier']['id'][$j];
                    $qte = $_SESSION['panier']['qteProduit'][$j];
                    //Ajout du consommable dans la table consommable_commande
                    $req='INSERT INTO consommable_commande (idCommande, idConsommables, quantite) 
                        VALUES ("' . $idCommande . '","'.$idConso.'","'.$qte.'")';
                    if ($insertCmd = $bdd->query($req)) 
                    {      

                    }else{
                        echo "problème d'insertion dans la base de données";
                    }
                }else{
                    //change les dates pour pouvoir les rentrer dans la bdd
                    $jourd = $datedold[0] . $datedold[1];
                    $moid=$datedold[3] . $datedold[4];
                    $anneed=$datedold[6] . $datedold[7] . $datedold[8] . $datedold[9];
                    $dated = $anneed . "-" . $moid . "-" . $jourd;                
                    
                    $jourf = $datefold[0] . $datefold[1];
                    $moif=$datefold[3] . $datefold[4];
                    $anneef=$datefold[6] . $datefold[7] . $datefold[8] . $datefold[9];
                    $datef = $anneef . "-" . $moif . "-" . $jourf;
                    
                    $idBornes = $_SESSION['panier']['id'][$j];
                    $qte = $_SESSION['panier']['qteProduit'][$j];
                    
                    //Ajout de la borne dans la table bornes_commande
                    $req='INSERT INTO bornes_commandes (idBornes, idCommande, debutDate, finDate, quantite) 
                        VALUES ("' . $idBornes . '","'.$idCommande.'","'.$dated.'","'.$datef.'","'.$qte.'")';
                    if ($insertCmd = $bdd->query($req)) 
                    {      

                    }else{
                        echo "problème d'insertion dans la base de données";
                    }
                }
            }
            }
    }

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
        $d = (isset($_POST['d'])? $_POST['d']:  (isset($_GET['d'])? $_GET['d']:null )) ;
        $f = (isset($_POST['f'])? $_POST['f']:  (isset($_GET['f'])? $_GET['f']:null )) ;
        $id = (isset($_POST['id'])? $_POST['id']:  (isset($_GET['id'])? $_GET['id']:null )) ;
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
                ajouterArticle($l,$q,$p,$d,$f,$id);
                break;
            Case "suppression":
                supprimerArticle($l,$d,$f);
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
        <?php
        if (creationPanier())
        {
            $nbArticles=count($_SESSION['panier']['libelleProduit']);
            if ($nbArticles <= 0)
            {
                echo "<tr class='table-head'><td style='padding-left: 15px;'>Votre panier est vide </td>";
                echo "<a href='product.php'><input type='button' class='flex-c-m bg1 bo-rad-23 hov1 s-text1 trans-0-4' style='padding: 0 15px 0 15px; margin: 5% 0 0 0;' value='Achetez-ici'></a>";
            }
            else
            {
                echo '<div class="container-table-cart pos-relative">';
                echo '<div class="wrap-table-shopping-cart bgwhite">';
                echo '<form method="post" action="cart.php">';
                echo '<table class="table-shopping-cart">';
                echo '<tr class="table-head">';
                echo '<th class="column-1"></th>';
                echo '<th class="column-2">Libellé</th>';
                echo '<th  class="column-2">Quantité</th>';
                echo '<th class="column-3">Prix Unitaire</th>';
                echo '<th class="column-3">Debut</th>';
                echo '<th class="column-3">Fin</th>';
                echo '<th class="column-5">Action</th>';
                echo '<th class="column-1"></th>';
                echo '</tr>';
                for ($i=0 ;$i < $nbArticles ; $i++)
                {
                    echo "<tr class='table-row'>";
                    echo "<td class='column-1'></td>";
                    echo "<td class='column-2'>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</td>";
                    echo "<td class='column-3'><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/></td>";
                    echo "<td class='column-4'>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td>";
                    echo "<td class='column-3'>".htmlspecialchars($_SESSION['panier']['debut'][$i])."</td>";
                    echo "<td class='column-3'>".htmlspecialchars($_SESSION['panier']['fin'][$i])."</td>";
                    echo "<td class='column-5'><a href=\"".htmlspecialchars("cart.php?action=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i])."&d=".rawurlencode($_SESSION['panier']['debut'][$i])."&f=".rawurlencode($_SESSION['panier']['fin'][$i]))."\"><i class='fa fa-times'></i></a></td>";
                    echo '<th class="column-1"></th>';
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
                echo "</div>";
                echo "<input type=\"submit\" class='flex-c-m bg1 bo-rad-23 hov1 s-text1 trans-0-4' style='padding: 0 58px 0 58px;  margin: 2% 0 1% 0;' value=\"Rafraichir\"/>";
                echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";
                echo "<a href='product.php'><input type='button' class='flex-c-m bg1 bo-rad-23 hov1 s-text1 trans-0-4' style=' padding: 0 15px 0 15px;' value='Revenir à vos achats'></a>";
                echo '<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">';
                echo '<div class="flex-w flex-sb-m p-t-26 p-b-30">';
                /*echo "<label for='event-select'><b>Choisir l'évènement prévu :</b></label><select id='event-select'>";
                $req ='SELECT * FROM evenement';
                $oui = $bdd->query($req);
                while($requete = $oui->fetch())
                {
                    echo "<option value='".$requete->libelle."'>".$requete->libelle."</option>";
                }*/
                echo "</select>";
                echo "<tr><td colspan=\"4\">";
                echo "</td></tr></br>";
                echo '<span class="m-text22 w-size19 w-full-sm"> Total : </span>';
                echo "<span class='m-text22 w-size19 w-full-sm' id='total'>".MontantGlobal()." €</span>";
                echo "</form>";
                echo '<form method="POST" action="?click=1">';
                echo "<button id='validbtn' type='submit' class='flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4' >Valider l'achat</button>";
                echo"<div style='margin: 10% 25% 0 25% ;' id='paypal-button-container'></div>";
            }
            echo "</table>";
            echo "</div>";
        }
        ?>
        </form>
    </div>
</section>

<?php include('footer.php') ?>

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
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>

    // Render the PayPal button
    paypal.Button.render({
// Set your environment
        env: 'sandbox', // sandbox | production
// Specify the style of the button
        style: {
            layout: 'vertical',  // horizontal | vertical
            size:   'responsive',    // medium | large | responsive
            shape:  'rect',      // pill | rect
            color:  'gold'       // gold | blue | silver | white | black
        },
// Specify allowed and disallowed funding sources
//
// Options:
// - paypal.FUNDING.CARD
// - paypal.FUNDING.CREDIT
// - paypal.FUNDING.ELV
        funding: {
            allowed: [
                paypal.FUNDING.CARD,
                paypal.FUNDING.CREDIT
            ],
            disallowed: []
        },
// Enable Pay Now checkout flow (optional)
        commit: true,
// PayPal Client IDs - replace with your own
// Create a PayPal app: https://developer.paypal.com/developer/applications/create
        client: {
            sandbox: 'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
            production: '<insert production client id>'
        },
        payment: function (data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: {
                                total: '<?php echo MontantGlobal(); ?>',
                                currency: 'EUR'
                            }
                        }
                    ]
                }
            });
        },
        onAuthorize: function (data, actions) {
            return actions.payment.execute()
                .then(function () {
                    window.alert('Payment Complete!');
                });
        }
    }, '#paypal-button-container');
</script>

</body>
</html>