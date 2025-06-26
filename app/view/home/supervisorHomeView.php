<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Supervisor Dashboard</title>
  <meta name="description" content="Supervisor dashboard for approving/rejecting reports">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/globals.css">
  <link rel="stylesheet" href="style/navbar.css">
  <link rel="stylesheet" href="style/reportHistory.css">
  <link rel="stylesheet" href="style/supervisorHome.css">
</head>

<body>
  <button class="menu-toggle" id="menuToggle">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white">
      <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
    </svg>
  </button>

  <div class="overlay" id="overlay"></div>

  <?php require_once 'components/supervisorNavbar.php'; ?>

  <div class="report-container">
    <h1 class="page-title">Pending Reports</h1>

    <?php if (empty($pendingPosts)): ?>
      <p class="empty-message">No reports are pending at this time.</p>
    <?php else: ?>
      <div class="report-list">
        <?php foreach ($pendingPosts as $post): ?>
          <div class="report-item">
            <h3>Report #<?php echo htmlspecialchars($post['id']); ?></h3>

            <div class="report-details">
              <div class="report-detail-row">
                <span class="report-label">Submitted By:</span>
                <span class="report-value">
                  <?php echo htmlspecialchars($post['fname'] ?? 'N/A') . ' ' . htmlspecialchars($post['lname'] ?? ''); ?>
                </span>
              </div>

              <!-- MEDIA -->
              <div class="report-detail-row">
                <span class="report-label">Media:</span>
                <div class="report-media">
                  <?php
                  $idPost = $post["id"];
                  $media = $mediaSupervisor[$idPost];
                  foreach ($media as $photo) {
                    echo "<img "
                      . "class=\"report-photo\""
                      . "src=\""
                      . getSourcePhoto($photo["source"]) . "\" "
                      . "alt=\"" . $photo["name"] . "\" "
                      . "/>";
                  }
                  ?>
                </div>
              </div>

              <div class="report-detail-row">
                <span class="report-label">Description:</span>
                <span class="report-value"><?php echo htmlspecialchars($post['description'] ?? 'N/A'); ?></span>
              </div>

              <div class="report-detail-row">
                <span class="report-label">Address:</span>
                <span class="report-value">
                  <?php echo htmlspecialchars($post['address']) ?>
                  (<?php echo htmlspecialchars($post['neighbourhood'] ?? 'N/A') ?>,
                  <?php echo htmlspecialchars($post['city'] ?? 'N/A') ?>,
                  <?php echo htmlspecialchars($post['country'] ?? 'N/A') ?>)
                </span>
              </div>

              <!-- MARKS -->
              <div class="report-detail-row">
                <span class="report-label">Marks:</span>
                <span class="report-value">
                  <?php
                  $idPost = $post["id"];
                  $marks = $marksSupervisor[$idPost];
                  foreach ($marks as $tag) {
                    echo "<p "
                      . "class=\"report-dadada\">"
                      . $tag["name"]
                      . "</p>";
                  }
                  ?>
                </span>
              </div>

              <div class="report-detail-row">
                <span class="report-label">Created At:</span>
                <span class="report-value"><?php echo htmlspecialchars($post['createdAt'] ?? 'N/A'); ?></span>
              </div>

              <form method="post" class="report-actions">
                <input type="hidden" name="postId" value="<?= $post['id'] ?>">
                <button type="submit" name="action" value="accept" class="btn">Accept</button>
                <button type="submit" name="action" value="reject" class="btn btn-reject">Reject</button>
              </form>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <script src="javascript/navbarCollapse.js"></script>
</body>

</html>