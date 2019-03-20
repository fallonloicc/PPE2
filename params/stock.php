<?php
  include('db.php');

  $choix = $_POST['choix'];
  $nombre = $_POST['nombre'];

  $req ='SELECT stock FROM consommables WHERE idConsosommables LIKE '.$choix.'';
  $oui = $bdd->query($req);

  $non = $oui->fetch();
  $yep = $non->stock + $nombre;
  echo $yep;

 ?>
