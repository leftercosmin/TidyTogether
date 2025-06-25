<?php

require_once "model/processEditModel.php";

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

// backend stuff
$id = $sessionData->id;

$fname = $_POST["editfirstname"] ?? null;
$lname = $_POST["editlastname"] ?? null;
$mcity = $_POST["editmaincity"] ?? null;

$fname = "" === $fname ? null : $fname;
$lname = "" === $lname ? null : $lname;
$mcity = "" === $mcity ? null : $mcity;

isError(
  processEditModel($id, $fname, $lname, $mcity)
);
