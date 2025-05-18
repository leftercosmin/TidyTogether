<?php

define("CONN", "userSession");
define("PAGE", "whatPage");


// do not access this page manually
if (isset($_SESSION[CONN])) {
  header("Location: ../index.php");
  exit();
}

// credentials inserted
if (isset($_POST["email"]) && isset($_POST["password"])) {

  if ($_POST[PAGE] == "Signup") {
    include_once "model/signupModel.php";
    exit();
  }

  include_once "model/loginModel.php";
  exit();
}

// page switcher
if ($_POST["whatPage"] == "Signup") {
  include_once "view/signup.html";
  exit();
}

include_once "view/login.html";
exit();
