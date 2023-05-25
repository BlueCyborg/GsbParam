<?php

/** 
 * Mission 3 : architecture MVC GsbParam
 
 * @file bd.produits.inc.php
 * @author Marielle Jouin <jouin.marielle@gmail.com>
 * @version    2.0
 * @date juin 2021
 * @details contient les fonctions d'accès BD à la table produits
 */
include_once 'bd.inc.php';

/**
 * Retourne toutes les catégories sous forme d'un tableau associatif
 *
 * @return array $lesLignes le tableau associatif des catégories 
 */
function getLesCategories()
{
	try {
		$monPdo = connexionPDO();
		$req = 'select id, libelle from categorie';
		$res = $monPdo->query($req);
		$lesLignes = $res->fetchAll(PDO::FETCH_ASSOC);
		return $lesLignes;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}
/**
 * Retourne toutes les informations d'une catégorie passée en paramètre
 *
 * @param string $idCategorie l'id de la catégorie
 * @return array $laLigne le tableau associatif des informations de la catégorie 
 */
function getLesInfosCategorie($idCategorie)
{
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare("SELECT id, libelle FROM categorie WHERE id= :id");
		$req->bindParam(':id', $idCategorie);
		$req->execute();
		$laLigne = $req->fetch(PDO::FETCH_ASSOC);
		return $laLigne;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}
/**
 * Retourne sous forme d'un tableau associatif tous les produits de la
 * catégorie passée en argument
 * 
 * @param string $idCategorie  l'id de la catégorie dont on veut les produits
 * @return array $lesLignes un tableau associatif  contenant les produits de la categ passée en paramètre
 */

function getLesProduitsDeCategorie($idCategorie)
{
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare('SELECT
		p.id,
		p.nom,
		p.image,
		p.id_categorie,
		o.stock,
		o.prix,
		m.libelle AS marque,
		CASE WHEN o.stock > 0 THEN true ELSE false END AS en_stock
	FROM
		produit p
	INNER JOIN posseder o ON
		p.id = o.id_produit
	INNER JOIN marque m ON
		p.id_marque = m.id
	WHERE p.id_categorie = :id;');
		$req->bindParam(':id', $idCategorie);
		$req->execute();
		$lesLignes = $req->fetchAll(PDO::FETCH_ASSOC);
		return $lesLignes;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}
/**
 * Retourne les produits concernés par le tableau des idProduits passée en argument
 *
 * @param array $desIdProduit tableau d'idProduits
 * @return array $lesProduits un tableau associatif contenant les infos des produits dont les id ont été passé en paramètre
 */
function getLesProduitsDuTableau($desProduits)
{
	try {
		$monPdo = connexionPDO();
		$nbProduits = count($desProduits);
		$lesProduits = array();
		if ($nbProduits != 0) {
			foreach ($desProduits as $unProduit) {
				$req = $monPdo->prepare("SELECT 
				o.id_produit AS 'idProduit',
				o.id_contenance AS 'idContenance',
				p.`nom`,
				p.`image`,
				o.prix,
				o.stock,
				m.libelle AS 'marque'
			FROM `produit` p
				INNER JOIN posseder o ON p.id = o.id_produit
				INNER JOIN marque m ON p.id_marque = m.id
			WHERE
				o.id_produit = :idP AND o.id_contenance = :idC");
				$req->bindParam(':idP', $unProduit['idProduit']);
				$req->bindParam(':idC', $unProduit['idContenance']);
				$req->execute();
				$unProduit = $req->fetch(PDO::FETCH_ASSOC);
				$lesProduits[] = $unProduit;
			}
		}
		return $lesProduits;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}
/**
 * Crée une commande 
 *
 * Crée une commande à partir des arguments validés passés en paramètre, l'identifiant est
 * construit à partir du maximum existant ; crée les lignes de commandes dans la table contenir à partir du
 * tableau d'idProduit passé en paramètre
 * @param string $nom nom du client
 * @param string $rue rue du client
 * @param string $cp cp du client
 * @param string $ville ville du client
 * @param string $mail mail du client
 * @param array $lesIdProduit tableau associatif contenant les id des produits commandés
 
 */
function creerCommande($mail, $lesProduits)
{
	try {
		$idClient = infoUtilisateur($mail);
		$idClient = $idClient['id'];
		$monPdo = connexionPDO();
		// on récupère le dernier id de commande
		$req = 'select max(id) as maxi from commande';
		$res = $monPdo->query($req);
		$laLigne = $res->fetch();
		$maxi = $laLigne['maxi']; // on place le dernier id de commande dans $maxi
		$idCommande = $maxi + 1; // on augmente le dernier id de commande de 1 pour avoir le nouvel idCommande
		$date = date('Y/m/d'); // récupération de la date système
		$req = $monPdo->prepare("insert into commande (`id`, `idClient`, `dateCommande`) values (:id, :idClient, :date)");
		$req->bindParam(':id', $idCommande);
		$req->bindParam(':idClient', $idClient);
		$req->bindParam(':date', $date);
		$req->execute();
		// insertion produits commandés
		foreach ($lesProduits as $unProduit) {
			$req = $monPdo->prepare("INSERT INTO `contenir`(`idCommande`, `idProduit`, `id_contenance`, `quantite`) VALUES (:id, :unIdProduit, :unIdContenance, :laQte)");
			$req->bindParam(':id', $idCommande);
			$req->bindParam(':unIdProduit', $unProduit['idProduit']);
			$req->bindParam(':unIdContenance', $unProduit['idContenance']);
			$req->bindParam(':laQte', $unProduit['quantite']);
			$req->execute();
		}
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}
/**
 * Retourne les produits concernés par le tableau des idProduits passée en argument
 *
 * @param int $mois un numéro de mois entre 1 et 12
 * @param int $an une année
 * @return array $lesCommandes un tableau associatif contenant les infos des commandes du mois passé en paramètre
 */
function getLesCommandesDuMois($mois, $an)
{
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare("select id, dateCommande, nomPrenomClient, adresseRueClient, cpClient, villeClient, mailClient from commande where YEAR(dateCommande)= :an AND MONTH(dateCommande)=:mois");
		$req->bindParam(':an', $an);
		$req->bindParam(':mois', $mois);
		$req->execute();
		$lesCommandes = $req->fetchAll(PDO::FETCH_ASSOC);
		return $lesCommandes;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}
/**
 * Retourne les produits de la base de donnée
 * 
 * @return array $lesProduits Les produits résultant de la requete
 */
function getLesProduits()
{
	try {
		$monPdo = connexionPDO();
		$req = 'SELECT
		p.id,
		p.nom,
		p.image,
		p.id_categorie,
		o.stock,
		o.prix,
		m.libelle AS marque,
		CASE WHEN o.stock > 0 THEN true ELSE false END AS en_stock
	FROM
		produit p
	INNER JOIN posseder o ON
		p.id = o.id_produit
	INNER JOIN marque m ON
		p.id_marque = m.id;
	';
		$res = $monPdo->query($req);
		$lesProduits = $res->fetchAll(PDO::FETCH_ASSOC);
		return $lesProduits;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}
/**
 * Retourne les informations d'un produits
 * 
 * @param $idProduit Le produit duquel on souhaite obtenir les informations
 * @return array $infoProduit Le tableau contenant les informations du produit
 */
function getInfoProduit($idProduit)
{
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare("SELECT
		p.`id`,
		p.`nom`,
		p.`image`,
		p.`description`,
		m.libelle AS 'marque',
		ca.libelle AS 'categorie',
		o.prix,
		o.stock,
		u.libelle AS 'unite',
		c.contenance,
		o.`id_contenance`
	FROM
		`produit` p
	INNER JOIN posseder o ON
		p.id = o.id_produit
	INNER JOIN marque m ON
		p.id_marque = m.id
	INNER JOIN contenance c ON
		o.id_contenance = c.id
	INNER JOIN unite u ON
		c.id_unite = u.id
	INNER JOIN categorie ca ON
		p.id_categorie = ca.id
	WHERE
		p.id = :id");

		$req->bindParam(':id', $idProduit);
		$req->execute();
		$infoProduit = $req->fetchAll(PDO::FETCH_ASSOC);
		return $infoProduit;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
	}
}

function getLesMarques(): array
{
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->query("SELECT `id`, `libelle` FROM `marque`;");
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getUneMarques($id)
{
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare("SELECT `id`, `libelle` FROM `marque` WHERE id = :id;");
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$req->execute();
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getLesProduitsFiltre(float $prixMin, float $prixMax, int $idMarque): array
{
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare("SELECT
            p.id,
		p.nom,
		p.image,
		p.id_categorie,
		o.stock,
		o.prix,
		m.libelle AS marque,
		CASE WHEN o.stock > 0 THEN true ELSE false END AS en_stock
        FROM
            `produit` p
        INNER JOIN posseder o ON
            p.id = o.id_produit
        INNER JOIN marque m ON
            p.id_marque = m.id
        WHERE
            o.prix >= :prixMin AND o.prix <= :prixMax AND m.id = :idMarque");

		$req->bindParam(':prixMin', $prixMin, PDO::PARAM_STR);
		$req->bindParam(':prixMax', $prixMax, PDO::PARAM_STR);
		$req->bindParam(':idMarque', $idMarque, PDO::PARAM_INT);

		$req->execute();

		$res = $req->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getQuantiteProduit($idProduit, $idContenance)
{
	if (isset($_SESSION['produits']) && is_array($_SESSION['produits'])) {
		foreach ($_SESSION['produits'] as $produit) {
			if ($produit['idProduit'] === $idProduit && $produit['idContenance'] === $idContenance) {
				return $produit['quantite'];
			}
		}
	}

	return 0; // Si le produit n'est pas trouvé, on retourne 0 par défaut
}
