<?php

// todo if connected send back to index

if (isset($_POST["whatPage"]) && $_POST["whatPage"] == "Signup") {
  include_once "view/signup.html";
  exit();
}

include_once "view/login.html";
exit();
