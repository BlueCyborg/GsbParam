<div style="text-align: center;">
	<img src="images/panier.gif" alt="Panier" title="panier" />
</div>

<form method="POST" action="index.php?uc=gererPanier&action=passerCommande" style="display: flex; row-gap: 2rem; align-items: center; flex-direction: column;">
	<div id="produits">
		<?php
		foreach ($lesProduits as $unProduit) {
			// récupération des données d'un produit
			$idProduit = htmlspecialchars($unProduit['idProduit']);
			$idContenance = htmlspecialchars($unProduit['idContenance']);
			$marque = htmlspecialchars($unProduit['marque']);
			$nom = htmlspecialchars($unProduit['nom']);
			$image = htmlspecialchars($unProduit['image']);
			$prix = htmlspecialchars($unProduit['prix']);
			$stock = htmlspecialchars($unProduit['stock']);
			$quantite = getQuantiteProduit($idProduit, $idContenance);
			// affichage
		?>
			<div class="card" style="width: auto;">
				<div><?= $marque ?></div>
				<div class="photoCard"><img src="<?= $image ?>" alt="image" /></div>
				<div class="nomCard"><?= $nom ?></div>
				<br>
				<div>Prix unitaire : <?= $prix . "€" ?></div>
				<div class="imgCard">
					<a href="index.php?uc=gererPanier&produit=<?= $idProduit ?>&action=supprimerUnProduit" onclick="return confirm('Voulez-vous vraiment retirer cet article ?');">
						<img src="images/retirerpanier.png" TITLE="Retirer du panier" alt="retirer du panier">
					</a>
				</div>
				<br>
				<p>Quantité
					<input type="number" name="quantite" min="1" max="<?= $stock ?>" value="<?= $quantite ?>" required />
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