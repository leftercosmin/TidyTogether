<?php

define("USER_CIVL", 0);
define("USER_SPRV", 1);
define("USER_AUTH", 2);

define("CONN", "userSession");
define("ROLE", "role");


if (!isset($_SESSION[CONN])) {
  require_once 'controller/accountController.php';
  if (!isset($_SESSION[CONN])) {
    exit();
  }
}

if (!isset($_SESSION[ROLE])) {
  exit("error: invalid session coockie");
}

if (USER_CIVL === $_SESSION[ROLE]) {
  require_once 'view/home/civilian.php';
} elseif (USER_SPRV === $_SESSION[ROLE]) {
  require_once 'view/home/supervisor.php';
} elseif (USER_AUTH === $_SESSION[ROLE]) {
  require_once 'view/home/authority.html';
}

exit("error: invalid role coockie");
