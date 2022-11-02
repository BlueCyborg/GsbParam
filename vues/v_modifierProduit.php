<p>ID du produit : <?= $infoProd[0]['id'] ?>
    <br><br>Description : <?= $infoProd[0]['description'] ?>
    <br><br>Prix : <?= $infoProd[0]['prix'] ?> €
    <br><br>Image : <?= $infoProd[0]['image'] ?>
    <br><br>ID Catégorie : <?= $infoProd[0]['idCategorie'] ?>
</p>
<p> Que souhaitez-vous modifier ?
    <br>
<form action="" method="POST">
    <select name="select_modifier" required>
        <option value="id" selected>ID</option>
        <option value="description">Description</option>
        <option value="prix">Prix</option>
        <option value="image">Image</option>
        <option value="idCat">ID Categorie</option>
    </select>
    <p>Par quoi souhaitez-vous le modifier : <input type="text" name="value_modifier" required></p>
    <input type="submit" name="submit" value="Modifier">
</form>
</p>