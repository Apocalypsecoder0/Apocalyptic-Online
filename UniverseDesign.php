<?php
// Universe Design Class
class UniverseDesign {
    public $zones;
    public $stellarObjects;
    
    public function __construct($zones, $stellarObjects) {
        $this->zones = $zones;
        $this->stellarObjects = $stellarObjects;
    }

    public function displayUniverseDesign() {
        echo "<h3>Universe Design:</h3>";
        echo "<h4>Zones:</h4><ul>";
        foreach ($this->zones as $zone) {
            echo "<li>" . $zone . "</li>";
        }
        echo "</ul>";
        echo "<h4>Stellar Objects:</h4><ul>";
        foreach ($this->stellarObjects as $object) {
            echo "<li>" . $object . "</li>";
        }
        echo "</ul>";
    }
}

// Example usage
$universe = new UniverseDesign(["Outer Rim", "Core Worlds"], ["Nebulas", "Stars", "Black Holes"]);
$universe->displayUniverseDesign();
?>
