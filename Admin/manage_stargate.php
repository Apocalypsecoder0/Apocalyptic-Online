<?php
session_start();
require_once('config.php'); // Database connection

// Check if the user is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$stargateId = $_GET['id'] ?? null;

if ($stargateId) {
    $sql = "SELECT * FROM stargates WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $stargateId);
    $stmt->execute();
    $stargate = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'] ?? 0;
    $destination = $_POST['destination'] ?? '';

    // Update the stargate status and destination
    $updateSql = "UPDATE stargates SET status = ?, destination = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param('ssi', $status, $destination, $stargateId);
    $updateStmt->execute();

    // Log the action
    $logSql = "INSERT INTO logs (action, user_id, details) VALUES ('Stargate Update', ?, 'Updated stargate status and destination for planet {$stargate['planet_name']}')";
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
    <title>Manage Stargate</title>
</head>
<body>
    <h1>Manage Stargate for Planet <?= htmlspecialchars($stargate['planet_name']); ?></h1>
    <form method="POST">
        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="1" <?= $stargate['status'] == 1 ? 'selected' : ''; ?>>Operational</option>
            <option value="0" <?= $stargate['status'] == 0 ? 'selected' : ''; ?>>Offline</option>
        </select>
        <br><br>

        <label for="destination">Destination:</label>
        <input type="text" name="destination" id="destination" value="<?= $stargate['destination']; ?>" required>
        <br><br>

        <button type="submit">Update Stargate</button>
    </form>
    <br>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
