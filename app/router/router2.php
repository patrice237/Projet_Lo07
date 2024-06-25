
<!-- ----- debut Router2 -->
<?php
require ('../controller/ControllerAdministrateur.php');
require ('../controller/ControllerClient.php');
require ('../controller/ControllerConnexion.php');

// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur) 
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);

$action=$param['action'];

unset($param['action']);

$args=$param;

// --- Liste des méthodes autorisées
switch ($action) {
    case "banqueReadAll" :
    case "ReadBanque":
    case "banqueAdd" :
    case "ReadAllCompteBanque":
    case "banqueCreated":
    case "clientReadAll":
    case "administrateurReadAll":
    case "compteReadAll":
    case "residenceReadAll":
    case "patrimoineAccueil":
        ControllerAdministrateur::$action();
        break;
    case "loginForm":
    case "inscriptionForm":
    case "testLogin":
    case "testInscription":
        controllerConnexion::$action();
        break;
    case "compteReadAllC" :
    case "compteAdd":
    case "compteAdded":
    case "compteTransfert":
    case "ResidenceReadAll":
    case "BilanAll":
    case "transfertCompte":
    case "transfertcontrol":
    case "ReadResidence":
    case "buyResidence":
    case "validationPaye":
    case "accueilClient":
        ControllerClient::$action();
        break;

// Tache par défaut
    default:
        $action = "accueil";
        controllerConnexion::$action();
}

?>
<!-- ----- Fin Router2 -->

