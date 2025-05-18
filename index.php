<?php

define("REGISTRATION_SUCCS", 0);
define("REGISTRATION_FAILR", 1);
define("REGISTRATION_FAILR_DATAB", 2);
define("REGISTRATION_FAILR_EMAIL", 3);
define("REGISTRATION_FAILR_PASSW", 4);

// load the dependency
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
include_once 'controller/controller.php';
