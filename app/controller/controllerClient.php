
<!-- ----- debut ControllerVin -->
<?php
 require_once '../model/ModelPersonne.php';
 require_once '../model/ModelCompte.php';
 require_once '../model/ModelResidence.php';

class ControllerClient {
 // --- page d'acceuil
 public static function accueilClient() {
  include 'config.php';
  $vue = $root . '/app/view/viewAccueilClient.php';
  if (DEBUG)
   echo ("ControllerClient : viewAccueilClient : vue = $vue");
  require ($vue);
 }
 
 public static function transfertCompte() {

     $results = ModelCompte::getAllClient($_SESSION['id']);
          include 'config.php';
     $vue = $root . '/app/view/Client/viewFormTransfert.php';
     require ($vue);
     
     
 }
 
 public static function ReadResidence() {
  $results = ModelResidence::getResidence();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/Client/viewReadResidence.php';
  if (DEBUG)
   echo ("ControllerClient : BilanAll : vue = $vue");
  require ($vue);
 }
 public static function buyResidence() {
  $residence_id = $_GET['id'];
  $results = ModelResidence::getbuy($residence_id);
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/Client/viewbuyResidence.php';
  if (DEBUG)
   echo ("ControllerClient : BilanAll : vue = $vue");
  require ($vue);
 }
  public static function validationPaye() {
     
  $results = ModelResidence::insert(
      htmlspecialchars($_GET['compte_a']??''), htmlspecialchars($_GET['compte_v']??''), htmlspecialchars($_GET['prix'])
  );
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/Client/viewValidationPaye.php';
  require ($vue);
     
 }

 // --- Liste des vins
 public static function compteReadAllC() {

  $results = ModelCompte::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/Client/viewCompteReadAll.php';
  if (DEBUG)
   echo ("ControllerClient : compteReadAll : vue = $vue");
  require ($vue);
 }
 public static function ResidenceReadAll() {
  $results = ModelResidence::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/Client/viewResidenceReadAll.php';
  if (DEBUG)
   echo ("ControllerClient : ResidenceReadAllC : vue = $vue");
  require ($vue);
 }
 
public static function transfertcontrol() {
    if (!isset($_GET['source_account'], $_GET['destination_account'], $_GET['montant'])) {
        // Redirection en cas de données manquantes
        include 'config.php';
        $vue = $root . '/app/view/Client/viewCompteErreur.php';
        require($vue);
    } elseif ($_GET['source_account'] == $_GET['destination_account']) {
        // Redirection en cas de comptes identiques
        include 'config.php';
        $vue = $root . '/app/view/Client/viewSameAccount.php';
        require($vue);
    } else {
        $sourceAccountId = $_GET['source_account'];
        $destinationAccountId = $_GET['destination_account'];
        $montant = floatval($_GET['montant']);
        
        $sourceAccount = ModelCompte::getById($sourceAccountId);
        $destinationAccount = ModelCompte::getById($destinationAccountId);

        // Effectuer le transfert
        $sourceAccount['montant'] -= $montant;
        $destinationAccount['montant'] += $montant;

        ModelCompte::update($sourceAccount['id'], $sourceAccount['montant']);
        ModelCompte::update($destinationAccount['id'], $destinationAccount['montant']);

        // Passer les informations des comptes à la vue de succès
        include 'config.php';
        $vue = $root . '/app/view/Client/viewSuccess.php';
        $sourceAccountDetails = $sourceAccount;
        $destinationAccountDetails = $destinationAccount;
        require($vue);
    }
}



 public static function compteAdd() { 
  $results = ModelCompte::getBanque();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/Client/viewCompteAdd.php';
  require ($vue);
 }

 public static function compteAdded() {
     
  
   $results = ModelCompte::insert(
      htmlspecialchars($_GET['label']), htmlspecialchars($_GET['montant']), htmlspecialchars($_GET['banque'])
  );
   
  include 'config.php';
  
  $vue = $root . '/app/view/Client/viewCompteAdded.php';
  require ($vue);
 }

 // Affiche un vin particulier (id)
 public static function ReadAllCompteBanque() {
  $banque_label = $_GET['label'];
  $results = ModelBanque::getOne($banque_label);
  // ----- Construction chemin de la vue
  
  include 'config.php';
  $vue = $root . '/app/view/Administrateur/viewAllCompteBanque.php';
  require ($vue);
 }

 public static function BilanAll() {
  $results = ModelResidence::getBilanAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/Client/viewBilanAll.php';
  if (DEBUG)
   echo ("ControllerClient : BilanAll : vue = $vue");
  require ($vue);
 }
 

 
}
?>
<!-- ----- fin ControllerVin -->


