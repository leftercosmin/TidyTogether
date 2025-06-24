<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>TidyTogether</title>
  <meta name="description" content="personal space of a regular user" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="/TidyTogether/app/style/globals.css">
  <link rel="stylesheet" href="/TidyTogether/app/style/navbar.css">
  <link rel="stylesheet" href="/TidyTogether/app/style/civilianHome.css">

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
</head>

<body>

<button class="menu-toggle" id="menuToggle">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white">
      <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/>
    </svg>
  </button>

    <div class="overlay" id="overlay"></div>

  <div class="page-layout">
    <?php require_once __DIR__ . '/../components/civilianNavbar.php'; ?>

    <div class="map-container">
      <div class="map-top-bar">
        <div class="topbar-left">
          <button id="openReportBtn" class="topbar-button">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--green)">
          <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
        </svg>
        Report a dirty area
      </button>
          
          <div class="topbar-dropdown">
            <button id="zonesDropdownBtn" class="topbar-button">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="http://www.w3.org/2000/svg" width="24px" fill="currentColor">
                <path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q150 0 255 105t105 255q0 150-105 255T480-120Z" />
              </svg>
              Saved zones <span class="arrow">&#9660;</span>
            </button>
            <div id="zonesDropdownContent" class="dropdown-content">
              <div style="padding:0.5em;color:#888;">Loading...</div>
            </div>
          </div>
        </div>
      
      <button id="locateMeBtn" class="topbar-button">My Location</button>
    </div>

      <div id="map" style="height: 100%; width: 100%;"></div>
    </div>

      <?php require_once __DIR__ . "/../components/civilianPostForm.php"; ?>
    </div>
  </div>

</body>
</html>

<script src="/TidyTogether/app/javascript/mapFunctionality.js"></script>
<script src="/TidyTogether/app/javascript/navbarCollapse.js"></script>
<script src="/TidyTogether/app/javascript/favoriteSpots.js"></script>