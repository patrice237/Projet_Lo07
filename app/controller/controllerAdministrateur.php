
<!-- ----- debut ControllerVin -->
<?php
require_once '../model/ModelBanque.php';
require_once '../model/ModelPersonne.php';
require_once '../model/ModelCompte.php';
require_once '../model/ModelResidence.php';

class ControllerAdministrateur {
 
    
   // --- page d'acceuil
 public static function patrimoineAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewPatrimoineAccueil.php';
  if (DEBUG)
   echo ("ControllerAdministrateur : patrimoineAccueil : vue = $vue");
  require ($vue);
 }
  
  public static function banqueReadAll() {
  $results = ModelBanque::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/Administrateur/viewbanqueReadAll.php';
  if (DEBUG)
   echo ("ControllerAdministrateur : banqueReadAll : vue = $vue");
  require ($vue);
 }
    
 // --- Liste des clients
 public static function clientReadAll() {
  $results = ModelPersonne::getAllClient();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/Administrateur/viewAllPersonne.php';
  if (DEBUG)
   echo ("ControllerAdministrateur : clientReadAll : vue = $vue");
  require ($vue);
 }
 
 public static function administrateurReadAll() {
  $results = ModelPersonne::getAllAdmin();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/Administrateur/viewAllPersonne.php';
  if (DEBUG)
   echo ("ControllerAdministrateur : administrateurReadAll : vue = $vue");
  require ($vue);
 }
 
 public static function compteReadAll() {
   $results = ModelCompte::getAllCompte();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/Administrateur/viewAllCompte.php';
  if (DEBUG)
   echo ("ControllerAdministrateur : compteReadAll : vue = $vue");
  require ($vue);
     
 }
  public static function ReadBanque() {
     

  $results = ModelBanque::getAllBanque();

  include 'config.php';
  
  $vue = $root . '/app/view/Administrateur/viewAllBanque.php';
  require ($vue);
  
 }
  public static function ReadAllCompteBanque() {
  $banque_label = $_GET['label'];
  $results = ModelBanque::getOne($banque_label);
  // ----- Construction chemin de la vue
  
  include 'config.php';
  $vue = $root . '/app/view/Administrateur/viewAllCompteBanque.php';
  require ($vue);
 }

  public static function residenceReadAll() {
      
   $results = ModelResidence::getAllResidence();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/Administrateur/viewAllResidence.php';
  if (DEBUG)
   echo ("ControllerAdministrateur : residenceReadAllResidence : vue = $vue");
  require ($vue);                   
     
 }

 // Affiche le formulaire de creation d'un vin
 public static function banqueAdd() {
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/Administrateur/viewInsert.php';
  require ($vue);
 }

 // Affiche un formulaire pour récupérer les informations d'un nouveau vin.
 // La clé est gérée par le systeme et pas par l'internaute
 
public static function banqueCreated() {
  // Ajouter une validation des informations du formulaire
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

    // Construction du chemin de la vue
    include 'config.php';
    $vue = $root . '/app/view/Administrateur/viewInserted.php';
    require($vue);
  }
}



 
}
?>
<!-- ----- fin ControllerVin -->


