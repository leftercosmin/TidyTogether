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
      <label for="editlname">Your Last Name:</label>
      <label for="editmcity">Your city:</label>
      <input type="text" id="editfname" name="editfirstname">
      <input type="text" id="editlname" name="editlastname">
      <input type="text" id="editmcity" name="editmaincity">
      <a href="./">Cancel</a>
      <button type="submit">Save</a>
    </form>

  </main>
</body>

</html>