<h1>Créer une nouvelle contenance : </h1>
<form action="" method="post">
    <label for="">Contenance :</label>
    <input type="text" name="laContenance"><br>
    <label for="">Unite :</label>
    <select name="unite" id="unite">
        <?php
        foreach ($unites as $uneUnitee) {
        ?>
            <option value="<?= $uneUnitee['id'] ?>"><?= $uneUnitee['libelle'] ?></option>
        <?php

        }
        ?>
    </select><br>
    <input type="submit" name="creer" value="Creer">
</form>