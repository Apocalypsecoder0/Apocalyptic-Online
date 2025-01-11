<?php
// Planetary Interface Section
class PlanetaryInterface {
    public $planetName;
    public $planetResources;
    public $planetBuildings;
    
    public function __construct($planetName, $planetResources, $planetBuildings) {
        $this->planetName = $planetName;
        $this->planetResources = $planetResources;
        $this->planetBuildings = $planetBuildings;
    }

    public function displayPlanetInterface() {
        echo "<h3>Planet: " . $this->planetName . "</h3>";
        echo "<p>Resources: " . implode(", ", $this->planetResources) . "</p>";
        echo "<h4>Buildings:</h4><ul>";
        foreach ($this->planetBuildings as $building) {
            echo "<li>" . $building . "</li>";
        }
        echo "</ul>";
    }
}

// Example usage
$planet = new PlanetaryInterface("Earth", ["Minerals", "Energy", "Food"], ["Command Center", "Resource Extractor"]);
$planet->displayPlanetInterface();
?>
