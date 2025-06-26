<?php

//define this if not 
if (!defined('CONN')) {
    define("CONN", "userSession");
}

// load environment variables if not already loaded
// formatEnv();

if (!getenv('DB_HOST')) {
    require_once __DIR__ . '/../../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../..");
    $dotenv->load();
    foreach ($_ENV as $key => $value) {
        putenv("$key=$value");
    }
}

/*
require_once "util/databaseConnection.php";
require_once "model/addFavoriteZone.php";
require_once "model/getFavoriteZones.php";
require_once "model/deleteFavoriteZone.php";
require_once "model/getTagModel.php";
 */
require_once __DIR__ . "/../util/databaseConnection.php";
require_once __DIR__ . "/addFavoriteZone.php";
require_once __DIR__ . "/getFavoriteZones.php";
require_once __DIR__ . "/deleteFavoriteZone.php";
require_once __DIR__ . "/getTagModel.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$sessionData = json_decode($_SESSION[CONN] ?? '');
if (!isset($_SESSION[CONN]) || !$sessionData || !isset($sessionData->id)) {
    http_response_code(401);
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'User not authenticated']);
    exit();
}

$userId = $sessionData->id;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fromFavorites'])) {
    $tags = getTagModel();
    header("Location: /");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['getFavorites'])) {
    $favorites = getFavoriteZones($userId);
    header('Content-Type: application/json');
    echo json_encode($favorites);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['favoriteZone'])) {
    $lat = $_POST['lat'] ?? null;
    $lng = $_POST['lng'] ?? null;
    $neighborhood = $_POST['neighborhood'] ?? '';
    $city = $_POST['city'] ?? '';
    $country = $_POST['country'] ?? '';
    $address = $_POST['address'] ?? '';

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
    $zoneId = $_POST['zoneId'] ?? null;

    if (!$zoneId) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Zone ID is required']);
        exit();
    }

    $result = deleteFavoriteZone($userId, $zoneId);

    header('Content-Type: application/json');
    if ($result === true) {
        echo json_encode(['success' => true, 'message' => 'Favorite zone deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => $result]);
    }
    exit();
}

// http_response_code(400);
// header('Content-Type: application/json');
// echo json_encode(['success' => false, 'message' => 'Invalid request']);