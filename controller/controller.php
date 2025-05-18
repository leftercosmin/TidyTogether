<?php

if (!isset($_COOKIE['userSession'])) {
  include_once 'controller/accountController.php';
  exit();
}

echo 'warning exit, should not exit here';
exit();
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
include_once 'view/dashboard/civilian.php';
exit();
// else
