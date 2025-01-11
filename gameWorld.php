<?php
// Game World Class
class GameWorld {
    public $universeDesign;
    public $planetsAndColonies;
    public $fleetDesignAndShipTypes;
    
    public function __construct($universeDesign, $planetsAndColonies, $fleetDesignAndShipTypes) {
        $this->universeDesign = $universeDesign;
        $this->planetsAndColonies = $planetsAndColonies;
        $this->fleetDesignAndShipTypes = $fleetDesignAndShipTypes;
    }

    public function displayWorldDetails() {
        echo "<h3>Game World:</h3>";
        echo "<p>Universe Design: " . $this->universeDesign . "</p>";
        echo "<p>Planets & Colonies: " . $this->planetsAndColonies . "</p>";
        echo "<p>Fleet Design & Ship Types: " . $this->fleetDesignAndShipTypes . "</p>";
    }
}

// Example usage
$world = new GameWorld("Expanding Universe, Multiple Zones", "Various Habitable Planets, Colonies", "Fighters, Cruisers, Battleships");
$world->displayWorldDetails();
?>
