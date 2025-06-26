<?php

// Define constants if not already defined (for standalone requests)
if (!defined('CONN')) {
    define("CONN", "userSession");
}

require_once "util/getRoot.php";
require_once "util/formatField.php";
require_once "util/getFormat.php";
require_once "util/isError.php";
require_once "util/alert.php";
require_once "util/databaseConnection.php";

require_once "model/addPostModel.php";
require_once "model/addMediaModel.php";
require_once "model/addMarksModel.php";

require_once "model/getLocationModel.php";
require_once "model/getPostModel.php";
require_once "model/getReportModel.php";
require_once "model/getProfileModel.php";
require_once "model/getTagModel.php";

require_once "model/processMediaModel.php";
require_once "model/processReportModel.php";
require_once "model/processTagsModel.php";

require_once "controller/civilianPageController.php";

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

// backend - new post created: insert post, media, tags
if (isset($_POST["postAddress"])) {

  $idPost = addPostModel(
    $id,
    $_POST["postDescription"] ?? null,
    $_POST["postAddress"],
    $_POST["postNeighbourhood"],
    $_POST["postCity"],
    $_POST["postCountry"],
  );

  $media = processMediaModel($id, $_FILES['postPhoto'] ?? null);
  $marks = processTagsModel(); // this directly uses $_POST and unset()

  $res0 = "";
  $res1 = "";
  if (!isError($idPost) && !isError($media)) {
    $res0 = addMediaModel((array) $media ?? [], $idPost);
    $res1 = addMarksModel($idPost, $marks);
  }

  isError($res0);
  isError($res1);

  unset(
    $_FILES["postPhoto"],
    $_POST["postDescription"],
    $_POST["postAddress"],
    $_POST["postNeighbourhood"],
    $_POST["postCity"],
    $_POST["postCountry"],
  );

  // fetch everything
  if (!$wasErrorThrown) {
    sleep(5);
    header("Location: /");
    exit();
  }

}

// frontend pages
civilianPrintPage($id);
