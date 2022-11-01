<div>
	<img src="images/panier.gif" alt="Panier" title="panier" />
</div>

<form method="POST" action="index.php?uc=gererPanier&action=passerCommande" style="display: flex; row-gap: 2rem; align-items: center; flex-direction: column;">
	<div id="produits">
		<?php
		foreach ($lesProduitsDuPanier as $unProduit) {
			// récupération des données d'un produit
			$id = htmlspecialchars($unProduit['id']);
			$description = htmlspecialchars($unProduit['description']);
			$image = htmlspecialchars($unProduit['image']);
			$prix = htmlspecialchars($unProduit['prix']);
			// affichage
		?>

			<div class="card">

				<div class="photoCard">
					<img src="<?php echo $image ?>" alt="image descriptive" />
				</div>
				<div class="descrCard"><?php echo	$description; ?> </div>
				<div class="prixCard"><?php echo $prix . "€" ?></div>
				<div class="imgCard">
					<a href="index.php?uc=gererPanier&produit=<?php echo $id ?>&action=supprimerUnProduit" onclick="return confirm('Voulez-vous vraiment retirer cet article ?');">
						<img src="images/retirerpanier.png" TITLE="Retirer du panier" alt="retirer du panier">
					</a>
				</div>
				<br>
				<br>
				<br>
				<br>
				<p>Quantité
					<?php
					//Permet de restituer la quantitée du produit précédement choisie par l'utilisateur
					$value = 1;
					if (isset($_SESSION['qte'])) {
						$value = $_SESSION['qte'][$id];
					} ?>
					<input type="number" name="qte[<?= $id ?>]" min="1" max="100" value="<?= $value ?>" required />
				</p>
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