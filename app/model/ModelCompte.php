<?php

require_once 'Model.php';

class ModelCompte {
    private $id, $label, $montant, $banque_id, $personne_id;

    // Constructeur avec des valeurs par défaut
    public function __construct($id = NULL, $label = NULL, $montant = NULL, $banque_id = NULL, $personne_id = NULL) {
        if (!is_null($id)) {
            $this->id = $id;
            $this->label = $label;
            $this->montant = $montant;
            $this->banque_id = $banque_id;
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

    public function getMontant() {
        return $this->montant;
    }

    public function getBanqueId() {
        return $this->banque_id;
    }

    public function getPersonneId() {
        return $this->personne_id;
    }

    // Setters
    public function setId($id): void {
        $this->id = $id;
    }

    public function setLabel($label): void {
        $this->label = $label;
    }

    public function setMontant($montant): void {
        $this->montant = $montant;
    }

    public function setBanqueId($banque_id): void {
        $this->banque_id = $banque_id;
    }

    public function setPersonneId($personne_id): void {
        $this->personne_id = $personne_id;
    }

    // Récupérer tous les comptes de l'utilisateur actuel
    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "SELECT p.prenom, p.nom, c.label 
                      FROM personne AS p, compte AS c 
                      WHERE c.personne_id = p.id AND personne_id = :id";
            $statement = $database->prepare($query);
            $statement->execute(['id' => $_SESSION['id']]);
            $results = $statement->fetchAll();
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // Récupérer tous les comptes d'un client spécifique
    public static function getAllClient($id_client) {
        try {
            $database = Model::getInstance();
            $query = "SELECT c.id, p.prenom, p.nom, c.label, c.montant 
                      FROM personne AS p, compte AS c 
                      WHERE p.id = c.personne_id AND p.id = :id_client";
            $statement = $database->prepare($query);
            $statement->execute(['id_client' => $id_client]);
            $results = $statement->fetchAll();
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // Récupérer tous les labels des banques distincts
    public static function getBanque() {
        try {
            $database = Model::getInstance();
            $query = "SELECT DISTINCT label FROM banque";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // Récupérer un compte par son id
    public static function getById($id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM compte WHERE id = :id";
            $stmt = $database->prepare($query);
            $stmt->execute(['id' => $id]);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $compte = $stmt->fetch();
            return $compte;
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
            return null;
        }
    }

    // Mettre à jour le montant d'un compte
    public static function update($id, $montant) {
        try {
            $pdo = Model::getInstance();
            $stmt = $pdo->prepare('UPDATE compte SET montant = :montant WHERE id = :id');
            $stmt->execute(['id' => $id, 'montant' => (float)$montant]);
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    // Récupérer les comptes d'une banque spécifique
    public static function getOne($label) {
        try {
            $database = Model::getInstance();
            $query = "SELECT p.prenom, p.nom, b.label, c.label as lb, c.montant 
                      FROM personne AS p, compte AS c, banque AS b  
                      WHERE c.banque_id = b.id AND p.id = c.personne_id AND b.label = :label";
            $statement = $database->prepare($query);
            $statement->execute(['label' => $label]);
            $results1 = $statement->fetchAll(PDO::FETCH_ASSOC);
            return ['compte' => $results1, 'namebank' => $label];
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // Insérer un nouveau compte
    public static function insert($label, $montant, $banque) {
        try {
            $database = Model::getInstance();

            // Recherche de la valeur de la clé = max(id) + 1
            $query = "SELECT max(id) FROM compte";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'] + 1;

            // Récupération de l'id de la banque
            $query = "SELECT id FROM banque WHERE label = :banque";
            $statement = $database->prepare($query);
            $statement->execute(['banque' => $banque]);
            $tuple = $statement->fetch();
            $banque_id = $tuple['0'];

            // Ajout d'un nouveau tuple
            $query = "INSERT INTO compte (id, label, montant, banque_id, personne_id) 
                      VALUES (:id, :label, :montant, :banque_id, :personne_id)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'label' => $label,
                'montant' => $montant,
                'banque_id' => $banque_id,
                'personne_id' => $_SESSION['id']
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    // Récupérer tous les comptes avec leurs informations associées
    public static function getAllCompte() {
        try {
            $database = Model::getInstance();
            $query = "SELECT 
                        p.nom, 
                        p.prenom, 
                        b.label AS banque_label, 
                        b.pays, 
                        c.label AS compte_label, 
                        c.montant 
                      FROM 
                        compte AS c 
                      JOIN 
                        banque AS b ON c.banque_id = b.id 
                      JOIN 
                        personne AS p ON c.personne_id = p.id";
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
