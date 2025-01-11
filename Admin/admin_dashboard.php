<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

require_once('config.php'); // Database connection

// Function to fetch the latest logs
function getLatestLogs($conn) {
    $sql = "SELECT * FROM logs ORDER BY timestamp DESC LIMIT 10";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to get all users
function getAllUsers($conn) {
    $sql = "SELECT id, username, email, role FROM users";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to get all planets
function getAllPlanets($conn) {
    $sql = "SELECT * FROM planets";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to get all fleets
function getAllFleets($conn) {
    $sql = "SELECT * FROM fleets";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

$logs = getLatestLogs($conn);
$users = getAllUsers($conn);
$planets = getAllPlanets($conn);
$fleets = getAllFleets($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Control Panel</title>
    <link rel="stylesheet" href="styles.css"> <!-- CSS for styling -->
</head>
<body>
    <h1>Admin Control Panel</h1>
    
    <h2>Welcome, Admin!</h2>
    
    <div class="section">
        <h3>Users</h3>
        <table>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['username']); ?></td>
                <td><?= htmlspecialchars($user['email']); ?></td>
                <td><?= htmlspecialchars($user['role']); ?></td>
                <td>
                    <a href="manage_user.php?id=<?= $user['id']; ?>">Manage</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="section">
        <h3>Planets</h3>
        <table>
            <tr>
                <th>Planet Name</th>
                <th>Owner</th>
                <th>Resources</th>
                <th>Jump Gate</th>
                <th>Stargate</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($planets as $planet): ?>
            <tr>
                <td><?= htmlspecialchars($planet['name']); ?></td>
                <td><?= htmlspecialchars($planet['owner_id']); ?></td>
                <td><?= htmlspecialchars($planet['resources']); ?></td>
                <td><?= $planet['jump_gate'] ? 'Active' : 'Inactive'; ?></td>
                <td><?= $planet['stargate'] ? 'Active' : 'Inactive'; ?></td>
                <td>
                    <a href="manage_planet.php?id=<?= $planet['id']; ?>">Manage</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
<div class="section">
    <h3>Manage Jump Gates</h3>
    <table>
        <tr>
            <th>Planet Name</th>
            <th>Owner</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($jumpGates as $jumpGate): ?>
        <tr>
            <td><?= htmlspecialchars($jumpGate['planet_name']); ?></td>
            <td><?= htmlspecialchars($jumpGate['owner_id']); ?></td>
            <td><?= $jumpGate['status'] == 1 ? 'Active' : 'Inactive'; ?></td>
            <td>
                <a href="manage_jump_gate.php?id=<?= $jumpGate['id']; ?>">Manage Jump Gate</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<div class="section">
    <h3>Manage Fleets</h3>
    <table>
        <tr>
            <th>Fleet Name</th>
            <th>Owner</th>
            <th>Size</th>
            <th>Target Planet</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($fleets as $fleet): ?>
        <tr>
            <td><?= htmlspecialchars($fleet['fleet_name']); ?></td>
            <td><?= htmlspecialchars($fleet['owner_id']); ?></td>
            <td><?= htmlspecialchars($fleet['fleet_size']); ?></td>
            <td><?= htmlspecialchars($fleet['target_planet']); ?></td>
            <td><?= $fleet['is_moving'] ? 'Moving' : 'Stationary'; ?></td>
            <td>
                <a href="manage_fleet.php?id=<?= $fleet['id']; ?>">Manage Fleet</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
    <div class="section">
        <h3>Fleets</h3>
        <table>
            <tr>
                <th>Fleet Name</th>
                <th>Owner</th>
                <th>Size</th>
                <th>Target Planet</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($fleets as $fleet): ?>
            <tr>
                <td><?= htmlspecialchars($fleet['fleet_name']); ?></td>
                <td><?= htmlspecialchars($fleet['owner_id']); ?></td>
                <td><?= htmlspecialchars($fleet['fleet_size']); ?></td>
                <td><?= htmlspecialchars($fleet['target_planet']); ?></td>
                <td><?= $fleet['is_moving'] ? 'Moving' : 'Stationary'; ?></td>
                <td>
                    <a href="manage_fleet.php?id=<?= $fleet['id']; ?>">Manage</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
<div class="section">
    <h3>Manage Resources</h3>
    <table>
        <tr>
            <th>Planet Name</th>
            <th>Owner</th>
            <th>Resources</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($planets as $planet): ?>
        <tr>
            <td><?= htmlspecialchars($planet['name']); ?></td>
            <td><?= htmlspecialchars($planet['owner_id']); ?></td>
            <td><?= htmlspecialchars($planet['resources']); ?></td>
            <td>
                <a href="manage_resources.php?id=<?= $planet['id']; ?>">Manage Resources</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
    <div class="section">
        <h3>Latest Logs</h3>
        <table>
            <tr>
                <th>Action</th>
                <th>User</th>
                <th>Timestamp</th>
                <th>Details</th>
            </tr>
            <?php foreach ($logs as $log): ?>
            <tr>
                <td><?= htmlspecialchars($log['action']); ?></td>
                <td><?= htmlspecialchars($log['user_id']); ?></td>
                <td><?= $log['timestamp']; ?></td>
                <td><?= htmlspecialchars($log['details']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    
</body>
</html>
