<?php
$action = $_REQUEST['action'];
switch ($action) {
    case 'connexion': {
            //Si l'utilisateur à rentré les valeurs
            if (isset($_REQUEST['username']) and isset($_REQUEST['password'])) {
                $user = $_REQUEST['username'];
                $password = $_REQUEST['password'];
                $msgErreurs = getErreursSaisieConnexion($user, $password);
                if (count($msgErreurs) != 0) {
                    //S'il y a des erreurs alors on les affiches
                    include("vues/v_erreurs.php");
                } else {
                    $connexion = connexionCompte($user, $password);
                    if (empty($connexion)) {
                        $msgErreurs[] = "Vous n'êtes pas inscrit.";
                        include("vues/v_erreurs.php");
                    } else {
                        $message = "Vous êtes désormais connecté";
                        include_once("vues/v_message.php");
                        $_SESSION['user'] = $user;
                    }
                }
            } elseif (isset($_SESSION['user']) and !empty($_SESSION['user'])) {
                $message = "Vous est déjà authentifié";
                include("vues/v_message.php");
            } else {
                include("vues/v_connexion.php");
            }
            break;
        }
    case 'deconnexion': {
            //On enleve la valeur du $_SESSION
            unset($_SESSION['user']);
            $message = "Vous êtes déconnecté";
            include("vues/v_message.php");
            break;
        }
        break;
}
