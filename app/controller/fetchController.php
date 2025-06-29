<?php

require_once "model/getAreasModel.php";

// get session
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$sessionData = json_decode($_SESSION[CONN]);
if (!isset($_SESSION[CONN]) || !$sessionData || !isset($sessionData->id)) {
  $root = getRoot();
  header("Location: $root");
  exit();
}

$id = $sessionData->id;

if (isset($_GET["getAreas"])) {
  $spots = getAreasModel($id);
  echo json_encode($spots);
  exit();
}
