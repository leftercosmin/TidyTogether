<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Profile</title>
  <link rel="stylesheet" href="view/home/home-style.css" />
  <link rel="stylesheet" href="view/home/profile-style.css" />
</head>

<body>

  <?php require_once "view/components/civilianNavbar.php"; ?>

  <main class="profile-container">
    <section class="profile-card">
      <h2 class="username">
        <?php
        echo formatField($profile['fname']) . ' '
          . formatField($profile['lname'])
          ?>
      </h2>
      <p class="email"><?php echo $profile['email'] ?></p>
      <p class="role"><?php echo $profile['role'] ?></p>
      <p class="timeCreate"><?php echo $profile['createdAt'] ?></p>
      <p class="timeUpdate"><?php echo $profile['updatedAt'] ?></p>

      <form method="post" action="./">
        <input hidden name="logout" value="now" />
        <button class="edit-btn" type="submit">
          Logout
        </button>
      </form>

    </section>
  </main>
</body>

</html>