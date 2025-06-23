<nav class="navbar">
  <div class="navbar-container">
    <div class="navbar-title">TidyTogether</div>
    <div class="navbar-links">
      <a href="./" class="nav-link active">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
          <path
            d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z" />
        </svg>
        Home</a>

      <div class="nav-link" style="position:relative;">
        <button id="zonesDropdownBtn" type="button" style="background:none;border:none;color:inherit;cursor:pointer;">
          Zones <span class="arrow">&#9660;</span>
        </button>
        <div class="dropdown-content" id="zonesDropdownContent" style="display:none; position:absolute; z-index:100; right:0;">
          <div style="padding:0.5em;color:#888;">Loading...</div>
        </div>
      </div>

      <a href="?civilianPage=civilianReportPage" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
          <path
            d="M200-120v-680h360l16 80h224v400H520l-16-80H280v280h-80Zm300-440Zm86 160h134v-240H510l-16-80H280v240h290l16 80Z" />
        </svg>
        Posts</a>
      <a href="?civilianPage=profilePage" class="nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
          <path
            d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z" />
        </svg>
        Profile</a>
      <a href="?civilianPage=zoneReportPage" class="nav-link">Reports</a>
    </div>
  </div>
</nav>

<script>
fetch('/TidyTogether/app/controller/civilianController.php?getFavorites=1')
  .then(res => res.json())
  .then(favorites => {
    const dropdown = document.getElementById('zonesDropdownContent');
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

// Toggle dropdown on button click
dropdownBtn.addEventListener('click', function (e) {
  e.stopPropagation();
  dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
});

// Hide dropdown when clicking outside
document.addEventListener('click', function () {
  dropdownContent.style.display = 'none';
});

// Prevent dropdown from closing when clicking inside
dropdownContent.addEventListener('click', function(e) {
  e.stopPropagation();
});

window.selectFavoriteZone = function(lat, lng, neighborhood, city) {
  localStorage.setItem('panToLat', lat);
  localStorage.setItem('panToLng', lng);
  localStorage.setItem('panToLabel', `${neighborhood}, ${city}`);
  window.location.href = '/TidyTogether/app/controller/civilianController.php?fromFavorites=1';
};
</script>