<?php
session_start();
require_once('config.php'); // Database connection

// Check if the user is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$planetId = $_GET['id'] ?? null;

if ($planetId) {
    $sql = "SELECT * FROM planets WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $planetId);
    $stmt->execute();
    $planet = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $resources = $_POST['resources'];

    // Update the resources for the planet
    $updateSql = "UPDATE planets SET resources = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param('ii', $resources, $planetId);
    $updateStmt->execute();

    // Log the action
    $logSql = "INSERT INTO logs (action, user_id, details) VALUES ('Resource Update', ?, 'Updated resources for planet {$planet['name']}')";
    $logStmt = $conn->prepare($logSql);
    $logStmt->bind_param('i', $_SESSION['user_id']);
    $logStmt->execute();

    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Resources</title>
</head>
<body>
    <h1>Manage Resources for Planet <?= htmlspecialchars($planet['name']); ?></h1>
    <form method="POST">
        <label for="resources">Resources:</label>
        <input type="number" id="resources" name="resources" value="<?= $planet['resources']; ?>" required>
        <button type="submit">Update Resources</button>
    </form>
    <br>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
