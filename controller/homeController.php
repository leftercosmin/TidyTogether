<?php

define("USER_CIVL", "civilian");
define("USER_SPRV", "supervisor");
define("USER_AUTH", "authority");

define("CONN", "userSession");


if (!isset($_SESSION[CONN])) {
  require_once 'controller/accountController.php';
  if (!isset($_SESSION[CONN])) {
    exit();
  }
}

$role = json_decode($_SESSION[CONN])->{"role"};
$role = str_replace(" ", "", $role);

if (USER_CIVL === $role) {
  header("Location:view/home/civilian.php");
} elseif (USER_SPRV === $role) {
  require_once 'view/home/supervisor.php';
} elseif (USER_AUTH === $role) {
  require_once 'view/home/authority.html';
}

exit("error: invalid role coockie");
