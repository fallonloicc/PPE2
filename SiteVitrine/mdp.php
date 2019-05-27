 <?php

                    if (isset($_POST['oldPasswd'], $_POST['newPasswd'], $_POST['verifPasswd']))
                    {
                        $req ='SELECT passwd FROM clients WHERE email ="'.$_SESSION["email"].'"';
                        $oui = $bdd->query($req);
                        $requete = $oui->fetch();
                        echo $requete;

                    }else
                    {
                        echo "Remplir les champs";
                        /*$req ='SELECT passwd FROM clients WHERE email ="'.$_SESSION["email"].'"';
                        $oui = $bdd->query($req);
                        $requete = $oui->fetch();
                        echo $requete;*/
                    }

                    $req ='SELECT passwd FROM clients WHERE email ="'.$_SESSION["email"].'"';
                    $oui = $bdd->query($req);

                ?>