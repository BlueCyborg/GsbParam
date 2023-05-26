 <?php
    foreach ($lesStockProd as $unStockProd) {
    ?>
    <h1>Modifier un stock</h1>

     <form action="index.php?uc=administrer&action=modifierStock" method="post">
         <label for="">Identifiant</label>
         <input name="idprod" type="text" value="<?= $unStockProd['id_produit'] ?>" readonly><br>
         <label for="">Libelle</label>
         <input name="libelle" type="text" value="<?= $unStockProd['libelle'] ?>" readonly><br>
         <label for="">Contenance</label>
         <input name="idContenance" type="hidden" value="<?= $unStockProd['id_contenance'] ?>">
         <input name="contenance" type="text" value="<?= $unStockProd['contenance'] ?>" readonly><br>
         <label for="">Stock</label>
         <input name="stock" type="text" value="<?= $unStockProd['stock'] ?>"><br>

         <input type="submit" value="modifier" name="modifier"><br>
     </form>
 <?php
    }
