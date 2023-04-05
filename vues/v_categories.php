<div id="categories">
	<h5>Filtre</h5>
	<hr width="75%" style="margin: auto;">
	<p>Catégories</p>
	<select class="form-select form-select-sm">
		<?php
		foreach ($lesCategories as $uneCategorie) {
			$idCategorie = $uneCategorie['id'];
			$libCategorie = $uneCategorie['libelle'];
		?>
			<option value="">
				<?php
				if (isset($_SESSION['administrateur'])) { ?>
					<a href="index.php?uc=administrer&categorie=<?= $idCategorie ?>&action=voirProduits">
					<?php } else { ?>
						<a href="index.php?uc=voirProduits&categorie=<?= $idCategorie ?>&action=voirProduits">
						<?php } ?>
						<?= $uneCategorie['libelle'] ?></a>
			</option>
		<?php
		}
		?>
	</select>
</div>