
<!-- ----- debut ControllerVin -->
<?php
 require_once '../model/ModelPersonne.php';
 require_once '../model/ModelCompte.php';
 require_once '../model/ModelResidence.php';

class ControllerClient {
 // --- page d'acceuil
 public static function AccueilClient() {
  include 'config.php';
  $vue = $root . '/app/view/viewAccueilClient.php';
  if (DEBUG)
   echo ("ControllerClient : AccueilClient : vue = $vue");
  require ($vue);
 }

 // --- Liste des vins
 public static function compteReadAll() {
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
   echo ("ControllerClient : ResidenceReadAll : vue = $vue");
  require ($vue);
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
 
}
?>
<!-- ----- fin ControllerVin -->


