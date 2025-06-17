<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Home</title>
  <meta name="description" content="personal space of a regular user" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="home-style.css" />

  <script>
    async function init() {
      await customElements.whenDefined("gmp-map");

      const map = document.querySelector("gmp-map");
      const marker = document.querySelector("gmp-advanced-marker");
      const placePicker = document.querySelector("gmpx-place-picker");
      const infowindow = new google.maps.InfoWindow();

      map.innerMap.setOptions({
        mapTypeControl: false,
      });

      placePicker.addEventListener("gmpx-placechange", () => {
        const place = placePicker.value;

        if (!place.location) {
          window.alert(
            "No details available for input: '" + place.name + "'"
          );
          infowindow.close();
          marker.position = null;
          return;
        }

        if (place.viewport) {
          map.innerMap.fitBounds(place.viewport);
        } else {
          map.center = place.location;
          map.zoom = 17;
        }

        marker.position = place.location;
        infowindow.setContent(
          `<strong>${place.displayName}</strong><br>
             <span>${place.formattedAddress}</span>
          `
        );
        infowindow.open(map.innerMap, marker);
      });
    }

    document.addEventListener("DOMContentLoaded", init);
  </script>
  <script type="module"
    src="https://ajax.googleapis.com/ajax/libs/@googlemaps/extended-component-library/0.6.11/index.min.js"></script>

</head>

<body>

  <nav class="navbar">
    <div class="navbar-container">
      <div class="navbar-title">TidyTogether</div>
      <div class="navbar-links">
        <a href="civilian.php" class="nav-link active"> 
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z"/></svg>
            Home</a>
        <a href="report-history.html" class="nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M200-120v-680h360l16 80h224v400H520l-16-80H280v280h-80Zm300-440Zm86 160h134v-240H510l-16-80H280v240h290l16 80Z"/></svg>
            Reports</a>
        <a href="profile.html" class="nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z"/></svg>
            Profile</a>
      </div>
    </div>
  </nav>

  <div class="map-container">
    <!-- using php to generate the secret key -->
    <?php
    echo "<gmpx-api-loader key=";
    echo "\"" . getenv("MAP_KEY") . "\"";
    echo "solution-channel=\"GMP_GE_mapsandplacesautocomplete_v2\">";
    ?>
    </gmpx-api-loader>
    
    <div class="map-top-bar">
      <div class="place-picker-container">
        <gmpx-place-picker placeholder="Enter an address"></gmpx-place-picker>
      </div>
      <button id="openReportBtn" class="report-btn"> 
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg> 
        Report a dirty area
      </button>
    </div>

    <gmp-map center="40.749933,-73.98633" zoom="13" map-id="DEMO_MAP_ID">
      <gmp-advanced-marker></gmp-advanced-marker>
    </gmp-map>
  </div>

  
    <div id="reportModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Report a dirty area</h2>
      <form id="reportForm">
        
        <label for="location">Location description:</label>
        <input type="text" id="location" name="location" required>

        <label for="trashType">Type of trash:</label>
        <select id="trashType" name="trashType" required>
          <option value="">-- Select type --</option>
          <option value="paper">Paper/Cardboard</option>
          <option value="plastic">Plastic</option>
          <option value="glass">Glass/Ceramic</option>
          <option value="metal">Metal</option>
          <option value="organic">Organic</option>
          <option value="toxic">Toxic</option>
        </select>

        <label for="photo">Photo (optional):</label>
        <input type="file" id="photo" name="photo" accept="image/*">

        <input type="hidden" id="reportTimestamp" name="timestamp">

        <label for="details">Details:</label>
        <textarea id="details" name="details" rows="4" placeholder="Add any useful notes (size, hazard, etc.)"></textarea>

        <button type="submit">Submit report</button>
      </form>
    </div>
  </div>

</div>

<script>
  const modal = document.getElementById("reportModal");
  const openBtn = document.getElementById("openReportBtn");
  const closeBtn = document.querySelector(".close");

  openBtn.onclick = () => {
    modal.style.display = "block";
  }

  closeBtn.onclick = () => {
    modal.style.display = "none";
  }

  window.onclick = (event) => {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  }

  document.getElementById("reportForm").onsubmit = (e) => {
    e.preventDefault();
    console.log("Submitted:", {
      location: e.target.location.value,
      details: e.target.details.value,
      photo: e.target.photo.files[0]
    });
    modal.style.display = "none";
    alert("Thank you for your report!");
    e.target.reset();
  };
</script>
</body>

</html>