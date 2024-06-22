
<!-- ----- debut Router2 -->
<?php
require ('../controller/controllerAdministrateur.php');
require ('../controller/controllerClient.php');

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
    case "compteReadAll" :
    case "vinReadOne" :
        ControllerAdministrateur::$action();
        break;
        
    case "producteurReadAll" :
        ControllerClient::$action();
        break;

// Tache par défaut
    default:
        $action = "patrimoineAccueil";
        ControllerAdministrateur::$action();
}

?>
<!-- ----- Fin Router2 -->

