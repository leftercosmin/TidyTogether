<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Authority home</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/authorityHome.css">
  <link rel="stylesheet" href="style/civilianHome.css">
  
</head>

<body>
  <?php require_once "view/components/authorityNavbar.php"; ?>
  
  <div class="container">
    <h1>Reports:</h1>
    <?php if (empty($approvedReports)): ?>
      <p>No approved reports at this time.</p>
    <?php else: ?>
      <ul class="report-list">
        <?php foreach ($approvedReports as $report): ?>
          <li class="report-item">
            <strong><?php echo htmlspecialchars($report['address']) ?></strong><br>
            <?php echo htmlspecialchars($report['description']) ?><br>
            <span>Status: 
              <?php echo htmlspecialchars($report['status']) ?></span>
            <?php if ($report['status'] === 'inProgress'): ?>
              <form class="accept-task-btn" method="POST" style="margin-top:10px;">
                <input type="hidden" name="postId" value="<?php echo htmlspecialchars($report['id']); ?>">
                <button type="submit" name="action" value="markDone">Mark as Done</button>
              </form>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>

</body>

</html>