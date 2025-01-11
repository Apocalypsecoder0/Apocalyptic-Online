// Function to activate/deactivate a Jump Gate
function toggleJumpGate($sourcePlanetId, $targetPlanetId, $status) {
    global $conn;

    // Check if user is an admin (this can be set using session)
    if (getLoggedInPlayer() !== 'admin') {
        echo "Only admins can control jump gates.\n";
        return;
    }

    $status = ($status) ? 1 : 0;  // 1 for active, 0 for inactive

    $sql = "UPDATE jump_gates SET is_active = ? WHERE source_planet_id = ? AND target_planet_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $status, $sourcePlanetId, $targetPlanetId);
    $stmt->execute();

    echo $status ? "Jump Gate activated between planets $sourcePlanetId and $targetPlanetId.\n" : "Jump Gate deactivated between planets $sourcePlanetId and $targetPlanetId.\n";
}

// Function to activate/deactivate a Stargate
function toggleStargate($sourcePlanetId, $targetPlanetId, $status) {
    global $conn;

    // Check if user is an admin (this can be set using session)
    if (getLoggedInPlayer() !== 'admin') {
        echo "Only admins can control stargates.\n";
        return;
    }

    $status = ($status) ? 1 : 0;  // 1 for active, 0 for inactive

    $sql = "UPDATE stargates SET is_active = ? WHERE source_planet_id = ? AND target_planet_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $status, $sourcePlanetId, $targetPlanetId);
    $stmt->execute();

    echo $status ? "Stargate activated between planets $sourcePlanetId and $targetPlanetId.\n" : "Stargate deactivated between planets $sourcePlanetId and $targetPlanetId.\n";
}
