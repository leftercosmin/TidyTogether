let barChart = null;
let currentInterval = 'MONTH';
let currentCity = '';

document.addEventListener('DOMContentLoaded', function() {
  console.log('zoneReports.js loaded');
  if (typeof userMainCity !== 'undefined' && userMainCity && userMainCity.trim() !== '') {
    currentCity = userMainCity.trim();
    const cityInput = document.getElementById('city-input');
    cityInput.value = currentCity;
    cityInput.placeholder = `Default: ${currentCity} (your main city)`;
    updateChartTitle();
    loadReportData('MONTH', currentCity);
  }
  
  updateDownloadLinks();
  
  document.getElementById('city-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
      applyCityFilter();
    }
  });
});

function changeInterval(interval) {
  document.querySelectorAll('.interval-selector button').forEach(btn => {
    btn.classList.remove('active');
  });
  document.getElementById(interval.toLowerCase() + '-btn').classList.add('active');
  
  currentInterval = interval;
  updateDownloadLinks();
  loadReportData(interval, currentCity);
}

function applyCityFilter() {
  const cityInput = document.getElementById('city-input');
  const newCity = cityInput.value.trim();
  
  if (!newCity) {
    alert('Please enter a city name to filter reports.');
    if (typeof userMainCity !== 'undefined' && userMainCity && userMainCity.trim() !== '') {
      cityInput.value = userMainCity.trim();
    } else {
      cityInput.value = currentCity;
    }
    return;
  }
  
  currentCity = newCity;
  updateChartTitle();
  loadReportData(currentInterval, currentCity);
  updateDownloadLinks();
}

function updateChartTitle() {
  const chartTitle = document.getElementById('chart-title');
  if (currentCity) {
    chartTitle.textContent = `Reports by Zone in ${currentCity}`;
  } else {
    chartTitle.textContent = 'Zone Reports - Please Select a City';
  }
}

function updateDownloadLinks() {
  const cityParam = currentCity ? `&city=${encodeURIComponent(currentCity)}` : '';
  document.getElementById('csv-link').href = 
    `controller/zoneReportController.php?interval=${currentInterval}&format=csv${cityParam}`;
  document.getElementById('pdf-link').href = 
    `controller/zoneReportController.php?interval=${currentInterval}&format=pdf${cityParam}`;
}

function loadReportData(interval, city = '') {
  console.log('Loading data for interval:', interval, 'city:', city);

  document.getElementById('reportsBarChart').innerHTML = '<div style="text-align:center;padding:20px;">Loading data...</div>';
  document.querySelector('#zoneReportTable tbody').innerHTML = '<tr><td colspan="6">Loading...</td></tr>';
  
  const cityParam = city ? `&city=${encodeURIComponent(city)}` : '';
  fetch(`controller/zoneReportController.php?interval=${interval}${cityParam}`)
    .then(response => {
      if (!response.ok) {
        throw new Error('Failed to load data');
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
      console.error('Error loading data:', err);
      document.getElementById('reportsBarChart').innerHTML = 
        `<div style="padding:20px;text-align:center;color:#721c24;background:#f8d7da;border-radius:5px;">
          Unable to load data
        </div>`;
      document.querySelector('#zoneReportTable tbody').innerHTML = 
        `<tr><td colspan="6">Unable to load data</td></tr>`;
    });
}

function renderBarChart(data) {
  const sortedData = [...data].sort((a, b) => b.total_reports - a.total_reports);
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
          backgroundColor: '#73a942',
        },
        {
          label: 'Completed',
          data: completedReports,
          backgroundColor: '#29bf12',
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
}

function renderTable(data) {
  const sortedData = [...data].sort((a, b) => b.total_reports - a.total_reports);
  
  // cleanest/dirtiest areas
  const enhancedData = sortedData.map(zone => {
    const total = Number(zone.total_reports);
    const completed = Number(zone.completed_reports);
    const completionPercentage = total > 0 ? Math.round((completed / total) * 100) : 0;
    
    return {
      ...zone,
      completionPercentage
    };
  });
  
  let html = '';
  enhancedData.forEach((zone) => {
    let rowClass = '';
    // <30% completion = red
    if (zone.completionPercentage < 30) {
      rowClass = 'dirty';
    }
    // >80% completion = green
    else if (zone.completionPercentage > 80) {
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
}