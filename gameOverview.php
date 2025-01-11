
<?php
// Game Overview Section
class GameOverview {
    public $gameTitle;
    public $gameGenre;
    public $platforms;
    public $gameMode;
    public $description;
    
    public function __construct($gameTitle, $gameGenre, $platforms, $gameMode, $description) {
        $this->gameTitle = $gameTitle;
        $this->gameGenre = $gameGenre;
        $this->platforms = $platforms;
        $this->gameMode = $gameMode;
        $this->description = $description;
    }

    public function displayOverview() {
        echo "<h1>" . $this->gameTitle . "</h1>";
        echo "<p><strong>Genre:</strong> " . $this->gameGenre . "</p>";
        echo "<p><strong>Platforms:</strong> " . implode(", ", $this->platforms) . "</p>";
        echo "<p><strong>Game Mode:</strong> " . $this->gameMode . "</p>";
        echo "<p><strong>Description:</strong> " . $this->description . "</p>";
    }
}

// Example usage
$gameOverview = new GameOverview("Galactic Empires", "MMORTS RPG", ["web game"], "Multiplayer Online", "An immersive sci-fi universe where players build empires, manage resources, and engage in intergalactic battles.");
$gameOverview->displayOverview();
?>
