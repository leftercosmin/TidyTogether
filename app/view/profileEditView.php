<!-- I AM SORRY FOR THE BIG SVG LABELS -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Profile</title>
  <link rel="stylesheet" href="style/globals.css">
  <link rel="stylesheet" href="style/navbar.css">
  <link rel="stylesheet" href="style/profileEdit.css">
</head>

<body class="profile-body">
  <button class="menu-toggle" id="menuToggle">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white">
      <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
    </svg>
  </button>

  <div class="overlay" id="overlay"></div>

  <?php
  if ($profile['role'] === 'civilian') {
    require_once 'view/components/civilianNavbar.php';
  } elseif ($profile['role'] === 'supervisor') {
    require_once 'view/components/supervisorNavbar.php';
  } elseif ($profile['role'] === 'authority') {
    require_once 'view/components/authorityNavbar.php';
  }
  ?>

  <main class="profile-container">
    <h1 class="page-title">Edit Profile</h1>

    <form method="post" action="./" class="profile-card">

      <div class="label-header">
        <label for="editfname">
          <?php require 'view/components/svg/identifierSvg.php'; ?>
          Your First Name:
        </label>
      </div>
      <input type="text" id="editfname" name="editfirstname">
      <br />

      <div class="label-header">
        <label for="editlname">
          <?php require 'view/components/svg/identifierSvg.php'; ?>
          Your Last Name:
        </label>
      </div>
      <input type="text" id="editlname" name="editlastname">
      <br />

      <div class="label-header">
        <label for="editmcity">
          <?php require 'view/components/svg/zoneSvg.php'; ?>
          Your city:
        </label>
      </div>
      <input type="text" id="editmcity" name="editmaincity">
      <br />

      <div class="buttons">

        <?php
        echo "<a "
          . "class=\"action-btn\" "
          . "href=\"?" . $profile["role"] . "Page" . "=profilePage\" "
          . ">";
        echo "Cancel";
        echo "</a>";
        ?>

        <button type="submit" class="action-btn">Save</a>
      </div>

    </form>

  </main>

  <script src="javascript/navbarCollapse.js"></script>
</body>

</html>