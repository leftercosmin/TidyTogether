<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Home</title>
  <meta name="description" content="personal space of a regular user" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="style/civilianHome.css" />

</head>

<body>

  <?php require_once "view/components/civilianNavbar.php"; ?>

  <div class="map-container">

    <div class="map-top-bar">

      <button id="openReportBtn" class="report-btn">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
          <path
            d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
        </svg>
        Report a dirty area
      </button>
    </div>

    <gmp-map center="40.749933,-73.98633" zoom="13" map-id="DEMO_MAP_ID">
      <gmp-advanced-marker></gmp-advanced-marker>
    </gmp-map>
  </div>

  <?php require_once "view/components/civilianPostForm.php"; ?>

</body>

</html>