<?php

require_once __DIR__ . '/../util/databaseConnection.php';
require_once __DIR__ . '/../util/getRoot.php';
require_once __DIR__ . '/../util/formatField.php';
require_once __DIR__ . '/../util/getFormat.php';
require_once __DIR__ . '/../util/isError.php';

require_once __DIR__ . '/../model/addPostModel.php';
require_once __DIR__ . '/../model/addMediaModel.php';
require_once __DIR__ . '/../model/addMarksModel.php';

require_once __DIR__ . '/../model/getLocationModel.php';
require_once __DIR__ . '/../model/getPostModel.php';
require_once __DIR__ . '/../model/getReportModel.php';
require_once __DIR__ . '/../model/getProfileModel.php';
require_once __DIR__ . '/../model/getTagModel.php';

require_once __DIR__ . '/../model/processMediaModel.php';
require_once __DIR__ . '/../model/processTagsModel.php';

if (!getenv('DB_HOST')) {
    require_once __DIR__ . '/../../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();
}

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['userSession'])) {
  $root = getRoot();
  header("Location: $root");
  exit();
}

$sessionData = json_decode($_SESSION['userSession']);
if (!$sessionData || !isset($sessionData->id)) {
  $root = getRoot();
  header("Location: $root");
  exit();
}

$id = $sessionData->id;

if (isset($_GET['fromFavorites'])) {
    $tags = getTagModel(); // Make sure $tags is available for the form
    
    // Include home view with the map
    header("Location: /TidyTogether/");
    exit();
}

if (isset($_GET['getFavorites'])) {
    require_once __DIR__ . '/../model/getFavoriteZones.php';
    $favorites = getFavoriteZones($id); // $id is the logged-in user's id from session
    header('Content-Type: application/json');
    echo json_encode($favorites);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['favoriteZone'])) {
    require_once __DIR__ . '/../model/addFavoriteZone.php';
    $userId = $id;
    $lat = $_POST['lat'] ?? null;
    $lng = $_POST['lng'] ?? null;
    $neighborhood = $_POST['neighborhood'] ?? '';
    $city = $_POST['city'] ?? '';
    $country = $_POST['country'] ?? '';
    $address = $_POST['address'] ?? '';

    // Save to DB
    $result = addFavoriteZone($userId, $neighborhood, $city, $country, $lat, $lng);

    header('Content-Type: application/json');
    if ($result === true) {
        echo json_encode(['success' => true, 'message' => 'Favorite zone saved successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => $result]);
    }
    exit();
}
// backend only
// new post created: insert post, media, tags
if (isset($_POST["postAddress"])) {

  $idPost = addPostModel(
    $id,
    $_POST["postDescription"] ?? null,
    $_POST["postAddress"],
    $_POST["postNeighbourhood"],
    $_POST["postCity"],
    $_POST["postCountry"],
  );

  $media = processMediaModel($id, $_FILES['postPhoto'] ?? null);
  $marks = processTagsModel(); // this directly uses $_POST and unset()

  $res0 = "";
  $res1 = "";
  if (!isError($idPost) && !isError($media)) {
    $res0 = addMediaModel((array) $media ?? [], $idPost);
    $res1 = addMarksModel($idPost, $marks);
  }

  isError($res0);
  isError($res1);

  unset(
    $_FILES["postPhoto"],
    $_POST["postDescription"],
    $_POST["postAddress"],
    $_POST["postNeighbourhood"],
    $_POST["postCity"],
    $_POST["postCountry"],
  );

  // fetch everything
  if (!$wasErrorThrown) {
    sleep(5);
    header("Location: /");
    exit();
  }

}

// frontend: determine pages
if (!isset($_GET) || !isset($_GET['civilianPage'])) {
  $location = getLocationModel();
  $tags = getTagModel();
  isError($location);
  isError($tags);
  require_once __DIR__ . '/../view/home/civilianHomeView.php';

} else {
  if ("favoriteZonePage" === $_GET["civilianPage"]) {
    require_once __DIR__ . '/../view/home/civilianFavoriteView.php';

  } elseif ("civilianReportPage" === $_GET['civilianPage']) {
    $posts = getPostModel($id);
    isError($posts);
    require_once __DIR__ . '/../view/home/civilianPostsView.php';

  } elseif ("profilePage" === $_GET['civilianPage']) {
    $profile = getProfileModel($id);
    isError($profile);
    require_once __DIR__ . '/../view/home/profileView.php';

  } elseif ("zoneReportPage" === $_GET['civilianPage']) {
    require_once __DIR__ . '/../view/home/zoneReportView.php';
  }
  else{
    $location = getLocationModel();
    $tags = getTagModel();
    isError($location);
    isError($tags);
    require_once "view/home/civilianHomeView.php";
  }

  unset($_GET);
}