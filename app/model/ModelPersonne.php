
<!-- ----- debut ModelVin -->

<?php
require_once 'Model.php';

class ModelPersonne {
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
 

 public static function getMany($query) {
  try {
   $database = Model::getInstance();
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelVin");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getOne($label) {
  try {
   $database = Model::getInstance();
   $query = "SELECT p.prenom,p.nom,b.label,c.label as lb,c.montant FROM `personne` as p, "
           . "`compte` as c, `banque` as b  WHERE c.banque_id=b.id AND p.id=c.personne_id AND b.label= :label";
   $statement = $database->prepare($query);
   $statement->execute([
     'label' => $label
   ]);
   
    $results1 = $statement->fetchAll(PDO::FETCH_ASSOC);
    $nom=$label;
   
   $results = [
        'compte' => $results1,
        'namebank' => $nom
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
