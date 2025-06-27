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
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
            <path
              d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z" />
          </svg>
          Your First Name:
        </label>
      </div>
      <input type="text" id="editfname" name="editfirstname">
      <br />

      <div class="label-header">
        <label for="editlname">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
            <path
              d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z" />
          </svg>
          Your Last Name:
        </label>
      </div>
      <input type="text" id="editlname" name="editlastname">
      <br />

      <div class="label-header">
        <label for="editmcity">
          <svg fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" xml:space="preserve">
            <path d="M12,2C8.1,2,5,5.1,5,9c0,6,7,13,7,13s7-7.1,7-13C19,5.1,15.9,2,12,2z M12,11.5c-1.4,0-2.5-1.1-2.5-2.5s1.1-2.5,2.5-2.5
  s2.5,1.1,2.5,2.5S13.4,11.5,12,11.5z" />
          </svg>
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