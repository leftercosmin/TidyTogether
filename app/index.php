<?php // used to load the dependencies

require_once "util/alert.php";
require_once "util/isError.php";
require_once "util/getRoot.php";
require_once "util/formatField.php";
require_once "util/writeConsole.php";
require_once "util/databaseConnection.php";
require_once "util/printFiles.php";
require_once "util/getSourcePhoto.php";
require_once "util/formatEnv.php";

formatEnv();

if(isset($_GET["fetch"])){
  require_once "controller/fetchController.php";
  exit();
}

require_once 'controller/homeController.php';
register_shutdown_function(fn() => DatabaseConnection::close());
