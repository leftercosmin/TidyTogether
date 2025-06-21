<?php
require_once __DIR__ . '/../model/getReportModel.php';
require_once "util/getRoot.php";
require_once "util/formatField.php";

require_once "model/getReportModel.php";
require_once "model/getProfileModel.php";

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

// determine pages + get posts
if (!isset($_GET['supervisorPage'])) {
  $pendingPosts = getPendingReports();
  require_once "view/home/supervisorHomeView.php";
} else {
  if ($_GET["supervisorPage"] === "profilePage") {
    $profile = getProfile($id);
    require_once "view/home/profileView.php";
  }
  // elseif ("approvedPostsPage" === $_GET['supervisorPage']) {
  //   $approvedPosts = getApprovedPendingReports($id);
  //   require_once "view/home/supervisorApprovedView.php";
  // } else {
  //   $pendingPosts = getRejectedPendingReports($id);
  //   require_once "view/home/supervisorDeniedView.php";
  // }
  unset($_GET);
}

//approve/deny posts
if (isset($_POST["postId"]) && isset($_POST["action"])) {
  $idPost = $_POST["postId"];
  $action = $_POST["action"];

  if ($action === "accept") {
    approveReport($idPost, $id);
  } elseif ($action === "reject") {
    denyReport($idPost, $id);
  }

  unset($_POST["postId"], $_POST["action"]);
}
