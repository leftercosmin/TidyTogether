<?php

ob_start();

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../model/zoneReportModel.php';

try {
    if (!getenv('DB_HOST')) {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
    }

    //get the interval parameter / month is default
    $interval = isset($_GET['interval']) ? strtoupper($_GET['interval']) : 'MONTH';
    $validIntervals = ['DAY', 'WEEK', 'MONTH', 'YEAR'];
    if (!in_array($interval, $validIntervals)) {
        $interval = 'MONTH';
    }

    //check the requested format and generate appropriate response
    if (isset($_GET['format'])) {
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
                $mpdf->WriteHTML(generateReportHTML($data, $interval));
                $mpdf->Output('zone_report.pdf', 'D');
                exit;
                
            default:
                // If not recognized default to JSON
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