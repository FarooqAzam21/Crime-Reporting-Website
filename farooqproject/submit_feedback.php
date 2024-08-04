<?php
include 'db_config.php'; // Ensure this file includes your database connection settings

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $report_id = $_POST['report_id'];
    $user_id = $_POST['user_id'];
    $feedback = $_POST['feedback'];
    $rating = $_POST['rating'];

    $sql = "INSERT INTO feedback (report_id, user_id, feedback, rating) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisi", $report_id, $user_id, $feedback, $rating);

    if ($stmt->execute()) {
        echo "Feedback submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
