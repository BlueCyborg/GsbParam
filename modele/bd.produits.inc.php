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
 * Retourne toutes les unites sous forme d'un tableau associatif
 *
 * @return array $lesLignes le tableau associatif des catégories 
 */
function getLesUnites()
{
	try {
		$monPdo = connexionPDO();
		$req = 'select id, libelle from unite';
		$res = $monPdo->query($req);
		$lesLignes = $res->fetchAll(PDO::FETCH_ASSOC);
		return $lesLignes;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

/**
 * Retourne toutes les marque sous forme d'un tableau associatif
 *
 * @return array $lesLignes le tableau associatif des catégories 
 */
function getLesMarques()
{
	try {
		$monPdo = connexionPDO();
		$req = 'select id, libelle from marque';
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
		$req = $monPdo->prepare("select id, description, image, idCategorie from produit where idCategorie = :id");
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
function getLesProduitsDuTableau($desIdProduit)
{
	try {
		$monPdo = connexionPDO();
		$nbProduits = count($desIdProduit);
		$lesProduits = array();
		if ($nbProduits != 0) {
			foreach ($desIdProduit as $unIdProduit) {
				$req = $monPdo->prepare("SELECT pr.id, description, image, idCategorie, MIN(prix) AS prix, po.id_contenance, contenance, uni.libelle as UNITE
			FROM produit pr
			INNER JOIN posseder po
			ON pr.id=po.id_produit 
			INNER JOIN contenance co
			ON po.id_contenance=co.id
			INNER JOIN unite uni
			ON co.id_unite=uni.id
			WHERE pr.id = :id
			GROUP BY pr.id");
				$req->bindParam(':id', $unIdProduit);
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

function creerCommande($mail, $lesIdProduit, $lesQte)
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
		foreach ($lesIdProduit as $unIdProduit) {
			$req = $monPdo->prepare("INSERT INTO `contenir`(`idCommande`, `idProduit`, `quantite`) VALUES (:id, :unIdProduit, :laQte)");
			$req->bindParam(':id', $idCommande);
			$req->bindParam(':unIdProduit', $unIdProduit);
			$req->bindParam(':laQte', $lesQte[$unIdProduit]);
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
		$req = 'SELECT `id`,`description`,`image`,`idCategorie`, MIN(prix) AS prix
		FROM produit pr
		LEFT JOIN posseder po
		ON pr.id=po.id_produit
		GROUP BY id';
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
		$req = $monPdo->prepare("SELECT p.id, description, image, idCategorie, id_marque, m.libelle AS marque,c.libelle AS categ, po.stock, po.prix, co.id_unite,u.libelle as unite, co.contenance  from 
		produit p
		INNER JOIN marque m
		ON p.id_marque=m.id
		INNER JOIN categorie c
		ON p.idCategorie=c.id
		INNER JOIN posseder po
		ON p.id=po.id_produit
		INNER JOIN contenance co
		ON po.id_contenance=co.id
		INNER JOIN unite u
		ON co.id_unite=u.id
		 where p.id=:id");
		$req->bindParam(':id', $idProduit);
		$req->execute();
		$infoProduit = $req->fetch(PDO::FETCH_ASSOC);
		return $infoProduit;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
	}
}


function creerCommande2($idClient)
{
	try {

		$monPdo = connexionPDO();
		$etat = 'E';
		$req = 'SELECT max(id) AS maxi FROM commande';
		$res = $monPdo->query($req);
		$laLigne = $res->fetch();
		$maxi = $laLigne['maxi']; // on place le dernier id de commande dans $maxi
		$idCommande = $maxi + 1; // on augmente le dernier id de commande de 1 pour avoir le nouvel idCommande
		$date = date('Y/m/d');
		$req = $monPdo->prepare("INSERT INTO commande (id, dateCommande, idClient, etat) VALUES (:idCommande, :date, :idClient, :etat)");
		$req->bindParam(':etat', $etat);
		$req->bindParam(':idClient', $idClient);
		$req->bindParam(':idCommande', $idCommande);
		$req->bindParam(':date', $date);

		$req->execute();
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
	}
}


function ajoutProduitCommande($idProduit, $quantite, $id_contenance)
{
	try {

		$monPdo = connexionPDO();
		$req = 'select max(id) as maxi from commande';
		$res = $monPdo->query($req);
		$laLigne = $res->fetch();
		$maxi = $laLigne['maxi']; // on place le dernier id de commande dans $maxi
		$idCommande = $maxi;

		$req = $monPdo->prepare("INSERT INTO contenir (idCommande, idProduit, id_contenance, quantite) VALUES (:idCommande, :idproduit, :id_contenance, :qte)");

		$req->bindParam(':idCommande', $idCommande);
		$req->bindParam(':idproduit', $idProduit);
		$req->bindParam(':id_contenance', $id_contenance);
		$req->bindParam(':qte', $quantite);

		$req->execute();
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
	}
}
