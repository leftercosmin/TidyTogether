<?php
// API/data processing logic
ob_start();

ini_set('display_errors', 0);
error_reporting(E_ALL);

require_once __DIR__ . '/../../vendor/autoload.php';
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
    $neighborhood = $_GET['neighborhood'] ?? '';
    $city = $_GET['city'] ?? '';
    $country = $_GET['country'] ?? '';
    $interval = isset($_GET['interval']) ? strtoupper($_GET['interval']) : 'MONTH';

    $validIntervals = ['DAY', 'WEEK', 'MONTH'];
    if (!in_array($interval, $validIntervals)) {
        $interval = 'MONTH';
    }

    if (empty($neighborhood) || empty($city)) {
        throw new Exception("Zone information is required");
    }

    if (isset($_GET['format'])) {
        ob_end_clean();

        $data = getNeighborhoodReportStats($neighborhood, $city, $country, $interval);

        switch ($_GET['format']) {
            case 'csv':
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="zone_report_' . urlencode($neighborhood) . '.csv"');
                echo generateZoneReportCSV($data, $neighborhood, $city, $interval);
                exit;

            case 'pdf':
                require_once __DIR__ . '/../../vendor/autoload.php';
                $mpdf = new \Mpdf\Mpdf();
                $mpdf->WriteHTML(generateZoneReportHTML($data, $neighborhood, $city, $interval));
                $mpdf->Output('zone_report_' . urlencode($neighborhood) . '.pdf', 'D');
                exit;

            default:
                break;
        }
    }

    try {
        $data = getNeighborhoodReportStats($neighborhood, $city, $country, $interval);
        if (!is_array($data)) {
            throw new Exception("Invalid data format returned from model");
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

function getNeighborhoodReportStats($neighborhood, $city, $country, $interval = 'MONTH')
{
    $db = DatabaseConnection::get();
    if (!$db || $db->connect_error) {
        throw new Exception("Database connection failed");
    }

    $stmt = $db->prepare("SELECT id FROM Zone WHERE name = ? AND city = ? AND country = ?");
    $stmt->bind_param("sss", $neighborhood, $city, $country);
    $stmt->execute();
    $result = $stmt->get_result();
    $zone = $result->fetch_assoc();

    if (!$zone) {
        return [
            'neighborhood' => $neighborhood,
            'city' => $city,
            'country' => $country,
            'total_reports' => 0,
            'completed_reports' => 0,
            'pending_reports' => 0,
            'in_progress_reports' => 0
        ];
    }

    $zoneId = $zone['id'];

    $sql = "SELECT
              COUNT(Post.id) AS total_reports,
              SUM(CASE WHEN Post.status = 'done' THEN 1 ELSE 0 END) AS completed_reports,
              SUM(CASE WHEN Post.status = 'pending' THEN 1 ELSE 0 END) AS pending_reports,
              SUM(CASE WHEN Post.status = 'inProgress' THEN 1 ELSE 0 END) AS in_progress_reports
            FROM Post
            WHERE Post.idZone = ?
              AND Post.createdAt >= DATE_SUB(NOW(), INTERVAL 1 $interval)";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $zoneId);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    $data['neighborhood'] = $neighborhood;
    $data['city'] = $city;
    $data['country'] = $country;

    return $data;
}

function generateZoneReportCSV($data, $neighborhood, $city, $interval)
{
    $output = "Zone Report for: $neighborhood, $city\n";
    $output .= "Time Period: Last $interval\n";
    $output .= "Generated: " . date('Y-m-d H:i:s') . "\n\n";
    $output .= "Status,Count\n";
    $output .= "Total Reports," . $data['total_reports'] . "\n";
    $output .= "Completed," . $data['completed_reports'] . "\n";
    $output .= "Pending," . $data['pending_reports'] . "\n";
    $output .= "In Progress," . $data['in_progress_reports'] . "\n";

    if ($data['total_reports'] > 0) {
        $completionRate = round(($data['completed_reports'] / $data['total_reports']) * 100, 2);
        $output .= "Completion Rate," . $completionRate . "%\n";
    }

    return $output;
}

function generateZoneReportHTML($data, $neighborhood, $city, $interval) {
    $intervalText = [
        'DAY' => 'Last 24 Hours',
        'WEEK' => 'Last Week',
        'MONTH' => 'Last Month'
    ];
    
    $title = isset($intervalText[$interval]) ? $intervalText[$interval] : 'Custom Period';
    
    $html = '<style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1, h2 { color: #333; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .stats-row { background-color: #f9f9f9; }
        .header-info { margin-bottom: 20px; }
        .completion-rate { font-size: 1.2em; font-weight: bold; color: #017852; }
    </style>';
    
    $html .= "<h1>Zone Cleanliness Report</h1>";
    $html .= "<div class='header-info'>";
    $html .= "<h2>Zone: " . htmlspecialchars($neighborhood) . ", " . htmlspecialchars($city) . "</h2>";
    $html .= "<p><strong>Period:</strong> {$title}</p>";
    $html .= "</div>";
    
    $html .= '<table>
        <thead>
            <tr>
                <th>Status</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>';
    
    $html .= "<tr class='stats-row'>
        <td><strong>Total Reports</strong></td>
        <td>{$data['total_reports']}</td>
    </tr>";
    
    $html .= "<tr>
        <td>Completed</td>
        <td>{$data['completed_reports']}</td>
    </tr>";
    
    $html .= "<tr>
        <td>Pending</td>
        <td>{$data['pending_reports']}</td>
    </tr>";
    
    $html .= "<tr>
        <td>In Progress</td>
        <td>{$data['in_progress_reports']}</td>
    </tr>";
    
    if ($data['total_reports'] > 0) {
        $completionRate = round(($data['completed_reports'] / $data['total_reports']) * 100, 2);
        $html .= "<tr class='stats-row'>
            <td><strong>Completion Rate</strong></td>
            <td class='completion-rate'>{$completionRate}%</td>
        </tr>";
    }
    
    $html .= '</tbody></table>';
    
    if ($data['total_reports'] == 0) {
        $html .= "<p style='margin-top: 20px; font-style: italic; color: #666;'>No reports found for this zone in the selected time period.</p>";
    }
    
    return $html;
}

exit;