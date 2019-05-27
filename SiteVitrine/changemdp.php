<?php
session_start();
include('header.php');
include('params/db.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Login V15</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util-index.css">
    <link rel="stylesheet" type="text/css" href="css/main-index.css">
    <!--===============================================================================================-->
</head>
<body>
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading-pages-02.jpg);">
    <h2 class="l-text2 t-center">
        Compte
    </h2>
</section>
<?php  ?>
<!-- content page -->
<section class="bgwhite p-t-66 p-b-38">
    <div class="container">
        <div class="row">
            <div class="col-md-8 p-b-30">
                <h3 class="m-text26 p-t-15 p-b-16">
                    Changement de mot de passe  :
                </h3>
                <?php         
                    if (isset($_POST['oldPasswd'], $_POST['newPasswd'], $_POST['verifPasswd']))
                    {
                        $oldPasswd = md5($_POST['oldPasswd']);
                        if ($_POST['newPasswd'] == $_POST['verifPasswd'])
                        {
                            $req ='SELECT passwd FROM clients WHERE email ="'.$_SESSION["email"].'"';
                                if ($recup = $bdd->query($req))
                                {
                                    if($usr = $recup->fetch())
                                    {                                  
                                        if($usr->passwd == $oldPasswd)
                                        {
                                            $passwd = md5($_POST['newPasswd']);
                                            $req = 'UPDATE clients SET passwd = "'. $passwd .'" WHERE email ="'.$_SESSION["email"].'" ';
                                            $recup = $bdd->query($req);
                                            echo "Mot de passe changé ";
                                        }else{
                                            echo "Mot de passe incorrect"; 
                                        }
                                    
                                    }else{
                                        echo "problème de requete a la base de données";

                                    }
                                }else{
                                    echo "problème de requete a la base de données";
                                }    

                        }else
                        {
                           echo "Mot de passe différent"; 
                        }

                    }else
                    {
                        
                    }
                ?>
               
                <form id="theform" name="formulaire" action="changeMdp.php" method="POST" class="login100-form validate-form">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Nom requis">
                        <span class="label-input100">Mot de passe actuel : </span>
                        <input class="input100" type="text" name="oldPasswd" placeholder="Saisir">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Nom requis">
                        <span class="label-input100">Nouveau mot de passe : </span>
                        <input class="input100" type="text" name="newPasswd" placeholder="Saisir">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Nom requis">
                        <span class="label-input100">Vérifiez le mot de passe : </span>
                        <input class="input100" type="text" name="verifPasswd" placeholder="Saisir">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="container-login100-form-btn">
                        <input class="login100-form-btn" type="submit" name="sub" value="Enregistrer modifications" >
                    </div>
                </form>

            </div>


        </div>
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
<script src="js/main.js"></script>
    <script type="text/javascript">
        function changeMdp(){
            if(document.getElementById('newPasswd').value=="" || document.getElementById('verifPasswd').value =="" || document.getElementById('oldPasswd').value =="" ){

            }else{
                if(document.getElementById('newPasswd').value != document.getElementById('verifPasswd').value){
                    alert("Mot de passe différent");
                    return false;
                }else
                {
                    return;
                }
            }
        $("#number").keypress(function() {
            if(this.value.length != 9) {
                this.value=[];
            };
        });
        }

    </script>
<!--===============================================================================================-->
<script src="js/main.js"></script>

</body>
</html>