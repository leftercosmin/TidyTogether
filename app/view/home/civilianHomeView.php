<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Civilian Dashboard</title>
  <meta name="description" content="personal space of a regular user" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="style/globals.css">
  <link rel="stylesheet" href="style/navbar.css">
  <link rel="stylesheet" href="style/civilianHome.css">

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
</head>

<body>

  <?php printFiles("public/uploads"); ?>

  <button class="menu-toggle" id="menuToggle">
    <?php require 'view/components/svg/menuSvg.php'; ?>
  </button>

  <div class="overlay" id="overlay"></div>

  <div class="page-layout">

    <?php require_once "view/components/civilianNavbar.php"; ?>

    <div class="map-container">
      <div class="map-top-bar">
        <button id="openReportBtn" class="topbar-button">
          <?php require 'view/components/svg/dirtySvg.php'; ?>
          Report a dirty area
        </button>

        <div class="topbar-dropdown">
          <button id="zonesDropdownBtn" class="topbar-button">
            <?php require 'view/components/svg/savedSvg.php'; ?>
            Saved zones
          </button>
          <div id="zonesDropdownContent" class="dropdown-content">
            <div style="padding:0.5em;color:#888;">Loading...</div>
          </div>
        </div>

        <button id="toggleRecyclingBtn" class="topbar-button">
          <?php require 'view/components/svg/recycleSvg.php'; ?>
          Recycling areas
        </button>

        <button id="locateMeBtn" class="topbar-button">
          <?php require 'view/components/svg/zoneSvg.php'; ?>
          My Location
        </button>
      </div>

      <div id="map"></div>
    </div>

    <?php require_once "view/components/civilianPostForm.php"; ?>
  </div>
</body>

</html>

<script>
  // Romanie Iasi
  const fallbackLat = 47.159811;
  const fallbackLon = 27.587201;

  const userCityLat = <?= json_encode($position['lat'] ?? "") ?>;
  const userCityLon = <?= json_encode($position['lon'] ?? "") ?>;

  const initialLat = userCityLat == "" ? fallbackLat : userCityLat;
  const initialLon = userCityLon == "" ? fallbackLon : userCityLon;

  const recyclingAreasData = <?= json_encode(array_values(array_map(function ($userAreas) {
    $areas = [];
    foreach ($userAreas as $coordId => $areaData) {
      $areas[] = [
        'lat' => (float) $areaData['lat'],
        'lng' => (float) $areaData['lon'],
        'address' => $areaData['address'],
        'tags' => $areaData['tag'] ?? []
      ];
    }
    return $areas;
  }, $recyclingAreas ?? []))) ?>.flat();
</script>
<script src="javascript/mapFunctionality.js"></script>
<script src="javascript/navbarCollapse.js"></script>
<script src="javascript/favoriteSpots.js"></script>