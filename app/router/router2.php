
<!-- ----- debut Router2 -->
<?php
require ('../controller/controllerClient.php');
require ('../controller/controllerAdministrateur.php');

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
    case "ReadBanque" :
    case "ReadAllCompteBanque" : 
        ControllerAdministrateur::$action();
        break;
        
    case "compteReadAll" :
    case "compteAdd" :
    case "compteAdded" :
    case "ResidenceReadAll" :
    case "BilanAll" :
    case "ReadResidence":
    case "buyResidence":
    case "validationPaye":
        ControllerClient::$action();
        break;

// Tache par défaut
    default:
        $action = "AccueilClient";
        ControllerClient::$action();  //$action = "patrimoineAccueil"; choisir ControllerAdministrateur::$action();
}               //$action = "viewAccueilClient"; ControllerClient::$action();

?>
<!-- ----- Fin Router2 -->

