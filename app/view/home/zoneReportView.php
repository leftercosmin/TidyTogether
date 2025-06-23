<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zone Reports - TidyTogether</title>
  <link rel="stylesheet" href="/TidyTogether/app/style/civilianHome.css">
  <style>
    .report-container {
      padding: 20px;
      max-width: 1200px;
      margin: 0 auto;
    }
    .controls {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
      align-items: center;
    }
    .interval-selector button {
      padding: 8px 16px;
      margin-right: 10px;
      cursor: pointer;
      border: 1px solid #ccc;
      background: #f1f1f1;
      border-radius: 4px;
    }
    .interval-selector button.active {
      background: var(--base-color);
      color: var(--accent-color);
      font-weight: bold;
    }
    .download-options a {
      margin-left: 10px;
      padding: 8px 16px;
      background: var(--base-color);
      color: var(--accent-color);
      text-decoration: none;
      border-radius: 4px;
    }
    .chart-box {
      width: 100%;
      background: #fff;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      margin-bottom: 30px;
    }
    .data-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    .data-table th, .data-table td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: left;
    }
    .data-table th {
      background-color: var(--base-color);
      color: var(--accent-color);
    }
    .dirty {
      background-color: rgba(255,0,0,0.1);
    }
    .clean {
      background-color: rgba(0,255,0,0.1);
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <?php require_once __DIR__ . '/../components/civilianNavbar.php'; ?>
  
  <div class="report-container">
    <h1>Zone Cleanliness Reports</h1>
    
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
    
    <h2>Detailed Zone Report</h2>
    <p><span style="background-color:rgba(255,0,0,0.1);padding:2px 5px;">Red</span> = Dirtiest Areas | 
       <span style="background-color:rgba(0,255,0,0.1);padding:2px 5px;">Green</span> = Cleanest Areas</p>
    
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
        <!-- Data will be inserted here -->
      </tbody>
    </table>
  </div>

  <script>
    let barChart = null;
    let currentInterval = 'MONTH';
    
    // Initial load
    document.addEventListener('DOMContentLoaded', function() {
      loadReportData('MONTH');
    });
    
    function changeInterval(interval) {
      // Update active button
      document.querySelectorAll('.interval-selector button').forEach(btn => {
        btn.classList.remove('active');
      });
      document.getElementById(interval.toLowerCase() + '-btn').classList.add('active');
      
      // Update download links
      currentInterval = interval;
      updateDownloadLinks();
      
      // Load new data
      loadReportData(interval);
    }
    
    function updateDownloadLinks() {
      document.getElementById('csv-link').href = 
        `/TidyTogether/app/controller/zoneReportController.php?interval=${currentInterval}&format=csv`;
      document.getElementById('pdf-link').href = 
        `/TidyTogether/app/controller/zoneReportController.php?interval=${currentInterval}&format=pdf`;
    }
    
    function loadReportData(interval) {
      fetch(`/TidyTogether/app/controller/zoneReportController.php?interval=${interval}`)
        .then(res => res.json())
        .then(data => {
          renderBarChart(data);
          renderTable(data);
          updateDownloadLinks();
        })
        .catch(err => console.error('Error loading report data:', err));
    }
    
    function renderBarChart(data) {
      // Sort data by total reports descending
      const sortedData = [...data].sort((a, b) => b.total_reports - a.total_reports);
      
      // Take top 10 zones for readability
      const topZones = sortedData.slice(0, 10);
      
      const labels = topZones.map(row => row.neighborhood);
      const totalReports = topZones.map(row => Number(row.total_reports));
      const completedReports = topZones.map(row => Number(row.completed_reports));
      
      const ctx = document.getElementById('reportsBarChart').getContext('2d');
      
      if (barChart) {
        barChart.destroy();
      }
      
      barChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [
            {
              label: 'Total Reports',
              data: totalReports,
              backgroundColor: 'rgba(255, 99, 132, 0.7)',
              borderColor: 'rgb(255, 99, 132)',
              borderWidth: 1
            },
            {
              label: 'Completed',
              data: completedReports,
              backgroundColor: 'rgba(75, 192, 192, 0.7)',
              borderColor: 'rgb(75, 192, 192)',
              borderWidth: 1
            }
          ]
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Number of Reports'
              }
            }
          }
        }
      });
    }
    
    function renderTable(data) {
      // Sort by total reports in descending order
      const sortedData = [...data].sort((a, b) => b.total_reports - a.total_reports);
      
      // Calculate completion percentage and identify cleanest/dirtiest areas
      const enhancedData = sortedData.map(zone => {
        const total = Number(zone.total_reports);
        const completed = Number(zone.completed_reports);
        const completionPercentage = total > 0 ? Math.round((completed / total) * 100) : 0;
        
        return {
          ...zone,
          completionPercentage
        };
      });
      
      // Mark the top 20% as dirty and bottom 20% as clean (if we have enough data)
      const numRows = enhancedData.length;
      const dirtyThreshold = Math.max(1, Math.floor(numRows * 0.2));
      const cleanThreshold = Math.max(1, Math.floor(numRows * 0.8));
      
      let html = '';
      enhancedData.forEach((zone, index) => {
        let rowClass = '';
        if (index < dirtyThreshold) {
          rowClass = 'dirty';
        } else if (index >= cleanThreshold) {
          rowClass = 'clean';
        }
        
        html += `
          <tr class="${rowClass}">
            <td>${zone.neighborhood}</td>
            <td>${zone.city}</td>
            <td>${zone.country}</td>
            <td>${zone.total_reports}</td>
            <td>${zone.completed_reports}</td>
            <td>${zone.completionPercentage}%</td>
          </tr>
        `;
      });
      
      document.querySelector('#zoneReportTable tbody').innerHTML = html;
    }
  </script>
</body>
</html>