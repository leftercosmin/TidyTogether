<?php

// Define constants if not already defined (for standalone AJAX requests)
if (!defined('CONN')) {
    define("CONN", "userSession");
}

// Load environment variables if not already loaded (for standalone AJAX requests)
if (!getenv('DB_HOST')) {
    require_once __DIR__ . '/../../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../..");
    $dotenv->load();
    foreach ($_ENV as $key => $value) {
        putenv("$key=$value");
    }
}

require_once __DIR__ . "/../util/databaseConnection.php";
require_once __DIR__ . "/addFavoriteZone.php";
require_once __DIR__ . "/getFavoriteZones.php";
require_once __DIR__ . "/deleteFavoriteZone.php";
require_once __DIR__ . "/getTagModel.php";

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is authenticated
$sessionData = json_decode($_SESSION[CONN] ?? '');
if (!isset($_SESSION[CONN]) || !$sessionData || !isset($sessionData->id)) {
    http_response_code(401);
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'User not authenticated']);
    exit();
}

$userId = $sessionData->id;

// Handle different operations
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fromFavorites'])) {
    $tags = getTagModel();
    header("Location: /TidyTogether/");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['getFavorites'])) {
    // Get user's favorite zones
    $favorites = getFavoriteZones($userId);
    header('Content-Type: application/json');
    echo json_encode($favorites);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['favoriteZone'])) {
    // Add new favorite zone
    $lat = $_POST['lat'] ?? null;
    $lng = $_POST['lng'] ?? null;
    $neighborhood = $_POST['neighborhood'] ?? '';
    $city = $_POST['city'] ?? '';
    $country = $_POST['country'] ?? '';
    $address = $_POST['address'] ?? '';

    // Save to DB
    $result = addFavoriteZone($userId, $neighborhood, $city, $country, $lat, $lng);

    header('Content-Type: application/json');
    if ($result === true) {
        echo json_encode(['success' => true, 'message' => 'Favorite zone saved successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => $result]);
    }
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteFavorite'])) {
    // Delete favorite zone
    $zoneId = $_POST['zoneId'] ?? null;
    
    if (!$zoneId) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Zone ID is required']);
        exit();
    }

    // Debug: Log the values being used
    error_log("Delete attempt - User ID: $userId, Zone ID: $zoneId");

    $result = deleteFavoriteZone($userId, $zoneId);

    header('Content-Type: application/json');
    if ($result === true) {
        echo json_encode(['success' => true, 'message' => 'Favorite zone deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => $result]);
    }
    exit();
}

// If we reach here, it's an invalid request
http_response_code(400);
header('Content-Type: application/json');
echo json_encode(['success' => false, 'message' => 'Invalid request']);
