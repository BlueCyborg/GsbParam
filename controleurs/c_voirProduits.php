<?php
// contrôleur qui gère l'affichage des produits
initPanier(); // se charge de réserver un emplacement mémoire pour le panier si pas encore fait
$action = $_REQUEST['action'];
switch ($action) {
		//A REFLECHIR POUR LE SUPPRIMER
	case 'voirCategories': {
			$lesCategories = getLesCategories();
			include("vues/v_categories.php");
			break;
		}
	case 'voirProduits': {
			$lesCategories = getLesCategories();
			$categorie = $_REQUEST['categorie'];
			$lesProduits = getLesProduitsDeCategorie($categorie);
			include("vues/v_categories.php");
			include("vues/v_produitsDeCategorie.php");
			break;
		}
	case 'nosProduits': {
			if (isset($_POST['idMarque'])) {
				$lesProduits = getLesProduitsFiltre($_POST['prixMin'], $_POST['prixMax'], $_POST['idMarque']);
			} else {
				$lesProduits = getLesProduits();
			}
			$lesMarques = getLesMarques();
			include("vues/v_filtre_produits.php");
			include("vues/v_produits.php");
			break;
		}
	case 'infoProduit': {
			$idProduit = $_POST['idProduit'];
			$infoProduit = getInfoProduit($idProduit);
			include("vues/v_produit.php");
			break;
		}
	case 'ajouterAuPanier': {
			$idProduit = $_GET['produit'];
			$idContenance = $_POST['contenance']; // Ajout de la récupération de l'identifiant de contenance
			$quantite = $_POST['quantite'];
			$ok = ajouterAuPanier($idProduit, $idContenance, $quantite);
			if (!$ok) {
				$message = "Cet article est déjà dans le panier !!";
				include("vues/v_message.php");
			} else {
				// on recharge la même page ( NosProduits si pas categorie passée dans l'url')
				if (isset($_REQUEST['categorie'])) {
					$categorie = $_REQUEST['categorie'];
					header('Location:index.php?uc=voirProduits&action=voirProduits&categorie=' . $categorie);
				} else
					header('Location:index.php?uc=voirProduits&action=nosProduits');
			}
			break;
		}
}
