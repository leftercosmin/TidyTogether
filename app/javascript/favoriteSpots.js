document.addEventListener('DOMContentLoaded', function() {
  fetch('?getFavorites=1')
    .then(res => res.json())
    .then(favorites => {
      const dropdown = document.getElementById('zonesDropdownContent');
      if (!dropdown) return;
      
      if (!favorites.length) {
        dropdown.innerHTML = "<div style='padding:0.5em;color:#888;'>No saved zones</div>";
        return;
      }
      dropdown.innerHTML = favorites.map(fav =>
        `<div style="display: flex; align-items: center; padding: 0.25em;">
          <button type="button" style="flex: 1; text-align: left; border: none; background: none; padding: 0.5em; cursor: pointer;" onclick="selectFavoriteZone(${fav.lat}, ${fav.lng}, '${fav.neighborhood.replace(/'/g, "\\'")}', '${fav.city.replace(/'/g, "\\'")}')" onmouseover="this.style.backgroundColor='#f0f0f0'" onmouseout="this.style.backgroundColor='transparent'">
            ${fav.neighborhood}, ${fav.city}
          </button>        
            
          <button type="button" style="width: 2rem; background:#017852; color: #F8EFE0; border: none; padding: 0.25em 0.5em; margin-left: 0.5em; border-radius: 3px; cursor: pointer; font-size: 0.8em;" onclick="deleteFavoriteZone(${fav.idZone}, '${fav.neighborhood.replace(/'/g, "\\'")}', '${fav.city.replace(/'/g, "\\'")}', this)" title="Delete this favorite zone">
            X
          </button>
        </div>`
      ).join('');
    });

  const dropdownBtn = document.getElementById('zonesDropdownBtn');
  const dropdownContent = document.getElementById('zonesDropdownContent');
  
  dropdownBtn.addEventListener('click', function (e) {
    e.stopPropagation();
    dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
  });

  document.addEventListener('click', function () {
    dropdownContent.style.display = 'none';
  });

  //stops from closing
  dropdownContent.addEventListener('click', function(e) {
    e.stopPropagation();
  });
});

window.selectFavoriteZone = function(lat, lng, neighborhood, city) {
  localStorage.setItem('panToLat', lat);
  localStorage.setItem('panToLng', lng);
  localStorage.setItem('panToLabel', `${neighborhood}, ${city}`);
  window.location.href = 'model/favoriteZoneHandler.php?fromFavorites=1';
};

window.deleteFavoriteZone = function(zoneId, neighborhood, city, buttonElement) {
  buttonElement.disabled = true;
  buttonElement.textContent = '...';

  const formData = new FormData();
  formData.append('deleteFavorite', '1');
  formData.append('zoneId', zoneId);

  fetch('model/favoriteZoneHandler.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      const row = buttonElement.parentElement;
      row.remove();
      
      const dropdown = document.getElementById('zonesDropdownContent');
      if (dropdown.children.length === 0) {
        dropdown.innerHTML = "<div style='padding:0.5em;color:#888;'>No saved zones</div>";
      }
    } else {
      alert('Failed to delete favorite zone: ' + data.message);
      buttonElement.disabled = false;
      buttonElement.textContent = '✕';
    }
  })
  .catch(error => {
    console.error('Error deleting favorite:', error);
    alert('Network error occurred while deleting the favorite zone.');
    buttonElement.disabled = false;
    buttonElement.textContent = '✕';
  });
};
