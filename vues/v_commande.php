<div id="creationCommande">
   <form method="POST" action="index.php?uc=gererPanier&action=confirmerCommande">
      <fieldset>
         <legend>Commande</legend>
         <p>Nom Prénom <?= ': ' . $nom ?></p>
         <p>Rue <?= ': ' . $rue ?></p>
         <p>Code postal <?= ': ' . $cp ?></p>
         <p>Ville <?= ': ' . $ville ?></p>
         <p>Mail <?= ': ' . $mail ?></p>
         <p>Produits*<br>
            <?php
            foreach ($_SESSION['produits'] as $unProduit) {
               
            }
            ?>
            <img src="images/laino-shampooing-douche-au-the-vert-bio-200ml.png" width="75">
         </p>
         <p>
            <input type="submit" value="Valider" name="valider">
            <input type="reset" value="Annuler" name="annuler">
         </p>
      </fieldset>
   </form>
</div>