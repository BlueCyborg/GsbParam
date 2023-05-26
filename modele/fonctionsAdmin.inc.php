<?php

/**
 * connexionPDOAdminfournit un objet Pdo $conn pour effectuer ensuite des requêtes
 */
function connexionPDOAdmin()
{
    $login = 'root';
    $mdp = '';
    $bd = 'gsbParam';
    $serveur = 'localhost:3307';

    try {
        $conn = new PDO("mysql:host=$serveur;dbname=$bd", $login, $mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
    catch (PDOException $e) {
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
    }
    catch (PDOException $e) {
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
    }
    catch (PDOException $e) {
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
    }
    catch (PDOException $e) {
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
    }
    catch (PDOException $e) {
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
    }
    catch (PDOException $e) {
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
    }
    catch (PDOException $e) {
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
function creerProduit($id, $description, $image, $idCat, $idMarque, $idContenance, $prix)
{
    try {

        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("INSERT INTO `produit`(`id`, `description`, `image`, `idCategorie`, id_marque) VALUES (:id, :description, :image, :idCat,:idMarque)");
        $req->bindParam(':id', $id);
        $req->bindParam(':description', $description);
        $req->bindParam(':image', $image);
        $req->bindParam(':idCat', $idCat);
        $req->bindParam(':idMarque', $idMarque);
        $req->execute();

        $stock = 0;
        $req = $monPdo->prepare("INSERT INTO `posseder` VALUES (:id_contenance, :id_produit, :stock, :prix)");
        $req->bindParam(':id_contenance', $idContenance);
        $req->bindParam(':id_produit', $id);
        $req->bindParam(':stock', $stock);
        $req->bindParam(':prix', $prix);

        $req->execute();
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}


/**
 * Fonction permettant d"éditer un produit.
 *
 * @param string $idProduit
 * @param string $description
 * @param string $marque
 * @param string $categorie
 * @return void
 */
function editerProduit($idProduit, $description, $marque, $categorie)
{
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("UPDATE produit SET description=:description, id_marque=:id_marque, idCategorie=:idCategorie WHERE id=:idProduit");
        $req->bindParam(':description', $description);
        $req->bindParam(':id_marque', $marque);
        $req->bindParam(':idCategorie', $categorie);
        $req->bindParam(':idProduit', $idProduit);
        $req->execute();
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

/**
 * Fonction permettant d'associer deux produit entre eux.
 *
 * @param int $produit1
 * @param int $produit2
 * @return void
 */
function associerProduit($produit1, $produit2)
{
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("INSERT INTO suggestion (id, id_produit) VALUES (:produit1, :produit2)");
        $req->bindParam(':produit1', $produit1);
        $req->bindParam(':produit2', $produit2);
        $req->execute();
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

/**
 * Permet de vérifier si il existe une assciation entre ces deux produits.
 *
 * @param int $produit1
 * @param int $produit2
 * @return void
 */
function existeAssociation($produit1, $produit2)
{
    try {
        $resultat = false;
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("SELECT id,id_produit FROM suggestion");
        $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);

        foreach ($res as $unRes) {
            if (($unRes['id'] == $produit1 || $unRes['id'] == $produit2) &&
            ($unRes['id_produit'] == $produit1 || $unRes['id_produit'] == $produit2)
            ) {
                $resultat = true;
            }
        }
        return $resultat;
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

/**
 * Fonction permettant de trouver tous les associations en base.
 *
 * @return $lesLignes
 */
function getAssociations()
{
    try {
        $monPdo = connexionPDO();
        $req = 'SELECT id, id_produit FROM suggestion ';
        $res = $monPdo->query($req);
        $lesLignes = $res->fetchAll(PDO::FETCH_ASSOC);
        return $lesLignes;
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

/**
 * Fonction permettant de modifier une association
 *
 * @param int $produit1
 * @param int $produit2
 * @param int $produit1Remp
 * @param int $produit2Remp
 * @return void
 */
function modificationAssociation($produit1, $produit2, $produit1Remp, $produit2Remp)
{
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("UPDATE suggestion SET id=:produit1Remp, id_produit=:produit2Remp WHERE id=:produit1 AND id_produit=:produit2");
        $req->bindParam(':produit1', $produit1);
        $req->bindParam(':produit2', $produit2);
        $req->bindParam(':produit1Remp', $produit1Remp);
        $req->bindParam(':produit2Remp', $produit2Remp);
        $req->execute();
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

/**
 * Fonction permettant de supprimer une association
 *
 * @param int $produit1
 * @param int $produit2
 * @return void
 */
function supprimerAssociation($produit1, $produit2)
{
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("DELETE FROM suggestion WHERE id=:produit1 AND id_produit=:produit2");
        $req->bindParam(':produit1', $produit1);
        $req->bindParam(':produit2', $produit2);
        $req->execute();
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

/**
 * Fonction permettant de récuperer le nom et le prènom d'un utilisateur qui a commané.
 *
 * @return void
 */
function getCommandes()
{
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("SELECT co.id, u.nom, u.prenom, dateCommande, etat FROM commande co
        INNER JOIN utilisateur u
        ON co.idClient=u.id");
        $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

/* * Fonction permettant de d'obtenir le stock d'un produit à partir de son id */
function getStockProd($id)
{
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("SELECT id_contenance,contenance,u.libelle,id_produit, stock FROM posseder po INNER JOIN contenance co ON po.id_contenance=co.id INNER JOIN unite u ON co.id_unite=u.id WHERE id_produit=:id_produit;");
        $req->bindParam(':id_produit', $id);
        $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}


/**
 * Fonction permettant de modifier le stock d'un produit.
 *
 * @param [type] $idProd
 * @param [type] $idContenance
 * @param [type] $stock
 * @return void
 */
function updateStock($idProd, $idContenance, $stock)
{
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("UPDATE posseder
        SET stock =:stock
        WHERE id_produit=:id_produit AND id_contenance=:id_contenance");
        $req->bindParam(':id_produit', $idProd);
        $req->bindParam(':id_contenance', $idContenance);
        $req->bindParam(':stock', $stock);
        $req->execute();
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

/* * Fonction permettant de modifier le prix d'un produit . */
function updatePrix($idProd, $idContenance, $prix)
{
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("UPDATE posseder
    SET prix =:prix
    WHERE id_produit=:id_produit AND id_contenance=:id_contenance");
        $req->bindParam(':id_produit', $idProd);
        $req->bindParam(':id_contenance', $idContenance);
        $req->bindParam(':prix', $prix);
        $req->execute();
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

/**
 * Fonction qui permet de supprimer une contenance d'un produit.
 */
function supprimerPosseder($idProd, $idContenance)
{
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("DELETE FROM posseder WHERE id_contenance=:id_contenance AND id_produit=:id_produit");
        $req->bindParam(':id_contenance', $idContenance);
        $req->bindParam(':id_produit', $idProd);
        $req->execute();
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

/**
 * Fonction qui permet d'ajouter une contenance à un produit.
 */
function ajouterPosseder($id_contenance, $id_produit, $stock, $prix)
{
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("INSERT INTO posseder  VALUES (:id_contenance, :id_produit, :stock, :prix)");
        $req->bindParam(':id_contenance', $id_contenance);
        $req->bindParam(':id_produit', $id_produit);
        $req->bindParam(':stock', $stock);
        $req->bindParam(':prix', $prix);
        $req->execute();
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}


/**
 * Fontion qui permet de vérifier si il exite bien un produut dans la table produit.
 */

function existeProduit($idProd): bool
{
    try {
        $monPdo = connexionPDO();
        $req = $monPdo->prepare("SELECT id from produit where id=:id_produit");
        $req->bindParam(':id_produit', $idProd);
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
/* * Fonction qui permet de d'obtenir toutes les contenances de la base. */


function getContenances()
{
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("SELECT contenance.id,contenance,libelle FROM `contenance`
        INNER JOIN unite
        on contenance.id_unite=unite.id;");
        $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

/**
 * Fonction qui permet de créer une contenance.
 *
 * @param int $contenance
 * @param  int $id_unite
 * @return void
 */
function creerContenance($contenance, $id_unite)
{
    try {
        $monPdo = connexionPDOAdmin();

        $req = 'select max(id) as maxi from contenance';
        $res = $monPdo->query($req);
        $laLigne = $res->fetch();
        $maxi = $laLigne['maxi'] + 1;
        $idContenance = $maxi;

        $req = $monPdo->prepare("INSERT INTO contenance (id, contenance, id_unite) VALUES (:id, :contenance, :id_unite)");
        $req->bindParam(':id', $idContenance);
        $req->bindParam(':contenance', $contenance);
        $req->bindParam(':id_unite', $id_unite);
        $req->execute();
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

/**
 * Fonctiont qui permet de vérifier si il existe une contenance dans la base de donnée.
 *
 * @param [type] $contenance
 * @param [type] $id_unite
 * @return void
 */
function existeContenance($contenance, $id_unite)
{
    try {
        $monPdo = connexionPDO();
        $req = $monPdo->prepare("SELECT contenance, id_unite FROM contenance WHERE contenance=:contenance AND id_unite=:id_unite");
        $req->bindParam(':contenance', $contenance);
        $req->bindParam(':id_unite', $id_unite);
        $req->execute();
        $res = $req->fetch(PDO::FETCH_ASSOC);
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

/**
 * Fonction qui permet de d'obtenir toutes les contenances d'un produit à parti de son id.
 *
 * @param [type] $IdProd
 * @return void
 */
function getContenancesProd($IdProd)
{
    try {
        $monPdo = connexionPDOAdmin();

        $req = $monPdo->prepare("SELECT id_contenance, libelle, contenance, stock, prix FROM posseder po
        INNER JOIN contenance co
        ON po.id_contenance=co.id
        INNER JOIN unite u 
        ON co.id_unite=u.id
        WHERE id_produit=:id_produit");
        $req->bindParam(':id_produit', $IdProd);
        $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

/**
 * Fonction qui permet de supprimer toutes les contenances d'un produit à partir de son id.
 *
 * @param [type] $idProd
 * @return void
 */
function supprimerContenancesProd($idProd)
{
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("DELETE FROM posseder WHERE id_produit=:id_produit");
        $req->bindParam(':id_produit', $idProd);
        $req->execute();
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

/**
 * Fonciont qui permet de supprimer les associations d"un produit à partir d'un id.
 *
 * @param [type] $idProd
 * @return void
 */
function supprimerAssociationsProd($idProd)
{
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("DELETE FROM suggestion WHERE id=:id_produit OR id_produit=:id_produit");
        $req->bindParam(':id_produit', $idProd);
        $req->execute();
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

/**
 * Fonction qui pemret de vérifier si il ya un produit dans cette commande à partir d"un id.
 *
 * @param [type] $idProd
 * @return void
 */
function verifProdCommande($idProd)
{

    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("SELECT idProduit FROM contenir WHERE idProduit=:id_produit");
        $req->bindParam(':id_produit', $idProd);
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

/**
 * Fonction qui permet de vérifier si il y aune contenance pour ce produit à partir d'un id.
 *
 * @param [type] $idProd
 * @return void
 */
function verifProdContenance($idProd)
{

    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("SELECT idProduit FROM contenir WHERE id_produit=:id_produit");
        $req->bindParam(':id_produit', $idProd);
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

/**
 * Vérification si il y a une contenance dans la table posséder.
 *
 * @param [type] $idProd
 * @param [type] $idCont
 * @return void
 */
function verifContPosseder($idProd, $idCont)
{
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("SELECT id_produit, id_contenance FROM posseder WHERE id_produit=:id_produit AND id_contenance=:id_contenance");
        $req->bindParam(':id_produit', $idProd);
        $req->bindParam(':id_contenance', $idCont);
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

/**
 * Fonction qui permet de vérifier si il y a une contenance dans la table contenir.
 */

function verifContContenir($idProd, $idCont)
{
    try {
        $monPdo = connexionPDOAdmin();
        $req = $monPdo->prepare("SELECT idProduit, id_contenance FROM contenir WHERE idProduit=:id_produit AND id_contenance=:id_contenance");
        $req->bindParam(':id_produit', $idProd);
        $req->bindParam(':id_contenance', $idCont);
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