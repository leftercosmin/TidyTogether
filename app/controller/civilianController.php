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

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION[CONN])) {
  $root = getRoot();
  header("Location: $root");
  exit();
}

$id = json_decode($_SESSION[CONN])->{"id"};

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
}

// frontend: determine pages
if (!isset($_GET) || !isset($_GET['civilianPage'])) {
  $location = getLocationModel();
  $tags = getTagModel();
  isError($location);
  isError($tags);
  require_once "view/home/civilianHomeView.php";

} else {
  if ("favoriteZonePage" === $_GET["civilianPage"]) {
    require_once "view/home/civilianFavoriteView.php";

  } elseif ("civilianReportPage" === $_GET['civilianPage']) {
    $posts = getPostModel($id);
    isError($posts);
    require_once "view/home/civilianPostsView.php";

  } elseif ("profilePage" === $_GET['civilianPage']) {
    $profile = getProfileModel($id);
    isError($profile);
    require_once "view/home/profileView.php";

  } else {
    $location = getLocationModel();
    $tags = getTagModel();
    isError($location);
    isError($tags);
    require_once "view/home/civilianHomeView.php";
  }

  unset($_GET);
}
