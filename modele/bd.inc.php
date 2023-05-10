<?php

/** 
 * Mission 3 : architecture MVC
 * @mainpage La documentation de la mission 3
 */
/**
 * @file bd.inc.php
 * @author Marielle Jouin <jouin.marielle@gmail.com>
 * @version    2.0
 * @date nov 2021
 * @details contient la fonction qui créée l'ojet Pdo $conn pour l'accès à la BD
 */

/**
 * connexionPdo fournit un objet Pdo $conn
 * pour effectuer ensuite des requêtes
 */
function connexionPDO()
{
    $login = 'dev';
    $mdp = 'dev';
    $bd = 'gsbParam';
    $serveur = 'localhost:3307';

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
 * fonction permettant de récupérer les informations de l'utilisateur en fonction de son adresse mail
 *
 * @param String $mail
 * @return array contenant les informations utilisateur
 */
function infoUtilisateur($mail): array
{
    try {
        $monPdo = connexionPDO();

        $req = $monPdo->prepare("SELECT u.id as ID, nom, prenom, telephone, adresse, cp, ville FROM utilisateur u
        INNER JOIN login l
        ON u.id_login=l.id
        WHERE  mail = :mail");
        $req->bindParam(':mail', $mail);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
/**
 * Fonction permettant d'inscrire un nouvelle utilisateur avec son nom, prenom, telephone, adresse, code postal, ville, email, mot de passe
 * 
 * @param String $nom
 * @param String $prenom
 * @param String $telephone
 * @param String $adresse
 * @param String $code postal
 * @param String $ville
 * @param String $email
 * @param String $password
 * @return array envoie les paramètres dans la base de donnée puis retourne un tableau si l'insertion à fonctionné sinon false
 */
function inscription($nom, $prenom, $telephone, $adresse, $cp, $ville, $email, $password): array
{
    try {
        $nom = htmlspecialchars(trim($nom));
        $prenom = htmlspecialchars(trim($prenom));
        $telephone = htmlspecialchars(trim($telephone));
        $adresse = htmlspecialchars(trim($adresse));
        $cp = htmlspecialchars(trim($cp));
        $ville = htmlspecialchars(trim($ville));
        $email = htmlspecialchars(trim($email));

        $password = htmlspecialchars(trim($password));
        $password = password_hash($password, PASSWORD_BCRYPT);

        $monPdo = connexionPDO();

        $req = $monPdo->prepare("INSERT INTO login (mdp, mail) VALUES (:mdp, :mail)");
        $req->bindParam(':mail', $email);
        $req->bindParam(':mdp', $password);
        $req->execute();

        $req = "SELECT MAX(id) AS maxi FROM login";
        $res = $monPdo->query($req);
        $laLigne = $res->fetch();
        $maxi = $laLigne['maxi'];
        $idlog = $maxi;

        $req = $monPdo->prepare("INSERT INTO utilisateur (nom, prenom, telephone, adresse, cp, ville, id_login) VALUES (:nom, :prenom, :telephone, :adresse, :cp, :ville, :id_login)");
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':telephone', $telephone);
        $req->bindParam(':adresse', $adresse);
        $req->bindParam(':cp', $cp);
        $req->bindParam(':ville', $ville);
        $req->bindParam(':id_login', $idlog);
        $req->execute();

        $uneInscription = $req->fetchAll(PDO::FETCH_ASSOC);
        return $uneInscription;
    } catch (\Throwable $e) {
        echo 'Erreur : ' . $e;
    }
}
/**
 * Fonction permettant de connecter l'utilisateur si le mot de passe correspond bien à l'adresse mail
 * 
 * @param String $mail
 * @param String $password
 * @return bool $validate Le booléen correspondant au resultat de la vérification du mot de passe
 */
function connexionCompte(string $mail, string $password): bool
{
    try {
        $monPdo = connexionPDO();
        $req = $monPdo->prepare("select mail, mdp from login where mail=:mail");
        $req->bindParam(':mail', $mail);
        $req->execute();

        $leCompte = $req->fetch(PDO::FETCH_ASSOC);

        if ($leCompte) {
            $validate = password_verify($password, $leCompte['mdp']);
        } else {
            $validate = false;
        }

        return $validate;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
/**
 * Fonction permettant de connecter l'administrateur si le mot de passe correspond bien
 * 
 * @param String $user
 * @param String $password
 * @return bool $validate Le booléen correspondant au resultat de la vérification du mot de passe
 */
function connexionCompteAdministrateur(string $user, string $password): bool
{
    try {
        $monPdo = connexionPDO();
        $req = $monPdo->prepare("select nom, mdp from administrateur where nom=:nom");
        $req->bindParam(':nom', $user);
        $req->execute();
        $leCompte = $req->fetch(PDO::FETCH_ASSOC);
        if ($leCompte) {
            $validate = password_verify($password, $leCompte['mdp']);
        } else {
            $validate = false;
        }
        return $validate;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
