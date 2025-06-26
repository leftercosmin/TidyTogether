<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Report History</title>
  <link rel="stylesheet" href="style/globals.css">
  <link rel="stylesheet" href="style/navbar.css">
  <link rel="stylesheet" href="style/civilianHome.css">
  <link rel="stylesheet" href="style/reportHistory.css">
</head>

<body>
  <button class="menu-toggle" id="menuToggle">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white">
      <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
    </svg>
  </button>

  <div class="overlay" id="overlay"></div>

  <?php require_once 'view/components/civilianNavbar.php'; ?>

  <div class="report-container">
    <h1 class="page-title">Your Report History</h1>
    
    <?php if (empty($posts)): ?>
      <p>You haven't submitted any reports yet.</p>
    <?php else: ?>
      <div class="report-list">
        <?php foreach ($posts as $onePost): ?>
          <div class="report-item">
            <h3>Report #<?php echo $onePost['id']; ?></h3>
            
            <div class="report-details">
              <div class="report-detail-row">
                <span class="report-label">Status:</span> 
                <span class="report-value">
                  <span class="report-status status-<?php echo strtolower($onePost['status']); ?>">
                    <?php echo $onePost['status']; ?>
                  </span>
                </span>
              </div>
              
              <div class="report-detail-row">
                <span class="report-label">Description:</span>
                <span class="report-value"><?php echo formatField($onePost['description']); ?></span>
              </div>
              
              <div class="report-detail-row">
                <span class="report-label">Address:</span>
                <span class="report-value"><?php echo $onePost['address']; ?></span>
              </div>
              
              <div class="report-detail-row">
                <span class="report-label">Zone ID:</span>
                <span class="report-value"><?php echo $onePost['idZone']; ?></span>
              </div>
              
              <div class="report-detail-row">
                <span class="report-label">Created:</span>
                <span class="report-value"><?php echo $onePost['createdAt']; ?></span>
              </div>
              
              <div class="report-detail-row">
                <span class="report-label">Last Updated:</span>
                <span class="report-value"><?php echo $onePost['updatedAt']; ?></span>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <script src="javascript/navbarCollapse.js"></script>
</body>

</html>