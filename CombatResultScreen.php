<?php
// Combat Result Screen
class CombatResultScreen {
    public $battleOutcome;
    public $resourcesLooted;
    public $shipsDestroyed;
    
    public function __construct($battleOutcome, $resourcesLooted, $shipsDestroyed) {
        $this->battleOutcome = $battleOutcome;
        $this->resourcesLooted = $resourcesLooted;
        $this->shipsDestroyed = $shipsDestroyed;
    }

    public function displayCombatResult() {
        echo "<h3>Battle Outcome: " . $this->battleOutcome . "</h3>";
        echo "<p>Resources Looted: " . $this->resourcesLooted . "</p>";
        echo "<p>Ships Destroyed: " . $this->shipsDestroyed . "</p>";
    }
}

// Example usage
$combatResult = new CombatResultScreen("Victory", "500 Minerals, 200 Energy", "2 Interceptors, 1 Battleship");
$combatResult->displayCombatResult();
?>
