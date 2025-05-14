<?php

$example = $_ENV['MAP_KEY'];
echo $example;
exit();

if (!isset($_COOKIE['userSession'])) {
  include_once 'view/login.html';
  exit();
}

include_once "model/user.php";

// get email
// get password
// $type = getUserType($) // $user = getUser();
if (null == $user) {
  echo "error";
  include_once 'view/login.html';
  exit();
}

// if civilian
// else
