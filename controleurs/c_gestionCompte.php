<?php
var_dump($_SESSION);
$action = $_REQUEST['action'];
switch ($action) {
    case 'connexion': {
            //Si l'utilisateur est déjà authentifié
            if (isset($_REQUEST['username']) and isset($_REQUEST['password'])) {
                $user = $_REQUEST['username'];
                $pass = $_REQUEST['password'];
                $msgErreurs = getErreursSaisieConnexion($user, $pass);
                if (count($msgErreurs) != 0) {
                    //S'il y a des erreurs alors on les affiches
                    include("vues/v_erreurs.php");
                }else {
                    $connexion = connexionCompte($user, $pass);
                    if (empty($connexion)) {
                        $msgErreurs[] = "Vous n'êtes pas inscrit.";
                        include("vues/v_erreurs.php");
                    }else {
                        $_SESSION['user'] = $user;
                        $_SESSION['pass'] = $pass;
                    }
                }
            }
            if (isset($_SESSION['user']) AND !empty($_SESSION['user'])) {
                $message = "L'utilisateur est déjà authentifié";
                include("vues/v_message.php");
            } else {
                include("vues/v_connexion.php");
            }
            break;
        }
    case 'deconnexion': {
            # code...
            break;
        }
    case 'inscription': {
            //Si les informations sont entrées dans le formulaire
            if (isset($_REQUEST['nom']) and isset($_REQUEST['prenom']) and isset($_REQUEST['adresse']) and isset($_REQUEST['cp']) and isset($_REQUEST['ville']) and isset($_REQUEST['email']) and isset($_REQUEST['password']) and isset($_REQUEST['repeatpassword'])) {
                $nom = $_REQUEST['nom'];
                $prenom = $_REQUEST['prenom'];
                $telephone = $_REQUEST['telephone'];
                $adresse = $_REQUEST['adresse'];
                $cp = $_REQUEST['cp'];
                $ville = $_REQUEST['ville'];
                $email = $_REQUEST['email'];
                $password = $_REQUEST['password'];
                $repeatpassword = $_REQUEST['repeatpassword'];
                $msgErreurs = getErreursSaisieInscription($nom, $prenom, $telephone, $adresse, $cp, $ville, $email, $password, $repeatpassword);
                if (count($msgErreurs) != 0) {
                    //S'il y a des erreurs alors on les affiches
                    include("vues/v_erreurs.php");
                } else {
                    inscription($nom, $prenom, $telephone, $adresse, $cp, $ville, $email, $password);
                    echo 'Inscription réalisé avec succès.';
                }
            } else {
                //Si les aucunes informations n'est rentré dans le formulaire alors on le propose
                include("vues/v_inscription.php");
            }
            break;
        }
}
