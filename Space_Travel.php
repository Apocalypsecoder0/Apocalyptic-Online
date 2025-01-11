<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "galactic_empire";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to travel via Jump Gate (Space Travel)
function useJumpGate($sourcePlanetId, $targetPlanetId) {
    global $conn;
    
    // Check if the jump gate exists and is active
    $sql = "SELECT * FROM jump_gates WHERE source_planet_id = ? AND target_planet_id = ? AND is_active = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $sourcePlanetId, $targetPlanetId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Traveling to planet ID $targetPlanetId via Jump Gate.\n";
    } else {
        echo "Jump Gate is not available for travel between these planets.\n";
    }
}

// Function to travel via Stargate (Planetary Travel)
function useStargate($sourcePlanetId, $targetPlanetId) {
    global $conn;

    // Check if the stargate exists and is active
    $sql = "SELECT * FROM stargates WHERE source_planet_id = ? AND target_planet_id = ? AND is_active = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $sourcePlanetId, $targetPlanetId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Traveling to planet ID $targetPlanetId via Stargate.\n";
    } else {
        echo "Stargate is not available for travel between these planets.\n";
    }
}

// Function to get planets controlled by a user
function getUserControlledPlanets($owner) {
    global $conn;
    
    $sql = "SELECT * FROM planets WHERE owner = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $owner);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "Planets controlled by $owner:\n";
    while ($row = $result->fetch_assoc()) {
        echo "Planet ID: " . $row['id'] . " Name: " . $row['name'] . "\n";
    }
}

// Function to get moons of a planet
function getMoonsOfPlanet($planetId) {
    global $conn;
    
    $sql = "SELECT * FROM moons WHERE planet_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $planetId);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "Moons orbiting planet ID $planetId:\n";
    while ($row = $result->fetch_assoc()) {
        echo "Moon ID: " . $row['id'] . " Name: " . $row['name'] . "\n";
    }
}

// Example usage
getUserControlledPlanets('Player1');
useJumpGate(1, 2); // Example: Player travels from planet 1 to planet 2
useStargate(1, 3); // Example: Player travels from planet 1 to planet 3
?>
