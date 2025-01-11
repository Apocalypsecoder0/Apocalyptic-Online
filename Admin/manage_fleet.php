<?php
session_start();
require_once('config.php'); // Database connection

// Check if the user is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$fleetId = $_GET['id'] ?? null;

if ($fleetId) {
    $sql = "SELECT * FROM fleets WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $fleetId);
    $stmt->execute();
    $fleet = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fleetSize = $_POST['fleet_size'];
    $targetPlanet = $_POST['target_planet'];
    $isMoving = isset($_POST['is_moving']) ? 1 : 0;

    // Update fleet data
    $updateSql = "UPDATE fleets SET fleet_size = ?, target_planet = ?, is_moving = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param('iiii', $fleetSize, $targetPlanet, $isMoving, $fleetId);
    $updateStmt->execute();

    // Log the action
    $logSql = "INSERT INTO logs (action, user_id, details) VALUES ('Fleet Update', ?, 'Updated fleet {$fleet['fleet_name']}')";
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
    <title>Manage Fleet</title>
</head>
<body>
    <h1>Manage Fleet: <?= htmlspecialchars($fleet['fleet_name']); ?></h1>
    <form method="POST">
        <label for="fleet_size">Fleet Size:</label>
        <input type="number" id="fleet_size" name="fleet_size" value="<?= $fleet['fleet_size']; ?>" required>
        <br>

        <label for="target_planet">Target Planet:</label>
        <input type="number" id="target_planet" name="target_planet" value="<?= $fleet['target_planet']; ?>" required>
        <br>

        <label for="is_moving">Fleet Moving:</label>
        <input type="checkbox" id="is_moving" name="is_moving" <?= $fleet['is_moving'] ? 'checked' : ''; ?>>
        <br>

        <button type="submit">Update Fleet</button>
    </form>
    <br>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
