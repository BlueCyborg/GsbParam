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
                }
                else {
                    $connexion = connexionCompte($user, $password);
                    if (empty($connexion)) {
                        $msgErreurs[] = "Vous n'êtes pas inscrit.";
                        include("vues/v_erreurs.php");
                    }
                    else {
                        $message = "Vous êtes désormais connecté";
                        include_once("vues/v_message.php");
                        $_SESSION['user'] = $user;
                    }
                }
            }
            elseif (isset($_SESSION['user']) and !empty($_SESSION['user'])) {
                $message = "Vous est déjà authentifié";
                include("vues/v_message.php");
            }
            else {
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
    case 'inscription': {
            if (isset($_REQUEST['nom']) && isset($_REQUEST['prenom']) && isset($_REQUEST['adresse']) && isset($_REQUEST['cp']) && isset($_REQUEST['ville']) && isset($_REQUEST['email']) && isset($_REQUEST['password']) && isset($_REQUEST['repeatpassword'])) {
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
                }
                else {
                    //Si l'utilisateur existe déjà alors on ne lui permet pas l'inscription
                    $exist = existeUtilisateur(htmlspecialchars($email));
                    if ($exist == 1) {
                        $msgErreurs[] = "L'email existe déjà.";
                        include("vues/v_erreurs.php");
                    }
                    else {
                        inscription($nom, $prenom, $telephone, $adresse, $cp, $ville, $email, $password);
                        echo 'Inscription réalisé avec succès.';
                    }
                }
            }
            else {
                //Si les aucunes informations n'est rentré dans le formulaire alors on le propose
                include("vues/v_inscription.php");
            }
            break;
        }
}
