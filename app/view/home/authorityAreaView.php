<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Recycling Area</title>
  <meta name="description" content="Authority dashboard for managing approved reports">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/globals.css">
  <link rel="stylesheet" href="style/navbar.css">
  <link rel="stylesheet" href="style/authorityArea.css">

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
</head>

<body>

  <button class="menu-toggle" id="menuToggle">
    <?php require 'view/components/svg/menuSvg.php'; ?>
  </button>

  <div class="overlay" id="overlay"></div>

  <div class="page-layout">

    <?php require_once 'view/components/authorityNavbar.php'; ?>

    <div class="map-container">
      <div class="map-top-bar">
        <div class="topbar-dropdown">
          <button id="zonesDropdownBtn" class="topbar-button">
            <?php require 'view/components/svg/savedSvg.php'; ?>
            Posted areas
          </button>
          <div id="zonesDropdownContent" class="dropdown-content">
            <div style="padding:0.5em;color:#888;">Loading...</div>
          </div>
        </div>

        <button id="locateMeBtn" class="topbar-button">
          <?php require 'view/components/svg/zoneSvg.php'; ?>
          My Location
        </button>
      </div>

      <div id="map"></div>
    </div>
  </div>

  <?php require_once 'view/components/authorityRecyclingForm.php'; ?>

</body>

</html>

<script>
  // Romanie Iasi
  const fallbackLat = 47.159811;
  const fallbackLon = 27.587201;

  const userCityLat = <?= json_encode($position['lat'] ?? "") ?>;
  const userCityLon = <?= json_encode($position['lon'] ?? "") ?>;
  const userCityName = <?= json_encode($mainCity ?? "Unknown City") ?>;

  const initialLat = userCityLat == "" ? fallbackLat : parseFloat(userCityLat);
  const initialLon = userCityLon == "" ? fallbackLon : parseFloat(userCityLon);

  const cityBounds = <?= json_encode($position['bounds'] ?? null) ?>;
  
  console.log('Authority Area Setup:', {
    userCity: userCityName,
    coordinates: [initialLat, initialLon],
    bounds: cityBounds
  });
</script>
<script src="javascript/authorityMapFunctionality.js"></script>
<script src="javascript/navbarCollapse.js"></script>