<?php
$action = $_REQUEST['action'];
switch ($action) {
    case 'connexion': {
            include("vues/v_connexion.php");
            break;
        }
    case 'deconnexion': {
            # code...
            break;
        }
    case 'inscription': {
            include("vues/v_inscription.php");
            break;
        }
}
