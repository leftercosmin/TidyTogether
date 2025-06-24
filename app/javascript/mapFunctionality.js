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
                  favBtn.style.backgroundColor = "#4CAF50";
                } else {
                  favBtn.textContent = "Failed - Try Again";
                  favBtn.disabled = false;
                  favBtn.style.backgroundColor = "#f44336";
                }
              })
              .catch(error => {
                console.error('Error saving favorite:', error);
                favBtn.textContent = "Network Error - Try Again";
                favBtn.disabled = false;
                favBtn.style.backgroundColor = "#f44336";
              });
            };
          }
        }, 100);
      })
      .catch(err => {
        console.error("Reverse geocoding failed", err);
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