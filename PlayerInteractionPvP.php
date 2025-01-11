<?php
// Player Interaction (PvP) System
class PlayerInteractionPvP {
    public $pvpMode;
    public $arenaTypes;
    
    public function __construct($pvpMode, $arenaTypes) {
        $this->pvpMode = $pvpMode;
        $this->arenaTypes = $arenaTypes;
    }

    public function displayPvPDetails() {
        echo "<h3>Player vs Player Interaction:</h3>";
        echo "<p>Mode: " . $this->pvpMode . "</p>";
        echo "<h4>Arena Types:</h4><ul>";
        foreach ($this->arenaTypes as $arena) {
            echo "<li>" . $arena . "</li>";
        }
        echo "</ul>";
    }
}

// Example usage
$pvp = new PlayerInteractionPvP("Team Deathmatch, Free-for-All", ["Galactic Arena", "Space Battlefields"]);
$pvp->displayPvPDetails();
?>
