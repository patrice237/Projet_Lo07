
<!-- ----- debut Router2 -->
<?php
require ('../controller/ControllerVin.php');
require ('../controller/ControllerProducteur.php');
require ('../controller/ControllerRecolte.php');

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
    case "vinReadAll" :
    case "vinReadOne" :
    case "vinReadId" :
    case "vinCreate" :
    case "vinCreated" :
    case "vinDeleted":
        ControllerVin::$action($args);
        break;
        
    case "producteurReadAll" :
    case "producteurReadId" :
    case "producteurReadOne":
    case "producteurCreate" :
    case "producteurCreated":
    case "producteurListe":
    case "producteurParRegion":
     case "producteurDeleted":
        ControllerProducteur::$action($args);
        break;
    
    case "recolteReadAll" :
    case "recolteReadId" :
    case "recolteReadOne":
    case "recolteCreate" :
    case "recolteCreated":
    case "recolteListe":
    case "recolteParRegion":
    case "recolteDeleted":
        ControllerRecolte::$action($args);
        break;

    // Tache par défaut
    default:
        $action = "caveAccueil";
        ControllerVin::$action();
}

?>
<!-- ----- Fin Router1 -->

