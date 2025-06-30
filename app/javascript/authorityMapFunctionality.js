document.addEventListener("DOMContentLoaded", function () {
  const map = L.map('map').setView([initialLat, initialLon], 16);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  if (typeof cityBounds !== 'undefined' && cityBounds) {
    const bounds = L.latLngBounds(
      [cityBounds.south, cityBounds.west],
      [cityBounds.north, cityBounds.east]
    );

    map.setMaxBounds(bounds);
    map.fitBounds(bounds);
    const boundaryRectangle = L.rectangle(bounds, {
      color: '#017852',
      weight: 3,
      opacity: 0.5,
      fillOpacity: 0,
    }).addTo(map);
  }

  const geocoderControl = new L.Control.Geocoder({
    defaultMarkGeocode: false,
    placeholder: "Search within your city area..."
  }).addTo(map);

  let userMarker = null;
  let fetchController = null;
  let currentLocation = null;

  function handleLocation(lat, lng) {

    if (typeof cityBounds !== 'undefined' && cityBounds) {
      if (lat < cityBounds.south || lat > cityBounds.north ||
        lng < cityBounds.west || lng > cityBounds.east) {
        alert("You can only add recycling areas in the city you operate in.");
        return;
      }
    }

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

        const street = data.address.road || data.address.street || "";
        const shortAddress = street ? `${street}, ${neighborhood}` : neighborhood;

        const popupContent = `
          <div style="display: flex; flex-direction: column; gap: 6px;">
            <div style="font-weight: bold; margin-bottom: 8px;">${shortAddress}</div>
            <button style="border-radius: 50px; padding: 0.85em; background-color: var(--base-color); color: var(--accent-color); cursor: pointer;" id="add-recycling-area">Add recycling area</button>
          </div>
        `;

        userMarker.setPopupContent(popupContent);

        setTimeout(() => {
          const addRecyclingBtn = document.getElementById('add-recycling-area');
          if (addRecyclingBtn) {
            addRecyclingBtn.onclick = function () {
              window.currentRecyclingLocation = currentLocation;

              const modal = document.getElementById("recyclingModal");
              if (modal) {
                document.getElementById('hiddenAdd').value = shortAddress ?? 'error';
                document.getElementById('hiddenLat').value = currentLocation.lat ?? 'error';
                document.getElementById('hiddenLon').value = currentLocation.lng ?? 'error';
                modal.style.display = "block";
              }
            };
          }
        }, 100);
      })
      .catch(err => {
        console.error("Reverse geocoding failed", err);
        userMarker.setPopupContent('<div>Unable to load location details</div>');
      });
  }

  //check for stored location to move to
  const panLat = localStorage.getItem('panToLat');
  const panLng = localStorage.getItem('panToLng');
  const panLabel = localStorage.getItem('panToLabel');

  if (panLat && panLng) {
    console.log("Panning to:", panLat, panLng, panLabel);
    map.setView([parseFloat(panLat), parseFloat(panLng)], 16);

    handleLocation(parseFloat(panLat), parseFloat(panLng));

    localStorage.removeItem('panToLat');
    localStorage.removeItem('panToLng');
    localStorage.removeItem('panToLabel');
  }

  //map listeners
  map.on('click', function (e) {
    console.log('Map clicked', e.latlng);
    const { lat, lng } = e.latlng;
    handleLocation(lat, lng);
  });

  geocoderControl.on('markgeocode', function (e) {
    const latlng = e.geocode.center;
    map.setView(latlng, 16);
    handleLocation(latlng.lat, latlng.lng);
  });

  document.getElementById('locateMeBtn').onclick = function () {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function (pos) {
        const userLat = pos.coords.latitude;
        const userLng = pos.coords.longitude;

        if (typeof cityBounds !== 'undefined' && cityBounds) {
          if (userLat < cityBounds.south || userLat > cityBounds.north ||
            userLng < cityBounds.west || userLng > cityBounds.east) {
            map.setView([initialLat, initialLon], 16);
            return;
          }
        }

        map.setView([userLat, userLng], 16);
        handleLocation(userLat, userLng);
      });
    } else {
      alert("Geolocation is not supported by your browser.");
    }
  };

  if (typeof userCityName !== 'undefined' && userCityName) {
    const cityInfoControl = L.control({ position: 'topright' });
    cityInfoControl.onAdd = function (map) {
      const div = L.DomUtil.create('div', 'city-info-control');
      div.innerHTML = `
        <div style="background: white; padding: 10px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
          <strong>Authority Area:</strong><br>
          ${userCityName}
        </div>
      `;
      return div;
    };
    cityInfoControl.addTo(map);
  }
});
