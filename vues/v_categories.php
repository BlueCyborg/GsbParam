<ul id="categories">
	<?php
	foreach ($lesCategories as $uneCategorie) {
		$idCategorie = $uneCategorie['id'];
		$libCategorie = $uneCategorie['libelle'];
	?>
		<li>
			<?php
			if (isset($_SESSION['administrateur'])) { ?>
				<a href="index.php?uc=administrer&categorie=<?= $idCategorie ?>&action=voirProduits">
				<?php } else { ?>
					<a href="index.php?uc=voirProduits&categorie=<?= $idCategorie ?>&action=voirProduits">
					<?php } ?>
					<?= $uneCategorie['libelle'] ?></a>
		</li>
	<?php
	}
	?>
</ul>