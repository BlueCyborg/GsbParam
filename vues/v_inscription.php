<?php include_once './modele/bd.inc.php'; ?>
<h1>Inscription</h1>
<form method="post" action="">
    <label><b>Nom</b></label>
    <input type="text" name="Nom">
    <br><br>

    <label><b>Prenom</b></label>
    <input type="text" name="Prenom">
    <br><br>

    <label><b>Telephone</b></label>
    <input type="text" name="Telephone">
    <br><br>

    <label><b>Adresse</b></label>
    <input type="text" name="Adresse">
    <br><br>

    <label><b>Code postal</b></label>
    <input type="text" name="Cp">
    <br><br>

    <label><b>Ville</b></label>
    <input type="text" name="Ville">
    <br><br>

    <label><b>Email</b></label>
    <input type="email" name="email">
    <br><br>

    <label><b>Password</b></label>
    <input type="password" name="password">
    <br><br>

    <label><b>Répétez votre mot de passe</b></label>
    <input type="password" name="repeatpassword">
    <br><br>
    <input type="submit" name="submit" value="Valider">
</form>

<?php

if (isset($_POST['submit'])) {

    $Nom = htmlspecialchars(trim($_POST['Nom']));
    $Prenom = htmlspecialchars(trim($_POST['Prenom']));
    $telephone = htmlspecialchars(trim($_POST['Telephone']));
    $adresse = htmlspecialchars(trim($_POST['Adresse']));
    $cp = htmlspecialchars(trim($_POST['Cp']));
    $ville = htmlspecialchars(trim($_POST['Ville']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $repeatpassword = htmlspecialchars(trim($_POST['repeatpassword']));

    if (isset($Nom) && isset($Prenom) && isset($telephone) && isset($cp) && isset($ville) && isset($email) && isset($password) && isset($repeatpassword)) {
        if (strlen($password) >= 6) {
            if ($password == $repeatpassword) {
                $password = md5($password);
                $monPdo = connexionPDO();
                $req = "INSERT INTO utilisateur VALUES ('" . $email . "', '" . $password . "', '" . $Nom . "', '" . $Prenom . "', '" . $adresse . "', '" . $cp . "', '" . $ville . "')";
                $res = $monPdo->prepare($req);
                $lesLignes = $res->fetchAll(PDO::FETCH_ASSOC);
                return $lesLignes;
            } else echo "Les mots de passe ne sont pas identiques";
        } else echo "Le mot de passe est trop court !";
    } else echo "Veuillez saisir tous les champs !";
}
?>