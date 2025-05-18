<?php

define("USER_CIVL", 0);
define("USER_SPRV", 1);
define("USER_AUTH", 2);

define("CONN", "userSession");
define("ROLE", "role");


if (!isset($_SESSION[CONN])) {
  include_once 'controller/accountController.php';
  exit();
}

if (!isset($_SESSION[ROLE]) || null == $_SESSION[ROLE]) {
  echo "error: invalid session coockie";
  exit();
}

if (USER_CIVL === $_SESSION[ROLE]) {
  include_once 'view/home/civilian.php';
  exit();
} elseif (USER_SPRV === $_SESSION[ROLE]) {
  include_once 'view/home/supervisor.php';
  exit();
} elseif (USER_AUTH === $_SESSION[ROLE]) {
  include_once 'view/home/authority.html';
  exit();
}

echo "error: invalid session coockie";
exit();
