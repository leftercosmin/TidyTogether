<div id="recyclingModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Add Recycling Area</h2>

    <form id="recyclingForm" method="POST" enctype="multipart/form-data" action="./">

      <!-- javascript/authorityMapFunctionality.js sets the values -->
      <input id="hiddenLat" type="hidden" name="recyclingLat" value="" />
      <input id="hiddenLon" type="hidden" name="recyclingLon" value="" />

      <div class="form-group">
        <label for="recyclingTypes">Recycling type:</label>
        <p>Select the types of materials that can be recycled at this facility.</p>
        <div class="tag-container">
          <?php
          $index = 0;
          foreach ($tags as $tagOne) {
            if (10 === $index) {
              break;
            }
            echo "<label class=\"tag-option\">";

            echo "<input type=checkbox "
              . "id=\"recycling" . $tagOne["name"] . "\" "
              . "name=\"recyclingType$index\""
              . "value=\""
              . $tagOne["id"] . "-"
              . $tagOne["name"] . "-"
              . $tagOne["color"] . "\">";

            echo $tagOne["name"];

            echo "</label>";

            $index += 1;
          }
          ?>
        </div>
      </div>

      <button type="submit">Add Recycling Area</button>
    </form>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const recyclingModal = document.getElementById("recyclingModal");
    const closeBtn = recyclingModal.querySelector(".close");

    window.openRecyclingModal = function (location) {
      if (location) {
        //document.getElementById('address').value = location.address || '';
        //document.getElementById('neighbourhood').value = location.neighborhood || '';
        //document.getElementById('city').value = location.city || '';
      }
      recyclingModal.style.display = "block";
      document.body.style.overflow = 'hidden';
    }

    function closeRecyclingModal() {
      recyclingModal.style.display = "none";
      document.body.style.overflow = 'auto';
    }

    if (closeBtn) {
      closeBtn.onclick = closeRecyclingModal;
    }
  });
</script>