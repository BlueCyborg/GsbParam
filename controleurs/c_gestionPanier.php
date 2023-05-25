<?php
$action = $_REQUEST['action'];
switch ($action) {
	case 'voirPanier': {
			$n = nbProduitsDuPanier();
			if ($n > 0) {
				$lesProduitsDuPanier = getLesIdProduitsDuPanier();
				$lesProduits = getLesProduitsDuTableau($lesProduitsDuPanier);
				include("vues/v_panier.php");
			} else {
				$message = "panier vide !!";
				include("vues/v_message.php");
			}
			break;
		}
	case 'supprimerUnProduit': {
			if (nbProduitsDuPanier() > 0) {
				$idProduit = $_REQUEST['produit'];
				retirerDuPanier($idProduit);
				$desIdProduit = getLesIdProduitsDuPanier();
				$lesProduitsDuPanier = getLesProduitsDuTableau($desIdProduit);
				include("vues/v_panier.php");
				header('Location:index.php?uc=gererPanier&action=voirPanier');
			}else {
				header('Location:index.php?uc=gererPanier&action=voirPanier');
			}
			
			break;
		}
	case 'passerCommande': {
			if (isset($_SESSION['user'])) {
				$n = nbProduitsDuPanier();
				if ($n > 0) {
					// ici le formulaire doit être vide, quand il est erroné, le formulaire sera réaffiché pré-rempli
					$info = infoUtilisateur($_SESSION['user']);
					$nom = $info['nom'] . ' ' . $info['prenom'];
					$nom = htmlspecialchars($nom);
					$rue = $info['adresse'];
					$rue = htmlspecialchars($rue);
					$ville = $info['ville'];
					$ville = htmlspecialchars($ville);
					$cp = $info['cp'];
					$cp = htmlspecialchars($cp);
					$mail = $_SESSION['user'];
					$mail = htmlspecialchars($mail);
					include("vues/v_commande.php");
				} else {
					$message = "panier vide !!";
					include("vues/v_message.php");
				}
			} else {
				$msgErreurs[] = "Vous devez être connecté";
				include("vues/v_erreurs.php");
			}
			break;
		}
	case 'confirmerCommande': {
			$info = infoUtilisateur($_SESSION['user']);
			$mail = htmlspecialchars($_SESSION['user']);
			$nom = htmlspecialchars($info['nom'] . ' ' . $info['prenom']);
			$telephone = htmlspecialchars($info['telephone']);
			$adresse = htmlspecialchars($info['adresse']);
			$cp = htmlspecialchars($info['cp']);
			$ville = htmlspecialchars($info['ville']);
			$msgErreurs = getErreursSaisieCommande($mail, $nom, $telephone, $adresse, $cp, $ville);
			if (count($msgErreurs) != 0) {
				include("vues/v_erreurs.php");
				include("vues/v_commande.php");
			} else {
				$lesProduits = getLesIdProduitsDuPanier();
				if (isset($lesProduits) == true) {
					creerCommande($mail, $lesProduits);
					$message = "Commande enregistrée";
					supprimerPanier();
					include("vues/v_message.php");
				} else {
					$msgErreurs = array('Erreur : Votre panier est vide.');
					include("vues/v_erreurs.php");
				}
			}
			break;
		}
	case 'viderPanier': {
			$lesIdProduit = getLesIdProduitsDuPanier();
			foreach ($lesIdProduit as $produit) {
				retirerDuPanier($produit);
			}
			$message = "panier vide !!";
			include("vues/v_message.php");
		}
}
