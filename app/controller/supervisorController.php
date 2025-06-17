<?php
require_once "util/getRoot.php";

// get session
session_start();
if (!isset($_SESSION[CONN])) {
  $root = getRoot();
  header("Location: $root");
  exit();
}

// get city
// get post
// approve them
// see their status
