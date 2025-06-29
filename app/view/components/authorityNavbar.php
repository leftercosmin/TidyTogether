<?php
$currentPage = $_GET['authorityPage'] ?? '';
$isHomePage = empty($currentPage) || $currentPage === 'home';
?>

<nav class="navbar">
  <div class="navbar-container">
    <div class="navbar-title">TidyTogether</div>

    <div class="navbar-links">
      <a href="./" class="nav-link <?php echo $isHomePage ? 'active' : ''; ?>">
        <?php require_once "view/components/svg/homeSvg.php"; ?>
        Home</a>

      <a href="?authorityPage=areaPage" class="nav-link <?php echo ($currentPage === 'areaPage') ? 'active' : ''; ?>">
        <?php require_once "view/components/svg/zoneSvg.php"; ?>
        Area</a>

      <a href="?authorityPage=profilePage"
        class="nav-link <?php echo ($currentPage === 'profilePage') ? 'active' : ''; ?>">
        <?php require_once "view/components/svg/profileSvg.php"; ?>
        Profile</a>

    </div>
  </div>
</nav>