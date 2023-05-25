<?php
if (getLesInfosCategorie($_GET['categorie'])['libelle']) { ?>
	<h3 style="text-align: center;">
		<span style="color:green;">Produits de la catégorie :</span>
		<?= htmlspecialchars(getLesInfosCategorie($_GET['categorie'])['libelle']) ?>
	</h3> <?php
		} ?>
<br>
<div id="categories" style="border: 15px solid white; width: 20%;">
	<form method="POST">
		<h5>Filtre</h5>
		<hr width="75%" style="margin: auto;">
		<p>Catégories</p>

		<select class="form-select form-select-sm" name="categorie" onchange="this.form.action='index.php?uc=voirProduits&categorie=' + this.value + '&action=voirProduits'; this.form.submit()">
			<?php
			foreach ($lesCategories as $uneCategorie) {
				$idCategorie = $uneCategorie['id'];
				$libCategorie = $uneCategorie['libelle'];
				if ($_GET['categorie'] == $idCategorie) { ?>
					<option value="<?= $idCategorie ?>" selected><?= $libCategorie ?></option>
				<?php } else { ?>
					<option value="<?= $idCategorie ?>"><?= $libCategorie ?></option>
				<?php }
				if (isset($_SESSION['administrateur'])) { ?>
					<a href="index.php?uc=administrer&categorie=<?= $idCategorie ?>&action=voirProduits">
					<?php
				} else { ?>
						<a href="index.php?uc=voirProduits&categorie=<?= $idCategorie ?>&action=voirProduits">
						<?php } ?>
						<?= $uneCategorie['libelle'] ?></a>
						</option>
					<?php
				}
					?>
		</select>
	</form>
</div>