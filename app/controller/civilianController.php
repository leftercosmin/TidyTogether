<?php

require_once "util/getRoot.php";
require_once "util/formatField.php";
require_once "util/getFormat.php";

require_once "model/addPostModel.php";
require_once "model/addMediaModel.php";
require_once "model/addMarksModel.php";

require_once "model/getLocationModel.php";
require_once "model/getPostModel.php";
require_once "model/getReportModel.php";
require_once "model/getProfileModel.php";
require_once "model/getTagModel.php";

require_once "model/processMediaModel.php";
require_once "model/processTagsModel.php";

require_once "controller/civilianPageController.php";

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

if (isset($_GET['fromFavorites'])) {
  $tags = getTagModel();
  header("Location: /TidyTogether/");
  exit();
}

if (isset($_GET['getFavorites'])) {
  require_once __DIR__ . '/../model/getFavoriteZones.php';
  $favorites = getFavoriteZones($id);
  header('Content-Type: application/json');
  echo json_encode($favorites);
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['favoriteZone'])) {
  require_once __DIR__ . '/../model/addFavoriteZone.php';
  $userId = $id;
  $lat = $_POST['lat'] ?? null;
  $lng = $_POST['lng'] ?? null;
  $neighborhood = $_POST['neighborhood'] ?? '';
  $city = $_POST['city'] ?? '';
  $country = $_POST['country'] ?? '';
  $address = $_POST['address'] ?? '';

  // Save to DB
  $result = addFavoriteZone($userId, $neighborhood, $city, $country, $lat, $lng);

  header('Content-Type: application/json');
  if ($result === true) {
    echo json_encode(['success' => true, 'message' => 'Favorite zone saved successfully']);
  } else {
    echo json_encode(['success' => false, 'message' => $result]);
  }
  exit();
}
// backend only
// new post created: insert post, media, tags
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

// frontend: determine pages
printPage($id);
