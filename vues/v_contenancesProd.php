<?php
foreach ($contenancesProd as $uneContenancesProd) {
?>
    <form action="index.php?uc=administrer&produit=c01&action=modifierContenance" method="post">
        <input name="idProd" type="hidden" value="<?= $_REQUEST['produit'] ?>">
        <input name="id_contenance" type="hidden" value="<?= $uneContenancesProd['id_contenance'] ?>">
        <label for="Contenance">Contenance :</label>
        <input name="contenance" type="text" value="<?= $uneContenancesProd['contenance'] ?> <?= $uneContenancesProd['libelle'] ?>" readonly><br>
        <label for="Stock">Stock :</label>
        <input name="stock" type="text" value="<?= $uneContenancesProd['stock'] ?>"><br>
        <label for="">Prix :</label>
        <input name="prix" type="text" value="<?= $uneContenancesProd['prix'] ?>"><br>
        <input type="submit" value="Modifier cette contenance" name="modifier">
        <input type="submit" value="Supprimer cette contenance" name="supprimer"><br>
        <a href="index.php?uc=administrer&produit=<?= $_REQUEST['produit'] ?>&action=ajoutContenance">Ajouter une contenance à ce produit</a>
    </form>
<?php
}
