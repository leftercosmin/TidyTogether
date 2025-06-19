<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/civilianHome.css">
  <link rel="stylesheet" href="style/supervisorHome.css">
</head>

<body>
  <?php require_once "view/components/supervisorNavbar.php"; ?>
    
  <div class="container">
    <h1 class="page-title">Pending reports</h1>
    <p class="below-title">Here you can accept or reject pending reports.</p>

    <ul class="report-list">
      <?php foreach ($pendingPosts as $post) : ?>
        <li>
          <p><strong>ID: </strong>
            <?php echo htmlspecialchars($post['id']); ?></p>
          <p><strong>Description: </strong>
            <?php echo htmlspecialchars($post['description'] ?? "No description available."); ?></p>
          <p><strong>Address: </strong>
            <?php echo htmlspecialchars($post['address'])?> (<?php echo htmlspecialchars($post['neighbourhood']) ?>, <?php echo htmlspecialchars($post['city']) ?>, <?php echo htmlspecialchars ($post['country']) ?>)</p>
          <p><strong>Posted by user with ID: </strong>
            <?php echo htmlspecialchars($post['idUser']); ?></p>
          <p><strong>Tag: </strong>
            <?php echo htmlspecialchars($post['tag']); ?></p>
          <p><strong>Created at: </strong>
            <?php echo htmlspecialchars($post['created_at']); ?></p>

          <?php if (!empty($post['photo'])): ?>
            <img src="<?= $post['photo'] ?>" alt="Report Photo" style="max-width: 300px; height: auto; margin-top: 10px;" />
          <?php endif; ?>

          <form method="POST" style="margin-top: 10px;">
            <input type="hidden" name="postId" value="<?= $post['id'] ?>">
            <button type="submit" name="action" value="accept">Accept</button>
            <button type="submit" name="action" value="reject">Reject</button>
          </form>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

</body>
</html>