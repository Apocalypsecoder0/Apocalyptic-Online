<?php
// Unique Unit Management
class UniqueUnits {
    public function unlockUniqueUnit($unitName) {
        // Logic to unlock a unique unit
        return "Unique unit $unitName unlocked!";
    }
}

// Example Usage
$unique = new UniqueUnits();
echo $unique->unlockUniqueUnit("Dragon Knight");
?>
