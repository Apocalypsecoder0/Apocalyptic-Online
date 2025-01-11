<?php
session_start();
require_once('config.php'); // Database connection

// Check if the user is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch the game settings
$sql = "SELECT * FROM game_settings";
$result = $conn->query($sql);
$settings = $result->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $setting_name => $setting_value) {
        $updateSql = "UPDATE game_settings SET setting_value = ? WHERE setting_name = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param('ss', $setting_value, $setting_name);
        $updateStmt->execute();
    }

    // Log the action
    $logSql = "INSERT INTO logs (action, user_id, details) VALUES ('Game Settings Update', ?, 'Updated game settings')";
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
    <title>Game Settings</title>
</head>
<body>
    <h1>Manage Game Settings</h1>
    <form method="POST">
        <?php foreach ($settings as $setting): ?>
        <label for="<?= $setting['setting_name']; ?>"><?= $setting['setting_name']; ?>:</label>
        <input type="text" id="<?= $setting['setting_name']; ?>" name="<?= $setting['setting_name']; ?>" value="<?= $setting['setting_value']; ?>" required>
        <br><br>
        <?php endforeach; ?>
        
        <button type="submit">Update Settings</button>
    </form>
    <br>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
