<?php
require 'dompdf/vendor/autoload.php';
require_once 'Model.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Afficher les erreurs PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Log de démarrage
file_put_contents('log.txt', 'Script started' . PHP_EOL, FILE_APPEND);

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    die('Utilisateur non connecté');
}

// Connexion à la base de données
$pdo = Model::getInstance();
$userId = $_SESSION['id'];

// Log utilisateur
file_put_contents('log.txt', 'User ID: ' . $userId . PHP_EOL, FILE_APPEND);

// Récupération des données de l'utilisateur
$stmt = $pdo->prepare('SELECT * FROM personne WHERE id = ?');
$stmt->execute([$userId]);
$personne = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$personne) {
    die('Utilisateur non trouvé');
}

// Log utilisateur trouvé
file_put_contents('log.txt', 'User found: ' . print_r($personne, true) . PHP_EOL, FILE_APPEND);

// Récupération des comptes de l'utilisateur
$stmt = $pdo->prepare('SELECT * FROM compte WHERE personne_id = ?');
$stmt->execute([$userId]);
$comptes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Log comptes
file_put_contents('log.txt', 'Accounts found: ' . print_r($comptes, true) . PHP_EOL, FILE_APPEND);

// Récupération des résidences de l'utilisateur
$stmt = $pdo->prepare('SELECT * FROM residence WHERE personne_id = ?');
$stmt->execute([$userId]);
$residences = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Log résidences
file_put_contents('log.txt', 'Residences found: ' . print_r($residences, true) . PHP_EOL, FILE_APPEND);

// Contenu HTML du PDF
$html = '
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Patrimoine de ' . htmlspecialchars($personne['prenom']) . ' ' . htmlspecialchars($personne['nom']) . '</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h1 { color: #4CAF50; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
    </style>
</head>
<body>
    <h1>Patrimoine de ' . htmlspecialchars($personne['prenom']) . ' ' . htmlspecialchars($personne['nom']) . '</h1>
    <p>Date: ' . date('d/m/Y') . '</p>

    <h2>Comptes Bancaires</h2>
    <table>
        <thead>
            <tr>
                <th>Label</th>
                <th>Montant</th>
                <th>Banque</th>
            </tr>
        </thead>
        <tbody>';
foreach ($comptes as $compte) {
    $html .= '<tr>
                <td>' . htmlspecialchars($compte['label']) . '</td>
                <td>' . htmlspecialchars($compte['montant']) . '</td>
                <td>' . htmlspecialchars($compte['banque_id']) . '</td>
              </tr>';
}
$html .= '   </tbody>
    </table>

    <h2>Résidences</h2>
    <table>
        <thead>
            <tr>
                <th>Label</th>
                <th>Ville</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>';
foreach ($residences as $residence) {
    $html .= '<tr>
                <td>' . htmlspecialchars($residence['label']) . '</td>
                <td>' . htmlspecialchars($residence['ville']) . '</td>
                <td>' . htmlspecialchars($residence['prix']) . '</td>
              </tr>';
}
$html .= '   </tbody>
    </table>
</body>
</html>';

// Log HTML
file_put_contents('log.txt', 'HTML content: ' . $html . PHP_EOL, FILE_APPEND);

// Initialisation de Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);

// (Facultatif) Réglage de la taille du papier et de l'orientation
$dompdf->setPaper('A4', 'portrait');

// Rendu du PDF
$dompdf->render();

ob_end_clean();
$dompdf->stream('patrimoine.pdf', array("Attachment" => false));
// Envoi du PDF au navigateur
//$dompdf->stream('patrimoine.pdf', array['Attachment' => 0]);

// Log fin du script
file_put_contents('log.txt', 'Script ended' . PHP_EOL, FILE_APPEND);

?>