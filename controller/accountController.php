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
  require "view/signup.html";
} else {
  require "view/login.html";
}

// credentials inserted
if (isset($_POST["email"]) && isset($_POST["password"])) {

  if (isset($_POST["passwordAgain"])) {
    require "model/signupModel.php";
  } else {
    require "model/loginModel.php";
  }
}
