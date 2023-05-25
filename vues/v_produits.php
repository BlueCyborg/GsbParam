<div id="produits">

	<?php
	// parcours du tableau contenant les produits à afficher
	foreach ($lesProduits as $unProduit) { 	// récupération des informations du produit
		$id = $unProduit['id'];
		$marque = $unProduit['marque'];
		$nom = $unProduit['nom'];
		$prix = $unProduit['prix'];
		$stock = $unProduit['en_stock'];
		if ($stock == true) {
			$stock = 'En Stock';
		} else {
			$stock = 'Indisponible';
		}
		$image = $unProduit['image'];
		$prix = number_format($prix, 2, '.', '');
		// affichage d'un produit avec ses informations
	?>
		<div class="card">
			<form action="index.php?uc=voirProduits&action=infoProduit" method="post">
				<div><?= $marque ?></div>
				<div class="photoCard"><img src="<?= $image ?>" alt="image" /></div>
				<div class="nomCard"><?= $nom ?></div>
				<div class="imgCard">
					<?php
					if (isset($_SESSION['administrateur'])) { ?>
						<a href="index.php?uc=administrer&produit=<?= $id ?>&action=modifier">
							<img src="images/modifier.png" width="40" title="Modifier" alt="Modifier">
						</a>
						<a style="text-decoration: none;" href="index.php?uc=administrer&produit=<?= $id ?>&action=supprimer" onclick="return confirm('Voulez-vous vraiment supprimer le produit ?');">
							<button type="button">Supprimer</button>
						</a>
					<?php } ?>
				</div>
				<div class="horizontal-container">
					<div><?= 'A partir de ' .$prix . "€" ?></div>
					<div style="margin: auto;"><?= $stock ?></div>
					<input type="hidden" name="idProduit" value="<?= $id ?>">
					<button type="submit" class="btn btn-success">Voir</button>
				</div>
			</form>
		</div>
	<?php
	} // fin du foreach qui parcourt les produits
	?>
</div>