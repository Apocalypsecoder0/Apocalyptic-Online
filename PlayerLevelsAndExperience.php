<?php
// Player Levels and Experience System
class PlayerLevelsAndExperience {
    public $level;
    public $xpRequiredForNextLevel;
    
    public function __construct($level, $xpRequiredForNextLevel) {
        $this->level = $level;
        $this->xpRequiredForNextLevel = $xpRequiredForNextLevel;
    }

    public function displayLevelDetails() {
        echo "<h3>Player Level: " . $this->level . "</h3>";
        echo "<p>XP to Next Level: " . $this->xpRequiredForNextLevel . "</p>";
    }
}

// Example usage
$levelDetails = new PlayerLevelsAndExperience(5, 2000);
$levelDetails->displayLevelDetails();
?>
