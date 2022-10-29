﻿<?php
$action = $_REQUEST['action'];
switch ($action) {
	case 'voirPanier': {
			$n = nbProduitsDuPanier();
			if ($n > 0) {
				$desIdProduit = getLesIdProduitsDuPanier();
				$lesProduitsDuPanier = getLesProduitsDuTableau($desIdProduit);
				include("vues/v_panier.php");
			} else {
				$message = "panier vide !!";
				include("vues/v_message.php");
			}
			break;
		}
	case 'supprimerUnProduit': {
			$idProduit = $_REQUEST['produit'];
			retirerDuPanier($idProduit);
			$desIdProduit = getLesIdProduitsDuPanier();
			$lesProduitsDuPanier = getLesProduitsDuTableau($desIdProduit);
			include("vues/v_panier.php");
			break;
		}
	case 'passerCommande': {
			$_SESSION['qte'] = $_REQUEST['qte'];
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
			//Reprendre à partir d'ici
			$msgErreurs = getErreursSaisieCommande($nom, $rue, $ville, $cp, $mail);
			if (count($msgErreurs) != 0) {
				include("vues/v_erreurs.php");
				include("vues/v_commande.php");
			} else {
				$lesIdProduit = getLesIdProduitsDuPanier();
				$lesQte = getLaQte();
				var_dump($_SESSION);
				if (isset($lesIdProduit) && isset($lesQte) == true) {
					creerCommande($nom, $rue, $ville, $cp, $mail, $lesIdProduit, $lesQte);
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
