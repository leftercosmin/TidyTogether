document.addEventListener('DOMContentLoaded', function() {
  fetch('/TidyTogether/app/controller/civilianController.php?getFavorites=1')
    .then(res => res.json())
    .then(favorites => {
      const dropdown = document.getElementById('zonesDropdownContent');
      if (!dropdown) return;
      
      if (!favorites.length) {
        dropdown.innerHTML = "<div style='padding:0.5em;color:#888;'>No saved zones</div>";
        return;
      }
      dropdown.innerHTML = favorites.map(fav =>
        `<button type="button" onclick="selectFavoriteZone(${fav.lat}, ${fav.lng}, '${fav.neighborhood.replace(/'/g, "\\'")}', '${fav.city.replace(/'/g, "\\'")}')">
          ${fav.neighborhood}, ${fav.city}
        </button>`
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
  window.location.href = '/TidyTogether/app/controller/civilianController.php?fromFavorites=1';
};