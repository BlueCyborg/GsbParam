<?php

/**
 * connexionPDOAdminfournit un objet Pdo $conn pour effectuer ensuite des requêtes
 */
function connexionPDOAdmin()
{
    $login = 'root';
    $mdp = '';
    $bd = 'gsbParam';
    $serveur = 'localhost';

    try {
        $conn = new PDO("mysql:host=$serveur;dbname=$bd", $login, $mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        print "Erreur de connexion PDO ";
        die();
    }
}
/**
 * Modifie l'ID en fonction du produit choisi ainsi que de la nouvelle valeur saisie
 * 
 * @param $idProduit Le produit séléctionné
 * @param $newID la nouvelle valeur
 * 
 * @return void Change la valeur dans la base de donnée
 */
function modifierIdProduit($idProduit, $newID)
{
    $newID = htmlspecialchars($newID);
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("UPDATE `produit` SET `id`= :newID WHERE `id` = :idProduit");
        $req->bindParam(':newID', $newID);
        $req->bindParam(':idProduit', $idProduit);
        $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
/**
 * Modifie la description en fonction du produit choisi ainsi que de la nouvelle valeur saisie
 * 
 * @param $idProduit Le produit séléctionné
 * @param $newDescription la nouvelle valeur
 * 
 * @return void Change la valeur dans la base de donnée
 */
function modifierDescriptionProduit($idProduit, $newDescription)
{
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("UPDATE `produit` SET `description`= :newDescription WHERE `id` = :idProduit");
        $req->bindParam(':newDescription', $newDescription);
        $req->bindParam(':idProduit', $idProduit);
        $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
/**
 * Modifie le prix en fonction du produit choisi ainsi que de la nouvelle valeur saisie
 * 
 * @param $idProduit Le produit séléctionné
 * @param $newPrix la nouvelle valeur
 * 
 * @return void Change la valeur dans la base de donnée
 */
function modifierPrixProduit($idProduit, $newPrix)
{
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("UPDATE `produit` SET `prix`= :newPrix WHERE `id` = :idProduit");
        $req->bindParam(':newPrix', $newPrix);
        $req->bindParam(':idProduit', $idProduit);
        $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
/**
 * Modifie l'image en fonction du produit choisi ainsi que de la nouvelle valeur saisie
 * 
 * @param $idProduit Le produit séléctionné
 * @param $newImage la nouvelle valeur
 * 
 * @return void Change la valeur dans la base de donnée
 */
function modifierImageProduit($idProduit, $newImage)
{
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("UPDATE `produit` SET `image`= :newImage WHERE `id` = :idProduit");
        $req->bindParam(':newImage', $newImage);
        $req->bindParam(':idProduit', $idProduit);
        $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
/**
 * Modifie l'ID  de Catégorie en fonction du produit choisi ainsi que de la nouvelle valeur saisie
 * 
 * @param $idProduit Le produit séléctionné
 * @param $newIDCat la nouvelle valeur
 * 
 * @return void Change la valeur dans la base de donnée
 */
function modifierIDCatProduit($idProduit, $newIDCat)
{
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("UPDATE `produit` SET `idCat`= :newIDCat WHERE `id` = :idProduit");
        $req->bindParam(':newIDCat', $newIDCat);
        $req->bindParam(':idProduit', $idProduit);
        $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
/**
 * Permet de supprimer un produit en fonction de son ID
 * 
 * @param $idProduit Le produit choisi que l'on souhaite supprimer
 * @return bool Supprime le produit dans la base de donnée
 */
function supprimerProduit($idProduit)
{
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("DELETE FROM `produit` WHERE `produit`.`id` = :idProduit");
        $req->bindParam(':idProduit', $idProduit);
        $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
/**
 * Permet de créer un produit en fonctions des paramètres rentrées par l'utilisateur
 * 
 * @param $id Le produit choisi que l'on souhaite
 * @param $description chaine
 * @param $prix int
 * @param $image chaine
 * @param $idCat chaine
 * @return bool Crée le produit dans la base de donnée
 */
function creerProduit($id, $description, $prix, $image, $idCat)
{
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("INSERT INTO `produit`(`id`, `description`, `prix`, `image`, `idCategorie`) VALUES (:id,:description,:prix,:image,:idCat)");
        $req->bindParam(':id', $id);
        $req->bindParam(':description', $description);
        $req->bindParam(':prix', $prix);
        $req->bindParam(':image', $image);
        $req->bindParam(':idCat', $idCat);
        $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
