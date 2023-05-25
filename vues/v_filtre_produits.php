<h3 style="text-align: center;">
    <span style="color:green;">Tous les produits</span>
</h3>
<br>
<div id="categories" style="border: 15px solid white; width: 25%;">
    <form method="POST">
        <h5>Filtre</h5>
        <hr width="75%" style="margin: auto;">
        <p>Prix</p>

        <div class="input-group input-group-sm mb-3">
            <input type="number" placeholder="Minimum" value="0" min="0" name="prixMin" style="width: 35%;">
            <span class="input-group-text" id="inputGroup-sizing-sm">€</span>
            <span class="input-group-addon">&ensp;</span>
            <input type="number" placeholder="Maximum" value="100" min="1" name="prixMax" style="width: 35%;">
            <span class="input-group-text" id="inputGroup-sizing-sm">€</span>
        </div>


        <hr width="75%" style="margin: auto;">
        <p>Marque</p>

        <select class="form-select form-select-sm" name="idMarque" style="text-align: center;">
            <option value="0" disabled>- Choissiez une marque -</option>
            <?php foreach ($lesMarques as $uneMarque) {
                $idMarque = $uneMarque['id'];
                $libMarque = $uneMarque['libelle'];
                if ($_POST['idMarque'] == $idMarque) { ?>
                    <option value="<?= $idMarque ?>" selected><?= $libMarque ?></option>
                <?php } else { ?>
                    <option value="<?= $idMarque ?>"><?= $libMarque ?></option>
            <?php  }
            } ?>
        </select>
        <br>
        <button type="submit" class="btn btn-success">Filtrer</button>
    </form>
</div>