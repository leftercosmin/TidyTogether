<?php

function fallbackPage(): void
{
  $location = getLocationModel();
  $tags = getTagModel();
  isError($location);
  isError($tags);
  require_once "view/home/civilianHomeView.php";
}

function printPage(int $id): void
{
  if (!isset($_GET) || !isset($_GET['civilianPage'])) {
    fallbackPage();
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
    require_once "view/home/profileView.php";

  } elseif ("zoneReportPage" === $_GET['civilianPage']) {
    require_once "view/home/zoneReportView.php";

  } else {
    fallbackPage();
  }
}
