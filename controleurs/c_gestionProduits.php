<?php
$action = $_REQUEST['action'];
switch ($action) {
    case 'administrer': {
            # code...
            break;
        }
    case 'connexion': {
            //Si l'administrateur à déjà rentré les valeurs
            if (isset($_REQUEST['username']) and isset($_REQUEST['password'])) {
                $user = $_REQUEST['username'];
                $password = $_REQUEST['password'];
                $msgErreurs = getErreursSaisieConnexionAdministrateur($user, $password);
                if (count($msgErreurs) != 0) {
                    //S'il y a des erreurs alors on les affiches
                    include("vues/v_erreurs.php");
                } else {
                    $connexion = connexionCompteAdministrateur($user, $password);
                    if (empty($connexion)) {
                        $msgErreurs[] = "Vous n'êtes pas inscrit.";
                        include("vues/v_erreurs.php");
                    } else {
                        $message = "Vous êtes désormais connecté";
                        include_once("vues/v_message.php");
                        $_SESSION['administrateur'] = $user;
                    }
                }
            } elseif (isset($_SESSION['administrateur']) and !empty($_SESSION['administrateur'])) {
                $message = "Vous est déjà authentifié";
                include("vues/v_message.php");
            } else {
                include("vues/v_connexionAdministrateur.php");
            }
            break;
        }
    case 'deconnexion': {
            //On enleve la valeur du $_SESSION
            unset($_SESSION['administrateur']);
            $message = "Vous êtes déconnecté";
            include("vues/v_message.php");
            break;
        }
        //Par défault l'on redirige l'utilisateur vers la page d'accueil pour cacher la page administrateur
    default: {
            header('Location: index.php?uc=accueil');
            exit();
            break;
        }
}
