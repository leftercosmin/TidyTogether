<?php

ob_start();

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../model/zoneReportModel.php';
require_once __DIR__ . '/../util/databaseConnection.php';

// load environment variables if not already loaded
// formatEnv();
if (!getenv('DB_HOST')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();
    foreach ($_ENV as $key => $value) {
        putenv("$key=$value");
    }
}

try {
    $interval = isset($_GET['interval']) ? strtoupper($_GET['interval']) : 'MONTH';
    $validIntervals = ['DAY', 'WEEK', 'MONTH'];
    if (!in_array($interval, $validIntervals)) {
        $interval = 'MONTH';
    }

    $city = isset($_GET['city']) ? trim($_GET['city']) : '';

    //fetch data
    $data = getZoneReportStats($interval, $city);
    if (!is_array($data)) {
        $data = [];
    }

    if (isset($_GET['format'])) {
        ob_end_clean();

        switch ($_GET['format']) {
            case 'csv':
                header('Content-Type: text/csv');
                $filename = 'zone_report_' . $interval . ($city ? '_' . preg_replace('/[^a-zA-Z0-9]/', '', $city) : '') . '.csv';
                header('Content-Disposition: attachment; filename="' . $filename . '"');
                echo generateReportCSV($data);
                exit;

            case 'pdf':
                require_once __DIR__ . '/../../vendor/autoload.php';
                $mpdf = new \Mpdf\Mpdf();
                $htmlData = generateReportHTML($data, $interval, $city);
                $mpdf->WriteHTML($htmlData);
                $filename = 'zone_report_' . $interval . ($city ? '_' . preg_replace('/[^a-zA-Z0-9]/', '', $city) : '') . '.pdf';
                $mpdf->Output($filename, 'D');
                exit;

            default:
                header('HTTP/1.1 400 Bad Request');
                echo "Invalid format requested";
                exit;
        }
    }

    //for json response
    ob_end_clean();
    header('Content-Type: application/json');
    echo json_encode($data);

} catch (Exception $e) {
    ob_end_clean();

    if (isset($_GET['format'])) {
        header('HTTP/1.1 500 Internal Server Error');
        header('Content-Type: text/html');
        echo "<html><body><h1>Report Generation Error</h1><p>Unable to generate report</p></body></html>";
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => true, 'message' => 'Unable to load data']);
    }
}

exit;