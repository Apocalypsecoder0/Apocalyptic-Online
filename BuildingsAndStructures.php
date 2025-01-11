<?php
// Buildings and Structures Section
class BuildingsAndStructures {
    public $buildingList;

    public function __construct($buildingList) {
        $this->buildingList = $buildingList;
    }

    public function displayBuildings() {
        echo "<h3>Available Buildings</h3>";
        foreach ($this->buildingList as $building) {
            echo "<p>" . $building . "</p>";
        }
    }
}

// Example usage
$buildings = ["Barracks", "Research Lab", "Resource Extractor", "Command Center"];
$buildingSystem = new BuildingsAndStructures($buildings);
$buildingSystem->displayBuildings();
?>
