<?php
// Defense Troop Management
class DefenseTroops {
    public function trainDefenseTroops($troopType, $quantity) {
        // Logic to train defense troops
        return "$quantity $troopType trained successfully!";
    }

    public function deployDefenseTroops($troopType, $quantity, $location) {
        // Logic to deploy defense troops
        return "$quantity $troopType deployed to defend $location!";
    }
}

// Example Usage
$defense = new DefenseTroops();
echo $defense->trainDefenseTroops("Super Defense Troop", 50);
?>
