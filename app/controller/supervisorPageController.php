<?php

function supervisorFallbackPage(int $id): void
{
  $city = getMainCity($id);
  $pendingPosts = getReportModel("pending", $city);
  isError($pendingPosts);

  $mediaSupervisor = [];
  $marksSupervisor = [];
  foreach ($pendingPosts as $post) {
    $idPost = $post["id"];
    $mediaSupervisor[$idPost] = getMediaModel($idPost);
    $marksSupervisor[$idPost] = getMarkModel($idPost);
  }

  require_once "view/home/supervisorHomeView.php";
}

function supervisorPrintPage(int $id): void
{
  if (!isset($_GET) || !isset($_GET['supervisorPage'])) {
    supervisorFallbackPage($id);
    return;
  }

  if ("profilePage" === $_GET["supervisorPage"]) {
    $profile = getProfileModel($id);
    isError($profile);
    require_once "view/profileView.php";

  } elseif ("editProfilePage" === $_GET['supervisorPage']) {
    $profile = getProfileModel($id);
    isError($profile);
    require_once "view/profileEditView.php";

  } else {
    supervisorFallbackPage($id);
  }
}
