<?php

function civilianFallbackPage(): void
{
  $location = getLocationModel();
  $tags = getTagModel();
  isError($location);
  isError($tags);
  require_once "view/home/civilianHomeView.php";
}

function civilianPrintPage(int $id): void
{
  if (!isset($_GET) || !isset($_GET['civilianPage'])) {
    civilianFallbackPage();
    return;
  }

  if ("favoriteZonePage" === $_GET["civilianPage"]) {
    require_once "view/home/civilianFavoriteView.php";
  } elseif ("civilianReportPage" === $_GET['civilianPage']) {
    $posts = getPostModel($id);
    isError($posts);
    require_once "view/home/civilianPostsView.php";

  } elseif ("profilePage" === $_GET['civilianPage']) {
    $profile = getProfileModel($id);
    isError($profile);
    require_once "view/profileView.php";

  } elseif ("editProfilePage" === $_GET['civilianPage']) {
    $profile = getProfileModel($id);
    isError($profile);
    require_once "view/profileEditView.php";

  } elseif ("zoneReportPage" === $_GET['civilianPage']) {
    require_once "view/home/zoneReportView.php";

  } else {
    civilianFallbackPage();
  }
}
