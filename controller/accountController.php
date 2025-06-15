<?php

define("CONN", "userSession");
define("PAGE", "whatPage");


// do not access this page manually
if (isset($_SESSION[CONN])) {
  header("Location: ../index.php");
  exit();
}

// page switcher
if ($_POST["whatPage"] == "Signup") {
  require_once "view/signup.php";
} else {
  require_once "view/login.php";
}

// credentials inserted
if (isset($_POST["email"]) && isset($_POST["password"])) {

  if (isset($_POST["passwordAgain"])) {
    require_once "model/signupModel.php";
  } else {
    require_once "model/loginModel.php";
  }
}
