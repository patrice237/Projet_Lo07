
<!-- ----- debut ModelVin -->

<?php
require_once 'Model.php';

class ModelCompte {
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
   $query = "SELECT p.prenom,p.nom,c.label  FROM `personne` as p, `compte` as c WHERE p.id=c.personne_id";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll();
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }
 public static function getBanque() {
  try {
   $database = Model::getInstance();
   $query = "select DISTINCT label from banque";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_ASSOC);
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

 public static function insert($label, $montant, $banque) {
  try {
   $database = Model::getInstance();

   // recherche de la valeur de la clé = max(id) + 1
   $query = "select max(id) from compte";
   $statement = $database->query($query);
   $tuple = $statement->fetch();
   $id = $tuple['0'];
   $id++;
  // echo $id."aozj";
   $query = "select id from banque where label= :banque";
   $statement = $database->prepare($query);
   $statement->execute([
     'banque' => $banque
   ]);
   $tuple = $statement->fetch();
   $j = $tuple['0'];
   $j;

   // ajout d'un nouveau tuple;
   $query = "insert into compte values (:id, :label, :montant, :banque, :pers)";
   $statement = $database->prepare($query);
   $statement->execute([
     'id' => $id,
     'label' => $label,
     'montant' => $montant,
     'banque' => $j,
     'pers' => "1001"
   ]);
   return $id;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
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
