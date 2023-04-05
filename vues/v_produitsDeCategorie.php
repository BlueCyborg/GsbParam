<?php
if (getLesInfosCategorie($_GET['categorie'])['libelle']) { //On vérifie si la catégorie existe
?> <h3><span style="color:green;">Produits de la catégorie :</span>
		<?php echo htmlspecialchars(getLesInfosCategorie($_GET['categorie'])['libelle']) ?> </h3>
<?php }
?>
<div id="produits">

	<?php
	// parcours du tableau contenant les produits à afficher
	foreach ($lesProduits as $unProduit) { 	// récupération des informations du produit
		$id = $unProduit['id'];
		$description = $unProduit['description'];
		//$prix = $unProduit['prix'];
		$image = $unProduit['image'];
		// affichage d'un produit avec ses informations
	?>
		<div class="card">
			<div class="photoCard"><img src="<?= $image ?>" alt=image /></div>
			<div class="descrCard"><?= $description ?></div>
			<div class="prixCard"><!--<?= $prix . "€" ?>--></div>
			<div class="imgCard">
				<?php
				if (isset($_SESSION['administrateur'])) { ?>
					<a href="index.php?uc=administrer&produit=<?= $id ?>&action=modifier">
						<img src="images/modifier.png" width="40" TITLE="Modifier" alt="Modifier">
					</a>
					<a style="text-decoration: none;" href="index.php?uc=administrer&produit=<?= $id ?>&action=supprimer" onclick="return confirm('Voulez-vous vraiment supprimer le produit ?');">
						<button type="button">Supprimer</button>
					</a>
				<?php } else { ?>
					<a href="index.php?uc=voirProduits&produit=<?= $id ?>&action=ajouterAuPanier">
						<img src="images/mettrepanier.png" TITLE="Ajouter au panier" alt="Mettre au panier">
					</a>
				<?php } ?>
			</div>
		</div>
	<?php
	} // fin du foreach qui parcourt les produits
	?>
</div>