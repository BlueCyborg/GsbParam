<?php
require_once("../modele/bd.inc.php");

/**
 * Retourne toutes les catégories sous forme d'un tableau associatif
 *
 * @return array $lesLignes le tableau associatif des catégories 
 */
function getLesProduitsDeCategorie()
{
    try {
        $monPdo = connexionPDO();
        $req = 'select id, description from produit where idCategorie = "CH" ';
        $res = $monPdo->query($req);
        $lesLignes = $res->fetchAll(PDO::FETCH_ASSOC);
        return $lesLignes;
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
var_dump(getLesProduitsDeCategorie());
echo '<br>';
print_r(getLesProduitsDeCategorie()[0]);
echo '<br>';
print_r(getLesProduitsDeCategorie()[0]['description']);