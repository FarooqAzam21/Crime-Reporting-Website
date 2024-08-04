<?php
include 'db_config.php';

// Check the current number of registered users
$sql = "SELECT COUNT(*) AS count FROM users";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$userCount = $row['count'];

if ($userCount >= 4) {
    echo json_encode(array('status' => 'error', 'message' => 'User limit reached. No more registrations allowed.'));
    exit();
}

// Get user details from the POST request
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Insert user details into the database
$sql = "INSERT INTO users (name, phone, email, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $phone, $email, $password);

if ($stmt->execute()) {
    echo json_encode(array('status' => 'success', 'message' => 'Registration successful.'));
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Error during registration.'));
}

$conn->close();
?>
