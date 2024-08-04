<?php
include 'db_config.php'; // Ensure this path is correct

// Admin user credentials
$admin_id = 'admin';
$password = 'admin123'; // Change this to your desired password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if the table exists
$query_check = "SHOW TABLES LIKE 'admin_users'";
$result_check = $conn->query($query_check);

if ($result_check->num_rows == 1) {
    // Prepare the SQL query
    $query = "INSERT INTO admin_users (admin_id, password) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    
    $stmt->bind_param("ss", $admin_id, $hashed_password);
    
    if ($stmt->execute()) {
        echo "Admin user created successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    echo "Table 'admin_users' does not exist.";
}

$conn->close();
?>
