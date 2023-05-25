<?php
$infoProduit = $infoProduit[0];
$id = $infoProduit['id'];
$marque = $infoProduit['marque'];
$categorie = $infoProduit['categorie'];
$description = $infoProduit['description'];;
$nom = $infoProduit['nom'];
$prix = $infoProduit['prix'];
$image = $infoProduit['image'];
$prix = number_format($prix, 2, '.', '');
$idContenance = $infoProduit['id_contenance'];
$contenance = $infoProduit['unite'] . ' ' . $infoProduit['contenance'];
$stock = $infoProduit['stock'];
?>
  <a class="btn btn-outline-success" onclick="history.go(-1)">Retour</a>
<div style="background-color: white; display: flex; align-items: center; justify-content: center; padding: inherit;">
    <div style="display: flex; align-items: center;">
        <img src="<?= $image ?>" alt="image" style="margin-right: 10px;">
        <div style="text-align: center;">
            <div style="color: green;">
                <br>
                <h4><?= $nom ?></h4>
            </div>
            <br>
            <strong>Produit de la marque <?= $marque ?> de la catégorie <?= $categorie ?></strong>
            <br><br>
            <U>Description :</U> <?= $description ?>
            <hr>
            <form method="POST" action="index.php?uc=voirProduits&produit=<?= $id ?>&action=ajouterAuPanier">
                <div style="display: flex; align-items: center; margin-left: 30%;">
                    <span style="margin-right: 10px;">Contenance :</span>
                    <select name="contenance" class="form-select" style="width: 20%;">
                        <option value="<?= $idContenance ?>"><?= $contenance ?></option>
                    </select>
                </div>
                <br>
                <div style="display: flex; align-items: center; margin-left: 30%;">
                    <?php
                    if ($stock >= 1) { ?>
                        <h5 style="margin-right: 10px; color: green;"><?= $prix ?>€</h5>
                        <p style="color: green;">En stock</p>
                        <p style="color: red;">&nbsp;(Plus que <?= $stock ?>)</p>
                    <?php } else { ?>
                        <h5 style="margin-right: 10px; color: green;"><?= $prix ?>€</h5>
                        <p style="color: red;">Rupture de stock</p>
                    <?php } ?>
                </div>
                <?php if ($stock >= 1) { ?>
                    <div style="display: flex; align-items: center; margin-left: 30%;">
                        <span style="margin-right: 10px;">Quantitée : </span>
                        <select name="quantite" class="form-select" style="width: 20%;">
                            <?php
                            for ($i = 1; $i <= $stock; $i++) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                        </select>
                    <?php } ?>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-outline-success" style="margin-left: -10%;";>Ajouter au panier</button>
            </form>
            <br>
        </div>
    </div>
</div>