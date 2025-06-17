<?php
require_once "util/getRoot.php";

// get session
session_start();
if (!isset($_SESSION[CONN])) {
  $root = getRoot();
  header("Location: $root");
  exit();
}

// get location

// print map
// print profile

// see raports
// see past posts
