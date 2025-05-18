<?php

// todo define constants
// load the dependency
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
include_once 'controller/controller.php';
