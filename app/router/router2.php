
<!-- ----- debut Router2 -->
<?php
require ('../controller/ControllerAdministrateur.php');
require ('../controller/ControllerClient.php');

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
        ControllerAdministrateur::$action();
        break;
        
    case "compteReadAllC" :
    case "compteAdd":
    case "compteAdded":
    case "compteTransfert":
    case "ResidenceReadAll":
    case "BilanAll":
        ControllerClient::$action();
        break;

// Tache par défaut
    default:
        $action = "accueilClient";
        ControllerClient::$action();
}

?>
<!-- ----- Fin Router2 -->

