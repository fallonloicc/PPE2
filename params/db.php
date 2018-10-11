<?php
  try
  {
    $bdd = new PDO('mysql:host=localhost;dbname=ppe2', 'root', '');
    $bdd->setAttribute (PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    //echo "connexion validée";
  }
  catch(PDOException $e)
  {
    echo "impossible de se connecter";
    die();
  }
?>
