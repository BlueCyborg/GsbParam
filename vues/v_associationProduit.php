<form action="" method="post">
    <p>Associer des produits</p><br>
    <label for="produit1">Produit :</label>
    <select name="produit1" id="produit1" required>
        <option hidden value="">Choisir un produit</option>
        <?php
        foreach ($produits as $unProduit) {
        ?>
            <option value="<?php echo $unProduit['id'] ?>"><?php echo $unProduit['id'] ?></option>
        <?php
        }
        ?>
    </select><br>

    <p>associer à </p><br>

    <label for="produit2">Produit :</label>
    <select name="produit2" id="produit2" required>
        <option hidden value="">Choisir un produit</option>
        <?php
        foreach ($produits as $unProduit) {
        ?>
            <option value="<?php echo $unProduit['id'] ?>"><?php echo $unProduit['id'] ?></option>
        <?php
        }
        ?>
    </select><br>

    <input type="submit" name="submit" value="Associer">
</form>