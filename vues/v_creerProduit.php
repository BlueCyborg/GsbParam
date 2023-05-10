<form action="" method="POST">
    <label for="id">Nom du produit : </label>
    <input type="text" name="id"><br>

    <label for="description">Description : </label>
    <input type="text" name="description"><br>

    <label for="image">Image : </label>
    <input type="text" name="image"><br>

    <label for="marque">Marque : </label>
    <select name="marque" id="marque">
        <option hidden value="">Choisir une marque</option>
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
        <option hidden value="">Choisir une catégorie</option>
        <?php
        foreach ($categories as $uneCategorie) {
        ?>
            <option value="<?php echo $uneCategorie['id'] ?>"><?php echo $uneCategorie['libelle'] ?></option>
        <?php
        }
        ?>
    </select><br>

    <label for="prix">Prix : </label>
    <input type="number" value="0" name="prix"><br>

    <label for="stock">Stock : </label>
    <input type="number" value="0" name="stock"><br>

    <label for="unite">Unité : </label>
    <select name="unite" id="unite">
        <option hidden value="">Choisir une unité</option>
        <?php
        foreach ($unites as $uneUnite) {
        ?>
            <option value="<?php echo $uneUnite['id'] ?>"><?php echo $uneUnite['libelle'] ?></option>
        <?php
        }
        ?>
    </select><br>

    <label for="contenance">Contenance : </label>
    <input type="number" value="0" name="contenance"><br>

    <input type="submit" name="submit" value="Créer">
</form>