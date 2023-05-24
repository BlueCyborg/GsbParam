<p>Modifier un stock :</p>
<form action="" method="POST">
    <select name="produitStock" id="produitStock">
        <?php
        foreach ($lesProduits as $unProduit) {
        ?>
            <option value="<?= $unProduit['id'] ?>"><?php echo $unProduit['id'] . ' - ' . $unProduit['description'] ?></option>
        <?php
        }
        ?>
    </select>
    <input type="submit" value="modifier le stock" name="modifStock">
</form>