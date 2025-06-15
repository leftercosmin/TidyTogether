<?php // used to load the dependencies

if (!getenv('SERVER')) {
  require_once __DIR__ . '/../vendor/autoload.php';
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
  $dotenv->load();
}

require_once 'controller/homeController.php';
