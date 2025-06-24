<?php

require_once __DIR__ . '/../util/databaseConnection.php';

function getZoneReportStats($interval = 'WEEK') {
    $validIntervals = ['DAY', 'WEEK', 'MONTH', 'YEAR'];
    if (!in_array($interval, $validIntervals)) {
        $interval = 'WEEK'; //invalid -> default to week
    }
    
    $db = DatabaseConnection::get();
    if (!$db || $db->connect_error) {
        return []; 
    }

    $sql = "SELECT
              Zone.id,
              Zone.name AS neighborhood,
              Zone.city,
              Zone.country,
              COUNT(Post.id) AS total_reports,
              SUM(CASE WHEN Post.status = 'done' THEN 1 ELSE 0 END) AS completed_reports
            FROM Zone
            LEFT JOIN Post ON Post.idZone = Zone.id
              AND Post.createdAt >= DATE_SUB(NOW(), INTERVAL 1 $interval)
            GROUP BY Zone.id, Zone.name, Zone.city, Zone.country
            ORDER BY total_reports DESC";
            
    $result = $db->query($sql);
    if (!$result) {
        return [];
    }
    
    $data = [];
    while ($row = $result->fetch_assoc()) {
        if ($row['total_reports'] > 0) {
            $data[] = $row;
        }
    }
    
    return $data;
}

//CSV helper
function generateReportCSV($data) {
    $output = "Neighborhood,City,Country,Total Reports,Completed Reports,Completion Percentage\n";
    
    foreach ($data as $row) {
        $completionPercentage = $row['total_reports'] > 0 
            ? round(($row['completed_reports'] / $row['total_reports']) * 100) 
            : 0;
            
        $output .= "{$row['neighborhood']},{$row['city']},{$row['country']}," .
                  "{$row['total_reports']},{$row['completed_reports']}," .
                  "{$completionPercentage}%\n";
    }
    
    return $output;
}

//PDF helper
function generateReportHTML($data, $interval) {
    $intervalText = [
        'DAY' => 'Last 24 Hours',
        'WEEK' => 'Last Week',
        'MONTH' => 'Last Month',
        'YEAR' => 'Last Year'
    ];
    
    $title = isset($intervalText[$interval]) ? $intervalText[$interval] : 'Custom Period';
    
    $html = '<style>
        body { font-family: Arial, sans-serif; }
        h1, h2 { color: #333; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr.dirty { background-color: rgba(255,0,0,0.1); }
        tr.clean { background-color: rgba(0,255,0,0.1); }
    </style>';
    
    $html .= "<h1>Zone Cleanliness Report</h1>";
    $html .= "<h2>Period: {$title}</h2>";
    $html .= "<p>Generated on: " . date('F j, Y, g:i a') . "</p>";
    
    $html .= '<table>
        <thead>
            <tr>
                <th>Neighborhood</th>
                <th>City</th>
                <th>Country</th>
                <th>Total Reports</th>
                <th>Completed</th>
                <th>Completion %</th>
            </tr>
        </thead>
        <tbody>';
    
    //highlights for dirty and clean zones
    $numRows = count($data);
    $dirtyThreshold = max(1, floor($numRows * 0.2));
    $cleanThreshold = max(1, floor($numRows * 0.8));
    
    foreach ($data as $index => $row) {
        $completionPercentage = $row['total_reports'] > 0 
            ? round(($row['completed_reports'] / $row['total_reports']) * 100) 
            : 0;
            
        $rowClass = '';
        if ($index < $dirtyThreshold) {
            $rowClass = 'dirty';
        } else if ($index >= $cleanThreshold) {
            $rowClass = 'clean';
        }
        
        $html .= "<tr class=\"{$rowClass}\">
            <td>{$row['neighborhood']}</td>
            <td>{$row['city']}</td>
            <td>{$row['country']}</td>
            <td>{$row['total_reports']}</td>
            <td>{$row['completed_reports']}</td>
            <td>{$completionPercentage}%</td>
        </tr>";
    }
    
    $html .= '</tbody></table>';
    
    return $html;
}