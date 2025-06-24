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
  <?php require_once __DIR__ . '/../components/supervisorNavbar.php'; ?>

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

              <div class="report-detail-row">
                <span class="report-label">Tag:</span>
                <span class="report-value"><?php echo htmlspecialchars($post['tag'] ?? 'N/A'); ?></span>
              </div>

              <div class="report-detail-row">
                <span class="report-label">Created:</span>
                <span class="report-value"><?php echo htmlspecialchars($post['created_at'] ?? 'N/A'); ?></span>
              </div>

              <?php if (!empty($post['photo'])): ?>
                <div class="report-detail-row">
                  <span class="report-label">Photo:</span>
                  <span class="report-value">
                    <img src="<?= $post['photo'] ?>" alt="Report Photo" class="report-photo" />
                  </span>
                </div>
              <?php endif; ?>

              <form method="POST" class="report-actions">
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
</body>

</html>