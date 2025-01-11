<?php
// Alliances and Cooperation System
class AlliancesAndCooperation {
    public $allianceTypes;
    public $cooperativeMissions;
    
    public function __construct($allianceTypes, $cooperativeMissions) {
        $this->allianceTypes = $allianceTypes;
        $this->cooperativeMissions = $cooperativeMissions;
    }

    public function displayAllianceDetails() {
        echo "<h3>Alliances & Cooperation:</h3>";
        echo "<h4>Alliance Types:</h4><ul>";
        foreach ($this->allianceTypes as $type) {
            echo "<li>" . $type . "</li>";
        }
        echo "</ul>";
        echo "<h4>Cooperative Missions:</h4><ul>";
        foreach ($this->cooperativeMissions as $mission) {
            echo "<li>" . $mission . "</li>";
        }
        echo "</ul>";
    }
}

// Example usage
$alliance = new AlliancesAndCooperation(["Military Alliance", "Resource Sharing"], ["Defend Allied Planet", "Joint Fleet Mission"]);
$alliance->displayAllianceDetails();
?>
