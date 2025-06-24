<?php

require_once "util/getRoot.php";
require_once "util/formatField.php";

require_once "model/helper/getMainCityModel.php";

require_once "model/getReportModel.php";
require_once "model/getProfileModel.php";
require_once "model/getMediaModel.php";
require_once "model/getMarkModel.php";
require_once "model/processReportModel.php";

require_once "controller/authorityPageController.php";

// get session
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION[CONN])) {
  $root = getRoot();
  header("Location: $root");
  exit();
}

$id = json_decode($_SESSION[CONN])->{"id"};

// backend operation
if (isset($_POST["postId"]) && isset($_POST["action"])) {
  if ($_POST["action"] === "markDone") {
    markReportDone($_POST["postId"]);
  }

  $root = getRoot();
  header("Location: " . $root);
  exit();
}

// frontend pages
authorityPrintPage($id);
