<?php
// admin_login.php
include('db_config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_id = $_POST['admin_id'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin_users WHERE admin_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_logged_in'] = true;
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Invalid admin ID or password.";
        }
    } else {
        echo "Invalid admin ID or password.";
    }
    $stmt->close();
}
$conn->close();
?>
