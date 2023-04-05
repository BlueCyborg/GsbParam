<?php
$action = $_REQUEST['action'];
//Si l'utilisateur est bien administrateur
if (isset($_SESSION['administrateur'])) {
    switch ($action) {
        case 'voirCategories': {
                $lesCategories = getLesCategories();
                include("vues/v_categories.php");
                break;
            }
        case 'voirProduits': {
                $lesCategories = getLesCategories();
                include("vues/v_categories.php");
                $categorie = $_REQUEST['categorie'];
                for ($i = 0; $i < count($lesCategories); $i++) {
                    if ($lesCategories[$i]['id'] == $categorie) {
                        echo "Produits de la catégorie " . $lesCategories[$i]['libelle'];
                    }
                }
                $lesProduits = getLesProduitsDeCategorie($categorie);
                include("vues/v_produitsDeCategorie.php");
                break;
            }
        case 'nosProduits': {
                $lesProduits = getLesProduits();
                include("vues/v_produits.php");
                break;
            }
        case 'creerProduit': {
                //Si les valeurs sont envoyés alors on crée le produit
                if (isset($_POST['submit'])) {
                    creerProduit($_POST['id'], $_POST['description'], $_POST['prix'], $_POST['image'], $_POST['idCat']);
                    echo 'Le Produit à bien été crée !';
                }
                else {
                    include("vues/v_creerProduit.php");
                }
                break;
            }
        case 'modifier': {
                //Si des valeurs sont entrées afin de modifier le produit
                if (isset($_POST['submit'])) {
                    //Si l'administrateur à choisi de changer l'ID
                    if ($_POST['select_modifier'] == 'id') {
                        modifierIdProduit($_REQUEST['produit'], $_POST['value_modifier']);
                        echo "L'ID à été modifié !";
                    }
                    elseif ($_POST['select_modifier'] == 'description') {
                        modifierDescriptionProduit($_REQUEST['produit'], $_POST['value_modifier']);
                        echo "La description à été modifié !";
                    }
                    elseif ($_POST['select_modifier'] == 'prix') {
                        modifierPrixProduit($_REQUEST['produit'], $_POST['value_modifier']);
                        echo "Le prix à été modifié !";
                    }
                    elseif ($_POST['select_modifier'] == 'image') {
                        modifierImageProduit($_REQUEST['produit'], $_POST['value_modifier']);
                        echo "L'image à été modifié !";
                    }
                    elseif ($_POST['select_modifier'] == 'idCat') {
                        modifierIDCatProduit($_REQUEST['produit'], $_POST['value_modifier']);
                        echo "L'ID Categorie à été modifié !";
                    }
                }
                else {
                    $infoProd = getInfoProduit($_REQUEST['produit']);
                    include("vues/v_modifierProduit.php");
                }
                break;
            }
        case 'supprimer': {
                supprimerProduit($_REQUEST['produit']);
                echo 'Le produit à bien été supprimé';
                break;
            }
        case 'deconnexion': {
                //On enleve la valeur du $_SESSION
                unset($_SESSION['administrateur']);
                $message = "Vous êtes déconnecté";
                include("vues/v_message.php");
                header('Location:index.php?uc=accueil');
                break;
            }
    }
}
else {
    switch ($action) {
        case 'connexion': {
                //Si l'administrateur à déjà rentré les valeurs
                if (isset($_REQUEST['username']) and isset($_REQUEST['password'])) {
                    $user = $_REQUEST['username'];
                    $password = $_REQUEST['password'];
                    $msgErreurs = getErreursSaisieConnexionAdministrateur($user, $password);
                    if (count($msgErreurs) != 0) {
                        //S'il y a des erreurs alors on les affiches
                        include("vues/v_erreurs.php");
                    }
                    else {
                        $connexion = connexionCompteAdministrateur($user, $password);
                        if (empty($connexion)) {
                            $msgErreurs[] = "Vous n'êtes pas inscrit.";
                            include("vues/v_erreurs.php");
                        }
                        else {
                            $message = "Vous êtes désormais connecté";
                            include_once("vues/v_message.php");
                            $_SESSION['administrateur'] = $user;
                        }
                    }
                }
                elseif (isset($_SESSION['administrateur']) and !empty($_SESSION['administrateur'])) {
                    $message = "Vous est déjà authentifié";
                    include("vues/v_message.php");
                }
                else {
                    include("vues/v_connexionAdministrateur.php");
                }
                break;
            }
        //Par défault l'on redirige l'utilisateur vers la page d'accueil pour cacher la page administrateur
        default: {
                header('Location:index.php?uc=accueil');
                exit();
                break;
            }
    }
}
