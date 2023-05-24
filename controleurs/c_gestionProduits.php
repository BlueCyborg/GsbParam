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
                    if (!existeProduit($_POST['id'])) {
                        creerProduit(
                            $_POST['id'],
                            $_POST['description'],
                            $_POST['image'],
                            $_POST['categorie'],
                            $_POST['marque'],
                            $_POST['lesContenances'],
                            $_POST['prix']
                        );

                        echo 'Le Produit à bien été crée !';
                    }
                    else {
                        echo 'Le produit existe déjà !';
                    }
                }
                else {
                    $contenances = getContenances();
                    $categories = getLesCategories();
                    $marques = getLesMarques();
                    $unites = getLesUnites();
                    include("vues/v_creerProduit.php");
                }
                break;
            }

        case 'creerContenance': {

                if (isset($_POST['creer'])) {
                    var_dump($_POST['laContenance']);
                    var_dump($_POST['unite']);
                    if (!existeContenance($_POST['laContenance'], $_POST['unite'])) {
                        creerContenance($_POST['laContenance'], $_POST['unite']);
                    }
                    else {
                        echo 'Cette contenance exite déjà !';
                    }
                }
                else {
                    $unites = getLesUnites();
                    include("vues/v_creerContenance.php");
                }

                break;
            }

        case 'modifierContenance': {

                if (isset($_POST['modifier'])) {
                    var_dump($_POST['contenance'], $_POST['id_contenance'], $_POST['stock'], $_POST['prix'], $_POST['idProd']);
                    updateStock($_POST['idProd'], $_POST['id_contenance'], $_POST['stock']);
                    updatePrix($_POST['idProd'], $_POST['id_contenance'], $_POST['prix']);
                }
                else {
                    supprimerPosseder($_POST['idProd'], $_POST['id_contenance']);
                }

                break;
            }
        case 'modifier': {
                //Si des valeurs sont entrées afin de modifier le produit
                if (isset($_POST['submit'])) {
                    //Si l'administrateur à choisi de changer l'ID
                    editerProduit(
                        $_POST['id'],
                        $_POST['description'],
                        $_POST['marque'],
                        $_POST['categorie'],
                    );
                    echo 'Le Produit à bien été modifié !';
                }
                else {
                    $contenances = getContenances();
                    $contenancesProd = getContenancesProd($_REQUEST['produit']);
                    //var_dump($contenancesProd);
                    $categories = getLesCategories();
                    $marques = getLesMarques();
                    $unites = getLesUnites();
                    $infoProd = getInfoProduit($_REQUEST['produit']);
                    //var_dump($infoProd);
                    include("vues/v_modifierProduit.php");
                    include("vues/v_contenancesProd.php");
                }
                break;
            }
        case 'associerProduit': {

                if (isset($_POST['submit']) && $_POST['produit1'] !== $_POST['produit2']) {
                    if (!existeAssociation($_POST['produit1'], $_POST['produit2'])) {
                        associerProduit($_POST['produit1'], $_POST['produit2']);
                        echo 'Vous avez associer deux produits !';
                    }
                    else {
                        echo 'Il y a déja une association entre ces deux produits !';
                    }
                }
                else {
                    if (isset($_POST['produit1']) && isset($_POST['produit2'])) {
                        if ($_POST['produit1'] == $_POST['produit2']) {
                            echo 'Deux mêmes produits !';
                        }
                    }
                    $produits = getLesProduits();
                    $associations = getAssociations();
                    include("vues/v_associationProduit.php");
                    include("vues/v_tabAssociationProd.php");
                }


                break;
            }

        case 'ajoutContenance': {
                if (isset($_POST['submit'])) {
                    var_dump($_REQUEST['produit']);
                    var_dump($_REQUEST['lesContenances']);
                    var_dump($_REQUEST['stock']);
                    var_dump($_REQUEST['prix']);
                    ajouterPosseder($_REQUEST['lesContenances'], $_REQUEST['produit'], $_REQUEST['stock'], $_REQUEST['prix']);
                }
                else {
                    $contenances = getContenances();
                    include("vues/v_ajoutContenance.php");
                }

                break;
            }

        case 'modifierAssociation': {

                if (isset($_POST['modifier']) || isset($_POST['supprimer'])) {
                    if (isset($_POST['modifier'])) {
                        if (($_GET['produit1'] == $_POST['produit1'] || $_GET['produit1'] == $_POST['produit2']) &&
                        ($_GET['produit2'] == $_POST['produit1'] || $_GET['produit2'] == $_POST['produit2'])
                        ) {
                            echo 'Modification impossible !';
                        }
                        else {
                            if (!existeAssociation($_POST['produit1'], $_POST['produit2'])) {
                                if ($_POST['produit1'] !== $_POST['produit2']) {
                                    modificationAssociation($_GET['produit1'], $_GET['produit2'], $_POST['produit1'], $_POST['produit2']);
                                    echo 'Vous avez modifier cette association !';
                                }
                                else {
                                    echo 'Deux mêmes produits !';
                                }
                            }
                            else {
                                echo 'Il y a déja une association entre ces deux produits !';
                            }
                        }
                    }
                    if (isset($_POST['supprimer'])) {
                        supprimerAssociation($_GET['produit1'], $_GET['produit2']);
                        echo 'Vous avez supprimer cette association !';
                    }
                }
                else {
                    $produits = getLesProduits();
                    include("vues/v_modifAssociation.php");
                }

                break;
            }

        case 'gestionStock': {

                if (isset($_POST['modifStock'])) {
                    $lesStockProd = getStockProd($_POST['produitStock']);
                    include("vues/v_modifStock.php");
                }
                else {
                    $lesProduits = getLesProduits();
                    include("vues/v_produitStock.php");
                }

                break;
            }
        case 'modifierStock': {

                //var_dump($_POST['idprod']);
                //var_dump($_POST['idContenance']);
                //var_dump($_POST['contenance']);
                //var_dump($_POST['libelle']);
                //var_dump($_POST['stock']);

                updateStock($_POST['idprod'], $_POST['idContenance'], $_POST['stock']);

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
