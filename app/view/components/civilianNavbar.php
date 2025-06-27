<?php
$currentPage = $_GET['civilianPage'] ?? '';
$isHomePage = empty($currentPage) || $currentPage === 'home';
?>

<nav class="navbar">
  <div class="navbar-container">
    <div class="navbar-title">TidyTogether</div>

    <div class="navbar-links">

      <a href="./" class="nav-link <?php echo $isHomePage ? 'active' : ''; ?>">
        <?php require_once "view/components/svg/homeSvg.php"; ?>
        Home
      </a>

      <a href="?civilianPage=civilianReportPage"
        class="nav-link <?php echo ($currentPage === 'civilianReportPage') ? 'active' : ''; ?>">
        <?php require_once "view/components/svg/postSvg.php"; ?>
        Report history
      </a>

      <a href="?civilianPage=profilePage"
        class="nav-link <?php echo ($currentPage === 'profilePage') ? 'active' : ''; ?>">
        <?php require_once "view/components/svg/profileSvg.php"; ?>
        Profile
      </a>

      <a href="?civilianPage=zoneReportPage"
        class="nav-link <?php echo ($currentPage === 'zoneReportPage') ? 'active' : ''; ?>">
        <?php require_once "view/components/svg/reportSvg.php"; ?>
        Reports
      </a>
      
    </div>
  </div>
</nav>