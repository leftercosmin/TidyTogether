<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../model/zoneReportModel.php';

// Load environment variables if needed
if (!getenv('DB_HOST')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();
}

// Get the interval parameter (default to MONTH)
$interval = isset($_GET['interval']) ? strtoupper($_GET['interval']) : 'MONTH';
$validIntervals = ['DAY', 'WEEK', 'MONTH', 'YEAR'];
if (!in_array($interval, $validIntervals)) {
    $interval = 'MONTH';
}

// Get report data from the model
$data = getZoneReportStats($interval);

// Check the requested format and generate appropriate response
if (isset($_GET['format'])) {
    switch ($_GET['format']) {
        case 'csv':
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="zone_report.csv"');
            echo generateReportCSV($data);
            exit;
            
        case 'pdf':
            require_once __DIR__ . '/../../vendor/autoload.php'; // Ensure mpdf is available
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML(generateReportHTML($data, $interval));
            $mpdf->Output('zone_report.pdf', 'D');
            exit;
            
        default:
            // If unknown format, fall through to JSON
            break;
    }
}

// Default: Return JSON
header('Content-Type: application/json');
echo json_encode($data);
exit;