<!-- ----- debut Router2 -->
<?php
// Inclusion des contrôleurs nécessaires
require ('../controller/ControllerAdministrateur.php');
require ('../controller/ControllerClient.php');
require ('../controller/ControllerConnexion.php');

// Récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// La fonction parse_str permet de construire une table de hachage (clé + valeur) à partir de la chaîne de requête
parse_str($query_string, $param);

// $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);
unset($param['action']);  // Suppression de l'action des paramètres pour récupérer les arguments restants

$args = $param;  // Arguments restants de la requête

// Liste des méthodes autorisées pour chaque contrôleur
switch ($action) {
    // Actions pour l'administrateur
    case "banqueReadAll":
    case "ReadBanque":
    case "banqueAdd":
    case "ReadAllCompteBanque":
    case "banqueCreated":
    case "clientReadAll":
    case "administrateurReadAll":
    case "compteReadAll":
    case "residenceReadAll":
    case "patrimoineAccueil":
    case "ameliorationMvc1":
    case "gestion_patrimoine":
        ControllerAdministrateur::$action();
        break;
    
    // Actions pour la connexion
    case "loginForm":
    case "inscriptionForm":
    case "testLogin":
    case "testInscription":
        ControllerConnexion::$action();
        break;

    // Actions pour le client
    case "compteReadAllC":
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
    case "generate_pdf":
    case "ameliorationMvc2":
        ControllerClient::$action();
        break;

    // Action par défaut si aucune action n'est spécifiée
    default:
        $action = "accueil";
        ControllerConnexion::$action();
}

?>
<!-- ----- Fin Router2 -->
