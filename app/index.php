<?php // used to load the dependencies

require_once "util/alert.php";
require_once "util/isError.php";
require_once "util/getRoot.php";
require_once "util/formatField.php";
require_once "util/writeConsole.php";
require_once "util/databaseConnection.php";
require_once "util/printFiles.php";
require_once "util/getSourcePhoto.php";

if (!getenv('SERVER')) {
  require_once '../vendor/autoload.php';
  $dotenv = Dotenv\Dotenv::createImmutable("../");
  $dotenv->load();
  foreach ($_ENV as $key => $value) {
    putenv("$key=$value");
  }
}

require_once 'controller/homeController.php';
register_shutdown_function(fn() => DatabaseConnection::close());
