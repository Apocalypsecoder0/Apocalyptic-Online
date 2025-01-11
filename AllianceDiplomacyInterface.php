<?php
// Alliance Diplomacy Interface
class AllianceDiplomacyInterface {
    public $allianceName;
    public $alliedFactions;
    public $diplomaticStatus;
    
    public function __construct($allianceName, $alliedFactions, $diplomaticStatus) {
        $this->allianceName = $allianceName;
        $this->alliedFactions = $alliedFactions;
        $this->diplomaticStatus = $diplomaticStatus;
    }

    public function displayDiplomacyInterface() {
        echo "<h3>Alliance: " . $this->allianceName . "</h3>";
        echo "<h4>Allied Factions:</h4><ul>";
        foreach ($this->alliedFactions as $faction) {
            echo "<li>" . $faction . "</li>";
        }
        echo "</ul>";
        echo "<h4>Diplomatic Status:</h4><ul>";
        foreach ($this->diplomaticStatus as $faction => $status) {
            echo "<li>" . $faction . ": " . $status . "</li>";
        }
        echo "</ul>";
    }
}

// Example usage
$allianceDiplomacy = new AllianceDiplomacyInterface("Galactic Council", ["Faction A", "Faction B"], ["Faction A" => "Alliance", "Faction B" => "Neutral"]);
$allianceDiplomacy->displayDiplomacyInterface();
?>
