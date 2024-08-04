<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="crimereport.css">
</head>
<body>
    <header>
        <h1>Crime Reporting System</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="report_crime.php">Report a Crime</a></li>
                <li><a href="crime_tips.php">Crime Prevention Tips</a></li>
                <li><a href="support_services.php">Support Services</a></li>
                <li><a href="contact_us.php">Contact Us</a></li>
                <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn">Account</a>
                        <div class="dropdown-content">
                            <a href="user_dashboard.php">Dashboard</a>
                            <a href="user_logout.php">Logout</a>
                        </div>
                    </li>
                <?php else: ?>
                    <li><a href="user_registration.html">Register</a></li>
                    <li><a href="user_login.html">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
