<?php

require_once 'Model.php';

class ModelResidence {
    private $id, $label, $ville, $prix, $personne_id;
    
    public function __construct($id=NULL, $label=NULL, $ville=NULL, $prix=NULL, $personne_id=NULL) {
        // Initialisation des propriétés seulement si $id est NULL
        if(is_null($id)){
            $this->id = $id;
            $this->label = $label;
            $this->ville = $ville;
            $this->prix = $prix;
            $this->personne_id = $personne_id;
        }
    }
    
    // Getters
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

    // Setters
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
    
    // Récupérer toutes les résidences associées à l'utilisateur actuel
    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "SELECT p.prenom,p.nom,r.label,r.ville  
                      FROM personne as p, residence as r 
                      WHERE p.id=r.personne_id AND p.id= :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $_SESSION['id']
            ]);
            
            $results = $statement->fetchAll();
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    // Récupérer les résidences n'appartenant pas à l'utilisateur actuel
    public static function getResidence() {
        try {
            $database = Model::getInstance();
            $query = "SELECT id,label FROM residence WHERE personne_id != :id;"; //remplacer 1007 par l'id personne du client
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $_SESSION['id']
            ]);
            
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
 
    // Obtenir le bilan de l'utilisateur actuel
    public static function getBilanAll() {
        try {
            $database = Model::getInstance();
            $query1 = "SELECT c.label,c.montant  FROM personne as p, compte as c WHERE p.id=c.personne_id AND p.id= :id";
            $statement1 = $database->prepare($query1);
            $statement1->execute([
                'id' => $_SESSION['id']
            ]);
            $results1 = $statement1->fetchAll();

            $query2 = "SELECT r.label,r.prix  FROM personne as p, residence as r WHERE p.id=r.personne_id AND p.id= :id";
            $statement2 = $database->prepare($query2);
            $statement2->execute([
                'id' => $_SESSION['id']
            ]);
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

    // Récupérer toutes les résidences avec les informations du propriétaire
    public static function getAllResidence() {
        try {
            $database = Model::getInstance();
            $query = "SELECT p.nom, p.prenom, r.label, r.ville, r.prix
                      FROM personne AS p
                      JOIN residence AS r
                      ON p.id = r.personne_id
                      ORDER BY r.prix ASC";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // Récupérer les informations d'achat pour une résidence donnée
    public static function getbuy($residence_id) {
        try {
            $database = Model::getInstance();
            
            $query0 = "SELECT personne_id FROM residence WHERE id = :id;"; //remplacer 1007 par l'id personne du client
            $statement0 = $database->prepare($query0);
            $statement0->execute([
                'id' => $residence_id
            ]);
            $results0 = $statement0->fetch(PDO::FETCH_ASSOC);
            
            $query1 = "SELECT c.label as a, c.personne_id as id_a  FROM compte as c WHERE c.personne_id= :id;"; //remplacer 1007 par l'id personne du client
            $statement1 = $database->prepare($query1);
            $statement1->execute([
                'id' => $_SESSION['id']
            ]);
            $results1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
            
            $query2 = "SELECT c.label as v, c.personne_id as id_v  FROM compte as c WHERE c.personne_id= :id;"; //remplacer 1007 par l'id personne du client
            $statement2 = $database->prepare($query2);
            $statement2->execute([
                'id' => $results0['personne_id']
            ]);
            $results2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
            
            $query3 = "SELECT prix FROM residence WHERE id= :id;"; //remplacer 1007 par l'id personne du client
            $statement3 = $database->prepare($query3);
            $statement3->execute([
                'id' => $residence_id
            ]);
            $results3 = $statement3->fetch(PDO::FETCH_ASSOC);
            
            $results = [
                'acheteur' => $results1,
                'vendeur' => $results2,
                'prix' => $results3['prix']
            ];
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // Effectuer une transaction d'achat de résidence
    public static function insert($compte_a, $compte_v, $prix) {
        try {
            $database = Model::getInstance();
            
            $id_a=$_SESSION['id_a'];
            
            $id_v=$_SESSION['id_v'];
            
            /* echo $id_a;
            echo $id_v;
            echo $compte_a;
            echo $compte_v;
            echo $prix; */
            
            if ($id_a=='' || $id_v=='' || $compte_a=='' || $compte_v=='') {
                return -1;
            } else {
                $Query = "UPDATE compte SET montant = montant - :prix WHERE personne_id = :personne_id AND label= :label;";
                $Statement = $database->prepare($Query);
                $Statement->execute([
                    'prix' => $prix,
                    'personne_id' => $id_a,
                    'label' => $compte_a
                ]);
                
                $Query1 = "UPDATE compte SET montant = montant + :prix WHERE personne_id = :personne_id AND label= :label;";
                $Statement1 = $database->prepare($Query1);
                $Statement1->execute([
                    'prix' => $prix,
                    'personne_id' => $id_v,
                    'label' => $compte_v
                ]);
                
                $Query2="UPDATE residence SET personne_id = :nouveau_personne_id WHERE personne_id = :ancien_personne_id AND "
                        . "prix = :prix;";
                $Statement2 = $database->prepare($Query2);
                $Statement2->execute([
                    'nouveau_personne_id' => $id_a,
                    'ancien_personne_id' => $id_v,
                    'prix' => $prix
                ]);
                return 1;
            }
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
}

?>
