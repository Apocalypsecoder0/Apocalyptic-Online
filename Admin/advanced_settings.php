<?php
session_start();
require_once('config.php'); // Database connection

// Check if the user is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update the game-wide settings
    $maintenanceMode = $_POST['maintenance_mode'] ?? 0;
    $eventTrigger = $_POST['event_trigger'] ?? 0;
    $resourceMultiplier = $_POST['resource_multiplier'] ?? 1;

    $updateSql = "UPDATE game_settings SET setting_value = ? WHERE setting_name = 'maintenance_mode'";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param('i', $maintenanceMode);
    $stmt->execute();

    $updateSql = "UPDATE game_settings SET setting_value = ? WHERE setting_name = 'event_trigger'";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param('i', $eventTrigger);
    $stmt->execute();

    $updateSql = "UPDATE game_settings SET setting_value = ? WHERE setting_name = 'resource_multiplier'";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param('i', $resourceMultiplier);
    $stmt->execute();

    // Log the action
    $logSql = "INSERT INTO logs (action, user_id, details) VALUES ('Advanced Settings Update', ?, 'Updated global game settings')";
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
    <title>Advanced Settings</title>
</head>
<body>
    <h1>Advanced Gameplay Settings</h1>
    <form method="POST">
        <label for="maintenance_mode">Maintenance Mode:</label>
        <input type="checkbox" name="maintenance_mode" id="maintenance_mode" <?= $maintenanceMode ? 'checked' : ''; ?>>
        <br><br>

        <label for="event_trigger">Event Trigger:</label>
        <input type="checkbox" name="event_trigger" id="event_trigger" <?= $eventTrigger ? 'checked' : ''; ?>>
        <br><br>

        <label for="resource_multiplier">Resource Multiplier:</label>
        <input type="number" name="resource_multiplier" id="resource_multiplier" value="<?= $resourceMultiplier; ?>" required>
        <br><br>

        <button type="submit">Update Settings</button>
    </form>
    <br>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
