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
    $login = 'root';
    $mdp = '';
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

        $req = $monPdo->prepare("select nom, prenom, telephone, adresse, cp, ville from utilisateur where mail = :mail");
        $req->bindParam(':mail', $mail);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
function inscription($nomI, $prenomI, $telephoneI, $adresseI, $cpI, $villeI, $emailI, $passwordI)
{
    try {
        $nom = htmlspecialchars(trim($nomI));
        $prenom = htmlspecialchars(trim($prenomI));
        $telephone = htmlspecialchars(trim($telephoneI));
        $adresse = htmlspecialchars(trim($adresseI));
        $cp = htmlspecialchars(trim($cpI));
        $ville = htmlspecialchars(trim($villeI));
        $email = htmlspecialchars(trim($emailI));
        $password = htmlspecialchars(trim($passwordI));

        $password = password_hash($password, PASSWORD_BCRYPT);
        $monPdo = connexionPDO();
        $req = $monPdo->prepare("INSERT INTO `utilisateur` (`mail`, `mdp`, `nom`, `prenom`, `telephone`, `adresse`, `cp`, `ville`) VALUES (:mail, :mdp, :nom, :prenom, :telephone, :adresse, :cp, :ville)");
        $req->bindParam(':mail', $email);
        $req->bindParam(':mdp', $password);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':telephone', $telephone);
        $req->bindParam(':adresse', $adresse);
        $req->bindParam(':cp', $cp);
        $req->bindParam(':ville', $ville);
        $req->execute();
        $uneInscription = $req->fetchAll(PDO::FETCH_ASSOC);
        return $uneInscription;
    } catch (\Throwable $e) {
        echo 'Erreur : ' . $e;
    }
}
function connexionCompte(string $mail, string $password): bool
{
    try {
        $monPdo = connexionPDO();
        $req = $monPdo->prepare("select mail, mdp from utilisateur where mail=:mail");
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
