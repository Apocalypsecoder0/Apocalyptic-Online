<?php
// Research and Technology Screen
class ResearchAndTechnologyScreen {
    public $currentResearch;
    public $availableTechnologies;
    
    public function __construct($currentResearch, $availableTechnologies) {
        $this->currentResearch = $currentResearch;
        $this->availableTechnologies = $availableTechnologies;
    }

    public function displayResearchScreen() {
        echo "<h3>Current Research: " . $this->currentResearch . "</h3>";
        echo "<h4>Available Technologies:</h4><ul>";
        foreach ($this->availableTechnologies as $technology) {
            echo "<li>" . $technology . "</li>";
        }
        echo "</ul>";
    }
}

// Example usage
$researchScreen = new ResearchAndTechnologyScreen("Advanced Mining", ["Laser Weapons", "Shielding Technologies"]);
$researchScreen->displayResearchScreen();
?>
