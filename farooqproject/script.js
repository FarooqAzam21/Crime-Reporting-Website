
$(document).ready(function() {
  $.ajax({
      url: 'fetch_reports.php',
      method: 'GET',
      success: function(response) {
          try {
              if (response.error) {
                  console.error('Error from server:', response.error);
                  return;
              }
              
              var labels = response.map(function(item) { return item.date; });
              var counts = response.map(function(item) { return item.count; });

              var ctx = document.getElementById('crimeRateChart').getContext('2d');
              var crimeRateChart = new Chart(ctx, {
                  type: 'line',
                  data: {
                      labels: labels,
                      datasets: [{
                          label: 'Crime Reports',
                          data: counts,
                          borderColor: 'rgba(75, 192, 192, 1)',
                          borderWidth: 1
                      }]
                  },
                  options: {
                      scales: {
                          y: {
                              beginAtZero: true
                          }
                      }
                  }
              });
          } catch (error) {
              console.error('Error parsing JSON:', error);
          }
      },
      error: function(xhr, status, error) {
          console.error('AJAX error:', status, error);
      }
  });
});
