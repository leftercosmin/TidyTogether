<?php

require_once "model/getAreasModel.php";
require_once "model/deleteAreaModel.php";

if (!defined('CONN')) {
  define("CONN", "userSession");
}

// get session
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION[CONN])) {
  http_response_code(405);
  header('Content-Type: application/json');
  echo json_encode(['success' => false, 'message' => 'User not authenticated']);
  exit();
}

$id = json_decode($_SESSION[CONN])->{"id"};

if (isset($_GET["getAreas"])) {
  $spots = getAreasModel($id);
  echo json_encode($spots);
  exit();
}

if (isset($_GET["deleteArea"])) {
  $res = deleteAreaModel($_POST["deleteAreaId"]);
  echo json_encode(['success' => !isError($res), 'message' => $res]);
  exit();
}
