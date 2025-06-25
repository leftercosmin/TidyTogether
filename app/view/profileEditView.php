<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Profile</title>
  <link rel="stylesheet" href="style/globals.css">
  <link rel="stylesheet" href="style/navbar.css">
  <link rel="stylesheet" href="style/profile.css">
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
    require_once 'components/civilianNavbar.php';
  } elseif ($profile['role'] === 'supervisor') {
    require_once 'components/supervisorNavbar.php';
  } elseif ($profile['role'] === 'authority') {
    require_once 'components/authorityNavbar.php';
  }
  ?>

  <main class="profile-container">

    <h1 class="page-title">Edit your Profile</h1>

    <form method="post" action="./" class="profile-card">

      <label for="editfname">Your First Name:</label>
      <input type="text" id="editfname" name="editfirstname">
      <br />

      <label for="editlname">Your Last Name:</label>
      <input type="text" id="editlname" name="editlastname">
      <br />

      <label for="editmcity">Your city:</label>
      <input type="text" id="editmcity" name="editmaincity">
      <br />

      <a href="./">Cancel</a>
      <button type="submit">Save</a>

    </form>

  </main>

  <script src="javascript/navbarCollapse.js"></script>
</body>

</html>