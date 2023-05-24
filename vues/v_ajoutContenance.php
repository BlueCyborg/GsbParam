<form action="" method="post">
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
    <a href="index.php?uc=administrer&action=creerContenance">créer une contenance</a><br>
    <label for="Stock">Stock :</label>
    <input name="stock" type="text" required><br>
    <label for="">Prix :</label>
    <input name="prix" type="text" required><br>
    <input type="submit" name="submit" value="Ajouter">
</form>