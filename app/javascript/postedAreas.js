document.addEventListener('DOMContentLoaded', function () {
  fetch('?fetch=true&getAreas=true')
    .then(res => res.json())
    .then(areas => {

      const dropdown = document.getElementById('zonesDropdownContent');
      if (!dropdown) return;

      let temp = "<div style='padding:0.5em;color:#888;'>No posted areas</div>";
      let html = "";

      if ("{}" === JSON.stringify(areas)) {
        dropdown.innerHTML = temp;
        return;
      }

      for (const userId in areas) {
        const coords = areas[userId];

        for (const coordId in coords) {
          const area = coords[coordId];
          html += `
      <div style="display: flex; align-items: center; padding: 0.25em;">
        <button type="button" style="flex: 1; text-align: left; border: none; background: none; padding: 0.5em; cursor: pointer;" 
          onclick="selectPostedArea(${area.lat}, ${area.lon}, '${area.address}')"
          onmouseover="this.style.backgroundColor='#f0f0f0'"
          onmouseout="this.style.backgroundColor='transparent'">
          ${area.address}
        </button>

        <button type="button" style="width: 2rem; background:#017852; color: #F8EFE0; border: none; padding: 0.25em 0.5em; margin-left: 0.5em; border-radius: 3px; cursor: pointer; font-size: 0.8em;" 
          onclick="deletePostedArea(${coordId}, this)"
          title="Delete this posted area">
          X
        </button>
      </div>
    `;
        }
      }

      if ("" === html) html = temp;
      dropdown.innerHTML = html;
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
  dropdownContent.addEventListener('click', function (e) {
    e.stopPropagation();
  });
});

window.selectPostedArea = function (lat, lng, address) {
  if (typeof window.panToLocation === 'function') {
    window.panToLocation(lat, lng, address);
  } else {
    localStorage.setItem('panToLat', lat);
    localStorage.setItem('panToLng', lng);
    localStorage.setItem('panToLabel', address);
    window.location.href = '?fetch=true&fromFavorites=true';
  }
};

window.deletePostedArea = function (coordId, buttonElement) {
  let temp = "<div style='padding:0.5em;color:#888;'>No posted areas</div>";
  buttonElement.disabled = true;
  buttonElement.textContent = '...';

  const formData = new FormData();
  formData.append('deleteAreaId', coordId);

  fetch('?fetch=true&deleteArea=true', {
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
          dropdown.innerHTML = temp;
        }
      } else {
        alert('Failed to delete posted area: ' + data.message);
        buttonElement.disabled = false;
        buttonElement.textContent = '✕';
      }
    })
    .catch(error => {
      console.error('Error deleting posted area:', error);
      alert('Network error occurred while deleting the posted area.');
      buttonElement.disabled = false;
      buttonElement.textContent = '✕';
    });
};
