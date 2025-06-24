<?php

require_once "util/getRoot.php";
require_once "util/formatField.php";

require_once "model/helper/getMainCityModel.php";

require_once "model/getReportModel.php";
require_once "model/getProfileModel.php";
require_once "model/getMediaModel.php";
require_once "model/getMarkModel.php";
require_once "model/processReportModel.php";

require_once "controller/supervisorPageController.php";

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

// backend first - approve/deny posts
if (isset($_POST["postId"]) && isset($_POST["action"])) {
  $idPost = $_POST["postId"];
  $action = $_POST["action"];

  if ($action === "accept") {
    isError(
      approveReport($idPost)
    );
  } elseif ($action === "reject") {
    isError(
      denyReport($idPost)
    );
  }

  unset($_POST["postId"], $_POST["action"]);
}

// frontend pages
supervisorPrintPage($id);
