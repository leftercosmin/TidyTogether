<div id="reportModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Report a dirty area</h2>
    <form id="reportForm" method="POST" enctype="multipart/form-data">

      <!-- POST table -->
      <label for="description">Description:</label>
      <input type="text" id="description" name="postDescription">

      <label for="address">Address:</label>
      <input type="text" id="address" name="postAddress" required>

      <label for="neighbourhood">Neighbourhood:</label>
      <input type="text" id="neighbourhood" name="postNeighbourhood" required>

      <label for="city">City:</label>
      <input type="text" id="city" name="postCity" value="<?php echo $location["city"]; ?>" required>

      <label for="country">Country:</label>
      <input type="text" id="country" name="postCountry" value="<?php echo $location["country"]; ?>" required>
  
      <label for="photo">Photo (optional):</label>
      <input type="file" id="photo" name="postPhoto[]" accept="image/jpg, image/png, image/webm, video/mp4" multiple>

      <div class="form-group">
        <label for="tags">Tags:</label>
        <p>Choose the tags that best describe the dirty area.</p>
      <div class="tag-container">
          <?php
          $index = 0;
          foreach ($tags as $tagOne) {
            if (10 === $index) {
              break;
            }
            echo "<label class=\"tag-option\">";
            
            echo "<input type=checkbox "
              . "id=\"" . $tagOne["name"] . "\" "
              . "name=\"postTag$index\""
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

      <button type="submit">Submit post</button>
    </form>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById("reportModal");
    const openBtn = document.getElementById("openReportBtn");
    const closeBtn = document.querySelector(".close");
    
    function openModal() {
      modal.style.display = "block";
      document.body.style.overflow = 'hidden';
    }
    
    function closeModal() {
      modal.style.display = "none";
      document.body.style.overflow = 'auto';
    }
    
    if (openBtn) {
      openBtn.onclick = openModal;
    }
    
    if (closeBtn) {
      closeBtn.onclick = closeModal;
    }
  });
</script>