<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Profile</title>
  <link rel="stylesheet" href="style/globals.css">
  <link rel="stylesheet" href="style/navbar.css">
  <link rel="stylesheet" href="style/profile.css">

  <style>
    body {
      background-color: var(--green);
    }

    body.profile-body {
      background-color: var(--green);
    }

    .profile-container {
      margin-left: 250px;
      padding: 2rem;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .profile-card {
      background-color: var(--offwhite1);
      border-radius: 8px;
      padding: 2rem;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      border-left: 4px solid var(--green);
    }

    .profile-card h2 {
      margin-top: 0;
      color: var(--green);
      font-size: 1.8rem;
      margin-bottom: 1.5rem;
      padding-bottom: 0.5rem;
      border-bottom: 1px solid #eee;
    }

    .profile-details {
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
      margin-bottom: 2rem;
    }

    .profile-detail-row {
      display: flex;
      margin-bottom: 0.5rem;
    }

    .profile-label {
      font-weight: 600;
      color: #555;
      width: 120px;
      flex-shrink: 0;
    }

    .profile-value {
      flex: 1;
    }

    .role-badge {
      display: inline-block;
      padding: 0.3rem 0.7rem;
      border-radius: 20px;
      font-size: 0.9rem;
      font-weight: 600;
      background-color: #d4edda;
      color: #155724;
      text-transform: capitalize;
    }

    .edit-btn {
      text-decoration: none;
      background-color: var(--green);
      color: white;
      border: none;
      padding: 0.85em 2em;
      border-radius: 50px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.2s;
      width: 100%;
    }

    .edit-btn:hover {
      background-color: #015c3f;
    }

    .logout-btn {
      text-decoration: none;
      background-color: var(--green);
      color: white;
      border: none;
      padding: 0.85em 2em;
      border-radius: 50px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.2s;
      margin-top: 1.5rem;
      width: 100%;
    }

    .logout-btn:hover {
      background-color: #015c3f;
    }

    .page-title {
      font-size: 2.5em;
      margin-bottom: 2rem;
      margin-left: 2rem;
      color: var(--offwhite1);
      align-self: center;
    }
  </style>
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
</body>

</html>