<?php
session_start();
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header("Location: user_login.html");
    exit();
}
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $report_id = $_POST['report_id'];
    $user_id = $_SESSION['user_id'];
    $message = $_POST['message'];

    $sql = "INSERT INTO messages (report_id, user_id, message) VALUES ('$report_id', '$user_id', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "Message sent!";
        header("Location: user_dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
