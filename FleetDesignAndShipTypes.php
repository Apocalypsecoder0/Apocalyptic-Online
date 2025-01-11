<?php
// Fleet Design and Ship Types System
class FleetDesignAndShipTypes {
    public $shipTypes;
    public $designCapabilities;
    
    public function __construct($shipTypes, $designCapabilities) {
        $this->shipTypes = $shipTypes;
        $this->designCapabilities = $designCapabilities;
    }

    public function displayFleetDesign() {
        echo "<h3>Fleet Design & Ship Types:</h3>";
        echo "<h4>Ship Types:</h4><ul>";
        foreach ($this->shipTypes as $type) {
            echo "<li>" . $type . "</li>";
        }
        echo "</ul>";
        echo "<h4>Design Capabilities:</h4><ul>";
        foreach ($this->designCapabilities as $capability) {
            echo "<li>" . $capability . "</li>";
        }
        echo "</ul>";
    }
}

// Example usage
$fleet = new FleetDesignAndShipTypes(["Interceptor", "Battleship", "Transport"], ["Customization", "Upgrade Slots", "Weapon Choices"]);
$fleet->displayFleetDesign();
?>
