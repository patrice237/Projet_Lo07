<?php

class ModelResidence {

    private $id, $label, $ville, $prix, $personne_id;
    
    public function __construct($id=NULL, $label=NULL, $ville=NULL, $prix=NULL, $personne_id=NULL) {
        if(is_null($id)){
        $this->id = $id;
        $this->label = $label;
        $this->ville = $ville;
        $this->prix = $prix;
        $this->personne_id = $personne_id;
    }
    }
    public function getId() {
        return $this->id;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getPrix() {
        return $this->prix;
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

    public function setVille($ville): void {
        $this->ville = $ville;
    }

    public function setPrix($prix): void {
        $this->prix = $prix;
    }

    public function setPersonne_id($personne_id): void {
        $this->personne_id = $personne_id;
    }
    
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

    
     public static function getAllResidence() {
         try {
            $database = Model::getInstance();
            $query =  "   SELECT 
                            p.nom, 
                            p.prenom, 
                            r.label,
                            r.ville,
                            r.prix
                        FROM 
                            personne AS p
                        JOIN 
                            residence AS r
                        ON 
                            p.id = r.personne_id
                        ORDER BY 
                            r.prix ASC
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