<?php

function authorityFallbackPage(int $id): void
{
  require_once "view/home/authorityHomeView.php";

  $city = getMainCity($id);
  $approvedReports = getReportModel("inProgress", $city);
  isError($approvedReports);

  $mediaAuthority = [];
  $marksAuthority = [];
  foreach ($approvedReports as $post) {
    $idPost = $post["id"];
    $mediaAuthority[$idPost] = getMediaModel($idPost);
    $marksAuthority[$idPost] = getMarkModel($idPost);
  }

  require_once "view/home/authorityHomeView.php";
}

function authorityPrintPage(int $id): void
{
  if (!isset($_GET) || !isset($_GET['authorityPage'])) {
    authorityFallbackPage($id);
    return;
  }

  if ("profilePage" === $_GET["authorityPage"]) {
    $profile = getProfileModel(id: $id);
    isError($profile);
    require_once "view/profileView.php";

  } elseif ("editProfilePage" === $_GET['authorityPage']) {
    $profile = getProfileModel($id);
    isError($profile);
    require_once "view/profileEditView.php";

  } else {
    authorityFallbackPage($id);
  }
}
