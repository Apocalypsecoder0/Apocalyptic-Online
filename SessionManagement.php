<?php
session_start();  // Start session to track the user

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "galactic_empire";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to log in a player (for demo purposes)
function loginPlayer($username) {
    // Set session for player login
    $_SESSION['username'] = $username;
}

// Function to log out a player
function logoutPlayer() {
    session_unset();
    session_destroy();
}

// Function to get the current logged-in player
function getLoggedInPlayer() {
    if (isset($_SESSION['username'])) {
        return $_SESSION['username'];
    } else {
        return null;  // No user logged in
    }
}

// Function to control planets and moons for the logged-in player
function getUserControlledPlanets() {
    global $conn;
    $owner = getLoggedInPlayer();  // Get logged-in player

    if ($owner) {
        $sql = "SELECT * FROM planets WHERE owner = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $owner);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "Planets controlled by $owner:\n";
        while ($row = $result->fetch_assoc()) {
            echo "Planet ID: " . $row['id'] . " Name: " . $row['name'] . "\n";
        }
    } else {
        echo "No player logged in.\n";
    }
}
?>
