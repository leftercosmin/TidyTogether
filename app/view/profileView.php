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
    <h1 class="page-title">Your Profile</h1>

    <section class="profile-card">
      <h2>
        <?php echo formatField($profile['fname']) . ' ' . formatField($profile['lname']); ?>
      </h2>

      <div class="profile-details">
        <div class="profile-detail-row">
          <span class="profile-label">Email:</span>
          <span class="profile-value"><?php echo $profile['email']; ?></span>
        </div>

        <div class="profile-detail-row">
          <span class="profile-label">Main City:</span>
          <span class="profile-value">
            <?php echo $profile['mainCity'] ?? "N/A"; ?></span>
        </div>

        <div class="profile-detail-row">
          <span class="profile-label">Role:</span>
          <span class="profile-value">
            <span class="role-badge"><?php echo $profile['role']; ?></span>
          </span>
        </div>

        <div class="profile-detail-row">
          <span class="profile-label">Member since:</span>
          <span class="profile-value"><?php echo date('F j, Y', strtotime($profile['createdAt'])); ?></span>
        </div>

        <div class="profile-detail-row">
          <span class="profile-label">Last updated:</span>
          <span class="profile-value"><?php echo date('F j, Y', strtotime($profile['updatedAt'])); ?></span>
        </div>
      </div>

      <?php
      echo "<a "
        . "class=\"edit-btn\" "
        . "href=\"?" . $profile["role"] . "Page" . "=editProfilePage\" "
        . ">";
      echo "Edit Profile";
      echo "</a>";
      ?>

      <form method="post" action="./">
        <input type="hidden" name="logout" value="now" />
        <button class="logout-btn" type="submit">
          Logout
        </button>
      </form>

    </section>
  </main>

  <script src="javascript/navbarCollapse.js"></script>
</body>

</html>