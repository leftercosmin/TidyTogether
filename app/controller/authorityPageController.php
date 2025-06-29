<?php

function authorityFallbackPage(int $id): void
{
  $city = getMainCityModel($id);
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

  if ("areaPage" === $_GET["authorityPage"]) {
    $mainCity = getMainCityModel($id);
    $position = processLocationModel($mainCity);
    $tags = getTagModel();
    isError($tags);
    require_once "view/home/authorityAreaView.php";

  } elseif ("profilePage" === $_GET["authorityPage"]) {
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
