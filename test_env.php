<?php
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

echo 'DB_HOST=' . ($_ENV['DB_HOST'] ?? 'NOT SET') . '<br>';
echo 'DB_HOST getenv=' . getenv('DB_HOST') . '<br>';