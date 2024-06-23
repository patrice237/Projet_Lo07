
<!-- ----- debut ModelVin -->

<?php
require_once 'Model.php';

class ModelResidence {
 private $id, $nom, $prenom;

 // pas possible d'avoir 2 constructeurs
 public function __construct($id = NULL, $nom = NULL, $prenom = NULL) {
  // valeurs nulles si pas de passage de parametres
  if (!is_null($id)) {
   $this->id = $id;
   $this->nom = $nom;
   $this->prenom = $prenom;
  }
 }

 function setId($id) {
  $this->id = $id;
 }

 function setNom($nom) {
  $this->label = $label;
 }

 function setPrenom($pays) {
  $this->pays = $pays;
 }

 function getId() {
  return $this->id;
 }

 function getNom() {
  return $this->label;
 }

 function getPrenom() {
  return $this->pays;
 }
 
 
// retourne une liste des id
 public static function getAll() {
  try {
   $database = Model::getInstance();
   $query = "SELECT p.prenom,p.nom,r.label,r.ville  FROM `personne` as p, `residence` as r WHERE p.id=r.personne_id";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll();
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }


 public static function getBilanAll() {
  try {
   $database = Model::getInstance();
   $query1 = "SELECT c.label,c.montant  FROM `personne` as p, `compte` as c WHERE p.id=c.personne_id";
   $statement1 = $database->prepare($query1);
   $statement1->execute();
   $results1 = $statement1->fetchAll();
   
   $query2 = "SELECT r.label,r.prix  FROM `personne` as p, `residence` as r WHERE p.id=r.personne_id";
   $statement2 = $database->prepare($query2);
   $statement2->execute();
   $results2 = $statement2->fetchAll();
   
   $results = [
        'compte' => $results1,
        'residence' => $results2
    ];
    return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 

 public static function update() {
  echo ("ModelVin : update() TODO ....");
  return null;
 }

 public static function delete() {
  echo ("ModelVin : delete() TODO ....");
  return null;
 }

}
?>
<!-- ----- fin ModelVin -->
