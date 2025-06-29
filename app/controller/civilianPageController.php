<?php

require_once "model/helper/getMainCityModel.php";
require_once "model/processLocationModel.php";

function civilianFallbackPage(int $id): void
{
  $tags = getTagModel();
  $location = getLocationModel();

  $mainCity = getMainCityModel($id);
  $position = processLocationModel($mainCity);

  isError($tags);
  isError($location);
  isError($position);
  if (str_starts_with($mainCity, "error")) {
    isError($mainCity);
  }
  require_once "view/home/civilianHomeView.php";
}

function civilianPrintPage(int $id): void
{
  if (!isset($_GET) || !isset($_GET['civilianPage'])) {
    civilianFallbackPage($id);
    return;
  }

  if ("civilianReportPage" === $_GET['civilianPage']) {
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
    $mainCity = getMainCityModel($id);
    if (str_starts_with($mainCity, "error")) {
      $mainCity = "";
    }
    require_once "view/home/zoneReportView.php";

  } elseif ("neighborhoodReportPage" === $_GET['civilianPage']) {
    $neighborhood = $_GET['neighborhood'] ?? '';
    $city = $_GET['city'] ?? '';

    if (empty($neighborhood) || empty($city)) {
      header("Location: ?civilianPage=zoneReportPage");
      exit();
    }

    require_once "view/home/neighborhoodReportView.php";

  } else {
    civilianFallbackPage($id);
  }
}
