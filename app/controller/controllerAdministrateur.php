<!-- ----- debut ControllerAdministrateur -->
<?php
require_once '../model/ModelBanque.php';
require_once '../model/ModelPersonne.php';
require_once '../model/ModelCompte.php';
require_once '../model/ModelResidence.php';

class ControllerAdministrateur {
    
    // Page d'accueil
    public static function patrimoineAccueil() {
        include 'config.php';
        $vue = $root . '/app/view/viewPatrimoineAccueil.php';
        if (DEBUG) {
            echo ("ControllerAdministrateur : patrimoineAccueil : vue = $vue");
        }
        require($vue);
    }

    // Afficher toutes les banques
    public static function banqueReadAll() {
        $results = ModelBanque::getAll();
        include 'config.php';
        $vue = $root . '/app/view/Administrateur/viewbanqueReadAll.php';
        if (DEBUG) {
            echo ("ControllerAdministrateur : banqueReadAll : vue = $vue");
        }
        require($vue);
    }
    
    // Afficher la liste de tous les clients
    public static function clientReadAll() {
        $results = ModelPersonne::getAllClient();
        include 'config.php';
        $vue = $root . '/app/view/Administrateur/viewAllPersonne.php';
        if (DEBUG) {
            echo ("ControllerAdministrateur : clientReadAll : vue = $vue");
        }
        require($vue);
    }

    // Afficher la liste de tous les administrateurs
    public static function administrateurReadAll() {
        $results = ModelPersonne::getAllAdmin();
        include 'config.php';
        $vue = $root . '/app/view/Administrateur/viewAllPersonne.php';
        if (DEBUG) {
            echo ("ControllerAdministrateur : administrateurReadAll : vue = $vue");
        }
        require($vue);
    }

    // Afficher la liste de tous les comptes
    public static function compteReadAll() {
        $results = ModelCompte::getAllCompte();
        include 'config.php';
        $vue = $root . '/app/view/Administrateur/viewAllCompte.php';
        if (DEBUG) {
            echo ("ControllerAdministrateur : compteReadAll : vue = $vue");
        }
        require($vue);
    }

    // Afficher toutes les banques (alternative)
    public static function ReadBanque() {
        $results = ModelBanque::getAllBanque();
        include 'config.php';
        $vue = $root . '/app/view/Administrateur/viewAllBanque.php';
        require($vue);
    }

    // Afficher tous les comptes d'une banque spécifique
    public static function ReadAllCompteBanque() {
        $banque_label = $_GET['label'];
        $results = ModelBanque::getOne($banque_label);
        include 'config.php';
        $vue = $root . '/app/view/Administrateur/viewAllCompteBanque.php';
        require($vue);
    }

    // Afficher la liste de toutes les résidences
    public static function residenceReadAll() {
        $results = ModelResidence::getAllResidence();
        include 'config.php';
        $vue = $root . '/app/view/Administrateur/viewAllResidence.php';
        if (DEBUG) {
            echo ("ControllerAdministrateur : residenceReadAll : vue = $vue");
        }
        require($vue);
    }

    // Afficher le formulaire d'ajout de banque
    public static function banqueAdd() {
        include 'config.php';
        $vue = $root . '/app/view/Administrateur/viewInsert.php';
        require($vue);
    }

    // Ajouter une nouvelle banque
    public static function banqueCreated() {
        $labelBanque = htmlspecialchars($_GET['labelBanque']);
        $pays = htmlspecialchars($_GET['pays']);

        if (empty($labelBanque) || empty($pays)) {
            // Rediriger vers une page d'erreur si l'un des champs est vide
            include 'config.php';
            $vue = $root . '/app/view/Administrateur/viewError.php'; // Assurez-vous d'avoir une vue d'erreur à cet emplacement
            require($vue);
        } else {
            // Insertion des données si les champs ne sont pas vides
            $results = ModelBanque::insert($labelBanque, $pays);
            include 'config.php';
            $vue = $root . '/app/view/Administrateur/viewInserted.php';
            require($vue);
        }
    }
}
?>
<!-- ----- fin ControllerAdministrateur -->
