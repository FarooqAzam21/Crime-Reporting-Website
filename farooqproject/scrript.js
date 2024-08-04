document.getElementById('crimeForm').addEventListener('submit', function(event) {
    let valid = true;
    
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const description = document.getElementById('description').value;
    
    if (!name || !email || !description) {
        valid = false;
        alert('Please fill in all fields.');
    }
    
    if (!valid) {
        event.preventDefault();
    }
});

function updateCrimeData() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var crimeData = JSON.parse(this.responseText);
            
            myChart.data.datasets[0].data = Object.values(crimeData);
            myChart.update();
        }
    };
    xhr.open("GET", "/fetch_reports.php", true);
    xhr.send();
}

setInterval(updateCrimeData, 5000); // Adjust the interval as needed

var ctx = document.getElementById('crimeRateChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'Crime Rate',
            data: [6, 19, 3, 5, 2, 3, 10],
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
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
