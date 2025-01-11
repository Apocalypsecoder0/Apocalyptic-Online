<?php
// Multiplayer Features Class
class MultiplayerFeatures {
    public $realTimeCommunication;
    public $playerInteractionPvP;
    public $alliancesAndCooperation;
    
    public function __construct($realTimeCommunication, $playerInteractionPvP, $alliancesAndCooperation) {
        $this->realTimeCommunication = $realTimeCommunication;
        $this->playerInteractionPvP = $playerInteractionPvP;
        $this->alliancesAndCooperation = $alliancesAndCooperation;
    }

    public function displayMultiplayerFeatures() {
        echo "<h3>Multiplayer Features:</h3>";
        echo "<p>Real-Time Communication: " . $this->realTimeCommunication . "</p>";
        echo "<p>Player vs. Player Interaction: " . $this->playerInteractionPvP . "</p>";
        echo "<p>Alliances & Cooperation: " . $this->alliancesAndCooperation . "</p>";
    }
}

// Example usage
$multiplayerFeatures = new MultiplayerFeatures("Chat, Voice, In-Game Messaging", "PvP Arena, Tactical Combat", "Form Alliances, Cooperative Missions");
$multiplayerFeatures->displayMultiplayerFeatures();
?>
