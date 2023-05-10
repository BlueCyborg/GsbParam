<table border="1">
    <thead>
        <tr>Liste des associations :</tr>
    </thead>
    <tbody>
        <?php
        foreach ($associations as $uneAssociation) {

        ?>
            <tr>
                <td><?php echo $uneAssociation['id'] ?></td>
                <td><?php echo $uneAssociation['id_produit'] ?></td>
                <td><a href="index.php?uc=administrer&produit1=<?php echo $uneAssociation['id'] ?>&produit2=<?php echo $uneAssociation['id_produit'] ?>&action=modifierAssociation">Modifier</a></td>
            </tr>
        <?php

        }
        ?>
    </tbody>
</table>