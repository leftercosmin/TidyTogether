<div id="reportModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Post a dirty area</h2>
    <form id="reportForm" method="POST" enctype="multipart/form-data">

      <!-- POST table -->
      <label for="description">Description:</label>
      <input type="text" id="description" name="postDescription">

      <label for="address">Address:</label>
      <input type="text" id="address" name="postAddress" required>

      <!-- todo determine values from address above using services -->
      <!-- ZONE table - autocompletes with the address of the user -->
      <label for="neighbourhood">Neighbourhood:</label>
      <input type="text" id="neighbourhood" name="postNeighbourhood" required>

      <label for="city">City:</label>
      <input type="text" id="city" name="postCity" value="<?php echo $location["city"]; ?>" required>

      <label for="country">Country:</label>
      <input type="text" id="country" name="postCountry" value="<?php echo $location["country"]; ?>" required>

      <!-- todo return name of the file, size, source, format -->
      <!-- MEDIA table -->
      <label for="photo">Photo (optional):</label>
      <input type="file" id="photo" name="postPhoto" accept="image/jpg, image/png, image/webm, video/mp4" multiple>

      <!-- TAG and MARK tables -->

      <?php
      foreach ($tags as $tagOne) {

        echo "<div >";

        echo "<label for=\"" . $tagOne["name"] . "\">"
          . $tagOne["name"]

          . "</label>";

        echo "<input type=checkbox "
          . "id=\"" . $tagOne["name"] . "\" "
          . "name=\postTag[]\" "
          . "value=\"" . $tagOne["name"] . "\">";

        echo "</div>";
      }
      ?>

      <div id="otherTagContainer">
        <label for="otherTag">New tag:</label>
        <input type="text" id="otherTag" name="otherTag" />
      </div>

      <button type="submit">Submit post</button>
    </form>
  </div>
</div>

<!-- add a new tag -->
<script>
  function handleTrashTypeChange() {
    const select = document.getElementById('trashType');
    const otherInputContainer = document.getElementById('otherTagContainer');
    if (select.value === 'other') {
      otherInputContainer.style.display = 'block';
      document.getElementById('otherTag').required = true;
    } else {
      otherInputContainer.style.display = 'none';
      document.getElementById('otherTag').required = false;
    }
  }
</script>

<!-- close modal -->
<script>
  const modal = document.getElementById("reportModal");
  const openBtn = document.getElementById("openReportBtn");
  const closeBtn = document.querySelector(".close");

  openBtn.onclick = () => {
    modal.style.display = "block";
  }

  closeBtn.onclick = () => {
    modal.style.display = "none";
  }

  window.onclick = (event) => {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  }

  // document.getElementById("reportForm").onsubmit = (e) => {
  //   e.preventDefault();
  //   modal.style.display = "none";
  //   alert("Thank you for your report!");
  //   e.target.reset();
  // };
</script>