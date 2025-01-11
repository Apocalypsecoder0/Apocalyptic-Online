<?php
session_start();
require_once('config.php'); // Database connection

// Check if the user is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$jumpGateId = $_GET['id'] ?? null;

if ($jumpGateId) {
    $sql = "SELECT * FROM jump_gates WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $jumpGateId);
    $stmt->execute();
    $jumpGate = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'] ?? 0;
    
    // Update the status of the jump gate
    $updateSql = "UPDATE jump_gates SET status = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param('ii', $status, $jumpGateId);
    $updateStmt->execute();

    // Log the action
    $logSql = "INSERT INTO logs (action, user_id, details) VALUES ('Jump Gate Update', ?, 'Updated jump gate status for planet {$jumpGate['planet_name']}')";
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
    <title>Manage Jump Gate</title>
</head>
<body>
    <h1>Manage Jump Gate for Planet <?= htmlspecialchars($jumpGate['planet_name']); ?></h1>
    <form method="POST">
        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="1" <?= $jumpGate['status'] == 1 ? 'selected' : ''; ?>>Active</option>
            <option value="0" <?= $jumpGate['status'] == 0 ? 'selected' : ''; ?>>Inactive</option>
        </select>
        <br><br>
        <button type="submit">Update Jump Gate Status</button>
    </form>
    <br>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
