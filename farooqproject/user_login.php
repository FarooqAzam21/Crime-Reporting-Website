<?php
session_start();
include('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, name, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $name, $hashed_password);

    if ($stmt->num_rows == 1) {
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_logged_in'] = true;
            header("Location: user_dashboard.php");
            exit();
        } else {
            $error_message = 'Invalid email or password';
        }
    } else {
        $error_message = 'Invalid email or password';
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="crimereport.css">
</head>
<body>
    <header>
        <h1>User Login</h1>
    </header>
    <main>
        <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="user_login.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" class="btn">Login</button>
            
        </form>
            <div class="popup" id="popup">
                <img src="submit-successfully.png">
                <h2> LOGIN SUCCESSFLLY</h2>
                
            </div>
    </main>
</body>
</html>
