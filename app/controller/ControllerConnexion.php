<?php

require_once '../model/ModelPersonne.php';

class controllerConnexion{
    
  public static function accueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewConnexion.php';
  if (DEBUG)
   echo ("ControllerClient : viewAccueilClient : vue = $vue");
  require ($vue);
 }
    public static function loginForm() {
         include 'config.php';
         $vue = $root . '/app/view/Connexion/viewLoginForm.php';
         if (DEBUG)
          echo ("ControllerAdministrateur : patrimoineAccueil : vue = $vue");
         require ($vue);
        
        
    }
        public static function inscriptionForm() {
         include 'config.php';
         $vue = $root . '/app/view/Connexion/viewInscriptionForm.php';
         if (DEBUG)
          echo ("ControllerAdministrateur : patrimoineAccueil : vue = $vue");
         require ($vue);
        
        
    }
    public static function testLogin() {
        // Récupérer les valeurs du formulaire
        $login = $_GET['login'];
        $password = $_GET['password'];

        // Vérifier si les données sont vides
        if (empty($login) || empty($password)) {
            $error = "Veuillez fournir à la fois le login et le mot de passe.";
            include 'config.php';
            $vue = $root . '/app/view/viewConnexion.php';
            require ($vue);
            exit();
        }

        // Appel au modèle pour vérifier les identifiants
        $results = ModelPersonne::check($login, $password);

        if (!empty($results)) {
            // Succès de la connexion, enregistrer les variables de session
            $_SESSION['login'] = $login; // Exemple : à adapter selon vos besoins
            $_SESSION['id'] = $results['id']; // Supposons que vous avez un champ 'id' dans votre modèle
            $_SESSION['statut'] = $results['statut']; // Supposons un champ 'statut' dans votre modèle
            $_SESSION['nom']=$results['nom'];
            $_SESSION['prenom']=$results['prenom'];
            // Redirection en fonction du statut
            if ($_SESSION['statut'] == 0) {
                include 'config.php';
                $vue = $root . '/app/view/viewPatrimoineAccueil.php';
            } else {
                include 'config.php';
                $vue = $root . '/app/view/viewAccueilClient.php';
            }

            include 'config.php';
            if (DEBUG) {
                echo ("ControllerConnexion : Redirection vers $vue");
            }
            require ($vue);
        } else {
            // Échec de la connexion
            $error = "Login ou mot de passe incorrect.";
            include 'config.php';
            $vue = $root . '/app/view/viewConnexion.php';
            require ($vue);
        }
    }

    
    public static function testInscription() {
        // Récupérer les valeurs du formulaire
        $nom = $_GET['nom'];
        $prenom = $_GET['prenom'];
        $login = $_GET['login'];
        $password = $_GET['password'];

        // Vérifier si les données sont vides
        if (empty($login) || empty($password) || empty($nom) || empty($prenom)) {
            $error = "Veuillez remplir tout le formulaire.";
            include 'config.php';
            $vue = $root . '/app/view/viewConnexion.php';
            require ($vue);
            exit();
        }

        // Appel au modèle pour vérifier les identifiants
        $results = ModelPersonne::create($nom,$prenom,$login, $password);

        if ($results==1) {
           include 'config.php';
            $vue = $root . '/app/view/viewConnexion.php';
            require ($vue);
        }
    }
    
    
    
}



?>
