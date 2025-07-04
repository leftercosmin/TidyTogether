<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Authority Dashboard</title>
  <meta name="description" content="Authority dashboard for managing approved reports">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/globals.css">
  <link rel="stylesheet" href="style/navbar.css">
  <link rel="stylesheet" href="style/reportHistory.css">
  <link rel="stylesheet" href="style/authorityHome.css">
</head>

<body>
  <button class="menu-toggle" id="menuToggle">
      <?php require 'view/components/svg/menuSvg.php'; ?>
  </button>

  <div class="overlay" id="overlay"></div>

  <?php require_once 'view/components/authorityNavbar.php'; ?>

  <div class="report-container">
    <h1 class="page-title">Approved Reports</h1>
    <p class="reports-info">Showing the 10 oldest approved reports. Mark reports as done to see more.</p>

    <?php if (empty($approvedReports)): ?>
      <p class="empty-message">No approved reports at this time.</p>
    <?php else: ?>
      <div class="report-list">
        <?php foreach ($approvedReports as $report): ?>
          <div class="report-item">
            <h3>Report #<?php echo htmlspecialchars($report['id']); ?></h3>

            <div class="report-details">
              <div class="report-detail-row">
                <span class="report-label">Status:</span>
                <span class="report-value">
                  <span class="report-status status-<?php echo strtolower(str_replace(' ', '', $report['status'])); ?>">
                    <?php echo htmlspecialchars($report['status']); ?>
                  </span>
                </span>
              </div>

              <div class="report-detail-row">
                <span class="report-label">Address:</span>
                <span class="report-value"><?php echo htmlspecialchars($report['address']); ?></span>
              </div>

              <div class="report-detail-row">
                <span class="report-label">Description:</span>
                <span class="report-value"><?php echo htmlspecialchars($report['description']); ?></span>
              </div>

              <?php if (!empty($report['zone_name'])): ?>
                <div class="report-detail-row">
                  <span class="report-label">Zone:</span>
                  <span class="report-value"><?php echo htmlspecialchars($report['zone_name'] ?? 'N/A'); ?></span>
                </div>
              <?php endif; ?>

              <!-- MEDIA -->
              <div class="report-detail-row">
                <span class="report-label">Media:</span>
                <div class="report-media">
                  <?php
                  $idPost = $report["id"];
                  $media = $mediaAuthority[$idPost];
                  foreach ($media as $photo) {
                    echo "<img "
                      . "class=\"report-photo\" "
                      . "src=\""
                      . getSourcePhoto($photo["source"]) . "\" "
                      . "alt=\"" . $photo["name"] . "\" "
                      . "/>";
                  }
                  // . "public/background-tile.png" . "\" " // for tests
                  ?>
                </div>
              </div>

              <!-- MARKS -->
              <div class="report-detail-row">
                <span class="report-label">Marks:</span>
                <span class="report-value">
                  <?php
                  $idPost = $report["id"];
                  $marks = $marksAuthority[$idPost];
                  foreach ($marks as $tag) {
                    echo "<p "
                      . "class=\"report-dadada\">" //todo
                      . $tag["name"]
                      . "</p>";
                  }
                  ?>
                </span>
              </div>

              <div class="report-detail-row">
                <span class="report-label">Submitted:</span>
                <span class="report-value"><?php echo htmlspecialchars($report['createdAt'] ?? 'N/A'); ?></span>
              </div>

              <form method="post" action="./">
                <input type="hidden" name="postId" value="<?php echo htmlspecialchars($report['id']); ?>">
                <button type="submit" name="action" value="markDone" class="mark-done-btn">
                  Mark as Done
                </button>
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