<?php
require_once "util/getRoot.php";
require_once "util/formatField.php";

require_once "model/getLocationModel.php";
require_once "model/getPostModel.php";
require_once "model/getReportModel.php";
require_once "model/getProfileModel.php";
require_once "model/getTagModel.php";
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
  $location = getLocation();
  $tags = getTag();
  require_once "view/home/civilianHomeView.php";
} else {
  if ("favoriteZonePage" === $_GET["civilianPage"]) {
    require_once "view/home/civilianFavoriteView.php";
  } elseif ("civilianReportPage" === $_GET['civilianPage']) {
    $posts = getPost($id);
    require_once "view/home/civilianPostsView.php";
  } elseif ("profilePage" === $_GET['civilianPage']) {
    $profile = getProfile($id);
    require_once "view/home/profileView.php";
  } else {
    $location = getLocation();
    $tags = getTag();
    require_once "view/home/civilianHomeView.php";
  }

  unset($_GET);
}

// new post created
if (isset($_POST["postAddress"])) {
  addPost(
    $id,
    $_POST["postDescription"] ?? null,
    $_POST["postAddress"],
    $_POST["postNeighbourhood"],
    $_POST["postCity"],
    $_POST["postCountry"],
    $_POST["postPhoto"] ?? null,
    $_POST["postTag"]
  );
  unset(
    $_POST["postDescription"],
    $_POST["postAddress"],
    $_POST["postNeighbourhood"],
    $_POST["postCity"],
    $_POST["postCountry"],
    $_POST["postPhoto"],
    $_POST["postTag"]
  );
}
