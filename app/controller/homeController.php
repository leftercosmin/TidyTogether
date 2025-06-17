<?php

define("USER_CIVL", "civilian");
define("USER_SPRV", "supervisor");
define("USER_AUTH", "authority");

define("CONN", "userSession");
define("PHPS", "PHPSESSID");
define("PAGE", "whatPage");

session_start();

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
  $role = str_replace(" ", "", $role);

  if (USER_CIVL === $role) {
    header("Location:view/home/civilian.php");
  } elseif (USER_SPRV === $role) {
    header("Location:view/home/supervisor.php");
  } elseif (USER_AUTH === $role) {
    header("Location:view/home/authority.php");
  } else {
    exit("error: invalid role cookie");
  }

  exit(0);
}

// session not set && page switcher
if (isset($_POST[PAGE]) && $_POST[PAGE] == "Signup") {
  require_once "view/signup.html";
} else {
  require_once "view/login.html";
}
