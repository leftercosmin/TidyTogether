<?php
session_start();

if (!defined('CONN')) {
    define("CONN", "userSession");
}

$sessionData = json_decode($_SESSION[CONN] ?? '');
if (!isset($_SESSION[CONN]) || !$sessionData || !isset($sessionData->id)) {
    header("Location: ../../");
    exit();
}

$neighborhood = $_GET['neighborhood'] ?? '';
$city = $_GET['city'] ?? '';

if (empty($neighborhood) || empty($city)) {
    header("Location: ../../");
    exit();
}

require_once __DIR__ . '/neighborhoodReportView.php';