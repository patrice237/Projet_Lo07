<!-- ----- debut ModelBanque -->

<?php
require_once 'Model.php';

class ModelBanque {
    private $id, $label, $pays;

    // Constructeur avec des valeurs par défaut
    public function __construct($id = NULL, $label = NULL, $pays = NULL) {
        if (!is_null($id)) {
            $this->id = $id;
            $this->label = $label;
            $this->pays = $pays;
        }
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getPays() {
        return $this->pays;
    }

    // Setters
    public function setId($id): void {
        $this->id = $id;
    }

    public function setLabel($label): void {
        $this->label = $label;
    }

    public function setPays($pays): void {
        $this->pays = $pays;
    }

    // Récupérer toutes les banques
    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM banque";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelBanque");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // Récupérer une banque et ses comptes
    public static function getOne($label) {
        try {
            $database = Model::getInstance();
            $query = "SELECT p.prenom, p.nom, b.label, c.label as lb, c.montant 
                      FROM personne AS p, compte AS c, banque AS b 
                      WHERE c.banque_id = b.id AND p.id = c.personne_id AND b.label = :label";
            $statement = $database->prepare($query);
            $statement->execute(['label' => $label]);
            $results1 = $statement->fetchAll(PDO::FETCH_ASSOC);
            return [
                'compte' => $results1,
                'namebank' => $label
            ];
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // Récupérer tous les labels des banques
    public static function getAllBanque() {
        try {
            $database = Model::getInstance();
            $query = "SELECT label FROM banque";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // Insérer une nouvelle banque
    public static function insert($label, $pays) {
        try {
            $database = Model::getInstance();

            // Recherche de la valeur de la clé = max(id) + 1
            $query = "SELECT max(id) FROM banque";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'] + 1;

            // Ajout d'un nouveau tuple
            $query = "INSERT INTO banque (id, label, pays) VALUES (:id, :label, :pays)";
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
<!-- ----- fin ModelBanque -->
