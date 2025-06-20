<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Home</title>
  <meta name="description" content="personal space of a regular user" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="style/civilianHome.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
</head>

<body>
  <div class="page-layout">
    <?php require_once "view/components/civilianNavbar.php"; ?>

    <div class="map-container">
      <div class="map-top-bar" style="display: flex; align-items: center; margin-bottom: 1em; z-index: 2; position: relative;">
        <button id="openReportBtn" class="report-btn" style="display: flex; align-items: center;">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3" style="margin-right: 8px;">
            <path
              d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
          </svg>
          Report a dirty area
        </button>
      </div>

      <div class="map-container" style="width: 100%;">
      <div id="map" style="height: 500px; width: 100%;"></div>
        <?php require_once "view/components/civilianPostForm.php"; ?>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var map = L.map('map').setView([40.749933, -73.98633], 13);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap contributors'
      }).addTo(map);
      L.marker([40.749933, -73.98633]).addTo(map)
        .bindPopup('Default location')
        .openPopup();
    });
  </script>

</body>

</html>