<?php
require_once "util/getRoot.php";
require_once "util/formatField.php";
require_once "util/getFormat.php";

require_once "model/getLocationModelModel.php";
require_once "model/getPostModel.php";
require_once "model/getReportModel.php";
require_once "model/getProfileModel.php";
require_once "model/getTagModelModel.php";
require_once "model/addPostModel.php";

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION[CONN])) {
  $root = getRoot();
  header("Location: $root");
  exit();
}

$id = json_decode($_SESSION[CONN])->{"id"};

// determine pages
if (!isset($_GET) || !isset($_GET['civilianPage'])) {
  $location = getLocationModel();
  $tags = getTagModel();

  // error checking
  $statusModel = is_string($location) ? $location : "";
  $statusModel = is_string($tags) ? $tags : "";
  require_once "view/home/civilianHomeView.php";

} else {
  if ("favoriteZonePage" === $_GET["civilianPage"]) {
    require_once "view/home/civilianFavoriteView.php";

  } elseif ("civilianReportPage" === $_GET['civilianPage']) {
    $posts = getPostModel($id);
    $statusModel = is_string($posts) ? $posts : "";
    require_once "view/home/civilianPostsView.php";

  } elseif ("profilePage" === $_GET['civilianPage']) {
    $profile = getProfileModel($id);
    $statusModel = is_string($profile) ? $profile : "";
    require_once "view/home/profileView.php";

  } else {
    $location = getLocationModel();
    $tags = getTagModel();

    $statusModel = is_string($location) ? $location : "";
    $statusModel = is_string($tags) ? $tags : "";
    require_once "view/home/civilianHomeView.php";
  }

  unset($_GET);
}

// new post created
if (isset($_POST["postAddress"])) {
  $tags = $_POST["postTag"] ?? [];
  if (is_array($tags)) {
    $tags = implode(',', $tags);
  }

  $media = [];
  if (!empty($_FILES['postPhoto'])) {

    $uploadDir = getRoot() . 'public/uploads/';

    // for each file sent by the user
    foreach ($_FILES['postPhoto']["tmp_name"] as $index => $oldPath) {

      // save it to local system (server)
      if (!is_uploaded_file($oldPath)) {
        alert("warning: not a valid uploaded file: $oldPath");
        continue;
      }

      if (!is_writable($uploadDir)) {
        alert("warning: upload directory is not writable.");
        continue;
      }

      $name = $_FILES['postPhoto']['name'][$index];
      $size = $_FILES['postPhoto']['size'][$index];
      $newPath = $uploadDir
        . $id . "_"
        . time() . "_"
        . basename($name);

      // change the path
      if (!move_uploaded_file($oldPath, $newPath)) {
        alert("error: file uploading");
        continue;
      }

      // writeConsole($oldPath);
      // writeConsole($newPath);
      $file = [];
      $file["name"] = $name;
      $file["size"] = $size;
      $file["source"] = $newPath;
      $file["format"] = getFormat($newPath);
      $media[] = $file;
    }
  }

  addPostModel(
    $id,
    $_POST["postDescription"] ?? null,
    $_POST["postAddress"],
    $_POST["postNeighbourhood"],
    $_POST["postCity"],
    $_POST["postCountry"],
    $media,
    $tags
  );

  unset(
    $_FILES,
    $_POST["postDescription"],
    $_POST["postAddress"],
    $_POST["postNeighbourhood"],
    $_POST["postCity"],
    $_POST["postCountry"],
    $_POST["postTag"]
  );
}