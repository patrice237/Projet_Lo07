<?php

class ModelCompte{
    private $id, $label, $montant, $banque_id, $personne_id;
    
    public function __construct($id=NULL, $label=NULL, $montant=NULL, $banque_id=null, $personne_id=NULL) {
       
        if(!is_null($id)){
        $this->id = $id;
        $this->label = $label;
        $this->montant = $montant;
        $this->banque_id = $banque_id;
        $this->personne_id = $personne_id;
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getMontant() {
        return $this->montant;
    }

    public function getBanque_id() {
        return $this->banque_id;
    }

    public function getPersonne_id() {
        return $this->personne_id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setLabel($label): void {
        $this->label = $label;
    }

    public function setMontant($montant): void {
        $this->montant = $montant;
    }

    public function setBanque_id($banque_id): void {
        $this->banque_id = $banque_id;
    }

    public function setPersonne_id($personne_id): void {
        $this->personne_id = $personne_id;
    }

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
     public static function getAllCompte() {
         try {
            $database = Model::getInstance();
            $query =  "SELECT 
            p.nom, 
            p.prenom, 
            b.label AS banque_label, 
            b.pays, 
            c.label AS compte_label, 
            c.montant 
        FROM 
            compte AS c 
        JOIN 
            banque AS b 
        ON 
            c.banque_id = b.id 
        JOIN 
            personne AS p 
        ON 
            c.personne_id = p.id
            ";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
           }
        
        
    }
    
    
}



?>