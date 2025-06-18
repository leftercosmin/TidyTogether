<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Home</title>
  <meta name="description" content="personal space of a regular user" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="view/home/home-style.css" />

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

  <?php require_once "view/components/civilianNavbar.php"; ?>

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


  <div id="reportModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Post a dirty area</h2>
      <form id="reportForm">

        <!-- ZONE table -->
        <label for="neighbourhood">Neighbourhood:</label>
        <input type="text" id="neighbourhood" name="neighbourhood" required>
        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>
        <label for="country">Country:</label>
        <input type="text" id="country" name="country" required>

        <!-- POST table -->
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required>
        <label for="adress">Address:</label>
        <input type="text" id="adress" name="adress" required>

        <!-- MEDIA table -->
        <label for="photo">Photo (optional):</label>
        <input type="file" id="photo" name="photo" accept="image/*">

        <!-- TAG and MARK tables -->
        <!-- name -->
        <label for="trashType">Type of trash:</label>
        <select id="trashType" name="trashType" required>
          <option value="">-- Select type --</option>
          <option value="paper">Paper/Cardboard</option>
          <option value="plastic">Plastic</option>
          <option value="glass">Glass/Ceramic</option>
          <option value="metal">Metal</option>
          <option value="organic">Organic</option>
          <option value="toxic">Toxic</option>
          <option value="other">Other</option>
        </select>

        <!-- color -->
        <div id="otherTrashTypeContainer" style="display: none; margin-top: 10px;">
          <label for="otherTrashType">Please specify:</label>
          <input type="text" id="otherTrashType" name="otherTrashType" />
        </div>

        <button type="submit">Submit post</button>
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