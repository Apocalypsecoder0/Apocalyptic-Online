<?php
// Fleet Management Screen
class FleetManagementScreen {
    public $fleetName;
    public $fleetShips;
    public $fleetStatus;
    
    public function __construct($fleetName, $fleetShips, $fleetStatus) {
        $this->fleetName = $fleetName;
        $this->fleetShips = $fleetShips;
        $this->fleetStatus = $fleetStatus;
    }

    public function displayFleetScreen() {
        echo "<h3>Fleet: " . $this->fleetName . "</h3>";
        echo "<h4>Ships:</h4><ul>";
        foreach ($this->fleetShips as $ship) {
            echo "<li>" . $ship . "</li>";
        }
        echo "</ul>";
        echo "<p>Status: " . $this->fleetStatus . "</p>";
    }
}

// Example usage
$fleetScreen = new FleetManagementScreen("Fleet Alpha", ["Interceptor", "Battleship"], "Ready for battle");
$fleetScreen->displayFleetScreen();
?>
