<?php 
require 'dompdf/vendor/autoload.php'; 
require_once 'Model.php'; 
use Dompdf\Dompdf; 
use Dompdf\Options; 
 
// Display PHP errors 
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL); 
 
// Log start of the script 
file_put_contents('log.txt', 'Admin PDF script started' . PHP_EOL, FILE_APPEND); 
 
// Check if the administrator is logged in 
if (!isset($_SESSION['id']) || $_SESSION['statut'] != 0) { 
    die('Access denied'); 
} 
 
// Connect to the database 
$pdo = Model::getInstance(); 
 
// Log administrator ID 
$adminId = $_SESSION['id']; 
file_put_contents('log.txt', 'Admin ID: ' . $adminId . PHP_EOL, FILE_APPEND); 
 
// Fetch all clients 
$stmt = $pdo->prepare('SELECT * FROM personne WHERE statut = ?'); 
$stmt->execute([1]); // 1 for client 
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC); 
 
// Log fetched clients 
file_put_contents('log.txt', 'Clients found: ' . print_r($clients, true) . PHP_EOL, FILE_APPEND); 
 
// Start building the HTML content for the PDF 
$html = ' 
<!DOCTYPE html> 
<html lang="fr"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Gestion du Patrimoine des Clients</title> 
    <style> 
        body { font-family: DejaVu Sans, sans-serif; } 
        h1 { color: #4CAF50; } 
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; } 
        table, th, td { border: 1px solid black; } 
        th, td { padding: 10px; text-align: left; } 
    </style> 
</head> 
<body> 
    <h1>Gestion du Patrimoine des Clients</h1> 
    <p>Date: ' . date('d/m/Y') . '</p>'; 
 
foreach ($clients as $client) { 
    // Fetch client's bank accounts 
    $stmt = $pdo->prepare('SELECT * FROM compte WHERE personne_id = ?'); 
    $stmt->execute([$client['id']]); 
    $comptes = $stmt->fetchAll(PDO::FETCH_ASSOC); 
 
    // Fetch client's residences 
    $stmt = $pdo->prepare('SELECT * FROM residence WHERE personne_id = ?'); 
    $stmt->execute([$client['id']]); 
    $residences = $stmt->fetchAll(PDO::FETCH_ASSOC); 
 
    $html .= ' 
    <h2>Client: ' . htmlspecialchars($client['prenom']) . ' ' . htmlspecialchars($client['nom']) . '</h2> 
    <h3>Comptes Bancaires</h3> 
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
 
    <h3>Résidences</h3> 
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
    </table>'; 
} 
 
$html .= ' 
</body> 
</html>'; 
 
// Log HTML content 
file_put_contents('log.txt', 'HTML content: ' . $html . PHP_EOL, FILE_APPEND); 
 
// Initialize Dompdf 
$options = new Options(); 
$options->set('isHtml5ParserEnabled', true); 
$dompdf = new Dompdf($options); 
$dompdf->loadHtml($html); 
 
// (Optional) Setup the paper size and orientation 
$dompdf->setPaper('A4', 'portrait'); 
 
// Render the PDF 
$dompdf->render(); 
 
ob_end_clean(); 
$dompdf->stream('gestion_patrimoine_clients.pdf', array("Attachment" => false)); 
 
// Log end of the script 
file_put_contents('log.txt', 'Admin PDF script ended' . PHP_EOL, FILE_APPEND); 
?>