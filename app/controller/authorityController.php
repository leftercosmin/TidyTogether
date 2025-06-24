<?php
require_once "util/getRoot.php";
require_once "util/formatField.php";

require_once "model/getReportModel.php";
require_once "model/getProfileModel.php";

require_once "model/processReportModel.php";

// get session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION[CONN])) {
  $root = getRoot();
  header("Location: $root");
  exit();
}

if (isset($_POST["postId"]) && isset($_POST["action"]) && $_POST["action"] === "markDone") {
    require_once __DIR__ . '/../model/getReportModel.php';
    markReportDone((int)$_POST["postId"]);
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

$id = json_decode($_SESSION[CONN])->{"id"};

if (!isset($_GET['authorityPage'])) {
  $approvedReports = getApprovedReports();
  require_once "view/home/authorityHomeView.php";
} else {
  if ($_GET["authorityPage"] === "profilePage") {
    $profile = getProfileModel($id);
    require_once "view/home/profileView.php";
  } else {
    $approvedReports = getApprovedReports();
    require_once "view/home/authorityHomeView.php";
  }
  unset($_GET);
}