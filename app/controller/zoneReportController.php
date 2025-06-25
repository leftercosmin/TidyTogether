<?php

ob_start();

ini_set('display_errors', 0);
error_reporting(E_ALL);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../model/zoneReportModel.php';
require_once __DIR__ . '/../util/databaseConnection.php';

try {
    // Load environment variables if not already loaded
    if (!getenv('DB_HOST')) {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
        foreach ($_ENV as $key => $value) {
            putenv("$key=$value");
        }
    }

    $interval = isset($_GET['interval']) ? strtoupper($_GET['interval']) : 'MONTH';
    $validIntervals = ['DAY', 'WEEK', 'MONTH', 'YEAR'];
    if (!in_array($interval, $validIntervals)) {
        $interval = 'MONTH';
    }

    if (isset($_GET['format'])) {
        ob_end_clean();
        
        switch ($_GET['format']) {
            case 'csv':
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="zone_report.csv"');
                ob_end_clean();
                echo generateReportCSV($data);
                exit;
                
            case 'pdf':
                ob_end_clean();
                require_once __DIR__ . '/../../vendor/autoload.php';
                $mpdf = new \Mpdf\Mpdf();
                
                $data = getZoneReportStats($interval);
                $mpdf->WriteHTML(generateReportHTML($data, $interval));
                $mpdf->Output('zone_report.pdf', 'D');
                exit;
                
            default:
                break;
        }
    }

    try {
        $data = getZoneReportStats($interval);
        if (!is_array($data)) {
            throw new Exception("Invalid data format returned from model");
        }
  
        if (empty($data)) {
            $data = [];
        }
    } catch (Exception $e) {
        throw new Exception("Error fetching report data: " . $e->getMessage());
    }

    ob_end_clean();
    header('Content-Type: application/json');
    echo json_encode($data);
    
} catch (Exception $e) {
    ob_end_clean();
    
    header('Content-Type: application/json');
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage()
    ]);
}

exit;