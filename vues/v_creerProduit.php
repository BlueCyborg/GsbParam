<h1>Créer un produit</h1>
<form action="" method="POST">
    <label for="id">Nom du produit : </label>
    <input type="text" name="id" required><br>

    <label for="description">Description : </label>
    <input type="text" name="description" required><br>

    <label for="image">Image : </label>
    <input type="text" name="image" required><br>

    <label for="marque">Marque : </label>
    <select name="marque" id="marque">
        <?php
        foreach ($marques as $uneMarque) {
        ?>
            <option value="<?php echo $uneMarque['id'] ?>"><?php echo $uneMarque['libelle'] ?></option>
        <?php
        }
        ?>
    </select><br>

    <label for="categorie">Catégorie du produit : </label>
    <select name="categorie" id="categorie">
        <?php
        foreach ($categories as $uneCategorie) {
        ?>
            <option value="<?php echo $uneCategorie['id'] ?>"><?php echo $uneCategorie['libelle'] ?></option>
        <?php
        }
        ?>
    </select><br>
    <p>Choisir une contenance : </p>
    <select name="lesContenances" id="lesContenances">
        <?php
        foreach ($contenances as $uneContenance) {
        ?>
            <option value="<?= $uneContenance['id'] ?>"><?= $uneContenance['contenance'] ?> <?= $uneContenance['libelle'] ?></option>
        <?php
        }
        ?>
    </select><br>
    <a href="index.php?uc=administrer&action=creerContenance">Créer une contenance</a><br>

    <label for="prix">Prix : </label>
    <input type="text" name="prix" required><br>
    <input type="submit" name="submit" value="Créer">
</form>