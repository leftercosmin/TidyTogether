<?php // used to load the dependencies

$path = "";
$file = strtok(__DIR__, "/");
while ($file !== false) {
  if ($file !== "app")
    $path .= $file . "/";
  $file = strtok("/");
}

$path .= 'vendor/autoload.php';
require_once __DIR__ . 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
require_once 'controller/homeController.php';
