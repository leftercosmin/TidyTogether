<?php

// called from fetch() at javascript/favoriteSpots.js
require_once "model/addFavoriteZone.php";
require_once "model/getFavoriteZones.php";
require_once "model/deleteFavoriteZone.php";
require_once "model/getTagModel.php";

// get session
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

// backend
if (isset($_GET['fromFavorites'])) {
  header("Set-Cookie: caca=cca");
  header("Location: /");
  exit();
}

if (isset($_GET['getFavorites'])) {
  $favorites = getFavoriteZones($userId);
  header('Content-Type: application/json');
  echo json_encode($favorites);
  exit();
}

if (isset($_POST['favoriteZone'])) {
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

if (isset($_POST['deleteFavorite'])) {
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
