document.addEventListener("DOMContentLoaded", function () {
  const map = L.map('map').setView([initialLat, initialLon], 12);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  const recyclingMarkersLayer = L.layerGroup();

  //Legenda
  var legend = L.control({position: 'bottomright'});
  legend.onAdd = function (map) {
    var div = L.DomUtil.create('div', 'info legend');
    var legendItems = [
      {color: 'green', label: 'Organic materials'},
      {color: 'marigold', label: 'Paper materials'},
      {color: 'blue', label: 'Glass materials'},
      {color: 'orange', label: 'Ceramic material'},
      {color: 'red', label: 'Plastic material'},
      {color: 'gray', label: 'Metal material'},
      {color: 'purple', label: 'Toxic materials'},
      {color: 'violet', label: 'Cloth materials'}
    ];
    
    legendItems.forEach(function(item) {
      div.innerHTML += '<i style="background:' + item.color + '"></i> ' + item.label + '<br>';
    });
    
    div.innerHTML += '<div style="margin-top: 8px; font-size: 11px; color: #666;">Click markers for details</div>';
    return div;
  };

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
            reportBtn.onclick = function () {
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
            favBtn.onclick = function () {
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

              fetch('model/favoriteZoneHandler.php', {
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

          const genReportBtn = document.getElementById('gen-report');
          if (genReportBtn) {
            console.log('Generate report button found:', genReportBtn);
            genReportBtn.onclick = function () {
              console.log('Generate report button clicked!');
              console.log('Current location:', currentLocation);
              const reportUrl = `?civilianPage=neighborhoodReportPage&neighborhood=${encodeURIComponent(currentLocation.neighborhood)}&city=${encodeURIComponent(currentLocation.city)}&country=${encodeURIComponent(currentLocation.country)}`;
              console.log('Navigating to:', reportUrl);
              window.location.href = reportUrl;
            };
          } else {
            console.log('Generate report button NOT found');
          }
        }, 100);
      })
      .catch(err => {
        console.error("Reverse geocoding failed", err);
      });
  }

  function loadRecyclingAreas() {
    recyclingMarkersLayer.clearLayers();

    recyclingAreasData.forEach(area => {

      let markerColor = '#4CAF50';
      if (area.tags && area.tags.length > 0) {
        if (area.tags.length === 1) {
          markerColor = area.tags[0].color || '#4CAF50';
        } else {
          markerColor = '#2196F3';
        }
      }

      const recyclingIcon = L.divIcon({
        className: 'recycling-marker',
        html: `<div style="
          background-color: ${markerColor};
          border: 2px solid #ffffff;
          border-radius: 50%;
          width: 30px;
          height: 30px;
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 12px;
          font-weight: bold;
          color: white;
        ">
         <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="white"><path d="m368-592 89-147-59-98q-12-20-34.5-20T329-837l-98 163 137 82Zm387 272-89-148 139-80 64 107q11 17 12 38t-9 39q-10 20-29.5 32T800-320h-45ZM640-40 480-200l160-160v80h190l-58 116q-11 20-30 32t-42 12h-60v80Zm-387-80q-20 0-36.5-10.5T192-158q-8-16-7.5-33.5T194-224l34-56h172v160H253Zm-99-114L89-364q-9-18-8.5-38.5T92-441l16-27-68-41 219-55 55 220-69-42-91 152Zm540-342-219-55 69-41-125-208h141q21 0 39.5 10.5T629-841l52 87 68-42-55 220Z"/></svg>
        </div>`,
        iconSize: [30, 30],
        iconAnchor: [15, 15],
        popupAnchor: [0, -15]
      });

      let tagsList = '';
      if (area.tags && area.tags.length > 0) {
        tagsList = area.tags.map(tag => 
          `<li style="color: black;">- ${tag.name}</li>`
        ).join('');
      }

      const popupContent = `
        <div style="min-width: 200px;">
          <p style="margin: 0 0 8px 0; font-size: 12px; color: #666; font-weight: bold;">
            ${area.address}
          </p>
          <div style="margin-bottom: 8px;">
            <strong style="font-size: 13px;">Accepted materials:</strong>
            <ul style="margin: 4px 0; padding-left: 16px; font-size: 12px; color: #666;">
              ${tagsList}
            </ul>
          </div>
        </div>
      `;

      const marker = L.marker([area.lat, area.lng], { icon: recyclingIcon })
        .bindPopup(popupContent);
      
      recyclingMarkersLayer.addLayer(marker);
    });
  }

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

  let recyclingAreasVisible = false;
  loadRecyclingAreas();
  
  document.getElementById('toggleRecyclingBtn').onclick = function () {
    const btn = document.getElementById('toggleRecyclingBtn');
    if (recyclingAreasVisible) {
      map.removeLayer(recyclingMarkersLayer);
      map.removeControl(legend);
      recyclingAreasVisible = false;
    } else {
      map.addLayer(recyclingMarkersLayer);
      legend.addTo(map);
      recyclingAreasVisible = true;
    }
  };

  document.getElementById('locateMeBtn').onclick = function () {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function (pos) {
        map.setView([pos.coords.latitude, pos.coords.longitude], 16);
        handleLocation(pos.coords.latitude, pos.coords.longitude);
      });
    } else {
      alert("Geolocation is not supported by your browser.");
    }
  };
});