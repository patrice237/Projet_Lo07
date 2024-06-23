
<!-- ----- debut ModelVin -->

<?php
require_once 'Model.php';

class ModelBanque {
 private $id, $label, $pays;

 // pas possible d'avoir 2 constructeurs
 public function __construct($id = NULL, $label = NULL, $pays = NULL) {
  // valeurs nulles si pas de passage de parametres
  if (!is_null($id)) {
   $this->id = $id;
   $this->label = $label;
   $this->pays = $pays;

  }
 }

 public function getId() {
     return $this->id;
 }

 public function getLabel() {
     return $this->label;
 }

 public function getPays() {
     return $this->pays;
 }

 public function setId($id): void {
     $this->id = $id;
 }

 public function setLabel($label): void {
     $this->label = $label;
 }

 public function setPays($pays): void {
     $this->pays = $pays;
 }


 
 public static function getAll() {
  try {
   $database = Model::getInstance();
   $query = "select * from banque";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelBanque");
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
 
  public static function getAllBanque() {
  try {
   $database = Model::getInstance();
   $query = "select label from banque";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }


 public static function insert($label, $pays) {
  try {
   $database = Model::getInstance();

   // recherche de la valeur de la clé = max(id) + 1
   $query = "select max(id) from banque";
   $statement = $database->query($query);
   $tuple = $statement->fetch();
   $id = $tuple['0'];
   $id++;

   // ajout d'un nouveau tuple;
   $query = "insert into banque value (:id, :label, :pays)";
   $statement = $database->prepare($query);
   $statement->execute([
     'id' => $id,
     'label' => $label,
     'pays' => $pays,
   ]);
   return $id;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

}

?>
<!-- ----- fin ModelVin -->
