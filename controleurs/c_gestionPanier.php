<?php
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
			$n = nbProduitsDuPanier();
			if ($n > 0) {   // les variables suivantes servent à l'affectation des attributs value du formulaire
				// ici le formulaire doit être vide, quand il est erroné, le formulaire sera réaffiché pré-rempli
				$nom = '';
				$nom = htmlspecialchars($nom);
				$rue = '';
				$rue = htmlspecialchars($rue);
				$ville = '';
				$ville = htmlspecialchars($ville);
				$cp = '';
				$cp = htmlspecialchars($cp);
				$mail = '';
				$mail = htmlspecialchars($mail);
				include("vues/v_commande.php");
			} else {
				$message = "panier vide !!";
				include("vues/v_message.php");
			}
			break;
		}
	case 'confirmerCommande': {
			var_dump($_REQUEST);
			var_dump($_SESSION);
			$nom = $_REQUEST['nom'];
			$rue = $_REQUEST['rue'];
			$cp = $_REQUEST['cp'];
			$ville = $_REQUEST['ville'];
			$mail = $_REQUEST['mail'];
			$msgErreurs = getErreursSaisieCommande($nom, $rue, $ville, $cp, $mail);
			if (count($msgErreurs) != 0) {
				include("vues/v_erreurs.php");
				include("vues/v_commande.php");
			} else {
				$lesIdProduit = getLesIdProduitsDuPanier();
				if (isset($lesIdProduit) == true) {
					creerCommande($nom, $rue, $ville, $cp, $mail, $lesIdProduit);
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
