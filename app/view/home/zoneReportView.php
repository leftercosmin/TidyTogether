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
  <button class="menu-toggle" id="menuToggle">
    <?php require 'view/components/svg/menuSvg.php'; ?>
  </button>

  <div class="overlay" id="overlay"></div>

  <?php require_once 'view/components/civilianNavbar.php'; ?>

  <div class="report-container">
    <div class="content-wrapper">
      <h1 class="report-heading">Zone Cleanliness Reports</h1>

      <div class="controls-city">
        <div class="control-row">
          <div class="city-filter">
            <label for="city-input">Filter by City:</label>
            <input type="text" id="city-input" placeholder="Enter city name" />
            <button id="apply-filter-btn" onclick="applyCityFilter()">Apply Filter</button>
          </div>
        </div>

        <div class="control-row">
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
      </div>

      <div class="chart-box">
        <h3 id="chart-title">Reports by Zone</h3>
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
         
        </tbody>
      </table>
    </div>
  </div>

  <script>
    const userMainCity = <?php echo json_encode(isset($mainCity) ? $mainCity : ''); ?>;
  </script>
  <script src="javascript/zoneReports.js"></script>
  <script src="javascript/navbarCollapse.js"></script>
</body>

</html>