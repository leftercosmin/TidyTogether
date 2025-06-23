<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Home</title>
  <meta name="description" content="personal space of a regular user" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="/TidyTogether/app/style/civilianHome.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
</head>

<body>
  <div class="page-layout">
    <?php require_once __DIR__ . '/../components/civilianNavbar.php'; ?>

    <div class="map-container">
      <div class="map-top-bar">
        <button id="openReportBtn" class="report-btn">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3" style="margin-right: 8px;">
            <path
              d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
          </svg>
          Report a dirty area
        </button>
        <button id="locateMeBtn" class="map-button">My Location</button>
      </div>

      <div id="map" style="height: 100%; width: 100%;"></div>
    </div>

      <?php require_once __DIR__ . "/../components/civilianPostForm.php"; ?>
    </div>
  </div>

</body>
</html>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const map = L.map('map').setView([47.169488, 27.576741], 16);
     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  const geocoderControl = new L.Control.Geocoder({
      defaultMarkGeocode: false,
      placeholder: "Search for a place or address..."
    }).addTo(map);

    let userMarker = null;
    let fetchController = null;
    let currentLocation = null;

    //map.off('click');

    function handleLocation(lat, lng) {
      if (userMarker && map.hasLayer(userMarker)) {
        map.removeLayer(userMarker);
      }

      if (fetchController) {
        fetchController.abort();
      }
      fetchController = new AbortController();

      userMarker = L.marker([lat, lng]).addTo(map)
        .bindPopup('<div>Loading address...</div>')
        .openPopup();

      fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
        .then(res => res.json())
        .then(data => {
          const neighborhood = data.address.neighbourhood || data.address.suburb || data.address.village || data.address.city || "Unknown area";
          const country = data.address.country || "Unknown Country";
          const city = data.address.city || data.address.town || data.address.village || "";
          const address = data.display_name || "";

          currentLocation = {
            lat: lat,
            lng: lng,
            address: address,
            neighborhood: neighborhood,
            city: city,
            country: country,
            fullData: data
          };

          const popupContent = `
            <div style="display: flex; flex-direction: column; gap: 6px;">
              <button style="border-radius: 50px; padding: 0.85em; background-color: var(--base-color); color: var(--accent-color); cursor: pointer;" id="report">Report dirty area</button>
              <button style="border-radius: 50px; padding: 0.85em; background-color: var(--base-color); color: var(--accent-color); cursor: pointer;" id="save-as-fav">Save ${neighborhood} as favorite zone</button>
              <button style="border-radius: 50px; padding: 0.85em; background-color: var(--base-color); color: var(--accent-color); cursor: pointer;" id="gen-report">Generate report for ${neighborhood}</button>
            </div>
          `;

          userMarker.setPopupContent(popupContent);

          setTimeout(() => {
            const reportBtn = document.getElementById('report');
            if (reportBtn) {
              reportBtn.onclick = function() {
                const modal = document.getElementById("reportModal");
                if (modal) {
                  document.getElementById('address').value = currentLocation.address || '';
                  document.getElementById('neighbourhood').value = currentLocation.neighborhood || '';
                  document.getElementById('city').value = currentLocation.city || '';
                  modal.style.display = "block";
                }
              };
            }

            const favBtn = document.getElementById('save-as-fav');
            if (favBtn) {
            favBtn.onclick = function() {
              // Disable button immediately to prevent double-clicks
              favBtn.disabled = true;
              favBtn.textContent = "Saving...";
              
              const formData = new FormData();
              formData.append('favoriteZone', '1');
              formData.append('lat', currentLocation.lat);
              formData.append('lng', currentLocation.lng);
              formData.append('neighborhood', currentLocation.neighborhood);
              formData.append('city', currentLocation.city);
              formData.append('country', currentLocation.fullData.address.country || '');
              formData.append('address', currentLocation.address);

              fetch('/TidyTogether/app/controller/civilianController.php', {
                method: 'POST',
                body: formData
              })
              .then(res => res.json())
              .then(data => {
                if (data.success) {
                  favBtn.textContent = "Saved!";
                  favBtn.style.backgroundColor = "#4CAF50"; // Green color for success
                } else {
                  favBtn.textContent = "Failed - Try Again";
                  favBtn.disabled = false;
                  favBtn.style.backgroundColor = "#f44336"; // Red color for error
                }
              })
              .catch(error => {
                console.error('Error saving favorite:', error);
                favBtn.textContent = "Network Error - Try Again";
                favBtn.disabled = false;
                favBtn.style.backgroundColor = "#f44336"; // Red color for error
              });
            };
            }
  
          }, 100);
        })
        .catch(err => {
          console.error("Reverse geocoding failed", err);
        });
    }

    const panLat = localStorage.getItem('panToLat');
    const panLng = localStorage.getItem('panToLng');
    const panLabel = localStorage.getItem('panToLabel');

    if (panLat && panLng) {
      console.log("Panning to:", panLat, panLng, panLabel);
      map.setView([parseFloat(panLat), parseFloat(panLng)], 16);
      
      // Now handleLocation is defined, so we can use it
      handleLocation(parseFloat(panLat), parseFloat(panLng));
      
      localStorage.removeItem('panToLat');
      localStorage.removeItem('panToLng');
      localStorage.removeItem('panToLabel');
    }

    map.on('click', function (e) {
      console.log('Map clicked', e.latlng);
      const { lat, lng } = e.latlng;
      handleLocation(lat, lng);
    });

    geocoderControl.on('markgeocode', function(e) {
      const latlng = e.geocode.center;
      map.setView(latlng, 16);
      handleLocation(latlng.lat, latlng.lng);
    });

    document.getElementById('locateMeBtn').onclick = function() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(pos) {
          map.setView([pos.coords.latitude, pos.coords.longitude], 16);
          handleLocation(pos.coords.latitude, pos.coords.longitude);
        });
      } else {
        alert("Geolocation is not supported by your browser.");
      }
    };
  });
</script>