<?php
require_once "util/getRoot.php";

require_once "model/getLocationModel.php";
require_once "model/getPostModel.php";
require_once "model/getReportModel.php";
require_once "model/getProfileModel.php";

// get session
session_start();
if (!isset($_SESSION[CONN])) {
  $root = getRoot();
  header("Location: $root");
  exit();
}

$id = json_decode($_SESSION[CONN])->{"id"};

if (!isset($_GET) || !isset($_GET['civilianPage'])) {
  require_once "view/home/civilian.php";
} else {
  if ("civilianHomePage" === $_GET['civilianPage']) {
    require_once "view/home/civilian.php";
  } elseif ("civilianReportPage" === $_GET['civilianPage']) {
    $posts = getPost($id);
    require_once "view/home/report-history.php";
  } elseif ("profilePage" === $_GET['civilianPage']) {
    $profile = getProfile($id);
    require_once "view/home/profile.php";
  }
  
  unset($_GET);
}
