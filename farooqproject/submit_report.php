<?php
session_start();
include 'db_config.php'; // Include your database configuration file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'You need to be logged in to submit a report.']);
    exit();
}

$user_id = $_SESSION['user_id']; // Get user_id from session
$name = $_POST['name'];
$email = $_POST['email'];
$description = $_POST['description'];
$report_date = date('Y-m-d H:i:s');
$status = 'Pending'; // Default status

// Insert the data into the database
$sql = "INSERT INTO crime_reports (user_id, name, email, description, report_date, status) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssss", $user_id, $name, $email, $description, $report_date, $status);

if ($stmt->execute() === TRUE) {
    echo json_encode(['status' => 'success', 'message' => 'New record created successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
