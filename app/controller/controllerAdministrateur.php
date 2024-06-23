
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

 // --- Liste des vins
 public static function clientReadAll() {
  $results = ModelPersonne::getAllClient();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/banque/viewAllPersonne.php';
  if (DEBUG)
   echo ("ControllerAdministrateur : vinReadAllPersonne : vue = $vue");
  require ($vue);
 }
 
 public static function administrateurReadAll() {
  $results = ModelPersonne::getAllAdmin();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/banque/viewAllPersonne.php';
  if (DEBUG)
   echo ("ControllerAdministrateur : vinReadAllPersonne : vue = $vue");
  require ($vue);
 }
 
 public static function compteReadAll() {
   $results = ModelCompte::getAllCompte();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/banque/viewAllCompte.php';
  if (DEBUG)
   echo ("ControllerAdministrateur : vinReadAllCompte : vue = $vue");
  require ($vue);
     
 }

  public static function residenceReadAll() {
   $results = ModelResidence::getAllResidence();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/banque/viewAllResidence.php';
  if (DEBUG)
   echo ("ControllerAdministrateur : residenceReadAllResidence : vue = $vue");
  require ($vue);                   
     
 }
 // Affiche un formulaire pour sélectionner un id qui existe
 public static function vinReadId($args) {
     
  
  // if(DEBUG) echo ("ControllerVin : vinReadId : begin </br>");
  $results = ModelVin::getAllId();

  // ----- Construction chemin de la vue
  
  $target=$args['target'];
   //if(DEBUG) echo ("ControllerVin : vinReadId : target=$target </br>");
   
  include 'config.php';
  
  $vue = $root . '/app/view/vin/viewId.php';
  require ($vue);
 }

 // Affiche un vin particulier (id)
 public static function vinReadOne() {
  $vin_id = $_GET['id'];
  $results = ModelVin::getOne($vin_id);

  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/vin/viewAll.php';
  require ($vue);
 }

 // Affiche le formulaire de creation d'un vin
 public static function banqueAdd() {
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/banque/viewInsert.php';
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
    $vue = $root . '/app/view/banque/viewError.php'; // Assurez-vous d'avoir une vue d'erreur à cet emplacement
    require($vue);
  } else {
    // Insertion des données si les champs ne sont pas vides
    $results = ModelBanque::insert($labelBanque, $pays);

    // Construction du chemin de la vue
    include 'config.php';
    $vue = $root . '/app/view/banque/viewInserted.php';
    require($vue);
  }
}


 public static function vinDeleted() {
     
  $vin_id = $_GET['id'];
  $results = ModelVin::delete($vin_id);

  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/vin/viewDeleted.php';
  require ($vue);
     
 }
 
}
?>
<!-- ----- fin ControllerVin -->


