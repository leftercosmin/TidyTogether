<?php

require_once "model/loginModel.php";
require_once "model/logoutModel.php";
require_once "model/signupModel.php";

define("USER_CIVL", "civilian");
define("USER_SPRV", "supervisor");
define("USER_AUTH", "authority");

define("CONN", "userSession");
define("PHPS", "PHPSESSID");
define("PAGE", "whatPage");

session_start();

if (
  isset($_SESSION[CONN]) &&
  isset($_POST["logout"]) &&
  "now" === $_POST["logout"]
) {
  logout();
}

// credentials inserted
if (isset($_POST["email"]) && isset($_POST["password"])) {

  if (isset($_POST["passwordAgain"])) {
    $statusModel = signup(
      $_POST["firstname"] ?? null,
      $_POST["lastname"] ?? null,
      $_POST["email"],
      $_POST["password"],
      $_POST["passwordAgain"],
      $_POST["role"]
    );
    unset(
      $_POST["firstname"],
      $_POST["lastname"],
      $_POST["email"],
      $_POST["password"],
      $_POST["passwordAgain"],
      $_POST["role"]
    );

  } else {
    $statusModel =
      login($_POST["email"], $_POST["password"]);
    unset($_POST["email"], $_POST["password"]);
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

if ("" !== $statusModel) {
  writeConsole($statusModel);
}
