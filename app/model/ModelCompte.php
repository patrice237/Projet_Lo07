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