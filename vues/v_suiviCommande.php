<form action="" method="POST">
    <p>Gestion des commandes :</p>
    <table border="1">
        <thead>
            <tr>
                <th>Numéro de Commande</th>
                <th>Client</th>
                <th>Date</th>
                <th>Etat</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $cpt = 0;
            foreach ($commandes as $uneCommande) {
                $cpt = $cpt + 1;
                if ($uneCommande['etat'] == "E") {
                    $etat = "En cours de livraison";
                } else {
                    if ($uneCommande['etat'] == "L") {
                        $etat = "Commande livrée";
                    } else {
                        $etat = "Remboursement de la commande";
                    }
                }
            ?>
                <tr>
                    <td><input type="number" value="<?= $uneCommande['id'] ?>" readonly></td>
                    <td><?php echo $uneCommande['nom'] ?> - <?php echo $uneCommande['prenom'] ?></td>
                    <td><?php echo $uneCommande['dateCommande'] ?></td>
                    <td>
                        <select name=" etat<?= $cpt ?>" id="etat">
                            <option hidden value="<?php echo $uneCommande['etat'] ?>"><?php echo $etat ?></option>
                            <option value="E">En cours de livraison</option>
                            <option value="L">Commande livrée</option>
                            <option value="R">Remboursement de la commande</option>
                        </select>
                    </td>
                    <td>

                    </td>

                </tr>

            <?php

            }
            ?>
        </tbody>
    </table>
    <input type="date" name="date1">
    <input type="date" name="date2"><br>
    <input type="submit" name="trier" value="Trier par période"><br>
    <input type="submit" name="modifier" value="Modifier"><br>
</form>