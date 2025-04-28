<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/models/Property.php';
require_once __DIR__ . '/models/Flat.php';
require_once __DIR__ . '/models/House.php';
require_once __DIR__ . '/repositories/OwnerRepository.php';
require_once __DIR__ . '/repositories/DBConnect.php';
require_once __DIR__ . '/controllers/TaxController.php';

// Créer un contrôleur et appeler la méthode d'affichage
$controller = new TaxController();

// Récupérer l'action à effectuer depuis l'URL
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Exécuter l'action appropriée
switch ($action) {
    case 'calculateTax':
        $controller->calculateTax();
        break;
    default:
        $controller->index();
}
?>