// Function to travel via Jump Gate (Space Travel) with error handling
function useJumpGate($sourcePlanetId, $targetPlanetId) {
    global $conn;

    $sql = "SELECT * FROM jump_gates WHERE source_planet_id = ? AND target_planet_id = ? AND is_active = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $sourcePlanetId, $targetPlanetId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Traveling to planet ID $targetPlanetId via Jump Gate.\n";
    } else {
        echo "No active Jump Gate found between planets $sourcePlanetId and $targetPlanetId.\n";
    }
}

// Function to travel via Stargate (Planetary Travel) with error handling
function useStargate($sourcePlanetId, $targetPlanetId) {
    global $conn;

    $sql = "SELECT * FROM stargates WHERE source_planet_id = ? AND target_planet_id = ? AND is_active = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $sourcePlanetId, $targetPlanetId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Traveling to planet ID $targetPlanetId via Stargate.\n";
    } else {
        echo "No active Stargate found between planets $sourcePlanetId and $targetPlanetId.\n";
    }
}
