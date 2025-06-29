<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Neighborhood Report - TidyTogether</title>
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
      <h1 class="report-heading" id="zone-title">Neighborhood Report</h1>

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
        <h3 id="chart-title">Report Status Distribution</h3>
        <div class="chart-content">
          <div class="stats-sidebar" id="chart-stats">
          </div>
          <div class="chart-wrapper">
            <canvas id="zonePieChart"></canvas>
          </div>
        </div>
      </div>
      <div class="stats-summary" id="stats-summary">
      </div>
    </div>
  </div>

  <script src="javascript/navbarCollapse.js"></script>
  <script>
    //URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const neighborhood = urlParams.get('neighborhood');
    const city = urlParams.get('city');
    const country = urlParams.get('country') || '';
    let currentInterval = urlParams.get('interval') || 'MONTH';

    document.getElementById('zone-title').textContent = `Zone Report: ${neighborhood}, ${city}`;
    document.getElementById('chart-title').textContent = `Report Status for ${neighborhood}`;

    let chart = null;

    function setActiveButton(interval) {
      document.querySelectorAll('.interval-selector button').forEach(btn => btn.classList.remove('active'));
      document.getElementById(`${interval.toLowerCase()}-btn`).classList.add('active');
    }

    function changeInterval(interval) {
      currentInterval = interval;
      setActiveButton(interval);
      loadZoneData();
      updateDownloadLinks();
    }
    function updateDownloadLinks() {
      const baseUrl = `controller/neighborhoodReportController.php?neighborhood=${encodeURIComponent(neighborhood)}&city=${encodeURIComponent(city)}&country=${encodeURIComponent(country)}&interval=${currentInterval}`;
      document.getElementById('csv-link').href = `${baseUrl}&format=csv`;
      document.getElementById('pdf-link').href = `${baseUrl}&format=pdf`;
    }

    function loadZoneData() {
      const url = `controller/neighborhoodReportController.php?neighborhood=${encodeURIComponent(neighborhood)}&city=${encodeURIComponent(city)}&country=${encodeURIComponent(country)}&interval=${currentInterval}`;

      fetch(url)
        .then(response => response.json())
        .then(data => {
          if (data.error) {
            console.error('Error:', data.message);
            return;
          }
          updateChart(data);
          updateChartStats(data);
        })
        .catch(error => {
          console.error('Error loading zone data:', error);
        });
    }

    function updateChart(data) {
      const ctx = document.getElementById('zonePieChart').getContext('2d');

      if (chart) {
        chart.destroy();
      }

      const chartData = {
        labels: ['Completed', 'Pending', 'In Progress'],
        datasets: [{
          data: [data.completed_reports, data.pending_reports, data.in_progress_reports],
          backgroundColor: [
            '#4CAF50',
            '#FFC107',
            '#2196F3'
          ],
          borderWidth: 2,
          borderColor: '#fff'
        }]
      };

      chart = new Chart(ctx, {
        type: 'pie',
        data: chartData,
        options: {
          responsive: true,
          maintainAspectRatio: true,
          aspectRatio: 1,
          plugins: {
            legend: {
              position: 'bottom',
              labels: {
                padding: 20,
                font: {
                  size: 14
                }
              }
            },
            tooltip: {
              callbacks: {
                label: function (context) {
                  const total = data.total_reports;
                  const value = context.parsed;
                  const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                  return `${context.label}: ${value} (${percentage}%)`;
                }
              }
            }
          },
          layout: {
            padding: {
              top: 20,
              bottom: 20,
              left: 20,
              right: 20
            }
          }
        }
      });
    }

    function updateChartStats(data) {
      const completionRate = data.total_reports > 0
        ? ((data.completed_reports / data.total_reports) * 100).toFixed(1)
        : 0;

      const completionClass = completionRate >= 70 ? 'completion-high' :
        completionRate >= 40 ? 'completion-medium' : 'completion-low';

      const statsHtml = `
        <div class="chart-stat-item">
          <h4>Total Reports</h4>
          <p class="chart-stat-value">${data.total_reports}</p>
        </div>
        <div class="chart-stat-item">
          <h4>Completed</h4>
          <p class="chart-stat-value completed">${data.completed_reports}</p>
        </div>
        <div class="chart-stat-item">
          <h4>Pending</h4>
          <p class="chart-stat-value pending">${data.pending_reports}</p>
        </div>
        <div class="chart-stat-item">
          <h4>In Progress</h4>
          <p class="chart-stat-value in-progress">${data.in_progress_reports}</p>
        </div>
        <div class="chart-stat-item">
          <h4>Completion Rate</h4>
          <p class="chart-stat-value ${completionClass}">${completionRate}%</p>
        </div>
      `;

      document.getElementById('chart-stats').innerHTML = statsHtml;
    }

    function updateStats(data) {
      const completionRate = data.total_reports > 0
        ? ((data.completed_reports / data.total_reports) * 100).toFixed(1)
        : 0;

      const completionClass = completionRate >= 70 ? 'completion-high' :
        completionRate >= 40 ? 'completion-medium' : 'completion-low';

      const statsHtml = `
        <div class="stats-grid">
          <div class="stat-item">
            <h4>Total Reports</h4>
            <p class="stat-value">${data.total_reports}</p>
          </div>
          <div class="stat-item">
            <h4>Completed</h4>
            <p class="stat-value completed">${data.completed_reports}</p>
          </div>
          <div class="stat-item">
            <h4>Pending</h4>
            <p class="stat-value pending">${data.pending_reports}</p>
          </div>
          <div class="stat-item">
            <h4>In Progress</h4>
            <p class="stat-value in-progress">${data.in_progress_reports}</p>
          </div>
          <div class="stat-item">
            <h4>Completion Rate</h4>
            <p class="stat-value ${completionClass}">${completionRate}%</p>
          </div>
        </div>
      `;

      document.getElementById('stats-summary').innerHTML = statsHtml;
    }

    setActiveButton(currentInterval);
    updateDownloadLinks();
    loadZoneData();

    //ensure chart responsiveness
    window.addEventListener('resize', function () {
      if (chart) {
        chart.resize();
      }
    });
  </script>
</body>

</html>