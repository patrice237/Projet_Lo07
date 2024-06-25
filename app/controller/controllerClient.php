<!-- ----- debut ControllerClient -->
<?php
require_once '../model/ModelPersonne.php';
require_once '../model/ModelCompte.php';
require_once '../model/ModelResidence.php';

class ControllerClient {
    
    // Page d'accueil pour les clients
    public static function accueilClient() {
        include 'config.php';
        $vue = $root . '/app/view/viewAccueilClient.php';
        if (DEBUG) {
            echo ("ControllerClient : viewAccueilClient : vue = $vue");
        }
        require($vue);
    }

    // Afficher le formulaire de transfert de compte
    public static function transfertCompte() {
        $results = ModelCompte::getAllClient($_SESSION['id']);
        include 'config.php';
        $vue = $root . '/app/view/Client/viewFormTransfert.php';
        require($vue);
    }

    // Lire toutes les résidences disponibles
    public static function ReadResidence() {
        $results = ModelResidence::getResidence();
        include 'config.php';
        $vue = $root . '/app/view/Client/viewReadResidence.php';
        if (DEBUG) {
            echo ("ControllerClient : ReadResidence : vue = $vue");
        }
        require($vue);
    }

    // Acheter une résidence
    public static function buyResidence() {
        $residence_id = $_GET['id'];
        $results = ModelResidence::getbuy($residence_id);
        include 'config.php';
        $vue = $root . '/app/view/Client/viewbuyResidence.php';
        if (DEBUG) {
            echo ("ControllerClient : buyResidence : vue = $vue");
        }
        require($vue);
    }

    // Validation du paiement pour l'achat de résidence
    public static function validationPaye() {
        $results = ModelResidence::insert(
            htmlspecialchars($_GET['compte_a'] ?? ''),
            htmlspecialchars($_GET['compte_v'] ?? ''),
            htmlspecialchars($_GET['prix'])
        );
        include 'config.php';
        $vue = $root . '/app/view/Client/viewValidationPaye.php';
        require($vue);
    }

    // Générer un PDF
    public static function generate_pdf() {
        $vue = '../model/generate_pdf.php';
        require($vue);
    }

    // Lire tous les comptes
    public static function compteReadAllC() {
        $results = ModelCompte::getAll();
        include 'config.php';
        $vue = $root . '/app/view/Client/viewCompteReadAll.php';
        if (DEBUG) {
            echo ("ControllerClient : compteReadAllC : vue = $vue");
        }
        require($vue);
    }

    // Lire toutes les résidences
    public static function ResidenceReadAll() {
        $results = ModelResidence::getAll();
        include 'config.php';
        $vue = $root . '/app/view/Client/viewResidenceReadAll.php';
        if (DEBUG) {
            echo ("ControllerClient : ResidenceReadAll : vue = $vue");
        }
        require($vue);
    }

    // Contrôle et exécution du transfert de fonds entre comptes
    public static function transfertcontrol() {
        if (!isset($_GET['source_account'], $_GET['destination_account'], $_GET['montant'])) {
            include 'config.php';
            $vue = $root . '/app/view/Client/viewCompteErreur.php';
            require($vue);
        } elseif ($_GET['source_account'] == $_GET['destination_account']) {
            include 'config.php';
            $vue = $root . '/app/view/Client/viewSameAccount.php';
            require($vue);
        } else {
            $sourceAccountId = $_GET['source_account'];
            $destinationAccountId = $_GET['destination_account'];
            $montant = floatval($_GET['montant']);
            
            $sourceAccount = ModelCompte::getById($sourceAccountId);
            $destinationAccount = ModelCompte::getById($destinationAccountId);

            $sourceAccount['montant'] -= $montant;
            $destinationAccount['montant'] += $montant;

            ModelCompte::update($sourceAccount['id'], $sourceAccount['montant']);
            ModelCompte::update($destinationAccount['id'], $destinationAccount['montant']);

            include 'config.php';
            $vue = $root . '/app/view/Client/viewSuccess.php';
            $sourceAccountDetails = $sourceAccount;
            $destinationAccountDetails = $destinationAccount;
            require($vue);
        }
    }

    // Afficher le formulaire pour ajouter un compte
    public static function compteAdd() {
        $results = ModelCompte::getBanque();
        include 'config.php';
        $vue = $root . '/app/view/Client/viewCompteAdd.php';
        require($vue);
    }

    // Ajouter un nouveau compte
    public static function compteAdded() {
        $results = ModelCompte::insert(
            htmlspecialchars($_GET['label']),
            htmlspecialchars($_GET['montant']),
            htmlspecialchars($_GET['banque'])
        );
        include 'config.php';
        $vue = $root . '/app/view/Client/viewCompteAdded.php';
        require($vue);
    }

    // Lire tous les comptes d'une banque spécifique
    public static function ReadAllCompteBanque() {
        $banque_label = $_GET['label'];
        $results = ModelBanque::getOne($banque_label);
        include 'config.php';
        $vue = $root . '/app/view/Administrateur/viewAllCompteBanque.php';
        require($vue);
    }

    // Afficher le bilan de toutes les résidences
    public static function BilanAll() {
        $results = ModelResidence::getBilanAll();
        include 'config.php';
        $vue = $root . '/app/view/Client/viewBilanAll.php';
        if (DEBUG) {
            echo ("ControllerClient : BilanAll : vue = $vue");
        }
        require($vue);
    }
}
?>
<!-- ----- fin ControllerClient -->
