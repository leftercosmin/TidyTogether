<?php

function getZoneReportStats($interval = 'WEEK', $city = '') {
    $validIntervals = ['DAY', 'WEEK', 'MONTH'];
    if (!in_array($interval, $validIntervals)) {
        $interval = 'WEEK';
    }
    
    $db = DatabaseConnection::get();
    if (!$db || $db->connect_error) {
        return []; 
    }

    $cityCondition = '';
    $params = [];
    $types = '';

    if (!empty($city)) {
        $cityCondition = 'WHERE Zone.city LIKE ?';
        $params[] = '%' . $city . '%';
        $types = 's';
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
            $cityCondition
            GROUP BY Zone.id, Zone.name, Zone.city, Zone.country
            ORDER BY total_reports DESC";

    if (!empty($params)) {
        $stmt = $db->prepare($sql);
        if (!$stmt) {
            return [];
        }
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $result = $db->query($sql);
    }
    
    if (!$result) {
        return [];
    }
    
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    
    return $data;
}

//CSV helper
function generateReportCSV($data) {
    $output = "Neighborhood,City,Country,Total Reports,Completed Reports,Completion Percentage\n";
    
    if (empty($data)) {
        $output .= "No data available for the selected period\n";
        return $output;
    }
    
    foreach ($data as $row) {
        $completionPercentage = $row['total_reports'] > 0 
            ? round(($row['completed_reports'] / $row['total_reports']) * 100) 
            : 0;
        
        // Escape commas and quotes in CSV data
        $neighborhood = '"' . str_replace('"', '""', $row['neighborhood']) . '"';
        $city = '"' . str_replace('"', '""', $row['city']) . '"';
        $country = '"' . str_replace('"', '""', $row['country']) . '"';
            
        $output .= "{$neighborhood},{$city},{$country}," .
                  "{$row['total_reports']},{$row['completed_reports']}," .
                  "{$completionPercentage}%\n";
    }
    
    return $output;
}

// //PDF helper
// function generateReportHTML($data, $interval, $city = '') {
//     $intervalText = [
//         'DAY' => 'Last 24 Hours',
//         'WEEK' => 'Last Week',
//         'MONTH' => 'Last Month',
//         'YEAR' => 'Last Year'
//     ];
    
//     $title = isset($intervalText[$interval]) ? $intervalText[$interval] : 'Custom Period';
//     $cityText = !empty($city) ? " for City: " . htmlspecialchars($city) : "";
    
//     $html = '<style>
//         body { font-family: Arial, sans-serif; }
//         h1, h2 { color: #333; }
//         table { border-collapse: collapse; width: 100%; margin-top: 20px; }
//         th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
//         th { background-color: #f2f2f2; }
//         tr.dirty { background-color: rgba(255,0,0,0.1); }
//         tr.clean { background-color: rgba(0,255,0,0.1); }
//     </style>';
    
//     $html .= "<h1>Zone Cleanliness Report</h1>";
//     $html .= "<h2>Period: {$title}{$cityText}</h2>";
//     $html .= "<p>Generated on: " . date('F j, Y, g:i a') . "</p>";
    
//     $html .= '<table>
//         <thead>
//             <tr>
//                 <th>Neighborhood</th>
//                 <th>City</th>
//                 <th>Country</th>
//                 <th>Total Reports</th>
//                 <th>Completed</th>
//                 <th>Completion %</th>
//             </tr>
//         </thead>
//         <tbody>';
    
//     if (empty($data)) {
//         $html .= '<tr><td colspan="6" style="text-align: center; font-style: italic;">No data available for the selected period</td></tr>';
//     } else {
//         //highlights for dirty and clean zones
//         $numRows = count($data);
//         $dirtyThreshold = max(1, floor($numRows * 0.2));
//         $cleanThreshold = max(1, floor($numRows * 0.8));
        
//         foreach ($data as $index => $row) {
//             $completionPercentage = $row['total_reports'] > 0 
//                 ? round(($row['completed_reports'] / $row['total_reports']) * 100) 
//                 : 0;
                
//             $rowClass = '';
//             if ($index < $dirtyThreshold) {
//                 $rowClass = 'dirty';
//             } else if ($index >= $cleanThreshold) {
//                 $rowClass = 'clean';
//             }
            
//             // Escape HTML entities
//             $neighborhood = htmlspecialchars($row['neighborhood']);
//             $city = htmlspecialchars($row['city']);
//             $country = htmlspecialchars($row['country']);
            
//             $html .= "<tr class=\"{$rowClass}\">
//                 <td>{$neighborhood}</td>
//                 <td>{$city}</td>
//                 <td>{$country}</td>
//                 <td>{$row['total_reports']}</td>
//                 <td>{$row['completed_reports']}</td>
//                 <td>{$completionPercentage}%</td>
//             </tr>";
//         }
//     }
    
//     $html .= '</tbody></table>';
    
//     return $html;
// }