<?php
include 'db_config.php';

// Fetch crime data from the database
$sql = "SELECT MONTH(report_date) AS month, COUNT(*) AS count FROM reports GROUP BY MONTH(report_date)";
$result = $conn->query($sql);

$crimeData = array();
while ($row = $result->fetch_assoc()) {
    $crimeData[$row['month']] = $row['count'];
}

echo json_encode($crimeData);
$conn->close();
?>
