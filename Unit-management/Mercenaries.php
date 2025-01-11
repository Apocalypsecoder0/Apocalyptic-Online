<?php
// Mercenary Management
class Mercenaries {
    public function hireMercenaries($quantity) {
        // Logic to hire mercenaries
        return "$quantity mercenaries hired!";
    }

    public function deployMercenaries($target) {
        // Logic to deploy mercenaries
        return "Mercenaries deployed to $target!";
    }
}

// Example Usage
$mercenaries = new Mercenaries();
echo $mercenaries->hireMercenaries(200);
?>
