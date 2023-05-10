<p>Editer un produit</p>
<form action="" method="post">
    <label for="id">Nom du produit : </label>
    <input type="text" name="id" value="<?php echo $infoProd['id'] ?>"><br>

    <img src="<?= $infoProd['image'] ?>" alt=image /><br>

    <label for="description">Description : </label>
    <input type="text" name="description" value="<?php echo $infoProd['description'] ?>"><br>

    <?php
    if (isset($infoProd['marque'])) {
    ?>
        <label for="marque">Marque : </label>
        <select name="marque" id="marque">
            <option hidden value="<?php echo $infoProd['id_marque'] ?>"><?php echo $infoProd['marque'] ?></option>
            <?php
            foreach ($marques as $uneMarque) {
            ?>
                <option value="<?php echo $uneMarque['id'] ?>"><?php echo $uneMarque['libelle'] ?></option>
            <?php
            }
            ?>
        </select><br>
    <?php
    }
    ?>

    <?php
    if (isset($infoProd['categ'])) {
    ?>
        <label for="categorie">Catégorie du produit : </label>
        <select name="categorie" id="categorie">
            <option hidden value="<?php echo $infoProd['idCategorie'] ?>"><?php echo $infoProd['categ'] ?></option>
            <?php
            foreach ($categories as $uneCategorie) {
            ?>
                <option value="<?php echo $uneCategorie['id'] ?>"><?php echo $uneCategorie['libelle'] ?></option>
            <?php
            }
            ?>
        </select><br>
    <?php
    }
    ?>

    <?php
    if (isset($infoProd['prix'])) {
    ?>
        <label for="prix">Prix : </label>
        <input type="number" value="<?php echo $infoProd['prix'] ?>" name="prix"><br>
    <?php
    }
    ?>

    <?php
    if (isset($infoProd['stock'])) {
    ?>
        <label for="stock">Stock : </label>
        <input type="number" value="<?php echo $infoProd['stock'] ?>" name="stock"><br>
    <?php
    }
    ?>

    <?php
    if (isset($infoProd['unite'])) {
    ?>
        <label for="unite">Unité : </label>
        <select name="unite" id="unite">
            <option hidden value="<?php echo $infoProd['id_unite'] ?>"><?php echo $infoProd['unite'] ?></option>
            <?php
            foreach ($unites as $uneUnite) {
            ?>
                <option value="<?php echo $uneUnite['id'] ?>"><?php echo $uneUnite['libelle'] ?></option>
            <?php
            }
            ?>
        </select><br>
    <?php
    }
    ?>

    <?php
    if (isset($infoProd['contenance'])) {
    ?>
        <label for="contenance">Contenance : </label>
        <input type="number" value="<?php echo $infoProd['contenance'] ?>" name="contenance"><br>
    <?php
    }
    ?>
    <input type="submit" name="submit" value="Modifier">
</form>