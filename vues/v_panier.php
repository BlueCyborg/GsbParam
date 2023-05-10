<div>
	<img src="images/panier.gif" alt="Panier" title="panier" />
</div>

<form method="POST" action="index.php?uc=gererPanier&action=passerCommande" style="display: flex; row-gap: 2rem; align-items: center; flex-direction: column;">
	<div id="produits">
		<?php
		$cpt = 0;
		foreach ($lesProduitsDuPanier as $unProduit) {
			// récupération des données d'un produit

			$id = htmlspecialchars($unProduit['id']);
			$description = htmlspecialchars($unProduit['description']);
			$image = htmlspecialchars($unProduit['image']);
			$prix = htmlspecialchars($unProduit['prix']);
			$id_contenance = $unProduit['id_contenance'];
			$contenance = $unProduit['contenance'];
			$unite = $unProduit['UNITE'];
			$cpt = $cpt + 1;
			// affichage
		?>

			<div class="card">

				<div class="photoCard">
					<img src="<?php echo $image ?>" alt="image descriptive" />
				</div>
				<div class="descrCard"><?php echo	$description; ?> </div>
				<div class="prixCard"><?php echo $prix . "€" ?></div>
				<div><?php echo $contenance ?> <?php echo $unite ?></div>
				<input type="number" name="prix<?php echo $cpt ?>" value="<?php echo $prix ?>" hidden>
				<input type="text" name="dsc<?php echo $cpt ?>" value="<?php echo $description ?>" hidden>
				<input type="text" name="id<?php echo $cpt ?>" value="<?php echo $id ?>" hidden>
				<input type="number" name="contenance<?php echo $cpt ?>" value="<?php echo $id_contenance ?>" hidden>
				<input type="number" name="qte<?php echo $cpt ?>" id="qte" value="1" min="1">
				<div class="imgCard">
					<a href="index.php?uc=gererPanier&produit=<?php echo $id ?>&action=supprimerUnProduit" onclick="return confirm('Voulez-vous vraiment retirer cet article ?');">
						<img src="images/retirerpanier.png" TITLE="Retirer du panier" alt="retirer du panier">
					</a>
				</div>
				<br>
				<br>
				<br>
				<br>
				<!--<p>Quantité
					<?php
					//Permet de restituer la quantitée du produit précédement choisie par l'utilisateur
					$value = 1;
					if (isset($_SESSION['qte'])) {
						$value = $_SESSION['qte'][$id];
					} ?>
					<input type="number" name="qte[<?= $id ?>]" min="1" max="100" value="<?= $value ?>" required />
				</p>-->
			</div>
		<?php
		}
		?>
	</div>
	<div>
		<a style="text-decoration: none;" href="index.php?uc=gererPanier&action=viderPanier" onclick="return confirm('Voulez-vous vraiment vider le panier ?');">
			<button type="button">Vider panier</button>
		</a>
		&nbsp;
		<button type="submit">Passer commande</button>
	</div>
</form>