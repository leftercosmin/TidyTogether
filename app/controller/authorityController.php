<?php

require_once "util/getRoot.php";
require_once "util/formatField.php";

require_once "model/helper/getMainCityModel.php";

require_once "model/getReportModel.php";
require_once "model/getProfileModel.php";
require_once "model/getMediaModel.php";
require_once "model/getMarkModel.php";
require_once "model/getTagModel.php";
require_once "model/processReportModel.php";
require_once "model/processReportModel.php";
require_once "model/processLocationModel.php";

require_once "model/addCoordinateModel.php";
require_once "model/getCoordinateModel.php";
require_once "model/processTagsAreaModel.php";
require_once "model/addRecyclingAreaModel.php";

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
}

// added a new RecyclingArea
if (isset($_POST["recyclingName"])) {

  $tags = processTagsAreaModel();
  $idCoordinate =
    getCoordinateModel($_POST["recyclingLat"], $_POST["recyclingLon"]);
  if (-1 === $idCoordinate) {
    $idCoordinate =
      addCoordinateModel($_POST["recyclingLat"], $_POST["recyclingLon"]);
  }

  if (isError($idCoordinate)) {
    exit();
  }

  $res = addRecyclingAreaModel(
    $tags,
    $id,
    $idCoordinate
  );
  unset(
    $_POST["recyclingLat"],
    $_POST["recyclingLon"],
  );

  isError($res);
}

// frontend pages
authorityPrintPage($id);
