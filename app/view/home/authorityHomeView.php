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

  <style>
    .mark-done-btn {
      background-color: var(--green);
      color: white;
      border: none;
      padding: 0.6rem 1.2rem;
      border-radius: 20px;
      font-size: 0.9rem;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.2s;
      margin-top: 1rem;
    }

    .mark-done-btn:hover {
      opacity: 0.9;
    }

    .empty-message {
      color: var(--offwhite1);
      text-align: center;
      font-size: 1.2rem;
      margin-top: 2rem;
    }

    h1 {
      color: var(--base-color);
      margin-top: 1rem;
      text-align: center;
    }

    .container {
      width: 500px;
      margin: 2rem auto;
      background: #faf8eb;
      color: #253d24;
      border-radius: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.13);
      padding: 2rem;
    }

    .report-list {
      list-style: none;
      padding: 0;
    }

    .report-item {
      background: #2a482a;
      color: #faf8eb;
      margin-bottom: 1.2rem;
      padding: 1.2rem 1.5rem;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(56, 98, 55, 0.08);
      transition: background 0.2s;
    }

    .report-item:hover {
      background: #386237;
    }

    .report-item strong {
      font-size: 1.1em;
      color: #e8e0ac;
    }

    .report-item span {
      display: block;
      margin-top: 0.5rem;
      font-size: 0.98em;
      color: #e8e0ac;
    }

    .accept-task-btn {
      display: flex;
      gap: 1rem;
      margin-top: 1rem;
    }

    .accept-task-btn button {
      background: var(--base-color);
      color: var(--accent-color);
      border: none;
      border-radius: 6px;
      padding: 0.5rem 1.5rem;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.2s;
    }

    .accept-task-btn button:hover {
      background: #457145;
    }

    .report-media {
      display: flex;
      justify-content: center;
    }

    .report-photo {
      width: 100%;
      max-width: 3rem;
      border-radius: 4px;
      margin: 0.2rem;
    }
  </style>
</head>

<body>

  <?php require_once 'view/components/authorityNavbar.php'; ?>

  <div class="report-container">
    <h1 class="page-title">Approved Reports</h1>

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
</body>

</html>