<html>
  <body>
  <h1>Ajouter Bornes</h1>
    <form action="params/insertborne.php" method="POST">
      <input type="text" placeholder="Prix" name="prix">
      <input type="text" placeholder="Libelle" name="libelle">
      <input type="text" placeholder="Adresse Mac" name="mac">
      <input type="text" placeholder="Adresse IP" name="ip">
      <button type="submit" class="btn btn-primary" id="sendMessageButton">Envoyez</button>
    </form>


  <h1>Ajouter Consommable</h1>
    <form action="params/insertconso.php" method="POST">
      <input type="text" placeholder="Libelle" name="libelle">
      <input type="text" placeholder="Stock" name="stock">
      <input type="text" placeholder="Description" name="descr">
      <input type="text" placeholder="Prix" name="prix">
      <button type="submit" class="btn btn-primary" id="sendMessageButton">Envoyez</button>
    </form>

    <h1>Ajouter / Retirer Stock</h1>
        <form action="params/stock.php" method="POST">
          <select name="choix">
            <?php
              include('params/db.php');
              $req ='SELECT * FROM consommables';
              $oui = $bdd->query($req);

              while($requete = $oui->fetch())
              {
                echo "<option value ='".$requete->idConsosommables."'>".$requete->libelle."</option>";
              }
             ?>
          </select>
          <input type="text" placeholder="Combien ?" name="nombre">
          <button type="submit" class="btn btn-primary" id="sendMessageButton">Envoyez</button>
        </form>

    </body>
  </html>
