<?php

function supervisorFallbackPage(int $id): void
{
  $city = getMainCity($id);
  $pendingPosts = getReportModel("pending", $city);
  
  $mediaSupervisor = [];
  foreach($pendingPosts as $post){
    $idPost = $post["id"];
    $mediaSupervisor[$idPost] = getMediaModel($idPost);
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
    require_once "view/home/profileView.php";
  } else {
    supervisorFallbackPage($id);
  }
}
