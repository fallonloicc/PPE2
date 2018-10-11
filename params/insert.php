<?php
  include('db.php');

  if (isset($_POST['prix'], $_POST['libelle'], $_POST['mac'], $_POST['ip']))
  {
    $prix = $_POST['prix'];
    $libelle = $_POST['libelle'];
    $mac = $_POST['mac'];
    $ip = $_POST['ip'];
    $requete = 'INSERT INTO `bornes` ( `prix`, `libelle`, `adresseMac`, `adresseIP`) VALUES ( "'.$prix.'" , "'.libelle.'", "'.$mac.'", "'.$ip.'")';
  }

?>
<h1>Ajouter Bornes</h1>
<form action="" method="POST">
  <input type="text" placeholder="Prix" name="prix">
  <input type="text" placeholder="Libelle" name="libelle">
  <input type="text" placeholder="Adresse Mac" name="mac">
  <input type="text" placeholder="Adresse IP" name="ip">
  <button type="submit" class="btn btn-primary" id="sendMessageButton">Envoyez</button>
</form>
