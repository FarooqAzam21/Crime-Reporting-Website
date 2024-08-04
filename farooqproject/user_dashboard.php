<?php
session_start();
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header("Location: user_login.php");
    exit();
}

include 'db_config.php';
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="crimereport.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $_SESSION['user_name']; ?></h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="user_logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>Your Reported Cases</h2>
            <table id="reportsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM crime_reports WHERE user_id='$user_id'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>{$row['id']}</td><td>{$row['description']}</td><td>{$row['Status']}</td><td>{$row['report_date']}</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No reports found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <section>
            <h2>Communication with Administrators</h2>
            <form action="send_message.php" method="post">
                <label for="report_id">Report ID:</label>
                <input type="number" name="report_id" required>
                <label for="message">Message:</label>
                <textarea name="message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
            <h3>Your Messages</h3>
            <table id="messagesTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Report ID</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM messages WHERE user_id='$user_id'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>{$row['id']}</td><td>{$row['report_id']}</td><td>{$row['message']}</td><td>{$row['created_at']}</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No messages found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
