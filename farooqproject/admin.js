document.addEventListener('DOMContentLoaded', function () {
    fetch('fetch_reports.php')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('crimeChart').getContext('2d');
            
            // Prepare data for Chart.js
            const labels = data.map(item => item.report_date);
            const counts = data.map(item => item.count);

            const chart = new Chart(ctx, {
                type: 'line', // or 'bar', 'pie', etc.
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Crime Reports',
                        data: counts,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});
