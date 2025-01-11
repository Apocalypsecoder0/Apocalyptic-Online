<?php
// Planets and Colonies System
class PlanetsAndColonies {
    public $planetTypes;
    public $colonyDevelopment;
    
    public function __construct($planetTypes, $colonyDevelopment) {
        $this->planetTypes = $planetTypes;
        $this->colonyDevelopment = $colonyDevelopment;
    }

    public function displayPlanetDetails() {
        echo "<h3>Planets & Colonies:</h3>";
        echo "<h4>Planet Types:</h4><ul>";
        foreach ($this->planetTypes as $type) {
            echo "<li>" . $type . "</li>";
        }
        echo "</ul>";
        echo "<h4>Colony Development:</h4><ul>";
        foreach ($this->colonyDevelopment as $development) {
            echo "<li>" . $development . "</li>";
        }
        echo "</ul>";
    }
}

// Example usage
$planets = new PlanetsAndColonies(["Desert", "Gas Giant", "Ice Planet"], ["Terraforming", "Resource Mining", "Population Growth"]);
$planets->displayPlanetDetails();
?>
