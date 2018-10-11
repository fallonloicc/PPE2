<?php
  include('db.php');

  if (isset($_POST['libelle'], $_POST['stock'], $_POST['descr'], $_POST['prix']))
  {
    $libelle = $_POST['libelle'];
    $stock = $_POST['stock'];
    $descr = $_POST['description'];
    $prix = $_POST['prix'];
    $requete = 'INSERT INTO `consommables` ( `libelle`, `stock`, `description`, `prix`) VALUES ( "'.$libelle.'" , "'.$stock.'", "'.$description.'", "'.$prix.'")';

    $bdd->query($requete);
  }

?>

<script>
					setTimeout(function()
					{
					document.location.href="index.php";
					},1250);
</script>
