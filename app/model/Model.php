<!-- ----- debut Model -->
<?php

class Model extends PDO {

    private static $_instance;

    // Le constructeur est public en raison de l'héritage de PDO,
    // mais il peut être protégé pour empêcher l'instanciation directe
    protected function __construct() {
        // Appel du constructeur parent PDO
    }

    // Méthode Singleton pour obtenir l'unique instance de la connexion à la base de données
    public static function getInstance() {
        // Inclure le fichier de configuration contenant les informations de connexion
        include_once '../controller/config.php';
        
        if (DEBUG) echo ("Model : getInstance : dsn = $dsn</br>");

        // Options de configuration de PDO pour gérer les erreurs par exceptions
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        // Vérifier si l'instance n'existe pas encore
        if (!isset(self::$_instance)) {
            try {
                // Créer une nouvelle instance de PDO
                self::$_instance = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                // Afficher un message d'erreur en cas d'échec de la connexion
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            }
        }
        // Retourner l'instance unique
        return self::$_instance;
    }

}
?>
<!-- ----- fin Model -->
