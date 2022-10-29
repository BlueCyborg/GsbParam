<div id="creationCommande">
   <form method="POST" action="index.php?uc=gererPanier&action=confirmerCommande">
      <fieldset>
         <legend>Commande</legend>
         <p><strong>Nom Prénom</strong><?= ': ' . $nom ?></p>
         <p><strong>Rue</strong><?= ': ' . $rue ?></p>
         <p><strong>Code postal</strong><?= ': ' . $cp ?></p>
         <p><strong>Ville</strong><?= ': ' . $ville ?></p>
         <p><strong>Mail</strong><?= ': ' . $mail ?></p>
         <p><strong>Produits</strong>: <br>
         <div style="display: flex; flex-direction: row;">
            <?php
            $total = 0;
            foreach ($_SESSION['produits'] as $unProduit) {
               $info = getInfoProduit($unProduit);
               $quantite = $_REQUEST['qte'][$info[0]['id']];
               $total += $quantite * $info[0]['prix'];
            ?>
               <img src="<?= $info[0]['image'] ?>" alt="<?= $info[0]['description'] ?>" width="100">
               <div style="flex-direction: columns;">
                  <p>Nom : <?= $info[0]['description'] ?></p>
                  <p>Qte:
                     <?= $quantite ?>
                  </p>
                  <p>Prix: <?= $quantite . " x " . $info[0]['prix'] . " = " . $quantite * $info[0]['prix'] ?></p>
               </div>
            <?php } ?>
         </div>
         </p>
         <p><strong>Total:</strong> <?= $total ?> €</p>
         <p>
            <input type="submit" value="Valider" name="valider">
            <input type="reset" value="Annuler" name="annuler">
         </p>
      </fieldset>
   </form>
</div>