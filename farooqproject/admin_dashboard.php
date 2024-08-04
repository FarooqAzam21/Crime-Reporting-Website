<?php
// admin_dashboard.php
include('db_config.php');
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.html");
    exit();
}

// Handle status update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
    $report_id = $_POST['report_id'];
    $new_status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE crime_reports SET Status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $report_id);

    if ($stmt->execute()) {
        echo "Status updated successfully.";
    } else {
        echo "Error updating status: " . $conn->error;
    }

    $stmt->close();
}

$sql = "SELECT id, name, email, description, report_date, user_id, Status FROM crime_reports";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    echo "Error: " . $conn->error;
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="crimereport.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>Reported Cases</h2>
            <table>
                <thead>
                    <tr>
                        <th>Case ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Details</th>
                        <th>Date</th>
                        <th>User ID</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>" . htmlspecialchars($row['id']) . "</td>
                                <td>" . htmlspecialchars($row['name']) . "</td>
                                <td>" . htmlspecialchars($row['email']) . "</td>
                                <td>" . htmlspecialchars($row['description']) . "</td>
                                <td>" . htmlspecialchars($row['report_date']) . "</td>
                                <td>" . htmlspecialchars($row['user_id']) . "</td>
                                <td>" . htmlspecialchars($row['Status']) . "</td>
                                <td>
                                    <form method='POST' action=''>
                                        <input type='hidden' name='report_id' value='" . htmlspecialchars($row['id']) . "'>
                                        <select name='status'>
                                            <option value='Pending'" . ($row['Status'] == 'Pending' ? ' selected' : '') . ">Pending</option>
                                            <option value='In Progress'" . ($row['Status'] == 'In Progress' ? ' selected' : '') . ">In Progress</option>
                                            <option value='Resolved'" . ($row['Status'] == 'Resolved' ? ' selected' : '') . ">Resolved</option>
                                        </select>
                                        <button type='submit' name='update_status'>Update</button>
                                    </form>
                                </td>
                              </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No reports found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <section>
            <h2>Feedback</h2>
            <table id="feedbackTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Report ID</th>
                        <th>User ID</th>
                        <th>Feedback</th>
                        <th>Rating</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM feedback";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr><td>{$row['id']}</td><td>{$row['report_id']}</td><td>{$row['user_id']}</td><td>{$row['feedback']}</td><td>{$row['rating']}</td><td>{$row['created_at']}</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No feedback found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
<?php
$conn->close();
?>
