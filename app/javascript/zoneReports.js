let barChart = null;
let currentInterval = 'MONTH';

document.addEventListener('DOMContentLoaded', function() {
  console.log('zoneReports.js loaded');
  try {
    loadReportData('MONTH');
    console.log('Initial data load requested');
  } catch (error) {
    console.error('Error loading initial data:', error);
  }
});

function changeInterval(interval) {
  document.querySelectorAll('.interval-selector button').forEach(btn => {
    btn.classList.remove('active');
  });
  document.getElementById(interval.toLowerCase() + '-btn').classList.add('active');
  
  currentInterval = interval;
  updateDownloadLinks();
  loadReportData(interval);
}

function updateDownloadLinks() {
  document.getElementById('csv-link').href = 
    `/TidyTogether/app/controller/zoneReportController.php?interval=${currentInterval}&format=csv`;
  document.getElementById('pdf-link').href = 
    `/TidyTogether/app/controller/zoneReportController.php?interval=${currentInterval}&format=pdf`;
}

function loadReportData(interval) {
  console.log('Loading data for interval:', interval);

  document.getElementById('reportsBarChart').innerHTML = '<div style="text-align:center;padding:20px;">Loading data...</div>';
  document.querySelector('#zoneReportTable tbody').innerHTML = '<tr><td colspan="6">Loading...</td></tr>';
  
  fetch(`/TidyTogether/app/controller/zoneReportController.php?interval=${interval}`)
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok: ' + response.status);
      }
      
      // Check if the response is JSON
      const contentType = response.headers.get('content-type');
      if (!contentType || !contentType.includes('application/json')) {
        // If not JSON, get the text to show the actual error
        return response.text().then(text => {
          throw new Error('Server returned non-JSON response: ' + text.substring(0, 150) + '...');
        });
      }
      
      return response.json();
    })
    .then(data => {
      console.log('Data received:', data);
      if (data && data.length > 0) {
        renderBarChart(data);
        renderTable(data);
      } else {
        document.getElementById('reportsBarChart').innerHTML = '<div style="text-align:center;padding:20px;">No data available for this time period</div>';
        document.querySelector('#zoneReportTable tbody').innerHTML = '<tr><td colspan="6">No data available</td></tr>';
      }
      updateDownloadLinks();
    })
    .catch(err => {
      console.error('Error in fetch:', err);
      document.getElementById('reportsBarChart').innerHTML = 
        `<div style="padding:20px;text-align:center;color:#721c24;background:#f8d7da;border-radius:5px;">
          Error loading data: ${err.message}
        </div>`;
      document.querySelector('#zoneReportTable tbody').innerHTML = 
        `<tr><td colspan="6">Error loading data: ${err.message}</td></tr>`;
    });
}

function renderBarChart(data) {
  try {
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
        maintainAspectRatio: false,
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
  } catch (error) {
    console.error('Error rendering chart:', error);
  }
}

function renderTable(data) {
  try {
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
    
    document.querySelector('#zoneReportTable tbody').innerHTML = html || '<tr><td colspan="6">No data available</td></tr>';
  } catch (error) {
    console.error('Error rendering table:', error);
  }
}