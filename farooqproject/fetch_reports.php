<?php
header('Content-Type: application/json'); // Ensure the content type is JSON

include 'db_config.php'; // Include your database configuration file

$sql = "SELECT DATE(report_date) as date, COUNT(*) as count FROM crime_reports GROUP BY DATE(report_date)";
$result = $conn->query($sql);

if (!$result) {
    // If the query fails, output the error message
    echo json_encode(['error' => $conn->error]);
    exit();
}

$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data = [];
}

echo json_encode($data);

$conn->close();
?>
