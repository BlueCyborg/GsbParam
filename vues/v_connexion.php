<form action="" method="POST">
    <br>
    <h1>Connexion</h1>
    <br>
    <label><b>Nom d'utilisateur</b></label>
    <br>
    <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
    <br>
    <label><b>Mot de passe</b></label>
    <br>
    <input type="password" placeholder="Entrer le mot de passe" name="password" required>
    <br><br>
    <input type="submit" id='submit' value='LOGIN'>
    <?php
    if (isset($_GET['erreur'])) {
        $err = $_GET['erreur'];
        if ($err == 1 || $err == 2)
            echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
    }
    ?>
</form>