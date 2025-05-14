<?php

require __DIR__ . '/vendor/autoload.php';
// header("Location: controller/controller.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dada = $_ENV['MAP_KEY'];
echo $dada;
exit();
