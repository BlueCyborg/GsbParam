<?php
require_once("../modele/bd.inc.php");

/**
 * Retourne toutes les catégories sous forme d'un tableau associatif
 *
 * @return array $lesLignes le tableau associatif des catégories 
 */
function getLesCategories()
{
    try {
        $monPdo = connexionPDO();
        $req = 'SELECT id, libelle FROM categorie';
        $res = $monPdo->query($req);
        $lesLignes = $res->fetchAll(PDO::FETCH_ASSOC);
        return $lesLignes;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
var_dump(getLesCategories());
echo '<br>';
print_r(getLesCategories()[0]);
echo '<br>';
print_r(getLesCategories()[0]['id']);