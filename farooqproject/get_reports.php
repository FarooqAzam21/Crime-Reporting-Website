<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.html");
    exit();
}

require_once 'db_config.php';

$sql = "SELECT * FROM reports";
$result = $conn->query($sql);

$reports = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reports[] = $row;
    }
}

echo json_encode($reports);
?>
