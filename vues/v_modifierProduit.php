<p>Editer un produit</p>
<form action="" method="post">
    <?php
    if (isset($infoProd['id'])) {
    ?>
        <label for="id">Nom du produit : </label>
        <input type="text" name="id" value="<?php echo $infoProd['id'] ?>" readonly=""><br>
    <?php
    }
    ?>

    <?php
    if (isset($infoProd['image'])) {
    ?>
        <img src="<?= $infoProd['image'] ?>" alt=image /><br>
    <?php
    }
    ?>

    <?php
    if (isset($infoProd['image'])) {
    ?>
        <label for="description">Description : </label>
        <input type="text" name="description" value="<?php echo $infoProd['description'] ?>"><br>
    <?php
    }
    ?>

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
        <input type="submit" name="submit" value="Modifier">
    <?php
    }
    ?>

</form>