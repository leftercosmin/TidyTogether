<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Posts</title>
  <link rel="stylesheet" href="style/home.css" />
  <link rel="stylesheet" href="style/profile.css" />
</head>

<body>

  <?php require_once "view/components/civilianNavbar.php"; ?>

  <main class="profile-container">
    <section class="report-history">
      <h2>Your past reports</h2>
      <ul class="report-list">
        <?php
        foreach ($posts as $onePost) {
          echo "<li>";
          echo "<p>" . $onePost['id'] . "</p>";
          echo "<p>" . formatField($onePost['description']) . "</p>";
          echo "<p>" . $onePost['status'] . "</p>";
          echo "<p>" . $onePost['idZone'] . "</p>";
          echo "<p>" . $onePost['address'] . "</p>";
          echo "<p>" . $onePost['createdAt'] . "</p>";
          echo "<p>" . $onePost['updatedAt'] . "</p>";
          echo "</li>";
        }
        ?>
      </ul>
    </section>
  </main>
</body>

</html>