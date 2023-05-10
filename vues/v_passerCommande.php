<form action="" method='POST'>
    <table border="1">
        <thead>
            <tr>
                <th>Commande</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            for ($i = 1; $i <= $n; $i++) {


                $total = $total + ($_POST['qte' . $i] * $_POST['prix' . $i]);
            ?>
                <input type="text" value="<?php echo $_POST['qte' . $i] ?>" name="qte<?php echo $i ?>" hidden>
                <input type="text" value="<?php echo $_POST['id' . $i] ?>" name="id<?php echo $i ?>" hidden>
                <input type="text" value="<?php echo $_POST['contenance' . $i] ?>" name="contenance<?php echo $i ?>" hidden>
                <tr>
                    <td><?php echo $_POST['qte' . $i] ?> x <?php echo $_POST['dsc' . $i] ?> (<?php echo $_POST['id' . $i] ?>)</td>
                    <td><?php echo ($_POST['qte' . $i] * $_POST['prix' . $i]) ?> €</td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <th>Total</th>
                <td><?php echo $total ?> €</td>
            </tr>
        </tbody>
    </table>
    <div>
        <input type="submit" name="retour" value="Retour">
        <input type="submit" name="commander" value="Commander">
    </div>

</form>