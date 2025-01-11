<?php
// Microtransactions System
class Microtransactions {
    public $transactionTypes;
    public $itemsAvailable;
    
    public function __construct($transactionTypes, $itemsAvailable) {
        $this->transactionTypes = $transactionTypes;
        $this->itemsAvailable = $itemsAvailable;
    }

    public function displayMicrotransactionDetails() {
        echo "<h3>Microtransactions:</h3>";
        echo "<h4>Types:</h4><ul>";
        foreach ($this->transactionTypes as $type) {
            echo "<li>" . $type . "</li>";
        }
        echo "</ul>";
        echo "<h4>Available Items:</h4><ul>";
        foreach ($this->itemsAvailable as $item) {
            echo "<li>" . $item . "</li>";
        }
        echo "</ul>";
    }
}

// Example usage
$microtransactions = new Microtransactions(["Cosmetics", "Boosters", "Subscriptions"], ["Ship Skins", "XP Boosters", "VIP Access"]);
$microtransactions->displayMicrotransactionDetails();
?>
