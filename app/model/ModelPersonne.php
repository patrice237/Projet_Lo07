<?php
session_start();
require_once 'Model.php';

class ModelPersonne {
    private $id, $nom, $prenom, $statut, $login, $password;

    public function __construct($id = NULL, $nom = NULL, $prenom = NULL, $statut = NULL, $login = NULL, $password = NULL) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->statut = $statut;
        $this->login = $login;
        $this->password = $password;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getStatut() {
        return $this->statut;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getPassword() {
        return $this->password;
    }

    // Setters
    public function setId($id): void {
        $this->id = $id;
    }

    public function setNom($nom): void {
        $this->nom = $nom;
    }

    public function setPrenom($prenom): void {
        $this->prenom = $prenom;
    }

    public function setStatut($statut): void {
        $this->statut = $statut;
    }

    public function setLogin($login): void {
        $this->login = $login;
    }

    public function setPassword($password): void {
        $this->password = $password;
    }

    // Vérification des informations de connexion
    public static function check($login, $password) {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM personne WHERE login = :login AND password = :password";
            $stmt = $database->prepare($query);
            $stmt->execute(['login' => $login, 'password' => $password]);
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            return $results ?: 0;
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
            return null;
        }
    }

    // Récupérer tous les clients
    public static function getAllClient() {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM personne WHERE statut = 1";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return null;
        }
    }

    // Créer une nouvelle personne
    public static function create($nom, $prenom, $login, $password) {
        try {
            $database = Model::getInstance();

            // Récupérer l'ID maximal et incrémenter
            $query1 = "SELECT MAX(id) AS max_id FROM personne";
            $statement1 = $database->query($query1);
            $tuple = $statement1->fetch();
            $id = $tuple['max_id'] + 1;

            // Insertion de la nouvelle personne
            $query = "INSERT INTO personne (id, nom, prenom, statut, login, password) 
                      VALUES (:id, :nom, :prenom, 0, :login, :password)";
            $stmt = $database->prepare($query);
            $stmt->execute([
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'login' => $login,
                'password' => $password
            ]);

            return 1;
        } catch (PDOException $e) {
            echo 'Erreur: ' . $e->getMessage();
            return null;
        }
    }

    // Récupérer tous les administrateurs
    public static function getAllAdmin() {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM personne WHERE statut = 0";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return null;
        }
    }
}
?>
