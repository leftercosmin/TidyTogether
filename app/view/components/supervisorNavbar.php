<?php
$currentPage = $_GET['supervisorPage'] ?? '';
$isHomePage = empty($currentPage) || $currentPage === 'home';
?>

<nav class="navbar">
  <div class="navbar-container">
    <div class="navbar-title">TidyTogether</div>
    <div class="navbar-links">

      <a href="./" class="nav-link <?php echo $isHomePage ? 'active' : ''; ?>">
        <?php require_once "view/components/svg/homeSvg.php"; ?>
        Home</a>

      <a href="?supervisorPage=profilePage"
        class="nav-link <?php echo ($currentPage === 'profilePage') ? 'active' : ''; ?>">
        <?php require_once "view/components/svg/profileSvg.php"; ?>
        Profile</a>

    </div>
  </div>
</nav>