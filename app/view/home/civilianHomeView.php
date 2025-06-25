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

  <button class="menu-toggle" id="menuToggle">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white">
      <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
    </svg>
  </button>

  <div class="overlay" id="overlay"></div>

  <div class="page-layout">

    <?php require_once "view/components/civilianNavbar.php"; ?>

    <div class="map-container">      
      <div class="map-top-bar">
        <button id="openReportBtn" class="topbar-button">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--green)"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" /></svg>
          Report a dirty area
        </button>

        <div class="topbar-dropdown">
          <button id="zonesDropdownBtn" class="topbar-button">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M380-400h60v-120h180l-60-80 60-80H380v280ZM200-120v-640q0-33 23.5-56.5T280-840h400q33 0 56.5 23.5T760-760v640L480-240 200-120Zm80-122 200-86 200 86v-518H280v518Zm0-518h400-400Z"/></svg>
            Saved zones
          </button>
          <div id="zonesDropdownContent" class="dropdown-content">
            <div style="padding:0.5em;color:#888;">Loading...</div>
          </div>
        </div>
        
        <button id="locateMeBtn" class="topbar-button">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M480-301q99-80 149.5-154T680-594q0-90-56-148t-144-58q-88 0-144 58t-56 148q0 65 50.5 139T480-301Zm0 101Q339-304 269.5-402T200-594q0-125 78-205.5T480-880q124 0 202 80.5T760-594q0 94-69.5 192T480-200Zm0-320q33 0 56.5-23.5T560-600q0-33-23.5-56.5T480-680q-33 0-56.5 23.5T400-600q0 33 23.5 56.5T480-520ZM200-80v-80h560v80H200Zm280-520Z"/></svg>
          My Location
        </button>
      </div>

      <div id="map"></div>
    </div>

    <?php require_once "view/components/civilianPostForm.php"; ?>
  </div>
  </div>
</body>

</html>

<script src="javascript/mapFunctionality.js"></script>
<script src="javascript/navbarCollapse.js"></script>
<script src="javascript/favoriteSpots.js"></script>