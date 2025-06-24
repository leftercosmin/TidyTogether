<?php

ob_start();

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../model/zoneReportModel.php';

// Turn off PHP error display in output
ini_set('display_errors', 0);
error_reporting(0);

try {
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

    // Check the requested format and generate appropriate response
    if (isset($_GET['format'])) {
        switch ($_GET['format']) {
            case 'csv':
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="zone_report.csv"');
                // Clear any buffered output
                ob_end_clean();
                echo generateReportCSV($data);
                exit;
                
            case 'pdf':
                // Clear any buffered output
                ob_end_clean();
                require_once __DIR__ . '/../../vendor/autoload.php';
                $mpdf = new \Mpdf\Mpdf();
                $mpdf->WriteHTML(generateReportHTML($data, $interval));
                $mpdf->Output('zone_report.pdf', 'D');
                exit;
                
            default:
                // If unknown format, fall through to JSON
                break;
        }
    }

    // Get report data from the model (wrapped in try/catch)
    try {
        $data = getZoneReportStats($interval);
        
        // Validate that data is an array to prevent issues
        if (!is_array($data)) {
            throw new Exception("Invalid data format returned from model");
        }
        
        // If data is empty, return empty array instead of null
        if (empty($data)) {
            $data = [];
        }
    } catch (Exception $e) {
        throw new Exception("Error fetching report data: " . $e->getMessage());
    }

    // Clear any buffered output before sending headers
    ob_end_clean();
    
    // Set JSON header and return data
    header('Content-Type: application/json');
    echo json_encode($data);
    
} catch (Exception $e) {
    // Clear any previous output
    ob_end_clean();
    
    // Return error as valid JSON
    header('Content-Type: application/json');
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage()
    ]);
}

exit;