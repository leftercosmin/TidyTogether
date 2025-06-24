<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zone Reports - TidyTogether</title>
  <link rel="stylesheet" href="style/chartReport.css">
  <link rel="stylesheet" href="style/globals.css">
  <link rel="stylesheet" href="style/navbar.css">
  <link rel="stylesheet" href="style/civilianHome.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <!-- Add mobile menu toggle button -->
  <button class="menu-toggle" id="menuToggle">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white">
      <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/>
    </svg>
  </button>

  <!-- Add overlay for mobile menu -->
  <div class="overlay" id="overlay"></div>
  
  <?php require_once __DIR__ . '/../components/civilianNavbar.php'; ?>
  
  <div class="report-container">
    <div class="content-wrapper">
      <h1 class="report-heading">Zone Cleanliness Reports</h1>

      <div class="controls">
        <div class="interval-selector">
          <button id="day-btn" onclick="changeInterval('DAY')">Last 24 Hours</button>
          <button id="week-btn" onclick="changeInterval('WEEK')">Last Week</button>
          <button id="month-btn" class="active" onclick="changeInterval('MONTH')">Last Month</button>
        </div>
        
        <div class="download-options">
          <a id="csv-link" href="#" target="_blank">Download CSV</a>
          <a id="pdf-link" href="#" target="_blank">Download PDF</a>
        </div>
      </div>
      
      <div class="chart-box">
        <h3>Reports by Zone</h3>
        <canvas id="reportsBarChart"></canvas>
      </div>
      
      <h2 class="report-heading">Detailed Zone Report</h2>
      
      <div class="legend">
        <div class="legend-item">
          <div class="legend-color" style="background-color:rgba(255, 99, 132, 0.7);"></div>
          <span class="legend-text">Dirtiest Areas</span>
        </div>
        <div class="legend-item">
          <div class="legend-color" style="background-color:rgba(75, 192, 192, 0.7);"></div>
          <span class="legend-text">Cleanest Areas</span>
        </div>
      </div>
      
      <table id="zoneReportTable" class="data-table">
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
        <tbody>
          <!-- data is inserted here -->
        </tbody>
      </table>
    </div>
  </div>

  <!-- Include both scripts for the report -->
  <script src="javascript/zoneReports.js"></script>
  <script src="javascript/navbarCollapse.js"></script>
</body>
</html>