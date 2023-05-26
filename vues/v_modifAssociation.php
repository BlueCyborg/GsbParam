<h1>Editer cette association</h1>
<form action="" method="post">
    <label for="produit1">Produit :</label>
    <select name="produit1" id="produit1" required>
        <option hidden value="<?php echo $_GET['produit1'] ?>"><?php echo $_GET['produit1'] ?></option>
        <?php
        foreach ($produits as $unProduit) {
        ?>
            <option value="<?php echo $unProduit['id'] ?>"><?php echo $unProduit['id'] ?></option>
        <?php
        }
        ?>
    </select><br>

    <label for="produit2">Produit :</label>
    <select name="produit2" id="produit2" required>
        <option hidden value="<?php echo $_GET['produit2'] ?>"><?php echo $_GET['produit2'] ?></option>
        <?php
        foreach ($produits as $unProduit) {
        ?>
            <option value="<?php echo $unProduit['id'] ?>"><?php echo $unProduit['id'] ?></option>
        <?php
        }
        ?>
    </select><br>

    </label>
    <input type="submit" name="modifier" id="modifier" value="Modifier">
    <input type="submit" name="supprimer" id="supprimer" value="Supprimer">
</form>