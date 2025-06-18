<?php

define("USER_CIVL", "civilian");
define("USER_SPRV", "supervisor");
define("USER_AUTH", "authority");

define("CONN", "userSession");
define("PHPS", "PHPSESSID");
define("PAGE", "whatPage");

session_start();

if (isset($_POST["logout"])) {
  
  unset($_SESSION[CONN]);
  session_destroy();
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
      session_name(),
      '',
      0,
      $params["path"],
      $params["domain"],
      $params["secure"],
      $params["httponly"]
    );
  }

  unset($_POST['logout']);
}

// credentials inserted
if (isset($_POST["email"]) && isset($_POST["password"])) {

  if (isset($_POST["passwordAgain"])) {
    require_once "model/signupModel.php";
  } else {
    require_once "model/loginModel.php";
  }
}

// redirect home
if (isset($_SESSION[CONN])) {

  $role = json_decode($_SESSION[CONN])->{"role"};
  if (USER_CIVL === $role) {
    require_once "controller/civilianController.php";
  } elseif (USER_SPRV === $role) {
    require_once "controller/supervisorController.php";
  } elseif (USER_AUTH === $role) {
    require_once "controller/authorityController.php";
  } else {
    exit("error: invalid role cookie");
  }

  exit();
}

// session not set && page switcher
if (isset($_POST[PAGE]) && $_POST[PAGE] == "Signup") {
  require_once "view/signup.html";
} else {
  require_once "view/login.html";
}
