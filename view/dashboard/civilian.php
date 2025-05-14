<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>dashboard</title>
  <meta name="description" content="personal space of a regular user" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="" />

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
  <style>
    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    .place-picker-container {
      padding: 20px;
    }
  </style>
</head>

<body>

  <!-- using php to generate the secret key -->
  <?php
  echo "<gmpx-api-loader key=";
  echo $_ENV["MAP_KEY"];
  echo "solution-channel=\"GMP_GE_mapsandplacesautocomplete_v2\">";
  ?>

  </gmpx-api-loader>
  <gmp-map center="40.749933,-73.98633" zoom="13" map-id="DEMO_MAP_ID">
    <div slot="control-block-start-inline-start" class="place-picker-container">
      <gmpx-place-picker placeholder="Enter an address"></gmpx-place-picker>
    </div>
    <gmp-advanced-marker></gmp-advanced-marker>
  </gmp-map>
</body>

</html>