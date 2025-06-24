<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Authority Dashboard</title>
  <meta name="description" content="Authority dashboard for managing approved reports">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/TidyTogether/app/style/globals.css">
  <link rel="stylesheet" href="/TidyTogether/app/style/navbar.css">
  <link rel="stylesheet" href="/TidyTogether/app/style/reportHistory.css">
  <style>
    body {
      background-color: var(--green);
    }
    
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
    
    .status-approved {
      background-color: #D4EDDA;
      color: #155724;
    }
    
    .status-inprogress {
      background-color: #FFF3CD;
      color: #856404;
    }
    
    .status-done {
      background-color: #D1ECF1;
      color: #0C5460;
    }
    
    .report-status {
      display: inline-block;
      padding: 0.3rem 0.7rem;
      border-radius: 20px;
      font-size: 0.9rem;
      font-weight: 600;
    }
    
    .empty-message {
      color: var(--offwhite1);
      text-align: center;
      font-size: 1.2rem;
      margin-top: 2rem;
    }
  </style>
</head>

<body>
  <?php require_once __DIR__ . '/../components/authorityNavbar.php'; ?>
  
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
              
              <div class="report-detail-row">
                <span class="report-label">Submitted:</span>
                <span class="report-value"><?php echo htmlspecialchars($report['createdAt'] ?? 'N/A'); ?></span>
              </div>
              
              <?php if ($report['status'] === 'inProgress' || $report['status'] === 'approved'): ?>
                <form method="POST">
                  <input type="hidden" name="postId" value="<?php echo htmlspecialchars($report['id']); ?>">
                  <button type="submit" name="action" value="markDone" class="mark-done-btn">
                    Mark as Done
                  </button>
                </form>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>