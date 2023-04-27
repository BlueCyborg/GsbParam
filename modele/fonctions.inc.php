<?php

/**
 * @file fonctions.inc.php
 * @author Marielle Jouin <jouin.marielle@gmail.com>
 * @version    2.0
 * @date juin 2021
 * @details contient les fonctions qui ne font pas accès aux données de la BD
 * regroupe les fonctions pour gérer le panier, et les erreurs de saisie dans le formulaire de commande
 * @package  GsbParam\util
 */
/**
 * Initialise le panier
 *
 * Crée un tableau associatif $_SESSION['produits']en session dans le cas
 * où il n'existe pas déjà
 */
function initPanier()
{
	if (!isset($_SESSION['produits'])) {
		$_SESSION['produits'] = array();
	}
}
/**
 * Supprime le panier
 *
 * Supprime le tableau associatif $_SESSION['produits']
 */
function supprimerPanier()
{
	unset($_SESSION['produits']);
}
/**
 * Ajoute un produit au panier
 *
 * Teste si l'identifiant du produit est déjà dans la variable session 
 * ajoute l'identifiant à la variable de type session dans le cas où
 * où l'identifiant du produit n'a pas été trouvé
 
 * @param string $idProduit identifiant de produit
 * @return boolean $ok vrai si le produit n'était pas dans la variable, faux sinon 
 */
function ajouterAuPanier($idProduit)
{
	$ok = true;
	if (in_array($idProduit, $_SESSION['produits'])) {
		$ok = false;
	}
	else {
		$_SESSION['produits'][] = $idProduit; // l'indice n'est pas précisé : il sera automatiquement celui qui suit le dernier occupé
	}
	return $ok;
}
/**
 * Retourne les produits du panier
 *
 * Retourne le tableau des identifiants de produit
 
 * @return array $_SESSION['produits'] le tableau des id produits du panier 
 */
function getLesIdProduitsDuPanier()
{
	return $_SESSION['produits'];
}
/**
 * Retourne la quantité des prioduits du panier
 * 
 * Retourne le tableau des quantités en fonction des produits du panier
 * 
 * @return array $_SESSION['qte'] le tableau de la quantité des produits
 */
function getLaQte()
{
	return $_SESSION['qte'];
}
/**
 * Retourne le nombre de produits du panier
 *
 * Teste si la variable de session existe
 * et retourne le nombre d'éléments de la variable session
 
 * @return int $n
 */
function nbProduitsDuPanier()
{
	$n = 0;
	if (isset($_SESSION['produits'])) {
		$n = count($_SESSION['produits']);
	}
	return $n;
}
/**
 * Retire un de produits du panier
 *
 * Recherche l'index de l'idProduit dans la variable session
 * et détruit la valeur à ce rang
 
 * @param string $idProduit identifiant de produit
 
 */
function retirerDuPanier($idProduit)
{
	$index = array_search($idProduit, $_SESSION['produits']);
	unset($_SESSION['produits'][$index]);
}
/**
 * teste si une chaîne a un format de code postal
 *
 * Teste le nombre de caractères de la chaîne et le type entier (composé de chiffres)
 
 * @param string $codePostal  la chaîne testée
 * @return boolean $ok vrai ou faux
 */
function estUnCp($codePostal)
{

	return strlen($codePostal) == 5 && estEntier($codePostal);
}
/**
 * teste si une chaîne est un entier
 *
 * Teste si la chaîne ne contient que des chiffres
 
 * @param string $valeur la chaîne testée
 * @return boolean $ok vrai ou faux
 */

function estEntier($valeur)
{
	return preg_match("/[^0-9]/", $valeur) == 0;
}
/**
 * Teste si une chaîne a le format d'un mail
 *
 * Utilise les expressions régulières
 
 * @param string $mail la chaîne testée
 * @return boolean $ok vrai ou faux
 */
function estUnMail($mail)
{
	return preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#', $mail);
}
/**
 * Retourne un tableau d'erreurs de saisie pour une commande
 *
 * @param string $mail de l'utilisateur testé
 * @param string $nom chaîne
 * @param string $telephone chaîne
 * @param string $adresse chaîne
 * @param string $cp chaîne
 * @param string $ville chaine
 * @return array $lesErreurs un tableau de chaînes d'erreurs
 */
function getErreursSaisieCommande($mail, $nom, $telephone, $adresse, $cp, $ville)
{
	$lesErreurs = array();
	if ($mail == "") {
		$lesErreurs[] = "Il faut saisir le champ mail";
	}
	else {
		if (!estUnMail($mail)) {
			$lesErreurs[] = "erreur de mail";
		}
	}
	if ($nom == "") {
		$lesErreurs[] = "Il faut saisir le champ nom";
	}
	if ($telephone == "") {
		$lesErreurs[] = "Il faut saisir le champ téléphone";
	}
	if ($adresse == "") {
		$lesErreurs[] = "Il faut saisir le champ adresse";
	}
	if ($cp == "") {
		$lesErreurs[] = "Il faut saisir le champ Code postal";
	}
	else {
		if (!estUnCp($cp)) {
			$lesErreurs[] = "erreur de code postal";
		}
	}
	if ($ville == "") {
		$lesErreurs[] = "Il faut saisir le champ ville";
	}
	return $lesErreurs;
}
/**
 * Retourne un tableau d'erreurs de saisie pour une Inscription
 *
 * @param string $nom chaine
 * @param string $telephone chaîne
 * @param string $adresse chaîne
 * @param string $cp chaîne
 * @param string $ville chaine
 * @param string $mail chaine
 * @param string $motdepasse chaine
 * @param string $motdepass2 chaine
 * 
 * @return array $lesErreurs un tableau de chaînes d'erreurs
 */
function getErreursSaisieInscription($nom, $prenom, $telephone, $adresse, $cp, $ville, $mail, $motdepasse, $motdepass2)
{
	$lesErreurs = array();
	if ($nom == "") {
		$lesErreurs[] = "Il faut saisir le champ nom";
	}
	if ($prenom == "") {
		$lesErreurs[] = "Il faut saisir le champ prenom";
	}
	if ($telephone == "") {
		$lesErreurs[] = "Il faut saisir le champ telephone";
	}
	if ($adresse == "") {
		$lesErreurs[] = "Il faut saisir le champ adresse";
	}
	if ($cp == "") {
		$lesErreurs[] = "Il faut saisir le champ cp";
	}
	if ($ville == "") {
		$lesErreurs[] = "Il faut saisir le champ ville";
	}
	if ($cp == "") {
		$lesErreurs[] = "Il faut saisir le champ Code postal";
	}
	else {
		if (!estUnCp($cp)) {
			$lesErreurs[] = "erreur de code postal";
		}
	}
	if ($mail == "") {
		$lesErreurs[] = "Il faut saisir le champ mail";
	}
	else {
		if (!estUnMail($mail)) {
			$lesErreurs[] = "erreur de mail";
		}
	}
	if ($motdepasse == "") {
		$lesErreurs[] = "Il faut saisir le champ mot de passe";
	}
	if ($motdepass2 == "") {
		$lesErreurs[] = "Il faut saisir le champ mot de passe";
	}
	else {
		if ($motdepass2 != $motdepasse) {
			$lesErreurs[] = "Les mots de passe ne sont pas identiques";
		}
	}
	if (strlen($motdepasse) <= 6) {
		$lesErreurs[] = "Le mot de passe est trop court";
	}
	return $lesErreurs;
}
/**
 * Retourne un tableau d'erreurs de saisie pour une Connexion
 *
 * @param string $mail chaine
 * @param string $pass chaine
 * 
 * @return array $lesErreurs un tableau de chaînes d'erreurs
 */
function getErreursSaisieConnexion($mail, $pass)
{
	$lesErreurs = array();
	if ($mail == "") {
		$lesErreurs[] = "Il faut saisir le champ mail";
	}
	else {
		if (!estUnMail($mail)) {
			$lesErreurs[] = "Erreur: votre saisie ne correspond pas à un mail";
		}
	}
	if ($pass == "") {
		$lesErreurs[] = "Il faut saisir le champ pass";
	}
	return $lesErreurs;
}
/**
 * Retourne un tableau d'erreurs de saisie pour une Connexion en tant qu'administrateur
 *
 * @param string $user chaine
 * @param string $pass chaine
 * 
 * @return array $lesErreurs un tableau de chaînes d'erreurs
 */
function getErreursSaisieConnexionAdministrateur($user, $pass)
{
	$lesErreurs = array();
	if ($user == "") {
		$lesErreurs[] = "Il faut saisir le champ User";
	}
	if ($pass == "") {
		$lesErreurs[] = "Il faut saisir le champ Mot de passe";
	}
	return $lesErreurs;
}
/**
 * Retourne un booléen concernant l'éxistance de l'utilisateur
 * 
 * @param $mail Mail de l'utilisateur
 * 
 * @return boolean $exist le resultat de la requete de séléction de l'utilisateur
 */
function existeUtilisateur($mail): bool
{
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare("select mail from login where mail=:mail");
		$req->bindParam(':mail', $mail);
		$req->execute();
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
		if (empty($res)) {
			$exist = false;
		}
		else {
			$exist = true;
		}
		return $exist;
	}
	catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}