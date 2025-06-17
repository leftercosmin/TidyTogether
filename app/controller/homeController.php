<?php

define("USER_CIVL", "civilian");
define("USER_SPRV", "supervisor");
define("USER_AUTH", "authority");

define("CONN", "userSession");
define("PHPS", "PHPSESSID");


if (!isset($_SESSION[PHPS])) {
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
  header("Location:view/home/supervisor.php");
} elseif (USER_AUTH === $role) {
  header("Location:view/home/authority.php");
}

exit("error: invalid role cookie");
