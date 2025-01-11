<?php
// Tech Trees and Unlocks System
class TechTreesAndUnlocks {
    public $techTree;
    public $unlockableItems;
    
    public function __construct($techTree, $unlockableItems) {
        $this->techTree = $techTree;
        $this->unlockableItems = $unlockableItems;
    }

    public function displayTechTree() {
        echo "<h3>Technology Tree:</h3>";
        echo "<ul>";
        foreach ($this->techTree as $tech) {
            echo "<li>" . $tech . "</li>";
        }
        echo "</ul>";

        echo "<h4>Unlockable Items:</h4><ul>";
        foreach ($this->unlockableItems as $item) {
            echo "<li>" . $item . "</li>";
        }
        echo "</ul>";
    }
}

// Example usage
$techTree = new TechTreesAndUnlocks(["Energy Production", "Weapon Research", "Fleet Enhancements"], ["Advanced Shields", "Laser Weapons"]);
$techTree->displayTechTree();
?>
